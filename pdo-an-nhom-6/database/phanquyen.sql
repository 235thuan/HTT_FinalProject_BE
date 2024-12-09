-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:16 AM
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
-- Table structure for table `phanquyen`
--

CREATE TABLE `phanquyen` (
  `id_phanquyen` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `id_vaitro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phanquyen`
--

INSERT INTO `phanquyen` (`id_phanquyen`, `id_nguoidung`, `id_vaitro`) VALUES
(1, 1, 1),
(2, 2, 6),
(3, 3, 6),
(4, 4, 6),
(5, 5, 6),
(6, 6, 6),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 2),
(12, 12, 4),
(13, 13, 4),
(14, 14, 4),
(15, 15, 4),
(16, 16, 4),
(17, 17, 4),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 4),
(22, 22, 4),
(23, 23, 4),
(24, 24, 4),
(25, 25, 4),
(26, 26, 4),
(27, 27, 4),
(28, 28, 4),
(29, 29, 4),
(30, 30, 4),
(31, 31, 4),
(32, 32, 4),
(33, 33, 4),
(34, 34, 4),
(35, 35, 4),
(36, 36, 4),
(37, 37, 4),
(38, 38, 4),
(39, 39, 4),
(40, 40, 4),
(41, 41, 4),
(42, 42, 4),
(43, 43, 4),
(44, 44, 4),
(45, 45, 4),
(46, 46, 4),
(47, 47, 4),
(48, 48, 4),
(49, 49, 4),
(50, 50, 4),
(51, 51, 4),
(52, 52, 4),
(53, 53, 4),
(54, 54, 4),
(55, 55, 4),
(56, 56, 4),
(57, 57, 4),
(58, 58, 4),
(59, 59, 4),
(60, 60, 4),
(61, 61, 5),
(62, 62, 3),
(63, 63, 3),
(64, 64, 3),
(65, 65, 3),
(66, 66, 3),
(67, 67, 3),
(68, 68, 3),
(69, 69, 3),
(70, 70, 3),
(71, 71, 3),
(72, 72, 3),
(73, 73, 3),
(74, 74, 3),
(75, 75, 3),
(76, 76, 3),
(77, 77, 3),
(78, 78, 3),
(79, 79, 3),
(80, 80, 3),
(81, 81, 3),
(82, 82, 3),
(83, 83, 3),
(84, 84, 3),
(85, 85, 3),
(86, 86, 3),
(87, 87, 3),
(88, 88, 3),
(89, 89, 3),
(90, 90, 3),
(91, 91, 3),
(92, 92, 3),
(93, 93, 3),
(94, 94, 3),
(95, 95, 3),
(96, 96, 3),
(97, 97, 3),
(98, 98, 3),
(99, 99, 3),
(100, 100, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`id_phanquyen`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `id_vaitro` (`id_vaitro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phanquyen`
--
ALTER TABLE `phanquyen`
  MODIFY `id_phanquyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD CONSTRAINT `phanquyen_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE,
  ADD CONSTRAINT `phanquyen_ibfk_2` FOREIGN KEY (`id_vaitro`) REFERENCES `vaitro` (`id_vaitro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
