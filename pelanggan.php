<?php
include 'config.php';
include 'includes/header.php';

$result = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id DESC");
?>

<div class="header-action">
    <h2>Data Pelanggan</h2>
    <a href="tambah_pelanggan.php" class="btn btn-primary">+ Tambah Pelanggan</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
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
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo htmlspecialchars($row['telepon']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td>
                <a href="edit_pelanggan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                <a href="hapus_pelanggan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>