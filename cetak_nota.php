<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';

$id = $_GET['id'];
$query = "SELECT transaksi.*, pelanggan.nama as nama_pelanggan, pelanggan.telepon, pelanggan.alamat, layanan.nama_layanan, layanan.harga 
          FROM transaksi 
          JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
          JOIN layanan ON transaksi.layanan_id = layanan.id 
          WHERE transaksi.id='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Transaksi tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi #<?php echo $data['id']; ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 300px;
            margin: 20px auto;
            padding: 10px;
            border: 1px dashed #000;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; font-size: 13px; }
        td { padding: 3px 0; }
        .btn-print {
            display: block;
            width: 100%;
            padding: 8px;
            margin-top: 15px;
            background: #27ae60;
            color: #fff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }
        @media print {
            .btn-print { display: none; }
            body { border: none; margin: 0; }
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>LAUNDRY KILAT</h2>
        <p>Jl. Raya Utama No. 123</p>
        <p>Telp: 0812-3456-7890</p>
    </div>
    
    <div class="line"></div>
    
    <table>
        <tr>
            <td>No. Nota</td>
            <td>: #<?php echo sprintf("%04d", $data['id']); ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?php echo date('d/m/Y H:i', strtotime($data['tanggal'])); ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>: <?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: <?php echo htmlspecialchars($data['telepon']); ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>: <strong><?php echo strtoupper($data['status']); ?></strong></td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <th align="left">Layanan</th>
            <th align="right">Subtotal</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($data['nama_layanan']); ?><br>
                <small><?php echo $data['berat']; ?> kg x Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></small>
            </td>
            <td align="right" valign="bottom">Rp <?php echo number_format($data['total_harga'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td><strong>TOTAL BAYAR</strong></td>
            <td align="right"><strong>Rp <?php echo number_format($data['total_harga'], 0, ',', '.'); ?></strong></td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="text-center">
        <p>Terima Kasih Atas Kepercayaan Anda!</p>
        <p><small>Barang yang tidak diambil dalam 30 hari di luar tanggung jawab kami.</small></p>
    </div>

    <button onclick="window.print()" class="btn-print">Cetak Nota</button>
</body>
</html>