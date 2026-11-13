
<?php
include 'koneksi.php';

$id = $_GET['id'];

$hapus = mysqli_query($db,
    "DELETE FROM produk WHERE ProdukID='$id'"
);

if ($hapus) {
    header("Location: dashboard_admin.php");
    exit;
} else {
    echo "Produk gagal dihapus karena mungkin sudah memiliki transaksi!";
}
?>
