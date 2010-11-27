-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2010 at 05:27 PM
-- Server version: 5.0.91
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `life_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE IF NOT EXISTS `tbl_blog` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date_posted` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `title`, `content`, `date_posted`, `user_id`) VALUES
(1, 'Welcome to LifeLitUp', 'blah blah blah BLAHHHH', '2010-11-26 16:43:30', 6),
(2, 'what''s this bro?', 'this is a blog! \r\n\r\ntest 1\r\n2\r\n3\r\n\r\n:O', '2010-11-26 17:00:50', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`) VALUES
(1, 'Water');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goals`
--

CREATE TABLE IF NOT EXISTS `tbl_goals` (
  `id` int(11) NOT NULL auto_increment,
  `categoryid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_goals`
--

INSERT INTO `tbl_goals` (`id`, `categoryid`, `name`, `icon`, `info`) VALUES
(1, 1, 'Scuba Diving', 'http://cache.toribash.com/forum/images/ca_morpheus_gray/misc/poll_posticon.gif', 'Scuba diving is held in many regards as the highest point of exploding ginger bread men.'),
(2, 1, 'Jetskiing', 'http://cache.toribash.com/forum/veb2009_images/posticons/fgt3.gif', 'Jetskiing is pretty cool lol');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `logged_in` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `name`, `url`, `logged_in`) VALUES
(1, 'Home', 'index.php', 0),
(2, 'Login', 'login.php', 1),
(3, 'Register', 'register.php', 1),
(4, 'Profile', 'profile.php', 0),
(5, 'List', 'todo.php', 0),
(6, 'Logout', 'login.php?action=logout', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo`
--

CREATE TABLE IF NOT EXISTS `tbl_todo` (
  `id` int(11) NOT NULL auto_increment,
  `goal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_todo`
--

INSERT INTO `tbl_todo` (`id`, `goal_id`, `user_id`) VALUES
(1, 1, 1),
(20, 2, 6),
(21, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(24) NOT NULL,
  `salt` varchar(3) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username-unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `salt`) VALUES
(6, 'bob', 'b1a83f4027aef008ab5f8ef8837fdab8e54f0cc4', '', '5b0'),
(8, 'Lapsus', '8a37018f060cff49e3f64014732cab7fd82f01ef', '', '10d');
