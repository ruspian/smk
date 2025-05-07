<?php
session_start();
session_unset();
session_destroy();

// Buat ulang CSRF token agar aman
session_start();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

header("Location: index.php");
exit();
?>
