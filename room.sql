-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 04:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'hamimsheikh234@gmail.com', 'Hamim123@');

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `id` int(6) UNSIGNED NOT NULL,
  `room_no` varchar(30) NOT NULL,
  `building` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `day` varchar(30) NOT NULL,
  `course_teacher` varchar(255) DEFAULT NULL,
  `intake` varchar(255) DEFAULT NULL,
  `sec` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`id`, `room_no`, `building`, `time`, `day`, `course_teacher`, `intake`, `sec`, `department`) VALUES
(1, '101', '2', ' 08:00 AM - 09:15 AM', 'Monday', 'HMF', '47', '3', 'EEE'),
(6, '202', '2', ' 08:00 AM - 09:15 AM', 'Monday', 'MDI', '47', '2', 'Ec'),
(7, '202', '1', ' 10:30 AM - 11:45 AM', 'Tuesday', 'MDI', '47', '1', 'BBA'),
(8, '201', '3', ' 08:00 AM - 09:15 AM', 'Monday', 'NKD', '48', '1', 'CSE'),
(9, '101', '3', ' 11:45 AM - 01:00 PM', 'Wednesday', 'NKD', '49', '1', 'CSE'),
(12, '505', '4', ' 11:45 AM - 01:00 PM', 'Tuesday', 'MJF', '47', '1', 'CSE'),
(13, '505', '3', ' 11:45 AM - 01:00 PM', 'Monday', NULL, NULL, NULL, NULL),
(14, '407', '2', ' 08:00 AM - 09:15 AM', 'Monday', 'NKD', '47', '3', 'EEE'),
(15, '408', '2', ' 09:15 AM - 10:30 AM', 'Monday', NULL, NULL, NULL, NULL),
(16, '101', '2', ' 09:15 AM - 10:30 AM', 'Monday', 'HMF', '47', '3', 'EEE'),
(17, '409', '2', '08:00 AM - 09:15 AM', 'Wednesday', NULL, NULL, NULL, NULL),
(18, '407', '1', '05:15 PM - 06:30 PM', 'Sunday', NULL, NULL, NULL, NULL),
(19, '102', '2', '08:00 AM - 09:15 AM', 'Monday', '', '', '', ''),
(20, '102', '2', '09:15 AM - 10:30 AM', 'Monday', '', '', '', ''),
(21, '102', '2', '10:30 AM - 11:45 AM', 'Monday', '', '', '', ''),
(22, '103', '2', '08:00 AM - 09:15 AM', 'Monday', 'MDI', '49', '2', 'CSE'),
(23, '103', '2', '09:15 AM - 10:30 AM', 'Monday', 'HMF', '45', '3', 'CSE'),
(24, '103', '2', '10:30 AM - 11:45 AM', 'Monday', 'HMF', '49', '1', 'CSE'),
(25, '103', '1', '04:00 PM - 05:15 PM', 'Thursday', 'MDI', '47', '2', 'CSE'),
(26, '103', '1', '01:30 PM - 02:45 PM', 'Wednesday', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `pass`) VALUES
(1, 'Hamim', '$2y$10$cHkwsxRUBYns8/YKgNACDOybOJ2yYVK20uwluzJwejpqqKUIemhlm'),
(2, 'Joy', '$2y$10$7mG3gZQgk8eBXxZORo7nz.R0c2BUNBgLp/t5tcVZx9avYX/i6utcu'),
(3, 'Mosa', '$2y$10$RQRB9gA0E3Y16jmKqDWcVOf3QiRARGvqHhiy0VtE9qA7RQ571qPtG'),
(4, 'sumu', '$2y$10$8bsyqwN114fO5/2n1TBuSul3zwC1GFVE5l/aA27Hg3ltvBZdGj9bu'),
(5, 'sumaiya', '$2y$10$rnGx7yoDkm8F7lhvSXhli.uTeBg9hEDvvFb0TlpW/W9kjLkf55R9q'),
(6, 'swrona', '$2y$10$h05CVnaBTPhCc5hYVDksA.WjXp8nqaCXz110QEndk4a3onDm/9RKi'),
(7, 'Mosharaf', '$2y$10$PReEgSxLxzrc74fjtD97ou2x0jZS/cCALcwfGy.AziSTczrDplwRK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_details`
--
ALTER TABLE `room_details`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
