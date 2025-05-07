<script language="javascript">
  function validasi(form) {
    if (form.nama_komentar.value == "") {
      alert("Anda belum mengisikan Nama.");
      form.nama_komentar.focus();
      return (false);
    }

    if (form.isi_komentar.value == "") {
      alert("Anda belum mengisikan komentar.");
      form.isi_komentar.focus();
      return (false);
    }
    return (true);
  }
</script>

<script language="JavaScript">
  function bukajendela(url) {
    window.open(url, "window_baru", "width=1000,height=700,left=120,top=10,resizable=1,scrollbars=1");
  }
</script>

<?php
// Skrip javascript diatas untuk melakukan validasi data untuk pengisi komentar agar tidak mengosongkan nama dan isi komentar.


// Halaman utama (Home)
if ($_GET['module'] == 'home') {
    // Query untuk mendapatkan berita terbaru dengan jumlah komentar
    $terkini = mysqli_query($conn, "SELECT COUNT(komentar.id_komentar) as jml, judul, judul_seo, jam, 
                                    berita.id_berita, hari, tanggal, gambar, isi_berita    
                                    FROM berita 
                                    LEFT JOIN komentar 
                                    ON berita.id_berita = komentar.id_berita AND aktif='Y' 
                                    GROUP BY berita.id_berita 
                                    ORDER BY berita.id_berita DESC 
                                    LIMIT 5");

    if (!$terkini) {
        die("Query Error: " . mysqli_error($conn)); // Debugging error query
    }

    while ($t = mysqli_fetch_array($terkini)) {
    $tgl = tgl_indo($t['tanggal']);
    $isi_berita = strip_tags($t["isi_berita"]); // Hapus tag HTML
    $isi = substr($isi_berita, 0, 220);
    $isi = substr($isi, 0, strrpos($isi, " ")); // Potong sampai spasi terakhir

    echo "<div class='card mb-3' style='max-width: 660px;'>
            <div class='row g-0'>
                <div class='col-md-3'>";
                
                // Tampilkan gambar jika ada
                if (!empty($t['gambar'])) {
                    echo "<img src='foto_berita/small_{$t['gambar']}' class='img-fluid mt-4 ms-4 rounded-start' alt='Gambar Berita'>";
                } else {
                    echo "<img src='https://via.placeholder.com/150' class='img-fluid rounded-start' alt='Gambar Default'>";
                }

    echo "    </div>
                <div class='col-md-8'>
                    <div class='card-body'>
                        <h5 class='card-title'>
                            <a href='berita-{$t['id_berita']}-{$t['judul_seo']}.html' class='text-black text-decoration-none'>
                                " . htmlspecialchars($t['judul']) . "
                            </a>
                        </h5>
                        <p class='card-text'>" . htmlspecialchars($isi) . "...</p>
                        <p class='card-text'>
                            <small class='text-body-secondary'>
                                <p><i class='fa-solid fa-clock'></i> {$t['hari']}, $tgl - {$t['jam']} WIB</p> 
                                
                            </small>
                        </p>
                        <a href='berita-{$t['id_berita']}-{$t['judul_seo']}.html' class='btn btn-success btn-sm text-white'>Selengkapnya <span class='badge bg-secondary'>{$t['jml']} Komentar</span></a>
                        
                    </div>
                </div>
            </div>
        </div>";
  }


  // Tampilkan 7 judul berita sebelumnya 
  echo "<p class='fs-5'><i class='fa-solid fa-newspaper'></i> <b>Berita Lainnya</b></p>";
  $sebelum = mysqli_query($conn, "SELECT * FROM berita 
                        ORDER BY id_berita DESC LIMIT 6,7");
  while ($s = mysqli_fetch_array($sebelum)) {
    echo "<li><a class='link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover' href=berita-$s[id_berita]-$s[judul_seo].html>$s[judul]</a></li>";
  }
  echo "</ul><hr color=#e0cb91 noshade=noshade /><br />";

  // Tampilkan galeri
  echo "<p class='fs-5'><i class='fa-solid fa-images'></i> <b>Galeri Photo</b></p>";

      // Ambil data gallery
      $g = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id_gallery DESC LIMIT 6");

      $carousel_id = "carouselGallery"; // ID unik untuk carousel

      echo "<div id='$carousel_id' class='carousel slide' data-bs-ride='carousel'>
              <div class='carousel-indicators'>";

      // Buat indikator carousel
      $index = 0;
      while ($w = mysqli_fetch_array($g)) {
          $active = ($index == 0) ? "active" : "";
          echo "<button type='button' data-bs-target='#$carousel_id' data-bs-slide-to='$index' class='$active' aria-label='Slide " . ($index + 1) . "'></button>";
          $index++;
      }

      echo "</div>
            <div class='carousel-inner'>";

      // Reset ulang query untuk mengambil ulang data gallery
      mysqli_data_seek($g, 0);

      $index = 0;
      while ($w = mysqli_fetch_array($g)) {
          $active = ($index == 0) ? "active" : "";
          echo "<div class='carousel-item $active' data-bs-interval='5000'>
                  <img src='img_galeri/kecil_{$w['gbr_gallery']}' class='d-block mx-auto' style='width: 640px; height: 360px; border-radius: 10px;' alt='{$w['jdl_gallery']}'>
                  <div class='carousel-caption d-none d-md-block'>
                      <h5><a href='album-{$w['id_album']}.html' class='text-light text-decoration-none'>{$w['jdl_gallery']}</a></h5>
                  </div>
                </div>";
          $index++;
      }

      echo "</div>
            <button class='carousel-control-prev' type='button' data-bs-target='#$carousel_id' data-bs-slide='prev'>
              <span class='carousel-control-prev-icon' aria-hidden='true'></span>
              <span class='visually-hidden'>Previous</span>
            </button>
            <button class='carousel-control-next' type='button' data-bs-target='#$carousel_id' data-bs-slide='next'>
              <span class='carousel-control-next-icon' aria-hidden='true'></span>
              <span class='visually-hidden'>Next</span>
            </button>
          </div>";
}
  

elseif ($_GET["module"] == "detailberita") {
    // Amankan ID dari GET
    $id = intval($_GET["id"]);

    // Ambil detail berita
    $query = "SELECT berita.*, users.nama_lengkap, kategori.nama_kategori, kategori.kategori_seo 
              FROM berita 
              JOIN users ON users.username = berita.username 
              JOIN kategori ON kategori.id_kategori = berita.id_kategori 
              WHERE id_berita = $id";

    $detail = mysqli_query($conn, $query);

    // Jika query gagal
    if (!$detail) {
        die("Query Error: " . mysqli_error($conn));
    }

    $d = mysqli_fetch_assoc($detail);

    // Jika berita ditemukan
    if ($d) {
    $tgl = tgl_indo($d["tanggal"]);
    $baca = $d["dibaca"] + 1;

    echo "<div class='container my-4'>";
    echo "<div class='card shadow-sm'>";
    echo "<div class='card-body'>";

    // **Header Berita**
    echo "<h4 class='card-title text-success'>{$d['judul']}</h4>";
    echo "<p class='text-muted'><i class='fa-solid fa-calendar'></i> {$d['hari']}, $tgl - {$d['jam']} WIB</p>";

    // **Kategori & Jumlah Dibaca**
    echo "<p><span class='badge bg-warning'><i class='fa-solid fa-folder'></i> 
          <a href='kategori-{$d['id_kategori']}-{$d['kategori_seo']}.html' class='text-white text-decoration-none'>{$d['nama_kategori']}</a></span>
          <span class='text-muted ms-2'><i class='fa-solid fa-eye'></i> Dibaca: <b>$baca</b> kali</span>
          </p>";

    // **Diposting oleh**
    echo "<p class='text-secondary'><i class='fa-solid fa-user'></i> Diposting oleh: <b>{$d['nama_lengkap']}</b></p>";

    // **Isi Berita**
    echo "<div class='border-top pt-3'>";
    echo "<p class='card-text'>{$d['isi_berita']}</p>";
    echo "</div>";

    echo "</div></div></div>";

    // **Update jumlah pembaca**
    $updateQuery = "UPDATE berita SET dibaca = dibaca + 1 WHERE id_berita = $id";
    if (!mysqli_query($conn, $updateQuery)) {
        die("Query Update Error: " . mysqli_error($conn));
    }
} else {
    echo "<div class='alert alert-danger'>Berita tidak ditemukan.</div>";
    exit;
}

   echo "<div class='container my-4'>";

// **Tampilkan berita terkait**
echo "<div class='card shadow-sm mb-4'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title text-success'><i class='fa-solid fa-newspaper'></i> Berita Terkait</h5>";
echo "<ul class='list-group list-group-flush'>";

// Perbaikan pencarian berita terkait
$tags = explode(",", $d["tag"]);
$tagConditions = [];

foreach ($tags as $tag) {
    $tag = trim($tag);
    if (!empty($tag)) {
        $tagConditions[] = "tag LIKE '%" . mysqli_real_escape_string($conn, $tag) . "%'";
    }
}

$whereTags = implode(" OR ", $tagConditions);
if (!empty($whereTags)) {
    $cari = "SELECT * FROM berita WHERE id_berita != $id AND ($whereTags) 
             ORDER BY id_berita DESC LIMIT 5";

    $hasil = mysqli_query($conn, $cari);

    if ($hasil) {
        while ($h = mysqli_fetch_assoc($hasil)) {
            echo "<li class='list-group-item'><a href='berita-{$h['id_berita']}-{$h['judul_seo']}.html' 
                  class='text-decoration-none text-dark'><i class='fa-solid fa-angle-right'></i> {$h['judul']}</a></li>";
        }
    }
}

echo "</ul>";
echo "</div></div>";

// **Tampilkan jumlah komentar**
$komentarQuery = "SELECT COUNT(id_komentar) AS jml FROM komentar WHERE id_berita = $id AND aktif='Y'";
$komentar = mysqli_query($conn, $komentarQuery);
$k = mysqli_fetch_assoc($komentar);

echo "<h5 class='text-success'><i class='fa-solid fa-comments'></i> {$k['jml']} Komentar</h5>";

// **Tampilkan komentar berita**
$sql = "SELECT * FROM komentar WHERE id_berita = $id AND aktif='Y'";
$komentarHasil = mysqli_query($conn, $sql);

if ($komentarHasil && mysqli_num_rows($komentarHasil) > 0) {
    while ($s = mysqli_fetch_assoc($komentarHasil)) {
        $tanggal = tgl_indo($s["tgl"]);

        echo "<div class='card my-3 shadow-sm'>";
        echo "<div class='card-body'>";
        echo "<h6 class='card-title'><i class='fa-solid fa-user'></i> ";
        echo $s["url"] ? "<a href='http://{$s['url']}' target='_blank' class='text-decoration-none text-success'>{$s['nama_komentar']}</a>" : "{$s['nama_komentar']}";
        echo "</h6>";
        echo "<p class='text-muted'><i class='fa-solid fa-clock'></i> $tanggal - {$s['jam_komentar']} WIB</p>";

        // Perbaiki sensor isi komentar
        $isian = nl2br($s["isi_komentar"]);
        $isikan = sensor($isian, $conn);

        // Pastikan fungsi autolink tersedia sebelum dipanggil
        if (file_exists('config/fungsi_autolink.php')) {
            include_once 'config/fungsi_autolink.php';
            if (function_exists('autolink')) {
                echo "<p class='card-text'>" . autolink($isikan) . "</p>";
            } else {
                echo "<p class='card-text'>$isikan</p>";
            }
        } else {
            echo "<p class='card-text'>$isikan</p>";
        }

        echo "</div></div>";
    }
}

  // **Form tambah komentar**
  echo "<div class='card shadow-sm'>";
  echo "<div class='card-body'>";
  echo "<h5 class='card-title text-success'><i class='fa-solid fa-comment-dots'></i> Tambahkan Komentar</h5>";
  echo "<form action='simpankomentar.php' method='POST' onSubmit=\"return validasi(this)\">";
  echo "<input type='hidden' name='id_berita' value='$id'>";

  // **Nama**
  echo "<div class='mb-3'>";
  echo "<label class='form-label'>Nama</label>";
  echo "<input type='text' name='nama_komentar' class='form-control' required>";
  echo "</div>";

  // **Website**
  echo "<div class='mb-3'>";
  echo "<label class='form-label'>Website</label>";
  echo "<input type='text' name='url' class='form-control'>";
  echo "</div>";

  // **Komentar**
  echo "<div class='mb-3'>";
  echo "<label class='form-label'>Komentar</label>";
  echo "<textarea name='isi_komentar' class='form-control' rows='3' required></textarea>";
  echo "</div>";

  // **Captcha**
  echo "<div class='mb-3'>";
  echo "<img src='captcha.php' class='mb-2'><br>";
  echo "<input type='text' name='kode' class='form-control w-50' placeholder='Masukkan kode' required>";
  echo "</div>";

  // **Tombol Submit**
  echo "<button type='submit' class='btn btn-warning'><i class='fa-solid fa-paper-plane'></i> Kirim</button>";
  echo "</form>";
  echo "</div></div>";

  echo "</div>"; // **Container tutup**
}


// Modul berita per kategori
elseif ($_GET["module"] == "detailkategori") {
    // Pastikan id kategori valid
    $id_kategori = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

    // Ambil nama kategori
    $stmt = mysqli_prepare($conn, "SELECT nama_kategori FROM kategori WHERE id_kategori = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_kategori);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($n = mysqli_fetch_assoc($result)) {
        echo "<div class='container mt-4'>";
        echo "<h2 class='text-success mb-3 fs-5'>Kategori: <b>" . htmlspecialchars($n['nama_kategori']) . "</b></h2>";
    } else {
        echo "<div class='container mt-4'><p class='alert alert-danger'>Kategori tidak ditemukan.</p></div>";
        exit;
    }

    // Pagination
    $p = new Paging3;
    $batas = 5;
    $posisi = $p->cariPosisi($batas);

    // Ambil daftar berita berdasarkan kategori
    $stmt = mysqli_prepare($conn, "SELECT * FROM berita WHERE id_kategori = ? ORDER BY id_berita DESC LIMIT ?, ?");
    mysqli_stmt_bind_param($stmt, "iii", $id_kategori, $posisi, $batas);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($hasil) > 0) {
        while ($r = mysqli_fetch_assoc($hasil)) {
            $tgl = tgl_indo($r["tanggal"]);
            $judul = htmlspecialchars($r["judul"]);
            $link = "berita-{$r['id_berita']}-" . htmlspecialchars($r["judul_seo"]) . ".html";
            $gambar = !empty($r["gambar"]) ? "foto_berita/small_" . htmlspecialchars($r["gambar"]) : "templates/standar/images/noimage.png";

            echo "<div class='card mb-3 shadow-sm'>";
            echo "  <div class='row g-0'>";
            echo "    <div class='col-md-3'>";
            echo "      <img src='$gambar' class='img-fluid rounded mt-4 ms-4' alt='$judul' loading='lazy'>";
            echo "    </div>";
            echo "    <div class='col-md-9'>";
            echo "      <div class='card-body'>";
            echo "        <h5 class='card-title'><a href='$link' class='text-decoration-none text-success fw-bold'>$judul</a></h5>";
            echo "        <p class='text-muted mb-1'><i class='bi bi-clock'></i> {$r["hari"]}, $tgl - {$r["jam"]} WIB</p>";

            // Potong isi berita
            $isi_berita = htmlspecialchars(strip_tags($r["isi_berita"]));
            $isi = substr($isi_berita, 0, 220);
            $isi = substr($isi, 0, strrpos($isi, " "));

            echo "        <p class='card-text'>$isi...</p>";
            echo "        <a href='$link' class='btn btn-success text-white btn-sm'>Selengkapnya</a>";
            echo "      </div>";
            echo "    </div>";
            echo "  </div>";
            echo "</div>";
        }

        // Ambil total data untuk pagination
        $stmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM berita WHERE id_kategori = ?");
        mysqli_stmt_bind_param($stmt, "i", $id_kategori);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $jmldata);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
        $halkategori = isset($_GET["halkategori"]) ? intval($_GET["halkategori"]) : 1;
        $linkHalaman = $p->navHalaman($halkategori, $jmlhalaman);

        echo "<nav class='mt-4'><ul class='pagination justify-content-center'>$linkHalaman</ul></nav>";

    } else {
        echo "<p class='alert alert-warning'>Belum ada berita pada kategori ini.</p>";
    }
    echo "</div>"; // Tutup container
}



// Modul detail agenda
elseif ($_GET["module"] == "detailagenda") {
    // Validasi dan casting ID ke integer untuk keamanan
    $id_agenda = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

    // Cek apakah ID valid
    if ($id_agenda <= 0) {
        echo "<div class='container mt-4'><div class='alert alert-danger'>Agenda tidak ditemukan.</div></div>";
        exit;
    }

    // Query dengan prepared statement 
    $stmt = $conn->prepare("SELECT * FROM agenda WHERE id_agenda = ?");
    $stmt->bind_param("i", $id_agenda);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container mt-4'>";
    
    if ($result->num_rows == 0) {
        echo "<div class='alert alert-warning'>Agenda tidak ditemukan.</div>";
    } else {
        $d = $result->fetch_assoc();
        $tgl_posting  = tgl_indo($d["tgl_posting"]);
        $tgl_mulai    = tgl_indo($d["tgl_mulai"]);
        $tgl_selesai  = tgl_indo($d["tgl_selesai"]);
        $isi_agenda   = nl2br(htmlspecialchars($d["isi_agenda"]));

        echo "<div class='card shadow-sm'>";
        echo "  <div class='card-header bg-success text-white'>";
        echo "    <h4 class='mb-0'>{$d['tema']}</h4>";
        echo "  </div>";
        echo "  <div class='card-body'>";
        echo "    <p class='text-muted'><i class='bi bi-calendar'></i> Diposting pada: $tgl_posting</p>";
        echo "    <hr>";
        echo "    <p><strong>Topik:</strong>$isi_agenda</p>";
        echo "    <p><strong>Tanggal:</strong> $tgl_mulai s/d $tgl_selesai</p>";
        echo "    <p><strong>Tempat:</strong> {$d['tempat']}</p>";
        echo "    <p><strong>Pengirim (Contact Person):</strong> {$d['pengirim']}</p>";
        echo "  </div>";
        echo "</div>";
    }

    echo "</div>"; // Tutup container

    // Tutup statement
    $stmt->close();
}

// Modul hasil pencarian berita 
elseif ($_GET["module"] == "hasilcari") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='mb-3 text-success'><i class='bi bi-search'></i> Hasil Pencarian</h4>";

    // Menghilangkan spasi di kiri dan kanan
    $kata = trim($_POST["kata"]);

    // Jika kosong, beri peringatan
    if (empty($kata)) {
        echo "<div class='alert alert-warning'><i class='bi bi-exclamation-triangle'></i> Masukkan kata kunci pencarian!</div>";
        exit;
    }

    // Pisahkan kata pencarian
    $pisah_kata = explode(" ", $kata);
    $jml_kata = count($pisah_kata);

    // Buat query pencarian dinamis
    $cari = "SELECT * FROM berita WHERE ";
    $whereClauses = [];
    foreach ($pisah_kata as $word) {
        $whereClauses[] = "isi_berita LIKE '%" . mysqli_real_escape_string($conn, $word) . "%'";
    }
    $cari .= implode(" OR ", $whereClauses);
    $cari .= " ORDER BY id_berita DESC LIMIT 7";

    // Eksekusi query
    $hasil = mysqli_query($conn, $cari);
    if (!$hasil) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    $ketemu = mysqli_num_rows($hasil);

    if ($ketemu > 0) {
        echo "<p class='text-black'>Ditemukan <b>$ketemu</b> berita dengan kata <span class='text-success'><b>$kata</b></span>:</p>";

        echo "<div class='list-group'>";
        while ($t = mysqli_fetch_assoc($hasil)) {
            // Menampilkan ringkasan isi berita
            $isi_berita = nl2br(htmlspecialchars($t["isi_berita"]));
            $isi = substr($isi_berita, 0, 150);
            $isi = substr($isi, 0, strrpos($isi, " ")); // Hindari pemotongan kata

            echo "<a href='berita-{$t['id_berita']}-{$t['judul_seo']}.html' class='list-group-item list-group-item-action text-black'>";
            echo "  <h5 class='mb-1'>{$t['judul']}</h5>";
            echo "  <p class='mb-1'>$isi ...</p>";
            echo "  <small class='text-success'>Selengkapnya</small>";
            echo "</a>";
        }
        echo "</div>";

    } else {
        echo "<div class='alert alert-danger'><i class='bi bi-x-circle'></i> Tidak ditemukan berita dengan kata <b>$kata</b>.</div>";
    }

    echo "</div>"; // Tutup container
}

// Modul indeks berita
elseif ($_GET["module"] == "indeksberita") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='mb-3 text-success'><i class='bi bi-calendar3'></i> Hasil Indeks Berita</h4>";

    // Validasi input tanggal
    $tahun   = isset($_POST["tahun"]) ? (int) $_POST["tahun"] : 0;
    $bulan   = isset($_POST["bulan"]) ? (int) $_POST["bulan"] : 0;
    $tanggal = isset($_POST["tanggal"]) ? (int) $_POST["tanggal"] : 0;

    if ($tahun == 0 || $bulan == 0 || $tanggal == 0) {
        echo "<div class='alert alert-warning'><i class='bi bi-exclamation-triangle'></i> Pilih tanggal yang valid!</div>";
        exit;
    }

    // Format tanggal sesuai MySQL
    $format_mysql = "$tahun-$bulan-$tanggal";
    $format_indo  = tgl_indo($format_mysql);

    // Query berita berdasarkan tanggal
    $cari = mysqli_query($conn, "SELECT * FROM berita WHERE tanggal = '$format_mysql'");
    if (!$cari) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    $jumlah = mysqli_num_rows($cari);

    if ($jumlah > 0) {
        echo "<p class='text-success'>Ditemukan <b>$jumlah</b> berita pada tanggal <span class='text-danger'><b>$format_indo</b></span>:</p>";
        echo "<div class='list-group'>";
        while ($r = mysqli_fetch_assoc($cari)) {
            echo "<a href='berita-{$r['id_berita']}-{$r['judul_seo']}.html' class='list-group-item list-group-item-action text-black'>";
            echo "  <h5 class='mb-1'>{$r['judul']}</h5>";
            echo "  <small class='text-success'>Lihat berita</small>";
            echo "</a>";
        }
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger'><i class='bi bi-x-circle'></i> Tidak ada berita pada tanggal <b>$format_indo</b>.</div>";
    }

    echo "</div>"; // Tutup container
}


// Modul hasil poling
elseif ($_GET["module"] == "hasilpoling") {
    echo "<div class='container mt-4'>";
    
    if (isset($_COOKIE["poling"])) {
        echo "<div class='alert alert-warning'><i class='bi bi-exclamation-triangle'></i> Anda sudah pernah melakukan voting terhadap polling ini.</div>";
    } else {
        // Set cookie untuk 24 jam
        setcookie("poling", "sudah poling", time() + 3600 * 24);

        echo "<h4 class='text-primary'><i class='bi bi-bar-chart-line'></i> Hasil Poling</h4>";
        echo "<p class='text-center'>Terimakasih atas partisipasi Anda mengikuti polling kami.</p>";
        echo "<h5 class='text-center text-success'>Hasil polling saat ini:</h5>";

        // Update rating untuk pilihan yang dipilih
        $pilihan = isset($_POST["pilihan"]) ? (int) $_POST["pilihan"] : 0;
        $u = mysqli_query($conn, "UPDATE poling SET rating = rating + 1 WHERE id_poling = $pilihan");

        // Total jumlah voting
        $jml = mysqli_query($conn, "SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
        $j = mysqli_fetch_assoc($jml);
        $jml_vote = $j["jml_vote"];

        // Ambil data polling
        $sql = mysqli_query($conn, "SELECT * FROM poling WHERE aktif='Y'");

        echo "<table class='table table-bordered mt-3'>";
        echo "<thead class='table-primary'><tr><th>Pilihan</th><th>Hasil</th></tr></thead>";
        echo "<tbody>";

        while ($s = mysqli_fetch_assoc($sql)) {
            $prosentase = ($jml_vote > 0) ? sprintf("%2.1f", ($s["rating"] / $jml_vote) * 100) : 0;
            
            echo "<tr>";
            echo "<td><b>{$s['pilihan']} ({$s['rating']})</b></td>";
            echo "<td>";
            echo "<div class='progress' style='height: 25px;'>";
            echo "<div class='progress-bar bg-primary' role='progressbar' style='width: $prosentase%;' aria-valuenow='$prosentase' aria-valuemin='0' aria-valuemax='100'>$prosentase%</div>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "<p class='text-center'><b>Total Voting: $jml_vote</b></p>";
    }

    echo "</div>"; // Tutup container
}


elseif ($_GET["module"] == "lihatpoling") {
    echo "<div class='container mt-4'>";

    echo "<h4 class='text-success text-center'><i class='bi bi-bar-chart-line'></i> Hasil Poling</h4>";
    echo "<p class='text-center'>Terimakasih atas partisipasi Anda mengikuti polling kami.</p>";
    echo "<h5 class='text-center text-success'>Hasil polling saat ini:</h5>";

    // Ambil jumlah total vote
    $jml = mysqli_query($conn, "SELECT SUM(rating) AS jml_vote FROM poling WHERE aktif='Y'");
    $j = mysqli_fetch_assoc($jml);
    $jml_vote = $j["jml_vote"] ?? 0;

    // Ambil data polling
    $sql = mysqli_query($conn, "SELECT * FROM poling WHERE aktif='Y'");

    echo "<table class='table table-bordered mt-3'>";
    echo "<thead class='table-success'><tr><th>Pilihan</th><th>Hasil</th></tr></thead>";
    echo "<tbody>";

    while ($s = mysqli_fetch_assoc($sql)) {
        $prosentase = ($jml_vote > 0) ? sprintf("%2.1f", ($s["rating"] / $jml_vote) * 100) : 0;

        echo "<tr>";
        echo "<td><b>" . htmlspecialchars($s['pilihan']) . " ({$s['rating']})</b></td>";
        echo "<td>";
        echo "<div class='progress' style='height: 25px;'>";
        echo "<div class='progress-bar bg-success' role='progressbar' style='width: $prosentase%;' aria-valuenow='$prosentase' aria-valuemin='0' aria-valuemax='100'>$prosentase%</div>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    echo "<p class='text-center'><b>Total Voting: $jml_vote</b></p>";

    echo "</div>"; // Tutup container
}



// Menu utama di header

elseif ($_GET["module"] == "profilkami") {
    echo "<div class='container mt-4'>";
    
    echo "<h4 class='text-primary text-center'><i class='bi bi-person-circle'></i> Profil Kami</h4>";

    $profil = mysqli_query($conn, "SELECT * FROM modul WHERE id_modul=37");
    $r = mysqli_fetch_assoc($profil);

    echo "<div class='card shadow-sm mt-3'>";
    echo "<div class='card-body'>";

    if (!empty($r["gambar"])) {
        echo "<div class='text-center mb-3'>";
        echo "<img src='foto_banner/{$r['gambar']}' class='img-fluid rounded' alt='Profil'>";
        echo "</div>";
    }

    $isi_profil = nl2br($r["static_content"]);
    echo "<p class='card-text'>$isi_profil</p>";

    echo "</div>"; // card-body
    echo "</div>"; // card

    echo "</div>"; // container
}


// modul semua berita
elseif ($_GET["module"] == "semuaberita") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='text-success'><i class='bi bi-newspaper'></i> Semua Berita</h4>";

    // Konfigurasi Pagination
    $p = new Paging2;
    $batas = 8;
    $posisi = $p->cariPosisi($batas);

    // Query utama untuk menampilkan berita
    $sql = mysqli_query($conn, "SELECT berita.id_berita, berita.judul, berita.judul_seo, berita.jam, 
                                       berita.hari, berita.tanggal, berita.gambar, berita.isi_berita,
                                       COUNT(komentar.id_komentar) AS jml 
                                FROM berita 
                                LEFT JOIN komentar ON berita.id_berita = komentar.id_berita AND komentar.aktif = 'Y' 
                                GROUP BY berita.id_berita
                                ORDER BY berita.tanggal DESC 
                                LIMIT $posisi, $batas");

    if (!$sql) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4'>";

    while ($r = mysqli_fetch_assoc($sql)) {
        $tgl = tgl_indo($r["tanggal"]);
        $isi_berita = nl2br($r["isi_berita"]); 
        $isi = substr($isi_berita, 0, 150);
        $isi = substr($isi, 0, strrpos($isi, " "));

        echo "<div class='col'>";
        echo "<div class='card shadow-sm h-100'>";
        
        // if (!empty($r['gambar'])) {
        //     echo "<img src='foto_banner/{$r['gambar']}' class='card-img-top' alt='{$r['judul']}'>";
        // }

        echo "<div class='card-body'>";
        echo "<h5 class='card-title'><a href='berita-{$r['id_berita']}-{$r['judul_seo']}.html' class='text-decoration-none text-success'>{$r['judul']}</a></h5>";
        echo "<p class='text-muted'><i class='bi bi-calendar3'></i> {$r['hari']}, $tgl - {$r['jam']} WIB</p>";
        echo "<p class='card-text'>$isi ... <a href='berita-{$r['id_berita']}-{$r['judul_seo']}.html' class='text-primary'>Selengkapnya</a></p>";
        echo "</div>";

        echo "<div class='card-footer'>";
        echo "<span class='badge bg-warning'><i class='bi bi-chat-left-text'></i> {$r['jml']} komentar</span>";
        echo "</div>";

        echo "</div>"; // card
        echo "</div>"; // col
    }

    echo "</div>"; // row

    // Hitung jumlah total data untuk pagination
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM berita");
    $data = mysqli_fetch_assoc($result);
    $jmldata = $data['total'];

    $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET["halberita"], $jmlhalaman);

    // Navigasi halaman dengan Bootstrap Pagination
    echo "<nav class='mt-4'>
            <ul class='pagination justify-content-center'>$linkHalaman</ul>
          </nav>";

    echo "</div>"; // container
}


// Modul semua agenda
elseif ($_GET["module"] == "semuaagenda") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='text-primary'><i class='bi bi-calendar-event'></i> Semua Agenda</h4>";

    $p      = new Paging4;
    $batas  = 6;
    $posisi = $p->cariPosisi($batas);

    // Query untuk menampilkan semua agenda
    $sql = mysqli_query($conn, "SELECT * FROM agenda ORDER BY id_agenda DESC LIMIT $posisi,$batas");

    if (!$sql) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4'>";

    while ($d = mysqli_fetch_assoc($sql)) {
        $tgl_posting = tgl_indo($d["tgl_posting"]);
        $tgl_mulai   = tgl_indo($d["tgl_mulai"]);
        $tgl_selesai = tgl_indo($d["tgl_selesai"]);
        $isi_agenda  = nl2br($d["isi_agenda"]);

        echo "<div class='col'>";
        echo "<div class='card shadow-sm h-100'>";

        echo "<div class='card-body'>";
        echo "<span class='badge bg-warning mb-2'><i class='bi bi-calendar'></i> $tgl_posting</span>";
        echo "<h5 class='card-title text-success'>{$d['tema']}</h5>";

        echo "<ul class='list-group list-group-flush'>";
        echo "<li class='list-group-item'><b>Topik:</b> $isi_agenda</li>";
        echo "<li class='list-group-item'><b>Tanggal:</b> $tgl_mulai s/d $tgl_selesai</li>";
        echo "<li class='list-group-item'><b>Tempat:</b> {$d['tempat']}</li>";
        echo "<li class='list-group-item'><b>Pengirim (Contact Person):</b> {$d['pengirim']}</li>";
        echo "</ul>";

        echo "</div>"; // card-body
        echo "</div>"; // card
        echo "</div>"; // col
    }

    echo "</div>"; // row

    // Hitung jumlah total data untuk pagination
    $jmldata     = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM agenda"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET["halagenda"], $jmlhalaman);

    // Navigasi halaman dengan Bootstrap Pagination
    echo "<nav class='mt-4'>
            <ul class='pagination justify-content-center'>$linkHalaman</ul>
          </nav>";

    echo "</div>"; // container
}

// Modul semua download
elseif ($_GET["module"] == "semuadownload") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='text-success'><i class='bi bi-download'></i> Semua File Download</h4>";

    $p      = new Paging5;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    // Query untuk menampilkan semua file download
    $sql = mysqli_query($conn, "SELECT * FROM download ORDER BY id_download DESC LIMIT $posisi,$batas");

    if (!$sql) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    echo "<div class='list-group'>";

    while ($d = mysqli_fetch_assoc($sql)) {
        echo "<div class='list-group-item d-flex justify-content-between align-items-center'>";
        echo "<div>";
        echo "<i class='bi bi-file-earmark-arrow-down text-success'></i> ";
        echo "<strong>{$d['judul']}</strong>";
        echo "</div>";
        echo "<a href='downlot.php?file={$d['nama_file']}' class='btn btn-success text-white btn-sm' download>
                <i class='bi bi-download'></i> Download ({$d['hits']})
              </a>";
        echo "</div>";
    }

    echo "</div>"; // list-group

    // Hitung jumlah total data untuk pagination
    $jmldata     = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM download"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET["haldownload"], $jmlhalaman);

    // Navigasi halaman dengan Bootstrap Pagination
    echo "<nav class='mt-4'>
            <ul class='pagination justify-content-center'>$linkHalaman</ul>
          </nav>";

    echo "</div>"; // container
}


// Modul semua album
elseif ($_GET["module"] == "semuaalbum") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='text-success'><i class='bi bi-image'></i> Semua Album</h4>";

    // Query untuk mengambil album dan jumlah foto
    $a = mysqli_query($conn, "SELECT jdl_album, album.id_album, gbr_album, album_seo,  
                              COUNT(gallery.id_gallery) as jumlah 
                              FROM album 
                              LEFT JOIN gallery ON album.id_album = gallery.id_album 
                              GROUP BY jdl_album");

    if (!$a) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4'>";

    while ($w = mysqli_fetch_assoc($a)) {
        echo "<div class='col'>";
        echo "<div class='card shadow-sm border-0'>";
        echo "<a href='album-{$w['id_album']}.html' class='text-decoration-none'>";
        echo "<img src='files/img_album/kecil_{$w['gbr_album']}' class='card-img-top img-fluid' 
                alt='{$w['jdl_album']}' style='height: 180px; object-fit: cover;'>";
        echo "</a>";
        echo "<div class='card-body text-center'>";
        echo "<h6 class='card-title'><a href='album-{$w['id_album']}.html' class='text-dark fw-bold'>{$w['jdl_album']}</a></h6>";
        echo "<p class='text-muted small'>{$w['jumlah']} Foto</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    echo "</div>"; // row
    echo "</div>"; // container
}



elseif ($_GET["module"] == "detailalbum") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='text-success'><i class='bi bi-images'></i> Galeri Foto</h4>";

    $p      = new Paging6;
    $batas  = 9;
    $posisi = $p->cariPosisi($batas);

    // Query untuk mengambil foto berdasarkan album
    $g = mysqli_query($conn, "SELECT * FROM gallery WHERE id_album={$_GET['id']} 
                              ORDER BY id_gallery DESC LIMIT $posisi, $batas");

    if (!$g) {
        die("<div class='alert alert-danger'>Query Error: " . mysqli_error($conn) . "</div>");
    }

    echo "<div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4'>";

    while ($w = mysqli_fetch_assoc($g)) {
        echo "<div class='col'>";
        echo "<div class='card shadow-sm border-0'>";
        echo "<a href='#' data-bs-toggle='modal' data-bs-target='#modal{$w['id_gallery']}'>";
        echo "<img src='img_galeri/kecil_{$w['gbr_gallery']}' class='card-img-top img-fluid' 
                alt='{$w['jdl_gallery']}' style='height: 180px; object-fit: cover;'>";
        echo "</a>";
        echo "<div class='card-body text-center'>";
        echo "<h6 class='card-title'>{$w['jdl_gallery']}</h6>";
        echo "<p class='text-muted small'>{$w['keterangan']}</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        // Modal Bootstrap untuk menampilkan gambar lebih besar
        echo "<div class='modal fade' id='modal{$w['id_gallery']}' tabindex='-1' aria-hidden='true'>";
        echo "<div class='modal-dialog modal-lg'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<h5 class='modal-title'>{$w['jdl_gallery']}</h5>";
        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
        echo "</div>";
        echo "<div class='modal-body text-center'>";
        echo "<img src='img_galeri/{$w['gbr_gallery']}' class='img-fluid' alt='{$w['jdl_gallery']}'>";
        echo "<p class='mt-3'>{$w['keterangan']}</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    echo "</div>"; // row
    echo "</div>"; // container

    // Pagination
    $jmldata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gallery WHERE id_album={$_GET['id']}"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET["halgaleri"], $jmlhalaman);

    echo "<div class='container mt-3'>";
    echo "<nav>";
    echo "<ul class='pagination pagination-sm justify-content-center'>$linkHalaman</ul>";
    echo "</nav>";
    echo "</div>";
}

// Modul hubungi kami
elseif ($_GET["module"] == "hubungikami") {
    echo "<div class='container mt-4'>";
    echo "<h4 class='text-success'><i class='bi bi-envelope-fill'></i> Hubungi Kami</h4>";
    echo "<p>Hubungi kami secara online dengan mengisi form di bawah ini:</p>";

    echo "<div class='card shadow-sm border-0'>";
    echo "<div class='card-body'>";

    echo "<form action='hubungi-aksi.html' method='POST'>";
    
    echo "<div class='mb-3'>";
    echo "<label for='nama' class='form-label'>Nama</label>";
    echo "<input type='text' class='form-control' id='nama' name='nama' placeholder='Masukkan nama Anda' required>";
    echo "</div>";

    echo "<div class='mb-3'>";
    echo "<label for='email' class='form-label'>Email</label>";
    echo "<input type='email' class='form-control' id='email' name='email' placeholder='Masukkan email Anda' required>";
    echo "</div>";

    echo "<div class='mb-3'>";
    echo "<label for='subjek' class='form-label'>Subjek</label>";
    echo "<input type='text' class='form-control' id='subjek' name='subjek' placeholder='Masukkan subjek pesan' required>";
    echo "</div>";

    echo "<div class='mb-3'>";
    echo "<label for='pesan' class='form-label'>Pesan</label>";
    echo "<textarea class='form-control' id='pesan' name='pesan' rows='4' placeholder='Tulis pesan Anda di sini...' required></textarea>";
    echo "</div>";

    echo "<button type='submit' class='btn btn-success text-white w-100'><i class='bi bi-send-fill'></i> Kirim Pesan</button>";

    echo "</form>";

    echo "</div>"; // card-body
    echo "</div>"; // card

    echo "</div>"; // container
}



// Modul hubungi aksi
elseif ($_GET["module"] == "hubungiaksi") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subjek = mysqli_real_escape_string($conn, $_POST['subjek']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
    $tanggal = date("Y-m-d H:i:s"); // Format tanggal otomatis

    // Gunakan prepared statement untuk keamanan
    $stmt = mysqli_prepare($conn, "INSERT INTO hubungi (nama, email, subjek, pesan, tanggal) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $subjek, $pesan, $tanggal);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-success text-center' role='alert'>";
    echo "<h4 class='alert-heading'><i class='bi bi-check-circle-fill'></i> Terima Kasih!</h4>";
    echo "<p>Pesan Anda telah terkirim. Kami akan segera meresponsnya.</p>";
    echo "</div>";

    echo "<div class='text-center'>";
    echo "<a href='index.php' class='btn btn-primary'><i class='bi bi-house-door-fill'></i> Kembali ke Beranda</a>";
    echo "</div>";

    echo "</div>"; // container
}

?>
<style>
  .img {
    border: 2px solid #72a143;
    padding: 2px;
    background: #ffeda5;
  }

  .img2 {
    border: 2px solid #F0892C;
    padding: 2px;
    background: #ffeda5;
  }
</style>