-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2018 at 07:54 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharpees`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Fashion', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(2, 'Interior', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(3, 'Electronics', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(4, 'Sound', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(5, 'Transport', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(6, 'Personal Care', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(7, 'Leisure', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(8, 'Tools', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(9, 'Services', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(10, 'Miscellaneours', '2018-04-10 12:11:24', '2018-04-10 12:11:24'),
(11, 'Old Junk', '2018-04-10 12:11:25', '2018-04-10 12:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`category_id`, `post_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `borrow_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swap_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `give_away_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wanted_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `company_id`, `title`, `description`, `image`, `borrow_image`, `swap_image`, `give_away_image`, `wanted_image`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'joke ', 'dff', NULL, '152338038513395003155accf0a100eb8.png', '152338038921358388325accf0a58f91d.png', '15233803946983339165accf0aa2f263.png', '152338039910250016585accf0af41fee.png', 1, '2018-04-10 12:13:05', '2018-04-10 12:13:21'),
(2, 2, 'webtechsol', 'asdfasdf', '152338650314675967715acd088798846.png', '152338648310854388985acd0873f2bed.png', '152338650720732090615acd088b4cb44.png', '15233865144746880415acd0892cb6f3.png', '15233865107115913875acd088eede9c.png', 1, '2018-04-10 13:54:44', '2018-04-10 13:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `community_post`
--

CREATE TABLE `community_post` (
  `community_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `is_stat` tinyint(4) NOT NULL,
  `communities` int(11) NOT NULL DEFAULT '1',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `parent_id`, `name`, `contact_person`, `email`, `region_id`, `is_stat`, `communities`, `image`, `privacy_document`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'technowiz', 'basharat', 'busharthussain@gmail.com', 3, 1, 1, '1522795820263085ac4052ce1969.jpeg', NULL, '2018-04-03 17:54:31', '2018-04-03 17:54:31'),
(2, 1, NULL, 'ddd', 'basharat', 'busharthussain1@gmail.com', 1, 0, 3, NULL, NULL, '2018-04-04 13:36:34', '2018-04-04 13:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_02_204434_create_companies_table', 2),
(4, '2018_04_03_154110_create_regions_table', 3),
(6, '2018_04_03_175341_create_temp_company_images_table', 4),
(7, '2018_04_05_194159_create_communities_table', 5),
(8, '2018_04_08_043844_create_posts_table', 5),
(9, '2018_04_08_050114_create_parent_categories_table', 5),
(10, '2018_04_08_052436_create_tags_table', 5),
(11, '2018_04_08_054117_create_categories_table', 5),
(12, '2018_04_08_054908_create_product_conditions_table', 5),
(13, '2018_04_08_062436_create_post_images_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `parent_categories`
--

CREATE TABLE `parent_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_categories`
--

INSERT INTO `parent_categories` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Swap', 'swap-icon.png', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(2, 'Borrow', 'borrow-icon.png', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(3, 'Wanted', 'wanted-icon.png', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(4, 'Give away', 'give-icon.png', '2018-04-10 12:11:25', '2018-04-10 12:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('busharthussain@gmail.com', '$2y$10$BJ34Wax8eqHq64hyFrpK7e4CEPeMT8e5WpeoaoS220a3UV3VtbD4i', '2018-04-01 11:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `product_condition_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `borrow_to` date DEFAULT NULL,
  `borrow_from` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `active`, `title`, `description`, `zip_code`, `city`, `category_id`, `parent_category_id`, `product_condition_id`, `created_by`, `borrow_to`, `borrow_from`, `created_at`, `updated_at`) VALUES
(1, '1', 'asdf', 'asdfasdf', 'asdf', 'asdfasd', 1, 1, 1, 1, NULL, NULL, '2018-04-10 13:56:23', '2018-04-10 13:56:23'),
(2, '1', 'asdf', 'asdfasdf', 'asdf', 'asdfasd', 1, 1, 3, 1, NULL, NULL, '2018-04-10 13:56:34', '2018-04-10 13:56:34'),
(3, '1', 'asdf', 'asdfasdf', 'asdf', 'asdfasd', 1, 1, 3, 1, NULL, NULL, '2018-04-10 13:56:46', '2018-04-10 13:56:46'),
(4, '1', 'asdf', 'asdfasdf', '54000', 'Lahore', 1, 1, 3, 1, NULL, NULL, '2018-04-10 13:57:09', '2018-04-10 13:57:09'),
(5, '1', 'asdf', 'asdfasdf', '54000', 'Lahore', 1, 1, 3, 1, NULL, NULL, '2018-04-10 13:57:18', '2018-04-10 13:57:18'),
(6, '1', 'asdf', 'asdfasdf', '54000', 'Lahore', 1, 1, 3, 1, NULL, NULL, '2018-04-10 13:57:24', '2018-04-10 13:57:24'),
(7, '1', 'asdf', 'asdfasdf', '54000', 'Lahore', 1, 1, 3, 1, NULL, NULL, '2018-04-10 13:57:40', '2018-04-10 13:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `batch_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `batch_id`, `image`, `thumbnail_image`, `created_at`, `updated_at`) VALUES
(1, NULL, '5accf66a500511523381866', '152338188315697936555accf67bdba28.png', '152338188315697936555accf67bdba28.png', '2018-04-10 12:38:04', '2018-04-10 12:38:04'),
(2, NULL, '5accf66a500511523381866', '152338189017039087235accf6820d4d9.png', '152338189017039087235accf6820d4d9.png', '2018-04-10 12:38:10', '2018-04-10 12:38:10'),
(3, NULL, '5accf66a500511523381866', '152338189512959652225accf68707f23.png', '152338189512959652225accf68707f23.png', '2018-04-10 12:38:15', '2018-04-10 12:38:15'),
(4, NULL, '5accf66a500511523381866', '15233819024537490355accf68e42942.png', '15233819024537490355accf68e42942.png', '2018-04-10 12:38:22', '2018-04-10 12:38:22'),
(5, NULL, '5accfefa529b21523384058', '152338419112800539905accff7f63f59.png', '152338419112800539905accff7f63f59.png', '2018-04-10 13:16:31', '2018-04-10 13:16:31'),
(6, NULL, '5accffcbed8541523384267', '152338428421040948125accffdcd5ac1.png', '152338428421040948125accffdcd5ac1.png', '2018-04-10 13:18:05', '2018-04-10 13:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_conditions`
--

CREATE TABLE `product_conditions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_conditions`
--

INSERT INTO `product_conditions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', '1', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(2, 'Old', '1', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(3, 'Very Old', '1', '2018-04-10 12:11:25', '2018-04-10 12:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nordjylland', NULL, NULL),
(2, 'Midtjylland', NULL, NULL),
(3, 'Syddanmark', NULL, NULL),
(4, 'Hovedstaden', NULL, NULL),
(5, 'Sjælland', NULL, NULL),
(6, 'Nordjylland', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(7, 'Midtjylland', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(8, 'Syddanmark', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(9, 'Hovedstaden', '2018-04-10 12:11:25', '2018-04-10 12:11:25'),
(10, 'Sjælland', '2018-04-10 12:11:25', '2018-04-10 12:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `post_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'sdf', '2018-04-10 13:56:23', '2018-04-10 13:56:23'),
(2, 2, 'sdf', '2018-04-10 13:56:34', '2018-04-10 13:56:34'),
(3, 3, 'sdf', '2018-04-10 13:56:46', '2018-04-10 13:56:46'),
(4, 4, 'sdf', '2018-04-10 13:57:09', '2018-04-10 13:57:09'),
(5, 5, 'sdf', '2018-04-10 13:57:18', '2018-04-10 13:57:18'),
(6, 6, 'sdf', '2018-04-10 13:57:24', '2018-04-10 13:57:24'),
(7, 7, 'Fashion', '2018-04-10 13:57:41', '2018-04-10 13:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `temp_company_images`
--

CREATE TABLE `temp_company_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_company_images`
--

INSERT INTO `temp_company_images` (`id`, `image`, `privacy_document`, `created_at`, `updated_at`) VALUES
(1, '1522792716241865ac3f90c5db5e.jpeg', NULL, '2018-04-03 16:58:36', '2018-04-03 16:58:36'),
(2, '1522792824294895ac3f978e2509.jpeg', NULL, '2018-04-03 17:00:24', '2018-04-03 17:00:24'),
(3, '1522793846187745ac3fd7672aae.jpeg', NULL, '2018-04-03 17:17:26', '2018-04-03 17:17:26'),
(4, '152279389676395ac3fda845719.jpeg', NULL, '2018-04-03 17:18:16', '2018-04-03 17:18:16'),
(5, '1522793994215985ac3fe0a3da76.jpeg', NULL, '2018-04-03 17:19:54', '2018-04-03 17:19:54'),
(6, '1522795205164475ac402c5b1a97.jpeg', NULL, '2018-04-03 17:40:05', '2018-04-03 17:40:05'),
(7, '1522795820263085ac4052ce1969.jpeg', NULL, '2018-04-03 17:50:20', '2018-04-03 17:50:20'),
(8, '152286280116945ac50ad198e4a.jpeg', NULL, '2018-04-04 12:26:41', '2018-04-04 12:26:41'),
(9, '152286300695995ac50b9e796a4.jpeg', NULL, '2018-04-04 12:30:06', '2018-04-04 12:30:06'),
(10, '1522863117228605ac50c0d627f8.jpeg', NULL, '2018-04-04 12:31:57', '2018-04-04 12:31:57'),
(11, '152286333219345ac50ce4b68c0.jpeg', NULL, '2018-04-04 12:35:32', '2018-04-04 12:35:32'),
(12, '152338677510821603775acd0997ad6be.png', NULL, '2018-04-10 13:59:35', '2018-04-10 13:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'basharat', 'busharthussain@gmail.com', '$2y$10$PqSb8.AZWR21BsNZCCP9vOiQNHeM4AtNO0UX.9T5EFWR/h3Q8/3z2', 'xiUTjMdRWUBpkLfuOpkHjwALO73GL70gGJkTUmU9b0hZveSWzozLsE0RPuHY', '2018-04-01 07:01:58', '2018-04-01 11:26:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_categories`
--
ALTER TABLE `parent_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_conditions`
--
ALTER TABLE `product_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_company_images`
--
ALTER TABLE `temp_company_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `parent_categories`
--
ALTER TABLE `parent_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_conditions`
--
ALTER TABLE `product_conditions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temp_company_images`
--
ALTER TABLE `temp_company_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
