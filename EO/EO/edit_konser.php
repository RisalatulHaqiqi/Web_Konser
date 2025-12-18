<?php
include '../db.php';
$id = $_GET['id'];
$konser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM konser WHERE ID_Konser='$id'"));

if(isset($_POST['update'])){
  $nama = $_POST['nama'];
  $waktu = $_POST['waktu'];
  $tempat = $_POST['tempat'];
  $harga = $_POST['harga'];

  if($_FILES['poster']['name']){
    $poster = $_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'], "../uploads/".$poster);
    mysqli_query($conn, "UPDATE konser SET Nama_Konser='$nama',Waktu='$waktu',Tempat='$tempat',Harga='$harga',Poster='$poster' WHERE ID_Konser='$id'");
  } else {
    mysqli_query($conn, "UPDATE konser SET Nama_Konser='$nama',Waktu='$waktu',Tempat='$tempat',Harga='$harga' WHERE ID_Konser='$id'");
  }
  header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Konser</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#001f54;font-family:'Poppins',sans-serif;}
.btn-primary{background:#001f54;border:none;}
</style>
</head>
<body>
<div class="container my-5">
<h3 class="fw-bold text-primary">Edit Konser</h3>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3"><label>Nama Konser</label><input type="text" name="nama" class="form-control" value="<?= $konser['Nama_Konser'] ?>"></div>
  <div class="mb-3"><label>Waktu</label><input type="date" name="waktu" class="form-control" value="<?= $konser['Waktu'] ?>"></div>
  <div class="mb-3"><label>Tempat</label><input type="text" name="tempat" class="form-control" value="<?= $konser['Tempat'] ?>"></div>
  <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" value="<?= $konser['Harga'] ?>"></div>
  <div class="mb-3"><label>Poster</label><input type="file" name="poster" class="form-control"></div>
  <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
</form>
</div>
</body>
</html>
