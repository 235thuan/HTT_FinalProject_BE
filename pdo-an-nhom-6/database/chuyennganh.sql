-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 07:29 AM
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
-- Table structure for table `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `id_chuyennganh` int(11) NOT NULL,
  `ten_chuyennganh` varchar(255) NOT NULL,
  `ma_khoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`id_chuyennganh`, `ten_chuyennganh`, `ma_khoa`) VALUES
(1, 'Kỹ Thuật Phần Mềm', 1),
(2, 'Mạng Máy Tính', 1),
(3, 'Trí Tuệ Nhân Tạo', 1),
(4, 'An Toàn Thông Tin', 1),
(5, 'Hệ Thống Thông Tin', 1),
(6, 'Khoa Học Dữ Liệu', 1),
(7, 'Quản Trị Kinh Doanh', 2),
(8, 'Tài Chính Ngân Hàng', 2),
(9, 'Kinh Tế Học', 2),
(10, 'Marketing', 2),
(11, 'Kế Toán', 2),
(12, 'Dược Học', 3),
(13, 'Y Khoa', 3),
(14, 'Răng Hàm Mặt', 3),
(15, 'Xây Dựng Dân Dụng', 4),
(16, 'Kỹ Thuật Cầu Đường', 4),
(17, 'Điện Tử Viễn Thông', 5),
(18, 'Kỹ Thuật Điện Tử', 5),
(19, 'Kỹ Thuật Phần Mềm', 1),
(20, 'Mạng Máy Tính', 1),
(21, 'Trí Tuệ Nhân Tạo', 1),
(22, 'An Toàn Thông Tin', 1),
(23, 'Hệ Thống Thông Tin', 1),
(24, 'Khoa Học Dữ Liệu', 1),
(25, 'Quản Trị Kinh Doanh', 2),
(26, 'Tài Chính Ngân Hàng', 2),
(27, 'Kinh Tế Học', 2),
(28, 'Marketing', 2),
(29, 'Kế Toán', 2),
(30, 'Dược Học', 3),
(31, 'Y Khoa', 3),
(32, 'Răng Hàm Mặt', 3),
(33, 'Xây Dựng Dân Dụng', 4),
(34, 'Kỹ Thuật Cầu Đường', 4),
(35, 'Điện Tử Viễn Thông', 5),
(36, 'Kỹ Thuật Điện Tử', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`id_chuyennganh`),
  ADD KEY `FK_chuyennganh_khoa` (`ma_khoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  MODIFY `id_chuyennganh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD CONSTRAINT `FK_chuyennganh_khoa` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`id_khoa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
