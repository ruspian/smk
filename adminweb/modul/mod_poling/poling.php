<?php
include __DIR__ . "../../../../config/koneksi.php";
$aksi = "modul/mod_poling/aksi_poling.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Poling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus polling ini?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <h2 class="mb-3">Manajemen Poling</h2>

    <?php
    $page = isset($_GET['act']) ? $_GET['act'] : 'default';
    switch ($page) {
        case 'default':
            echo '<button class="btn btn-success mb-3" onclick="location.href=\'?module=poling&act=tambahpoling\'"><i class="bi bi-plus-circle"></i> Tambah Poling</button>';
            echo '<table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Pilihan</th>
                            <th>Rating</th>
                            <th>Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            $no = 1;
            $tampil = mysqli_query($conn, "SELECT * FROM poling ORDER BY id_poling DESC");
            while ($r = mysqli_fetch_array($tampil)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$r['pilihan']}</td>
                        <td align='center'>{$r['rating']}</td>
                        <td align='center'>{$r['aktif']}</td>
                        <td>
                            <a href='?module=poling&act=editpoling&id={$r['id_poling']}' class='btn btn-warning btn-sm'>Edit</a>
                            <button onclick=\"confirmDelete('$aksi?module=poling&act=hapus&id={$r['id_poling']}')\" class='btn btn-danger btn-sm'>Hapus</button>
                        </td>
                      </tr>";
                $no++;
            }
            echo '</tbody></table>';
            break;

        case 'tambahpoling':
            echo '<h2>Tambah Poling</h2>
                  <form method="POST" action="'.$aksi.'?module=poling&act=input" class="mt-3">
                    <div class="mb-3">
                        <label class="form-label">Pilihan</label>
                        <input type="text" name="pilihan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Aktif</label><br>
                        <input type="radio" name="aktif" value="Y" checked> Ya
                        <input type="radio" name="aktif" value="N"> Tidak
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Batal</button>
                  </form>';
            break;

        case 'editpoling':
            $id = intval($_GET['id']);
            $edit = mysqli_query($conn, "SELECT * FROM poling WHERE id_poling='$id'");
            $r = mysqli_fetch_array($edit);

            echo '<h2>Edit Poling</h2>
                  <form method="POST" action="'.$aksi.'?module=poling&act=update" class="mt-3">
                    <input type="hidden" name="id" value="'.$r['id_poling'].'">
                    <div class="mb-3">
                        <label class="form-label">Pilihan</label>
                        <input type="text" name="pilihan" class="form-control" value="'.$r['pilihan'].'" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Aktif</label><br>
                        <input type="radio" name="aktif" value="Y" '.($r['aktif'] == 'Y' ? 'checked' : '').'> Ya
                        <input type="radio" name="aktif" value="N" '.($r['aktif'] == 'N' ? 'checked' : '').'> Tidak
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
