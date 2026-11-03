<?php
session_start();
include 'koneksi.php';

$error = '';
$success = '';
$token = '';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
} elseif (isset($_POST['token'])) {
    $token = $_POST['token'];
}

if (empty($token)) {
    header("Location: login.php");
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) !== 1) {
    $error = "Token reset password tidak valid atau sudah kadaluarsa.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt_update = mysqli_prepare($conn, "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        mysqli_stmt_bind_param($stmt_update, "ss", $password, $token);

        if (mysqli_stmt_execute($stmt_update)) {
            $success = "Password berhasil diubah! Silakan <a href='login.php'>Login</a>.";
        } else {
            $error = "Gagal mengubah password: " . mysqli_error($conn);
        }
    } else {
        $error = "Password baru tidak boleh kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Klinik Gigi</title>
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
    <main class="login-page">
        <!-- Bagian Form -->
        <section class="login-form">
            <form action="" method="POST">
                <h1>Reset Password</h1>
                <p class="subtitle">Masukkan password baru akun Anda</p>

                <?php if ($error): ?>
                    <p style="color: red; font-size: 13px;"><?= $error ?></p>
                <?php endif; ?>

                <?php if ($success): ?>
                    <p style="color: green; font-size: 13px;"><?= $success ?></p>
                <?php endif; ?>

                <?php if (empty($success) && strpos($error, 'tidak valid') === false): ?>
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">

                    <div class="field">
                        <input type="password" name="password" placeholder="Password Baru" required>
                    </div>

                    <button type="submit" id="submit-btn">Simpan Password Baru</button>
                <?php endif; ?>
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