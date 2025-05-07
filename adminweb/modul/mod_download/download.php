<?php
include dirname(__DIR__, 3) . "/config/koneksi.php";
$aksi = "modul/mod_download/aksi_download.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';
?>

<div class="container mt-4">
    <h2 class="mb-3">Download</h2>
    <a href="?module=download&act=tambahdownload" class="btn btn-success mb-3">Tambah Download</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Nama File</th>
                    <th>Tanggal Posting</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tampil = mysqli_query($conn, "SELECT * FROM download ORDER BY id_download DESC");
                $no = 1;
                while ($r = mysqli_fetch_array($tampil)) {
                    $tgl = date("d-m-Y", strtotime($r['tgl_posting']));
                    echo "<tr>
                            <td>$no</td>
                            <td>$r[judul]</td>
                            <td>$r[nama_file]</td>
                            <td>$tgl</td>
                            <td>
                                <a href='?module=download&act=editdownload&id=$r[id_download]' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='$aksi?module=download&act=hapus&id=$r[id_download]' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus?')\">Hapus</a>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($act == 'tambahdownload') { ?>
<div class="container mt-4">
    <h2>Tambah Download</h2>
    <form method="POST" action="<?= $aksi ?>?module=download&act=input" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>File</label>
            <input type="file" name="fupload" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="self.history.back()">Batal</button>
    </form>
</div>
<?php } ?>

<?php if ($act == 'editdownload') {
    $id = intval($_GET['id']);
    $edit = mysqli_query($conn, "SELECT * FROM download WHERE id_download='$id'");
    $r = mysqli_fetch_array($edit);
?>
<div class="container mt-4">
    <h2>Edit Download</h2>
    <form method="POST" enctype="multipart/form-data" action="<?= $aksi ?>?module=download&act=update">
        <input type="hidden" name="id" value="<?= $r['id_download'] ?>">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= $r['judul'] ?>" required>
        </div>
        <div class="form-group">
            <label>File Saat Ini</label>
            <p><?= $r['nama_file'] ?></p>
        </div>
        <div class="form-group">
            <label>Ganti File</label>
            <input type="file" name="fupload" class="form-control-file">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah file.</small>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-secondary" onclick="self.history.back()">Batal</button>
    </form>
</div>
<?php } ?>
