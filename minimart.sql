-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2019 at 06:43 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.3.3-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimart`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nsx` date NOT NULL,
  `hsd` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `id_product`, `nsx`, `hsd`, `quantity`, `active`) VALUES
(1, 2, '1990-01-01', '1990-02-01', 12, 0),
(2, 2, '1997-01-01', '1997-03-16', 70, 0),
(3, 3, '1990-01-01', '1990-03-20', 70, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `active_public` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `name`, `active_public`) VALUES
(1, 'Thùng rác', 0),
(2, 'Chưa phân loại', 0),
(6, 'Bánh kẹo', 1),
(7, 'Sữa', 1),
(9, 'Nước ngọt', 1),
(10, 'Gia vị thực phẩm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `username`, `content`, `date_at`) VALUES
(1, 'Baynguyen', '45454545', 'gggggggggggggg', NULL),
(2, 'Nam', '34343434', 'dddddddddddđdd', NULL),
(3, 'Hoa', '0155553333', 'gggggggggggggggggg', '2019-04-08 16:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_at` datetime DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action`, `username`, `date_at`, `detail`) VALUES
(2, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-03-31 23:40:17', NULL),
(3, 'Xóa danh mục', 'baynguyen1997@gmail.com', '2019-04-01 00:11:43', '{"id":14,"name":"M\\u00ec \\u0103n li\\u1ec1n","active_public":1}'),
(4, 'Thêm danh mục', 'baynguyen1997@gmail.com', '2019-04-01 00:42:24', '{"id":15,"name":"M\\u00ec \\u0103n li\\u1ec1n","active_public":0}'),
(5, 'Xóa người dùng', 'baynguyen1997@gmail.com', '2019-04-01 00:47:36', '{"id":22,"username":"baynguyena4k13@gmail.com","fullname":"B\\u1ea3y Nguy\\u1ec5n","id_role":8,"email":null,"phone":null}'),
(6, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-01 13:38:37', NULL),
(7, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-01 20:08:02', NULL),
(8, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-01 20:33:11', NULL),
(9, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-01 20:37:27', NULL),
(10, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-02 09:24:22', NULL),
(11, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 01:19:19', NULL),
(12, 'Đăng nhập', '0942193241', '2019-04-04 01:20:44', NULL),
(13, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 01:21:00', NULL),
(14, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 01:28:45', NULL),
(15, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 02:18:39', NULL),
(16, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 08:19:13', NULL),
(17, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 09:56:37', NULL),
(18, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 10:21:39', NULL),
(19, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 10:30:12', NULL),
(20, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 15:12:48', NULL),
(21, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 15:25:12', NULL),
(22, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 17:29:53', NULL),
(23, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 22:28:44', NULL),
(24, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 22:36:51', NULL),
(25, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-04 22:38:15', NULL),
(26, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-05 01:38:57', NULL),
(27, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-05 01:40:03', NULL),
(28, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-05 01:48:46', NULL),
(29, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-05 01:50:20', NULL),
(30, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-07 10:11:34', NULL),
(31, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-08 15:35:02', NULL),
(32, 'Xóa danh mục', 'baynguyen1997@gmail.com', '2019-04-08 17:05:21', '{"id":15,"name":"M\\u00ec \\u0103n li\\u1ec1n","active_public":1}'),
(33, 'Đăng nhập', 'baynguyen1997@gmail.com', '2019-04-08 18:41:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `desc_text` text COLLATE utf8_unicode_ci,
  `detail_text` text COLLATE utf8_unicode_ci,
  `cat_id` int(11) DEFAULT NULL,
  `picture` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_si` int(11) DEFAULT NULL,
  `price_le` int(11) DEFAULT NULL,
  `unit_le_char` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_si_int` int(3) DEFAULT NULL,
  `unit_le_picture` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_si_picture` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `active_km` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `desc_text`, `detail_text`, `cat_id`, `picture`, `price_si`, `price_le`, `unit_le_char`, `unit_si_int`, `unit_le_picture`, `unit_si_picture`, `active`, `active_km`) VALUES
(2, 'Bánh quy bạc', 'gggggggg', 'ggggggggggggggggg', 6, '1553059892.png', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, 'Nước Coca cola chai lớn 1 lit', 'gggggggggggggggggggggg', 'ggggggggggggggggggggggggggggg', 9, '1552576572.png', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, 'demo', 'gggggggggg', 'ggggggggggggggg', 2, '1553791284.png', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phanSuDanhMuc` int(1) NOT NULL DEFAULT '0',
  `phanSuProduct` int(1) NOT NULL DEFAULT '0',
  `phanSuUser` int(1) NOT NULL DEFAULT '0',
  `phanSuGiaoDien` int(1) NOT NULL DEFAULT '0',
  `phanSuAdmin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `phanSuDanhMuc`, `phanSuProduct`, `phanSuUser`, `phanSuGiaoDien`, `phanSuAdmin`) VALUES
(1, 'admin', 1, 1, 1, 1, 1),
(8, 'user', 0, 0, 0, 0, 0),
(9, 'NhanVienBanHang', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `picture` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `desc_text` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail_text` text COLLATE utf8_unicode_ci,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_role` int(2) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `id_role`, `email`, `phone`, `remember_token`) VALUES
(15, 'baynguyen1997@gmail.com', '$2y$10$XcDYC4EVoW3bmiB8kE6UbumJ35BO22BZFuzzcnK6oOB2ewieyogwi', 'Admin', 1, NULL, NULL, 'i5IlIDSVfDXHFXBTEa79DQNodPbCaePIwTAfON6H9zEy0rNJJnmcpJgDDILu'),
(19, '0942193241', '$2y$10$k9Pe71vksMb.m6X6A7IYYuTa.B8Xg6d4UawzwrF4h7lvBRN.IgBW.', 'bay', 8, NULL, NULL, 'AXe4qjX6IxCW5hDXia1gTWYUJU3OI56RegvoMQyZQoyt4dg2aqBR3HjhZTnD'),
(21, '0364924043', '$2y$10$u6SqhCP/mOYQuUz6dnX8nerBpEsHe8G.X9y/bsIhT/RqKmM1yPykG', 'Nguyễn Thị Hoa', 9, NULL, NULL, 'R605ZQP8aXGWq3KUg9A6yqgSuT7QAFhwkSOCMv7X2Z7Om7QsqcpgkA7Nxz7l'),
(22, '121212', '$2y$10$2geGIKBcih04id7W7CViTO/wuaB.STdVenirE5Bg5TIu2wSo/KIN.', 'demo1', 8, NULL, NULL, NULL),
(23, '232323', '$2y$10$qATEJXq91DPqKNNoe0.huuZQhakoCC7zki/PLDqRA9Iz9PFrMoPlW', 'demo2', 8, NULL, NULL, NULL),
(24, '545545', '$2y$10$SRxu/34FY/fJWxnR5ckkverc0id2X0OAenU1LJGM1QN8RtH2tA4C.', 'demo3', 9, NULL, NULL, NULL),
(25, '545454', '$2y$10$oOSFiHqfH5KRPnsqP5qsIePa04kkHpsnArWxxxYyynzjdFOowhF7e', 'demo5', 8, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `value_option`
--

CREATE TABLE `value_option` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value_char` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_int` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `value_option`
--

INSERT INTO `value_option` (`id`, `name`, `value_char`, `value_int`) VALUES
(1, 'mau_nen', '#49d5ca', NULL),
(2, 'mau_nen_demo', '#49d5ca', NULL),
(3, 'logo', 'logo_admin.png', NULL),
(4, 'logo_demo', '1554105906.png', NULL),
(5, 'mau_nen_content', '#d1e2c0', NULL),
(6, 'mau_nen_content_demo', '#d1e2c0', NULL),
(7, 'width_slide', NULL, 600),
(8, 'height_slide', NULL, 250),
(9, 'width_product', NULL, 205),
(10, 'height_product', NULL, 190),
(11, 'width_logo', NULL, 270),
(12, 'height_logo', NULL, 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_option`
--
ALTER TABLE `value_option`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `value_option`
--
ALTER TABLE `value_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
