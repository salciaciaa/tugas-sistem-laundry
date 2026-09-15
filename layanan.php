<?php
include 'config.php';
include 'includes/header.php';

$result = mysqli_query($conn, "SELECT * FROM layanan ORDER BY id DESC");
?>

<div class="header-action">
    <h2>Data Layanan</h2>
    <a href="tambah_layanan.php" class="btn btn-primary">+ Tambah Layanan</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Harga / kg</th>
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
            <td><?php echo htmlspecialchars($row['nama_layanan']); ?></td>
            <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>
                <a href="edit_layanan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                <a href="hapus_layanan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Yakin hapus layanan ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>