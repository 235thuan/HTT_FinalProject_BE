-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 06:16 PM
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
-- Database: `do_an_nhom_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `mien_giam_hoc_phi`
--

CREATE TABLE `mien_giam_hoc_phi` (
  `id_mien_giam` int(11) NOT NULL,
  `id_monhoc` int(11) NOT NULL,
  `ty_le_mien_giam` decimal(5,2) NOT NULL,
  `so_tien_mien_giam` decimal(10,2) DEFAULT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `mo_ta` varchar(255) DEFAULT NULL,
  `trang_thai` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mien_giam_hoc_phi`
--
ALTER TABLE `mien_giam_hoc_phi`
  ADD PRIMARY KEY (`id_mien_giam`),
  ADD KEY `fk_miengiam_monhoc` (`id_monhoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mien_giam_hoc_phi`
--
ALTER TABLE `mien_giam_hoc_phi`
  MODIFY `id_mien_giam` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mien_giam_hoc_phi`
--
ALTER TABLE `mien_giam_hoc_phi`
  ADD CONSTRAINT `fk_miengiam_monhoc` FOREIGN KEY (`id_monhoc`) REFERENCES `monhoc` (`id_monhoc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
