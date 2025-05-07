<?php
function sensor($teks, $conn)
{
    $w = mysqli_query($conn, "SELECT * FROM katajelek");

    while ($r = mysqli_fetch_assoc($w)) {
        $teks = str_ireplace($r['kata'], $r['ganti'], $teks);
    }

    return $teks;
}
