<?php
// Include the database connection
require 'koneksi.php';

$id = $_GET['id'];
$successMessage = "";
$errorMessage = "";

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated form data
    $id_admin = $_POST['id_admin'];
    $id_kamar = $_POST['id_kamar'];  // Get the selected room's ID
    $no_kamar = $_POST['no_kamar'];  // Get the selected room number
    $jumlah_orang = $_POST['jumlah_orang'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $tgl_checkin = $_POST['tgl_checkin'];  // Updated check-in date
    $tgl_checkout = $_POST['tgl_checkout'];  // Updated check-out date
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $nama_staf = $_POST['nama_staf'];

    // Update query
    try {
        $stmt = $pdo->prepare('UPDATE transaksi SET id_admin = ?, id_kamar = ?, no_kamar = ?, jumlah_orang = ?, nama_pelanggan = ?, no_telepon = ?, alamat_pelanggan = ?, tgl_checkin = ?, tgl_checkout = ?, harga = ?, keterangan = ?, nama_staf = ? WHERE id_transaksi = ?');
        $stmt->execute([$id_admin, $id_kamar, $no_kamar, $jumlah_orang, $nama_pelanggan, $no_telepon, $alamat_pelanggan, $tgl_checkin, $tgl_checkout, $harga, $keterangan, $nama_staf, $id]);

        // Set success message
        $successMessage = "Transaksi berhasil diperbarui!";
    } catch (PDOException $e) {
        // Set error message
        $errorMessage = "Terjadi kesalahan: " . $e->getMessage();
    }
}

// Fetch the current transaction data to pre-fill the form
$stmt = $pdo->prepare("SELECT * FROM transaksi WHERE id_transaksi = ?");
$stmt->execute([$id]);
$transaction = $stmt->fetch();

// Fetch the list of admins from the admin table
$admins = $pdo->query("SELECT id_admin, nama_admin FROM admin")->fetchAll();

// Fetch the list of rooms (with prices) from the kamar table
$rooms = $pdo->query("SELECT id_kamar, no_kamar, harga FROM kamar")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi - Puri Lembang</title>
    
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
        <h2>Edit Transaksi</h2>

        <!-- Display success or error message -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php elseif ($errorMessage): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Bootstrap Form for editing the transaction -->
        <div class="container mt-4">
            <form action="update.php?id=<?php echo $id; ?>" method="POST" class="row g-3">
                <!-- ID Admin Dropdown -->
                <div class="col-md-6">
                    <label for="id_admin" class="form-label">ID Admin</label>
                    <select id="id_admin" name="id_admin" class="form-select" required onchange="populateStaffName()">
                        <?php foreach ($admins as $admin): ?>
                            <option value="<?php echo $admin['id_admin']; ?>" 
                                    data-nama="<?php echo $admin['nama_admin']; ?>" 
                                    <?php echo ($transaction['id_admin'] == $admin['id_admin']) ? 'selected' : ''; ?>>
                                <?php echo $admin['id_admin']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <!-- Nama Staf (Auto-filled based on ID Admin) -->
                <div class="col-md-6">
                    <label for="nama_staf" class="form-label">Nama Staf</label>
                    <input type="text" id="nama_staf" name="nama_staf" class="form-control" value="<?php echo $transaction['nama_staf']; ?>" readonly required>
                </div>

                <!-- Jumlah Orang (Max 3) -->
                <div class="col-md-6">
                    <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                    <input type="number" id="jumlah_orang" name="jumlah_orang" class="form-control" value="<?php echo $transaction['jumlah_orang']; ?>" min="1" max="3" required onchange="updateHarga()">
                </div>

                <!-- Nama Pelanggan -->
                <div class="col-md-6">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" value="<?php echo $transaction['nama_pelanggan']; ?>" required>
                </div>

                <!-- No Telepon -->
                <div class="col-md-6">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="number" id="no_telepon" name="no_telepon" class="form-control" value="<?php echo $transaction['no_telepon']; ?>" required>
                </div>

                <!-- Alamat Pelanggan -->
                <div class="col-md-6">
                    <label for="alamat_pelanggan" class="form-label">Alamat Pelanggan</label>
                    <input type="text" id="alamat_pelanggan" name="alamat_pelanggan" class="form-control" value="<?php echo $transaction['alamat_pelanggan']; ?>" required>
                </div>

                <!-- No Kamar Dropdown -->
                <div class="col-md-6">
                    <label for="no_kamar" class="form-label">No Kamar</label>
                    <select id="no_kamar" name="no_kamar" class="form-select" required onchange="populateRoomIdAndPrice()">
                        <?php foreach ($rooms as $room): ?>
                            <option value="<?php echo $room['no_kamar']; ?>" data-harga="<?php echo $room['harga']; ?>" data-id="<?php echo $room['id_kamar']; ?>" <?php echo ($transaction['no_kamar'] == $room['no_kamar']) ? 'selected' : ''; ?>>
                                <?php echo $room['no_kamar']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- ID Kamar (Auto-filled based on No Kamar) -->
                <div class="col-md-6">
                    <label for="id_kamar" class="form-label">ID Kamar</label>
                    <input type="text" id="id_kamar" name="id_kamar" class="form-control" value="<?php echo $transaction['id_kamar']; ?>" readonly required>
                </div>

                <!-- Harga -->
                <div class="col-md-6">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" id="harga" name="harga" class="form-control" value="<?php echo $transaction['harga']; ?>" readonly required>
                </div>

                <!-- Tanggal Check-In -->
                <div class="col-md-6">
                    <label for="tgl_checkin" class="form-label">Tanggal Check-In</label>
                    <input type="date" id="tgl_checkin" name="tgl_checkin" class="form-control" value="<?php echo $transaction['tgl_checkin']; ?>" required>
                </div>

                <!-- Tanggal Check-Out -->
                <div class="col-md-6">
                    <label for="tgl_checkout" class="form-label">Tanggal Check-Out</label>
                    <input type="date" id="tgl_checkout" name="tgl_checkout" class="form-control" value="<?php echo $transaction['tgl_checkout']; ?>" required>
                </div>

                <!-- Keterangan -->
                <div class="col-md-12">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control" rows="3"><?php echo $transaction['keterangan']; ?></textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100">Update Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to update the room ID and price based on selected room
        function populateRoomIdAndPrice() {
            var selectedRoom = document.querySelector('#no_kamar option:checked');
            document.getElementById('id_kamar').value = selectedRoom.getAttribute('data-id');
            document.getElementById('harga').value = selectedRoom.getAttribute('data-harga');
        }

                // Function to update the staff name based on selected admin
        function populateStaffName() {
            var selectedAdmin = document.querySelector('#id_admin option:checked');
            document.getElementById('nama_staf').value = selectedAdmin.getAttribute('data-nama');
        }



        // Function to update price based on the number of guests
        function updateHarga() {
            var jumlahOrang = document.getElementById('jumlah_orang').value;
            var hargaPerOrang = parseInt(document.getElementById('harga').value, 10);
            document.getElementById('harga').value = hargaPerOrang * jumlahOrang;
        }
        
        // Trigger the initial population
        populateRoomIdAndPrice();
        populateStaffName();
    </script>
</body>
</html>
