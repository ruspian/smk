<?php
include __DIR__ . "../../../../config/koneksi.php";
include __DIR__ . "../../../../config/library.php";
$aksi = "modul/mod_banner/aksi_banner.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Banner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus banner ini?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body class="container mt-4">
    <h2 class="mb-3">Manajemen Banner</h2>

    <?php
    $page = isset($_GET['act']) ? $_GET['act'] : 'default';

    switch ($page) {
        // Tampilkan daftar banner
        case 'default':
            echo '<button class="btn btn-primary mb-3" onclick="location.href=\'?module=banner&act=tambahbanner\'">Tambah Banner</button>';
            echo '<table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>URL</th>
                            <th>Tgl. Posting</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            $result = mysqli_query($conn, "SELECT * FROM banner ORDER BY id_banner DESC");
            $no = 1;
            while ($row = mysqli_fetch_array($result)) {
                $tgl = tgl_indo($row['tgl_posting']);
                echo "<tr>
                        <td>$no</td>
                        <td>{$row['judul']}</td>
                        <td><a href='{$row['url']}' target='_blank'>{$row['url']}</a></td>
                        <td>$tgl</td>
                        <td>
                            <a href='?module=banner&act=editbanner&id={$row['id_banner']}' class='btn btn-warning btn-sm'>Edit</a>
                            <button onclick=\"confirmDelete('$aksi?module=banner&act=hapus&id={$row['id_banner']}')\" class='btn btn-danger btn-sm'>Hapus</button>
                        </td>
                      </tr>";
                $no++;
            }
            echo '</tbody></table>';
            break;

        // Form tambah banner
        case 'tambahbanner':
            echo '<h2>Tambah Banner</h2>
                  <form method="POST" action="'.$aksi.'?module=banner&act=input" enctype="multipart/form-data" class="mt-3">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="http://" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="fupload" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Batal</button>
                  </form>';
            break;

        // Form edit banner
        case 'editbanner':
            $id = intval($_GET['id']);
            $edit = mysqli_query($conn, "SELECT * FROM banner WHERE id_banner='$id'");
            $row = mysqli_fetch_array($edit);

            echo '<h2>Edit Banner</h2>
                  <form method="POST" action="'.$aksi.'?module=banner&act=update" enctype="multipart/form-data" class="mt-3">
                    <input type="hidden" name="id" value="'.$row['id_banner'].'">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" value="'.$row['judul'].'" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="'.$row['url'].'" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="../foto_banner/'.$row['gambar'].'" class="img-thumbnail" width="200">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" name="fupload" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Batal</button>
                  </form>';
            break;
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
