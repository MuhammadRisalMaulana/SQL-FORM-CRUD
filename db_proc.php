<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "crud_example";
// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $dbname);
// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
