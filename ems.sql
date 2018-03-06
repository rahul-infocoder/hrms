-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2013 at 08:52 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_project`
--

CREATE TABLE IF NOT EXISTS `assign_project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `eid` int(10) NOT NULL,
  `esdatefrom` int(10) DEFAULT NULL,
  `esdateto` int(10) DEFAULT NULL,
  `remarks` text,
  `status` char(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `assign_project`
--

INSERT INTO `assign_project` (`id`, `pid`, `eid`, `esdatefrom`, `esdateto`, `remarks`, `status`) VALUES
(1, 1, 1, 1380578400, 1383174000, 'HURRR', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empid` int(10) NOT NULL,
  `logindate` int(10) NOT NULL,
  `signintime` int(10) NOT NULL,
  `signouttime` int(10) DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `empid`, `logindate`, `signintime`, `signouttime`, `remark`) VALUES
(4, 1, 1381356000, 1381363970, 1381365592, ''),
(5, 1, 1381442400, 1381474512, 1381474550, NULL),
(7, 1, 1383001200, 1383013558, 1383013584, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'AWACP'),
(2, 'Cloud18');

-- --------------------------------------------------------

--
-- Table structure for table `increments`
--

CREATE TABLE IF NOT EXISTS `increments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empid` int(10) NOT NULL,
  `increment` int(10) NOT NULL,
  `doi` int(10) NOT NULL,
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `increments`
--

INSERT INTO `increments` (`id`, `empid`, `increment`, `doi`, `remark`) VALUES
(9, 1, 10, 1383951600, 'For Taking Too Many Leaves');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empid` int(10) NOT NULL,
  `leavefrom` int(10) NOT NULL,
  `leaveto` int(10) NOT NULL,
  `halfday` int(5) NOT NULL DEFAULT '0',
  `fullday` int(5) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `approved` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `empid`, `leavefrom`, `leaveto`, `halfday`, `fullday`, `reason`, `approved`) VALUES
(5, 1, 1380578400, 1381442400, 0, 10, 'AAAA', 'Y'),
(6, 1, 1380578400, 1380664800, 0, 1, 'Hello Test', 'N'),
(7, 1, 1380578400, 1381960800, 0, 16, 'Test', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `projectname` varchar(255) NOT NULL,
  `pstartdate` int(10) NOT NULL,
  `penddate` int(10) NOT NULL,
  `pdescription` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectname`, `pstartdate`, `penddate`, `pdescription`) VALUES
(1, 'Cachell', 1383057147, 1383057147, 'Ecommerce');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('86b2ef48c596dda2c3da59132927206e', '::1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1383998283, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `doj` int(10) NOT NULL,
  `dob` int(10) NOT NULL,
  `salary` double(10,2) NOT NULL,
  `current_salary` double(10,2) NOT NULL,
  `experience` int(10) NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `emergency_number` varchar(12) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `plain` varchar(255) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `added_on` int(11) unsigned NOT NULL,
  `active` char(1) NOT NULL DEFAULT 'Y',
  `user_type` char(1) NOT NULL DEFAULT 'E',
  `area` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cid`, `gender`, `doj`, `dob`, `salary`, `current_salary`, `experience`, `fathername`, `emergency_number`, `contact_name`, `contact_email`, `password`, `plain`, `phone_num`, `address`, `added_on`, `active`, `user_type`, `area`, `department`, `designation`, `image`) VALUES
(1, 2, 'F', 1373148000, 497833200, 4000.00, 4400.00, 12, 'Sujeet Kumar Srivastava', '9506292999', 'Akanksha Srivastava', 'ak@gmail.com', '1e5b44a846ed7b6670e040ba3216e56eb7eaf1f8', 'admin', '9793645652', 'Alambagh, Lucknow', 1381403995, 'Y', 'E', 'ALLAHABAD', 'Computers', 'Software Developer', '1321231321.jpg'),
(2, 2, 'F', 1373148000, 484079400, 8000.00, 8000.00, 15, 'Mr. Gupta', '9795986000', 'Sona Gupta', 'sona@gmail.com', '1e5b44a846ed7b6670e040ba3216e56eb7eaf1f8', 'admin', '9795986000', 'Alambagh', 1383988018, 'Y', 'E', 'Lucknow', 'Computers', 'Office Assistant', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_reports`
--

CREATE TABLE IF NOT EXISTS `work_reports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `eid` int(10) NOT NULL,
  `reportdate` int(10) NOT NULL,
  `report` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `work_reports`
--

INSERT INTO `work_reports` (`id`, `eid`, `reportdate`, `report`) VALUES
(1, 1, 1383087600, 'aaaaaaaaaaa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
