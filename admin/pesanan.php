<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}



// Include koneksi database
require 'koneksi.php';

// Fetch data pesanan dari tabel pesanan dan kamar
$sql = "SELECT pesanan.*, kamar.no_kamar, kamar.tipe_kamar
        FROM pesanan
        JOIN kamar ON pesanan.id_kamar = kamar.id_kamar";

try {
    $stmt = $pdo->query($sql);
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Admin Dashboard</title>
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
        <h2>Daftar Pesanan</h2>

        <!-- Search Input -->
        <input type="text" id="searchInput" placeholder="Cari pesanan..." onkeyup="searchTable()">
        <br><br>

        <!-- Display Existing Orders -->
<table id="orderTable">
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Tipe Kamar</th>
            <th>Nomor Kamar</th>
            <th>Jumlah Penginap</th>
            <th>Tanggal Checkin</th>
            <th>Tanggal Checkout</th>
            <th>Harga Total</th>
            <th>Catatan</th>
            <th>Bukti Transfer</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($orders): ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id_pesanan']; ?></td>
                <td><?php echo $order['nama_pelanggan']; ?></td>
                <td><?php echo $order['alamat']; ?></td>
                <td><?php echo $order['tipe_kamar']; ?></td>
                <td><?php echo $order['no_kamar']; ?></td>
                <td><?php echo $order['jumlah_orang']; ?></td>
                <td><?php echo $order['tgl_checkin']; ?></td>
                <td><?php echo $order['tgl_checkout']; ?></td>
                <td>Rp <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></td>
                <td><?php echo $order['catatan']; ?></td>
                <td><a href="lihat_bukti.php?id=<?php echo $order['id_pesanan']; ?>" target="_blank">Lihat Bukti</a></td>
                <td>
                    <a href="konfirmasi_pesanan.php?id=<?php echo $order['id_pesanan']; ?>" onclick="return confirm('Yakin ingin mengonfirmasi pesanan ini?');">Konfirmasi Pesanan</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="12">Tidak ada pesanan ditemukan</td>
        </tr>
    <?php endif; ?>
</tbody>

</table>

    </div>

    <!-- Footer Section -->
    <footer>
        <p>© 2024 Puri Lembang. All Rights Reserved.</p>
    </footer>

    <!-- Search Script -->
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("orderTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>
