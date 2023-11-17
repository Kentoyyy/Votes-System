-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2023 at 01:14 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votes`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` int(13) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(24) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `contact`, `address`, `password`, `username`) VALUES
(1, 'ivvo', 'barroba', 'ivojoghn@gmail.com', 9113131, 'Tokyo, Japan', 'meliodas1', NULL),
(2, 'Ivo', 'Barroba', 'ivojohnmbarroba@gmail.com', 9123, 'wuhan china', 'meliodas1', NULL),
(3, 'Sha', 'Panes', 'shaarleenpanes@gmail.com', 9676767, 'Grove St.', 'meliodas1', NULL),
(4, 'ja', 'bol', 'jabol@gmail.com', 91234566, 'Grove St.', '1234', NULL),
(5, 'Ivo John', 'Barroba', 'barrobaovinhoj@gmail.com', 918613, 'Bacoor Cavite', 'youalreadyknowmyname', NULL),
(6, 'Shaarleen', 'Panes', 'shaarleenganda@gmail.com', 912345, 'Mabolo St.', 'chiyo', NULL),
(7, 'Ian Matthew', 'De Guzman', 'ianmatthew@gmail.com', 912432, 'Wuhan China', 'coachpenge12', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
