-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2016 at 09:40 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(4) NOT NULL,
  `image` text CHARACTER SET latin1 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `created`, `modified`) VALUES
(2, 'Masodik', 'Description of the item called Masodik.', 22, '11354983_998446663501104_992924378_n.jpg', '2015-02-27 14:32:03', '2016-02-18 20:39:42'),
(3, 'Harmadik', 'Harmadik shirt is so awesome, because its the third item. So cool.', 13, '1454704408_shirt2.jpg', '2015-02-27 14:32:16', '2016-02-05 21:33:28'),
(4, 'Negyedik', 'Negyedik item in database.', 15, 'shirt.jpg', '2015-03-16 14:52:05', '2016-02-05 21:30:27'),
(5, 'Otodik', 'new stuff', 22, '1452186219_11354983_998446663501104_992924378_n.jpg', '2015-04-15 15:03:36', '2016-01-07 18:03:39'),
(6, 'Hatodik', '', 20, '1454704522_1429103096_shirt4.jpg', '2015-04-15 15:04:56', '2016-02-05 21:35:22'),
(7, 'Hetedik', 'lorem ipsum', 12, '1454704549_shirt5.jpg', NULL, '2016-02-05 21:35:49'),
(19, 'Prototype', 'This was the first doll drawn.', 22, '1454706756_shirt3.jpg', '2016-02-05 22:12:36', '2016-02-05 22:12:36'),
(20, 'Matthew', 'Frankeinsteins doll in inverted colors', 25, '1454707058_mate2.jpg', '2016-02-05 22:16:12', '2016-02-05 22:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created`) VALUES
(1, 'asdasd@asdasd.asd', '2016-01-22 12:32:58'),
(2, 'asdasd@asdasd.asd', '2016-01-22 12:39:48'),
(3, 'asdasd2@asdasd.asd', '2016-01-22 12:40:35'),
(4, 'asdasd3@asdasd.asd', '2016-01-22 12:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_province` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_item_count` int(11) DEFAULT NULL,
  `total` decimal(8,2) unsigned DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=30 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `address2`, `city`, `zip`, `country`, `state_province`, `order_item_count`, `total`, `status`, `created`, `modified`) VALUES
(17, 24, 'Robert', 'Szell', 'szellrobert92@gmail.com', '0123456789', 'Tenkovska 115.', '', 'Martonos', '24417', '204', 'Vojvodina', 3, '48.00', NULL, '2016-01-06 14:03:43', '2016-01-06 14:03:43'),
(20, 24, 'Robert', 'Szell', 'szellrobert92@gmail.com', '0123456789', 'kjhgfd546', 'sdvb', 'City', '1345', '0', 'Vojvodina', 1, '15.00', NULL, '2016-01-06 15:10:27', '2016-01-06 15:10:27'),
(21, 24, 'Robert', 'Szell', 'szellrobert92@gmail.com', '0123456789', 'kjhgfd 546', 'sdvb', 'City', '1345', '3', 'Vojvodina', 2, '42.00', NULL, '2016-01-06 15:15:48', '2016-01-06 15:15:48'),
(24, 24, 'Robert', 'Szell', 'szellrobert92@gmail.com', '0123456789', 'kjhgfd 546', '', 'City', '1345', '1', 'Vojvodina', 1, '13.00', NULL, '2016-01-06 15:31:19', '2016-01-06 15:31:19'),
(26, 25, 'Kicsi', 'Virág', 'kicsivirag@kicsivirag.com', '+381 156 156 15', 'virag street 38.', '', 'ViragCity', '12345', 'Equatorial Guinea', '', 3, '31.00', NULL, '2016-01-25 18:44:43', '2016-01-25 18:44:43'),
(27, 25, 'asdasd', 'asdasd', 'kicsivirag@kicsivirag.com', '0123456789', 'virag street 38.', '', 'City', '1345', 'Aruba', '', 2, '34.00', NULL, '2016-02-05 21:11:44', '2016-02-05 21:11:44'),
(28, 25, 'Cserepes', 'Virág', 'szellrobert92@gmail.com', '0123456789', 'virag street 38.', '', 'Virag', '1345', 'Georgia', '', 1, '15.00', NULL, '2016-02-17 17:14:30', '2016-02-17 17:14:30'),
(29, 25, 'Robert', 'Szell', 'szellrobert92@gmail.com', '0123456789', 'virag street 38.', 'sdvb', 'City', '24417', 'Martinique', '', 2, '42.00', 'feldolgozva', '2016-02-18 13:28:24', '2016-02-18 17:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `size` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(8,2) unsigned DEFAULT NULL,
  `subtotal` decimal(8,2) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=45 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `session_id`, `item_id`, `name`, `size`, `quantity`, `price`, `subtotal`, `created`, `modified`) VALUES
(25, 17, '2bf1qhvjhr45gimm92ssnelme0', 3, 'Harmadik', 's', 2, '13.00', '26.00', '2016-01-06 14:03:10', '2016-01-06 14:03:10'),
(26, 17, '2bf1qhvjhr45gimm92ssnelme0', 5, 'Otodik', 'xl', 1, '22.00', '22.00', '2016-01-06 14:03:10', '2016-01-06 14:03:10'),
(28, 20, 'helmagsv85vmo3ohsn11evp1p3', 1, 'Elsoo', 's', 1, '15.00', '15.00', '2016-01-06 15:10:10', '2016-01-06 15:10:10'),
(29, 21, 'r2na4eingjl0aqjk49u4tdoa22', 2, 'Masodik', 's', 2, '21.00', '42.00', '2016-01-06 15:12:57', '2016-01-06 15:12:57'),
(33, 26, '87t5jtgpflnn3473qfh8pn5vn6', 2, 'Masodik', 'l', 1, '21.00', '21.00', '2016-01-25 18:43:31', '2016-01-25 18:43:31'),
(34, 26, '87t5jtgpflnn3473qfh8pn5vn6', 4, 'Negyedik', 'l', 2, '5.00', '10.00', '2016-01-25 18:43:31', '2016-01-25 18:43:31'),
(36, 27, 'bkl2ro5vrmadi6ig3gsdlonsl3', 2, 'Masodik', 'l', 1, '21.00', '21.00', '2016-02-05 21:00:29', '2016-02-05 21:00:29'),
(37, 27, 'bkl2ro5vrmadi6ig3gsdlonsl3', 3, 'Harmadik', 'l', 1, '13.00', '13.00', '2016-02-05 21:00:30', '2016-02-05 21:00:30'),
(38, 27, 'bkl2ro5vrmadi6ig3gsdlonsl3', 2, 'Masodik', 'l', 1, '21.00', '21.00', '2016-02-05 21:04:01', '2016-02-05 21:04:01'),
(39, 27, 'bkl2ro5vrmadi6ig3gsdlonsl3', 3, 'Harmadik', 'l', 1, '13.00', '13.00', '2016-02-05 21:04:01', '2016-02-05 21:04:01'),
(40, 28, '0sshtp6gg3jemorb0ili9cfsg4', 4, 'Negyedik', 's', 1, '15.00', '15.00', '2016-02-17 17:12:24', '2016-02-17 17:12:24'),
(41, NULL, '3tf6p52krds7dp8tvbmhdt9av3', 2, 'Masodik', 'l', 2, '21.00', '42.00', '2016-02-17 18:16:13', '2016-02-17 18:16:13'),
(42, 29, 'qiigsj9lbin7jgr2d6dvssmus3', 2, 'Masodik', 's', 2, '21.00', '42.00', '2016-02-18 13:27:42', '2016-02-18 13:27:42'),
(43, NULL, '4umnrq5f3gq2gpcu8ard8ij4k1', 20, 'Matthew', 'l', 2, '25.00', '50.00', '2016-02-18 17:33:55', '2016-02-18 17:33:55'),
(44, NULL, 'l3kf5vglrjl838iar19g9t68g3', 2, 'Masodikk', 'xl', 2, '22.00', '44.00', '2016-02-18 20:36:21', '2016-02-18 20:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `user_type` tinyint(1) DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_4` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `birthdate`, `user_type`, `activation_code`, `status`, `created`, `modified`) VALUES
(3, 'Godmother', 'e4878b9f8d75a1b41d2e60baf5b4bc8725fff920', 'giannika32@gmail.com', 'János', 'Égető', '1992-05-15', NULL, '', 'active', '2015-06-07 11:57:58', '2015-06-07 11:58:31'),
(7, 'admin', '110d77b9eea51aa06ff7313b3edf519e84793a4a', 'szell.robert92@hotmail.hu', 'Firstname', 'Lastname', '1992-08-14', 1, '', 'active', '2015-06-23 22:47:29', '2015-06-23 22:47:42'),
(24, 'robika', 'e4878b9f8d75a1b41d2e60baf5b4bc8725fff920', 'szellrobert92@gmail.com', 'robika', 'robika', '1992-08-14', 0, '', 'active', '2015-11-11 17:18:51', '2015-12-21 13:15:55'),
(25, 'asdasd', 'e4878b9f8d75a1b41d2e60baf5b4bc8725fff920', 'asdasdasd@asdasd.asd', 'robika', 'asd', '2011-01-01', 0, '', 'active', '2016-01-25 18:35:49', '2016-01-27 12:17:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
