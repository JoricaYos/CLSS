-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 04:45 AM
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
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `sched-color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `role`, `username`, `password`, `img`, `sched-color`) VALUES
(13, 'Jak The Jakjak', 'Admin', 'admin', '$2y$10$g3vj34qwtfFHTGvihWKaIetirIXNs5STvwXqwnzaD9iT8wIK25hju', '', ''),
(14, 'SI mark tahimik lungs', 'personnel', 'personnel', '$2y$10$vE2p84WEWDOFnapmQsE3He6pdrO9WS5V46sPHlwqqftX0gCQEWmLW', '', ''),
(15, 'ako mani', 'personnel', 'personnel1', '$2y$10$a6ei0DxXImKmRDxY9AiKxed1twZp/Hdx1rrQN9Xla/CQcuBGX1nui', '', ''),
(16, 'sya mani', 'personnel', 'personnel2', '$2y$10$5dIM9dPxYyb5CevFZhFhG.a/qRBqFsCEX6K06WVzzuOyKiwg6yupi', '', ''),
(17, 'Jane', 'personnel', 'personnel3', '$2y$10$pqfBiJvFuwV.zcB.syyMg.RJo5CmSgbPNPcpjjViZCZm.FO6R6uZy', '', ''),
(18, 'sample', 'personnel', 'personnel1000', '$2y$10$wIiJcsvpvL5F9Vr2P/qOhOt/jf29AwzSlS/HRS.95ECxxZJvibFcG', '', '#ff0000');

-- --------------------------------------------------------

--
-- Table structure for table `sched`
--

CREATE TABLE `sched` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
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

INSERT INTO `sched` (`id`, `subject`, `personnel_id`, `semester`, `day`, `start_time`, `end_time`, `semester_start`, `semester_end`, `created_at`) VALUES
(11, 'aa', 15, 1, 'Monday', '16:00:00', '18:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:20:13'),
(13, 'asd', 16, 1, 'Monday', '14:00:00', '17:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:31:09'),
(14, 'asd', 15, 1, 'Monday', '20:00:00', '22:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:36:42'),
(15, 'asd', 18, 1, 'Monday', '13:00:00', '15:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:39:15'),
(16, 'asd', 18, 1, 'Monday', '06:00:00', '10:00:00', '2024-04-08', '2024-10-18', '2024-08-03 17:39:44');

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
(72, 'sad', 'sad', 1, 'Tue', '2024-07-02', '2024-07-30', 1, NULL, NULL, '2024-07-01 22:58:03', '', 'schedule', 'lab4', '\0\0\0\0\0DÄ\0\0I\0\0\0\0\0\0Ä\0\0\0\0\0\0sadsadÅWedè–„è—ÄÄûÄÄæÄfÉ4úschedulelab1\00\0\0 \0>Ä\0\0J\0\0\0\0\0\0Ä\0\0\0\0\0\0sadsadÄWedè–'),
(73, 'sad', 'sad', 1, 'Wed', '2024-07-03', '2024-08-07', 0, '09:58:00', '11:58:00', '2024-07-01 22:58:36', '', 'schedule', 'lab1', '\00\0\0 \0>Ä\0\0J\0\0\0\0\0\0Ä\0\0\0\0\0\0sadsadÄWedè–Êè–ÊÅfÉ4πsc'),
(74, 'sad', 'sad', 0, 'Wed', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-01 22:59:05', '', 'schedule', 'lab3', '\0\00\0(\0;Ä\0\0K\0\0\0\0\0\0Ä\0\0\0\0\0\0aaaaaaaÄè–Âè–ÂÅfÉ4Êr'),
(75, 'aaa', 'aaaa', 0, '', '2024-07-05', '2024-07-05', 1, NULL, NULL, '2024-07-01 22:59:50', '', 'reserve', 'lab1', '\0\00\0\00\0:Ä\0\0L\0\0\0\0\0\0Ä\0\0\0\0\0\0asdasdÄè–Ïè–ÏÅfÉ5Jrese'),
(76, 'asd', 'asd', 0, '', '2024-07-12', '2024-07-12', 1, NULL, NULL, '2024-07-01 23:01:30', '', 'reserve', 'lab2', '\0\0	0\0\08\0FÄ\0\0N\0\0\0\0\0\0Ä\0\0\0\0\0\0lab1 newlab 1 newÄè–'),
(78, 'lab1 new', 'lab 1 new', 0, '', '2024-07-03', '2024-07-03', 1, NULL, NULL, '2024-07-02 17:05:33', '', 'schedule', 'lab1', '\0\0		0\0\0@\0GÄ\0\0O\0\0\0\0\0\0Ä\0\0\0\0\0\0lab 2 newlab 2 newÄè–'),
(79, 'lab 2 new', 'lab 2 new', 0, '', '2024-07-03', '2024-07-03', 1, NULL, NULL, '2024-07-02 17:05:47', '', 'schedule', 'lab2', '\0	\n0\0H\0KÄ\0\0P\0\0\0\0\0\0Ä\0\0\0\0\0\0lab 3 new lab 3 newÅ'),
(80, 'lab 3 new ', 'lab 3 new', 1, 'Wed', '2024-07-03', '2024-07-24', 1, NULL, NULL, '2024-07-02 17:06:09', '', 'schedule', 'lab3', '\0\0\0\0\0P\0ÇÄ\0\0Q\0\0\0\0\0\0Ä\0\0\0\0\0\0lab 4lab 4 Äè–„è–„ÄÄq'),
(81, 'lab 4', 'lab 4 ', 0, '', '2024-07-03', '2024-07-03', 0, '07:06:00', '09:00:00', '2024-07-02 17:06:43', '', 'schedule', 'lab4', '\0\00\0\0XñÄ\0\0e\0\0\0\0\0\0Ä\0\0\0\0\0\0asdasdÄè–Îè–ÎÅfçêæsche'),
(83, 'aa new', 'aa new ', 0, '', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-02 18:32:44', 'Imong Nawng', 'reserve', 'lab1', '\0\00 \0h\0\0Ä\0\0Y\0\0\0\0-Ò\0\0V+ﬂmemsmamsÄè–Èè–ÈÅfã\Z'),
(86, 'asd', 'asd', 0, '', '2024-07-01', '2024-07-01', 1, NULL, NULL, '2024-07-02 18:38:18', '', 'schedule', 'lab1', '\0\00\0x\0KÄ\0\0W\0\0\0\0\0\0Ä\0\0\0\0\0\0SampleDescription la'),
(87, 'Sample', 'Description lang', 0, '', '2024-07-08', '2024-07-08', 1, NULL, NULL, '2024-07-07 22:12:07', '', 'schedule', 'lab3', '\00\0\0ÄAÄ\0\0X\0\0\0\0\0\0Ä\0\0\0\0\0\0reserveasdÄè–Ëè–ËÅfã'),
(88, 'reserve', 'asd', 0, '', '2024-07-08', '2024-07-08', 1, NULL, NULL, '2024-07-07 22:12:26', 'Imong Nawng', 'reserve', 'lab3', '\0\00 \0à˛ÚÄ\0\0Z\0\0\0\0-Û \0\0îjmomsmimsÄè–Íè–ÍÅfã*sc'),
(103, 'aaa', 'aaaa', 0, '', '2024-07-10', '2024-07-12', 1, NULL, NULL, '2024-07-09 21:13:02', '', 'schedule', 'lab1', 'edulelab1\0\00 \0‡˝≤Ä\0\0i\0\0\0\0.Ã9\0\0´#§11Äè–Íè–ÍÅf');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
