<?php
function GetCheckboxes($table, $key, $Label, $Nilai = '')
{
  global $conn;
  $s = "SELECT * FROM $table ORDER BY nama_tag";
  $r = mysqli_query($conn, $s);

  if (!$r) {
    die("Query gagal: " . mysqli_error($conn));
  }

  $_arrNilai = explode(',', $Nilai);
  $str = '';

  while ($w = mysqli_fetch_array($r)) {
    $_ck = (array_search($w[$key], $_arrNilai) === false) ? '' : 'checked';
    $str .= "<div class='form-check'>
                <input class='form-check-input' type='checkbox' name='{$key}[]' value='{$w[$key]}' $_ck>
                <label class='form-check-label'>{$w[$Label]}</label>
              </div>";
  }
  return $str;
}

$aksi = "modul/mod_berita/aksi_berita.php";
$act = $_GET['act'] ?? '';
switch ($act) {
  default:
    echo "<div class='container mt-4'>
            <h2>Berita</h2>
            <button class='btn btn-primary mb-3' onclick=\"window.location.href='?module=berita&act=tambahberita';\">Tambah Berita</button>
            <table class='table table-bordered'>
              <thead class='table-dark'>
                <tr><th>No</th><th>Judul</th><th>Tgl. Posting</th><th>Aksi</th></tr>
              </thead>
              <tbody>";

    $p = new Paging;
    $batas = 10;
    $posisi = $p->cariPosisi($batas);

    $query = ($_SESSION['leveluser'] == 'admin') ? 
             "SELECT * FROM berita ORDER BY id_berita DESC LIMIT $posisi,$batas" :
             "SELECT * FROM berita WHERE username='$_SESSION[namauser]' ORDER BY id_berita DESC LIMIT $posisi,$batas";
    $tampil = mysqli_query($conn, $query);

    $no = $posisi + 1;
    while ($r = mysqli_fetch_array($tampil)) {
      $tgl_posting = tgl_indo($r['tanggal']);
      echo "<tr>
              <td>$no</td>
              <td>{$r['judul']}</td>
              <td>$tgl_posting</td>
              <td>
                <a class='btn btn-warning btn-sm' href='?module=berita&act=editberita&id={$r['id_berita']}'>Edit</a>
                <a class='btn btn-danger btn-sm' href='$aksi?module=berita&act=hapus&id={$r['id_berita']}'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    echo "</tbody></table></div>";
    break;

  case "tambahberita":
    echo "<div class='container mt-4'>
            <h2>Tambah Berita</h2>
            <form method='POST' action='$aksi?module=berita&act=input' enctype='multipart/form-data'>
              <div class='mb-3'>
                <label class='form-label'>Judul</label>
                <input type='text' name='judul' class='form-control'>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Kategori</label>
                <select name='kategori' class='form-select'>
                  <option value=0 selected>- Pilih Kategori -</option>";
    $tampil = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori");
    while ($r = mysqli_fetch_array($tampil)) {
      echo "<option value='{$r['id_kategori']}'>{$r['nama_kategori']}</option>";
    }
    echo "  </select>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Isi Berita</label>
                <textarea name='isi_berita' class='form-control' rows='5'></textarea>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Gambar</label>
                <input type='file' name='fupload' class='form-control'>
                <small class='text-muted'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
              </div>
              <button type='submit' class='btn btn-success'>Simpan</button>
              <button type='button' class='btn btn-secondary' onclick='self.history.back()'>Batal</button>
            </form>
          </div>";
    break;

    case "editberita":
    $id_berita = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id_berita'");
    $data = mysqli_fetch_array($query);

    echo "<div class='container mt-4'>
            <h2>Edit Berita</h2>
            <form method='POST' action='$aksi?module=berita&act=update' enctype='multipart/form-data'>
              <input type='hidden' name='id' value='{$data['id_berita']}'>
              <div class='mb-3'>
                <label class='form-label'>Judul</label>
                <input type='text' name='judul' class='form-control' value='{$data['judul']}'>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Kategori</label>
                <select name='kategori' class='form-select'>";
    
    // Menampilkan kategori yang sudah ada
    $tampil_kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori");
    while ($r = mysqli_fetch_array($tampil_kategori)) {
        $selected = ($data['id_kategori'] == $r['id_kategori']) ? 'selected' : '';
        echo "<option value='{$r['id_kategori']}' $selected>{$r['nama_kategori']}</option>";
    }
    
    echo "</select>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Isi Berita</label>
                <textarea name='isi_berita' class='form-control' rows='5'>{$data['isi_berita']}</textarea>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Gambar</label>
                <input type='file' name='fupload' class='form-control'>
                <small class='text-muted'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</small>
              </div>
              <button type='submit' class='btn btn-success'>Simpan</button>
              <button type='button' class='btn btn-secondary' onclick='self.history.back()'>Batal</button>
            </form>
          </div>";
    break;


}
?>
