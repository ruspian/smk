<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";

// Escape input
function escape($data)
{
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// --- HAPUS BERITA ---
if ($module === 'berita' && $act === 'hapus') {
    $id_berita = escape($_GET['id']);
    $query = mysqli_query($conn, "DELETE FROM berita WHERE id_berita='$id_berita'");

    header('Location: ../../media.php?module=' . $module);
    exit();
}

// --- INPUT BERITA ---
elseif ($module === 'berita' && $act === 'input') {
    $judul = escape($_POST['judul']);
    $kategori = escape($_POST['kategori']);
    $username = escape($_SESSION['namauser']);
    $isi_berita = escape($_POST['isi_berita']);
    $judul_seo = seo_title($judul);
    $jam_sekarang = date("H:i:s");
    $tgl_sekarang = date("Y-m-d");
    $hari_ini = date("l");

    $tag_seo = $_POST['tag_seo'] ?? [];
    $tag = !empty($tag_seo) ? implode(',', array_map('escape', $tag_seo)) : '';

    $lokasi_file = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file = $_FILES['fupload']['name'] ?? '';
    $acak = rand(1, 99);
    $nama_file_unik = $acak . basename($nama_file);

    if (!empty($lokasi_file)) {
        if (function_exists('UploadImage')) {
            UploadImage($nama_file_unik);
        }
        $query = mysqli_query($conn, "INSERT INTO berita(judul, judul_seo, id_kategori, username, isi_berita, jam, tanggal, hari, tag, gambar)
                                      VALUES('$judul', '$judul_seo', '$kategori', '$username', '$isi_berita', '$jam_sekarang', '$tgl_sekarang', '$hari_ini', '$tag', '$nama_file_unik')");
    } else {
        $query = mysqli_query($conn, "INSERT INTO berita(judul, judul_seo, id_kategori, username, isi_berita, jam, tanggal, hari, tag)
                                      VALUES('$judul', '$judul_seo', '$kategori', '$username', '$isi_berita', '$jam_sekarang', '$tgl_sekarang', '$hari_ini', '$tag')");
    }

    if ($query && !empty($tag_seo)) {
        foreach ($tag_seo as $tag_item) {
            $safe_tag = escape($tag_item);
            mysqli_query($conn, "UPDATE tag SET count = count + 1 WHERE tag_seo = '$safe_tag'");
        }
    }

    header('Location: ../../media.php?module=' . $module);
    exit();
}

// --- UPDATE BERITA ---
elseif ($module === 'berita' && $act === 'update') {
    $id_berita = escape($_POST['id']);
    $judul = escape($_POST['judul']);
    $kategori = escape($_POST['kategori']);
    $isi_berita = escape($_POST['isi_berita']);
    $judul_seo = seo_title($judul);

    $tag_seo = $_POST['tag_seo'] ?? [];
    $tag = !empty($tag_seo) ? implode(',', array_map('escape', $tag_seo)) : '';

    $lokasi_file = $_FILES['fupload']['tmp_name'] ?? '';
    $nama_file = $_FILES['fupload']['name'] ?? '';
    $acak = rand(1, 99);
    $nama_file_unik = $acak . basename($nama_file);

    if (!empty($lokasi_file)) {
        if (function_exists('UploadImage')) {
            UploadImage($nama_file_unik);
        }
        $query = mysqli_query($conn, "UPDATE berita SET judul='$judul', judul_seo='$judul_seo', id_kategori='$kategori', tag='$tag', isi_berita='$isi_berita', gambar='$nama_file_unik' WHERE id_berita='$id_berita'");
    } else {
        $query = mysqli_query($conn, "UPDATE berita SET judul='$judul', judul_seo='$judul_seo', id_kategori='$kategori', tag='$tag', isi_berita='$isi_berita' WHERE id_berita='$id_berita'");
    }

    // Jika berhasil update, redirect ke halaman daftar berita
    if ($query) {
        header('Location: ../../media.php?module=' . $module);
        exit();
    } else {
        // Jika gagal, redirect kembali ke halaman edit dengan pesan error
        header('Location: ../../media.php?module=' . $module . '&act=editberita&id=' . $id_berita);
        exit();
    }
}

?>
