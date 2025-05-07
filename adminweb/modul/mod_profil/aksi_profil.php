<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// Update profil
if ($module == 'profil' && $act == 'update') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    $lokasi_file = $_FILES['fupload']['tmp_name'];
    $nama_file   = basename($_FILES['fupload']['name']);
    
    // Jika ada gambar yang diupload
    if (!empty($lokasi_file)) {
        $target_dir = "../../../foto_banner/";
        $target_file = $target_dir . $nama_file;
        
        // Validasi format gambar
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($lokasi_file, $target_file)) {
                UploadBanner($nama_file);
                $query = "UPDATE modul SET static_content = '$isi', gambar = '$nama_file' WHERE id_modul = '$id'";
            } else {
                echo "Gagal mengunggah gambar.";
                exit;
            }
        } else {
            echo "Format file tidak valid. Gunakan JPG, JPEG, PNG, atau GIF.";
            exit;
        }
    } else {
        $query = "UPDATE modul SET static_content = '$isi' WHERE id_modul = '$id'";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: ../../media.php?module=' . $module);
        exit;
    } else {
        echo "Gagal memperbarui profil: " . mysqli_error($conn);
    }
}
?>
