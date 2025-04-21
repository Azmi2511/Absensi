<?php
session_start();
include 'config/db.php'; // Menyertakan file koneksi database

// Jika pengguna sudah login, arahkan ke halaman dashboard
if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menghindari SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk memeriksa apakah pengguna ada di database dan status is_delete adalah 0 (aktif)
    $query = "SELECT * FROM users WHERE username = '$username' AND is_delete = 0 LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Memeriksa apakah password sesuai
        if (password_verify($password, $user['password'])) {
            // Menyimpan sesi login
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect ke halaman dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Username atau password salah!";
        }
    } else {
        $error_message = "Username tidak ditemukan atau akun telah dihapus!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Menambahkan background gradien */
        body {
            background: linear-gradient(to right, #4e73df, #1cc88a); /* Gradasi warna biru ke hijau */
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-6">
                <div class="card shadow-lg p-4 rounded-4 d-flex flex-row">
                    <!-- Kolom Kiri: Form Login -->
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <h3 class="text-center mb-4">Login</h3>

                        <?php
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger'>$error_message</div>";
                        }
                        ?>

                        <form action="dashboard.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 py-2 fs-5">Login</button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="register.php" class="text-decoration-none text-muted">Belum punya akun? Daftar di sini</a>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Gambar Logo -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <img src="images/logo.jpg" alt="Logo" class="img-fluid" style="max-width: 200px; height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
