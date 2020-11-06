-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 03:01 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vintagethriftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `hats`
--

CREATE TABLE `hats` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hats`
--

INSERT INTO `hats` (`id`, `title`, `price`, `email`, `img`, `created_at`) VALUES
(75, 'Alas Pizza', 15, 'aceluimanalo@gmail.com', 'raiders.jpg', '2020-11-06 11:39:12'),
(76, 'Alas Pizza', 15, 'alasacelui010@gmail.com', 'raiders.jpg', '2020-11-06 11:39:53'),
(77, 'Alas Pizza', 15, 'alasacelui010@gmail.com', 'raiders.jpg', '2020-11-06 11:40:13'),
(80, 'Alas Pizza', 15, 'alasacelui010@gmail.com', 'raiders.jpg', '2020-11-06 13:18:29'),
(81, 'Alas Pizza', 15, 'alasacelui010@gmail.com', 'aw.png', '2020-11-06 13:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Acelui', 'acelui', 'acelui@gmail.com', 'dadsadasdasdasdas', '2020-11-06 07:26:41'),
(2, 'Ace Lui Manalo', 'alas10', 'alasacelui010@gmail.com', 'alas10', '2020-11-06 07:44:37'),
(3, 'Ace Lui Manalo', 'alas10', 'aceluimanalo@gmail.com', 'alas10', '2020-11-06 07:46:00'),
(4, 'Ace Lui Manalo', 'alas10', 'alasacelui0101@gmail.com', 'c8d3fcc6f2832f343ab1526fecc2ace1', '2020-11-06 07:46:57'),
(5, 'Ace Lui Manalo', 'boykupal', 'kupal@gmail.com', '077e6915ecf2b85eea678e00de45907f', '2020-11-06 08:31:50'),
(6, 'Ace Lui Manalo', 'aaaaa', 'aaaa@email.com', '594f803b380a41396ed63dca39503542', '2020-11-06 11:22:55'),
(7, 'Ace Lui Manalo', 'alas101', 'alasaceluii010@gmail.com', 'c8d3fcc6f2832f343ab1526fecc2ace1', '2020-11-06 11:30:59'),
(8, 'Ace Lui Manalo', 'alas10', 'alasaceelui010@gmail.come', 'c8d3fcc6f2832f343ab1526fecc2ace1', '2020-11-06 11:31:40'),
(9, 'Ace Lui Manalo', 'alas10', 'alasaeecelui010@gmail.com', 'c8d3fcc6f2832f343ab1526fecc2ace1', '2020-11-06 11:32:19'),
(10, 'Ace Lui Manalo', 'alas10', 'alasaecelui010@gmail.com', 'c8d3fcc6f2832f343ab1526fecc2ace1', '2020-11-06 11:33:23'),
(11, 'Ace Lui Manalo', 'alas10', 'aalasacelui010@gmail.com', 'c8d3fcc6f2832f343ab1526fecc2ace1', '2020-11-06 11:34:40'),
(12, 'admin admin', 'admin', 'admin@gmail.com', 'admin123', '2020-11-06 12:36:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hats`
--
ALTER TABLE `hats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hats`
--
ALTER TABLE `hats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
