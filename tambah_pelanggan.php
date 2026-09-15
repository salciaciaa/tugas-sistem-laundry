<?php
include 'config.php';
include 'includes/header.php';

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $query = "INSERT INTO pelanggan (nama, telepon, alamat) VALUES ('$nama', '$telepon', '$alamat')";
    if (mysqli_query($conn, $query)) {
        header("Location: pelanggan.php");
        exit;
    }
}
?>

<h2>Tambah Pelanggan Baru</h2>

<form action="" method="POST" class="form-container">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="telepon" required>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" rows="4" required></textarea>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="pelanggan.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'includes/footer.php'; ?>