<?php
require '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    $_SESSION['redirect_to'] = '../pages/detail.php';
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id_asset'];
    $query = "SELECT * FROM assets WHERE id_asset = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Asset</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar py-3" style="background-color:#1a1a2e;">
        <div class="container">
            <a href="../index.php" class="navbar-brand fw-bold text-white fs-5">MAM.</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary small">
                    <i class="bi bi-person-circle me-1"></i>
                    <?= htmlspecialchars($_SESSION['username']) ?>
                </span>
                <a href="../auth/logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container py-4">

        <a href="../index.php"
            class="text-dark text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1 mb-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>

        <div class="row justify-content-center">
            <div class="col-12 col-md-7 col-lg-5">

                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">

                    <img src="<?= htmlspecialchars($row['url_gambar']) ?>"
                         alt="<?= htmlspecialchars($row['nama_alat']) ?>"
                         class="w-100 object-fit-cover"
                         style="height:280px;">

                    <div class="card-body px-4 py-3">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-uppercase text-muted fw-semibold mb-1" style="font-size:.7rem;letter-spacing:.08em;">Serial Number</p>
                                <p class="fw-bold mb-0"><?= htmlspecialchars($row['serial_number']) ?></p>
                            </div>
                            <?php
                                $badgeClass = match($row['status']) {
                                    'Tersedia'    => 'bg-success',
                                    'Dipinjam'    => 'bg-info text-dark',
                                    'Maintenance' => 'bg-warning text-dark',
                                    default       => 'bg-secondary'
                                };
                            ?>
                            <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2"><?= htmlspecialchars($row['status']) ?></span>
                        </div>

                        <hr class="my-2">

                        <div class="mb-3">
                            <p class="text-uppercase text-muted fw-semibold mb-1" style="font-size:.7rem;letter-spacing:.08em;">Nama Asset / Model</p>
                            <p class="fw-bold mb-1"><?= htmlspecialchars($row['nama_alat']) ?></p>
                            <p class="text-muted small mb-0">Merk: <?= htmlspecialchars($row['merk']) ?></p>
                        </div>

                        <hr class="my-2">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-uppercase text-muted fw-semibold mb-1" style="font-size:.7rem;letter-spacing:.08em;">Ketersediaan Stok</p>
                                <p class="fw-bold mb-0"><?= (int)$row['jumlah'] ?> Unit</p>
                            </div>
                            <a href="edit.php?id_asset=<?= $row['id_asset'] ?>"
                               class="btn btn-dark btn-sm d-flex align-items-center gap-1">
                                <i class="bi bi-pencil-square"></i> Edit Data
                            </a>
                        </div>

                    </div>
                </div>

                <p class="text-center text-muted small mt-3">
                    ID Aset: #<?= str_pad($row['id_asset'], 5, '0', STR_PAD_LEFT) ?> | Terdaftar dalam sistem MAM.
                </p>

            </div>
        </div>

     </main>
</body>

</html>