-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql_db
-- Generation Time: Nov 16, 2023 at 05:00 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.12

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
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Untitled',
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
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
(33, 2, '', NULL, '2023-06-07 01:31:57', 'uploads/647fc1edc622a.jpg'),
(34, 6, '', NULL, '2023-10-24 18:03:46', 'uploads/6537eae2248ee.jpg'),
(35, 6, '', NULL, '2023-10-24 18:04:35', 'uploads/6537eb13c9a35.jpg'),
(36, 6, '', NULL, '2023-10-24 18:04:45', 'uploads/6537eb1d63387.jpg'),
(37, 6, '', NULL, '2023-10-24 18:05:01', 'uploads/6537eb2d211be.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `photo_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `photo_path`) VALUES
(1, 'Dany', 'danirazzouqa@gmail.com', '$2y$10$lgMWqTXFVGubKwqu.Y2/E.Z0yCkOo7acshM.KZikk8kMkdU/h7Ewm', '2023-05-24 22:53:50', 'uploads/299875413_5234898586587150_4871907045940906478_n.jpg'),
(2, 'dany2', 'danirazzouqa1@gmail.com', '$2y$10$mtwd9jyy5bKONRiw5.86M.0Ngn.3/CSiYJB0V3meSHYIoE.3IXo0y', '2023-06-07 00:03:28', 'uploads/346591044_892640748468782_1487132688769595511_n.jpg'),
(5, 'danyrazzoqa', 'danirazzouqa@gmail.com', '$2y$10$eypSN3.z/ES3mH9/fuIeEer/xBRatqHR9yHxGh48leucEmOWiStPG', '2023-10-24 17:58:33', ''),
(6, 'dany3', 'dany3@gmail.com', '$2y$10$VCHc56pcp5S1ycKGde7Ude1WEThgndKzqDFUCyBTfxc7r83MHQqli', '2023-10-24 18:03:13', 'uploads/346591044_892640748468782_1487132688769595511_n.jpg'),
(7, 'ddd1', 'ddd1@gmail.com', '$2y$10$9aUghZaAk62rBRt0UBuM5eswdf5JQOI9ThuHE5viFVvScDbnQMo6a', '2023-11-16 16:49:48', NULL),
(8, 'ddd2', 'ddd2@gmail.com', '$2y$10$8IO.YavYX6pJ6m4YlocZ6.vCgLrWij2VyO6b5vNVjpzuL2i7HD7si', '2023-11-16 16:49:59', 'uploads/html.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
