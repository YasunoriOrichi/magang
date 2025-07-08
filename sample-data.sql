-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3360
-- Generation Time: Jul 08, 2025 at 02:16 PM
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
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ACCOUNT_ID` int(255) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `REMEMBER` enum('true','false') DEFAULT 'false',
  `RESET_TOKEN` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACCOUNT_ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `REMEMBER`, `RESET_TOKEN`) VALUES
(1, 'admin', '12345', 'nevil@gmail.com', 'true', NULL),
(2, 'nevil', 'nevil', 'nurserinevil@gmail.com', 'false', 'a7c61a1079dc99523efe237c84e16bb5');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(255) NOT NULL,
  `REF_NO` varchar(4) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `NUMBER` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `REF_NO`, `NAME`, `ADDRESS`, `EMAIL`, `NUMBER`) VALUES
(1, 'A482', 'Ahmad Rizky', 'Jl. Sukomanunggal gg 6 No. 35', 'ahmadrizky@gmail.com', '081327537181'),
(2, 'B739', 'Siti Nurhaliza', 'Nginden semolo waru', 'anjay@gmail.com', '081217192984'),
(3, 'C215', 'Budi Santoso', '', '', NULL),
(4, 'D064', 'Rina Wulandari', '', '', NULL),
(5, 'E523', 'Dedi Prasetyo', '', '', NULL),
(6, 'F981', 'Maya Sari', '', '', NULL),
(7, 'G432', 'Andi Wijaya', '', '', NULL),
(8, 'H306', 'Lia Permata', '', '', NULL),
(9, 'I174', 'Fajar Hidayat', '', '', NULL),
(10, 'J859', 'Indah Lestari', '', '', NULL),
(11, 'K042', 'Toni Susanto', '', '', NULL),
(12, 'L728', 'Dewi Anggraini', '', '', NULL),
(13, 'M351', 'Agus Santika', '', '', NULL),
(14, 'N609', 'Fitri Ramadhani', '', '', NULL),
(15, 'O214', 'Rian Aditya', '', '', NULL),
(16, 'P876', 'Siska Melati', '', '', NULL),
(17, 'Q345', 'Yudi Pranata', '', '', NULL),
(18, 'R927', 'Nina Safitri', '', '', NULL),
(19, 'S108', 'Irfan Kurniawan', '', '', NULL),
(20, 'T673', 'Wulan Permatasari', '', '', NULL),
(21, 'U489', 'Eko Setiawan', '', '', NULL),
(22, 'V230', 'Rini Anggraeni', '', '', NULL),
(23, 'W565', 'Dimas Putra', '', '', NULL),
(24, 'X019', 'Sari Melinda', '', '', NULL),
(25, 'Y784', 'Hendra Saputra', '', '', NULL),
(26, 'Z342', 'Lilis Nurhayati', '', '', NULL),
(27, 'A915', 'Joko Santoso', '', '', NULL),
(28, 'B068', 'Nita Rahmawati', '', '', NULL),
(29, 'C723', 'Bayu Aji', '', '', NULL),
(30, 'D487', 'Ria Sari', '', '', NULL),
(31, 'E130', 'Edi Gunawan', '', '', NULL),
(32, 'F654', 'Ratna Dewi', '', '', NULL),
(33, 'G298', 'Slamet Riyadi', '', '', NULL),
(34, 'H835', 'Maya Putri', '', '', NULL),
(35, 'I046', 'Arif Hidayat', '', '', NULL),
(36, 'J572', 'Intan Larasati', '', '', NULL),
(37, 'K903', 'Rudi Kurnia', '', '', NULL),
(38, 'L214', 'Desi Anggraini', '', '', NULL),
(39, 'M476', 'Bambang Supriadi', '', '', NULL),
(40, 'N385', 'Santi Lestari', '', '', NULL),
(41, 'O027', 'Dedi Wahyudi', '', '', NULL),
(42, 'P764', 'Novi Rahma', '', '', NULL),
(43, 'Q512', 'Imam Prasetyo', '', '', NULL),
(44, 'R698', 'Yulia Sari', 'Menganti, Gresik, Jawa Timur', 'yuliasari@gmail.com', NULL),
(45, 'S309', 'Hasan Basri', '', '', NULL),
(46, 'T157', 'Melisa Putri', '', '', NULL),
(47, 'U824', 'Gunawan Saputra', '', '', NULL),
(48, 'V043', 'Dina Oktaviani', '', '', NULL),
(49, 'W670', 'Heri Susanto', '', '', NULL),
(50, 'X285', 'Ayu Puspitasari', '', '', NULL),
(51, 'Y931', 'Tommy Wijaya', '', '', NULL),
(52, 'Z408', 'Ratih Pratiwi', '', '', NULL),
(53, 'A172', 'Andre Saputra', '', '', NULL),
(54, 'B654', 'Nanda Putri', '', '', NULL),
(55, 'C390', 'Riko Santoso', '', '', NULL),
(56, 'D815', 'Siska Dewi', '', '', NULL),
(57, 'E237', 'Wahyu Pratama', '', '', NULL),
(58, 'F506', 'Rini Sari', '', '', NULL),
(59, 'G128', 'Fikri Maulana', '', '', NULL),
(60, 'H742', 'Intan Pertiwi', '', '', NULL),
(61, 'I396', 'Yoga Pratama', '', '', NULL),
(62, 'J051', 'Diah Wulandari', '', '', NULL),
(63, 'K684', 'Arman Setiawan', '', '', NULL),
(64, 'L219', 'Tika Melani', '', '', NULL),
(65, 'M873', 'Eko Prabowo', '', '', NULL),
(66, 'N430', 'Anisa Lestari', '', '', NULL),
(67, 'O167', 'Dani Saputra', '', '', NULL),
(68, 'P594', 'Fitri Anggraini', '', '', NULL),
(69, 'Q038', 'Bayu Santoso', '', '', NULL),
(70, 'R729', 'Maya Rahmawati', '', '', NULL),
(71, 'S465', 'Hadi Kurniawan', '', '', NULL),
(72, 'T810', 'Nia Sari', '', '', NULL),
(73, 'U253', 'Joni Putra', '', '', NULL),
(74, 'V694', 'Sari Dewi', '', '', NULL),
(75, 'W135', 'Irwan Pratama', '', '', NULL),
(76, 'X576', 'Lila Nuraini', '', '', NULL),
(77, 'Y907', 'Dedi Santoso', '', '', NULL),
(78, 'Z280', 'Novi Anggraini', '', '', NULL),
(79, 'A439', 'Rian Wijaya', '', '', NULL),
(80, 'B081', 'Sinta Puspita', '', '', NULL),
(81, 'C726', 'Agus Prasetyo', '', '', NULL),
(82, 'D354', 'Rika Melinda', '', '', NULL),
(83, 'E690', 'Arif Saputra', '', '', NULL),
(84, 'F247', 'Winda Sari', '', '', NULL),
(85, 'G913', 'Imam Santoso', '', '', NULL),
(86, 'H502', 'Rina Putri', '', '', NULL),
(87, 'I764', 'Slamet Hidayat', '', '', NULL),
(88, 'J309', 'Desi Rahmawati', '', '', NULL),
(89, 'K158', 'Bayu Kurniawan', '', '', NULL),
(90, 'L634', 'Lilis Anggraini', '', '', NULL),
(91, 'M072', 'Dimas Saputra', '', '', NULL),
(92, 'N481', 'Santi Pratiwi', '', '', NULL),
(93, 'O930', 'Toni Putra', '', '', NULL),
(94, 'P267', 'Ratna Dewi', '', '', NULL),
(95, 'Q814', 'Heri Santoso', '', '', NULL),
(96, 'R349', 'Ayu Sari', '', '', NULL),
(97, 'S601', 'Tommy Prasetyo', '', '', NULL),
(98, 'T478', 'Melisa Anggraini', '', '', NULL),
(99, 'U203', 'Gunawan Putra', '', '', NULL),
(100, 'V756', 'Dina Rahmawati', '', '', NULL),
(106, 'A999', 'Nevil Nurseri', 'Bengawan Solo', '', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `ID` int(255) NOT NULL,
  `INVOICE_NO` varchar(11) NOT NULL,
  `CUSTOMER` int(255) NOT NULL,
  `DATE_INVOICE` date NOT NULL DEFAULT current_timestamp(),
  `STATUS` enum('LUNAS','BELUM LUNAS','ITEM KOSONG') NOT NULL DEFAULT 'ITEM KOSONG',
  `NOTE` text NOT NULL,
  `TERMS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`ID`, `INVOICE_NO`, `CUSTOMER`, `DATE_INVOICE`, `STATUS`, `NOTE`, `TERMS`) VALUES
(1, 'AB73921584', 12, '2025-03-05', 'LUNAS', '', ''),
(2, 'CD48261093', 45, '2025-03-12', 'BELUM LUNAS', '', ''),
(3, 'EF15739482', 78, '2025-03-18', 'BELUM LUNAS', '', ''),
(4, 'GH82046357', 23, '2025-03-22', 'BELUM LUNAS', '', ''),
(5, 'IJ39685721', 89, '2025-03-28', 'BELUM LUNAS', '', ''),
(6, 'KL57102846', 34, '2025-04-02', 'BELUM LUNAS', '', ''),
(7, 'MN24691358', 67, '2025-04-07', 'BELUM LUNAS', '', ''),
(8, 'OP91357264', 56, '2025-04-11', 'BELUM LUNAS', '', ''),
(9, 'QR68245913', 90, '2025-04-15', 'BELUM LUNAS', '', ''),
(10, 'ST35792468', 11, '2025-04-19', 'BELUM LUNAS', '', ''),
(11, 'UV19462835', 44, '2025-04-23', 'BELUM LUNAS', '', ''),
(12, 'WX52739146', 77, '2025-04-27', 'BELUM LUNAS', '', ''),
(13, 'YZ86315942', 22, '2025-05-01', 'BELUM LUNAS', '', ''),
(14, 'ZA49268315', 55, '2025-05-05', 'BELUM LUNAS', '', ''),
(15, 'BC71539462', 88, '2025-05-09', 'BELUM LUNAS', '', ''),
(16, 'DE32856914', 33, '2025-05-13', 'BELUM LUNAS', '', ''),
(17, 'FG96147328', 66, '2025-05-17', 'BELUM LUNAS', '', ''),
(18, 'HI57481293', 99, '2025-05-21', 'BELUM LUNAS', '', ''),
(19, 'JK23968514', 10, '2025-05-25', 'BELUM LUNAS', '', ''),
(20, 'LM84612359', 43, '2025-05-29', 'BELUM LUNAS', '', ''),
(21, 'NO15937284', 76, '2025-03-01', 'BELUM LUNAS', '', ''),
(22, 'PQ48293651', 19, '2025-03-06', 'BELUM LUNAS', '', ''),
(23, 'RS61529483', 52, '2025-03-11', 'BELUM LUNAS', '', ''),
(24, 'TU34782159', 85, '2025-03-16', 'BELUM LUNAS', '', ''),
(25, 'VW92851463', 28, '2025-03-21', 'BELUM LUNAS', '', ''),
(26, 'XY46138592', 61, '2025-03-26', 'BELUM LUNAS', '', ''),
(27, 'YZ79315624', 94, '2025-03-31', 'BELUM LUNAS', '', ''),
(28, 'AC28461935', 17, '2025-04-03', 'BELUM LUNAS', '', ''),
(29, 'BD53729146', 50, '2025-04-08', 'BELUM LUNAS', '', ''),
(30, 'CE69184253', 83, '2025-04-13', 'BELUM LUNAS', '', ''),
(31, 'DF82457319', 26, '2025-04-18', 'BELUM LUNAS', '', ''),
(32, 'EG15932784', 59, '2025-04-22', 'BELUM LUNAS', '', ''),
(33, 'FH37268145', 92, '2025-04-26', 'BELUM LUNAS', '', ''),
(34, 'GI48521693', 35, '2025-04-30', 'BELUM LUNAS', '', ''),
(35, 'HJ61839452', 68, '2025-05-04', 'BELUM LUNAS', '', ''),
(36, 'IK72914583', 1, '2025-05-08', 'BELUM LUNAS', '', ''),
(37, 'JL83651294', 24, '2025-05-12', 'BELUM LUNAS', '', ''),
(38, 'KM94182735', 57, '2025-05-16', 'BELUM LUNAS', '', ''),
(39, 'LN25836914', 80, '2025-05-20', 'BELUM LUNAS', '', ''),
(40, 'MO47193625', 13, '2025-05-24', 'BELUM LUNAS', '', ''),
(41, 'NP58261493', 46, '2025-05-28', 'BELUM LUNAS', '', ''),
(42, 'OQ69314752', 79, '2025-05-31', 'BELUM LUNAS', '', ''),
(43, 'PR81496235', 2, '2025-03-02', 'BELUM LUNAS', '', ''),
(44, 'QS92537146', 25, '2025-03-07', 'BELUM LUNAS', '', ''),
(45, 'RT13648259', 48, '2025-03-13', 'BELUM LUNAS', '', ''),
(46, 'SU24759318', 71, '2025-03-17', 'BELUM LUNAS', '', ''),
(47, 'TV35861427', 4, '2025-03-23', 'BELUM LUNAS', '', ''),
(48, 'UW46972513', 37, '2025-03-27', 'BELUM LUNAS', '', ''),
(49, 'VX57183624', 70, '2025-04-01', 'BELUM LUNAS', '', ''),
(50, 'WY68294735', 93, '2025-04-05', 'BELUM LUNAS', '', ''),
(51, 'XZ79315846', 16, '2025-04-09', 'BELUM LUNAS', '', ''),
(52, 'YA82436951', 49, '2025-04-14', 'BELUM LUNAS', '', ''),
(53, 'ZB93547162', 82, '2025-04-20', 'BELUM LUNAS', '', ''),
(54, 'AC14658273', 15, '2025-04-24', 'BELUM LUNAS', '', ''),
(55, 'BD25769384', 38, '2025-04-28', 'BELUM LUNAS', '', ''),
(56, 'CE36871495', 61, '2025-05-02', 'BELUM LUNAS', '', ''),
(57, 'DF47982516', 84, '2025-05-06', 'BELUM LUNAS', '', ''),
(58, 'EG58193627', 7, '2025-05-10', 'BELUM LUNAS', '', ''),
(59, 'FH69214738', 30, '2025-05-14', 'BELUM LUNAS', '', ''),
(60, 'GI71325849', 63, '2025-05-18', 'BELUM LUNAS', '', ''),
(61, 'HJ82436950', 96, '2025-05-22', 'BELUM LUNAS', '', ''),
(62, 'IK93547161', 9, '2025-05-26', 'BELUM LUNAS', '', ''),
(63, 'JL14658272', 42, '2025-05-30', 'BELUM LUNAS', '', ''),
(64, 'KM25769383', 75, '2025-03-03', 'BELUM LUNAS', '', ''),
(65, 'LN36871494', 8, '2025-03-08', 'BELUM LUNAS', '', ''),
(66, 'MO47982515', 31, '2025-03-14', 'BELUM LUNAS', '', ''),
(67, 'NP58193626', 64, '2025-03-19', 'BELUM LUNAS', '', ''),
(68, 'OQ69214737', 97, '2025-03-24', 'BELUM LUNAS', '', ''),
(69, 'PR81325848', 20, '2025-03-29', 'BELUM LUNAS', '', ''),
(70, 'QS92436959', 53, '2025-04-04', 'BELUM LUNAS', '', ''),
(71, 'RT13547160', 86, '2025-04-10', 'BELUM LUNAS', '', ''),
(72, 'SU24658271', 19, '2025-04-16', 'BELUM LUNAS', '', ''),
(73, 'TV35769382', 52, '2025-04-21', 'BELUM LUNAS', '', ''),
(74, 'UW46871493', 85, '2025-04-25', 'BELUM LUNAS', '', ''),
(75, 'VX57982514', 18, '2025-04-29', 'BELUM LUNAS', '', ''),
(76, 'WY68193625', 41, '2025-05-03', 'BELUM LUNAS', '', ''),
(77, 'XZ79214736', 74, '2025-05-07', 'BELUM LUNAS', '', ''),
(78, 'YA81325847', 7, '2025-05-11', 'BELUM LUNAS', '', ''),
(79, 'ZB92436958', 40, '2025-05-15', 'BELUM LUNAS', '', ''),
(80, 'AC13547169', 73, '2025-05-19', 'BELUM LUNAS', '', ''),
(81, 'BD24658270', 6, '2025-05-23', 'BELUM LUNAS', '', ''),
(82, 'CE35769381', 39, '2025-05-27', 'BELUM LUNAS', '', ''),
(83, 'DF46871492', 72, '2025-03-04', 'BELUM LUNAS', '', ''),
(84, 'EG57982513', 5, '2025-03-09', 'BELUM LUNAS', '', ''),
(85, 'FH68193624', 28, '2025-03-15', 'BELUM LUNAS', '', ''),
(86, 'GI79214735', 51, '2025-03-20', 'BELUM LUNAS', '', ''),
(87, 'HJ81325846', 84, '2025-03-25', 'BELUM LUNAS', '', ''),
(88, 'IK92436957', 17, '2025-03-30', 'BELUM LUNAS', '', ''),
(89, 'JL13547168', 50, '2025-04-06', 'BELUM LUNAS', '', ''),
(90, 'KM24658279', 83, '2025-04-12', 'BELUM LUNAS', '', ''),
(91, 'LN35769380', 16, '2025-04-17', 'BELUM LUNAS', '', ''),
(92, 'MO46871491', 49, '2025-04-22', 'BELUM LUNAS', '', ''),
(93, 'NP57982512', 82, '2025-04-26', 'BELUM LUNAS', '', ''),
(94, 'OQ68193623', 15, '2025-04-30', 'BELUM LUNAS', '', ''),
(95, 'PR79214734', 38, '2025-05-05', 'BELUM LUNAS', '', ''),
(96, 'QS81325845', 61, '2025-05-10', 'BELUM LUNAS', '', ''),
(97, 'RT92436956', 94, '2025-05-15', 'BELUM LUNAS', '', ''),
(98, 'SU13547167', 27, '2025-05-20', 'BELUM LUNAS', '', ''),
(99, 'TV24658278', 60, '2025-05-24', 'BELUM LUNAS', '', ''),
(100, 'UW35769389', 93, '2025-05-28', 'BELUM LUNAS', '', ''),
(101, 'VX46871490', 26, '2025-03-10', 'ITEM KOSONG', '', ''),
(102, 'WY57982511', 59, '2025-03-17', 'ITEM KOSONG', '', ''),
(103, 'XZ68193622', 92, '2025-03-24', 'ITEM KOSONG', '', ''),
(104, 'YA79214733', 25, '2025-03-31', 'ITEM KOSONG', '', ''),
(105, 'ZB81325844', 58, '2025-04-07', 'ITEM KOSONG', '', ''),
(106, 'AC92436955', 91, '2025-04-14', 'ITEM KOSONG', '', ''),
(107, 'BD13547166', 24, '2025-04-21', 'ITEM KOSONG', '', ''),
(108, 'CE24658277', 57, '2025-04-28', 'ITEM KOSONG', '', ''),
(109, 'DF35769388', 90, '2025-05-05', 'ITEM KOSONG', '', ''),
(110, 'EG46871499', 23, '2025-05-12', 'ITEM KOSONG', '', ''),
(111, 'FH57982510', 56, '2025-05-19', 'ITEM KOSONG', '', 'Barang tidak dapat dikembalikan, kecuali cacat produksi.\r\nMohon konfirmasi pembayaran ke admin sesuai nomor yang telah tercantum diatas.\r\nTesting membuat baris baru'),
(112, 'GI68193621', 89, '2025-05-26', 'BELUM LUNAS', '', ''),
(113, 'HJ79214732', 32, '2025-05-31', 'BELUM LUNAS', '', ''),
(116, 'YJ060625116', 44, '2025-06-06', 'ITEM KOSONG', 'Terima kasih telah berbelanja di toko kami!', ''),
(118, 'DJ040725118', 5, '2025-07-04', 'ITEM KOSONG', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

CREATE TABLE `invoice_detail` (
  `ITEM` int(255) NOT NULL,
  `QTY` int(255) NOT NULL,
  `UNIT_PRICE` int(255) NOT NULL,
  `TOTAL_PRICE` int(255) NOT NULL,
  `ID_DETAIL` int(255) NOT NULL,
  `ID_DETAIL_ROW` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_detail`
--

INSERT INTO `invoice_detail` (`ITEM`, `QTY`, `UNIT_PRICE`, `TOTAL_PRICE`, `ID_DETAIL`, `ID_DETAIL_ROW`) VALUES
(12, 3, 125000, 375000, 1, 1),
(45, 2, 187500, 375000, 1, 2),
(78, 5, 82500, 412500, 2, 3),
(23, 1, 325000, 325000, 2, 4),
(89, 4, 112500, 450000, 3, 5),
(34, 2, 95000, 190000, 3, 6),
(56, 3, 75000, 225000, 4, 7),
(67, 1, 285000, 285000, 4, 8),
(90, 2, 137500, 275000, 5, 9),
(11, 4, 62500, 250000, 5, 10),
(44, 3, 87500, 262500, 6, 11),
(77, 2, 112500, 225000, 6, 12),
(22, 5, 45000, 225000, 7, 13),
(55, 1, 375000, 375000, 7, 14),
(88, 4, 82500, 330000, 8, 15),
(33, 2, 125000, 250000, 8, 16),
(66, 3, 95000, 285000, 9, 17),
(99, 1, 425000, 425000, 9, 18),
(10, 2, 175000, 350000, 10, 19),
(43, 4, 67500, 270000, 10, 20),
(76, 3, 115000, 345000, 11, 21),
(19, 2, 92500, 185000, 11, 22),
(52, 5, 55000, 275000, 12, 23),
(85, 1, 295000, 295000, 12, 24),
(28, 4, 72500, 290000, 13, 25),
(61, 2, 137500, 275000, 13, 26),
(94, 3, 105000, 315000, 14, 27),
(17, 1, 335000, 335000, 14, 28),
(50, 2, 155000, 310000, 15, 29),
(83, 4, 77500, 310000, 15, 30),
(26, 3, 92500, 277500, 16, 31),
(59, 2, 142500, 285000, 16, 32),
(92, 5, 47500, 237500, 17, 33),
(35, 1, 365000, 365000, 17, 34),
(68, 4, 87500, 350000, 18, 35),
(1, 2, 112500, 225000, 18, 36),
(24, 3, 125000, 375000, 19, 37),
(57, 1, 275000, 275000, 19, 38),
(80, 2, 165000, 330000, 20, 39),
(13, 4, 82500, 330000, 20, 40),
(46, 3, 115000, 345000, 21, 41),
(79, 2, 92500, 185000, 21, 42),
(2, 5, 52500, 262500, 22, 43),
(25, 1, 385000, 385000, 22, 44),
(48, 4, 72500, 290000, 23, 45),
(71, 2, 127500, 255000, 23, 46),
(4, 3, 105000, 315000, 24, 47),
(37, 1, 345000, 345000, 24, 48),
(70, 2, 175000, 350000, 25, 49),
(93, 4, 87500, 350000, 25, 50),
(16, 3, 115000, 345000, 26, 51),
(49, 2, 92500, 185000, 26, 52),
(82, 5, 57500, 287500, 27, 53),
(15, 1, 395000, 395000, 27, 54),
(38, 4, 82500, 330000, 28, 55),
(61, 2, 137500, 275000, 28, 56),
(84, 3, 125000, 375000, 29, 57),
(7, 1, 325000, 325000, 29, 58),
(30, 2, 185000, 370000, 30, 59),
(63, 4, 92500, 370000, 30, 60),
(96, 3, 135000, 405000, 31, 61),
(9, 2, 102500, 205000, 31, 62),
(42, 5, 62500, 312500, 32, 63),
(75, 1, 415000, 415000, 32, 64),
(8, 4, 92500, 370000, 33, 65),
(31, 2, 147500, 295000, 33, 66),
(64, 3, 135000, 405000, 34, 67),
(97, 1, 355000, 355000, 34, 68),
(20, 2, 195000, 390000, 35, 69),
(53, 4, 97500, 390000, 35, 70),
(86, 3, 145000, 435000, 36, 71),
(19, 2, 112500, 225000, 36, 72),
(52, 5, 67500, 337500, 37, 73),
(85, 1, 425000, 425000, 37, 74),
(18, 4, 102500, 410000, 38, 75),
(41, 2, 157500, 315000, 38, 76),
(74, 3, 145000, 435000, 39, 77),
(7, 1, 375000, 375000, 39, 78),
(40, 2, 205000, 410000, 40, 79),
(73, 4, 102500, 410000, 40, 80),
(6, 3, 155000, 465000, 41, 81),
(39, 2, 122500, 245000, 41, 82),
(72, 5, 72500, 362500, 42, 83),
(28, 4, 112500, 450000, 43, 85),
(51, 2, 167500, 335000, 43, 86),
(84, 3, 155000, 465000, 44, 87),
(17, 1, 385000, 385000, 44, 88),
(50, 2, 215000, 430000, 45, 89),
(83, 4, 107500, 430000, 45, 90),
(16, 3, 165000, 495000, 46, 91),
(49, 2, 132500, 265000, 46, 92),
(82, 5, 77500, 387500, 47, 93),
(15, 1, 445000, 445000, 47, 94),
(38, 4, 122500, 490000, 48, 95),
(61, 2, 177500, 355000, 48, 96),
(84, 3, 165000, 495000, 49, 97),
(7, 1, 395000, 395000, 49, 98),
(30, 2, 225000, 450000, 50, 99),
(63, 4, 112500, 450000, 50, 100),
(96, 3, 175000, 525000, 51, 101),
(9, 2, 142500, 285000, 51, 102),
(42, 5, 82500, 412500, 52, 103),
(75, 1, 455000, 455000, 52, 104),
(8, 4, 132500, 530000, 53, 105),
(31, 2, 187500, 375000, 53, 106),
(64, 3, 175000, 525000, 54, 107),
(97, 1, 405000, 405000, 54, 108),
(20, 2, 235000, 470000, 55, 109),
(53, 4, 117500, 470000, 55, 110),
(86, 3, 185000, 555000, 56, 111),
(19, 2, 152500, 305000, 56, 112),
(52, 5, 87500, 437500, 57, 113),
(85, 1, 465000, 465000, 57, 114),
(18, 4, 142500, 570000, 58, 115),
(41, 2, 197500, 395000, 58, 116),
(74, 3, 185000, 555000, 59, 117),
(7, 1, 415000, 415000, 59, 118),
(40, 2, 245000, 490000, 60, 119),
(73, 4, 122500, 490000, 60, 120),
(6, 3, 195000, 585000, 61, 121),
(39, 2, 162500, 325000, 61, 122),
(72, 5, 92500, 462500, 62, 123),
(5, 1, 475000, 475000, 62, 124),
(28, 4, 152500, 610000, 63, 125),
(51, 2, 207500, 415000, 63, 126),
(84, 3, 195000, 585000, 64, 127),
(17, 1, 425000, 425000, 64, 128),
(50, 2, 255000, 510000, 65, 129),
(83, 4, 127500, 510000, 65, 130),
(16, 3, 205000, 615000, 66, 131),
(49, 2, 172500, 345000, 66, 132),
(82, 5, 97500, 487500, 67, 133),
(15, 1, 485000, 485000, 67, 134),
(38, 4, 162500, 650000, 68, 135),
(61, 2, 217500, 435000, 68, 136),
(84, 3, 205000, 615000, 69, 137),
(7, 1, 435000, 435000, 69, 138),
(30, 2, 265000, 530000, 70, 139),
(63, 4, 132500, 530000, 70, 140),
(96, 3, 215000, 645000, 71, 141),
(9, 2, 182500, 365000, 71, 142),
(42, 5, 102500, 512500, 72, 143),
(75, 1, 495000, 495000, 72, 144),
(8, 4, 172500, 690000, 73, 145),
(31, 2, 227500, 455000, 73, 146),
(64, 3, 215000, 645000, 74, 147),
(97, 1, 445000, 445000, 74, 148),
(20, 2, 275000, 550000, 75, 149),
(53, 4, 137500, 550000, 75, 150),
(86, 3, 225000, 675000, 76, 151),
(19, 2, 192500, 385000, 76, 152),
(52, 5, 107500, 537500, 77, 153),
(85, 1, 505000, 505000, 77, 154),
(18, 4, 182500, 730000, 78, 155),
(41, 2, 237500, 475000, 78, 156),
(74, 3, 225000, 675000, 79, 157),
(7, 1, 455000, 455000, 79, 158),
(40, 2, 285000, 570000, 80, 159),
(73, 4, 142500, 570000, 80, 160),
(6, 3, 235000, 705000, 81, 161),
(39, 2, 202500, 405000, 81, 162),
(72, 5, 112500, 562500, 82, 163),
(5, 1, 515000, 515000, 82, 164),
(28, 4, 192500, 770000, 83, 165),
(51, 2, 247500, 495000, 83, 166),
(84, 3, 235000, 705000, 84, 167),
(17, 1, 465000, 465000, 84, 168),
(50, 2, 295000, 590000, 85, 169),
(83, 4, 147500, 590000, 85, 170),
(16, 3, 245000, 735000, 86, 171),
(49, 2, 212500, 425000, 86, 172),
(82, 5, 117500, 587500, 87, 173),
(15, 1, 525000, 525000, 87, 174),
(38, 4, 202500, 810000, 88, 175),
(61, 2, 257500, 515000, 88, 176),
(84, 3, 245000, 735000, 89, 177),
(7, 1, 475000, 475000, 89, 178),
(30, 2, 305000, 610000, 90, 179),
(63, 4, 152500, 610000, 90, 180),
(96, 3, 255000, 765000, 91, 181),
(9, 2, 222500, 445000, 91, 182),
(42, 5, 122500, 612500, 92, 183),
(75, 1, 535000, 535000, 92, 184),
(8, 4, 212500, 850000, 93, 185),
(31, 2, 267500, 535000, 93, 186),
(64, 3, 255000, 765000, 94, 187),
(97, 1, 485000, 485000, 94, 188),
(20, 2, 315000, 630000, 95, 189),
(53, 4, 157500, 630000, 95, 190),
(86, 3, 265000, 795000, 96, 191),
(19, 2, 232500, 465000, 96, 192),
(52, 5, 127500, 637500, 97, 193),
(85, 1, 545000, 545000, 97, 194),
(18, 4, 222500, 890000, 98, 195),
(41, 2, 277500, 555000, 98, 196),
(74, 3, 265000, 795000, 99, 197),
(7, 1, 495000, 495000, 99, 198),
(40, 2, 325000, 650000, 100, 199),
(73, 4, 162500, 650000, 100, 200),
(53, 1, 145000, 145000, 113, 201),
(10, 17, 95000, 1615000, 112, 202);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ID` int(255) NOT NULL,
  `REF_NO` varchar(4) NOT NULL DEFAULT 'WIP',
  `NAME` varchar(255) NOT NULL,
  `PRICE` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ID`, `REF_NO`, `NAME`, `PRICE`) VALUES
(1, 'A123', 'Kaos Polos Hitam', 25000),
(2, 'B456', 'Kemeja Lengan Panjang', 75000),
(3, 'C789', 'Jaket Hoodie Abu', 120000),
(4, 'D234', 'Celana Jeans Biru', 90000),
(5, 'E567', 'Sepatu Sneakers Putih', 150000),
(6, 'F890', 'Topi Baseball Merah', 35000),
(7, 'G012', 'Tas Ransel Hitam', 200000),
(8, 'H345', 'Kacamata Hitam', 45000),
(9, 'I678', 'Jam Tangan Digital', 180000),
(10, 'J901', 'Sweater Rajut Abu', 95000),
(11, 'K234', 'Kaos Polos Putih', 25000),
(12, 'L567', 'Kemeja Flanel Merah', 85000),
(13, 'M890', 'Jaket Bomber Hijau', 130000),
(14, 'N123', 'Celana Chino Coklat', 80000),
(15, 'O456', 'Sepatu Boots Kulit', 210000),
(16, 'P789', 'Topi Fedora Hitam', 40000),
(17, 'Q234', 'Tas Selempang Coklat', 110000),
(18, 'R567', 'Kacamata Baca', 30000),
(19, 'S890', 'Jam Tangan Analog', 190000),
(20, 'T123', 'Sweater Hoodie Biru', 98000),
(21, 'U456', 'Kaos Polo Navy', 35000),
(22, 'V789', 'Kemeja Batik Modern', 95000),
(23, 'W012', 'Jaket Parka Abu', 140000),
(24, 'X345', 'Celana Pendek Jeans', 60000),
(25, 'Y678', 'Sepatu Slip-on Hitam', 160000),
(26, 'Z901', 'Topi Rajut Abu', 30000),
(27, 'A234', 'Tas Tote Bag', 90000),
(28, 'B567', 'Kacamata Fashion', 55000),
(29, 'C890', 'Jam Tangan Sport', 200000),
(30, 'D123', 'Sweater Polos Merah', 80000),
(31, 'E456', 'Kaos Lengan Panjang', 30000),
(32, 'F789', 'Kemeja Denim Biru', 85000),
(33, 'G012', 'Jaket Kulit Hitam', 250000),
(34, 'H345', 'Celana Cargo Hijau', 85000),
(35, 'I678', 'Sepatu Running', 170000),
(36, 'J901', 'Topi Snapback', 35000),
(37, 'K234', 'Tas Ransel Kanvas', 120000),
(38, 'L567', 'Kacamata Retro', 40000),
(39, 'M890', 'Jam Tangan Klasik', 210000),
(40, 'N123', 'Sweater Rajut Navy', 90000),
(41, 'O456', 'Kaos Polos Abu', 22000),
(42, 'P789', 'Kemeja Lengan Pendek', 75000),
(43, 'Q012', 'Jaket Hoodie Merah', 125000),
(44, 'R345', 'Celana Jeans Hitam', 90000),
(45, 'S678', 'Sepatu Sneakers Hitam', 155000),
(46, 'T901', 'Topi Baseball Biru', 30000),
(47, 'U234', 'Tas Selempang Hitam', 115000),
(48, 'V567', 'Kacamata Polarized', 65000),
(49, 'W890', 'Jam Tangan Digital Sport', 190000),
(50, 'X123', 'Sweater Hoodie Hitam', 98000),
(51, 'Y456', 'Kaos Polo Putih', 32000),
(52, 'Z789', 'Kemeja Batik Biru', 90000),
(53, 'A012', 'Jaket Parka Hitam', 145000),
(54, 'B345', 'Celana Pendek Chino', 65000),
(55, 'C678', 'Sepatu Slip-on Putih', 165000),
(56, 'D901', 'Topi Rajut Hitam', 28000),
(57, 'E234', 'Tas Tote Bag Kanvas', 92000),
(58, 'F567', 'Kacamata Aviator', 58000),
(59, 'G890', 'Jam Tangan Analog Sport', 200000),
(60, 'H123', 'Sweater Polos Hitam', 82000),
(61, 'I456', 'Kaos Lengan Pendek', 28000),
(62, 'J789', 'Kemeja Denim Hitam', 87000),
(63, 'K012', 'Jaket Kulit Coklat', 260000),
(64, 'L345', 'Celana Cargo Coklat', 83000),
(65, 'M678', 'Sepatu Running Merah', 175000),
(66, 'N901', 'Topi Snapback Merah', 36000),
(67, 'O234', 'Tas Ransel Kulit', 125000),
(68, 'P567', 'Kacamata Vintage', 42000),
(69, 'Q890', 'Jam Tangan Klasik Kulit', 220000),
(70, 'R123', 'Sweater Rajut Hitam', 93000),
(71, 'S456', 'Kaos Polos Merah', 23000),
(72, 'T789', 'Kemeja Lengan Panjang Putih', 78000),
(73, 'U012', 'Jaket Hoodie Biru', 128000),
(74, 'V345', 'Celana Jeans Biru Tua', 92000),
(75, 'W678', 'Sepatu Sneakers Biru', 158000),
(76, 'X901', 'Topi Baseball Hitam', 32000),
(77, 'Y234', 'Tas Selempang Merah', 118000),
(78, 'Z567', 'Kacamata Sport', 62000),
(79, 'A890', 'Jam Tangan Digital Casual', 185000),
(80, 'B123', 'Sweater Hoodie Abu', 97000),
(81, 'C456', 'Kaos Polo Hitam', 34000),
(82, 'D789', 'Kemeja Batik Merah', 92000),
(83, 'E012', 'Jaket Parka Hijau', 142000),
(84, 'F345', 'Celana Pendek Jeans', 67000),
(85, 'G678', 'Sepatu Slip-on Merah', 162000),
(86, 'H901', 'Topi Rajut Merah', 31000),
(87, 'I234', 'Tas Tote Bag Kulit', 95000),
(88, 'J567', 'Kacamata Retro Klasik', 60000),
(89, 'K890', 'Jam Tangan Analog Casual', 205000),
(90, 'L123', 'Sweater Polos Biru', 84000),
(91, 'M456', 'Kaos Lengan Panjang Hitam', 29000),
(92, 'N789', 'Kemeja Denim Abu', 88000),
(93, 'O012', 'Jaket Kulit Abu', 255000),
(94, 'P345', 'Celana Cargo Hitam', 86000),
(95, 'Q678', 'Sepatu Running Hitam', 172000),
(96, 'R901', 'Topi Snapback Hitam', 37000),
(97, 'S234', 'Tas Ransel Nylon', 130000),
(98, 'T567', 'Kacamata Vintage Sport', 43000),
(99, 'U890', 'Jam Tangan Klasik Casual', 225000),
(100, 'K005', 'Kemeja Remaja', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `itemcustomer`
--

CREATE TABLE `itemcustomer` (
  `ID` int(255) NOT NULL,
  `REF_NO` varchar(5) NOT NULL,
  `CUSTOMER` int(255) NOT NULL,
  `ITEM` int(255) NOT NULL,
  `PRICE` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemcustomer`
--

INSERT INTO `itemcustomer` (`ID`, `REF_NO`, `CUSTOMER`, `ITEM`, `PRICE`) VALUES
(1, 'QX837', 25, 48, 234000),
(2, 'LB193', 73, 56, 122500),
(3, 'UD476', 5, 92, 318000),
(4, 'PK284', 31, 60, 45999),
(5, 'YA100', 63, 23, 185000),
(6, 'HS987', 99, 5, 239000),
(7, 'ZM234', 58, 84, 141200),
(8, 'RT374', 18, 39, 293800),
(9, 'CE725', 44, 14, 98700),
(10, 'AX911', 91, 37, 273000),
(11, 'TD660', 32, 19, 367000),
(12, 'JP500', 6, 3, 181500),
(13, 'OV318', 89, 97, 445200),
(14, 'BG441', 9, 54, 223300),
(15, 'LK140', 52, 11, 109000),
(16, 'WR067', 74, 82, 205000),
(17, 'DX822', 60, 93, 164000),
(18, 'NG330', 38, 90, 472800),
(19, 'VC519', 40, 8, 295500),
(20, 'ME781', 100, 71, 165000),
(21, 'RK354', 81, 99, 419000),
(22, 'JW285', 84, 25, 319500),
(23, 'TV991', 43, 68, 115000),
(24, 'CZ246', 46, 7, 324000),
(25, 'SQ101', 59, 22, 278000),
(26, 'HE622', 14, 27, 308900),
(27, 'BY355', 92, 1, 347500),
(28, 'AO012', 2, 26, 398000),
(29, 'XK654', 96, 40, 223000),
(30, 'FM803', 86, 41, 176000),
(31, 'UL594', 88, 91, 261900),
(32, 'NV479', 66, 76, 172000),
(33, 'JP861', 62, 86, 429000),
(34, 'KW911', 21, 58, 114500),
(35, 'EB201', 11, 63, 99000),
(36, 'RA704', 56, 17, 482000),
(37, 'LY477', 4, 28, 144000),
(38, 'TR782', 26, 9, 299900),
(39, 'GV307', 23, 12, 225000),
(40, 'CS889', 20, 43, 189000),
(41, 'MA345', 16, 36, 413000),
(42, 'ZT554', 12, 2, 132000),
(43, 'PO890', 34, 33, 405000),
(44, 'DN399', 36, 30, 295000),
(45, 'YU771', 3, 47, 101000),
(46, 'HG103', 85, 6, 119900),
(47, 'XI117', 13, 44, 162000),
(48, 'WT435', 29, 53, 470000),
(49, 'BQ565', 30, 66, 171000),
(50, 'AZ466', 45, 64, 258000),
(51, 'SO390', 83, 38, 212000),
(52, 'CN133', 39, 13, 273000),
(53, 'BL304', 24, 59, 364000),
(54, 'QA055', 71, 20, 334000),
(55, 'VB676', 93, 18, 388000),
(56, 'RY276', 28, 34, 420000),
(57, 'EF913', 95, 10, 193000),
(58, 'UL608', 8, 49, 227000),
(59, 'WN459', 22, 96, 166500),
(60, 'JC880', 15, 57, 181000),
(61, 'KD142', 61, 24, 271000),
(62, 'ZX003', 7, 31, 111000),
(63, 'YI224', 75, 42, 147000),
(64, 'AD320', 67, 85, 367500),
(65, 'UR019', 41, 100, 232000),
(66, 'GR672', 33, 15, 421000),
(67, 'BF915', 35, 4, 395000),
(68, 'VP478', 97, 16, 268000),
(69, 'QN111', 17, 21, 178000),
(70, 'TE736', 10, 98, 160000),
(71, 'WI728', 64, 50, 294000),
(72, 'EO062', 50, 45, 218000),
(73, 'NS794', 53, 46, 279000),
(74, 'HL898', 87, 32, 195000),
(75, 'KV175', 90, 80, 483000),
(76, 'XM385', 69, 55, 147000),
(77, 'JB221', 55, 73, 223000),
(78, 'ZX996', 19, 35, 362000),
(79, 'OM623', 98, 74, 398500),
(80, 'DA799', 70, 52, 274000),
(81, 'VS877', 42, 65, 169000),
(82, 'MC609', 37, 51, 153000),
(83, 'QW725', 47, 75, 388000),
(84, 'FB580', 80, 77, 183000),
(85, 'NL212', 27, 87, 390000),
(86, 'UR091', 49, 88, 142000),
(87, 'TP771', 78, 29, 419000),
(88, 'CG165', 65, 67, 317000),
(89, 'IZ478', 72, 70, 204000),
(90, 'UX649', 57, 72, 476000),
(91, 'XA141', 79, 95, 287000),
(92, 'YK389', 76, 78, 179500),
(93, 'DO920', 94, 69, 214000),
(94, 'HB729', 68, 83, 258000),
(95, 'WP073', 77, 62, 118000),
(96, 'VJ830', 51, 79, 256000),
(97, 'RH544', 100, 61, 132500),
(98, 'ML616', 1, 94, 337000),
(99, 'AK872', 48, 89, 153000),
(100, 'SN470', 19, 46, 278000),
(101, 'CG355', 42, 53, 315000),
(102, 'TB158', 70, 100, 388000),
(103, 'UG330', 97, 99, 145000),
(104, 'VF932', 36, 84, 496000),
(105, 'ZX557', 4, 71, 262000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAYMENT_ID` int(255) NOT NULL,
  `PAYMENT_DATE` date NOT NULL,
  `INVOICE_ID` int(255) NOT NULL,
  `PAID` int(255) NOT NULL,
  `NOTE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAYMENT_ID`, `PAYMENT_DATE`, `INVOICE_ID`, `PAID`, `NOTE`) VALUES
(5, '2025-06-07', 1, 500000, 'tes catatan...'),
(6, '2025-06-13', 1, 100000, ''),
(7, '2025-06-16', 1, 150000, 'lunas'),
(8, '2025-06-16', 2, 100000, 'membayar 100 ribu'),
(9, '2025-06-23', 116, 1000000, 'Lumayan lagi cair THR nya :)'),
(12, '2025-07-04', 116, 265000, '');

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `PIC_ID` int(255) NOT NULL,
  `PIC_REF` varchar(4) NOT NULL,
  `PIC_NAME` varchar(255) NOT NULL,
  `PIC_ADDRESS` varchar(255) NOT NULL,
  `PIC_EMAIL` varchar(255) NOT NULL,
  `PIC_NUMBER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `COMPANY_ID` int(11) NOT NULL,
  `COMPANY_NAME` varchar(255) NOT NULL,
  `COMPANY_ADDRESS` text NOT NULL,
  `COMPANY_PHONE` varchar(20) NOT NULL,
  `COMPANY_EMAIL` varchar(100) NOT NULL,
  `COMPANY_LOGO` varchar(255) NOT NULL,
  `COMPANY_SIGNATURE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`COMPANY_ID`, `COMPANY_NAME`, `COMPANY_ADDRESS`, `COMPANY_PHONE`, `COMPANY_EMAIL`, `COMPANY_LOGO`, `COMPANY_SIGNATURE`) VALUES
(1, 'Wevelope', 'Sukomanunggal gg 6 No. 35', '081327537181', 'nevil@gmail.com', '/dist/assets/img/GOOGLE.png', '/dist/assets/img/SIGNATURE2.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID` int(255) NOT NULL,
  `REF_NO` varchar(4) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID`, `REF_NO`, `NAME`) VALUES
(1, 'A527', 'PT Sumber Jaya'),
(2, 'B849', 'CV Cahaya Abadi'),
(3, 'C302', 'UD Makmur Sentosa'),
(4, 'D674', 'PT Mitra Sejahtera'),
(5, 'E185', 'CV Global Prima'),
(6, 'F960', 'PT Alam Indah'),
(7, 'G431', 'CV Surya Mandiri'),
(8, 'H218', 'PT Bumi Kencana'),
(9, 'I750', 'CV Harapan Jaya'),
(10, 'J409', 'PT Citra Alam'),
(11, 'K853', 'CV Bintang Timur'),
(12, 'L326', 'PT Multi Sukses'),
(13, 'M178', 'CV Sentosa Abadi'),
(14, 'N694', 'PT Satria Perkasa'),
(15, 'O251', 'CV Indah Lestari'),
(16, 'P730', 'PT Pilar Bangsa'),
(17, 'Q096', 'CV Mega Jaya'),
(18, 'R864', 'PT Jaya Makmur'),
(19, 'S527', 'CV Kencana Baru'),
(20, 'T341', 'PT Abadi Sentosa'),
(21, 'U789', 'CV Prima Mandiri'),
(22, 'V120', 'PT Nusantara Sejahtera'),
(23, 'W563', 'CV Makmur Sentosa'),
(24, 'X978', 'PT Cemerlang Abadi'),
(25, 'Y246', 'CV Lestari Jaya'),
(26, 'Z831', 'PT Maju Terus'),
(27, 'A412', 'CV Sukses Bersama'),
(28, 'B697', 'PT Harapan Baru'),
(29, 'C285', 'CV Mandiri Sejati'),
(30, 'D130', 'PT Sejahtera Mandiri'),
(31, 'E579', 'CV Bersama Kita'),
(32, 'F860', 'PT Bina Usaha'),
(33, 'G492', 'CV Jaya Abadi'),
(34, 'H367', 'PT Sentosa Jaya'),
(35, 'I741', 'CV Prima Sukses'),
(36, 'J264', 'PT Cahaya Terang'),
(37, 'K809', 'CV Mandiri Jaya'),
(38, 'L325', 'PT Sejati Abadi'),
(39, 'M680', 'CV Makmur Jaya'),
(40, 'N147', 'PT Abadi Jaya'),
(41, 'O792', 'CV Citra Mandiri'),
(42, 'P438', 'PT Bumi Sejahtera'),
(43, 'Q610', 'CV Terang Jaya'),
(44, 'R274', 'PT Maju Jaya'),
(45, 'S859', 'CV Sejahtera Abadi'),
(46, 'T301', 'PT Global Mandiri'),
(47, 'U764', 'CV Abadi Makmur'),
(48, 'V429', 'PT Sukses Bersama'),
(49, 'W158', 'CV Jaya Makmur'),
(50, 'X692', 'PT Mandiri Sentosa'),
(51, 'Y583', 'CV Prima Jaya'),
(52, 'Z249', 'PT Sumber Makmur'),
(53, 'A310', 'CV Cahaya Sejahtera'),
(54, 'B764', 'UD Mandiri Abadi'),
(55, 'C497', 'PT Satria Jaya'),
(56, 'D680', 'CV Sejahtera Lestari'),
(57, 'E132', 'PT Bina Mandiri'),
(58, 'F905', 'CV Makmur Abadi'),
(59, 'G726', 'PT Citra Sentosa'),
(60, 'H314', 'CV Sukses Makmur'),
(61, 'I457', 'PT Harapan Jaya'),
(62, 'J281', 'CV Maju Bersama'),
(63, 'K698', 'PT Global Jaya'),
(64, 'L502', 'CV Lestari Sentosa'),
(65, 'M319', 'PT Nusantara Jaya'),
(66, 'N475', 'CV Prima Sejahtera'),
(67, 'O860', 'PT Mandiri Makmur'),
(68, 'P231', 'CV Sumber Lestari'),
(69, 'Q746', 'PT Cahaya Makmur'),
(70, 'R503', 'CV Jaya Bersama'),
(71, 'S691', 'PT Sentosa Makmur'),
(72, 'T248', 'CV Abadi Jaya'),
(73, 'U374', 'PT Makmur Sejahtera'),
(74, 'V582', 'CV Mandiri Jaya'),
(75, 'W093', 'PT Sukses Mandiri'),
(76, 'X647', 'CV Bina Sejahtera'),
(77, 'Y812', 'PT Sejahtera Makmur'),
(78, 'Z159', 'CV Citra Bersama'),
(79, 'A735', 'PT Harapan Makmur'),
(80, 'B864', 'CV Global Sejahtera'),
(81, 'C520', 'PT Maju Mandiri'),
(82, 'D478', 'CV Lestari Makmur'),
(83, 'E901', 'PT Nusantara Bersama'),
(84, 'F234', 'CV Prima Mandiri'),
(85, 'G560', 'PT Mandiri Sentosa'),
(86, 'H417', 'CV Sumber Makmur'),
(87, 'I728', 'PT Cahaya Jaya'),
(88, 'J169', 'CV Jaya Makmur'),
(89, 'K846', 'PT Sentosa Bersama'),
(90, 'L329', 'CV Abadi Mandiri'),
(91, 'M574', 'PT Makmur Jaya'),
(92, 'N910', 'CV Mandiri Sejahtera'),
(93, 'O683', 'PT Sukses Bersama'),
(94, 'P257', 'CV Bina Jaya'),
(95, 'Q461', 'PT Sejahtera Sentosa'),
(96, 'R705', 'CV Citra Makmur'),
(97, 'S894', 'PT Harapan Bersama'),
(98, 'T362', 'CV Global Mandiri'),
(99, 'U148', 'PT Maju Jaya'),
(100, 'V596', 'CV Lestari Bersama'),
(101, 'W030', 'PT Nusantara Makmur'),
(102, 'X741', 'CV Prima Bersama'),
(103, 'Y459', 'PT Mandiri Jaya'),
(104, 'Z382', 'CV Sumber Bersama'),
(105, 'A016', 'PT Cahaya Sentosa'),
(106, 'B573', 'CV Jaya Mandiri'),
(107, 'C824', 'PT Sentosa Makmur'),
(108, 'D169', 'CV Abadi Bersama'),
(109, 'E495', 'PT Makmur Bersama'),
(110, 'F608', 'CV Mandiri Jaya'),
(111, 'G731', 'PT Sukses Makmur'),
(112, 'H254', 'CV Bina Mandiri'),
(113, 'I896', 'PT Sejahtera Bersama'),
(114, 'J370', 'CV Citra Jaya'),
(115, 'K524', 'PT Harapan Sentosa'),
(116, 'L138', 'CV Global Bersama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ACCOUNT_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_customer_invoice` (`CUSTOMER`);

--
-- Indexes for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD PRIMARY KEY (`ID_DETAIL_ROW`),
  ADD KEY `fk_item_invoice_detail` (`ITEM`),
  ADD KEY `id_buat_invoice_detail` (`ID_DETAIL`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `itemcustomer`
--
ALTER TABLE `itemcustomer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_customer_itemCustomer` (`CUSTOMER`),
  ADD KEY `fk_item_itemCustomer` (`ITEM`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAYMENT_ID`),
  ADD KEY `fk_invoiceid` (`INVOICE_ID`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`PIC_ID`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`COMPANY_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ACCOUNT_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `ID_DETAIL_ROW` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `itemcustomer`
--
ALTER TABLE `itemcustomer`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAYMENT_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `PIC_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `COMPANY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_customer_invoice` FOREIGN KEY (`CUSTOMER`) REFERENCES `customer` (`ID`);

--
-- Constraints for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  ADD CONSTRAINT `fk_item_invoice_detail` FOREIGN KEY (`ITEM`) REFERENCES `item` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_buat_invoice_detail` FOREIGN KEY (`ID_DETAIL`) REFERENCES `invoice` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `itemcustomer`
--
ALTER TABLE `itemcustomer`
  ADD CONSTRAINT `fk_customer_itemCustomer` FOREIGN KEY (`CUSTOMER`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `fk_item_itemCustomer` FOREIGN KEY (`ITEM`) REFERENCES `item` (`ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_invoiceid` FOREIGN KEY (`INVOICE_ID`) REFERENCES `invoice` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
