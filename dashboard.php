<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'] ?? 'User';
$user_id  = $_SESSION['user_id'];

// Ambil data booking dari database berdasarkan user yang sedang login
// Catatan: Jika kolom relasi user di tabel booking bernama 'user_id', biarkan seperti di bawah.
$query = "SELECT * FROM booking WHERE user_id = ? ORDER BY tanggal DESC";
$stmt  = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Sunflower Dental Klinik!</title>
    <link rel="stylesheet" href="/assets//css/dashboard.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- SIDEBAR -->
    <!-- sidebar.php -->
<aside class="sidebar">
    <h4 class="sidebar_username">Halo, <?= htmlspecialchars($username ?? 'User') ?></h4>
    <p class="sidebar_title">Menu Utama</p>
    <div class="sidebar_items">
        <a href="index.php"><img src="/icon/house.svg" alt="">Beranda</a>
        <a href="buat-janji.php"><img src="/icon/calendar-check.svg" alt="">Buat janji</a>
        <a href="history.php"><img src="/icon/history.svg" alt="">History</a>
        <a href="index.php#dokter"><img src="/icon/user-round-plus.svg" alt="">Dokter kami</a>
        <a href="index.php#layanan"><img src="/icon/layout-grid.svg" alt="">Layanan</a>
    </div>
</aside>
    <div class="main-wrapper">
        <nav>
            <div class="nav-title">
                <h2 class="welcome_title">Selamat datang di Sunflower Dental Klinik</h2>
                <p>Senyum sehat dimulai dari perawatan yang tepat</p>
            </div>
            <div class="nav-logout">
                <a href="index.php"><img src="/assets/icon/door_exit_icon.svg" alt="">Logout</a>
            </div>
        </nav>
        <hr>
        <div class="appointment-section">
            <div class="appointment-header">
                <h3>History Janji Temu</h3>
            </div>

            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="appointment-card" style="margin-bottom: 20px;">
                        <div class="card-top">
                            <div class="info-group">
                                <span class="label">LAYANAN</span>
                                <strong><?= htmlspecialchars($row['layanan']) ?></strong>
                            </div>
                            <div class="info-group">
                                <span class="label">DOKTER ID</span>
                                <strong><?= htmlspecialchars($row['dokter_id']) ?></strong>
                            </div>
                            <div class="info-group">
                                <span class="label">TANGGAL & WAKTU</span>
                                <strong><?= htmlspecialchars($row['tanggal']) ?> | <?= htmlspecialchars($row['sesi_jam']) ?></strong>
                            </div>
                        </div>

                        <div class="card-bottom">
                            <div class="patient-grid">
                                <div class="info-group">
                                    <span class="label">NAMA LENGKAP</span>
                                    <p><?= htmlspecialchars($row['nama_pasien']) ?></p>
                                </div>
                                <div class="info-group">
                                    <span class="label">TANGGAL LAHIR</span>
                                    <p><?= htmlspecialchars($row['tanggal_lahir']) ?></p>
                                </div>
                                <div class="info-group">
                                    <span class="label">NO. HANDPHONE</span>
                                    <p><?= htmlspecialchars($row['no_wa']) ?></p>
                                </div>
                                <div class="info-group">
                                    <span class="label">EMAIL</span>
                                    <p><?= htmlspecialchars($row['email'] ?? '-') ?></p>
                                </div>
                                <div class="info-group">
                                    <span class="label">STATUS</span>
                                    <p><?= htmlspecialchars($row['status']) ?></p>
                                </div>
                                <div class="info-group full-width">
                                    <span class="label">CATATAN / KELUHAN</span>
                                    <p><?= htmlspecialchars($row['keluhan']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align: center; color: #777; margin-top: 30px;">Belum ada riwayat janji temu.</p>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>