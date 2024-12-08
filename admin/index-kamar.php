<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kamar - Puri Lembang</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
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
            <img src="profile.png" alt="Admin Profile" class="profile-logo">
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


    <!-- Main Content Section -->
    <div class="main-content">
        <h2>Kelola Kamar</h2>

        <!-- Button to add a new room -->
        <a href="tambah-kamar.php" class="btn btn-primary mb-3">Tambah Kamar</a>

        <div class="container mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Kamar</th>
                        <th>No Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Harga (Rp)</th>
                        <th>Status Kamar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection
                    require 'koneksi.php';

                    // Fetch all rooms from the kamar table
                    $stmt = $pdo->query("SELECT * FROM kamar");
                    $rooms = $stmt->fetchAll();

                    foreach ($rooms as $room):
                    ?>
                    <tr>
                        <td><?php echo $room['id_kamar']; ?></td>
                        <td><?php echo $room['no_kamar']; ?></td>
                        <td><?php echo $room['tipe_kamar']; ?></td>
                        <td><?php echo $room['harga']; ?></td>
                        <td><?php echo ucfirst($room['status_kamar']); ?></td> <!-- Display status_kamar -->
                        <td>
                            <a href="update-kamar.php?id=<?php echo $room['id_kamar']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete-kamar.php?id=<?php echo $room['id_kamar']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kamar ini?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>© 2024 Puri Lembang. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
