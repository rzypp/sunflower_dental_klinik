<?php
session_start();
include 'koneksi.php';

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error   = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $token   = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

            $updateStmt = mysqli_prepare($conn, "UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
            mysqli_stmt_bind_param($updateStmt, "sss", $token, $expires, $email);
            mysqli_stmt_execute($updateStmt);

            $mail = new PHPMailer(true);

            try {
                // Konfigurasi SMTP Mailtrap
                $mail->isSMTP();
                $mail->Host       = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = '6882c17d220bd2';
                $mail->Password   = '1b8998dae4fle8';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 2525;

                $mail->setFrom('admin@sunflowerdental.com', 'Sunflower Dental');
                $mail->addAddress($email);

                $resetLink = "http://mitchiii.free.nf/reset-password.php?token=" . $token;
                
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password Akun Klinik Gigi';
                $mail->Body    = "Halo,<br><br>Kami menerima permintaan untuk mereset password akun Anda. Silakan klik link di bawah ini:<br><br><a href='{$resetLink}'>{$resetLink}</a><br><br>Link ini berlaku 1 jam.";

                $mail->send();
                $success = "Link reset password berhasil dikirim! Silakan cek inbox Mailtrap.";
            } catch (Exception $e) {
                $error = "Gagal mengirim email. Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Email tidak terdaftar di sistem kami!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Klinik Gigi</title>
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>
    <main class="login-page">
        <!-- Bagian Form -->
        <section class="login-form">
            <form action="" method="POST">
                <h1>Lupa Password</h1>
                <p class="subtitle">Masukkan email akun Anda untuk mereset password</p>

                <?php if (!empty($error)): ?>
                    <p style="color: red; font-size: 13px;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <p style="color: green; font-size: 13px;"><?= htmlspecialchars($success) ?></p>
                <?php endif; ?>

                <div class="field">
                    <input type="email" name="email" placeholder="Email Anda" required>
                </div>

                <button type="submit" id="submit-btn">Kirim Link Reset</button>
                <p class="signup"><a href="login.php">Kembali ke Login</a></p>
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