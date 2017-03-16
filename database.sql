-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2017 at 03:23 AM
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
  `cdate` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `particulars` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deposits` decimal(20,2) DEFAULT NULL,
  `withdrawals` decimal(20,2) DEFAULT NULL,
  `bankname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bankstatement`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankstatement`
--
ALTER TABLE `bankstatement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankstatement`
--
ALTER TABLE `bankstatement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
