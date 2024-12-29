-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 09:12 AM
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
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id_lop` int(11) NOT NULL,
  `ten_lop` varchar(255) NOT NULL,
  `id_phonghoc` int(11) DEFAULT NULL,
  `id_chuyennganh` int(11) DEFAULT NULL,
  `nam_vao_hoc` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id_lop`, `ten_lop`, `id_phonghoc`, `id_chuyennganh`, `nam_vao_hoc`) VALUES
(1, 'KTPM01', 1, NULL, '0000'),
(2, 'KTPM02', 2, NULL, '0000'),
(3, 'KTPM03', 3, NULL, '0000'),
(4, 'MMT01', 11, NULL, '0000'),
(5, 'MMT02', 12, NULL, '0000'),
(6, 'MMT03', 13, NULL, '0000'),
(7, 'TTNT01', 21, NULL, '0000'),
(8, 'TTNT02', 22, NULL, '0000'),
(9, 'TTNT03', 23, NULL, '0000'),
(10, 'TTNT04', 24, NULL, '0000'),
(11, 'ATTT01', 31, NULL, '0000'),
(12, 'ATTT02', 32, NULL, '0000'),
(13, 'ATTT03', 33, NULL, '0000'),
(14, 'HTTT01', 41, NULL, '0000'),
(15, 'HTTT02', 42, NULL, '0000'),
(16, 'HTTT03', 43, NULL, '0000'),
(17, 'HTTT04', 44, NULL, '0000'),
(18, 'QTKD01', 51, NULL, '0000'),
(19, 'QTKD02', 52, NULL, '0000'),
(20, 'QTKD03', 53, NULL, '0000'),
(21, 'TCNH01', 56, NULL, '0000'),
(22, 'TCNH02', 57, NULL, '0000'),
(23, 'TCNH03', 58, NULL, '0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id_lop`),
  ADD KEY `ma_phong_hoc` (`id_phonghoc`),
  ADD KEY `fk_lop_chuyennganh` (`id_chuyennganh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id_lop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `fk_lop_chuyennganh` FOREIGN KEY (`id_chuyennganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`id_phonghoc`) REFERENCES `phonghoc` (`id_phonghoc`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
