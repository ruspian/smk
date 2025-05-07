<?php
$aksi = "modul/mod_profil/aksi_profil.php";
$act = isset($_GET['act']) ? $_GET['act'] : ""; 

switch ($act) {
  default:
    $sql  = mysqli_query($conn, "SELECT * FROM modul WHERE id_modul='37'");
    $r    = mysqli_fetch_array($sql);
?>

<div class="container mt-4">
    <h2 class="mb-3">Profil</h2>
    <form method="POST" enctype="multipart/form-data" action="<?= $aksi ?>?module=profil&act=update">
        <input type="hidden" name="id" value="<?= $r['id_modul'] ?>">
        
        <div class="mb-3">
            <img src="../foto_banner/<?= $r['gambar'] ?>" class="img-fluid rounded" alt="Foto Profil">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Ganti Foto</label>
            <input type="file" class="form-control" name="fupload">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Deskripsi Profil</label>
            <textarea name="isi" class="form-control" rows="10"><?= $r['static_content'] ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php
    break;
}
?>
