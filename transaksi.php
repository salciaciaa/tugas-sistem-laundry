<?php
include 'config.php';
include 'includes/header.php';

// Proses Update Status
if (isset($_POST['update_status'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $status_baru = $_POST['status'];
    mysqli_query($conn, "UPDATE transaksi SET status='$status_baru' WHERE id='$transaksi_id'");
    header("Location: transaksi.php");
    exit;
}

$query = "SELECT transaksi.*, pelanggan.nama as nama_pelanggan, layanan.nama_layanan 
          FROM transaksi 
          JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
          JOIN layanan ON transaksi.layanan_id = layanan.id 
          ORDER BY transaksi.id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="header-action">
    <h2>Data Transaksi Laundry</h2>
    <a href="tambah_transaksi.php" class="btn btn-primary">+ Tambah Transaksi</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Layanan</th>
            <th>Berat (kg)</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)): 
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
            <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_layanan']); ?></td>
            <td><?php echo $row['berat']; ?> kg</td>
            <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
            <td>
                <form action="" method="POST" style="display:inline-block;">
                    <input type="hidden" name="transaksi_id" value="<?php echo $row['id']; ?>">
                    <select name="status" onchange="this.form.submit()" class="status-select status-<?php echo strtolower($row['status']); ?>">
                        <option value="Proses" <?php echo $row['status'] == 'Proses' ? 'selected' : ''; ?>>Proses</option>
                        <option value="Selesai" <?php echo $row['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                        <option value="Diambil" <?php echo $row['status'] == 'Diambil' ? 'selected' : ''; ?>>Diambil</option>
                    </select>
                    <input type="hidden" name="update_status" value="1">
                </form>
            </td>
            <td>
                <a href="cetak_nota.php?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-sm btn-print">Cetak Nota</a>
                <a href="hapus_transaksi.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>