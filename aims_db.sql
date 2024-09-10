-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 01:04 AM
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
  `profile_picture` longblob DEFAULT NULL,
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

INSERT INTO `users_acc` (`id`, `profile_picture`, `firstname`, `lastname`, `department`, `studentID`, `company`, `email`, `password`, `user_type`, `created_at`) VALUES
(34, '', NULL, NULL, NULL, NULL, NULL, 'admin@aims.edu.ph', '$2y$10$Li/ITgDL4iAOP.CunWJP4uK7KzVcrTYxnlsqjsKMAXkaRwr7caEi.', 'Admin', '2024-09-01 06:48:24'),
(44, NULL, 'John Paul', 'Payos', 'Computer Engineering', NULL, '', 'jpp@aims.edu.ph', '$2y$10$ezJ7sFstoWWuzCHzducdl.JzSEG9bI1wloIdWaPQLt9G9wUP0bKzW', 'OJT Coordinator', '2024-09-03 05:55:10'),
(46, NULL, 'Alfeo', 'Tenorio', NULL, NULL, '', 'feo@aims.edu.ph', '$2y$10$wXLoxvu4jwkPcvcE8miIoeulX/Jj9UxSATVmtQ8EfkhfwnqCAy8b.', 'OJT Supervisor', '2024-09-03 05:58:59'),
(52, NULL, 'Charlene', 'De Guzman', NULL, NULL, NULL, 'char@aims.edu.ph', '$2y$10$uC4Pe2QQ8T35twYXYQT1d.zvdJovBh6wfn.lOzR28t1poOHt5ppMm', 'Registrar', '2024-09-03 10:07:04'),
(53, NULL, 'Albert', 'Alias', 'Information Technology', '1-210153', NULL, '1-210153@aims.edu.ph', '$2y$10$PB09aXDdGgBn.ygY2/c3COXpr4JezQYCrmVJynRKfRsk38y8L4nLu', 'OJT Student', '2024-09-10 21:41:51'),
(54, NULL, 'Jay Tee', 'Talibsao', 'Computer Engineering', '1-210154', NULL, '1-210154@aims.edu.ph', '$2y$10$LgeiusSnLwRW/l/JYUb/Ce4d71mYVmDoEbq6XGUomZTBnd8kAlYAa', 'OJT Student', '2024-09-10 21:43:11'),
(55, NULL, 'Ronan', 'Redondo', 'Tourism Management', '1-210156', NULL, '1-210156@aims.edu.ph', '$2y$10$7Jy6MimwZJDwkiVDUVJc8O4/wECeaFrJXbEUQWKqcQffTDMVH2u7i', 'OJT Student', '2024-09-10 21:44:02'),
(56, NULL, 'Lian', 'De Chavez', 'Business Administration', '1-210157', NULL, '1-210157@aims.edu.ph', '$2y$10$EJjpC1lBCR2M2ImiME5BT.ztORnUNl2NUHeMKp7DGxNeHhbUx1gB6', 'OJT Student', '2024-09-10 21:45:19'),
(57, NULL, 'George', 'Balauag', 'Education', '1-210160', NULL, '1-210160@aims.edu.ph', '$2y$10$EZf4XWur5gs5Ufyhaftb3OcrTdrcJ2SfF1gnr8Qi3.J3IDQ6ycNfa', 'OJT Student', '2024-09-10 21:47:22'),
(58, NULL, 'Francis', 'Diaz', 'Criminology', '1-210161', NULL, '1-210161@aims.edu.ph', '$2y$10$zAuHclw6o5116WPMYni00.L4L9cpna5CixucVR1PTGMEduVjLzyua', 'OJT Student', '2024-09-10 21:48:02'),
(59, NULL, 'Sharlene', 'Flaviano', 'Hospitality Management', '1-210158', NULL, '1-210158@aims.edu.ph', '$2y$10$vhPQdCY3vzjhcerMILn5NuQ8.C2Ur6ttJJPLU0kd20JHDkqdZ8T/O', 'OJT Student', '2024-09-10 21:49:07'),
(60, NULL, 'Zach', 'Bascon', 'Computer Science', '1-210155', NULL, '1-210155@aims.edu.ph', '$2y$10$oP9zTZLTOtCLIcN3Rl.5We2lxzu3KDghkPRC9yemmiIVi0zS5R4mO', 'OJT Student', '2024-09-10 21:51:06'),
(61, NULL, 'Jelo', 'Casulla', 'Accountancy', '1-210159', NULL, '1-210159@aims.edu.ph', '$2y$10$6s/GDoEetGinMhHKZeRSG.Unqfar7LgxOcz4Nqy4GRjsDrjXD6UFO', 'OJT Student', '2024-09-10 21:52:16');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
