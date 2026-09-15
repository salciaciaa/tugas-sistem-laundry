<?php
include 'config.php';
include 'includes/header.php';

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$layanan = mysqli_query($conn, "SELECT * FROM layanan");

if (isset($_POST['simpan'])) {
    $pelanggan_id = $_POST['pelanggan_id'];
    $layanan_id = $_POST['layanan_id'];
    $berat = floatval($_POST['berat']);

    $get_harga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM layanan WHERE id='$layanan_id'"));
    $total_harga = $berat * $get_harga['harga'];

    $query = "INSERT INTO transaksi (pelanggan_id, layanan_id, berat, total_harga, status) 
              VALUES ('$pelanggan_id', '$layanan_id', '$berat', '$total_harga', 'Proses')";
    if (mysqli_query($conn, $query)) {
        header("Location: transaksi.php");
        exit;
    }
}
?>

<h2>Tambah Transaksi Laundry</h2>

<form action="" method="POST" class="form-container">
    <div class="form-group">
        <label>Pelanggan</label>
        <select name="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
                <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nama']); ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Layanan</label>
        <select name="layanan_id" required>
            <option value="">-- Pilih Layanan --</option>
            <?php while($l = mysqli_fetch_assoc($layanan)): ?>
                <option value="<?php echo $l['id']; ?>"><?php echo htmlspecialchars($l['nama_layanan']); ?> (Rp <?php echo number_format($l['harga'],0,',','.'); ?>/kg)</option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Berat (kg)</label>
        <input type="number" step="0.1" name="berat" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan Transaksi</button>
    <a href="transaksi.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'includes/footer.php'; ?>