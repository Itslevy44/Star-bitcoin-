-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 07:06 AM
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
-- Database: `mpesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders`(
    `ID` int(11) NOT NULL,
    `OrderNo` int(11) NOT NULL,
    `Amount` int(11) NOT NULL,
    `Phone` varchar(11) NOT NULL,
    `CheckoutRequestID` varchar(255) NOT NULL,
    `MerchantRequestID` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `OrderNo`, `Amount`,`Phone`,`CheckoutRequestID`,`MerchantRequestID`) VALUES
(1, 1, 500, '0796174057', '001', '100');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions`(
    `Trans_id` int(11) NOT NULL,
    `CheckoutRequestID` varchar(255) NOT NULL,
    `MerchantRequestID` varchar(255) NOT NULL,
    `ResultCode` int(11) NOT NULL,
    `ResultDesc` varchar(255) NOT NULL,
    `MpesaCode` varchar(100) NOT NULL,
    `TransactionDate` date DEFAULT current_date(),
    `PhoneNumber` varchar(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Trans_id`, `CheckoutRequestID`, `MerchantRequestID`, `ResultCode`, `ResultDesc`, `MpesaCode`, `TransactionDate`, `PhoneNumber`) 
VALUES (1, '001', '100', 0, 'Payment of Starter Miner', 'SK72WV42MQ', '2024-11-07', '0796174057');


-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--

ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transactions`
--

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`Trans_id`);

--
-- AUTO_INCREMENT for table `orders`
--

ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- ------------------------------------------------
--
--
-- AUTO_INCREMENT for table `transactions`
--

ALTER TABLE `transactions`
  MODIFY `Trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- ------------------------------------------------
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;