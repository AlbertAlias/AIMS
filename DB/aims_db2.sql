-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:03 AM
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
-- Table structure for table `coordinator_evaluations`
--

CREATE TABLE `coordinator_evaluations` (
  `id` int(11) NOT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `evaluation_grade` enum('5','4','3','2','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `final_grades`
--

CREATE TABLE `final_grades` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `final_grade` enum('5','4','3','2','1') NOT NULL
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
(82, 'CO001', 121, '1-190302'),
(83, 'CO002', 122, '1-200043'),
(84, 'CO003', 123, '1-190058'),
(85, 'CO004', 124, '1-200083'),
(86, 'CO005', 125, '1-200146'),
(87, 'CO006', 126, '1-200027'),
(88, 'CO007', 127, '1-210016'),
(89, 'CO008', 128, '1-200086'),
(90, 'CO009', 129, '1-190077'),
(91, 'CO010', 130, '1-200011'),
(92, 'CO011', 131, '1-200155'),
(93, 'CO012', 132, '1-200149'),
(94, 'CO013', 133, '1-170033'),
(95, 'CO014', 134, '1-200065'),
(96, 'CO015', 135, '1-200203'),
(97, 'CO016', 136, '1-200200'),
(98, 'CO017', 137, '1-200186'),
(99, 'CO018', 138, '1-200125'),
(100, 'CO019', 139, '1-200138'),
(101, 'CO020', 140, '1-200145'),
(102, 'CO021', 141, '1-200004'),
(103, 'CO022', 142, '1-200096'),
(104, 'CO023', 143, '1-160042'),
(105, 'CO024', 144, '1-200049'),
(106, 'CO025', 145, '1-200094'),
(107, 'CO026', 146, '1-190303'),
(108, 'CO027', 147, '1-200044'),
(109, 'CO028', 148, '1-190343'),
(110, 'CO029', 149, '2-210005'),
(111, 'CO030', 150, '1-190245'),
(112, 'CO031', 151, '1-190094'),
(113, 'CO032', 152, '1-190174'),
(114, 'CO033', 153, '1-190078'),
(115, 'CO034', 154, '1-200111'),
(116, 'CO035', 155, '1-190155');

-- --------------------------------------------------------

--
-- Table structure for table `rendered_hours`
--

CREATE TABLE `rendered_hours` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `hours` int(11) NOT NULL,
  `rendered_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_approvals`
--

CREATE TABLE `report_approvals` (
  `id` int(11) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `report_status` enum('approved','disapproved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `title` enum('Medical Certificate','Application Letter','Recommendation Letter','Acceptance Form') NOT NULL,
  `description` text DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `coordinator_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `title`, `description`, `department_id`, `coordinator_id`, `created_at`, `updated_at`) VALUES
(7, 'Acceptance Form', 'pakibilisan george', 8, 8, '2024-12-03 05:28:46', '2024-12-03 05:28:46');

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
-- Table structure for table `supervisor_evaluations`
--

CREATE TABLE `supervisor_evaluations` (
  `id` int(11) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `evaluation_grade` enum('5','4','3','2','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_type` enum('developer','admin','coordinator','intern','registrar') NOT NULL,
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
(121, '', NULL, 'Abella', 'Adriane Paul', NULL, NULL, 'Male', '', '', '', 'AA1190302', '$2y$10$YVoLzOYwch4uf6W7BFq5UejUFmvrAJPwJa8b71PUU9/NgC5PATWx.', 'intern', 8),
(122, '', NULL, 'Abellano', 'Dynarose', NULL, NULL, 'Female', '', '', '', 'AD1200043', '$2y$10$Gl/.FjIrSHJ9nEBrtFyhO.jhN/ac1uOAc0PV9zRDZaFsx9FbSiZbC', 'intern', 8),
(123, '', NULL, 'Alaurin', 'Karl Dominic', NULL, NULL, 'Male', '', '', '', 'AK1190058', '$2y$10$8k4f1K96M2W4.px5SzfReuqJOKvwNY8zExf.yBUkVU4FWa1MJrIQS', 'intern', 8),
(124, '', NULL, 'Apquiz', 'John Lorenz', NULL, NULL, 'Male', '', '', '', 'AJ1200083', '$2y$10$fe3y0/hqJtWiAGIhoSa6JOhG75EbVALKd/CXseRe.G5924Ln9MvJ6', 'intern', 8),
(125, '', NULL, 'Arambulo', 'Joshua', NULL, NULL, 'Male', '', '', '', 'AJ1200146', '$2y$10$0PJYruK20XX/CYgTq2zDTOhcHoNaU.OZ6ogkZJRKaue5ytAgCRPHC', 'intern', 8),
(126, '', NULL, 'Balquin', 'Gerald', NULL, NULL, 'Male', '', '', '', 'BG1200027', '$2y$10$eoLDwyybjeblotYdrU.8UuEP1TTNyUYrtdxJCtkLUK3OPUxHU1.xW', 'intern', 8),
(127, '', NULL, 'Carteciano', 'Mj Bryan', NULL, NULL, 'Male', '', '', '', 'CM1210016', '$2y$10$kgU45zhBNDKafH/k7u6K8OsshmxfsxP//BP0ZsSLISQr.jDKGu/l2', 'intern', 8),
(128, '', NULL, 'Cledera', 'Dulce Maria', NULL, NULL, 'Female', '', '', '', 'CD1200086', '$2y$10$Qu384V7ESIvoY5npVAxb9uKoo5jSVWNu5OxfrTQjk7/Pm0.7rN.yG', 'intern', 8),
(129, '', NULL, 'Coronel', 'John Lenard', NULL, NULL, 'Male', '', '', '', 'CJ1190077', '$2y$10$9m9azmUbDD9UwgRRWCzwNuE5MTFPw3WhdTKNoWc/QgGMaF/PEshu2', 'intern', 8),
(130, '', NULL, 'Corsame', 'John Genesis', NULL, NULL, 'Male', '', '', '', 'CJ1200011', '$2y$10$s/z2sMn30sfRNM8Xff9kO.2CZpVRiWWSsJBumtph8BIJWt0spIpw2', 'intern', 8),
(131, '', NULL, 'Curilan', 'Ruth', NULL, NULL, 'Female', '', '', '', 'CR1200155', '$2y$10$ljfEGDy3fyeibKqEj.Fupe/uGm8/BgVyfBifojUzFTKgUhVd8CP3W', 'intern', 8),
(132, '', NULL, 'Dacoroon', 'Jade Maureen', NULL, NULL, 'Female', '', '', '', 'DJ1200149', '$2y$10$Tdm727IcdV59/YiRkaYoue93cV6q7mincMrnDlV1fTdt4qIpFG4sy', 'intern', 8),
(133, '', NULL, 'Dela Cueva', 'Jose Gabriel', NULL, NULL, 'Male', '', '', '', 'DJ1170033', '$2y$10$nomaDm/VDVaWb0iTA5my9u0MKz2UQm0hr85PX5CdDM8SUWkWb4i1y', 'intern', 8),
(134, '', NULL, 'Dichoso', 'Jerold', NULL, NULL, 'Male', '', '', '', 'DJ1200065', '$2y$10$wGkpEf.qdaxmih3hzqB02.U8gU.vEvXr4kgJvHfi1sCcM1kqS51Gq', 'intern', 8),
(135, '', NULL, 'Ebro', 'Anne Geline', NULL, NULL, 'Female', '', '', '', 'EA1200203', '$2y$10$uVmsl3.iBiR5CBQ5Fv5QeOUR/VBQVSfpea0vuEECpv3aaNRWvdvt6', 'intern', 8),
(136, '', NULL, 'Fernandez', 'Rean', NULL, NULL, 'Male', '', '', '', 'FR1200200', '$2y$10$qYH39s0Knb/Q6hjLe8HiMu4hA4YTmu36w/kskD3sknhwI9IEFK2uS', 'intern', 8),
(137, '', NULL, 'Francisco', 'Vince Andrie', NULL, NULL, 'Male', '', '', '', 'FV1200186', '$2y$10$qYl8mpNILW7gTCr/6kn4auuk0Qey7tlUmTnOksc3PraM5WeoYrm2u', 'intern', 8),
(138, '', NULL, 'Jaspio', 'Jhomell', NULL, NULL, 'Male', '', '', '', 'JJ1200125', '$2y$10$89izZ7v/qhYRHnWYi2yLkexO2jETFcm2XvJFg5WywMMRm8A4B2vBy', 'intern', 8),
(139, '', NULL, 'Labangco', 'Angelyn', NULL, NULL, 'Female', '', '', '', 'LA1200138', '$2y$10$BPofFfVWWby0IgFZjdmjy.tp9Hxw2lF5GLyPPY43OXRd8z2crVR96', 'intern', 8),
(140, '', NULL, 'Labangco', 'Michaela', NULL, NULL, 'Female', '', '', '', 'LM1200145', '$2y$10$J9BIXl7oPQIUaWsiRGMA1O3Gd/FctsnG/dCWPVAZRoleykv7UsQOK', 'intern', 8),
(141, '', NULL, 'Labao', 'Queen Real', NULL, NULL, 'Female', '', '', '', 'LQ1200004', '$2y$10$zvMDRmQrSqJSUr4QSaUBNu4qRxV/PM4htk7FeJg3vbTbgEPR/Az2.', 'intern', 8),
(142, '', NULL, 'Laserna', 'Rency Gerard', NULL, NULL, 'Male', '', '', '', 'LR1200096', '$2y$10$/SMNWWhpgoJp72gjfwTzN.CFxgSP86g2trSYqg3PAU6igv2F2g95y', 'intern', 8),
(143, '', NULL, 'Lucas', 'Pablo III', NULL, NULL, 'Male', '', '', '', 'LP1160042', '$2y$10$0CiN73IuCiVEnUSfBkz1du9zk5.BwXaQ7fzs99Hkuseg31PdF/IY.', 'intern', 8),
(144, '', NULL, 'Marasigan', 'Jomheldz Prince', NULL, NULL, 'Male', '', '', '', 'MJ1200049', '$2y$10$YT.tjUixaIL44VZN4dkbKucRAZVAFRg9dnIzX4d60giMYlz2kuhQO', 'intern', 8),
(145, '', NULL, 'Mercado', 'Kyle Brian', NULL, NULL, 'Male', '', '', '', 'MK1200094', '$2y$10$dSa/vTx4BTlvs/ItHkP8L.qC7sPFRHV0yxUDJjloZ73NGRBApH4je', 'intern', 8),
(146, '', NULL, 'Menoza', 'John Oscar', NULL, NULL, 'Male', '', '', '', 'MJ1190303', '$2y$10$exKC37R1tVMO9iHyYSSVre6pzNJ1nH4fBW9g12gjo1VVMv.xGtC3S', 'intern', 8),
(147, '', NULL, 'Morallos', 'Shara Mae', NULL, NULL, 'Female', '', '', '', 'MS1200044', '$2y$10$vpCzEwdfDND3ToJ9Aq68AO6B9w7W5uq.FPwx8qvyOtyTzUejkb7nG', 'intern', 8),
(148, '', NULL, 'Moreno', 'King Cedric', NULL, NULL, 'Male', '', '', '', 'MK1190343', '$2y$10$B4ODSe522P6meKPTGL/XJ.uW9UY6iMVGMTZ53OW7jKvNvyWt2tAlC', 'intern', 8),
(149, '', NULL, 'Patal', 'Marvin', NULL, NULL, 'Male', '', '', '', 'PM2210005', '$2y$10$DcSQPa6d7/m1xg/pZEMlCe2jI3TLb/gyfKh7Ip6ZcSIes6ZYxmIZG', 'intern', 8),
(150, '', NULL, 'Punongbayan', 'Nhiel Bryan', NULL, NULL, 'Male', '', '', '', 'PN1190245', '$2y$10$BjV.XSPyfoero2NTacAybeRKE6Oi.mOk/FKz1TyEiOlfHd6xFHlv.', 'intern', 8),
(151, '', NULL, 'Reporte', 'Vic', NULL, NULL, 'Male', '', '', '', 'RV1190094', '$2y$10$TusJFAGgT1mjCwPXlwbf5.yEaqO4Cx6yLMpKzV1iLYP1.1Q22VZ42', 'intern', 8),
(152, '', NULL, 'Sales', 'Aleahbel', NULL, NULL, 'Female', '', '', '', 'SA1190174', '$2y$10$Teu2f7YW8uodRqe0ZVWJeuyfZzjh1tgbuuREBJyawQuflZPHh95d2', 'intern', 8),
(153, '', NULL, 'Sayat', 'Kyla Mitch', NULL, NULL, 'Female', '', '', '', 'SK1190078', '$2y$10$MNsv6z.JirT4pgpU/qVmY.F63rNqHVf4xkaretlxRmZduMNRqUPx6', 'intern', 8),
(154, '', NULL, 'Villamor', 'John Rey', NULL, NULL, 'Male', '', '', '', 'VJ1200111', '$2y$10$R3mpuppxe9iEJ6iX5L2l9e9x1JpASQEPt6N/rdmgdGJETw4GlFI5.', 'intern', 8),
(155, '', NULL, 'Yuzon', 'Jigendille', NULL, NULL, 'Male', '', '', '', 'YJ1190155', '$2y$10$ogVC1DmFze5icUdeq2GBAuWRRlgsJD7gTJ2lFXSmLok9BOCT4QSMG', 'intern', 8);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_reports`
--

CREATE TABLE `weekly_reports` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) DEFAULT NULL,
  `report_type` enum('pdf','jpeg') NOT NULL,
  `report_file` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `coordinator_evaluations`
--
ALTER TABLE `coordinator_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coordinator_id` (`coordinator_id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `final_grades`
--
ALTER TABLE `final_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `rendered_hours`
--
ALTER TABLE `rendered_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `report_approvals`
--
ALTER TABLE `report_approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor_id` (`supervisor_id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `coordinator_id` (`coordinator_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `supervisor_evaluations`
--
ALTER TABLE `supervisor_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor_id` (`supervisor_id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`);

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
-- AUTO_INCREMENT for table `coordinator_evaluations`
--
ALTER TABLE `coordinator_evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `final_grades`
--
ALTER TABLE `final_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `rendered_hours`
--
ALTER TABLE `rendered_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_approvals`
--
ALTER TABLE `report_approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisor_evaluations`
--
ALTER TABLE `supervisor_evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `coordinator_evaluations`
--
ALTER TABLE `coordinator_evaluations`
  ADD CONSTRAINT `coordinator_evaluations_ibfk_1` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coordinator_evaluations_ibfk_2` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `final_grades`
--
ALTER TABLE `final_grades`
  ADD CONSTRAINT `final_grades_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `interns_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rendered_hours`
--
ALTER TABLE `rendered_hours`
  ADD CONSTRAINT `rendered_hours_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report_approvals`
--
ALTER TABLE `report_approvals`
  ADD CONSTRAINT `report_approvals_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_approvals_ibfk_2` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requirements_ibfk_2` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinators` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisor_evaluations`
--
ALTER TABLE `supervisor_evaluations`
  ADD CONSTRAINT `supervisor_evaluations_ibfk_1` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supervisor_evaluations_ibfk_2` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `weekly_reports`
--
ALTER TABLE `weekly_reports`
  ADD CONSTRAINT `weekly_reports_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
