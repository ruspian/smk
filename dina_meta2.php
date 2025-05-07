<?php
// Pastikan koneksi database ($conn) sudah dibuat sebelum kode ini dijalankan.
// Contoh (sesuaikan dengan file koneksi Anda):
include "./config/koneksi.php";

if (isset($_GET['id'])) {
    // Amankan data dari URL untuk mencegah SQL injection
    $id_berita = mysqli_real_escape_string($conn, $_GET['id']);

    // Buat query SQL menggunakan prepared statement (lebih aman)
    $stmt = mysqli_prepare($conn, "SELECT tag FROM berita WHERE id_berita = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id_berita);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $j = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($j && isset($j['tag'])) {
            echo htmlspecialchars($j['tag'], ENT_QUOTES, 'UTF-8'); // Outputkan tag dengan aman
        } else {
            echo "Tag tidak ditemukan.";
        }
    } else {
        // Tangani kesalahan prepared statement
        echo "Terjadi kesalahan database: " . mysqli_error($conn);
        error_log("Error preparing statement: " . mysqli_error($conn));
    }
} else {
    // Outputkan daftar tag default dengan format yang lebih baik (misalnya, dipisahkan koma)
    $default_tags = "lokomedia, bukulokomedia, toko online, buku komputer, trik, tutorial, konsultasi, distro kaos, php";
    echo htmlspecialchars($default_tags, ENT_QUOTES, 'UTF-8');
}
?>