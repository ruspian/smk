<?php
$aksi = "modul/mod_modul/aksi_modul.php";
$act = $_GET['act'] ?? "";

switch ($act) {
    default:
        echo "<div class='container mt-4'>
                <h2>Modul</h2>
                <a href='?module=modul&act=tambahmodul' class='btn btn-success mb-3'>Tambah Modul</a>
                <table class='table table-bordered table-striped'>
                    <thead class='table-dark'>
                        <tr>
                            <th>No</th><th>Nama Modul</th><th>Link</th><th>Publish</th>
                            <th>Aktif</th><th>Status</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";

        $tampil = mysqli_query($conn, "SELECT * FROM modul ORDER BY urutan");

        if ($tampil && mysqli_num_rows($tampil) > 0) {
            while ($r = mysqli_fetch_array($tampil)) {
                $urutan = htmlspecialchars($r['urutan']);
                $nama   = htmlspecialchars($r['nama_modul']);
                $link   = htmlspecialchars($r['link']);
                $publish= htmlspecialchars($r['publish']);
                $aktif  = htmlspecialchars($r['aktif']);
                $status = htmlspecialchars($r['status']);
                $id     = (int)$r['id_modul'];

                echo "<tr>
                        <td>$urutan</td>
                        <td>$nama</td>
                        <td><a href='$link' target='_blank'>$link</a></td>
                        <td class='text-center'>$publish</td>
                        <td class='text-center'>$aktif</td>
                        <td>$status</td>
                        <td>
                            <a href='?module=modul&act=editmodul&id=$id' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='$aksi?module=modul&act=hapus&id=$id' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus?')\">Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>Belum ada modul.</td></tr>";
        }

        echo "    </tbody>
                </table>
                <div class='alert alert-info mt-3'>*) Apabila PUBLISH bernilai Y, akan ditampilkan di menu utama</div>
              </div>";
        break;
    
    case "tambahmodul":
        echo "<div class='container mt-4'>
                <h2>Tambah Modul</h2>
                <form method='POST' action='$aksi?module=modul&act=input' class='form-group'>
                    <div class='mb-3'>
                        <label>Nama Modul</label>
                        <input type='text' name='nama_modul' class='form-control' required>
                    </div>
                    <div class='mb-3'>
                        <label>Link</label>
                        <input type='text' name='link' class='form-control' required>
                    </div>
                    <div class='mb-3'>
                        <label>Publish</label><br>
                        <input type='radio' name='publish' value='Y' checked> Y 
                        <input type='radio' name='publish' value='N'> N
                    </div>
                    <div class='mb-3'>
                        <label>Aktif</label><br>
                        <input type='radio' name='aktif' value='Y' checked> Y 
                        <input type='radio' name='aktif' value='N'> N
                    </div>
                    <div class='mb-3'>
                        <label>Status</label><br>
                        <input type='radio' name='status' value='user' checked> User 
                        <input type='radio' name='status' value='admin'> Admin
                    </div>
                    <button type='submit' class='btn btn-success'>Simpan</button>
                    <button type='button' class='btn btn-secondary' onclick='self.history.back()'>Batal</button>
                </form>
              </div>";
        break;

    case "editmodul":
    $id = $_GET['id'];
    $edit = mysqli_query($conn, "SELECT * FROM modul WHERE id_modul='$id'");
    $r = mysqli_fetch_array($edit);

    echo "<div class='container mt-4'>
            <h2>Edit Modul</h2>
            <form method='POST' action='$aksi?module=modul&act=update' class='form-group'>
                <input type='hidden' name='id' value='{$r['id_modul']}'>
                <div class='mb-3'>
                    <label>Nama Modul</label>
                    <input type='text' name='nama_modul' class='form-control' value='{$r['nama_modul']}' required>
                </div>
                <div class='mb-3'>
                    <label>Link</label>
                    <input type='text' name='link' class='form-control' value='{$r['link']}' required>
                </div>
                <div class='mb-3'>
                    <label>Publish</label><br>
                    <input type='radio' name='publish' value='Y' ".($r['publish']=='Y'?'checked':'')."> Y 
                    <input type='radio' name='publish' value='N' ".($r['publish']=='N'?'checked':'')."> N
                </div>
                <div class='mb-3'>
                    <label>Aktif</label><br>
                    <input type='radio' name='aktif' value='Y' ".($r['aktif']=='Y'?'checked':'')."> Y 
                    <input type='radio' name='aktif' value='N' ".($r['aktif']=='N'?'checked':'')."> N
                </div>
                <div class='mb-3'>
                    <label>Status</label><br>
                    <input type='radio' name='status' value='user' ".($r['status']=='user'?'checked':'')."> User 
                    <input type='radio' name='status' value='admin' ".($r['status']=='admin'?'checked':'')."> Admin
                </div>
                <div class='mb-3'>
                    <label>Urutan</label>
                    <input type='number' name='urutan' class='form-control' value='{$r['urutan']}' required>
                </div>
                <button type='submit' class='btn btn-success'>Update</button>
                <button type='button' class='btn btn-secondary' onclick='self.history.back()'>Batal</button>
            </form>
          </div>";
    break;

}
?>
