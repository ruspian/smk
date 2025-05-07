<?php
include "../../../config/koneksi.php";

$module = isset($_GET['module']) ? $_GET['module'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hapus komentar
if ($module === 'komentar' && $act === 'hapus') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "DELETE FROM komentar WHERE id_komentar='$id'";
        mysqli_query($conn, $query);
    }
    header('location:../../media.php?module=' . $module);
    exit();
}

// Update komentar
elseif ($module === 'komentar' && $act === 'update') {
    if (isset($_POST['id'], $_POST['nama_komentar'], $_POST['url'], $_POST['isi_komentar'], $_POST['aktif'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $nama_komentar = mysqli_real_escape_string($conn, $_POST['nama_komentar']);
        $url = mysqli_real_escape_string($conn, $_POST['url']);
        $isi_komentar = mysqli_real_escape_string($conn, $_POST['isi_komentar']);
        $aktif = mysqli_real_escape_string($conn, $_POST['aktif']);
        
        $query = "UPDATE komentar SET nama_komentar='$nama_komentar', url='$url', isi_komentar='$isi_komentar', aktif='$aktif' WHERE id_komentar='$id'";
        mysqli_query($conn, $query);
    }
    header('location:../../media.php?module=' . $module);
    exit();
}
