-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2011 at 10:26 AM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pathbost_ob`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `login` varchar(100) NOT NULL DEFAULT '',
  `passwd` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `login`, `passwd`) VALUES
(1, 'Jatinder', 'Thind', 'phpsense', 'ba018360fc26e0cc2e929b8e071f052d'),
(145, 'Tim', 'McKenna', 'tim', '3abf00fa61bfae2fff9133375e142416');

-- --------------------------------------------------------

--
-- Table structure for table `OBsoupVolunteers`
--

CREATE TABLE IF NOT EXISTS `OBsoupVolunteers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `OBsoupVolunteers`
--

INSERT INTO `OBsoupVolunteers` (`id`, `email`, `name`, `password`) VALUES
(145, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(146, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(147, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(148, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(149, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(150, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(151, 'mckenna.tim@gmail.com', 'Tim McKenna', ''),
(152, 'perimckenna@yahoo.com', 'Tim McKenna', ''),
(153, '', '', ''),
(154, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjjjjj'),
(155, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjj'),
(156, 'g', 'Tio', 'j'),
(157, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjj'),
(158, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjj'),
(159, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjj'),
(160, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjj'),
(161, 'mckenna.tim@gmail.com', 'Tim McKenna', 'jjj');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `organizer` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `info` text,
  `projdate` varchar(100) NOT NULL,
  `leadtime` varchar(100) NOT NULL,
  `location` varchar(120) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pid`, `organizer`, `title`, `description`, `info`, `projdate`, `leadtime`, `location`) VALUES
(1, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', ''),
(2, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', ''),
(3, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', ''),
(4, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', ''),
(5, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', ''),
(6, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', ''),
(7, '', 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prOutlines`
--

CREATE TABLE IF NOT EXISTS `prOutlines` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `info` text,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

--
-- Dumping data for table `prOutlines`
--

INSERT INTO `prOutlines` (`oid`, `title`, `description`, `info`) VALUES
(145, 'soup', 'A soup project brings hot soup to the OB site. Key members find or create the soup. Team members work to facilitate getting the soup to the OB site.', 'See soup page in the OB wiki - http://wiki.occupyboston.org/wiki/soup\r\nfor guidelines on safe procedures, templates for soup label, ingredients list, menu and directions'),
(147, 'energy', 'An energy project brings power to the OB site.', 'Guidelines are available at'),
(148, 'event', 'An event project creates an off site event in support of the occupy movement', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `roledesc` varchar(120) DEFAULT NULL,
  `num` int(2) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`rid`, `oid`, `role`, `roledesc`, `num`) VALUES
(145, 145, 'cook', 'cook the soup', 2),
(146, 145, 'setup', 'Get the thermos to the soup kitchen', 1),
(149, 145, 'delivery', 'Deliver the soup thermos from the soup kitchen to the site', 1),
(150, 145, 'retrieve', 'Retrieve the thermos from the site and delver back to the group', 1),
(151, 145, 'promo', 'create menu description, ingredient list and label for soup', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `trid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `roledesc` varchar(120) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`trid`, `pid`, `role`, `roledesc`, `id`) VALUES
(16, 7, 'cook', 'cook the soup', NULL),
(17, 7, 'cook', 'cook the soup', NULL),
(18, 7, 'setup', 'Get the thermos to the soup kitchen', NULL),
(19, 7, 'delivery', 'Deliver the soup thermos from the soup kitchen to the site', NULL),
(20, 7, 'retrieve', 'Retrieve the thermos from the site and delver back to the group', NULL),
(21, 7, 'promo', 'create menu description, ingredient list and label for soup', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
