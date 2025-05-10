<?php
include "../../../config/koneksi.php";

$module = isset($_GET['module']) ? $_GET['module'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

// Hapus Kata Jelek
if ($module === 'katajelek' && $act === 'hapus' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ubah ke integer agar aman

    // Siapkan statement SQL untuk menghapus data
    $stmt = $conn->prepare("DELETE FROM katajelek WHERE id_jelek = ?");
    if ($stmt === false) {
        // Jika terjadi kesalahan dalam mempersiapkan query
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind parameter
    $stmt->bind_param("i", $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, tutup statement dan alihkan ke halaman sebelumnya
        $stmt->close();
        header("Location: ../../media.php?module=" . $module);
        exit(); // Pastikan script berhenti setelah pengalihan
    } else {
        // Jika gagal, tampilkan pesan error dari MySQL
        echo "Gagal menghapus data. Error: " . $stmt->error; // Menampilkan error MySQL
    }
}

// Input kata jelek
elseif ($module == 'katajelek' && $act == 'input' && isset($_POST['kata']) && isset($_POST['ganti'])) {
    $kata = mysqli_real_escape_string($conn, $_POST['kata']);
    $ganti = mysqli_real_escape_string($conn, $_POST['ganti']);

    $query = "INSERT INTO katajelek (kata, ganti) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die('Error preparing the statement: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "ss", $kata, $ganti);

    if (mysqli_stmt_execute($stmt)) {
        header("location:../../media.php?module=" . $module);
        exit();
    } else {
        echo "Gagal menambahkan data. Error: " . mysqli_error($conn);
    }
}

// Update kata jelek
elseif ($module == 'katajelek' && $act == 'update' && isset($_POST['id']) && isset($_POST['kata']) && isset($_POST['ganti'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $kata = mysqli_real_escape_string($conn, $_POST['kata']);
    $ganti = mysqli_real_escape_string($conn, $_POST['ganti']);

    $query = "UPDATE katajelek SET kata = ?, ganti = ? WHERE id_jelek = ?";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die('Error preparing the statement: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "ssi", $kata, $ganti, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("location:../../media.php?module=" . $module);
        exit();
    } else {
        echo "Gagal mengupdate data. Error: " . mysqli_error($conn);
    }
}
?>
