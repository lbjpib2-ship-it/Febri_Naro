
<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: create.php");
    exit;
}

$pesan = "";

if (isset($_POST['tambah_produk'])) {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = mysqli_prepare($db,
        "INSERT INTO produk (NamaProduk, Harga, Stok)
         VALUES (?, ?, ?)"
    );

    if ($query) {
        mysqli_stmt_bind_param($query, "sii", $nama, $harga, $stok);

        if (mysqli_stmt_execute($query)) {
            header("Location: produk.php");
            exit;
        } else {
            $pesan = "Gagal menambah produk: " . mysqli_stmt_error($query);
        }
    } else {
        $pesan = "Query error: " . mysqli_error($db);
    }
}

$produk = mysqli_query($db, "SELECT * FROM produk");

if (!$produk) {
    die("Database error: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Data Produk</h2>

<h3>Tambah Produk</h3>

<?php if ($pesan != "") { ?>
    <p style="color:red;">
        <?= htmlspecialchars($pesan); ?>
    </p>
<?php } ?>

<form method="POST">

    <input type="text" name="nama"
        placeholder="Nama Produk" required>

    <input type="number" name="harga"
        placeholder="Harga" min="0" required>

    <input type="number" name="stok"
        placeholder="Stok" min="0" required>

    <button type="submit" name="tambah_produk">
        Tambah Produk
    </button>

</form>

<h3>Daftar Produk</h3>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($produk)) { ?>
    <tr>
        <td><?= $row['ProdukID']; ?></td>
        <td><?= htmlspecialchars($row['NamaProduk']); ?></td>
        <td>Rp <?= number_format($row['Harga']); ?></td>
        <td><?= $row['Stok']; ?></td>
        <td>
            <a href="update.php?id=<?= $row['ProdukID']; ?>">Edit</a>
            |
            <a href="hapus.php?id=<?= $row['ProdukID']; ?>"
               onclick="return confirm('Yakin ingin menghapus produk?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="javascript:history.back()">Kembali</a>

</body>
</html>
