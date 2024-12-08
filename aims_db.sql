-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 03:49 PM
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
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `user_id`) VALUES
(1, 5),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `dean`
--

CREATE TABLE `dean` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dean`
--

INSERT INTO `dean` (`id`, `user_id`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `dean_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `dean_id`) VALUES
(1, 'NEWJABOL', 1),
(2, 'PARAK', 2),
(3, 'PAKAN', 3),
(4, 'Information Technology', 4),
(5, 'bago', NULL),
(6, 'isa pa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrar`
--

CREATE TABLE `registrar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `studentID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `studentID`) VALUES
(1, 8, '1-190302'),
(2, 9, '1-200043'),
(3, 10, '1-190058'),
(4, 11, '1-200083'),
(5, 12, '1-200146'),
(6, 13, '1-200027'),
(7, 14, '1-210016'),
(8, 15, '1-200086');

-- --------------------------------------------------------

--
-- Table structure for table `student_requirements`
--

CREATE TABLE `student_requirements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_requirements`
--

INSERT INTO `student_requirements` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'try', 'try', '2024-12-07 13:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_submissions`
--

CREATE TABLE `student_submissions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `requirement_id` int(11) NOT NULL,
  `submitted_documents` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employee_no` varchar(20) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `personal_email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('it','dean','coordinator','student','supervisor','registrar') NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_no`, `profile_picture`, `last_name`, `first_name`, `middle_name`, `gender`, `address`, `personal_email`, `username`, `password`, `user_type`, `department_id`) VALUES
(1, '', NULL, 'albert', 'bryan', NULL, NULL, '', '', 'it', '$2y$10$dwY/qMJfYueBEagEJlzJ6.vHWqInONX862GfhVXURI8s.nvGDxmd2', 'it', NULL),
(2, '', NULL, 'JABOL', 'JABOL', NULL, NULL, '', '', 'JABOL', '$2y$10$E1tdm/AkwMxcEdZUnf5fVexkBVFjQorG0zOaW5Tra5SuLbAw/flAW', 'dean', 1),
(3, '', NULL, 'GEORGE', 'GEORGEQ', NULL, NULL, '', '', 'GEORGE', '$2y$10$qvsT2n/AS9CrO9pH4Aw5q.srbRJ6Hb8iOmPV59yECCeTLqZ0uW3yq', 'dean', 2),
(4, '', NULL, 'TOT', 'TOT', NULL, NULL, '', '', 'TOT', '$2y$10$DP2SlrY8dQFEaQ1PmpwlLeesW3z7J4AqcR.x/W2VPBPnofABbjyf2', 'dean', 3),
(5, '12345', NULL, 'tot', 'tot', 'tot', NULL, 'tot', 'tot@gmail.com', 'toto', '$2y$10$48fRBnHTFrTgr/JXiBQP/e63P0nd1LHnuXglBAkDGMe1xUujTL9zS', 'coordinator', 3),
(6, '', NULL, 'Tuazon', 'Rozaida', NULL, NULL, '', '', 'dean', '$2y$10$6VDKzzIV887cW3MhThiZPOjlmBcvQjiC8NJmtIUXim7JxslLn5G/i', 'dean', 4),
(7, '12345', NULL, 'coor', 'coor', 'coor', NULL, 'coor', 'coor@gmail.com', 'coor', '$2y$10$T1jJxZPYfqemobsMc4KsyewbckI40OFc8.Cafc051T5xf3ctv56La', 'coordinator', 4),
(8, '', NULL, 'Abella', 'Adriane Paul', NULL, 'Male', '', '', '1190302', '$2y$10$gRPlIRlMrqHB77g63tGqeeN5FFowDr0HZvAHGgyxaF4CMhWUlYEuq', 'student', 4),
(9, '', NULL, 'Abellano', 'Dynarose', NULL, 'Female', '', '', '1200043', '$2y$10$wqnBcLGNqdKwQVFjwLKW7OE3vwbWBQnYHwwO/FT9IZojCUJf5.BEm', 'student', 4),
(10, '', NULL, 'Alaurin', 'Karl Dominic', NULL, 'Male', '', '', '1190058', '$2y$10$2HAuz.5c1wD0OP6xdXfGDOWJYhrMEch.hfQiz8PHM.Xlz9A1Mkgei', 'student', 4),
(11, '', NULL, 'Apquiz', 'John Lorenz', NULL, 'Male', '', '', '1200083', '$2y$10$eDLUbynzdKRh6NIXHu5qj.wHDUSQxvbITIMa4Qwl686gUj6xyUJwC', 'student', 4),
(12, '', NULL, 'Arambulo', 'Joshua', NULL, 'Male', '', '', '1200146', '$2y$10$hyPqpJgGW29SDk16GaHodekKxoYNuE1w7BFQ.1fAL8qQDpJb4/HW6', 'student', 4),
(13, '', NULL, 'Balquin', 'Gerald', NULL, 'Male', '', '', '1200027', '$2y$10$yUeHVdTcWvRkcf4g3tWooun.hGqABJF.3StDc6QtroLpmWcPLGI3i', 'student', 4),
(14, '', NULL, 'Carteciano', 'Mj Bryan', NULL, 'Male', '', '', '1210016', '$2y$10$9Fr662QVbUe.FZQYl47H4unj3Vq2gf501JnmTrigVEaAFDCnP8AUm', 'student', 4),
(15, '', NULL, 'Cledera', 'Dulce Maria', NULL, 'Female', '', '', '1200086', '$2y$10$G0iGYbj535Ln6h961Bmbzen/EYJpJanmYvhWKnFCAvoRd0IlIWxHq', 'student', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `dean`
--
ALTER TABLE `dean`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD KEY `dean_id` (`dean_id`);

--
-- Indexes for table `registrar`
--
ALTER TABLE `registrar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentID` (`studentID`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `student_requirements`
--
ALTER TABLE `student_requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_submissions`
--
ALTER TABLE `student_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirement_id` (`requirement_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dean`
--
ALTER TABLE `dean`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_requirements`
--
ALTER TABLE `student_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_submissions`
--
ALTER TABLE `student_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD CONSTRAINT `coordinators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dean`
--
ALTER TABLE `dean`
  ADD CONSTRAINT `dean_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`dean_id`) REFERENCES `dean` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `registrar`
--
ALTER TABLE `registrar`
  ADD CONSTRAINT `registrar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_submissions`
--
ALTER TABLE `student_submissions`
  ADD CONSTRAINT `student_submissions_ibfk_1` FOREIGN KEY (`requirement_id`) REFERENCES `student_requirements` (`id`),
  ADD CONSTRAINT `student_submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
