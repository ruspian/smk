<link href="templates/building/style.css" rel="stylesheet" type="text/css" />

<?php
include "config/koneksi.php";

$shoutbox = mysqli_query($conn, "SELECT * FROM shoutbox WHERE aktif='Y' ORDER BY id_shoutbox DESC LIMIT 10");

echo "<div class='card border-primary mb-3'>
        <div class='card-header bg-primary text-white'>
          <i class='fa-solid fa-comments'></i> 
        </div>
        <div class='card-body p-3' style='max-height: 300px;'>";

while ($d = mysqli_fetch_array($shoutbox)) {
    $pesan = $d['pesan'];


    // Mengganti emotikon teks dengan Font Awesome
    // $emoticons = [
    //     ":-)"  => "<i class='fa-solid fa-smile text-warning'></i>",
    //     ":-("  => "<i class='fa-solid fa-frown text-primary'></i>",
    //     ";-)"  => "<i class='fa-solid fa-wink text-info'></i>",
    //     ";-D"  => "<i class='fa-solid fa-grin-squint text-success'></i>",
    //     ";;-)" => "<i class='fa-solid fa-kiss-wink-heart text-danger'></i>",
    //     "<:D>" => "<i class='fa-solid fa-grin-stars text-warning'></i>"
    // ];

    // foreach ($emoticons as $key => $icon) {
    //     $pesan = str_replace($key, $icon, $pesan);
    // }

    echo "<div class='d-flex align-items-start mb-2'>";
    
    // Nama pengguna sebagai bubble chat
    echo "<div class='p-2 rounded bg-light border w-100'>";
    
    
    // Nama pengguna dengan link jika ada website
    if (!empty($d['website'])) {
        echo "<strong><a href='http://{$d['website']}' target='_blank' class='text-decoration-none text-primary'>{$d['nama']}</a></strong>: ";
    } elseif (empty($d['pesan'])) {
        echo "<div class='text-muted text-center'>Belum ada chat</div>";
    }
    else {
        echo "<strong style='color: #1f7d53;'>{$d['nama']}</strong>: <br />";
    }

    echo "<span style='margin-left: 4px; color: black;'>$pesan</span>";

    echo "<div class='text-muted text-end' style='font-size: 8px; margin-top: 10px; margin-left: 93px; color: white; background-color: #1f7d53; border-radius: 2px;'>{$d['tanggal']}</div>";
    echo "<hr color=#e0cb91 noshade=noshade />";
    echo "</div></div>";
}

echo "  </div>
      </div>";
?>