-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2021 at 07:15 PM
-- Server version: 8.0.26
-- PHP Version: 7.3.33

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
-- Table structure for table `analysis_data`
--

CREATE TABLE `analysis_data` (
  `ad_id` int NOT NULL,
  `ad_fd_id` int DEFAULT NULL,
  `ad_time_taken` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ad_total_error` int DEFAULT NULL,
  `ad_datetime` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analysis_data`
--

INSERT INTO `analysis_data` (`ad_id`, `ad_fd_id`, `ad_time_taken`, `ad_total_error`, `ad_datetime`) VALUES
(31, 12, '0.00045', 35, 'Wednesday, 15-Dec-21 18:23:49 UTC'),
(32, 12, '0.00038', 28, 'Wednesday, 15-Dec-21 18:24:01 UTC'),
(33, 12, '0.00036', 9, 'Wednesday, 15-Dec-21 18:24:31 UTC'),
(34, 12, '0.00021', 2, 'Wednesday, 15-Dec-21 18:25:31 UTC'),
(35, 12, '0.00015', 0, 'Wednesday, 15-Dec-21 18:25:55 UTC'),
(36, 13, '0.00022', 0, 'Wednesday, 15-Dec-21 18:26:13 UTC');

-- --------------------------------------------------------

--
-- Table structure for table `file_data`
--

CREATE TABLE `file_data` (
  `fd_id` int NOT NULL,
  `fd_ud_id` int DEFAULT NULL,
  `fd_name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fd_log` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_data`
--

INSERT INTO `file_data` (`fd_id`, `fd_ud_id`, `fd_name`, `fd_log`) VALUES
(12, 2, 'cartModel.php', 'Wednesday, 15-Dec-21 18:23:49 UTC'),
(13, 2, 'profileModel.php', 'Wednesday, 15-Dec-21 18:26:13 UTC');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `ud_id` int NOT NULL,
  `ud_username` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_fullname` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_institution` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_log` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`ud_id`, `ud_username`, `ud_password`, `ud_fullname`, `ud_institution`, `ud_log`) VALUES
(1, 'adaman', '3da5debc3095c0761563003ede880b8c', 'adam aiman bin zulkornain', 'Student', '09:17:45AM 13/08/2021'),
(2, 'adam', '1d7c2923c1684726dc23d2901c4d8157', 'adam aiman', 'Individual', '00:24:35AM 22/11/2021'),
(3, 'TEST', '033bd94b1168d7e4f0d644c3c95e35bf', 'TEST', 'Individual', '13:07:38PM 14/12/2021'),
(4, 'kaisarah', '2bbc23c38d206ecfc76f42453abe0183', 'Kaisarah Mahmud', 'Student', '16:39:38PM 14/12/2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis_data`
--
ALTER TABLE `analysis_data`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `ad_fd_id` (`ad_fd_id`);

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
-- AUTO_INCREMENT for table `analysis_data`
--
ALTER TABLE `analysis_data`
  MODIFY `ad_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `file_data`
--
ALTER TABLE `file_data`
  MODIFY `fd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `ud_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analysis_data`
--
ALTER TABLE `analysis_data`
  ADD CONSTRAINT `analysis_data_ibfk_1` FOREIGN KEY (`ad_fd_id`) REFERENCES `file_data` (`fd_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_data`
--
ALTER TABLE `file_data`
  ADD CONSTRAINT `file_data_ibfk_1` FOREIGN KEY (`fd_ud_id`) REFERENCES `user_data` (`ud_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
