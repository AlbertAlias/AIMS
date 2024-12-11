-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 11:42 AM
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
(2, 14),
(3, 15);

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
(10, 'BSIT', NULL),
(11, 'BSTM', NULL);

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

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`requirement_id`, `coordinator_id`, `title`, `description`, `status`, `created_at`) VALUES
(0, 14, 'Resume', 'BSIT', 'pending', '2024-12-11 10:29:39');

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
(0, 'George', 'balauag', 'B', 'visor', '$2y$10$cphUi3xdsF/vNR.eqK241O0csJ7l0/NmKA1NWliy7Bn/5QESk/2N.', 'Supervisor', NULL, NULL, 'brysda@gmail.com', 'Male', NULL, 'George', 'sdsadw', NULL, NULL),
(1, 'albert', 'bryan', 'george', 'itdev', '$2y$10$1/X0mF3r533RLAeuYG3pRuzk.4DhfKdjuTTCVj7uG/j2wotgnGARC', 'IT', NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL),
(14, 'Custodio', 'Bryan', 'G', 'itcoor', '$2y$10$FPe/peX1zZZu72QwvIFG7.y5uWEJL5aVQ8vb.LBOgl1oH4HF5cKaC', 'Coordinator', NULL, NULL, 'Custodio@gmail.com', NULL, 10, NULL, NULL, NULL, NULL),
(15, 'Bryan', 'Custodio', 'G', 'tmcoor', '$2y$10$gUc7wPRYS3HmK3jUhl3.4.8ASxfvue5r8qzJuj2tBKT7yUlXSgyt.', 'Coordinator', NULL, NULL, 'Custodio@gmail.com', NULL, 11, NULL, NULL, NULL, NULL),
(16, 'Abella', 'Adriane Paul', NULL, '112233', '$2y$10$UWNXtJS7SUZ69BZtd.92hOGreFyspJBEiPOiykhoPh84cLls5OTqq', 'Student', NULL, NULL, NULL, 'Male', 10, NULL, NULL, '1', 2022),
(17, 'Abellano', 'Dynarose', NULL, '112234', '$2y$10$gRYxKddna48E/kXggIvUrO.uUAvQkOc/8iVmF.ZVZFgefaskWPVpy', 'Student', NULL, NULL, NULL, 'Female', 10, NULL, NULL, '1', 2022),
(18, 'Alaurin', 'Karl Dominic', NULL, '112235', '$2y$10$gNKnUVyIR2S/IeORa1FA2ehqkco2zodIW7bd0SPXT9sryKuJgNSU.', 'Student', NULL, NULL, NULL, 'Male', 10, NULL, NULL, '1', 2022),
(19, 'Apquiz', 'John Lorenz', NULL, '112236', '$2y$10$6OgOOqAqcu7oNyqRD0VPIu9Lb/7S1zmgWw292LMKE.OfS2bW65xOS', 'Student', NULL, NULL, NULL, 'Male', 10, NULL, NULL, '1', 2022),
(20, 'Arambulo', 'Joshua', NULL, '112237', '$2y$10$mBxusyEs0YiUvkWJX6wv3ebhxtVpYItVl9F/Q1F8mrGjDm3YjdwKu', 'Student', NULL, NULL, NULL, 'Male', 11, NULL, NULL, '1', 2022),
(21, 'Balquin', 'Gerald', NULL, '112238', '$2y$10$agZdNHBGHnl31B2feVccK.I5GdsVReobM1rTwX0FCBu27fEDqiX0a', 'Student', NULL, NULL, NULL, 'Male', 11, 'George', NULL, '1', 2022),
(22, 'Carteciano', 'Mj Bryan', NULL, '112239', '$2y$10$S8GrI4FXKIxL/1OblNWhEuuEtEqrwacyZSodpniAlEntCIA8eO1Ta', 'Student', NULL, NULL, NULL, 'Male', 11, 'George', NULL, '1', 2022),
(23, 'Cledera', 'Dulce Maria', NULL, '112240', '$2y$10$tZ4xrVcaqcTn93rG9ZdQ/On/C6fYcx3t4tFWh/VgQU6yVxBibthxm', 'Student', NULL, NULL, NULL, 'Female', 11, 'George', NULL, '1', 2022);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
