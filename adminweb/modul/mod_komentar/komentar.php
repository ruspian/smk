<?php
$aksi = "modul/mod_komentar/aksi_komentar.php";
switch ($aksi) {
  default:
    echo "<div class='container mt-4'>
            <h2>Komentar</h2>
            <table class='table table-bordered table-striped'>
              <thead class='thead-dark'>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Komentar</th>
                  <th>Aktif</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysqli_query($conn, "SELECT * FROM komentar ORDER BY id_komentar DESC LIMIT $posisi,$batas");
    $no = $posisi + 1;
    while ($r = mysqli_fetch_array($tampil)) {
      echo "<tr>
              <td>$no</td>
              <td>$r[nama_komentar]</td>
              <td>$r[isi_komentar]</td>
              <td class='text-center'>$r[aktif]</td>
              <td>
                <a href='?module=komentar&act=editkomentar&id=$r[id_komentar]' class='btn btn-warning btn-sm'>Edit</a>
                <a href='$aksi?module=komentar&act=hapus&id=$r[id_komentar]' class='btn btn-danger btn-sm mt-2' onclick='return confirm('Apakah Anda yakin ingin menghapus?');'>Hapus</a>
              </td>
            </tr>";
      $no++;
    }
    echo "</tbody></table>";
    
    $jmldata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM komentar"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<nav><ul class='pagination'>$linkHalaman</ul></nav></div>";
    break;

  case "editkomentar":
    $edit = mysqli_query($conn, "SELECT * FROM komentar WHERE id_komentar='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

    echo "<div class='container mt-4'>
            <h2>Edit Komentar</h2>
            <form method='POST' action='$aksi?module=komentar&act=update'>
              <input type='hidden' name='id' value='$r[id_komentar]'>
              <div class='form-group'>
                <label>Nama</label>
                <input type='text' class='form-control' name='nama_komentar' value='$r[nama_komentar]' required>
              </div>
              <div class='form-group'>
                <label>Website</label>
                <input type='text' class='form-control' name='url' value='$r[url]'>
              </div>
              <div class='form-group'>
                <label>Isi Komentar</label>
                <textarea class='form-control' name='isi_komentar' rows='4' required>$r[isi_komentar]</textarea>
              </div>
              <div class='form-group'>
                <label>Aktif</label><br>
                <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='radio' name='aktif' value='Y' ".($r['aktif'] == 'Y' ? 'checked' : '').">
                  <label class='form-check-label'>Ya</label>
                </div>
                <div class='form-check form-check-inline'>
                  <input class='form-check-input' type='radio' name='aktif' value='N' ".($r['aktif'] == 'N' ? 'checked' : '').">
                  <label class='form-check-label'>Tidak</label>
                </div>
              </div>
              <button type='submit' class='btn btn-primary'>Update</button>
              <button type='button' class='btn btn-secondary' onclick='history.back()'>Batal</button>
            </form>
          </div>";
    break;
}
