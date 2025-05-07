<?php
session_start();
include "../config/koneksi.php";

// Generate CSRF Token jika belum ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function anti_injection($conn, $data)
{
    return mysqli_real_escape_string($conn, strip_tags(htmlspecialchars($data, ENT_QUOTES)));
}

$error = "";

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah semua data yang diperlukan ada
    if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['csrf_token'])) {
        $error = "Data login tidak lengkap!";
    } else {
        $username = anti_injection($conn, $_POST['username']);
        $password = $_POST['password'];
        $csrf_token = $_POST['csrf_token'];

        // Validasi CSRF Token
        if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
            $error = "Token CSRF tidak valid!";
        } else {
            // Gunakan prepared statement untuk mencegah SQL injection
            $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND blokir = 'N'");
            if ($query) {
                $query->bind_param("s", $username);
                if ($query->execute()) {
                    $result = $query->get_result();
                    $user = $result->fetch_assoc();

                    // Verifikasi password
                    if ($user && password_verify($password, $user['password'])) {
                        // Regenerasi ID sesi untuk mencegah session fixation
                        session_regenerate_id(true);

                        $_SESSION['namauser'] = $user['username'];
                        $_SESSION['namalengkap'] = $user['nama_lengkap'];
                        $_SESSION['leveluser'] = $user['level'];

                        $sid = session_id();
                        $update = $conn->prepare("UPDATE users SET id_session = ? WHERE username = ?");
                        if ($update) {
                            $update->bind_param("ss", $sid, $username);
                            if ($update->execute()) {
                                // Redirect ke halaman dashboard setelah berhasil login
                                header("Location: media.php?module=home");
                                exit();
                            } else {
                                // Kesalahan saat memperbarui sesi
                                $error = "Terjadi kesalahan saat memperbarui sesi.";
                                error_log("Error updating session: " . $update->error);
                            }
                            $update->close();
                        } else {
                            // Kesalahan dengan prepared statement update
                            $error = "Terjadi kesalahan database.";
                            error_log("Error preparing update statement: " . $conn->error);
                        }
                    } else {
                        $error = "Username atau password salah!";
                    }
                } else {
                    // Kesalahan saat menjalankan query SELECT
                    $error = "Terjadi kesalahan saat memproses login.";
                    error_log("Error executing query: " . $query->error);
                }
                $query->close();
            } else {
                // Kesalahan dengan prepared statement SELECT
                $error = "Terjadi kesalahan database.";
                error_log("Error preparing select statement: " . $conn->error);
            }
        }
    }
}
?>


