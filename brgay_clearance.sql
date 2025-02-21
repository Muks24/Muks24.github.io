-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 07:14 AM
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
-- Database: `brgay_clearance`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `posted_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `date`, `posted_by`) VALUES
(1, 'COVID-19 Vaccination Drive', 'Vaccination drive will be held at the Barangay Hall.', '2025-02-20 05:24:44', 'Captain Juan'),
(2, 'Clean-Up Drive', 'Join us for a community clean-up this Saturday.', '2025-02-20 05:24:44', 'Secretary Maria');

-- --------------------------------------------------------

--
-- Table structure for table `barangay_clearances`
--

CREATE TABLE `barangay_clearances` (
  `id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `status` enum('pending','approved','denied') DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_clearances`
--

INSERT INTO `barangay_clearances` (`id`, `purpose`, `details`, `requested_by`, `status`, `date`) VALUES
(1, 'Purpose 1', 'Details 1', 'user1', 'approved', '2024-01-17 16:00:00'),
(2, 'Purpose 2', 'Details 2', 'user2', 'approved', '2024-01-24 16:00:00'),
(3, 'Purpose 3', 'Details 3', 'user3', 'approved', '2024-02-11 16:00:00'),
(4, 'Purpose 4', 'Details 4', 'user4', 'approved', '2024-02-19 16:00:00'),
(5, 'Purpose 5', 'Details 5', 'user5', 'approved', '2024-03-07 16:00:00'),
(6, 'Purpose 6', 'Details 6', 'user6', 'approved', '2024-03-14 16:00:00'),
(7, 'Purpose 7', 'Details 7', 'user7', 'approved', '2024-03-24 16:00:00'),
(8, 'Purpose 8', 'Details 8', 'user8', 'approved', '2024-04-07 16:00:00'),
(9, 'Purpose 9', 'Details 9', 'user9', 'approved', '2024-04-14 16:00:00'),
(10, 'Purpose 10', 'Details 10', 'user10', 'approved', '2024-04-24 16:00:00'),
(11, 'Purpose 11', 'Details 11', 'user11', 'approved', '2024-05-04 16:00:00'),
(12, 'Purpose 12', 'Details 12', 'user12', 'approved', '2024-05-17 16:00:00'),
(13, 'Purpose 13', 'Details 13', 'user13', 'approved', '2024-05-24 16:00:00'),
(14, 'Purpose 14', 'Details 14', 'user14', 'approved', '2024-06-09 16:00:00'),
(15, 'Purpose 15', 'Details 15', 'user15', 'approved', '2024-06-21 16:00:00'),
(16, 'Purpose 16', 'Details 16', 'user16', 'approved', '2024-06-29 16:00:00'),
(17, 'Purpose 17', 'Details 17', 'user17', 'approved', '2024-07-04 16:00:00'),
(18, 'Purpose 18', 'Details 18', 'user18', 'approved', '2024-07-17 16:00:00'),
(19, 'Purpose 19', 'Details 19', 'user19', 'approved', '2024-07-24 16:00:00'),
(20, 'Purpose 20', 'Details 20', 'user20', 'approved', '2024-08-04 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_permits`
--

CREATE TABLE `business_permits` (
  `id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_address` varchar(255) NOT NULL,
  `business_details` text NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `status` enum('pending','approved','denied') DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_permits`
--

INSERT INTO `business_permits` (`id`, `business_name`, `business_address`, `business_details`, `requested_by`, `status`, `date`) VALUES
(1, 'Business 1', 'Address 1', 'Details 1', 'user1', 'approved', '2024-01-14 16:00:00'),
(2, 'Business 2', 'Address 2', 'Details 2', 'user2', 'approved', '2024-01-21 16:00:00'),
(3, 'Business 3', 'Address 3', 'Details 3', 'user3', 'approved', '2024-02-09 16:00:00'),
(4, 'Business 4', 'Address 4', 'Details 4', 'user4', 'approved', '2024-02-17 16:00:00'),
(5, 'Business 5', 'Address 5', 'Details 5', 'user5', 'approved', '2024-03-04 16:00:00'),
(6, 'Business 6', 'Address 6', 'Details 6', 'user6', 'approved', '2024-03-11 16:00:00'),
(7, 'Business 7', 'Address 7', 'Details 7', 'user7', 'approved', '2024-03-21 16:00:00'),
(8, 'Business 8', 'Address 8', 'Details 8', 'user8', 'approved', '2024-04-04 16:00:00'),
(9, 'Business 9', 'Address 9', 'Details 9', 'user9', 'approved', '2024-04-11 16:00:00'),
(10, 'Business 10', 'Address 10', 'Details 10', 'user10', 'approved', '2024-04-21 16:00:00'),
(11, 'Business 11', 'Address 11', 'Details 11', 'user11', 'approved', '2024-05-02 16:00:00'),
(12, 'Business 12', 'Address 12', 'Details 12', 'user12', 'approved', '2024-05-14 16:00:00'),
(13, 'Business 13', 'Address 13', 'Details 13', 'user13', 'approved', '2024-05-21 16:00:00'),
(14, 'Business 14', 'Address 14', 'Details 14', 'user14', 'approved', '2024-06-07 16:00:00'),
(15, 'Business 15', 'Address 15', 'Details 15', 'user15', 'approved', '2024-06-19 16:00:00'),
(16, 'Business 16', 'Address 16', 'Details 16', 'user16', 'approved', '2024-06-27 16:00:00'),
(17, 'Business 17', 'Address 17', 'Details 17', 'user17', 'approved', '2024-07-03 16:00:00'),
(18, 'Business 18', 'Address 18', 'Details 18', 'user18', 'approved', '2024-07-14 16:00:00'),
(19, 'Business 19', 'Address 19', 'Details 19', 'user19', 'approved', '2024-07-21 16:00:00'),
(20, 'Business 20', 'Address 20', 'Details 20', 'user20', 'approved', '2024-08-02 16:00:00'),
(21, 'Business 21', 'Address 21', 'Details 21', 'user21', 'approved', '2024-08-09 16:00:00'),
(22, 'Business 22', 'Address 22', 'Details 22', 'user22', 'approved', '2024-08-21 16:00:00'),
(23, 'Business 23', 'Address 23', 'Details 23', 'user23', 'approved', '2024-09-04 16:00:00'),
(24, 'Business 24', 'Address 24', 'Details 24', 'user24', 'approved', '2024-09-14 16:00:00'),
(25, 'Business 25', 'Address 25', 'Details 25', 'user25', 'approved', '2024-09-21 16:00:00'),
(26, 'Business 26', 'Address 26', 'Details 26', 'user26', 'approved', '2024-10-04 16:00:00'),
(27, 'Business 27', 'Address 27', 'Details 27', 'user27', 'approved', '2024-10-14 16:00:00'),
(28, 'Business 28', 'Address 28', 'Details 28', 'user28', 'approved', '2024-10-21 16:00:00'),
(29, 'Business 29', 'Address 29', 'Details 29', 'user29', 'approved', '2024-11-03 16:00:00'),
(30, 'Business 30', 'Address 30', 'Details 30', 'user30', 'approved', '2024-11-09 16:00:00'),
(31, 'Business 31', 'Address 31', 'Details 31', 'user31', 'approved', '2024-11-21 16:00:00'),
(32, 'Business 32', 'Address 32', 'Details 32', 'user32', 'approved', '2024-12-04 16:00:00'),
(33, 'Business 33', 'Address 33', 'Details 33', 'user33', 'approved', '2024-12-11 16:00:00'),
(34, 'Business 34', 'Address 34', 'Details 34', 'user34', 'approved', '2024-12-21 16:00:00'),
(35, 'Business 35', 'Address 35', 'Details 35', 'user35', 'approved', '2024-12-29 16:00:00'),
(36, 'Business 36', 'Address 36', 'Details 36', 'user36', 'approved', '2025-01-09 16:00:00'),
(37, 'Business 37', 'Address 37', 'Details 37', 'user37', 'approved', '2025-01-14 16:00:00'),
(38, 'Business 38', 'Address 38', 'Details 38', 'user38', 'approved', '2025-01-21 16:00:00'),
(39, 'Business 39', 'Address 39', 'Details 39', 'user39', 'approved', '2025-02-02 16:00:00'),
(40, 'Business 40', 'Address 40', 'Details 40', 'user40', 'approved', '2025-02-09 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `term_start` date DEFAULT NULL,
  `term_end` date DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `name`, `position`, `term_start`, `term_end`, `contact`, `created_at`) VALUES
(2, 'Maria Santos', 'Barangay Secretary', '2022-01-01', '2025-12-31', '09987654321', '2025-02-20 13:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `name`, `address`, `contact`, `created_at`) VALUES
(1, 'Mark Jess', '123 Main St.', '09123456789', '2025-02-20 05:24:44'),
(2, 'Mark Jonard', '456 Oak St.', '09987654321', '2025-02-20 05:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `sk_officials`
--

CREATE TABLE `sk_officials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `term_start` date DEFAULT NULL,
  `term_end` date DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sk_officials`
--

INSERT INTO `sk_officials` (`id`, `name`, `position`, `term_start`, `term_end`, `contact`, `created_at`) VALUES
(1, 'Jose Rizal', 'SK Chairman', '2022-01-01', '2025-12-31', '09111222333', '2025-02-20 13:26:00'),
(2, 'Andres Bonifacio', 'SK Councilor', '2022-01-01', '2025-12-31', '09222333444', '2025-02-20 13:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('captain','secretary','resident') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'captain1', '$2a$12$KDUoLGLrD1OwJBOEG7zy5uJjJx7w41Lblmi/WDIROMCen9mblk1ke', 'captain'),
(2, 'secretary1', '$2a$12$KDUoLGLrD1OwJBOEG7zy5uJjJx7w41Lblmi/WDIROMCen9mblk1ke', 'secretary'),
(3, 'resident1', '$2a$12$KDUoLGLrD1OwJBOEG7zy5uJjJx7w41Lblmi/WDIROMCen9mblk1ke', 'resident');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay_clearances`
--
ALTER TABLE `barangay_clearances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_permits`
--
ALTER TABLE `business_permits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_officials`
--
ALTER TABLE `sk_officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barangay_clearances`
--
ALTER TABLE `barangay_clearances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `business_permits`
--
ALTER TABLE `business_permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_officials`
--
ALTER TABLE `sk_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
