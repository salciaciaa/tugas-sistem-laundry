<?php
include 'config.php';
include 'includes/header.php';

$tgl_mulai = $_GET['tgl_mulai'] ?? date('Y-m-01');
$tgl_selesai = $_GET['tgl_selesai'] ?? date('Y-m-t');

$query = "SELECT transaksi.*, pelanggan.nama as nama_pelanggan, layanan.nama_layanan 
          FROM transaksi 
          JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
          JOIN layanan ON transaksi.layanan_id = layanan.id 
          WHERE DATE(transaksi.tanggal) BETWEEN '$tgl_mulai' AND '$tgl_selesai'
          ORDER BY transaksi.id DESC";
$result = mysqli_query($conn, $query);
?>

<h2>Laporan Pendapatan Laundry</h2>

<form action="" method="GET" class="filter-form">
    <div class="form-group" style="margin:0;">
        <label>Tanggal Mulai:</label>
        <input type="date" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>">
    </div>
    <div class="form-group" style="margin:0;">
        <label>Tanggal Selesai:</label>
        <input type="date" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>">
    </div>
    <button type="submit" class="btn btn-primary" style="align-self: flex-end;">Filter</button>
    <button type="button" onclick="window.print()" class="btn btn-print" style="align-self: flex-end;">Cetak Laporan</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Layanan</th>
            <th>Berat (kg)</th>
            <th>Status</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        $total_semua = 0;
        while ($row = mysqli_fetch_assoc($result)): 
            $total_semua += $row['total_harga'];
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
            <td><?php echo htmlspecialchars($row['nama_pelanggan']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_layanan']); ?></td>
            <td><?php echo $row['berat']; ?> kg</td>
            <td><span class="badge badge-<?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span></td>
            <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="text-align:right;">Total Pendapatan:</th>
            <th>Rp <?php echo number_format($total_semua, 0, ',', '.'); ?></th>
        </tr>
    </tfoot>
</table>

<?php include 'includes/footer.php'; ?>