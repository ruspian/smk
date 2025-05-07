<script language="JavaScript" type="text/javascript">
  function addSmiley(textToAdd) {
    document.formshout.pesan.value += textToAdd;
    document.formshout.pesan.focus();
  }
</script>


<?php
session_start();
include "config/koneksi.php";
// var_dump($_SESSION);


// Jika user sudah login, tampilkan tombol Keluar
if (isset($_SESSION['namauser'])) {
  echo "<p class='text-center'>
        <a class='btn btn-danger fw-bold text-white' href='keluar.php'>
            <i class='fa-solid fa-right-from-bracket'></i> Keluar
        </a>
      </p>
      <hr color=#e0cb91 noshade=noshade />";
} else {
  // Jika user belum login, tampilkan tombol Masuk
  echo "<p class='text-center'>
        <a name='keluar' class='btn btn-warning fw-bold text-white' href='daftar.php'>
            <i class='fa-solid fa-right-to-bracket'></i> Masuk
        </a>
      </p>
      <hr color=#e0cb91 noshade=noshade />";
}



// Form indeks berita
echo "<p class='fs-6'><i class='fa-regular fa-circle-right'></i> <b>Indeks Berita</b></p>
      <form method=POST action='indeks-berita.html'>";
      combotgl(1, 31, 'tanggal', $tgl_skrg);
      echo " / ";
      combobln(1, 12, 'bulan', $bln_sekarang);
      echo " / ";
      combothn(2000, $thn_sekarang, 'tahun', $thn_sekarang);
echo "<br /><input class='btn btn-warning btn-sm w-75 h-25 mt-2 ms-3' type=submit value=Cari />
      </form>
      <hr color=#e0cb91 noshade=noshade />";

// Kalender
echo "<p class='fs-6 mb-2'><i class='fa-solid fa-calendar-days'></i> <b>Kalender</b></p>";

$tgl_skrg = date("d");
$bln_skrg = date("n");
$thn_skrg = date("Y");


echo buatkalender($tgl_skrg, $bln_skrg, $thn_skrg);

echo "<hr class='my-2' style='border-color: #e0cb91;'>";


// Statistik user
echo "<p class='fs-6'><i class='fa-solid fa-users'></i> <b>Pengunjung</b></p>";

$ip      = $_SERVER['REMOTE_ADDR']; // IP user
$tanggal = date("Ymd"); // Tanggal hari ini
$waktu   = time(); // Waktu sekarang
$bataswaktu = $waktu - 300; // 5 menit terakhir untuk pengunjung online

// Query untuk mendapatkan statistik pengunjung
$stmt = $conn->prepare("
    SELECT 
        COUNT(DISTINCT ip) AS total_pengunjung_hari_ini,
        COUNT(hits) AS total_pengunjung,
        SUM(hits) AS total_hits_hari_ini,
        (SELECT SUM(hits) FROM statistik) AS total_hits,
        (SELECT COUNT(*) FROM statistik WHERE online > ?) AS pengunjung_online
    FROM statistik
    WHERE tanggal = ?
");
$stmt->bind_param("is", $bataswaktu, $tanggal);
$stmt->execute();
$stmt->bind_result($pengunjung, $totalpengunjung, $hits, $totalhits, $pengunjungonline);
$stmt->fetch();
$stmt->close();

// Cek apakah user sudah tercatat hari ini
$stmt = $conn->prepare("SELECT COUNT(*) FROM statistik WHERE ip = ? AND tanggal = ?");
$stmt->bind_param("ss", $ip, $tanggal);
$stmt->execute();
$stmt->bind_result($user_tercatat);
$stmt->fetch();
$stmt->close();

// Jika belum ada, tambahkan ke database
if ($user_tercatat == 0) {
    $stmt = $conn->prepare("INSERT INTO statistik (ip, tanggal, hits, online) VALUES (?, ?, 1, ?)");
    $stmt->bind_param("ssi", $ip, $tanggal, $waktu);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt = $conn->prepare("UPDATE statistik SET hits = hits + 1, online = ? WHERE ip = ? AND tanggal = ?");
    $stmt->bind_param("iss", $waktu, $ip, $tanggal);
    $stmt->execute();
    $stmt->close();
}

// Format angka dengan Bootstrap Badge
$tothitsgbr = sprintf("%06d", $totalhits);
$tothitsgbr = "<span class='badge bg-warning fs-4'>$tothitsgbr</span>";

// Tampilkan statistik dengan tampilan Bootstrap
echo "<p align=center>$tothitsgbr</p>
      <p><i class='fa-solid fa-calendar-day'></i> <b>Pengunjung hari ini:</b> <span class='badge bg-warning text-white'>$pengunjung</span></p>
      <p><i class='fa-solid fa-users'></i> <b>Total pengunjung:</b> <span class='badge bg-warning text-white'>$totalpengunjung</span></p>
      <p><i class='fa-solid fa-chart-line'></i> <b>Hits hari ini:</b> <span class='badge bg-warning text-white'>$hits</span></p>
      <p><i class='fa-solid fa-chart-bar'></i> <b>Total Hits:</b> <span class='badge bg-warning text-white'>$totalhits</span></p>
      <p><i class='fa-solid fa-user-clock'></i> <b>Pengunjung Online:</b> <span class='badge bg-warning text-white'>$pengunjungonline</span></p>";

echo "<hr color=#e0cb91 noshade=noshade />";


// Polling
echo "<p class='fs-6'><i class='fa-solid fa-poll-h'></i> <b>Voting</b></p>";
echo "<b>Pilih Browser Favorit Anda?</b> <br /><br />";

echo "<form method=POST action='hasil-poling.html'>";

$poling = mysqli_query($conn, "SELECT * FROM poling WHERE aktif='Y'");
while ($p = mysqli_fetch_assoc($poling)) {
  echo "<div class='form-check'>
    <input class='form-check-input' type='checkbox' value='$p[id_poling]' id='flexCheckDefault'>
    <label class='form-check-label' for='flexCheckDefault'></label>
      $p[pilihan]
    </label>
  </div>";
}
echo "<input class='btn btn-warning btn-sm w-75 h-25 mt-2 ms-3' type=submit value=Vote />
      </form>
      <p class='text-center mt-2'><a class='link-warning text-white text-decoration-none link-underline-opacity-100-hover' href=lihat-poling.html>Lihat Hasil Voting</a></p>
      <hr color=#e0cb91 noshade=noshade /><br />";


// Shoutbox / chat box
echo "<p class='fs-6 fw-bold'><i class='fa-solid fa-comments'></i> Chat Box</p>";

// Shoutbox iframe dengan Bootstrap card
echo "<div class='card border-warning mb-3' style='max-width: 18rem;'>
        <div class='card-body p-2'>
          <iframe src='shoutbox.php' class='w-100 border rounded' style='height: 250px;'></iframe>
        </div>
      </div>";

// Form chat dengan Bootstrap styling
echo "<form name='formshout' action='simpanshoutbox.php' method='POST' class='border p-1 rounded shadow-sm bg-light'>
        <div class='mb-1'>
          <input type='text' name='nama' style='font-size: 10px;' class='form-control' placeholder='Masukkan nama' required>
        </div>
        <div class='mb-1'>
          <input type='text' name='website' style='font-size: 10px;' class='form-control' placeholder='https://contoh.com'>
        </div>
        <div class='mb-1'>
          <textarea name='pesan' style='font-size: 10px;' class='form-control' rows='3' placeholder='Tulis pesan...' required></textarea>
        </div>";

?>

<?php
echo "<div class='d-flex gap-2'>
        <button type='submit' name='submit' style='font-size: 10px;' class='btn btn-primary btn-sm'><i class='fa-solid fa-paper-plane'></i> Kirim</button>
        <button type='reset' name='reset' style='font-size: 10px;' class='btn btn-danger btn-sm'><i class='fa-solid fa-rotate-left'></i> Reset</button>
      </div>
    </form>";

echo "<hr class='my-4 border-warning'>";


// Banner
$banner = mysqli_query($conn, "SELECT * FROM banner 
                    ORDER BY id_banner DESC LIMIT 4");
while ($b = mysqli_fetch_array($banner)) {
  echo "<p align=center><a href=$b[url] target='_blank' title='$b[judul]'><img src='foto_banner/$b[gambar]' border=0></a></p>";
}
?>
<style>
  .tr_judul {
    font-weight: bold;
    text-align: center;
    background: #d0d0d0;
  }

  .tr_terang {
    text-align: center;
    background: #f0f0f0;
  }

  .tabel_data {
    background: #d0d0d0;
    color: #000000;
  }
</style>