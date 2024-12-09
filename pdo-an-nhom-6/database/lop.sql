-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:09 AM
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
  `ma_phong_hoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id_lop`, `ten_lop`, `ma_phong_hoc`) VALUES
(1, 'KTPM01', 1),
(2, 'KTPM02', 2),
(3, 'KTPM03', 3),
(4, 'MMT01', 11),
(5, 'MMT02', 12),
(6, 'MMT03', 13),
(7, 'TTNT01', 21),
(8, 'TTNT02', 22),
(9, 'TTNT03', 23),
(10, 'TTNT04', 24),
(11, 'ATTT01', 31),
(12, 'ATTT02', 32),
(13, 'ATTT03', 33),
(14, 'HTTT01', 41),
(15, 'HTTT02', 42),
(16, 'HTTT03', 43),
(17, 'HTTT04', 44),
(18, 'QTKD01', 51),
(19, 'QTKD02', 52),
(20, 'QTKD03', 53),
(21, 'TCNH01', 56),
(22, 'TCNH02', 57),
(23, 'TCNH03', 58);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id_lop`),
  ADD KEY `ma_phong_hoc` (`ma_phong_hoc`);

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
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`ma_phong_hoc`) REFERENCES `phonghoc` (`id_phonghoc`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
