-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2024 pada 13.40
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `role`) VALUES
(1, 'ikhsan', 'ikhsan', 'ikhsan27', 'admin'),
(2, 'ikhsan', 'ikhsan@gokil.com', 'ikhsan', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `tipe_kamar` varchar(50) DEFAULT NULL,
  `bed` enum('Single Bed','Double Bed') NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `status_kamar` enum('tersedia','terisi') DEFAULT 'tersedia',
  `gambar` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `tipe_kamar`, `bed`, `harga`, `status_kamar`, `gambar`) VALUES
(53, 1, 'ac', 'Single Bed', 180000.00, 'terisi', 0x696d672f686f6d652f6578706c6f7265312e6a7067),
(54, 2, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(55, 3, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(56, 4, 'ac', 'Single Bed', 180000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265312e6a7067),
(57, 5, 'ac', 'Single Bed', 180000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d30352e6a706567),
(58, 6, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(59, 7, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(60, 8, 'ac', 'Double Bed', 180000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d30352e6a706567),
(61, 21, 'ac', 'Double Bed', 180000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d30352e6a706567),
(62, 22, 'kipas', 'Double Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d30352e6a706567),
(63, 23, 'kipas', 'Double Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d32332e6a706567),
(64, 24, 'kipas', 'Double Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d32332e6a706567),
(65, 25, 'kipas', 'Double Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d32332e6a706567),
(66, 26, 'kipas', 'Double Bed', 120000.00, 'terisi', 0x696d672f686f6d652f726f6f6d2d32332e6a706567),
(67, 31, 'ac', 'Single Bed', 165000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d33352e6a706567),
(68, 32, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(69, 33, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(70, 34, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(71, 35, 'ac', 'Single Bed', 165000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d33312e6a706567),
(72, 36, 'kipas', 'Single Bed', 120000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265322e6a7067),
(73, 201, 'ac', 'Double Bed', 200000.00, 'terisi', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(74, 202, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(75, 203, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(76, 204, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(77, 205, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(78, 206, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(79, 207, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(80, 208, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(81, 209, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3230392e6a706567),
(82, 210, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3230392e6a706567),
(83, 211, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3230392e6a706567),
(84, 301, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(85, 302, 'ac', 'Double Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f6578706c6f7265352e6a7067),
(86, 303, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3330332e6a706567),
(87, 304, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3330332e6a706567),
(88, 305, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3330332e6a706567),
(89, 306, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3330332e6a706567),
(90, 307, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3330332e6a706567),
(91, 308, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3330332e6a706567),
(92, 309, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3230392e6a706567),
(93, 310, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3230392e6a706567),
(94, 311, 'ac', 'Single Bed', 200000.00, 'tersedia', 0x696d672f686f6d652f726f6f6d2d3230392e6a706567);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pajak`
--

CREATE TABLE `pajak` (
  `id_pajak` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `jenis_kamar` enum('ac','kipas') NOT NULL,
  `pajak` varchar(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `pemasukan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pajak`
--

INSERT INTO `pajak` (`id_pajak`, `id_transaksi`, `tgl_checkin`, `tgl_checkout`, `jenis_kamar`, `pajak`, `potongan`, `pemasukan`) VALUES
(1, 6, '2024-11-29', '2024-11-30', 'kipas', '3', 5100, 164900),
(2, 7, '2024-11-14', '2024-11-15', 'ac', '5', 10000, 190000),
(3, 9, '2024-12-02', '2024-12-04', 'kipas', '3', 7200, 232800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_kamar` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('belum dibayar','dibayar','selesai') DEFAULT 'belum dibayar',
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `no_kamar` varchar(10) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `nama_staf` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_admin`, `id_kamar`, `jumlah_orang`, `nama_pelanggan`, `no_telepon`, `alamat_pelanggan`, `no_kamar`, `tgl_checkin`, `tgl_checkout`, `harga`, `keterangan`, `nama_staf`, `bukti_pembayaran`, `created_at`) VALUES
(2, 2, 69, 1, 'nunu', '087862799300', 'buttutala', '33', '2024-11-13', '2024-11-15', 240000, 'jangan digannggu', 'ikhsan', 'uploads/Logo.png', '2024-11-13 15:48:06'),
(4, 2, 86, 3, 'ikhsan', '085242606074', 'palece', '303', '2024-11-14', '2024-11-15', 250000, '', 'ikhsan', 'uploads/Logo.png', '2024-11-14 08:12:14'),
(5, 2, 55, 3, 'irfan', '09876543456789', 'campa', '3', '2024-11-29', '2024-11-30', 170000, 'ahahahaha', 'ikhsan', 'uploads/WhatsApp Image 2024-11-19 at 17.25.15.jpeg', '2024-11-30 16:15:05'),
(6, 2, 55, 3, 'irfan', '09876543456789', 'campa', '3', '2024-11-29', '2024-11-30', 170000, 'ahahahaha', 'ikhsan', 'uploads/WhatsApp Image 2024-11-19 at 17.25.15.jpeg', '2024-11-30 16:18:23'),
(7, 2, 73, 2, 'i putu andreana wirawan', '087862799300', 'salupangkang', '201', '2024-11-14', '2024-11-15', 200000, '', 'ikhsan', 'uploads/Logo.png', '2024-11-30 16:25:20'),
(9, 2, 55, 1, 'kjhgf', '09876543', 'lkjmynhtgbrvf', '3', '2024-12-02', '2024-12-04', 240000, '', 'ikhsan', 'uploads/WhatsApp Image 2024-11-19 at 17.07.32.jpeg', '2024-12-02 12:15:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indeks untuk tabel `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id_pajak`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id_pajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pajak`
--
ALTER TABLE `pajak`
  ADD CONSTRAINT `pajak_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
