<?php
$host = "localhost";
$user = "root";
$pass = "";          // sesuaikan password database
$db   = "healthyLife";

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
