-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 12:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnsp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkStock` ()   SELECT * FROM `produk` 
WHERE `produk`.`stok` 
BETWEEN '0' AND '10'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telpon`, `alamat`) VALUES
(1, 'Ulva Yuliarti', 'P', '042898756416', 'Ds. Ujung No. 139, Sawahlunto 27937, SulUt'),
(2, 'Bahuwarna Jailani', 'L', '043636975098', 'Ki. Teuku Umar No. 123, Sabang 13338, SumUt'),
(3, 'Asmianto Simanjuntak', 'L', '034470314561', 'Jln. Merdeka No. 227, Pagar Alam 64482, Bali'),
(4, 'Jasmani Anggriawan', 'P', '073617260413', 'Jln. R.E. Martadinata No. 853, Sawahlunto 78094, Jambi'),
(5, 'Indah Kusmawati', 'P', '074296518842', 'Jr. Bata Putih No. 832, Kupang 20213, NTB');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('tunai','transfer') NOT NULL,
  `penjualan_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tanggal_bayar`, `total`, `metode`, `penjualan_id`) VALUES
(1, '2023-05-13 00:00:00', 999000, 'tunai', 1),
(2, '2023-05-14 00:00:00', 1698000, 'tunai', 2),
(3, '2023-05-15 00:00:00', 1299000, 'transfer', 3),
(4, '2023-05-20 00:00:00', 2999000, 'tunai', 4),
(5, '2023-05-22 00:00:00', 2890000, 'transfer', 5),
(6, '2023-05-23 00:00:00', 2999000, 'transfer', 6);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `pelanggan_id` int(11) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal`, `keterangan`, `pelanggan_id`, `total`) VALUES
(1, '2023-05-13 00:00:00', 'Razer Orochi V2 Quartz Edition', 1, 999000),
(2, '2023-05-14 00:00:00', 'Rexus Daxa Air 4', 2, 1698000),
(3, '2023-05-15 00:00:00', 'Glorious Model O PRO', 3, 1299000),
(4, '2023-05-20 00:00:00', 'Razer Naga V2 Pro - MMO Wireless', 1, 2999000),
(5, '2023-05-22 00:00:00', 'ZOWIE EC2-CW Wireless Mouse - Gaming Mouse', 4, 2890000),
(6, '2023-05-23 00:00:00', 'Razer Naga V2 Pro - MMO Wireless', 5, 2999000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `penjualan_id` int(11) UNSIGNED NOT NULL,
  `produk_id` int(11) UNSIGNED NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `total`) VALUES
(1, 1, 3, 1, 999000),
(2, 2, 4, 2, 1698000),
(3, 3, 5, 1, 1299000),
(4, 4, 6, 1, 2999000),
(5, 5, 1, 1, 2890000),
(6, 6, 6, 1, 2999000);

--
-- Triggers `penjualan_detail`
--
DELIMITER $$
CREATE TRIGGER `updateStock` AFTER INSERT ON `penjualan_detail` FOR EACH ROW UPDATE `produk`
SET `stok` = `stok`- NEW.`kuantitas`
WHERE `produk`.`id` = NEW.`produk_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'EC2-CW', 'ZOWIE EC2-CW Wireless Mouse - Gaming Mouse', 2890000, 11),
(2, 'R-DAV3', 'Razer Deathadder V3 - Gaming Mouse', 1249000, 14),
(3, 'R-OV2', 'Razer Orochi V2 Quartz Edition', 999000, 7),
(4, 'RX-DX4', 'Rexus Daxa Air 4 ', 849000, 12),
(5, 'G-MO-PRO', 'Glorious Model O PRO', 1299000, 8),
(6, 'R-NV2-PRO', 'Razer Naga V2 Pro - MMO Wireless', 2999000, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_penjualan_id` (`penjualan_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_detail_penjualan_id` (`penjualan_id`),
  ADD KEY `penjualan_detail_produk_id` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_penjualan_id` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_pelanggan_id` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_penjualan_id` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penjualan_detail_produk_id` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
