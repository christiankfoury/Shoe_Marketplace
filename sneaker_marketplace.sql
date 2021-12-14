-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 02:22 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sneaker_marketplace`
--
CREATE DATABASE IF NOT EXISTS `sneaker_marketplace` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sneaker_marketplace`;

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

DROP TABLE IF EXISTS `listing`;
CREATE TABLE `listing` (
  `listing_id` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `seller_username` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `color` varchar(150) NOT NULL,
  `available` enum('yes','no') NOT NULL DEFAULT 'yes',
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `message` varchar(150) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `seller_username` varchar(50) NOT NULL,
  `buyer_username` varchar(50) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `postal_code` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `province` text DEFAULT NULL,
  `country` text NOT NULL DEFAULT 'Canada',
  `timestamp` timestamp NULL DEFAULT NULL,
  `total_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shoe`
--

DROP TABLE IF EXISTS `shoe`;
CREATE TABLE `shoe` (
  `shoe_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `previously_sold_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shoe`
--

INSERT INTO `shoe` (`shoe_id`, `brand`, `name`, `previously_sold_price`) VALUES
(1, 'Nike', 'Air Force 1', NULL),
(2, 'Jordan', 'Retro 1', NULL),
(3, 'Jordan', 'Retro 11', NULL),
(4, 'Jordan', 'Retro 12', NULL),
(5, 'Jordan', 'Retro 13', NULL),
(6, 'Nike', 'Air Max 90', NULL),
(7, 'Nike', 'Air Max 95', NULL),
(8, 'Nike', 'Air Max 97', NULL),
(9, 'Nike', 'Air Force 1', NULL),
(10, 'Nike', 'Dunks', NULL),
(11, 'Adidas', 'NMD', NULL),
(12, 'Adidas', 'Ultraboost', NULL),
(13, 'Adidas', 'Yeezy 350', NULL),
(14, 'Adidas', 'Yeezy Foam', NULL),
(15, 'Vans', 'Sk8 Hi', NULL),
(16, 'Vans', 'Old Skool', NULL),
(17, 'Vans', 'Slip On', NULL),
(18, 'Vans', 'Slide On', NULL),
(19, 'New Balance', '550', NULL),
(20, 'New Balance', '993', NULL),
(21, 'New Balance', '990', NULL),
(22, 'New Balance', '574', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `favorite_color` varchar(50) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `shoe_id` int(11) NOT NULL,
  `color` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`listing_id`),
  ADD KEY `to_shoe_id_fk` (`shoe_id`),
  ADD KEY `to_seller_username_fk` (`seller_username`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `to_sender_fk` (`sender`),
  ADD KEY `to_receiver_fk` (`receiver`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `to_seller_username_fk_2` (`seller_username`),
  ADD KEY `to_buyer_username_fk` (`buyer_username`),
  ADD KEY `to_listing_id_fk` (`listing_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `to_username_fk` (`username`),
  ADD KEY `to_shoe_id_fk_2` (`shoe_id`);

--
-- Indexes for table `shoe`
--
ALTER TABLE `shoe`
  ADD PRIMARY KEY (`shoe_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `to_shoe_id_fk_3` (`shoe_id`),
  ADD KEY `to_username_fk_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoe`
--
ALTER TABLE `shoe`
  MODIFY `shoe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `to_seller_username_fk` FOREIGN KEY (`seller_username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `to_shoe_id_fk` FOREIGN KEY (`shoe_id`) REFERENCES `shoe` (`shoe_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `to_receiver_fk` FOREIGN KEY (`receiver`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `to_sender_fk` FOREIGN KEY (`sender`) REFERENCES `user` (`username`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `to_buyer_username_fk` FOREIGN KEY (`buyer_username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `to_listing_id_fk` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`listing_id`),
  ADD CONSTRAINT `to_seller_username_fk_2` FOREIGN KEY (`seller_username`) REFERENCES `user` (`username`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `to_shoe_id_fk_2` FOREIGN KEY (`shoe_id`) REFERENCES `shoe` (`shoe_id`),
  ADD CONSTRAINT `to_username_fk` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `to_shoe_id_fk_3` FOREIGN KEY (`shoe_id`) REFERENCES `shoe` (`shoe_id`),
  ADD CONSTRAINT `to_username_fk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
