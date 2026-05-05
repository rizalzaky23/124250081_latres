<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "latres_web_si-d";

$koneksi = new mysqli($host, $user, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

session_start();
?>