-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 10:13 PM
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
(1, 4);

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
-- Table structure for table `dean`
--

CREATE TABLE `dean` (
  `user_id` int(11) NOT NULL,
  `department_1` int(11) DEFAULT NULL,
  `department_2` int(11) DEFAULT NULL,
  `department_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean`
--

INSERT INTO `dean` (`user_id`, `department_1`, `department_2`, `department_3`) VALUES
(2, 1, 2, 3);

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
(2, 'BSCPE'),
(3, 'BSCS'),
(1, 'BSIT');

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
  `status` enum('approved','reject','pending') DEFAULT NULL,
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
  `status` enum('approved','reject','pending') DEFAULT NULL
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
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `academic_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `username`, `password`, `user_type`, `email`, `gender`, `department_id`, `company`, `company_address`, `student_id`, `academic_year`) VALUES
(1, 'albert', 'bryan', 'george', 'itdev', '$2y$10$1/X0mF3r533RLAeuYG3pRuzk.4DhfKdjuTTCVj7uG/j2wotgnGARC', 'IT', NULL, 'Male', NULL, NULL, NULL, NULL, NULL),
(2, 'Tuazon', 'Rozaida', NULL, 'ceitedean', '$2y$10$RoSPEG.mDBuNUlLpIMv6MuqVFoygnwQmGj6x9rkkI/ynPTVz5KW5i', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'bsit', 'bsit', 'bsit', 'bsitcoor', '$2y$10$8yc0rx.TVepztkxkj4dqHOX/sgaRp4L8Ec48Su9GCKxpAh6TSuxgS', 'Coordinator', 'bsit', NULL, 1, NULL, NULL, NULL, NULL),
(6, 'Abella', 'Adriane Paul', NULL, '1190302', '$2y$10$dt0NOd1p3pla6AWheMKQ5.VrXoSWfoOoVq73BiluEf0uXBG4kCJEe', 'Student', NULL, 'Male', 1, NULL, NULL, '1', 2022),
(7, 'Abellano', 'Dynarose', NULL, '1200043', '$2y$10$Eupp1slOxuDwEWlBj75pvuQq0BSs1mxE98622ToDsGaftEKzFWq3G', 'Student', NULL, 'Female', 1, NULL, NULL, '1', 2022),
(8, 'Alaurin', 'Karl Dominic', NULL, '1190058', '$2y$10$ZZ5VEaHp4.flM6U8uZmhTuJDP93sRUCWi3Xf514FzNXrH6EqC0.NK', 'Student', NULL, 'Male', 1, NULL, NULL, '1', 2022),
(9, 'Apquiz', 'John Lorenz', NULL, '1200083', '$2y$10$e211hh.2iCDC66Jrm7WM/OIekXA/mWuPu77mBRSmXu0yuFgarkXGe', 'Student', NULL, 'Male', 1, NULL, NULL, '1', 2022),
(10, 'Arambulo', 'Joshua', NULL, '1200146', '$2y$10$LfDf5TME..aCeF2AqH05reGR7bxLrJg20LgaUsW922nsHBzsbLD/m', 'Student', NULL, 'Male', 1, NULL, NULL, '1', 2022),
(11, 'Balquin', 'Gerald', NULL, '1200027', '$2y$10$EBwzchAxHl9e4d.n1fVs.eLLhvCTejcYlhUOc2FlhRsJXX8j.8wLa', 'Student', NULL, 'Male', 1, NULL, NULL, '1', 2022),
(12, 'Carteciano', 'Mj Bryan', NULL, '1210016', '$2y$10$aUU.UCF2iTM4uJw4CAFScOzgu77fathms5hOKIW093UsJwVvsht/W', 'Student', NULL, 'Male', 1, NULL, NULL, '1', 2022),
(13, 'Cledera', 'Dulce Maria', NULL, '1200086', '$2y$10$nlg2ABhngTKeOl9aRJWikO/86s5KnSXJPHgzX9n1zIOl6vFQmD5..', 'Student', NULL, 'Female', 1, NULL, NULL, '1', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_reports`
--

CREATE TABLE `weekly_reports` (
  `report_id` int(11) NOT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('approved','reject','pending') DEFAULT NULL,
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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indexes for table `dean`
--
ALTER TABLE `dean`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `department_1` (`department_1`),
  ADD KEY `department_2` (`department_2`),
  ADD KEY `department_3` (`department_3`);

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
  ADD KEY `coordinator_id` (`coordinator_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`requirement_id`),
  ADD KEY `coordinator_id` (`coordinator_id`);

--
-- Indexes for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  ADD PRIMARY KEY (`submit_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `coordinator_id` (`coordinator_id`);

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
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `coordinator_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  ADD CONSTRAINT `coordinator_evaluation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `coordinator_evaluation_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `dean`
--
ALTER TABLE `dean`
  ADD CONSTRAINT `dean_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `dean_ibfk_2` FOREIGN KEY (`department_1`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `dean_ibfk_3` FOREIGN KEY (`department_2`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `dean_ibfk_4` FOREIGN KEY (`department_3`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `ojt_hours`
--
ALTER TABLE `ojt_hours`
  ADD CONSTRAINT `ojt_hours_ibfk_1` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);

--
-- Constraints for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  ADD CONSTRAINT `submit_requirements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD CONSTRAINT `weekly_reports_ibfk_1` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator` (`coordinator_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
