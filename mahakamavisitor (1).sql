-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2024 at 07:37 AM
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
-- Database: `mahakamavisitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('mahakama2025@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `guards`
--

CREATE TABLE `guards` (
  `guid` int(11) NOT NULL,
  `guemail` varchar(255) DEFAULT NULL,
  `guname` varchar(255) DEFAULT NULL,
  `gupassword` varchar(255) DEFAULT NULL,
  `guphone` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `guards`
--

INSERT INTO `guards` (`guid`, `guemail`, `guname`, `gupassword`, `guphone`) VALUES
(1, 'happybenson@gmail.com', 'HAPPY BENSON', '1234', '0622729172'),
(13, 'johnemmanuel4343@gmail.com', 'LEONARD  LEONARD', '12345678', '0753462632');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unapotoka` varchar(255) DEFAULT NULL,
  `unapoenda` varchar(255) DEFAULT NULL,
  `detail` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `timein` varchar(255) DEFAULT NULL,
  `timeout` varchar(255) DEFAULT NULL,
  `guemail` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `name`, `unapotoka`, `unapoenda`, `detail`, `phone`, `date`, `timein`, `timeout`, `guemail`) VALUES
(4, 'EMMANUEL LEONARD JOHN', 'DODOMA', 'MAHAKAMA KUU', 'NIDA', '0743435910', '2024-10-04', '16:15:01', '16:15:03', NULL),
(6, 'EMMANUEL LEONARD JOHN', 'DODOMA', 'MAHAKAMA KUU', 'PIGA KULA', '0743435910', '2024-10-07', '13:17:51', '13:17:53', 'happybenson@gmail.com'),
(7, 'HAMIS ATHUMAN', 'MTWARA', 'MAHAKAMA KUU', 'NIDA', '0743435910', '2024-10-07', '13:35:57', '13:35:58', 'johnemmanuel4343@gmail.com'),
(9, 'ROGES SIMON', 'MTWARA', 'MAHAKAMA KUU', 'PIGA KULA', '0623451678', '2024-10-11', '21:35:14', '21:35:15', 'happybenson@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('mahakama2025@gmail.com', 'a'),
('happybenson@gmail.com', 'gu'),
('johnemmanuel4343@gmail.com', 'gu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `guards`
--
ALTER TABLE `guards`
  ADD PRIMARY KEY (`guid`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guards`
--
ALTER TABLE `guards`
  MODIFY `guid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
