<?php
session_start();
include "../../../config/koneksi.php";

$module = $_GET['module'] ?? '';
$act    = $_GET['act'] ?? '';

// Hapus modul
if ($module === 'modul' && $act === 'hapus') {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    mysqli_query($conn, "DELETE FROM modul WHERE id_modul = '$id'");
    header('Location: ../../media.php?module=' . $module);
    exit;
}

// Input modul
elseif ($module === 'modul' && $act === 'input') {
    $nama_modul = mysqli_real_escape_string($conn, $_POST['nama_modul'] ?? '');
    $link       = mysqli_real_escape_string($conn, $_POST['link'] ?? '');
    $publish    = mysqli_real_escape_string($conn, $_POST['publish'] ?? 'Y');
    $aktif      = mysqli_real_escape_string($conn, $_POST['aktif'] ?? 'Y');
    $status     = mysqli_real_escape_string($conn, $_POST['status'] ?? 'user');

    // Cari urutan terakhir
    $u = mysqli_query($conn, "SELECT urutan FROM modul ORDER BY urutan DESC LIMIT 1");
    $d = mysqli_fetch_array($u);
    $urutan = ($d) ? $d['urutan'] + 1 : 1;

    $query = mysqli_query($conn, "INSERT INTO modul (nama_modul, link, publish, aktif, status, urutan) 
                VALUES ('$nama_modul', '$link', '$publish', '$aktif', '$status', '$urutan')");

    if (!$query) {
        die("Gagal menambahkan modul: " . mysqli_error($conn));
    }

    header('Location: ../../media.php?module=' . $module);
    exit;
}

// Update modul
elseif ($module === 'modul' && $act === 'update') {
    $id         = mysqli_real_escape_string($conn, $_POST['id'] ?? '');
    $nama_modul = mysqli_real_escape_string($conn, $_POST['nama_modul'] ?? '');
    $link       = mysqli_real_escape_string($conn, $_POST['link'] ?? '');
    $publish    = mysqli_real_escape_string($conn, $_POST['publish'] ?? 'Y');
    $aktif      = mysqli_real_escape_string($conn, $_POST['aktif'] ?? 'Y');
    $status     = mysqli_real_escape_string($conn, $_POST['status'] ?? 'user');
    $urutan     = mysqli_real_escape_string($conn, $_POST['urutan'] ?? '1');

    $query = mysqli_query($conn, "UPDATE modul SET 
                    nama_modul = '$nama_modul',
                    link       = '$link',
                    publish    = '$publish',
                    aktif      = '$aktif',
                    status     = '$status',
                    urutan     = '$urutan'  
                WHERE id_modul = '$id'");

    if (!$query) {
        die("Gagal mengupdate modul: " . mysqli_error($conn));
    }

    header('Location: ../../media.php?module=' . $module);
    exit;
}
?>
