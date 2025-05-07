<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module = isset($_GET['module']) ? $_GET['module'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Pastikan koneksi ke database tersedia
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Hapus Kategori
if ($module == 'kategori' && $act == 'hapus') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "DELETE FROM kategori WHERE id_kategori='$id'";
        if (mysqli_query($conn, $query)) {
            header('location:../../media.php?module=' . $module);
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "ID kategori tidak valid!";
    }
}

// Input kategori
elseif ($module == 'kategori' && $act == 'input') {
    if (!empty($_POST['nama_kategori'])) {
        $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
        $kategori_seo = seo_title($nama_kategori);

        $query = "INSERT INTO kategori(nama_kategori, kategori_seo) VALUES('$nama_kategori', '$kategori_seo')";
        if (mysqli_query($conn, $query)) {
            header('location:../../media.php?module=' . $module);
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Nama kategori tidak boleh kosong!";
    }
}

// Update kategori
elseif ($module == 'kategori' && $act == 'update') {
    if (!empty($_POST['nama_kategori']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
        $kategori_seo = seo_title($nama_kategori);

        $query = "UPDATE kategori SET nama_kategori = '$nama_kategori', kategori_seo='$kategori_seo' WHERE id_kategori = '$id'";
        if (mysqli_query($conn, $query)) {
            header('location:../../media.php?module=' . $module);
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Data tidak valid!";
    }
}
?>
