-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2011 at 09:54 AM
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
  `date_posted` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
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
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `tbl` varchar(28) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `user_id`, `page_id`, `date_posted`, `content`, `tbl`) VALUES
(1, 6, 2, '2010-11-27 17:51:06', 'omg omg this is soooo cool - from Hamr', 'tbl_blog'),
(16, 13, 1, '2010-12-28 12:30:02', 'testing 1 23', 'tbl_goals'),
(15, 13, 2, '2010-12-28 12:29:13', 'eeeest', 'tbl_blog'),
(14, 13, 2, '2010-12-28 12:29:03', '...reeee', 'tbl_blog'),
(11, 6, 2, '2010-11-27 21:24:59', '...OMG I SO WANT TO JET SKI ALREADY FFFFUCK', 'tbl_goals'),
(9, 6, 2, '2010-11-27 21:22:28', '...dv', 'tbl_blog'),
(10, 6, 2, '2010-11-27 21:24:22', 'HEY JET SKI AWESOME', 'tbl_goals'),
(17, 13, 2, '2010-12-28 12:33:27', 'jetskiing is the shit man', 'tbl_goals'),
(18, 13, 2, '2011-01-05 18:54:39', 'test y0', 'tbl_blog'),
(19, 13, 1, '2011-01-05 18:57:35', '...yyrty', 'tbl_blog'),
(20, 13, 2, '2011-01-05 19:03:15', '...dsdssdsdsd', 'tbl_blog'),
(21, 13, 2, '2011-01-05 19:07:11', 'fghhfghfghfghfg', 'tbl_goals'),
(22, 26, 1, '2011-01-05 19:20:12', 'this is a very interesting goal... I will do this naked.', 'tbl_goals'),
(23, 13, 1, '2011-01-05 19:20:54', 'no you wont!', 'tbl_goals');

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
-- Table structure for table `tbl_logs`
--

CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `id` int(11) NOT NULL auto_increment,
  `event_type` varchar(75) NOT NULL,
  `details` text NOT NULL,
  `log_date` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `event_type`, `details`, `log_date`) VALUES
(13, 'USER_LOGIN', '::1,localhost,login.php,0,http://localhost/llu/login.php', 1294263205),
(12, 'USER_REGISTRATION', '::1,localhost,register.php,0,http://localhost/llu/register.php', 1294262635);

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
-- Table structure for table `tbl_people`
--

CREATE TABLE IF NOT EXISTS `tbl_people` (
  `id` int(11) NOT NULL auto_increment,
  `ip` int(10) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tbl_people`
--

INSERT INTO `tbl_people` (`id`, `ip`, `time`) VALUES
(56, 1136881566, '2011-01-06 09:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo`
--

CREATE TABLE IF NOT EXISTS `tbl_todo` (
  `id` int(11) NOT NULL auto_increment,
  `goal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_todo`
--

INSERT INTO `tbl_todo` (`id`, `goal_id`, `user_id`) VALUES
(1, 1, 1),
(20, 2, 6),
(21, 1, 6),
(22, 1, 13),
(23, 2, 13),
(24, 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(24) NOT NULL,
  `salt` varchar(3) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username-unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `salt`) VALUES
(6, 'bob', 'b1a83f4027aef008ab5f8ef8837fdab8e54f0cc4', '', '5b0'),
(8, 'Lapsus', '8a37018f060cff49e3f64014732cab7fd82f01ef', '', '10d'),
(9, 'hog', '$2a$08$Rq8xQMFfqW/D8wc7BdzUCuia4UkjO4haU', '', ''),
(10, 'chac', '$2a$08$/549gvYsAzNyEcXATKmQO.uvieOQq4knzEB2Sb2Ch65Fgd4th//KG', '', ''),
(11, 'gay', '$2a$08$lHvtIbvCksYzxxJ876R4cuIYu9gLMMPL1I0veKAb9eMa86BH/RMfK', '', ''),
(12, 'fuck', '$P$Bx2wjNwj.MyIHHUjZfEOU3zwBHk/eL/', '', ''),
(13, 'man', '$P$BBHajW9TXgGO9jtqv9F4MMN3QaqKDI/', '', ''),
(14, 'cgrunwald', '$P$BObhbcoKX/1ezyH/gDqWLyxHzCp2pO0', '', ''),
(15, 'john', '$P$BQYZuu4xokWAMClTzF3M8eK3wSBXeN.', '', ''),
(16, 'ausername', '$P$BmcCK4V4O9DWIe26yfXd06itOPQCnm.', '', ''),
(17, 'fhty', '$P$BC4J9thpd3L7LhSCDeu92Qf6j7CgL40', '', ''),
(18, 'homoh', '$P$BWxW9rqtk6B//s6ahInIa52TPq44Q70', '', ''),
(19, '123', '$P$Bdl2SJ8kBmpM1Q6DrftACKNt6myBD3/', '', ''),
(20, 'dffdd', '$P$B.IMtVDt1yzWFJl4lv4Qinc1qfbgWb1', '', ''),
(21, 'ewewew', '$P$BL/bYwZ45/JwnpXrjOzjdrCY/nbVy61', '', ''),
(22, 'K123', '$P$BlBQs35V/cNmqeob2f.Gs59M3HAu4C/', '', ''),
(23, 'King', '$P$BXcVN3pjxygzzJXYLmUpPiaLkxFlLG.', '', ''),
(24, 'dfdf', '$P$BITmNG.sFWS8InrF0qUPFiWvKvxA1p/', '', ''),
(25, 'sfddffsd', '$P$Bl9I9U7LpgGVh5BRfzqLIpgQbL7ZiY0', '', ''),
(26, 'hack', '$P$BB8r2mbvf8jba9chg2bn8oqAxe.prT0', '', ''),
(27, 'faggots', '$P$BESxj5SCs8We8Yq4BEZCmJa4SK28Qx1', '', ''),
(28, 'ette', '$P$BDJF.zOyX/JU8pFtVqhByQokH8Y3kz.', '', ''),
(29, 'fvbgd', '$P$B0WkaMYqGChUKRFdqw1ZXdHk2fRHiJ0', '', ''),
(30, 'yjhft', '$P$BCtwp12xDh1e.RNGGVivj2Lu9nCveb.', '', ''),
(31, 'omg', '$P$BF4QghpG9w4y.L44VNgjsEFyQmAa38.', '', ''),
(32, 'penis', '$P$BDBUeyqKVPux/aysTuuieymxfRCKRq/', '', ''),
(33, 'sdffdssfd', '$P$B2/xD.XMoO3EL9rh6PJ2MKpC7mVTXm0', '', ''),
(34, 'woop', '$P$BrBDfgitSVSi1SnfANsAHDUrTDI4vf/', '', ''),
(35, 'sggsgs', '$P$BXCj5LrLoHhs9imHX/Wk3e88Srn91I0', '', ''),
(36, 'dffdfddfdffd', '$P$BxiddGgKQMRB3jxz/XX.eBTvPU76DM0', '', '');
