<?php
session_start();
require 'koneksi.php';

// Pastikan admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Ambil ID pesanan dari parameter URL
$id_pesanan = $_GET['id'];

// Ambil data pesanan
$stmt = $pdo->prepare("SELECT * FROM pesanan WHERE id_pesanan = ?");
$stmt->execute([$id_pesanan]);
$order = $stmt->fetch();

if ($order) {
    // Ambil tipe kamar dan no kamar berdasarkan id_kamar
    $stmt = $pdo->prepare("SELECT tipe_kamar, no_kamar FROM kamar WHERE id_kamar = ?");
    $stmt->execute([$order['id_kamar']]);
    $room = $stmt->fetch();

    if (!$room) {
        die("Error: Data kamar tidak ditemukan untuk id_kamar = {$order['id_kamar']}");
    }

    $tipe_kamar = $room['tipe_kamar'];
    $no_kamar = $room['no_kamar'];
    $total_harga = $order['total_harga'];

    // Hitung pajak berdasarkan tipe kamar
    $pajak_persen = ($tipe_kamar === 'kipas') ? 0.03 : 0.05; // 3% untuk kipas, 5% untuk AC
    $potongan = $total_harga * $pajak_persen;
    $pemasukan = $total_harga - $potongan;

    // Pindahkan data ke tabel transaksi
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
                keterangan, 
                nama_staf, 
                bukti_pembayaran
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['admin_id'], // ID admin yang mengonfirmasi
        $order['id_kamar'],
        $order['jumlah_orang'],
        $order['nama_pelanggan'],
        $order['no_telepon'],
        $order['alamat'],
        $no_kamar,
        $order['tgl_checkin'],
        $order['tgl_checkout'],
        $total_harga,
        $order['catatan'],
        $_SESSION['admin_name'],
        $order['bukti_pembayaran']
    ]);

    // Simpan data pajak ke tabel pajak
    $stmt = $pdo->prepare("INSERT INTO pajak (
                id_transaksi, 
                tgl_checkin, 
                tgl_checkout, 
                jenis_kamar, 
                pajak, 
                potongan, 
                pemasukan
            ) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $pdo->lastInsertId(), // ID transaksi terakhir
        $order['tgl_checkin'],
        $order['tgl_checkout'],
        $tipe_kamar,
        $pajak_persen * 100, // Pajak dalam persen (misal: 3% atau 5%)
        $potongan,
        $pemasukan
    ]);

    // Perbarui status kamar menjadi 'terisi'
    $stmt = $pdo->prepare("UPDATE kamar SET status_kamar = 'terisi' WHERE id_kamar = ?");
    $stmt->execute([$order['id_kamar']]);

    // Hapus data dari tabel pesanan
    $stmt = $pdo->prepare("DELETE FROM pesanan WHERE id_pesanan = ?");
    $stmt->execute([$id_pesanan]);

    // Redirect kembali ke halaman pesanan
    header('Location: pesanan.php');
    exit;
} else {
    echo "Pesanan tidak ditemukan.";
}
?>
