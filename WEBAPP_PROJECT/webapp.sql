-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2023 at 08:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `receipt_number` int DEFAULT NULL,
  `checked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `user_id`, `date_added`, `quantity`, `total`, `receipt_number`, `checked`) VALUES
(98, 37, 48, '2023-12-11 02:15:17', 1, 3, 27, 0),
(99, 38, 48, '2023-12-11 02:15:18', 2, 64, 27, 0),
(100, 41, 48, '2023-12-11 02:15:19', 1, 55, 27, 0),
(101, 38, 48, '2023-12-11 02:15:26', 2, 64, 28, 0),
(102, 36, 48, '2023-12-11 02:15:28', 1, 2, 28, 0),
(103, 38, 40, '2023-12-11 02:30:53', 1, 32, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_auth`
--

CREATE TABLE `login_auth` (
  `id` int NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `token` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_auth`
--

INSERT INTO `login_auth` (`id`, `email`, `password`, `token`) VALUES
(27, 'elizabethgeronaga@gmail.com', '$2y$10$Ooo7XOHpIFX1At4JJJs81OG5.b29if2Ol789GGpkCS4xsnZKWP/JW', 'verified'),
(28, 'olajohnfilhmar@gmail.com', '$2y$10$H9ojZMx6IvBMDOl0AzbddeO6E5WIz.G/z4xTQMhD50Yhb5NQQNdT.', 'verified'),
(31, 'qwe@qwe.com', '$2y$10$bebk1ZcU5ioA3EcsIseWz..AjuSjZLNOBySR3RrxzDyy.AJvh/Vzu', 'verified'),
(32, 'asdf@gmail.com', '$2y$10$BJrdiaaJSQQLqsyEguOxP.Nx.6VyGDDkZeEz3MCDF9sC/y4p/A6YO', 'verified'),
(33, 'qwe@email.com', '$2y$10$3NdzNYdJ0SH30ABFbdaV5ufILM901uTO.voXpJF0b2YLCqI5.Wyt2', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-11-12-051147', 'App\\Database\\Migrations\\Users', 'default', 'App', 1699765971, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `compatibility` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` int NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `itemname`, `compatibility`, `description`, `image`, `price`, `date_added`, `quantity`) VALUES
(35, '1', '1', '1', 'WIN_20231024_16_58_49_Pro.jpg', 1, '2023-12-03 21:32:08', 40),
(36, '2', '2', '2', 'WIN_20231024_16_58_59_Pro.jpg', 2, '2023-12-03 21:32:14', 10),
(37, '3', '3', '3', 'WIN_20230330_19_32_01_Pro.jpg', 3, '2023-12-08 22:06:57', 6),
(38, 'asdf', 'asdf', 'asdfasdfasfasdfasfd', 'WIN_20231128_15_30_29_Pro.jpg', 32, '2023-12-10 22:43:46', 27),
(39, 'FASD', 'f3f3vaf', 'aasdfaca3fac3afa 3fa ', 'WIN_20231022_14_02_07_Pro.jpg', 32, '2023-12-10 22:44:08', 11),
(40, '616', '6122', '621261216 21 216 ', 'WIN_20231117_16_13_11_Pro.jpg', 32, '2023-12-10 22:44:23', 32),
(41, 'cr FDV ', 'G A  FASE ', 'AF EAS FAES FA', 'WIN_20230517_18_37_35_Pro.jpg', 55, '2023-12-10 22:44:53', 54);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  `transac_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `user_id`, `date_created`, `total_amount`, `payment_method`, `status`, `transac_key`) VALUES
(27, 48, '2023-12-11 02:15:24', '90.00', 'paymaya', 'COMPLETED', 'AdRiYITLftT88Q8U05Bx03ZrAmmjP0XlFftslTwo9wbld90uB08rcoOndfAK'),
(28, 48, '2023-12-11 02:15:33', '66.00', 'gcash', 'COMPLETED', 'eVmkpCsWpgpI2XITCqT51a2RZ7Jh6OAOx7g6ceCSThFBVvaso9UGWqjmIy9b'),
(29, 40, '2023-12-11 02:30:59', '32.00', 'paypal', 'PROCESSING', '2q1InJn7xuMTg8T2XfolYBH6gdtlJRLY6vqyp9QwRYpEOPSDh4u7hXn42hef');

-- --------------------------------------------------------

--
-- Table structure for table `webproject`
--

CREATE TABLE `webproject` (
  `id` int NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `datetime_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `webproject`
--

INSERT INTO `webproject` (`id`, `username`, `password`, `image`, `email`, `role`, `datetime_created`, `status`) VALUES
(40, 'ADMINISTRATOR', '$2y$10$qKAR3EfkIygwx/tIWKhx.Oomncgu656oJvTl5GGihz9IxSG07KNCK', '338622042_5807321536061500_9100557271014267825_n3.jpg', 'olajohnfilhmar@gmail.com', 'ADMIN', '2023-12-05 23:38:22', 'UP'),
(43, 'SALESCLERK', '$2y$10$zXOIuMV0R6l51H6YPErT3.HjHvdZRznAAL2B56vxbNFmc5Du3Kzw6', NULL, NULL, 'CLERK', '2023-12-06 00:29:46', 'UP'),
(48, 'ampel', '$2y$10$P9DcwSb6f/NRiXjhCsYO/eWKDbSrxOFdDTYfTeWtBD9kpRNdzDp8q', 'WIN_20231117_16_14_08_Pro.jpg', 'elizabethgeronaga@gmail.com', 'USER', '2023-12-08 22:22:08', 'UP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_products_id_FK_cart_item_id` (`item_id`),
  ADD KEY `constraint_users_id_FK_cart_user_id` (`user_id`),
  ADD KEY `constraint_receipt_number_FK_receipts_id` (`receipt_number`);

--
-- Indexes for table `login_auth`
--
ALTER TABLE `login_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`user_id`);

--
-- Indexes for table `webproject`
--
ALTER TABLE `webproject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `login_auth`
--
ALTER TABLE `login_auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `webproject`
--
ALTER TABLE `webproject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `constraint_products_id_FK_cart_item_id` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constraint_receipt_number_FK_receipts_id` FOREIGN KEY (`receipt_number`) REFERENCES `receipts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `constraint_users_id_FK_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `webproject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `constraint_receipts_user_id_FK_webproject_user_id` FOREIGN KEY (`user_id`) REFERENCES `webproject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
