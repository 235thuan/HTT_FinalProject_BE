-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 12:38 PM
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
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `id_vaitro` int(11) NOT NULL,
  `ten_vaitro` varchar(100) NOT NULL,
  `mo_ta_vaitro` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`id_vaitro`, `ten_vaitro`, `mo_ta_vaitro`) VALUES
(1, 'Admin', 'Quản trị toàn bộ hệ thống, có quyền thay đổi cấu hình, quản lý người dùng và các tài nguyên hệ thống.'),
(2, 'Kế Toán', 'Quản lý tài chính, thu chi, lập báo cáo tài chính cho các hoạt động của trường học.'),
(3, 'Sinh Viên', 'Học sinh viên tham gia học tập, đăng ký môn học, xem lịch học và điểm thi.'),
(4, 'Giáo Viên', 'Giảng dạy, chấm điểm, theo dõi tiến độ học tập của sinh viên và hỗ trợ giáo dục.'),
(5, 'Hiệu Trưởng', 'Quản lý chung trường học, quyết định các chính sách và giám sát các hoạt động giáo dục.'),
(6, 'Giáo Vụ', 'Quản lý lịch học, sắp xếp phòng học, giảng viên và các vấn đề hành chính liên quan đến công tác giảng dạy.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`id_vaitro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `id_vaitro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
