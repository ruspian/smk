<?php
function UploadImage($fupload_name) {
    // Tentukan direktori upload
    $vdir_upload = "../../foto_berita/";

    // Memastikan file berhasil diupload
    if ($_FILES['fupload']['error'] !== UPLOAD_ERR_OK) {
        die("Upload gagal, kode error: " . $_FILES['fupload']['error']);
    }

    // Tentukan path file upload
    $vfile_upload = $vdir_upload . $fupload_name;

    // Cek format file dengan finfo untuk keamanan
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['fupload']['tmp_name']);
    finfo_close($finfo);

    // Validasi format gambar
    if (!in_array($mime_type, ['image/jpeg', 'image/png', 'image/gif'])) {
        die("Format file tidak diperbolehkan. Hanya JPEG, PNG, dan GIF yang diterima.");
    }

    // Pindahkan file yang diupload
    if (!move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload)) {
        die("Gagal mengunggah file.");
    }

    // Resize gambar
    switch ($mime_type) {
        case 'image/jpeg':
            $im_src = imagecreatefromjpeg($vfile_upload);
            break;
        case 'image/png':
            $im_src = imagecreatefrompng($vfile_upload);
            break;
        case 'image/gif':
            $im_src = imagecreatefromgif($vfile_upload);
            break;
        default:
            die("Format gambar tidak dikenali.");
    }

    if (!$im_src) die("Gagal memproses gambar.");

    $src_width = imagesx($im_src);
    $src_height = imagesy($im_src);

    // Tentukan ukuran gambar kecil
    $dst_width = 110;
    $dst_height = ($dst_width / $src_width) * $src_height;

    $im = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

    // Simpan gambar kecil
    $thumb_file = $vdir_upload . "small_" . $fupload_name;
    switch ($mime_type) {
        case 'image/jpeg':
            imagejpeg($im, $thumb_file);
            break;
        case 'image/png':
            imagepng($im, $thumb_file);
            break;
        case 'image/gif':
            imagegif($im, $thumb_file);
            break;
    }

    // Bersihkan memori
    imagedestroy($im_src);
    imagedestroy($im);
}

function UploadBanner($fupload_name) {
    $vdir_upload = "../../foto_banner/";

    // Validasi error upload
    if ($_FILES['fupload']['error'] !== UPLOAD_ERR_OK) {
        die("Upload gagal, kode error: " . $_FILES['fupload']['error']);
    }

    // Tentukan path file upload
    $vfile_upload = $vdir_upload . $fupload_name;

    // Pindahkan file ke direktori tujuan
    if (!move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload)) {
        die("Gagal mengunggah file.");
    }
}

function UploadFile($fupload_name) {
    $vdir_upload = "../files";

    // Validasi error upload
    if ($_FILES['fupload']['error'] !== UPLOAD_ERR_OK) {
        die("Upload gagal, kode error: " . $_FILES['fupload']['error']);
    }

    // Tentukan path file upload
    $vfile_upload = $vdir_upload . $fupload_name;

    // Pindahkan file ke direktori tujuan
    if (!move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload)) {
        die("Gagal mengunggah file.");
    }
}

function UploadAlbum($nama_file, $lokasi_file) {
  $folder = "../foto_album";
  $ukuran_thumb = 150; // ukuran thumbnail

  $image_info = getimagesize($lokasi_file);
  $src = null;

  switch ($image_info['mime']) {
      case 'image/jpeg':
          $src = imagecreatefromjpeg($lokasi_file);
          break;
      case 'image/png':
          $src = imagecreatefrompng($lokasi_file);
          break;
      case 'image/gif':
          $src = imagecreatefromgif($lokasi_file);
          break;
      default:
          return false;
  }

  $width = $ukuran_thumb;
  $height = ($image_info[1] / $image_info[0]) * $ukuran_thumb;
  $thumb = imagecreatetruecolor($width, $height);

  imagecopyresampled($thumb, $src, 0, 0, 0, 0, $width, $height, $image_info[0], $image_info[1]);

  // Simpan versi kecil
  imagejpeg($thumb, $folder . "kecil_" . $nama_file);
  // Simpan versi asli
  move_uploaded_file($lokasi_file, $folder . $nama_file);

  imagedestroy($src);
  imagedestroy($thumb);

  return true;
}


function UploadGallery($fupload_name) {
  $vdir_upload = __DIR__ . '/../foto_galeri/';


  // Pastikan folder img_galeri ada
  if (!is_dir($vdir_upload)) {
      die("Direktori tujuan tidak ditemukan. ");
  }

  // Validasi error upload
  if ($_FILES['fupload']['error'] !== UPLOAD_ERR_OK) {
      die("Upload gagal, kode error: " . $_FILES['fupload']['error']);
  }

  // Cek ekstensi file
  $allowed_types = ['image/jpeg', 'image/png'];
  $tipe_file = mime_content_type($_FILES['fupload']['tmp_name']);
  if (!in_array($tipe_file, $allowed_types)) {
      die("Hanya file JPG dan PNG yang diperbolehkan.");
  }

  // Tentukan path tujuan
  $vfile_upload = rtrim($vdir_upload, '/') . '/' . $fupload_name;

  // Pindahkan file upload ke folder tujuan
  if (!move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload)) {
      die("Gagal mengunggah file.");
  }

  // Resize gambar
  if ($tipe_file === 'image/jpeg') {
      $im_src = imagecreatefromjpeg($vfile_upload);
  } elseif ($tipe_file === 'image/png') {
      $im_src = imagecreatefrompng($vfile_upload);
  } else {
      die("Format gambar tidak dikenali.");
  }

  $src_width = imagesx($im_src);
  $src_height = imagesy($im_src);

  // Tentukan ukuran thumbnail
  $dst_width = 100;
  $dst_height = ($dst_width / $src_width) * $src_height;

  $im = imagecreatetruecolor($dst_width, $dst_height);

  // Untuk PNG: atur transparansi
  if ($tipe_file === 'image/png') {
      imagealphablending($im, false);
      imagesavealpha($im, true);
  }

  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  // Simpan thumbnail
  if ($tipe_file === 'image/jpeg') {
      imagejpeg($im, rtrim($vdir_upload, '/') . '/kecil_' . $fupload_name, 85);
  } elseif ($tipe_file === 'image/png') {
      imagepng($im, rtrim($vdir_upload, '/') . '/kecil_' . $fupload_name);
  }

  // Bersihkan memori
  imagedestroy($im_src);
  imagedestroy($im);
}


?>
