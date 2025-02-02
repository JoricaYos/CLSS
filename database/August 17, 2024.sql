-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 07:56 AM
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
-- Database: `scheduling-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `role`, `status`, `username`, `password`, `img`) VALUES
(13, 'ImongNawngHello', 'Admin', 'active', 'admin', '$2y$10$WB1MoQwlsTH6vk4yp8FUpO8wQ7eiSsjU/2FngBEQZ7PXe.newFE.O', 'uploads/13/smcc-logo.png'),
(29, 'jam', 'student', 'active', 'student', '$2y$10$79y.m.8kF8DTK.LnRJrtjOGqFPO629xFr8dfP88BWP6hjcKWLbAAW', ''),
(31, 'dean', 'Dean/Principal', 'active', 'dean', '$2y$10$pW//bNoNobob6lqDAlOuheNlBvQ3q/8gL5bZtJbH8ANfwWxfXfyTC', ''),
(32, 'instructor', 'Instructor', 'active', 'instructor', '$2y$10$k72tcb1sVn.RdbllOqwI2eGyASJ2v8okec5VBUeDbk9DV94isrJWu', ''),
(33, 'custodian', 'Custodian', 'active', 'custodian', '$2y$10$iAGzDdsC2iZv89LCt/HY3uaTtz1Tz94ixckpFI73x96L/fh9FUbq2', '');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lab` varchar(255) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`id`, `title`, `lab`, `personnel_id`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(4, 'asd', 'lab1', 13, '2024-08-15', '2024-08-15', '09:56:00', '12:00:00'),
(5, 'meek', 'lab1', 13, '2024-08-17', '2024-08-17', '17:00:00', '20:00:00'),
(6, 'meymey', 'lab2', 13, '2024-08-08', '2024-08-08', '22:00:00', '23:00:00'),
(7, 'asd', 'lab2', 13, '2024-08-16', '2024-08-16', '08:01:00', '10:00:00'),
(8, '8', 'lab1', 13, '2024-08-15', '2024-08-15', '13:00:00', '15:00:00'),
(10, 'Try 2 day event', 'lab1', 13, '2024-08-15', '2024-08-17', '16:00:00', '19:00:00'),
(14, '', 'lab1', 13, '2024-08-16', '0000-00-00', '08:00:00', '10:00:00'),
(15, 'asd', 'lab4', 13, '2024-08-16', '0000-00-00', '13:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sched`
--

CREATE TABLE `sched` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `lab` varchar(255) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `semester_start` date NOT NULL,
  `semester_end` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sched`
--

INSERT INTO `sched` (`id`, `subject`, `personnel_id`, `semester`, `lab`, `day`, `start_time`, `end_time`, `semester_start`, `semester_end`, `created_at`) VALUES
(30, 'meek', 27, 1, 'lab2', 'Monday', '08:00:00', '11:30:00', '2024-04-08', '2024-10-18', '2024-08-13 00:36:34'),
(31, 'marps', 27, 1, 'lab3', 'Monday', '08:00:00', '11:00:00', '2024-04-08', '2024-10-18', '2024-08-13 00:39:31'),
(32, 'marps 4', 32, 1, 'lab4', 'Tuesday', '13:00:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-13 00:39:56'),
(33, 'Intro to Computing', 13, 1, 'lab1', 'Monday', '15:30:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-13 01:35:51'),
(35, 'Web Development', 13, 1, 'lab3', 'Tuesday', '13:00:00', '15:00:00', '2024-04-08', '2024-10-18', '2024-08-13 01:38:26'),
(47, 'bbbb', 13, 1, 'lab2', 'Tuesday', '13:00:00', '15:00:00', '2024-04-08', '2024-10-18', '2024-08-16 03:50:03'),
(48, 'mummimi', 13, 1, 'lab3', 'Wednesday', '13:00:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-16 03:50:59'),
(49, 'mamar apdited', 13, 1, 'lab4', 'Monday', '13:00:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-16 03:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `sem1_start` date NOT NULL,
  `sem1_end` date NOT NULL,
  `sem2_start` date NOT NULL,
  `sem2_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `sem1_start`, `sem1_end`, `sem2_start`, `sem2_end`) VALUES
(1, '2024-04-08', '2024-10-18', '2024-09-01', '2024-12-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sched`
--
ALTER TABLE `sched`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
