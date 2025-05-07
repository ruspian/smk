<?php
session_start();
include "../../../config/koneksi.php";

$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// Fungsi untuk membersihkan input
function clean_input($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// Hapus poling
if ($module === 'poling' && $act === 'hapus') {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("ID tidak valid!");
    }

    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM poling WHERE id_poling = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: ../../media.php?module=' . $module);
        exit();
    } else {
        die("Gagal menghapus data!");
    }
}

// Input poling
elseif ($module === 'poling' && $act === 'input') {
    if (empty($_POST['pilihan']) || empty($_POST['aktif'])) {
        die("Semua kolom harus diisi!");
    }

    $pilihan = clean_input($_POST['pilihan']);
    $aktif = ($_POST['aktif'] === 'Y') ? 'Y' : 'N';

    $stmt = $conn->prepare("INSERT INTO poling (pilihan, aktif) VALUES (?, ?)");
    $stmt->bind_param("ss", $pilihan, $aktif);

    if ($stmt->execute()) {
        header('Location: ../../media.php?module=' . $module);
        exit();
    } else {
        die("Gagal menambahkan data!");
    }
}

// Update poling
elseif ($module === 'poling' && $act === 'update') {
    if (!isset($_POST['id']) || !is_numeric($_POST['id']) || empty($_POST['pilihan']) || empty($_POST['aktif'])) {
        die("Data tidak valid!");
    }

    $id = intval($_POST['id']);
    $pilihan = clean_input($_POST['pilihan']);
    $aktif = ($_POST['aktif'] === 'Y') ? 'Y' : 'N';

    $stmt = $conn->prepare("UPDATE poling SET pilihan = ?, aktif = ? WHERE id_poling = ?");
    $stmt->bind_param("ssi", $pilihan, $aktif, $id);

    if ($stmt->execute()) {
        header('Location: ../../media.php?module=' . $module);
        exit();
    } else {
        die("Gagal mengupdate data!");
    }
}
?>
