<?php
session_start();
include "../../../config/koneksi.php";

// Fungsi untuk mengubah nama tag jadi SEO-friendly
function seo_title($s) {
    $s = str_replace(' ', '-', $s);
    $s = preg_replace('/[^a-zA-Z0-9\-]/', '', $s);
    return strtolower($s);
}

// Tangkap nilai dari URL
$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// Proses tag
if ($module == 'tag') {
    // Tambah Tag
    if ($act == 'input' && isset($_POST['nama_tag'])) {
        $nama_tag = htmlspecialchars($_POST['nama_tag'], ENT_QUOTES);
        $tag_seo = seo_title($nama_tag);

        $stmt = $conn->prepare("INSERT INTO tag(nama_tag, tag_seo) VALUES(?, ?)");
        $stmt->bind_param("ss", $nama_tag, $tag_seo);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Tag berhasil ditambahkan!";
        header("Location: ../../media.php?module=tag");
        exit;
    }

    // Update Tag
    elseif ($act == 'update' && isset($_POST['id']) && isset($_POST['nama_tag'])) {
        $id = intval($_POST['id']);
        $nama_tag = htmlspecialchars($_POST['nama_tag'], ENT_QUOTES);
        $tag_seo = seo_title($nama_tag);

        $stmt = $conn->prepare("UPDATE tag SET nama_tag = ?, tag_seo = ? WHERE id_tag = ?");
        $stmt->bind_param("ssi", $nama_tag, $tag_seo, $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Tag berhasil diperbarui!";
        header("Location: ../../media.php?module=tag");
        exit;
    }

    // Hapus Tag
    elseif ($act == 'hapus' && isset($_GET['id'])) {
        $id = intval($_GET['id']);

        $stmt = $conn->prepare("DELETE FROM tag WHERE id_tag = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Tag berhasil dihapus!";
        header("Location: ../../media.php?module=tag");
        exit;
    }
}
?>
