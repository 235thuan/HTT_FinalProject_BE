-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 08:57 AM
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
(65, 25, 'Vi sinh học và các bệnh truyền nhiễm, ứng dụng trong ngành y tế.', 55),
(66, 26, 'Nghiên cứu về các bệnh lý răng hàm mặt và phương pháp điều trị.', 50),
(70, 30, 'Cơ sở xây dựng dân dụng và các công trình xây dựng trong đô thị.', 50),
(71, 31, 'Kết cấu công trình xây dựng, vật liệu và quy trình thi công.', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  ADD PRIMARY KEY (`id_chitietmonhoc`),
  ADD KEY `ma_monhoc` (`ma_monhoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  MODIFY `id_chitietmonhoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  ADD CONSTRAINT `chitietmonhoc_ibfk_1` FOREIGN KEY (`ma_monhoc`) REFERENCES `monhoc` (`id_monhoc`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
