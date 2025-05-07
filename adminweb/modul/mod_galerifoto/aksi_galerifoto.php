<?php
include __DIR__ . "../../../../config/koneksi.php";
include __DIR__ . "../../../../config/fungsi_thumb.php";
include __DIR__ . "../../../../config/fungsi_seo.php";

$module = $_GET['module'] ?? '';
$act = $_GET['act'] ?? '';

// Hapus gallery
if ($module === 'galerifoto' && $act === 'hapus') {
    $id = intval($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM gallery WHERE id_gallery = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    header('location:../../media.php?module=' . $module);
    exit;
}

// Input gallery
elseif ($module === 'galerifoto' && $act === 'input') {
    $judul_gallery = mysqli_real_escape_string($conn, $_POST['jdl_gallery']);
    $id_album = intval($_POST['album']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $gallery_seo = seo_title($judul_gallery);

    $nama_file_unik = '';
    if (!empty($_FILES['fupload']['tmp_name'])) {
        $tipe_file = mime_content_type($_FILES['fupload']['tmp_name']);
        if (in_array($tipe_file, ['image/jpeg', 'image/png'])) {
            $acak = rand(100000, 999999);
            $nama_file_unik = $acak . basename($_FILES['fupload']['name']);
            UploadGallery($nama_file_unik);
        }
    }

    $stmt = $conn->prepare("INSERT INTO gallery (jdl_gallery, gallery_seo, id_album, keterangan, gbr_gallery) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $judul_gallery, $gallery_seo, $id_album, $keterangan, $nama_file_unik);
    $stmt->execute();
    $stmt->close();
    
    header('location:../../media.php?module=' . $module);
    exit;
}

// Update gallery
elseif ($module === 'galerifoto' && $act === 'update') {
    $id = intval($_POST['id'] ?? 0);
    $judul_gallery = mysqli_real_escape_string($conn, $_POST['jdl_gallery']);
    $id_album = intval($_POST['album']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $gallery_seo = seo_title($judul_gallery);

    if ($id > 0) {
        $nama_file_unik = '';
        if (!empty($_FILES['fupload']['tmp_name'])) {
            $tipe_file = mime_content_type($_FILES['fupload']['tmp_name']);
            if (in_array($tipe_file, ['image/jpeg', 'image/png'])) {
                $acak = rand(100000, 999999);
                $nama_file_unik = $acak . basename($_FILES['fupload']['name']);
                UploadGallery($nama_file_unik);

                $stmt = $conn->prepare("UPDATE gallery SET jdl_gallery = ?, gallery_seo = ?, id_album = ?, keterangan = ?, gbr_gallery = ? WHERE id_gallery = ?");
                $stmt->bind_param("ssissi", $judul_gallery, $gallery_seo, $id_album, $keterangan, $nama_file_unik, $id);
            }
        } else {
            $stmt = $conn->prepare("UPDATE gallery SET jdl_gallery = ?, gallery_seo = ?, id_album = ?, keterangan = ? WHERE id_gallery = ?");
            $stmt->bind_param("ssisi", $judul_gallery, $gallery_seo, $id_album, $keterangan, $id);
        }

        $stmt->execute();
        $stmt->close();
    }

    header('location:../../media.php?module=' . $module);
    exit;
}
