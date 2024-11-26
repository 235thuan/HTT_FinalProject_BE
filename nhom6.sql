-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 03:00 AM
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
-- Database: `nhom6`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `QuyenHan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietchuyennganh`
--

CREATE TABLE `chitietchuyennganh` (
  `ChiTietChuyenNganhID` int(11) NOT NULL,
  `ChuyenNganhID` int(11) DEFAULT NULL,
  `MonHocID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitiethocphi`
--

CREATE TABLE `chitiethocphi` (
  `ChiTietHocPhiID` int(11) NOT NULL,
  `HocPhiID` int(11) DEFAULT NULL,
  `ThuocTinhChungID` int(11) DEFAULT NULL,
  `MonHocID` int(11) DEFAULT NULL,
  `GiaMonHoc` decimal(10,2) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietmonhoc`
--

CREATE TABLE `chitietmonhoc` (
  `ChiTietMonHocID` int(11) NOT NULL,
  `MonHocID` int(11) DEFAULT NULL,
  `GiaoVienID` int(11) DEFAULT NULL,
  `ThoiKhoaBieuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `ChuyenNganhID` int(11) NOT NULL,
  `TenChuyenNganh` varchar(100) DEFAULT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem`
--

CREATE TABLE `diem` (
  `DiemID` int(11) NOT NULL,
  `SinhVienID` int(11) DEFAULT NULL,
  `DiemSo` decimal(5,2) DEFAULT NULL,
  `MonHocID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diemdanh`
--

CREATE TABLE `diemdanh` (
  `DiemDanhID` int(11) NOT NULL,
  `SinhVienID` int(11) DEFAULT NULL,
  `NgayDiemDanh` date DEFAULT NULL,
  `MonHocID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `GiaoVienID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `ChuyenNganhID` int(11) DEFAULT NULL,
  `SoluongGv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hieutruong`
--

CREATE TABLE `hieutruong` (
  `HieuTruongID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `NgayNhanChuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocphi`
--

CREATE TABLE `hocphi` (
  `HocPhiID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `TongGia` decimal(10,2) DEFAULT NULL,
  `NgayTao` date DEFAULT NULL,
  `TrangThaiGio` varchar(100) DEFAULT NULL,
  `ThuocTinhChungID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ketoan`
--

CREATE TABLE `ketoan` (
  `KeToanID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `NgayBatDauLamViec` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `MonHocID` int(11) NOT NULL,
  `TenMonHoc` varchar(100) DEFAULT NULL,
  `Gia` decimal(10,2) DEFAULT NULL,
  `MoTa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `NguoiDungID` int(11) NOT NULL,
  `Ten` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `MatKhau` varchar(100) DEFAULT NULL,
  `LoaiNguoiDung` enum('HieuTruong','GiaoVien','KeToan','SinhVien') DEFAULT NULL,
  `VaiTroID` int(11) DEFAULT NULL,
  `ThuocTinhChungID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noidungmonhoc`
--

CREATE TABLE `noidungmonhoc` (
  `ContentID` int(11) NOT NULL,
  `ChiTietMonHocID` int(11) DEFAULT NULL,
  `LoaiNoiDung` varchar(100) DEFAULT NULL,
  `DuongDan` varchar(255) DEFAULT NULL,
  `ThuocTinhChungID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `SinhVienID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `ChuyenNganhID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanhtich`
--

CREATE TABLE `thanhtich` (
  `ThanhTichID` int(11) NOT NULL,
  `DiemID` int(11) DEFAULT NULL,
  `DiemDanhID` int(11) DEFAULT NULL,
  `ChiTietMonHocID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `ThanhToanID` int(11) NOT NULL,
  `HocPhiID` int(11) DEFAULT NULL,
  `ThuocTinhChungID` int(11) DEFAULT NULL,
  `SoTien` decimal(10,2) DEFAULT NULL,
  `NgayThanhToan` date DEFAULT NULL,
  `TrangThaiThanhToan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `ThoiKhoaBieuID` int(11) NOT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `MonHocID` int(11) DEFAULT NULL,
  `GiaoVienID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thuoctinhchung`
--

CREATE TABLE `thuoctinhchung` (
  `ThuocTinhChungID` int(11) NOT NULL,
  `Ten` varchar(100) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `TrangThai` varchar(100) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `NgayCapNhat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `VaiTroID` int(11) NOT NULL,
  `TenVaiTro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`);

--
-- Indexes for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  ADD PRIMARY KEY (`ChiTietChuyenNganhID`),
  ADD KEY `ChuyenNganhID` (`ChuyenNganhID`),
  ADD KEY `MonHocID` (`MonHocID`);

--
-- Indexes for table `chitiethocphi`
--
ALTER TABLE `chitiethocphi`
  ADD PRIMARY KEY (`ChiTietHocPhiID`),
  ADD KEY `HocPhiID` (`HocPhiID`),
  ADD KEY `MonHocID` (`MonHocID`),
  ADD KEY `ThuocTinhChungID` (`ThuocTinhChungID`);

--
-- Indexes for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  ADD PRIMARY KEY (`ChiTietMonHocID`),
  ADD KEY `MonHocID` (`MonHocID`),
  ADD KEY `GiaoVienID` (`GiaoVienID`),
  ADD KEY `ThoiKhoaBieuID` (`ThoiKhoaBieuID`);

--
-- Indexes for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`ChuyenNganhID`);

--
-- Indexes for table `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`DiemID`),
  ADD KEY `SinhVienID` (`SinhVienID`),
  ADD KEY `MonHocID` (`MonHocID`);

--
-- Indexes for table `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD PRIMARY KEY (`DiemDanhID`),
  ADD KEY `SinhVienID` (`SinhVienID`),
  ADD KEY `MonHocID` (`MonHocID`);

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`GiaoVienID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`),
  ADD KEY `ChuyenNganhID` (`ChuyenNganhID`);

--
-- Indexes for table `hieutruong`
--
ALTER TABLE `hieutruong`
  ADD PRIMARY KEY (`HieuTruongID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`);

--
-- Indexes for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD PRIMARY KEY (`HocPhiID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`),
  ADD KEY `ThuocTinhChungID` (`ThuocTinhChungID`);

--
-- Indexes for table `ketoan`
--
ALTER TABLE `ketoan`
  ADD PRIMARY KEY (`KeToanID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MonHocID`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`NguoiDungID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `VaiTroID` (`VaiTroID`),
  ADD KEY `ThuocTinhChungID` (`ThuocTinhChungID`);

--
-- Indexes for table `noidungmonhoc`
--
ALTER TABLE `noidungmonhoc`
  ADD PRIMARY KEY (`ContentID`),
  ADD KEY `ChiTietMonHocID` (`ChiTietMonHocID`),
  ADD KEY `ThuocTinhChungID` (`ThuocTinhChungID`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`SinhVienID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`),
  ADD KEY `ChuyenNganhID` (`ChuyenNganhID`);

--
-- Indexes for table `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD PRIMARY KEY (`ThanhTichID`),
  ADD KEY `DiemID` (`DiemID`),
  ADD KEY `DiemDanhID` (`DiemDanhID`),
  ADD KEY `ChiTietMonHocID` (`ChiTietMonHocID`);

--
-- Indexes for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`ThanhToanID`),
  ADD KEY `HocPhiID` (`HocPhiID`),
  ADD KEY `ThuocTinhChungID` (`ThuocTinhChungID`);

--
-- Indexes for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`ThoiKhoaBieuID`),
  ADD KEY `MonHocID` (`MonHocID`),
  ADD KEY `GiaoVienID` (`GiaoVienID`);

--
-- Indexes for table `thuoctinhchung`
--
ALTER TABLE `thuoctinhchung`
  ADD PRIMARY KEY (`ThuocTinhChungID`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`VaiTroID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`NguoiDungID`);

--
-- Constraints for table `chitietchuyennganh`
--
ALTER TABLE `chitietchuyennganh`
  ADD CONSTRAINT `chitietchuyennganh_ibfk_1` FOREIGN KEY (`ChuyenNganhID`) REFERENCES `chuyennganh` (`ChuyenNganhID`),
  ADD CONSTRAINT `chitietchuyennganh_ibfk_2` FOREIGN KEY (`MonHocID`) REFERENCES `monhoc` (`MonHocID`);

--
-- Constraints for table `chitiethocphi`
--
ALTER TABLE `chitiethocphi`
  ADD CONSTRAINT `chitiethocphi_ibfk_1` FOREIGN KEY (`HocPhiID`) REFERENCES `hocphi` (`HocPhiID`),
  ADD CONSTRAINT `chitiethocphi_ibfk_2` FOREIGN KEY (`MonHocID`) REFERENCES `monhoc` (`MonHocID`),
  ADD CONSTRAINT `chitiethocphi_ibfk_3` FOREIGN KEY (`ThuocTinhChungID`) REFERENCES `thuoctinhchung` (`ThuocTinhChungID`);

--
-- Constraints for table `chitietmonhoc`
--
ALTER TABLE `chitietmonhoc`
  ADD CONSTRAINT `chitietmonhoc_ibfk_1` FOREIGN KEY (`MonHocID`) REFERENCES `monhoc` (`MonHocID`),
  ADD CONSTRAINT `chitietmonhoc_ibfk_2` FOREIGN KEY (`GiaoVienID`) REFERENCES `giaovien` (`GiaoVienID`),
  ADD CONSTRAINT `chitietmonhoc_ibfk_3` FOREIGN KEY (`ThoiKhoaBieuID`) REFERENCES `thoikhoabieu` (`ThoiKhoaBieuID`);

--
-- Constraints for table `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `diem_ibfk_1` FOREIGN KEY (`SinhVienID`) REFERENCES `sinhvien` (`SinhVienID`),
  ADD CONSTRAINT `diem_ibfk_2` FOREIGN KEY (`MonHocID`) REFERENCES `monhoc` (`MonHocID`);

--
-- Constraints for table `diemdanh`
--
ALTER TABLE `diemdanh`
  ADD CONSTRAINT `diemdanh_ibfk_1` FOREIGN KEY (`SinhVienID`) REFERENCES `sinhvien` (`SinhVienID`),
  ADD CONSTRAINT `diemdanh_ibfk_2` FOREIGN KEY (`MonHocID`) REFERENCES `monhoc` (`MonHocID`);

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `giaovien_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`NguoiDungID`),
  ADD CONSTRAINT `giaovien_ibfk_2` FOREIGN KEY (`ChuyenNganhID`) REFERENCES `chuyennganh` (`ChuyenNganhID`);

--
-- Constraints for table `hieutruong`
--
ALTER TABLE `hieutruong`
  ADD CONSTRAINT `hieutruong_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`NguoiDungID`);

--
-- Constraints for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD CONSTRAINT `hocphi_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`NguoiDungID`),
  ADD CONSTRAINT `hocphi_ibfk_2` FOREIGN KEY (`ThuocTinhChungID`) REFERENCES `thuoctinhchung` (`ThuocTinhChungID`);

--
-- Constraints for table `ketoan`
--
ALTER TABLE `ketoan`
  ADD CONSTRAINT `ketoan_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`NguoiDungID`);

--
-- Constraints for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`VaiTroID`) REFERENCES `vaitro` (`VaiTroID`),
  ADD CONSTRAINT `nguoidung_ibfk_2` FOREIGN KEY (`ThuocTinhChungID`) REFERENCES `thuoctinhchung` (`ThuocTinhChungID`);

--
-- Constraints for table `noidungmonhoc`
--
ALTER TABLE `noidungmonhoc`
  ADD CONSTRAINT `noidungmonhoc_ibfk_1` FOREIGN KEY (`ChiTietMonHocID`) REFERENCES `chitietmonhoc` (`ChiTietMonHocID`),
  ADD CONSTRAINT `noidungmonhoc_ibfk_2` FOREIGN KEY (`ThuocTinhChungID`) REFERENCES `thuoctinhchung` (`ThuocTinhChungID`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`NguoiDungID`),
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`ChuyenNganhID`) REFERENCES `chuyennganh` (`ChuyenNganhID`);

--
-- Constraints for table `thanhtich`
--
ALTER TABLE `thanhtich`
  ADD CONSTRAINT `thanhtich_ibfk_1` FOREIGN KEY (`DiemID`) REFERENCES `diem` (`DiemID`),
  ADD CONSTRAINT `thanhtich_ibfk_2` FOREIGN KEY (`DiemDanhID`) REFERENCES `diemdanh` (`DiemDanhID`),
  ADD CONSTRAINT `thanhtich_ibfk_3` FOREIGN KEY (`ChiTietMonHocID`) REFERENCES `chitietmonhoc` (`ChiTietMonHocID`);

--
-- Constraints for table `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`HocPhiID`) REFERENCES `hocphi` (`HocPhiID`),
  ADD CONSTRAINT `thanhtoan_ibfk_2` FOREIGN KEY (`ThuocTinhChungID`) REFERENCES `thuoctinhchung` (`ThuocTinhChungID`);

--
-- Constraints for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `thoikhoabieu_ibfk_1` FOREIGN KEY (`MonHocID`) REFERENCES `monhoc` (`MonHocID`),
  ADD CONSTRAINT `thoikhoabieu_ibfk_2` FOREIGN KEY (`GiaoVienID`) REFERENCES `giaovien` (`GiaoVienID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
