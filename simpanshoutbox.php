<?php
include "config/koneksi.php";
include "config/library.php";

function anti_injection($conn, $data)
{
  $filter = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
  return $filter;
}

// Koneksi database (pastikan ini ada)
$conn = mysqli_connect("localhost", "root", "Ruspian1998.", "db_Berita");

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$nama = anti_injection($conn, $_POST['nama']);
$website = anti_injection($conn, $_POST['website']);
$pesan = anti_injection($conn, $_POST['pesan']);


$kueri = mysqli_query($conn, "INSERT INTO shoutbox(nama, website, pesan, tanggal, jam)
          VALUES('$nama', '$website', '$pesan', '$tgl_sekarang','$jam_sekarang')");
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
