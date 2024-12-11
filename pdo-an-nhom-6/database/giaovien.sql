-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 12:19 PM
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
  `ma_khoa` int(11) NOT NULL,
  `ten_giaovien` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`id_giaovien`, `id_nguoidung`, `ma_khoa`, `ten_giaovien`, `email`, `so_dien_thoai`) VALUES
(1, 12, 2, 'Tống Văn Tình', 'giaovien1@example.com', '0123456789'),
(2, 13, 2, 'Giáo viên 2', 'giaovien2@example.com', '0123456790'),
(3, 14, 2, 'Giáo viên 3', 'giaovien3@example.com', '0123456791'),
(4, 15, 1, 'Mai Siêu Phong', 'giaovien4@example.com', '0123456792'),
(5, 16, 3, 'Đặng Văn Tùng Dương', 'giaovien5@example.com', '0123456793'),
(6, 17, 2, 'Giáo viên 6', 'giaovien6@example.com', '0123456794'),
(7, 18, 4, 'Giáo viên 7', 'giaovien7@example.com', '0123456795'),
(8, 19, 3, 'Giáo viên 8', 'giaovien8@example.com', '0123456796'),
(9, 20, 4, 'Giáo viên 9', 'giaovien9@example.com', '0123456797'),
(10, 21, 4, 'Giáo viên 10', 'giaovien10@example.com', '0123456798'),
(11, 22, 1, 'Đoàn Chính Thuần', 'giaovien11@example.com', '0123456799'),
(12, 23, 5, 'Hoàng Lão Tà', 'giaovien12@example.com', '0123456800'),
(13, 24, 2, 'Giáo viên 13', 'giaovien13@example.com', '0123456801'),
(14, 25, 1, 'Chu Bá Thông', 'giaovien14@example.com', '0123456802'),
(15, 26, 5, 'Giáo viên 15', 'giaovien15@example.com', '0123456803'),
(16, 27, 4, 'Giáo viên 16', 'giaovien16@example.com', '0123456804'),
(17, 28, 3, 'Giáo viên 17', 'giaovien17@example.com', '0123456805'),
(18, 29, 5, 'Giáo viên 18', 'giaovien18@example.com', '0123456806'),
(19, 30, 3, 'Giáo viên 19', 'giaovien19@example.com', '0123456807'),
(20, 31, 1, 'Hoàng Dung', 'giaovien20@example.com', '0123456808'),
(21, 32, 2, 'Giáo viên 21', 'giaovien21@example.com', '0123456809'),
(22, 33, 4, 'Giáo viên 22', 'giaovien22@example.com', '0123456810'),
(23, 34, 3, 'Giáo viên 23', 'giaovien23@example.com', '0123456811'),
(24, 35, 3, 'Giáo viên 24', 'giaovien24@example.com', '0123456812'),
(25, 36, 2, 'Giáo viên 25', 'giaovien25@example.com', '0123456813'),
(26, 37, 2, 'Giáo viên 26', 'giaovien26@example.com', '0123456814'),
(27, 38, 5, 'Giáo viên 27', 'giaovien27@example.com', '0123456815'),
(28, 39, 1, 'Giáo viên 28', 'giaovien28@example.com', '0123456816'),
(29, 40, 4, 'Giáo viên 29', 'giaovien29@example.com', '0123456817'),
(30, 41, 1, 'Giáo viên 30', 'giaovien30@example.com', '0123456818'),
(31, 42, 2, 'Giáo viên 31', 'giaovien31@example.com', '0123456819'),
(32, 43, 2, 'Giáo viên 32', 'giaovien32@example.com', '0123456820'),
(33, 44, 5, 'Giáo viên 33', 'giaovien33@example.com', '0123456821'),
(34, 45, 1, 'Giáo viên 34', 'giaovien34@example.com', '0123456822'),
(35, 46, 2, 'Giáo viên 35', 'giaovien35@example.com', '0123456823'),
(36, 47, 1, 'Giáo viên 36', 'giaovien36@example.com', '0123456824'),
(37, 48, 3, 'Giáo viên 37', 'giaovien37@example.com', '0123456825'),
(38, 49, 2, 'Giáo viên 38', 'giaovien38@example.com', '0123456826'),
(39, 50, 4, 'Giáo viên 39', 'giaovien39@example.com', '0123456827'),
(40, 51, 1, 'Giáo viên 40', 'giaovien40@example.com', '0123456828'),
(41, 52, 2, 'Giáo viên 41', 'giaovien41@example.com', '0123456829'),
(42, 53, 3, 'Giáo viên 42', 'giaovien42@example.com', '0123456830'),
(43, 54, 1, 'Giáo viên 43', 'giaovien43@example.com', '0123456831'),
(44, 55, 5, 'Giáo viên 44', 'giaovien44@example.com', '0123456832'),
(45, 56, 1, 'Giáo viên 45', 'giaovien45@example.com', '0123456833'),
(46, 57, 5, 'Giáo viên 46', 'giaovien46@example.com', '0123456834'),
(47, 58, 3, 'Giáo viên 47', 'giaovien47@example.com', '0123456835'),
(48, 59, 4, 'Giáo viên 48', 'giaovien48@example.com', '0123456836'),
(49, 60, 4, 'Giáo viên 49', 'giaovien49@example.com', '0123456837');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`id_giaovien`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `id_giaovien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE,
  ADD CONSTRAINT `giaovien_ibfk_2` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`id_khoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
