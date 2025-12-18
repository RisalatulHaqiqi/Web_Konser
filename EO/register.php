<?php
include 'db.php';
if (isset($_POST['register'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    $cek = mysqli_query($conn, "SELECT * FROM pembeli WHERE NIK='$nik'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "NIK sudah terdaftar!";
    } else {
        mysqli_query($conn, "INSERT INTO pembeli (NIK, Nama, Nomor_Telepon, Email) VALUES ('$nik','$nama','$telp','$email')");
        header('Location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - KonserKu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {background:#001f54;font-family:'Poppins',sans-serif;}
    .register-card {max-width:450px;margin:70px auto;padding:30px;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.1);}
    .btn-primary {background:#001f54;border:none;}
    .btn-primary:hover {background:#023b90;}
  </style>
</head>
<body>
  <div class="register-card">
    <h3 class="text-center text-primary fw-bold">Daftar Akun Baru</h3>
    <?php if(isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3"><label>NIK</label><input type="text" name="nik" class="form-control" required></div>
      <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
      <div class="mb-3"><label>Nomor Telepon</label><input type="text" name="telp" class="form-control" required></div>
      <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
      <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
    </form>
  </div>
</body>
</html>
