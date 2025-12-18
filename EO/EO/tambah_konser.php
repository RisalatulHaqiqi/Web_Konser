<?php
include '../db.php';
session_start();
if (!isset($_SESSION['eo'])) {
    header('Location: login_eo.php');
    exit;
}

if (isset($_POST['simpan'])) {
    $id = uniqid('K');
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $tempat = $_POST['tempat'];
    $harga = $_POST['harga'];

    $poster = $_FILES['poster']['name'];
    $tmp = $_FILES['poster']['tmp_name'];
    $path = "../uploads/" . $poster;

    if (!file_exists("../uploads")) {
        mkdir("../uploads");
    }

    move_uploaded_file($tmp, $path);

    mysqli_query($conn, "INSERT INTO konser (ID_Konser, Nama_Konser, Waktu, Tempat, Harga, Poster)
                         VALUES ('$id','$nama','$waktu','$tempat','$harga','$poster')");
    echo "<script>alert('Konser berhasil ditambahkan!');window.location='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Konser - KonserKu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
  background:#001f54;
  font-family:'Poppins',sans-serif;
  color:white;
}
.container {
  max-width:700px;
  margin-top:60px;
}
.form-card {
  background:white;
  padding:40px;
  border-radius:15px;
  box-shadow:0 0 20px rgba(255,105,180,0.3);
  color:#ff69b4;
}
.form-card label {
  color:#ff69b4;
  font-weight:600;
}
.form-card input {
  border:2px solid #ff69b4;
  border-radius:8px;
}
.form-card input:focus {
  box-shadow:0 0 10px rgba(255,105,180,0.5);
  border-color:#ff85c1;
}
.btn-primary {
  background:#ff69b4;
  border:none;
  font-weight:600;
}
.btn-primary:hover {
  background:#ff85c1;
}
h3 {
  color:white;
  text-align:center;
  margin-bottom:30px;
  font-weight:600;
}
.back-link {
  color:white;
  text-decoration:none;
}
.back-link:hover {
  text-decoration:underline;
}
</style>
</head>
<body>
<div class="container">
  <h3>✨ Tambah Konser Baru ✨</h3>
  <div class="form-card">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Nama Konser</label>
        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama konser" required>
      </div>
      <div class="mb-3">
        <label>Waktu</label>
        <input type="date" name="waktu" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Tempat</label>
        <input type="text" name="tempat" class="form-control" placeholder="Lokasi konser" required>
      </div>
      <div class="mb-3">
        <label>Harga Tiket</label>
        <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000" required>
      </div>
      <div class="mb-3">
        <label>Poster Konser</label>
        <input type="file" name="poster" class="form-control" accept="image/*" required>
      </div>
      <div class="text-center mt-4">
        <button type="submit" name="simpan" class="btn btn-primary px-5 py-2">Simpan</button>
        <a href="dashboard.php" class="btn btn-light ms-2 px-4">Batal</a>
      </div>
    </form>
  </div>
  <div class="text-center mt-4">
    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
  </div>
</div>
</body>
</html>
