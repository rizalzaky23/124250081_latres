<?php
require '../config/koneksi.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $statement = $koneksi->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        if ($password == $user_data['password']) {
            $_SESSION['id_user'] = $user_data['id_user'];
            $_SESSION['username'] = $user_data['username'];
            $redirect_to = $_SESSION['redirect_to'] ?? '../index.php';
            unset($_SESSION['redirect_to']);
            header("Location: $redirect_to");
            exit;
        } else {
            $error = "Password yang Anda masukkan salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MAM SYSTEM</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/auth.css">
</head>

<body>
    <main class="auth-main">
        <div class="image-container">
            <img src="../assets/img1.jpg" alt="gambar-fotografer">
            <h1>MAM SYSTEM</h1>
        </div>

        <div class="login-card">
            <div class="login-box">
                <h2 class="fw-bold mb-1">Welcome Back</h2>
                <p class="subtitle text-muted mb-4">Silakan masuk ke akun MAM Anda</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger text-center py-2" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control form-control-auth" placeholder="username" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control form-control-auth" placeholder="Masukan Password" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mt-2">Masuk Sekarang</button>

                    <p class="text-center mt-4 text-muted small">
                        Belum Punya akun? <a href="register.php" class="link-dark fw-semibold">Daftar Akun</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>

</html>