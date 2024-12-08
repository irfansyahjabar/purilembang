<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Puri Lembang</title>
    
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
        <h2>Tambah Transaksi Baru</h2>

        <?php
        // Include the database connection
        require 'koneksi.php';

        // Fetch the list of admins from the admin table
        $stmt = $pdo->query("SELECT id_admin, nama_admin FROM admin");
        $admins = $stmt->fetchAll();

        // Fetch the list of rooms (with prices) from the kamar table
        $stmt = $pdo->query("SELECT id_kamar, no_kamar, harga FROM kamar");
        $rooms = $stmt->fetchAll();
        ?>

        <!-- Bootstrap Form for adding a new transaction -->
        <div class="container mt-4">
            <form action="create.php" method="POST" class="row g-3">
                <!-- ID Admin Dropdown -->
                <div class="col-md-6">
                    <label for="id_admin" class="form-label">ID Admin</label>
                    <select id="id_admin" name="id_admin" class="form-select" required onchange="populateAdminName()">
                        <option value="" disabled selected>Pilih ID Admin</option>
                        <?php foreach ($admins as $admin): ?>
                            <option value="<?php echo $admin['id_admin']; ?>">
                                <?php echo $admin['id_admin']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Nama Admin (Auto-filled based on ID Admin) -->
                <div class="col-md-6">
                    <label for="nama_admin" class="form-label">Nama Admin</label>
                    <input type="text" id="nama_admin" name="nama_admin" class="form-control" readonly required>
                </div>

                <!-- Jumlah Orang (Max 3) -->
                <div class="col-md-6">
                    <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                    <input type="number" id="jumlah_orang" name="jumlah_orang" class="form-control" min="1" max="3" required onchange="updateHarga()">
                </div>

                <!-- Nama Pelanggan -->
                <div class="col-md-6">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" required>
                </div>

                <!-- No Telepon -->
                <div class="col-md-6">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="number" id="no_telepon" name="no_telepon" class="form-control" required>
                </div>

                <!-- Alamat Pelanggan -->
                <div class="col-md-6">
                    <label for="alamat_pelanggan" class="form-label">Alamat Pelanggan</label>
                    <input type="text" id="alamat_pelanggan" name="alamat_pelanggan" class="form-control" required>
                </div>

                <!-- No Kamar Dropdown -->
                <div class="col-md-6">
                    <label for="no_kamar" class="form-label">No Kamar</label>
                    <select id="no_kamar" name="no_kamar" class="form-select" required onchange="populateRoomIdAndPrice()">
                        <option value="" disabled selected>Pilih No Kamar</option>
                        <?php foreach ($rooms as $room): ?>
                            <option value="<?php echo $room['no_kamar']; ?>" data-harga="<?php echo $room['harga']; ?>" data-id="<?php echo $room['id_kamar']; ?>">
                                <?php echo $room['no_kamar']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- ID Kamar (Auto-filled based on No Kamar) -->
                <div class="col-md-6">
                    <label for="id_kamar" class="form-label">ID Kamar</label>
                    <input type="text" id="id_kamar" name="id_kamar" class="form-control" readonly required>
                </div>

                <!-- Tanggal Checkin -->
                <div class="col-md-6">
                    <label for="tgl_checkin" class="form-label">Tanggal Checkin</label>
                    <input type="date" id="tgl_checkin" name="tgl_checkin" class="form-control" required onchange="updateHarga()">
                </div>

                <!-- Tanggal Checkout -->
                <div class="col-md-6">
                    <label for="tgl_checkout" class="form-label">Tanggal Checkout</label>
                    <input type="date" id="tgl_checkout" name="tgl_checkout" class="form-control" required onchange="updateHarga()">
                </div>

                <!-- Harga (Auto-filled) -->
                <div class="col-md-6">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" class="form-control" readonly required>
                </div>

                <!-- Keterangan -->
                <div class="col-md-6">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-select" required>
                        <option value="lunas">Lunas</option>
                        <option value="tidak lunas">Tidak Lunas</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <input type="submit" class="btn btn-success w-100" value="Simpan Transaksi">
                    
                </div>
            </form>

            <!-- Link to go back to the index page -->
            <a href="index.php" class="btn btn-primary mt-3">Kembali ke Daftar Transaksi</a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>© 2024 Puri Lembang. All Rights Reserved.</p>
    </footer>

    <!-- JavaScript for auto-filling Nama Admin, ID Kamar, and Harga -->
    <script>
        // Store the admin data from PHP in a JavaScript object
        const adminData = <?php echo json_encode($admins); ?>;

        // Function to auto-populate the 'nama_admin' field based on the selected ID Admin
        function populateAdminName() {
            const idAdminSelect = document.getElementById('id_admin');
            const namaAdminInput = document.getElementById('nama_admin');
            
            // Find the selected admin's name and fill it in the 'nama_admin' input
            const selectedIdAdmin = idAdminSelect.value;
            const selectedAdmin = adminData.find(admin => admin.id_admin == selectedIdAdmin);
            
            if (selectedAdmin) {
                namaAdminInput.value = selectedAdmin.nama_admin;
            } else {
                namaAdminInput.value = '';
            }
        }

        // Function to auto-populate the 'id_kamar' and 'harga' based on the selected No Kamar
        function populateRoomIdAndPrice() {
            const noKamarSelect = document.getElementById('no_kamar');
            const idKamarInput = document.getElementById('id_kamar');
            const hargaInput = document.getElementById('harga');
            
            // Get the selected option
            const selectedOption = noKamarSelect.options[noKamarSelect.selectedIndex];
            const selectedIdKamar = selectedOption.getAttribute('data-id');
            const selectedHarga = selectedOption.getAttribute('data-harga');
            
            // Set the ID Kamar and Harga
            idKamarInput.value = selectedIdKamar;
            hargaInput.value = selectedHarga;

            // Update the price based on the number of people and stay duration
            updateHarga();
        }

        // Function to update the price based on the selected room, number of people, and days of stay
        function updateHarga() {
            const hargaInput = document.getElementById('harga');
            const jumlahOrangInput = document.getElementById('jumlah_orang');
            const tglCheckinInput = document.getElementById('tgl_checkin');
            const tglCheckoutInput = document.getElementById('tgl_checkout');
            const noKamarSelect = document.getElementById('no_kamar');
            
            // Get the base price from the selected room
            const selectedOption = noKamarSelect.options[noKamarSelect.selectedIndex];
            const basePrice = parseInt(selectedOption.getAttribute('data-harga') || 0);

            // Get the number of people
            const jumlahOrang = parseInt(jumlahOrangInput.value) || 0;

            // Calculate the number of days between check-in and check-out
            const checkinDate = new Date(tglCheckinInput.value);
            const checkoutDate = new Date(tglCheckoutInput.value);
            const timeDiff = checkoutDate - checkinDate;
            const numberOfDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)) || 1;

            // Calculate the new price
            let totalPrice = basePrice * numberOfDays; // Multiply base price by the number of days

            // Add Rp.50.000,00 if 3 people
            if (jumlahOrang === 3) {
                totalPrice += 50000;
            }

            // Update the price in the input
            hargaInput.value = totalPrice;
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
