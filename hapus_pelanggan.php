<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM pelanggan WHERE id='$id'");
header("Location: pelanggan.php");
exit;
?>