<?php
include __DIR__ . "../../../../config/koneksi.php";

$aksi = "modul/mod_album/aksi_album.php";
switch ($_GET['act'] ?? '') {
  // Tampil Album
  default:
    echo "<div class='container mt-4'>
            <h2 class='mb-3'>Album</h2>
            <button class='btn btn-success mb-3' onclick=\"window.location.href='?module=album&act=tambahalbum';\">
                Tambah Album
            </button>
            <table class='table table-striped'>
              <thead class='table-dark'>
                <tr>
                  <th>No</th>
                  <th>Judul Album</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>";
              
    $stmt = $conn->prepare("SELECT * FROM album ORDER BY id_album DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    
    $no = 1;
    while ($r = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$r['jdl_album']}</td>
                <td>
                  <a href='?module=album&act=editalbum&id={$r['id_album']}' class='btn btn-warning btn-sm'>Edit</a>
                </td>
              </tr>";
        $no++;
    }
    
    echo "</tbody></table></div>";
    break;
  
  // Form Tambah Album
  case "tambahalbum":
    echo "<div class='container mt-4'>
            <h2>Tambah Album</h2>
            <form method='POST' action='$aksi?module=album&act=input' enctype='multipart/form-data'>
              <div class='mb-3'>
                <label for='jdl_album' class='form-label'>Judul Album</label>
                <input type='text' class='form-control' name='jdl_album' id='jdl_album' required>
              </div>
              <div class='mb-3'>
                <label for='fupload' class='form-label'>Gambar</label>
                <input type='file' class='form-control' name='fupload' id='fupload' required>
              </div>
              <button type='submit' class='btn btn-success'>Simpan</button>
              <button type='button' class='btn btn-danger' onclick='self.history.back()'>Batal</button>
            </form>
          </div>";
    break;
  
  // Form Edit Album  
  case "editalbum":
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $conn->prepare("SELECT * FROM album WHERE id_album = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $r = $stmt->get_result()->fetch_assoc();
        
        echo "<div class='container mt-4'>
                <h2>Edit Album</h2>
                <form method='POST' enctype='multipart/form-data' action='$aksi?module=album&act=update'>
                  <input type='hidden' name='id' value='{$r['id_album']}'>
                  
                  <div class='mb-3'>
                    <label for='jdl_album' class='form-label'>Judul Album</label>
                    <input type='text' class='form-control' name='jdl_album' id='jdl_album' value='{$r['jdl_album']}' required>
                  </div>
                  
                  <div class='mb-3'>
                    <label>Gambar Saat Ini:</label><br>
                    <img src='../img_album/kecil_{$r['gbr_album']}' class='img-thumbnail' width='150'>
                  </div>
                  
                  <div class='mb-3'>
                    <label for='fupload' class='form-label'>Ganti Gambar</label>
                    <input type='file' class='form-control' name='fupload' id='fupload'>
                  </div>
                  
                  <button type='submit' class='btn btn-success'>Update</button>
                  <button type='button' class='btn btn-danger' onclick='self.history.back()'>Batal</button>
                </form>
              </div>";
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>ID Album tidak valid!</div>";
    }
    break;
}
?>
