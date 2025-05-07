<?php
include "../../../config/koneksi.php";

$module = filter_input(INPUT_GET, 'module', FILTER_SANITIZE_STRING);
$act = filter_input(INPUT_GET, 'act', FILTER_SANITIZE_STRING);

// Hapus shoutbox
if ($module == 'shoutbox' && $act == 'hapus') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
    if ($id) {
        $stmt = $conn->prepare("DELETE FROM shoutbox WHERE id_shoutbox = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: ../../media.php?module=$module&status=success&msg=Shoutbox berhasil dihapus");
        } else {
            header("Location: ../../media.php?module=$module&status=error&msg=Gagal menghapus shoutbox");
        }
        $stmt->close();
    } else {
        header("Location: ../../media.php?module=$module&status=error&msg=ID tidak valid");
    }
}

// Update shoutbox
elseif ($module == 'shoutbox' && $act == 'update') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $website = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_URL);
    $pesan = filter_input(INPUT_POST, 'pesan', FILTER_SANITIZE_STRING);
    $aktif = filter_input(INPUT_POST, 'aktif', FILTER_SANITIZE_STRING);

    if ($id && $nama && $pesan) {
        $stmt = $conn->prepare("UPDATE shoutbox SET nama = ?, website = ?, pesan = ?, aktif = ? WHERE id_shoutbox = ?");
        $stmt->bind_param("ssssi", $nama, $website, $pesan, $aktif, $id);
        
        if ($stmt->execute()) {
            header("Location: ../../media.php?module=$module&status=success&msg=Shoutbox berhasil diperbarui");
        } else {
            header("Location: ../../media.php?module=$module&status=error&msg=Gagal memperbarui shoutbox");
        }
        $stmt->close();
    } else {
        header("Location: ../../media.php?module=$module&status=error&msg=Data tidak valid");
    }
}
?>
