-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 05:21 AM
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
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `id_monhoc` int(11) NOT NULL,
  `ten_monhoc` varchar(255) NOT NULL,
  `so_tin_chi` int(11) NOT NULL,
  `id_chuyennganh` int(11) DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT 0.00,
  `ky_hoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`id_monhoc`, `ten_monhoc`, `so_tin_chi`, `id_chuyennganh`, `gia`, `ky_hoc`) VALUES
(1, 'Lập Trình C', 3, 1, 0.00, NULL),
(2, 'Cấu Trúc Dữ Liệu', 4, 1, 0.00, NULL),
(3, 'Hệ Điều Hành', 3, 1, 0.00, NULL),
(4, 'Mạng Máy Tính', 4, 1, 0.00, NULL),
(5, 'Kỹ Thuật Phần Mềm', 3, 1, 0.00, NULL),
(6, 'An Toàn Thông Tin', 2, 1, 0.00, NULL),
(7, 'Giải Thuật', 4, 1, 0.00, NULL),
(8, 'Khoa Học Dữ Liệu', 4, 1, 0.00, NULL),
(9, 'Lập Trình Java', 3, 1, 0.00, NULL),
(10, 'Mạng Viễn Thông', 3, 1, 0.00, NULL),
(11, 'Kinh Tế Vi Mô', 3, 2, 0.00, NULL),
(12, 'Quản Trị Kinh Doanh', 3, 2, 0.00, NULL),
(13, 'Kế Toán Quản Trị', 3, 2, 0.00, NULL),
(14, 'Marketing', 4, 2, 0.00, NULL),
(15, 'Tài Chính Ngân Hàng', 4, 2, 0.00, NULL),
(16, 'Kinh Tế Lượng', 3, 2, 0.00, NULL),
(17, 'Kinh Tế Học', 4, 2, 0.00, NULL),
(18, 'Lý Thuyết Tài Chính', 3, 2, 0.00, NULL),
(19, 'Đầu Tư Tài Chính', 3, 2, 0.00, NULL),
(20, 'Pháp Luật Kinh Tế', 3, 2, 0.00, NULL),
(21, 'Y Học Cơ Sở', 4, 3, 0.00, NULL),
(22, 'Sinh Lý Học', 3, 3, 0.00, NULL),
(23, 'Dược Học Cơ Sở', 3, 3, 0.00, NULL),
(24, 'Chẩn Đoán Bệnh', 4, 3, 0.00, NULL),
(25, 'Điều Dưỡng', 3, 3, 0.00, NULL),
(26, 'Vi sinh học Y Dược', 3, 3, 0.00, NULL),
(27, 'Răng Hàm Mặt', 3, 3, 0.00, NULL),
(28, 'Sức Khỏe Cộng Đồng', 4, 3, 0.00, NULL),
(29, 'Giải Phẫu Học', 3, 3, 0.00, NULL),
(30, 'Kỹ Thuật Cầu Đường', 3, 4, 0.00, NULL),
(31, 'Xây Dựng Dân Dụng', 3, 4, 0.00, NULL),
(32, 'Kết Cấu Công Trình', 4, 4, 0.00, NULL),
(33, 'Kỹ Thuật Xây Dựng', 4, 4, 0.00, NULL),
(34, 'Vật Liệu Xây Dựng', 3, 4, 0.00, NULL),
(35, 'Đo Lường và Thiết Kế', 4, 4, 0.00, NULL),
(36, 'Quản Lý Dự Án', 4, 4, 0.00, NULL),
(37, 'Điện Tử Viễn Thông', 3, 5, 0.00, NULL),
(38, 'Kỹ Thuật Điện Tử', 3, 5, 0.00, NULL),
(39, 'Viễn Thông và Mạng', 4, 5, 0.00, NULL),
(40, 'Mạng và An Toàn Thông Tin', 3, 5, 0.00, NULL),
(41, 'Xử Lý Tín Hiệu', 4, 5, 0.00, NULL),
(42, 'Điện Tử Công Nghiệp', 3, 5, 0.00, NULL),
(43, 'Điện Tử Viễn Thông 2', 3, 5, 0.00, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id_monhoc`),
  ADD KEY `ma_chuyen_nganh` (`id_chuyennganh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `id_monhoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `monhoc_ibfk_1` FOREIGN KEY (`id_chuyennganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
