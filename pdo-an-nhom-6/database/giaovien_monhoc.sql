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
-- Table structure for table `giaovien_monhoc`
--

CREATE TABLE `giaovien_monhoc` (
  `id` int(11) NOT NULL,
  `ma_giaovien` int(11) NOT NULL,
  `ma_monhoc` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giaovien_monhoc`
--
ALTER TABLE `giaovien_monhoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_giaovien` (`ma_giaovien`),
  ADD KEY `ma_monhoc` (`ma_monhoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giaovien_monhoc`
--
ALTER TABLE `giaovien_monhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giaovien_monhoc`
--
ALTER TABLE `giaovien_monhoc`
  ADD CONSTRAINT `giaovien_monhoc_ibfk_1` FOREIGN KEY (`ma_giaovien`) REFERENCES `giaovien` (`id_giaovien`),
  ADD CONSTRAINT `giaovien_monhoc_ibfk_2` FOREIGN KEY (`ma_monhoc`) REFERENCES `monhoc` (`id_monhoc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
