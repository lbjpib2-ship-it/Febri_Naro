<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'administrator') {
    header("Location:login.php");
    exit;
}

$data = mysqli_query($db, "SELECT * FROM usern");
?>

<h2>Data Petugas</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Username</th>
        <th>Role</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <?php if ($row['role'] == 'petugas') { ?>
    <tr>
        <td><?= htmlspecialchars($row['username']); ?></td>
        <td><?= htmlspecialchars($row['role']); ?></td>
    </tr>
    <?php } ?>
    <?php } ?>
</table>