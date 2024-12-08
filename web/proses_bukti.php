<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];

    // Proses unggah bukti
    $photo = $_FILES['photo'];
    $upload_dir = 'uploads/';
    $photo_name = $upload_dir . basename($photo['name']);
    move_uploaded_file($photo['tmp_name'], $photo_name);

    // Update status pesanan menjadi 'dibayar' dan simpan path bukti
    $stmt = $pdo->prepare("UPDATE pesanan SET status = 'dibayar', bukti_pembayaran = ? WHERE id_pesanan = ?");
    $stmt->execute([$photo_name, $order_id]);

    // Redirect ke halaman sukses
    header("Location: sukses.html");
    exit();
}
?>
