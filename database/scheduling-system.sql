-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 01:03 AM
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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `role`, `username`, `password`) VALUES
(1, 'Imong Nawng', 'Admin', 'sample', '$2y$10$Co85bUsBaDeiQ2VJ8bx5keOhwyDBwjcBGqWfLpdOfkaJ.qiS8V3Na'),
(2, '', '', 'sam', '$2y$10$vSZWoedKZSPpgcoukUz/a.uOYfI0caYqpLJheuhjumfwpn3wGYRZq');

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
  `type` varchar(255) NOT NULL,
  `lab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `title`, `description`, `repeat_weekly`, `days`, `start_date`, `end_date`, `all_day`, `start_time`, `end_time`, `created_at`, `type`, `lab`) VALUES
(72, 'sad', 'sad', 1, 'Tue', '2024-07-02', '2024-07-30', 1, NULL, NULL, '2024-07-01 22:58:03', 'schedule', 'lab1'),
(73, 'sad', 'sad', 1, 'Wed', '2024-07-03', '2024-08-07', 0, '09:58:00', '11:58:00', '2024-07-01 22:58:36', 'schedule', 'lab1'),
(74, 'sad', 'sad', 0, 'Wed', '2024-07-06', '2024-07-06', 1, NULL, NULL, '2024-07-01 22:59:05', 'schedule', 'lab1'),
(75, 'aaa', 'aaaa', 0, '', '2024-07-05', '2024-07-05', 1, NULL, NULL, '2024-07-01 22:59:50', 'reserve', 'lab1'),
(76, 'asd', 'asd', 0, '', '2024-07-12', '2024-07-12', 1, NULL, NULL, '2024-07-01 23:01:30', 'reserve', 'lab1');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
