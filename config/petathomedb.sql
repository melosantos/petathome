-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 08:51 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petathomedb`
--
CREATE DATABASE IF NOT EXISTS `petathomedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `petathomedb`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--
-- Creation: Sep 19, 2018 at 04:39 PM
--

CREATE TABLE IF NOT EXISTS `tbl_address` (
  `address_id` int(4) NOT NULL AUTO_INCREMENT,
  `house_no` varchar(100) NOT NULL,
  `streetname` varchar(100) NOT NULL,
  `subd` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `zipcode` varchar(4) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_address`:
--

--
-- Dumping data for table `tbl_address`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_adopt_transc`
--
-- Creation: Sep 19, 2018 at 04:41 PM
--

CREATE TABLE IF NOT EXISTS `tbl_adopt_transc` (
  `transc_id` int(100) NOT NULL AUTO_INCREMENT,
  `is_adopted` tinyint(1) NOT NULL,
  `tbl_users_user_id` int(5) NOT NULL,
  `tbl_pets_pet_id` int(100) NOT NULL,
  PRIMARY KEY (`transc_id`),
  KEY `fk_tbl_adopt_transc_tbl_users1_idx` (`tbl_users_user_id`),
  KEY `fk_tbl_adopt_transc_tbl_pets1_idx` (`tbl_pets_pet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_adopt_transc`:
--   `tbl_pets_pet_id`
--       `tbl_pets` -> `pet_id`
--   `tbl_users_user_id`
--       `tbl_users` -> `user_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document`
--
-- Creation: Sep 19, 2018 at 04:41 PM
--

CREATE TABLE IF NOT EXISTS `tbl_document` (
  `document_id` int(100) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(45) NOT NULL,
  `tbl_file_file_id` int(100) NOT NULL,
  `tbl_pets_pet_id` int(100) NOT NULL,
  PRIMARY KEY (`document_id`),
  KEY `fk_tbl_document_tbl_file1_idx` (`tbl_file_file_id`),
  KEY `fk_tbl_document_tbl_pets1_idx` (`tbl_pets_pet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_document`:
--   `tbl_file_file_id`
--       `tbl_file` -> `file_id`
--   `tbl_pets_pet_id`
--       `tbl_pets` -> `pet_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--
-- Creation: Sep 19, 2018 at 04:39 PM
--

CREATE TABLE IF NOT EXISTS `tbl_file` (
  `file_id` int(100) NOT NULL AUTO_INCREMENT,
  `file_type` varchar(100) NOT NULL,
  `file_size` int(100) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_file`:
--

--
-- Dumping data for table `tbl_file`
--



-- --------------------------------------------------------

--
-- Table structure for table `tbl_notif`
--
-- Creation: Sep 19, 2018 at 04:41 PM
--

CREATE TABLE IF NOT EXISTS `tbl_notif` (
  `notif_id` int(100) NOT NULL AUTO_INCREMENT,
  `is_accepted` tinyint(1) NOT NULL,
  `is_reviewed` tinyint(1) NOT NULL,
  `rejection_reason` varchar(500) NOT NULL,
  `accepted_reason` varchar(500) NOT NULL,
  `tbl_adopt_transc_transc_id` int(100) NOT NULL,
  PRIMARY KEY (`notif_id`),
  KEY `fk_tbl_notif_tbl_adopt_transc1_idx` (`tbl_adopt_transc_transc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_notif`:
--   `tbl_adopt_transc_transc_id`
--       `tbl_adopt_transc` -> `transc_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pets`
--
-- Creation: Sep 19, 2018 at 04:41 PM
--

CREATE TABLE IF NOT EXISTS `tbl_pets` (
  `pet_id` int(100) NOT NULL AUTO_INCREMENT,
  `petname` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `bday` date NOT NULL,
  `document_id` varchar(100) NOT NULL,
  `donated_by` varchar(100) NOT NULL,
  `dsc` varchar(500) NOT NULL,
  `tbl_users_user_id` int(5) NOT NULL,
  `tbl_file_file_id` int(100) NOT NULL,
  PRIMARY KEY (`pet_id`),
  KEY `fk_tbl_pets_tbl_users1_idx` (`tbl_users_user_id`),
  KEY `fk_tbl_pets_tbl_file1_idx` (`tbl_file_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_pets`:
--   `tbl_file_file_id`
--       `tbl_file` -> `file_id`
--   `tbl_users_user_id`
--       `tbl_users` -> `user_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--
-- Creation: Sep 19, 2018 at 05:06 PM
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_type` int(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `bday` date NOT NULL,
  `contact_no` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tbl_address_address_id` int(4) NOT NULL,
  `tbl_file_file_id` int(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_tbl_users_tbl_address_idx` (`tbl_address_address_id`),
  KEY `fk_tbl_users_tbl_file1_idx` (`tbl_file_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tbl_users`:
--   `tbl_address_address_id`
--       `tbl_address` -> `address_id`
--   `tbl_file_file_id`
--       `tbl_file` -> `file_id`
--

--
-- Dumping data for table `tbl_users`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_adopt_transc`
--
ALTER TABLE `tbl_adopt_transc`
  ADD CONSTRAINT `fk_tbl_adopt_transc_tbl_pets1` FOREIGN KEY (`tbl_pets_pet_id`) REFERENCES `tbl_pets` (`pet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_adopt_transc_tbl_users1` FOREIGN KEY (`tbl_users_user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_document`
--
ALTER TABLE `tbl_document`
  ADD CONSTRAINT `fk_tbl_document_tbl_file1` FOREIGN KEY (`tbl_file_file_id`) REFERENCES `tbl_file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_docutbl_usersment_tbl_pets1` FOREIGN KEY (`tbl_pets_pet_id`) REFERENCES `tbl_pets` (`pet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_notif`
--
ALTER TABLE `tbl_notif`
  ADD CONSTRAINT `fk_tbl_notif_tbl_adopt_transc1` FOREIGN KEY (`tbl_adopt_transc_transc_id`) REFERENCES `tbl_adopt_transc` (`transc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_pets`
--
ALTER TABLE `tbl_pets`
  ADD CONSTRAINT `fk_tbl_pets_tbl_file1` FOREIGN KEY (`tbl_file_file_id`) REFERENCES `tbl_file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_pets_tbl_users1` FOREIGN KEY (`tbl_users_user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_tbl_users_tbl_address` FOREIGN KEY (`tbl_address_address_id`) REFERENCES `tbl_address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_users_tbl_file1` FOREIGN KEY (`tbl_file_file_id`) REFERENCES `tbl_file` (`file_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
