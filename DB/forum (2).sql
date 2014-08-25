-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2014 at 07:08 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `added_by`, `name`, `description`, `status`) VALUES
(1, 'shefa', 'MYSQL', 'everything about mysql', 1),
(2, 'shefa', 'PHP 5.4/5.5', 'PHP books / tutorials / stuff', 0),
(3, 'shefa', 'JavaScript', 'NEED TO KNOW/HAVE', 2),
(4, 'shefa', 'FAQ', 'Frequently asked questions ', 3),
(5, 'shefa', 'Random Topics', 'stuff about stuff and some other stuff ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `date_added` date NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `view_count` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_when` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `topic_id`, `added_by`, `date_added`, `title`, `content`, `view_count`, `edited_by`, `edited_when`) VALUES
(2, 1, 'shefa', '2014-08-06', 'testing relations whit post', 'asdsfsdfsdfasdfsafdsadfsdfsdf', 0, 0, '0000-00-00'),
(3, 1, 'shefa', '2014-08-13', 'testing relations whit topics', 'cffdfdgfghfdgh', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`tag_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `title`, `count`) VALUES
(1, 'php', 1),
(2, 'Java', 1),
(3, 'sql', 1);

-- --------------------------------------------------------

--
-- Table structure for table `title_tag`
--

CREATE TABLE IF NOT EXISTS `title_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title_tag`
--

INSERT INTO `title_tag` (`post_id`, `tag_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
`topic_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `added_by` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `categories_id`, `added_by`, `name`, `description`, `status`) VALUES
(1, 1, 'shefa', 'Testing Relations', 'asdfadfasdf', 2),
(2, 1, 'shefa', 'asdasd', 'asdasdas', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login`, `pass`, `real_name`, `email`, `date_reg`, `status`, `active`) VALUES
(1, 'kiko', 'dsadas', 'Kristian Mariyanov', 'hfu@ABV.BG', 123912498, 1, 1),
(2, 'shefa', 'shefaPass', 'pesho', 'pesho@pes.com', 0, 3, 1),
(3, 'gosho', 'dsa', 'asd', 'dsa', 0, 1, 1),
(4, 'pesho', 'dsa', 'asd', 'dsa', 0, 1, 1);

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
MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

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
