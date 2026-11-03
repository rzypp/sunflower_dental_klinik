<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $layanan       = mysqli_real_escape_string($conn, $_POST['layanan'] ?? '');
    $dokter_id     = mysqli_real_escape_string($conn, $_POST['dokter'] ?? '');
    $nama          = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
    $wa            = mysqli_real_escape_string($conn, $_POST['wa'] ?? '');
    $email         = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $keluhan       = mysqli_real_escape_string($conn, $_POST['keluhan'] ?? '');
    
    // Konversi format tanggal lahir ke YYYY-MM-DD agar sesuai dengan database
    $raw_lahir     = $_POST['lahir'] ?? '';
    $tanggal_lahir = '';
    
    if (!empty($raw_lahir)) {
        // Cek jika format dari input adalah DD/MM/YYYY
        if (strpos($raw_lahir, '/') !== false) {
            $parts = explode('/', $raw_lahir);
            if (count($parts) === 3) {
                $tanggal_lahir = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            }
        } else {
            // Jika sudah format YYYY-MM-DD (dari input type="date")
            $tanggal_lahir = $raw_lahir;
        }
    }
    
    $tanggal_lahir = mysqli_real_escape_string($conn, $tanggal_lahir);
    
    // Query INSERT disesuaikan urutannya dengan kolom di database
    $query = "INSERT INTO booking (layanan, dokter_id, tanggal, sesi_jam, nama_pasien, no_wa, keluhan, status, tanggal_lahir, user_id, email) 
              VALUES ('$layanan', '$dokter_id', NOW(), '09:00 WIB', '$nama', '$wa', '$keluhan', 'Pending', '$tanggal_lahir', '$user_id', '$email')";
              
    if (mysqli_query($conn, $query)) {
        // Langsung diarahkan ke dashboard setelah berhasil
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "Gagal mengirim janji temu: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buat Janji Temu - Sunflower Dental</title>
  <link rel="stylesheet" href="/assets/css/form.css">
</head>
<body>
  <main class="wrap">
    <div class="crumb"><a href="dashboard.php">&#8592; Beranda</a> <span>&#8250;</span> <span>Buat Janji Temu</span></div>

    <?php if (!empty($pesan)) { echo "<script>alert('$pesan');</script>"; } ?>

    <div class="layout">
      <form class="form" action="" method="POST">
        <!-- 1. Layanan -->
        <section class="card">
          <h2><span class="num">1</span> Pilih layanan</h2>
          <div class="grid-2">
            <label class="opt"><input type="radio" name="layanan" value="Pemeriksaan Rutin" checked><span class="dot"></span><span><b>Pemeriksaan Rutin</b></span></label>
            <label class="opt"><input type="radio" name="layanan" value="Perawatan Gigi Berlubang"><span class="dot"></span><span><b>Perawatan Gigi Berlubang</b></span></label>
            <label class="opt"><input type="radio" name="layanan" value="Pembersihan Karang Gigi"><span class="dot"></span><span><b>Pembersihan Karang Gigi</b></span></label>
            <label class="opt"><input type="radio" name="layanan" value="Estetika Gigi"><span class="dot"></span><span><b>Estetika Gigi</b></span></label>
          </div>
        </section>

        <!-- 2. Dokter -->
        <section class="card">
          <h2><span class="num">2</span> Pilih dokter</h2>
          <div class="grid-3">
            <label class="doc"><input type="radio" name="dokter" value="1" checked><span class="radio"></span><b>drg. Risma Kurniawati</b></label>
            <label class="doc"><input type="radio" name="dokter" value="2"><span class="radio"></span><b>drg. Sugeng Santoso</b></label>
            <label class="doc"><input type="radio" name="dokter" value="3"><span class="radio"></span><b>drg. Ayu Rahma</b></label>
          </div>
        </section>

        <!-- 4. Data pasien -->
        <section class="card">
          <h2><span class="num">4</span> Lengkapi data pasien</h2>
          <div class="grid-2 fields">
            <div class="field"><label for="nama">Nama lengkap *</label><input id="nama" name="nama" type="text" required></div>
            <div class="field"><label for="lahir">Tanggal lahir *</label><input id="lahir" name="lahir" type="date" required></div>
            <div class="field"><label for="wa">Nomor WhatsApp *</label><input id="wa" name="wa" type="tel" required></div>
            <div class="field"><label for="email">Email *</label><input id="email" name="email" type="email" placeholder="example@email.com" required></div>
          </div>

          <div class="field">
            <label for="keluhan">Keluhan atau catatan (opsional)</label>
            <textarea id="keluhan" name="keluhan" rows="3"></textarea>
          </div>

          <button class="btn btn-slate" type="submit" style="margin-top: 20px; width: 100%;">Kirim Permintaan Janji Temu &rarr;</button>
        </section>
      </form>
    </div>
  </main>
</body>
</html>