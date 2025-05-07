<?php
include "config/koneksi.php";
// tentukan folder yang boleh didownload
$direktori = "files/";
// lalu cek menggunakan fungsi file_exist
if (!file_exists($direktori . $_GET['file'])) {
  echo "<h1>Access forbidden!</h1>
        <p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi. <br />
        Silahkan hubungi <a href='mailto:redaksi@bukulokomedia.com'>webmaster</a>.</p>";
  exit;
} else {
  mysqli_query($conn, "update download set hits=hits+1 where nama_file='$_GET[file]'");
  header("Content-Type: octet/stream");
  header("Content-Disposition: attachment; filename=\"" . $_GET['file'] . "\"");
  $fp = fopen($direktori . $_GET['file'], "r");
  $data = fread($fp, filesize($direktori . $_GET['file']));
  fclose($fp);
  print $data;
}
