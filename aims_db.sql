-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 09:38 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`) VALUES
(9, 71),
(11, 73);

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `coor_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `user_id`, `department_id`, `coor_code`) VALUES
(43, 306, 1, 'VJ'),
(44, 307, 2, 'AL'),
(45, 308, 3, 'PJ'),
(46, 309, 5, 'OC'),
(47, 310, 4, 'JJ'),
(48, 311, 6, 'CP'),
(49, 312, 7, 'RG'),
(53, 316, 8, 'OC'),
(54, 317, 9, 'DM');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `department_head` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_head`) VALUES
(1, 'Accountancy', 'Darle Joy B. Escuton'),
(2, 'Business Administration', 'Eduardo B. Tuquilar'),
(3, 'Computer Engineering', 'Rozaida Tuazon'),
(4, 'Criminology', 'Jose Mari Jasmin'),
(5, 'Computer Science', 'Rozaida Tuazon'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `studentID` varchar(20) NOT NULL,
  `intern_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `user_id`, `studentID`, `intern_id`) VALUES
(316, 424, '1-210153', 'JV001'),
(317, 425, '1-210154', 'LA001'),
(318, 426, '1-210155', 'JP001'),
(319, 427, '1-210156', 'JJ001'),
(320, 428, '1-210157', 'CO001'),
(321, 429, '1-210158', 'PC001'),
(322, 430, '1-210159', 'GR001'),
(323, 431, '1-210160', 'CO001'),
(324, 432, '1-210161', 'CD001');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `civil_status` varchar(20) NOT NULL,
  `personal_email` varchar(100) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `employee_number` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','sub-admin','coordinator','intern') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `birthdate`, `civil_status`, `personal_email`, `contact_number`, `employee_number`, `department_id`, `username`, `password`, `user_type`) VALUES
(71, 'profile_6734598a0ee648.89908834.jpg', 'Custodio', 'Bryan', 'Guevarra', '', NULL, 'Santa Rosa', NULL, 'Single', 'bry@gmail.com', NULL, '1', NULL, 'admin', '$2y$10$uiOHQagRVCjOMjKu1swvhusyQUG5CAF90LmQK4PCXdrLVzav8zqB2', 'admin'),
(73, 'profile_672b0ebf027c79.63551893.jpeg', 'Balauag', 'George', '', '', NULL, 'Cabuyao', NULL, 'Single', 'geo@gmail.com', NULL, '2', NULL, 'subadmin', '$2y$10$gmcPNp7CBsTrw/L4.PzjuekkrqUUu7VcQccA4qUmeddQAL6dlXcXW', 'sub-admin'),
(306, NULL, 'Veron', 'Jeffrey', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'jeff@gmail.com', NULL, '1', 1, 'acoor', '$2y$10$bPPpQY69DMd0VUmxUaVS6ekXH6Te.V5C.Pr80wdgPDpoQTomKHAoK', 'coordinator'),
(307, NULL, 'Atienza', 'Leo', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'leo@gmail.com', NULL, '2', 2, 'bacoor', '$2y$10$r6P8Ia8mZTbgfXB9A2PleeH/2i8YPCesxw658XzIdBTY4DE4l0Ap6', 'coordinator'),
(308, NULL, 'Payos', 'John Paul', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'jp@gmail.com', NULL, '3', 3, 'cpecoor', '$2y$10$vEFtVFkgaELlVXzMsKusz.PdfCGHScH5eK.D3fDqrPFCu3.iWplIO', 'coordinator'),
(309, NULL, 'Oliva', 'Catherine', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'cath@gmail.com', NULL, '4', 5, 'cscoor', '$2y$10$KqacfJvznemq7IT4KzwAE.RWKqR67SNNvckCbN7N3yqlkHdnofwge', 'coordinator'),
(310, NULL, 'Jasmin', 'Jose Mari', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'jose@gmail.com', NULL, '5', 4, 'crimcoor', '$2y$10$87E4N7LLG4XD6WyUcRwVvuNOdgh5xVHbfs1PbpQ0FgTthQQhTKstm', 'coordinator'),
(311, NULL, 'Cera', 'Pauline', 'Diola', '', NULL, 'Santa Rosa', NULL, 'Single', 'pau@gmail.com', NULL, '6', 6, 'educcoor', '$2y$10$Hf20y2aWcJpkBIG4u6835u4b2yHUsIHZuyw0qdm2H0GsIU4RjaSha', 'coordinator'),
(312, NULL, 'Ramos', 'Grace', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'grace@gmail.com', NULL, '7', 7, 'hmcoor', '$2y$10$iGz0hbEFrZLbs2D/2CsjjeWfI8SsJ4n9mP38a56pnFClaQXgeXeHy', 'coordinator'),
(316, NULL, 'Oliva', 'Catherine', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'cath@gmail.com', NULL, '8', 8, 'itcoor', '$2y$10$7upxOqyqlSmjYmR.VcU6WO6GdR43VFejGIFRo3OR7nNzYGYJ5TaES', 'coordinator'),
(317, NULL, 'De Guzman', 'Marie Charlene', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'char@gmail.com', NULL, '9', 9, 'tmcoor', '$2y$10$d.p.YA7jQqugWixniKR7R.PgZx.4Aj4VyFnIFaDtjBlgAjSfuPscu', 'coordinator'),
(424, NULL, 'Alias', 'Albert', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 1, 'AA1210153', '$2y$10$AhkjUic1ts3PotJ4ic89weB0e1tmqMB0d164gqtkzn69eRtYgujKS', 'intern'),
(425, NULL, 'Arroyo', 'Justin', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 2, 'AJ1210154', '$2y$10$8cRLeJywbbthUkh9Ku4vdeH8mwrgUCZaVF/2kaf1mRVhnoJ0JZtKi', 'intern'),
(426, NULL, 'Balauag', 'George', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 3, 'BG1210155', '$2y$10$jMXr6T26lWT4g7t2Y6rDYelrYxhKOUAbfhcMWyAMIJqCMseDvo11W', 'intern'),
(427, NULL, 'Casulla', 'Jello Mark Andrei', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 4, 'CJ1210156', '$2y$10$dlwJDXA8CcebeAJZ7KQbu.gkmOLqG0qT48Y5J1IU31MshnABYof3G', 'intern'),
(428, NULL, 'Talibsao', 'Jay Tee', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 5, 'TJ1210157', '$2y$10$QoqJuCo2ZQmUw/YNsVZxNO/SkUQ8JNpGjff3wZZUPi8am5YAAx2cG', 'intern'),
(429, NULL, 'Custodio', 'Bryan', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 6, 'CB1210158', '$2y$10$ETEq88ezspDMe0l3hH3peuIP4x.BxsJTJzvtK9fM3S5lY6NJt1NFy', 'intern'),
(430, NULL, 'De Chavez', 'Lian James', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 7, 'DL1210159', '$2y$10$gAyXUrGnJTcrE6yOKySL1enON46e1m.mPoEOJ50nu/b61Fjk2MeGy', 'intern'),
(431, NULL, 'Barria', 'Carl', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 8, 'BC1210160', '$2y$10$P0m7cZ/qCvGROwrzE3r2lukDYfZMJeSF9HonfCHZq023gKZpZIgZG', 'intern'),
(432, NULL, 'Redondo', 'Ronan', NULL, NULL, 'Male', '', NULL, '', '', NULL, NULL, 9, 'RR1210161', '$2y$10$8.HQuRsxoByK.Ax7HYYOaOyov7uxkAfH22KoU1fjFQEPx/iifi69q', 'intern');

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
  ADD UNIQUE KEY `account_email` (`username`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `file_uploads`
--
ALTER TABLE `file_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;

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
