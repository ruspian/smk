<?php
session_start(); // HARUS di awal sebelum output HTML

// Cek apakah sudah login
if (isset($_SESSION['namauser'])) {
    header("Location: media.php?module=home");
    exit();
}

// Pastikan CSRF token ada
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Daftar</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/a0aa1a6901.js" crossorigin="anonymous"></script>

    <script>
        function toggleForm() {
            let loginForm = document.getElementById("loginForm");
            let daftarForm = document.getElementById("daftarForm");
            let toggleText = document.getElementById("toggleText");

            if (loginForm.style.display === "none") {
                loginForm.style.display = "block";
                daftarForm.style.display = "none";
                toggleText.innerHTML = "Belum punya akun? <a href='#' class='link-warning' onclick='toggleForm()'>Daftar di sini</a>";
            } else {
                loginForm.style.display = "none";
                daftarForm.style.display = "flex";
                toggleText.innerHTML = "Sudah punya akun? <a href='#' class='link-success' onclick='toggleForm()'>Login di sini</a>";
            }
        }
    </script>

    <style>
        .flex-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .flex-form .form-control {
            width: 100%;
        }
    </style>
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 350px;">
        <!-- MENAMPILKAN ERROR JIKA ADA -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php } ?>

        <!-- FORM LOGIN -->
        <form id="loginForm" name="login" action="cek_login.php" method="POST" class="flex-form">
          <div class="text-center">
            <p class="display-4"><i class="fa-solid fa-user-lock"></i></p>
            <h3 class="fw-bold text-success">Masuk</h3>
          </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required autocomplete="off">
            <button type="submit" class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
        </form>

        <!-- FORM DAFTAR -->
        <form id="daftarForm" name="daftar" action="cek_login.php" method="POST" class="flex-form" style="display: none;">
          <div class="text-center">
            <p class="fw-bold fs-4"><i class="fa-solid fa-user-lock"></i> Daftar</p>
          </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
            <input type="text" name="username" class="form-control" placeholder="Buat username" required>
            <input type="password" name="password" class="form-control" placeholder="Buat password" required autocomplete="off">
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap" required>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            <input type="text" name="no_telp" class="form-control" placeholder="Masukkan nomor telepon" required>
            <input type="hidden" name="level" value="user">  <!-- Perbaikan di sini -->
            <button type="submit" class="btn btn-warning w-100"><i class="bi bi-person-plus"></i> Daftar</button>
        </form>

        <p id="toggleText" class="text-center mt-3">
            Belum punya akun? <a href="#" class="link-success" onclick="toggleForm()">Daftar di sini</a>
        </p>
    </div>
</div>
</body>
</html>
