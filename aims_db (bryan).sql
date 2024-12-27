-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 06:54 AM
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
(3, 484),
(4, 485),
(5, 486),
(6, 487),
(7, 488),
(8, 489),
(9, 490),
(10, 491),
(11, 492);

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
(478, 27),
(478, 28),
(478, 29),
(479, 30),
(479, 31),
(480, 33),
(481, 32),
(482, 34),
(483, 39);

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
(33, 'BSA'),
(32, 'BSBA'),
(29, 'BSCPE'),
(34, 'BSCRIM'),
(28, 'BSCS'),
(39, 'BSED'),
(31, 'BSHM'),
(27, 'BSIT'),
(30, 'BSTM'),
(47, 'TRY AGAIN'),
(48, 'TRY ISA PA');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `ratings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `total_grade` decimal(5,2) NOT NULL,
  `comments` text DEFAULT NULL,
  `evaluation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `student_id`, `ratings`, `total_grade`, `comments`, `evaluation_date`) VALUES
(1, '1197', '{\"ratings[quality1]\":\"5\",\"ratings[quality2]\":\"5\",\"ratings[quality3]\":\"5\",\"ratings[quality4]\":\"5\",\"ratings[quality5]\":\"5\",\"ratings[quality6]\":\"5\",\"ratings[quality7]\":\"5\",\"ratings[quality8]\":\"5\",\"ratings[quality9]\":\"5\",\"ratings[quality10]\":\"5\",\"ratings[quality11]\":\"5\",\"ratings[quality12]\":\"5\",\"ratings[quality13]\":\"5\",\"ratings[quality14]\":\"5\",\"ratings[quality15]\":\"5\",\"ratings[quality16]\":\"5\",\"ratings[quality17]\":\"5\",\"ratings[quality18]\":\"5\"}', 70.00, 'tanga ka bert', '2024-12-17 13:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `requirement_id` int(11) NOT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline` date NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`requirement_id`, `coordinator_id`, `title`, `description`, `created_at`, `deadline`, `status`) VALUES
(67, 484, 'Application Letter', 'Pokemon Horizon Episode 30', '2024-12-17 13:05:11', '2024-12-18', 'open'),
(68, 484, 'Resume Letter', 'Pokemon Horizon Rayquaza', '2024-12-17 13:05:38', '2001-12-15', 'open'),
(77, 484, 'Memorandum of Agreement', 'pikachu', '2024-12-18 03:29:59', '2024-12-22', 'open'),
(79, 484, 'BSIT COOR ONLY', 'sad', '2024-12-27 05:47:44', '2024-12-27', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `student_hours`
--

CREATE TABLE `student_hours` (
  `coordinator_id` int(11) NOT NULL,
  `hours_needed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_hours`
--

INSERT INTO `student_hours` (`coordinator_id`, `hours_needed`) VALUES
(484, 480);

-- --------------------------------------------------------

--
-- Table structure for table `student_supervisor`
--

CREATE TABLE `student_supervisor` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `assigned_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_supervisor`
--

INSERT INTO `student_supervisor` (`id`, `student_id`, `supervisor_id`, `company`, `assigned_date`) VALUES
(24, 1197, 1195, 'Fujitsu Die Tech Philippines Corporation', '2024-12-17 21:11:07'),
(25, 1206, 1195, 'Fujitsu Die Tech Philippines Corporation', '2024-12-17 21:11:34'),
(26, 1207, 1195, 'Fujitsu Die Tech Philippines Corporation', '2024-12-17 21:11:42');

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
  `requirement_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_requirements`
--

INSERT INTO `submit_requirements` (`submit_id`, `student_id`, `document_name`, `status`, `submission_date`, `requirement_id`, `file_path`, `remarks`) VALUES
(125, 1217, 'Application Letter.pdf', 'rejected', '2024-12-18 10:49:27', 67, 'uploads/Application Letter.pdf', 'adad'),
(126, 1217, 'Resume Letter.pdf', 'rejected', '2024-12-18 10:49:33', 68, 'uploads/Resume Letter.pdf', 'bawal'),
(127, 1217, 'Buenaobra Certified True Copy of Registration Form 1st Semester1st Term, AY 2023-2024.pdf', 'rejected', '2024-12-18 11:33:13', 68, 'uploads/Buenaobra Certified True Copy of Registration Form 1st Semester1st Term, AY 2023-2024.pdf', 'dsd'),
(128, 1217, 'Buenaobra Certified True Copy of Registration Form 1st Semester1st Term, AY 2023-2024.pdf', 'rejected', '2024-12-18 11:33:24', 77, 'uploads/Buenaobra Certified True Copy of Registration Form 1st Semester1st Term, AY 2023-2024.pdf', 'dsds');

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
  `academic_year` varchar(9) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `middle_name`, `username`, `password`, `user_type`, `emergency_number`, `address`, `email`, `gender`, `department_id`, `company`, `company_address`, `student_id`, `academic_year`, `profile_picture`) VALUES
(476, 'Sabao', 'Joemari', '', 'itdev', '$2y$10$1/X0mF3r533RLAeuYG3pRuzk.4DhfKdjuTTCVj7uG/j2wotgnGARC', 'IT', NULL, 'Santa Rosa, Laguna', 'itdev@gmail.com', 'Male', NULL, NULL, NULL, NULL, NULL, NULL),
(478, 'Tuazon', 'Rozaida', NULL, 'ceitedean', '$2y$10$CY0hn9c8EWTsS2JIUZGbNOeI/IhSv4Am1B.ys6O3Q4pDwTWwpcaVy', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(479, 'Tuquilar', 'Eduardo', NULL, 'tmhmdean', '$2y$10$GfSCi2tedFyYy65MQfB7MO/Hl2EvmybHhnMLzCxCEPPGJmvZjCOK2', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(480, 'Escuton', 'Darle Joy', NULL, 'bsadean', '$2y$10$9pF8VUsKAz/m01bP7Ee2rORqqFMeik3nYQ8dGjr.CiPVqZcldlexu', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(481, 'Tuquilar', 'Eduardo', NULL, 'badean', '$2y$10$nonB5wOHAS7xMRBwyG025e50yiSCXRN3kCljd/ZC2atfAg8xmtLBi', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(482, 'Jasmin', 'Jose Mari', NULL, 'crimdean', '$2y$10$eTU4xsmOS/NAFp.Z/OnFBu.qxEwxvtR9hKRGmKWzwPGp.191nfYNu', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(483, 'Lim', 'Ana Rose', NULL, 'bseddean', '$2y$10$lHpLNYcdoPUS9Mzh4IN0bOYFr7oP5GfG8CbeAI4lWdEN3BKBUn08O', 'Dean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(484, 'Oliva', 'Catherine', '', 'bsitcoor', '$2y$10$SOWbnjFFHMsDhPs5nxHdS.yU8C1xiMbU2gqiJg2TgMbbsLqIYzKYW', 'Coordinator', NULL, NULL, 'bsit@gmail.com', NULL, 27, NULL, NULL, NULL, NULL, NULL),
(485, 'Payos', 'John Paul', '', 'bscpecoor', '$2y$10$HwDsOjsUyyznQiHd27r4/uNs/WX9zkreuThW3Zw0iDZcCfwYvyfry', 'Coordinator', NULL, NULL, 'bscpe@gmail.com', NULL, 29, NULL, NULL, NULL, NULL, NULL),
(486, 'Oliva', 'Catherine', '', 'bscscoor', '$2y$10$dfQPIOvSiwn/w8ntreWNp.Px570TmFQCSdPoMB41yw1de1oi5mamS', 'Coordinator', NULL, NULL, 'bscs@gmail.com', NULL, 28, NULL, NULL, NULL, NULL, NULL),
(487, 'Veron', 'Jeffrey ', '', 'bsacoor', '$2y$10$dKd6thFs3IeybVD6BhTSBuXstfZqgwZaG2fGGc9xEC8BwGXGFDhpq', 'Coordinator', NULL, NULL, 'bsa@gmail.com', NULL, 33, NULL, NULL, NULL, NULL, NULL),
(488, 'Atienza', 'Leo', '', 'bsbacoor', '$2y$10$apNUwAvMYKBaFuJq0RpnxeYVf46aFw.OqPIr8Fy9kY/qHkfpoBA92', 'Coordinator', NULL, NULL, 'bsba@gmail.com', NULL, 32, NULL, NULL, NULL, NULL, NULL),
(489, 'Jasmin', 'Jose Mari', '', 'bscrimcoor', '$2y$10$K7k7nuKkNEILsAIhLWPPRuWs3bp.7IJgXofeuRnS/7Ata9WJ2uTFu', 'Coordinator', NULL, NULL, 'bscrim@gmail.com', NULL, 34, NULL, NULL, NULL, NULL, NULL),
(490, 'Cera', 'Pauline Diola', '', 'bsedcoor', '$2y$10$PwNTNgaaj/Mvn.Rbn1XXd.f7e4qjQO7wVj6COXTwzGOcyXAZUCfuG', 'Coordinator', NULL, NULL, 'bsed@gmail.com', NULL, 39, NULL, NULL, NULL, NULL, NULL),
(491, 'Ramos', 'Grace', '', 'bshmcoor', '$2y$10$U9ZOk2JfMeXmyzmRfEBCNOzMR2CHKZvyD3W/yamuvhS1Y679dSee2', 'Coordinator', NULL, NULL, 'bshm@gmail.com', NULL, 31, NULL, NULL, NULL, NULL, NULL),
(492, 'De Guzman', 'Marie Charlene', '', 'bstmdean', '$2y$10$CgDXqYIsIJ0uGysQPMPES.KXQC.DxNykHewcNnSFLGihr8o7hcOfa', 'Coordinator', NULL, NULL, 'bstm@gmail.com', NULL, 30, NULL, NULL, NULL, NULL, NULL),
(1195, 'Alias', 'Akisha Nianna', '', 'fujitsu', '$2y$10$3fBcVFSxN7Sa6W0fnnqdw.Z4nsrV.kL60HHoV0CIwEq7cuPuqu17G', 'Supervisor', NULL, NULL, 'fujitsu@gmail.com', 'Female', NULL, 'Fujitsu Die Tech Philippines Corporation', 'Laguna Technopark', NULL, NULL, NULL),
(1196, 'Regis', 'trar', NULL, 'registrar', '$2y$10$nurRk0nfJGNkSfpW5jzFzeV5SkRruPsnJBpX6KiLq3/9/KQ2UOpLy', 'Registrar', NULL, NULL, 'registrar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1197, 'Abadillo', 'Mark Daren', NULL, '112233', '$2y$10$QYxFFgBIcFU9hpb/UTdVeurhPd8ieB22hUKYGCDruIUePfIGNTqQ6', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190302', '2022-2023', NULL),
(1198, 'Abanes', 'Sian Ernest', NULL, '112234', '$2y$10$u42os2ci1QXw44t9IaxQxe/48.E/zdyCvLmXxhaaJfpCdXhy9c6ti', 'Student', NULL, NULL, NULL, 'Female', 28, NULL, NULL, '1190303', '2022-2024', NULL),
(1199, 'Abdur Rashid', 'Abdur Raffy', NULL, '112235', '$2y$10$cC2KUeUW.H7/dxhdJ5AOr.mZCJgtNecNVYfIV83zkOHvn083/4oV6', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190304', '2022-2025', NULL),
(1200, 'Abella', 'Mathew Benedict', NULL, '112236', '$2y$10$gJzwFyCoOxry9k0uCjZeduwBDACLej1n8/PHfe1eQXLiFV3oT7b2C', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190305', '2022-2026', NULL),
(1201, 'Abocado', 'Joan Faith', NULL, '112237', '$2y$10$NfuSrvgEPKO3SGef56UM4eOzFGJvkXZwEjPGiLHAAjOdsVbR/up72', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190306', '2022-2027', NULL),
(1202, 'Abril', 'Alexa Nicole', NULL, '112238', '$2y$10$zn3ENzdbtGldFfx4kiCKZOlFU337/tzzp47y.4YXRi90fKT7LZAMy', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190307', '2022-2028', NULL),
(1203, 'Absalon', 'Lorabelle', NULL, '112239', '$2y$10$7AbQGucBT55whhWgGQ9HFe2dkL3lxFI9ndYSxnrnBsLipmXSx.tue', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190308', '2022-2029', NULL),
(1204, 'Acosta', 'Cristine Joy', NULL, '112240', '$2y$10$xaQfFJuKDA0tBLlQDMQV6.GbpXS8ZhDcjY2GamKvVofyAvWmK5hva', 'Student', NULL, NULL, NULL, 'Female', 30, NULL, NULL, '1190309', '2022-2030', NULL),
(1205, 'Acosta', 'Justin V.', NULL, '112241', '$2y$10$a.mnRJxEquqdDexyomDC8OdHKrp2V0cVO8PWcz0Q2obdy8zsLr5k6', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190310', '2022-2031', NULL),
(1206, 'Agapito', 'Justin Rey Q.', NULL, '112242', '$2y$10$RvvO3qBeem6GU2DL9dqlqOEaVsxQxnhrcm0gy0Pi22wioIc0RpcPK', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190311', '2022-2032', NULL),
(1207, 'Agner', 'Edrian', NULL, '112243', '$2y$10$lxXVrV5IKWhrYvm2hjBy5OmvRn69QxSLrjBx6BxIRfm76kaDtRZHK', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190312', '2022-2033', NULL),
(1208, 'Aguado', 'Jannicka Azela B.', NULL, '112244', '$2y$10$Wek5IX6sMHWV3mwSW7EbeuWTru06i6SeU4I263QVzZ4wixobfRdS.', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190313', '2022-2034', NULL),
(1209, 'Aguilar', 'Alleyah Kryztel', NULL, '112245', '$2y$10$kvGSDfEGNzNBYA0Puv/5y.RzXtxLgqxQvzsxig2L2bq.RSnddWhZ6', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190314', '2022-2035', NULL),
(1210, 'Aguja', 'Joshua', NULL, '112246', '$2y$10$Or0qKta3Jl1Cn00RdlakDuDvmgR3oRheFwwt70dSgcvgAp.sgnX2y', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190315', '2022-2036', NULL),
(1211, 'Alaan', 'Jobel C.', NULL, '112247', '$2y$10$gZze05PLoOI5rpZP6wHX.uvwi4xn/Yfaz0PsfEM2SvGD6HZEwU1nK', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190316', '2022-2037', NULL),
(1212, 'Alagon', 'Carl Steven', NULL, '112248', '$2y$10$pJED3zw3/QwzNxmPZ6Z40usUsOCJUTGZ5VtMNeHnM4V795KMv.//m', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190317', '2022-2038', NULL),
(1213, 'Alagon', 'Kurt Allen', NULL, '112249', '$2y$10$/RxfVTNkJNjI0.px1jLUiuH5SuEphJ5IjDfIisMfVodV609EEJ2Wa', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190318', '2022-2039', NULL),
(1214, 'Albofera', 'Dave', NULL, '112250', '$2y$10$SBjoaOt6KLubuonYDmyNqO6m8414cNeYcnc01xBk/j8Mr9wcsm4N6', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190319', '2022-2040', NULL),
(1215, 'Alejandrino', 'Janna Mae', NULL, '112251', '$2y$10$/YbzUccC4tc32mNUSFRri.kJuUFbagPaDEf3AKvUQfWzYOOYuCyVe', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190320', '2022-2041', NULL),
(1216, 'Alfonso', 'Emira Febby Ann', NULL, '112252', '$2y$10$46fjLazS/dGXp3CHbyF09OELDvT7jxiAkF9BUp4IYHECn7oI/FiUS', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190321', '2022-2042', NULL),
(1217, 'Alias', 'Albert', NULL, '112253', '$2y$10$wt5aTSH/XfvgITf/cx1yUewEK7sf0U/SaCbAOtv0QbzJ9kZqFhD7a', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190322', '2022-2043', NULL),
(1218, 'Alimorom', 'Aira', NULL, '112254', '$2y$10$r5ozRggj6twvyKcV3y12uupKV6yaaoJg7m4EtVYQTCIYp0RBZARzi', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190323', '2022-2044', NULL),
(1219, 'Almodovar', 'Arianne Janus', NULL, '112255', '$2y$10$rx9t15yrza.114n86JQzpuFmHL7a0.ff8YsD5mMA5W8H3konTE1ZO', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190324', '2022-2045', NULL),
(1220, 'Almodovar', 'Jhumer C.', NULL, '112256', '$2y$10$fXpBTE68scc640wa/kIgvOqEmq2zN6J3zoGN5I0R6kp/icgRn0IX2', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190325', '2022-2046', NULL),
(1221, 'Alvarez', 'Matt Railey', NULL, '112257', '$2y$10$X8N4qAqJglIh4nyhkc0EO.wKgm5mXxXTLqupqcn882UsAJHaN9XTO', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190326', '2022-2047', NULL),
(1222, 'Amalin', 'Jeremy', NULL, '112258', '$2y$10$MNqdHMcdEg8hQVkYvqS43u6l3oSAkO.2dnE1WcLtEfYENGCP0RRLq', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190327', '2022-2048', NULL),
(1223, 'Amante', 'Brix', NULL, '112259', '$2y$10$IN6D1DelknmYZQAPTm7GUOe0SIjFD.Lil.hvmCZAdCgB94UPcU3ia', 'Student', NULL, NULL, NULL, 'Male', 27, NULL, NULL, '1190328', '2022-2049', NULL),
(1224, 'Amante', 'John Paulo', NULL, '112260', '$2y$10$g2If.qC9WuMSbhnogJ2EZ.8pNeXP6mw3r9hEj.9uxCmJjRT/y0JYm', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190329', '2022-2050', NULL),
(1225, 'Amante', 'kristan Rain', NULL, '112261', '$2y$10$dO6r6.nZFEkH7zXc7zr1Autr/.8H2nTnm7Iy/lLxyJYHp/lkIS12K', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190330', '2022-2051', NULL),
(1226, 'Amar, Jr.', 'Eleuterio', NULL, '112262', '$2y$10$TZEP9j4jziDqe9MYiOJZkOreEB3tEIhV51cggzvVCQSLUO1BouFUS', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190331', '2022-2052', NULL),
(1227, 'Amarante', 'Duncan', NULL, '112263', '$2y$10$7x37p7nLqjYqgDOUBP7BQu/kXFTrEecXS1/L2/UPiI74AfDKz5Caa', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190332', '2022-2053', NULL),
(1228, 'Ambos', 'John Carlo C.', NULL, '112264', '$2y$10$lYwN/Z5GfvDnARdx0M2JBOuIRp742CDWDIRoAF.YxxInxstTatF3.', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190333', '2022-2054', NULL),
(1229, 'Anape', 'Jerome', NULL, '112265', '$2y$10$a6b/prlYuPwZIRJwsIm9NOtZE6lKsDmX691mZWjXt.hbYRGlSob..', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190334', '2022-2055', NULL),
(1230, 'Angeles', 'Alaricquisha', NULL, '112266', '$2y$10$I0m91/g53a4aJZ3vJyusCO/vcfRN2yF/Cl7urTwl75xFhIKC7rDK6', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190335', '2022-2056', NULL),
(1231, 'Angeles', 'Justine Lawrence', NULL, '112267', '$2y$10$dYyPoQKqwWypBNpUNAAFUuYCfwWJfYp5QFGVmtJ0s/IScty9rihWK', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190336', '2022-2057', NULL),
(1232, 'Anievas', 'Khrys kharlou', NULL, '112268', '$2y$10$o4T3.YkhKrAe5l5Z3L5Np.Qa8hBnoqLfhKOwC1Gf0IoT9.EzGfV5S', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190337', '2022-2058', NULL),
(1233, 'Antique', 'Archie William', NULL, '112269', '$2y$10$OYebJsgF9wjxBbtpzpWq7.OP6FZyOFHlk0luho.N2Oj6D.FwZbLX2', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190338', '2022-2059', NULL),
(1234, 'Apit', 'Jr Julius', NULL, '112270', '$2y$10$tptA0DnWPko1aBS.qoAHUeFHprsoRohmbMp2pjsl227/UQHM9dREW', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190339', '2022-2060', NULL),
(1235, 'Aquino', 'Earl Lorenz', NULL, '112271', '$2y$10$XXZrLeHBGVYwPp4HQ.GaL.qvuelDfHq.MKmJ3nsWjzZK8BIV6qEqm', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190340', '2022-2061', NULL),
(1236, 'Aquino', 'Jimmy', NULL, '112272', '$2y$10$b5ql4EH/k3iWq80LIY6l5uzJXavcYG/KnrpEdvKEIXBzDuI8qILje', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190341', '2022-2062', NULL),
(1237, 'Arambulo', 'Dan Lester', NULL, '112273', '$2y$10$HvHhh6N60XjNccR3Y/iXN.tD/NppPDLA.aAmLg.iPuHOM5KojXZ3S', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190342', '2022-2063', NULL),
(1238, 'Aranel', 'John lord', NULL, '112274', '$2y$10$3fvvVKPgmIJElIVC6lvrMOzLJcA3Q7SgbZDhQFDpx7u7aQL53kDnS', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190343', '2022-2064', NULL),
(1239, 'Araullo', 'Kirsten Curtney', NULL, '112275', '$2y$10$3CHBY.AZh8cUDwePJrBud.wkWGjY3RLXOt0VHiks4v9pWo/T.sNH2', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190344', '2022-2065', NULL),
(1240, 'Arceo', 'Christian Clark', NULL, '112276', '$2y$10$kQOBzAzLY6WwoeFBCv95t.L.nxuoKtoRE0z7Io4WwP3.xsqQsaRdm', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190345', '2022-2066', NULL),
(1241, 'Arcoirez', 'Aljo', NULL, '112277', '$2y$10$JiN1sthEmqg9UzJa3rxL..RdfJdD/SfCN.Z9XsE.vnnQX0z1KWqC.', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190346', '2022-2067', NULL),
(1242, 'Arcoirez', 'Harold', NULL, '112278', '$2y$10$q5c1UqjNBWVpULZfSy8qReEvXgzHiZ7B58HMLYgyfIEyLl5BeZ/hy', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190347', '2022-2068', NULL),
(1243, 'Arguelles', 'Johnson', NULL, '112279', '$2y$10$S.WsxKJVHTI1mluK59cfXOY6agjU8Vcu8Ik3mhdH.UxDJQr8rPh9i', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190348', '2022-2069', NULL),
(1244, 'Ariate', 'John Roi R.', NULL, '112280', '$2y$10$Mah2.8nhwxpZldAx4f8Jsufg/irmqb4w0oc2p8MLy.AKHwzCsXndO', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190349', '2022-2070', NULL),
(1245, 'Armamento', 'Fhillihp Vinzhent', NULL, '112281', '$2y$10$CIsigc7qdFOPbdi0lndX7uCOlptrG4cbIuxNI0Y06.BB6t/55B.r2', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190350', '2022-2071', NULL),
(1246, 'Arroyo', 'Justin Randolf', NULL, '112282', '$2y$10$xblkRXCGcSrEaOrHgLMT6epOTpExxr1S/gBypG.H9qkfwsaoaBWNG', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190351', '2022-2072', NULL),
(1247, 'Asi', 'Henry Niel', NULL, '112283', '$2y$10$TAqsE.C5lSnEy6N5JUj.eOBOgh0klGOqgYDCSZE93njUiJlN2Tqg.', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190352', '2022-2073', NULL),
(1248, 'Asis', 'Krissha jene', NULL, '112284', '$2y$10$hXjRNMPmKjA2dxGSfMCMVeskvz00ZfrfvVdMwDhUhoG57Jg3mUzty', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190353', '2022-2074', NULL),
(1249, 'Aspera', 'John Patrick', NULL, '112285', '$2y$10$B27RMhghaLuQMe/Jr66V6eYwV1RmUyW5PqHevUyMA3M3pEyjIPg9C', 'Student', NULL, NULL, NULL, 'Male', 28, NULL, NULL, '1190354', '2022-2075', NULL),
(1250, 'Asuncion', 'Kurt Russell', NULL, '112286', '$2y$10$VHBXLxUX4oNi7dw6a0dmXun/ZvrQddJK5.p5WO7JN8mA9p8I8AXZS', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190355', '2022-2076', NULL),
(1251, 'Avecilla', 'Vincent King', NULL, '112287', '$2y$10$8aqEjBRdv4fUWOrrI1HMguzvebm2OpMbrzBggI362mJwSW3tE/z0u', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190356', '2022-2077', NULL),
(1252, 'Avila', 'Shienley', NULL, '112288', '$2y$10$WJvhezHPfkboTbUPmCpP4Op602/DGF8dlsUkZOn3qpwAJcy0K3SuK', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190357', '2022-2078', NULL),
(1253, 'Bacsarpa', 'Zhyien', NULL, '112289', '$2y$10$3R7ZykwaXtKl8117hf0dE.u11javhTMva1RTkX9vpzJ5N5giLCcPC', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190358', '2022-2079', NULL),
(1254, 'Badong', 'Karl Justine', NULL, '112290', '$2y$10$sXKOJd8Hdo9Ps3aX.A9GpO7IgSo.HrN5aFWJ6GJVgX0dPrGQEq16.', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190359', '2022-2080', NULL),
(1255, 'Balauag', 'George', NULL, '112291', '$2y$10$x5JtHzhZVQHSVIZZdhxp6OnM/KvYYkJ1Btqjrz/fQGozr6QzCGCmS', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190360', '2022-2081', NULL),
(1256, 'Balbag', 'Justine Harry', NULL, '112292', '$2y$10$dSIaLc199q6EAB0qJ97tuei0/Kusx3oUSOim6rWX724X8dBHhViIi', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190361', '2022-2082', NULL),
(1257, 'Baldado', 'John kenneth', NULL, '112293', '$2y$10$RhmISoDRpC2urcg499r.MuzJjAr2m6LwupY.YW2cIv5lTxJAHzHKK', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190362', '2022-2083', NULL),
(1258, 'Baldon', 'Princes Nicole', NULL, '112294', '$2y$10$xaN4M.Kb6lXh7KxAqehJPusJhJYgyt0HXXzn5P1r36fujj2el1kMO', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190363', '2022-2084', NULL),
(1259, 'Baldonado', 'Keith zyril', NULL, '112295', '$2y$10$8qNpL0uLp.n/wiFYGYBuTebva/NLOFwDpawQn18Lcts/2NC80DeWC', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190364', '2022-2085', NULL),
(1260, 'Balindan', 'John Christian', NULL, '112296', '$2y$10$V3vaTbwFUyRnsHYHr6kqk.znVHfTmFsD3A5LnEG.ESnbst6impTbm', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190365', '2022-2086', NULL),
(1261, 'Balolo', 'Carl Vincent', NULL, '112297', '$2y$10$8tK0MkFe5Np6va/y4n1ij.G7cTtESx/fIrQxaAFs02VmIv.ORevTe', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190366', '2022-2087', NULL),
(1262, 'Barretto', 'Loraine', NULL, '112298', '$2y$10$EcxUGW08Kr27wKEqSlIVV.5aUHGb5AJoDSaWSTrpuEBiSbK3YDeUq', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190367', '2022-2088', NULL),
(1263, 'Barria', 'Carl Justin', NULL, '112299', '$2y$10$uJjrb3BUgfXEKv4xLULrLuNNA9WBVbetaj44m5.R8eWjwzOXjqHbi', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190368', '2022-2089', NULL),
(1264, 'Barria', 'John Christian', NULL, '112300', '$2y$10$VFNep7DqaQtZxXYo2LNwEOCoCiF/vR0UzuzeYUPrgtS09n5zbwgnK', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190369', '2022-2090', NULL),
(1265, 'Barriga', 'Lloyd Patrik', NULL, '112301', '$2y$10$sDKCFOux7UZTnlvboNLXI.CO3RWXWOlYeezGy9OpLuf7Zb04Tk0OS', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190370', '2022-2091', NULL),
(1266, 'Barrun', 'Eunizel', NULL, '112302', '$2y$10$TVJEo9XJzX8Ng602T1M30eHkajPL5HERvIJ5dsFgWdEqOLYHexJa2', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190371', '2022-2092', NULL),
(1267, 'Bartolazo', 'Jason Emmanuel', NULL, '112303', '$2y$10$VZmTguvXDZRTz6BPjROf3uBfLg.uWLxzIYL/EANTFpqN/ED756ngy', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190372', '2022-2093', NULL),
(1268, 'Bartolazo', 'Darrell Evans', NULL, '112304', '$2y$10$t2IvTPTExDvbxdfMeeRu..FeJxwVSHQ29B0Hv/M8oL6Z/CB/xbtc6', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190373', '2022-2094', NULL),
(1269, 'Barundia', 'Allaine Marie', NULL, '112305', '$2y$10$5q1NsW8FlDr6B2T3CZyUueXzseFrhQFgunY.2I9feyvAWf.p7jDbG', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190374', '2022-2095', NULL),
(1270, 'Basbas', 'Prince Louise Emmanuel', NULL, '112306', '$2y$10$5GX146eRoEPaERQQdmBoLOeWzhBXw/OdTCFcVxkWCbCJGe/cDdfl2', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190375', '2022-2096', NULL),
(1271, 'Bascon', 'Zach Djan Derreck', NULL, '112307', '$2y$10$.xe12pf5v8P1oULAkvLezOXP82B/vT8Yvx/agxql7R2PU63I8gB5.', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190376', '2022-2097', NULL),
(1272, 'Basila', 'John Paul', NULL, '112308', '$2y$10$nefYOLeR5UrtZEOJTtI26OF9DO..fwM6MAiDbO2AgwxJETmeQzwo.', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190377', '2022-2098', NULL),
(1273, 'Batain', 'Justine Dhave', NULL, '112309', '$2y$10$zeESE6s0oSKNcY1fz5TIdOkq0QjPPcOC0m4ZzPMEXsiwJl9nBDrza', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190378', '2022-2099', NULL),
(1274, 'Batiao', 'Hanna May', NULL, '112310', '$2y$10$2z.mABj9tqy9rQpU0IDOwOfczH7a4sx2MAepYw4Onj.dHvs60urm6', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190379', '2022-2100', NULL),
(1275, 'Batitis', 'Baeron Mark', NULL, '112311', '$2y$10$ErnO/tIqWY16Y740FKosve4y/VWtQX14VxKAEt6WELT67RXjqQveW', 'Student', NULL, NULL, NULL, 'Male', 29, NULL, NULL, '1190380', '2022-2101', NULL),
(1276, 'Baynosa', 'Kaizer Andri', NULL, '112312', '$2y$10$xdbQxZg6UThUMVk.GGMA2emAoO5YsrF4ELXj8tUUHU20ajukc5x8a', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190381', '2022-2102', NULL),
(1277, 'Bayugo', 'Hans Jeheil', NULL, '112313', '$2y$10$mXhOBTnBUSl5a4sl6ohHUOtAZZImENd6cR7Vl6L5IVzZ.JbY1BD/e', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190382', '2022-2103', NULL),
(1278, 'Bazar', 'Danielle Olive', NULL, '112314', '$2y$10$qieJCDLFob89un0.BUVWd.vaGp2zxBw9QgYaGgeRa5YxysmfishTi', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190383', '2022-2104', NULL),
(1279, 'Beldenesa', 'Gerald', NULL, '112315', '$2y$10$Y6IDdQ/3dKflTBT7GIhayuJ0IAOh8E59Mvfgb/Z/l5z5bhBQEskqe', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190384', '2022-2105', NULL),
(1280, 'Belmonte', 'Arjay', NULL, '112316', '$2y$10$ZaZJuJg9Slu/1pNObJPai.ceWRuEC0i1b56TayeGAmWZ3Eg9Fbw2u', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190385', '2022-2106', NULL),
(1281, 'Belo', 'Yuri Kyla', NULL, '112317', '$2y$10$2LfdiUKAQrZFsNMb6oDrQ.MS30H7cMCqX7Pi.MeGwJI5dtNAs7HHO', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190386', '2022-2107', NULL),
(1282, 'Bergantin', 'Allen Rose', NULL, '112318', '$2y$10$mxlit.tPHek5jcfUzId7zeCqh7sdCn3Z8xAMmkwgdKLuM8LVf1oQW', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190387', '2022-2108', NULL),
(1283, 'Bollosa', 'Jazly', NULL, '112319', '$2y$10$A4gBRzwWHfEzGf2UdusNnOZA6TWMbkrM7ttGGK9gZ2QicC3K4KBTK', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190388', '2022-2109', NULL),
(1284, 'Bolodo', 'Lovely Rose, Galang', NULL, '112320', '$2y$10$567kgFFIlVnLvnHBwz4GseNNAJt8U0WyL7FaleUFtht.5tWCEDBwS', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190389', '2022-2110', NULL),
(1285, 'Bombahay', 'Kurt Justin', NULL, '112321', '$2y$10$OS0LyHibJmN/v4Hw5vBmuuFwehVkAc0wD71b4ttw0vY60Y3CBOI/i', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190390', '2022-2111', NULL),
(1286, 'Bombase', 'Marella Fiona', NULL, '112322', '$2y$10$gwzE3O23TATohGZzDobJVOJa2J3DJnEh9f.mJUkqBz9aeLvTPc5pa', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190391', '2022-2112', NULL),
(1287, 'Bombita', 'Jodilyn', NULL, '112323', '$2y$10$18fS6ruIjFbrbhGao7tszer4G55PJoxZVQCcOiSpSqct2r8IW3Kwm', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190392', '2022-2113', NULL),
(1288, 'Bongalon', 'Dyna Nicole', NULL, '112324', '$2y$10$XsFnGu3Uk7aCFYpm0Eyc8.XxB8M2HUJo41QtCsaauP2xe.CKDWhmm', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190393', '2022-2114', NULL),
(1289, 'Boquiren', 'Matthew', NULL, '112325', '$2y$10$9m2iDzDKHae3k/aAR4ZSqOU8yC8dmmbGQb5sfZK0hnO0s0cs7HTmG', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190394', '2022-2115', NULL),
(1290, 'Boromeo', 'Cemar', NULL, '112326', '$2y$10$/9yjb5RD.HYjcKL68rAmaudrLT4T5hZf5nqeefMWv2x/lRMOAvUH6', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190395', '2022-2116', NULL),
(1291, 'Borras', 'Aron', NULL, '112327', '$2y$10$X6RpsED3pleKKDjMPLl8QO1e4YREdVBR6RxAp2lEC2fnzVNqlUtUS', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190396', '2022-2117', NULL),
(1292, 'Brion', 'Jerald Louie', NULL, '112328', '$2y$10$pD1Saz.nssycz4keuUmMfO2Qsdy.5HbOi6i4dkC2ZvS1qQzmC2DNy', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190397', '2022-2118', NULL),
(1293, 'Brutas', 'Apollo Mel', NULL, '112329', '$2y$10$Gsa/HL5azD4eXpjD3ltGXed3.tX7iLPXURgnS6WZiSyhxJ8z6n6q.', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190398', '2022-2119', NULL),
(1294, 'Buan', 'Jeric Vince', NULL, '112330', '$2y$10$vwVQs0iRXMlkZF/1m7V.oO7HgeRz1/14MafP3YtY9t6ZETkls2Ube', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190399', '2022-2120', NULL),
(1295, 'Buhain', 'John Martin M.', NULL, '112331', '$2y$10$XHhPMSa5gSF/msimxUhxeelefwbhwZuDXG4GXIQbZMLX2ryIOBEQu', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190400', '2022-2121', NULL),
(1296, 'Bukid', 'Glifford', NULL, '112332', '$2y$10$xEZ/FS9AMB7g8DLolRTM7uNeumD/YXDxAVuLFyeVJklySJBX8Vzje', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190401', '2022-2122', NULL),
(1297, 'Bunag', 'Edward Miguel', NULL, '112333', '$2y$10$f1CZT0MiqRw/IEPz/Nvn2uikIwEyPl0bw6DlMpTc4LYcMlWG.8gNq', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190402', '2022-2123', NULL),
(1298, 'Bundalian', 'Larissa Joy', NULL, '112334', '$2y$10$nNgamuXMA5tIOvDCjWaOseuPeF9axA5FT4skF7nACxpUleqpaw74W', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190403', '2022-2124', NULL),
(1299, 'Caceres', 'Lemuel', NULL, '112335', '$2y$10$L/KHG7RSJ6X1O.frELoae.uSfL76b.eDGrC89eS3meoaS4vRhiLyK', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190404', '2022-2125', NULL),
(1300, 'Calamba', 'Ruvic', NULL, '112336', '$2y$10$Ozs7yBwoSlD8UEZ7S/LdBecXYYzz8i.TM/JZh.VZ53VN8utjXHTU2', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190405', '2022-2126', NULL),
(1301, 'Calibugar', 'Jayson', NULL, '112337', '$2y$10$deC8lsgJxMlFDyqA7ym.AuVzNjvNHwGy1mkQuayy/7x12oSyvvkWS', 'Student', NULL, NULL, NULL, 'Male', 30, NULL, NULL, '1190406', '2022-2127', NULL),
(1302, 'Calingay', 'Justine', NULL, '112338', '$2y$10$7jFdYDxmSUiir8H0sTVObO2uiL4bIsEG1r4EhcflYEhEdpYBukNm6', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190407', '2022-2128', NULL),
(1303, 'Calixtro', 'Radz', NULL, '112339', '$2y$10$LDNg6m24UB8z6E6I02Tu6.PkzZ2eSLvykC6.jbsCSWWestXFWR4qu', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190408', '2022-2129', NULL),
(1304, 'Calma', 'Arabella', NULL, '112340', '$2y$10$I9RH5YZBFsTcswi659GSGOJox.dMzBI/5sQYKW1D6fleDqLfyK4wO', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190409', '2022-2130', NULL),
(1305, 'Camalla', 'Angielyn', NULL, '112341', '$2y$10$DtKd/Sj0nXQsxKBHSEGTtOeN4mxTS6c.Tm7zlPj4WwhxScd2Lt3hC', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190410', '2022-2131', NULL),
(1306, 'Cangayo', 'Sydel', NULL, '112342', '$2y$10$lacvNL9g467Tj2fORZQpFeeIGtmY7gD2o1HHIxc0v9Yb4GGz1drda', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190411', '2022-2132', NULL),
(1307, 'Canog', 'Manuel', NULL, '112343', '$2y$10$DY4jBW/BXy6ndTeWbL4VBegLPw6dgWR96sbC30roH.S.akyy/0xFu', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190412', '2022-2133', NULL),
(1308, 'Canonse', 'Japeth', NULL, '112344', '$2y$10$UCZsTK.izQMBJ.T3eYKTbOPOy3ITs3tZD1vvngjZCmXUFKj.01Xsy', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190413', '2022-2134', NULL),
(1309, 'Cantina', 'Nicky Angheles T.', NULL, '112345', '$2y$10$5OiS82or1E6eu6UfscOl3.fIWSZLVOAyTnKL1yuXXTB0D7H/2jQRm', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190414', '2022-2135', NULL),
(1310, 'Capate', 'Noel', NULL, '112346', '$2y$10$aBBWLwCjK3hzBZkp18ZVYeqeQ31o25nky5xcxJhvkUM6/bCTy4VN2', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190415', '2022-2136', NULL),
(1311, 'Capero', 'Jenniel', NULL, '112347', '$2y$10$4BHqSyr6AeMH9C1ZocxBpeBUvrQBWhsucAkTNqoF2fbGBP52dahGy', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190416', '2022-2137', NULL),
(1312, 'Capuchino', 'Jhomar James', NULL, '112348', '$2y$10$cVOtrG5M0q.NCYHpjBap8erjXnM4fwv069FKYCwt5I14JlrFxRFz6', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190417', '2022-2138', NULL),
(1313, 'Capul', 'Kyle Renwelle', NULL, '112349', '$2y$10$8Xno/fVivtF4EZ8cVaYbgepXdLYlF3Z6TsggC8LshoGSUx3YZOQpO', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190418', '2022-2139', NULL),
(1314, 'Caraig', 'Mark', NULL, '112350', '$2y$10$w0SAPJFX4PJb1UYkvmDPlOgoR6gzvijkjUVFNPMJVqwoirWyCssXi', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190419', '2022-2140', NULL),
(1315, 'Caramay', 'Karla Mae', NULL, '112351', '$2y$10$L.qu9gnTut6kxp1ZPFVVVOA2GL6nXUZYdlPdjrkt/eYYya4RJj1sC', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190420', '2022-2141', NULL),
(1316, 'Carianga', 'Ronnie', NULL, '112352', '$2y$10$BusJu0RVd.yfnVgs2m2pxue2PiEATagTmlN0hLrb8sHsZv23ov8Ey', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190421', '2022-2142', NULL),
(1317, 'Carreon', 'Shane Mathew', NULL, '112353', '$2y$10$pbKCnBlTYz4uZshsa.rdtuEhgjF8ZP93ajEw/X3M9JdiMVnU/o3cW', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190422', '2022-2143', NULL),
(1318, 'Castillejo', 'Maria Christina', NULL, '112354', '$2y$10$v6aY6CcJJ.dRaIIyiyNRFuPxZJC1kALABpe0XxgDBwpqwg4rwd5ge', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190423', '2022-2144', NULL),
(1319, 'Castillo', 'Karen', NULL, '112355', '$2y$10$VDXPHdL.PeHliSJBlIwne.B4Rs/uHRcOZHUIyQ6r8fp/bN05DAHka', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190424', '2022-2145', NULL),
(1320, 'Casulla', 'Jelo Mark Andrei', NULL, '112356', '$2y$10$mKlZ61M7UM9YR9mI3d365eWnw.KozX1Z8X.UqlwpUCuALNoZI6JnC', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190425', '2022-2146', NULL),
(1321, 'Catindig', 'Christian Frank', NULL, '112357', '$2y$10$BFJs5vyktVwG/jZ09pV7X.27qf17msskxbj15Q5j2m6PG5EcZT.4K', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190426', '2022-2147', NULL),
(1322, 'Catindig', 'Don Ismael', NULL, '112358', '$2y$10$IMAt2ECZ13bHCE5CBklWIeZ.qzmWdeMYEl.O4eKA5QnZ9oBQ3mx.K', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190427', '2022-2148', NULL),
(1323, 'Cautiver', 'Mark Henson', NULL, '112359', '$2y$10$IsByMqQ7BThjal9Rvo8mkOq10ZGrnYB4CeGaOwlkpRJGAa1X6ejrm', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190428', '2022-2149', NULL),
(1324, 'Cavan', 'Jeruel Abiezer', NULL, '112360', '$2y$10$DA9WsJET.L9O2uDKbfdcW.qe7MLVbz0gcInBLHtVvPwH4ETVhCulO', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190429', '2022-2150', NULL),
(1325, 'Cavan', 'Joshua Aroh G', NULL, '112361', '$2y$10$2KFtWo6cXXBdMZgO3UnWGe8xFcZ6ia9limIatIEGBiiCjp0C9XHz6', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190430', '2022-2151', NULL),
(1326, 'Cay', 'John Raniel', NULL, '112362', '$2y$10$48IGlFxv/eUNzNOKZClcW.j6dQBei0l77AyfmNQhjeT1wl6E5Et9a', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190431', '2022-2152', NULL),
(1327, 'Celebre', 'John Paul', NULL, '112363', '$2y$10$6D/aswFQ8vjbvFk7DvAzpOMXQYFq2ttHXlIHTmaBpppQNPJ0Xsu.m', 'Student', NULL, NULL, NULL, 'Male', 31, NULL, NULL, '1190432', '2022-2153', NULL),
(1328, 'Cenizal', 'Marlanne', NULL, '112364', '$2y$10$O2rdwnu43krTkAhlKgcvVehGCrio0lbQwk71lZDp.QfrAqTlckbrS', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190433', '2022-2154', NULL),
(1329, 'Cequi?a', 'John Bernard M.', NULL, '112365', '$2y$10$7cLBE9iCzxcdBTrbcDC8WOlZmlzn5qmWWl6H7vze/AM1jKY8f/rb6', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190434', '2022-2155', NULL),
(1330, 'Chavez', 'Edrian', NULL, '112366', '$2y$10$Nb0SQ31qn.qzy5WaHi2dV.Es312c/rodDwCA73Ft9wYE2QnTrVIoa', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190435', '2022-2156', NULL),
(1331, 'Claud', 'Patrick John', NULL, '112367', '$2y$10$iTkZgW.uZ0VzyJsN.s14.uJxmFqfTeCGBjVHy.nacIT0EGz5KazpC', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190436', '2022-2157', NULL),
(1332, 'Claudio', 'Ralph Laurence', NULL, '112368', '$2y$10$HcqiT/ufdYherySoTOucm.f151ElCsDVy9dwiRQmOxPZBkbUdiG7e', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190437', '2022-2158', NULL),
(1333, 'Codog', 'Reynaldo', NULL, '112369', '$2y$10$i2tlOS7/ruopHoWJOvSkZebtsN3OULL1aTmzQ6lwASjO/RdFoVvIq', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190438', '2022-2159', NULL),
(1334, 'Colipano', 'Rhed jay', NULL, '112370', '$2y$10$qgPPRm6p78NxBARtpzlnHu6VAX5X/y331le7B8nzW3PNgFMz8KY5K', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190439', '2022-2160', NULL),
(1335, 'Compayan', 'Jomari', NULL, '112371', '$2y$10$rmueFsYGNMgkBFHdBDWF5ulP8UtMXN9vkrX9ZIraGp7KDd4nEIVVe', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190440', '2022-2161', NULL),
(1336, 'Concepcion', 'Gabriel Christian', NULL, '112372', '$2y$10$.EOLM5sJIR6sL3ZRPSPNBuK8Kq/ivA2NvWSzp/.30Fe3TSLtydLfa', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190441', '2022-2162', NULL),
(1337, 'Consuelo', 'Lance Ivan', NULL, '112373', '$2y$10$5l9ujZZvZMEJzK8znCi.guupvl/zLqOXx5mhkaIBPcUd6JXc.2w8C', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190442', '2022-2163', NULL),
(1338, 'Contreras', 'Shaira Lei', NULL, '112374', '$2y$10$HLMWXCk2w/.2xeRBg81gp.e.GJiH.VIYz9iK6eJpYxJJthWS8UxAK', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190443', '2022-2164', NULL),
(1339, 'Cornelio', 'Acel Rose', NULL, '112375', '$2y$10$rMJfnJMlVsJJnugYX5..NenviobhHIx.6yWVmbIV7sev054m2dZm.', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190444', '2022-2165', NULL),
(1340, 'Coronel', 'Mark Aldwin', NULL, '112376', '$2y$10$oFhMArB4aHtCCiBHZ14UoOF0szw9ikYEi0FJGd5m1uJDP.p/1HOWS', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190445', '2022-2166', NULL),
(1341, 'Cortez', 'Anne Margarette', NULL, '112377', '$2y$10$ZIJq1GzQKcEQQ1BpwkWxGOSzE7vFYubaoC3iASIJ1HyDAxGVm6qoa', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190446', '2022-2167', NULL),
(1342, 'Cortez', 'John Benedict', NULL, '112378', '$2y$10$eKL35B1shAXdkP4qalUoK.lF1DO5zoML5O7bU.q5U2/kfX7i2Uiwm', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190447', '2022-2168', NULL),
(1343, 'Crisostomo', 'John Lodie', NULL, '112379', '$2y$10$TVFFJ00OX3Fp3jPj6XY6jO.XP0qKQ8bMA9t.hAj0CCP5cbkgEGZBW', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190448', '2022-2169', NULL),
(1344, 'Cristales', 'Clingle Anne N.', NULL, '112380', '$2y$10$qHiNbY02Vxrmi3WR4Os93ud1iQEZYL/TQczn85syqv2jTOQBmMdfm', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190449', '2022-2170', NULL),
(1345, 'Cruz', 'Frisian Joy', NULL, '112381', '$2y$10$0hMc7IAgdSRveB2HPqdnFew2FfromuKXW2l9AXqG3lfNhPTx8uaXW', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190450', '2022-2171', NULL),
(1346, 'Custodio', 'Bryan', NULL, '112382', '$2y$10$nBE15bGiWOLD.T1JwppEJuD4bmlHW3hJv2K0ZVRtniMfbpgaoihwG', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190451', '2022-2172', NULL),
(1347, 'Daingan', 'Darren Andrei', NULL, '112383', '$2y$10$i.i6wLEIO2Ed8Qhd4x9yg.tT7kDSZhIqhphdC/pd/VOrI8G3vwHpu', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190452', '2022-2173', NULL),
(1348, 'Dasco', 'Joy Ann', NULL, '112384', '$2y$10$.2Kmw/K5ACHarIrQCVXeYO.LYGWb/jiieNmPhBkJIfZl7939UFX72', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190453', '2022-2174', NULL),
(1349, 'De Chavez', 'Lian James', NULL, '112385', '$2y$10$qir9aWUEbZ5Zi0Q3oe1Ka.Y5CObJIiJ5CiHlnrng3ZpyWvs2J/vly', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190454', '2022-2175', NULL),
(1350, 'De Chavez', 'Swedden Jay', NULL, '112386', '$2y$10$n0azjyZP3yFRsQSWhKGquOfMItNf5nwk1i8e2DmsWvdxJ8FGLJq0.', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190455', '2022-2176', NULL),
(1351, 'De Chavez', 'Sander John', NULL, '112387', '$2y$10$NTHXwmkFgNC0KoUvg8lguuz2oOVKykOwNY35O2l2R5skrx8TStFZa', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190456', '2022-2177', NULL),
(1352, 'De guzman', 'Andrei Blue', NULL, '112388', '$2y$10$HYlN7UScIJTAzYvjQVxYLOzqk1Ayka4lYSsmroAXFUKivOQAISXX2', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190457', '2022-2178', NULL),
(1353, 'De Jesus', 'Brett Kirsten', NULL, '112389', '$2y$10$Y5qbkWHzghyPLWQkF4sp0.ONvVZO0.zPok/pFyc5lxRWYtlriIqxC', 'Student', NULL, NULL, NULL, 'Male', 32, NULL, NULL, '1190458', '2022-2179', NULL),
(1354, 'De Jesus', 'Ren Marc', NULL, '112390', '$2y$10$Hg.SjhEftnc3/IzZqyKnuuiw9dfsqF921Gq1qm5ekuJcKliosY0he', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190459', '2022-2180', NULL),
(1355, 'De Leon', 'Rajul', NULL, '112391', '$2y$10$rwJtP5npe/PF0KRkzpsEDe7epYyRA3/eYXIGcHb0w/MimfZhZGvVm', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190460', '2022-2181', NULL),
(1356, 'Deacosta', 'John Ezekiel', NULL, '112392', '$2y$10$JBRPEJvlpXSU7eBeKhcp1.fdDLpBoaH0zovcWEp2THlLvfuxbfW3C', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190461', '2022-2182', NULL),
(1357, 'Degamon', 'Jerald Dominic', NULL, '112393', '$2y$10$zDX6RrxkbLAxnCSx7/VJPOI9mjrVkhQO.Z6P9sudS59M8XfOTDzPS', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190462', '2022-2183', NULL),
(1358, 'Dela Cruz', 'John Michael', NULL, '112394', '$2y$10$4GZsvmugS7FySG.nuXLt/OGH.31vCOgpRKnCaCxZDcJADzZuXR/9e', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190463', '2022-2184', NULL),
(1359, 'Dela Rosa', 'Elaija', NULL, '112395', '$2y$10$AF3rcy/09TBJpFwVyvD2Vuq4rSqwd0Mz2F4pglrxvdL5DgKX6fCUO', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190464', '2022-2185', NULL),
(1360, 'Delfin', 'Daniella', NULL, '112396', '$2y$10$i1duUk4lR2jYNWHkUUfeyu5SQoTShhDgSsgmNhEJUeVyJzL/RQL82', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190465', '2022-2186', NULL),
(1361, 'Delfino', 'Krisha Mae', NULL, '112397', '$2y$10$6ymRuP4PwnvmNEmDmiGl6.Z1U.p7LWxBPUouK4lfcZNoJcwTL1H4i', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190466', '2022-2187', NULL),
(1362, 'Delima', 'Justine Luis G.', NULL, '112398', '$2y$10$WWxqGKlujyTR4bFtWU0Qju/bI1ckohOU8KFtwAJmGIAlgd/3fLv46', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190467', '2022-2188', NULL),
(1363, 'Delmo', 'Julienne', NULL, '112399', '$2y$10$BGUU0OnBhmQB8wuLV5FzR.LJhfcSXwFAV9MyRbxQKVWMQq5LeEzQy', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190468', '2022-2189', NULL),
(1364, 'Delmo', 'Sebastian', NULL, '112400', '$2y$10$XkaW/iDyzGK3FR4VJBhtmOMU24pNUEIIpjn0jNvUEbceg9phzC.tW', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190469', '2022-2190', NULL),
(1365, 'Demain', 'Mark u-an', NULL, '112401', '$2y$10$d27fDLKcwvoQ48vHMKPhVOKbCLtS4tusd89eFnqFb/wWbsciVdUlK', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190470', '2022-2191', NULL),
(1366, 'Demellones', 'Jovanie', NULL, '112402', '$2y$10$gofUIMr4x/nSBUYaM/GT6O6Dbb5GfHWmWzf8B/NZ3v2Hf8wXxjBcW', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190471', '2022-2192', NULL),
(1367, 'Demonteverde', 'Albert', NULL, '112403', '$2y$10$JsmbX9wt2HgwCpXNTUC8xuFmUCeVlXAXC.n9tNj8VfVjGU2C1Yg9.', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190472', '2022-2193', NULL),
(1368, 'Demonteverde', 'John Kent', NULL, '112404', '$2y$10$V1mSaAj0ncUnEn7r8Ptmh.xlMfUYEyzbC8LGP155qwcmDKLPOAa2G', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190473', '2022-2194', NULL),
(1369, 'Derilo', 'Mark Steven', NULL, '112405', '$2y$10$JKxJ61Zg2fy2JsGjV/8mDOx1NJ3mltnrNa0fpPNOkhTU72YrQpoQ2', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190474', '2022-2195', NULL),
(1370, 'Diapulet', 'Carlo Angelo', NULL, '112406', '$2y$10$NbtXr0LLjxb36E.Sc2rg1OKD2qUi8VFfUNxInxQuGHNLiFwdtvw46', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190475', '2022-2196', NULL),
(1371, 'Diaz', 'Francis Adrian', NULL, '112407', '$2y$10$LOdJRUw.kxLivz3FhhdKcuEZiQJIXK96WlzGS6J9/jF/kxN.IGSAC', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190476', '2022-2197', NULL),
(1372, 'Diaz', 'Joshua', NULL, '112408', '$2y$10$HCkJ2w8eUY2MPCuFfRo0q.5LesW96Zb5nNMZFkg8ZgKaU.yQc1b/a', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190477', '2022-2198', NULL),
(1373, 'Dictado', 'Nheil', NULL, '112409', '$2y$10$2hQ.l2WEIMgXxWhL1TGdMOyn1J.F6haw9m3MfNgZ9F2jTSGPAFlFy', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190478', '2022-2199', NULL),
(1374, 'Diniega', 'jenith', NULL, '112410', '$2y$10$LBGcpLqy4fb.iCw.buF2Ju8JqTUAOsK8/PUZxZBHVVoaL4r7uahp.', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190479', '2022-2200', NULL),
(1375, 'Diocares', 'Mc Harvey', NULL, '112411', '$2y$10$eGd7CN3qgbFRtlUldG5AxeQnP0ykH18EyX7hJUkVb.n1kJGJRBcIi', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190480', '2022-2201', NULL),
(1376, 'Diongco', 'Elton John', NULL, '112412', '$2y$10$hG2eDJCi5bme6mZaUZzMlOjivwd4LEaPjfTBWw6wjvFiaxADQQFO.', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190481', '2022-2202', NULL),
(1377, 'Dioso', 'Arlie Marie', NULL, '112413', '$2y$10$BL8FKNHhHQLLRSvk7GHzy.58rsCJp5m2mqUDETWBJG4iXepS1ghU2', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190482', '2022-2203', NULL),
(1378, 'Divinaflor', 'Rojen D.', NULL, '112414', '$2y$10$BwuzT78NQmsBmjxZPqinZO8mAor69dIoi3Wn44beXlgZl5hz04gbO', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190483', '2022-2204', NULL),
(1379, 'Domingo', 'Brent Angelo', NULL, '112415', '$2y$10$yJYo4BhqySsdxk3jpu/aeuDvtMf3DRkD8AgE9oNNaF88n.pPO03Ha', 'Student', NULL, NULL, NULL, 'Male', 33, NULL, NULL, '1190484', '2022-2205', NULL),
(1380, 'Duenas', 'Clint Harold', NULL, '112416', '$2y$10$3jeaeAFF5UXXnsoEBpdkR.4K5B8B6yQtSWOGdPrd3YdS8HUvfDcvu', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190485', '2022-2206', NULL),
(1381, 'Dugay', 'Samuel Ehrole', NULL, '112417', '$2y$10$8b2K8KBSfxx6mWiEWmugied4Gem/uigeLHeK/lpPVfC6oopKT40Vq', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190486', '2022-2207', NULL),
(1382, 'Duinog', 'Lenard', NULL, '112418', '$2y$10$dMEhS4E2AG2oV.wILx6iXuuWT3jTu6CWpwbZ1r/B7R3wcLN5DV/Ai', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190487', '2022-2208', NULL),
(1383, 'Duraliza', 'James Paul', NULL, '112419', '$2y$10$hknpe/4hCtkCxnS6mRllEO97CO//fyL5nN7KydSxtiuv59jWShTeG', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190488', '2022-2209', NULL),
(1384, 'Dy', 'Hiroyuki', NULL, '112420', '$2y$10$dJDsLy4rB2cmS.I0mt6pKuYUJPBPlKZcqI7rHyPLgM4qc8DvgQ3O2', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190489', '2022-2210', NULL),
(1385, 'Ebitner', 'Ishmael', NULL, '112421', '$2y$10$4KZ8rvIMV3He8O43w0fqletLVrFAeSSbBGeWkMR4.pGrOE9nG9gT2', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190490', '2022-2211', NULL),
(1386, 'Echon', 'Vincent Joseph', NULL, '112422', '$2y$10$Jz56sjLKpLqXqZwA.7ZfkOu10GL9gggajtXGuza58gAqWGB7ogYIK', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190491', '2022-2212', NULL),
(1387, 'Elomina', 'Carl Joshua', NULL, '112423', '$2y$10$BVy8fRa74mv5RMJ2.1cTguKTJNmkOc1Spt7a7Zl3Centxbh2Tuixm', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190492', '2022-2213', NULL),
(1388, 'Empedrado', 'Leandro', NULL, '112424', '$2y$10$prqFH3GnprTfM2cUX/s6X.1gOrBagtgXJAh5JEHO0zg/vCF5GmzNy', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190493', '2022-2214', NULL),
(1389, 'Endrina', 'Francine Faith', NULL, '112425', '$2y$10$gRwZ55dz61qk8WegjGe4y.Z6sFhv6UN/z7.C5mWBbdrNE8CR4HK0e', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190494', '2022-2215', NULL),
(1390, 'Eno', 'Joshua', NULL, '112426', '$2y$10$EbwEkf2dQmBcM1GTJsGuReeK8GVv/wVzTXr0TPOHJHNZ5aI1ZBUkm', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190495', '2022-2216', NULL),
(1391, 'Enriquez', 'Nathan Jacob', NULL, '112427', '$2y$10$UgK6NPIX8OoKoCJkSpb2b.6RzhhLJ6sn4FbPmuWIDadeDGHhDdBV6', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190496', '2022-2217', NULL),
(1392, 'Ereno', 'Angelyn', NULL, '112428', '$2y$10$73ZIzwei5Tyv4pmousDFduBbEFpgFLpW5.RovUXRPFqLOm47wFiKm', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190497', '2022-2218', NULL),
(1393, 'Ereno', 'Ralph Clarence', NULL, '112429', '$2y$10$.5RipRulCYGCKAy/ws2cPegT.8ZB13kRKtqFrjriOD.eKgfl/Apgy', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190498', '2022-2219', NULL),
(1394, 'Escano', 'Jhon Christian', NULL, '112430', '$2y$10$sHcm29bAxjuTmKMhq.ihEurhW1ySewWNo5eJfeGOLZ8VdTge7pFHK', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190499', '2022-2220', NULL),
(1395, 'Escarlan', 'John Dayle', NULL, '112431', '$2y$10$5rN6RbdgBUAZbhuFqyLsT.VpfGK2PvUcZ5zuVtrCkCwlVV280Zj8e', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190500', '2022-2221', NULL),
(1396, 'Escosura', 'Ariel C.', NULL, '112432', '$2y$10$YNeZ1Vnwt.qaKksFd0tAretJNFKU22JBo/9/EzKVpPn7ZE..KAon2', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190501', '2022-2222', NULL),
(1397, 'Escoto', 'Anthony Glenn', NULL, '112433', '$2y$10$WzBpl6K3T6XUf8ErJW1zKOfkY4FoSG4hkmUPHhBiqD1LJrVO3cbAq', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190502', '2022-2223', NULL),
(1398, 'Espenida', 'Jessie B.', NULL, '112434', '$2y$10$oT5Ox65Qy99GTDagIlPgPuujAZI2GI2lTAILVbCBI18UT1SAkwS26', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190503', '2022-2224', NULL),
(1399, 'Espina', 'John Vincent', NULL, '112435', '$2y$10$sIEtiJIMFzyWhsvyHozLT.060sBfr1ts6iNERzla5B7PkmhPrG3xy', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190504', '2022-2225', NULL),
(1400, 'Evangelista,', 'Nio D', NULL, '112436', '$2y$10$cKkvvhmG1XvZrnd6YeR3CeqFhxRlTKKi2OLDhbeMLcx7vCFGCbDUy', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190505', '2022-2226', NULL),
(1401, 'Fadul', 'Nikko', NULL, '112437', '$2y$10$6.hBxOpqpwC/FHOj6s32NeczFIPaLMQY3U57X01ZQF50Twv/RZ8P.', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190506', '2022-2227', NULL),
(1402, 'Feliciano', 'Mark Rouie', NULL, '112438', '$2y$10$qJl4r03GHUozGYuADcveseYURwp9aAIxM1rxH6HJOIV7ZQKpJ9cvW', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190507', '2022-2228', NULL),
(1403, 'Fernandez', 'Mark Aiden', NULL, '112439', '$2y$10$iRzGPsWgX79hlIQT6J0wk.cuTDwp8RZM7nzKkWYB/KvdE5b/DJVoG', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190508', '2022-2229', NULL),
(1404, 'Ferrer', 'James Mark', NULL, '112440', '$2y$10$WIVbK0hNbWbhbfi7YlEdjOGp1fLMIg0FqoNDo6qt0QERvNL4u6kAG', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190509', '2022-2230', NULL),
(1405, 'Fetalco', 'Jan Lenard', NULL, '112441', '$2y$10$lq9tfSf01BKxO.MTqn1pEOrPDoLT8W4V0WZRJxMjldJbQoG0XQzf2', 'Student', NULL, NULL, NULL, 'Male', 39, NULL, NULL, '1190510', '2022-2231', NULL),
(1406, 'Flaviano', 'Sharlene Mae', NULL, '112442', '$2y$10$Ziyv4YXhZykjtuvc4L6ynevTXUUf.bqblL/Lv9Y5QvtWkp4qxt2sW', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190511', '2022-2232', NULL),
(1407, 'Flores', 'Victor Joe', NULL, '112443', '$2y$10$7fNEcIYplAetrHeJwvgaxeobTqRFah88EJSwsaKEDDnsRm3KuJ1Se', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190512', '2022-2233', NULL),
(1408, 'Flores', 'John Phillip', NULL, '112444', '$2y$10$Z6AZ7RA.JoEJNZfQbWBqp.UAjAdjZArmlgGO1xBg8wEufbDqMOUPq', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190513', '2022-2234', NULL),
(1409, 'Fontanilla', 'Jose Luis', NULL, '112445', '$2y$10$5aAg8qkaw6ChPta.yFoR4.HFD1N4JVYmoQXmzdi3Adgv8y4LHtWJ2', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190514', '2022-2235', NULL),
(1410, 'Formaran', 'John Marzel', NULL, '112446', '$2y$10$q2hgcsXYoG5zqh6M0sw9CefxYMp8br83ZipMYUOL9dHy2z2kCdF3i', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190515', '2022-2236', NULL),
(1411, 'Frias', 'Hanz Marione', NULL, '112447', '$2y$10$ivIa0tEvvntVM7Luquc5/O.x8IWWcuz2iJZ0AbmPDuwsqGZyDDkqi', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190516', '2022-2237', NULL),
(1412, 'Frilles', 'Ron abiel', NULL, '112448', '$2y$10$KK4iTq328vM2a4XOAT2vWOtdpIsLP0pT2C7EuB7cVTM6tIi58eIGy', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190517', '2022-2238', NULL),
(1413, 'Gabane', 'Robert', NULL, '112449', '$2y$10$tENEhgly94L66LBcCdZnzOtThA9bGXNzfzwNYWpB2mKv6xLFQrNLK', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190518', '2022-2239', NULL),
(1414, 'Galeria', 'Mark Angelo', NULL, '112450', '$2y$10$TzRXqFZpzS6eOMJiKfdKTOBcEcCYTfNTDL453u.YDzI4C.LH3nP8a', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190519', '2022-2240', NULL),
(1415, 'Gallora', 'Prinz Ezra', NULL, '112451', '$2y$10$Hu9GnGLDYxxLeIZVTxt8keULdHKqMGnxQ8F6ppqRPAD43sD87M3WO', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190520', '2022-2241', NULL),
(1416, 'Garcia', 'Dave Winsley', NULL, '112452', '$2y$10$ICm8ZfrjuKX38jR0HmSD6uZernQTpfvmtMQXEFVGsoqaqRonKZF8u', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190521', '2022-2242', NULL),
(1417, 'Garcia', 'John Cedrick', NULL, '112453', '$2y$10$EN3ZeDQ0DsabFgo8gfuSMOC2UwK7byU.QmrdMalVzkflrVLIj2gIu', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190522', '2022-2243', NULL),
(1418, 'Gogorza', 'Iriane Nicole', NULL, '112454', '$2y$10$d9jY147akawkeMf.8g/2hu2.L3zMwmgZILyfe2AEWjbSNc3uRRRry', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190523', '2022-2244', NULL),
(1419, 'Gomez', 'Glen', NULL, '112455', '$2y$10$.jnZt2ZnZSwsH/hjqWsGZ.fHGyu0GNHYI3jNyfzUvEtw8kOeIFReK', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190524', '2022-2245', NULL),
(1420, 'Gomez jr', 'John Gerwin', NULL, '112456', '$2y$10$pQwTn4RSuNbQijNZGOFwGeLp1743oi/JXmfVUfF3lGgmwAGg1yHzG', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190525', '2022-2246', NULL),
(1421, 'Gondraneous', 'Aubrey Dianne', NULL, '112457', '$2y$10$rGGUb.dXDNTYc3alcIzQMORezYFRI4qiiQkgf8bp9H3c6p7AtVv1W', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190526', '2022-2247', NULL),
(1422, 'Gonzales', 'Gon Yohraine', NULL, '112458', '$2y$10$HpN9ERi4aaIpAU39YqsthumXUYBOzqqDyRoNAWs2LJmEmk.uBDYRS', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190527', '2022-2248', NULL),
(1423, 'Gragas', 'Saren', NULL, '112459', '$2y$10$tx3g5BE1IzsBD8wvEZQQrOfehg9LTxgKYxOBw.V4IE9NQQimWr1GW', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190528', '2022-2249', NULL),
(1424, 'Gualberto', 'Carlos Jose', NULL, '112460', '$2y$10$adJkvalJ4TPS2yp1Homyo.VTzbLJQXYWPRc/llsEANJW/mWtkZHvS', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190529', '2022-2250', NULL),
(1425, 'Guerta', 'Jasmine', NULL, '112461', '$2y$10$QwtGP5NKmj6XnuuwhCGwE.zSRSnAJwwXURLSr8F4uEPCtyYWkyC/6', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190530', '2022-2251', NULL),
(1426, 'Gumaro', 'John Vincent', NULL, '112462', '$2y$10$1Yn2ATh8Q2vr9QEs4mH65ud8NdzO4.D8E74vgsvPC9U4Pzpfp6XWS', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190531', '2022-2252', NULL),
(1427, 'Gungon', 'Jastine James', NULL, '112463', '$2y$10$zDxSKjGSdqnEA5rqsgtwP.pIYIbug.hJFMno3HWi/c2K2ZRD0Ywnm', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190532', '2022-2253', NULL),
(1428, 'Gutierrez', 'Kent Adrian', NULL, '112464', '$2y$10$EQxfz/qo0uk1qXZNbFkAyuBELbBpsVKLy.LVN9aY6OIpjfEaPyuRK', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190533', '2022-2254', NULL),
(1429, 'Hermano', 'Kurt Justin', NULL, '112465', '$2y$10$yLYFngdzccJHs4GFm1Ccbe4LEe0lm2BFnf.kGHa45DTHc/1WpUHwK', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190534', '2022-2255', NULL),
(1430, 'Herrera', 'Gabriel', NULL, '112466', '$2y$10$li1jct4qVd2ibB21G3gWdevAQdU5H5o3KiASSb2Mg4ZWqxo3wLELO', 'Student', NULL, NULL, NULL, 'Male', 34, NULL, NULL, '1190535', '2022-2256', NULL),
(1431, 'Custodio', 'Bryan', 'Guevarra', 'supervisor', '$2y$10$.Pk22qplQJvrU155rWuHDOScJ.vmdhzOvPfKe8NZ0XNjNxrJjdDt.', 'Supervisor', NULL, NULL, 'bryancustodio320@gmail.com', '', NULL, 'fujitsu', 'santa rosa', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_reports`
--

CREATE TABLE `weekly_reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `week_start` date NOT NULL,
  `week_end` date NOT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weekly_reports`
--

INSERT INTO `weekly_reports` (`id`, `title`, `student_id`, `week_start`, `week_end`, `file_path`) VALUES
(1, 'Weekly Report 1', 1197, '2024-12-22', '2024-12-28', 'uploads/1734844756_MOA.pdf');

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
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`requirement_id`);

--
-- Indexes for table `student_hours`
--
ALTER TABLE `student_hours`
  ADD PRIMARY KEY (`coordinator_id`);

--
-- Indexes for table `student_supervisor`
--
ALTER TABLE `student_supervisor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coordinator_evaluation`
--
ALTER TABLE `coordinator_evaluation`
  MODIFY `evaluation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `student_supervisor`
--
ALTER TABLE `student_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `submit_requirements`
--
ALTER TABLE `submit_requirements`
  MODIFY `submit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1432;

--
-- AUTO_INCREMENT for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `student_hours`
--
ALTER TABLE `student_hours`
  ADD CONSTRAINT `student_hours_ibfk_1` FOREIGN KEY (`coordinator_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `student_supervisor`
--
ALTER TABLE `student_supervisor`
  ADD CONSTRAINT `student_supervisor_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_supervisor_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `weekly_reports_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
