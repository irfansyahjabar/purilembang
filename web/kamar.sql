-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2024 pada 21.46
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `tipe_kamar` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `status_kamar` enum('tersedia','terisi') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `tipe_kamar`, `harga`, `status_kamar`) VALUES
(53, 1, 'ac', '180000.00', 'terisi'),
(54, 2, 'kipas', '120000.00', 'tersedia'),
(55, 3, 'kipas', '120000.00', 'tersedia'),
(56, 4, 'ac', '180000.00', 'tersedia'),
(57, 5, 'ac', '180000.00', 'tersedia'),
(58, 6, 'kipas', '120000.00', 'tersedia'),
(59, 7, 'kipas', '120000.00', 'tersedia'),
(60, 8, 'ac', '180000.00', 'tersedia'),
(61, 21, 'ac', '180000.00', 'tersedia'),
(62, 22, 'kipas', '120000.00', 'tersedia'),
(63, 23, 'kipas', '120000.00', 'tersedia'),
(64, 24, 'kipas', '120000.00', 'tersedia'),
(65, 25, 'kipas', '120000.00', 'tersedia'),
(66, 26, 'kipas', '120000.00', 'tersedia'),
(67, 31, 'ac', '165000.00', 'tersedia'),
(68, 32, 'kipas', '120000.00', 'tersedia'),
(69, 33, 'kipas', '120000.00', 'tersedia'),
(70, 34, 'kipas', '120000.00', 'tersedia'),
(71, 35, 'ac', '165000.00', 'tersedia'),
(72, 36, 'kipas', '120000.00', 'tersedia'),
(73, 201, 'ac', '200000.00', 'tersedia'),
(74, 202, 'ac', '200000.00', 'tersedia'),
(75, 203, 'ac', '200000.00', 'tersedia'),
(76, 204, 'ac', '200000.00', 'tersedia'),
(77, 205, 'ac', '200000.00', 'tersedia'),
(78, 206, 'ac', '200000.00', 'tersedia'),
(79, 207, 'ac', '200000.00', 'tersedia'),
(80, 208, 'ac', '200000.00', 'tersedia'),
(81, 209, 'ac', '200000.00', 'tersedia'),
(82, 210, 'ac', '200000.00', 'tersedia'),
(83, 211, 'ac', '200000.00', 'tersedia'),
(84, 301, 'ac', '200000.00', 'tersedia'),
(85, 302, 'ac', '200000.00', 'tersedia'),
(86, 303, 'ac', '200000.00', 'tersedia'),
(87, 304, 'ac', '200000.00', 'tersedia'),
(88, 305, 'ac', '200000.00', 'tersedia'),
(89, 306, 'ac', '200000.00', 'tersedia'),
(90, 307, 'ac', '200000.00', 'tersedia'),
(91, 308, 'ac', '200000.00', 'tersedia'),
(92, 309, 'ac', '200000.00', 'tersedia'),
(93, 310, 'ac', '200000.00', 'tersedia'),
(94, 311, 'ac', '200000.00', 'tersedia');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_kamar` (`id_kamar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
