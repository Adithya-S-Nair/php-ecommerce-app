-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2023 at 07:28 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `total_prize` double NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `delivery_addr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `order_status` varchar(10) NOT NULL DEFAULT 'placed',
  `final_prize` double NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100067 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `payment_method`, `delivery_addr`, `order_date`, `order_status`, `final_prize`) VALUES
(100066, 109, 1019, 1, 'Cash on delivery', '', 'Thu Jan 05 2023 00:09:23 GMT+0530 (India Standard Time)', 'shipped', 149900),
(100064, 124, 1022, 1, 'Online Payment', '', 'Mon Jan 02 2023 11:37:17 GMT+0530 (India Standard Time)', 'shipped', 119999),
(100065, 120, 1020, 1, 'Cash on delivery', 'Cochin', 'Wed Jan 04 2023 23:59:36 GMT+0530 (India Standard Time)', 'shipped', 62999),
(100062, 109, 1025, 1, 'Cash on delivery', 'Paippad', 'Mon Jan 02 2023 11:30:17 GMT+0530 (India Standard Time)', 'shipped', 73899),
(100059, 109, 1024, 2, 'Cash on delivery', 'Paippad', 'Sun Jan 01 2023 01:48:31 GMT+0530 (India Standard Time)', 'shipped', 356895);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `product_prize` double NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_stock` int NOT NULL,
  `product_desc` varchar(256) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1027 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_prize`, `product_category`, `product_brand`, `product_stock`, `product_desc`) VALUES
(1019, 'Iphone 14', 149900, 'Mobile', 'Apple', 5, 'The iPhone 14 measures in at 5.78 inches tall 128 GB'),
(1020, 'Iphone 13', 62999, 'Mobile', 'Apple', 6, 'iPhone 13 boasts improved camera, faster performance.'),
(1021, 'Galaxy S22', 57998, 'Mobile', 'Samsung', 4, ' Next-generation smartphone with advanced features'),
(1022, 'Z Fold 2', 119999, 'Mobile', 'Samsung', 3, 'Foldable smartphone with enhanced screen'),
(1023, 'Pixel 7', 59999, 'Mobile', 'Google', 3, 'Premium smartphone with excellent camera'),
(1024, 'Note 12 pro', 56999, 'Mobile', 'Xiomi', 3, 'Powerful smartphone with advanced features'),
(1025, 'Watch 7', 42900, 'Watch', 'Apple', 14, 'Advanced smartwatch with new features'),
(1026, 'Galaxy Watch 5', 30999, 'Watch', 'Samsung', 6, 'Stylish smartwatch with advanced features');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `u_name` varchar(100) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_mobile` varchar(15) NOT NULL DEFAULT 'Not Specified',
  `u_addr` varchar(50) NOT NULL DEFAULT 'Not Specified',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isBlock` tinyint(1) NOT NULL DEFAULT '0',
  `u_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`u_id`, `u_name`, `u_email`, `u_mobile`, `u_addr`, `isAdmin`, `isBlock`, `u_password`) VALUES
(109, 'Adithya S Nair', 'adithyasnair00@gmail.com', '73566658947', 'Kottayam', 1, 0, '$2y$10$jrw8sXY3flX/E05EB6keGuQyhawOAieI.iacio.eNORUT4LC9wrf6'),
(120, 'Bharath', 'bharath@gmail.com', 'Not Specified', 'Not Specified', 0, 0, '$2y$10$R3rWORrTLCFaeijuyjvEyOlzurgsZ/SLFr0yBuygjLdge6tdhYMrm'),
(119, 'Reybin', 'reybin@gmail.com', 'Not Specified', 'Not Specified', 0, 0, '$2y$10$nohZTmsTlwgWDVZgtssAVu73PFRzih3njvbaKblAHkZtrAZzvBKp2'),
(124, 'Abhimanyu', 'abhimanyu@gmail.com', 'Not Specified', 'Not Specified', 0, 0, '$2y$10$XFNkbDFU60SCXsWloAHlceWhxD.c0NrAmr84XHx1XzvuxYKHndVh2'),
(125, 'Aswin', 'aswin@gmail.com', 'Not Specified', 'Not Specified', 0, 0, '$2y$11$W/ZnvjVo3U1z7ApwdcaDrewMZbSVYazsNgTvlhf4NfEu183BFllq6');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishlist_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`wishlist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `product_id`) VALUES
(116, 109, 1026),
(114, 124, 1019),
(115, 109, 1019),
(117, 120, 1019);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
