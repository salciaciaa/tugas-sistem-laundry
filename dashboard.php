<?php
include 'config.php';
include 'includes/header.php';

$total_pelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pelanggan"))['total'];
$total_layanan   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM layanan"))['total'];
$total_transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM transaksi"))['total'];
$total_pendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_harga) as total FROM transaksi"))['total'];
?>

<h1 class="page-title">Dashboard Utama</h1>

<div class="card-grid">
    <div class="card bg-blue">
        <h3>Total Pelanggan</h3>
        <p class="card-number"><?php echo $total_pelanggan; ?></p>
    </div>
    <div class="card bg-green">
        <h3>Total Layanan</h3>
        <p class="card-number"><?php echo $total_layanan; ?></p>
    </div>
    <div class="card bg-orange">
        <h3>Total Transaksi</h3>
        <p class="card-number"><?php echo $total_transaksi; ?></p>
    </div>
    <div class="card bg-purple">
        <h3>Total Pendapatan</h3>
        <p class="card-number">Rp <?php echo number_format($total_pendapatan ?? 0, 0, ',', '.'); ?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>