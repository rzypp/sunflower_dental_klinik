<?php
include 'koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Pendaftaran gagal: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="/assets/css/sign_up.css">
</head>
<body>
    <div class="signup-container">
        <div class="left-box">
            <img src="/assets/img/dentist_picture.jpg" alt="dentist_picture.jpg">
        </div>
        
        <div class="form-box">
        <h1 id="title">Create Account</h1>
        <?php if (!empty($error)) { echo "<p style='color: red; font-size: 13px; margin-bottom: 10px;'>$error</p>"; } ?>
        <form action="" method="POST">
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-submit">Sign Up</button>
        </form>

        <p class="login-link">
            Sudah punya akun? <a href="login.php">Masuk di sini</a>
        </p>
    </div>
</body>
</html>