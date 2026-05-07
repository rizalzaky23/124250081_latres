<?php
require '../config/koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $error = "Password tidak cocok.";
    } else {
        $query = "SELECT * FROM users WHERE username = ?";
        $statement = $koneksi->prepare($query);
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $error = "Username sudah terdaftar.";
        } else {
            $query = "INSERT INTO users (username, password) VALUES (?, ?)";
            $statement = $koneksi->prepare($query);
            $statement->bind_param("ss", $username, $password);

            if ($statement->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat mendaftar.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | MAM SYSTEM</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/auth.css">
</head>

<body>
    <main class="auth-main">
        <div class="login-card">
            <div class="login-box">
                <h2 class="fw-bold mb-0">MAM SYSTEM</h2>
                <h1 class="fs-4 fw-bold mb-1">Daftar Admin Baru</h1>
                <p class="subtitle text-muted mb-4">Silahkan mengisi data untuk membuat akun baru</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger text-center py-2" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control form-control-auth" placeholder="Buat username" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control form-control-auth" placeholder="Masukan Password" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-auth" placeholder="Masukan Ulang Password" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 mt-2">Daftar Sekarang</button>
                    <p class="text-center mt-4 text-muted small">
                        Sudah punya akun? <a href="login.php" class="link-dark fw-semibold">Masuk di sini</a>
                    </p>
                </form>
            </div>
        </div>

        <div class="image-container">
            <img src="../assets/img2.jpg" alt="Register Image">
            <h1>Capture Every Asset</h1>
            <p>Sistem Terpadu untuk monitoring kamera, lensa dan peralatan kreatuv </p>
        </div>
    </main>
</body>

</html>