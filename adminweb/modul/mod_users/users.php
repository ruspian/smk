<?php
$aksi = "modul/mod_users/aksi_users.php";
$act = isset($_GET['act']) ? $_GET['act'] : "";

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <?php
        switch ($act) {
            default:
                echo "<h2 class='mb-3'>User</h2>";
                if ($_SESSION['leveluser'] == 'admin') {
                    echo "<a href='?module=user&act=tambahuser' class='btn btn-success mb-3'>Tambah User</a>";
                    $tampil = mysqli_query($conn, "SELECT * FROM users ORDER BY username");
                } else {
                    $tampil = mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[namauser]'");
                }
                echo "<table class='table table-bordered table-striped'>
                        <thead class='table-dark'>
                            <tr><th>No</th><th>Username</th><th>Nama Lengkap</th><th>Email</th><th>No. Telp</th><th>Blokir</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>";
                $no = 1;
                while ($r = mysqli_fetch_array($tampil)) {
                    echo "<tr>
                            <td>$no</td>
                            <td>$r[username]</td>
                            <td>$r[nama_lengkap]</td>
                            <td><a href='mailto:$r[email]'>$r[email]</a></td>
                            <td>$r[no_telp]</td>
                            <td class='text-center'>$r[blokir]</td>
                            <td><a href='?module=user&act=edituser&id=$r[id_session]' class='btn btn-warning btn-sm'>Edit</a></td>
                          </tr>";
                    $no++;
                }
                echo "</tbody></table>";
                break;
            
            case "tambahuser":
                echo "<h2>Tambah User</h2>
                      <form method='POST' action='$aksi?module=user&act=input' class='w-50'>
                          <div class='mb-3'><label class='form-label'>Username</label><input type='text' name='username' class='form-control'></div>
                          <div class='mb-3'><label class='form-label'>Password</label><input type='text' name='password' class='form-control'></div>
                          <div class='mb-3'><label class='form-label'>Nama Lengkap</label><input type='text' name='nama_lengkap' class='form-control'></div>
                          <div class='mb-3'><label class='form-label'>E-mail</label><input type='text' name='email' class='form-control'></div>
                          <div class='mb-3'><label class='form-label'>No. Telp/HP</label><input type='text' name='no_telp' class='form-control'></div>
                          <button type='submit' class='btn btn-success'>Simpan</button>
                          <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
                      </form>";
                break;
            
            case "edituser":
                $edit = mysqli_query($conn, "SELECT * FROM users WHERE id_session='$_GET[id]'");
                $r = mysqli_fetch_array($edit);
                echo "<h2>Edit User</h2>
                      <form method='POST' action='$aksi?module=user&act=update' class='w-50'>
                          <input type='hidden' name='id' value='$r[username]'>
                          <div class='mb-3'><label class='form-label'>Username</label><input type='text' class='form-control' value='$r[username]' disabled></div>
                          <div class='mb-3'><label class='form-label'>Password</label><input type='text' name='password' class='form-control'></div>
                          <div class='mb-3'><label class='form-label'>Nama Lengkap</label><input type='text' name='nama_lengkap' class='form-control' value='$r[nama_lengkap]'></div>
                          <div class='mb-3'><label class='form-label'>E-mail</label><input type='text' name='email' class='form-control' value='$r[email]'></div>
                          <div class='mb-3'><label class='form-label'>No. Telp/HP</label><input type='text' name='no_telp' class='form-control' value='$r[no_telp]'></div>
                          <div class='mb-3'><label class='form-label'>Blokir</label>
                              <div class='form-check'>
                                  <input type='radio' name='blokir' value='Y' class='form-check-input' " . ($r['blokir'] == 'Y' ? 'checked' : '') . "> Y
                              </div>
                              <div class='form-check'>
                                  <input type='radio' name='blokir' value='N' class='form-check-input' " . ($r['blokir'] == 'N' ? 'checked' : '') . "> N
                              </div>
                          </div>
                          <button type='submit' class='btn btn-warning'>Update</button>
                          <a href='javascript:history.back()' class='btn btn-secondary'>Batal</a>
                      </form>";
                break;
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>