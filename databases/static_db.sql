-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 03:48 AM
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
-- Database: `static_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `experience` int(1) NOT NULL,
  `feedback` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `experience`, `feedback`) VALUES
(9, 'Manny DeJesus', 'mjdknights14@gmail.com', 5, 'Great job fellas!!!'),
(10, 'Manny DeJesus', 'mjdknights14@gmail.com', 2, 'this is a test'),
(11, 'Manny DeJesus', 'mjdknights14@gmail.com', 2, 'this is a test'),
(12, 'Manny DeJesus', 'mjdknights14@gmail.com', 2, 'this is a test');

-- --------------------------------------------------------

--
-- Table structure for table `finished_surveys`
--

CREATE TABLE `finished_surveys` (
  `id` int(11) NOT NULL,
  `surveyName` varchar(350) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finished_surveys`
--

INSERT INTO `finished_surveys` (`id`, `surveyName`, `email`) VALUES
(1, 'day trip took it to ten-mjdknights14@gmail.com-2', 'amorillo2@mail.usf.edu'),
(2, 'day trip took it to ten-mjdknights14@gmail.com-2', 'mimarmolv@gmail.com'),
(3, 'day trip took it to ten-mjdknights14@gmail.com-2', 'macdemarcofan@protonmail.com'),
(4, 'day trip took it to ten-mjdknights14@gmail.com-2', 'manueljacobo@mail.usf.edu'),
(5, 'day trip took it to ten-mjdknights14@gmail.com-2', 'boricologomdj@gmail.com'),
(6, 'day trip took it to ten-mjdknights14@gmail.com-2', 'mcbelloise@mail.usf.edu'),
(7, 'day trip took it to ten-mjdknights14@gmail.com-2', 'mjdknights14@gmail.com'),
(22, 'test 2-mjdknights14@gmail.com-10', 'boricologomdj@gmail.com'),
(23, 'test 2-mjdknights14@gmail.com-10', 'amorillo2@mail.usf.edu'),
(24, 'test 2-mjdknights14@gmail.com-10', 'macdemarcofan@protonmail.com'),
(25, 'test 2-mjdknights14@gmail.com-10', 'mimarmolv@gmail.com'),
(26, 'test 2-mjdknights14@gmail.com-10', 'manueljacobo@mail.usf.edu'),
(27, 'test 2-mjdknights14@gmail.com-10', 'mcbelloise@mail.usf.edu'),
(28, 'test 2-mjdknights14@gmail.com-10', 'mjdknights14@gmail.com'),
(29, 'test 1-mjdknights14@gmail.com-9', 'amorillo2@mail.usf.edu'),
(30, 'test 1-mjdknights14@gmail.com-9', 'boricologomdj@gmail.com'),
(31, 'test 1-mjdknights14@gmail.com-9', 'macdemarcofan@protonmail.com'),
(32, 'test 1-mjdknights14@gmail.com-9', 'manueljacobo@mail.usf.edu'),
(33, 'test 1-mjdknights14@gmail.com-9', 'mimarmolv@gmail.com'),
(34, 'test 1-mjdknights14@gmail.com-9', 'mcbelloise@mail.usf.edu'),
(35, 'test 1-mjdknights14@gmail.com-9', 'mjdknights14@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pending_surveys`
--

CREATE TABLE `pending_surveys` (
  `id` int(11) NOT NULL,
  `surveyName` varchar(350) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_surveys`
--

INSERT INTO `pending_surveys` (`id`, `surveyName`, `email`) VALUES
(29, 'Stargazing-mjdknights14@gmail.com-11', 'mjdknights14@gmail.com'),
(30, 'Stargazing-mjdknights14@gmail.com-11', 'macdemarcofan@protonmail.com'),
(31, 'Stargazing-mjdknights14@gmail.com-11', 'amorillo2@mail.usf.edu'),
(32, 'Stargazing-mjdknights14@gmail.com-11', 'mimarmolv@gmail.com'),
(33, 'Stargazing-mjdknights14@gmail.com-11', 'boricologomdj@gmail.com'),
(34, 'Stargazing-mjdknights14@gmail.com-11', 'manueljacobo@mail.usf.edu'),
(35, 'Stargazing-mjdknights14@gmail.com-11', 'mcbelloise@mail.usf.edu'),
(36, 'one of the lasts-mjdknights14@gmail.com-12', 'mjdknights14@gmail.com'),
(37, 'one of the lasts-mjdknights14@gmail.com-12', 'macdemarcofan@protonmail.com'),
(38, 'one of the lasts-mjdknights14@gmail.com-12', 'manueljacobo@mail.usf.edu'),
(39, 'one of the lasts-mjdknights14@gmail.com-12', 'boricologomdj@gmail.com'),
(40, 'one of the lasts-mjdknights14@gmail.com-12', 'amorillo2@mail.usf.edu'),
(41, 'one of the lasts-mjdknights14@gmail.com-12', 'mimarmolv@gmail.com'),
(42, 'one of the lasts-mjdknights14@gmail.com-12', 'mcbelloise@mail.usf.edu'),
(43, 'test-mjdknights14@gmail.com-13', 'mjdknights14@gmail.com'),
(44, 'test-mjdknights14@gmail.com-13', 'amorillo2@mail.usf.edu'),
(45, 'test-mjdknights14@gmail.com-13', 'mimarmolv@gmail.com'),
(46, 'test-mjdknights14@gmail.com-13', 'boricologomdj@gmail.com'),
(47, 'test-mjdknights14@gmail.com-13', 'mcbelloise@mail.usf.edu'),
(48, 'test-mjdknights14@gmail.com-13', 'macdemarcofan@protonmail.com'),
(49, 'test-mjdknights14@gmail.com-13', 'manueljacobo@mail.usf.edu');

-- --------------------------------------------------------

--
-- Table structure for table `survey_deadlines`
--

CREATE TABLE `survey_deadlines` (
  `id` int(11) NOT NULL,
  `surveyName` varchar(100) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_deadlines`
--

INSERT INTO `survey_deadlines` (`id`, `surveyName`, `deadline`) VALUES
(15, 'Stargazing-mjdknights14@gmail.com-11', '2019-11-29'),
(16, 'one of the lasts-mjdknights14@gmail.com-12', '2019-12-02'),
(17, 'test-mjdknights14@gmail.com-13', '2019-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 0,
  `surveysCreated` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `verified`, `token`, `password`, `type`, `surveysCreated`) VALUES
(32, 'Mac', 'DeMarco', 'macdemarcofan@protonmail.com', 1, '68e8b2f0ce96614b24eb394bd81b007e95e616ae16198d536bde06fce0f16b0f7057761ce63d3e5cb7625946eb80970d9c13', '$2y$10$ggY5dBzItFOLJQq8KybiFuTDWY.sOu1Lt36d23a9uverR0NgNqYH2', 0, 0),
(33, 'Manny', 'DeJesus', 'mjdknights14@gmail.com', 1, 'f4289ddc3a424f3acdc38100b8b1324a619970a5c92a111715e3a61623c47480b6dcdb08da634a5620eb6598ec1350156fd5', '$2y$10$V/vmi1O9qlylnxrQ/.2e7eEg3mBQpThXSp.7uIbIak9kyAnVcJfqi', 1, 14),
(39, 'Chance', 'Belloise', 'mcbelloise@mail.usf.edu', 1, 'db1c3ba1f2574b59009627218c3ba0c04796f3bbc3fd840f59e8439c950999ac9428d5fe99b8c0583fabc0689bd287ed5b4b', '$2y$10$eK6PTwft.s90L5y/EdgV3./nVuOzYBV3CK5nPJ.g.g08e6yyd8QTe', 0, 0),
(40, 'Ariel', 'Morillo', 'amorillo2@mail.usf.edu', 1, 'f8929bf2aece4354e2adb90980cf10d6221232f8454cfc36d48be7369669c3f3adbbbebf89f5a87df6d7a5b1dd0d2566f136', '$2y$10$ey0OvGBOoORolGSHVCl91.P3oOiDeOmCSN25V9NThgOgYM.3Cx9k6', 0, 0),
(49, 'Maria', 'Marmol', 'mimarmolv@gmail.com', 1, 'a0c91687c1c68876e97ee20a478f69749ad7813bc207ca75b4a09e7c2165d1e4a2840d652ff4abcd3ebbdc443329fe333cee', '$2y$10$rdH01GLwnS5Hfyd9C1njAee.jCsEuNmognN.uYGdUjJwdHqfKJAeC', 0, 0),
(50, 'Toro', 'Junior', 'boricologomdj@gmail.com', 1, 'b5058b166d0241ba2f711705bf2fa53bb2d3cc5bb999bb4778fe43428ecac4a506eae315389fad411e52a0256e9feff5ee5b', '$2y$10$YeSUYeCDjwf9qAALzweMh.n8T0zGkmsPaELgK7q.wYycux/a1E3yG', 0, 0),
(53, 'Manuel', 'DeJesus', 'manueljacobo@mail.usf.edu', 1, '253072d558e744e088476f7e59fde12dfac525e49c7d7c5617d12b63e59e76ed907bdda333eb74c17f7186db7d2ba5fd07de', '$2y$10$p//k05NjirbP9vR2V2XXW.RWIpYidU0T4dkfUJNtW9P0yOkB77NQi', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finished_surveys`
--
ALTER TABLE `finished_surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_surveys`
--
ALTER TABLE `pending_surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_deadlines`
--
ALTER TABLE `survey_deadlines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surveyName` (`surveyName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `finished_surveys`
--
ALTER TABLE `finished_surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pending_surveys`
--
ALTER TABLE `pending_surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `survey_deadlines`
--
ALTER TABLE `survey_deadlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
