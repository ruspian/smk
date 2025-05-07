<?php
include "../config/koneksi.php";

echo "
<div class='list-group list-group-flush bg-light rounded shadow-sm'>
    <div class='list-group-item bg-primary text-white fw-bold'>
        <i class='bi bi-list'></i> Menu Navigasi
    </div>";

if ($_SESSION['leveluser'] == 'admin') {
    $sql = mysqli_query($conn, "SELECT * FROM modul WHERE aktif='Y' ORDER BY urutan");
} else {
    $sql = mysqli_query($conn, "SELECT * FROM modul WHERE status='user' AND aktif='Y' ORDER BY urutan");
}

while ($m = mysqli_fetch_assoc($sql)) {
    echo "
    <a href='$m[link]' class='list-group-item list-group-item-action d-flex align-items-center'>
        <i class='bi bi-chevron-right me-2'></i> $m[nama_modul]
    </a>";
}

echo "</div>";
?>

<!-- Bootstrap CSS -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css'>
<script src='https://kit.fontawesome.com/a0aa1a6901.js' crossorigin='anonymous'></script>
