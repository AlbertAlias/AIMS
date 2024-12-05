-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 06:14 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`) VALUES
(1, 59);

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `coor_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `user_id`, `department_id`, `coor_code`) VALUES
(1, 3, 1, 'VJ'),
(2, 4, 1, 'AL'),
(3, 5, 3, 'PJ'),
(4, 6, 4, 'OC'),
(5, 7, 5, 'JJ'),
(6, 8, 1, 'CP'),
(7, 9, 7, 'RG'),
(8, 10, 8, 'OC'),
(9, 11, 9, 'DM');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `department_head` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_head`) VALUES
(1, 'Accountancy', 'Darle Joy B. Escuton'),
(2, 'Business Administration', 'Eduardo B. Tuquilar'),
(3, 'Computer Engineering', 'Rozaida Tuazon'),
(4, 'Computer Science', 'Jose Mari Jasmin'),
(5, 'Criminology', 'Rozaida Tuazon'),
(6, 'Education', 'Ana Rose D. Lim'),
(7, 'Hospitality Management', 'Eduardo B. Tuquilar'),
(8, 'Information Technology', 'Rozaida Tuazon'),
(9, 'Tourism Management', 'Eduardo B. Tuquilar');

-- --------------------------------------------------------

--
-- Table structure for table `file_uploads`
--

CREATE TABLE `file_uploads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `intern_id` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `studentID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `intern_id`, `user_id`, `studentID`) VALUES
(37, 'JV001', 60, '1-210153'),
(38, 'JP001', 61, '1-210155'),
(39, 'JJ001', 62, '1-210156'),
(40, 'CO001', 63, '1-210157'),
(41, 'GR001', 64, '1-210159'),
(42, 'CO001', 65, '1-210160'),
(43, 'CD001', 66, '1-210161');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employee_number` varchar(20) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `personal_email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('developer','admin','coordinator','intern') NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_number`, `profile_picture`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `civil_status`, `personal_email`, `username`, `password`, `user_type`, `department_id`) VALUES
(1, '', 'profile_674cfeb933bd37.27505503.jpg', 'Custodio', 'Bryan', '', '', NULL, 'Santa Rosa', 'Single', 'bry@gmail.com', 'developer', '$2y$10$dwY/qMJfYueBEagEJlzJ6.vHWqInONX862GfhVXURI8s.nvGDxmd2', 'developer', NULL),
(3, '1C', NULL, 'Veron', 'Jeffrey', '', '', NULL, 'Santa Rosa', 'Single', 'jeff@gmail.com', 'acoor', '$2y$10$BUOcHAi/LDIIFzxhB8F9JuQpTV3ty0/BdE4CSs5kZrJ0kqTSw.EyO', 'coordinator', 1),
(4, '2C', NULL, 'Atienza', 'Leo', '', '', NULL, 'Santa Rosa', 'Single', 'leo@gmail.com', 'bacoor', '$2y$10$XhpoMKTT2mdjHIXFMJjXuuSHZo4dZ7trOjWdHL3BE5FnU5trnSnvi', 'coordinator', 2),
(5, '3C', NULL, 'Payos', 'John Paul', '', '', NULL, 'Santa Rosa', 'Single', 'jp@gmail.com', 'cpecoor', '$2y$10$tXNcdu8r0JV6r2qISfJm1.YpNZ6dYX3AZeAXCqsX/XKLu1QBae0DS', 'coordinator', 3),
(6, '4C', NULL, 'Oliva', 'Catherine', '', '', NULL, 'Santa Rosa', 'Single', 'cath@gmail.com', 'cscoor', '$2y$10$RBMYu1gz7aHt.4vSyeJ2DedPp6aFbaO8yGkte91qGqtwfKAPTn5Dy', 'coordinator', 4),
(7, '5C', NULL, 'Jasmin', 'Jose Mari', '', '', NULL, 'Santa Rosa', 'Single', 'jose@gmail.com', 'crimcoor', '$2y$10$Wr.TVvMS3TVmW4zvye3PZu92US7N2SUXXNDOSylMrqrrQeEPquRAW', 'coordinator', 5),
(8, '6C', NULL, 'Cera', 'Pauline Diola', '', '', NULL, 'Santa Rosa', 'Single', 'pau@gmail.com', 'educcoor', '$2y$10$Wk3jD7N2.Wg5AQer06q9ceVt3srQs800K6tHl9jAgOfrNFydXb3SG', 'coordinator', 6),
(9, '7C', NULL, 'Ramos', 'Grace', '', '', NULL, 'Santa Rosa', 'Single', 'grace@gmail.com', 'hmcoor', '$2y$10$zEXGLaECLzLTBcWMGTIB5u8HnGM6nSKdbjgA/ff0uj3kRcf1zhUSS', 'coordinator', 7),
(10, '8C', NULL, 'Oliva', 'Catherine', '', '', NULL, 'Santa Rosa', 'Single', 'cath@gmail.com', 'itcoor', '$2y$10$Y2NKRIwhu8mJrYIoloFi1e98v50E8WqZe.7ZLmvFamZ1sYOnr4pMa', 'coordinator', 8),
(11, '9C', NULL, 'De Guzman', 'Marie Charlene', '', '', NULL, 'Santa Rosa', 'Single', 'char@gmail.com', 'tmcoor', '$2y$10$9juZpdmy.LqkZHn6sK19j.zrIc2l4k0kPWaVpjPvhxbJiQDemJ/Cu', 'coordinator', 9),
(59, '10A', NULL, 'Balauag', 'George', '', '', NULL, 'Santa Rosa', '', 'george@gmail.com', 'admin', '$2y$10$/F3vSqd9oF7W3ppw.lEs0eQbA9LRUbGfeAnE/a2mUkQ9oq2RPQhpC', 'admin', NULL),
(60, '', NULL, 'Alias', 'Albert', NULL, NULL, 'Male', '', '', '', 'AA1210153', '$2y$10$O7O2AtDWfCSHPuYfRpSlZeRNC6c6WhEuqKZlppSrpfFco40jHVGr2', 'intern', 1),
(61, '', NULL, 'Balauag', 'George', NULL, NULL, 'Male', '', '', '', 'BG1210155', '$2y$10$HlTt09mfN0ZQalI7VXC32OaRJi4kplpHIIZ978JTeN2BKs6ODUX/W', 'intern', 3),
(62, '', NULL, 'Casulla', 'Jello Mark Andrei', NULL, NULL, 'Male', '', '', '', 'CJ1210156', '$2y$10$5EIHMYend9xzaxHnfGF8IOABXxENTKpzYxgnN.Hf99jRRDq.DTMVO', 'intern', 5),
(63, '', NULL, 'Talibsao', 'Jay Tee', NULL, NULL, 'Male', '', '', '', 'TJ1210157', '$2y$10$Zf.VEbI.HynUMdX/naYn2eTLQ1sOLI9TdMEZpl6SbUMVhNWlL5ehK', 'intern', 4),
(64, '', NULL, 'De Chavez', 'Lian James', NULL, NULL, 'Male', '', '', '', 'DL1210159', '$2y$10$q0uRZZIg7qx5C9k6.q8t5.UPNB15hOvj5by04eJyM3u963ExjYyxW', 'intern', 7),
(65, '', NULL, 'Barria', 'Carl', NULL, NULL, 'Male', '', '', '', 'BC1210160', '$2y$10$4vYkF.okKe.8h2D5ydm.bOZWn.AxbXePgyfymHy7YZ8jijKaGywPu', 'intern', 8),
(66, '', NULL, 'Redondo', 'Ronan', NULL, NULL, 'Male', '', '', '', 'RR1210161', '$2y$10$aVQUyGRNiXLDMNRIeHQTa.qa/Wk.sK/FVCizgkEXc9Xz7QtThDB3O', 'intern', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `file_uploads`
--
ALTER TABLE `file_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `file_uploads`
--
ALTER TABLE `file_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD CONSTRAINT `coordinators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coordinators_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `file_uploads`
--
ALTER TABLE `file_uploads`
  ADD CONSTRAINT `file_uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `interns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
