-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 03:52 AM
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
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `role`, `username`, `password`, `img`) VALUES
(13, 'Nawng Nimo', 'Admin', 'admin', '$2y$10$IRTCH4eQfFqDUZQffHy47uqTrTYVUOn8azO6FiYDNwdr0ENt3D76.', 'uploads/13/smcc-logo.png'),
(14, 'SI mark tahimik lungs', 'personnel', 'personnel', '$2y$10$vE2p84WEWDOFnapmQsE3He6pdrO9WS5V46sPHlwqqftX0gCQEWmLW', ''),
(15, 'ako mani', 'personnel', 'personnel1', '$2y$10$a6ei0DxXImKmRDxY9AiKxed1twZp/Hdx1rrQN9Xla/CQcuBGX1nui', ''),
(16, 'sya mani', 'personnel', 'personnel2', '$2y$10$5dIM9dPxYyb5CevFZhFhG.a/qRBqFsCEX6K06WVzzuOyKiwg6yupi', ''),
(17, 'Jane', 'personnel', 'personnel3', '$2y$10$pqfBiJvFuwV.zcB.syyMg.RJo5CmSgbPNPcpjjViZCZm.FO6R6uZy', ''),
(18, 'sample', 'personnel', 'personnel1000', '$2y$10$wIiJcsvpvL5F9Vr2P/qOhOt/jf29AwzSlS/HRS.95ECxxZJvibFcG', ''),
(19, 'asd', 'personnel', 'asd', '$2y$10$GP4AoSiotvQ1PYExHnodS.Gsz7sUPRy0mxze2afFNwugdWvNX.L0e', ''),
(20, 'saaaad', 'personnel', 'saaaad', '$2y$10$kkuO5T0lombyjRcpeOEske/wCVuXm/Yx2dXcvXvPJ23.dXfTydbM2', ''),
(21, 'aaa', 'personnel', 'aaa', '$2y$10$JCR3rTABDPqiitIZCzJz5.IEm2nIBKUE0dva5VsN/bI5Eof1Zxumq', ''),
(22, 'olala', 'personnel', 'olaa', '$2y$10$XNj8kJy.khr4YIaIuyleCeTsVDnbgxf4fr.Y6Jau1xkBJZNFCxvlK', ''),
(23, 'alili', 'personnel', 'aliliaaa', '$2y$10$9VbOKDlnlQtO7XgNRX49hes3GAn4GQDZ2QT.RI.VEHVqF5VkhlEQ.', ''),
(24, 'aaa', 'personnel', 'aaa', '$2y$10$LQq5izculfuirp3xSR86NOWIalztSoN5jcefLhAk7Cspk1tUD.XwG', ''),
(25, 'oorts', 'personnel', 'ooorts', '$2y$10$F6fYe1NY2FcCnSFfDGaZG.0ZXusZ4ozjZm0b2RgaGxZ8YI2G2NWnC', ''),
(26, 'mars', 'personnel', 'maers', '$2y$10$pY33VAImPBKjnJliRxwkTO0gCGf6vtz.9zvGmAJe8Z.ta1lvQctj.', ''),
(27, 'ako mani', 'Library Custodian', 'ako mani gani', '$2y$10$7CbRdYBIVQ7buGc8ni/vieqs2JbzPlVPUqThUq6Kzg7iSAzgyGmx6', ''),
(29, 'jam', 'student', 'student', '$2y$10$79y.m.8kF8DTK.LnRJrtjOGqFPO629xFr8dfP88BWP6hjcKWLbAAW', ''),
(30, 'meep', 'Instructor', 'maap', '$2y$10$G2BzloEryKace.bQ2GgMtetLys/7oGQib84o8b1t3E4X0YXROi72q', ''),
(31, 'dean', 'Dean/Principal', 'dean', '$2y$10$pW//bNoNobob6lqDAlOuheNlBvQ3q/8gL5bZtJbH8ANfwWxfXfyTC', ''),
(32, 'instructor', 'Instructor', 'instructor', '$2y$10$k72tcb1sVn.RdbllOqwI2eGyASJ2v8okec5VBUeDbk9DV94isrJWu', ''),
(33, 'custodian', 'Library Custodian', 'custodian', '$2y$10$iAGzDdsC2iZv89LCt/HY3uaTtz1Tz94ixckpFI73x96L/fh9FUbq2', '');

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
(6, 'meymey', 'lab2', 13, '2024-08-08', '2024-08-08', '22:00:00', '23:00:00');

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
(11, 'aa', 15, 1, '', 'Monday', '16:00:00', '18:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:20:13'),
(13, 'asd', 16, 1, '', 'Monday', '14:00:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:31:09'),
(14, 'asd', 15, 1, '', 'Monday', '20:00:00', '22:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:36:42'),
(15, 'asd', 18, 1, '', 'Monday', '13:00:00', '15:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:39:15'),
(16, 'asd', 18, 1, '', 'Monday', '06:00:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:39:44'),
(17, 'samting', 17, 1, 'lab1', 'Tuesday', '12:24:00', '15:24:00', '2024-04-08', '2024-10-18', '2024-08-10 15:24:27'),
(18, 'aaaa', 17, 1, 'lab1', 'Monday', '06:00:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-10 18:03:55'),
(19, 'asd', 17, 1, 'lab1', 'Monday', '11:59:00', '01:00:00', '2024-04-08', '2024-10-18', '2024-08-10 18:04:51'),
(20, 'asd', 17, 1, 'lab2', 'Monday', '06:00:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-10 18:07:26'),
(21, 'kkk', 17, 1, 'lab3', 'Monday', '06:00:00', '13:00:00', '2024-04-08', '2024-10-18', '2024-08-10 18:09:22'),
(22, '6', 17, 1, 'lab4', 'Monday', '06:00:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-10 18:10:03'),
(23, 'asd', 15, 1, 'lab4', 'Monday', '06:00:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-10 18:10:30'),
(24, 'asd', 21, 1, 'lab1', 'Monday', '06:00:00', '07:00:00', '2024-04-08', '2024-10-18', '2024-08-11 10:37:55'),
(25, 'aaa', 13, 1, 'lab1', 'Friday', '03:24:00', '05:24:00', '2024-04-08', '2024-10-18', '2024-08-11 17:24:53'),
(26, 'Mehehey', 14, 1, 'lab1', 'Wednesday', '08:00:00', '11:00:00', '2024-04-08', '2024-10-18', '2024-08-12 00:37:57'),
(27, 'maap', 13, 1, 'lab1', 'Thursday', '08:07:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-12 00:50:13');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
