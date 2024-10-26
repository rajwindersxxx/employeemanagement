-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2024 at 04:57 PM
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
-- Database: `id21948620_erms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$LIi//p2PampokllykBnBQ.KifpNs956.rwC6GAiKhIMQjUkUq2jbi');

-- --------------------------------------------------------

--
-- Table structure for table `attend-details`
--

CREATE TABLE `attend-details` (
  `emp-id` varchar(255) NOT NULL,
  `days-present` mediumint(9) NOT NULL,
  `days-approved` mediumint(9) NOT NULL,
  `days-absent` mediumint(9) NOT NULL,
  `holidays` mediumint(9) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attend-history`
--

CREATE TABLE `attend-history` (
  `id` int(25) NOT NULL,
  `emp-id` varchar(255) NOT NULL,
  `current-date` date NOT NULL,
  `time` time DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attend-history`
--

INSERT INTO `attend-history` (`id`, `emp-id`, `current-date`, `time`, `status`) VALUES
(442, 'rajwinder8659', '2024-03-20', NULL, 'Holiday'),
(443, 'Palwinder8659', '2024-03-20', NULL, 'Holiday'),
(444, 'mohinder8659', '2024-03-20', NULL, 'Holiday'),
(445, 'rajwinder8659', '2024-03-20', NULL, 'Holiday'),
(446, 'Palwinder8659', '2024-03-20', NULL, 'Holiday'),
(447, 'mohinder8659', '2024-03-20', NULL, 'Holiday');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dept-name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept-name`) VALUES
(38, 'Income Department'),
(40, 'Minority Department'),
(41, 'Residence Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee-info`
--

CREATE TABLE `employee-info` (
  `emp-id` varchar(30) NOT NULL,
  `uid-id` bigint(15) NOT NULL,
  `first-name` varchar(40) NOT NULL,
  `last-name` varchar(40) NOT NULL,
  `department` varchar(40) NOT NULL,
  `e-mail` varchar(33) NOT NULL,
  `mobile-no` bigint(15) NOT NULL,
  `country` varchar(33) NOT NULL,
  `state` varchar(33) NOT NULL,
  `city` varchar(33) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  `profile-img` longblob NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` int(20) NOT NULL,
  `attend-status` varchar(255) DEFAULT 'pending',
  `days-present` mediumint(255) DEFAULT NULL,
  `days-absent` mediumint(255) DEFAULT NULL,
  `days-approved` mediumint(255) DEFAULT NULL,
  `holidays` mediumint(255) DEFAULT NULL,
  `mark-time` varchar(255) DEFAULT NULL,
  `last-update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee-info`
--

INSERT INTO `employee-info` (`emp-id`, `uid-id`, `first-name`, `last-name`, `department`, `e-mail`, `mobile-no`, `country`, `state`, `city`, `dob`, `doj`, `profile-img`, `address`, `password`, `id`, `attend-status`, `days-present`, `days-absent`, `days-approved`, `holidays`, `mark-time`, `last-update`) VALUES
('rajwinder8659', 123412341234, 'Rajwinder Pal', 'Singh', 'Income Department', 'Rajwindersxxx@gmail.com', 9779257974, 'India', 'Punjab', 'Kapurthala', '1997-10-19', '2024-03-13', '', 'House no 122, Mohala kasaban', '$2y$10$vFKk7MdesXaQng50Jfy/iebo1LAzE.r2i2fmlW2S34syy7FjVu1Km', 62, 'Holiday', 0, 0, 0, 2, '2024-03-18 21:39:35', '2024-03-20'),
('palwinder8659', 123423452234, 'Palwinder', 'kaur', 'Family department', 'kaurpalvi@gmail.com', 8968585382, 'India', 'Punjab', 'Jalandhar', '2024-02-26', '2024-03-18', '', 'modal town , house no 123', '$2y$10$ICGl6YFjSRGEJx2LxjeiKuJgtQXwrEEj/XlrFRri7dDTH6DHJY/Pq', 65, 'Holiday', 0, 0, 0, 2, NULL, '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `date` date DEFAULT NULL,
  `day` varchar(512) DEFAULT NULL,
  `reason` varchar(512) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`date`, `day`, `reason`, `id`) VALUES
('2024-01-17', 'Wed', 'Guru Gobind Singh Jayanti', 1),
('2024-01-26', 'Fri', 'Republic Day', 2),
('2024-02-24', 'Sat', 'Guru Ravidas Jayanti', 3),
('2024-03-08', 'Fri', 'Maha Shivaratri', 4),
('2024-03-23', 'Sat', 'S. Bhagat Singh\'s Martyrdom Day', 5),
('2024-03-25', 'Mon', 'Holi', 6),
('2024-03-29', 'Fri', 'Good Friday', 7),
('2024-04-08', 'Mon', 'Parkash Gurpurab of Sri Guru Ram Dass Ji', 8),
('2024-04-11', 'Thu', 'Idul Fitr', 9),
('2024-04-13', 'Sat', 'Vaisakh', 10),
('2024-04-14', 'Sun', 'Dr Ambedkar Jayanti', 11),
('2024-04-17', 'Wed', 'Ram Navami', 12),
('2024-04-21', 'Sun', 'Mahavir Jayanti', 13),
('2024-05-01', 'Wed', 'May Day', 14),
('2024-05-10', 'Fri', 'Maharshi Parasuram Jayanti', 15),
('2024-06-10', 'Mon', 'Sri Guru Arjun Dev Ji\'s Martyrdom Day', 16),
('2024-06-17', 'Mon', 'Bakrid / Eid al Adha', 17),
('2024-06-22', 'Sat', 'Sant Guru Kabir Jayanti', 18),
('2024-08-15', 'Thu', 'Independence Day', 19),
('2024-08-26', 'Mon', 'Janmashtami', 20),
('2024-10-02', 'Wed', 'Gandhi Jayanti', 21),
('2024-10-03', 'Thu', 'Maharaja Agrasen Jayanti', 22),
('2024-10-12', 'Sat', 'Vijaya Dashami', 23),
('2024-10-17', 'Thu', 'Maharishi Valmiki Jayanti', 24),
('2024-10-31', 'Thu', 'Diwali', 25),
('2024-11-15', 'Fri', 'Guru Nanak Jayanti', 26),
('2024-11-16', 'Sat', 'Shahidi Diwas S. Kartar Singh Sarabha Ji', 27),
('2024-12-06', 'Fri', 'Sri Guru Teg Bahadur Ji\'s Martyrdom Day', 28),
('2024-12-25', 'Wed', 'Christmas Day', 29),
('2024-12-27', 'Fri', 'Shaheedi Sabha', 30),
('2024-03-20', 'sun', 'Government Holdiay', 42);

-- --------------------------------------------------------

--
-- Table structure for table `image-`
--

CREATE TABLE `image-` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image-location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave-applied`
--

CREATE TABLE `leave-applied` (
  `id` int(255) NOT NULL,
  `emp-id` varchar(30) NOT NULL,
  `leave-type` varchar(50) NOT NULL,
  `apply-date` date NOT NULL DEFAULT current_timestamp(),
  `from-date` date NOT NULL,
  `to-date` date NOT NULL,
  `days` bigint(20) NOT NULL,
  `reason` longtext NOT NULL,
  `action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave-info`
--

CREATE TABLE `leave-info` (
  `id` int(10) NOT NULL,
  `leave-type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave-info`
--

INSERT INTO `leave-info` (`id`, `leave-type`) VALUES
(11, 'Leave without pay'),
(12, 'Casual leave'),
(13, 'Urgent Leave');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `emp-id` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `salary` bigint(20) NOT NULL,
  `allowance` bigint(20) NOT NULL,
  `total` int(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date-only` date NOT NULL DEFAULT current_timestamp(),
  `action` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `emp-id`, `department`, `salary`, `allowance`, `total`, `date`, `date-only`, `action`) VALUES
(7, 'rajwinder8659', 'income department', 8000, 245, 8245, '2024-03-14 11:02:44', '2024-03-14', 'Paid'),
(8, 'Palwinder8659', 'income department', 8000, 453, 8453, '2024-03-14 11:04:52', '2024-03-14', 'Paid'),
(9, 'rajwinder8659', 'income department', 8000, 245, 8245, '2024-03-17 17:40:12', '2024-03-17', 'Paid'),
(10, 'rajwinder8659', 'income department', 8000, 245, 8245, '2024-03-17 17:44:14', '2024-03-17', 'Paid'),
(11, 'rajwinder8659', 'income department', 20000, 245, 20245, '2024-03-17 17:52:20', '2024-03-17', 'Paid'),
(12, 'rajwinder8659', 'income department', 90000, 245, 90245, '2024-03-17 17:55:12', '2024-03-17', 'Paid'),
(13, 'rajwinder8659', 'income department', 3442, 245, 3687, '2024-03-17 17:56:26', '2024-03-17', 'Paid'),
(14, 'rajwinder8659', 'income department', 102020, 245, 102265, '2024-03-17 17:57:01', '2024-03-17', 'Paid'),
(15, 'rajwinder8659', 'income department', 102020, 245, 8245, '2024-03-17 17:57:13', '2024-03-17', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(15) NOT NULL,
  `dept-name` varchar(25) NOT NULL,
  `service-type` varchar(25) NOT NULL,
  `service-cost` bigint(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `dept-name`, `service-type`, `service-cost`) VALUES
(17, 'income department', 'Income Certificate', 100),
(18, 'Family department', 'Merriage Certificate', 500),
(19, 'Income Department', 'Residence certificate', 75),
(20, 'Minority Department', 'Caste certificate', 175);

-- --------------------------------------------------------

--
-- Table structure for table `services-applied`
--

CREATE TABLE `services-applied` (
  `Applyed-date` date NOT NULL DEFAULT current_timestamp(),
  `id` int(30) NOT NULL,
  `emp-id` varchar(30) NOT NULL,
  `customer-name` varchar(255) NOT NULL,
  `customer-number` bigint(255) NOT NULL,
  `dept-name` varchar(255) NOT NULL,
  `service-type` varchar(25) NOT NULL,
  `quantity` mediumint(30) NOT NULL,
  `total-cost` bigint(30) NOT NULL,
  `date-time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services-applied`
--

INSERT INTO `services-applied` (`Applyed-date`, `id`, `emp-id`, `customer-name`, `customer-number`, `dept-name`, `service-type`, `quantity`, `total-cost`, `date-time`) VALUES
('2024-03-20', 123, 'rajwinder8659', 'balwinder', 9779257974, 'Income Department', 'Residence certificate', 1, 75, '2024-03-20 21:23:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attend-details`
--
ALTER TABLE `attend-details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attend-history`
--
ALTER TABLE `attend-history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee-info`
--
ALTER TABLE `employee-info`
  ADD PRIMARY KEY (`id`,`uid-id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image-`
--
ALTER TABLE `image-`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave-applied`
--
ALTER TABLE `leave-applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave-info`
--
ALTER TABLE `leave-info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services-applied`
--
ALTER TABLE `services-applied`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attend-details`
--
ALTER TABLE `attend-details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attend-history`
--
ALTER TABLE `attend-history`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `employee-info`
--
ALTER TABLE `employee-info`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `image-`
--
ALTER TABLE `image-`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave-applied`
--
ALTER TABLE `leave-applied`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `leave-info`
--
ALTER TABLE `leave-info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `services-applied`
--
ALTER TABLE `services-applied`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
