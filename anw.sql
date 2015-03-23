-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2015 at 09:45 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anw`
--

-- --------------------------------------------------------

--
-- Table structure for table `AnweshaHierarchy`
--

CREATE TABLE IF NOT EXISTS `AnweshaHierarchy` (
  `ID` int(3) NOT NULL,
  `Event` varchar(100) DEFAULT NULL,
  `subID` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `EveID` int(3) NOT NULL,
  `Event` varchar(25) NOT NULL,
  `Fee` int(4) NOT NULL,
  `day` int(1) NOT NULL,
  `size` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GIDTable`
--

CREATE TABLE IF NOT EXISTS `GIDTable` (
  `ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `GrpID`
--

CREATE TABLE IF NOT EXISTS `GrpID` (
`GrpID` int(4) NOT NULL,
  `EveID` int(3) NOT NULL,
  `ID` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9896 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `IDTable`
--

CREATE TABLE IF NOT EXISTS `IDTable` (
  `ID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LoginTable`
--

CREATE TABLE IF NOT EXISTS `LoginTable` (
  `ID` int(4) NOT NULL,
  `pass` char(40) DEFAULT NULL,
  `token` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `NewQuery`
--

CREATE TABLE IF NOT EXISTS `NewQuery` (
  `Query` varchar(450) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`SNO` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3713 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE IF NOT EXISTS `Payment` (
  `EveID` int(3) NOT NULL,
  `ID` int(4) NOT NULL,
  `grp` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE IF NOT EXISTS `Registration` (
  `EveID` int(3) NOT NULL,
  `ID` int(4) NOT NULL,
  `grp` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RegOut`
--

CREATE TABLE IF NOT EXISTS `RegOut` (
  `name` varchar(50) NOT NULL,
  `ID` int(4) NOT NULL,
  `college` varchar(50) DEFAULT NULL,
  `sex` char(1) NOT NULL DEFAULT 'M',
  `mobile` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `city` varchar(20) NOT NULL DEFAULT 'Patna',
  `Fee` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UD`
--

CREATE TABLE IF NOT EXISTS `UD` (
  `ID` int(4) DEFAULT NULL,
  `CID` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AnweshaHierarchy`
--
ALTER TABLE `AnweshaHierarchy`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
 ADD PRIMARY KEY (`EveID`), ADD UNIQUE KEY `Event` (`Event`);

--
-- Indexes for table `GIDTable`
--
ALTER TABLE `GIDTable`
 ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `GrpID`
--
ALTER TABLE `GrpID`
 ADD PRIMARY KEY (`GrpID`), ADD KEY `EveID` (`EveID`);

--
-- Indexes for table `LoginTable`
--
ALTER TABLE `LoginTable`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `NewQuery`
--
ALTER TABLE `NewQuery`
 ADD PRIMARY KEY (`SNO`), ADD UNIQUE KEY `SNO` (`SNO`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
 ADD KEY `EveID` (`EveID`), ADD KEY `ID` (`ID`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
 ADD UNIQUE KEY `Reg` (`EveID`,`ID`), ADD KEY `EveID` (`EveID`), ADD KEY `ID` (`ID`);

--
-- Indexes for table `RegOut`
--
ALTER TABLE `RegOut`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `mobile` (`mobile`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `UD`
--
ALTER TABLE `UD`
 ADD UNIQUE KEY `ID` (`ID`), ADD UNIQUE KEY `idx_nam` (`ID`,`CID`), ADD KEY `fk_CID` (`CID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `GrpID`
--
ALTER TABLE `GrpID`
MODIFY `GrpID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9896;
--
-- AUTO_INCREMENT for table `NewQuery`
--
ALTER TABLE `NewQuery`
MODIFY `SNO` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3713;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `GrpID`
--
ALTER TABLE `GrpID`
ADD CONSTRAINT `GrpID_ibfk_1` FOREIGN KEY (`EveID`) REFERENCES `Events` (`EveID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `LoginTable`
--
ALTER TABLE `LoginTable`
ADD CONSTRAINT `LoginTable_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `RegOut` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Payment`
--
ALTER TABLE `Payment`
ADD CONSTRAINT `Payment_ibfk_1` FOREIGN KEY (`EveID`) REFERENCES `Events` (`EveID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Payment_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `RegOut` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Registration`
--
ALTER TABLE `Registration`
ADD CONSTRAINT `Registration_ibfk_1` FOREIGN KEY (`EveID`) REFERENCES `Events` (`EveID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Registration_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `RegOut` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `UD`
--
ALTER TABLE `UD`
ADD CONSTRAINT `UD_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `RegOut` (`ID`),
ADD CONSTRAINT `UD_ibfk_2` FOREIGN KEY (`CID`) REFERENCES `AnweshaHierarchy` (`ID`),
ADD CONSTRAINT `fk_CID` FOREIGN KEY (`CID`) REFERENCES `AnweshaHierarchy` (`ID`),
ADD CONSTRAINT `fk_ID` FOREIGN KEY (`ID`) REFERENCES `RegOut` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
