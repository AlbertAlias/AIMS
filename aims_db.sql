-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 11:34 AM
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
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `user_id`, `department_id`) VALUES
(30, 93, 1),
(31, 94, 2),
(32, 95, 3),
(33, 96, 5),
(34, 97, 4),
(35, 98, 6),
(36, 99, 7),
(37, 100, 8),
(38, 101, 9);

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
  `studentID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `user_id`, `studentID`) VALUES
(193, 281, '1-434245'),
(194, 282, '1-210154'),
(195, 283, '1-210155'),
(196, 284, '1-210156'),
(197, 285, '1-210157'),
(198, 286, '1-210158'),
(199, 287, '1-210159'),
(200, 288, '1-210160'),
(201, 289, '1-210161');

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
  `account_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','sub-admin','coordinator','intern') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_picture`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `birthdate`, `civil_status`, `personal_email`, `contact_number`, `employee_number`, `department_id`, `account_email`, `password`, `user_type`) VALUES
(71, 'profile_6731dce0ebd3e4.17567049.jpg', 'Custodio', 'Bryan', 'Guevarra', '', NULL, 'Santa Rosa', NULL, 'Single', 'bry@gmail.com', NULL, '1', NULL, 'admin@aims.edu.ph', '$2y$10$uiOHQagRVCjOMjKu1swvhusyQUG5CAF90LmQK4PCXdrLVzav8zqB2', 'admin'),
(73, 'profile_672b0ebf027c79.63551893.jpeg', 'Balauag', 'George', '', '', NULL, 'Cabuyao', NULL, 'Single', 'geo@gmail.com', NULL, '2', NULL, 'subadmin@aims.edu.ph', '$2y$10$gmcPNp7CBsTrw/L4.PzjuekkrqUUu7VcQccA4qUmeddQAL6dlXcXW', 'sub-admin'),
(93, NULL, 'Veron', 'Jeffrey', '', '', NULL, 'Santa Rosa', NULL, 'Married', 'jeff@gmail.com', NULL, '3', 1, 'acoor@aims.edu.ph', '$2y$10$y3JvAbhtgWE7wWyHZVn6N.5dbjI47hljubltghWxA0HIPAowj0otm', 'coordinator'),
(94, NULL, 'Atienza', 'Leo', '', '', NULL, 'Santa Rosa', NULL, 'Married', 'leo@gmail.com', NULL, '4', 2, 'bacoor@aims.edu.ph', '$2y$10$iTHbeGl9mFjQNMBIN72ns.dJn35lUbSfuLwG5yBWswxXmyeGmL2DW', 'coordinator'),
(95, NULL, 'Payos', 'John Paul', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'jp@gmail.com', NULL, '5', 3, 'cpecoor@aims.edu.ph', '$2y$10$hRW.gNhmFYq8xvOccA2KiOPSMt.Kof0BSpaQ6bPjLuTy9Ma9KfFGS', 'coordinator'),
(96, NULL, 'Oliva', 'Catherine', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'cath@gmail.com', NULL, '6', 5, 'cscoor@aims.edu.ph', '$2y$10$dsOMCwhikOZ/ZLnZpKdHzeqfmZV6gL3TJPPtpiFhJHcr1SWGEVUJ6', 'coordinator'),
(97, NULL, 'Jasmin', 'Jose Mari', '', '', NULL, 'Santa Rosa', NULL, 'Married', 'jm@gmail.com', NULL, '7', 4, 'crimcoor@aims.edu.ph', '$2y$10$G.2zxG.xCWk7X5YdxaJ5SelXaAcgm3dx96tEwcBPqbFGw0VNhw8jK', 'coordinator'),
(98, NULL, 'Cera', 'Pauline', 'Diola', '', NULL, 'Santa Rosa', NULL, 'Married', 'pau@gmail.com', NULL, '8', 6, 'educcoor@aims.edu.ph', '$2y$10$9B.SsXavy1OEtATweUQNDOgi6PaFXptBbfLwT4PG3EmjZzMYPRJpy', 'coordinator'),
(99, NULL, 'Ramos', 'Grace', '', '', NULL, 'Santa Rosa', NULL, 'Married', 'grace@gmail.com', NULL, '9', 7, 'hmcoor@aims.edu.ph', '$2y$10$MjZVKqpw/FFACoXrfxoWl.kLyxvZ74pPHMX2XxAjy40b35AIpd/Na', 'coordinator'),
(100, NULL, 'Oliva', 'Catherine', '', '', NULL, 'Santa Rosa', NULL, 'Single', 'cath@gmail.com', NULL, '10', 8, 'itcoor@aims.edu.ph', '$2y$10$W/U9e0qFssc7djsb0Zo4fuOJwmyDzhVETkvGxaPeBfDMrSiEIzHtG', 'coordinator'),
(101, NULL, 'De Guzman', 'Marie Charlene', '', '', NULL, 'Santa Rosa', NULL, 'Married', 'char@gmail.com', NULL, '11', 9, 'tmcoor@aims.edu.ph', '$2y$10$JIbuyrTMKn1yNdO5M.JQiOULD04NIXhqiWbtqUnfk2n1KdsH195gu', 'coordinator'),
(281, NULL, 'Alias', 'Albert', 'Dela Pena', '', 'Male', 'Cabuyao', '1999-10-10', 'Single', 'al@gmail.com', '97326549821', NULL, 1, '1-434245@aims.edu.ph', '$2y$10$WAH5L9BJ/AcuTh4XF4hyHuHNT2hp1EMBvdUg.8UmMMboTC52MbiFe', 'intern'),
(282, NULL, 'Arroyo', 'Justin', 'Mangahis', '', 'Male', 'Santa Rosa', '2003-08-21', 'Single', 'dyastin@gmail.com', '97335849832', NULL, 2, '1-210154@aims.edu.ph', '$2y$10$jPXGjWEZdutnNbDVJQ9ICer7VmPECkYhRWFytDFL9lPqOFP5c0nnG', 'intern'),
(283, NULL, 'Balauag', 'George', '', '', 'Male', 'Santa Rosa', '2003-01-17', 'Single', 'geo@gmail.com', '97368413876', NULL, 3, '1-210155@aims.edu.ph', '$2y$10$QB8B1XMsbKRKmCdy/aZlOezjqrThY.BsZB7lJFW9/ZSfkAUhx3Ij2', 'intern'),
(284, NULL, 'Bascon', 'Zach', '', '', 'Male', 'Santa Rosa', '2024-10-14', 'Single', 'zach@gmail.com', '97379419934', NULL, 4, '1-210156@aims.edu.ph', '$2y$10$9qyzltjjWaECLv1tMj8mFeBo4Qlt9QskkMi2kqGvnW2XNPtQJBaG.', 'intern'),
(285, NULL, 'Coronel', 'Mark Aldwin', '', '', 'Male', 'Santa Rosa', '2024-10-14', 'Single', 'ryker@gmai.com', '97326546134', NULL, 5, '1-210157@aims.edu.ph', '$2y$10$pKUWBhcuXQRt.geaJS0XW.QIhUVrDJB2hSPpYdzvuygdwOxgYjd26', 'intern'),
(286, NULL, 'Custodio', 'Bryan', '', '', 'Male', 'Santa Rosa', '2024-10-14', 'Single', 'bry@gmail.com', '97326549347', NULL, 6, '1-210158@aims.edu.ph', '$2y$10$LY4SSnCnpKOFfQw9I1qOJejD7Qxnup/Wm54vRuZAYOZ5EOw90sNpq', 'intern'),
(287, NULL, 'Diaz', 'Francis', '', '', 'Male', 'Santa Rosa', '2024-10-14', 'Single', 'cis@gmail.com', '97326549691', NULL, 7, '1-210159@aims.edu.ph', '$2y$10$UuCLc3xOBOBT7ZxcrbYuhOxdX.TDl/esXLmqs1qSBjkaqcGFzYbqy', 'intern'),
(288, NULL, 'Lawas', 'James Nathaniel', '', '', 'Male', 'Santa Rosa', '2024-10-14', 'Single', 'james@gmail.com', '97326549167', NULL, 8, '1-210160@aims.edu.ph', '$2y$10$mEuOpqsKQ.EYN0HrsXaWXuQ4wRB6pQBP3MsvzLD2qyUYGkjfzp7aS', 'intern'),
(289, NULL, 'Paronable', 'Wilford', '', '', 'Male', 'Santa Rosa', '2024-10-14', 'Single', 'ford@gmail.com', '97326549639', NULL, 9, '1-210161@aims.edu.ph', '$2y$10$j/HnlhF4.WWooih7Z7.3UeHJiaZv5P/kyOElTi.lxFvISR0RY3vza', 'intern');

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
  ADD UNIQUE KEY `account_email` (`account_email`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

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
