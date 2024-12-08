<?php
// proses-transaksi.php

// Include the database connection
require 'koneksi.php';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id_admin = $_POST['id_admin'];
    $id_kamar = $_POST['id_kamar'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $no_kamar = $_POST['no_kamar'];
    $jam_checkin = $_POST['jam_checkin'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $nama_staf = $_POST['nama_staf'];

    try {
        // Prepare the SQL statement to insert the data into the 'transaksi' table
        $stmt = $pdo->prepare('INSERT INTO transaksi (id_admin, id_kamar, jumlah_orang, nama_pelanggan, no_telepon, alamat_pelanggan, no_kamar, jam_checkin, harga, keterangan, nama_staf)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

        // Bind the form data to the SQL query
        $stmt->execute([$id_admin, $id_kamar, $jumlah_orang, $nama_pelanggan, $no_telepon, $alamat_pelanggan, $no_kamar, $jam_checkin, $harga, $keterangan, $nama_staf]);

        // If the insert is successful, redirect or display a success message
        echo "Transaksi berhasil disimpan!";
    } catch (PDOException $e) {
        // Display error message if insertion fails
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
