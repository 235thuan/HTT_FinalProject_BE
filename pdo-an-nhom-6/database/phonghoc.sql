-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 11:06 PM
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
-- Table structure for table `phonghoc`
--

CREATE TABLE `phonghoc` (
  `id_phonghoc` int(11) NOT NULL,
  `ten_phonghoc` varchar(255) NOT NULL,
  `so_cho_ngoi` int(11) NOT NULL,
  `co_may_chieu` tinyint(1) DEFAULT 0,
  `khu_vuc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phonghoc`
--

INSERT INTO `phonghoc` (`id_phonghoc`, `ten_phonghoc`, `so_cho_ngoi`, `co_may_chieu`, `khu_vuc`) VALUES
(1, 'A1-1', 50, 0, 'Building A - Tầng 1'),
(2, 'A1-2', 50, 0, 'Building A - Tầng 1'),
(3, 'A1-3', 50, 0, 'Building A - Tầng 1'),
(4, 'A1-4', 50, 0, 'Building A - Tầng 1'),
(5, 'A1-5', 50, 0, 'Building A - Tầng 1'),
(6, 'A1-6', 50, 0, 'Building A - Tầng 1'),
(7, 'A1-7', 50, 0, 'Building A - Tầng 1'),
(8, 'A2-1', 50, 0, 'Building A - Tầng 2'),
(9, 'A2-2', 50, 0, 'Building A - Tầng 2'),
(10, 'A2-3', 50, 0, 'Building A - Tầng 2'),
(11, 'A2-4', 50, 0, 'Building A - Tầng 2'),
(12, 'A2-5', 50, 0, 'Building A - Tầng 2'),
(13, 'A2-6', 50, 0, 'Building A - Tầng 2'),
(14, 'A2-7', 50, 0, 'Building A - Tầng 2'),
(15, 'A3-1', 50, 0, 'Building A - Tầng 3'),
(16, 'A3-2', 50, 0, 'Building A - Tầng 3'),
(17, 'A3-3', 50, 0, 'Building A - Tầng 3'),
(18, 'A3-4', 50, 0, 'Building A - Tầng 3'),
(19, 'A3-5', 50, 0, 'Building A - Tầng 3'),
(20, 'A3-6', 50, 0, 'Building A - Tầng 3'),
(21, 'A3-7', 50, 0, 'Building A - Tầng 3'),
(22, 'A4-1', 50, 0, 'Building A - Tầng 4'),
(23, 'A4-2', 50, 0, 'Building A - Tầng 4'),
(24, 'A4-3', 50, 0, 'Building A - Tầng 4'),
(25, 'A4-4', 50, 0, 'Building A - Tầng 4'),
(26, 'A4-5', 50, 0, 'Building A - Tầng 4'),
(27, 'A4-6', 50, 0, 'Building A - Tầng 4'),
(28, 'A4-7', 50, 0, 'Building A - Tầng 4'),
(29, 'A5-1', 50, 0, 'Building A - Tầng 5'),
(30, 'A5-2', 50, 0, 'Building A - Tầng 5'),
(31, 'A5-3', 50, 0, 'Building A - Tầng 5'),
(32, 'A5-4', 50, 0, 'Building A - Tầng 5'),
(33, 'A5-5', 50, 0, 'Building A - Tầng 5'),
(34, 'A5-6', 50, 0, 'Building A - Tầng 5'),
(35, 'A5-7', 50, 0, 'Building A - Tầng 5'),
(36, 'A6-1', 50, 0, 'Building A - Tầng 6'),
(37, 'A6-2', 50, 0, 'Building A - Tầng 6'),
(38, 'A6-3', 50, 0, 'Building A - Tầng 6'),
(39, 'A6-4', 50, 0, 'Building A - Tầng 6'),
(40, 'A6-5', 50, 0, 'Building A - Tầng 6'),
(41, 'A6-6', 50, 0, 'Building A - Tầng 6'),
(42, 'A6-7', 50, 0, 'Building A - Tầng 6'),
(43, 'A7-1', 50, 0, 'Building A - Tầng 7'),
(44, 'A7-2', 50, 0, 'Building A - Tầng 7'),
(45, 'A7-3', 50, 0, 'Building A - Tầng 7'),
(46, 'A7-4', 50, 0, 'Building A - Tầng 7'),
(47, 'A7-5', 50, 0, 'Building A - Tầng 7'),
(48, 'A7-6', 50, 0, 'Building A - Tầng 7'),
(49, 'A7-7', 50, 0, 'Building A - Tầng 7'),
(50, 'B1-1', 50, 0, 'Building B - Tầng 1'),
(51, 'B1-2', 50, 0, 'Building B - Tầng 1'),
(52, 'B1-3', 50, 0, 'Building B - Tầng 1'),
(53, 'B1-4', 50, 0, 'Building B - Tầng 1'),
(54, 'B1-5', 50, 0, 'Building B - Tầng 1'),
(55, 'B1-6', 50, 0, 'Building B - Tầng 1'),
(56, 'B1-7', 50, 0, 'Building B - Tầng 1'),
(57, 'B1-8', 50, 0, 'Building B - Tầng 1'),
(58, 'B1-9', 50, 0, 'Building B - Tầng 1'),
(59, 'B1-10', 50, 0, 'Building B - Tầng 1'),
(60, 'B2-1', 50, 0, 'Building B - Tầng 2'),
(61, 'B2-2', 50, 0, 'Building B - Tầng 2'),
(62, 'B2-3', 50, 0, 'Building B - Tầng 2'),
(63, 'B2-4', 50, 0, 'Building B - Tầng 2'),
(64, 'B2-5', 50, 0, 'Building B - Tầng 2'),
(65, 'B2-6', 50, 0, 'Building B - Tầng 2'),
(66, 'B2-7', 50, 0, 'Building B - Tầng 2'),
(67, 'B2-8', 50, 0, 'Building B - Tầng 2'),
(68, 'B2-9', 50, 0, 'Building B - Tầng 2'),
(69, 'B2-10', 50, 0, 'Building B - Tầng 2'),
(70, 'B3-1', 50, 0, 'Building B - Tầng 3'),
(71, 'B3-2', 50, 0, 'Building B - Tầng 3'),
(72, 'B3-3', 50, 0, 'Building B - Tầng 3'),
(73, 'B3-4', 50, 0, 'Building B - Tầng 3'),
(74, 'B3-5', 50, 0, 'Building B - Tầng 3'),
(75, 'B3-6', 50, 0, 'Building B - Tầng 3'),
(76, 'B3-7', 50, 0, 'Building B - Tầng 3'),
(77, 'B3-8', 50, 0, 'Building B - Tầng 3'),
(78, 'B3-9', 50, 0, 'Building B - Tầng 3'),
(79, 'B3-10', 50, 0, 'Building B - Tầng 3'),
(80, 'C1-1', 50, 0, 'Building C - Tầng 1'),
(81, 'C1-2', 50, 0, 'Building C - Tầng 1'),
(82, 'C1-3', 50, 0, 'Building C - Tầng 1'),
(83, 'C1-4', 50, 0, 'Building C - Tầng 1'),
(84, 'C1-5', 50, 0, 'Building C - Tầng 1'),
(85, 'C1-6', 50, 0, 'Building C - Tầng 1'),
(86, 'C1-7', 50, 0, 'Building C - Tầng 1'),
(87, 'C1-8', 50, 0, 'Building C - Tầng 1'),
(88, 'C1-9', 50, 0, 'Building C - Tầng 1'),
(89, 'C1-10', 50, 0, 'Building C - Tầng 1'),
(90, 'D1-1', 50, 0, 'Building D - Tầng 1'),
(91, 'D1-2', 50, 0, 'Building D - Tầng 1'),
(92, 'D1-3', 50, 0, 'Building D - Tầng 1'),
(93, 'D1-4', 50, 0, 'Building D - Tầng 1'),
(94, 'D1-5', 50, 0, 'Building D - Tầng 1'),
(95, 'D1-6', 50, 0, 'Building D - Tầng 1'),
(96, 'D1-7', 50, 0, 'Building D - Tầng 1'),
(97, 'D1-8', 50, 0, 'Building D - Tầng 1'),
(98, 'D1-9', 50, 0, 'Building D - Tầng 1'),
(99, 'D2-1', 50, 0, 'Building D - Tầng 2'),
(100, 'D2-2', 50, 0, 'Building D - Tầng 2'),
(101, 'D2-3', 50, 0, 'Building D - Tầng 2'),
(102, 'D2-4', 50, 0, 'Building D - Tầng 2'),
(103, 'D2-5', 50, 0, 'Building D - Tầng 2'),
(104, 'D2-6', 50, 0, 'Building D - Tầng 2'),
(105, 'D2-7', 50, 0, 'Building D - Tầng 2'),
(106, 'D2-8', 50, 0, 'Building D - Tầng 2'),
(107, 'D2-9', 50, 0, 'Building D - Tầng 2'),
(108, 'D3-1', 50, 0, 'Building D - Tầng 3'),
(109, 'D3-2', 50, 0, 'Building D - Tầng 3'),
(110, 'D3-3', 50, 0, 'Building D - Tầng 3'),
(111, 'D3-4', 50, 0, 'Building D - Tầng 3'),
(112, 'D3-5', 50, 0, 'Building D - Tầng 3'),
(113, 'D3-6', 50, 0, 'Building D - Tầng 3'),
(114, 'D3-7', 50, 0, 'Building D - Tầng 3'),
(115, 'D3-8', 50, 0, 'Building D - Tầng 3'),
(116, 'D3-9', 50, 0, 'Building D - Tầng 3'),
(117, 'D4-1', 50, 0, 'Building D - Tầng 4'),
(118, 'D4-2', 50, 0, 'Building D - Tầng 4'),
(119, 'D4-3', 50, 0, 'Building D - Tầng 4'),
(120, 'D4-4', 50, 0, 'Building D - Tầng 4'),
(121, 'D4-5', 50, 0, 'Building D - Tầng 4'),
(122, 'D4-6', 50, 0, 'Building D - Tầng 4'),
(123, 'D4-7', 50, 0, 'Building D - Tầng 4'),
(124, 'D4-8', 50, 0, 'Building D - Tầng 4'),
(125, 'D4-9', 50, 0, 'Building D - Tầng 4'),
(126, 'D5-1', 50, 0, 'Building D - Tầng 5'),
(127, 'D5-2', 50, 0, 'Building D - Tầng 5'),
(128, 'D5-3', 50, 0, 'Building D - Tầng 5'),
(129, 'D5-4', 50, 0, 'Building D - Tầng 5'),
(130, 'D5-5', 50, 0, 'Building D - Tầng 5'),
(131, 'D5-6', 50, 0, 'Building D - Tầng 5'),
(132, 'D5-7', 50, 0, 'Building D - Tầng 5'),
(133, 'D5-8', 50, 0, 'Building D - Tầng 5'),
(134, 'D5-9', 50, 0, 'Building D - Tầng 5'),
(135, 'D6-1', 50, 0, 'Building D - Tầng 6'),
(136, 'D6-2', 50, 0, 'Building D - Tầng 6'),
(137, 'D6-3', 50, 0, 'Building D - Tầng 6'),
(138, 'D6-4', 50, 0, 'Building D - Tầng 6'),
(139, 'D6-5', 50, 0, 'Building D - Tầng 6'),
(140, 'D6-6', 50, 0, 'Building D - Tầng 6'),
(141, 'D6-7', 50, 0, 'Building D - Tầng 6'),
(142, 'D6-8', 50, 0, 'Building D - Tầng 6'),
(143, 'D6-9', 50, 0, 'Building D - Tầng 6'),
(144, 'D7-1', 50, 0, 'Building D - Tầng 7'),
(145, 'D7-2', 50, 0, 'Building D - Tầng 7'),
(146, 'D7-3', 50, 0, 'Building D - Tầng 7'),
(147, 'D7-4', 50, 0, 'Building D - Tầng 7'),
(148, 'D7-5', 50, 0, 'Building D - Tầng 7'),
(149, 'D7-6', 50, 0, 'Building D - Tầng 7'),
(150, 'D7-7', 50, 0, 'Building D - Tầng 7'),
(151, 'D7-8', 50, 0, 'Building D - Tầng 7'),
(152, 'D7-9', 50, 0, 'Building D - Tầng 7'),
(153, 'D8-1', 50, 0, 'Building D - Tầng 8'),
(154, 'D8-2', 50, 0, 'Building D - Tầng 8'),
(155, 'D8-3', 50, 0, 'Building D - Tầng 8'),
(156, 'D8-4', 50, 0, 'Building D - Tầng 8'),
(157, 'D8-5', 50, 0, 'Building D - Tầng 8'),
(158, 'D8-6', 50, 0, 'Building D - Tầng 8'),
(159, 'D8-7', 50, 0, 'Building D - Tầng 8'),
(160, 'D8-8', 50, 0, 'Building D - Tầng 8'),
(161, 'D8-9', 50, 0, 'Building D - Tầng 8'),
(162, 'D9-1', 50, 0, 'Building D - Tầng 9'),
(163, 'D9-2', 50, 0, 'Building D - Tầng 9'),
(164, 'D9-3', 50, 0, 'Building D - Tầng 9'),
(165, 'D9-4', 50, 0, 'Building D - Tầng 9'),
(166, 'D9-5', 50, 0, 'Building D - Tầng 9'),
(167, 'D9-6', 50, 0, 'Building D - Tầng 9'),
(168, 'D9-7', 50, 0, 'Building D - Tầng 9'),
(169, 'D9-8', 50, 0, 'Building D - Tầng 9'),
(170, 'D9-9', 50, 0, 'Building D - Tầng 9'),
(171, 'D10-1', 50, 0, 'Building D - Tầng 10'),
(172, 'D10-2', 50, 0, 'Building D - Tầng 10'),
(173, 'D10-3', 50, 0, 'Building D - Tầng 10'),
(174, 'D10-4', 50, 0, 'Building D - Tầng 10'),
(175, 'D10-5', 50, 0, 'Building D - Tầng 10'),
(176, 'D10-6', 50, 0, 'Building D - Tầng 10'),
(177, 'D10-7', 50, 0, 'Building D - Tầng 10'),
(178, 'D10-8', 50, 0, 'Building D - Tầng 10'),
(179, 'D10-9', 50, 0, 'Building D - Tầng 10'),
(180, 'D11-1', 50, 0, 'Building D - Tầng 11'),
(181, 'D11-2', 50, 0, 'Building D - Tầng 11'),
(182, 'D11-3', 50, 0, 'Building D - Tầng 11'),
(183, 'D11-4', 50, 0, 'Building D - Tầng 11'),
(184, 'D11-5', 50, 0, 'Building D - Tầng 11'),
(185, 'D11-6', 50, 0, 'Building D - Tầng 11'),
(186, 'D11-7', 50, 0, 'Building D - Tầng 11'),
(187, 'D11-8', 50, 0, 'Building D - Tầng 11'),
(188, 'D11-9', 50, 0, 'Building D - Tầng 11'),
(189, 'D12-1', 50, 0, 'Building D - Tầng 12'),
(190, 'D12-2', 50, 0, 'Building D - Tầng 12'),
(191, 'D12-3', 50, 0, 'Building D - Tầng 12'),
(192, 'D12-4', 50, 0, 'Building D - Tầng 12'),
(193, 'D12-5', 50, 0, 'Building D - Tầng 12'),
(194, 'D12-6', 50, 0, 'Building D - Tầng 12'),
(195, 'D12-7', 50, 0, 'Building D - Tầng 12'),
(196, 'D12-8', 50, 0, 'Building D - Tầng 12'),
(197, 'D12-9', 50, 0, 'Building D - Tầng 12'),
(198, 'D13-1', 50, 0, 'Building D - Tầng 13'),
(199, 'D13-2', 50, 0, 'Building D - Tầng 13'),
(200, 'D13-3', 50, 0, 'Building D - Tầng 13'),
(201, 'D13-4', 50, 0, 'Building D - Tầng 13'),
(202, 'D13-5', 50, 0, 'Building D - Tầng 13'),
(203, 'D13-6', 50, 0, 'Building D - Tầng 13'),
(204, 'D13-7', 50, 0, 'Building D - Tầng 13'),
(205, 'D13-8', 50, 0, 'Building D - Tầng 13'),
(206, 'D13-9', 50, 0, 'Building D - Tầng 13'),
(207, 'D14-1', 50, 0, 'Building D - Tầng 14'),
(208, 'D14-2', 50, 0, 'Building D - Tầng 14'),
(209, 'D14-3', 50, 0, 'Building D - Tầng 14'),
(210, 'D14-4', 50, 0, 'Building D - Tầng 14'),
(211, 'D14-5', 50, 0, 'Building D - Tầng 14'),
(212, 'D14-6', 50, 0, 'Building D - Tầng 14'),
(213, 'D14-7', 50, 0, 'Building D - Tầng 14'),
(214, 'D14-8', 50, 0, 'Building D - Tầng 14'),
(215, 'D14-9', 50, 0, 'Building D - Tầng 14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phonghoc`
--
ALTER TABLE `phonghoc`
  ADD PRIMARY KEY (`id_phonghoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phonghoc`
--
ALTER TABLE `phonghoc`
  MODIFY `id_phonghoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
