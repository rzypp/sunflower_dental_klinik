<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($current_password, $user['password'])) {
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt_update = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt_update, "si", $hashed_new_password, $user_id);

        if (mysqli_stmt_execute($stmt_update)) {
            $success = "Password berhasil diperbarui!";
        } else {
            $error = "Terjadi kesalahan saat memperbarui password.";
        }
    } else {
        $error = "Password lama yang Anda masukkan salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ganti Password - Klinik Gigi</title>
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
    <main class="login-page">
        <!-- Bagian Form -->
        <section class="login-form">
            <form action="" method="POST">
                <h1>Ganti Password</h1>
                <p class="subtitle">Masukkan password lama dan password baru Anda</p>

                <?php if ($error): ?>
                    <p style="color: red; font-size: 13px;"><?= $error ?></p>
                <?php endif; ?>

                <?php if ($success): ?>
                    <p style="color: green; font-size: 13px;"><?= $success ?></p>
                <?php endif; ?>

                <div class="field">
                    <input type="password" name="current_password" placeholder="Password Lama" required>
                </div>

                <div class="field">
                    <input type="password" name="new_password" placeholder="Password Baru" required>
                </div>

                <button type="submit" id="submit-btn">Simpan Perubahan</button>
                <p class="signup"><a href="login.php">Kembali ke Dashboard</a></p>
            </form>
        </section>

        <!-- Bagian Gambar -->
        <section class="login-image">
            <div class="image-card">
                <img src="/assets/img/dentist_picture.jpg" alt="Dokter gigi sedang memeriksa pasien" onerror="this.style.display='none'">
                <span class="placeholder">INI GAMBAR</span>
            </div>
        </section>
    </main>
</body>
</html>