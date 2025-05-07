<?php
session_start();

// Periksa apakah pengguna sudah login
if (empty($_SESSION['namauser'])) {
    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href='index.php' class='btn btn-primary'><b>LOGIN</b></a></center>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-success px-3">
        <a class="navbar-brand fw-bold text-uppercase" href="#">Admin Panel</a>
        <a href="logout.php" class="btn btn-light">Logout</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="btn btn-success active mb-3 mt-3" href="?module=home">Home</a>
                    </li>
                    <?php include "menu.php"; ?>
                </ul>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <?php include "content.php"; ?>
            </main>
        </div>
    </div>

    <footer class="bg-light text-center py-3 mt-4">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> by bahrin.com. All rights reserved.</p>
    </footer>
</body>
</html>