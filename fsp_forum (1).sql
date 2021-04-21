-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2021 at 10:46 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fsp_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

DROP TABLE IF EXISTS `catagory`;
CREATE TABLE IF NOT EXISTS `catagory` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`cat_id`, `cat_name`) VALUES
(1, 'Games'),
(2, 'Random'),
(3, 'Tech'),
(4, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(8) NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int(8) NOT NULL,
  `post_by` int(8) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(23, 'This is the programming, post anything programming here\r\n\r\nPosts unrelated may be deleted or moved to the random catagory', '2021-04-20 10:55:00', 11, 1),
(22, 'Here you can post anything tech\r\n\r\nposts unrelated may be deleted, please post those in the random category', '2021-04-20 10:16:50', 10, 1),
(21, 'Hi, thanks for visiting this category\r\n\r\nYou can post everything here, I don\'t care: posts with illegal stuff happening might be deleted', '2021-04-20 10:13:45', 9, 1),
(20, 'Here you can post about everything games.\r\n\r\nPosts about things unrelated may be deleted if I feel like it.\r\n\r\nOther than that, it\'s a free for all\r\n\r\n', '2021-04-20 10:08:13', 8, 1),
(24, '{Some nono stuff was posted here, we don\'t do that}\r\n\r\n-Admin boi\r\n', '2021-04-20 12:39:37', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `idReplies` int(11) NOT NULL AUTO_INCREMENT,
  `reply_content` text NOT NULL,
  `reply_date` datetime NOT NULL,
  `topics_idtopics` int(11) NOT NULL,
  `users_userID` int(11) NOT NULL,
  PRIMARY KEY (`idReplies`),
  KEY `fk_Replies_topics1` (`topics_idtopics`),
  KEY `fk_Replies_users1` (`users_userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `Topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `Topic_subject` varchar(200) DEFAULT NULL,
  `topic_date` datetime DEFAULT NULL,
  `users_userID` int(11) NOT NULL,
  `Catagory_cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Topic_id`),
  KEY `fk_topics_users` (`users_userID`),
  KEY `fk_topics_Catagory1` (`Catagory_cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`Topic_id`, `Topic_subject`, `topic_date`, `users_userID`, `Catagory_cat_id`) VALUES
(11, 'Welcome to the programming catagory', '2021-04-20 10:55:00', 1, 4),
(10, 'Welcome to the tech catagory', '2021-04-20 10:16:50', 1, 3),
(9, 'Welcome to the random catagory', '2021-04-20 10:13:45', 1, 2),
(8, 'Welcome to the Games catagory', '2021-04-20 10:08:13', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `date_created`) VALUES
(1, 'ovab', '1234567', '2021-04-06 14:22:36'),
(2, 'ovab8meme', 'Lmao69', '2021-04-12 12:21:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
