-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 11:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `anvnamn` varchar(255) NOT NULL,
  `losenord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `anvnamn`, `losenord`) VALUES
(1, 'admin', '$2y$10$c1Q7TeNbatIw0j8LhQgZ3ekVZXRi0jht0zMvVWXeXlLgorwM9uOTm');

-- --------------------------------------------------------

--
-- Table structure for table `dag`
--

CREATE TABLE `dag` (
  `dagID` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dag`
--

INSERT INTO `dag` (`dagID`, `datum`) VALUES
(133, '2021-03-01'),
(134, '2021-03-02'),
(135, '2021-03-03'),
(136, '2021-03-04'),
(137, '2021-03-05'),
(138, '2021-03-06'),
(139, '2021-03-08'),
(140, '2021-03-09'),
(182, '2021-03-10'),
(183, '2021-03-11'),
(184, '2021-03-12'),
(141, '2021-03-15'),
(142, '2021-03-16'),
(143, '2021-03-17'),
(144, '2021-03-18'),
(145, '2021-03-19'),
(146, '2021-03-22'),
(147, '2021-03-23'),
(148, '2021-03-24'),
(180, '2021-03-25'),
(181, '2021-03-26'),
(149, '2021-03-27'),
(150, '2021-03-29'),
(151, '2021-03-30'),
(152, '2021-03-31'),
(153, '2021-04-01'),
(154, '2021-04-02'),
(155, '2021-04-05'),
(156, '2021-04-06'),
(157, '2021-04-07'),
(158, '2021-04-08'),
(159, '2021-04-09'),
(160, '2021-04-12'),
(161, '2021-04-13'),
(162, '2021-04-14'),
(163, '2021-04-15'),
(164, '2021-04-16'),
(165, '2021-04-19'),
(166, '2021-04-20'),
(167, '2021-04-21'),
(168, '2021-04-22'),
(169, '2021-04-23'),
(170, '2021-04-26'),
(171, '2021-04-27'),
(172, '2021-04-28'),
(173, '2021-04-29'),
(174, '2021-04-30'),
(175, '2021-05-03'),
(176, '2021-05-04'),
(177, '2021-05-05'),
(178, '2021-05-06'),
(179, '2021-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `elev`
--

CREATE TABLE `elev` (
  `elevID` varchar(255) NOT NULL,
  `fornamn` varchar(255) NOT NULL,
  `efternamn` varchar(255) NOT NULL,
  `klass` varchar(255) NOT NULL,
  `epost` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foretag`
--

CREATE TABLE `foretag` (
  `foretagID` int(11) NOT NULL,
  `namn` varchar(255) NOT NULL,
  `losenord` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `handledare`
--

CREATE TABLE `handledare` (
  `handledarID` int(11) NOT NULL,
  `fornamn` varchar(255) NOT NULL,
  `efternamn` varchar(255) NOT NULL,
  `foretagID` int(11) NOT NULL,
  `epost` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klass`
--

CREATE TABLE `klass` (
  `klass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klass`
--

INSERT INTO `klass` (`klass`) VALUES
('It3'),
('T4'),
('Te3');

-- --------------------------------------------------------

--
-- Table structure for table `narvaro`
--

CREATE TABLE `narvaro` (
  `narvaroID` int(11) NOT NULL,
  `platsID` int(11) NOT NULL,
  `perioddagID` int(11) NOT NULL,
  `narvaro` smallint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE `period` (
  `periodNamn` varchar(255) NOT NULL,
  `startdatum` date NOT NULL,
  `slutdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`periodNamn`, `startdatum`, `slutdatum`) VALUES
('ko', '2021-03-01', '2021-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `perioddag`
--

CREATE TABLE `perioddag` (
  `perioddagID` int(11) NOT NULL,
  `dagID` int(11) NOT NULL,
  `periodNamn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perioddag`
--

INSERT INTO `perioddag` (`perioddagID`, `dagID`, `periodNamn`) VALUES
(513, 133, 'ko'),
(514, 134, 'ko'),
(515, 135, 'ko');

-- --------------------------------------------------------

--
-- Table structure for table `plats`
--

CREATE TABLE `plats` (
  `platsID` int(11) NOT NULL,
  `periodNamn` varchar(255) NOT NULL,
  `foretagID` int(11) NOT NULL,
  `elevID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `dag`
--
ALTER TABLE `dag`
  ADD PRIMARY KEY (`dagID`),
  ADD UNIQUE KEY `datum` (`datum`);

--
-- Indexes for table `elev`
--
ALTER TABLE `elev`
  ADD PRIMARY KEY (`elevID`),
  ADD KEY `fk_klass` (`klass`);

--
-- Indexes for table `foretag`
--
ALTER TABLE `foretag`
  ADD PRIMARY KEY (`foretagID`);

--
-- Indexes for table `handledare`
--
ALTER TABLE `handledare`
  ADD PRIMARY KEY (`handledarID`),
  ADD KEY `fk_foretagID` (`foretagID`);

--
-- Indexes for table `klass`
--
ALTER TABLE `klass`
  ADD PRIMARY KEY (`klass`);

--
-- Indexes for table `narvaro`
--
ALTER TABLE `narvaro`
  ADD PRIMARY KEY (`narvaroID`),
  ADD KEY `fk_platsID` (`platsID`),
  ADD KEY `fk_perioddagID` (`perioddagID`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`periodNamn`),
  ADD UNIQUE KEY `periodNamn` (`periodNamn`);

--
-- Indexes for table `perioddag`
--
ALTER TABLE `perioddag`
  ADD PRIMARY KEY (`perioddagID`),
  ADD KEY `fk_dagID` (`dagID`),
  ADD KEY `fk_periodNamn` (`periodNamn`);

--
-- Indexes for table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`platsID`),
  ADD KEY `fk_period` (`periodNamn`),
  ADD KEY `fk_elevID` (`elevID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dag`
--
ALTER TABLE `dag`
  MODIFY `dagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `foretag`
--
ALTER TABLE `foretag`
  MODIFY `foretagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `handledare`
--
ALTER TABLE `handledare`
  MODIFY `handledarID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `narvaro`
--
ALTER TABLE `narvaro`
  MODIFY `narvaroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=976;

--
-- AUTO_INCREMENT for table `perioddag`
--
ALTER TABLE `perioddag`
  MODIFY `perioddagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- AUTO_INCREMENT for table `plats`
--
ALTER TABLE `plats`
  MODIFY `platsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elev`
--
ALTER TABLE `elev`
  ADD CONSTRAINT `fk_klass` FOREIGN KEY (`klass`) REFERENCES `klass` (`klass`) ON DELETE CASCADE;

--
-- Constraints for table `handledare`
--
ALTER TABLE `handledare`
  ADD CONSTRAINT `fk_foretagID` FOREIGN KEY (`foretagID`) REFERENCES `foretag` (`foretagID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `narvaro`
--
ALTER TABLE `narvaro`
  ADD CONSTRAINT `fk_perioddagID` FOREIGN KEY (`perioddagID`) REFERENCES `perioddag` (`perioddagID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_platsID` FOREIGN KEY (`platsID`) REFERENCES `plats` (`platsID`) ON DELETE CASCADE;

--
-- Constraints for table `perioddag`
--
ALTER TABLE `perioddag`
  ADD CONSTRAINT `fk_dagID` FOREIGN KEY (`dagID`) REFERENCES `dag` (`dagID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_periodNamn` FOREIGN KEY (`periodNamn`) REFERENCES `period` (`periodNamn`) ON DELETE CASCADE;

--
-- Constraints for table `plats`
--
ALTER TABLE `plats`
  ADD CONSTRAINT `fk_elevID` FOREIGN KEY (`elevID`) REFERENCES `elev` (`elevID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_period` FOREIGN KEY (`periodNamn`) REFERENCES `period` (`periodNamn`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
