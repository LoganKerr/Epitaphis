-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 08, 2018 at 07:23 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `epitaphis`
--

-- --------------------------------------------------------

--
-- Table structure for table `follower_assoc`
--

CREATE TABLE `follower_assoc` (
`id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`following_id` int(11) NOT NULL,
`accepted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follower_assoc`
--

INSERT INTO `follower_assoc` (`id`, `user_id`, `following_id`, `accepted`) VALUES
(5, 1, 2, 0),
(6, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
`id` int(11) NOT NULL,
`goalName` varchar(256) NOT NULL DEFAULT '',
`goalText` varchar(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `goalName`, `goalText`) VALUES
(11, 'test', '1');

-- --------------------------------------------------------

--
-- Table structure for table `goal_assoc`
--

CREATE TABLE `goal_assoc` (
`id` int(11) NOT NULL,
`user_id` int(11) NOT NULL,
`goal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goal_assoc`
--

INSERT INTO `goal_assoc` (`id`, `user_id`, `goal_id`) VALUES
(11, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
`email` varchar(256) NOT NULL,
`firstName` varchar(256) NOT NULL,
`lastName` varchar(256) NOT NULL,
`bio` varchar(256) NOT NULL DEFAULT '',
`passHash` varchar(256) NOT NULL,
`admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `bio`, `passHash`, `admin`) VALUES
(1, 'lkerr1998@gmail.com', 'Logan', 'Kerr', 'test', '$2y$10$h9HjjFScQIeEUc2PtKUQyOLEGvUIBphr5jhHmiVgJsY5miaz5PSNG', 0),
(2, 'tmulvey@gmail.com', 'Tom', 'Mulvey', '', '$2y$10$HStceRTga.K7EyMsFYmQv.G8WEWdPu.mxjldMlq..H2ay2gvhebDK', 0),
(3, 'mustafa@gmail.com', 'mustafa', 'kerr', '', '$2y$10$bIJR6na9aZ8cod8W7bMTv.NDBbmg5CkdANp0GVNijgQc5F7pTD5Ym', 0),
(4, 'lkerr1999@gmail.com', 'Logan', 'Kerr', '', '$2y$10$4hjInxIMIW9CAeoOBrpOPeqejNhuGxcqJ135D7xaaYg1Oo57yMFBW', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follower_assoc`
--
ALTER TABLE `follower_assoc`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goal_assoc`
--
ALTER TABLE `goal_assoc`
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
-- AUTO_INCREMENT for table `follower_assoc`
--
ALTER TABLE `follower_assoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `goal_assoc`
--
ALTER TABLE `goal_assoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
