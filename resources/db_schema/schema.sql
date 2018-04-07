-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 04, 2018 at 10:14 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `epitaphis`
--

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
`id` int(11) NOT NULL,
`goalName` varchar(256) NOT NULL,
`goalText` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `goalName`, `goalText`) VALUES
(1, 'By the time I\'m 30', 'I wanna eat 300 mchickens');

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
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
`email` varchar(256) NOT NULL,
`firstName` varchar(256) NOT NULL,
`lastName` varchar(256) NOT NULL,
`passHash` varchar(256) NOT NULL,
`admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `passHash`, `admin`) VALUES
(1, 'lkerr1998@gmail.com', 'Logan', 'Kerr', '$2y$10$h9HjjFScQIeEUc2PtKUQyOLEGvUIBphr5jhHmiVgJsY5miaz5PSNG', 0);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `goal_assoc`
--
ALTER TABLE `goal_assoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
