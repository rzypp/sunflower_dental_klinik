<?php
// Kode PHP atau kosongkan dulu gak apa-apa
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sunflower Dental - Perawatan Gigi Berkualitas</title>
  <link rel="stylesheet" href="/assets/css/style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar">
    <div class="container">
      <a href="index.php" class="logo">Sunflower Dental Klinik</a>
      <nav class="nav-links">
        <a href="#layanan">Layanan</a>
        <a href="#dokter">Jadwal Dokter</a>
        <a href="#faq">Tentang</a>
        <a href="login.php" class="login">Login</a>
      </nav>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <h1>Perawatan Gigi Berkualitas</h1>
      <p>Dapatkan perawatan gigi yang nyaman, steril, dan sesuai kebutuhan Anda.
         Lihat jadwal dokter, pilih layanan, dan buat janji temu dengan mudah.</p>
      <a href="buat-janji.php" class="btn btn-primary">Buat Janji Temu</a>

      <div class="hero-image">
        <img src="/assets/img/hero_image.png" alt="Resepsionis klinik dan dokter menyambut pasien" />
      </div>
    </div>
  </section>

  <!-- LAYANAN UTAMA -->
  <section class="section" id="layanan">
    <div class="container">
      <h2 class="section-title">Layanan Utama</h2>
      <div class="services-grid">
        <article class="service-card">
          <i data-lucide="stethoscope" class="icon"></i>
          <h3>Pemeriksaan Rutin</h3>
          <p>Pemeriksaan gigi menyeluruh, membersihkan plak, dan skrining kesehatan mulut untuk menjaga gigi tetap sehat.</p>
        </article>
        <article class="service-card">
          <i data-lucide="briefcase-medical" class="icon"></i>
          <h3>Perawatan Gigi Berlubang</h3>
          <p>Pengisian gigi berlubang dengan bahan aman dan tampilan alami untuk mengembalikan fungsi kunyah secara optimal.</p>
        </article>
        <article class="service-card">
          <i data-lucide="shield" class="icon"></i>
          <h3>Pembersihan Karang Gigi</h3>
          <p>Membersihkan karang gigi dan plak di bawah gusi untuk mencegah radang gusi dan menjaga napas segar.</p>
        </article>
        <article class="service-card">
          <i data-lucide="smile" class="icon"></i>
          <h3>Estetika Gigi</h3>
          <p>Pemutihan gigi, veneer, dan perawatan estetika lainnya untuk senyum lebih cerah dan percaya diri.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- DOKTER KAMI -->
  <section class="section" id="dokter" style="padding-top:0">
    <div class="container">
      <h2 class="doctors-title">Dokter Kami</h2>
      <div class="doctors-grid">
        <article class="doctor-card">
          <div class="photo"><img src="/assets/img/doctor_image_2.png" alt="drg. Rahayu Setia, Sp.KG" /></div>
          <div class="info">
            <h3>drg. Risma Kurniawati, Sp.KG</h3>
            <div class="label">Jadwal Praktik</div>
            <div class="schedule">Senin – Jumat, 08.00 – 17.00 WIB</div>
          </div>
        </article>
        <article class="doctor-card">
          <div class="photo"><img src="/assets/img/doctor_image.png" alt="drg. Sugeng Santoso, Sp.Ort" /></div>
          <div class="info">
            <h3>drg. Sugeng Santoso, Sp.Ort</h3>
            <div class="label">Jadwal Praktik</div>
            <div class="schedule">Selasa &amp; Kamis, 10.00 – 16.00 WIB</div>
          </div>
        </article>
        <article class="doctor-card">
          <div class="photo"><img src="/assets/img/doctor_image_3.png" alt="drg. Ayu Rahma, Sp.BM" /></div>
          <div class="info">
            <h3>drg. Ayu Rahma, Sp.BM</h3>
            <div class="label">Jadwal Praktik</div>
            <div class="schedule">Sabtu, 09.00 – 14.00 WIB</div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq" id="faq">
    <div class="container">
      <h2>FAQ Dokter Gigi</h2>
      <div class="faq-list">
        <div class="faq-item">
          <h3>Apa tugas utama dokter gigi?</h3>
          <p>Tugas utama dokter gigi di Klinik Gigi Sunflower Dental adalah memelihara dan memperbaiki kesehatan gigi dan mulut pasien. Ini termasuk diagnosis, pencegahan, dan perawatan masalah gigi dan gusi.</p>
        </div>
        <div class="faq-item">
          <h3>Bagaimana cara memilih dokter gigi yang tepat?</h3>
          <p>Memilih dokter gigi yang tepat melibatkan pengecekan kualifikasi, pengalaman, dan ulasan dari pasien lain. Di Klinik Gigi Sunflower Dental, dokter gigi yang berpengalaman dan bersertifikat siap memberikan perawatan terbaik untuk Anda.</p>
        </div>
        <div class="faq-item">
          <h3>Berapa sering sebaiknya kita mengunjungi dokter gigi?</h3>
          <p>Gejala seperti sakit gigi, gusi berdarah, sensitivitas gigi, atau perubahan warna gigi adalah indikasi untuk berkonsultasi dengan dokter gigi di Klinik Gigi Sunflower Dental.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <<section class="cta">
  <div class="container">
    <h2>Butuh Bantuan?</h2>
    <div class="actions">
      <!-- 
        1. WhatsApp Link: 
           Gunakan format https://wa.me/NOMOR_TELP_DENGAN_KODE_NEGARA (tanpa tanda + atau angka 0 di depan).
           Contoh untuk Indonesia: 6281234567890
           Parameter ?text=... opsional jika ingin menyisipkan pesan otomatis.
      -->
      <a href="https://wa.me/6287722094368?text=Halo,%20saya%20butuh%20bantuan" target="_blank" rel="noopener noreferrer" class="btn">
        Hubungi Kami
      </a>

      <!-- 
        2. Google Maps Link: 
           Gunakan URL Google Maps tempat/lokasi klinik/usaha kamu. 
           Atau bisa menggunakan URL pencarian otomatis seperti contoh di bawah.
      -->
      <a href="https://www.google.com/maps/place/kerajaan+zefanya/@-6.3728573,106.8657834,20.5z/data=!4m14!1m7!3m6!1s0x2e69ed002160da5b:0x635ab437d6b4baae!2skerajaan+zefanya!8m2!3d-6.3731214!4d106.8657896!16s%2Fg%2F11yzxtxcsd!3m5!1s0x2e69ed002160da5b:0x635ab437d6b4baae!8m2!3d-6.3731214!4d106.8657896!16s%2Fg%2F11yzxtxcsd?hl=en&entry=ttu&g_ep=EgoyMDI2MTAxOS4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer" class="btn">
        Lihat Lokasi
      </a>
    </div>
  </div>
</section>

  <script>lucide.createIcons();</script>
</body>
</html>
