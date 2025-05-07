<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'];
$act = $_GET['act'];

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

// Input album
if ($module == 'album' && $act == 'input') {
    $jdl_album = mysqli_real_escape_string($conn, $_POST['jdl_album']);
    $album_seo = seo_title($jdl_album);

    // Cek jika ada file yang diupload
    if (!empty($_FILES['fupload']['name'])) {
        $file = $_FILES['fupload'];
        $validasi = validasiFile($file);
        
        if ($validasi !== true) {
            die("<script>alert('$validasi'); window.history.back();</script>");
        }

        // Buat nama file unik
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_file_unik = uniqid() . '.' . $ext;

        if (UploadAlbum($nama_file_unik)) {
            $stmt = $conn->prepare("INSERT INTO album (jdl_album, album_seo, gbr_album) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $jdl_album, $album_seo, $nama_file_unik);
        } else {
            die("<script>alert('Gagal mengunggah gambar'); window.history.back();</script>");
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO album (jdl_album, album_seo) VALUES (?, ?)");
        $stmt->bind_param("ss", $jdl_album, $album_seo);
    }

    if ($stmt->execute()) {
        header('location:../../media.php?module=' . $module);
    } else {
        die("<script>alert('Gagal menyimpan data'); window.history.back();</script>");
    }
}

// Update album
elseif ($module == 'album' && $act == 'update') {
    $id_album = intval($_POST['id']);
    $jdl_album = mysqli_real_escape_string($conn, $_POST['jdl_album']);
    $album_seo = seo_title($jdl_album);

    // Jika ada file yang diupload
    if (!empty($_FILES['fupload']['name'])) {
        $file = $_FILES['fupload'];
        $validasi = validasiFile($file);
        
        if ($validasi !== true) {
            die("<script>alert('$validasi'); window.history.back();</script>");
        }

        // Buat nama file unik
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nama_file_unik = uniqid() . '.' . $ext;

        if (UploadAlbum($nama_file_unik)) {
            $stmt = $conn->prepare("UPDATE album SET jdl_album = ?, album_seo = ?, gbr_album = ? WHERE id_album = ?");
            $stmt->bind_param("sssi", $jdl_album, $album_seo, $nama_file_unik, $id_album);
        } else {
            die("<script>alert('Gagal mengunggah gambar'); window.history.back();</script>");
        }
    } else {
        $stmt = $conn->prepare("UPDATE album SET jdl_album = ?, album_seo = ? WHERE id_album = ?");
        $stmt->bind_param("ssi", $jdl_album, $album_seo, $id_album);
    }

    if ($stmt->execute()) {
        header('location:../../media.php?module=' . $module);
    } else {
        die("<script>alert('Gagal mengupdate data'); window.history.back();</script>");
    }
}
?>
