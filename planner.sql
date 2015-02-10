-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2014 at 07:10 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`) VALUES
(1, 'Cygnis'),
(2, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `street_address` varchar(200) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `account_id`, `first_name`, `last_name`, `phone`, `mobile`, `fax`, `email`, `street_address`, `zip`, `city`, `country`) VALUES
(1, 2, 'b', 'b', 'b', 'b', '', 'a@yahoo.com', 'a', 'a', 'a', 'Switzerland'),
(2, 2, 'b', 'b', 'b', 'b', 'b', 'b@yahoo.com', 'a', 'a', 'a', 'Switzerland'),
(3, 2, 'j', 'j', 'j', 'j', 'j', 'a@yahoo.com', 'a', 'a', 'a', 'Switzerland'),
(4, 2, 'g', 'g', 'g', 'g', 'g', 'a@yahoo.com', 's', 's', 's', 'Switzerland');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `day_code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `code` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `email`, `password`, `first_name`, `last_name`, `mobile`, `pic`, `code`, `status`, `is_verified`) VALUES
(2, 'jason@yahoo.com', '', 'Jason', 'Bourne', '323232', '1417498029.png', '3a6ae00a0fef7e9f35ccd6f1cf6713d2', 'inactive', 0),
(3, 'iqbal@yahoo.com', '$2y$10$EwEdOUDJYOKzFb3DNSzuhOesKUgz59AM1ZWAgjDVm.A6TYq.O0x96', 'a', 'a', NULL, NULL, 'f3d707e94398e28bafa5710d005f8fe4', 'inactive', 0);

-- --------------------------------------------------------

--
-- Table structure for table `person_accounts`
--

CREATE TABLE IF NOT EXISTS `person_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `mode` enum('admin','resource') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `person_accounts`
--

INSERT INTO `person_accounts` (`id`, `account_id`, `resource_id`, `mode`, `first_name`, `last_name`, `color`, `timezone`, `notes`, `mobile`, `pic`) VALUES
(1, 1, 1, 'admin', 'Jason', 'Bourne', '', '', '', '', ''),
(2, 1, 2, 'resource', 'Iqbal', 'Malik', '#000000', 'Pacific/Gambier', '', '1234567', '1417325650.jpg'),
(3, 1, 2, 'resource', 'Jason', 'Bourne', '#000000', 'America/Anchorage', '', '323232', '1417498029.png'),
(4, 2, 3, 'admin', 'a', 'a', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `budget` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Archived','Pending','Planned','Floating') NOT NULL,
  `date_created` datetime NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_resources`
--

CREATE TABLE IF NOT EXISTS `project_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `type` enum('Person','Vehicle') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_services`
--

CREATE TABLE IF NOT EXISTS `project_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE IF NOT EXISTS `social_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `basecamp` varchar(255) NOT NULL,
  `trello` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `harvest` varchar(255) NOT NULL,
  `dropbox` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `account_id`, `name`, `pic`, `timezone`, `color`, `notes`) VALUES
(2, 1, 'Car', '1417497987.png', 'Pacific/Midway', '#000000', ''),
(3, 1, 'Bike', '1417498002.png', 'Pacific/Midway', '#000000', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
