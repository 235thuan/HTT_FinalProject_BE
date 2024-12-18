-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 07:19 AM
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
-- Table structure for table `file_nguoidung`
--

CREATE TABLE `file_nguoidung` (
  `id_file` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ten_file` varchar(255) NOT NULL,
  `loai_file` varchar(50) DEFAULT NULL,
  `duong_dan` varchar(500) NOT NULL,
  `ngay_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_nguoidung`
--

INSERT INTO `file_nguoidung` (`id_file`, `id_nguoidung`, `ten_file`, `loai_file`, `duong_dan`, `ngay_upload`) VALUES
(1, 1, 'admin_avatar.png', 'avatar', 'storage/avatars/admin_avatar.png', '2023-12-21 10:30:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_nguoidung`
--
ALTER TABLE `file_nguoidung`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_nguoidung` (`id_nguoidung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_nguoidung`
--
ALTER TABLE `file_nguoidung`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_nguoidung`
--
ALTER TABLE `file_nguoidung`
  ADD CONSTRAINT `file_nguoidung_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
