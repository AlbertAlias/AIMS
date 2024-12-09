-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 01:53 AM
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
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `coordinator_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coordinator_id`, `user_id`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `coordinator_evaluation`
--

CREATE TABLE `coordinator_evaluation` (
  `evaluation_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `coordinator_grade` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `dean_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `dean_id`) VALUES
(1, 'BSA', NULL),
(2, 'BSBA', NULL),
(3, 'BSCPE', 4),
(4, 'BSCS', 4),
(5, 'BSCRIM', NULL),
(6, 'BSED', NULL),
(7, 'BSHM', NULL),
(8, 'BSIT', 4),
(9, 'BSTM', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ojt_hours`
--

CREATE TABLE `ojt_hours` (
  `coordinator_id` int(11) DEFAULT NULL,
  `hours_needed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `requirement_id` int(11) NOT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('approved','rejected','pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submit_requirements`
--

CREATE TABLE `submit_requirements` (
  `submit_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `status` enum('approved','rejected','pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` enum('IT','Dean','Coordinator','Student','Supervisor','Registrar') DEFAULT NULL,
  `emergency_number` varchar(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `academic_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `username`, `password`, `user_type`, `emergency_number`, `address`, `email`, `gender`, `department_id`, `company`, `company_address`, `student_id`, `academic_year`) VALUES
(1, 'albert', 'bryan', 'george', 'itdev', '$2y$10$1/X0mF3r533RLAeuYG3pRuzk.4DhfKdjuTTCVj7uG/j2wotgnGARC', 'IT', NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL),
(3, 'Arroyo', 'Justin', NULL, 'bstmdean', '$2y$10$o.kyhPfCQCCQe4HkEnrL1u8/K6yNFTH8sr26JkdpajhzAR62NlIje', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Balauag', 'George', NULL, 'ceitedean', '$2y$10$E5CbWgg28LdDDBrbel9bn.MSPzdtjqOIALmiaSFi/JWU/DQGKMvr6', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'BSIT', 'BSIT', 'BSIT', 'bsitcoor', '$2y$10$qI919QY4uqENgDs0Pe2kRuZxIoTsgRHKdwEyRh2O22bGoonsQ7TWq', 'Coordinator', NULL, NULL, 'BSIT@gmail.com', NULL, 8, NULL, NULL, NULL, NULL),
(6, 'Abella', 'Adriane Paul', NULL, '1190302', '$2y$10$fksNQCrc42oIKbzMG0YwrO8mmIdFL4pAFH6N2291wzSO8pUo9dSBu', 'Student', NULL, NULL, NULL, 'Male', 8, NULL, NULL, '1', 2022),
(7, 'Abellano', 'Dynarose', NULL, '1200043', '$2y$10$sNbu8OxikpmerzFZ1a3FGuNWczZ8Moj4Snm0aALwfOIT6t0CYUYK.', 'Student', NULL, NULL, NULL, 'Female', 8, NULL, NULL, '1', 2022),
(8, 'Alaurin', 'Karl Dominic', NULL, '1190058', '$2y$10$Y.Fggfq.tOwLO8yuActJK.ROdjmy3P1dnkpspXAJTi4BxGOb2Qllu', 'Student', NULL, NULL, NULL, 'Male', 8, NULL, NULL, '1', 2022),
(9, 'Apquiz', 'John Lorenz', NULL, '1200083', '$2y$10$hbgsSSEm7cs.FD847deqRuaC9oM.0Vc31e9nctdOeSSImoRacCnEa', 'Student', NULL, NULL, NULL, 'Male', 8, NULL, NULL, '1', 2022),
(10, 'Arambulo', 'Joshua', NULL, '1200146', '$2y$10$a/lpLbyRDd5lJBvfxBmfcuIJ0fXc3VmpTRl4hnJ/U6bMxwycowIFy', 'Student', NULL, NULL, NULL, 'Male', 8, NULL, NULL, '1', 2022),
(11, 'Balquin', 'Gerald', NULL, '1200027', '$2y$10$RiBWQJTKhoONtqtQIdzxmeJ0vzTFoXN.DIKKsqDXi1OyKvY9SAVdu', 'Student', NULL, NULL, NULL, 'Male', 8, NULL, NULL, '1', 2022),
(12, 'Carteciano', 'Mj Bryan', NULL, '1210016', '$2y$10$2Rs9Ppru2BQeykbGSltEMupcJh5fQLNwRV1pm4rtCHrUpPxUoZWQW', 'Student', NULL, NULL, NULL, 'Male', 8, NULL, NULL, '1', 2022),
(13, 'Cledera', 'Dulce Maria', NULL, '1200086', '$2y$10$2WYSOwvn8CEJ/dEVbtCOFed6ahXerLcz26kVZ0dEGwFO6NUFkZPj.', 'Student', NULL, NULL, NULL, 'Female', 8, NULL, NULL, '1', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_reports`
--

CREATE TABLE `weekly_reports` (
  `report_id` int(11) NOT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('approved','rejected','pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`coordinator_id`),
  ADD KEY `FK_coordinator_user` (`user_id`);

--
-- Indexes for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `FK_coordinator_evaluation_student` (`student_id`),
  ADD KEY `FK_coordinator_evaluation_supervisor` (`supervisor_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD KEY `FK_department_dean` (`dean_id`);

--
-- Indexes for table `ojt_hours`
--
ALTER TABLE `ojt_hours`
  ADD KEY `FK_ojt_hours_coordinator` (`coordinator_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`requirement_id`),
  ADD KEY `FK_requirements_coordinator` (`coordinator_id`);

--
-- Indexes for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  ADD PRIMARY KEY (`submit_id`),
  ADD KEY `FK_submit_requirements_student` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `FK_users_department` (`department_id`);

--
-- Indexes for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `FK_weekly_reports_coordinator` (`coordinator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  MODIFY `submit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD CONSTRAINT `FK_coordinator_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  ADD CONSTRAINT `FK_coordinator_evaluation_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_coordinator_evaluation_supervisor` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `FK_department_dean` FOREIGN KEY (`dean_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `ojt_hours`
--
ALTER TABLE `ojt_hours`
  ADD CONSTRAINT `FK_ojt_hours_coordinator` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `FK_requirements_coordinator` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);

--
-- Constraints for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  ADD CONSTRAINT `FK_submit_requirements_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD CONSTRAINT `FK_weekly_reports_coordinator` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
