-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 10:56 PM
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
-- Table structure for table `chitietchuyennganh`
--

CREATE TABLE `chitietchuyennganh` (
  `id_chitiet` int(11) NOT NULL,
  `ma_chuyennganh` int(11) NOT NULL,
  `ma_monhoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietchuyennganh`
--

INSERT INTO `chitietchuyennganh` (`id_chitiet`, `ma_chuyennganh`, `ma_monhoc`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30),
(31, 1, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 1, 35),
(36, 1, 36),
(37, 1, 37),
(38, 1, 38),
(39, 1, 39),
(40, 1, 40),
(81, 1, 1),
(82, 1, 2),
(83, 1, 3),
(84, 1, 4),
(85, 1, 5),
(86, 1, 6),
(87, 1, 7),
(88, 1, 8),
(89, 1, 9),
(90, 1, 10),
(91, 1, 11),
(92, 1, 12),
(93, 1, 13),
(94, 1, 14),
(95, 1, 15),
(96, 1, 16),
(97, 1, 17),
(98, 1, 18),
(99, 1, 19),
(100, 1, 20),
(101, 1, 21),
(102, 1, 22),
(103, 1, 23),
(104, 1, 24),
(105, 1, 25),
(106, 1, 26),
(107, 1, 27),
(108, 1, 28),
(109, 1, 29),
(110, 1, 30),
(111, 1, 31),
(112, 1, 32),
(113, 1, 33),
(114, 1, 34),
(115, 1, 35),
(116, 1, 36),
(117, 1, 37),
(118, 1, 38),
(119, 1, 39),
(120, 1, 40),
(121, 2, 11),
(122, 2, 12),
(123, 2, 13),
(124, 2, 14),
(125, 2, 15),
(126, 2, 16),
(127, 2, 17),
(128, 2, 18),
(129, 2, 19),
(130, 2, 20),
(131, 2, 21),
(132, 2, 22),
(133, 2, 23),
(134, 2, 24),
(135, 2, 25),
(136, 2, 26),
(137, 2, 27),
(138, 2, 28),
(139, 2, 29),
(140, 2, 30),
(141, 2, 31),
(142, 2, 32),
(143, 2, 33),
(144, 2, 34),
(145, 2, 35),
(146, 2, 36),
(147, 2, 37),
(148, 2, 38),
(149, 2, 39),
(150, 2, 40),
(151, 2, 41),
(152, 2, 42),
(153, 2, 43),
(161, 3, 21),
(162, 3, 22),
(163, 3, 23),
(164, 3, 24),
(165, 3, 25),
(166, 3, 26),
(167, 3, 27),
(168, 3, 28),
(169, 3, 29),
(170, 3, 30),
(171, 3, 31),
(172, 3, 32),
(173, 3, 33),
(174, 3, 34),
(175, 3, 35),
(176, 3, 36),
(177, 3, 37),
(178, 3, 38),
(179, 3, 39),
(180, 3, 40),
(181, 3, 41),
(182, 3, 42),
(183, 3, 43),
(191, 4, 31),
(192, 4, 32),
(193, 4, 33),
(194, 4, 34),
(195, 4, 35),
(196, 4, 36),
(197, 4, 37),
(198, 4, 38),
(199, 4, 39),
(200, 4, 40),
(201, 4, 41),
(202, 4, 42),
(203, 4, 43),
(221, 5, 41),
(222, 5, 42),
(223, 5, 43),
(275, 6, 75),
(300, 7, 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  ADD PRIMARY KEY (`id_chitiet`),
  ADD KEY `ma_chuyennganh` (`ma_chuyennganh`),
  ADD KEY `ma_monhoc` (`ma_monhoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  MODIFY `id_chitiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  ADD CONSTRAINT `chitietchuyennganh_ibfk_1` FOREIGN KEY (`ma_chuyennganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietchuyennganh_ibfk_2` FOREIGN KEY (`ma_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
