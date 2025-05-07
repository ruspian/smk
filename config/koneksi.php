<?php
$server = "localhost";
$username = "root";
$password = "Ruspian1998.";
$database = "db_berita";

// Koneksi ke database
$conn = mysqli_connect($server, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// echo "Koneksi berhasil!";
