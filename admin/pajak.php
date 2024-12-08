<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Koneksi ke database
require 'koneksi.php';

// Ambil data pajak
$sql = "SELECT * FROM pajak";
try {
    $stmt = $pdo->query($sql);
    $pajak_data = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pajak - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container d-flex justify-content-between">
            <h1>Puri Lembang - Data Pajak</h1>
            <div class="profile-container">
                <a href="profile.php" class="text-white">Admin Profile</a>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="d-flex">
        <nav class="bg-light p-3" style="width: 250px; min-height: 100vh;">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="tambah-transaksi.php">Tambah Transaksi</a></li>
                <li class="nav-item"><a class="nav-link" href="index-kamar.php">Kelola Kamar</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan.php">Pesanan</a></li>
                <li class="nav-item"><a class="nav-link active" href="pajak.php">Data Pajak</a></li>
                <li class="nav-item"><a class="nav-link" href="pengaturan.php">Pengaturan</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="container-fluid p-4">
            <h2 class="mb-4">Data Pajak</h2>

            <!-- Tabel Pajak -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Pajak</th>
                            <th>ID Transaksi</th>
                            <th>Tanggal Check-in</th>
                            <th>Tanggal Check-out</th>
                            <th>Jenis Kamar</th>
                            <th>Pajak (%)</th>
                            <th>Potongan (Rp)</th>
                            <th>Pemasukan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($pajak_data): ?>
                            <?php foreach ($pajak_data as $pajak): ?>
                                <tr>
                                    <td><?php echo $pajak['id_pajak']; ?></td>
                                    <td><?php echo $pajak['id_transaksi']; ?></td>
                                    <td><?php echo $pajak['tgl_checkin']; ?></td>
                                    <td><?php echo $pajak['tgl_checkout']; ?></td>
                                    <td><?php echo ucfirst($pajak['jenis_kamar']); ?></td>
                                    <td><?php echo number_format($pajak['pajak'], 2); ?>%</td>
                                    <td>Rp <?php echo number_format($pajak['potongan'], 0, ',', '.'); ?></td>
                                    <td>Rp <?php echo number_format($pajak['pemasukan'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pajak</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3 mt-4">
        <p>© 2024 Puri Lembang. All Rights Reserved.</p>
    </footer>
</body>
</html>
