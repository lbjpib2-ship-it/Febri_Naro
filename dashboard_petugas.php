<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'petugas') {
    header("Location: ../login.php");
    exit;
}

$produk = mysqli_query($db, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Petugas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>PETUGAS</h2>
    <a href="produk.php">Data Produk</a>
    <a href="stok.php">Stok Barang</a>
    <a href="pembelian.php">Pembelian</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Dashboard Petugas</h2>
    <p>Selamat datang, <?= htmlspecialchars($_SESSION['user']['username']); ?></p>

    <h3>Data Produk</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
        <tr>
            <td><?= $row['ProdukID']; ?></td>
            <td><?= htmlspecialchars($row['NamaProduk']); ?></td>
            <td>Rp <?= number_format($row['Harga']); ?></td>
            <td><?= $row['Stok']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
