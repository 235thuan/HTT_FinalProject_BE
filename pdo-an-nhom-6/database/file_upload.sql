-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 07:30 AM
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
  `id_lop` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT;

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
