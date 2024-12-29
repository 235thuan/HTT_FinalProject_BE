-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 09:01 AM
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
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `id_giaovien` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `id_khoa` int(11) NOT NULL,
  `ten_giaovien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`id_giaovien`, `id_nguoidung`, `id_khoa`, `ten_giaovien`) VALUES
(1, 12, 2, 'Tống Văn Tình'),
(2, 13, 2, 'Giáo viên 2'),
(3, 14, 2, 'Giáo viên 3'),
(4, 15, 1, 'Mai Siêu Phong'),
(5, 16, 3, 'Đặng Văn Tùng Dương'),
(6, 17, 2, 'Giáo viên 6'),
(7, 18, 4, 'Giáo viên 7'),
(8, 19, 3, 'Giáo viên 8'),
(9, 20, 4, 'Giáo viên 9'),
(10, 21, 4, 'Giáo viên 10'),
(11, 22, 1, 'Đoàn Chính Thuần'),
(12, 23, 5, 'Hoàng Lão Tà'),
(13, 24, 2, 'Giáo viên 13'),
(14, 25, 1, 'Chu Bá Thông'),
(15, 26, 5, 'Giáo viên 15'),
(16, 27, 4, 'Giáo viên 16'),
(17, 28, 3, 'Giáo viên 17'),
(18, 29, 5, 'Giáo viên 18'),
(19, 30, 3, 'Giáo viên 19'),
(20, 31, 1, 'Hoàng Dung'),
(21, 32, 2, 'Giáo viên 21'),
(22, 33, 4, 'Giáo viên 22'),
(23, 34, 3, 'Giáo viên 23'),
(24, 35, 3, 'Giáo viên 24'),
(25, 36, 2, 'Giáo viên 25'),
(26, 37, 2, 'Giáo viên 26'),
(27, 38, 5, 'Giáo viên 27'),
(28, 39, 1, 'Giáo viên 28'),
(29, 40, 4, 'Giáo viên 29'),
(30, 41, 1, 'Giáo viên 30'),
(31, 42, 2, 'Giáo viên 31'),
(32, 43, 2, 'Giáo viên 32'),
(33, 44, 5, 'Giáo viên 33'),
(34, 45, 1, 'Giáo viên 34'),
(35, 46, 2, 'Giáo viên 35'),
(36, 47, 1, 'Giáo viên 36'),
(37, 48, 3, 'Giáo viên 37'),
(38, 49, 2, 'Giáo viên 38'),
(39, 50, 4, 'Giáo viên 39'),
(40, 51, 1, 'Giáo viên 40'),
(41, 52, 2, 'Giáo viên 41'),
(42, 53, 3, 'Giáo viên 42'),
(43, 54, 1, 'Giáo viên 43'),
(44, 55, 5, 'Giáo viên 44'),
(45, 56, 1, 'Giáo viên 45'),
(46, 57, 5, 'Giáo viên 46'),
(47, 58, 3, 'Giáo viên 47'),
(48, 59, 4, 'Giáo viên 48'),
(49, 60, 4, 'Giáo viên 49'),
(50, 114, 1, 'abcd'),
(51, 115, 1, 'abcdefgh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`id_giaovien`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `ma_khoa` (`id_khoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `id_giaovien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `fk_giaovien_khoa` FOREIGN KEY (`id_khoa`) REFERENCES `khoa` (`id_khoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE,
  ADD CONSTRAINT `giaovien_ibfk_2` FOREIGN KEY (`id_khoa`) REFERENCES `khoa` (`id_khoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
