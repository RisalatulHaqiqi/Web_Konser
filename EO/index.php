<?php
include 'db.php';
$query = mysqli_query($conn, "SELECT * FROM konser ORDER BY Waktu DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KonserKu | Event Musik Indonesia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9faff;
      font-family: 'Poppins', sans-serif;
    }
    nav {
      background-color: #001f54;
      color: white;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 1.4rem;
      color: #fff !important;
    }
    .search-bar input {
      border-radius: 20px;
      padding-left: 15px;
      border: none;
      width: 300px;
    }
    .hero {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: white;
      padding: 50px 0;
      text-align: center;
    }
    .hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }
    .hero p {
      font-size: 1.1rem;
      opacity: 0.9;
    }
    .card {
      border: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border-radius: 12px;
      transition: transform 0.3s;
    }
    .card:hover {
      transform: scale(1.03);
    }
    .card img {
      border-radius: 12px 12px 0 0;
      height: 220px;
      object-fit: cover;
    }
    footer {
      background-color: #001f54;
      color: #dce3f0;
      padding: 40px 0;
      margin-top: 80px;
    }
    footer a {
      color: #dce3f0;
      text-decoration: none;
    }
    footer a:hover {
      color: #f7b731;
    }
  </style>
</head>
<body>

<!-- 🔹 NAVBAR -->
<nav class="navbar navbar-expand-lg">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="#">🎵 KonserKu</a>
    <form class="search-bar d-flex">
      <input type="text" class="form-control" placeholder="Cari konser seru di sini...">
    </form>
    <div>
      <a href="login.php" class="btn btn-outline-light me-2">Masuk</a>
      <a href="register.php" class="btn btn-warning text-dark">Daftar</a>
      <a href="eo/login_eo.php" class="btn btn-light me-2">Login EO</a>
    </div>
  </div>
</nav>

<!-- 🔹 HERO BANNER -->
<section class="hero">
  <div class="container">
    <h1>Tempatnya Event Musik Paling Seru 🎸</h1>
    <p>Temukan konser terbaru dari artis favoritmu dan rasakan pengalaman musik yang luar biasa!</p>
  </div>
</section>

<!-- 🔹 DAFTAR KONSER -->
<div class="container my-5">
  <h3 class="mb-4 fw-bold text-center text-primary">🎫 Konser Tersedia</h3>
  <div class="row g-4">
    <?php while($data = mysqli_fetch_array($query)): ?>
      <div class="col-md-3">
        <div class="card">
          <img src="uploads/<?php echo $data['Poster']; ?>" alt="<?php echo $data['Nama_Konser']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $data['Nama_Konser']; ?></h5>
            <p class="text-muted mb-1"><?php echo date("d M Y", strtotime($data['Waktu'])); ?></p>
            <p class="fw-bold text-primary">Rp<?php echo number_format($data['Harga']); ?></p>
            <a href="beli_tiket.php?id=<?php echo $data['ID_Konser']; ?>" class="btn btn-outline-primary w-100">Beli Tiket</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- 🔹 FOOTER -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h5 class="fw-bold">Tentang KonserKu</h5>
        <a href="#">Tentang Kami</a><br>
        <a href="#">Syarat & Ketentuan</a><br>
        <a href="#">Privasi</a>
      </div>
      <div class="col-md-3">
        <h5 class="fw-bold">Buat Event</h5>
        <a href="#">Daftar EO</a><br>
        <a href="#">Panduan EO</a>
      </div>
      <div class="col-md-3">
        <h5 class="fw-bold">Temukan Event</h5>
        <a href="#">Jakarta</a><br>
        <a href="#">Bandung</a><br>
        <a href="#">Surabaya</a>
      </div>
      <div class="col-md-3">
        <h5 class="fw-bold">Ikuti Kami</h5>
        <a href="#"><i class="bi bi-instagram"></i> Instagram</a><br>
        <a href="#"><i class="bi bi-youtube"></i> YouTube</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
