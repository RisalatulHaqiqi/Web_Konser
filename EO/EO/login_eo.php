<?php
include '../db.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM eo_admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($cek);

    if ($data) {
        $_SESSION['eo'] = $data;
        header('Location: dashboard.php');
    } else {
        $error = "Login EO gagal! Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login EO - KonserKu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#001f54;font-family:'Poppins',sans-serif;}
.card{max-width:400px;margin:100px auto;padding:30px;background:white;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.1);}
.btn-primary{background:#001f54;border:none;}
.btn-primary:hover{background:#023b90;}
</style>
</head>
<body>
<div class="card">
  <h3 class="text-center text-primary fw-bold">Login EO</h3>
  <?php if(isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
    <p class="mt-3 text-center"><a href="../index.php">Kembali ke Beranda</a></p>
  </form>
</div>
</body>
</html>
