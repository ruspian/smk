<?php
$aksi = "modul/mod_katajelek/aksi_katajelek.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kata Jelek</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
<?php
switch ($_GET['act'] ?? '') {
  // Tampil Kata Jelek
  default:
    echo "<h2 class='mb-3'>Daftar Kata Jelek</h2>
          <a href='?module=katajelek&act=tambahkatajelek' class='btn btn-success mb-3'>Tambah Kata Jelek</a>
          <table class='table table-bordered'>
          <thead class='table-dark'>
            <tr>
              <th>No</th>
              <th>Kata Jelek</th>
              <th>Ganti</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>";

    $tampil = mysqli_query($conn, "SELECT * FROM katajelek ORDER BY id_jelek DESC");
    $no = 1;
    while ($r = mysqli_fetch_array($tampil)) {
      echo "<tr>
              <td>$no</td>
              <td>$r[kata]</td>
              <td>$r[ganti]</td>
              <td>
                <a href='?module=katajelek&act=editkatajelek&id=$r[id_jelek]' class='btn btn-warning btn-sm'>Edit</a>
                <a href='$aksi?module=katajelek&act=hapus&id=$r[id_jelek]' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kata ini?\")'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }

    echo "</tbody></table>";
    break;

  // Form Tambah Kata Jelek
  case "tambahkatajelek":
    echo "<h2 class='mb-3'>Tambah Kata Jelek</h2>
          <form method='POST' action='$aksi?module=katajelek&act=input'>
            <div class='mb-3'>
              <label class='form-label'>Kata Jelek</label>
              <input type='text' name='kata' class='form-control' required>
            </div>
            <div class='mb-3'>
              <label class='form-label'>Ganti</label>
              <input type='text' name='ganti' class='form-control' required>
            </div>
            <button type='submit' class='btn btn-success'>Simpan</button>
            <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
          </form>";
    break;

  // Form Edit Kata Jelek
  case "editkatajelek":
    $edit = mysqli_query($conn, "SELECT * FROM katajelek WHERE id_jelek='$_GET[id]'");
    $r = mysqli_fetch_array($edit);

    echo "<h2 class='mb-3'>Edit Kata Jelek</h2>
          <form method='POST' action='$aksi?module=katajelek&act=update'>
            <input type='hidden' name='id' value='$r[id_jelek]'>
            <div class='mb-3'>
              <label class='form-label'>Kata Jelek</label>
              <input type='text' name='kata' class='form-control' value='$r[kata]' required>
            </div>
            <div class='mb-3'>
              <label class='form-label'>Ganti</label>
              <input type='text' name='ganti' class='form-control' value='$r[ganti]' required>
            </div>
            <button type='submit' class='btn btn-warning'>Update</button>
            <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
          </form>";
    break;
}
?>
</div>

<!-- Tambahkan Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
