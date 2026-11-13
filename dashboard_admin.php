<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'administrator') {
    header("Location: ../login.php");
    exit;
}

$produk = mysqli_query($db, "SELECT * FROM produk ORDER BY ProdukID DESC");

if (!$produk) {
    die("Error: " . mysqli_error($db));
}
$penjualan = mysqli_query($db, "SELECT * FROM penjualan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>ADMIN KASIR</h2>
    <a href="produk.php">Data Produk</a>
    <a href="penjualan.php">Penjualan</a>
    <a href="regristasi.php">Registrasi Petugas</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <?= htmlspecialchars($_SESSION['user']['username']); ?></p>

    <h3>Data Produk</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>

       <?php if (mysqli_num_rows($produk) > 0) { ?>

    <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
    <tr>
        <td><?= $row['ProdukID']; ?></td>
        <td><?= htmlspecialchars($row['NamaProduk']); ?></td>
        <td>Rp <?= number_format($row['Harga']); ?></td>
        <td><?= $row['Stok']; ?></td>
    </tr>
    <?php } ?>

<?php } else { ?>

    <tr>
        <td colspan="4">Belum ada produk.</td>
    </tr>

<?php } ?>
    </table>

    <h3>Data Penjualan</h3>
    <table>
        <tr>
            <th>ID Penjualan</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($penjualan)) { ?>
        <tr>
            <td><?= $row['PenjualanID']; ?></td>
            <td><?= $row['TanggalPenjualan']; ?></td>
            <td>Rp <?= number_format($row['TotalHarga']); ?></td>
        </tr>
        <?php } ?>
        
    </table>
</div>

</body>
</html>
