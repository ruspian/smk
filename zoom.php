<?php
include "config/koneksi.php";

$s = mysqli_query($conn, "SELECT * FROM gallery WHERE id_gallery='$_GET[id]'");
$r = mysqli_fetch_array($s);
echo "<p align=center><img src='img_galeri/$r[gbr_gallery]' border=0></p>";
