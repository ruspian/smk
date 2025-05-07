<?php
$aksi = "modul/mod_kategori/aksi_kategori.php";
$act = isset($_GET['act']) ? $_GET['act'] : ''; // Cek apakah $_GET['act'] ada

echo "<h2 class='my-3'>Kategori</h2>";
echo "<button class='btn btn-success mb-3' onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">Tambah Kategori</button>";

echo "<table class='table table-striped'>
        <thead class='table-dark'>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>";

$tampil = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");
$no = 1;
while ($r = mysqli_fetch_array($tampil)) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$r['nama_kategori']}</td>
            <td>
                <a href='?module=kategori&act=editkategori&id={$r['id_kategori']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='{$aksi}?module=kategori&act=hapus&id={$r['id_kategori']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus kategori ini?\")'>Hapus</a>
            </td>
          </tr>";
    $no++;
}
echo "</tbody></table>";

// Form Tambah Kategori
if ($act == "tambahkategori") {
    echo "<h2 class='my-3'>Tambah Kategori</h2>
          <form method='POST' action='{$aksi}?module=kategori&act=input' class='w-50'>
            <div class='mb-3'>
                <label for='nama_kategori' class='form-label'>Nama Kategori</label>
                <input type='text' name='nama_kategori' id='nama_kategori' class='form-control' required>
            </div>
            <button type='submit' class='btn btn-success'>Simpan</button>
            <button type='button' class='btn btn-secondary' onclick='self.history.back()'>Batal</button>
          </form>";
}

// Form Edit Kategori
if ($act == "editkategori") {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $edit = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$id'");
        $r = mysqli_fetch_array($edit);

        echo "<h2 class='my-3'>Edit Kategori</h2>
              <form method='POST' action='{$aksi}?module=kategori&act=update' class='w-50'>
                <input type='hidden' name='id' value='{$r['id_kategori']}'>
                <div class='mb-3'>
                    <label for='nama_kategori' class='form-label'>Nama Kategori</label>
                    <input type='text' name='nama_kategori' id='nama_kategori' class='form-control' value='{$r['nama_kategori']}' required>
                </div>
                <button type='submit' class='btn btn-primary'>Update</button>
                <button type='button' class='btn btn-secondary' onclick='self.history.back()'>Batal</button>
              </form>";
    } else {
        echo "<p class='alert alert-danger'>ID Kategori tidak ditemukan!</p>";
    }
}
?>
