<?php
include 'config.php';
include 'includes/header.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id'"));

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $update_query = "UPDATE pelanggan SET nama='$nama', telepon='$telepon', alamat='$alamat' WHERE id='$id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: pelanggan.php");
        exit;
    }
}
?>

<h2>Edit Data Pelanggan</h2>

<form action="" method="POST" class="form-container">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="telepon" value="<?php echo htmlspecialchars($data['telepon']); ?>" required>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" rows="4" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="pelanggan.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'includes/footer.php'; ?>