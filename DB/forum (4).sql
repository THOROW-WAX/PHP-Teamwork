-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2014 at 06:59 PM
-- Server version: 10.0.13-MariaDB-log
-- PHP Version: 5.5.15

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
`categories_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
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
`post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `date_added` int(11) NOT NULL,
  `content` text NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `edited_by` varchar(50) DEFAULT NULL,
  `edited_when` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `topic_id`, `added_by`, `date_added`, `content`, `view_count`, `edited_by`, `edited_when`) VALUES
(2, 1, 'shefa', 2147483647, 'asdsfsdfsdfasdfsafdsadfsdfsdf', 0, '0', 0),
(3, 1, 'shefa', 2147483647, 'cffdfdgfghfdgh', 0, '0', 0),
(4, 16, 'vknikov', 0, 'Пу пу, стискайте палци!', 0, NULL, 0),
(5, 17, 'vknikov', 0, 'Another one bites the dust', 0, NULL, 0),
(6, 18, 'vknikov', 0, 'ПОМОООООЩ!', 0, NULL, 0),
(7, 19, 'vknikov', 0, 'Абе лети ми се тия дни', 0, NULL, 0),
(8, 20, 'vknikov', 2147483647, 'Аз карам колееелоооо', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`tag_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `title_tags`
--

CREATE TABLE IF NOT EXISTS `title_tags` (
  `topic_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
`topic_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `date_added` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `categories_id`, `added_by`, `date_added`, `title`, `status`) VALUES
(1, 1, 'shefa', 2147483647, 'Testing Relations', 2),
(16, 1, 'vknikov', 2147483647, 'Опала', 1),
(17, 1, 'vknikov', 2147483647, 'Test', 1),
(18, 3, 'vknikov', 0, 'Как да си подкараме дебъгера', 1),
(19, 4, 'vknikov', 0, 'Хвърчило?', 1),
(20, 5, 'vknikov', 2147483647, 'Летя с колата', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `real_name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_reg` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '1'
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
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`categories_id`), ADD UNIQUE KEY `categories_id` (`categories_id`), ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD UNIQUE KEY `post_id` (`post_id`), ADD KEY `topic_id` (`topic_id`), ADD KEY `added_by` (`added_by`), ADD KEY `post_id_2` (`post_id`), ADD KEY `topic_id_2` (`topic_id`), ADD KEY `added_by_2` (`added_by`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
 ADD PRIMARY KEY (`topic_id`), ADD KEY `categories_id` (`categories_id`), ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `login_2` (`login`), ADD KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
