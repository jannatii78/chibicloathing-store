-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 12:16 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `stok`, `foto`, `kategori`, `deskripsi`) VALUES
(16, 'Kaos kimetsu no yaiba ', 35000, 399, 'kaos1.jpg', 'kaos', 'Kaos katun | Distro | All size | anime KNY'),
(18, 'Kaos kimetsu no yaiba ', 42000, 139, 'kaos2.png', 'kaos', 'Kaos katun | Distro | All size | Tanjiro Nezuko'),
(21, 'Kaos kimetsu no yaiba ', 50000, 94, 'kaos3.jpg', 'kaos', 'Kaos katun | Distro | All size | Zenitsu Agatsuma'),
(22, 'Kaos kimetsu no yaiba ', 40000, 199, 'kaos4.jpg', 'kaos', 'Kaos katun | Distro | All size | Tanjiro '),
(23, 'Kaos kimetsu no yaiba ', 40000, 95, 'kaos5.jpg', 'kaos', 'Kaos katun | Distro | All size | Tomioka Giyu'),
(24, 'Kaos kimetsu no yaiba ', 40000, 99, 'kaos6.jpg', 'kaos', 'Kaos katun | Distro | All size | Pasukan Pemburu Iblis'),
(25, 'Kaos kimetsu no yaiba ', 40000, 195, 'kaos7.jpeg', 'kaos', 'Kaos katun | Distro | All size | Shinobu Kocho'),
(26, 'Kaos kimetsu no yaiba ', 42000, 149, 'kaos8.jpeg', 'kaos', 'Kaos katun | Distro | All size | Tokito Muichiro'),
(27, 'Kaos kimetsu no yaiba ', 40000, 100, 'kaos9.jpeg', 'kaos', 'Kaos katun | Distro | All size | Kakushibo'),
(28, 'Kaos kimetsu no yaiba ', 42000, 150, 'kaos10.jpeg', 'kaos', 'Kaos katun | Distro | All size | Inosuke Hashibira'),
(29, 'Kaos kimetsu no yaiba ', 40000, 148, 'kaos11.jpg', 'kaos', 'Kaos katun | Distro | All size | anime KNY II');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail`
--

CREATE TABLE `tb_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_detail`
--

INSERT INTO `tb_detail` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`) VALUES
(1, 1, 18, 1),
(2, 2, 18, 2),
(3, 3, 18, 1),
(4, 4, 26, 1),
(5, 5, 16, 1),
(6, 6, 18, 1),
(7, 6, 23, 3),
(8, 7, 29, 2),
(9, 8, 21, 1),
(10, 9, 25, 2),
(11, 10, 16, 100),
(12, 11, 18, 1),
(13, 12, 18, 1),
(14, 13, 22, 1),
(15, 14, 24, 1),
(16, 15, 18, 10),
(17, 15, 21, 5),
(18, 16, 16, 1),
(19, 17, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pelanggan`, `tanggal`, `total_harga`) VALUES
(1, 0, '2024-09-03', 42000),
(2, 0, '2024-09-03', 84000),
(3, 0, '2024-09-03', 42000),
(4, 0, '2024-09-04', 42000),
(5, 0, '2024-09-04', 35000),
(6, 5, '2024-09-04', 162000),
(7, 12, '2024-09-04', 80000),
(8, 5, '2024-09-04', 50000),
(9, 13, '2024-09-09', 80000),
(10, 12, '2024-09-10', 3500000),
(11, 12, '2024-09-10', 42000),
(12, 12, '2024-09-11', 42000),
(13, 12, '2024-09-11', 40000),
(14, 13, '2024-09-11', 40000),
(15, 14, '2024-09-11', 670000),
(16, 14, '2024-09-11', 35000),
(17, 12, '2024-09-13', 42000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('admin','pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `username`, `password`, `hp`, `alamat`, `role`) VALUES
(5, 'Nuril ', 'nuril@gmail.com', 'Ril13', '12345', '081234567890', 'Gg.buntu', 'pelanggan'),
(9, 'admin', 'admin', 'admin', 'mimin123', '123', 'admin', 'admin'),
(11, 'shabila', 'shabila@gmail.com', 'shabil123', 'shabilaaa', '012345678', 'desa karang sembung', 'pelanggan'),
(12, 'ramzy malik alzaky', 'malikalzaky@gmail.com', 'zaky30', '12345678', '081234567890', 'Talun', 'pelanggan'),
(13, 'Bila', 'sabila@gmail.com', 'bilaaa', '1234567', '0859109851980', 'desa dukuh kec. kapetakan kab.cirebon', 'pelanggan'),
(14, 'Dewi Santika', 'santikadewi@gmail.com', 'santika_dewi', '12345678', '081234567890', 'jalan pelandakan, majasem', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_detail`
--
ALTER TABLE `tb_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_detail`
--
ALTER TABLE `tb_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
