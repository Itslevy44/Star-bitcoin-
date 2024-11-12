-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 11:40 AM
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
-- Database: `Star`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'kiprotichlevy0@gmail.com', 'metadrop24');

--
-- Table structure for table `machine_type`
--

CREATE TABLE `machine_type` (
  `machine_type_id` int(11) NOT NULL,
  `type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machines_type`
--

INSERT INTO `machine_type` (`machine_type_id`, `type`) VALUES
(1, ' Regular Miner'),
(2, ' Advanced Miner');

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `machine_id` int(255) NOT NULL,
  `machine_name` varchar(200) NOT NULL,
  `machine_price` int(255) NOT NULL,
  `machine_des` varchar(250) NOT NULL,
  `machine_type` int(11) NOT NULL,
  `machine_revenue` int(255) NOT NULL,
  `machine_duration` int(200) NOT NULL,
  `machine_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`machine_id`, `machine_name`, `machine_price`, `machine_des`, `machine_type`, `machine_revenue`, `machine_duration`,`machine_status`) VALUES
(1, ' Starter miner', 500, 'Low performance mining machine.', 1 ,600, 30,'active'),
(2, ' Basic miner', 1000, ' Medium performance mining machine',1 , 1200,30, 'active'),
(3, ' Advanced miner', 2500, 'High performance mining machine ', 1 , 3000,30,'active'),
(4, ' Pro miner', 4500, 'High performance mining machine ', 1 , 5100, 30, 'active'),
(5, ' Elite miner', 10000, 'Premium performance mining machine ', 1 , 12000, 30, 'active'),
(6, ' Advanced Lock Machine 1',20000, 'Lock for 50 days to earn your reward', 2 , 25000, 50, 'active'),
(7, ' Advanced Lock Machine 2', 40000, 'Lock for 50 days to earn your reward', 2 ,50000, 50, 'active'),
(8, 'Advanced Lock Machine 3', 10000, 'Lock for 50 days to earn your reward', 2, 130000, 50, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_phoneno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phoneno`, `created_at`, `modified_at`) VALUES
(1, 'Vincent','vincentkoech95@gmail.com', '11223344', 0701246798, '2023-08-21 13:38:23', '2023-08-21 13:38:23'),
(2, 'Mary', 'marywangechi01@gmail.com', '091827', 0111246798, '2023-08-21 13:38:23', '2024-08-21 13:38:23'),
(3, 'Anntonette', 'wanguikoi@gmail.com', 'qwerty01234', 0716847323, '2023-08-21 18:56:24', '2023-08-21 18:56:24'),
(4, 'Levy', 'kiprotichlevy0@gmail.com', '123987', 0795959596, '2023-12-01 11:20:17', '2023-12-01 11:20:17');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`machine_id`);
--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `machines`
  MODIFY `machine_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;