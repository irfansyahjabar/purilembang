<?php
// transactions.php
header('Content-Type: application/json');

// Include the database connection file
require 'koneksi.php';

try {
    // Prepare the SQL query to fetch all transaction data
    $stmt = $pdo->prepare('SELECT id_transaksi, nama_pelanggan, no_telepon, alamat_pelanggan, no_kamar, jam_checkin, harga, keterangan, nama_staf FROM transaksi');
    $stmt->execute();

    // Fetch the results as an associative array
    $transactions = $stmt->fetchAll();

    // Output the data in JSON format
    echo json_encode($transactions);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
