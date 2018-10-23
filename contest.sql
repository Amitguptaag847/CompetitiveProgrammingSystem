-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2018 at 04:04 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(4, 'tccsuperadmin', '$2y$10$YxxI9i794Ds4LQWPdERgFu7UXV0RqOx81RO7iYE1AfYr.CL77LSzy');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `collegename` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `question1` varchar(50) NOT NULL,
  `question2` varchar(50) NOT NULL,
  `question3` varchar(50) NOT NULL,
  `submission1` tinyint(4) NOT NULL DEFAULT '0',
  `submission2` tinyint(4) NOT NULL DEFAULT '0',
  `submission3` tinyint(4) NOT NULL DEFAULT '0',
  `status1` int(11) NOT NULL DEFAULT '0',
  `status2` int(11) NOT NULL DEFAULT '0',
  `status3` int(11) NOT NULL DEFAULT '0',
  `time1` int(11) NOT NULL DEFAULT '3600',
  `time2` int(11) NOT NULL DEFAULT '3600',
  `time3` int(11) NOT NULL DEFAULT '3600',
  `attempt1` int(11) NOT NULL DEFAULT '0',
  `attempt2` int(11) NOT NULL DEFAULT '0',
  `attempt3` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '43200'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `collegename`, `year`, `department`, `email`, `phonenumber`, `start`, `end`, `question1`, `question2`, `question3`, `submission1`, `submission2`, `submission3`, `status1`, `status2`, `status3`, `time1`, `time2`, `time3`, `attempt1`, `attempt2`, `attempt3`, `points`) VALUES
(1, 'Amit', 'HITK', 'First', 'IT', 'amit@gmail.com', '8013011730', '1540300607', '1540304207', '24', '21', '17', 0, 1, 0, 0, 0, 0, 3600, 85, 3600, 0, 1, 0, 43200),
(2, 'Ajay', 'CSE', 'first', 'IT', 'ajay@gmail.com', '5865511151', '1540300892', '1540304492', '6', '25', '17', 0, 0, 0, 0, 0, 0, 3600, 3600, 3600, 0, 0, 0, 43200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
