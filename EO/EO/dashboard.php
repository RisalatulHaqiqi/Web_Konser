<?php
include '../db.php';
session_start();
if (!isset($_SESSION['eo'])) {
    header('Location: login_eo.php');
    exit;
}
$query = mysqli_query($conn, "SELECT * FROM konser ORDER BY Waktu DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard EO - KonserKu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background:#001f54;
    font-family:'Poppins',sans-serif;
    color:white;
}
nav {
    background:#001f54;
    color:white;
    border-bottom:2px solid #ff69b4;
}
h4 {
    font-weight:600;
}
.table {
    background:rgba(255,105,180,0.9); /* pink transparan */
    border-radius:10px;
    overflow:hidden;
}
.table th {
    background-color:#ff85c1;
    color:white;
    text-align:center;
}
.table td {
    color:black;
    vertical-align:middle;
    text-align:center;
}
.btn-primary {
    background:#ff69b4;
    border:none;
    font-weight:500;
}
.btn-primary:hover {
    background:#ff85c1;
}
.btn-warning {
    background:#ffcc00;
    border:none;
    color:#001f54;
    font-weight:600;
}
.btn-danger {
    background:#ff4757;
    border:none;
}
.btn-outline-light:hover {
    background:white;
    color:#001f54;
}
.container h4 {
    color:white;
}
.shadow-box {
    background-color:rgba(255,255,255,0.1);
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 20px rgba(255,105,180,0.3);
}
</style>
</head>
<body>
<nav class="navbar navbar-dark px-4 d-flex justify-content-between align-items-center shadow-sm">
  <h4 class="text-white mb-0">🎵 Dashboard EO</h4>
  <a href="logout_eo.php" class="btn btn-outline-light btn-sm">Logout</a>
</nav>

<div class="container my-5">
  <div class="shadow-box">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Daftar Konser</h4>
      <a href="tambah_konser.php" class="btn btn-primary shadow-sm">+ Tambah Konser</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama Konser</th>
            <th>Waktu</th>
            <th>Tempat</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($query) > 0): ?>
            <?php while($k = mysqli_fetch_assoc($query)): ?>
              <tr>
                <td><?= htmlspecialchars($k['Nama_Konser']) ?></td>
                <td><?= htmlspecialchars($k['Waktu']) ?></td>
                <td><?= htmlspecialchars($k['Tempat']) ?></td>
                <td>Rp<?= number_format($k['Harga'], 0, ',', '.') ?></td>
                <td>
                  <a href="edit_konser.php?id=<?= $k['ID_Konser'] ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="hapus_konser.php?id=<?= $k['ID_Konser'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus konser ini?')">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="5" class="text-center text-light">Belum ada konser terdaftar</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
