-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 12:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$zGz.p6mbR5kIp6Rm.7LmTe73nqYD6g2QSwZQ8ToUvzy9SgCNbvUGG');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author`, `created_at`, `updated_at`) VALUES
(3, 'Garbage Collection', '\r\n\r\nGarbage collection is the automatic process of freeing up memory used by objects that are no longer needed by a program. It is an essential feature of modern programming languages such as Java, Python, and C#. Without garbage collection, developers would need to manually manage memory allocation and deallocation, which can be a time-consuming and error-prone process.\r\n\r\nGarbage collection works by continuously monitoring the usage of memory in a program and identifying objects that are no longer referenced by the program. Once these objects are identified, they can be safely removed from memory, freeing up space for other objects to be created.\r\n\r\nThere are several techniques used in garbage collection, including reference counting, mark and sweep, and copying. Reference counting keeps track of the number of references to each object and deallocates it when the count reaches zero. Mark and sweep scans the entire memory space and marks objects that are still in use, then deallocates objects that are not marked. Copying involves moving all live objects to a new memory space, and then deallocating the old space.\r\n\r\nGarbage collection has some performance costs, as it requires processing time to scan memory and identify objects that can be removed. However, the benefits of automatic memory management far outweigh these costs, as it reduces the risk of memory leaks and makes programming faster and more efficient.\r\n\r\nIn conclusion, garbage collection is an essential feature of modern programming languages that automates memory management and reduces the risk of memory leaks. It relies on various techniques to identify and deallocate objects that are no longer needed by a program. While it has some performance costs, the benefits of garbage collection far outweigh them, making programming more efficient and reliable.', 'Vihanga Vayantha', '2023-05-11 21:35:16', '2023-05-11 21:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `impact` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `importance` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `title`, `description`, `impact`, `latitude`, `longitude`, `photo_path`, `created_at`, `updated_at`, `importance`, `uid`, `status`) VALUES
(677259, 'Garbage Here', 'There are some garbage here. Please look into this and do needful.', 'Environment Pollution ', '6.92128508', '79.86416224', 'images/677259_0.jpg', '2023-05-11 21:40:46', '2023-05-11 21:45:12', 'high', '4', 'approved'),
(889833, 'Waste ', 'Collect this wastes', 'Pollution', '6.91106035', '79.87806681', 'images/889833_0.webp', '2023-05-11 21:44:04', '2023-05-11 21:45:15', 'medium', '4', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$zGz.p6mbR5kIp6Rm.7LmTe73nqYD6g2QSwZQ8ToUvzy9SgCNbvUGG'),
(3, 'dewmi', 'dewmi@gmail.com', '$2y$10$jQ2hcs/fIzy8yaJ/T7UCH.ZGbn4OXVhOYdHr6rQp0lEnnZ1/6yvqu'),
(4, 'Vihanga', 'vihanga@gmail.com', '$2y$10$3RqvpSdZ.utPfvHmYXmrvuWwuPFX43Q5q/3MjbtuPpV.s0vA5T/22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('captain','collecting_staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, '5y5', 'admingt@fr.com', '$2y$10$Ls4wTxZViWx6aD5KCkGG6OhvO6.EPaukqlvNNK7hRba1L/zyyx6O2', 'captain'),
(2, '5y5', 'admingt@fr.coyytm', '$2y$10$LtNBLX4uzuP/MLnoxvPZKunHx7bPncNFRjHu12OcLxT7UaItMiSdO', 'captain'),
(3, '5y5', 'admingt@fr.coyytmgr', '$2y$10$54Gm9nNZWyqeU3wssyNEsO1mXjKvtoM5h5qKboIhFtkwSJOfRoacK', 'captain'),
(6, 'vayantha', 'vayantha@gmail.com', '$2y$10$72GDoJQSBGgPciVhMXCGCuKVKfZEHdkusdBWmHTfp8EM8yY2ieKL6', 'captain'),
(7, 'vayantha1', 'vayantha1@gmail.com', '$2y$10$.ey8twiqFJ0Q33tfxszMBOpVS9n1JMjtHjIYsu.bJ5KfBHDAL4RVm', 'captain');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
