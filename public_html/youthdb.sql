-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 03:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youthdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(12) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `Undergraduatelevels` varchar(255) DEFAULT NULL,
  `Undergraduatefields` varchar(255) DEFAULT NULL,
  `Graduatelevels` varchar(255) DEFAULT NULL,
  `Graduatefields` varchar(255) DEFAULT NULL,
  `Artisancraft` varchar(255) DEFAULT NULL,
  `tradersgoods` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `firstname`, `middlename`, `lastname`, `email`, `profileImage`, `gender`, `password`, `occupation`, `phone`, `Undergraduatelevels`, `Undergraduatefields`, `Graduatelevels`, `Graduatefields`, `Artisancraft`, `tradersgoods`, `date`) VALUES
(2, 'Gray', 'Daniel ', 'Nwaeze', 'gooddestc20@gmail.com', '1675674411166.jpg', 'male', '$2y$10$5OM5jLYNbU/S/.5zQ2XVcO1crD2XJeqEL5ql5dA8CaBNu1v1xNqbK', 'gamer', '09030491543', 'give me a call 📞 ', 'questions about your business ', 'times are the best ', 'type and how much ', 'names under the impression ', 'yes I am not sure ', '2025-01-25 '),
(3, 'james ', 'chidera', 'ueze', 'destc20@gmail.com', NULL, 'female', '$2y$10$tIZvkoxpYRwLGna2NSrZHOwX287AHZcfIZKMlM6gGHFTc4gsIUNDq', 'doctor ', '', 'gfhjklkjhkl', 'hjfioklfwprmffmlml', 'sm d oreerler', 'fkknfojoijrpr', 'ooooenfkffffb', 'pejdbjvbv', '2025-01-25 '),
(4, 'vine ', 'adaeze', 'knight', 'vine@gmail.com', '1674331910035.jpg', 'female', '$2y$10$THeZBAF9GovBZ5GyM4lVYezGsDLOxKMPJVlddl/zVwdEDD3duFYEu', 'lawyer', '080657464446', '400 level', '', '', '', '', '', '2025-01-27 '),
(5, 'fedric', 'sean', 'smith', 'fedric@gmail.com', NULL, 'male', '$2y$10$wXukQJYjo48hIIqoOHIiEe44teiGSd/xq2GaNyhiZ8tIV4BHuI0XS', 'gamer', '09162435829', '', '', '', '', '', '', '2025-04-12 '),
(6, 'fidelity', 'bank', 'eze', 'fidelity@gmail.com', 'IMG_20240319_120232.jpg', 'male', '$2y$10$4P59tiQf.KpBTPWj2YAWWOBdK3vdrCqrO3nRwULWmQxoIFar100qG', 'doctor', '090876547654', '', '', '', '', '', '', '2025-04-12 ');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`) VALUES
(1, 2, 2, 'hey', '2025-01-30 11:45:53'),
(2, 2, 3, 'hey', '2025-01-30 11:46:47'),
(3, 2, 4, 'well ', '2025-01-30 12:20:17'),
(4, 2, 4, 'well ', '2025-01-30 12:20:31'),
(5, 2, 4, 'well ', '2025-01-30 12:20:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
