-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3360
-- Generation Time: May 08, 2025 at 09:09 AM
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(255) NOT NULL,
  `REF_NO` varchar(4) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `REF_NO`, `NAME`) VALUES
(10, 'V001', 'Lulla'),
(13, 'M001', 'Miyabi'),
(19, 'S001', 'Sutan Umar Al Arqom'),
(24, 'N002', 'Nevil Nurseri'),
(25, 'H001', 'Hasna Nabila Zalfa'),
(27, 'V002', 'Vivian');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `ID` int(255) NOT NULL,
  `INVOICE_NO` varchar(11) NOT NULL,
  `CUSTOMER` int(255) NOT NULL,
  `DATE_INVOICE` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`ID`, `INVOICE_NO`, `CUSTOMER`, `DATE_INVOICE`) VALUES
(1, 'VJ250425001', 24, '2025-04-25'),
(2, 'MJ250425002', 25, '2025-04-25'),
(4, 'VR300425004', 10, '2025-04-30'),
(5, 'NR230125005', 19, '2025-04-30'),
(6, 'NR230125006', 13, '2025-04-30'),
(34, 'HJ020525050', 25, '2025-05-02'),
(47, 'MR070525047', 13, '2025-05-07'),
(48, 'LR070525048', 10, '2025-05-07'),
(51, 'SK080525055', 24, '2023-12-20');

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
(11, 5, 29000, 145000, 1, 1),
(9, 2, 16000, 32000, 2, 2),
(9, 13, 16000, 208000, 4, 3),
(9, 2, 14000, 28000, 5, 4),
(9, 5, 12000, 60000, 6, 5),
(16, 3, 8000, 24000, 34, 21),
(9, 10, 10000, 100000, 34, 22),
(15, 13, 7000, 91000, 34, 23),
(14, 17, 2000, 34000, 34, 24),
(11, 1, 81000, 81000, 34, 25),
(9, 1, 10000, 10000, 48, 44),
(18, 2, 10000, 20000, 48, 45),
(14, 3, 2000, 6000, 51, 50),
(16, 2, 8000, 16000, 51, 51),
(14, 1, 2000, 2000, 47, 56),
(16, 1, 8000, 8000, 47, 57);

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
(9, 'P010', 'Mie Ayam', 10000),
(11, 'P002', 'Polychrome', 81000),
(14, 'D001', 'Donat', 2000),
(15, 'L001', 'Lolipop', 7000),
(16, 'E001', 'Es Krim Matcha', 8000),
(18, 'B001', 'Bakwan', 10000);

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
(6, 'VP195', 13, 9, 15000),
(9, 'SP009', 10, 9, 10000),
(22, 'VE022', 27, 16, 8000),
(23, 'HE023', 25, 16, 8000),
(24, 'NE024', 24, 16, 8000),
(25, 'MM025', 13, 9, 10000);

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
(3, 'Y195', 'Yudhistira'),
(4, 'S001', 'Sutan Umar Al Arqom'),
(7, 'H001', 'Habib'),
(8, 'A001', 'Ayaka'),
(9, 'H002', 'Hu tao'),
(10, 'A002', 'Aether'),
(11, 'K001', 'Kaeya');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `invoice_detail`
--
ALTER TABLE `invoice_detail`
  MODIFY `ID_DETAIL_ROW` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `itemcustomer`
--
ALTER TABLE `itemcustomer`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
