-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 04:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(13, 'Nawng Nimo', 'Admin', 'active', 'admin', '$2y$10$IRTCH4eQfFqDUZQffHy47uqTrTYVUOn8azO6FiYDNwdr0ENt3D76.', 'uploads/13/smcc-logo.png'),
(27, 'ako mani', 'Library Custodian', 'active', 'ako mani gani', '$2y$10$7CbRdYBIVQ7buGc8ni/vieqs2JbzPlVPUqThUq6Kzg7iSAzgyGmx6', ''),
(29, 'jam', 'student', 'inactive', 'student', '$2y$10$79y.m.8kF8DTK.LnRJrtjOGqFPO629xFr8dfP88BWP6hjcKWLbAAW', ''),
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
(9, 'aa', 'lab1', 13, '2024-08-15', '2024-08-15', '08:00:00', '09:00:00');

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
(28, 'Monday nasad', 33, 2, 'lab1', 'Monday', '08:00:00', '09:30:00', '2024-07-07', '2024-12-12', '2024-08-12 06:04:38'),
(29, 'asd', 33, 1, 'lab1', 'Monday', '10:00:00', '13:00:00', '2024-04-08', '2024-10-18', '2024-08-13 00:24:01'),
(30, 'meek', 27, 1, 'lab2', 'Monday', '08:00:00', '11:30:00', '2024-04-08', '2024-10-18', '2024-08-13 00:36:34'),
(31, 'marps', 27, 1, 'lab3', 'Monday', '08:00:00', '11:00:00', '2024-04-08', '2024-10-18', '2024-08-13 00:39:31'),
(32, 'marps 4', 32, 1, 'lab4', 'Tuesday', '13:00:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-13 00:39:56'),
(33, 'Intro to Computing', 13, 1, 'lab1', 'Monday', '15:30:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-13 01:35:51'),
(35, 'Web Development', 13, 1, 'lab3', 'Tuesday', '13:00:00', '15:00:00', '2024-04-08', '2024-10-18', '2024-08-13 01:38:26'),
(37, ' updated', 27, 1, 'lab1', 'Tuesday', '08:00:00', '11:00:00', '2024-07-07', '2024-12-12', '2024-08-13 13:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `repeat_weekly` tinyint(1) DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `all_day` tinyint(1) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `personnel` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lab` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `description`, `repeat_weekly`, `days`, `start_date`, `end_date`, `all_day`, `start_time`, `end_time`, `created_at`, `personnel`, `type`, `lab`, `sem`) VALUES
(72, 'sad', 'sad', 1, 'Tue', '2024-07-02', '2024-07-30', 1, NULL, NULL, '2024-07-01 22:58:03', '', 'schedule', 'lab4', '\0\0\0\0\0D?\0\0I\0\0\0\0\0\0?\0\0\0\0\0\0sadsad?Wed????????????f?4?schedulelab1\00\0\0 \0>?\0\0J\0\0\0\0\0\0?\0\0\0\0\0\0sadsad?Wed??'),
(73, 'sad', 'sad', 1, 'Wed', '2024-07-03', '2024-08-07', 0, '09:58:00', '11:58:00', '2024-07-01 22:58:36', '', 'schedule', 'lab1', '\00\0\0 \0>?\0\0J\0\0\0\0\0\0?\0\0\0\0\0\0sadsad?Wed???????f?4?sc'),
(74, 'sad', 'sad', 0, 'Wed', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-01 22:59:05', '', 'schedule', 'lab3', '\0\00\0(\0;?\0\0K\0\0\0\0\0\0?\0\0\0\0\0\0aaaaaaa????????f?4?r'),
(75, 'aaa', 'aaaa', 0, '', '2024-07-05', '2024-07-05', 1, NULL, NULL, '2024-07-01 22:59:50', '', 'reserve', 'lab1', '\0\00\0\00\0:?\0\0L\0\0\0\0\0\0?\0\0\0\0\0\0asdasd????????f?5Jrese'),
(76, 'asd', 'asd', 0, '', '2024-07-12', '2024-07-12', 1, NULL, NULL, '2024-07-01 23:01:30', '', 'reserve', 'lab2', '\0\0	0\0\08\0F?\0\0N\0\0\0\0\0\0?\0\0\0\0\0\0lab1 newlab 1 new???'),
(78, 'lab1 new', 'lab 1 new', 0, '', '2024-07-03', '2024-07-03', 1, NULL, NULL, '2024-07-02 17:05:33', '', 'schedule', 'lab1', '\0\0		0\0\0@\0G?\0\0O\0\0\0\0\0\0?\0\0\0\0\0\0lab 2 newlab 2 new???'),
(79, 'lab 2 new', 'lab 2 new', 0, '', '2024-07-03', '2024-07-03', 1, NULL, NULL, '2024-07-02 17:05:47', '', 'schedule', 'lab2', '\0	\n0\0H\0K?\0\0P\0\0\0\0\0\0?\0\0\0\0\0\0lab 3 new lab 3 new?'),
(80, 'lab 3 new ', 'lab 3 new', 1, 'Wed', '2024-07-03', '2024-07-24', 1, NULL, NULL, '2024-07-02 17:06:09', '', 'schedule', 'lab3', '\0\0\0\0\0P\0??\0\0Q\0\0\0\0\0\0?\0\0\0\0\0\0lab 4lab 4 ??????　q'),
(81, 'lab 4', 'lab 4 ', 0, '', '2024-07-03', '2024-07-03', 0, '07:06:00', '09:00:00', '2024-07-02 17:06:43', '', 'schedule', 'lab4', '\0\00\0\0X??\0\0e\0\0\0\0\0\0?\0\0\0\0\0\0asdasd????????f???sche'),
(83, 'aa new', 'aa new ', 0, '', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-02 18:32:44', 'Imong Nawng', 'reserve', 'lab1', '\0\00 \0h\0\0?\0\0Y\0\0\0\0-?\0\0V+?memsmams????????f?\Z'),
(86, 'asd', 'asd', 0, '', '2024-07-01', '2024-07-01', 1, NULL, NULL, '2024-07-02 18:38:18', '', 'schedule', 'lab1', '\0\00\0x\0K?\0\0W\0\0\0\0\0\0?\0\0\0\0\0\0SampleDescription la'),
(87, 'Sample', 'Description lang', 0, '', '2024-07-08', '2024-07-08', 1, NULL, NULL, '2024-07-07 22:12:07', '', 'schedule', 'lab3', '\00\0\0?A?\0\0X\0\0\0\0\0\0?\0\0\0\0\0\0reserveasd????????f?'),
(88, 'reserve', 'asd', 0, '', '2024-07-08', '2024-07-08', 1, NULL, NULL, '2024-07-07 22:12:26', 'Imong Nawng', 'reserve', 'lab3', '\0\00 \0????\0\0Z\0\0\0\0-? \0\0?jmomsmims????????f?*sc'),
(103, 'aaa', 'aaaa', 0, '', '2024-07-10', '2024-07-12', 1, NULL, NULL, '2024-07-09 21:13:02', '', 'schedule', 'lab1', 'edulelab1\0\00 \0????\0\0i\0\0\0\0.?9\0\0?#?11????????f');

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
(1, '2024-04-08', '2024-10-18', '2024-07-07', '2024-12-12');

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
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
