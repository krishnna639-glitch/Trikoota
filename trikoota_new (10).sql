-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 03:52 PM
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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `name`, `price`, `image`, `quantity`) VALUES
(6, 15, 3, 'chery', 200.00, 'WhatsApp Image 2025-11-24 at 6.35.39 PM (1).jpeg', 2),
(9, 0, 3, NULL, NULL, NULL, 5),
(14, 47, 4, NULL, NULL, NULL, 3),
(15, 47, 3, NULL, NULL, NULL, 1),
(17, 11, 5, NULL, NULL, NULL, 1),
(23, 49, 4, NULL, NULL, NULL, 2),
(26, 48, 15, NULL, NULL, NULL, 1),
(27, 48, 11, NULL, NULL, NULL, 1),
(36, 53, 11, NULL, NULL, NULL, 1),
(37, 53, 9, NULL, NULL, NULL, 1),
(88, 52, 7, NULL, NULL, NULL, 1);

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
(1, 'Outdoor ', 'outdure.jpeg'),
(2, 'Indoor ', 'indure.jpeg'),
(3, 'Fruits', 'fruits.jpg'),
(4, 'Flowers', 'flower.png'),
(5, 'Seeds', 'seed.png'),
(6, 'Vegetables', 'vege.png'),
(7, 'Air puryfire', 'air_pury.png'),
(8, 'Herbs & medicines', 'hur_med.png');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `deal_code` varchar(50) NOT NULL,
  `deal_title` varchar(100) NOT NULL,
  `deal_type` enum('percentage','flat') NOT NULL,
  `deal_value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT 0.00,
  `apply_on` enum('all','category','product') DEFAULT 'all',
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `max_discount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) DEFAULT 0,
  `valid_from` date NOT NULL,
  `valid_till` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `deal_code`, `deal_title`, `deal_type`, `deal_value`, `min_order_amount`, `apply_on`, `category_id`, `product_id`, `max_discount`, `usage_limit`, `used_count`, `valid_from`, `valid_till`, `status`, `created_at`) VALUES
(1, 'GREEN10', '10% Off on All Plants', 'percentage', 10.00, 999.00, 'all', NULL, NULL, NULL, NULL, 0, '2026-01-01', '2026-12-31', 'active', '2026-01-26 12:48:22'),
(2, 'SAVE200', 'Flat ₹200 Off', 'flat', 200.00, 1499.00, 'all', NULL, NULL, NULL, NULL, 0, '2026-01-01', '2026-06-30', 'active', '2026-01-26 12:48:22'),
(3, 'HOLI2026', 'holi special', 'flat', 5.00, 2.00, 'all', 0, 0, NULL, NULL, 0, '2026-04-06', '2026-06-06', 'active', '2026-04-06 09:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `deal_products`
--

CREATE TABLE `deal_products` (
  `id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deal_products`
--

INSERT INTO `deal_products` (`id`, `deal_id`, `product_id`) VALUES
(10, 1, 6),
(11, 1, 7),
(12, 1, 8),
(14, 1, 9),
(15, 1, 10),
(16, 1, 11),
(17, 1, 12),
(18, 1, 14),
(19, 1, 15),
(26, 1, 18),
(25, 1, 19),
(27, 1, 22),
(38, 1, 43),
(28, 1, 58),
(50, 1, 59),
(113, 1, 60),
(114, 1, 61),
(115, 1, 62),
(116, 1, 63),
(117, 1, 64),
(118, 1, 65),
(169, 3, 35);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `U_id`, `name`, `email`, `subject`, `message`, `created_at`, `status`) VALUES
(1, 15, 'user5', 'user5@gmail.com', 'not add to wish list', 'wish does not work', '2025-12-08 08:31:42', 'read'),
(3, 52, 'ananya gayen', 'anu@gmail.com', 'buy now erorr', 'there is an error in buy now button', '2026-02-08 10:16:23', 'read'),
(4, 0, 'ananya ', 'anu@gmail.com', 'view error', 'tere i s an error solve t he error', '2026-04-06 08:07:58', 'read');

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
  `order_status` varchar(50) DEFAULT 'Processing',
  `deal_code` varchar(50) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `cancelled_by` enum('user','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_total`, `payment_status`, `order_status`, `deal_code`, `discount_amount`, `cancelled_by`) VALUES
(1, 1, '2025-12-05 08:01:30', 1200.00, 'Pending', 'Completed', NULL, 0.00, NULL),
(2, 15, '2025-12-08 06:46:31', 200.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(3, 15, '2025-12-08 06:48:59', 40.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(4, 15, '2025-12-08 07:39:00', 40.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(5, 15, '2025-12-08 07:46:31', 40.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(6, 15, '2025-12-08 08:46:35', 40.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(7, 15, '2025-12-22 04:30:39', 40.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(8, 15, '2025-12-22 11:38:55', 40.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(9, 47, '2026-01-25 10:19:35', 0.00, 'Completed', 'Pending', NULL, 0.00, NULL),
(10, 47, '2026-01-26 08:09:28', 200.00, 'Paid', 'Delivered', NULL, 0.00, NULL),
(11, 47, '2026-01-26 08:12:26', 200.00, 'Pending', 'Pending', NULL, 0.00, NULL),
(12, 48, '2026-01-28 14:04:22', 180.00, 'Pending', 'Pending', NULL, 0.00, NULL),
(13, 48, '2026-01-28 14:09:06', 180.00, 'Pending', 'Pending', NULL, 0.00, NULL),
(14, 48, '2026-01-28 14:32:55', 180.00, 'Pending', 'Pending', NULL, 0.00, NULL),
(15, 53, '2026-01-30 14:03:29', 1264.50, 'Pending', 'Pending', NULL, 0.00, NULL),
(16, 53, '2026-01-30 14:11:12', 252.90, 'Pending', 'Pending', NULL, 0.00, NULL),
(17, 53, '2026-01-30 14:12:44', 495.00, 'Pending', 'Pending', NULL, 0.00, NULL),
(18, 54, '2026-01-30 14:18:36', 387.90, 'Pending', 'Pending', NULL, 0.00, NULL),
(19, 54, '2026-01-30 14:19:17', 495.00, 'Paid', 'Delivered', NULL, 0.00, NULL),
(20, 55, '2026-01-31 02:41:21', 495.00, 'Paid', 'Delivered', NULL, 0.00, ''),
(21, 50, '2026-01-31 02:55:37', 792.90, 'Paid', 'Delivered', NULL, 0.00, NULL),
(22, 52, '2026-02-07 07:36:42', 180.00, 'Failed', 'Cancelled', NULL, 0.00, 'admin'),
(23, 52, '2026-02-08 08:51:34', 333.00, 'Pending', 'Cancelled', NULL, 0.00, 'user'),
(24, 52, '2026-02-08 08:54:40', 257.40, 'Pending', 'Cancelled', NULL, 0.00, 'user'),
(25, 52, '2026-02-08 09:09:28', 315.00, 'Pending', 'Pending', NULL, 0.00, 'admin'),
(26, 52, '2026-02-09 09:09:52', 199.00, 'Failed', 'Cancelled', NULL, 0.00, 'admin'),
(27, 52, '2026-02-16 10:09:42', 99.00, 'Paid', 'Delivered', NULL, 0.00, ''),
(28, 52, '2026-02-16 10:21:08', 145.00, 'Failed', 'Cancelled', NULL, 0.00, 'admin'),
(29, 52, '2026-02-16 16:02:30', 145.00, 'Paid', 'Delivered', NULL, 0.00, ''),
(30, 52, '2026-02-26 09:04:29', 99.00, 'Paid', 'Delivered', NULL, 0.00, ''),
(31, 52, '2026-03-12 07:28:17', 333.00, 'Pending', 'Pending', NULL, 0.00, NULL),
(32, 52, '2026-03-13 13:42:22', 699.00, 'Failed', 'Cancelled', NULL, 0.00, 'admin'),
(33, 52, '2026-04-06 07:46:04', 29.00, 'Failed', 'Pending', NULL, 0.00, ''),
(34, 52, '2026-04-06 08:01:13', 225.00, 'Pending', 'Processing', NULL, 0.00, NULL),
(35, 50, '2026-04-07 03:18:33', 153.00, 'Paid', 'Processing', NULL, 0.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `deal_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `price`, `deal_name`) VALUES
(1, 5, 2, 1, 40.00, NULL),
(2, 6, 2, 1, 40.00, NULL),
(3, 7, 2, 1, 40.00, NULL),
(4, 8, 2, 1, 40.00, NULL),
(5, 10, 3, 1, 200.00, NULL),
(6, 11, 3, 1, 200.00, NULL),
(7, 14, 6, 1, 180.00, ''),
(8, 15, 15, 5, 252.90, ''),
(9, 16, 15, 1, 252.90, ''),
(10, 17, 9, 1, 495.00, ''),
(11, 18, 15, 1, 252.90, ''),
(12, 18, 12, 1, 135.00, ''),
(13, 19, 9, 1, 495.00, ''),
(14, 20, 9, 1, 495.00, ''),
(15, 21, 15, 1, 252.90, ''),
(16, 21, 12, 1, 135.00, ''),
(17, 21, 14, 1, 405.00, ''),
(18, 22, 6, 1, 180.00, ''),
(19, 23, 6, 1, 180.00, ''),
(20, 23, 7, 1, 153.00, ''),
(21, 24, 19, 1, 114.30, ''),
(22, 24, 18, 1, 143.10, ''),
(23, 25, 11, 1, 315.00, ''),
(24, 26, 17, 1, 199.00, NULL),
(25, 27, 58, 1, 99.00, NULL),
(26, 28, 59, 1, 145.00, NULL),
(27, 29, 59, 1, 145.00, NULL),
(28, 30, 38, 1, 99.00, NULL),
(29, 31, 6, 1, 180.00, ''),
(30, 31, 7, 1, 153.00, ''),
(31, 32, 74, 1, 699.00, NULL),
(32, 33, 66, 1, 29.00, NULL),
(33, 34, 8, 1, 225.00, 'GREEN10'),
(34, 35, 7, 1, 153.00, 'GREEN10');

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
(9, 8, 15, 40.00, 'Cash on Delivery', 'Completed', '2025-12-22 11:38:55'),
(11, 11, 47, 200.00, 'Cash On Delivery', 'Pending', '2026-01-26 08:12:27'),
(12, 14, 48, 180.00, 'Cash On Delivery', 'Pending', '2026-01-28 14:32:55'),
(13, 15, 53, 1264.50, 'Cash On Delivery', 'Pending', '2026-01-30 14:03:29'),
(15, 17, 53, 495.00, 'Cash On Delivery', 'Pending', '2026-01-30 14:12:44'),
(16, 18, 54, 387.90, 'Cash On Delivery', 'Pending', '2026-01-30 14:18:36'),
(18, 20, 55, 495.00, 'Cash On Delivery', 'Paid', '2026-01-31 02:41:21'),
(19, 21, 50, 792.90, 'Cash On Delivery', 'Pending', '2026-01-31 02:55:37'),
(20, 22, 52, 180.00, 'Cash On Delivery', 'Pending', '2026-02-07 07:36:42'),
(21, 23, 52, 333.00, 'Cash On Delivery', 'Pending', '2026-02-08 08:51:34'),
(22, 24, 52, 257.40, 'Cash On Delivery', 'Pending', '2026-02-08 08:54:40'),
(23, 25, 52, 315.00, 'Cash On Delivery', 'Pending', '2026-02-08 09:09:28'),
(24, 26, 52, 199.00, 'Cash On Delivery', 'Failed', '2026-02-09 09:09:52'),
(25, 27, 52, 99.00, 'Cash On Delivery', 'Paid', '2026-02-16 10:09:42'),
(26, 28, 52, 145.00, 'Cash On Delivery', 'Failed', '2026-02-16 10:21:08'),
(27, 29, 52, 145.00, 'Cash On Delivery', 'Paid', '2026-02-16 16:02:30'),
(28, 30, 52, 99.00, 'Cash On Delivery', 'Paid', '2026-02-26 09:04:29'),
(29, 31, 52, 333.00, 'Cash On Delivery', 'Pending', '2026-03-12 07:28:17'),
(30, 32, 52, 699.00, 'Cash On Delivery', 'Failed', '2026-03-13 13:42:22'),
(31, 33, 52, 29.00, 'Cash On Delivery', 'Failed', '2026-04-06 07:46:04'),
(32, 34, 52, 225.00, 'Cash On Delivery', 'Pending', '2026-04-06 08:01:13'),
(33, 35, 50, 153.00, 'Cash On Delivery', 'Paid', '2026-04-07 03:18:33');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tips` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `name`, `price`, `description`, `image`, `stock_quantity`, `created_at`, `tips`) VALUES
(6, 2, 'Snake Plant', 200.00, 'The snake plant, scientifically known as Dracaena trifasciata (formerly Sansevieria), is a popular indoor evergreen plant with upright, sword-like leaves. It’s often called Mother-in-Law’s Tongue and is loved for being very low maintenance and air-purifying — it can help filter indoor air pollutants like formaldehyde and benzene. Snake plants tolerate low light, need infrequent watering, and thrive with minimal care, making them ideal for homes, offices, and beginners. ', '1769591808_Snake Plant.png', 7, '2026-01-28 05:44:13', 'Light: Bright indirect sunlight (tolerates low light).\r\n\r\nWater: Only water when the soil dries out; avoid overwatering.\r\n\r\nSoil: Use well-draining potting mix (cactus/succulent mix is ideal).'),
(7, 2, 'Aloe Vera', 170.00, 'Aloe vera (Aloe barbadensis Miller) is a succulent medicinal plant known for its thick, fleshy green leaves that contain soothing gel. It’s widely used for skin care, minor burns, moisturizing, and natural remedies — plus it’s easy to care for and suitable for both indoor and outdoor growth. Aloe thrives in bright indirect sunlight, needs infrequent watering, and does well in well-drained soil.', 'Aloe Vera.png', 7, '2026-01-28 09:22:30', 'Light: Bright indirect sunlight (tolerates low light).  Water: Only water when the soil dries out; avoid overwatering.  Soil: Use well-draining potting mix (cactus/succulent mix is ideal).'),
(8, 2, 'Boston Fern', 250.00, 'The Boston Fern (Nephrolepis exaltata), also known as the sword fern, fishbone fern, or simply fern, is a classic indoor foliage plant known for its lush, arching fronds and delicate texture. Its vibrant green foliage makes it a popular choice for home décor, hanging baskets, balconies, and indoor plant displays. Boston ferns also help purify indoor air and add humidity to dry indoor spaces — great for living rooms, bathrooms, and offices.', 'Boston Fern.png', 14, '2026-01-28 09:27:33', 'Keep soil moist but not soggy — watering 2–3 times a week in warm months.  Provide bright, indirect light; avoid harsh midday sun.  Increase humidity by misting or using a pebble tray under the pot.  Trim yellow fronds to keep it looking lush and healthy.'),
(9, 2, 'Peace Lily', 550.00, 'The Peace Lily (Spathiphyllum spp.) is a classic indoor flowering houseplant known for its lush green foliage and elegant white blooms (spathes). It’s prized for both beauty and air-purifying qualities, helping filter common indoor toxins and making your space feel fresher and calmer. Peace Lilies thrive in bright, indirect light (and can tolerate low light), prefer consistent moisture without waterlogging, and are generally low-maintenance, though they enjoy higher humidity.', 'Peace Lily.png', 24, '2026-01-28 09:29:31', 'Light: Bright indirect light (avoid direct sun).  Water: Water when the top soil feels dry, keeping soil moist but not soggy.  Humidity: Enjoys higher humidity — mist leaves or place in bathroom/kitchen.  Temperature: Warm rooms (15–27 °C) are ideal.'),
(10, 2, 'Spider Plant', 150.00, 'The Spider Plant (Chlorophytum comosum) is a popular indoor houseplant known for its archingly cascading leaves with green and white variegation and its ability to produce small baby plantlets (“spiderettes”). It’s very easy to care for, tolerant of a range of light conditions, and is often recommended as a beginner-friendly plant. It’s also known for being one of the air-purifying plants that can help improve indoor air quality.', 'Spider Plant.png', 20, '2026-01-28 09:30:49', 'Light: Bright, indirect sunlight is ideal; tolerates moderate indoor light.  Water: Water when the topsoil feels dry; avoid overwatering.  Soil: Use well-draining potting mix to avoid root rot.  Placement: Great for shelves, hanging baskets, desks, and living rooms due to cascading foliage.'),
(11, 2, 'Rubber Plant', 350.00, 'The Rubber Plant (Ficus elastica) is a striking indoor houseplant famous for its large, glossy foliage and easy-care nature. Its dark, leathery leaves (often deep green, burgundy, or variegated) make it a bold decorative piece that purifies indoor air and adds a lush, tropical vibe to homes and offices. Rubber plants thrive in bright, indirect light, like near windows with filtered sunlight, and prefer watering only when the top soil dries to avoid overwatering. They are generally low-maintenance, though the sap can be irritating if ingested or contacting skin, so they’re not pet-friendly', '1769593168_Rubber Plant.png', 16, '2026-01-28 09:35:22', 'Light: Bright indirect light is best; avoid harsh direct sun on leaves.  Water: Water moderately — allow the top layer of soil to dry before watering again.  Maintenance: Wipe leaves occasionally to keep them dust-free and glossy.  Placement: Ideal for living rooms, bedrooms, and office spaces.'),
(12, 2, 'Pothos', 150.00, 'Pothos (Epipremnum aureum), often called Money Plant or Devil’s Ivy, is one of the most popular easy-care indoor vines. It features heart-shaped leaves that can be solid green, variegated with white, yellow, or cream, or even neon chartreuse depending on the variety. Pothos grows quickly, trailing beautifully from hanging baskets or climbing up supports, and is excellent for beginners and busy plant parents. It also has air-purifying qualities, helping remove indoor pollutants and making your home or office feel fresher.', 'Pothos.png', 17, '2026-01-28 09:37:45', 'Light: Bright indirect light is best; avoid harsh direct sun on leaves.  Water: Water moderately — allow the top layer of soil to dry before watering again.  Maintenance: Wipe leaves occasionally to keep them dust-free and glossy.  Placement: Ideal for living rooms, bedrooms, and office spaces.'),
(14, 2, 'Dracaena', 450.00, 'Dracaena is a genus of tropical plants with about 200+ species that include popular indoor houseplants like Dracaena fragrans, Dracaena marginata, Dracaena colorama, and Dracaena reflexa (“Song of India”). They are known for upright, sword-like leaves in various shades and patterns — from solid green to variegated with yellow, red, or cream. Dracaenas are ornamental, air-purifying, and relatively low-maintenance plants that add height and elegance to homes and offices. The name comes from the Greek word drákaina, meaning “female dragon”.', 'Dracaena.png', 24, '2026-01-28 09:42:16', 'Light: Bright, indirect light — avoid harsh direct sun for most varieties. Water: Water moderately — allow the topsoil to dry before watering. Placement: Ideal for living rooms, bedrooms, offices, and entryways. Soil: Use well-draining potting mix (helps prevent root rot).  📌 Note: some Dracaena species (especially the colorful/red ones) may be toxic to pets if ingested, so keep them clear of cats/dogs.'),
(15, 2, 'Bamboo Plam', 281.00, 'The Bamboo Palm (Chamaedorea seifrizii), also called Reed Palm or Lady Palm, is a graceful indoor palm plant with slender, bamboo-like stems and lush feathery fronds. It’s valued for its tropical look, easy care, and air-purifying ability, making it excellent for homes, offices, living rooms, or shaded corners. It thrives in bright indirect light and tolerates lower light conditions, and prefers moderate watering without waterlogging. Bamboo Palms bring a calming green aesthetic and can grow from small tabletop sizes to larger floor specimens over time.', 'Bamboo Plam.png', 15, '2026-01-28 09:45:53', 'Light: Bright indirect light — no harsh direct sun.  Water: Water when the top inch of soil is dry; keep soil moist but not soggy.  Humidity: Prefers moderate humidity — misting occasionally helps.  Placement: Great indoors near windows with filtered light or in shaded corners.'),
(16, 1, 'Petunias', 169.00, 'Petunias are bright, colorful flowering plants that bloom beautifully in gardens, pots, and hanging baskets. They come in many shades like pink, purple, white, red, and yellow. Petunias are fast-growing and bloom for a long time, making them perfect for adding instant beauty to balconies and outdoor spaces.', 'Petunias.png', 20, '2026-02-07 14:43:43', '☀ Sunlight: Petunias love full sun. Keep them where they get at least 5–6 hours of sunlight daily.  💧 Watering: Water regularly, but don’t let the soil stay soggy. Let the top soil dry slightly before watering again.  🌿 Soil: Use well-draining, fertile soil for healthy growth.  🌼 Fertilizer: Feed every 2 weeks with liquid flowering fertilizer for more blooms.  ✂ Pruning: Remove dead flowers (deadheading) to encourage new blooms and bushy growth.  🐛 Pests: Watch for aphids or caterpillars. Use neem oil if needed.'),
(17, 1, 'Geraniums', 199.00, 'Geraniums (often Pelargonium species) are popular ornamental flowering plants known for their bright, clustered blooms in red, pink, white, orange, purple, and mixed shades. They’re widely grown in gardens and containers because of their long-lasting flowers, pleasant fragrance, and attractive foliage. They can also attract pollinators like bees and butterflies.', 'Geraniums.png', 12, '2026-02-07 14:47:21', '☀ Light  Geraniums prefer full sun to partial shade — aim for around 4–6 hours of direct sunlight daily for best flowering.  💧 Watering  Water moderately — allow the top of the soil to dry between waterings. Avoid waterlogging, as soggy soil can lead to root rot.  🌿 Soil  Use well-draining soil rich in organic matter. Good drainage is crucial to prevent overwatering issues.  🌼 Fertilizer  Feed with a balanced liquid or granular fertilizer during the growing season to encourage healthy growth and abundant flowers.  ✂ Pruning & Deadheading  Removing spent flowers (deadheading) keeps plants tidy and encourages more blooms. Trim leggy stems to promote bushiness.  🐛 Pests & Problems  Watch for common issues like aphids or powdery mildew. Good air circulation and neem oil can help prevent problems.'),
(18, 1, 'Hibiscus', 159.00, 'Hibiscus (Hibiscus rosa-sinensis), also called Gudhal, Chinese rose, Jasvandi, or shoe flower, is a tropical flowering shrub valued for its large, colorful, trumpet-shaped blooms in shades of red, pink, yellow, orange, white and more. It’s commonly grown in gardens, balconies and patios and is also used in Ayurveda, hair care (hibiscus oil/tea) and traditional rituals. The plant can bloom throughout warm months and attract pollinators.', 'Hibiscus.png', 12, '2026-02-07 14:51:01', '🌞 Light  Needs full sun to partial shade — ideally 6–8 hours of sunlight daily for best flowering.  💧 Watering  Water regularly to keep the soil moist but not soggy. Overwatering can cause root rot. Reduce watering in winter.  🪴 Soil  Use well-draining, fertile soil rich in organic matter.  🧪 Fertilizer  Feed every 2–4 weeks during active growth with balanced or organic fertilizer to boost blooms.  ✂ Pruning & Deadheading  Remove spent flowers and prune to shape the plant — this encourages more blooms and keeps the plant bushy.  🐛 Pests & Problems  Hibiscus can attract pests like mealybugs and aphids; neem oil spray helps control them naturally. (Note: common advice from gardeners)  🌡 Temperature  Being tropical, it prefers warm temperatures. In colder weather, growth slows and watering should be reduced. (General plant care knowledge)  '),
(19, 1, 'Marigolds (Genda)', 127.00, 'Marigolds are bright, cheerful flowering plants with yellow, orange, and red blooms. They grow quickly and flower for a long time. Marigolds are easy to maintain and are commonly used in gardens and decorations. They also help repel insects naturally. These plants look great in pots and borders.', 'Marigolds.png', 12, '2026-02-07 14:55:47', '☀ Full sunlight 💧 Moderate watering 🌱 Well-drained soil ✂ Remove dry flowers 🧪 Light fertilizer every 2 weeks'),
(20, 1, 'Bougainvillea', 145.00, 'Bougainvillea is a hardy climber plant known for its colorful paper-like flowers. It comes in pink, purple, red, orange, and white shades. It grows fast and adds beauty to walls, gates, and balconies. Bougainvillea blooms more when slightly stressed. It is drought-tolerant and low maintenance.', 'Bougainvillea.png', 14, '2026-02-07 14:56:36', '☀ Full sun (6–8 hrs) 💧 Water only when soil is dry 🌱 Well-draining soil ✂ Regular pruning 🧪 Monthly feeding'),
(21, 1, 'Croton', 199.00, 'Croton is a decorative foliage plant famous for its colorful leaves in green, yellow, red, and orange. It is perfect for indoor and outdoor spaces. Croton adds a tropical look to gardens and homes. Leaf colors become brighter in good sunlight. It is mainly grown for its attractive leaves.', 'Croton.png', 15, '2026-02-07 14:57:49', '☀ Bright indirect light 💧 Keep soil slightly moist 🌱 Loose fertile soil 🌡 Warm temperature 🐛 Neem oil if pests appear'),
(22, 1, 'Coleus', 149.00, 'Coleus is a beautiful leafy plant available in many bright colors and patterns. It is mostly grown for its vibrant foliage. Coleus grows well in pots and garden beds. It adds color even without flowers. This plant grows fast and is easy to care for.', 'Coleus.png', 14, '2026-02-07 14:58:38', '☀ Partial sunlight 💧 Regular watering 🌱 Rich well-drained soil ✂ Pinch tips for bushy growth 🧪 Light fertilizer'),
(23, 1, 'Areca Palm', 145.00, 'Areca Palm is a popular indoor palm with soft, feathery green leaves. It improves air quality and gives a fresh tropical look. It is perfect for homes and offices. Areca Palm grows slowly and stays elegant for years. It is safe for pets and easy to maintain.', 'Areca Plam.png', 20, '2026-02-07 14:59:51', '☀ Bright indirect light 💧 Water when top soil dries 🌱 Well-drained soil 🌫 Likes humidity ✂ Remove dry leaves'),
(24, 1, 'Cycas (Sago Palm)', 149.00, 'Cycas is a slow-growing ornamental plant with stiff, shiny leaves. It looks like a small palm tree and is great for landscaping. Cycas is very hardy and long-lasting. It adds a classy look to gardens and entrances. This plant needs very little care.', 'Cycas.png', 14, '2026-02-07 15:00:52', '☀ Bright sunlight 💧 Water sparingly 🌱 Sandy well-drained soil ✂ Remove yellow leaves 🧪 Feed occasionally'),
(25, 3, 'Strawberries', 349.00, 'Strawberries are sweet and juicy fruits perfect for home gardening. They grow well in pots, hanging baskets, and garden beds. Compact plants with attractive green foliage. Ideal for terrace and balcony gardening. Produces multiple harvests in the growing season.', 'Strawberries.png', 25, '2026-02-14 18:56:16', '🌞 Full sunlight (6–8 hours daily) 💧 Keep soil consistently moist 🌱 Rich, well-drained soil 🌿 Add compost regularly ✂️ Remove runners for better fruiting'),
(26, 3, 'Lemon', 189.00, 'Lemon plants produce fresh, tangy fruits rich in Vitamin C. Perfect for container gardening and home orchards. Glossy green leaves add ornamental value. Can produce fruits multiple times a year. Easy to maintain with proper sunlight.', 'Lemon.png', 25, '2026-02-14 18:57:06', ' 🌞 Full sunlight 💧 Moderate but deep watering 🌱 Well-drained, slightly acidic soil 🌿 Apply citrus fertilizer monthly ✂️ Prune lightly for shape and airflow'),
(27, 3, 'Orange', 559.00, 'Orange plants produce sweet and juicy fruits. Great for pots and small garden spaces. Evergreen plant with glossy foliage. Adds both beauty and productivity to your home garden. Long-lasting and rewarding plant.', 'Orange.png', 24, '2026-02-14 18:58:08', '🌞 Full sunlight 💧 Regular watering (avoid waterlogging) 🌱 Fertile, well-drained soil 🌿 Seasonal fertilization ✂️ Prune after fruiting'),
(28, 3, 'Blueberries', 669.00, 'Blueberries are nutritious fruits rich in antioxidants. Compact shrubs ideal for container gardening. Produce sweet berries during the season. Attractive foliage adds decorative value. Perfect for healthy home-grown produce.', 'Blueberries.png', 25, '2026-02-14 18:59:32', '🌞 Full to partial sunlight 💧 Keep soil moist but not soggy 🌱 Acidic, well-drained soil 🌿 Mulch to retain moisture ❄️ Protect from extreme heat'),
(29, 3, 'Olive Tree', 789.00, 'Olive trees are elegant evergreen plants. They produce small nutritious olives. Perfect for pots and Mediterranean-style gardens. Drought tolerant and long-living plant. Adds a premium look to any space.', 'Olive Tree.png', 25, '2026-02-14 19:02:26', '🌞 Full sunlight 💧 Light to moderate watering 🌱 Sandy, well-drained soil 🌬 Good air circulation ✂️ Prune annually for shape'),
(30, 4, 'Orchids', 359.00, 'Orchids are exotic and elegant flowering plants. They bring a luxurious look to indoor spaces. Known for their long-lasting and unique blooms. Ideal for home décor and gifting. Low maintenance when placed properly.', 'Orchids.png', 15, '2026-02-14 19:04:28', '🌤 Bright indirect sunlight 💧 Water once a week 🌱 Special orchid potting mix 🌬 Good air circulation 🚫 Avoid direct harsh sunlight'),
(31, 4, 'Dahlias', 469.00, 'Dahlias are stunning flowering plants known for their large, colorful blooms. They add elegance and vibrancy to gardens, balconies, and indoor spaces. Available in various shades, they bloom beautifully in the growing season. Perfect for decorative pots and landscaping. A favorite choice for flower lovers and gifting purposes.', 'Dahlias.png', 20, '2026-02-14 19:06:03', '🌞 Full sunlight (6–8 hours daily) 💧 Moderate watering, keep soil moist 🌱 Fertile, well-drained soil ✂️ Remove faded blooms regularly 📏 Provide support for taller varieties'),
(32, 4, 'Lilies', 449.00, 'Lilies are elegant flowering plants with fragrant and eye-catching blooms. They enhance garden beauty with their tall stems and vibrant colors. Ideal for pots, garden beds, and floral decoration. They bloom seasonally and create a graceful look. Low maintenance and highly attractive plants.', 'Lilies.png', 20, '2026-02-14 19:07:19', 'Lilies  🌤 Partial to full sunlight 💧 Moderate watering, avoid waterlogging 🌱 Organic-rich, well-drained soil 🌬 Good air circulation 🌿 Fertilize during growing season'),
(33, 4, 'Sunflowers', 489.00, 'Sunflowers are bright, cheerful plants that symbolize positivity. Their large yellow blooms instantly enhance any garden space. Perfect for outdoor gardens and terrace farming. They attract bees and butterflies. Easy to grow and beginner-friendly.', 'Sunflowers.png', 25, '2026-02-14 19:08:48', '🌞 Full direct sunlight 💧 Regular watering, especially during flowering 🌱 Nutrient-rich, well-drained soil 📏 Provide staking for tall plants 🍂 Remove dry leaves for healthy growth'),
(34, 4, 'Tulips', 359.00, 'Tulips are beautiful seasonal flowers known for their cup-shaped blooms. Available in vibrant colors, they create a stunning garden display. Perfect for pots, borders, and landscaping. They bloom in cooler seasons and enhance outdoor beauty. Highly popular for decorative gardening.', 'Tulips.png', 25, '2026-02-14 19:09:38', '🌤 Full to partial sunlight 💧 Light watering after planting 🌱 Loose, well-drained soil ❄️ Prefer cooler climate 🚫 Avoid excessive moisture'),
(35, 4, 'Gerbera Daisies', 359.00, 'Gerbera daisies are bright and colorful flowering plants. Their large blooms make them perfect for home decoration. Suitable for both indoor and outdoor gardening. Long-lasting flowers with attractive appearance. Great option for gifting and special occasions.', 'Gerbera Daisies.png', 25, '2026-02-14 19:10:35', '🌞 Bright sunlight 💧 Moderate watering 🌱 Well-drained soil ✂️ Remove faded flowers 🌿 Monthly liquid fertilizer'),
(36, 4, 'Hydrangeas', 359.00, 'Hydrangeas are lush flowering plants with large clustered blooms. They add softness and charm to gardens and balconies. Available in beautiful pastel shades. Perfect for decorative landscaping. Bloom beautifully with proper care.', 'Hydrandeas.png', 25, '2026-02-14 19:11:29', '🌤 Partial shade preferred 💧 Keep soil consistently moist 🌱 Organic-rich, well-drained soil ✂️ Prune after flowering ☀️ Protect from harsh afternoon sun'),
(37, 4, 'Lavender', 259.00, 'Lavender is a fragrant herb with beautiful purple flowers. It adds color and soothing aroma to your garden. Perfect for pots, borders, and balcony spaces. Attracts pollinators and repels insects naturally. Low maintenance and drought tolerant.', 'Lavender.png', 25, '2026-02-14 19:12:35', '🌞 Full sunlight 💧 Light watering (drought tolerant) 🌱 Sandy, well-drained soil ✂️ Prune after blooming 🌬 Ensure good air circulation'),
(38, 4, 'Roses', 99.00, 'Roses are classic flowering plants known for their beauty and fragrance. Available in various colors and varieties. Perfect for gardens, balconies, and gifting. They bloom repeatedly with proper care. Symbol of love and elegance.', 'Roses.png', 24, '2026-02-14 19:13:28', '🌞 At least 6 hours sunlight 💧 Regular deep watering 🌱 Fertile, well-drained soil ✂️ Regular pruning 🌿 Monthly organic fertilizer'),
(41, 6, 'Tomatoes', 149.00, 'Tomatoes are one of the most popular kitchen garden plants. They produce juicy, flavorful fruits rich in vitamins. Perfect for pots, grow bags, and garden beds. High-yielding and suitable for beginners. Ideal for salads, cooking, and sauces.', '1771097528_Tomatoes.png', 25, '2026-02-14 19:30:42', ' 🌞 Full sunlight (6–8 hours daily) 💧 Regular deep watering 🌱 Fertile, well-drained soil 📏 Provide staking or cage support 🌿 Apply organic fertilizer every 2–3 weeks'),
(42, 6, 'Bell Peppers', 149.00, 'Bell peppers produce colorful and nutritious fruits. Available in red, yellow, and green varieties. Perfect for container gardening. Adds vibrant color to your home garden. Easy to maintain with proper care.', 'Bell Pappers.png', 25, '2026-02-14 19:34:23', '🌞 Full sunlight 💧 Moderate and consistent watering 🌱 Nutrient-rich, well-drained soil 🌿 Add compost regularly 📏 Provide light support if needed'),
(43, 6, 'Cucumbers', 145.00, 'Cucumbers are fast-growing and high-yielding plants. They produce fresh, crunchy fruits perfect for salads. Ideal for terrace and balcony gardening. Vining plant that grows quickly. Great for summer cultivation.', 'Cucumbers.png', 20, '2026-02-14 19:35:17', ' 🌞 Full sunlight 💧 Frequent watering 🌱 Fertile, well-drained soil 📏 Provide vertical trellis support 🌿 Harvest regularly for better yield'),
(44, 6, 'Lettuce', 149.00, 'Lettuce is a leafy green vegetable ideal for salads. Grows quickly and is perfect for small spaces. Suitable for pots and kitchen gardens. Fresh and nutritious for daily use. Easy to grow in cool seasons.', 'Lettuce.png', 26, '2026-02-14 19:36:11', '🌤 Partial to full sunlight 💧 Light but regular watering 🌱 Loose, well-drained soil ❄️ Prefers cooler temperatures ✂️ Harvest outer leaves regularly'),
(45, 6, 'Eggplant (Brinjal)', 199.00, 'Eggplant is a productive vegetable plant. Produces glossy purple fruits rich in nutrients. Suitable for pots and garden beds. Long harvesting season with proper care. Popular in many cuisines.', 'Eggplant.png', 20, '2026-02-14 19:37:01', '🌞 Full sunlight 💧 Moderate watering 🌱 Fertile, well-drained soil 🌿 Monthly organic fertilizer 📏 Provide support for heavy fruits'),
(46, 6, 'Kale', 259.00, 'Kale is a highly nutritious leafy green. Rich in vitamins and antioxidants. Perfect for healthy diets and salads. Grows well in containers and gardens. Cold-tolerant and easy to maintain.', 'Kale.png', 20, '2026-02-14 19:38:08', '🌤 Partial to full sunlight 💧 Regular watering 🌱 Well-drained, compost-rich soil ❄️ Prefers cooler weather ✂️ Harvest leaves from outside first'),
(47, 6, 'Carrots', 145.00, 'Carrots are root vegetables rich in vitamins. They grow underground in loose soil. Perfect for kitchen gardening. Healthy and easy to grow in deep pots. Best suited for cooler seasons.', 'Carrots.png', 25, '2026-02-14 19:39:03', '🌞 Full sunlight 💧 Keep soil evenly moist 🌱 Loose, sandy, well-drained soil 📏 Use deep containers for root growth 🚫 Avoid compact or hard soil'),
(48, 6, 'Green Beans', 299.00, 'Green beans are fast-growing climbing plants. Produce fresh, tender pods regularly. Suitable for containers and garden beds. High-yielding and beginner-friendly. Perfect for daily cooking.', 'Green Beans.png', 20, '2026-02-14 19:41:15', ' 🌞 Full sunlight 💧 Regular watering 🌱 Fertile, well-drained soil 📏 Provide trellis or vertical support 🌿 Harvest pods frequently for continuous production'),
(49, 7, 'Areca Palm', 199.00, 'Areca Palm is a popular indoor air-purifying plant. It adds a tropical and elegant look to any space. Known for improving indoor air quality. Perfect for living rooms and offices. Low maintenance and beginner-friendly plant.', 'Areca Plam.png', 20, '2026-02-14 19:42:41', ' 🌤 Bright indirect sunlight 💧 Water when top soil feels dry 🌱 Well-drained potting mix 🌬 Good air circulation 🚫 Avoid direct harsh sunlight'),
(50, 7, 'Chinese Evergreen', 145.00, 'Chinese Evergreen is a hardy indoor plant with attractive variegated leaves. Excellent for improving indoor air quality. Thrives in low-light conditions. Perfect for homes and offices. Easy to care for and long-lasting.', 'Ghingee Evergreen.png', 25, '2026-02-14 19:43:52', '🌤 Low to medium indirect light 💧 Moderate watering 🌱 Well-drained soil 🌡 Prefers warm indoor temperature 🚫 Avoid overwatering'),
(51, 7, 'ZZ Plant', 199.00, 'ZZ Plant is a stylish and low-maintenance indoor plant. Known for tolerating low light and drought. Glossy green leaves enhance modern interiors. Excellent air-purifying qualities. Perfect for busy plant lovers.', 'ZZ Plant.png', 25, '2026-02-14 19:44:44', '🌤 Low to bright indirect light 💧 Water sparingly 🌱 Well-drained soil 🌡 Thrives in room temperature 🚫 Avoid waterlogging'),
(52, 7, 'Lady Palm', 199.00, 'Lady Palm is an elegant indoor palm plant. Helps purify indoor air naturally. Adds a sophisticated look to interiors. Perfect for corners and office spaces. Slow-growing and easy to maintain.', 'Lady Plam.png', 14, '2026-02-14 19:45:29', '🌤 Bright indirect light 💧 Keep soil slightly moist 🌱 Rich, well-drained soil 🌬 Ensure good air flow 🚫 Avoid direct sunlight'),
(53, 7, 'Philodendron', 249.00, 'Philodendron is a beautiful leafy indoor plant. Known for its large decorative leaves. Improves indoor air quality. Suitable for homes and workspaces. Easy-care and adaptable plant.', 'Philodendron.png', 20, '2026-02-14 19:46:38', '🌤 Bright indirect sunlight 💧 Moderate watering 🌱 Loose, well-drained soil 🌡 Prefers warm environment ✂️ Remove yellow leaves regularly'),
(54, 7, 'English Ivy', 149.00, 'English Ivy is a fast-growing trailing plant. Effective in reducing indoor pollutants. Perfect for hanging baskets and shelves. Adds greenery to indoor spaces. Compact and decorative plant.', 'English Ivy.png', 14, '2026-02-14 19:47:35', '🌤 Bright indirect light 💧 Keep soil moist 🌱 Well-drained potting mix 🌬 Good ventilation ✂️ Trim regularly to control growth'),
(55, 7, 'Parlor Palm', 149.00, 'Parlor Palm is a compact indoor palm plant. Ideal for small apartments and offices. Improves indoor air quality. Low maintenance and slow-growing. Adds a fresh tropical touch indoors.', 'Parlor Plam.png', 20, '2026-02-14 19:48:34', ' 🌤 Medium indirect light 💧 Water moderately 🌱 Well-drained soil 🌡 Prefers warm indoor temperature 🚫 Avoid overwatering'),
(56, 7, 'Calathea', 149.00, 'Calathea is known for its striking patterned leaves. Perfect decorative indoor plant. Improves indoor air quality. Adds vibrant foliage to interiors. Requires slightly attentive care.', 'Calathea.png', 20, '2026-02-14 19:49:31', '🌤 Bright indirect light 💧 Keep soil consistently moist 🌱 Well-drained, organic-rich soil 🌫 Prefers high humidity 🚫 Avoid direct sunlight'),
(57, 7, 'Dieffenbachia', 359.00, 'Dieffenbachia is a popular decorative indoor plant. Known for its broad variegated leaves. Helps purify indoor air. Perfect for living rooms and offices. Easy to grow with basic care.', 'Dieffenbachia.png', 25, '2026-02-14 19:50:17', '🌤 Bright indirect sunlight 💧 Moderate watering 🌱 Well-drained potting soil 🌡 Keep in warm indoor temperature 🚫 Avoid cold drafts'),
(58, 5, 'Pumpkin Seeds', 99.00, 'Premium quality pumpkin seeds ideal for home gardens and terrace farming. These seeds grow into strong vines that produce large, nutritious pumpkins. Pumpkins are rich in vitamins and perfect for cooking and decoration. The plant spreads well and gives high yield with proper care. Suitable for beginners and experienced gardeners.', 'Pumpkin Seeds.png', 14, '2026-02-15 07:53:03', 'Growing Season: Summer / Warm season\r\nGermination Time: 7–10 days\r\n🌞 Full sunlight (6–8 hours daily)  💧 Water regularly but avoid waterlogging  🌱 Use well-drained, compost-rich soil  📏 Maintain 2–3 feet spacing between plants'),
(59, 5, 'Sunflower Seeds', 145.00, 'High-quality sunflower seeds that produce bright and attractive flowers. Perfect for garden borders, balconies, and open spaces. Sunflowers attract bees and butterflies to your garden. They grow tall and add a cheerful look to any landscape. Easy to grow and low maintenance.', 'Sunflower Seeds.png', 27, '2026-02-15 07:57:42', 'Growing Season: Spring / Summer Germination Time: 7–14 days🌞 Requires full sunlight  💧 Moderate watering  🌿 Use loose, fertile soil  📏 Provide support for tall varieties'),
(60, 5, 'Tomato Seeds', 89.00, 'Premium tomato seeds that produce juicy and flavorful fruits. Suitable for pots, grow bags, and garden beds. Tomatoes are rich in vitamins and widely used in cooking. Plants grow quickly and produce multiple harvests. Ideal for kitchen gardening.', 'Tomato Seeds.png', 20, '2026-02-15 07:59:03', 'Growing Season: Winter / Spring Germination Time: 5–10 days🌞 Full sunlight  💧 Regular watering (do not wet leaves frequently)  🌱 Rich organic soil  📏 Use support/stakes for better growth'),
(61, 5, 'Sesame Seeds', 459.00, 'Sesame seeds are nutritious and easy-to-grow seeds ideal for home gardens and terrace farming. They grow into healthy plants that produce small pods filled with oil-rich seeds. Sesame is widely used in cooking, baking, and traditional dishes. The plant thrives in warm climates and requires minimal maintenance. Perfect for beginners looking to grow edible crops at home. Sesame seeds are rich in calcium, iron, and healthy fats. Plants grow upright with delicate flowers before seed formation. A great choice for organic kitchen gardening. Harvest when seed pods turn dry and light brown.', 'Sesame Seeds.png', 25, '2026-02-15 08:02:22', 'Growing Season: Warm season Germination Time: 7–12 days  .🌞 Full sun exposure  💧 Light but consistent watering  🌱 Well-drained sandy soil works best  🚫 Avoid overwatering'),
(62, 5, 'Pepper Seeds', 79.00, 'Pepper seeds grow into healthy plants that produce flavorful and spicy peppers. Perfect for kitchen gardens, pots, and terrace farming. Plants are compact and give multiple harvests in one season. Peppers are rich in vitamins and widely used in cooking. Easy to grow and suitable for beginners. Thrives well in warm climates with proper sunlight. Produces colorful fruits ranging from green to red. Adds freshness and spice to home-grown meals. Ideal choice for organic gardening lovers.', 'Papper Seeds.png', 25, '2026-02-15 08:04:02', 'Growing Season: Warm season Germination Time: 7–14 days. 🌞 Full sun required  💧 Moderate watering  🌱 Well-drained fertile soil  🌿 Apply organic fertilizer every 15 days'),
(63, 5, 'Flower Seeds (Mixed)', 359.00, 'Flower seeds grow into beautiful, colorful blooms that brighten any garden or balcony. Perfect for pots, garden beds, and terrace gardening. These seeds produce a mix of vibrant flowers throughout the season. Easy to grow and suitable for beginners. Flowers attract butterflies and bees, adding life to your garden. Ideal for home décor, landscaping, and gifting. Provides continuous blooming with proper care. A wonderful choice to create a cheerful outdoor space.', 'Flower Seeds.png', 25, '2026-02-15 08:05:35', 'Growing Season: Depends on variety Germination Time: 5–15 days.  🌞 Most varieties prefer full sun  💧 Light watering daily  🌱 Use garden soil mixed with compost  ✂️ Remove dried flowers for continuous blooming'),
(64, 5, 'Basil Seeds', 299.00, 'Fresh basil seeds perfect for culinary and medicinal use. Easy to grow in small pots or garden beds. Produces aromatic green leaves used in many dishes. Grows well in warm climates throughout the year. Low maintenance and fast-growing herb.', 'Basil Seeds.png', 25, '2026-02-15 08:07:05', 'Growing Season: Year-round (in warm climate) Germination Time: 5–10 days🌞 4–6 hours sunlight  💧 Keep soil moist  🌱 Well-drained soil  ✂️ Pinch leaves regularly for bushy growth.  '),
(65, 5, 'Cucumber Seeds', 0.00, 'High-yield cucumber seeds that grow into healthy vines. Produces fresh, crunchy cucumbers ideal for salads. Suitable for terrace gardens and open fields. Fast-growing plant with excellent productivity. Easy to manage with basic care.', 'Cucumber Seeds.png', 25, '2026-02-15 08:08:13', 'Growing Season: Summer Germination Time: 5–10 days.   '),
(66, 8, 'Tulsi (Holy Basil)', 29.00, 'Tulsi is a sacred Indian herb known for its powerful medicinal value. It has small green leaves with a pleasant aroma. Commonly grown in homes for health and spiritual benefits. Helps boost immunity and respiratory health. Easy to grow in pots or garden beds. A fast-growing, bushy plant with regular harvesting.', 'Tulsi.png', 27, '2026-02-15 09:51:44', ' 🌞 Full sunlight 💧 Moderate watering 🌱 Fertile, well-drained soil ✂️ Pinch tips for bushy growth.  Usage: Used in herbal tea, immunity drinks, and Ayurvedic remedies.'),
(67, 8, 'Curry Leaves', 29.00, 'Curry leaf plant is an essential kitchen herb in Indian cooking. Its glossy leaves add strong aroma and flavor to dishes. A perennial shrub suitable for containers. Also valued for digestive and hair health. Slow starter but long-lasting plant', 'Curry Leaves.png', 25, '2026-02-15 09:52:45', '🌞 Bright sunlight 💧 Water when top soil dries 🌱 Loose, well-drained soil ✂️ Regular pruning encourages growth.  Usage: Used fresh in curries, sambhar, chutneys, and hair oil.'),
(68, 8, 'Giloy', 89.00, 'Giloy is a powerful climbing medicinal plant. Known as “Amrita” for its immunity-boosting properties. Heart-shaped leaves with fast vine growth. Very hardy and low maintenance. Perfect for terrace gardens with support.', 'Giloy.png', 25, '2026-02-15 09:53:45', '🌞 Partial to full sun 💧 Moderate watering 🌱 Normal garden soil 📏 Provide vertical support.  Usage: Used in immunity juice, kadha, and herbal medicines.'),
(69, 8, 'Rosemary', 149.00, 'Rosemary is a fragrant foreign herb with needle-like leaves. Adds flavor to roasted vegetables and breads. Compact plant ideal for pots. Also improves memory and circulation. Drought tolerant once established.', 'Rosemary.png', 25, '2026-02-15 09:54:43', '🌞 Full sunlight 💧 Light watering 🌱 Sandy, well-drained soil ✂️ Trim regularly.  Usage: Used in cooking, herbal tea, and aromatherapy.'),
(70, 8, 'Mint', 99.00, 'Mint is a fast-growing aromatic herb. Produces refreshing green leaves. Perfect for balconies and small gardens. Spreads quickly and regrows after cutting. Very beginner-friendly.', 'Mint.png', 25, '2026-02-15 09:55:55', ' 🌤 Partial sunlight 💧 Frequent watering 🌱 Moist, fertile soil ✂️ Harvest often.  Usage: Used in chutneys, drinks, salads, and digestion remedies.'),
(71, 8, 'Lemongrass', 129.00, 'Lemongrass is a tall herb with citrus fragrance. Great for terrace gardens and large pots. Repels insects naturally. Grows in thick clumps. Very aromatic and refreshing.', 'Lemongrass.png', 25, '2026-02-15 09:57:15', '🌞 Full sunlight 💧 Regular watering 🌱 Well-drained fertile soil ✂️ Cut outer stalks.  Usage: Used in tea, soups, oils, and stress relief drinks.'),
(72, 8, 'Oregano', 149.00, 'Oregano is a popular foreign herb for Italian dishes. Small soft leaves with strong flavor. Compact growth for indoor or outdoor pots. Low maintenance and fast harvesting. Perfect for kitchen gardens.', 'Oregano.png', 25, '2026-02-15 09:58:05', '🌞 Bright sunlight 💧 Light watering 🌱 Loose, well-drained soil ✂️ Pinch tips.  Usage: Used in pizza, pasta, salads, and herbal teas.'),
(73, 8, 'Brahmi (Bacopa)', 359.00, 'Brahmi is a creeping medicinal herb. Known for improving memory and focus. Small rounded leaves with soft stems. Prefers moist environment. Great for shallow pots.', 'Brahmi.png', 25, '2026-02-15 09:58:58', '🌤 Partial sunlight 💧 Keep soil moist 🌱 Organic rich soil ✂️ Trim regularly.  Usage: Used in brain tonics, herbal tea, and Ayurveda.'),
(74, 8, 'Ashwagandha', 699.00, 'Ashwagandha is a powerful Ayurvedic plant. Produces small berries and broad leaves. Helps reduce stress and increase strength. Hardy plant for warm climates. Moderate growth habit.', 'Ashwagandha.png', 25, '2026-02-15 09:59:55', '🌞 Full sunlight 💧 Moderate watering 🌱 Well-drained soil ✂️ Minimal pruning.  Usage: Used in powders, capsules, and immunity boosters.');

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
-- Table structure for table `temp1`
--

CREATE TABLE `temp1` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp1`
--

INSERT INTO `temp1` (`id`, `name`, `price`, `image`, `description`) VALUES
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
(41, 'disha', 'disha@gmail.com', '$2y$10$nkel/gxwCm7UsyhK9q38EuatCVRNGbyzNTOc9MIDRcEp.vNxMmvjq', '6782034667', 2, NULL, NULL, 'ddddddddd', '2026-01-13 18:15:21'),
(43, 'userthree', 'user5@gmail.com', '$2y$10$g.fgPIZhZ3PwOhMs/mggKeg8K7U3OL7z6rra2LPO992bNr9ikZPse', '1234567889', 2, NULL, NULL, 'guj', '2026-01-14 07:11:41'),
(44, 'krishna', 'sidhi1@gmail.com', '$2y$10$bZ8HSU8PfBPVN0Qw9YlzouacxdfT9.Z2UAEFwkP86xqJcnpM1KK2O', '1234567890', 2, NULL, NULL, 'guj', '2026-01-14 09:53:11'),
(45, 'navi', 'navi@gmail.com', '$2y$10$9OxV6el/yBffJtLRpctrjuyhEmB9/gqQ.GRY9LXlBg5OeZ5rmXqdC', '1478523698', 2, NULL, NULL, 'guj', '2026-01-14 16:59:51'),
(48, 'Ananya ', 'anu@gmail.com', '$2y$10$uJItg5B2TriIvADlqS06t.Db9Mf3v.n3KM7cuzQ3osaICIYiLJn2y', '1122334455', 2, NULL, NULL, 'mehsana', '2026-01-27 18:34:29'),
(50, 'krishnaadmin', 'krishna@gmail.com', '$2y$10$q4.c6g.H79hyV0BsqO8EHeefayO1Thjm6IyCjOonvHCMhcTNvqqRi', '7846532956', 1, NULL, NULL, 'G95, 1136, Shivam Apartment, near Nava Vadaj metro station, nava vadaj', '2026-01-29 06:25:31'),
(51, 'yash gayen', 'yash@gmail.com', '$2y$10$61T0v7JLy2l3Li8DfcpKweJofGjnmLUv5A4mXSjjWjghy1pLpDPh6', '7418452148', 2, NULL, NULL, 'vadodara', '2026-01-30 12:02:16'),
(52, 'Anu gayen', 'ananya@gmail.com', '$2y$10$GCW84Zl13Wh/3CiAh6jofemddTI4OZS1L7Lu07a72MEcxaVuR9/ka', '7484542414', 2, NULL, NULL, 'vadaj,ahmedabad', '2026-01-30 12:09:26'),
(53, 'sanjit', 'sanjit@gmail.com', '$2y$10$fDcuuaVl6K5QZivvi5Qoyupq6oCtM16EbdiHrrjVp3k.DCTS3Vmx.', '4174541247', 2, NULL, NULL, 'bhuj', '2026-01-30 14:02:07'),
(54, 'diya', 'diya@gmail.com', '$2y$10$vBadTNklb7fnwGz1OBX0dugp/OVmj89DRZyA1QuG3d0JsOyaoy5qq', '7415789544', 2, NULL, NULL, 'bhuj', '2026-01-30 14:17:16'),
(55, 'rachana', 'rachanashah@svgu.ac.in', '$2y$10$VD6/vQDBIInXOsMAXy7v1ek6dnWI2fwUVCx4VCz1eEwjSWIQ9wXj6', '7417481254', 2, NULL, NULL, 'ahmedabad', '2026-01-31 02:37:21'),
(56, 'Rahul Goyal', 'rahul@gmail.com', '$2y$10$TMFbSvmsEwb8YEU1if0pfuazSJ.dEdv3bWjGPQcXd2ztETYWqUqfG', '7541478491', 2, NULL, NULL, 'jaipur', '2026-04-06 15:11:50'),
(57, 'Harsh Pandya', 'Harsh@gmail.com', '$2y$10$5NFGWKHua80XOeJ94d4LHuyqknG0r42Rlhel7PMewoDxOSIbbQIWi', '8454145120', 2, NULL, NULL, 'dandi, Gujrat', '2026-04-06 15:14:22'),
(59, 'Dev Nayak', 'dev@gmail.com', '$2y$10$58y9.YE0YusyP0RKpvqYBOHLyCf9UQNxZgtWDhxVHeBX9R5/0dd0i', '7484574514', 2, NULL, NULL, 'narol', '2026-04-06 15:43:17'),
(61, 'rudra', 'rudra@gmail.com', '$2y$10$Rue1NWX1xq9VAn2m2PpqkupBUWVEkJsPaFUEf.K3S5Cl/EkizAOjW', '7484596214', 2, NULL, NULL, 'nae', '2026-04-07 02:46:25'),
(62, 'akr', 'akr@gmail.com', '$2y$10$Cc2170SbtZeJXuAbRd0/AOdobXS2PwGOyAea1/J5GDm2EZ2WuIVRu', '8454214547', 2, NULL, NULL, 'narol', '2026-04-07 02:47:21'),
(63, 'yami', 'yami@gmail.com', '$2y$10$rCgdm3DQx4Ks7ma72kcUWeMazbwwYa6SPhV/hlKbwwwm6xqyfQ8Ge', '8475145145', 2, NULL, NULL, 'narol', '2026-04-07 02:50:54'),
(64, 'krish', 'krish@gmail.com', '$2y$10$wSSGQQoY0l2kRr7kwDbgseZj0W9hBxGlk8ACqVvVF.DNWXidQF1KW', '9494587451', 2, NULL, NULL, 'narol', '2026-04-07 02:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `w_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`w_id`, `user_id`, `product_id`) VALUES
(10, 52, 8);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deal_code` (`deal_code`);

--
-- Indexes for table `deal_products`
--
ALTER TABLE `deal_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deal_id` (`deal_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`R__id`);

--
-- Indexes for table `temp1`
--
ALTER TABLE `temp1`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deal_products`
--
ALTER TABLE `deal_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `R__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp1`
--
ALTER TABLE `temp1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userr`
--
ALTER TABLE `userr`
  MODIFY `U_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deal_products`
--
ALTER TABLE `deal_products`
  ADD CONSTRAINT `deal_products_ibfk_1` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deal_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userr`
--
ALTER TABLE `userr`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`R__id`) REFERENCES `roles` (`R__id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
