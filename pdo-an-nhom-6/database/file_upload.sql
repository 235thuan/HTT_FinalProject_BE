-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 05:12 AM
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
-- Table structure for table `file_upload`
--

CREATE TABLE `file_upload` (
  `id_file` int(11) NOT NULL,
  `ten_file` varchar(255) NOT NULL,
  `loai_file` varchar(50) DEFAULT NULL,
  `duong_dan` varchar(500) NOT NULL,
  `ngay_upload` datetime DEFAULT current_timestamp(),
  `id_chuyennganh` int(11) DEFAULT NULL,
  `id_khoa` int(11) DEFAULT NULL,
  `id_monhoc` int(11) DEFAULT NULL,
  `id_lop` int(11) DEFAULT NULL,
  `thoi_luong` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_upload`
--

INSERT INTO `file_upload` (`id_file`, `ten_file`, `loai_file`, `duong_dan`, `ngay_upload`, `id_chuyennganh`, `id_khoa`, `id_monhoc`, `id_lop`, `thoi_luong`) VALUES
(6, 'antoanthongtin.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 4, NULL, NULL, NULL, 0),
(7, 'quantrikinhdoanh.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 7, NULL, NULL, NULL, 0),
(8, 'kinhtehoc.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 9, NULL, NULL, NULL, 0),
(9, 'taichinhnganhanginhnganhang.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 8, NULL, NULL, NULL, 0),
(10, 'kythuatcauduong.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 16, NULL, NULL, NULL, 0),
(11, 'kythuatphanmem.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 1, NULL, NULL, NULL, 0),
(12, 'kythuatdientu.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 18, NULL, NULL, NULL, 0),
(13, 'ranghammat.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 14, NULL, NULL, NULL, 0),
(14, 'maketting.jpg', 'image', 'hoa/', '2024-12-31 10:44:37', 10, NULL, NULL, NULL, 0),
(15, 'c++.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 1, NULL, 0),
(16, 'chuandoanbenh.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 24, NULL, 0),
(17, 'cấu trúc dữ liệu.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 2, NULL, 0),
(18, 'daututaichinh.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 19, NULL, 0),
(19, 'dientucongnghiep.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 42, NULL, 0),
(20, 'dientuvienthong.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 37, NULL, 0),
(21, 'dieuduong.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 25, NULL, 0),
(22, 'doluongthietke.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 35, NULL, 0),
(23, 'duochoccoso.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 23, NULL, 0),
(24, 'giaiphauhoc.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 29, NULL, 0),
(25, 'giaithuat.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 7, NULL, 0),
(26, 'hệ điều hành.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 3, NULL, 0),
(27, 'ketoanquantri.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 13, NULL, 0),
(28, 'kinhteluong.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 16, NULL, 0),
(29, 'kinhtevimo.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 11, NULL, 0),
(30, 'kythuatxaydung.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 33, NULL, 0),
(31, 'laptrinhjava.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 9, NULL, 0),
(32, 'lythuyettaichinh.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 18, NULL, 0),
(33, 'mangmaytinh.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 4, NULL, 0),
(34, 'mangvaantoanthongtin.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 40, NULL, 0),
(35, 'mangvienthong.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 10, NULL, 0),
(36, 'phapluatkinhte.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 20, NULL, 0),
(37, 'quanlyduan.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 36, NULL, 0),
(38, 'sinhlyhoc.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 22, NULL, 0),
(39, 'suckhoecongdong.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 28, NULL, 0),
(40, 'vatlieuxaydung.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 34, NULL, 0),
(41, 'vienthongvamang.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 39, NULL, 0),
(42, 'visinhhoc.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 26, NULL, 0),
(43, 'xaydungdandung.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 31, NULL, 0),
(44, 'xulytinhieu.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 41, NULL, 0),
(45, 'yhoccoso.jpg', 'image', 'hoa/', '2024-12-31 10:51:10', NULL, NULL, 21, NULL, 0),
(46, 'khoahocdulieu.jpg', 'image', 'hoa/', '2024-12-31 10:54:53', NULL, NULL, 8, NULL, 0),
(47, 'khoacongnghethongtin.jpg', 'image', 'hoa/', '2024-12-31 10:56:09', NULL, 1, NULL, NULL, 0),
(48, 'khoadientuvienthong.jpg', 'image', 'hoa/', '2024-12-31 10:56:09', NULL, 5, NULL, NULL, 0),
(49, 'khoakinhte.jpg', 'image', 'hoa/', '2024-12-31 10:56:09', NULL, 2, NULL, NULL, 0),
(50, 'khoaxaydung.jpg', 'image', 'hoa/', '2024-12-31 10:56:09', NULL, 4, NULL, NULL, 0),
(51, 'khoayduoc.jpg', 'image', 'hoa/', '2024-12-31 10:56:09', NULL, 3, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_chuyennganh` (`id_chuyennganh`),
  ADD KEY `id_khoa` (`id_khoa`),
  ADD KEY `id_monhoc` (`id_monhoc`),
  ADD KEY `id_lop` (`id_lop`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD CONSTRAINT `file_upload_ibfk_1` FOREIGN KEY (`id_chuyennganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_upload_ibfk_2` FOREIGN KEY (`id_khoa`) REFERENCES `khoa` (`id_khoa`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_upload_ibfk_3` FOREIGN KEY (`id_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE,
  ADD CONSTRAINT `file_upload_ibfk_4` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
