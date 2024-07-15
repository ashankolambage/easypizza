-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2022 at 02:03 PM
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
-- Database: `easypizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id_admin`, `full_name`, `username`, `password`) VALUES
(31, 'admin', 'admin', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `full_name`, `address`, `contact_number`, `email`, `username`, `password`, `active`) VALUES
(4, 'Jocelyn Solis', 'njkljklljkunt do', '777', 'daberubafy@mailinator.com', 'user', '25d55ad283aa400af464c76d713c07ad', 'Yes'),
(5, 'Micah Cohen', 'Ut ut dolor veniam ', '28', 'tiry@mailinator.com', 'mm', 'b3cd915d758008bd19d0f2428fbb354a', 'Yes'),
(6, 'Paloma May', 'Occaecat quia aliqui', '726', 'hamylytecy@mailinator.com', 'jumexijad', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Yes'),
(7, 'Rhonda Hood', 'Eu non rerum cupidat', '385', 'typi@mailinator.com', 'zolalo', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Yes'),
(8, 'Hyacinth Kirby', 'Fuga Ut excepteur e', '911', 'hicen@mailinator.com', 'gyfurehiw', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Yes'),
(9, 'sachin karunarathna', 'badulla', '0751112244', 'sachinchinthaka86@gmail.com', 'sachin', '827ccb0eea8a706c4c34a16891f84e7b', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order` int(10) UNSIGNED NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_pizza` int(11) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_bill` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order`, `id_customer`, `id_pizza`, `item_price`, `item_qty`, `order_date`, `order_status`, `delivery_address`, `payment_method`, `total_bill`) VALUES
(21, 4, 44, '341.00', 2, '2022-09-01 17:26:49', 'Ordered', 'njkljklljkunt do', 'Cash on Delivery', '682.00');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_category`
--

CREATE TABLE `pizza_category` (
  `id_category` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza_category`
--

INSERT INTO `pizza_category` (`id_category`, `title`, `image_name`, `featured`, `active`) VALUES
(20, 'Chicken', 'Pizza_Category_968.jpg', 'Yes', 'Yes'),
(21, 'Cheese', 'Pizza_Category_7512.jpg', 'Yes', 'Yes'),
(22, 'BBQ', 'Pizza_Category_340.jpg', 'No', 'Yes'),
(23, 'Sosejas', 'Pizza_Category_4527.jpg', 'No', 'Yes'),
(24, 'Peparoni', 'Pizza_Category_9612.jpg', 'No', 'Yes'),
(25, 'Vegie', 'Pizza_Category_3004.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_item`
--

CREATE TABLE `pizza_item` (
  `id_pizza` int(10) UNSIGNED NOT NULL,
  `id_category` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza_item`
--

INSERT INTO `pizza_item` (`id_pizza`, `id_category`, `title`, `description`, `price`, `image_name`, `featured`, `active`) VALUES
(44, 21, 'Cheese Merged Pizza', 'ICheese, Onion , tomatto with delirious Recipe', '341.00', 'Pizza_Item_2692.jpg', 'Yes', 'Yes'),
(45, 20, 'Chiken tomatto', 'pizza 012, tomatto', '575.00', 'Pizza_Item_5204.jpg', 'Yes', 'Yes'),
(46, 23, 'Cheese', 'provide cheese', '135.00', 'Pizza_Item_3243.jpg', 'Yes', 'Yes'),
(47, 22, 'Pork Pizza', 'delisious Pizza', '314.00', 'Pizza_Item_1131.jpg', 'No', 'No'),
(48, 21, 'Mashroom pizza', 'vegitable', '295.00', 'Pizza_Item_7095.jpg', 'No', 'No'),
(49, 22, 'BBQ Chiken', 'BBQ ', '589.00', 'Pizza_Item_2926.jpg', 'No', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `pizza_category`
--
ALTER TABLE `pizza_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `pizza_item`
--
ALTER TABLE `pizza_item`
  ADD PRIMARY KEY (`id_pizza`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pizza_category`
--
ALTER TABLE `pizza_category`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pizza_item`
--
ALTER TABLE `pizza_item`
  MODIFY `id_pizza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
