<?php
session_start();
unset($_SESSION['eo']);
session_destroy();
header('Location: login_eo.php');
exit;
?>
