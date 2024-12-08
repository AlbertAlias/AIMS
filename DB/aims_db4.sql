-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 05:54 AM
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
(5, 140),
(6, 141),
(7, 142),
(8, 143),
(9, 144),
(10, 145),
(11, 146),
(12, 147),
(13, 148);

-- --------------------------------------------------------

--
-- Table structure for table `department_dean`
--

CREATE TABLE `department_dean` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_dean`
--

INSERT INTO `department_dean` (`id`, `department_name`, `user_id`) VALUES
(6, 'BSIT', 122),
(7, 'BSCPE', 123),
(11, 'BSCRIM', 127),
(13, 'BSTM', 134),
(14, 'BSA', 135),
(15, 'BSE', 136),
(16, 'BSBA', 137),
(17, 'BSCS', 138),
(18, 'BSHM', 139);

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
(129, 208, '1-123567'),
(130, 209, '1-123568'),
(131, 210, '1-123569'),
(132, 211, '1-123570'),
(133, 212, '1-123571'),
(134, 213, '1-123572'),
(135, 214, '1-123573'),
(136, 215, '1-123574'),
(137, 216, '1-123575'),
(138, 217, '1-123576'),
(139, 218, '1-123577'),
(140, 219, '1-123578'),
(141, 220, '1-123579'),
(142, 221, '1-123580'),
(143, 222, '1-123581'),
(144, 223, '1-123582'),
(145, 224, '1-123583'),
(146, 225, '1-123584'),
(147, 226, '1-123585'),
(148, 227, '1-123586'),
(149, 228, '1-123587'),
(150, 229, '1-123588'),
(151, 230, '1-123589'),
(152, 231, '1-123590'),
(153, 232, '1-123591'),
(154, 233, '1-123592'),
(155, 234, '1-123593'),
(156, 235, '1-123594'),
(157, 236, '1-123595');

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
(6, 'Resume', 'Due to Tomorow', '2024-12-07 03:44:22');

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

--
-- Dumping data for table `student_submissions`
--

INSERT INTO `student_submissions` (`id`, `student_id`, `requirement_id`, `submitted_documents`, `submitted_at`) VALUES
(2, 1, 6, 'C:\\fakepath\\EDTD_(FINAL)GROUP 9_ CAPSTONE CHAPTER 1 to 5 (1).pdf', '2024-12-07 04:05:21');

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
(1, '', NULL, 'alias', 'albert', NULL, NULL, '', '', 'it', '$2y$10$dwY/qMJfYueBEagEJlzJ6.vHWqInONX862GfhVXURI8s.nvGDxmd2', 'it', NULL),
(122, '', NULL, 'Tuazon', 'Rozaida', NULL, NULL, '', '', 'itdean', '$2y$10$yHOBGzJKsU4JJsHoSvx.qOfyEc5F8qGIfXu4v0P3sHU9jzOxGWrpS', 'dean', NULL),
(123, '', NULL, 'Catherene', 'Oliva', NULL, NULL, '', '', 'cpedean', '$2y$10$msdRdBAhiSC1wCOj2.BFHOZ/Vim3zgcaa/yVoAH/bNaogDrsCrb/.', 'dean', NULL),
(127, '', NULL, 'Guevarra', 'Gerald', NULL, NULL, '', '', 'crimdean', '$2y$10$fqujNlNBYcxCqnbD47/3.OEMbUKOZBrKwTN0hQpuV9Zrrz4gg60Oe', 'dean', NULL),
(134, '', NULL, 'Maann', 'Guevarra', NULL, NULL, '', '', 'tmdean', '$2y$10$LZl7h4ikZxBb0gPo7xvLF.T/7iv3YYXw3PO1yBlAQQtRp4LgkOWIq', 'dean', NULL),
(135, '', NULL, 'Tacker', 'Lenlen', NULL, NULL, '', '', 'adean', '$2y$10$ZLI1sTpZjMy8mQp4t1FVxujSQVX0/BAqrSOibGHbrs6fB05ttwfGO', 'dean', NULL),
(136, '', NULL, 'Balauag', 'Goerge', NULL, NULL, '', '', 'edean', '$2y$10$LjL7raD/Bhxdqun9aFLzAuXa5cewWDnr0LWoTiVN5AAn8hn8Kxu0C', 'dean', NULL),
(137, '', NULL, 'Esteban', 'Lolit', NULL, NULL, '', '', 'badean', '$2y$10$BnrprM54eiaNXG9BBrEtte067HLrHe1pMmXYdISzuJ/wlThF5atam', 'dean', NULL),
(138, '', NULL, 'Marco', 'Guevara', NULL, NULL, '', '', 'csdean', '$2y$10$Bq/SX5in0d2Yikghw/EHW.LGhAZRJJIPx.N.hVZqXi5bVX5ElM5Ki', 'dean', NULL),
(139, '', NULL, 'Dinio', 'dindo', NULL, NULL, '', '', 'hmdean', '$2y$10$rDu/.7duZHlY4tUHARAUH.SH55IS66u4qeJiE.yLOT0EBDJAJJIiy', 'dean', NULL),
(140, '1234', NULL, 'Custodio', 'Bryan', 'G', NULL, 'pulong', 'bryan@gmail.com', 'acoor', '$2y$10$hmP/jDMdKWGKJWrb8V98SuarSuyibPYbtw132wOZr8ZzRdQoQCkSu', 'coordinator', 14),
(141, '1234', NULL, 'Alias', 'Albert', 'P', NULL, 'butong', 'Albert@gmail.com', 'bacoor', '$2y$10$FooplXSf2TsKvssuuR2VNeAJ/lcE8Kv0Fy/k4d9xcTYtOPE.0Ul2u', 'coordinator', 16),
(142, '2133', NULL, 'Balauag', 'George', 'na', NULL, 'sv69', 'Balauag@gmail.com', 'cpecoor', '$2y$10$apvkGgrHxm5NITS83prl1O1jGVeypvWj4Ve6QmbOgsSu.0BWrqZKC', 'coordinator', 7),
(143, '1234', NULL, 'Arroyo', 'Justin', 'M', NULL, 'Macabling', 'Arroyo@gmail.com', 'crimcoor', '$2y$10$/m.tPxiXqt3tURYVWVHXC.Ke2X/7IfTa0bsWSYdA4Ic9O4H952TX.', 'coordinator', 11),
(144, '1234', NULL, 'Tibayan', 'Aaron', 'B', NULL, 'Butonggs', 'Tibayan@gmail.com', 'cscoor', '$2y$10$bbdJ05zZXKDDpoW7yW7qrOGzwhk/.DLgoV5i75GX8WjIVcqmwGS3G', 'coordinator', 17),
(145, '1234', NULL, 'Lumor', 'Catrina', 'A', NULL, 'Butongs', 'Lumor@gmail.com', 'ecoor', '$2y$10$Xyo74Rp8hmWVdWFdug/s.uNyxS1s537XoIrceR2sazxf16DOwqa02', 'coordinator', 15),
(146, '12342', NULL, 'nicer', 'archie', 'b', NULL, 'Cabuyao', 'Nicer@gmail.com', 'hmcoor', '$2y$10$FWjgkWjJAi6Mbx0zRkuBSO6oh3tpEXbC5cmAK4fToqHdddMb0SeQe', 'coordinator', 18),
(147, '6996', NULL, 'Alias', 'Lovely', 'Galang', NULL, 'Butongggs', 'Alias@gmail.com', 'itcoor', '$2y$10$hSdy5fbu9tauirx7ETbGI.aJw9HGLer6cssjXTQ1TkGg.lwA4n9pG', 'coordinator', 6),
(148, '2312', NULL, 'Talibsao', 'Gaytee', 'B', NULL, 'Aplaya', 'Talibsao@gmail.com', 'tmcoor', '$2y$10$JIreaofSalULZt2lU5aw1Ocz0AbR76qRstay62mPkm4RHqD43pOqG', 'coordinator', 13),
(208, '', NULL, 'Mary', 'Elizabeth', NULL, 'Male', '', '', '112233', '$2y$10$mTpGOIzLBg5WF.Etj9X8ae2enoqwR7ZAuMiktYaFjFbAV2N4AdA3K', 'student', 11),
(209, '', NULL, 'Doe', 'John', NULL, 'Female', '', '', '112234', '$2y$10$pvBdZN1Ns9neKbKrKHpxpuM9aea9eg/feooqECEzQQgVnsCEXE7qK', 'student', 11),
(210, '', NULL, 'Kennedy', 'Jhon', NULL, 'Male', '', '', '112235', '$2y$10$4LWaxApZCeTz56x2t6.22eUz3XvrrktaXK2FndIREAWD3tZY374/m', 'student', 11),
(211, '', NULL, 'Rid ', 'Joseph', NULL, 'Male', '', '', '112236', '$2y$10$4cFhAGAbXcJ78XmV1So3RevZ/qGNwqHw/IxhHINfdlUaF35dcpiIu', 'student', 6),
(212, '', NULL, 'Geo', 'Lester', NULL, 'Male', '', '', '112237', '$2y$10$g5Lu8r.gE8oDEBrFS/2ki.RzpRDB98jXI72kPhghyVIe0lYLI8V7K', 'student', 6),
(213, '', NULL, 'will', 'ford', NULL, 'Male', '', '', '112238', '$2y$10$B2fKLppEV7v70NOeqnja8uF09uDoDIXqW2hzlDAtnYQOz34d5d4zK', 'student', 6),
(214, '', NULL, 'gil', 'albert', NULL, 'Male', '', '', '112239', '$2y$10$4Yyo6vkQZXDMZ28LtR/5I.bdbQaBqbFe1XjavlGLq.ZLdaBJ7GU86', 'student', 7),
(215, '', NULL, 'max', 'collins', NULL, 'Female', '', '', '112240', '$2y$10$csFjXMmybRlkOkvlpdDny.3gtfWHqS2ClAT0hnBflaU9YsRDTi0Vq', 'student', 7),
(216, '', NULL, 'mil', 'Clyde', NULL, 'Male', '', '', '112241', '$2y$10$lAUzGqHKPI8XfBFtD9zZwuH79DV6N3jeZknQ7eonV8evUHzjT/Sxe', 'student', 7),
(217, '', NULL, 'men', 'ture', NULL, 'Male', '', '', '112242', '$2y$10$T/YHAO0YcBzVje7Nu1qkHuP6xeMm6wW5BS4VE8PN3vHQkzoMx/ljq', 'student', 17),
(218, '', NULL, 'bry', 'Col', NULL, 'Female', '', '', '112243', '$2y$10$ciolt.3cpXUpEshhDmWVru0kC6NTFYg7lFdgtdO8wShU0vzkSGEsi', 'student', 17),
(219, '', NULL, 'cren', 'Cin', NULL, 'Female', '', '', '112244', '$2y$10$0T.XbCM5SN4M43jkttkplOb0rRvmwmZXtlxxR2E8uRdLpHMjByn7q', 'student', 17),
(220, '', NULL, 'Cron', 'Cen', NULL, 'Male', '', '', '112245', '$2y$10$zpmqUtKKUvB7.JgsgCTEguIx/zQNc.cYBgpv4xuA2OpL5B4Lf8ftS', 'student', 13),
(221, '', NULL, 'gen', 'Der', NULL, 'Male', '', '', '112246', '$2y$10$8qeXtXh8chMW2OO3fVOQ4.yF80Xqw7wYseLp1VqQOa4GSUK3Fr8bq', 'student', 13),
(222, '', NULL, 'git', 'Get', NULL, 'Female', '', '', '112247', '$2y$10$xacMgUFTbewmfmRjrQaxseWmwDabxi8WH2VeLfDzU7Ofcuc4js7x6', 'student', 13),
(223, '', NULL, 'Gat', 'Got', NULL, 'Male', '', '', '112248', '$2y$10$hYejH8VK5gEWnR58BbbimeiRC0N2T2l./tj3bpc.5/K4PopUO44Y.', 'student', 18),
(224, '', NULL, 'tik', 'Tak', NULL, 'Male', '', '', '112249', '$2y$10$FEqgexClWavOOSjJnlYIqu1RrOam.jdktYxHVfiQv1.LT7OCXM6WG', 'student', 18),
(225, '', NULL, 'Tuk', 'Tok', NULL, 'Male', '', '', '112250', '$2y$10$gsTj8PQeVviX0MEhTjeXeOhIWVSh89dpMJLH6JKpnFaw8QgAZ3rJu', 'student', 18),
(226, '', NULL, 'Tek', 'Lik', NULL, 'Female', '', '', '112251', '$2y$10$T6UmARkghhpAnceZ8PFg2eBD/hdpyLunhrYqimCgukeFE31YRoYba', 'student', 16),
(227, '', NULL, 'Lak', 'Lek', NULL, 'Female', '', '', '112252', '$2y$10$Lxhtq/XcpuGN3I8g9P2YpeimtjZQnlN.jsEosEc33nkqqp4QoGFM2', 'student', 16),
(228, '', NULL, 'Luk', 'Lok', NULL, 'Female', '', '', '112253', '$2y$10$N5VQWMN6F3cHYgzJmfbH3e.CVl8D3QsJWXKTn4qLI7LLW.LM9Tg7C', 'student', 16),
(229, '', NULL, 'Man', 'Men', NULL, 'Male', '', '', '112254', '$2y$10$dj3mJnF8wfttpo6ErTZk1ujLvZzZiPDkZc.oDrhxxfUb5hbgPOnMi', 'student', 14),
(230, '', NULL, 'Min', 'Mon', NULL, 'Male', '', '', '112255', '$2y$10$19dGCuc.hfKkPpHpqw9b8OiK5JDaQEVUAFAWScOjWA6YjgR5jxpLq', 'student', 14),
(231, '', NULL, 'Mun', 'Nam', NULL, 'Male', '', '', '112256', '$2y$10$c1tGIm8gl0.bLLNMKOEFCeQxAYVrm2tE81RkleGcRK9Z9PTIeFuZy', 'student', 14),
(232, '', NULL, 'Nem', 'Nim', NULL, 'Male', '', '', '112257', '$2y$10$hz170fKJuqVjL6fVwl4PRugTytvGN77jc94pjqc1Tk9m161lL6k.a', 'student', 14),
(233, '', NULL, 'Nom', 'Num', NULL, 'Male', '', '', '112258', '$2y$10$amNHaxH5jQygF/2uYKxP8Ot.mCGwLCQ.JvP5WHb1ktWFG/uURbbBq', 'student', 15),
(234, '', NULL, 'Kan', 'Ken', NULL, 'Female', '', '', '112259', '$2y$10$SRlFflYtRQVvjI/CWB95YOzyNpLMFbjJRVWtKVchG4vb74Y4cX1bq', 'student', 15),
(235, '', NULL, 'Kin', 'Kon', NULL, 'Male', '', '', '112260', '$2y$10$/ZSDDcdmHa1R06uW4R6qO.ZeBsn1H9.xjjxVZrREyExh6.SOPOpty', 'student', 15),
(236, '', NULL, 'Kun', 'Far', NULL, 'Male', '', '', '112261', '$2y$10$cS6PR8fb6oQBWUSWihfd4uluGCtPKCSpoUIIR.SEzZvTvl/J/d1e6', 'student', 15);

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
-- Indexes for table `department_dean`
--
ALTER TABLE `department_dean`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD UNIQUE KEY `user_id` (`user_id`);

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
  ADD KEY `requirement_id` (`requirement_id`);

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department_dean`
--
ALTER TABLE `department_dean`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `student_requirements`
--
ALTER TABLE `student_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_submissions`
--
ALTER TABLE `student_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD CONSTRAINT `coordinators_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department_dean`
--
ALTER TABLE `department_dean`
  ADD CONSTRAINT `department_dean_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `student_submissions_ibfk_1` FOREIGN KEY (`requirement_id`) REFERENCES `student_requirements` (`id`);

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
