-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 03:49 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_tables`
--

-- --------------------------------------------------------

--
-- Table structure for table `day trip took it to ten-mjdknights14@gmail.com-2`
--

CREATE TABLE `day trip took it to ten-mjdknights14@gmail.com-2` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `itFunction` varchar(100) NOT NULL,
  `preferredProj` int(2) NOT NULL,
  `camp_distance` varchar(50) NOT NULL,
  `monAv` varchar(3) NOT NULL,
  `tueAv` varchar(3) NOT NULL,
  `wedAv` varchar(3) NOT NULL,
  `thuAv` varchar(3) NOT NULL,
  `friAv` varchar(3) NOT NULL,
  `satAv` varchar(3) NOT NULL,
  `sunAv` varchar(3) NOT NULL,
  `collabMethod` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `groupNum` int(2) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `day trip took it to ten-mjdknights14@gmail.com-2`
--

INSERT INTO `day trip took it to ten-mjdknights14@gmail.com-2` (`id`, `firstName`, `lastName`, `itFunction`, `preferredProj`, `camp_distance`, `monAv`, `tueAv`, `wedAv`, `thuAv`, `friAv`, `satAv`, `sunAv`, `collabMethod`, `score`, `groupNum`, `email`) VALUES
(1, 'Mac', 'DeMarco', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'macdemarcofan@protonmail.com'),
(2, 'Ariel', 'Morillo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'amorillo2@mail.usf.edu'),
(3, 'Toro', 'Junior', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'boricologomdj@gmail.com'),
(4, 'Maria', 'Marmol', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'mimarmolv@gmail.com'),
(5, 'Manuel', 'Jacobo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'manueljacobo@mail.usf.edu'),
(6, 'Chance', 'Belloise', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'mcbelloise@mail.usf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `one of the lasts-mjdknights14@gmail.com-12`
--

CREATE TABLE `one of the lasts-mjdknights14@gmail.com-12` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `itFunction` varchar(100) NOT NULL,
  `preferredProj` int(2) NOT NULL,
  `camp_distance` varchar(50) NOT NULL,
  `monAv` varchar(3) NOT NULL,
  `tueAv` varchar(3) NOT NULL,
  `wedAv` varchar(3) NOT NULL,
  `thuAv` varchar(3) NOT NULL,
  `friAv` varchar(3) NOT NULL,
  `satAv` varchar(3) NOT NULL,
  `sunAv` varchar(3) NOT NULL,
  `collabMethod` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `groupNum` int(2) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `one of the lasts-mjdknights14@gmail.com-12`
--

INSERT INTO `one of the lasts-mjdknights14@gmail.com-12` (`id`, `firstName`, `lastName`, `itFunction`, `preferredProj`, `camp_distance`, `monAv`, `tueAv`, `wedAv`, `thuAv`, `friAv`, `satAv`, `sunAv`, `collabMethod`, `score`, `groupNum`, `email`) VALUES
(1, 'Mac', 'DeMarco', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'macdemarcofan@protonmail.com'),
(2, 'Manuel', 'DeJesus', 'CyberSec', 6, '45', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'manueljacobo@mail.usf.edu'),
(3, 'Toro', 'Junior', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'boricologomdj@gmail.com'),
(4, 'Ariel', 'Morillo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'amorillo2@mail.usf.edu'),
(5, 'Maria', 'Marmol', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'mimarmolv@gmail.com'),
(6, 'Chance', 'Belloise', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'mcbelloise@mail.usf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `stargazing-mjdknights14@gmail.com-11`
--

CREATE TABLE `stargazing-mjdknights14@gmail.com-11` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `itFunction` varchar(100) NOT NULL,
  `preferredProj` int(2) NOT NULL,
  `camp_distance` varchar(50) NOT NULL,
  `monAv` varchar(3) NOT NULL,
  `tueAv` varchar(3) NOT NULL,
  `wedAv` varchar(3) NOT NULL,
  `thuAv` varchar(3) NOT NULL,
  `friAv` varchar(3) NOT NULL,
  `satAv` varchar(3) NOT NULL,
  `sunAv` varchar(3) NOT NULL,
  `collabMethod` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `groupNum` int(2) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stargazing-mjdknights14@gmail.com-11`
--

INSERT INTO `stargazing-mjdknights14@gmail.com-11` (`id`, `firstName`, `lastName`, `itFunction`, `preferredProj`, `camp_distance`, `monAv`, `tueAv`, `wedAv`, `thuAv`, `friAv`, `satAv`, `sunAv`, `collabMethod`, `score`, `groupNum`, `email`) VALUES
(1, 'Mac', 'DeMarco', 'CyberSec', 2, '30', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'Asynchronous', 0, 0, 'macdemarcofan@protonmail.com'),
(2, 'Ariel', 'Morillo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'amorillo2@mail.usf.edu'),
(3, 'Maria', 'Marmol', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'mimarmolv@gmail.com'),
(4, 'Toro', 'Junior', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'boricologomdj@gmail.com'),
(5, 'Manuel', 'Jacobo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'manueljacobo@mail.usf.edu'),
(6, 'Chance', 'Belloise', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'mcbelloise@mail.usf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `test-mjdknights14@gmail.com-13`
--

CREATE TABLE `test-mjdknights14@gmail.com-13` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `itFunction` varchar(100) NOT NULL,
  `preferredProj` int(2) NOT NULL,
  `camp_distance` varchar(50) NOT NULL,
  `monAv` varchar(3) NOT NULL,
  `tueAv` varchar(3) NOT NULL,
  `wedAv` varchar(3) NOT NULL,
  `thuAv` varchar(3) NOT NULL,
  `friAv` varchar(3) NOT NULL,
  `satAv` varchar(3) NOT NULL,
  `sunAv` varchar(3) NOT NULL,
  `collabMethod` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `groupNum` int(2) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test-mjdknights14@gmail.com-13`
--

INSERT INTO `test-mjdknights14@gmail.com-13` (`id`, `firstName`, `lastName`, `itFunction`, `preferredProj`, `camp_distance`, `monAv`, `tueAv`, `wedAv`, `thuAv`, `friAv`, `satAv`, `sunAv`, `collabMethod`, `score`, `groupNum`, `email`) VALUES
(1, 'Ariel', 'Morillo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'amorillo2@mail.usf.edu'),
(2, 'Maria', 'Marmol', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'mimarmolv@gmail.com'),
(3, 'Toro', 'Junior', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'boricologomdj@gmail.com'),
(4, 'Chance', 'Belloise', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'mcbelloise@mail.usf.edu'),
(5, 'Mac', 'DeMarco', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'macdemarcofan@protonmail.com'),
(6, 'Manuel', 'DeJesus', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 0, 'manueljacobo@mail.usf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `test 1-mjdknights14@gmail.com-9`
--

CREATE TABLE `test 1-mjdknights14@gmail.com-9` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `itFunction` varchar(100) NOT NULL,
  `preferredProj` int(2) NOT NULL,
  `camp_distance` varchar(50) NOT NULL,
  `monAv` varchar(3) NOT NULL,
  `tueAv` varchar(3) NOT NULL,
  `wedAv` varchar(3) NOT NULL,
  `thuAv` varchar(3) NOT NULL,
  `friAv` varchar(3) NOT NULL,
  `satAv` varchar(3) NOT NULL,
  `sunAv` varchar(3) NOT NULL,
  `collabMethod` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `groupNum` int(2) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test 1-mjdknights14@gmail.com-9`
--

INSERT INTO `test 1-mjdknights14@gmail.com-9` (`id`, `firstName`, `lastName`, `itFunction`, `preferredProj`, `camp_distance`, `monAv`, `tueAv`, `wedAv`, `thuAv`, `friAv`, `satAv`, `sunAv`, `collabMethod`, `score`, `groupNum`, `email`) VALUES
(1, 'Mac', 'DeMarco', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'macdemarcofan@protonmail.com'),
(2, 'Ariel', 'Morillo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'amorillo2@mail.usf.edu'),
(3, 'Maria', 'Marmol', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'mimarmolv@gmail.com'),
(4, 'Toro', 'Junior', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'boricologomdj@gmail.com'),
(5, 'Manuel', 'Jacobo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'manueljacobo@mail.usf.edu'),
(6, 'Chance', 'Belloise', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'mcbelloise@mail.usf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `test 2-mjdknights14@gmail.com-10`
--

CREATE TABLE `test 2-mjdknights14@gmail.com-10` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `itFunction` varchar(100) NOT NULL,
  `preferredProj` int(2) NOT NULL,
  `camp_distance` varchar(50) NOT NULL,
  `monAv` varchar(3) NOT NULL,
  `tueAv` varchar(3) NOT NULL,
  `wedAv` varchar(3) NOT NULL,
  `thuAv` varchar(3) NOT NULL,
  `friAv` varchar(3) NOT NULL,
  `satAv` varchar(3) NOT NULL,
  `sunAv` varchar(3) NOT NULL,
  `collabMethod` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `groupNum` int(2) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test 2-mjdknights14@gmail.com-10`
--

INSERT INTO `test 2-mjdknights14@gmail.com-10` (`id`, `firstName`, `lastName`, `itFunction`, `preferredProj`, `camp_distance`, `monAv`, `tueAv`, `wedAv`, `thuAv`, `friAv`, `satAv`, `sunAv`, `collabMethod`, `score`, `groupNum`, `email`) VALUES
(1, 'Mac', 'DeMarco', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'macdemarcofan@protonmail.com'),
(2, 'Toro', 'Junior', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'boricologomdj@gmail.com'),
(3, 'Manuel', 'Jacobo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'manueljacobo@mail.usf.edu'),
(4, 'Ariel', 'Morillo', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 1, 'amorillo2@mail.usf.edu'),
(5, 'Maria', 'Marmol', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'mimarmolv@gmail.com'),
(6, 'Chance', 'Belloise', 'Programming', 0, '<5', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'Synchronous', 0, 2, 'mcbelloise@mail.usf.edu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `day trip took it to ten-mjdknights14@gmail.com-2`
--
ALTER TABLE `day trip took it to ten-mjdknights14@gmail.com-2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `one of the lasts-mjdknights14@gmail.com-12`
--
ALTER TABLE `one of the lasts-mjdknights14@gmail.com-12`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stargazing-mjdknights14@gmail.com-11`
--
ALTER TABLE `stargazing-mjdknights14@gmail.com-11`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test-mjdknights14@gmail.com-13`
--
ALTER TABLE `test-mjdknights14@gmail.com-13`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test 1-mjdknights14@gmail.com-9`
--
ALTER TABLE `test 1-mjdknights14@gmail.com-9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test 2-mjdknights14@gmail.com-10`
--
ALTER TABLE `test 2-mjdknights14@gmail.com-10`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `day trip took it to ten-mjdknights14@gmail.com-2`
--
ALTER TABLE `day trip took it to ten-mjdknights14@gmail.com-2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `one of the lasts-mjdknights14@gmail.com-12`
--
ALTER TABLE `one of the lasts-mjdknights14@gmail.com-12`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stargazing-mjdknights14@gmail.com-11`
--
ALTER TABLE `stargazing-mjdknights14@gmail.com-11`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test-mjdknights14@gmail.com-13`
--
ALTER TABLE `test-mjdknights14@gmail.com-13`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test 1-mjdknights14@gmail.com-9`
--
ALTER TABLE `test 1-mjdknights14@gmail.com-9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test 2-mjdknights14@gmail.com-10`
--
ALTER TABLE `test 2-mjdknights14@gmail.com-10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
