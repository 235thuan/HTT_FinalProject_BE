-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:09 AM
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
(100, 'user100', '$2y$10$L2m5gFqA.QWUV6aZCUFxyeFojg6tU6yTk3ehXQyYSsPtvFQwzMYcW', 'user100@example.com', '0901234666', 'hoạt động');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id_nguoidung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id_nguoidung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
