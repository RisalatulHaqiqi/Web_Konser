<?php
include 'db.php';
session_start();

if (isset($_POST['login'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];

    $cek = mysqli_query($conn, "SELECT * FROM pembeli WHERE NIK='$nik' AND Nama='$nama'");
    $data = mysqli_fetch_assoc($cek);

    if ($data) {
        $_SESSION['user'] = $data;
        header('Location: index.php');
    } else {
        $error = "Login gagal! Data tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - KonserKu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {background:#001f54;font-family:'Poppins',sans-serif;}
    .login-card {max-width:400px;margin:100px auto;padding:30px;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.1);}
    .btn-primary {background:#001f54;border:none;}
    .btn-primary:hover {background:#023b90;}
  </style>
</head>
<body>
  <div class="login-card">
    <h3 class="text-center text-primary fw-bold">Masuk ke KonserKu</h3>
    <?php if(isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label>NIK</label>
        <input type="text" name="nik" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
      <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar</a></p>
    </form>
  </div>
</body>
</html>
