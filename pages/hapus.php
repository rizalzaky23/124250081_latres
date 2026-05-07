<?php
require '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    $_SESSION['redirect_to'] = '/pages/hapus.php?id_asset=' . $_GET['id_asset'];
    header('Location: ../auth/login.php');
    exit;
}

$id = $_GET['id_asset'];

$query = "DELETE FROM assets WHERE id_asset = $id";
$result = mysqli_query($koneksi, $query);

if ($result) {
    header('Location: ../index.php');
} else {
    echo "Error: " . mysqli_error($koneksi);
}