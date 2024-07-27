-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2024 at 07:52 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `doz`
--

DROP TABLE IF EXISTS `doz`;
CREATE TABLE IF NOT EXISTS `doz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namePlayer1` varchar(20) COLLATE utf32_persian_ci NOT NULL,
  `namePlayer2` varchar(20) COLLATE utf32_persian_ci NOT NULL,
  `countWin` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `walletplayer1` int(11) NOT NULL,
  `walletplayer2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf32 COLLATE=utf32_persian_ci;

--
-- Dumping data for table `doz`
--

INSERT INTO `doz` (`id`, `namePlayer1`, `namePlayer2`, `countWin`, `price`, `walletplayer1`, `walletplayer2`) VALUES
(36, 'amirhossein', 'alireza', 4, 10000, 10000, 10000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
