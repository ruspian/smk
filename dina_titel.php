<?php
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); // Mencegah SQL Injection
    $sql = mysqli_query($conn, "SELECT judul FROM berita WHERE id_berita='$id'");
    $j   = mysqli_fetch_assoc($sql);

    if ($j) {
        echo htmlspecialchars($j['judul']); // Mencegah XSS
    } else {
        echo "Judul tidak ditemukan";
    }
} else {
    echo "bahrin.com - All rights reserved";
}
?>
