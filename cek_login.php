<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "config/koneksi.php"; // Pastikan koneksi database sudah benar

// **Pastikan CSRF Token Ada**
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// **Fungsi untuk menghindari SQL Injection**
function anti_injection($conn, $data) {
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data), ENT_QUOTES));
}

// **Cek apakah login atau daftar yang diproses**
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // **Cek CSRF Token**
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "CSRF detected! Akses ditolak.";
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = anti_injection($conn, $_POST['username']);
        $password = $_POST['password'];

        if (isset($_POST['nama_lengkap'])) {
            // **PROSES PENDAFTARAN**
            $nama_lengkap = anti_injection($conn, $_POST['nama_lengkap']);
            $email = anti_injection($conn, $_POST['email']);
            $no_telp = anti_injection($conn, $_POST['no_telp']);
            $level = anti_injection($conn, $_POST['level']);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $blokir = 'N';
            $id_session = session_id();

            // **Cek apakah username sudah ada**
            $cek_user = $conn->prepare("SELECT username FROM users WHERE username=?");
            $cek_user->bind_param("s", $username);
            $cek_user->execute();
            $cek_user->store_result();

            if ($cek_user->num_rows > 0) {
                $_SESSION['error'] = "Username sudah digunakan!";
                header("Location: index.php");
                exit();
            }

            // **Insert ke database**
            $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap, email, no_telp, level, blokir, id_session) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $username, $hashed_password, $nama_lengkap, $email, $no_telp, $level, $blokir, $id_session);

            if (!$stmt->execute()) {
                $_SESSION['error'] = "Pendaftaran gagal! " . $stmt->error;
                header("Location: index.php");
                exit();
            }

            $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
            header("Location: index.php");
            exit();
        } else {
            // **PROSES LOGIN**
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND blokir='N'");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $r = $result->fetch_assoc();

            if ($r) {
                if (password_verify($password, $r['password'])) {
                    $_SESSION['namauser'] = $r['username'];
                    $_SESSION['namalengkap'] = $r['nama_lengkap'];
                    $_SESSION['leveluser'] = $r['level'];
                    $_SESSION['timeout'] = time() + 3600; // Session timeout (1 jam)

                    // **Update session ID ke database**
                    $sid = session_id();
                    $stmt = $conn->prepare("UPDATE users SET id_session=? WHERE username=?");
                    $stmt->bind_param("ss", $sid, $username);
                    $stmt->execute();

                    // **Redirect ke dashboard**
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Password salah.";
                    header("Location: index.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Username tidak ditemukan.";
                header("Location: index.php");
                exit();
            }
        }
    }
}




$conn->close();
