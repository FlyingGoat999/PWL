-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 04:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gaji_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `pokok` decimal(12,2) NOT NULL,
  `lembur` decimal(12,2) DEFAULT 0.00,
  `pajak` decimal(12,2) DEFAULT 0.00,
  `asuransi` decimal(12,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `pokok`, `lembur`, `pajak`, `asuransi`) VALUES
(1, 2000000.00, 100000.00, 50000.00, 900000.00),
(2, 1000000.00, 800000.00, 90000.00, 302000.00),
(3, 2000000.00, 10000.00, 90000.00, 20000.00),
(4, 0.00, 0.00, 0.00, 0.00),
(5, 50000000.00, 1000.00, 20000000.00, 4500.00),
(6, 150000000.00, 120000.00, 90000.00, 50000.00),
(7, 20000000.00, 400000.00, 80000.00, 1005000.00);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelamin` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `gaji` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `kelamin`, `tanggal_lahir`, `email`, `telephone`, `gaji`) VALUES
(1, 'Fairuz Amru Ghani', 'Laki-laki', '2011-11-11', 'admin111@gmail.com', '08154111111', 1),
(2, 'Liliana Anggita Wardani', 'Perempuan', '2005-05-05', 'lili@yahoo.com', '0815499999', 2),
(3, 'Fico Aldi Saputro', 'Laki-laki', '2001-09-09', 'fiko@gmail.com', '081223445667', 3),
(5, 'Ajrun', 'Laki-laki', '2011-11-01', 'ajrun@gmail.com', '08154532147', 5),
(6, 'Ummi Saroh', 'Perempuan', '2008-08-08', 'ummi@gmail.com', '08957368313', 6),
(7, 'Gatotkaca', 'Laki-laki', '2005-05-05', 'gatot@gmail.com', '081273838298', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `confirm`) VALUES
(1, 'admin111', 'admin111@gmail.com', '$2y$10$d5XTchoE9XdWObW.EiZUbuaakLkhKG.h3fDbgksF1RNAy68fpYsm6', ''),
(2, 'fikomok', 'fiko@gmail.com', '$2y$10$gPNRML17nWf4bUvUt7afOOVCq1n0YlxZflHgrRtNo5XaKYicbKJz.', ''),
(3, 'admin123', 'admin123@gmail.com', '$2y$10$IzAVixcHulr4ldbCTOFmJeBjQA7WGZxHjO8z89PZPoeWfNAjg4SwC', ''),
(4, 'yuyu', 'yuyu@gmail.com', '$2y$10$k0LbVF51MEFKwbGyQxPK1OmKZlLms3JGzRjCIyBdxoGjzr24DO2Hy', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `gaji` (`gaji`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`gaji`) REFERENCES `gaji` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
