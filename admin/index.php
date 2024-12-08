<?php

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Include the database connection
require 'koneksi.php';

// Fetch existing transactions
$sql = "SELECT * FROM transaksi";
try {
    $stmt = $pdo->query($sql);
    $transactions = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Puri Lembang</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo-container">
            <img src="logo.png" alt="Puri Lembang Logo" class="logo">
            <h1>Puri Lembang</h1>
        </div>
        <div class="profile-container">
            <img href="profile.php" src="profile.png" alt="Admin Profile" class="profile-logo">
        </div>
    </header>

    <!-- Sidebar Section -->
<div class="sidebar">
    <ul>
        <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Dashboard</a></li>
        <li><a href="tambah-transaksi.php" class="<?php echo ($current_page == 'tambah-transaksi.php') ? 'active' : ''; ?>">Tambah Transaksi</a></li>
        <li><a href="index-kamar.php" class="<?php echo ($current_page == 'index-kamar.php') ? 'active' : ''; ?>">Kelola Kamar</a></li>
        <li><a href="pesanan.php" class="<?php echo ($current_page == 'pesanan.php') ? 'active' : ''; ?>">Pesanan</a></li>
        <li><a href="pengaturan.php" class="<?php echo ($current_page == 'pengaturan.php') ? 'active' : ''; ?>">Pengaturan</a></li>
    </ul>
</div>



    <!-- Main Content -->
    <div class="main-content">
    <h2>Daftar Transaksi</h2>

    <!-- Search Input -->
    <input type="text" id="searchInput" placeholder="Cari transaksi..." onkeyup="searchTable()">
    <br><br>

    <!-- Wrapper untuk Tabel dengan Scroll -->
    <div class="table-wrapper">
        <table id="transactionTable">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>ID Admin</th>
                    <th>ID Kamar</th>
                    <th>Jumlah Orang</th>
                    <th>Nama Pelanggan</th>
                    <th>No Telepon</th>
                    <th>Alamat Pelanggan</th>
                    <th>No Kamar</th>
                    <th>Tanggal Checkin</th> <!-- Updated -->
                    <th>Tanggal Checkout</th>
                    <th>Harga (Rp)</th>
                    <th>Keterangan</th>
                    <th>Nama Staf</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($transactions): ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo $transaction['id_transaksi']; ?></td>
                            <td><?php echo $transaction['id_admin']; ?></td>
                            <td><?php echo $transaction['id_kamar']; ?></td>
                            <td><?php echo $transaction['jumlah_orang']; ?></td>
                            <td><?php echo $transaction['nama_pelanggan']; ?></td>
                            <td><?php echo $transaction['no_telepon']; ?></td>
                            <td><?php echo $transaction['alamat_pelanggan']; ?></td>
                            <td><?php echo $transaction['no_kamar']; ?></td>
                            <td><?php echo $transaction['tgl_checkin']; ?></td>
                            <td><?php echo $transaction['tgl_checkout']; ?></td>
                            <td><?php echo $transaction['harga']; ?></td>
                            <td><?php echo $transaction['keterangan']; ?></td>
                            <td><?php echo $transaction['nama_staf']; ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $transaction['id_transaksi']; ?>">Edit</a>
                                <a href="delete.php?id=<?php echo $transaction['id_transaksi']; ?>" onclick="return confirmDelete();">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14">No transactions found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


    <!-- Footer Section -->
    <footer>
        <p>© 2024 Puri Lembang. All Rights Reserved.</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
