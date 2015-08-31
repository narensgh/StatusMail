-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2014 at 03:24 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `application`
--

-- --------------------------------------------------------

--
-- Table structure for table `pm_project`
--

CREATE TABLE IF NOT EXISTS `pm_project` (
  `project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pm_project`
--

INSERT INTO `pm_project` (`project_id`, `project_name`, `date_added`) VALUES
(1, 'Test Project', '2014-08-31 23:51:42'),
(2, 'test 2', '2014-08-31 23:56:03'),
(3, 'test 3', '2014-09-01 00:03:51'),
(4, 'test 4', '2014-09-01 00:04:05'),
(5, 'test6', '2014-10-31 08:04:25'),
(6, 'Test Project 2 ', '2014-10-31 08:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `todo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `todo_list_id` int(10) unsigned NOT NULL,
  `description` varchar(500) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`todo_id`),
  KEY `todo_list_id` (`todo_list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todo_id`, `todo_list_id`, `description`, `assigned_to`, `date_updated`, `active`, `date_added`) VALUES
(45, 3, 'testing to do list 1 todo 3', 0, '2014-12-09 12:24:17', 'yes', '2014-12-09 17:54:17'),
(47, 2, 'testing to do list 1 todo 2', 0, '2014-12-16 08:44:19', 'yes', '0000-00-00 00:00:00'),
(48, 2, 'testing to do list 1 todo 1 edited', 0, '2014-12-16 13:53:10', 'yes', '2014-12-16 19:23:10'),
(53, 3, 'testing to do list 1 todo 2', 0, '2014-12-16 09:37:47', 'yes', '2014-12-16 15:07:47'),
(55, 4, 'adding list 4 todo 1', 0, '2014-12-16 11:20:17', 'yes', '2014-12-16 16:50:17'),
(56, 5, ' adding list 5 todo 1', 0, '2014-12-16 11:21:13', 'yes', '2014-12-16 16:51:13'),
(59, 6, 'one edited by narendra', 0, '2014-12-19 12:34:27', 'yes', '2014-12-19 18:04:27'),
(61, 1, 'adding to do for abhinav', 0, '2014-12-19 13:13:38', 'yes', '2014-12-19 18:43:38'),
(62, 1, 'testing completed', 0, '2014-12-19 14:03:08', 'yes', '2014-12-19 19:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `todo_list`
--

CREATE TABLE IF NOT EXISTS `todo_list` (
  `todo_list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `listname` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`todo_list_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `todo_list`
--

INSERT INTO `todo_list` (`todo_list_id`, `project_id`, `listname`, `date_added`, `date_modified`) VALUES
(1, 1, 'test1', '2014-11-05 11:26:51', '2014-11-05 05:56:51'),
(2, 1, 'test', '2014-11-05 11:35:52', '2014-11-05 06:05:52'),
(3, 1, 'test3', '2014-11-05 11:37:06', '2014-11-05 06:07:06'),
(4, 1, 'testing list 4', '2014-12-16 16:48:32', '2014-12-16 11:18:32'),
(5, 1, 'testing list 5', '2014-12-16 16:51:02', '2014-12-16 11:21:02'),
(6, 1, ' ankur', '2014-12-16 19:24:45', '2014-12-16 13:54:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`todo_list_id`) REFERENCES `todo_list` (`todo_list_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `todo_list`
--
ALTER TABLE `todo_list`
  ADD CONSTRAINT `todo_list_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `pm_project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
