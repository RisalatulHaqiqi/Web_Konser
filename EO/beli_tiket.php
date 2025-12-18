<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM konser WHERE ID_Konser='$id'");
$konser = mysqli_fetch_assoc($query);

if (isset($_POST['beli'])) {
    $nik = $_SESSION['user']['NIK'];
    $id_konser = $konser['ID_Konser'];
    $harga = $konser['Harga'];
    $id_tiket = uniqid('TK');

    mysqli_query($conn, "INSERT INTO tiket (ID_Tiket, NIK, ID_Konser, Harga) VALUES ('$id_tiket', '$nik', '$id_konser', '$harga')");
    $success = "Tiket berhasil dibeli!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beli Tiket - <?= $konser['Nama_Konser'] ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#001f54;font-family:'Poppins',sans-serif;}
    .card{max-width:600px;margin:80px auto;padding:20px;border-radius:12px;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    .btn-primary{background:#001f54;border:none;}
  </style>
</head>
<body>
  <div class="card">
    <h3 class="fw-bold text-primary text-center">Beli Tiket Konser</h3>
    <img src="uploads/<?= $konser['Poster'] ?>" class="img-fluid rounded my-3">
    <h4><?= $konser['Nama_Konser'] ?></h4>
    <p><strong>Tanggal:</strong> <?= date("d M Y", strtotime($konser['Waktu'])) ?></p>
    <p><strong>Tempat:</strong> <?= $konser['Tempat'] ?></p>
    <p><strong>Harga:</strong> Rp<?= number_format($konser['Harga']) ?></p>
    <?php if(isset($success)): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
    <form method="post">
      <button type="submit" name="beli" class="btn btn-primary w-100">Beli Sekarang</button>
    </form>
  </div>
</body>
</html>
