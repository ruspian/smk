<?php
include "../../../config/koneksi.php";

$module = $_GET['module'];
$act = $_GET['act'];

// Input templates
if ($module == 'templates' && $act == 'input') {
    $judul = $_POST['judul'];
    $pembuat = $_POST['pembuat'];
    $folder = $_POST['folder'];

    $query = "INSERT INTO templates (judul, pembuat, folder) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $judul, $pembuat, $folder);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Update templates
elseif ($module == 'templates' && $act == 'update') {
    $id = intval($_POST['id']);
    $judul = $_POST['judul'];
    $pembuat = $_POST['pembuat'];
    $folder = $_POST['folder'];

    $query = "UPDATE templates SET judul = ?, pembuat = ?, folder = ? WHERE id_templates = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $judul, $pembuat, $folder, $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Aktifkan templates
elseif ($module == 'templates' && $act == 'aktifkan') {
    $id = intval($_GET['id']);

    $query1 = "UPDATE templates SET aktif='Y' WHERE id_templates=?";
    $stmt1 = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt1, "i", $id);
    $success1 = mysqli_stmt_execute($stmt1);

    $query2 = "UPDATE templates SET aktif='N' WHERE id_templates!=?";
    $stmt2 = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt2, "i", $id);
    $success2 = mysqli_stmt_execute($stmt2);

    if ($success1 && $success2) {
        header('Location: ../../media.php?module=' . $module);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
