-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 07:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) NOT NULL,
  `guest` varchar(80) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `persons` tinyint(4) NOT NULL,
  `message` text DEFAULT NULL,
  `book_status` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'coco@gmail.com', '2023-12-01 10:16:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(40) DEFAULT NULL,
  `info` varchar(250) DEFAULT NULL,
  `item_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `price`, `img`, `info`, `item_status`) VALUES
(1, 'American Pizza', 260, 'american_pizza.jpg', 'Turn up the heat with juicy Beef, sliced Onions, Tomatoes and spicy Green Chilies ', 1),
(2, 'Veg Pizza', 135, 'veg_pizza.jpg', 'Mushrooms, Green peppers, Fresh Tomatoes, Onions, Black Olives Loaded on a tomato', 0),
(3, 'Chicken Pizza', 220, 'chicken_pizza.jpg', 'The ultimate mix of Chicken together with Mushrooms, Red Onions, Green Peppers,', 1),
(4, 'Pepperroni Pizza', 185, 'pepperroni_pizza.jpg', 'One of our all time specialties. A meaty feast of Pepperoni, Mushroom , Black Olives, ', 1),
(5, 'Veg Burger', 130, 'veg_burger.jpg', 'Gourmet Vegan Mushroom Burger,  and tofu, nuts, grains, seeds or fungi ', 0),
(6, 'Chicken Burger', 145, 'chicken_burger.jpg', 'American Yellow Cheese, savory flame-grilled Chicken Burger Patty,', 1),
(7, 'Power Burger', 175, 'power_burger.jpg', 'Our MUSHROOM XXL Burger features Swiss cheese on two flame-grilled beef patties, ', 1),
(8, 'Sandwich Burger', 145, 'sandwich_burger.jpg', 'Our famous combination of Beef Pepperoni, Fresh Tomatoes, Mayonnaise', 1),
(9, 'Gulab Jamun', 80, 'gulab_jamun.jpg', 'Buttery soft freshly made bread sticks sprinkled with a cinnamon-sugar blend', 1),
(10, 'Chocolate Mousse', 100, 'chocolate_mousse.jpg', 'Cool and creamy, our made-to-order Caramel Sundae is prepared with our velvety', 1),
(11, 'Nougat Mousse', 110, 'nougat_mouss.jpg', 'Caramel Sundae is prepared with our velvety Vanilla Soft Serve, delicious caramel swirl', 1),
(12, 'Belgium Waffle', 45, 'belgium_waffle.jpg', 'Buttery soft freshly made bread sticks sprinkled with a cinnamon-sugar blend', 1),
(13, 'Ice Tea', 35, 'ice_tea.jpg', ' Try our Classic Mojito with the mint and lemon flavour, large and xlarage size', 0),
(14, 'Salad', 45, 'salad_bar.jpg', 'Our King Chicken Salad is a wonderful medley of romaine lettuce, juicy tomatoes', 1),
(15, 'Fire Wings', 110, 'firewings.jpg', 'Served with our special BBQ sauce (Spicy Hot). 1 free slider per customer.', 1),
(16, 'Cappuccino', 45, 'cappuccino.jpg', 'Medio Size, cream instead of milk, using non-dairy milk, and cinnamon flavored ', 0),
(17, 'Shrimp Sandwich', 50, 'bahig_shrimp.jpg', 'Tender shrimp drizzled in a creamy, spicy sauce and topped with crunchy cabbage.', 1),
(18, 'Mandarin Soda', 40, 'ss_mandarin.jpg', 'Mandarin-flavored The amount of sourness and sweetness is your way to an instant refresh.', 1),
(19, 'Apple Juice', 40, 'ss_apple.jpg', 'Apple Juice is rich in vitamins and minerals, It\'s natural, preservative-free juice.', 1),
(20, 'Pineapple Soda', 40, 'ss_pineapple.jpg', 'Pineapple Flavored, The flavour takes you on an adventure of tropical vibrance.', 1),
(21, 'Soda Lemon', 35, 'ss_lemon.jpg', 'Lemon flavored drink, Try a lemon spatula to know the true taste of this mix. ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Farid Shawky', 'admin@coco.com', '$2y$10$fK2nw5tJeQi0R.B1c4d/XOlhIjizmnl5WK02rgADH80ac9AqIV1Ca', 'admin', '2023-11-04 10:35:30', NULL),
(2, 'Zeinat Sedki', 'sales@coco.com', '$2y$10$.WKRgpAnsDk/eCEHC.thFeU042lbljReu6brjhwM5IK5EiCeV3RMi', 'sales', '2023-11-04 10:36:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
