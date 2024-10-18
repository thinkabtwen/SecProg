-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 01:59 PM
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
-- Table structure for table `job_listings`
--

CREATE TABLE `job_listings` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `job_description` text NOT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `benefits` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_listings`
--

INSERT INTO `job_listings` (`id`, `username`, `job_title`, `location`, `job_description`, `job_type`, `salary`, `benefits`) VALUES
(1, 'wen1', 'Software engineer', 'jl anggrek', 'jadi softeng', 'part-time', '1000000', 'bonus'),
(2, 'wen1', '<script>alert(\"c\")</script>', '<script>alert(\"c\")</script>', '<script>alert(\"c\")</script>', 'full-time', '<script>alert(\"c\")</script>', '<script>alert(\"c\")</script>'),
(3, 'wen1', '<script>alert(\"c\")</script>', '<script>alert(\"c\")</script>', '<script>alert(\"c\")</script>', 'full-time', '<script>alert(\"c\")</script>', '<script>alert(\"c\")</script>'),
(4, 'wen1', '&lt;script&gt;alert(&quot;c&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;c&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;c&quot;)&lt;/script&gt;', 'full-time', '&lt;script&gt;alert(&quot;c&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;c&quot;)&lt;/script&gt;'),
(5, 'wen1', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', 'part-time', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;'),
(6, 'wen1', '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', 'part-time', '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;'),
(7, 'wen1', 'alert(&quot;xss&quot;)', 'alert(&quot;xss&quot;)', 'alert(&quot;xss&quot;)', 'part-time', 'alert(&quot;xss&quot;)', 'alert(&quot;xss&quot;)'),
(8, 'wen1', 'alert(&quot;xss&quot;)', 'alert(&quot;xss&quot;)', 'alert(&quot;xss&quot;)', 'part-time', 'alert(&quot;xss&quot;)', 'alert(&quot;xss&quot;)'),
(9, 'wen1', 'alert(&quot;e&quot;)', 'alert(&quot;e&quot;)', 'alert(&quot;e&quot;)', 'full-time', 'alert(&quot;e&quot;)', 'alert(&quot;e&quot;)'),
(10, 'wen1', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', 'contract', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;s&quot;)&lt;/script&gt;'),
(11, 'wen1', 'driver', 'jl orange', 'driver', 'part-time', '200000', 'bonus'),
(12, 'wen1', 'Penetration Tester', 'jl kebon jeruk', 'pentest', 'full-time', '4000000', 'lembur bonus'),
(13, 'wen1', 'Penetration Tester', 'jl kebon jeruk', 'pentest', 'full-time', '4000000', 'lembur bonus'),
(14, 'wen1', 'ayam', 'ayam', 'ayam', 'part-time', 'ayam', 'ayam'),
(15, 'wen1', 'SELECT * FROM users', 'SELECT * FROM users', 'SELECT * FROM users', 'part-time', 'SELECT * FROM users', 'SELECT * FROM users'),
(16, 'wen1', 'SELECT * FROM users', 'SELECT * FROM users', 'SELECT * FROM users', 'full-time', 'SELECT * FROM users', 'SELECT * FROM users'),
(17, 'company1', 'network engineer', 'jl puri', 'jadi net eng', 'part-time', '3000000', 'bonus');

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
  `profile_image` varchar(255) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profession` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_image`, `age`, `gender`, `address`, `profession`) VALUES
(1, 'tes', 'test@test.com', '$2y$10$se8f6ST.OOyNuth9CuR2duL6uIDZDooPjJjlwKPFtMTZj5V6eurEi', 'Company', NULL, NULL, NULL, NULL, NULL),
(2, 'owen2', 'owen@example.com', '$2y$10$mpEV5LL5dcXfagCyICPDE.Tinw5/N/ZVjbmC5.0cF1Jq2QcxxdiDi', 'Company', NULL, NULL, NULL, NULL, NULL),
(3, 'shane2', 'shane@example.com', '$2y$10$vG.srdd0jKecOl3RbBjrH.xFTtFywx.Iph80jRPPTVfQ26RhQy4H6', 'Company', NULL, NULL, NULL, NULL, NULL),
(4, 'owen12', 'owen12@gmail.com', '$2y$10$30qe9RzZFeKP7uwQ9VHfPOaYPn19nE2vV5KCpEw1J6oxC0wnLqf6i', 'Customer', NULL, NULL, NULL, NULL, NULL),
(5, 'user123', 'user123@example.com', '$2y$10$7V.veZazrfsBOUckbLFlfeIjrGmum.IWP1G0pmsnN2LC5XPxwouxm', 'Company', NULL, NULL, NULL, NULL, NULL),
(6, 'shane14', 'shane14@gmail.com', '$2y$10$4hMzfi7pch9.ruI6YTICgOu4FQfJ3ShdjOtjpEbJNhWZ4LwmcWkD6', 'Company', NULL, NULL, NULL, NULL, NULL),
(7, 'test1', 'test1@gmail.com', '$2y$10$iMhgh3SPaH6tzk7uOGlEdOOL1hzucTr0aefJ6Aauyv1Hh8wcrVTG.', 'Customer', NULL, NULL, NULL, NULL, NULL),
(8, 'hai', 'hai@gmail.com', '$2y$10$nIy0pFmYX2Lhc3DIubUoHeO5TxeiRWBXdnkPx9g.gTvPkhE4abgDa', 'Customer', NULL, NULL, NULL, NULL, NULL),
(9, 'test', 'test2@test.com', '$2y$10$uYDQGwa7CWXsxpTSh5j3tuQ2.azmw4A101phJYhO6gISP6Sjqg8TO', 'Company', NULL, NULL, NULL, NULL, NULL),
(11, 'hello', 'hello@gmail.com', '$2y$10$OZQmtIOy452Oze4gRwcl2.ljc7BmNSioFIOmDia.D8UFGbIglrwE.', 'Customer', NULL, NULL, NULL, NULL, NULL),
(13, 'wen1', 'wen1@test.com', '$2y$10$n6lqfrqajbvzG4/nMJaoieZlggwZIERXpvkHOREbvd7ts3bCffpRK', 'Company', NULL, NULL, NULL, NULL, NULL),
(16, 'wen2', 'wen2@gmail.com', '$2y$10$i8TbxUiFsWCDvk.H6HrE4uLE27BC/lD9bvn6STkRTfHPJ2hIFl57u', 'Customer', NULL, NULL, NULL, NULL, NULL),
(24, 'appledev', 'appledev@email.com', '$2y$10$/6ArvCfhPpxtuNf2BF7LP.etzUMNA88LKdKSMI60mlTVI0SlfkN0a', 'Company', NULL, NULL, NULL, NULL, NULL),
(25, 'wen1', 'wen1@email.com', '$2y$10$9UZIF11KVl0pZ8dq0SLMGOjTn7/7IP3B/OSBqZIlP/wXAdTP8IvAi', 'Company', NULL, NULL, NULL, NULL, NULL),
(30, 'wen3', 'wen3@email.com', '$2y$10$.RNDQtAFIfBzT66JtYCsmuOrMn9n/OewLX7JiS1Gqn9jzdmbg2uh6', 'Customer', NULL, NULL, NULL, NULL, NULL),
(31, 'wen4', 'wen4@email.com', '$2y$10$Tic1kGBjbatXBz0J/s72pOl/51IubBjakzvYYrYYyVt7lfv9TYjW6', 'Company', NULL, NULL, NULL, NULL, NULL),
(37, 'wen7', 'wen7@email.com', '$2y$10$debuI/dwrx1EDbZb/MVTQOSHEuVq9rqZiybyONRwt4LmeNdxvHZqi', 'Company', NULL, NULL, NULL, NULL, NULL),
(38, 'customer1', 'customer1@email.com', '$2y$10$DgHTRO5bMNstMz32oz0ljOf.yPHuHBS39e7DBCx12h7yzd3iMqlqS', 'Customer', NULL, NULL, NULL, NULL, NULL),
(39, 'company1', 'company1@email.com', '$2y$10$AkXfw7CDqARgBdkPmUxUF.Vs33jT3.gOk2vElY6eQV8R.GhqydK5W', 'Company', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_listings`
--
ALTER TABLE `job_listings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `job_listings`
--
ALTER TABLE `job_listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
