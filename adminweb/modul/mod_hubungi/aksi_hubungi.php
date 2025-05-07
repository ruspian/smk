<?php
include "../../../config/koneksi.php";

$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

if ($module == 'hubungi' && $act == 'hapus') {
    // Validasi ID agar hanya angka (integer)
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("ID tidak valid!");
    }

    $id = intval($_GET['id']);

    // Gunakan prepared statements untuk keamanan
    $stmt = $conn->prepare("DELETE FROM hubungi WHERE id_hubungi = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: ../../media.php?module=' . $module);
        exit; // Pastikan script berhenti setelah redirect
    } else {
        die("Gagal menghapus data.");
    }
}
?>
