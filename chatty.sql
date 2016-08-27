-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2016 at 08:53 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatty`
--

-- --------------------------------------------------------

--
-- Table structure for table `display_pictures`
--

CREATE TABLE `display_pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `display_pictures`
--

INSERT INTO `display_pictures` (`id`, `user_id`, `filename`, `created_at`, `updated_at`) VALUES
(4, 2, '2_1xq5d6.jpg', '2016-07-06 23:18:03', '2016-07-08 13:07:13'),
(5, 3, '3_ALxUwn.jpg', '2016-07-07 08:30:00', '2016-07-08 13:12:20'),
(6, 4, 'default_dp.jpg', '2016-07-06 18:30:00', '2016-07-07 03:09:10'),
(8, 1, '1_4jYMVI.jpg', '2016-07-06 23:32:05', '2016-08-10 12:45:20'),
(10, 12, 'default_dp.jpg', '2016-07-07 05:56:08', '2016-07-07 08:34:09'),
(11, 13, '13_knB43j.jpg', '2016-07-07 10:34:51', '2016-07-08 13:09:36'),
(12, 14, 'default_dp.jpg', '2016-07-07 10:35:12', '2016-07-07 10:35:12'),
(13, 15, 'default_dp.jpg', '2016-07-07 10:35:32', '2016-07-07 10:35:32'),
(14, 16, 'default_dp.jpg', '2016-07-07 23:49:31', '2016-07-07 23:51:06'),
(15, 17, 'default_dp.jpg', '2016-07-10 13:21:53', '2016-07-10 13:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `accepted`, `created_at`, `updated_at`) VALUES
(16, 2, 1, 1, NULL, NULL),
(17, 4, 1, 1, NULL, NULL),
(18, 1, 12, 1, NULL, NULL),
(19, 2, 12, 1, NULL, NULL),
(20, 3, 12, 1, NULL, NULL),
(21, 12, 4, 1, NULL, NULL),
(22, 14, 1, 1, NULL, NULL),
(23, 15, 1, 1, NULL, NULL),
(25, 4, 13, 0, NULL, NULL),
(26, 1, 16, 1, NULL, NULL),
(27, 16, 2, 1, NULL, NULL),
(30, 1, 13, 1, NULL, NULL),
(31, 3, 1, 1, NULL, NULL),
(32, 1, 17, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likeable`
--

CREATE TABLE `likeable` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likeable`
--

INSERT INTO `likeable` (`id`, `user_id`, `likeable_id`, `likeable_type`, `created_at`, `updated_at`) VALUES
(8, 1, 32, 'Chatty\\Models\\Status', '2016-07-07 15:27:25', '2016-07-07 15:27:25'),
(10, 1, 33, 'Chatty\\Models\\Status', '2016-07-07 23:30:42', '2016-07-07 23:30:42'),
(11, 1, 35, 'Chatty\\Models\\Status', '2016-07-07 23:30:58', '2016-07-07 23:30:58'),
(12, 1, 2, 'Chatty\\Models\\Status', '2016-07-07 23:34:55', '2016-07-07 23:34:55'),
(14, 1, 37, 'Chatty\\Models\\Status', '2016-07-08 03:56:01', '2016-07-08 03:56:01'),
(15, 2, 37, 'Chatty\\Models\\Status', '2016-07-08 03:58:54', '2016-07-08 03:58:54'),
(16, 2, 39, 'Chatty\\Models\\Status', '2016-07-08 03:59:15', '2016-07-08 03:59:15'),
(17, 1, 43, 'Chatty\\Models\\Status', '2016-07-09 01:52:56', '2016-07-09 01:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_06_19_045231_create_users_table', 1),
('2016_06_21_183238_create_friends_table', 2),
('2016_06_24_071802_create_statuses_table', 3),
('2016_07_07_025855_create_display_pictures_table', 4),
('2016_07_07_174341_create_likeable_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `user_id`, `parent_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'this is a test status..', '2016-07-04 01:38:21', '2016-07-04 01:38:21'),
(2, 2, NULL, 'It''s a rainy day..yayy!!', '2016-07-04 01:45:55', '2016-07-04 01:45:55'),
(5, 4, NULL, 'I am enjoying web development..and i hope to continue this as my job also..', '2016-07-05 08:58:16', '2016-07-05 08:58:16'),
(8, 1, 5, 'Hope you are having fun..', '2016-07-05 12:57:13', '2016-07-05 23:32:47'),
(14, 1, 2, 'It''s not raining here..', '2016-07-05 23:33:18', '2016-07-05 23:33:18'),
(20, 4, 5, 'thank you...', '2016-07-07 03:09:31', '2016-07-07 03:09:31'),
(21, 1, 5, 'you are welcome!', '2016-07-07 03:18:39', '2016-07-07 03:18:40'),
(24, 3, NULL, 'Happy rathayatra guys..', '2016-07-07 08:36:35', '2016-07-07 08:36:35'),
(25, 1, NULL, 'Why do I have only one status??', '2016-07-07 08:52:47', '2016-07-07 08:52:47'),
(28, 1, 1, 'someone please reply to this post..', '2016-07-07 10:09:27', '2016-07-07 10:09:27'),
(29, 1, NULL, 'This is another post to test the design anomaly', '2016-07-07 10:10:31', '2016-07-07 10:10:31'),
(30, 1, NULL, 'The problem''s aparently solved..', '2016-07-07 10:23:03', '2016-07-07 10:23:03'),
(31, 1, 30, 'I am commenting on my own status..', '2016-07-07 12:05:38', '2016-07-07 12:05:38'),
(32, 13, 30, 'I am commenting here too..', '2016-07-07 12:06:11', '2016-07-07 12:06:11'),
(33, 13, NULL, 'Hello everyone.. I was born after big bang and everything that you know came into existance..', '2016-07-07 12:09:10', '2016-07-07 12:09:10'),
(34, 13, 25, 'because you deleted the earlier ones..', '2016-07-07 12:10:27', '2016-07-07 12:10:27'),
(35, 13, 29, 'I hope the anomaly is gone..', '2016-07-07 12:10:45', '2016-07-07 12:10:45'),
(36, 13, 1, 'heiieiiasfo', '2016-07-07 12:11:02', '2016-07-07 12:11:03'),
(37, 16, NULL, 'This is my first post..blah', '2016-07-07 23:51:34', '2016-07-07 23:52:13'),
(39, 1, 37, 'welcome to chatty', '2016-07-07 23:54:18', '2016-07-07 23:54:18'),
(42, 2, 37, 'welcome buddy..', '2016-07-08 03:59:10', '2016-07-08 03:59:10'),
(43, 3, NULL, 'image resizing successful... yayy party time..', '2016-07-08 13:23:43', '2016-07-08 13:23:43'),
(44, 1, NULL, 'Good afternoon people.. Have a great rainy afternoon..', '2016-07-09 01:55:46', '2016-07-09 01:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'das.sayantan94@gmail.com', 'sayantan94', '$2y$10$MKcxGkK9o8XAtnmOQ4391OKQDlbcWEIlf1luKCq4BI1TVzncSW8r6', 'Sayantan', 'Das', 'Howrah, India', 'lk8mcIPE20ZOGqK1QY5IM7SGL9lJKdFX78FPwHOxW9XI309P7eStQ0RLmrgm', '2016-06-19 08:10:33', '2016-08-20 22:13:21'),
(2, 'alexgarret@gmail.com', 'alex', '$2y$10$03Q2KbJA/Hfl/O.BQJLBz.JffEI1fCeIG7dicGuYJUsWkd2W0QtDW', 'Alex', 'Garret', 'London, UK', 'LQpydsbXZDWYCYBUQmbL8QIAydIDCkoGr0TANoTQ3ZqfGTobmu350IVxXU4U', '2016-06-19 15:13:33', '2016-08-20 23:14:26'),
(3, 'billy@codecourse.com', 'billy', '$2y$10$Kti..uTOIDb1b.7Ys6psJ.c1X/AnXhdhesLu.oiKLymg.lUfvAhZS', 'Billy', 'Garret', 'London, UK', 'xmbK4aIhYJzQpovsCzPEMiYEtQ11ji0C91KdtmrHx0hCBBuJJ2bvWgUN8sWT', '2016-06-20 13:00:22', '2016-07-07 08:39:09'),
(4, 'alex@codecourse.com', 'dale', '$2y$10$e7bQOrfXftePJE8XU8CJf.pY6yuSVFYGl2bqqvdzrXfx1w7PU.5/y', 'Dale', 'Smith', 'New York, USA', 'pBSfGAk3P2BPD4fHhhr1ppkRChj0cQICt1ET2rVWvB1iHitBP8WK1m7g6Bgv', '2016-06-21 09:44:50', '2016-08-20 23:14:19'),
(12, 'sayantan123das@gmail.com', 'iamsayantan', '$2y$10$0Pz.ApV.vM4wWvay07Z4Xe5nZ5H4OBM8sosTqYN34o/lICDD72GU6', 'Supratim', 'Das', 'Howrah, India', 'lt5mbMWRlQHh09rChUIidY19ujkFIXeDg0K3wkdlzhNueFAzza8uOKPjIS5W', '2016-07-07 05:56:08', '2016-07-07 10:34:29'),
(13, 'universe@gmail.com', 'universe', '$2y$10$0s4XvtBf4Ej5X.xEwggjCOEU0yCMTBodLwEIk..oIqR3URxsj0IYK', 'Big', 'Bang', 'Universe', 'CbG4edE083sFq5GqudhP3C2n8QKkM2eEyE0xQezZK3qD2wfaPEUqi8XCC2d7', '2016-07-07 10:34:51', '2016-07-08 13:12:00'),
(14, 'galaxy@gmail.com', 'galaxy', '$2y$10$wGyNOGz65HgMLW1jtdGKmO0zmhl9P3Cp6tFxH8UhAm1j/2Q2XGzFG', NULL, NULL, NULL, NULL, '2016-07-07 10:35:12', '2016-07-07 10:35:12'),
(15, 'milkyway@gmail.com', 'milkyway', '$2y$10$YEFpmadd.Og0QxZ2TngKLOouJqtXF2CLSZkfoZmH.WjRUZ1DF14o6', NULL, NULL, NULL, NULL, '2016-07-07 10:35:31', '2016-07-07 10:35:31'),
(16, 'blah@gmail.com', 'blah', '$2y$10$GX9ZZLhXtHk//24tuEDvZeH/X0d9XXmPTbnvPuT4eA1rY3TlqOrB2', 'Blah', 'Blip', 'Mars', 'jwr30ApwoZY3DT496S7JqpHEAsFjGLLS6pVCyC02PLrtX5dXDkATQlApSSvR', '2016-07-07 23:49:30', '2016-07-08 06:26:00'),
(17, 'dm@gmail.com', 'dipmanna', '$2y$10$WipGCWq08MaC2wc0ata.nunqriVjnqPDp9jiwVxjmACG1nwe3grCm', NULL, NULL, NULL, NULL, '2016-07-10 13:21:52', '2016-07-10 13:21:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `display_pictures`
--
ALTER TABLE `display_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likeable`
--
ALTER TABLE `likeable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
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
-- AUTO_INCREMENT for table `display_pictures`
--
ALTER TABLE `display_pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `likeable`
--
ALTER TABLE `likeable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
