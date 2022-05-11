-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 28, 2022 lúc 10:33 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kooding_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `province`
--

CREATE TABLE `province` (
  `provinceid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `province`
--

INSERT INTO `province` (`provinceid`, `name`) VALUES
('01TTT', 'Thành phố Hà Nội'),
('02TTT', 'Tỉnh Hà Giang'),
('04TTT', 'Tỉnh Cao Bằng'),
('06TTT', 'Tỉnh Bắc Kạn'),
('08TTT', 'Tỉnh Tuyên Quang'),
('10TTT', 'Tỉnh Lào Cai'),
('11TTT', 'Tỉnh Điện Biên'),
('12TTT', 'Tỉnh Lai Châu'),
('14TTT', 'Tỉnh Sơn La'),
('15TTT', 'Tỉnh Yên Bái'),
('17TTT', 'Tỉnh Hòa Bình'),
('19TTT', 'Tỉnh Thái Nguyên'),
('20TTT', 'Tỉnh Lạng Sơn'),
('22TTT', 'Tỉnh Quảng Ninh'),
('24TTT', 'Tỉnh Bắc Giang'),
('25TTT', 'Tỉnh Phú Thọ'),
('26TTT', 'Tỉnh Vĩnh Phúc'),
('27TTT', 'Tỉnh Bắc Ninh'),
('30TTT', 'Tỉnh Hải Dương'),
('31TTT', 'Thành phố Hải Phòng'),
('33TTT', 'Tỉnh Hưng Yên'),
('34TTT', 'Tỉnh Thái Bình'),
('35TTT', 'Tỉnh Hà Nam'),
('36TTT', 'Tỉnh Nam Định'),
('37TTT', 'Tỉnh Ninh Bình'),
('38TTT', 'Tỉnh Thanh Hóa'),
('40TTT', 'Tỉnh Nghệ An'),
('42TTT', 'Tỉnh Hà Tĩnh'),
('44TTT', 'Tỉnh Quảng Bình'),
('45TTT', 'Tỉnh Quảng Trị'),
('46TTT', 'Tỉnh Thừa Thiên Huế'),
('48TTT', 'Thành phố Đà Nẵng'),
('49TTT', 'Tỉnh Quảng Nam'),
('51TTT', 'Tỉnh Quảng Ngãi'),
('52TTT', 'Tỉnh Bình Định'),
('54TTT', 'Tỉnh Phú Yên'),
('56TTT', 'Tỉnh Khánh Hòa'),
('58TTT', 'Tỉnh Ninh Thuận'),
('60TTT', 'Tỉnh Bình Thuận'),
('62TTT', 'Tỉnh Kon Tum'),
('64TTT', 'Tỉnh Gia Lai'),
('66TTT', 'Tỉnh Đắk Lắk'),
('67TTT', 'Tỉnh Đắk Nông'),
('68TTT', 'Tỉnh Lâm Đồng'),
('70TTT', 'Tỉnh Bình Phước'),
('72TTT', 'Tỉnh Tây Ninh'),
('74TTT', 'Tỉnh Bình Dương'),
('75TTT', 'Tỉnh Đồng Nai'),
('77TTT', 'Tỉnh Bà Rịa - Vũng Tàu'),
('79TTT', 'Thành phố Hồ Chí Minh'),
('80TTT', 'Tỉnh Long An'),
('82TTT', 'Tỉnh Tiền Giang'),
('83TTT', 'Tỉnh Bến Tre'),
('84TTT', 'Tỉnh Trà Vinh'),
('86TTT', 'Tỉnh Vĩnh Long'),
('87TTT', 'Tỉnh Đồng Tháp'),
('89TTT', 'Tỉnh An Giang'),
('91TTT', 'Tỉnh Kiên Giang'),
('92TTT', 'Thành phố Cần Thơ'),
('93TTT', 'Tỉnh Hậu Giang'),
('94TTT', 'Tỉnh Sóc Trăng'),
('95TTT', 'Tỉnh Bạc Liêu'),
('96TTT', 'Tỉnh Cà Mau');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `province`
--
ALTER TABLE `province`
  ADD UNIQUE KEY `province_provinceid_unique` (`provinceid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
