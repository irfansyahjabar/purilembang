<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data kamar dari POST
    $id_kamar = $_POST['id_kamar'];
    $no_kamar = $_POST['no_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];

    // Simpan data kamar ke session
    $_SESSION['selected_room'] = [
        'id_kamar' => $id_kamar,
        'no_kamar' => $no_kamar,
        'tipe_kamar' => $tipe_kamar,
        'harga' => $harga
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Konfirmasi Pemesanan Kamar</h2>

    <?php if (isset($_SESSION['selected_room'])): ?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Kamar No: <?= $_SESSION['selected_room']['no_kamar']; ?></h5>
                <p><strong>Tipe:</strong> <?= ucfirst($_SESSION['selected_room']['tipe_kamar']); ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($_SESSION['selected_room']['harga'], 0, ',', '.'); ?></p>
                <p>Pastikan Anda telah memeriksa kamar yang dipilih sebelum melanjutkan pembayaran.</p>
                <form action="pembayaran.php" method="POST">
                    <button type="submit" class="btn btn-success">Konfirmasi dan Lanjutkan ke Pembayaran</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p>Tidak ada kamar yang dipilih.</p>
    <?php endif; ?>
</div>
</body>
</html>
