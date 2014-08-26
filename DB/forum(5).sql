-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2014 at 12:25 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`categories_id`),
  UNIQUE KEY `categories_id` (`categories_id`),
  KEY `added_by` (`added_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `added_by`, `name`, `description`, `status`) VALUES
(1, 'shefa', 'MYSQL', 'everything about mysql', 1),
(2, 'shefa', 'PHP 5.4/5.5', 'PHP books / tutorials / stuff', 1),
(3, 'shefa', 'JavaScript', 'NEED TO KNOW/HAVE', 1),
(4, 'shefa', 'FAQ', 'Frequently asked questions ', 1),
(5, 'shefa', 'Random Topics', 'stuff about stuff and some other stuff ', 1),
(11, 'shefa', 'asdfasdfasdf', 'asdfasfd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `date_added` int(11) NOT NULL,
  `content` text NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `edited_by` varchar(50) NOT NULL,
  `edited_when` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_id` (`post_id`),
  KEY `topic_id` (`topic_id`),
  KEY `added_by` (`added_by`),
  KEY `post_id_2` (`post_id`),
  KEY `topic_id_2` (`topic_id`),
  KEY `added_by_2` (`added_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `topic_id`, `added_by`, `date_added`, `content`, `view_count`, `edited_by`, `edited_when`) VALUES
(2, 1, 'shefa', 2147483647, 'asdsfsdfsdfasdfsafdsadfsdfsdf', 0, '0', 0),
(3, 1, 'shefa', 2147483647, 'cffdfdgfghfdgh', 0, '0', 0),
(4, 16, 'vknikov', 0, 'Пу пу, стискайте палци!', 0, '', 0),
(5, 17, 'vknikov', 0, 'Another one bites the dust', 0, '', 0),
(6, 18, 'vknikov', 0, 'ПОМОООООЩ!', 0, '', 0),
(7, 19, 'vknikov', 0, 'Абе лети ми се тия дни', 0, '', 0),
(11, 24, 'vknikov', 1409082217, 'Точно така!', 0, '', 0),
(16, 24, 'vknikov', 1409088035, 'Още един тест', 0, '', 0),
(17, 24, 'vknikov', 1409088049, 'И още един... тест.', 0, 'vknikov', 1409089812),
(19, 26, 'vknikov', 1409090035, 'Мисля, че работи! :)', 0, '', 0),
(20, 26, 'vknikov', 1409090051, 'Мхм, така изглежда. Наистина работи!', 0, 'vknikov', 1409090063),
(21, 27, 'vknikov', 1409091293, 'Тук можете да намерите всякаква информация относно PHP. Enjoy!', 0, 'vknikov', 1409091779);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `title`, `count`) VALUES
(1, 'jedi', 0),
(2, 'тест', 4),
(3, 'php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `title_tags`
--

CREATE TABLE IF NOT EXISTS `title_tags` (
  `topic_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title_tags`
--

INSERT INTO `title_tags` (`topic_id`, `tag_id`) VALUES
(7, 1),
(7, 2),
(7, 2),
(7, 2),
(7, 2),
(7, 2),
(27, 3);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `date_added` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `categories_id` (`categories_id`),
  KEY `added_by` (`added_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `categories_id`, `added_by`, `date_added`, `title`, `status`, `counter`) VALUES
(1, 1, 'shefa', 2147483647, 'Testing Relations', 2, 0),
(16, 1, 'vknikov', 2147483647, 'Опала', 1, 0),
(17, 1, 'vknikov', 2147483647, 'Test', 1, 0),
(18, 3, 'vknikov', 0, 'Как да си подкараме дебъгера', 1, 0),
(19, 4, 'vknikov', 0, 'Хвърчило?', 1, 0),
(24, 5, 'vknikov', 1409082217, 'Първи тест', 1, 0),
(26, 5, 'vknikov', 1409090035, 'Втори тест', 1, 0),
(27, 2, 'vknikov', 1409091293, 'Всичко за PHP', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `real_name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_reg` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login_2` (`login`),
  KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login`, `pass`, `real_name`, `email`, `date_reg`, `status`, `active`) VALUES
(1, 'kiko', 'dsadas', 'Kristian Mariyanov', 'hfu@ABV.BG', 123912498, 1, 1),
(2, 'shefa', '496238d7b33af728f369b92e0543ada0', 'pesho', 'pesho@pes.com', 0, 2, 1),
(3, 'gosho', 'dsa', 'asd', 'dsa', 0, 1, 1),
(4, 'pesho', 'dsa', 'asd', 'dsa', 0, 1, 1),
(5, 'vknikov', 'e10adc3949ba59abbe56e057f20f883e', 'duncan mclaoud', 'stata@gmail.com', 1408986845, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
