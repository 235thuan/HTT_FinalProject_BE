-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 05:22 AM
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
  `id_khoa` int(11) NOT NULL,
  `ky_hoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`id_chuyennganh`, `ten_chuyennganh`, `id_khoa`, `ky_hoc`) VALUES
(1, 'Kỹ Thuật Phần Mềm', 1, NULL),
(2, 'Mạng Máy Tính', 1, NULL),
(3, 'Trí Tuệ Nhân Tạo', 1, NULL),
(4, 'An Toàn Thông Tin', 1, NULL),
(5, 'Hệ Thống Thông Tin', 1, NULL),
(6, 'Khoa Học Dữ Liệu', 1, NULL),
(7, 'Quản Trị Kinh Doanh', 2, NULL),
(8, 'Tài Chính Ngân Hàng', 2, NULL),
(9, 'Kinh Tế Học', 2, NULL),
(10, 'Marketing', 2, NULL),
(11, 'Kế Toán', 2, NULL),
(12, 'Dược Học', 3, NULL),
(13, 'Y Khoa', 3, NULL),
(14, 'Răng Hàm Mặt', 3, NULL),
(15, 'Xây Dựng Dân Dụng', 4, NULL),
(16, 'Kỹ Thuật Cầu Đường', 4, NULL),
(17, 'Điện Tử Viễn Thông', 5, NULL),
(18, 'Kỹ Thuật Điện Tử', 5, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`id_chuyennganh`),
  ADD KEY `FK_chuyennganh_khoa` (`id_khoa`);

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
  ADD CONSTRAINT `FK_chuyennganh_khoa` FOREIGN KEY (`id_khoa`) REFERENCES `khoa` (`id_khoa`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
