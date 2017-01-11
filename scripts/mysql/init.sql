-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2017 at 10:29 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waterfall`
--
CREATE DATABASE IF NOT EXISTS `waterfall` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `waterfall`;

-- --------------------------------------------------------

--
-- Table structure for table `Payload`
--

CREATE TABLE IF NOT EXISTS `Payload` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Data` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--

CREATE TABLE IF NOT EXISTS `Subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Name` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Webhook`
--

CREATE TABLE IF NOT EXISTS `Webhook` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `URL` varchar(2048) NOT NULL,
  `WebhookKey` varchar(128) NOT NULL,
  `State` enum('active','disabled','paused') NOT NULL,
  `MaxRetries` int(11) NOT NULL,
  `OnFail` enum('abort','continue','pause') NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WebhookKey` (`WebhookKey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `WebhookPayload`
--

CREATE TABLE IF NOT EXISTS `WebhookPayload` (
  `WebhookID` int(11) NOT NULL,
  `PayloadID` int(11) NOT NULL,
  `State` enum('pending','skip','processed') NOT NULL,
  `IsProcessing` tinyint(1) NOT NULL,
  `Retries` int(11) NOT NULL,
  PRIMARY KEY (`WebhookID`,`PayloadID`),
  KEY `k_WebhookPayload_PayloadID` (`PayloadID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `WebhookSubject`
--

CREATE TABLE IF NOT EXISTS `WebhookSubject` (
  `WebhookID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  PRIMARY KEY (`WebhookID`,`SubjectID`),
  KEY `k_WebhookSubject_SubjectID` (`SubjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `WebhookPayload`
--
ALTER TABLE `WebhookPayload`
  ADD CONSTRAINT `fk_WebhookPayload_PayloadID` FOREIGN KEY (`PayloadID`) REFERENCES `Payload` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_WebhookPayload_WebhookID` FOREIGN KEY (`WebhookID`) REFERENCES `Webhook` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `WebhookSubject`
--
ALTER TABLE `WebhookSubject`
  ADD CONSTRAINT `fk_WebhookSubject_SubjectID` FOREIGN KEY (`SubjectID`) REFERENCES `Subject` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_WebhookSubject_WebhookID` FOREIGN KEY (`WebhookID`) REFERENCES `Webhook` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
