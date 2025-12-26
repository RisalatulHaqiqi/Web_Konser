<?php
include 'db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']); // bisa NIK (pembeli) atau username (admin)
    $password = $_POST['password'];

    // Cek admin
    $admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    if ($row = mysqli_fetch_assoc($admin)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = ['role' => 'admin', 'data' => $row];
            header('Location: admin_dashboard.php'); // atau index.php
            exit;
        }
    }

    // Cek pembeli
    $pembeli = mysqli_query($conn, "SELECT * FROM pembeli WHERE NIK = '$username'");
    if ($row = mysqli_fetch_assoc($pembeli)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = ['role' => 'pembeli', 'data' => $row];
            header('Location: index.php');
            exit;
        }
    }

    $error = "Username/NIK atau password salah!";
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
    <?php if(isset($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Masuk</button>
      <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar sebagai Pembeli</a></p>
    </form>
  </div>
</body>
</html>
