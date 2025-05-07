<?php
session_start();
include "../../../config/koneksi.php";

$module = $_GET['module'];
$act = $_GET['act'];

function anti_injection($conn, $data)
{
    return mysqli_real_escape_string($conn, strip_tags(htmlspecialchars($data, ENT_QUOTES)));
}

// Input user
if ($module == 'user' and $act == 'input') {
    $username = anti_injection($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_lengkap = anti_injection($conn, $_POST['nama_lengkap']);
    $email = anti_injection($conn, $_POST['email']);
    $no_telp = anti_injection($conn, $_POST['no_telp']);

    $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap, email, no_telp) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssss", $username, $password, $nama_lengkap, $email, $no_telp);
        if ($stmt->execute()) {
            header('location:../../media.php?module=' . $module); // Perbaikan jalur
        } else {
            echo "Terjadi kesalahan saat menambahkan user: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Terjadi kesalahan database: " . $conn->error;
    }
}

// Update user
elseif ($module == 'user' and $act == 'update') {
    $nama_lengkap = anti_injection($conn, $_POST['nama_lengkap']);
    $email = anti_injection($conn, $_POST['email']);
    $blokir = anti_injection($conn, $_POST['blokir']);
    $no_telp = anti_injection($conn, $_POST['no_telp']);
    $username = anti_injection($conn, $_POST['id']);

    // Periksa apakah id_session ada di database
    $query = $conn->prepare("SELECT id_session FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) { // Jika data ditemukan
        if (empty($_POST['password'])) {
            // Update tanpa password
            $stmt = $conn->prepare("UPDATE users SET nama_lengkap = ?, email = ?, blokir = ?, no_telp = ? WHERE username = ?");
            if ($stmt) {
                $stmt->bind_param("sssss", $nama_lengkap, $email, $blokir, $no_telp, $username);
                if ($stmt->execute()) {
                    header('location:../../media.php?module=' . $module); // Perbaikan jalur
                } else {
                    echo "Terjadi kesalahan saat memperbarui user: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Terjadi kesalahan database: " . $conn->error;
            }
        } else {
            // Update dengan password baru
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ?, nama_lengkap = ?, email = ?, blokir = ?, no_telp = ? WHERE username = ?");
            if ($stmt) {
                $stmt->bind_param("ssssss", $password, $nama_lengkap, $email, $blokir, $no_telp, $username);
                if ($stmt->execute()) {
                    header('location:../../media.php?module=' . $module); // Perbaikan jalur
                } else {
                    echo "Terjadi kesalahan saat memperbarui user dengan password baru: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Terjadi kesalahan database: " . $conn->error;
            }
        }
    } else {
        echo "User tidak ditemukan. Pastikan id_session yang dikirimkan benar.";
    }
}
?>
