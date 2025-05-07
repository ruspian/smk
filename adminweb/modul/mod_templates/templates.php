<?php
$aksi = "modul/mod_templates/aksi_templates.php";
$module = isset($_GET['module']) ? $_GET['module'] : '';
$act = isset($_GET['act']) ? $_GET['act'] : '';

echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">';

switch ($act) {
    // Tampil Templates
    default:
        echo "<div'>
                <div'>
                    <h2 class='mb-3'>Daftar Templates</h2>
                </div>
                <div class='card-body'>
                    <a href='?module=templates&act=tambahtemplates' class='btn btn-success mb-3'>Tambah Templates</a>
                    <div class='table-responsive'>
                        <table class='table table-striped table-hover'>
                            <thead class='table-dark'>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Templates</th>
                                    <th>Pembuat</th>
                                    <th>Folder</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>";

        $batas = 10;
        $halaman = isset($_GET['halaman']) ? intval($_GET['halaman']) : 1;
        $posisi = ($halaman - 1) * $batas;

        $query = "SELECT * FROM templates ORDER BY id_templates DESC LIMIT ?, ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $posisi, $batas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $no = $posisi + 1;
        while ($r = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>$no</td>
                    <td>" . htmlspecialchars($r['judul']) . "</td>
                    <td>" . htmlspecialchars($r['pembuat']) . "</td>
                    <td>" . htmlspecialchars($r['folder']) . "</td>
                    <td class='text-center'>" . htmlspecialchars($r['aktif']) . "</td>
                    <td>
                        <a href='?module=templates&act=edittemplates&id=" . intval($r['id_templates']) . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='$aksi?module=templates&act=aktifkan&id=" . intval($r['id_templates']) . "' class='btn btn-danger btn-sm'>Aktifkan</a>
                    </td>
                  </tr>";
            $no++;
        }
        echo "</tbody></table></div>";

        // Pagination
        $result_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM templates");
        $data_total = mysqli_fetch_assoc($result_total);
        $jmldata = $data_total['total'];
        $jmlhalaman = ceil($jmldata / $batas);

        echo "<nav>
                <ul class='pagination'>";
        for ($i = 1; $i <= $jmlhalaman; $i++) {
            $active = ($i == $halaman) ? "active" : "";
            echo "<li class='page-item $active'>
                    <a class='page-link' href='?module=templates&halaman=$i'>$i</a>
                  </li>";
        }
        echo "</ul>
              </nav>
              </div>
              </div>";
        break;

    // Form Tambah Templates
    case "tambahtemplates":
        echo "<div class='card shadow-sm'>
                <div class='card-header bg-success text-white'>
                    <h2 class='mb-0'>Tambah Templates</h2>
                </div>
                <div class='card-body'>
                    <form method='POST' action='$aksi?module=templates&act=input'>
                        <div class='mb-3'>
                            <label class='form-label'>Nama Templates</label>
                            <input type='text' name='judul' class='form-control' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Pembuat</label>
                            <input type='text' name='pembuat' class='form-control' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Folder</label>
                            <input type='text' name='folder' class='form-control' value='templates/' required>
                        </div>
                        <button type='submit' class='btn btn-primary'>Simpan</button>
                        <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
                    </form>
                </div>
              </div>";
        break;

    // Form Edit Templates 
    case "edittemplates":
        $id = intval($_GET['id']);
        $stmt = mysqli_prepare($conn, "SELECT * FROM templates WHERE id_templates = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $r = mysqli_fetch_assoc($result);

        echo "<div class='card shadow-sm'>
                <div class='card-header bg-warning text-white'>
                    <h2 class='mb-0'>Edit Templates</h2>
                </div>
                <div class='card-body'>
                    <form method='POST' action='$aksi?module=templates&act=update'>
                        <input type='hidden' name='id' value='" . intval($r['id_templates']) . "'>
                        <div class='mb-3'>
                            <label class='form-label'>Nama Templates</label>
                            <input type='text' name='judul' class='form-control' value='" . htmlspecialchars($r['judul']) . "' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Pembuat</label>
                            <input type='text' name='pembuat' class='form-control' value='" . htmlspecialchars($r['pembuat']) . "' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Folder</label>
                            <input type='text' name='folder' class='form-control' value='" . htmlspecialchars($r['folder']) . "' required>
                        </div>
                        <button type='submit' class='btn btn-primary'>Update</button>
                        <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
                    </form>
                </div>
              </div>";
        break;
}

echo '</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';
?>
