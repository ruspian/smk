<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";

$module = $_GET['module'];
$act = $_GET['act'];

// Hapus agenda
if ($module == 'agenda' && $act == 'hapus') {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "DELETE FROM agenda WHERE id_agenda='$id'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    header("location:../../media.php?module=$module");
}

// Input agenda
elseif ($module == 'agenda' && $act == 'input') {
    $mulai = $_POST['thn_mulai'] . '-' . $_POST['bln_mulai'] . '-' . $_POST['tgl_mulai'];
    $selesai = $_POST['thn_selesai'] . '-' . $_POST['bln_selesai'] . '-' . $_POST['tgl_selesai'];
    $tema_seo = seo_title($_POST['tema']);
    
    $query = "INSERT INTO agenda (tema, tema_seo, isi_agenda, tempat, tgl_mulai, tgl_selesai, tgl_posting, pengirim, username) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['tema'], $tema_seo, $_POST['isi_agenda'], $_POST['tempat'], $mulai, $selesai, $tgl_sekarang, $_POST['pengirim'], $_SESSION['namauser']);
    mysqli_stmt_execute($stmt);
    
    header("location:../../media.php?module=$module");
}

// Update agenda
elseif ($module == 'agenda' && $act == 'update') {
    $id_agenda = $_POST['id_agenda']; // Pastikan id_agenda diterima
    $mulai = $_POST['thn_mulai'] . '-' . $_POST['bln_mulai'] . '-' . $_POST['tgl_mulai'];
    $selesai = $_POST['thn_selesai'] . '-' . $_POST['bln_selesai'] . '-' . $_POST['tgl_selesai'];
    $tema_seo = seo_title($_POST['tema']);
    
    // Periksa apakah data agenda ada
    $query = "SELECT * FROM agenda WHERE id_agenda = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_agenda);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        // Update data agenda
        $query_update = "UPDATE agenda SET tema=?, tema_seo=?, isi_agenda=?, tgl_mulai=?, tgl_selesai=?, tempat=?, pengirim=? WHERE id_agenda=?";
        $stmt_update = mysqli_prepare($conn, $query_update);
        mysqli_stmt_bind_param($stmt_update, "sssssssi", $_POST['tema'], $tema_seo, $_POST['isi_agenda'], $mulai, $selesai, $_POST['tempat'], $_POST['pengirim'], $id_agenda);
        mysqli_stmt_execute($stmt_update);
        
        header("location:../../media.php?module=$module");
    } else {
        // Jika agenda tidak ditemukan
        echo "Agenda tidak ditemukan.";
    }
}
?>
