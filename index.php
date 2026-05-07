<?php

require 'config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
    $_SESSION['redirect_to'] = '../index.php';
    header('Location: auth/login.php');
    exit;
}

$query = "SELECT id_asset, serial_number, nama_alat, merk, status, jumlah FROM assets";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
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

    <main>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <h1>Inventaris Alat Multimedia</h1>
                    <p>Kelola Stok Kamera, Lensa, dan Aksesoris Studio</p>
                </div>
                <a href="pages/tambah.php" class="btn btn-dark btn-sm"><i class="bi bi-plus"></i> Tambah</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Serial Number</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Status</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <?php while($row = mysqli_fetch_assoc($result)) { 
                            if($row['status'] == "Tersedia"){
                                $tampil = "bg-success";
                                $tableTampil = "table-light";
                            }else if($row['status'] == "Dipinjam"){
                                $tampil = "bg-info";
                                $tableTampil = "table-info";
                            }else{
                                $tampil = "bg-warning";
                                $tableTampil = "table-warning";
                            }
                        ?>

                        <tbody>
                            <tr class="<?=$tableTampil?>">
                                <th scope="row"><?= $row['id_asset'] ?></th>
                                <td><?= $row['serial_number'] ?></td>
                                <td><?= $row['nama_alat'] ?></td>
                                <td><?=$row['merk']?></td>
                                <td><span class="badge <?=$tampil?>"><?=$row['status']?></span></td>
                                <td><?=$row['jumlah']?></td>
                                <td>
                                    <a href="pages/detail.php?id_asset=<?=$row['id_asset']?>" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="pages/update.php?id_asset=<?=$row['id_asset']?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <a href="pages/delete.php?id_asset=<?=$row['id_asset']?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>