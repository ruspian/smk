<?php
session_start();
include "config/koneksi.php";
include "config/library.php";

function anti_injection($conn, $data)
{
	$filter = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
	return $filter;
}

// Koneksi database (pastikan ini ada)
$conn = mysqli_connect("localhost", "root", "", "db_proyek");

$nama_komentar = anti_injection($conn, $_POST['nama_komentar']);
$url = anti_injection($conn, $_POST['url']);
$isi_komentar = anti_injection($conn, $_POST['isi_komentar']);


if (!empty($_POST['kode'])) {
	if ($_POST['kode'] == $_SESSION['captcha_session']) {

		$split_text = explode(" ", $isi_komentar);
		$split_count = count($split_text);
		$max = 17;

		for ($i = 0; $i <= $split_count; $i++) {
			if (strlen($split_text[$i]) >= $max) {
				for ($j = 0; $j <= strlen($split_text[$i]); $j++) {
					$char[$j] = substr($split_text[$i], $j, 1);

					if (($j % $max == 0) && ($j != 0)) {
						$v_text .= $char[$j] . ' ';
					} else {
						$v_text .= $char[$j];
					}
				}
			} else {
				$v_text .= " " . $split_text[$i] . " ";
			}
		}


		$sql = mysqli_query($conn, "INSERT INTO komentar(nama_komentar,url,isi_komentar,id_berita,tgl,jam_komentar) 
                        VALUES('$nama_komentar','$url','$v_text','$_POST[id_berita]','$tgl_sekarang','$jam_sekarang')");
		echo "<meta http-equiv='refresh' content='0; url=berita-$_POST[id].html'>";
	} else {
		echo "Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
} else {
	echo "Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
