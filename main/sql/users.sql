-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2024 at 01:46 PM
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
-- Database: `cyber_resource`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_image`) VALUES
(1, 'tes', 'test@test.com', '$2y$10$se8f6ST.OOyNuth9CuR2duL6uIDZDooPjJjlwKPFtMTZj5V6eurEi', 'Company', NULL),
(2, 'owen2', 'owen@example.com', '$2y$10$mpEV5LL5dcXfagCyICPDE.Tinw5/N/ZVjbmC5.0cF1Jq2QcxxdiDi', 'Company', NULL),
(3, 'shane2', 'shane@example.com', '$2y$10$vG.srdd0jKecOl3RbBjrH.xFTtFywx.Iph80jRPPTVfQ26RhQy4H6', 'Company', NULL),
(4, 'owen12', 'owen12@gmail.com', '$2y$10$30qe9RzZFeKP7uwQ9VHfPOaYPn19nE2vV5KCpEw1J6oxC0wnLqf6i', 'Customer', NULL),
(5, 'user123', 'user123@example.com', '$2y$10$7V.veZazrfsBOUckbLFlfeIjrGmum.IWP1G0pmsnN2LC5XPxwouxm', 'Company', NULL),
(6, 'shane14', 'shane14@gmail.com', '$2y$10$4hMzfi7pch9.ruI6YTICgOu4FQfJ3ShdjOtjpEbJNhWZ4LwmcWkD6', 'Company', NULL),
(7, 'test1', 'test1@gmail.com', '$2y$10$iMhgh3SPaH6tzk7uOGlEdOOL1hzucTr0aefJ6Aauyv1Hh8wcrVTG.', 'Customer', NULL),
(8, 'hai', 'hai@gmail.com', '$2y$10$nIy0pFmYX2Lhc3DIubUoHeO5TxeiRWBXdnkPx9g.gTvPkhE4abgDa', 'Customer', NULL),
(9, 'test', 'test2@test.com', '$2y$10$uYDQGwa7CWXsxpTSh5j3tuQ2.azmw4A101phJYhO6gISP6Sjqg8TO', 'Company', NULL),
(11, 'hello', 'hello@gmail.com', '$2y$10$OZQmtIOy452Oze4gRwcl2.ljc7BmNSioFIOmDia.D8UFGbIglrwE.', 'Customer', NULL),
(13, 'wen1', 'wen1@test.com', '$2y$10$n6lqfrqajbvzG4/nMJaoieZlggwZIERXpvkHOREbvd7ts3bCffpRK', 'Company', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
