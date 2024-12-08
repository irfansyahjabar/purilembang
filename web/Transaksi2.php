<?php
session_start();
require 'koneksi.php'; // Koneksi ke database

// Ambil data pembayaran dari session dan POST
$selected_room = $_SESSION['selected_room'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$guest_count = $_POST['guest_count'];
$total_price = $_POST['total_price'];
$checkin_date = $_POST['checkin_date'];
$checkout_date = $_POST['checkout_date'];
$note = $_POST['note'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simpan data ke tabel pesanan sebelum mengunggah bukti
    $stmt = $pdo->prepare("INSERT INTO pesanan (id_kamar, nama_pelanggan, alamat, no_telepon, jumlah_orang, tgl_checkin, tgl_checkout, total_harga, catatan, status)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'belum dibayar')");
    $stmt->execute([
        $selected_room['id_kamar'], $name, $address, $phone, $guest_count, $checkin_date, $checkout_date, $total_price, $note
    ]);

    // Simpan ID pesanan untuk keperluan referensi ke halaman berikutnya
    $order_id = $pdo->lastInsertId();
    $_SESSION['order_id'] = $order_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seaplace Hotel - Pembayaran</title>
  <link rel="icon" href="img/favicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .card { margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px; max-width: 500px; }
    .card-title { text-align: center; }
    .main_menu { position: sticky; top: 0; z-index: 1000; background-color: white; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
  </style>
</head>
<body>
  <header class="header_area">
    <div class="header-top">
      <div class="container">
        <div class="d-flex align-items-center">
          <div id="logo">
            <a href="index.html"><img src="img/Logo.png" alt="" title="" /></a>
          </div>
        </div>
      </div>
    </div>
    <div class="main_menu mb-4">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="icon-bar"></span>
          </button>
        </div>
      </nav>
    </div>
  </header>

  <section class="transaction_area">
    <div class="container">
      <div class="card">
        <h5 class="card-title">Detail Pembayaran</h5>
        <p><strong>Nama:</strong> <?= htmlspecialchars($name); ?></p>
        <p><strong>No Kamar:</strong> <?= $selected_room['no_kamar']; ?></p>
        <p><strong>Tipe Kamar:</strong> <?= ucfirst($selected_room['tipe_kamar']); ?></p>
        <p><strong>Check-in:</strong> <?= $checkin_date; ?></p>
        <p><strong>Check-out:</strong> <?= $checkout_date; ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($total_price, 0, ',', '.'); ?></p>

        <!-- Informasi Bank -->
        <div class="card mt-3">
          <h5 style="text-align: center; color: #007bff;">Bank BRI</h5>
          <p style="text-align: center;">1234567890</p>
        </div>
        <div class="card mt-3">
          <h5 style="text-align: center; color: #007bff;">Bank BNI</h5>
          <p style="text-align: center;">1234567890</p>
        </div>

        <!-- Form Upload Bukti Transaksi -->
        <form action="proses_bukti.php" method="POST" enctype="multipart/form-data">
          <div class="form-group mt-4">
            <label for="photo">Unggah Bukti Transaksi</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
          </div>
          <input type="hidden" name="order_id" value="<?= $order_id; ?>">
          <button type="submit" class="btn btn-primary btn-block mt-3">Bayar Sekarang</button>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
