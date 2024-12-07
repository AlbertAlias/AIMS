-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 11:03 PM
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
(1, 7);

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
(2, 'Information Technology', 3);

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
(8, 15, '1-200086'),
(9, 16, '1-190077'),
(10, 17, '1-200011'),
(11, 18, '1-200155'),
(12, 19, '1-200149'),
(13, 20, '1-170033'),
(14, 21, '1-200065'),
(15, 22, '1-200203'),
(16, 23, '1-200200'),
(17, 24, '1-200186'),
(18, 25, '1-200125'),
(19, 26, '1-200138'),
(20, 27, '1-200145'),
(21, 28, '1-200004'),
(22, 29, '1-200096'),
(23, 30, '1-160042'),
(24, 31, '1-200049'),
(25, 32, '1-200094'),
(26, 33, '1-190303'),
(27, 34, '1-200044'),
(28, 35, '1-190343'),
(29, 36, '2-210005'),
(30, 37, '1-190245'),
(31, 38, '1-190094'),
(32, 39, '1-190174'),
(33, 40, '1-190078'),
(34, 41, '1-200111'),
(35, 42, '1-190155');

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
(3, '', NULL, 'Balauag', 'George', NULL, NULL, '', '', 'dean', '$2y$10$K1hJjx3wclASVh9czFssjerVT3BowjYCNbnYSOCGDIQ/XxsKgQ7LO', 'dean', NULL),
(7, '12345', NULL, 'Custodio', 'Bryan', 'bry', NULL, 'bry', 'bry@gmail.com', 'coor', '$2y$10$hrfjrjZD2MX.O31uyaxEi.8Me/HdimhdKML6R7IED1YRcuGIRud3a', 'coordinator', 2),
(8, '', NULL, 'Abella', 'Adriane Paul', NULL, 'Male', '', '', '1190302', '$2y$10$8ccoGvCFTwdgI/toXZfy0OJGpr/9RiSlPjIr/rk.4f2.Ic5xTGB3q', 'student', 2),
(9, '', NULL, 'Abellano', 'Dynarose', NULL, 'Female', '', '', '1200043', '$2y$10$J5MOg120r9FoalJQIlmfBegivnnN2Z19zyj/4h8vHW.QTopCulYcC', 'student', 2),
(10, '', NULL, 'Alaurin', 'Karl Dominic', NULL, 'Male', '', '', '1190058', '$2y$10$EtebV7DUcqo5MRmZypmSluo.bVC1LanC2L6nSsXM4zX47PbTOaSQe', 'student', 2),
(11, '', NULL, 'Apquiz', 'John Lorenz', NULL, 'Male', '', '', '1200083', '$2y$10$3F8SzPvJS/S5o/q0Dke9Ze75avS2EazgKSLI215kf1MfdNEeSHHpW', 'student', 2),
(12, '', NULL, 'Arambulo', 'Joshua', NULL, 'Male', '', '', '1200146', '$2y$10$HWvbSv1Aent.sIYRH.VMyuy.6fnZbvjBitiRFeVD7FjE.VzAXEU5q', 'student', 2),
(13, '', NULL, 'Balquin', 'Gerald', NULL, 'Male', '', '', '1200027', '$2y$10$urhXco2KY1s/lknBmgU5a.mrfEovGKk5J3/CbskvS0Th6OlGPyILi', 'student', 2),
(14, '', NULL, 'Carteciano', 'Mj Bryan', NULL, 'Male', '', '', '1210016', '$2y$10$GYiu4cOR9UaQ8RdrmaNFdunrGEDfSmP.cTIsD.uYt55XEA.ckn.8C', 'student', 2),
(15, '', NULL, 'Cledera', 'Dulce Maria', NULL, 'Female', '', '', '1200086', '$2y$10$lO6MO3YDyttnLbhUdkU83eBBBk/i3t6g/aQsnlWPA5qgkiqJEdhQ2', 'student', 2),
(16, '', NULL, 'Coronel', 'John Lenard', NULL, 'Male', '', '', '1190077', '$2y$10$BUjO92na6VFpEK6VsYLxku9CCiku5dvlKizh2ZwmDMaUeUhu8G06u', 'student', 2),
(17, '', NULL, 'Corsame', 'John Genesis', NULL, 'Male', '', '', '1200011', '$2y$10$zj/SKmuY2TQPKHZXtqtQAenuHBq/ULNSYDk33Oqd.GCsCexxqs5O.', 'student', 2),
(18, '', NULL, 'Curilan', 'Ruth', NULL, 'Female', '', '', '1200155', '$2y$10$i2bcr2hSAyKJOLgvYP8haeGAw2lImWIxz4TJbd2OZD6EQOQXo1nw.', 'student', 2),
(19, '', NULL, 'Dacoroon', 'Jade Maureen', NULL, 'Female', '', '', '1200149', '$2y$10$vq09S9b/Vc/OqYaTnqHbEO.5puEL9ngPUrcaP87S/n5W6bMUngDKm', 'student', 2),
(20, '', NULL, 'Dela Cueva', 'Jose Gabriel', NULL, 'Male', '', '', '1170033', '$2y$10$7Od1GGr0gooOlF7Qepy0Nu3r9KJsxMWCHufjpGUo/LwehM464YsMy', 'student', 2),
(21, '', NULL, 'Dichoso', 'Jerold', NULL, 'Male', '', '', '1200065', '$2y$10$.llNhS5N3kUlntwdXI2UkuaScp9Zd2mPE5vZ/J2E.o53mKM21u..e', 'student', 2),
(22, '', NULL, 'Ebro', 'Anne Geline', NULL, 'Female', '', '', '1200203', '$2y$10$f6SlM6gCzOeFF4Q.b8j5OOYR7VrKyKbY9KbKUNlHnn3egiUrh2ZoS', 'student', 2),
(23, '', NULL, 'Fernandez', 'Rean', NULL, 'Male', '', '', '1200200', '$2y$10$bhou93AHhyCk0X7S/eQ/UeDh0DqNJ1375Oc6JtseBbYx0PeRciKI.', 'student', 2),
(24, '', NULL, 'Francisco', 'Vince Andrie', NULL, 'Male', '', '', '1200186', '$2y$10$/GbWmYITJo8bgmkKbScSjOxZMxrzrVyKzi6E8JaMzm1VHsvbqFnx.', 'student', 2),
(25, '', NULL, 'Jaspio', 'Jhomell', NULL, 'Male', '', '', '1200125', '$2y$10$XI4aU2Y9zovMU2LqakBvX.9cyPjiLG8/ngzP1J2KQTN5xwmhFzO0S', 'student', 2),
(26, '', NULL, 'Labangco', 'Angelyn', NULL, 'Female', '', '', '1200138', '$2y$10$Ce76iTC5NYosiM3uxKHh2OYuCtsE6nvmo34T1Cxzk8AHNo19vJ8aC', 'student', 2),
(27, '', NULL, 'Labangco', 'Michaela', NULL, 'Female', '', '', '1200145', '$2y$10$r2Cgyb7Q870LCrKeTO66m.qWe/OAkZiLzS9UNVXwI5z1xXG6LSIUC', 'student', 2),
(28, '', NULL, 'Labao', 'Queen Real', NULL, 'Female', '', '', '1200004', '$2y$10$o9L1TR6Vse.6Dt7xWocB.eIZ8APPYrjqz1yjCRXlh2RAEsLEHg/bG', 'student', 2),
(29, '', NULL, 'Laserna', 'Rency Gerard', NULL, 'Male', '', '', '1200096', '$2y$10$1KE1oMQb9t.7L5dme1Qxk.bNeUzUV4w8fWZj.qlXD5hFbvvTBnF7q', 'student', 2),
(30, '', NULL, 'Lucas', 'Pablo III', NULL, 'Male', '', '', '1160042', '$2y$10$l0wGyherJnMZvw9vIsn5h.AGvPEKfIY/WOOJamfHlNOummEMLjGiy', 'student', 2),
(31, '', NULL, 'Marasigan', 'Jomheldz Prince', NULL, 'Male', '', '', '1200049', '$2y$10$IHj.CiMnz.AqaqXSkRW9Vu8yFT/TPqSE4WBLlJjUTbiDjlZMekJVG', 'student', 2),
(32, '', NULL, 'Mercado', 'Kyle Brian', NULL, 'Male', '', '', '1200094', '$2y$10$Fdia5T7kWrGA/FL/11XFaukqWEwnMg3/QTXrI5uDKl.Ykah2v5hXW', 'student', 2),
(33, '', NULL, 'Menoza', 'John Oscar', NULL, 'Male', '', '', '1190303', '$2y$10$yAc6OpukA9CO3adDJ979EuOtVk69VtojdLAKySNPKQUue/kjs5glW', 'student', 2),
(34, '', NULL, 'Morallos', 'Shara Mae', NULL, 'Female', '', '', '1200044', '$2y$10$4etwNaq6G2bW1oBD2GHn4./TAk8C3RFavSt27t1KjfInbS/EDPCqe', 'student', 2),
(35, '', NULL, 'Moreno', 'King Cedric', NULL, 'Male', '', '', '1190343', '$2y$10$xe/CS1KQg2LaObNkoGBQ5.WneSY2hyez9fLsJxchybWHNKfpUZfyO', 'student', 2),
(36, '', NULL, 'Patal', 'Marvin', NULL, 'Male', '', '', '2210005', '$2y$10$xdxtuPk7WNLzmCxUDKzqbet1xZAlSds7msdb6dBuVr73wkA/72FYW', 'student', 2),
(37, '', NULL, 'Punongbayan', 'Nhiel Bryan', NULL, 'Male', '', '', '1190245', '$2y$10$xJCR0wQdp/6oz/FzSBuAc.iCGizyhSHP2mSQEgbLD5IsIi2ELKwFe', 'student', 2),
(38, '', NULL, 'Reporte', 'Vic', NULL, 'Male', '', '', '1190094', '$2y$10$CWmFg5dNJWopKHPmfAJZZuOntzfjtPvPsNWKhJRrmLKmuuJi2o4ym', 'student', 2),
(39, '', NULL, 'Sales', 'Aleahbel', NULL, 'Female', '', '', '1190174', '$2y$10$jFNKlpozXS6fLCfzBHWoguNn6iRp0UYCF70ph9f7gS6qPL0qfsT6G', 'student', 2),
(40, '', NULL, 'Sayat', 'Kyla Mitch', NULL, 'Female', '', '', '1190078', '$2y$10$8M0Q10UPir8ebQBhmPr8cOa5H8u51qaeVeJYDF/QKui.eKXCx8NZG', 'student', 2),
(41, '', NULL, 'Villamor', 'John Rey', NULL, 'Male', '', '', '1200111', '$2y$10$KQCq18z81GyAzewPiueiSuTBY3SoAIcgLYiUK2tstA/3PJHKx7B9u', 'student', 2),
(42, '', NULL, 'Yuzon', 'Jigendille', NULL, 'Male', '', '', '1190155', '$2y$10$HOQovGm7wn7rzHW0HOxTFePgTvq7jWEr5UUXHPKS4WDZWzW.OlwM.', 'student', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department_dean`
--
ALTER TABLE `department_dean`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registrar`
--
ALTER TABLE `registrar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
