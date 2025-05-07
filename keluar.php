<?php
session_start(); // Mulai session

// Hapus semua variabel dalam session
session_unset();

// Hapus session dari server
session_destroy();

// Hapus cookie session (jika ada)
setcookie(session_name(), '', time() - 3600, '/');

// Redirect ke halaman utama (index.php)
header("Location: index.php");
exit();
?>
