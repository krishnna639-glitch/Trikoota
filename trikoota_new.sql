-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 14, 2026 at 06:52 PM
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
-- Database: `trikoota_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `A_id` int(11) NOT NULL,
  `A_name` varchar(50) NOT NULL,
  `A_address` varchar(100) NOT NULL,
  `A_pincode` varchar(100) NOT NULL,
  `A_designation` varchar(50) NOT NULL,
  `U_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CA_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `category_name`, `image`) VALUES
(1, 'Outdoor Plants', 'outdure.jpeg'),
(2, 'Indoor Plants', 'indure.jpeg'),
(3, 'Fruits', 'fruits.jpg'),
(4, 'Flowers', 'flower.png'),
(5, 'Seeds', 'seed.png'),
(6, 'Vegetables', 'vege.png'),
(7, 'Air puryfire plants', 'air_pury.png'),
(8, 'Herba & medicines plans', 'hur_med.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `C_id` int(11) NOT NULL,
  `C_address` varchar(100) NOT NULL,
  `C_city` varchar(50) NOT NULL,
  `C_state` varchar(50) NOT NULL,
  `C_pincode` varchar(10) NOT NULL,
  `U_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `U_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `U_id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 15, 'user5', 'user5@gmail.com', 'not add to wish list', 'wish does not work', '2025-12-08 08:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_total` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) DEFAULT 'Pending',
  `order_status` varchar(50) DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_total`, `payment_status`, `order_status`) VALUES
(1, 1, '2025-12-05 08:01:30', 1200.00, 'Pending', 'Completed'),
(2, 15, '2025-12-08 06:46:31', 200.00, 'Completed', 'Processing'),
(3, 15, '2025-12-08 06:48:59', 40.00, 'Completed', 'Processing'),
(4, 15, '2025-12-08 07:39:00', 40.00, 'Completed', 'Processing'),
(5, 15, '2025-12-08 07:46:31', 40.00, 'Completed', 'Processing'),
(6, 15, '2025-12-08 08:46:35', 40.00, 'Completed', 'Processing'),
(7, 15, '2025-12-22 04:30:39', 40.00, 'Completed', 'Processing'),
(8, 15, '2025-12-22 11:38:55', 40.00, 'Completed', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'Completed',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `amount`, `payment_method`, `payment_status`, `payment_date`) VALUES
(2, 1, 1, 1200.00, 'UPI', 'Completed', '2025-12-05 10:48:32'),
(3, 2, 15, 200.00, 'Cash on Delivery', 'Completed', '2025-12-08 06:46:31'),
(4, 3, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-08 06:48:59'),
(5, 4, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-08 07:39:00'),
(6, 5, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-08 07:46:31'),
(7, 6, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-08 08:46:35'),
(8, 7, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-22 04:30:39'),
(9, 8, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-22 11:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `name`, `price`, `description`, `image`, `stock_quantity`, `created_at`) VALUES
(2, 1, 'banana', 40.00, 'fruit', '1764782102_WhatsApp Image 2025-11-24 at 6.35.39 PM (2).jpeg', NULL, '2025-12-02 11:16:43'),
(3, 1, 'chery', 200.00, 'reach fruit ', 'WhatsApp Image 2025-11-24 at 6.35.39 PM (1).jpeg', 11, '2025-12-03 12:03:38'),
(4, 2, 'apple', 300.00, 'fruit', 'logo123.png', 10, '2026-01-14 14:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `products1`
--

CREATE TABLE `products1` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products1`
--

INSERT INTO `products1` (`id`, `name`, `price`, `image`, `description`) VALUES
(1, 'Hibiscus Plant', 300.00, 'hibiscus.jpg', 'Hibiscus are popular,large flower shrubs or small trees from the mallow family,\r\nknown for their vibrant, trumpetshaped blooms that often last only a day,thriving in warm climates ans used ornamentally , \r\nmedicinally(like for tea) , and for fiber.They prefer full sun, well-drained soil, and consistent moisture, with species\r\n like Hibiscus rosa-sinensis being common, featuring glossy leaves and showy flowers in red,pink,yellow and white.'),
(2, 'Petunia', 200.00, 'petunia.jpg', 'Petunia are vibrant, popular south american\r\nflowers known for their trumpet-shaped blooms in nearly every color, excellent for\r\ncontainers,baskets ,and beds , attracting\r\npollinators like bees and butterflies.\r\nkey characteristics\r\n-appearance\r\n-growth habit\r\n-bloom time\r\n-family'),
(3, 'Aster', 220.00, 'aster.jpeg', 'Aster are star-shaped , daisy-like flowers\r\nthat are popular in gardens because they \r\nbloom in late summer and fall, when many\r\nother plants are fading. They are easy to \r\ngrow and attract bees and butterflies.\r\nKey characteristics:\r\n- composite flower\r\n- star shape\r\n- late bloomers\r\n- foliage\r\n- growing needs'),
(4, 'Sweet-Pea', 240.00, 'sweet_pea.jpg', 'Sweet peas are beautiful, fragrant climbing annual flowers known for them \r\ndelicate, butterfly-like blooms in many colors like pink, purple, white, red and yellow that love cool weather, need support to climb and are grown for gardeners and bouquets, but their seeds and pods are toxic if eaten, despite looking like edible peas. '),
(5, 'Pansy', 199.00, 'pansy.jpg', 'Pansies are cheerful, cool-weather flowers\r\nknown for their wide range of vibrant colors and distinctive \"face\" markings\r\nin the center. They are popular, low-growing plants often used in gardens, containers, and borders.'),
(6, 'Calendula', 299.00, 'calendula.jpg', 'Calendula or pot marigold is a daisy-family flower known for its bright yellow and orange blooms, long history in herbal medicine for skin healing, inflammation,\r\nand wound care and use as a culinary coloring agent or garnish, adding color and flavor to dishes while also attracting pollinators to gardens.'),
(7, 'Fenugreek', 80.00, 'fenugreek.jpg', 'Fenugreek is a plant with nutritious leaves and seeds used globally as a spice\r\n(curry, maple syrup flavor), vegetable and traditional medicine for digestion, blood\r\nsugar, lactation and male vitality, through more research is needed for specific health claims like diabetes or menstrual cramps.'),
(8, 'Sea Milkwort', 499.00, 'korean.jpg', 'Sea Milkwort is a low-growing fleshy perennial herb thriving in salty soils, coastal salt marshes and saline meadows known for forming pinkish carpets when blooming with tiny, petal-like flowers.\r\nSea Milkwort used as a medicine to treat heart palpitations, yellow skin, shortness of breath and swollen parts of the body.');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `R__id` int(11) NOT NULL,
  `R_name` varchar(50) NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`R__id`, `R_name`, `permission`) VALUES
(1, 'Admin', 'ALL'),
(2, 'Customer', 'BUY,VIEW');

-- --------------------------------------------------------

--
-- Table structure for table `userr`
--

CREATE TABLE `userr` (
  `U_id` int(11) NOT NULL,
  `U_name` varchar(100) NOT NULL,
  `U_email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `U_phone` varchar(15) DEFAULT NULL,
  `R__id` int(11) NOT NULL DEFAULT 2,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userr`
--

INSERT INTO `userr` (`U_id`, `U_name`, `U_email`, `password`, `U_phone`, `R__id`, `reset_token`, `token_expiry`, `address`, `created_at`) VALUES
(1, 'kusum gohil', 'kusum23@gmail.com', '$2y$10$SO.lCT4WJSmnze2t5sqt1O0bSMlIcStyFnZ/rWVEJtmS1MTJaukA.', '07863061767', 2, NULL, NULL, '', '2026-01-05 16:26:45'),
(11, 'Admin', 'admin@trikoota.com', '$2y$10$5PZlQQQyzPWDBHCHmieGu.bZ8Nzvs2e6TBrK55qfBKKKohMuGNv5i', '7890789090', 1, NULL, NULL, 'NARODA,AHMEDABAD', '2026-01-05 16:26:45'),
(36, 'divya', 'divya@gmail.com', '$2y$10$aVH/RgD9zL7H3FvNMouofu/HuOLmQ9yPB9XBXjHt2Q119i9WNYwxy', '4571865414', 2, NULL, NULL, 'dbdhbjk', '2026-01-12 08:46:40'),
(40, 'vani', 'vani@gmail.com', '$2y$10$pZtm0vvD7DJ6KNhzwD9nZuVIYyTHYsyDVqToLRTHMNhl8b0bUWjj2', '8758401112', 2, NULL, NULL, 'Bhavnagar', '2026-01-12 16:21:25'),
(41, 'disha', 'disha@gmail.com', '$2y$10$nkel/gxwCm7UsyhK9q38EuatCVRNGbyzNTOc9MIDRcEp.vNxMmvjq', '6782034667', 2, NULL, NULL, 'ddddddddd', '2026-01-13 18:15:21'),
(42, 'tiki', 'tiki@gmail.com', '$2y$10$8wnplCkIzki0S3r/AC6PFOse4AOVRaamkeBB5xafDGU3D8DcPp99q', '3443560990', 2, NULL, NULL, 'hhhhhhhhhhhhh', '2026-01-14 06:49:58'),
(43, 'userthree', 'user5@gmail.com', '$2y$10$g.fgPIZhZ3PwOhMs/mggKeg8K7U3OL7z6rra2LPO992bNr9ikZPse', '1234567889', 2, NULL, NULL, 'guj', '2026-01-14 07:11:41'),
(44, 'krishna', 'sidhi1@gmail.com', '$2y$10$bZ8HSU8PfBPVN0Qw9YlzouacxdfT9.Z2UAEFwkP86xqJcnpM1KK2O', '1234567890', 2, NULL, NULL, 'guj', '2026-01-14 09:53:11'),
(45, 'navi', 'navi@gmail.com', '$2y$10$9OxV6el/yBffJtLRpctrjuyhEmB9/gqQ.GRY9LXlBg5OeZ5rmXqdC', '1478523698', 2, NULL, NULL, 'guj', '2026-01-14 16:59:51'),
(47, 'userone', 'userone@gmail.com', '$2y$10$97UQ2f0yrQUgb70q/r2nr.c7xuf9TGhisuSBw4Mpa4cqt8bs4jK2m', '1234567880', 2, NULL, NULL, 'guj', '2026-01-14 17:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `w_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`A_id`),
  ADD KEY `U_id` (`U_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CA_id`),
  ADD KEY `fk_cart_product` (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`C_id`),
  ADD KEY `U_id` (`U_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`U_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `U_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_c_id` (`categories_id`);

--
-- Indexes for table `products1`
--
ALTER TABLE `products1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`R__id`);

--
-- Indexes for table `userr`
--
ALTER TABLE `userr`
  ADD PRIMARY KEY (`U_id`),
  ADD UNIQUE KEY `U_email` (`U_email`),
  ADD UNIQUE KEY `U_phone` (`U_phone`),
  ADD KEY `fk_user_role` (`R__id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `fk_wish_product` (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `A_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CA_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products1`
--
ALTER TABLE `products1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `R__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userr`
--
ALTER TABLE `userr`
  MODIFY `U_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`U_id`) REFERENCES `userr` (`U_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`p_id`) REFERENCES `products1` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`U_id`) REFERENCES `userr` (`U_id`);

--
-- Constraints for table `userr`
--
ALTER TABLE `userr`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`R__id`) REFERENCES `roles` (`R__id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wish_product` FOREIGN KEY (`pro_id`) REFERENCES `products1` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
