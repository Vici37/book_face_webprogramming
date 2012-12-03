-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2012 at 12:22 PM
-- Server version: 5.1.66
-- PHP Version: 5.3.6-13ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Book_Face`
--
CREATE DATABASE `Book_Face` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Book_Face`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`status_id`, `user_id`, `comment`, `time`) VALUES
(3, 24, 'This is a comment\r\n\r\n-Troy', '2012-12-10 01:01:01'),
(3, 28, 'This is another comment', '2012-12-10 01:01:02'),
(3, 29, 'This is a comment', '2012-12-03 11:17:24'),
(3, 29, 'comment take 2', '2012-12-03 11:17:47'),
(40, 29, 'I''m commenting on my own status!', '2012-12-03 11:25:35'),
(41, 29, 'yadda', '2012-12-03 12:08:24'),
(41, 29, 'as;ldkfjads;lfkjads;fkljads;f', '2012-12-03 12:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `friends_relations`
--

CREATE TABLE IF NOT EXISTS `friends_relations` (
  `user_id` int(11) NOT NULL,
  `friend_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Who is friends with who';

--
-- Dumping data for table `friends_relations`
--

INSERT INTO `friends_relations` (`user_id`, `friend_user_id`) VALUES
(30, 29),
(24, 29);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `user_id`, `status`, `time`) VALUES
(3, 24, 'My name is Troy.', '2012-12-02 20:56:26'),
(50, 29, 'a', '2012-12-03 12:10:21'),
(49, 29, 'a', '2012-12-03 12:10:17'),
(48, 29, 'a', '2012-12-03 12:10:13'),
(47, 29, 'a', '2012-12-03 12:10:11'),
(46, 29, 'a', '2012-12-03 12:10:10'),
(45, 29, 'a', '2012-12-03 12:10:08'),
(44, 29, 'a', '2012-12-03 12:09:48'),
(43, 29, 'a', '2012-12-03 12:09:44'),
(42, 29, 'a', '2012-12-03 12:09:41'),
(41, 30, 'My first status', '2012-12-03 12:06:44'),
(40, 29, 'My new status', '2012-12-03 11:22:25'),
(31, 29, '', '2012-12-02 21:20:14'),
(32, 29, '', '2012-12-02 21:20:14'),
(33, 29, '', '2012-12-02 21:20:16'),
(34, 29, '', '2012-12-02 21:20:16'),
(35, 29, 'asdf', '2012-12-02 21:21:58'),
(36, 29, 'SELECT * FROM statuses FULL JOIN user_information ON statuses.user_id=user_information.user_id WHERE statuses.user_id=''29'' ORDER BY time DESC LIMIT 5', '2012-12-02 21:37:44'),
(37, 24, '1324', '2012-12-02 21:45:27'),
(38, 24, 'a', '2012-12-02 21:50:48'),
(39, 24, 'b', '2012-12-02 21:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE IF NOT EXISTS `user_information` (
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `gender` text COMMENT 'Optional'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`user_id`, `first_name`, `last_name`, `gender`) VALUES
(25, 'asdf', 'adsf', NULL),
(24, 'asdf', 'fdsa', NULL),
(23, 'asdf', 'asdf', NULL),
(28, 'asdf', 'asdf', 'Female'),
(29, 'troy', 'sornson', 'Male'),
(30, 'asdfads', 'fadsfadsfasd', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email` text NOT NULL,
  `password` text NOT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This is the key for all other tables',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='This table used for login purposes' AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `user_id`) VALUES
('whatever@here1.com', 'ddfcbc820f415bda61c38516829c508d4762d9a781dc9bdb52d04dc20036dbd8313ed0556b7be712086b5ab308c88e926323737fe20e7c94', 30),
('whatever@here.com', 'b577496958b1c54c281ae6b7897ee340236afbad81dc9bdb52d04dc20036dbd8313ed0557ffe274f8c8c08bba8c6843f4f0d6b1fab23c351', 29),
('a@a.c', '1a7d285e542b567059246a2adda8a93f1286207481dc9bdb52d04dc20036dbd8313ed0553b2622c083beb9f6bd54f78e6ddc3f7bb2fa8e37', 28),
('a@a.b', 'b82936ac436a7e0889a8b2bc08972e2b1cc9bc9881dc9bdb52d04dc20036dbd8313ed055cb29f6f55041152c74719a57af26fb4f54855841', 25),
('a@a.a', 'd656370089fedbd4313c67bfdc24151fb7c0fe8b81dc9bdb52d04dc20036dbd8313ed0557e309907e0e24722061fd0225c732fe9a46f19a0', 24),
('asdf', '3da541559918a808c2402bba5012f6c60b27661c81dc9bdb52d04dc20036dbd8313ed055d631600ee726f291e0aed59252c68b6565ea6803', 23);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
