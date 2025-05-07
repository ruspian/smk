<?php
$aksi = "modul/mod_tag/aksi_tag.php";
$act = $_GET['act'] ?? '';

switch ($act) {
  // Tampil Tag
  default:
    echo "<div class='container mt-4'>
            <h2 class='mb-3'>Tag</h2>
            <a href='?module=tag&act=tambahtag' class='btn btn-primary mb-3'>Tambah Tag</a>
            <table class='table table-bordered table-striped'>
              <thead class='table-dark'>
                <tr>
                  <th>No</th>
                  <th>Nama Tag</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>";

    $tampil = mysqli_query($conn, "SELECT * FROM tag ORDER BY id_tag DESC");
    $no = 1;
    while ($r = mysqli_fetch_array($tampil)) {
      echo "<tr>
              <td>{$no}</td>
              <td>{$r['nama_tag']}</td>
              <td>
                <a href='?module=tag&act=edittag&id={$r['id_tag']}' class='btn btn-warning btn-sm'>Edit</a> 
                <a href='{$aksi}?module=tag&act=hapus&id={$r['id_tag']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus tag ini?\")'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    echo "</tbody></table></div>";
    break;

  // Form Tambah Tag
  case "tambahtag":
    echo "<div class='container mt-4'>
            <h2>Tambah Tag</h2>
            <form method='POST' action='{$aksi}?module=tag&act=input'>
              <div class='mb-3'>
                <label class='form-label'>Nama Tag</label>
                <input type='text' name='nama_tag' class='form-control' required>
              </div>
              <button type='submit' class='btn btn-success'>Simpan</button>
              <a href='?module=tag' class='btn btn-secondary'>Batal</a>
            </form>
          </div>";
    break;

  // Form Edit Tag
  case "edittag":
    $id = intval($_GET['id']);
    $edit = mysqli_query($conn, "SELECT * FROM tag WHERE id_tag = $id");
    $r = mysqli_fetch_array($edit);

    echo "<div class='container mt-4'>
            <h2>Edit Tag</h2>
            <form method='POST' action='{$aksi}?module=tag&act=update'>
              <input type='hidden' name='id' value='{$r['id_tag']}'>
              <div class='mb-3'>
                <label class='form-label'>Nama Tag</label>
                <input type='text' name='nama_tag' class='form-control' value='{$r['nama_tag']}' required>
              </div>
              <button type='submit' class='btn btn-primary'>Update</button>
              <a href='?module=tag' class='btn btn-secondary'>Batal</a>
            </form>
          </div>";
    break;
}
