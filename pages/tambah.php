<?php

require '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    $_SESSION['redirect_to'] = '../pages/tambah.php';
    header('Location: ../auth/login.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serial = trim($_POST['serial_number']);
    $nama = trim($_POST['nama']);
    $merk = trim($_POST['merk']);
    $status = $_POST['status'];
    $jumlah = (int) $_POST['jumlah'];
    $url_gambar = trim($_POST['url_gambar']);

    $query = "SELECT * FROM assets WHERE serial_number = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $serial);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Serial Number sudah terdaftar. Gunakan Serial Number yang berbeda.";
    } else {
        $query = "INSERT INTO assets (id_asset, serial_number, nama_alat, merk, status, jumlah, url_gambar) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssds", $serial, $nama, $merk, $status, $jumlah, $url_gambar);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Terjadi kesalahan saat menambahkan data.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Alat Multimedia — MAM</title>
    <meta name="description"
        content="Tambahkan unit kamera, lensa, atau aksesoris baru ke dalam inventaris multimedia.">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar bg-dark navbar-dark py-3">
        <div class="container-fluid d-flex justify-content-between align-items-center px-4">
            <a class="navbar-brand fw-bold" href="#">MAM.</a>

            <div class="d-flex align-items-center gap-3">
                <span class="text-white">
                    <i class="bi bi-person-circle me-1"></i>
                    <?= htmlspecialchars($_SESSION['username']) ?>
                </span>
                <a href="auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container py-4">

        <a href="../index.php"
            class="text-dark text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1 mb-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>

        <h1 class="fw-bold fs-3 mb-1">Registrasi Alat Multimedia</h1>
        <p class="text-muted small mb-4">Tambahkan unit kamera, lensa, atau aksesoris baru ke dalam inventaris.</p>

        <div class="row g-4 align-items-start">

            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <form method="POST" action="">

                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger d-flex align-items-center gap-2 py-2 mb-4" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span><?= htmlspecialchars($error) ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="serial_number" class="form-label fw-semibold small">Serial Number</label>
                                <input type="text" id="serial_number" name="serial_number" class="form-control"
                                    placeholder="Contoh: CAM-SONY-001" required
                                    value="<?= isset($_POST['serial_number']) ? htmlspecialchars($_POST['serial_number']) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold small">Nama Alat</label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Contoh: Sony Alpha a7 III Mirrorless" required
                                    value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label for="merk" class="form-label fw-semibold small">Merk</label>
                                <input type="text" id="merk" name="merk" class="form-control" placeholder="Contoh: Sony"
                                    required
                                    value="<?= isset($_POST['merk']) ? htmlspecialchars($_POST['merk']) : '' ?>">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label for="status" class="form-label fw-semibold small">Status Awal</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="" disabled <?= !isset($_POST['status']) ? 'selected' : '' ?>>Pilih
                                            Status</option>
                                        <option value="Tersedia" <?= (isset($_POST['status']) && $_POST['status'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                        <option value="Dipinjam" <?= (isset($_POST['status']) && $_POST['status'] == 'Dipinjam') ? 'selected' : '' ?>>Dipinjam</option>
                                        <option value="Maintenance" <?= (isset($_POST['status']) && $_POST['status'] == 'Maintenance') ? 'selected' : '' ?>>Maintenance</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="jumlah" class="form-label fw-semibold small">Jumlah Unit</label>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="1"
                                        min="1" required
                                        value="<?= isset($_POST['jumlah']) ? (int) $_POST['jumlah'] : 1 ?>">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="url_gambar" class="form-label fw-semibold small">Link Foto Perangkat
                                    (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-secondary">
                                        <i class="bi bi-image"></i>
                                    </span>
                                    <input type="url" id="url_gambar" name="url_gambar" class="form-control"
                                        placeholder="https://example.com/camera.jpg"
                                        value="<?= isset($_POST['url_gambar']) ? htmlspecialchars($_POST['url_gambar']) : '' ?>">
                                </div>
                                <div class="form-text">Gunakan URL gambar dari internet (Unsplash/Imgur).</div>
                            </div>

                            <button type="submit" id="btn-simpan"
                                class="btn btn-dark w-100 py-2 fw-semibold d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-cloud-arrow-up"></i>
                                Simpan Alat Multimedia
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">

                        <h2 class="fs-6 fw-bold mb-1 d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle-fill text-dark"></i>
                            Penomoran Asset
                        </h2>
                        <p class="text-muted small mb-3">
                            Format Serial Number (SN) untuk peralatan multimedia lab
                        </p>

                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge rounded-2 fw-bold"
                                    style="background-color:#1a1a2e;font-size:.7rem;letter-spacing:.5px;">CAM</span>
                                <span class="fw-semibold small">Kamera (Body/Kit)</span>
                            </div>
                            <p class="mb-1" style="font-size:.8rem;">
                                <span class="text-danger fw-semibold">CAM-</span><span
                                    class="text-danger fw-semibold">[MERK]</span>-<span
                                    class="text-danger fw-semibold">[NOMOR]</span>
                            </p>
                            <p class="text-muted mb-0" style="font-size:.8rem;">Contoh: SN-CAM-SONY-01</p>
                        </div>

                        <hr class="my-2">

                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge rounded-2 fw-bold bg-dark"
                                    style="font-size:.7rem;letter-spacing:.5px;">LNS</span>
                                <span class="fw-semibold small">Lensa &amp; Optik</span>
                            </div>
                            <p class="mb-1" style="font-size:.8rem;">
                                <span class="text-danger fw-semibold">LNS-</span><span
                                    class="text-danger fw-semibold">[MERK]</span>-<span
                                    class="text-danger fw-semibold">[JARAK]</span>
                            </p>
                            <p class="text-muted mb-0" style="font-size:.8rem;">Contoh: SN-LNS-CAN-50MM</p>
                        </div>

                        <hr class="my-2">

                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge rounded-2 fw-bold bg-dark"
                                    style="font-size:.7rem;letter-spacing:.5px;">DRN</span>
                                <span class="fw-semibold small">Drone &amp; Gimbal</span>
                            </div>
                            <p class="mb-1" style="font-size:.8rem;">
                                <span class="text-danger fw-semibold">DRN-</span><span
                                    class="text-danger fw-semibold">[MERK]</span>-<span
                                    class="text-danger fw-semibold">[NOMER]</span>
                            </p>
                            <p class="text-muted mb-0" style="font-size:.8rem;">Contoh: SN-DRN-DJI-05</p>
                        </div>

                        <div class="alert alert-primary d-flex align-items-start gap-2 py-2 px-3 mb-0 mt-3 small"
                            role="alert">
                            <i class="bi bi-lightbulb-fill mt-1 flex-shrink-0"></i>
                            <span>Pastikan SN unik untuk setiap unit agar pelacakan peminjaman lebih akurat.</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

</html>