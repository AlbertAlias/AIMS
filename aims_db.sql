-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 03:37 PM
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
-- Database: `aims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_acc`
--

CREATE TABLE `users_acc` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `department` enum('Information Technology','Computer Engineering','Computer Science','Tourism Management','Hospitality Management','Business Administration','Accountancy','Education','Criminology') DEFAULT NULL,
  `studentID` varchar(20) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('OJT Student','OJT Coordinator','OJT Supervisor','Registrar','Admin') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_acc`
--

INSERT INTO `users_acc` (`id`, `firstname`, `lastname`, `department`, `studentID`, `company`, `email`, `password`, `user_type`, `created_at`) VALUES
(34, NULL, NULL, NULL, NULL, NULL, 'admin@aims.edu.ph', '$2y$10$Li/ITgDL4iAOP.CunWJP4uK7KzVcrTYxnlsqjsKMAXkaRwr7caEi.', 'Admin', '2024-09-01 06:48:24'),
(38, 'Albert', 'Alias', 'Information Technology', '1-210153', NULL, '1-210153@aims.edu.ph', '$2y$10$ZqvP4RdQf4lzpFgNZ7L3Ueu/.hCu57/eQqc0u3aiMYxdcub.9.TiC', 'OJT Student', '2024-09-03 05:18:20'),
(44, 'John Paul', 'Payos', 'Computer Engineering', NULL, '', 'jpp@aims.edu.ph', '$2y$10$ezJ7sFstoWWuzCHzducdl.JzSEG9bI1wloIdWaPQLt9G9wUP0bKzW', 'OJT Coordinator', '2024-09-03 05:55:10'),
(46, 'Alfeo', 'Tenorio', NULL, NULL, '', 'feo@aims.edu.ph', '$2y$10$wXLoxvu4jwkPcvcE8miIoeulX/Jj9UxSATVmtQ8EfkhfwnqCAy8b.', 'OJT Supervisor', '2024-09-03 05:58:59'),
(48, 'Bryan', 'Custodio', 'Information Technology', '1-210146', NULL, '1-210146@aims.edu.ph', '$2y$10$Zqxev2m/HtOxDz914MALv.gTKGJPi6H3/wwhctjdu7aeAi9Gph9eS', 'OJT Student', '2024-09-03 06:00:01'),
(50, 'George', 'Balauag', 'Computer Science', '1-220703', NULL, '1-220703@aims.edu.ph', '$2y$10$JcTpp4qBNELuaZVc06KqieT3Mz9PNiBeufTYt7Yh9pvSeQ8Eidb7i', 'OJT Student', '2024-09-03 06:57:50'),
(52, 'Charlene', 'De Guzman', NULL, NULL, NULL, 'char@aims.edu.ph', '$2y$10$uC4Pe2QQ8T35twYXYQT1d.zvdJovBh6wfn.lOzR28t1poOHt5ppMm', 'Registrar', '2024-09-03 10:07:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_acc`
--
ALTER TABLE `users_acc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_acc`
--
ALTER TABLE `users_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
