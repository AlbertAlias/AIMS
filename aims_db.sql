-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 03:30 PM
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
(9, 71),
(11, 73);

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `user_id`, `department_id`) VALUES
(5, 6, 1),
(15, 23, 2),
(16, 24, 3),
(17, 25, 5),
(18, 26, 4),
(19, 27, 6),
(20, 28, 7),
(21, 29, 8),
(22, 30, 9);

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
(4, 'Criminology', 'Chief D. Guard'),
(5, 'Computer Science', 'Rozaida Tuazon'),
(6, 'Education', 'Marmelo V. Abante'),
(7, 'Hospitality Management', 'Marigrace R. Ramos'),
(8, 'Information Technology', 'Rozaida Tuazon'),
(9, 'Tourism Management', 'Eduardo B. Tuquilar');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `studentID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `user_id`, `studentID`) VALUES
(33, 82, '1-210153'),
(34, 83, '1-210154'),
(35, 84, '1-210155'),
(36, 85, '1-210156'),
(37, 86, '1-210157'),
(38, 87, '1-210158'),
(39, 88, '1-210159'),
(40, 89, '1-210160'),
(41, 90, '1-210161');

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
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `personal_email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `account_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','sub-admin','coordinator','intern') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `birthdate`, `civil_status`, `personal_email`, `contact_number`, `department_id`, `account_email`, `password`, `user_type`) VALUES
(6, NULL, 'Escuton', 'Darle Joy', 'B.', '', 'Female', 'Santa Rosa', '2024-09-29', 'Married', 'darle@gmail.com', '9856123644', 1, 'acoor@aims.edu.ph', '$2y$10$KVoSSLHBxZ/H8BLeuwP/Ie2dKkYZnfmippkF0QD16GGohwf0aiiwy', 'coordinator'),
(23, NULL, 'Deada', 'Lani', 'D.', '', 'Female', 'Santa Rosa', '2024-03-10', 'Married', 'lani@gmail.com', '9932742778', 2, 'bacoor@aims.edu.ph', '$2y$10$m9PTDttv9OrFtiRwDnL6N.YUj0hrZU/FaY1cfjHUz1XVURAYhUZqm', 'coordinator'),
(24, NULL, 'Tuazon', 'Rozaida', 'C.', '', 'Female', 'Santa Rosa', '2024-03-10', 'Married', 'aida@gmail.com', '9861364843', 3, 'cpecoor@aims.edu.ph', '$2y$10$leAWl6/rAVQCC3/w88REwe2locDlYg5uIP3922wLwxpnLSr/lDRY2', 'coordinator'),
(25, NULL, 'Tuazon', 'Rozaida', 'C.', '', 'Male', 'Santa Rosa', '2024-03-10', 'Married', 'aida@gmail.com', '9931488741', 5, 'cscoor@aims.edu.ph', '$2y$10$qbQ7ojw8D0rFCROL5541FOn/coPJ/2CgmUdDbe4YU6c10rcFjUOYC', 'coordinator'),
(26, NULL, 'Guard', 'Chief', 'D.', '', 'Male', 'Santa Rosa', '2024-03-10', 'Single', 'chief@gmail.com', '9961668301', 4, 'crimcoor@aims.edu.ph', '$2y$10$iqC7V3jvEx7rRw81F5GGCuHTrjM9EADzlUdsFJ3g6UekiOvJxPZu.', 'coordinator'),
(27, NULL, 'Lim', 'Ana Rose', 'D.', '', 'Female', 'Santa Rosa', '2024-03-10', 'Married', 'rose@gmail.com', '9961648446', 6, 'educcoor@aims.edu.ph', '$2y$10$3jjRIevWrH2Jf3h4hTvfxOO0AYlX9mV6tan4Iez70S3y.e/lVEbxu', 'coordinator'),
(28, NULL, 'Tuquilar', 'Eduardo', 'B.', '', 'Male', 'Santa Rosa', '2024-03-10', 'Married', 'edu@gmail.com', '9914761347', 7, 'hmcoor@aims.edu.ph', '$2y$10$HCEbI7SEaVAXsLTgds74CuHph9R1snSGl3ZoyBNNFGa.gcD7SUYaW', 'coordinator'),
(29, NULL, 'Tuazon', 'Rozaida', 'C.', '', 'Female', 'Santa Rosa', '2024-03-10', 'Married', 'aida@gmail.com', '9931564764', 8, 'itcoor@aims.edu.ph', '$2y$10$dXAfGh5YU/91qLlAmpFV1.3HD64qQD8yEasv3BNa8GDGt0OIeZJTG', 'coordinator'),
(30, NULL, 'Indino', 'Creselito', 'G.', '', 'Male', 'Santa Rosa', '2024-03-10', 'Married', 'cres@gmail.com', '9987413874', 9, 'tmcoor@aims.edu.ph', '$2y$10$2wEN3NVEXz3b3zmwTyfNIOhPdyXl0sMLLvyH2qyXZs6Rl6PR57dZC', 'coordinator'),
(71, 'profile_67026ea3eb54a9.17812280.png', 'Tuazon', 'Rozaida', 'C.', '', 'Female', 'Santa Rosa', '2024-05-10', 'Single', 'aida@gmail.com', '9984134877', NULL, 'admin@aims.edu.ph', '$2y$10$uiOHQagRVCjOMjKu1swvhusyQUG5CAF90LmQK4PCXdrLVzav8zqB2', 'admin'),
(73, NULL, 'Avendaño', 'Alexander', '', '', 'Male', 'Santa Rosa', '2024-05-10', 'Single', 'alex@gmail.com', '9984519864', NULL, 'subadmin@aims.edu.ph', '$2y$10$gmcPNp7CBsTrw/L4.PzjuekkrqUUu7VcQccA4qUmeddQAL6dlXcXW', 'sub-admin'),
(82, 'profile_67028d689750c2.35904147.png', 'Alias', 'Albert', 'Dela Peña', '', 'Male', 'Cabuyao', '2024-06-10', 'Single', 'al@gmail.com', '9987413841', 1, '1-210153@aims.edu.ph', '$2y$10$/2Vj/Pity2E4f4mMuyicnuvpe3fAMLtkMs4NKgQVWaylNt8uRYONy', 'intern'),
(83, NULL, 'Custodio', 'Bryan', 'Guevarra', '', 'Male', 'Santa Rosa', '2024-06-10', 'Single', 'bry@gmail.com', '9987413684', 2, '1-210154@aims.edu.ph', '$2y$10$zQC.GkxCOJ8E0PNJgHndFeo/d/Of7XnDoIFoHaqkyOHT5IBJCbcWm', 'intern'),
(84, NULL, 'Arroyo', 'Justin', 'Mangahis', '', 'Male', 'Santa Rosa', '2024-06-10', 'Single', 'dyastin@gmail.com', '9989847463', 3, '1-210155@aims.edu.ph', '$2y$10$u/3wvnSIwpaQphF/ICifSe/SRnZvDN2GP9WFxNy4cvXmuBLYWK062', 'intern'),
(85, NULL, 'Balauga', 'George', '', '', 'Male', 'Cabutao', '2024-06-10', 'Single', 'geroge@gmail.com', '9974687468', 5, '1-210156@aims.edu.ph', '$2y$10$uXIWsvfzJ2oGLTahqFNhi.3fWIV/vyIjHC.5qbA4umi3TEnpKhKMy', 'intern'),
(86, NULL, 'Bazar', 'Danielle', 'Olive', '', 'Female', 'Santa Rosa', '2024-06-10', 'Single', 'dani@gmail.com', '9974141364', 4, '1-210157@aims.edu.ph', '$2y$10$5qPvl4kaXgrgtg0P5GdOXujzys4n3gKF1pCI/sdg05IwUjEiIMkG.', 'intern'),
(87, NULL, 'Talibsao', 'Jay Tee', 'Barrinuevo', '', 'Male', 'Santa Rosa', '2024-06-10', 'Single', 'jt@gmail.com', '9988431181', 6, '1-210158@aims.edu.ph', '$2y$10$uvyxDS9nbu93/S8GielmzejsMKf1EWvoPN9T2m/P0zEQBf9Orn2ba', 'intern'),
(88, NULL, 'De Chavez', 'Lian James', 'Britanico', '', 'Male', 'Santa Rosa', '2024-06-10', 'Single', 'liyan@gmail.com', '9984138741', 7, '1-210159@aims.edu.ph', '$2y$10$Wx9MXt4YfACy3L4tCH7tjemPwq6Xv1pB6teOtm86r6FQ6DnV.UHGm', 'intern'),
(89, NULL, 'Casulla', 'Jelo', '', '', 'Male', 'Santa Rosa', '2024-06-10', 'Single', 'jelo@gmail.com', '9984138841', 8, '1-210160@aims.edu.ph', '$2y$10$s2MMDoFrQYeCvM4xyuDTOe2QUDiFylFTS1/4IqmiN6uF3FIxP5o3y', 'intern'),
(90, NULL, 'Barria', 'Carl', '', '', 'Male', 'Santa Rosa', '2024-06-10', 'Single', 'carl@gmail.com', '9984186451', 9, '1-210161@aims.edu.ph', '$2y$10$6C8m/74Jn5vhyCiOaOKrPugVwFjxpPK9UOfEq/xbQkC4l1m3gBqUq', 'intern');

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
  ADD UNIQUE KEY `account_email` (`account_email`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
