<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            // Diarahkan langsung ke dashboard.php setelah login berhasil
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
  <main class="login-page">
    <section class="login-form">
      <form action="" method="POST">
        <h1>Login</h1>
        <p class="subtitle">Silahkan Login</p>
        <?php if (!empty($error)) { echo "<p style='color: red; font-size: 13px; margin-bottom: 10px;'>$error</p>"; } ?>

        <div class="field">
          <input type="email" id="email" name="email" placeholder="Email" aria-label="Email" autocomplete="email" required>
          <p class="error" id="email-error" role="alert"></p>
        </div>

        <div class="field">
          <div class="password-wrap">
            <input type="password" id="password" name="password" placeholder="Password" aria-label="Password" autocomplete="current-password" required>
          </div>
          <p class="error" id="password-error" role="alert"></p>
        </div>

        <div class="options">
          <label class="remember">
            <input type="checkbox" id="remember" name="remember">
            <span>Remember me</span>
          </label>
          <a href="forgot-password.php">Lupa Password?</a>
        </div>

        <button type="submit" id="submit-btn">Log In</button>
        <p class="status" id="status" role="status" aria-live="polite"></p>

        <p class="signup">Belum punya akun? <a href="sign_up.php">Daftar Disini!</a></p>
      </form>
    </section>

    <section class="login-image">
      <div class="image-card">
        <img src="/assets/img/dentist_picture.jpg" alt="Dokter gigi sedang memeriksa pasien" onerror="this.style.display='none'">
        <span class="placeholder">INI GAMBAR</span>
      </div>
    </section>
      <address class="footer">
        <p>&copy; 2024 Sunflower Dental Klinik. All rights reserved.</p>
      </address>
  </main>
</body>
</html>