<?php

function autolink($str) {
    // Autolink untuk URL dengan http/https
    $str = preg_replace(
        '/\b((https?:\/\/|www\.)[^\s<]+[a-z0-9])/i',
        '<a href="$1" target="_blank">$1</a>',
        $str
    );

    // Autolink untuk alamat email
    $str = preg_replace(
        '/\b([_\.0-9a-z-]+@[0-9a-z][0-9a-z-]+\.[a-z]{2,6})\b/i',
        '<a href="mailto:$1">$1</a>',
        $str
    );

    // Menambahkan "http://" jika hanya ada "www."
    $str = preg_replace(
        '/\b(www\.[^\s<]+[a-z0-9])/i',
        '<a href="http://$1" target="_blank">$1</a>',
        $str
    );

    return $str;
}
?>
