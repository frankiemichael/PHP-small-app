-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2021 at 12:31 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tremenheerenursery`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `privileges` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `privileges`) VALUES
(1, 'Daniel Michael', '$2y$10$VHiBmQ.x8.FX.US4GYSj1uX2kIBq9gP3WX0civmPDQUiSFLEwgLza', 'dan@surrealsucculents.co.uk', 1),
(2, 'Mark Lea', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'mark@surrealsucculents.co.uk', 1),
(3, 'Lisa Blake', '$2y$10$FvLJUeqr0wwqCm.HmsOSNOcWUBqdzx5Uzftz/tW4X9lj2GkH.goWO', 'lisa.blake@surrealsucculents.co.uk', 1),
(4, 'Louise Twigger', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'louise.twigger@surrealsucculents.co.uk', 0),
(5, 'Jack Michael', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'jack.michael@surrealsucculents.co.uk', 0),
(6, 'Angkhan Phumiwet', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'angkhan.phumiwet@surrealsucculents.co.uk', 0),
(7, 'Jack Drewitt', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'jack.drewitt@surrealsucculents.co.uk', 0),
(8, 'Frankie Michael', '$2y$10$3OJDmv8wit3s/eTaKpuMaO9W9x9LdE.Ys9sYoGWxICK0nQ5qDc70e', 'frankie.michael@surrealsucculents.co.uk', 0),
(9, 'Admin', '$2y$10$mfIzps89lRiuXg.N7aHbOe25Uur7zoMWZItG.Gry6oKQVZxkQ0An.', 'admin@surrealsucculents.co.uk', 1),
(10, 'All', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'all@surrealsucculents.co.uk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_parentid` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`cat_id`, `cat_parentid`, `cat_name`, `cat_image`) VALUES
(1, 0, 'Agapanthus', '../images/agapanthus.jpg'),
(2, 0, 'Pots and Extras', ''),
(3, 2, 'Compost', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orderdetails`
--

CREATE TABLE `shop_orderdetails` (
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_orderdetails`
--

INSERT INTO `shop_orderdetails` (`orderid`, `productid`, `productquantity`) VALUES
(22, 1, 1),
(1, 1, 1),
(24, 1, 1),
(25, 1, 1),
(26, 1, 1),
(27, 1, 1),
(28, 1, 1),
(29, 1, 1),
(30, 1, 1),
(31, 1, 1),
(32, 1, 1),
(33, 1, 1),
(34, 4, 1),
(35, 4, 1),
(36, 4, 1),
(37, 4, 1),
(38, 4, 1),
(39, 1, 1),
(39, 3, 1),
(40, 1, 1),
(41, 1, 1),
(42, 1, 1),
(43, 1, 1),
(44, 2, 1),
(45, 4, 1),
(46, 4, 1),
(47, 4, 1),
(48, 4, 1),
(49, 1, 1),
(49, 3, 1),
(49, 4, 1),
(50, 1, 1),
(50, 3, 1),
(50, 4, 1),
(50, 3, 1),
(50, 1, 1),
(50, 4, 1),
(51, 1, 1),
(51, 3, 1),
(51, 4, 1),
(52, 1, 2),
(52, 2, 1),
(53, 2, 1),
(53, 1, 2),
(54, 1, 2),
(54, 2, 1),
(55, 1, 4),
(55, 2, 1),
(55, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE `shop_orders` (
  `order_id` int(11) NOT NULL,
  `order_placed` datetime NOT NULL,
  `order_creator` text NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_notes` text DEFAULT NULL,
  `paymentmethod` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`order_id`, `order_placed`, `order_creator`, `order_total`, `order_notes`, `paymentmethod`) VALUES
(1, '2021-03-23 13:48:25', '', '2.00', 'Testing orders', ''),
(2, '2021-03-23 13:49:22', 'Louise Twigger', '2.00', 'Testing orders', ''),
(3, '2021-03-23 13:56:31', 'Louise Twigger', '2.00', 'Testing orders', ''),
(4, '2021-03-23 13:57:21', 'Louise Twigger', '2.00', 'Testing orders', ''),
(5, '2021-03-23 13:58:09', 'Louise Twigger', '2.00', 'Testing orders', ''),
(6, '2021-03-23 13:59:16', 'Louise Twigger', '2.00', 'Testing orders', ''),
(7, '2021-03-23 22:21:47', '', '2.00', 'Testing orders', ''),
(8, '2021-03-23 23:01:05', '', '2.00', 'Testing orders', ''),
(9, '2021-03-23 23:03:56', 'Jack Michael', '2.00', 'Testing orders', ''),
(10, '2021-03-23 23:06:06', 'Jack Michael', '2.00', '', ''),
(11, '2021-03-23 23:07:38', 'Jack Michael', '2.00', '', ''),
(12, '2021-03-23 23:08:02', 'Jack Michael', '2.00', '', ''),
(13, '2021-03-23 23:11:10', 'Jack Michael', '2.00', '', ''),
(14, '2021-03-23 23:11:39', 'Jack Michael', '2.00', '', ''),
(15, '2021-03-23 23:12:27', 'Jack Michael', '2.00', '', ''),
(16, '2021-03-23 23:13:17', 'Jack Michael', '2.00', '', ''),
(17, '2021-03-23 23:14:04', 'Jack Michael', '2.00', '', ''),
(18, '2021-03-23 23:18:25', 'Jack Michael', '2.00', '', ''),
(19, '2021-03-23 23:19:18', 'Jack Michael', '2.00', '', ''),
(20, '2021-03-23 23:22:45', 'Jack Michael', '2.00', '', ''),
(21, '2021-03-23 23:23:04', 'Jack Michael', '2.00', '', ''),
(22, '2021-03-23 23:27:25', 'Jack Michael', '2.00', '', ''),
(23, '2021-03-23 23:31:54', 'Jack Michael', '2.00', '', ''),
(24, '2021-03-23 23:33:05', 'Jack Michael', '2.00', '', ''),
(25, '2021-03-23 23:33:21', 'Jack Michael', '2.00', '', ''),
(26, '2021-03-23 23:33:36', 'Jack Michael', '2.00', '', ''),
(27, '2021-03-23 23:35:08', 'Daniel Michael', '2.00', '', ''),
(28, '2021-03-23 23:49:43', 'Daniel Michael', '2.00', '', ''),
(29, '2021-03-23 23:53:49', 'Daniel Michael', '2.00', '', ''),
(30, '2021-03-23 23:55:19', 'Daniel Michael', '2.00', '', ''),
(31, '2021-03-23 23:58:02', 'Daniel Michael', '2.00', '', ''),
(32, '2021-03-23 23:58:27', 'Daniel Michael', '2.00', '', ''),
(33, '2021-03-23 23:58:49', 'Daniel Michael', '2.00', 'fdfd', ''),
(34, '2021-03-25 23:50:25', 'Admin', '3.00', '', ''),
(35, '2021-03-25 23:51:51', 'Admin', '3.00', '', ''),
(36, '2021-03-25 23:52:16', 'Admin', '3.00', '', ''),
(37, '2021-03-25 23:53:12', 'Admin', '3.00', '', ''),
(38, '2021-03-25 23:54:45', 'Admin', '3.00', '', ''),
(40, '2021-03-26 23:14:37', 'Admin', '2.00', '', 'Cash'),
(41, '2021-03-26 23:14:55', 'Admin', '2.00', 'hello', 'Card'),
(42, '2021-03-26 23:22:44', 'Admin', '2.00', '', 'Card'),
(43, '2021-03-26 23:23:18', 'Admin', '2.00', '', 'Card'),
(44, '2021-03-26 23:28:00', 'Admin', '15.00', '', 'Card'),
(45, '2021-03-26 23:29:44', 'Admin', '3.00', '', 'Card'),
(46, '2021-03-26 23:34:30', 'Admin', '3.00', '', 'Card'),
(47, '2021-03-26 23:39:11', 'Admin', '3.00', '', 'Card'),
(48, '2021-03-26 23:43:07', 'Admin', '3.00', '', 'Card'),
(49, '2021-03-26 23:45:07', 'Admin', '20.00', '', 'Card'),
(50, '2021-03-26 23:45:57', 'Admin', '20.00', '', 'Card'),
(51, '2021-03-26 23:48:02', 'Admin', '20.00', '', 'Card'),
(52, '2021-03-27 00:11:07', 'Admin', '19.00', '', 'Cash'),
(53, '2021-03-27 00:12:21', 'Admin', '19.00', '', 'Cash'),
(54, '2021-03-27 00:13:49', 'Admin', '19.00', '', 'Card'),
(55, '2021-03-27 00:15:18', 'Admin', '26.00', '', 'Card');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_sku` text NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `parentid`, `product_name`, `product_sku`, `product_desc`, `product_image`, `product_price`, `product_stock`, `product_sales`) VALUES
(1, 1, 'Agapanthus Margaret', '', 'Agapanthus Margaret', '', '2.00', 75, 4),
(2, 1, 'Navy Blue', '', '-', '', '15.00', 30, 1),
(3, 1, 'Peter Pan', '', '-', '', '15.00', 54, 0),
(4, 3, '1L Compost', '', '-', '', '3.00', 86, 1);

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `deadline` datetime NOT NULL,
  `task` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `staffid` int(11) NOT NULL,
  `completed` int(1) NOT NULL DEFAULT 0,
  `weekly` int(1) NOT NULL DEFAULT 0,
  `daily` int(1) NOT NULL DEFAULT 0,
  `day` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `date`, `deadline`, `task`, `priority`, `staffid`, `completed`, `weekly`, `daily`, `day`, `time`) VALUES
(119, '2021-03-26 20:48:24', '2021-03-24 00:00:00', 'Hello', 'Low', 10, 1, 1, 0, 'Thursday', NULL),
(120, '2021-03-26 20:49:19', '2021-03-24 23:48:00', 'Hello', 'Medium', 10, 0, 0, 1, NULL, '23:48'),
(121, '2021-03-26 20:49:35', '2021-03-24 00:00:00', 'Weekly Task', 'Low', 10, 0, 1, 0, 'Friday', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trereife_categories`
--

CREATE TABLE `trereife_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_parentid` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trereife_orderdetails`
--

CREATE TABLE `trereife_orderdetails` (
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trereife_orders`
--

CREATE TABLE `trereife_orders` (
  `order_id` int(11) NOT NULL,
  `order_placed` datetime NOT NULL,
  `order_creator` text NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trereife_products`
--

CREATE TABLE `trereife_products` (
  `id` int(11) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_sku` text NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_image` varchar(60) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trereife_categories`
--
ALTER TABLE `trereife_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `trereife_orders`
--
ALTER TABLE `trereife_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `trereife_products`
--
ALTER TABLE `trereife_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_orders`
--
ALTER TABLE `shop_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `shop_products`
--
ALTER TABLE `shop_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `trereife_categories`
--
ALTER TABLE `trereife_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trereife_orders`
--
ALTER TABLE `trereife_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trereife_products`
--
ALTER TABLE `trereife_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
