<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php
        $module = isset($_GET['module']) ? $_GET['module'] : 'home';

        switch ($module) {
            case 'home':
                echo "
                <div class='container mt-5 mb-5'>
                    <div class='row justify-content-center'>
                        <div class='col-md-12 '>
                            <div class='card shadow-lg border-0 animate__animated animate__fadeIn'>
                                <div class='card-body text-center'>
                                    <h2 class='text-success fw-bold'>
                                        <i class='bi bi-house-door-fill'></i> Selamat Datang
                                    </h2>
                                    <p class='mt-3'>
                                        Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator website bahrin.com.
                                        Silakan klik menu pilihan di sebelah kiri untuk mengelola konten website.
                                    </p>
                                    <hr>
                                    <p class='text-muted'>
                                        <i class='bi bi-calendar-event'></i> Login: " . tgl_indo(date("Y m d")) . " | " . date("H:i:s") . " WIB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
                break;

            case 'profil':
                include "modul/mod_profil/profil.php";
                break;

            case 'user':
                include "modul/mod_users/users.php";
                break;

            case 'modul':
                include "modul/mod_modul/modul.php";
                break;

            case 'kategori':
                include "modul/mod_kategori/kategori.php";
                break;

            case 'berita':
                include "modul/mod_berita/berita.php";
                break;

            case 'komentar':
                include "modul/mod_komentar/komentar.php";
                break;

            case 'tag':
                include "modul/mod_tag/tag.php";
                break;

            case 'agenda':
                include "modul/mod_agenda/agenda.php";
                break;

            case 'banner':
                include "modul/mod_banner/banner.php";
                break;

            case 'poling':
                include "modul/mod_poling/poling.php";
                break;

            case 'download':
                include "modul/mod_download/download.php";
                break;

            case 'hubungi':
                include "modul/mod_hubungi/hubungi.php";
                break;

            case 'templates':
                include "modul/mod_templates/templates.php";
                break;

            case 'shoutbox':
                include "modul/mod_shoutbox/shoutbox.php";
                break;

            case 'album':
                include "modul/mod_album/album.php";
                break;

            case 'galerifoto':
                include "modul/mod_galerifoto/galerifoto.php";
                break;

            case 'katajelek':
                include "modul/mod_katajelek/katajelek.php";
                break;

            default:
                echo "<div class='alert alert-danger'><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></div>";
                break;
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
