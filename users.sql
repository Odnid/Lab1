-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 05:49 PM
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
-- Database: `user_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `security_question`, `security_answer_hash`) VALUES
(1, 'john_doe', 'john@example.com', '$2y$10$exampleHashedPassword', 'What is your favorite pet?', '$2y$10$exampleHashedSecurityAnswer'),
(2, '1234', '1212@asda1.com', '$2y$10$I72GWjwQti423mQksPVioukVNZEZJZIj5YmTiHCTzsI8HgvqSiIsK', '', '$2y$10$kGFyJQnPWs2owqvJVC5vfeDGT2eY52jII9uKFNI9DWC0Hg8ZaAs3O'),
(17, '1234aa', 'giulliandawal@gmail.com', '$2y$10$N8zoKS7bPlgX2DNzNWrZ8.T68XYwZjvrTXYy0mnXWYz2UHj3FNXEy', '', '$2y$10$XUVIakd0Q2VCHhKieYk/HOBatyQXwLR7x4kv2yseMjZpWoF7Yu8Ti'),
(19, 'Spartacist', 'd.dominguez@gmail.com', '$2y$10$l5YDhF1GzKaJC5Gx5CXGweMBg82uE8xuy1K9Ckl/8gwjEYvoRFSES', 'mother', '$2y$10$G4cou47ptJfe7HQbDBcCDeXICV8vfYmmU41Wij2oQ7EitK7KxMOJW'),
(20, 'lalalala', 'laurawhite@example.com', '$2y$10$a6VcTG7JiSBN/8E.LXWN2uGWobg0gLnYowH.zvQvZs8RSOKktS5nG', 'What is your mothers maiden name?', '$2y$10$qO/Ir7U.s17GcfcMxDt0b.k1HGCpM.D2IKPT6HiVHtoOSP7xGgiR6'),
(21, 'nigga', 'nigga@gmail.com', '$2y$10$ISbkebj4bxTCt4sBDlh4ROTNv6R2qje.IOf04KvobV6wKz64Yy.L.', 'What was your first school?', '$2y$10$CuaKtctWOJblaBcd/Yrrue/N1vfGyGKz1nGX5R/hLFplnDbaoE9q6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
