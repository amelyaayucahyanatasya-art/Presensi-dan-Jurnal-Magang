<?php
// config.php

$host = "127.0.0.1"; // bisa juga "localhost"
$user = "root";
$pass = ""; // kosong kalau default XAMPP
$db   = "presensi_magang";

// Coba koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
