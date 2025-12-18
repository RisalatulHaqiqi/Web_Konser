<?php
include '../db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM konser WHERE ID_Konser='$id'");
header('Location: dashboard.php');
?>
