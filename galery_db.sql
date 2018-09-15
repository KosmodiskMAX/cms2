-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2018 at 09:09 PM
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
-- Database: `galery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `photo_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `user_id`, `body`) VALUES
(7, 16, 1, 'Da li je ovo realno'),
(9, 16, 1, 'Hoce kobas');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`) VALUES
(16, 'Batmobile', 'Brzina', '<p><i><strong>Mnogo brz auto, lorem ipsum hoce kobas max, prosto ne bi verovali</strong></i></p>', 'images-7.jpg', '', 'image/jpeg', 24140),
(17, 'Auto3', '', '', '_large_image_4.jpg', '', 'image/jpeg', 554659),
(18, 'Kobas2', '', '', '_large_image_2.jpg', '', 'image/jpeg', 309568),
(19, 'Nova slika', '', '', 'images-4.jpg', '', 'image/jpeg', 23270),
(20, 'Car 423', '', '', 'images-26.jpg', '', 'image/jpeg', 21802),
(21, 'Javascript course 2', '', '', 'images-8.jpg', '', 'image/jpeg', 20810),
(22, 'Car 4', '', '', 'images-14.jpg', '', 'image/jpeg', 21992),
(23, 'Kobas', '', '', 'images-15.jpg', '', 'image/jpeg', 28466),
(24, 'Kobas2', '', '', 'images-12.jpg', '', 'image/jpeg', 18540),
(25, '1', '', '', 'images-50.jpg', '', 'image/jpeg', 21652),
(26, '2', '', '', 'images-44.jpg', '', 'image/jpeg', 29486),
(27, '3', '', '', 'images-43.jpg', '', 'image/jpeg', 27955),
(28, '4', '', '', 'images-42.jpg', '', 'image/jpeg', 22401),
(29, '5', '', '', 'images-41.jpg', '', 'image/jpeg', 16296),
(30, '6', '', '', 'images-40.jpg', '', 'image/jpeg', 24385),
(31, '7', '', '', 'images-39.jpg', '', 'image/jpeg', 24969),
(32, '8', '', '', 'images-38.jpg', '', 'image/jpeg', 21857),
(33, '9', '', '', 'images-37.jpg', '', 'image/jpeg', 20381),
(34, '10', '', '', 'images-36.jpg', '', 'image/jpeg', 21672),
(35, '20', '', '', 'images-35.jpg', '', 'image/jpeg', 23672),
(36, '21', '', '', 'images-34.jpg', '', 'image/jpeg', 23587),
(37, '22', '', '', 'images-33.jpg', '', 'image/jpeg', 16855),
(38, '444', '', '', 'images-32.jpg', '', 'image/jpeg', 22772),
(39, '123', '', '', 'images-31.jpg', '', 'image/jpeg', 20928),
(40, '1234', '', '', 'images-29.jpg', '', 'image/jpeg', 25493),
(41, '125', '', '', 'images-28.jpg', '', 'image/jpeg', 17662),
(42, '126', '', '', 'images-18.jpg', '', 'image/jpeg', 27595);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `user_image`) VALUES
(1, 'Superman', '123', 'Mihajlo', 'Petrovic', '_large_image_3.jpg'),
(4, 'KONJ', '', '', '', ''),
(10, 'KONJ33', '123', 'Lazar', 'Casio', ''),
(11, 'KONJ', '123', '', '', ''),
(12, 'KONJMAX', '', '', '', ''),
(14, 'KONJ2', '123', 'Lazar', 'Casio', ''),
(20, 'Vitez Koja14', '', 'Mihajlo', 'Zlatic', 'images-37.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
