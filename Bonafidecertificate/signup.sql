-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 03:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signup`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonafide_data`
--

CREATE TABLE `bonafide_data` (
  `serialnumber` int(20) NOT NULL,
  `enrollment` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facultyid` varchar(255) NOT NULL,
  `facultyemail` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bonafide_data`
--

INSERT INTO `bonafide_data` (`serialnumber`, `enrollment`, `name`, `number`, `sem`, `branch`, `email`, `facultyid`, `facultyemail`, `reason`, `date`, `status`) VALUES
(1, '210130107009', 'Brijesh Parmar', '9054180748', '6', 'Computer', '210130107009@gecg28.ac.in', 'gecg001', 'ypt@gecg28.ac.in', 'MSYS', '2024-03-15 04:42:11', 'accept'),
(2, '210130107009', 'Brijesh Parmar', '9054180748', '6', 'Computer', '210130107009@gecg28.ac.in', 'gecg001', 'ypt@gecg28.ac.in', 'CMSS', '2024-03-15 06:16:09', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `facultyid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'faculty'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_data`
--

INSERT INTO `faculty_data` (`facultyid`, `name`, `email`, `number`, `password`, `role`) VALUES
('gecg001', 'Yogendra P. Tank', 'ypt@gecg28.ac.in', '9876543210', '$2y$10$tMF6yefrb7mZP/bnL/4KHuJnqtdnzmiExwWMJ0DNiUMedL64iLN2W', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `enrollment` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`enrollment`, `name`, `email`, `number`, `password`, `sem`, `branch`, `file`) VALUES
('210130107009', 'Brijesh Parmar', '210130107009@gecg28.ac.in', '9054180748', '$2y$10$S/Jy9.WuhTmNIykGkmW4v.pXpDJhoEsfVwEvPQGUZLhdG7XGLK0Bm', '6', 'Computer', 'brijeshcomment.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonafide_data`
--
ALTER TABLE `bonafide_data`
  ADD PRIMARY KEY (`serialnumber`);

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`facultyid`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`enrollment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonafide_data`
--
ALTER TABLE `bonafide_data`
  MODIFY `serialnumber` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
