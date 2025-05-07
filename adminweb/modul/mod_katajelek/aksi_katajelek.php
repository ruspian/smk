<?php
include "../../../config/koneksi.php";

$module = isset($_GET['module']) ? $_GET['module'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hapus Kata Jelek
if ($module == 'katajelek' && $act == 'hapus' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "DELETE FROM katajelek WHERE id_jelek=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("location:../../media.php?module=" . $module);
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
}

// Input kata jelek
elseif ($module == 'katajelek' && $act == 'input' && isset($_POST['kata']) && isset($_POST['ganti'])) {
    $kata = mysqli_real_escape_string($conn, $_POST['kata']);
    $ganti = mysqli_real_escape_string($conn, $_POST['ganti']);

    $query = "INSERT INTO katajelek (kata, ganti) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $kata, $ganti);

    if (mysqli_stmt_execute($stmt)) {
        header("location:../../media.php?module=" . $module);
        exit();
    } else {
        echo "Gagal menambahkan data.";
    }
}

// Update kata jelek
elseif ($module == 'katajelek' && $act == 'update' && isset($_POST['id']) && isset($_POST['kata']) && isset($_POST['ganti'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $kata = mysqli_real_escape_string($conn, $_POST['kata']);
    $ganti = mysqli_real_escape_string($conn, $_POST['ganti']);

    $query = "UPDATE katajelek SET kata = ?, ganti = ? WHERE id_jelek = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $kata, $ganti, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("location:../../media.php?module=" . $module);
        exit();
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>
