<?php
// Form Pencarian
// echo "<p class='fs-6'><i class='fa-solid fa-magnifying-glass'></i> <b>Pencarian</b></p>
//       <form class='d-flex' role='search' method=POST action='hasil-pencarian.html'>
//         <input name=kata class='form-control me-2' type='search' placeholder='Cari' aria-label='Search'>
//         <button class='btn btn-outline-warning' type='submit'>Cari</button>
//       </form>
//       <hr color=#FCEDC7 noshade=noshade />";

// Menu Kategori
echo "<p class='fs-6'><i class='fa-solid fa-layer-group'></i> <b>Kategori</b></p>";

$kategori = mysqli_query($conn, "SELECT nama_kategori, kategori.id_kategori, kategori_seo,  
                       count(berita.id_kategori) as jml 
                       from kategori left join berita 
                       on berita.id_kategori=kategori.id_kategori 
                       group by nama_kategori");
while ($k = mysqli_fetch_array($kategori)) {
  echo "<span class=kategori>&bull; <a href=kategori-$k[id_kategori].html> $k[nama_kategori] ($k[jml])</a></span><br />";
}
echo "<br /><hr color=#FCEDC7 noshade=noshade /><br />";

// Berita Teratas
echo "<p class='fs-6'><i class='fa-solid fa-newspaper'></i> <b>Berita Teratas</b></p><ul>";
$populer = mysqli_query($conn, "SELECT * FROM berita ORDER BY dibaca DESC LIMIT 6");
while ($p = mysqli_fetch_array($populer)) {
  echo "<p><li><a href=berita-$p[id_berita]-$p[judul_seo].html>$p[judul]</a> ($p[dibaca])</li></p>";
}
echo "</ul><br /><hr color=#FCEDC7 noshade=noshade /><br />";

// Komentar Terakhir
echo "<p class='fs-6'><i class='fa-solid fa-message'></i> <b>Komentar</b></p><ul>";
$komentar = mysqli_query($conn, "SELECT * FROM berita,komentar 
                      WHERE komentar.id_berita=berita.id_berita  
                      ORDER BY id_komentar DESC LIMIT 6");
while ($k = mysqli_fetch_array($komentar)) {
  echo "<p><li><a href='$k[url]'><b>$k[nama_komentar]</b></a> pada <a href='berita-$k[id_berita]-$k[judul_seo].html'>$k[judul]</a></li></p>";
}
echo "</ul><br /><hr color=#FCEDC7 noshade=noshade /><br />";

// Download
echo "<p class='fs-6'><i class='fa-solid fa-file-arrow-down'></i> <b>Download</b></p><ul>";
$download = mysqli_query($conn, "SELECT * FROM download 
                    ORDER BY id_download DESC LIMIT 5");
while ($d = mysqli_fetch_array($download)) {
  echo "<p><li><a href='downlot.php?file=$d[nama_file]'>$d[judul]</a> ($d[hits])</li></p>";
}
echo "</ul><hr color=#e0cb91 noshade=noshade /><br />";

// Agenda
echo "<p class='fs-6'><i class='fa-solid fa-rectangle-list'></i> <b>Agenda</b></p>";
$agenda = mysqli_query($conn, "SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT 4");

while ($a = mysqli_fetch_array($agenda)) {
  $tgl_agenda = tgl_indo($a['tgl_mulai']);
  echo "<span class=date>&bull; $tgl_agenda </a></span><br />";
  echo "<span class=agenda><a href=agenda-$a[id_agenda]-$a[tema_seo].html> $a[tema]</a></span><br /><br />";
}
echo "<br />";
