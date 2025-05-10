<?php
$aksi = "modul/mod_galerifoto/aksi_galerifoto.php";
$act = $_GET['act'] ?? '';

switch ($act) {
  // Tampil Galeri Foto
  default:
    echo "<div class='container'>
            <h2 class='my-4'>Galeri Foto</h2>
            <a href='?module=galerifoto&act=tambahgalerifoto' class='btn btn-success mb-3'>Tambah Galeri Foto</a>
            <table class='table table-bordered'>
              <thead class='table-dark'>
                <tr><th>No</th><th>Judul Foto</th><th>Album</th><th>Aksi</th></tr>
              </thead>
              <tbody>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
    
    $tampil = mysqli_query($conn, "SELECT * FROM gallery,album WHERE gallery.id_album=album.id_album ORDER BY id_gallery DESC LIMIT $posisi,$batas");

    $no = $posisi + 1;
    while ($r = mysqli_fetch_array($tampil)) {
      echo "<tr>
              <td>$no</td>
              <td>$r[jdl_gallery]</td>
              <td>$r[jdl_album]</td>
              <td>
                <a href='?module=galerifoto&act=editgalerifoto&id=$r[id_gallery]' class='btn btn-warning btn-sm'>Edit</a>
                <a href='$aksi?module=galerifoto&act=hapus&id=$r[id_gallery]' class='btn btn-danger btn-sm' onclick='return confirm('Apakah Anda yakin?')'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    echo "</tbody></table></div>";
    break;

  case "tambahgalerifoto":
    echo "<div class='container'>
            <h2 class='my-4'>Tambah Galeri Foto</h2>
            <form method='POST' action='$aksi?module=galerifoto&act=input' enctype='multipart/form-data'>
              <div class='mb-3'>
                <label class='form-label'>Judul Foto</label>
                <input type='text' name='jdl_gallery' class='form-control'>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Album</label>
                <select name='album' class='form-select'>
                  <option value='0' selected>- Pilih Album -</option>";
    $tampil = mysqli_query($conn, "SELECT * FROM album ORDER BY jdl_album");
    while ($r = mysqli_fetch_array($tampil)) {
      echo "<option value='$r[id_album]'>$r[jdl_album]</option>";
    }
    echo "  </select>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Keterangan</label>
                <textarea name='keterangan' class='form-control' rows='3'></textarea>
              </div>
              <div class='mb-3'>
                <label class='form-label'>Gambar</label>
                <input type='file' name='fupload' class='form-control'>
                <small class='text-muted'>Tipe gambar harus JPG/JPEG</small>
              </div>
              <button type='submit' class='btn btn-success'>Simpan</button>
              <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
            </form>
          </div>";
    break;

    case "editgalerifoto":
      $id = intval($_GET['id']);
      $edit = mysqli_query($conn, "SELECT * FROM gallery WHERE id_gallery = $id");
      $r = mysqli_fetch_array($edit);
    
      echo "<div class='container'>
              <h2 class='my-4'>Edit Galeri Foto</h2>
              <form method='POST' action='$aksi?module=galerifoto&act=update' enctype='multipart/form-data'>
                <input type='hidden' name='id' value='$r[id_gallery]'>
    
                <div class='mb-3'>
                  <label class='form-label'>Judul Foto</label>
                  <input type='text' name='jdl_gallery' class='form-control' value='$r[jdl_gallery]'>
                </div>
    
                <div class='mb-3'>
                  <label class='form-label'>Album</label>
                  <select name='album' class='form-select'>";
                  
      $album = mysqli_query($conn, "SELECT * FROM album ORDER BY jdl_album");
      while ($a = mysqli_fetch_array($album)) {
        $selected = ($a['id_album'] == $r['id_album']) ? 'selected' : '';
        echo "<option value='$a[id_album]' $selected>$a[jdl_album]</option>";
      }
    
      echo "    </select>
                </div>
    
                <div class='mb-3'>
                  <label class='form-label'>Keterangan</label>
                  <textarea name='keterangan' class='form-control' rows='3'>$r[keterangan]</textarea>
                </div>
    
                <div class='mb-3'>
                  <label class='form-label'>Gambar Saat Ini</label><br>
                  <img src='../foto_galeri/$r[gbr_gallery]' width='150'><br><br>
                  <input type='file' name='fupload' class='form-control'>
                  <small class='text-muted'>Biarkan kosong jika tidak ingin mengganti gambar</small>
                </div>
    
                <button type='submit' class='btn btn-success'>Update</button>
                <a href='?module=galerifoto' class='btn btn-secondary'>Batal</a>
              </form>
            </div>";
      break;
    
}
