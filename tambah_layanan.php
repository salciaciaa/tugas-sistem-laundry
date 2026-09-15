<?php
include 'config.php';
include 'includes/header.php';

if (isset($_POST['simpan'])) {
    $nama_layanan = mysqli_real_escape_string($conn, $_POST['nama_layanan']);
    $harga = intval($_POST['harga']);

    $query = "INSERT INTO layanan (nama_layanan, harga) VALUES ('$nama_layanan', '$harga')";
    if (mysqli_query($conn, $query)) {
        header("Location: layanan.php");
        exit;
    }
}
?>

<h2>Tambah Layanan Baru</h2>

<form action="" method="POST" class="form-container">
    <div class="form-group">
        <label>Nama Layanan</label>
        <input type="text" name="nama_layanan" required>
    </div>
    <div class="form-group">
        <label>Harga per kg (Rp)</label>
        <input type="number" name="harga" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="layanan.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'includes/footer.php'; ?>