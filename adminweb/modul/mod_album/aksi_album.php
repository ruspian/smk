<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

// Fungsi Validasi File
function validasiFile($file) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (!in_array($file['type'], $allowed_types)) {
        return "Format file tidak diperbolehkan.";
    }
    if ($file['size'] > $max_size) {
        return "Ukuran file terlalu besar (maks 2MB).";
    }
    return true;
}

$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// Input album
if ($module === 'album' && $act === 'input') {
    $jdl_album = mysqli_real_escape_string($conn, $_POST['jdl_album']);
    $album_seo = seo_title($jdl_album);
    $nama_file_unik = null;

    // Jika ada file yang diupload
    if (!empty($_FILES['fupload']['name'])) {
        $file = $_FILES['fupload'];
        $validasi = validasiFile($file);

        if ($validasi !== true) {
            echo "<script>alert('$validasi'); window.history.back();</script>";
            exit();
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_file_unik = uniqid() . '.' . $ext;
        $lokasi_file = $file['tmp_name'];

        // Panggil fungsi untuk upload dan resize gambar
        UploadAlbum($nama_file_unik, $lokasi_file);
    }

    // Simpan ke database
    if ($nama_file_unik) {
        $stmt = $conn->prepare("INSERT INTO album (jdl_album, album_seo, gbr_album) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $jdl_album, $album_seo, $nama_file_unik);
    } else {
        $stmt = $conn->prepare("INSERT INTO album (jdl_album, album_seo) VALUES (?, ?)");
        $stmt->bind_param("ss", $jdl_album, $album_seo);
    }

    if ($stmt->execute()) {
        header("Location: ../../media.php?module=album");
        exit();
    } else {
        echo "<script>alert('Gagal menyimpan data: {$stmt->error}'); window.history.back();</script>";
    }
}

// Update album
elseif ($module === 'album' && $act === 'update') {
    $id_album = intval($_POST['id']);
    $jdl_album = mysqli_real_escape_string($conn, $_POST['jdl_album']);
    $album_seo = seo_title($jdl_album);
    $nama_file_unik = null;

    if (!empty($_FILES['fupload']['name'])) {
        $file = $_FILES['fupload'];
        $validasi = validasiFile($file);

        if ($validasi !== true) {
            echo "<script>alert('$validasi'); window.history.back();</script>";
            exit();
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_file_unik = uniqid() . '.' . $ext;
        $lokasi_file = $file['tmp_name'];

        UploadAlbum($nama_file_unik, $lokasi_file);

        $stmt = $conn->prepare("UPDATE album SET jdl_album = ?, album_seo = ?, gbr_album = ? WHERE id_album = ?");
        $stmt->bind_param("sssi", $jdl_album, $album_seo, $nama_file_unik, $id_album);
    } else {
        $stmt = $conn->prepare("UPDATE album SET jdl_album = ?, album_seo = ? WHERE id_album = ?");
        $stmt->bind_param("ssi", $jdl_album, $album_seo, $id_album);
    }

    if ($stmt->execute()) {
        header("Location: ../../media.php?module=album");
        exit();
    } else {
        echo "<script>alert('Gagal mengupdate data: {$stmt->error}'); window.history.back();</script>";
    }
}
?>
