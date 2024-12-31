-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 11:06 AM
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
-- Table structure for table `sodutaikhoan`
--

CREATE TABLE `sodutaikhoan` (
  `id_sodutaikhoan` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 999999999999.00,
  `id_cardnumber` varchar(255) NOT NULL,
  `id_cvv` char(3) NOT NULL,
  `id_billingaddress` varchar(255) NOT NULL,
  `id_expirydate` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sodutaikhoan`
--

INSERT INTO `sodutaikhoan` (`id_sodutaikhoan`, `amount`, `id_cardnumber`, `id_cvv`, `id_billingaddress`, `id_expirydate`, `created_at`, `updated_at`) VALUES
(1, 999999999999.00, '1234567891234567', '123', '123', '1231', '2024-12-31 09:58:25', '2024-12-31 09:58:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sodutaikhoan`
--
ALTER TABLE `sodutaikhoan`
  ADD PRIMARY KEY (`id_sodutaikhoan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sodutaikhoan`
--
ALTER TABLE `sodutaikhoan`
  MODIFY `id_sodutaikhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
