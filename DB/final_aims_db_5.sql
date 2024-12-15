-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 06:55 AM
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
(1, 3),
(2, 32);

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
-- Table structure for table `dean_department`
--

CREATE TABLE `dean_department` (
  `dean_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean_department`
--

INSERT INTO `dean_department` (`dean_id`, `department_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(22, 4),
(23, 5),
(31, 6);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(5, 'BSA'),
(6, 'BSBA'),
(3, 'BSCPE'),
(7, 'BSCRIM'),
(2, 'BSCS'),
(1, 'BSIT'),
(4, 'BSTM');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`requirement_id`, `coordinator_id`, `title`, `description`, `created_at`) VALUES
(44, 3, 'Application Letter', 'Maalis dapat to', '2024-12-13 04:28:41'),
(45, 3, 'Resume Letter', 'Di dapat to maaalis', '2024-12-13 04:28:53'),
(46, 3, 'Birth Certificate', 'Maiiwan dapat to magisa', '2024-12-13 04:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `submit_requirements`
--

CREATE TABLE `submit_requirements` (
  `submit_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `status` enum('approved','rejected','pending') DEFAULT NULL,
  `submission_date` datetime DEFAULT current_timestamp(),
  `requirement_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_requirements`
--

INSERT INTO `submit_requirements` (`submit_id`, `student_id`, `document_name`, `status`, `submission_date`, `requirement_id`) VALUES
(82, 4, 'Application Letter.pdf', 'pending', '2024-12-13 13:18:17', 44),
(83, 4, 'Resume Letter.pdf', 'rejected', '2024-12-13 13:18:23', 45),
(84, 4, 'Birth Certificate.pdf', 'approved', '2024-12-13 13:19:06', 46);

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
  `academic_year` int(11) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `username`, `password`, `user_type`, `emergency_number`, `address`, `email`, `gender`, `department_id`, `company`, `company_address`, `student_id`, `academic_year`, `profile_picture`) VALUES
(1, 'Sabao', 'Joemari', '', 'itdev', '$2y$10$1/X0mF3r533RLAeuYG3pRuzk.4DhfKdjuTTCVj7uG/j2wotgnGARC', 'IT', NULL, 'Santa Rosa Laguna', 'itdev@gmail.com', 'Male', NULL, NULL, NULL, NULL, NULL, 'profile_675cf1ced375b9.47616365.jpg'),
(2, 'DEAN', 'CEITE', NULL, 'ceitedean', '$2y$10$POlAJNjZLlLDDcQCEbCywesmhPze32aL4RSxPWtA5Dx.IspqgEjUO', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'COOR', 'BSIT', '', 'bsitcoor', '$2y$10$eLmRYH/Y/4eJiFTYCYFWTuToi3TdlRSLHUyA/bEaG3Yh0KxQ6omN2', 'Coordinator', NULL, NULL, 'bsit@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Abella', 'Adriane Paul', NULL, '1190302', '$2y$10$hAq3AW4Qv6MDR9oFDIdNUOBxHFKkCkiZ90KNfH96PU4iGOdFIYeqC', 'Student', NULL, NULL, '1-190302@asiatech.edu.ph', 'Male', 1, NULL, NULL, '1190302', 2022, NULL),
(5, 'Abellano', 'Dynarose', NULL, '1200043', '$2y$10$3PfUofkZktBG2zg9D8IJH.hl9yhpJUfhEmyChvMDjIiMGG70y1EF6', 'Student', NULL, NULL, '1200043@asiatech.edu.ph', 'Female', 1, NULL, NULL, '1200043', 2022, NULL),
(22, 'Arroyo', 'Dyastin', NULL, 'tmdean', '$2y$10$UxP7myNub2Yq98M33Z1c8OwJ9a7.EpQaY.pGlukdmC6x5tv4vnOTO', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Balauag', 'George', NULL, 'adean', '$2y$10$F0XvwILC4mxXj3f.4hrcXuGSVUoTNcDWT/xviTJqNWcx6MlBDtWf6', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Lao', 'Soffia Pearl', NULL, 'bsdean', '$2y$10$Pocg1Hpy5W2bRhYgHt9RGuW33shfpGzsK9BM.0Kxi6GTc5q9yLioS', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Payos', 'John Paul', '', 'cpecoor', '$2y$10$1iE8ZO35Uky.bffFqz9aVufEHsxez1WxJPknVZqlJktH/We0jEObW', 'Coordinator', NULL, NULL, 'cpe@gmail.com', NULL, 3, NULL, NULL, NULL, NULL, NULL);

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
-- Indexes for table `dean_department`
--
ALTER TABLE `dean_department`
  ADD PRIMARY KEY (`dean_id`,`department_id`),
  ADD KEY `FK_dean_department_department` (`department_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `ojt_hours`
--
ALTER TABLE `ojt_hours`
  ADD KEY `FK_ojt_hours_coordinator` (`coordinator_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`requirement_id`);

--
-- Indexes for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  ADD PRIMARY KEY (`submit_id`),
  ADD KEY `requirement_id` (`requirement_id`);

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
  MODIFY `coordinator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  MODIFY `submit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- Constraints for table `dean_department`
--
ALTER TABLE `dean_department`
  ADD CONSTRAINT `FK_dean_department_dean` FOREIGN KEY (`dean_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_dean_department_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE;

--
-- Constraints for table `ojt_hours`
--
ALTER TABLE `ojt_hours`
  ADD CONSTRAINT `FK_ojt_hours_coordinator` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);

--
-- Constraints for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  ADD CONSTRAINT `fk_requirement_id` FOREIGN KEY (`requirement_id`) REFERENCES `requirements` (`requirement_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submit_requirements_ibfk_1` FOREIGN KEY (`requirement_id`) REFERENCES `requirements` (`requirement_id`);

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
