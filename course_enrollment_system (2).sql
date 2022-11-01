-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 08:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_enrollment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) NOT NULL,
  `courseName` varchar(250) NOT NULL,
  `maxStudents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `courseName`, `maxStudents`) VALUES
(1, 'PSY 101: Intro to Psychology', 3),
(2, 'INT 301: Networking', 3),
(3, 'CST 313: Software Testing', 5),
(4, 'CPT 307: Introduction to Python', 5),
(5, 'CPT 312: Java in the real world', 3),
(6, 'CST 310: Software Development', 5);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `offering_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `student_id`, `offering_id`) VALUES
(158, 1, 6),
(163, 2, 7),
(164, 2, 4),
(165, 2, 12),
(167, 2, 20),
(168, 2, 9),
(169, 3, 1),
(170, 3, 2),
(171, 3, 3),
(172, 3, 14),
(173, 3, 19),
(174, 3, 17),
(175, 4, 1),
(176, 4, 6),
(177, 4, 13),
(178, 4, 17),
(179, 4, 19),
(180, 4, 21),
(181, 5, 3),
(182, 5, 4),
(183, 5, 5),
(184, 5, 20),
(185, 5, 21),
(186, 5, 16),
(187, 6, 11),
(188, 6, 10),
(189, 6, 12),
(190, 6, 9),
(191, 6, 8),
(192, 6, 16),
(193, 7, 1),
(194, 7, 6),
(195, 7, 13),
(196, 7, 17),
(197, 7, 19),
(198, 7, 21),
(199, 8, 20),
(200, 8, 18),
(201, 8, 12),
(202, 8, 13),
(203, 8, 8),
(204, 8, 7),
(205, 9, 6),
(206, 9, 12),
(207, 9, 10),
(208, 9, 21),
(209, 9, 20),
(210, 9, 5),
(216, 1, 14),
(217, 1, 20),
(218, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `offering_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE `offering` (
  `offering_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `year` year(4) NOT NULL,
  `semester` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offering_id`, `course_id`, `year`, `semester`) VALUES
(1, 1, 2023, 'Summer'),
(2, 1, 2023, 'Fall'),
(3, 1, 2023, 'Spring'),
(4, 1, 2023, 'Summer'),
(5, 1, 2023, 'Fall'),
(6, 2, 2023, 'Fall'),
(7, 2, 2023, 'Spring'),
(8, 2, 2023, 'Fall'),
(9, 3, 2023, 'Summer'),
(10, 3, 2023, 'Spring'),
(11, 3, 2023, 'Summer'),
(12, 4, 2023, 'Summer'),
(13, 4, 2023, 'Fall'),
(14, 4, 2023, 'Spring'),
(15, 4, 2023, 'Summer'),
(16, 4, 2023, 'Fall'),
(17, 5, 2023, 'Fall'),
(18, 5, 2023, 'Fall'),
(19, 6, 2023, 'Fall'),
(20, 6, 2023, 'Spring'),
(21, 6, 2023, 'Fall');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `degree` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `email`, `password`, `firstName`, `lastName`, `address`, `phone`, `degree`) VALUES
(1, 'Goku@hotmail.com', 'dbz1', 'Goku', 'Kakarot', '456 Dragon Path Ln Other World PA 12345', '111-111-1111', 'B.A. in ultra Instinct'),
(2, 'Vegeta@hotmail.com', 'dbz2', 'Vegeta', 'Prince', '101 W main st World tournament Ohio 45678', '222-222-2222', 'B.S. in world ruling'),
(3, 'Trunks@hotmail.com', 'dbz3', 'Trunks', 'Fav', '300 training cir Pittsburgh PA 17290', '333-333-3333', 'B.S. in sword combat'),
(4, 'Gohan@hotmail.com', 'dbz4', 'Gohan', 'Goat', '6795 Nimbus Ln Yahhoy City NV 75373', '444-444-4444', 'B.A. in world savior'),
(5, 'Goten@hotmail.com', 'dbz5', 'Goten', 'Young', '73637 Toasty Rd Fire Village PA 18621', '555-555-5555', 'B.S. in fusion'),
(6, 'Beerus@hotmail.com', 'dbz6', 'Beerus', 'God', '7345 universe 7 Rd West City FL 65985', '666-666-6666', 'B.A. in destruction'),
(7, 'Broly@hotmail.com', 'dbz7', 'Broly', 'Best', '1987 Swole Ct Bulk City IL 59852', '777-777-7777', 'B.A. in strongest fighter'),
(8, 'Frieza@hotmail.com', 'dbz8', 'Frieza', 'Wrecked', '5896 Sayain Blvd Universe 6 OH 58624', '888-888-8888', 'B.A. in World Destruction'),
(9, 'Krillin@hotmail.com', 'dbz9', 'Krillin', 'Android', '2345 Apple Blossom Dr Erie Pa 25653', '999-999-9999', 'B.S. in Training');

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

CREATE TABLE `waitlist` (
  `waitlist_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `offering_id` int(10) NOT NULL,
  `dateTimeAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waitlist`
--

INSERT INTO `waitlist` (`waitlist_id`, `student_id`, `offering_id`, `dateTimeAdded`) VALUES
(1, 2, 6, '2022-10-21 22:02:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `offering_id` (`offering_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `offering_id` (`offering_id`);

--
-- Indexes for table `offering`
--
ALTER TABLE `offering`
  ADD PRIMARY KEY (`offering_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `waitlist`
--
ALTER TABLE `waitlist`
  ADD PRIMARY KEY (`waitlist_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `offering_id` (`offering_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offering`
--
ALTER TABLE `offering`
  MODIFY `offering_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `waitlist`
--
ALTER TABLE `waitlist`
  MODIFY `waitlist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `offering`
--
ALTER TABLE `offering`
  ADD CONSTRAINT `offering_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `waitlist`
--
ALTER TABLE `waitlist`
  ADD CONSTRAINT `waitlist_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `waitlist_ibfk_2` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
