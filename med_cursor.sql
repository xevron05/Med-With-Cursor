-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2024 at 01:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `C_ID` int NOT NULL,
  `C_name` varchar(20) DEFAULT NULL,
  `C_VALUE` decimal(3,2) DEFAULT NULL
);

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`C_ID`, `C_name`, `C_VALUE`) VALUES
(1, 'Nepali', '1.00'),
(2, 'Indian', '1.60');

-- --------------------------------------------------------

--
-- Table structure for table `medicinebatch`
--

CREATE TABLE `medicinebatch` (
  `B_SN` int NOT NULL,
  `MED_ID` int DEFAULT NULL,
  `BATCHNUMBER` varchar(255) DEFAULT NULL,
  `EXPIRYDATE` date DEFAULT NULL,
  `QUANTITY` int DEFAULT NULL,
  `MRP` int DEFAULT NULL,
  `CURRENCY_TYPE` int DEFAULT NULL
) ;

--
-- Dumping data for table `medicinebatch`
--

INSERT INTO `medicinebatch` (`B_SN`, `MED_ID`, `BATCHNUMBER`, `EXPIRYDATE`, `QUANTITY`, `MRP`, `CURRENCY_TYPE`) VALUES
(2, 7, '12333333sdsdaadasdsad', '2024-03-28', 123, 111, 2),
(3, 7, 'asghdasda67as6d7asd67as6dasd', '2024-03-28', 123, 11, 2),
(4, 64, '12333333sdsdaadasdsad', '2024-03-29', 10, 100, 1),
(5, 65, '23ddjhshjf', '2024-03-30', 10, 45, 2),
(6, 19, 'tiwti4', '2024-03-28', 9, 90, 1),
(7, 65, 'asghdasda67as6d7asd67as6dasd', '2024-03-28', 5, 80, 2),
(8, 7, '4385GHFH448', '2024-03-30', 14, 500, 2),
(9, 64, '123123edfd', '2024-04-10', 12, 300, 1),
(10, 67, 'CSD13F', '2024-04-26', 10, 150, 1),
(11, 67, 'HTI2K5J', '2024-04-18', 2, 150, 1),
(12, 67, 'GFF', '2024-04-27', 1, 50, 1),
(13, 61, '5GHF7FJ', '2025-10-24', 5, 200, 1),
(14, 61, 'HJG5FK4', '2024-04-23', 2, 230, 1),
(15, 21, 'FKFHJ5D4', '2027-06-23', 30, 400, 1),
(16, 63, 'GJHIY4FJH6F4', '2026-06-26', 50, 200, 2),
(17, 54, '45G-TRV3', '2028-04-16', 30, 50, 2),
(18, 58, 'FGHB6334', '2027-08-24', 15, 605, 2),
(19, 62, 'F5GJ4', '2027-05-01', 20, 70, 1),
(21, 53, 'LT-6KDE', '2026-11-28', 100, 306, 2),
(22, 43, 'DGHR58BN', '2028-12-31', 12, 80, 1),
(23, 30, 'HJRI78_FDJ', '2028-12-30', 17, 95, 2),
(24, 36, 'GHD24FFH', '2024-04-30', 30, 456, 1),
(26, 21, 'GJDJ458G', '2024-04-04', 7, 500, 1),
(29, 49, 'LKVBF5CJ', '2024-04-16', 6, 80, 2),
(39, 22, 'T-H-GH-56', '2024-03-31', 3, 230, 2),
(40, 15, 'GHR43C', '2024-04-03', 9, 490, 1),
(41, 15, 'BNHJT', '2024-03-31', 5, 570, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `SN` int NOT NULL,
  `MEDICINENAME` varchar(255) NOT NULL,
  `COMPANYNAME` varchar(255) NOT NULL,
  `UNIT` varchar(255) NOT NULL,
  `MONEYTYPE` varchar(255) NOT NULL
);

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`SN`, `MEDICINENAME`, `COMPANYNAME`, `UNIT`, `MONEYTYPE`) VALUES
(9, 'ATCHOL 10', 'ARISTO PHARMACEUTICALS', 'CAPSULES', '1'),
(11, 'CANDID-B CREEM', 'GLENMARK', 'creem', '1'),
(12, 'Acarbose 25 mg', 'ARTEBET', '10', '2'),
(13, 'ACARBOSE 50 mg', 'ARTEBET', '10', '1'),
(15, 'MYLOD 5', 'QUIEST', 'tablets', '1'),
(16, 'TOPIROL', 'SUN PHARMA', 'tablets', '2'),
(17, 'SARTEL-H 80', 'INTAS', 'tablets', '2'),
(18, 'SPIROLAC 12.5', 'NATIONAL', 'tablets', '2'),
(20, 'RANIPED ORAL SOLUTION', 'PRIME PHARMACEUTICALS', 'CAPSULES', '1'),
(22, 'RISPER-2', 'ASIAN', 'tablets', '2'),
(23, 'P-ONE 40', 'MAGNUS', 'CAPSULES', '2'),
(24, 'REPACE H', 'SUN PHARMA', 'CAPSULES', '2'),
(25, 'DIAPRIDE M3 FORTE', 'MICRO LABS', 'tablets', '2'),
(26, 'GLYCOMET-GP 0.5', 'USV PRIVATE', 'TABLETS', '2'),
(27, 'DYTOR 10', 'CIPLA', 'TABLETS', '1'),
(28, 'GLYCOMET', 'USV PRIVATE', 'TABLET', '2'),
(29, 'DETRY 10', 'MAGNUS', 'CAPSULES', '1'),
(30, 'EMBETA XR-25', 'INTAS PHARMACEUTICALS', 'CAPSULES', '2'),
(31, 'VITA DEE', 'ASIAN PHARMACEUTICALS', 'CAPSULES', '2'),
(32, 'ASMA-20', 'ONEMEDICINE', 'TABLET', '1'),
(33, 'HIST-180', 'NATIONAL HEALTHCARE', 'TABLET', '1'),
(35, 'PRADEEP', 'ABC', 'CAPSULES', '2'),
(36, 'JUNIOR HORLICKS', 'HINDUSTAN UNILEVER', 'GRAM', '1'),
(37, 'EVA 400', 'QUEST PHARMACEUTICALS', 'CAPSULES', '1'),
(38, 'ETAPRAM-5', 'ASIAN PHARMACEUTICALS', 'TABLET', '2'),
(39, 'ESOZOL-20', 'QUEST', 'TABLET', '1'),
(40, 'PENZES 40', 'INNOVATIVE', 'TABLET', '2'),
(41, 'ESAM-AT', 'TORRENT PHARMACEUTICAL', 'CAPSULES', '2'),
(42, 'ENCORATE', 'SUN PHARMA LABORATORIES', 'TABLET', '2'),
(43, 'NECILOX CAPSULES', 'NATIONAL HEALTHCARE', 'CAPSULES', '1'),
(44, 'FORTIPLEX', 'DEURALI-JANTA PHARMACEUTICALS PRIVATE LIMITED', 'CAPSULES', '1'),
(46, 'HCQUIN-200', 'QMED FORMULATION', 'TABLET', '1'),
(47, 'LOTACE -H', 'CTL', 'TABLET', '1'),
(48, 'LINA 2.5', 'VEGA', 'TABLET', '1'),
(49, 'MAXVIT CAPSULES', 'GRACE PHARMACEUTICALS', 'CAPSULES', '2'),
(50, 'MECON 1500', 'TIME', 'TABLET', '2'),
(51, 'monotrate 10', 'SUN PHARMA LABORATORIES', 'TABLET', '2'),
(52, 'megavog 0.3', 'otsira genetice', 'TABLET', '2'),
(53, 'MAXRON', 'DIVINE HEALTHCARE', 'CAPSULES', '2'),
(54, 'MENOSAN TAB', 'HIMALAYA', 'TABLET', '2'),
(55, 'metocard-25 er', 'vega PHARMACEUTICAL', 'TABLET', '2'),
(56, 'DIAPRIDE M1', 'MICRO LABS', 'CAPSULES', '2'),
(57, 'OVRAL G', 'PFIZER LIMITED', 'CAPSULES', '2'),
(58, 'AFEE', 'APEX PHARMACEUTICALS', 'TABLET', '2'),
(59, 'ONCOTREX 7.5', 'SUN PHARMA LABORATORIES', 'TABLET', '2'),
(62, 'ZOL-20', 'NATIONAL', 'TABLET', '1'),
(63, 'PEXIDEP CR 25', 'SUN PHARMA', 'CAPSULES', '2'),
(66, 'AMLOD 10', 'QUIEST', 'TABLET', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SID` int NOT NULL,
  `MEDICINENAME` varchar(255) NOT NULL,
  `BATCHNUMBER` varchar(255) NOT NULL,
  `REMAININGQUANTITY` int NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `SN` int NOT NULL,
  `FULLNAME` varchar(255) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `PHONENUMBER` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `GENDER` varchar(100) NOT NULL,
  `PROFILEPICTURE` varchar(255) NOT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`SN`, `FULLNAME`, `USERNAME`, `PASSWORD`, `PHONENUMBER`, `EMAIL`, `GENDER`, `PROFILEPICTURE`) VALUES
(18, 'Pradeep Banjara', 'pradeep', '$2y$10$6M7b6UzQSFA7SrShHH9LoO4gvSi8TVcV9jGV/k1Du8NbugzxtBqI2', '9848744205', 'pradeepbanjara92@gmail.com', 'male', 'Pradeep.jpg'),
(19, 'Suzan Ghimire', 'suzan', '$2y$10$g6rry9iYb.BPXQhMqkccW.lOuHq5nG1zldR6lfccMWV.qvVy3thNK', '58685849', 'sujan@gmail.com', 'male', 'user1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `medicinebatch`
--
ALTER TABLE `medicinebatch`
  ADD PRIMARY KEY (`B_SN`),
  ADD KEY `MED_ID` (`MED_ID`),
  ADD KEY `CURRENCY_TYPE` (`CURRENCY_TYPE`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`SN`),
  ADD UNIQUE KEY `MEDICINENAME` (`MEDICINENAME`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`SN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `C_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicinebatch`
--
ALTER TABLE `medicinebatch`
  MODIFY `B_SN` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `SN` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SN` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicinebatch`
--
ALTER TABLE `medicinebatch`
  ADD CONSTRAINT `medicinebatch_ibfk_1` FOREIGN KEY (`MED_ID`) REFERENCES `medicines` (`SN`),
  ADD CONSTRAINT `medicinebatch_ibfk_2` FOREIGN KEY (`CURRENCY_TYPE`) REFERENCES `currency` (`C_ID`);
COMMIT;


-- Run once if not using auto-create in controller
CREATE TABLE IF NOT EXISTS bills (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  bill_no VARCHAR(64) NOT NULL,
  bill_date DATETIME NOT NULL,
  customer_name VARCHAR(255) NULL,
  contact_number VARCHAR(64) NULL,
  address VARCHAR(255) NULL,
  total_amount DECIMAL(12,2) NOT NULL DEFAULT 0,
  payment_status VARCHAR(32) NOT NULL DEFAULT 'Paid',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (bill_date),
  INDEX (bill_no)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS bill_items (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  bill_id INT NOT NULL,
  medicine_id INT NOT NULL,
  batch_id INT NOT NULL,
  medicine_name VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  mrp DECIMAL(12,2) NOT NULL,
  discount_percent DECIMAL(5,2) NOT NULL DEFAULT 0,
  line_total DECIMAL(12,2) NOT NULL,
  CONSTRAINT fk_bill_items_bill FOREIGN KEY (bill_id) REFERENCES bills (id) ON DELETE CASCADE,
  INDEX (medicine_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
