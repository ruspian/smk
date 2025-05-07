<?php
ob_start();
// Panggil semua fungsi yang dibutuhkan (semuanya ada di folder config)
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/fungsi_combobox.php";
include "config/library.php";
include "config/fungsi_autolink.php";
include "config/fungsi_badword.php";
include "config/fungsi_kalender.php";

// Memilih template yang aktif saat ini
$pilih_template = mysqli_query($conn, "SELECT folder FROM templates WHERE aktif='Y'");
$f = mysqli_fetch_array($pilih_template);
include "$f[folder]/template.php";

echo ob_flush();
