-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 11:22 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'PHP'),
(4, 'JAVA');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(6, 6, 'Sandra', 'mihajlo.p@gmail.com', 'O ne', 'approved', '2018-09-02'),
(7, 1, 'Mihajlo', 'mihajlo.p@gmail.com', '23123123', 'approved', '2018-09-04'),
(11, 1, 'Mihajlo', 'mihajlo.p@gmail.com', '123', 'approved', '2018-09-04'),
(12, 1, 'Mihajlo', 'mihajlo.p@gmail.com', 'Konjina', 'approved', '2018-09-04'),
(13, 11, 'Sandra', 'mihajlo.p@gmail.com', '12341241241', 'approved', '2018-09-04'),
(14, 2, 'Mihajlo', 'adw@fwaF.com', '1241243sdgsdgdsg', 'approved', '2018-09-04'),
(15, 2, 'Mihajlo', 'adw@fwaF.com', '1241243sdgsdgdsg', 'approved', '2018-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`, `post_views_count`) VALUES
(1, 1, 'CMS PHP Project', 'AntMan', '2018-09-03', 'image_1.jpg', 'WOW I really like PHP                ', 'Mihajlo, PHP', 'published', 21),
(2, 1, 'Javascript course 2', 'Superman2', '2018-09-02', 'image_5.jpg', 'This is really nice poLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis luctus magna, ac aliquam ipsum. Cras sem est, commodo a mattis at, accumsan sed urna. Pellentesque et pulvinar orci. Vivamus varius in dolor at sodales. Sed eu mollis tellus. Donec ut lacinia quam. Ut fermentum ultrices est ac consectetur. Maecenas in nisi mollis, faucibus ligula sit amet, mollis orci. Cras varius vehicula efficitur. Nulla egestas rutrum dolor, sit amet sollicitudin arcu varius ac.\r\n\r\nDonec auctor blandit turpis, vitae ultrices turpis lobortis quis. Morbi purus tellus, sagittis ac elementum ac, ullamcorper a libero. Proin pharetra urna sed quam scelerisque sodales. Etiam eleifend purus urna, id faucibus enim porttitor nec. Aliquam convallis massa tellus, vitae volutpat lectus porta non. Donec euismod, purus id placerat laoreet, ligula sapien convallis dui, et vestibulum elit nunc eget erat. Proin pellentesque, ipsum at lacinia ultrices, massa augue faucibus elit, eu feugiat lacus mauris a nulla. Maecenas nisl velit, fermentum id tortor vel, egestas vulputate lacus. Fusce id elit accumsan, consectetur magna id, ultrices neque. Proin nec ex sodales, pellentesque nulla vitae, iaculis massa.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci est. Donec fringilla nibh est, eget volutpat lacus suscipit in. In luctus ipsum tortor, non fringilla diam ornare nec. Fusce tincidunt lacus eget scelerisque malesuada. Phasellus finibus neque ac arcu molestie, eu tincidunt lacus maximus. Proin finibus, eros sit amet ultrices tincidunt, sem ipsum blandit ex, non ultrices nunc ligula in mi. Nunc quis dui vitae justo suscipit tincidunt quis sit amet odio. Nunc a purus ac dui iaculis consectetur id sit amet mauris. Vivamus in sem metus. Etiam ac placerat est. Pellentesque at metus fringilla, mattis sapien quis, dictum metus.\r\n\r\nMaecenas vitae luctus velit. Vivamus elementum pulvinar urna non posuere. Suspendisse at felis nisi. In ut interdum orci. Quisque varius massa sit amet orci volutpat, in finibus est scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vitae elit lectus. Mauris aliquet diam nec justo sagittis cursus. Vestibulum ut aliquet nunc. Ut justo nulla, placerat vel nisl sed, sodales fringilla nisl. Proin malesuada odio elit, nec porttitor quam blandit et. Nunc faucibus semper neque ac interdum. Nunc et imperdiet lectus, quis porttitor urna. Etiam in viverra odio. Aenean ut erat fermentum, ornare sem ac, scelerisque lectus.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent condimentum rhoncus quam vitae gravida. Etiam vel fringilla quam. Curabitur sed accumsan lectus. Nam eros odio, rutrum vitae arcu posuere, malesuada maximus turpis. Nunc pellentesque dui vitae augue interdum, nec elementum metus vehicula. Mauris consectetur urna vitae accumsan consectetur. Suspendisse placerat lectus at odio tempor maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus varius justo ultricies, posuere dui nec, fringilla diam. Etiam dignissim pharetra pharetra. Sed interdum quam non semper bibendum. Quisque sit amet vehicula libero, id facilisis quam. Vivamus orci orci, dapibus in nibh quis, facilisis congue eros. Aliquam eu maximus velit. Morbi cursus ac eros in mollisst                                                        ', 'javascript, course, class, Belinda', 'published', 3),
(6, 1, 'JAVA', 'AntMan', '2018-09-02', 'lambo_1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis luctus magna, ac aliquam ipsum. Cras sem est, commodo a mattis at, accumsan sed urna. Pellentesque et pulvinar orci. Vivamus varius in dolor at sodales. Sed eu mollis tellus. Donec ut lacinia quam. Ut fermentum ultrices est ac consectetur. Maecenas in nisi mollis, faucibus ligula sit amet, mollis orci. Cras varius vehicula efficitur. Nulla egestas rutrum dolor, sit amet sollicitudin arcu varius ac.\r\n\r\nDonec auctor blandit turpis, vitae ultrices turpis lobortis quis. Morbi purus tellus, sagittis ac elementum ac, ullamcorper a libero. Proin pharetra urna sed quam scelerisque sodales. Etiam eleifend purus urna, id faucibus enim porttitor nec. Aliquam convallis massa tellus, vitae volutpat lectus porta non. Donec euismod, purus id placerat laoreet, ligula sapien convallis dui, et vestibulum elit nunc eget erat. Proin pellentesque, ipsum at lacinia ultrices, massa augue faucibus elit, eu feugiat lacus mauris a nulla. Maecenas nisl velit, fermentum id tortor vel, egestas vulputate lacus. Fusce id elit accumsan, consectetur magna id, ultrices neque. Proin nec ex sodales, pellentesque nulla vitae, iaculis massa.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci est. Donec fringilla nibh est, eget volutpat lacus suscipit in. In luctus ipsum tortor, non fringilla diam ornare nec. Fusce tincidunt lacus eget scelerisque malesuada. Phasellus finibus neque ac arcu molestie, eu tincidunt lacus maximus. Proin finibus, eros sit amet ultrices tincidunt, sem ipsum blandit ex, non ultrices nunc ligula in mi. Nunc quis dui vitae justo suscipit tincidunt quis sit amet odio. Nunc a purus ac dui iaculis consectetur id sit amet mauris. Vivamus in sem metus. Etiam ac placerat est. Pellentesque at metus fringilla, mattis sapien quis, dictum metus.\r\n\r\nMaecenas vitae luctus velit. Vivamus elementum pulvinar urna non posuere. Suspendisse at felis nisi. In ut interdum orci. Quisque varius massa sit amet orci volutpat, in finibus est scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vitae elit lectus. Mauris aliquet diam nec justo sagittis cursus. Vestibulum ut aliquet nunc. Ut justo nulla, placerat vel nisl sed, sodales fringilla nisl. Proin malesuada odio elit, nec porttitor quam blandit et. Nunc faucibus semper neque ac interdum. Nunc et imperdiet lectus, quis porttitor urna. Etiam in viverra odio. Aenean ut erat fermentum, ornare sem ac, scelerisque lectus.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent condimentum rhoncus quam vitae gravida. Etiam vel fringilla quam. Curabitur sed accumsan lectus. Nam eros odio, rutrum vitae arcu posuere, malesuada maximus turpis. Nunc pellentesque dui vitae augue interdum, nec elementum metus vehicula. Mauris consectetur urna vitae accumsan consectetur. Suspendisse placerat lectus at odio tempor maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus varius justo ultricies, posuere dui nec, fringilla diam. Etiam dignissim pharetra pharetra. Sed interdum quam non semper bibendum. Quisque sit amet vehicula libero, id facilisis quam. Vivamus orci orci, dapibus in nibh quis, facilisis congue eros. Aliquam eu maximus velit. Morbi cursus ac eros in mollis        ', 'java, Antman', 'published', 2),
(7, 2, 'Javascript course 2', 'Superman', '2018-09-04', 'image_1.jpg', '<p><strong>KONJ</strong></p>', 'Javascript, Superman', 'published', 0),
(9, 1, 'Javascript course 2', 'Superman2', '2018-09-04', 'image_5.jpg', 'This is really nice poLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis luctus magna, ac aliquam ipsum. Cras sem est, commodo a mattis at, accumsan sed urna. Pellentesque et pulvinar orci. Vivamus varius in dolor at sodales. Sed eu mollis tellus. Donec ut lacinia quam. Ut fermentum ultrices est ac consectetur. Maecenas in nisi mollis, faucibus ligula sit amet, mollis orci. Cras varius vehicula efficitur. Nulla egestas rutrum dolor, sit amet sollicitudin arcu varius ac.\r\n\r\nDonec auctor blandit turpis, vitae ultrices turpis lobortis quis. Morbi purus tellus, sagittis ac elementum ac, ullamcorper a libero. Proin pharetra urna sed quam scelerisque sodales. Etiam eleifend purus urna, id faucibus enim porttitor nec. Aliquam convallis massa tellus, vitae volutpat lectus porta non. Donec euismod, purus id placerat laoreet, ligula sapien convallis dui, et vestibulum elit nunc eget erat. Proin pellentesque, ipsum at lacinia ultrices, massa augue faucibus elit, eu feugiat lacus mauris a nulla. Maecenas nisl velit, fermentum id tortor vel, egestas vulputate lacus. Fusce id elit accumsan, consectetur magna id, ultrices neque. Proin nec ex sodales, pellentesque nulla vitae, iaculis massa.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci est. Donec fringilla nibh est, eget volutpat lacus suscipit in. In luctus ipsum tortor, non fringilla diam ornare nec. Fusce tincidunt lacus eget scelerisque malesuada. Phasellus finibus neque ac arcu molestie, eu tincidunt lacus maximus. Proin finibus, eros sit amet ultrices tincidunt, sem ipsum blandit ex, non ultrices nunc ligula in mi. Nunc quis dui vitae justo suscipit tincidunt quis sit amet odio. Nunc a purus ac dui iaculis consectetur id sit amet mauris. Vivamus in sem metus. Etiam ac placerat est. Pellentesque at metus fringilla, mattis sapien quis, dictum metus.\r\n\r\nMaecenas vitae luctus velit. Vivamus elementum pulvinar urna non posuere. Suspendisse at felis nisi. In ut interdum orci. Quisque varius massa sit amet orci volutpat, in finibus est scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vitae elit lectus. Mauris aliquet diam nec justo sagittis cursus. Vestibulum ut aliquet nunc. Ut justo nulla, placerat vel nisl sed, sodales fringilla nisl. Proin malesuada odio elit, nec porttitor quam blandit et. Nunc faucibus semper neque ac interdum. Nunc et imperdiet lectus, quis porttitor urna. Etiam in viverra odio. Aenean ut erat fermentum, ornare sem ac, scelerisque lectus.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent condimentum rhoncus quam vitae gravida. Etiam vel fringilla quam. Curabitur sed accumsan lectus. Nam eros odio, rutrum vitae arcu posuere, malesuada maximus turpis. Nunc pellentesque dui vitae augue interdum, nec elementum metus vehicula. Mauris consectetur urna vitae accumsan consectetur. Suspendisse placerat lectus at odio tempor maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus varius justo ultricies, posuere dui nec, fringilla diam. Etiam dignissim pharetra pharetra. Sed interdum quam non semper bibendum. Quisque sit amet vehicula libero, id facilisis quam. Vivamus orci orci, dapibus in nibh quis, facilisis congue eros. Aliquam eu maximus velit. Morbi cursus ac eros in mollisst                                                        ', 'javascript, course, class, Belinda', 'published', 0),
(10, 1, 'Javascript course 2', 'Superman2', '2018-09-04', 'image_5.jpg', 'This is really nice poLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis luctus magna, ac aliquam ipsum. Cras sem est, commodo a mattis at, accumsan sed urna. Pellentesque et pulvinar orci. Vivamus varius in dolor at sodales. Sed eu mollis tellus. Donec ut lacinia quam. Ut fermentum ultrices est ac consectetur. Maecenas in nisi mollis, faucibus ligula sit amet, mollis orci. Cras varius vehicula efficitur. Nulla egestas rutrum dolor, sit amet sollicitudin arcu varius ac.\r\n\r\nDonec auctor blandit turpis, vitae ultrices turpis lobortis quis. Morbi purus tellus, sagittis ac elementum ac, ullamcorper a libero. Proin pharetra urna sed quam scelerisque sodales. Etiam eleifend purus urna, id faucibus enim porttitor nec. Aliquam convallis massa tellus, vitae volutpat lectus porta non. Donec euismod, purus id placerat laoreet, ligula sapien convallis dui, et vestibulum elit nunc eget erat. Proin pellentesque, ipsum at lacinia ultrices, massa augue faucibus elit, eu feugiat lacus mauris a nulla. Maecenas nisl velit, fermentum id tortor vel, egestas vulputate lacus. Fusce id elit accumsan, consectetur magna id, ultrices neque. Proin nec ex sodales, pellentesque nulla vitae, iaculis massa.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci est. Donec fringilla nibh est, eget volutpat lacus suscipit in. In luctus ipsum tortor, non fringilla diam ornare nec. Fusce tincidunt lacus eget scelerisque malesuada. Phasellus finibus neque ac arcu molestie, eu tincidunt lacus maximus. Proin finibus, eros sit amet ultrices tincidunt, sem ipsum blandit ex, non ultrices nunc ligula in mi. Nunc quis dui vitae justo suscipit tincidunt quis sit amet odio. Nunc a purus ac dui iaculis consectetur id sit amet mauris. Vivamus in sem metus. Etiam ac placerat est. Pellentesque at metus fringilla, mattis sapien quis, dictum metus.\r\n\r\nMaecenas vitae luctus velit. Vivamus elementum pulvinar urna non posuere. Suspendisse at felis nisi. In ut interdum orci. Quisque varius massa sit amet orci volutpat, in finibus est scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vitae elit lectus. Mauris aliquet diam nec justo sagittis cursus. Vestibulum ut aliquet nunc. Ut justo nulla, placerat vel nisl sed, sodales fringilla nisl. Proin malesuada odio elit, nec porttitor quam blandit et. Nunc faucibus semper neque ac interdum. Nunc et imperdiet lectus, quis porttitor urna. Etiam in viverra odio. Aenean ut erat fermentum, ornare sem ac, scelerisque lectus.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent condimentum rhoncus quam vitae gravida. Etiam vel fringilla quam. Curabitur sed accumsan lectus. Nam eros odio, rutrum vitae arcu posuere, malesuada maximus turpis. Nunc pellentesque dui vitae augue interdum, nec elementum metus vehicula. Mauris consectetur urna vitae accumsan consectetur. Suspendisse placerat lectus at odio tempor maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus varius justo ultricies, posuere dui nec, fringilla diam. Etiam dignissim pharetra pharetra. Sed interdum quam non semper bibendum. Quisque sit amet vehicula libero, id facilisis quam. Vivamus orci orci, dapibus in nibh quis, facilisis congue eros. Aliquam eu maximus velit. Morbi cursus ac eros in mollisst                                                        ', 'javascript, course, class, Belinda', 'published', 0),
(11, 2, 'Javascript course 2', 'Superman', '2018-09-04', 'image_1.jpg', '<p><strong>KONJ</strong></p>', 'Javascript, Superman', 'published', 2),
(12, 3, 'PHP post', 'Test', '2018-09-04', 'image_1.jpg', '<p>Mnogo Dobar POST</p>', 'PHP, cms, OMG', 'published', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `firstname`, `lastname`, `user_email`, `user_image`, `user_role`) VALUES
(21, 'AAA', '$2y$10$thisarerandomcharacteeefspreCYmvzP6UPCKLjiTUTcdVQZc4u', 'Zlatko', 'Zlatic', 't@t.com', 'lambo_1.jpg', 'admin'),
(22, 'Test', '$2y$12$mo/H87aoFdTZdsPAGMtiGe.SF6lNIJdyiWC.Q8edhtVdO8bixvK.S', '', '', 'test@test.com', 'DSC02520.JPG', 'admin'),
(23, 'Supermen', '$2y$12$ikE1x.bBjnXO0CjtzWH/eui5fZv909dlWaEpydk4vurzvkpdSfJta', 'Zlatko', 'Zlatic', 'mihajlop12123@gmail.com', '21231.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'jbi0tnggns2p7f90hbllng0vad', 1536075437),
(2, 'om2mipk2g85f1csult5mucbisv', 1536090760);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
