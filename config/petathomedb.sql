-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2018 at 11:24 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id7163051_petathomedb`
--
CREATE DATABASE IF NOT EXISTS `petathomedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `petathomedb`;
-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

DROP TABLE IF EXISTS `tbl_address`;
CREATE TABLE IF NOT EXISTS `tbl_address` (
  `address_id` int(4) NOT NULL AUTO_INCREMENT,
  `house_no` varchar(100) DEFAULT NULL,
  `streetname` varchar(100) DEFAULT NULL,
  `subd` varchar(100) DEFAULT NULL,
  `brgy` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `zipcode` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `house_no`, `streetname`, `subd`, `brgy`, `city`, `province`, `zipcode`) VALUES
(44, NULL, NULL, NULL, NULL, 'Caloocan', NULL, NULL),
(45, NULL, NULL, NULL, NULL, 'Las PiÃ±as', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adopt_transc`
--

DROP TABLE IF EXISTS `tbl_adopt_transc`;
CREATE TABLE IF NOT EXISTS `tbl_adopt_transc` (
  `transc_id` int(100) NOT NULL AUTO_INCREMENT,
  `is_adopted` tinyint(1) NOT NULL DEFAULT '0',
  `tbl_pets_pet_id` int(100) NOT NULL,
  PRIMARY KEY (`transc_id`),
  KEY `fk_tbl_adopt_transc_tbl_pets1_idx` (`tbl_pets_pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_adopt_transc`
--

INSERT INTO `tbl_adopt_transc` (`transc_id`, `is_adopted`, `tbl_pets_pet_id`) VALUES
(24, 0, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document`
--

DROP TABLE IF EXISTS `tbl_document`;
CREATE TABLE IF NOT EXISTS `tbl_document` (
  `document_id` int(100) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(45) NOT NULL,
  `tbl_file_file_id` int(100) NOT NULL,
  `tbl_pets_pet_id` int(100) NOT NULL,
  PRIMARY KEY (`document_id`),
  KEY `fk_tbl_document_tbl_file1_idx` (`tbl_file_file_id`),
  KEY `fk_tbl_document_tbl_pets1_idx` (`tbl_pets_pet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

DROP TABLE IF EXISTS `tbl_file`;
CREATE TABLE IF NOT EXISTS `tbl_file` (
  `file_id` int(100) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` int(100) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`file_id`, `file_name`, `file_type`, `file_size`) VALUES
(130, 'me', 'png', 338168),
(131, NULL, 'unicorn1.jpg', 23509),
(132, NULL, '.png', 200),
(133, NULL, '.png', 200),
(134, 'pizza 1', 'png', 67248);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif`
--

DROP TABLE IF EXISTS `tbl_notif`;
CREATE TABLE IF NOT EXISTS `tbl_notif` (
  `notif_id` int(100) NOT NULL AUTO_INCREMENT,
  `is_accepted` tinyint(1) NOT NULL,
  `is_reviewed` tinyint(1) NOT NULL,
  `rejection_reason` varchar(500) NOT NULL,
  `accepted_reason` varchar(500) NOT NULL,
  `interest_reason` varchar(200) NOT NULL,
  `tbl_user_owner_user_id` int(4) NOT NULL,
  `tbl_user_interest_user_id` int(4) NOT NULL,
  `tbl_adopt_transc_transc_id` int(100) NOT NULL,
  PRIMARY KEY (`notif_id`),
  KEY `fk_tbl_notif_tbl_adopt_transc1_idx` (`tbl_adopt_transc_transc_id`),
  KEY `fk_tbl_notif_tbl_user1` (`tbl_user_owner_user_id`),
  KEY `fk_tbl_notif_tbl_user2` (`tbl_user_interest_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pets`
--

DROP TABLE IF EXISTS `tbl_pets`;
CREATE TABLE IF NOT EXISTS `tbl_pets` (
  `pet_id` int(100) NOT NULL AUTO_INCREMENT,
  `petname` varchar(100) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `pet_type` varchar(100) DEFAULT NULL,
  `bday` date DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `dsc` varchar(500) DEFAULT NULL,
  `tbl_users_user_id` int(5) DEFAULT NULL,
  `tbl_file_file_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`pet_id`),
  KEY `fk_tbl_pets_tbl_users1_idx` (`tbl_users_user_id`),
  KEY `fk_tbl_pets_tbl_file1_idx` (`tbl_file_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pets`
--

INSERT INTO `tbl_pets` (`pet_id`, `petname`, `breed`, `gender`, `pet_type`, `bday`, `rdate`, `dsc`, `tbl_users_user_id`, `tbl_file_file_id`) VALUES
(24, 'Huy', 'help', 'F', 'Dog', '2018-12-31', NULL, 'please', 41, 131);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `status` varchar(255) NOT NULL DEFAULT 'not active',
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_type` int(1) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `bday` date NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tbl_address_address_id` int(4) NOT NULL,
  `tbl_file_file_id` int(100) NOT NULL,
  `activationcode` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_tbl_users_tbl_address_idx` (`tbl_address_address_id`),
  KEY `fk_tbl_users_tbl_file1_idx` (`tbl_file_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`status`, `user_id`, `user_type`, `username`, `password`, `email`, `fname`, `mname`, `lname`, `bday`, `contact_no`, `timestamp`, `tbl_address_address_id`, `tbl_file_file_id`, `activationcode`) VALUES
('active', 41, 1, 'melosantos', 'Test123', 'msdas@test.com', 'Melo', '', 'Santos', '2018-12-31', '09123456798', '2018-10-02 10:32:16', 44, 130, '5d15bef1e46a2066eb76ad603a95e0bb'),
('active', 42, 0, 'chorva', 'Test123', 'sdas@test.com', 'Test', '', 'Test', '2018-12-31', '09123456789', '2018-10-02 10:40:13', 45, 134, '55678f208b633eab445d050dafa23933');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
