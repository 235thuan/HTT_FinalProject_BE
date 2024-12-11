-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 04:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ten_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(154, 2, 44),
(155, 2, 45),
(156, 2, 46),
(157, 2, 47),
(158, 2, 48),
(159, 2, 49),
(160, 2, 50),
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
(184, 3, 44),
(185, 3, 45),
(186, 3, 46),
(187, 3, 47),
(188, 3, 48),
(189, 3, 49),
(190, 3, 50),
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
(204, 4, 44),
(205, 4, 45),
(206, 4, 46),
(207, 4, 47),
(208, 4, 48),
(209, 4, 49),
(210, 4, 50),
(211, 4, 51),
(212, 4, 52),
(213, 4, 53),
(214, 4, 54),
(215, 4, 55),
(216, 4, 56),
(217, 4, 57),
(218, 4, 58),
(219, 4, 59),
(220, 4, 60),
(221, 5, 41),
(222, 5, 42),
(223, 5, 43),
(224, 5, 44),
(225, 5, 45),
(226, 5, 46),
(227, 5, 47),
(228, 5, 48),
(229, 5, 49),
(230, 5, 50),
(231, 5, 51),
(232, 5, 52),
(233, 5, 53),
(234, 5, 54),
(235, 5, 55),
(236, 5, 56),
(237, 5, 57),
(238, 5, 58),
(239, 5, 59),
(240, 5, 60),
(241, 5, 61),
(242, 5, 62),
(243, 5, 63),
(244, 5, 64),
(245, 5, 65),
(246, 5, 66),
(247, 5, 67),
(248, 5, 68),
(249, 5, 69),
(250, 5, 70),
(251, 6, 51),
(252, 6, 52),
(253, 6, 53),
(254, 6, 54),
(255, 6, 55),
(256, 6, 56),
(257, 6, 57),
(258, 6, 58),
(259, 6, 59),
(260, 6, 60),
(261, 6, 61),
(262, 6, 62),
(263, 6, 63),
(264, 6, 64),
(265, 6, 65),
(266, 6, 66),
(267, 6, 67),
(268, 6, 68),
(269, 6, 69),
(270, 6, 70),
(271, 6, 71),
(272, 6, 72),
(273, 6, 73),
(274, 6, 74),
(275, 6, 75),
(276, 6, 76),
(277, 6, 77),
(278, 6, 78),
(279, 6, 79),
(280, 6, 80),
(281, 7, 56),
(282, 7, 57),
(283, 7, 58),
(284, 7, 59),
(285, 7, 60),
(286, 7, 61),
(287, 7, 62),
(288, 7, 63),
(289, 7, 64),
(290, 7, 65),
(291, 7, 66),
(292, 7, 67),
(293, 7, 68),
(294, 7, 69),
(295, 7, 70),
(296, 7, 71),
(297, 7, 72),
(298, 7, 73),
(299, 7, 74),
(300, 7, 75),
(301, 7, 76),
(302, 7, 77),
(303, 7, 78),
(304, 7, 79),
(305, 7, 80),
(306, 7, 81),
(307, 7, 82),
(308, 7, 83),
(309, 7, 84),
(310, 7, 85);

-- --------------------------------------------------------

--
-- Table structure for table `chitiethocphi`
--

CREATE TABLE `chitiethocphi` (
  `id_chitiethocphi` int(11) NOT NULL,
  `id_hocphi` int(11) NOT NULL,
  `id_monhoc` int(11) DEFAULT NULL,
  `ten_khoan_phi` varchar(255) NOT NULL,
  `so_tien` decimal(10,2) NOT NULL,
  `mien_giam` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietmonhoc`
--

CREATE TABLE `chitietmonhoc` (
  `id_chitietmonhoc` int(11) NOT NULL,
  `ma_monhoc` int(11) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `so_tiet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietmonhoc`
--

INSERT INTO `chitietmonhoc` (`id_chitietmonhoc`, `ma_monhoc`, `mo_ta`, `so_tiet`) VALUES
(1, 1, 'Môn học cơ bản về lập trình C, giúp sinh viên nắm vững các khái niệm lập trình cơ bản.', 45),
(2, 2, 'Cấu trúc dữ liệu cơ bản và các thuật toán cần thiết cho lập trình hiệu quả.', 50),
(3, 3, 'Giới thiệu về hệ điều hành, các thành phần và chức năng của nó.', 55),
(4, 4, 'Môn học này giới thiệu các khái niệm về mạng máy tính và các giao thức mạng.', 60),
(5, 5, 'Phát triển phần mềm và các phương pháp lập trình ứng dụng.', 48),
(6, 6, 'Lý thuyết về bảo mật thông tin và các phương pháp bảo vệ hệ thống máy tính.', 40),
(7, 7, 'Nghiên cứu các thuật toán và cách tối ưu hóa hiệu quả xử lý dữ liệu.', 45),
(8, 8, 'Các khái niệm và ứng dụng của khoa học dữ liệu trong thực tế.', 50),
(9, 9, 'Môn học lập trình Java với các kỹ thuật phát triển ứng dụng phần mềm.', 50),
(10, 10, 'Mạng viễn thông và các hệ thống truyền tải thông tin.', 55),
(11, 11, 'Cơ sở của kinh tế vi mô và các mô hình kinh tế cơ bản.', 40),
(12, 12, 'Khái quát về quản lý doanh nghiệp và các nguyên lý quản trị kinh doanh.', 50),
(13, 13, 'Kế toán tài chính và quản trị, các quy trình tài chính trong doanh nghiệp.', 45),
(14, 14, 'Khái niệm về marketing, nghiên cứu thị trường và chiến lược marketing.', 50),
(15, 15, 'Nghiên cứu về tài chính ngân hàng và các công cụ tài chính trong thị trường.', 45),
(16, 16, 'Kinh tế lượng và ứng dụng của nó trong phân tích dữ liệu kinh tế.', 55),
(17, 17, 'Các lý thuyết cơ bản trong kinh tế học và các mô hình kinh tế ứng dụng.', 50),
(18, 18, 'Môn học giảng dạy về lý thuyết tài chính và các công cụ đầu tư.', 50),
(19, 19, 'Các quy định pháp lý trong kinh tế và sự ảnh hưởng của chúng đến doanh nghiệp.', 40),
(20, 20, 'Giới thiệu các khái niệm cơ bản trong y học và chẩn đoán bệnh.', 50),
(21, 21, 'Các vấn đề cơ bản trong sinh lý học con người và ứng dụng trong y học.', 45),
(22, 22, 'Môn học về dược học, các phương pháp và quy trình sử dụng thuốc.', 50),
(23, 23, 'Nghiên cứu về chẩn đoán và điều trị bệnh tật trong y học.', 55),
(24, 24, 'Điều dưỡng cơ bản và các kỹ năng chăm sóc bệnh nhân.', 50),
(25, 25, 'Vi sinh học và các bệnh truyền nhiễm, ứng dụng trong ngành y tế.', 55),
(26, 26, 'Nghiên cứu về các bệnh lý răng hàm mặt và phương pháp điều trị.', 50),
(27, 27, 'Sức khỏe cộng đồng, các biện pháp phòng ngừa dịch bệnh và cải thiện sức khỏe.', 45),
(28, 28, 'Giải phẫu học cơ thể người và các kỹ thuật phẫu thuật cơ bản.', 50),
(29, 29, 'Cấu trúc và kết cấu cầu đường trong ngành xây dựng và giao thông.', 55),
(30, 30, 'Cơ sở xây dựng dân dụng và các công trình xây dựng trong đô thị.', 50),
(31, 31, 'Kết cấu công trình xây dựng, vật liệu và quy trình thi công.', 60),
(32, 32, 'Các kỹ thuật trong xây dựng công trình và các vấn đề về quy hoạch xây dựng.', 55),
(33, 33, 'Vật liệu xây dựng, tính chất và ứng dụng trong các công trình xây dựng.', 50),
(34, 34, 'Các phương pháp đo lường và thiết kế trong ngành xây dựng.', 45),
(35, 35, 'Quản lý dự án xây dựng, các công cụ và phương pháp quản lý công trình.', 50),
(36, 36, 'Nghiên cứu về điện tử viễn thông và ứng dụng trong truyền thông mạng.', 50),
(37, 37, 'Kỹ thuật điện tử cơ bản và các phương pháp thiết kế mạch điện.', 45),
(38, 38, 'Mạng viễn thông, các phương thức truyền tải và bảo mật thông tin.', 60),
(39, 39, 'Xử lý tín hiệu trong viễn thông, các ứng dụng và công nghệ mới.', 55),
(40, 40, 'Các công nghệ trong điện tử công nghiệp và ứng dụng trong sản xuất.', 50),
(41, 1, 'Môn học cơ bản về lập trình C, giúp sinh viên nắm vững các khái niệm lập trình cơ bản.', 45),
(42, 2, 'Cấu trúc dữ liệu cơ bản và các thuật toán cần thiết cho lập trình hiệu quả.', 50),
(43, 3, 'Giới thiệu về hệ điều hành, các thành phần và chức năng của nó.', 55),
(44, 4, 'Môn học này giới thiệu các khái niệm về mạng máy tính và các giao thức mạng.', 60),
(45, 5, 'Phát triển phần mềm và các phương pháp lập trình ứng dụng.', 48),
(46, 6, 'Lý thuyết về bảo mật thông tin và các phương pháp bảo vệ hệ thống máy tính.', 40),
(47, 7, 'Nghiên cứu các thuật toán và cách tối ưu hóa hiệu quả xử lý dữ liệu.', 45),
(48, 8, 'Các khái niệm và ứng dụng của khoa học dữ liệu trong thực tế.', 50),
(49, 9, 'Môn học lập trình Java với các kỹ thuật phát triển ứng dụng phần mềm.', 50),
(50, 10, 'Mạng viễn thông và các hệ thống truyền tải thông tin.', 55),
(51, 11, 'Cơ sở của kinh tế vi mô và các mô hình kinh tế cơ bản.', 40),
(52, 12, 'Khái quát về quản lý doanh nghiệp và các nguyên lý quản trị kinh doanh.', 50),
(53, 13, 'Kế toán tài chính và quản trị, các quy trình tài chính trong doanh nghiệp.', 45),
(54, 14, 'Khái niệm về marketing, nghiên cứu thị trường và chiến lược marketing.', 50),
(55, 15, 'Nghiên cứu về tài chính ngân hàng và các công cụ tài chính trong thị trường.', 45),
(56, 16, 'Kinh tế lượng và ứng dụng của nó trong phân tích dữ liệu kinh tế.', 55),
(57, 17, 'Các lý thuyết cơ bản trong kinh tế học và các mô hình kinh tế ứng dụng.', 50),
(58, 18, 'Môn học giảng dạy về lý thuyết tài chính và các công cụ đầu tư.', 50),
(59, 19, 'Các quy định pháp lý trong kinh tế và sự ảnh hưởng của chúng đến doanh nghiệp.', 40),
(60, 20, 'Giới thiệu các khái niệm cơ bản trong y học và chẩn đoán bệnh.', 50),
(61, 21, 'Các vấn đề cơ bản trong sinh lý học con người và ứng dụng trong y học.', 45),
(62, 22, 'Môn học về dược học, các phương pháp và quy trình sử dụng thuốc.', 50),
(63, 23, 'Nghiên cứu về chẩn đoán và điều trị bệnh tật trong y học.', 55),
(64, 24, 'Điều dưỡng cơ bản và các kỹ năng chăm sóc bệnh nhân.', 50),
(65, 25, 'Vi sinh học và các bệnh truyền nhiễm, ứng dụng trong ngành y tế.', 55),
(66, 26, 'Nghiên cứu về các bệnh lý răng hàm mặt và phương pháp điều trị.', 50),
(67, 27, 'Sức khỏe cộng đồng, các biện pháp phòng ngừa dịch bệnh và cải thiện sức khỏe.', 45),
(68, 28, 'Giải phẫu học cơ thể người và các kỹ thuật phẫu thuật cơ bản.', 50),
(69, 29, 'Cấu trúc và kết cấu cầu đường trong ngành xây dựng và giao thông.', 55),
(70, 30, 'Cơ sở xây dựng dân dụng và các công trình xây dựng trong đô thị.', 50),
(71, 31, 'Kết cấu công trình xây dựng, vật liệu và quy trình thi công.', 60),
(72, 32, 'Các kỹ thuật trong xây dựng công trình và các vấn đề về quy hoạch xây dựng.', 55),
(73, 33, 'Vật liệu xây dựng, tính chất và ứng dụng trong các công trình xây dựng.', 50),
(74, 34, 'Các phương pháp đo lường và thiết kế trong ngành xây dựng.', 45),
(75, 35, 'Quản lý dự án xây dựng, các công cụ và phương pháp quản lý công trình.', 50),
(76, 36, 'Nghiên cứu về điện tử viễn thông và ứng dụng trong truyền thông mạng.', 50),
(77, 37, 'Kỹ thuật điện tử cơ bản và các phương pháp thiết kế mạch điện.', 45),
(78, 38, 'Mạng viễn thông, các phương thức truyền tải và bảo mật thông tin.', 60),
(79, 39, 'Xử lý tín hiệu trong viễn thông, các ứng dụng và công nghệ mới.', 55),
(80, 40, 'Các công nghệ trong điện tử công nghiệp và ứng dụng trong sản xuất.', 50);

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `id_chuyennganh` int(11) NOT NULL,
  `ten_chuyennganh` varchar(255) NOT NULL,
  `ma_khoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`id_chuyennganh`, `ten_chuyennganh`, `ma_khoa`) VALUES
(1, 'Kỹ Thuật Phần Mềm', 1),
(2, 'Mạng Máy Tính', 1),
(3, 'Trí Tuệ Nhân Tạo', 1),
(4, 'An Toàn Thông Tin', 1),
(5, 'Hệ Thống Thông Tin', 1),
(6, 'Khoa Học Dữ Liệu', 1),
(7, 'Quản Trị Kinh Doanh', 2),
(8, 'Tài Chính Ngân Hàng', 2),
(9, 'Kinh Tế Học', 2),
(10, 'Marketing', 2),
(11, 'Kế Toán', 2),
(12, 'Dược Học', 3),
(13, 'Y Khoa', 3),
(14, 'Răng Hàm Mặt', 3),
(15, 'Xây Dựng Dân Dụng', 4),
(16, 'Kỹ Thuật Cầu Đường', 4),
(17, 'Điện Tử Viễn Thông', 5),
(18, 'Kỹ Thuật Điện Tử', 5),
(19, 'Kỹ Thuật Phần Mềm', 1),
(20, 'Mạng Máy Tính', 1),
(21, 'Trí Tuệ Nhân Tạo', 1),
(22, 'An Toàn Thông Tin', 1),
(23, 'Hệ Thống Thông Tin', 1),
(24, 'Khoa Học Dữ Liệu', 1),
(25, 'Quản Trị Kinh Doanh', 2),
(26, 'Tài Chính Ngân Hàng', 2),
(27, 'Kinh Tế Học', 2),
(28, 'Marketing', 2),
(29, 'Kế Toán', 2),
(30, 'Dược Học', 3),
(31, 'Y Khoa', 3),
(32, 'Răng Hàm Mặt', 3),
(33, 'Xây Dựng Dân Dụng', 4),
(34, 'Kỹ Thuật Cầu Đường', 4),
(35, 'Điện Tử Viễn Thông', 5),
(36, 'Kỹ Thuật Điện Tử', 5);

-- --------------------------------------------------------

--
-- Table structure for table `dangkyhoc`
--

CREATE TABLE `dangkyhoc` (
  `id_dangky` int(11) NOT NULL,
  `id_sinhvien` int(11) NOT NULL,
  `id_thoikhoabieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem`
--

CREATE TABLE `diem` (
  `id_diem` int(11) NOT NULL,
  `id_sinhvien` int(11) NOT NULL,
  `id_monhoc` int(11) NOT NULL,
  `loai_diem` enum('Giữa kỳ','Cuối kỳ','Thực hành','Khác') NOT NULL,
  `diem_so` decimal(5,2) DEFAULT NULL CHECK (`diem_so` >= 0 and `diem_so` <= 10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diemdanh`
--

CREATE TABLE `diemdanh` (
  `id_diemdanh` int(11) NOT NULL,
  `id_sinhvien` int(11) NOT NULL,
  `id_thoikhoabieu` int(11) NOT NULL,
  `trang_thai` enum('Có mặt','Vắng mặt','Muộn') DEFAULT 'Vắng mặt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `hieutruong`
--

CREATE TABLE `hieutruong` (
  `id_hieutruong` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ten_hieutruong` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocphi`
--

CREATE TABLE `hocphi` (
  `id_hocphi` int(11) NOT NULL,
  `id_sinhvien` int(11) NOT NULL,
  `so_tien` decimal(10,2) NOT NULL,
  `trang_thai` enum('Chưa thanh toán','Đang xử lý','Đã thanh toán') DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ketoan`
--

CREATE TABLE `ketoan` (
  `id_ketoan` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ten_ketoan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `id_khoa` int(11) NOT NULL,
  `ten_khoa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`id_khoa`, `ten_khoa`) VALUES
(1, 'Khoa Công Nghệ Thông Tin'),
(2, 'Khoa Kinh Tế'),
(3, 'Khoa Y Dược'),
(4, 'Khoa Xây Dựng'),
(5, 'Khoa Điện Tử Viễn Thông'),
(6, 'Khoa Công Nghệ Thông Tin'),
(7, 'Khoa Kinh Tế'),
(8, 'Khoa Y Dược'),
(9, 'Khoa Xây Dựng'),
(10, 'Khoa Điện Tử Viễn Thông');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `login_time`, `logout_time`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-12-09 18:50:14', NULL, '127.0.0.1', NULL, NULL),
(2, 1, '2024-12-09 18:50:20', NULL, '127.0.0.1', NULL, NULL),
(3, 1, '2024-12-09 18:51:04', NULL, '127.0.0.1', NULL, NULL),
(4, 1, '2024-12-09 18:51:17', NULL, '127.0.0.1', NULL, NULL),
(5, 1, '2024-12-09 18:51:21', NULL, '127.0.0.1', NULL, NULL),
(6, 1, '2024-12-09 18:53:48', NULL, '127.0.0.1', NULL, NULL),
(7, 1, '2024-12-09 18:54:07', NULL, '127.0.0.1', NULL, NULL),
(8, 1, '2024-12-09 18:54:10', NULL, '127.0.0.1', NULL, NULL),
(9, 1, '2024-12-09 18:54:10', NULL, '127.0.0.1', NULL, NULL),
(10, 1, '2024-12-09 18:54:11', NULL, '127.0.0.1', NULL, NULL),
(11, 1, '2024-12-09 18:54:11', NULL, '127.0.0.1', NULL, NULL),
(12, 1, '2024-12-09 18:54:14', NULL, '127.0.0.1', NULL, NULL),
(13, 1, '2024-12-09 18:54:14', NULL, '127.0.0.1', NULL, NULL),
(14, 1, '2024-12-09 18:54:15', NULL, '127.0.0.1', NULL, NULL),
(15, 1, '2024-12-09 18:54:15', NULL, '127.0.0.1', NULL, NULL),
(16, 1, '2024-12-09 18:54:16', NULL, '127.0.0.1', NULL, NULL),
(17, 1, '2024-12-09 18:54:21', NULL, '127.0.0.1', NULL, NULL),
(18, 1, '2024-12-09 18:58:39', NULL, '127.0.0.1', NULL, NULL),
(19, 1, '2024-12-09 18:58:48', NULL, '127.0.0.1', NULL, NULL),
(20, 1, '2024-12-09 19:07:51', NULL, '127.0.0.1', NULL, NULL),
(21, 1, '2024-12-09 19:08:12', NULL, '127.0.0.1', NULL, NULL),
(22, 1, '2024-12-09 19:08:26', NULL, '127.0.0.1', NULL, NULL),
(23, 1, '2024-12-09 19:08:45', NULL, '127.0.0.1', NULL, NULL),
(24, 1, '2024-12-09 19:09:32', NULL, '127.0.0.1', NULL, NULL),
(25, 1, '2024-12-09 19:10:01', NULL, '127.0.0.1', NULL, NULL),
(26, 1, '2024-12-09 19:10:03', NULL, '127.0.0.1', NULL, NULL),
(27, 1, '2024-12-09 19:10:46', NULL, '127.0.0.1', NULL, NULL),
(28, 1, '2024-12-09 19:10:48', NULL, '127.0.0.1', NULL, NULL),
(29, 1, '2024-12-09 19:11:01', NULL, '127.0.0.1', NULL, NULL),
(30, 1, '2024-12-09 19:11:06', NULL, '127.0.0.1', NULL, NULL),
(31, 1, '2024-12-09 19:11:18', NULL, '127.0.0.1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id_lop` int(11) NOT NULL,
  `ten_lop` varchar(255) NOT NULL,
  `ma_phong_hoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id_lop`, `ten_lop`, `ma_phong_hoc`) VALUES
(1, 'KTPM01', 1),
(2, 'KTPM02', 2),
(3, 'KTPM03', 3),
(4, 'MMT01', 11),
(5, 'MMT02', 12),
(6, 'MMT03', 13),
(7, 'TTNT01', 21),
(8, 'TTNT02', 22),
(9, 'TTNT03', 23),
(10, 'TTNT04', 24),
(11, 'ATTT01', 31),
(12, 'ATTT02', 32),
(13, 'ATTT03', 33),
(14, 'HTTT01', 41),
(15, 'HTTT02', 42),
(16, 'HTTT03', 43),
(17, 'HTTT04', 44),
(18, 'QTKD01', 51),
(19, 'QTKD02', 52),
(20, 'QTKD03', 53),
(21, 'TCNH01', 56),
(22, 'TCNH02', 57),
(23, 'TCNH03', 58);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_15_create_login_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `id_monhoc` int(11) NOT NULL,
  `ten_monhoc` varchar(255) NOT NULL,
  `so_tin_chi` int(11) NOT NULL,
  `ma_chuyen_nganh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`id_monhoc`, `ten_monhoc`, `so_tin_chi`, `ma_chuyen_nganh`) VALUES
(1, 'Lập Trình C', 3, 1),
(2, 'Cấu Trúc Dữ Liệu', 4, 1),
(3, 'Hệ Điều Hành', 3, 1),
(4, 'Mạng Máy Tính', 4, 1),
(5, 'Kỹ Thuật Phần Mềm', 3, 1),
(6, 'An Toàn Thông Tin', 2, 1),
(7, 'Giải Thuật', 4, 1),
(8, 'Khoa Học Dữ Liệu', 4, 1),
(9, 'Lập Trình Java', 3, 1),
(10, 'Mạng Viễn Thông', 3, 1),
(11, 'Kinh Tế Vi Mô', 3, 2),
(12, 'Quản Trị Kinh Doanh', 3, 2),
(13, 'Kế Toán Quản Trị', 3, 2),
(14, 'Marketing', 4, 2),
(15, 'Tài Chính Ngân Hàng', 4, 2),
(16, 'Kinh Tế Lượng', 3, 2),
(17, 'Kinh Tế Học', 4, 2),
(18, 'Lý Thuyết Tài Chính', 3, 2),
(19, 'Đầu Tư Tài Chính', 3, 2),
(20, 'Pháp Luật Kinh Tế', 3, 2),
(21, 'Y Học Cơ Sở', 4, 3),
(22, 'Sinh Lý Học', 3, 3),
(23, 'Dược Học Cơ Sở', 3, 3),
(24, 'Chẩn Đoán Bệnh', 4, 3),
(25, 'Điều Dưỡng', 3, 3),
(26, 'Vi sinh học Y Dược', 3, 3),
(27, 'Răng Hàm Mặt', 3, 3),
(28, 'Sức Khỏe Cộng Đồng', 4, 3),
(29, 'Giải Phẫu Học', 3, 3),
(30, 'Kỹ Thuật Cầu Đường', 3, 4),
(31, 'Xây Dựng Dân Dụng', 3, 4),
(32, 'Kết Cấu Công Trình', 4, 4),
(33, 'Kỹ Thuật Xây Dựng', 4, 4),
(34, 'Vật Liệu Xây Dựng', 3, 4),
(35, 'Đo Lường và Thiết Kế', 4, 4),
(36, 'Quản Lý Dự Án', 4, 4),
(37, 'Điện Tử Viễn Thông', 3, 5),
(38, 'Kỹ Thuật Điện Tử', 3, 5),
(39, 'Viễn Thông và Mạng', 4, 5),
(40, 'Mạng và An Toàn Thông Tin', 3, 5),
(41, 'Xử Lý Tín Hiệu', 4, 5),
(42, 'Điện Tử Công Nghiệp', 3, 5),
(43, 'Điện Tử Viễn Thông 2', 3, 5),
(44, 'Lập Trình C', 3, 1),
(45, 'Cấu Trúc Dữ Liệu', 4, 1),
(46, 'Hệ Điều Hành', 3, 1),
(47, 'Mạng Máy Tính', 4, 1),
(48, 'Kỹ Thuật Phần Mềm', 3, 1),
(49, 'An Toàn Thông Tin', 2, 1),
(50, 'Giải Thuật', 4, 1),
(51, 'Khoa Học Dữ Liệu', 4, 1),
(52, 'Lập Trình Java', 3, 1),
(53, 'Mạng Viễn Thông', 3, 1),
(54, 'Kinh Tế Vi Mô', 3, 2),
(55, 'Quản Trị Kinh Doanh', 3, 2),
(56, 'Kế Toán Quản Trị', 3, 2),
(57, 'Marketing', 4, 2),
(58, 'Tài Chính Ngân Hàng', 4, 2),
(59, 'Kinh Tế Lượng', 3, 2),
(60, 'Kinh Tế Học', 4, 2),
(61, 'Lý Thuyết Tài Chính', 3, 2),
(62, 'Đầu Tư Tài Chính', 3, 2),
(63, 'Pháp Luật Kinh Tế', 3, 2),
(64, 'Y Học Cơ Sở', 4, 3),
(65, 'Sinh Lý Học', 3, 3),
(66, 'Dược Học Cơ Sở', 3, 3),
(67, 'Chẩn Đoán Bệnh', 4, 3),
(68, 'Điều Dưỡng', 3, 3),
(69, 'Vi sinh học Y Dược', 3, 3),
(70, 'Răng Hàm Mặt', 3, 3),
(71, 'Sức Khỏe Cộng Đồng', 4, 3),
(72, 'Giải Phẫu Học', 3, 3),
(73, 'Kỹ Thuật Cầu Đường', 3, 4),
(74, 'Xây Dựng Dân Dụng', 3, 4),
(75, 'Kết Cấu Công Trình', 4, 4),
(76, 'Kỹ Thuật Xây Dựng', 4, 4),
(77, 'Vật Liệu Xây Dựng', 3, 4),
(78, 'Đo Lường và Thiết Kế', 4, 4),
(79, 'Quản Lý Dự Án', 4, 4),
(80, 'Điện Tử Viễn Thông', 3, 5),
(81, 'Kỹ Thuật Điện Tử', 3, 5),
(82, 'Viễn Thông và Mạng', 4, 5),
(83, 'Mạng và An Toàn Thông Tin', 3, 5),
(84, 'Xử Lý Tín Hiệu', 4, 5),
(85, 'Điện Tử Công Nghiệp', 3, 5),
(86, 'Điện Tử Viễn Thông 2', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `id_nguoidung` int(11) NOT NULL,
  `ten_dang_nhap` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `trang_thai` enum('hoạt động','không hoạt động') DEFAULT 'hoạt động'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`id_nguoidung`, `ten_dang_nhap`, `mat_khau`, `email`, `so_dien_thoai`, `trang_thai`) VALUES
(1, 'user01', '$2y$12$3m67OSSCeJvZP6PTxm569OLJrSK7i8y5Ik0zso5m7b96AYPhl8StW', 'user01@example.com', '0901234567', 'hoạt động'),
(2, 'user02', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user02@example.com', '0901234568', 'hoạt động'),
(3, 'user03', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user03@example.com', '0901234569', 'hoạt động'),
(4, 'user04', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user04@example.com', '0901234570', 'hoạt động'),
(5, 'user05', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user05@example.com', '0901234571', 'hoạt động'),
(6, 'user06', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user06@example.com', '0901234572', 'hoạt động'),
(7, 'user07', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user07@example.com', '0901234573', 'hoạt động'),
(8, 'user08', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user08@example.com', '0901234574', 'hoạt động'),
(9, 'user09', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user09@example.com', '0901234575', 'hoạt động'),
(10, 'user10', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user10@example.com', '0901234576', 'hoạt động'),
(11, 'user11', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user11@example.com', '0901234577', 'hoạt động'),
(12, 'user12', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user12@example.com', '0901234578', 'hoạt động'),
(13, 'user13', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user13@example.com', '0901234579', 'hoạt động'),
(14, 'user14', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user14@example.com', '0901234580', 'hoạt động'),
(15, 'user15', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user15@example.com', '0901234581', 'hoạt động'),
(16, 'user16', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user16@example.com', '0901234582', 'hoạt động'),
(17, 'user17', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user17@example.com', '0901234583', 'hoạt động'),
(18, 'user18', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user18@example.com', '0901234584', 'hoạt động'),
(19, 'user19', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user19@example.com', '0901234585', 'hoạt động'),
(20, 'user20', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user20@example.com', '0901234586', 'hoạt động'),
(21, 'user21', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user21@example.com', '0901234587', 'hoạt động'),
(22, 'user22', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user22@example.com', '0901234588', 'hoạt động'),
(23, 'user23', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user23@example.com', '0901234589', 'hoạt động'),
(24, 'user24', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user24@example.com', '0901234590', 'hoạt động'),
(25, 'user25', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user25@example.com', '0901234591', 'hoạt động'),
(26, 'user26', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user26@example.com', '0901234592', 'hoạt động'),
(27, 'user27', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user27@example.com', '0901234593', 'hoạt động'),
(28, 'user28', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user28@example.com', '0901234594', 'hoạt động'),
(29, 'user29', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user29@example.com', '0901234595', 'hoạt động'),
(30, 'user30', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user30@example.com', '0901234596', 'hoạt động'),
(31, 'user31', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user31@example.com', '0901234597', 'hoạt động'),
(32, 'user32', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user32@example.com', '0901234598', 'hoạt động'),
(33, 'user33', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user33@example.com', '0901234599', 'hoạt động'),
(34, 'user34', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user34@example.com', '0901234600', 'hoạt động'),
(35, 'user35', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user35@example.com', '0901234601', 'hoạt động'),
(36, 'user36', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user36@example.com', '0901234602', 'hoạt động'),
(37, 'user37', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user37@example.com', '0901234603', 'hoạt động'),
(38, 'user38', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user38@example.com', '0901234604', 'hoạt động'),
(39, 'user39', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user39@example.com', '0901234605', 'hoạt động'),
(40, 'user40', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user40@example.com', '0901234606', 'hoạt động'),
(41, 'user41', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user41@example.com', '0901234607', 'hoạt động'),
(42, 'user42', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user42@example.com', '0901234608', 'hoạt động'),
(43, 'user43', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user43@example.com', '0901234609', 'hoạt động'),
(44, 'user44', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user44@example.com', '0901234610', 'hoạt động'),
(45, 'user45', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user45@example.com', '0901234611', 'hoạt động'),
(46, 'user46', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user46@example.com', '0901234612', 'hoạt động'),
(47, 'user47', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user47@example.com', '0901234613', 'hoạt động'),
(48, 'user48', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user48@example.com', '0901234614', 'hoạt động'),
(49, 'user49', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user49@example.com', '0901234615', 'hoạt động'),
(50, 'user50', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user50@example.com', '0901234616', 'hoạt động'),
(51, 'user51', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user51@example.com', '0901234617', 'hoạt động'),
(52, 'user52', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user52@example.com', '0901234618', 'hoạt động'),
(53, 'user53', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user53@example.com', '0901234619', 'hoạt động'),
(54, 'user54', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user54@example.com', '0901234620', 'hoạt động'),
(55, 'user55', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user55@example.com', '0901234621', 'hoạt động'),
(56, 'user56', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user56@example.com', '0901234622', 'hoạt động'),
(57, 'user57', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user57@example.com', '0901234623', 'hoạt động'),
(58, 'user58', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user58@example.com', '0901234624', 'hoạt động'),
(59, 'user59', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user59@example.com', '0901234625', 'hoạt động'),
(60, 'user60', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user60@example.com', '0901234626', 'hoạt động'),
(61, 'user61', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user61@example.com', '0901234627', 'hoạt động'),
(62, 'user62', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user62@example.com', '0901234628', 'hoạt động'),
(63, 'user63', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user63@example.com', '0901234629', 'hoạt động'),
(64, 'user64', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user64@example.com', '0901234630', 'hoạt động'),
(65, 'user65', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user65@example.com', '0901234631', 'hoạt động'),
(66, 'user66', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user66@example.com', '0901234632', 'hoạt động'),
(67, 'user67', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user67@example.com', '0901234633', 'hoạt động'),
(68, 'user68', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user68@example.com', '0901234634', 'hoạt động'),
(69, 'user69', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user69@example.com', '0901234635', 'hoạt động'),
(70, 'user70', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user70@example.com', '0901234636', 'hoạt động'),
(71, 'user71', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user71@example.com', '0901234637', 'hoạt động'),
(72, 'user72', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user72@example.com', '0901234638', 'hoạt động'),
(73, 'user73', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user73@example.com', '0901234639', 'hoạt động'),
(74, 'user74', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user74@example.com', '0901234640', 'hoạt động'),
(75, 'user75', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user75@example.com', '0901234641', 'hoạt động'),
(76, 'user76', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user76@example.com', '0901234642', 'hoạt động'),
(77, 'user77', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user77@example.com', '0901234643', 'hoạt động'),
(78, 'user78', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user78@example.com', '0901234644', 'hoạt động'),
(79, 'user79', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user79@example.com', '0901234645', 'hoạt động'),
(80, 'user80', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user80@example.com', '0901234646', 'hoạt động'),
(81, 'user81', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user81@example.com', '0901234647', 'hoạt động'),
(82, 'user82', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user82@example.com', '0901234648', 'hoạt động'),
(83, 'user83', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user83@example.com', '0901234649', 'hoạt động'),
(84, 'user84', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user84@example.com', '0901234650', 'hoạt động'),
(85, 'user85', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user85@example.com', '0901234651', 'hoạt động'),
(86, 'user86', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user86@example.com', '0901234652', 'hoạt động'),
(87, 'user87', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user87@example.com', '0901234653', 'hoạt động'),
(88, 'user88', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user88@example.com', '0901234654', 'hoạt động'),
(89, 'user89', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user89@example.com', '0901234655', 'hoạt động'),
(90, 'user90', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user90@example.com', '0901234656', 'hoạt động'),
(91, 'user91', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user91@example.com', '0901234657', 'hoạt động'),
(92, 'user92', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user92@example.com', '0901234658', 'hoạt động'),
(93, 'user93', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user93@example.com', '0901234659', 'hoạt động'),
(94, 'user94', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user94@example.com', '0901234660', 'hoạt động'),
(95, 'user95', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user95@example.com', '0901234661', 'hoạt động'),
(96, 'user96', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user96@example.com', '0901234662', 'hoạt động'),
(97, 'user97', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user97@example.com', '0901234663', 'hoạt động'),
(98, 'user98', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user98@example.com', '0901234664', 'hoạt động'),
(99, 'user99', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user99@example.com', '0901234665', 'hoạt động'),
(100, 'user100', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user100@example.com', '0901234666', 'hoạt động'),
(101, 'user150@example.com', '$2y$12$O0y5xl5SWkw8x3B7deTDD.p8R3xEUEsp8HsRHckB8ydwFzwwIETFi', 'user150@example.com', NULL, 'hoạt động'),
(102, 'user151@example.com', '$2y$12$Yrn2/n9V3Cxi1Cf.ulz6COnnFQeCZt3e8hrlNAVwYs7AEHH0cOcWq', 'user151@example.com', NULL, 'hoạt động'),
(103, 'user152@example.com', '$2y$12$gVPG7qIhLXwDRLCica7TbOlJeJK77kEnqMqb61BS0sgoauD2KECci', 'user152@example.com', NULL, 'hoạt động'),
(104, 'user153@example.com', '$2y$12$gy6T3uvsyin/AJ60GhzLUeqXSMY8sGO2kpD5C1gVIbtb3jJf837t.', 'user153@example.com', NULL, 'hoạt động'),
(105, 'user154@example.com', '$2y$12$4.Sy20IdcyYYZbP1C5R4beqogzFbCBjye5ITL1dfLEVpy0u9HEZFW', 'user154@example.com', NULL, 'hoạt động'),
(106, 'user155@example.com', '$2y$12$4cL4y1nqqmWMWsl5AuDEDO56NMYYdbV0/n0Pu2BqOVviI3ZR7f7s6', 'user155@example.com', NULL, 'hoạt động'),
(107, 'user156@example.com', '$2y$12$MywTjZ6U4InvHxaeJbG4MOidT7pmmVOI..ZGR4OE21uuTmwDZEI8O', 'user156@example.com', NULL, 'hoạt động'),
(108, 'user157@example.com', '$2y$12$d4wPZWTGn7TxAhWb1WEmc.7D1ttPDtaiqO2AGLFAOWpHfHNI6W.3G', 'user157@example.com', '0901234582', 'hoạt động'),
(109, 'user158@example.com', '$2y$12$ydBLfvojlGfUU7W6gW2UeOPVs4wM2.tyWfZ1o9WgshvGfPQxaNHO2', 'user158@example.com', NULL, 'hoạt động'),
(110, 'user159@example.com', '$2y$12$lQ7xoawS1zpznNrwEQ2lzO/G87dkaBkAKTWPMi/gcCnp04uWwE/Jy', 'user159@example.com', NULL, 'hoạt động'),
(111, 'user200@example.com', '$2y$12$HmZl30BApA44CQ.KUh44HucIzpkS2MPCwINj/C./04fxyeK03ysAi', 'user200@example.com', NULL, 'hoạt động');

-- --------------------------------------------------------

--
-- Table structure for table `noidungmonhoc`
--

CREATE TABLE `noidungmonhoc` (
  `id_noidung` int(11) NOT NULL,
  `id_monhoc` int(11) NOT NULL,
  `ten_tai_lieu` varchar(255) NOT NULL,
  `loai_tai_lieu` varchar(50) DEFAULT NULL,
  `duong_dan` varchar(500) NOT NULL,
  `nguoi_upload` int(11) NOT NULL,
  `ngay_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phanquyen`
--

CREATE TABLE `phanquyen` (
  `id_phanquyen` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `id_vaitro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phanquyen`
--

INSERT INTO `phanquyen` (`id_phanquyen`, `id_nguoidung`, `id_vaitro`) VALUES
(1, 1, 1),
(2, 2, 6),
(3, 3, 6),
(4, 4, 6),
(5, 5, 6),
(6, 6, 6),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 2),
(12, 12, 4),
(13, 13, 4),
(14, 14, 4),
(15, 15, 4),
(16, 16, 4),
(17, 17, 4),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 4),
(22, 22, 4),
(23, 23, 4),
(24, 24, 4),
(25, 25, 4),
(26, 26, 4),
(27, 27, 4),
(28, 28, 4),
(29, 29, 4),
(30, 30, 4),
(31, 31, 4),
(32, 32, 4),
(33, 33, 4),
(34, 34, 4),
(35, 35, 4),
(36, 36, 4),
(37, 37, 4),
(38, 38, 4),
(39, 39, 4),
(40, 40, 4),
(41, 41, 4),
(42, 42, 4),
(43, 43, 4),
(44, 44, 4),
(45, 45, 4),
(46, 46, 4),
(47, 47, 4),
(48, 48, 4),
(49, 49, 4),
(50, 50, 4),
(51, 51, 4),
(52, 52, 4),
(53, 53, 4),
(54, 54, 4),
(55, 55, 4),
(56, 56, 4),
(57, 57, 4),
(58, 58, 4),
(59, 59, 4),
(60, 60, 4),
(61, 61, 5),
(62, 62, 3),
(63, 63, 3),
(64, 64, 3),
(65, 65, 3),
(66, 66, 3),
(67, 67, 3),
(68, 68, 3),
(69, 69, 3),
(70, 70, 3),
(71, 71, 3),
(72, 72, 3),
(73, 73, 3),
(74, 74, 3),
(75, 75, 3),
(76, 76, 3),
(77, 77, 3),
(78, 78, 3),
(79, 79, 3),
(80, 80, 3),
(81, 81, 3),
(82, 82, 3),
(83, 83, 3),
(84, 84, 3),
(85, 85, 3),
(86, 86, 3),
(87, 87, 3),
(88, 88, 3),
(89, 89, 3),
(90, 90, 3),
(91, 91, 3),
(92, 92, 3),
(93, 93, 3),
(94, 94, 3),
(95, 95, 3),
(96, 96, 3),
(97, 97, 3),
(98, 98, 3),
(99, 99, 3),
(100, 100, 3),
(101, 101, 3),
(102, 102, 3),
(103, 103, 3),
(104, 104, 3),
(105, 105, 3),
(106, 106, 3),
(107, 107, 3),
(108, 108, 3),
(109, 109, 3),
(110, 110, 3),
(111, 111, 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5FFYoBjeYsQfBagFBChNd3k4hhOdiEkpqbH8JzIa', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR1FuSU11VVdJSmZORnVzUW1Yd2VIQkw2Mk5hblBWaE4zUWJpTjUwdSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qcy92ZW5kb3Ivc2VsZWN0Mi5taW4uanMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1733888080);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `id_sinhvien` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `ten_sinhvien` varchar(255) NOT NULL,
  `lop` varchar(100) DEFAULT NULL,
  `ma_chuyen_nganh` int(11) DEFAULT NULL,
  `nam_vao_hoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`id_sinhvien`, `id_nguoidung`, `ten_sinhvien`, `lop`, `ma_chuyen_nganh`, `nam_vao_hoc`) VALUES
(62, 62, 'Đoàn Nguyên Đức', 'KTPM01', 1, 2023),
(63, 63, 'Đoàn Dự', 'KTPM01', 1, 2023),
(64, 64, 'Sinh viên user64', 'KTPM01', 1, 2023),
(65, 65, 'Sinh viên user65', 'KTPM01', 1, 2023),
(66, 66, 'Sinh viên user66', 'KTPM01', 1, 2023),
(67, 67, 'Sinh viên user67', 'KTPM01', 1, 2023),
(68, 68, 'Sinh viên user68', 'KTPM01', 1, 2023),
(69, 69, 'Sinh viên user69', 'KTPM01', 1, 2023),
(70, 70, 'Sinh viên user70', 'KTPM01', 1, 2023),
(71, 71, 'Sinh viên user71', 'KTPM01', 1, 2023),
(72, 72, 'Sinh viên user72', 'KTPM02', 1, 2023),
(73, 73, 'Sinh viên user73', 'KTPM02', 1, 2023),
(74, 74, 'Sinh viên user74', 'KTPM02', 1, 2023),
(75, 75, 'Sinh viên user75', 'KTPM02', 1, 2023),
(76, 76, 'Sinh viên user76', 'KTPM02', 1, 2023),
(77, 77, 'Sinh viên user77', 'KTPM02', 1, 2023),
(78, 78, 'Sinh viên user78', 'KTPM02', 1, 2023),
(79, 79, 'Sinh viên user79', 'KTPM02', 1, 2023),
(80, 80, 'Sinh viên user80', 'KTPM02', 1, 2023),
(81, 81, 'Sinh viên user81', 'KTPM02', 1, 2023),
(82, 82, 'Sinh viên user82', 'KTPM03', 1, 2023),
(83, 83, 'Sinh viên user83', 'KTPM03', 1, 2023),
(84, 84, 'Sinh viên user84', 'KTPM03', 1, 2023),
(85, 85, 'Sinh viên user85', 'KTPM03', 1, 2023),
(86, 86, 'Sinh viên user86', 'KTPM03', 1, 2023),
(87, 87, 'Sinh viên user87', 'KTPM03', 1, 2023),
(88, 88, 'Sinh viên user88', 'KTPM03', 1, 2023),
(89, 89, 'Sinh viên user89', 'KTPM03', 1, 2023),
(90, 90, 'Sinh viên user90', 'KTPM03', 1, 2023),
(91, 91, 'Sinh viên user91', 'KTPM03', 1, 2023),
(92, 92, 'Sinh viên user92', 'MMT01', 2, 2023),
(93, 93, 'Sinh viên user93', 'MMT01', 2, 2023),
(94, 94, 'Sinh viên user94', 'MMT01', 2, 2023),
(95, 95, 'Sinh viên user95', 'MMT01', 2, 2023),
(96, 96, 'Sinh viên user96', 'MMT01', 2, 2023),
(97, 97, 'Sinh viên user97', 'MMT02', 2, 2023),
(98, 98, 'Sinh viên user98', 'MMT02', 2, 2023),
(99, 99, 'Sinh viên user99', 'MMT02', 2, 2023),
(100, 100, 'Sinh viên user100', 'MMT02', 2, 2023),
(101, 101, 'Đoàn Văn Vương', 'ATTT01', 4, 2023),
(102, 102, 'Lâm Chấn Đông', 'ATTT02', 4, 2023),
(103, 103, 'Tấm', 'ATTT03', 4, 2023),
(104, 104, 'Hoàng Mạnh Hà', 'HTTT01', 5, 2023),
(105, 105, 'Nguyễn Đức', 'ATTT01', 4, 2023),
(106, 106, 'Chẩu Mạnh Hà', 'ATTT01', 4, 2023),
(107, 107, 'Trần Đức Bình', 'ATTT01', 4, 2023),
(108, 108, 'Hoàng Việt Cồ', 'ATTT01', 4, 2023),
(109, 109, 'Văn Bằng', 'ATTT01', 4, 2023),
(110, 110, 'Khổng Tử', 'ATTT01', 4, 2023),
(111, 111, 'Nguyễn Chí Cường', 'ATTT02', 4, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `thanhtich`
--

CREATE TABLE `thanhtich` (
  `id_thanhtich` int(11) NOT NULL,
  `id_sinhvien` int(11) NOT NULL,
  `ten_thanhtich` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `ngay_dat_duoc` date NOT NULL,
  `loai_thanhtich` enum('Cá nhân','Nhóm') DEFAULT 'Cá nhân'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `id_thanhtoan` int(11) NOT NULL,
  `id_hocphi` int(11) NOT NULL,
  `so_tien_da_tra` decimal(10,2) NOT NULL,
  `phuong_thuc` enum('Tiền mặt','Chuyển khoản','Thẻ tín dụng') NOT NULL,
  `ngay_thanhtoan` datetime DEFAULT current_timestamp(),
  `trang_thai` enum('Thành công','Chờ xử lý','Thất bại') DEFAULT 'Chờ xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `id_thoikhoabieu` int(11) NOT NULL,
  `id_monhoc` int(11) NOT NULL,
  `id_giaovien` int(11) NOT NULL,
  `id_lop` int(11) NOT NULL,
  `id_phonghoc` int(11) NOT NULL,
  `ngay_hoc` date NOT NULL,
  `gio_bat_dau` time NOT NULL,
  `gio_ket_thuc` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thoikhoabieu`
--

INSERT INTO `thoikhoabieu` (`id_thoikhoabieu`, `id_monhoc`, `id_giaovien`, `id_lop`, `id_phonghoc`, `ngay_hoc`, `gio_bat_dau`, `gio_ket_thuc`) VALUES
(281, 1, 12, 1, 1, '2024-12-02', '13:00:00', '15:00:00'),
(282, 2, 13, 1, 2, '2024-12-03', '13:00:00', '15:00:00'),
(283, 3, 14, 1, 3, '2024-12-04', '13:00:00', '15:00:00'),
(284, 4, 15, 1, 4, '2024-12-05', '13:00:00', '15:00:00'),
(285, 5, 16, 2, 5, '2024-12-02', '13:00:00', '15:00:00'),
(286, 6, 17, 2, 6, '2024-12-03', '13:00:00', '15:00:00'),
(287, 7, 18, 2, 7, '2024-12-04', '13:00:00', '15:00:00'),
(288, 8, 19, 2, 8, '2024-12-05', '13:00:00', '15:00:00'),
(289, 9, 20, 3, 9, '2024-12-02', '07:30:00', '09:00:00'),
(290, 10, 21, 3, 10, '2024-12-03', '07:30:00', '09:00:00'),
(291, 11, 22, 3, 11, '2024-12-04', '07:30:00', '09:00:00'),
(292, 12, 23, 3, 12, '2024-12-05', '07:30:00', '09:00:00'),
(293, 13, 24, 4, 13, '2024-12-02', '07:30:00', '09:00:00'),
(294, 14, 25, 4, 14, '2024-12-03', '07:30:00', '09:00:00'),
(295, 15, 26, 4, 15, '2024-12-04', '07:30:00', '09:00:00'),
(296, 16, 27, 4, 16, '2024-12-05', '07:30:00', '09:00:00'),
(297, 17, 28, 5, 17, '2024-12-02', '13:00:00', '15:00:00'),
(298, 18, 29, 5, 18, '2024-12-03', '13:00:00', '15:00:00'),
(299, 19, 30, 5, 19, '2024-12-04', '13:00:00', '15:00:00'),
(300, 20, 31, 5, 20, '2024-12-05', '13:00:00', '15:00:00'),
(301, 21, 32, 6, 21, '2024-12-02', '07:30:00', '09:00:00'),
(302, 22, 33, 6, 22, '2024-12-03', '07:30:00', '09:00:00'),
(303, 23, 34, 6, 23, '2024-12-04', '07:30:00', '09:00:00'),
(304, 24, 35, 6, 24, '2024-12-05', '07:30:00', '09:00:00'),
(305, 36, 36, 7, 25, '2024-12-02', '13:00:00', '15:00:00'),
(306, 37, 37, 7, 26, '2024-12-03', '13:00:00', '15:00:00'),
(307, 38, 38, 7, 27, '2024-12-04', '13:00:00', '15:00:00'),
(308, 39, 39, 7, 28, '2024-12-05', '13:00:00', '15:00:00'),
(309, 40, 40, 8, 29, '2024-12-02', '07:30:00', '09:00:00'),
(310, 41, 41, 8, 30, '2024-12-03', '07:30:00', '09:00:00'),
(311, 42, 42, 8, 31, '2024-12-04', '07:30:00', '09:00:00'),
(312, 43, 43, 8, 32, '2024-12-05', '07:30:00', '09:00:00'),
(313, 11, 44, 9, 51, '2024-12-02', '13:00:00', '15:00:00'),
(314, 12, 45, 9, 52, '2024-12-03', '13:00:00', '15:00:00'),
(315, 13, 46, 9, 53, '2024-12-04', '13:00:00', '15:00:00'),
(316, 14, 47, 9, 54, '2024-12-05', '13:00:00', '15:00:00'),
(317, 15, 48, 10, 55, '2024-12-02', '13:00:00', '15:00:00'),
(318, 16, 49, 10, 56, '2024-12-03', '13:00:00', '15:00:00'),
(319, 17, 1, 10, 57, '2024-12-04', '13:00:00', '15:00:00'),
(320, 18, 2, 10, 58, '2024-12-05', '13:00:00', '15:00:00'),
(321, 19, 3, 11, 59, '2024-12-02', '07:30:00', '09:00:00'),
(322, 20, 4, 11, 60, '2024-12-03', '07:30:00', '09:00:00'),
(323, 21, 5, 11, 61, '2024-12-04', '07:30:00', '09:00:00'),
(324, 22, 6, 11, 62, '2024-12-05', '07:30:00', '09:00:00'),
(325, 23, 7, 12, 63, '2024-12-02', '07:30:00', '09:00:00'),
(326, 24, 8, 12, 64, '2024-12-03', '07:30:00', '09:00:00'),
(327, 25, 9, 12, 65, '2024-12-04', '07:30:00', '09:00:00'),
(328, 26, 10, 12, 66, '2024-12-05', '07:30:00', '09:00:00'),
(329, 27, 11, 13, 67, '2024-12-02', '13:00:00', '15:00:00'),
(330, 28, 12, 13, 68, '2024-12-03', '13:00:00', '15:00:00'),
(331, 29, 13, 13, 69, '2024-12-04', '13:00:00', '15:00:00'),
(332, 30, 14, 13, 70, '2024-12-05', '13:00:00', '15:00:00'),
(333, 31, 15, 14, 71, '2024-12-02', '07:30:00', '09:00:00'),
(334, 32, 16, 14, 72, '2024-12-03', '07:30:00', '09:00:00'),
(335, 33, 17, 14, 73, '2024-12-04', '07:30:00', '09:00:00'),
(336, 34, 18, 14, 74, '2024-12-05', '07:30:00', '09:00:00'),
(337, 35, 19, 15, 75, '2024-12-02', '13:00:00', '15:00:00'),
(338, 36, 20, 15, 76, '2024-12-03', '13:00:00', '15:00:00'),
(339, 37, 21, 15, 77, '2024-12-04', '13:00:00', '15:00:00'),
(340, 38, 22, 15, 78, '2024-12-05', '13:00:00', '15:00:00'),
(341, 39, 23, 16, 79, '2024-12-02', '07:30:00', '09:00:00'),
(342, 40, 24, 16, 80, '2024-12-03', '07:30:00', '09:00:00'),
(343, 41, 25, 16, 81, '2024-12-04', '07:30:00', '09:00:00'),
(344, 42, 26, 16, 82, '2024-12-05', '07:30:00', '09:00:00'),
(345, 43, 27, 17, 83, '2024-12-02', '13:00:00', '15:00:00'),
(346, 44, 28, 17, 84, '2024-12-03', '13:00:00', '15:00:00'),
(347, 45, 29, 17, 85, '2024-12-04', '13:00:00', '15:00:00'),
(348, 46, 30, 17, 86, '2024-12-05', '13:00:00', '15:00:00'),
(349, 47, 31, 18, 87, '2024-12-02', '07:30:00', '09:00:00'),
(350, 48, 32, 18, 88, '2024-12-03', '07:30:00', '09:00:00'),
(351, 49, 33, 18, 89, '2024-12-04', '07:30:00', '09:00:00'),
(352, 50, 34, 18, 90, '2024-12-05', '07:30:00', '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE `thong_bao` (
  `id_thongbao` int(11) NOT NULL,
  `id_nguoidung` int(11) NOT NULL,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `loai_thongbao` varchar(50) DEFAULT NULL,
  `da_doc` tinyint(1) DEFAULT 0,
  `thoi_gian` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thong_bao`
--

INSERT INTO `thong_bao` (`id_thongbao`, `id_nguoidung`, `tieu_de`, `noi_dung`, `loai_thongbao`, `da_doc`, `thoi_gian`) VALUES
(1, 1, 'Chào mừng đến với hệ thống', 'Chào mừng user01 đến với hệ thống quản lý.', 'system', 1, '2024-12-09 14:13:53'),
(2, 1, 'Cập nhật thông tin', 'Vui lòng cập nhật thông tin cá nhân của bạn.', 'info', 1, '2024-12-09 13:13:53'),
(3, 1, 'Nhiệm vụ mới', 'Bạn có một nhiệm vụ mới cần xử lý.', 'task', 1, '2024-12-09 12:13:53'),
(4, 1, 'Bảo mật tài khoản', 'Vui lòng thay đổi mật khẩu định kỳ để bảo vệ tài khoản.', 'security', 1, '2024-12-08 14:13:53'),
(5, 1, 'Thông báo bảo trì', 'Hệ thống sẽ bảo trì vào ngày mai.', 'maintenance', 1, '2024-12-07 14:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `thuoctinhchung`
--

CREATE TABLE `thuoctinhchung` (
  `id_thuoctinh` int(11) NOT NULL,
  `ten_thuoctinh` varchar(255) NOT NULL,
  `gia_tri` text NOT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_nguoidung` (`id_nguoidung`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  ADD PRIMARY KEY (`id_chitiet`),
  ADD KEY `ma_chuyennganh` (`ma_chuyennganh`),
  ADD KEY `ma_monhoc` (`ma_monhoc`);

--
-- Indexes for table `chitiethocphi`
--
ALTER TABLE `chitiethocphi`
  ADD PRIMARY KEY (`id_chitiethocphi`),
  ADD KEY `id_hocphi` (`id_hocphi`),
  ADD KEY `id_monhoc` (`id_monhoc`);

--
-- Indexes for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  ADD PRIMARY KEY (`id_chitietmonhoc`),
  ADD KEY `ma_monhoc` (`ma_monhoc`);

--
-- Indexes for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`id_chuyennganh`),
  ADD KEY `FK_chuyennganh_khoa` (`ma_khoa`);

--
-- Indexes for table `dangkyhoc`
--
ALTER TABLE `dangkyhoc`
  ADD PRIMARY KEY (`id_dangky`),
  ADD KEY `id_sinhvien` (`id_sinhvien`),
  ADD KEY `id_thoikhoabieu` (`id_thoikhoabieu`);

--
-- Indexes for table `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`id_diem`),
  ADD KEY `id_sinhvien` (`id_sinhvien`),
  ADD KEY `id_monhoc` (`id_monhoc`);

--
-- Indexes for table `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD PRIMARY KEY (`id_diemdanh`),
  ADD KEY `id_sinhvien` (`id_sinhvien`),
  ADD KEY `id_thoikhoabieu` (`id_thoikhoabieu`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_nguoidung`
--
ALTER TABLE `file_nguoidung`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_nguoidung` (`id_nguoidung`);

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`id_giaovien`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `ma_khoa` (`ma_khoa`);

--
-- Indexes for table `giaovien_monhoc`
--
ALTER TABLE `giaovien_monhoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_giaovien` (`ma_giaovien`),
  ADD KEY `ma_monhoc` (`ma_monhoc`);

--
-- Indexes for table `hieutruong`
--
ALTER TABLE `hieutruong`
  ADD PRIMARY KEY (`id_hieutruong`),
  ADD KEY `id_nguoidung` (`id_nguoidung`);

--
-- Indexes for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD PRIMARY KEY (`id_hocphi`),
  ADD KEY `id_sinhvien` (`id_sinhvien`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ketoan`
--
ALTER TABLE `ketoan`
  ADD PRIMARY KEY (`id_ketoan`),
  ADD KEY `id_nguoidung` (`id_nguoidung`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`id_khoa`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id_lop`),
  ADD KEY `ma_phong_hoc` (`ma_phong_hoc`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id_monhoc`),
  ADD KEY `ma_chuyen_nganh` (`ma_chuyen_nganh`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id_nguoidung`);

--
-- Indexes for table `noidungmonhoc`
--
ALTER TABLE `noidungmonhoc`
  ADD PRIMARY KEY (`id_noidung`),
  ADD KEY `id_monhoc` (`id_monhoc`),
  ADD KEY `nguoi_upload` (`nguoi_upload`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`id_phanquyen`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `id_vaitro` (`id_vaitro`);

--
-- Indexes for table `phonghoc`
--
ALTER TABLE `phonghoc`
  ADD PRIMARY KEY (`id_phonghoc`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id_sinhvien`),
  ADD KEY `id_nguoidung` (`id_nguoidung`),
  ADD KEY `ma_chuyen_nganh` (`ma_chuyen_nganh`);

--
-- Indexes for table `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD PRIMARY KEY (`id_thanhtich`),
  ADD KEY `id_sinhvien` (`id_sinhvien`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`id_thanhtoan`),
  ADD KEY `id_hocphi` (`id_hocphi`);

--
-- Indexes for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`id_thoikhoabieu`),
  ADD KEY `id_monhoc` (`id_monhoc`),
  ADD KEY `id_giaovien` (`id_giaovien`),
  ADD KEY `id_lop` (`id_lop`),
  ADD KEY `id_phonghoc` (`id_phonghoc`);

--
-- Indexes for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD PRIMARY KEY (`id_thongbao`),
  ADD KEY `fk_thongbao_nguoidung` (`id_nguoidung`);

--
-- Indexes for table `thuoctinhchung`
--
ALTER TABLE `thuoctinhchung`
  ADD PRIMARY KEY (`id_thuoctinh`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`id_vaitro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  MODIFY `id_chitiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `chitiethocphi`
--
ALTER TABLE `chitiethocphi`
  MODIFY `id_chitiethocphi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  MODIFY `id_chitietmonhoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  MODIFY `id_chuyennganh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `dangkyhoc`
--
ALTER TABLE `dangkyhoc`
  MODIFY `id_dangky` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem`
--
ALTER TABLE `diem`
  MODIFY `id_diem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diemdanh`
--
ALTER TABLE `diemdanh`
  MODIFY `id_diemdanh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_nguoidung`
--
ALTER TABLE `file_nguoidung`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `id_giaovien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `giaovien_monhoc`
--
ALTER TABLE `giaovien_monhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hieutruong`
--
ALTER TABLE `hieutruong`
  MODIFY `id_hieutruong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hocphi`
--
ALTER TABLE `hocphi`
  MODIFY `id_hocphi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ketoan`
--
ALTER TABLE `ketoan`
  MODIFY `id_ketoan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `id_khoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id_lop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `id_monhoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id_nguoidung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `noidungmonhoc`
--
ALTER TABLE `noidungmonhoc`
  MODIFY `id_noidung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phanquyen`
--
ALTER TABLE `phanquyen`
  MODIFY `id_phanquyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `phonghoc`
--
ALTER TABLE `phonghoc`
  MODIFY `id_phonghoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id_sinhvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `thanhtich`
--
ALTER TABLE `thanhtich`
  MODIFY `id_thanhtich` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `id_thanhtoan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  MODIFY `id_thoikhoabieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `thong_bao`
--
ALTER TABLE `thong_bao`
  MODIFY `id_thongbao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thuoctinhchung`
--
ALTER TABLE `thuoctinhchung`
  MODIFY `id_thuoctinh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `id_vaitro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;

--
-- Constraints for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  ADD CONSTRAINT `chitietchuyennganh_ibfk_1` FOREIGN KEY (`ma_chuyennganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietchuyennganh_ibfk_2` FOREIGN KEY (`ma_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE;

--
-- Constraints for table `chitiethocphi`
--
ALTER TABLE `chitiethocphi`
  ADD CONSTRAINT `chitiethocphi_ibfk_1` FOREIGN KEY (`id_hocphi`) REFERENCES `hocphi` (`id_hocphi`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitiethocphi_ibfk_2` FOREIGN KEY (`id_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE SET NULL;

--
-- Constraints for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  ADD CONSTRAINT `chitietmonhoc_ibfk_1` FOREIGN KEY (`ma_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE;

--
-- Constraints for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD CONSTRAINT `FK_chuyennganh_khoa` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`id_khoa`) ON DELETE CASCADE;

--
-- Constraints for table `dangkyhoc`
--
ALTER TABLE `dangkyhoc`
  ADD CONSTRAINT `dangkyhoc_ibfk_1` FOREIGN KEY (`id_sinhvien`) REFERENCES `sinhvien` (`id_sinhvien`) ON DELETE CASCADE,
  ADD CONSTRAINT `dangkyhoc_ibfk_2` FOREIGN KEY (`id_thoikhoabieu`) REFERENCES `thoikhoabieu` (`id_thoikhoabieu`) ON DELETE CASCADE;

--
-- Constraints for table `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `diem_ibfk_1` FOREIGN KEY (`id_sinhvien`) REFERENCES `sinhvien` (`id_sinhvien`) ON DELETE CASCADE,
  ADD CONSTRAINT `diem_ibfk_2` FOREIGN KEY (`id_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE;

--
-- Constraints for table `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD CONSTRAINT `diemdanh_ibfk_1` FOREIGN KEY (`id_sinhvien`) REFERENCES `sinhvien` (`id_sinhvien`) ON DELETE CASCADE,
  ADD CONSTRAINT `diemdanh_ibfk_2` FOREIGN KEY (`id_thoikhoabieu`) REFERENCES `thoikhoabieu` (`id_thoikhoabieu`) ON DELETE CASCADE;

--
-- Constraints for table `file_nguoidung`
--
ALTER TABLE `file_nguoidung`
  ADD CONSTRAINT `file_nguoidung_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE,
  ADD CONSTRAINT `giaovien_ibfk_2` FOREIGN KEY (`ma_khoa`) REFERENCES `khoa` (`id_khoa`);

--
-- Constraints for table `giaovien_monhoc`
--
ALTER TABLE `giaovien_monhoc`
  ADD CONSTRAINT `giaovien_monhoc_ibfk_1` FOREIGN KEY (`ma_giaovien`) REFERENCES `giaovien` (`id_giaovien`),
  ADD CONSTRAINT `giaovien_monhoc_ibfk_2` FOREIGN KEY (`ma_monhoc`) REFERENCES `monhoc` (`id_monhoc`);

--
-- Constraints for table `hieutruong`
--
ALTER TABLE `hieutruong`
  ADD CONSTRAINT `hieutruong_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;

--
-- Constraints for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD CONSTRAINT `hocphi_ibfk_1` FOREIGN KEY (`id_sinhvien`) REFERENCES `sinhvien` (`id_sinhvien`) ON DELETE CASCADE;

--
-- Constraints for table `ketoan`
--
ALTER TABLE `ketoan`
  ADD CONSTRAINT `ketoan_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`ma_phong_hoc`) REFERENCES `phonghoc` (`id_phonghoc`) ON DELETE SET NULL;

--
-- Constraints for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `monhoc_ibfk_1` FOREIGN KEY (`ma_chuyen_nganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE SET NULL;

--
-- Constraints for table `noidungmonhoc`
--
ALTER TABLE `noidungmonhoc`
  ADD CONSTRAINT `noidungmonhoc_ibfk_1` FOREIGN KEY (`id_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE,
  ADD CONSTRAINT `noidungmonhoc_ibfk_2` FOREIGN KEY (`nguoi_upload`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE;

--
-- Constraints for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD CONSTRAINT `phanquyen_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE,
  ADD CONSTRAINT `phanquyen_ibfk_2` FOREIGN KEY (`id_vaitro`) REFERENCES `vaitro` (`id_vaitro`) ON DELETE CASCADE;

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`) ON DELETE CASCADE,
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`ma_chuyen_nganh`) REFERENCES `chuyennganh` (`id_chuyennganh`) ON DELETE SET NULL;

--
-- Constraints for table `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD CONSTRAINT `thanhtich_ibfk_1` FOREIGN KEY (`id_sinhvien`) REFERENCES `sinhvien` (`id_sinhvien`) ON DELETE CASCADE;

--
-- Constraints for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`id_hocphi`) REFERENCES `hocphi` (`id_hocphi`) ON DELETE CASCADE;

--
-- Constraints for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `thoikhoabieu_ibfk_1` FOREIGN KEY (`id_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE,
  ADD CONSTRAINT `thoikhoabieu_ibfk_2` FOREIGN KEY (`id_giaovien`) REFERENCES `giaovien` (`id_giaovien`) ON DELETE CASCADE,
  ADD CONSTRAINT `thoikhoabieu_ibfk_3` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`) ON DELETE CASCADE,
  ADD CONSTRAINT `thoikhoabieu_ibfk_4` FOREIGN KEY (`id_phonghoc`) REFERENCES `phonghoc` (`id_phonghoc`) ON DELETE CASCADE;

--
-- Constraints for table `thong_bao`
--
ALTER TABLE `thong_bao`
  ADD CONSTRAINT `fk_thongbao_nguoidung` FOREIGN KEY (`id_nguoidung`) REFERENCES `nguoidung` (`id_nguoidung`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
