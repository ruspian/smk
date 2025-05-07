<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/a0aa1a6901.js" crossorigin="anonymous"></script>

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
        <?php
        if (isset($_SESSION['username'])) {
            echo "<div class='alert alert-success text-center'>
                    <i class='bi bi-check-circle-fill'></i> Anda sudah login sebagai <b>{$_SESSION['username']}</b>.
                  </div>
                  <div class='d-grid'>
                      <a href='media.php?module=home' class='btn btn-primary'><i class='bi bi-house-door'></i> Dashboard</a>
                      <a href='logout.php' class='btn btn-danger mt-2'><i class='bi bi-box-arrow-right'></i> Logout</a>
                  </div>";
        } else {
        ?>
        
        <!-- MENAMPILKAN ERROR JIKA ADA -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php } ?>
        
        <!-- FORM LOGIN -->
        <form name="login" action="cek_login.php" method="POST" class="flex-form">
          <div class="text-center">
            <p class="display-4"><i class="fa-solid fa-user-lock"></i></p>
            <h3 class="fw-bold text-success">Masuk</h3>
          </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            <button type="submit" class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
        </form>

        <?php } ?>
    </div>
</div>
</body>
</html>
