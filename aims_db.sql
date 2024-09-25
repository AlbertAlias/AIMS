-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 01:05 AM
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
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `civil_status` enum('Single','Married','Divorced','Widowed') DEFAULT NULL,
  `personal_email` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `account_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Sub-Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `birthdate`, `civil_status`, `personal_email`, `contact_number`, `account_email`, `password`, `role`) VALUES
(10, 'admin', 'admin', '', '', 'Male', 'admin', '2024-09-25', 'Single', 'admin@gmail.com', '9941356464', 'admin@aims.edu.ph', '$2y$10$/PczbwuMMYe7zvW.xv06..x1kAuRBsDYG61P5ZK65LLy29G7SliNK', 'Admin'),
(25, 'Avendaño', 'Alexander', '', '', 'Male', 'Santa Rosa', '2024-09-26', 'Single', 'alex@gmail.com', '9937435424', 'subadmin1@aims.edu.ph', '$2y$10$4ELmyvXKl8GiNO4sa2eEp.s.CCioYJljAnL1XiaOUWA8N/Zlh/WhC', 'Sub-Admin'),
(34, 'Custodio', 'Bryan', 'Guevarra', '', 'Male', 'Santa Rosa', '2024-09-26', 'Single', 'bry@gmail.com', '9979614641', 'subadmin2@aims.edu.ph', '$2y$10$kGrBB10zF0zNVWbAWZuT6uFhxLV2nZzFreH3Z3R7nYAkVE58Ces92', 'Sub-Admin');

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `personal_email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `department` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `birthdate`, `civil_status`, `personal_email`, `contact_number`, `department`, `account_email`, `password`, `created_at`) VALUES
(24, 'De Chavez', 'Lian James', 'Dingba', '', 'Male', 'Baclaran', '2003-09-17', 'Single', 'liyan@gmail.com', '9389515151', 'Accountancy', 'liyan@aims.edu.ph', '$2y$10$i9oETceDzUVnMrnzuS7kIOY1joS24ZYEZy5wLlBg3uHp9VuvExbCG', '2024-09-17 15:10:32'),
(25, 'Arroyo', 'Justin', 'Mangahis', '', 'Male', 'Batangas', '2003-09-17', 'Single', 'dyastin@gmail.com', '9389515151', 'Business Administration', 'dyastin@aims.edu.ph', '$2y$10$WN.UWQUWOam29i.zdzjUL.DHfpvk.4JIUJvXnE7cPexF/5v0349W2', '2024-09-17 15:21:45'),
(29, 'Balauag', 'George', 'Edickson', '', 'Male', 'Banay Banay', '2003-01-17', 'Single', 'george@gmail.com', '9515151515', 'Computer Engineering', 'george@aims.edu.ph', '$2y$10$6aLU.6Be4ot2fAwFizUzo.zsDtPOWoRWa2WV1cAlh//RgmwF7Cxt.', '2024-09-17 23:52:55'),
(32, 'Talibsao', 'Jay Tee', 'Barrinuevo', '', 'Male', 'Aplaya', '2003-09-18', 'Single', 'jt@gmail.com', '9389414141', 'Criminology', 'jt@aims.edu.ph', '$2y$10$TfZ/2rTAvDB5Vf9ECgdrZeBQK1CmE4LwWQr8x59VooLbzINesShZC', '2024-09-18 00:26:26'),
(33, 'Alias', 'Albert', 'Dela Pena', '', 'Male', 'cabuyao', '1999-10-10', 'Single', 'al@gmail.com', '9389436773', 'Computer Science', 'al@aims.edu.ph', '$2y$10$.XjdLl5EOv2D1tUcyC/hPud9ImZv8FSi2FHVT3FnTel0guX9VrYFG', '2024-09-18 00:32:28'),
(35, 'Casulla', 'Jelo', 'Puyaters', '', 'Male', 'Baclaran', '2003-09-18', 'Single', 'jelo@gmail.com', '9389414141', 'Education', 'jelo@aims.edu.ph', '$2y$10$jYI7bkn9Z2wNxNnFaZ4RGOYRB3AB1jjcyVoYZrkjUOwjz5s0HUQZa', '2024-09-18 12:58:04'),
(36, 'Custodio', 'Bryan', 'Guevarra', '', 'Male', 'Pulong', '2003-09-04', 'Single', 'bry@gmail.com', '9389717171', 'Hospitality Management', 'bry@aims.edu.ph', '$2y$10$mGaEe.tnhPhqW8dOyN44nu48Gt1itn/S89M2/Qdl/SfnZLVGiy.h.', '2024-09-18 13:00:43'),
(42, 'Bombahay', 'Kurt Justin', 'D.', '', 'Male', 'Pooc', '1010-10-10', 'Single', 'kurt@gmail.com', '9931465416', 'Information Technology', 'kurt@aims.edu.ph', '$2y$10$wNo15pwBVfhy13Sd94ehK.CdKSsxhhi5y90IWf9DftdS1Tgvth8le', '2024-09-24 03:45:48'),
(59, 'Barria', 'Carl', '', '', 'Male', 'Santa Rosa', '2024-09-25', 'Single', 'carl@gmail.com', '9916441663', '', 'carl@aims.edu.ph', '$2y$10$pgWIWUf1UtRYpva.14sgs.sFkRdWgMPqaH.mFlSgt4dlf.1yrNlz.', '2024-09-25 00:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_head` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_head`, `created_at`) VALUES
(60, 'Accountancy', 'Darle Joy B. Escuton', '2024-09-25 00:01:36'),
(61, 'Business Administration', 'Eduardo B. Tuquilar', '2024-09-25 00:01:58'),
(62, 'Computer Engineering', 'John Paul Payos', '2024-09-25 00:02:15'),
(63, 'Criminology', 'Chief D. Guard', '2024-09-25 00:02:34'),
(64, 'Computer Science', 'Rhowel M.  Dellosa', '2024-09-25 00:02:46'),
(65, 'Education', 'Marmelo V. Abante', '2024-09-25 00:03:02'),
(66, 'Hospitality Management', 'Marigrace R. Ramos', '2024-09-25 00:03:18'),
(67, 'Information Technology', 'Rozaida Tuazon', '2024-09-25 00:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `civil_status` enum('Single','Married','Divorced') NOT NULL,
  `personal_email` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `studentID` varchar(250) NOT NULL,
  `department` varchar(255) NOT NULL,
  `coordinator_name` varchar(255) NOT NULL,
  `hours_needed` int(11) NOT NULL,
  `coordinator_email` varchar(255) NOT NULL,
  `internship_status` varchar(50) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `address`, `birthdate`, `civil_status`, `personal_email`, `contact_number`, `studentID`, `department`, `coordinator_name`, `hours_needed`, `coordinator_email`, `internship_status`, `account_email`, `password`) VALUES
(29, 'Custodio', 'Bryan', 'Guevarra', '', 'Male', 'Santa Rosa', '2024-09-25', 'Single', 'bry@gmail.com', '9930159461', '1-210153', 'Accountancy', 'De Chavez, Lian James', 200, 'liyan@gmail.com', 'Ongoing', '1-210153@aims.edu.ph', '$2y$10$HOdFk.khdeNTA5zEnhv/tOz9cx9gC.WitiPz1e2jyNz85G4u7xytO'),
(30, 'Balauag', 'George', '', '', 'Male', 'Cabuyao', '2024-09-25', 'Single', 'ge@gmail.com', '9913661464', '1-210154', 'Business Administration', 'De Chavez, Lian James', 200, 'liyan@gmail.com', 'Ongoing', '1-210154@aims.edu.ph', '$2y$10$Xg4Et6vSgCRNRd11odhgk.8ehN7CsEpCibuKENlRUbtxP5u.Ku7vW'),
(31, 'Talibsao', 'Jay Tee', 'Barrinuevo', '', 'Male', 'Aplaya', '2024-09-25', 'Single', 'jt@gmail.com', '9913569846', '1-210155', 'Computer Engineering', 'Arroyo, Justin', 200, 'dyastin@gmail.com', 'Ongoing', '1-210155@aims.edu.ph', '$2y$10$xIY1WXM/NnkU5TAU6wL4EufY0tnmkk4.4vnSaOAGeDX84f0K4EcOy'),
(32, 'De Chavez', 'Lian James', 'Britanico', '', 'Male', 'Aplaya', '2024-09-25', 'Single', 'liyan@gmail.com', '9916341614', '1-210156', 'Criminology', 'Talibsao, Jay Tee', 200, 'jt@gmail.com', 'Ongoing', '1-210156@aims.edu.ph', '$2y$10$1vRSHWmlfz53rWR.Y094wOfMs9LcfugTDrm/opVoCPyuhVZHWc9cK'),
(33, 'Alias', 'Albert', 'Dela Peña', '', 'Male', 'Cabuyao', '2024-09-24', 'Single', 'al@gmail.com', '9913684651', '1-210157', 'Computer Science', 'Alias, Albert', 200, 'al@gmail.com', 'Ongoing', '1-210157@aims.edu.ph', '$2y$10$aIUpQLtTlg2vvODRJegJEuppJEGQUhj6M6E8s4u2MVmZY/VxtDiVC'),
(34, 'Arroyo', 'Justin', 'Mangahis', '', 'Male', 'Santa Rosa', '2024-09-25', 'Single', 'dyastin@gmail.com', '9913651316', '1-210158', 'Education', 'Casulla, Jelo', 200, 'jelo@gmail.com', 'Ongoing', '1-210158@aims.edu.ph', '$2y$10$qkIcM6YedLlPE6LNRr3dTOLBe274Gu9FrRwmi17XABvHZZBCz7GOO'),
(35, 'Bombahay', 'Kurt Justin', '', '', 'Male', 'Santa Rosa', '2024-09-25', 'Single', 'kert@gmail.com', '9951631654', '1-210159', 'Hospitality Management', 'Custodio, Bryan', 200, 'bry@gmail.com', 'Ongoing', '1-210159@aims.edu.ph', '$2y$10$TLOSUHWz9uTAIyODkI2.T.sjwmqsinD/RxNdmniX1Hw5jGSGLD3ru'),
(36, 'Casulla', 'Jelo', '', '', 'Male', 'Santa Rosa', '2024-09-25', 'Single', 'cash@gmail.com', '9951638694', '1-210160', 'Information Technology', 'Bombahay, Kurt Justin', 200, 'kurt@gmail.com', 'Cancelled', '1-210160@aims.edu.ph', '$2y$10$psB.Lehr9B.fUbtG3ARDAOOzVPFmzUR5r0ngyVZpubVui2.y8s1Om'),
(37, 'Barria', 'Carl', '', '', 'Male', 'Santa Rosa', '2024-09-25', 'Single', 'carl@gmail.com', '9961368941', '1-210161', 'Tourism Management', 'Barria, Carl', 201, 'carl@gmail.com', 'Cancelled', '1-210161@aims.edu.ph', '$2y$10$o3vu.lbZOhQ07u39wDl8nOxX7gy1O7SEjY475vZipnaerbNfvZAUO');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_acc`
--

INSERT INTO `users_acc` (`id`, `profile_picture`, `firstname`, `lastname`, `department`, `studentID`, `company`, `email`, `password`, `user_type`, `created_at`, `department_id`) VALUES
(34, '', NULL, NULL, NULL, NULL, NULL, 'admin@aims.edu.ph', '$2y$10$Li/ITgDL4iAOP.CunWJP4uK7KzVcrTYxnlsqjsKMAXkaRwr7caEi.', 'Admin', '2024-09-01 06:48:24', NULL),
(44, NULL, 'John Paul', 'Payos', 'Computer Engineering', NULL, '', 'jpp@aims.edu.ph', '$2y$10$ezJ7sFstoWWuzCHzducdl.JzSEG9bI1wloIdWaPQLt9G9wUP0bKzW', 'OJT Coordinator', '2024-09-03 05:55:10', NULL),
(46, NULL, 'Alfeo', 'Tenorio', NULL, '', 'Iqor Santa Rosa', 'feo@aims.edu.ph', '$2y$10$wXLoxvu4jwkPcvcE8miIoeulX/Jj9UxSATVmtQ8EfkhfwnqCAy8b.', 'OJT Supervisor', '2024-09-03 05:58:59', NULL),
(52, NULL, 'Charlene', 'De Guzman', NULL, NULL, NULL, 'char@aims.edu.ph', '$2y$10$uC4Pe2QQ8T35twYXYQT1d.zvdJovBh6wfn.lOzR28t1poOHt5ppMm', 'Registrar', '2024-09-03 10:07:04', NULL),
(53, NULL, 'Albert', 'Alias', 'Information Technology', '1-210153', '', '1-210153@aims.edu.ph', '$2y$10$PB09aXDdGgBn.ygY2/c3COXpr4JezQYCrmVJynRKfRsk38y8L4nLu', 'OJT Student', '2024-09-10 21:41:51', NULL),
(54, NULL, 'Jay Tee', 'Talibsao', 'Computer Engineering', '1-210154', NULL, '1-210154@aims.edu.ph', '$2y$10$LgeiusSnLwRW/l/JYUb/Ce4d71mYVmDoEbq6XGUomZTBnd8kAlYAa', 'OJT Student', '2024-09-10 21:43:11', NULL),
(55, NULL, 'Ronan', 'Redondo', 'Tourism Management', '1-210156', NULL, '1-210156@aims.edu.ph', '$2y$10$7Jy6MimwZJDwkiVDUVJc8O4/wECeaFrJXbEUQWKqcQffTDMVH2u7i', 'OJT Student', '2024-09-10 21:44:02', NULL),
(56, NULL, 'Lian', 'De Chavez', 'Business Administration', '1-210157', NULL, '1-210157@aims.edu.ph', '$2y$10$EJjpC1lBCR2M2ImiME5BT.ztORnUNl2NUHeMKp7DGxNeHhbUx1gB6', 'OJT Student', '2024-09-10 21:45:19', NULL),
(57, NULL, 'George', 'Balauag', 'Education', '1-210160', '', '1-210160@aims.edu.ph', '$2y$10$EZf4XWur5gs5Ufyhaftb3OcrTdrcJ2SfF1gnr8Qi3.J3IDQ6ycNfa', 'OJT Student', '2024-09-10 21:47:22', NULL),
(58, NULL, 'Francis', 'Diaz', 'Criminology', '1-210161', NULL, '1-210161@aims.edu.ph', '$2y$10$zAuHclw6o5116WPMYni00.L4L9cpna5CixucVR1PTGMEduVjLzyua', 'OJT Student', '2024-09-10 21:48:02', NULL),
(59, NULL, 'Sharlene', 'Flaviano', 'Hospitality Management', '1-210158', NULL, '1-210158@aims.edu.ph', '$2y$10$vhPQdCY3vzjhcerMILn5NuQ8.C2Ur6ttJJPLU0kd20JHDkqdZ8T/O', 'OJT Student', '2024-09-10 21:49:07', NULL),
(60, NULL, 'Zach', 'Bascon', 'Computer Science', '1-210155', NULL, '1-210155@aims.edu.ph', '$2y$10$oP9zTZLTOtCLIcN3Rl.5We2lxzu3KDghkPRC9yemmiIVi0zS5R4mO', 'OJT Student', '2024-09-10 21:51:06', NULL),
(61, NULL, 'Jelo', 'Casulla', 'Accountancy', '1-210159', NULL, '1-210159@aims.edu.ph', '$2y$10$6s/GDoEetGinMhHKZeRSG.Unqfar7LgxOcz4Nqy4GRjsDrjXD6UFO', 'OJT Student', '2024-09-10 21:52:16', NULL),
(84, NULL, 'Carl', 'Barria', 'Information Technology', '1-210162', '', '1-210162@aims.edu.ph', '$2y$10$PZ9tYkHOCK7CB85ouraKv.5H7Lq2AJn7V2b8vMmAulMCM2P36eUiW', 'OJT Student', '2024-09-13 03:26:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_reports`
--

CREATE TABLE `weekly_reports` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `week` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `submission_date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_email` (`personal_email`),
  ADD UNIQUE KEY `account_email` (`account_email`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_acc`
--
ALTER TABLE `users_acc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_department` (`department_id`);

--
-- Indexes for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users_acc`
--
ALTER TABLE `users_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_acc`
--
ALTER TABLE `users_acc`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
