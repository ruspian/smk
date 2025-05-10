<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

// Cek apakah module dan act ada
$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// Daftar ekstensi file yang diperbolehkan
$allowed_extensions = ['pdf', 'doc', 'docx', 'docx', 'zip', 'rar', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'avi', 'mkv', 'mov', 'wmv', 'flv', 'webm'];

// Hapus download
if ($module == 'download' && $act == 'hapus') {
    $id = intval($_GET['id']);
    // Ambil nama file untuk dihapus
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_file FROM download WHERE id_download='$id'"));
    if (!empty($data['nama_file']) && file_exists("../../../files/" . $data['nama_file'])) {
        unlink("../../../files/" . $data['nama_file']);
    }
    $query = mysqli_query($conn, "DELETE FROM download WHERE id_download='$id'");
    header('Location: ../../media.php?module=' . $module);
}

// Input download
elseif ($module == 'download' && $act == 'input') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $tgl_posting = date('Y-m-d');
    $nama_file = $_FILES['fupload']['name'];
    $tmp_file = $_FILES['fupload']['tmp_name'];
    $tipe_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    $hits = 0; // Default hits

    if (!empty($tmp_file) && in_array($tipe_file, $allowed_extensions)) {
        UploadFile($nama_file);
        // Tidak perlu menyertakan id_download karena akan otomatis terisi
        $query = "INSERT INTO download(judul, nama_file, tgl_posting, hits) 
                  VALUES('$judul', '$nama_file', '$tgl_posting', '$hits')";
    } else {
        // Jika tidak ada file, tetap set hits ke 0
        $query = "INSERT INTO download(judul, tgl_posting, hits) 
                  VALUES('$judul', '$tgl_posting', '$hits')";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}

// Update download
elseif ($module == 'download' && $act == 'update') {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $nama_file = $_FILES['fupload']['name'];
    $tmp_file = $_FILES['fupload']['tmp_name'];
    $tipe_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    // Set default hits
    $hits = 0;

    if (!empty($tmp_file) && in_array($tipe_file, $allowed_extensions)) {
        // Hapus file lama
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama_file FROM download WHERE id_download='$id'"));
        if (!empty($data['nama_file']) && file_exists("../../../files/" . $data['nama_file'])) {
            unlink("../../../files/" . $data['nama_file']);
        }

        // Upload file baru
        UploadFile($nama_file);
        // Tidak perlu menyertakan id_download pada query update, karena id sudah diidentifikasi
        $query = "UPDATE download SET judul='$judul', nama_file='$nama_file', tgl_posting=NOW(), hits='$hits' WHERE id_download='$id'";
    } else {
        // Jika tidak ada file baru, tetap update hits
        $query = "UPDATE download SET judul='$judul', hits='$hits' WHERE id_download='$id'";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>
