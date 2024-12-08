<?php
session_start();

// Koneksi ke database
require 'koneksi.php'

// Jika data kamar dikirim melalui POST dari halaman sebelumnya
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['selected_room'] = [
        'id_kamar' => $_POST['id_kamar'],
        'no_kamar' => $_POST['no_kamar'],
        'tipe_kamar' => $_POST['tipe_kamar'],
        'harga' => $_POST['harga'],
        'bed' => $_POST['bed']
    ];
}

// Ambil data kamar yang dipilih dari session
$selected_room = isset($_SESSION['selected_room']) ? $_SESSION['selected_room'] : null;
$base_price = $selected_room['harga'] ?? 0; // Harga dasar per malam
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seaplace Hotel - Pembayaran</title>
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .card { margin: 20px auto; padding: 20px; max-width: 500px; border-radius: 8px; border: 1px solid #ddd; }
    .card-title { text-align: center; }
    #extraBedNotification { display: none; color: #ff0000; font-weight: bold; margin-top: 10px; }
    #totalPriceDisplay { font-size: 1.2em; font-weight: bold; color: #007bff; margin-top: 15px; }
  </style>
</head>
<body>
  <!-- Form Pembayaran Section -->
  <section class="transaction_area">
    <div class="container">
      <div class="card">
        <h5 class="card-title">Form Pembayaran</h5>
        
        <!-- Menampilkan detail kamar yang dipilih -->
        <?php if ($selected_room): ?>
          <div class="card-body">
            <p><strong>Kamar No:</strong> <?= $selected_room['no_kamar']; ?></p>
            <p><strong>Tipe:</strong> <?= ucfirst($selected_room['tipe_kamar']); ?></p>
            <p><strong>Harga per Malam:</strong> Rp <?= number_format($base_price, 0, ',', '.'); ?></p>
            <p><strong>Bed:</strong> <?= ($selected_room['bed'] == 'single') ? 'Single Bed' : 'Double Bed'; ?></p>
          </div>
        <?php endif; ?>

        <!-- Form untuk melengkapi informasi pembayaran -->
        <form action="transaksi2.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>

          <!-- Form Nomor Telepon -->
          <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
          </div>

          <div class="form-group">
            <label for="guest_count">Jumlah Orang (Max: 3)</label>
            <input type="number" class="form-control" id="guest_count" name="guest_count" min="1" max="3" required onchange="calculateTotalPrice()">
          </div>
          <p id="extraBedNotification">Jika jumlah tamu 3 orang, maka akan dikenakan biaya tambahan Rp 50,000 untuk extra bed.</p>

          <div class="form-group">
            <label for="checkin_date">Tanggal Cek In</label>
            <input type="date" class="form-control" id="checkin_date" name="checkin_date" required onchange="calculateTotalPrice()">
          </div>
          <div class="form-group">
            <label for="checkout_date">Tanggal Cek Out</label>
            <input type="date" class="form-control" id="checkout_date" name="checkout_date" required onchange="calculateTotalPrice()">
          </div>

          <p id="totalPriceDisplay">Total Harga: Rp 0</p>
          <input type="hidden" id="total_price" name="total_price" value="">

          <!-- Form Catatan -->
          <div class="form-group">
            <label for="note">Catatan</label>
            <textarea class="form-control" id="note" name="note" rows="3" placeholder="Tambahkan catatan atau permintaan khusus..."></textarea>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary w-100 mt-3">Lanjutkan ke Pembayaran</button>
        </form>
      </div>
    </div>
  </section>

  <script>
    const basePrice = <?= $base_price; ?>;

    function calculateTotalPrice() {
      const guestCount = parseInt(document.getElementById('guest_count').value);
      const checkinDate = new Date(document.getElementById('checkin_date').value);
      const checkoutDate = new Date(document.getElementById('checkout_date').value);
      const extraBedNotification = document.getElementById('extraBedNotification');
      const totalPriceDisplay = document.getElementById('totalPriceDisplay');
      const totalPriceInput = document.getElementById('total_price');

      const timeDifference = checkoutDate - checkinDate;
      const dayDifference = timeDifference / (1000 * 60 * 60 * 24);

      if (dayDifference <= 0 || isNaN(dayDifference)) {
        totalPriceDisplay.innerHTML = "Total Harga: Rp 0";
        totalPriceInput.value = 0;
        return;
      }

      let extraBedCharge = 0;
      if (guestCount === 3) {
        extraBedCharge = 50000;
        extraBedNotification.style.display = 'block';
      } else {
        extraBedNotification.style.display = 'none';
      }

      const totalPrice = (basePrice * dayDifference) + extraBedCharge;
      totalPriceDisplay.innerHTML = `Total Harga: Rp ${totalPrice.toLocaleString('id-ID')}`;
      totalPriceInput.value = totalPrice;
    }
  </script>
</body>
</html>
