
<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($db, "UPDATE produk SET
        NamaProduk='$nama',
        Harga='$harga',
        Stok='$stok'
        WHERE ProdukID='$id'");

    header("Location: dashboard_admin.php");
    exit;
}

$data = mysqli_query($db, "SELECT * FROM produk WHERE ProdukID='$id'");
$row = mysqli_fetch_assoc($data);
?>

<h2>Edit Produk</h2>

<form method="POST">
    <input type="text" name="nama" value="<?= htmlspecialchars($row['NamaProduk']); ?>" required>
    <input type="number" name="harga" value="<?= $row['Harga']; ?>" required>
    <input type="number" name="stok" value="<?= $row['Stok']; ?>" required>

    <button name="simpan">Simpan</button>
</form>
