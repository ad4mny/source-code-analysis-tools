-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2021 at 08:46 AM
-- Server version: 8.0.25
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scatdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_data`
--

CREATE TABLE `file_data` (
  `fd_id` int NOT NULL,
  `fd_ud_id` int DEFAULT NULL,
  `fd_name` varchar(150) DEFAULT NULL,
  `fd_log` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `file_data`
--

INSERT INTO `file_data` (`fd_id`, `fd_ud_id`, `fd_name`, `fd_log`) VALUES
(94, 1, 'good_sql.php', '08:29:49 AM 31/08/2021'),
(95, 1, 'good_sql1.php', '08:31:32 AM 31/08/2021'),
(96, 1, 'good_sql2.php', '08:35:05 AM 31/08/2021'),
(97, 1, 'good_sql3.php', '08:35:18 AM 31/08/2021'),
(98, 1, 'good_sql4.php', '08:36:29 AM 31/08/2021');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `ud_id` int NOT NULL,
  `ud_username` varchar(20) DEFAULT NULL,
  `ud_password` varchar(100) DEFAULT NULL,
  `ud_fullname` varchar(100) DEFAULT NULL,
  `ud_institution` varchar(10) DEFAULT NULL,
  `ud_log` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`ud_id`, `ud_username`, `ud_password`, `ud_fullname`, `ud_institution`, `ud_log`) VALUES
(1, 'adaman', '3da5debc3095c0761563003ede880b8c', 'adam aiman bin zulkornain', 'Student', '09:17:45AM 13/08/2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_data`
--
ALTER TABLE `file_data`
  ADD PRIMARY KEY (`fd_id`),
  ADD KEY `fd_ud_id` (`fd_ud_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`ud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_data`
--
ALTER TABLE `file_data`
  MODIFY `fd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `ud_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_data`
--
ALTER TABLE `file_data`
  ADD CONSTRAINT `file_data_ibfk_1` FOREIGN KEY (`fd_ud_id`) REFERENCES `user_data` (`ud_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
