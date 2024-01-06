-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 10:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `sno` int(11) NOT NULL,
  `Task` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`sno`, `Task`, `Description`, `timestamp`) VALUES
(32, 'test task', 'complete hw', '2024-01-05'),
(35, 'test task2', 'hw2', '2024-01-05'),
(36, 'test task3', 'hw3', '2024-01-05'),
(37, '2024', 'github contributions', '2024-01-05'),
(38, 'task_today', 'modifications', '2024-01-05'),
(39, 'study', 'acdemic validation', '2024-01-05'),
(40, 'fitness', 'go to gym and be in good shape', '2024-01-05'),
(41, 'co-curricular activities', 'fashion show ', '2024-01-05'),
(42, 'co-curricular activities', 'join a dance team', '2024-01-05'),
(44, 'test task', 'qwerty', '2024-01-06'),
(45, 'test task 3', '', '2024-01-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
