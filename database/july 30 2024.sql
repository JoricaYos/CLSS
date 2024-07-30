-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 03:10 AM
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
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `role`, `username`, `password`, `img`) VALUES
(1, 'Imong Nawng', 'Admin', '', 'sample', ''),
(2, 'Hey Joe', 'tambay', 'sam', '$2y$10$vSZWoedKZSPpgcoukUz/a.uOYfI0caYqpLJheuhjumfwpn3wGYRZq', ''),
(9, 'bebert', 'Admin', 'labert', '$2y$10$LBJ5icQ2/lrabETAYPafZeXVa2D9cCL8xICLFe.i5gC6.fGALwrSa', ''),
(10, 'maak', 'view1', 'meek', '$2y$10$4JnXQsg7uuRahfDeTahj0u3wNk220NDzo9dRpazESiXlh6R0rmirC', ''),
(11, 'mark', 'Admin', 'maks', '$2y$10$mz1bRoYzuH5j5gxY/9t4G.bYlWq4Sv0dC9tJVt14hyZOVJC1e/pQe', 'uploads/11/sample nawng.png'),
(12, 'sample', 'view1', '', '$2y$10$M3AcZAH7E.ZwEJ8/3lzZEuId7pn52/44..wbhz5UnZz2Kz.aTHprC', ''),
(13, 'Mark Tahimik Lungs', 'Admin', 'admin', '$2y$10$BYj3dPDEiOTN.qUxk6C0cOcb4K91xqtehN3LNR7o0fciSUTyhA1.a', 'uploads/13/bg.jpg'),
(14, 'Regie ', 'Student', 'regie123', '$2y$10$Q9rCgHPWAS34cHjagK.V7eUwoeoylLBvog2EzP3uD8BSO9gQvPvH6', ''),
(15, 'student', 'Student', 'student', '$2y$10$8sJMERWfAhV7OV6Y.9lk2OHFHXzYnxKFp77D4g3jRcNH5dyCPZLiq', ''),
(16, 'personnel', 'personnel', 'personnel', '$2y$10$85f8qvOHlXG1T.kfaSdyauFjkqS/4C0HW34dKj/8SSAY0HL61g7Zy', '');

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
  `lab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `description`, `repeat_weekly`, `days`, `start_date`, `end_date`, `all_day`, `start_time`, `end_time`, `created_at`, `personnel`, `type`, `lab`) VALUES
(72, 'sad', 'sad', 1, 'Tue', '2024-07-02', '2024-07-30', 1, NULL, NULL, '2024-07-01 22:58:03', '', 'schedule', 'lab4'),
(74, 'sad', 'sad', 0, 'Wed', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-01 22:59:05', '', 'schedule', 'lab3'),
(75, 'aaa', 'aaaa', 0, '', '2024-07-05', '2024-07-05', 1, NULL, NULL, '2024-07-01 22:59:50', '', 'reserve', 'lab1'),
(76, 'asd', 'asd', 0, '', '2024-07-12', '2024-07-12', 1, NULL, NULL, '2024-07-01 23:01:30', '', 'reserve', 'lab2'),
(78, 'lab1 new', 'lab 1 new', 0, '', '2024-07-03', '2024-07-03', 1, NULL, NULL, '2024-07-02 17:05:33', '', 'schedule', 'lab1'),
(79, 'lab 2 new', 'lab 2 new', 0, '', '2024-07-03', '2024-07-03', 1, NULL, NULL, '2024-07-02 17:05:47', '', 'schedule', 'lab2'),
(80, 'lab 3 new ', 'lab 3 new', 1, 'Wed', '2024-07-03', '2024-07-24', 1, NULL, NULL, '2024-07-02 17:06:09', '', 'schedule', 'lab3'),
(81, 'lab 4', 'lab 4 ', 0, '', '2024-07-03', '2024-07-03', 0, '07:06:00', '09:00:00', '2024-07-02 17:06:43', '', 'schedule', 'lab4'),
(83, 'aa new', 'aa new ', 0, '', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-02 18:32:44', 'Imong Nawng', 'reserve', 'lab1'),
(86, 'asd', 'asd', 0, '', '2024-07-01', '2024-07-01', 1, NULL, NULL, '2024-07-02 18:38:18', '', 'schedule', 'lab1'),
(87, 'Sample', 'Description lang', 0, '', '2024-07-08', '2024-07-08', 1, NULL, NULL, '2024-07-07 22:12:07', '', 'schedule', 'lab3'),
(88, 'reserve', 'asd', 0, '', '2024-07-08', '2024-07-08', 1, NULL, NULL, '2024-07-07 22:12:26', 'Imong Nawng', 'reserve', 'lab3'),
(103, 'aaa', 'aaaa', 0, '', '2024-07-10', '2024-07-12', 1, NULL, NULL, '2024-07-09 21:13:02', '', 'schedule', 'lab1'),
(108, 'a', 'a', 0, '', '2024-07-18', '2024-07-18', 1, NULL, NULL, '2024-07-29 09:33:33', '', 'schedule', 'lab1'),
(117, 'aa', 'aa', 0, '', '2024-07-30', '2024-07-30', 0, '08:00:00', '13:00:00', '2024-07-29 20:45:15', '', 'schedule', 'lab2'),
(121, 'lab2', 'asdasd', 0, '', '2024-07-30', '2024-07-30', 1, NULL, NULL, '2024-07-29 20:47:20', 'Mark Tahimik Lungs', 'reserve', 'lab2'),
(122, 'asd', 'asd', 0, '', '2024-07-30', '2024-07-30', 0, '08:00:00', '10:00:00', '2024-07-29 20:47:44', '', 'schedule', 'lab1');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `sem1-start` date NOT NULL,
  `sem1-end` date NOT NULL,
  `sem2-start` date NOT NULL,
  `sem2-end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `sem1-start`, `sem1-end`, `sem2-start`, `sem2-end`) VALUES
(1, '2024-07-02', '2024-07-28', '2024-07-15', '2024-07-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
