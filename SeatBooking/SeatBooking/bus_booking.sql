create database bus_booking
-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2024 at 01:39 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `created_at`, `status`) VALUES
(1, 2, '2024-04-20 11:31:33', 1),
(2, 2, '2024-04-20 13:11:48', 1),
(3, 2, '2024-04-20 13:12:15', 1),
(4, 2, '2024-04-20 13:12:15', 1),
(5, 2, '2024-04-20 13:12:16', 1),
(6, 2, '2024-04-20 13:13:38', 1),
(7, 2, '2024-04-20 13:19:28', 1),
(8, 2, '2024-04-20 13:19:44', 1),
(9, 2, '2024-04-20 13:19:59', 1),
(10, 2, '2024-04-20 13:35:05', 1),
(11, 2, '2024-04-20 13:35:33', 1),
(12, 2, '2024-04-20 13:35:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `booking_date` date NOT NULL,
  `seat_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `booking_date`, `seat_id`, `status`) VALUES
(1, 1, '2024-04-20', 1, 0),
(2, 6, '2024-04-20', 15, 1),
(3, 6, '2024-04-20', 19, 0),
(4, 6, '2024-04-20', 16, 0),
(5, 7, '2024-04-20', 6, 1),
(6, 7, '2024-04-20', 11, 0),
(7, 7, '2024-04-20', 12, 0),
(8, 7, '2024-04-20', 13, 0),
(9, 7, '2024-04-20', 14, 0),
(10, 7, '2024-04-20', 2, 0),
(11, 7, '2024-04-20', 3, 0),
(12, 1, '2024-04-20', 11, 0),
(13, 1, '2024-04-20', 12, 0),
(14, 1, '2024-04-20', 13, 1),
(15, 1, '2024-04-20', 3, 0),
(16, 1, '2024-04-20', 4, 0),
(17, 1, '2024-04-20', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int NOT NULL,
  `bus_no` varchar(25) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_no`, `status`) VALUES
(1, 'B013', 1),
(2, 'A015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int NOT NULL,
  `bus_id` int NOT NULL,
  `seat_no` varchar(25) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `bus_id`, `seat_no`, `status`) VALUES
(1, 1, 'S1', 1),
(2, 1, 'SB2', 1),
(3, 1, 'SB3', 1),
(4, 1, 'SB4', 1),
(5, 1, 'SB5', 1),
(6, 2, 'SA5', 1),
(7, 1, 'SB7', 1),
(8, 1, 'SB8', 1),
(9, 1, 'SB9', 1),
(10, 1, 'SB10', 1),
(11, 2, 'SA1', 1),
(12, 2, 'SA2', 1),
(13, 2, 'SA3', 1),
(14, 2, 'SA4', 1),
(15, 1, 'SB6', 1),
(16, 2, 'SA6', 1),
(17, 2, 'SA7', 1),
(18, 2, 'SA8', 1),
(19, 2, 'SA9', 1),
(20, 2, 'SA10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` varchar(25) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `username`, `password`, `privilege`, `created_at`, `status`) VALUES
(1, 'ltm', '0716008543', 'ltm', 'd41d8cd98f00b204e9800998ecf8427e', 'user', '2024-04-20 10:52:34', 1),
(2, 'lahiru', '0712284096', 'lahiru', '2a12f86e0124d7e43e2a16c7a051bb1a', 'user', '2024-04-20 10:53:11', 1),
(3, 'test', '0112458789', 'test', '098f6bcd4621d373cade4e832627b4f6', 'user', '2024-04-20 10:54:04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
