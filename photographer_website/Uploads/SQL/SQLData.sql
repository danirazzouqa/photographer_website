-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 03:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photographer_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `title`, `description`, `created_at`, `path`) VALUES
(18, 1, '', NULL, '2023-06-07 01:30:02', 'uploads/647fc17a3233a.jpg'),
(19, 1, '', NULL, '2023-06-07 01:30:06', 'uploads/647fc17e57a70.jpg'),
(20, 1, '', NULL, '2023-06-07 01:30:11', 'uploads/647fc183c12b1.jpg'),
(21, 1, '', NULL, '2023-06-07 01:30:19', 'uploads/647fc18b76ef1.jpg'),
(22, 1, '', NULL, '2023-06-07 01:30:33', 'uploads/647fc199949d7.jpg'),
(23, 1, '', NULL, '2023-06-07 01:30:38', 'uploads/647fc19e0fbc9.jpg'),
(24, 1, '', NULL, '2023-06-07 01:30:41', 'uploads/647fc1a1e69f4.jpg'),
(25, 1, '', NULL, '2023-06-07 01:30:47', 'uploads/647fc1a7168c3.jpg'),
(26, 1, '', NULL, '2023-06-07 01:30:53', 'uploads/647fc1ad9094d.jpg'),
(27, 2, '', NULL, '2023-06-07 01:31:22', 'uploads/647fc1ca7921a.jpg'),
(28, 2, '', NULL, '2023-06-07 01:31:26', 'uploads/647fc1ce8527d.jpg'),
(29, 2, '', NULL, '2023-06-07 01:31:30', 'uploads/647fc1d277a2c.jpg'),
(30, 2, '', NULL, '2023-06-07 01:31:34', 'uploads/647fc1d6e174e.jpg'),
(31, 2, '', NULL, '2023-06-07 01:31:41', 'uploads/647fc1dda976e.jpg'),
(33, 2, '', NULL, '2023-06-07 01:31:57', 'uploads/647fc1edc622a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `photo_path` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `photo_path`) VALUES
(1, 'Dany', 'danirazzouqa@gmail.com', '$2y$10$lgMWqTXFVGubKwqu.Y2/E.Z0yCkOo7acshM.KZikk8kMkdU/h7Ewm', '2023-05-24 22:53:50', 'uploads/299875413_5234898586587150_4871907045940906478_n.jpg'),
(2, 'dany1', 'danirazzouqa1@gmail.com', '$2y$10$mtwd9jyy5bKONRiw5.86M.0Ngn.3/CSiYJB0V3meSHYIoE.3IXo0y', '2023-06-07 00:03:28', 'uploads/346591044_892640748468782_1487132688769595511_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
