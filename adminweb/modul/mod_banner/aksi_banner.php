<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'];
$act = $_GET['act'];

// Hapus banner
if ($module == 'banner' and $act == 'hapus') {
  mysqli_query($conn, "DELETE FROM banner WHERE id_banner='$_GET[id]'");
  header('location:../../media.php?module=' . $module);
}

// Input banner
elseif ($module == 'banner' and $act == 'input') {
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)) {
    UploadBanner($nama_file);
    mysqli_query($conn, "INSERT INTO banner(judul,
                                    url,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[url]',
                                   '$tgl_sekarang',
                                   '$nama_file')");
  } else {
    mysqli_query($conn, "INSERT INTO banner(judul,
                                    tgl_posting,
                                    url) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang',
                                   '$_POST[url]')");
  }
  header('location:../../media.php?module=' . $module);
}

// Update banner
elseif ($module == 'banner' and $act == 'update') {
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)) {
    mysqli_query($conn, "UPDATE banner SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]'
                             WHERE id_banner = '$_POST[id]'");
  } else {
    UploadBanner($nama_file);
    mysqli_query($conn, "UPDATE banner SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
                                   gambar    = '$nama_file'   
                             WHERE id_banner = '$_POST[id]'");
  }
  header('location:../../media.php?module=' . $module);
}
