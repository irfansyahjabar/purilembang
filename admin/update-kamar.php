<?php
// Include the database connection
require 'koneksi.php';

// Fetch the room ID from the URL
$id = $_GET['id'];

// Fetch room data from the database
$stmt = $pdo->prepare("SELECT * FROM kamar WHERE id_kamar = ?");
$stmt->execute([$id]);
$room = $stmt->fetch();

if (!$room) {
    echo "Room not found!";
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $no_kamar = $_POST['no_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];
    $status_kamar = $_POST['status_kamar'];

    // Update query to modify the room details
    try {
        $stmt = $pdo->prepare('UPDATE kamar SET no_kamar = ?, tipe_kamar = ?, harga = ?, status_kamar = ? WHERE id_kamar = ?');
        $stmt->execute([$no_kamar, $tipe_kamar, $harga, $status_kamar, $id]);

        // Redirect back to the room list after successful update
        header("Location: index-kamar.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML Form for Editing Room -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar - Puri Lembang</title>
    
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
        <h2>Edit Kamar</h2>

        <!-- Bootstrap Form for editing the room -->
        <div class="container mt-4">
            <form action="update-kamar.php?id=<?php echo $id; ?>" method="POST" class="row g-3">
                <!-- No Kamar -->
                <div class="col-md-6">
                    <label for="no_kamar" class="form-label">No Kamar</label>
                    <input type="number" id="no_kamar" name="no_kamar" class="form-control" value="<?php echo $room['no_kamar']; ?>" required>
                </div>

                <!-- Tipe Kamar -->
                <div class="col-md-6">
                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                    <input type="text" id="tipe_kamar" name="tipe_kamar" class="form-control" value="<?php echo $room['tipe_kamar']; ?>" required>
                </div>

                <!-- Harga -->
                <div class="col-md-6">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" class="form-control" value="<?php echo $room['harga']; ?>" required>
                </div>

                <!-- Status Kamar -->
                <div class="col-md-6">
                    <label for="status_kamar" class="form-label">Status Kamar</label>
                    <select id="status_kamar" name="status_kamar" class="form-select" required>
                        <option value="tersedia" <?php echo $room['status_kamar'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="terisi" <?php echo $room['status_kamar'] == 'terisi' ? 'selected' : ''; ?>>Terisi</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <input type="submit" class="btn btn-success w-100" value="Update Kamar">
                </div>
            </form>

            <!-- Link to go back to the room list -->
            <a href="index-kamar.php" class="btn btn-primary mt-3">Kembali ke Daftar Kamar</a>
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
