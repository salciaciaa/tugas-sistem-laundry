<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM layanan WHERE id='$id'");
header("Location: layanan.php");
exit;
?>