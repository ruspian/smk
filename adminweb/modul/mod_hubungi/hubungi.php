<?php
$aksi = "modul/mod_hubungi/aksi_hubungi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<?php
switch ($_GET['act'] ?? '') {
  // Tampil Hubungi Kami
  default:
    echo "<h2 class='mb-3'>Hubungi Kami</h2>
          <div class='table-responsive'>
          <table class='table table-bordered table-striped'>
          <thead class='table-dark'>
          <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Subjek</th>
              <th>Tanggal</th>
              <th>Aksi</th>
          </tr>
          </thead><tbody>";

    $p = new Paging;
    $batas = 10;
    $posisi = $p->cariPosisi($batas);

    $stmt = $conn->prepare("SELECT id_hubungi, nama, email, subjek, tanggal FROM hubungi ORDER BY id_hubungi DESC LIMIT ?, ?");
    $stmt->bind_param("ii", $posisi, $batas);
    $stmt->execute();
    $result = $stmt->get_result();

    $no = $posisi + 1;
    while ($r = $result->fetch_assoc()) {
      $tgl = htmlspecialchars(tgl_indo($r['tanggal']));
      echo "<tr>
              <td>$no</td>
              <td>" . htmlspecialchars($r['nama']) . "</td>
              <td><a href='?module=hubungi&act=balasemail&id=" . intval($r['id_hubungi']) . "' class='text-decoration-none'>" . htmlspecialchars($r['email']) . "</a></td>
              <td>" . htmlspecialchars($r['subjek']) . "</td>
              <td>$tgl</td>
              <td>
                <a href='$aksi?module=hubungi&act=hapus&id=" . intval($r['id_hubungi']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus pesan ini?\")'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    echo "</tbody></table></div>";

    $stmt = $conn->prepare("SELECT COUNT(*) FROM hubungi");
    $stmt->execute();
    $stmt->bind_result($jmldata);
    $stmt->fetch();
    $stmt->close();

    $jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'] ?? 1, $jmlhalaman);

    echo "<nav class='mt-3'>
            <ul class='pagination'>$linkHalaman</ul>
          </nav>";
    break;

  case "balasemail":
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("ID tidak valid!");
    }
    
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT email, subjek, pesan FROM hubungi WHERE id_hubungi = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $r = $result->fetch_assoc();

    if (!$r) {
        die("Data tidak ditemukan!");
    }

    echo "<h2 class='mb-3'>Reply Email</h2>
          <form method='POST' action='?module=hubungi&act=kirimemail' class='needs-validation' novalidate>
          <div class='mb-3'>
              <label class='form-label'>Kepada</label>
              <input type='email' name='email' class='form-control' value='" . htmlspecialchars($r['email']) . "' required>
          </div>
          <div class='mb-3'>
              <label class='form-label'>Subjek</label>
              <input type='text' name='subjek' class='form-control' value='Re: " . htmlspecialchars($r['subjek']) . "' required>
          </div>
          <div class='mb-3'>
              <label class='form-label'>Pesan</label>
              <textarea name='pesan' class='form-control' rows='5' required>
-------------------------------------------------------------------------------------------------------
" . htmlspecialchars($r['pesan']) . "</textarea>
          </div>
          <button type='submit' class='btn btn-primary'>Kirim</button>
          <button type='button' class='btn btn-secondary' onclick='history.back()'>Batal</button>
          </form>";
    break;

  case "kirimemail":
    if (empty($_POST['email']) || empty($_POST['subjek']) || empty($_POST['pesan'])) {
        die("<div class='alert alert-danger'>Semua kolom harus diisi!</div>");
    }

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subjek = htmlspecialchars($_POST['subjek']);
    $pesan = htmlspecialchars($_POST['pesan']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<div class='alert alert-danger'>Email tidak valid!</div>");
    }

    $headers = "From: admin@domainanda.com\r\n" .
               "Reply-To: admin@domainanda.com\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($email, $subjek, $pesan, $headers)) {
        echo "<div class='alert alert-success mt-3'>Email berhasil terkirim!</div>
              <a href='javascript:history.go(-2)' class='btn btn-secondary mt-3'>Kembali</a>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Gagal mengirim email!</div>
              <a href='javascript:history.go(-2)' class='btn btn-secondary mt-3'>Kembali</a>";
    }
    break;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
