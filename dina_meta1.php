<?php
// Pastikan koneksi database ($conn) sudah dibuat sebelum kode ini dijalankan.
// Contoh (sesuaikan dengan file koneksi Anda):
include "./config/koneksi.php";

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    // Amankan data yang diterima dari URL untuk mencegah SQL injection
    $id_berita = mysqli_real_escape_string($conn, $_GET['id']);

    // Buat query SQL menggunakan data yang sudah diamankan
    $sql = mysqli_query($conn, "SELECT judul FROM berita WHERE id_berita = '$id_berita'");

    // Periksa apakah query berhasil dijalankan
    if ($sql) {
        // Ambil hasil query
        $j = mysqli_fetch_array($sql);

        // Periksa apakah ada data yang ditemukan
        if ($j) {
            echo htmlspecialchars($j['judul'], ENT_QUOTES, 'UTF-8'); // Outputkan judul dengan aman
        } else {
            echo "Berita tidak ditemukan.";
        }
    } else {
        // Tangani kesalahan query
        echo "Terjadi kesalahan database: " . mysqli_error($conn);
        // Anda mungkin ingin mencatat error ini untuk debugging lebih lanjut
        error_log("Error fetching berita: " . mysqli_error($conn));
    }
} else {
    echo "Lokomedia adalah penerbit buku-buku komputer khususnya di bidang pemrograman web dan internet.";
}
?>
