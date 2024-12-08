<?php
require 'koneksi.php';

// Periksa apakah form dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_admin = $_POST['id_admin'];
    $id_kamar = $_POST['id_kamar'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_telepon = $_POST['no_telepon'];
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $no_kamar = $_POST['no_kamar'];
    $tgl_checkin = $_POST['tgl_checkin'];
    $tgl_checkout = $_POST['tgl_checkout'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];

    try {
        // Simpan data transaksi ke tabel transaksi
        $stmt = $pdo->prepare("INSERT INTO transaksi (
            id_admin, 
            id_kamar, 
            jumlah_orang, 
            nama_pelanggan, 
            no_telepon, 
            alamat_pelanggan, 
            no_kamar, 
            tgl_checkin, 
            tgl_checkout, 
            harga, 
            keterangan
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $id_admin, 
            $id_kamar, 
            $jumlah_orang, 
            $nama_pelanggan, 
            $no_telepon, 
            $alamat_pelanggan, 
            $no_kamar, 
            $tgl_checkin, 
            $tgl_checkout, 
            $harga, 
            $keterangan
        ]);

        // Perbarui status kamar menjadi "terisi"
        $stmt = $pdo->prepare("UPDATE kamar SET status_kamar = 'terisi' WHERE id_kamar = ?");
        $stmt->execute([$id_kamar]);

        // Redirect kembali ke halaman index dengan pesan sukses
        header('Location: index.php?status=success');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika tidak ada data yang dikirimkan, kembalikan ke form tambah transaksi
    header('Location: tambah-transaksi.php');
    exit;
}
?>
