-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 12:36 PM
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
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id_sinhvien` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ten_sinhvien` varchar(255) NOT NULL,
  `id_lop` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id_sinhvien`, `id_nguoidung`, `ten_sinhvien`, `id_lop`) VALUES
(62, 62, 'Đoàn Nguyên Đức', 17),
(63, 63, 'Đoàn Dự', 20),
(64, 64, 'Sinh viên user64', 1),
(65, 65, 'Sinh viên user65', 15),
(66, 66, 'Sinh viên user66', 1),
(67, 67, 'Sinh viên user67', 5),
(68, 68, 'Sinh viên user68', 1),
(69, 69, 'Sinh viên user69', 10),
(70, 70, 'Sinh viên user70', 1),
(71, 71, 'Sinh viên user71', 20),
(72, 72, 'Sinh viên user72', 3),
(73, 73, 'Sinh viên user73', 2),
(74, 74, 'Sinh viên user74', 2),
(75, 75, 'Sinh viên user75', 3),
(76, 76, 'Sinh viên user76', 9),
(77, 77, 'Sinh viên user77', 13),
(78, 78, 'Sinh viên user78', 15),
(79, 79, 'Sinh viên user79', 10),
(80, 80, 'Sinh viên user80', 7),
(81, 81, 'Sinh viên user81', 2),
(82, 82, 'Sinh viên user82', 11),
(83, 83, 'Sinh viên user83', 10),
(84, 84, 'Sinh viên user84', 12),
(85, 85, 'Sinh viên user85', 2),
(86, 86, 'Sinh viên user86', 2),
(87, 87, 'Sinh viên user87', 1),
(88, 88, 'Sinh viên user88', 21),
(89, 89, 'Sinh viên user89', 10),
(90, 90, 'Sinh viên user90', 12),
(91, 91, 'Sinh viên user91', 4),
(92, 92, 'Sinh viên user92', 8),
(93, 93, 'Sinh viên user93', 2),
(94, 94, 'Sinh viên user94', 11),
(95, 95, 'Sinh viên user95', 2),
(96, 96, 'Sinh viên user96', 20),
(97, 97, 'Sinh viên user97', 4),
(98, 98, 'Sinh viên user98', 4),
(99, 99, 'Sinh viên user99', 10),
(100, 100, 'Sinh viên user100', 13),
(101, 101, 'Đoàn Văn Vương', 13),
(102, 102, 'Lâm Chấn Đông', 1),
(103, 103, 'Tấm', 11),
(104, 104, 'Hoàng Mạnh Hà', 7),
(105, 105, 'Nguyễn Đức', 2),
(106, 106, 'Chẩu Mạnh Hà', 9),
(107, 107, 'Trần Đức Bình', 17),
(108, 108, 'Hoàng Việt Cồ', 9),
(109, 109, 'Văn Bằng', 20),
(110, 110, 'Khổng Tử', 23),
(111, 111, 'Nguyễn Chí Cường', 12),
(112, 116, 'Xavier', 12),
(115, 1, 'user01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id_sinhvien`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `fk_id_lop` (`id_lop`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id_sinhvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `fk_id_lop` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_nguoidung` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
