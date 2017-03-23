-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 02:36 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankrecon`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankstatement`
--

CREATE TABLE `bankstatement` (
  `id` int(11) NOT NULL,
  `cdate` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `particulars` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deposits` decimal(20,2) DEFAULT NULL,
  `withdrawals` decimal(20,2) DEFAULT NULL,
  `bankname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bankstatement`
--

INSERT INTO `bankstatement` (`id`, `cdate`, `particulars`, `reference`, `deposits`, `withdrawals`, `bankname`, `status`) VALUES
(1, '18-May-09', 'ATW-4386240128875299 - SRINAGAR COL', '6702', '5000.00', '0.00', 'HDFC', '1'),
(2, '18-May-09', 'ATW-4386240128875299 - SRINAGAR HYD', '0', '0.00', '5000.00', 'HDFC', '0'),
(3, '13-May-09', 'CASH', '118205965A1', '0.00', '2000.00', 'HDFC', '1'),
(4, '12-May-09', 'ATW-4386240128875299 - Chowdary', '5790', '6000.00', '0.00', 'HDFC', '0'),
(5, '12-May-09', 'ATW-4386240128875299 - SRINAGAR COL', '116469880A1', '0.00', '6002.00', 'HDFC', '0'),
(6, '02-Jan-13', 'TO CLEARING HDF RITESH-315504', '315604', '0.00', '15000.00', 'SBI', '0'),
(7, '04-Jan-13', 'ATM WDL-ATM 0684 DAKSHINESWAR KOLKATA IND-', '', '0.00', '900.00', 'SBI', '0'),
(8, '08-Jan-13', 'TO CLEARING-CAB KENDRIYA-315601', '315901', '0.00', '720.00', 'SBI', '0'),
(9, '12-Jan-13', 'ATM WDL-ATM 2617 AIRPORT GATE NO 3 KOLKATA IND-', '', '0.00', '1400.00', 'SBI', '0'),
(10, '14-Jan-13', 'BULK POSTING SALARY', '', '400.00', '0.00', 'SBI', '0'),
(11, '18-Jan-13', 'cash', '', '10000.00', '0.00', 'SBI', '1'),
(12, '20-Jan-13', 'CASh 45545104545', '', '20000.00', '0.00', 'SBI', '1'),
(13, '22-Jan-13', 'Withdraw cash self', '', '0.00', '500.00', 'SBI', '1'),
(14, '23-Jan-13', 'CaSH    fkldj5645354543', '', '100.00', '0.00', 'SBI', '0');

-- --------------------------------------------------------

--
-- Table structure for table `internalstatement`
--

CREATE TABLE `internalstatement` (
  `id` int(11) NOT NULL,
  `cdate` varchar(15) NOT NULL,
  `particulars` varchar(150) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `bankname` varchar(50) NOT NULL,
  `deposits` decimal(20,2) DEFAULT NULL,
  `withdrawals` decimal(20,2) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `bid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internalstatement`
--

INSERT INTO `internalstatement` (`id`, `cdate`, `particulars`, `reference`, `bankname`, `deposits`, `withdrawals`, `status`, `bid`) VALUES
(1, '13-May-13', 'Cash', '', 'HDFC', '0.00', '2000.00', '1', 3),
(2, '04-Jan-13', 'ATM', '', 'SBI', '0.00', '900.00', '0', 0),
(3, '18-May-09', 'Cheque Srinagar', '6702', 'HDFC', '5000.00', '0.00', '1', 1),
(4, '18-Jan-13', 'PPPP cash for item1', '', 'SBI', '10000.00', '0.00', '1', 11),
(5, '20-Jan-13', 'ITEM 2 CASH RECEIVED', '', 'SBI', '20000.00', '0.00', '1', 12),
(6, '22-Jan-13', 'Withdraw Cash by manager', '', 'SBI', '0.00', '500.00', '1', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankstatement`
--
ALTER TABLE `bankstatement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internalstatement`
--
ALTER TABLE `internalstatement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankstatement`
--
ALTER TABLE `bankstatement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `internalstatement`
--
ALTER TABLE `internalstatement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
