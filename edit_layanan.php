<?php
include 'config.php';
include 'includes/header.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM layanan WHERE id='$id'"));

if (isset($_POST['update'])) {
    $nama_layanan = mysqli_real_escape_string($conn, $_POST['nama_layanan']);
    $harga = intval($_POST['harga']);

    $update_query = "UPDATE layanan SET nama_layanan='$nama_layanan', harga='$harga' WHERE id='$id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: layanan.php");
        exit;
    }
}
?>

<h2>Edit Data Layanan</h2>

<form action="" method="POST" class="form-container">
    <div class="form-group">
        <label>Nama Layanan</label>
        <input type="text" name="nama_layanan" value="<?php echo htmlspecialchars($data['nama_layanan']); ?>" required>
    </div>
    <div class="form-group">
        <label>Harga per kg (Rp)</label>
        <input type="number" name="harga" value="<?php echo htmlspecialchars($data['harga']); ?>" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="layanan.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'includes/footer.php'; ?>