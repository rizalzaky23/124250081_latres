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
    <link rel="stylesheet" href="../css/auth.css">
</head>

<body>
    <main>
        <div class="login-card">
            <div class="login-box">
                <h2>MAM SYSTEM</h2>
                <h1>Daftar Admin Baru</h1>
                <p class="subtitle">Silahkan mengisi data untuk membuat akun baru</p>

                <?php if ($error): ?>
                    <div class="error-msg"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Buat username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="confirm_password" placeholder="Masukan Ulang Password" required>
                    </div>

                    <button type="submit">Daftar Sekarang</button>
                    <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
                </form>
            </div>
        </div>

        <div class="image-container">
            <img src="../assets/img2.png" alt="Register Image">
        </div>
    </main>
</body>

</html>