<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php include "dina_titel.php"; ?></title>
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "dina_meta1.php"; ?>">
<meta name="keywords" content="<?php include "dina_meta2.php"; ?>">
<meta http-equiv="Copyright" content="bahrin">
<meta name="author" content="Bahrin dahlan">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="shortcut icon" href="Book.ico" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://localhost/detikcom/rss.xml" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="<?php echo "$f[folder]/style.css" ?>" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
  <div id="header">
    <!-- konten header -->
    <div class="header-content d-flex">
      <img src="<?php echo "$f[folder]/" ?>/images/logo.png" alt="">
      <div class="h-100 w-100">
        <h1 class="text-center fs-5 mt-4 fw-bold">PONDOK PESANTREN SALAFIYAH SYAFI'IYAH</h1>
        <p class="text-center">Situs Informasi Resmi Pondok Pesantren Salafiyyah Syafi'iyah</p>
      </div>
    </div>

    <!-- navbar -->
  <nav id="menuutama" class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">BERANDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil-kami.html">PROFIL</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="semua-agenda.html">AGENDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="semua-berita.html">BERITA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="semua-download.html">DOWNLOAD</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="semua-album.html">GALERI FOTO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="hubungi-kami.html">HUBUNGI KAMI</a>
            </li>
          </ul>
          <form class='align-items-end d-flex' role='search' method=POST action='hasil-pencarian.html'>
              <input name=kata class='form-control me-2' type='search' placeholder='Cari' aria-label='Search'>
              <button class='btn btn-outline-warning' type='submit'>Cari</button>
          </form>
        </div>
      </div>
    </nav>
  </div>

  <div id="leftcontent">
    <p>
      <?php include "tengah.php"; ?>
    </p>
  </div>
  <div id="middlecontent">
    <p>
      <?php include "kiri.php"; ?>
    </p>
  </div>
  <div id="rightcontent">
    <p>
      <?php include "kanan.php"; ?>
    </p>
  </div>
  <div id="clearer"></div>
  <div id="footer">Copyright &copy; 2012 by bahrin.com. All Rights Reserved.</div>
</div>

    <script src="https://kit.fontawesome.com/a0aa1a6901.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 
</body>
</html>
