<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

// Cek apakah module dan act ada
$module = isset($_GET['module']) ? $_GET['module'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hapus download
if ($module == 'download' && $act == 'hapus') {
    $id = intval($_GET['id']); // Pastikan ID adalah angka
    $query = mysqli_query($conn, "DELETE FROM download WHERE id_download='$id'");

    if ($query) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Gagal menghapus data.";
    }
}

// Input download
elseif ($module == 'download' && $act == 'input') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $tgl_posting = date('Y-m-d'); // Pastikan tanggal diambil dari sistem

    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file = $_FILES['fupload']['name'];
    $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
    $allowed_extensions = ['pdf', 'doc', 'docx', 'zip', 'rar'];

    // Cek apakah file memiliki ekstensi yang diperbolehkan
    if (!empty($lokasi_file) && in_array($tipe_file, $allowed_extensions)) {
        UploadFile($nama_file);
        $query = "INSERT INTO download(judul, nama_file, tgl_posting) 
                  VALUES('$judul', '$nama_file', '$tgl_posting')";
    } else {
        $query = "INSERT INTO download(judul, tgl_posting) 
                  VALUES('$judul', '$tgl_posting')";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Gagal menyimpan data.";
    }
}

// Update download
elseif ($module == 'download' && $act == 'update') {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);

    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file = $_FILES['fupload']['name'];
    $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
    $allowed_extensions = ['pdf', 'doc', 'docx', 'zip', 'rar'];

    // Jika file diunggah dan memiliki ekstensi yang diperbolehkan
    if (!empty($lokasi_file) && in_array($tipe_file, $allowed_extensions)) {
        UploadFile($nama_file);
        $query = "UPDATE download SET judul='$judul', nama_file='$nama_file' WHERE id_download='$id'";
    } else {
        $query = "UPDATE download SET judul='$judul' WHERE id_download='$id'";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>
