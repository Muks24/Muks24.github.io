-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 06:25 AM
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
-- Database: `employee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `address`) VALUES
(25, 'Rye Denzel De Guzman', 'rye254@gamil.com', '0936-456-7865', 'Gapan City'),
(26, 'Lexter Tanco', 'tancolexter@gmail.com', '0961-414-9189', 'San Isidro'),
(27, 'John Ferry Santiago', 'joni62@gmail.com', '0929-619-9578', 'Cabanatuan City'),
(28, 'Arenvie Pascual', 'arengi@gmail.com', '0917-657-9087', 'Gapan City'),
(29, 'Heckells Mariano', 'hekk2r5e52@gmail.com', '0976-435-7685', 'Munoz'),
(30, 'john lexter tanco', 'delavega@gmail.com', '09614149189', 'maharlika highway');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `usertype`) VALUES
('Admin', 'admin1234', 'Admin'),
('lexter', 'muko123', 'user'),
('lexterqq', 'hahahaha', 'user'),
('muko', 'kokokoko', 'user'),
('muko221', 'heheheh', 'user'),
('arenv', 'dadadadada', 'user'),
('paolo', 'wawawawawa', 'user'),
('regge', 'rgeege', 'user'),
('lexter24', 'fsdfasd', 'user'),
('User', 'user1234', 'user'),
('dasd', 'sdfsd', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
