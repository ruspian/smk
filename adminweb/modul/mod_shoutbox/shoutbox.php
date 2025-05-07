<?php
include __DIR__ . "../../../../config/koneksi.php";
$aksi = "modul/mod_shoutbox/aksi_shoutbox.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shoutbox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<?php
switch ($_GET['act'] ?? '') {
    default:
        echo "<h2 class='mb-3'>Shoutbox</h2>";
        echo "<table class='table table-striped table-hover'>
                <thead class='table-dark'>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>";

        $batas = 10;
        $posisi = ($_GET['halaman'] ?? 1 - 1) * $batas;

        $stmt = $conn->prepare("SELECT * FROM shoutbox ORDER BY id_shoutbox DESC LIMIT ?, ?");
        $stmt->bind_param("ii", $posisi, $batas);
        $stmt->execute();
        $result = $stmt->get_result();

        $no = $posisi + 1;
        while ($r = $result->fetch_assoc()) {
            echo "<tr>
                    <td>$no</td>
                    <td width='150'>{$r['nama']}</td>
                    <td width='290'>{$r['pesan']}</td>
                    <td class='text-center'>{$r['aktif']}</td>
                    <td>
                        <a href='?module=shoutbox&act=editshoutbox&id={$r['id_shoutbox']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='$aksi?module=shoutbox&act=hapus&id={$r['id_shoutbox']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                    </td>
                  </tr>";
            $no++;
        }
        echo "</tbody></table>";
        break;

    case "editshoutbox":
        $stmt = $conn->prepare("SELECT * FROM shoutbox WHERE id_shoutbox = ?");
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $r = $result->fetch_assoc();

        echo "<h2 class='mb-3'>Edit Shoutbox</h2>
              <form method='POST' action='$aksi?module=shoutbox&act=update' class='mb-4'>
                  <input type='hidden' name='id' value='{$r['id_shoutbox']}'>
                  <div class='mb-3'>
                      <label class='form-label'>Nama</label>
                      <input type='text' name='nama' class='form-control' value='{$r['nama']}' required>
                  </div>
                  <div class='mb-3'>
                      <label class='form-label'>Website</label>
                      <input type='text' name='website' class='form-control' value='{$r['website']}'>
                  </div>
                  <div class='mb-3'>
                      <label class='form-label'>Pesan</label>
                      <textarea name='pesan' class='form-control' rows='4' required>{$r['pesan']}</textarea>
                  </div>
                  <div class='mb-3'>
                      <label class='form-label'>Aktif</label>
                      <div class='form-check'>
                          <input class='form-check-input' type='radio' name='aktif' value='Y' " . ($r['aktif'] == 'Y' ? 'checked' : '') . ">
                          <label class='form-check-label'>Ya</label>
                      </div>
                      <div class='form-check'>
                          <input class='form-check-input' type='radio' name='aktif' value='N' " . ($r['aktif'] == 'N' ? 'checked' : '') . ">
                          <label class='form-check-label'>Tidak</label>
                      </div>
                  </div>
                  <button type='submit' class='btn btn-primary'>Update</button>
                  <button type='button' class='btn btn-secondary' onclick='history.back()'>Batal</button>
              </form>";
        break;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
