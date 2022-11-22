-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Nov 22, 2022 at 08:47 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scooter_ride`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221118143553', '2022-11-18 15:36:52', 630),
('DoctrineMigrations\\Version20221118152135', '2022-11-18 16:22:04', 679),
('DoctrineMigrations\\Version20221119075355', '2022-11-19 08:58:30', 552),
('DoctrineMigrations\\Version20221119081045', '2022-11-19 09:11:05', 270),
('DoctrineMigrations\\Version20221119201903', '2022-11-19 21:19:15', 492);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `id` int(11) NOT NULL,
  `ride_uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `start_time` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scooter_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`id`, `ride_uuid`, `status`, `start_time`, `end_time`, `created_at`, `updated_at`, `scooter_uuid`, `client_uuid`) VALUES
(1, 'f7b33b00-67e5-11ed-891c-e72eaa274e01', 2, '1605690000', '', '1668847291', '1668847291', 'b0a062b7-b225-c294-b8a0-06b98931a45b', 'c0a062b7-b225-c294-b8a0-06b98931a45b'),
(4, '4219ed78-6846-11ed-8d1c-cb33c9af15b4', 2, '1605690000', '1668851657', '1668845448', '1668851670', 'ed3d2a90-677d-11ed-886c-47d2d32f279f', 'c0a062b7-b225-c294-b8a0-06b98931a45b1'),
(5, '0053b52c-6855-11ed-9d0e-47f69d9b697f', 2, '1668851507', '1668851657', '1668851780', '1668851864', 'ed3d2a90-677d-11ed-886c-47d2d32f279f', 'c0a062b7-b225-c294-b8a0-06b98931a45b1'),
(6, 'e56fd806-6856-11ed-bcd6-ed4f63603ef6', 2, '1668852582', '1668852707', '1668852594', '1668852724', 'ed3d2a90-677d-11ed-886c-47d2d32f279f', 'c0a062b7-b225-c294-b8a0-06b98931a45b1'),
(7, 'b2a8627c-685a-11ed-9b3f-e1a705ff3337', 1, '1668854206', NULL, '1668854227', '1668854227', 'ed3d2a90-677d-11ed-886c-47d2d32f279f', 'c0a062b7-b225-c294-b8a0-06b98931a45b1');

-- --------------------------------------------------------

--
-- Table structure for table `scooter`
--

CREATE TABLE `scooter` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_lat` decimal(10,8) NOT NULL,
  `current_lng` decimal(11,8) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scooter`
--

INSERT INTO `scooter` (`id`, `uuid`, `current_lat`, `current_lng`, `status`, `created_at`, `updated_at`) VALUES
(3, 'ed3d2a90-677d-11ed-886c-47d2d32f279f', '53.00000000', '13.00000000', 2, '1668759406', '1668854227'),
(4, '14341f64-677e-11ed-a4a0-0d28682d25e3', '55.52961150', '13.33780230', 1, '1668759472', '1668759472'),
(5, 'a321fd12-6798-11ed-ab45-e9af69376d8f', '52.52961150', '23.33780230', 1, '1668857278', '1668857278'),
(6, 'b0a062b7-b225-c294-b8a0-06b98931a45b', '52.52961150', '13.33780230', 1, '1668844080', '1668844080'),
(7, 'eada5390-68bd-11ed-aad5-4d4431991c0b', '52.52961150', '23.33780230', 1, '1668940041', '1668940041'),
(8, '21695a7e-68c2-11ed-9076-d9ddf7b4fab0', '52.52961150', '23.33780230', 1, '1668941851', '1668941851'),
(9, '6ed3aecc-68c2-11ed-88cf-afd008daf3d8', '52.52961150', '23.33780230', 1, '1668941981', '1668941981'),
(10, '926c47b8-68c2-11ed-88a2-e1db2ab4bc8e', '52.52961150', '23.33780230', 1, '1668942040', '1668942040'),
(11, '899bbf18-6978-11ed-a847-29f69f3e5f87', '52.52961150', '999.99999999', 1, '1669020194', '1669020194');

-- --------------------------------------------------------

--
-- Table structure for table `track_ride`
--

CREATE TABLE `track_ride` (
  `id` int(11) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `event_time` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ride_uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_ride`
--

INSERT INTO `track_ride` (`id`, `lat`, `lng`, `event_time`, `ride_uuid`) VALUES
(1, '52.52961150', '13.33780230', '1605690000', '4219ed78-6846-11ed-8d1c-cb33c9af15b4'),
(2, '52.52961150', '13.33780230', '1668851814', '0053b52c-6855-11ed-9d0e-47f69d9b697f'),
(3, '52.52961150', '13.33780230', '1668851814', '0053b52c-6855-11ed-9d0e-47f69d9b697f'),
(4, '52.52961150', '13.33780230', '1668852651', 'e56fd806-6856-11ed-bcd6-ed4f63603ef6'),
(5, '52.52961150', '13.33780230', '1668852651', 'e56fd806-6856-11ed-bcd6-ed4f63603ef6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9B3D7CD09A4065D2` (`ride_uuid`);

--
-- Indexes for table `scooter`
--
ALTER TABLE `scooter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_43D2208BD17F50A6` (`uuid`);

--
-- Indexes for table `track_ride`
--
ALTER TABLE `track_ride`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scooter`
--
ALTER TABLE `scooter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `track_ride`
--
ALTER TABLE `track_ride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
