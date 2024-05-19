-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 05:03 AM
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
-- Database: `otps`
--
CREATE DATABASE IF NOT EXISTS `otps` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `otps`;

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

DROP TABLE IF EXISTS `accesslevel`;
CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `activated`
--

DROP TABLE IF EXISTS `activated`;
CREATE TABLE IF NOT EXISTS `activated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activated`
--

INSERT INTO `activated` (`id`, `name`) VALUES
(1, 'not_enable'),
(2, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `keypairs`
--

DROP TABLE IF EXISTS `keypairs`;
CREATE TABLE IF NOT EXISTS `keypairs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `hotp` varchar(32) DEFAULT NULL,
  `counter` int(10) DEFAULT NULL,
  `totp` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otpstorage`
--

DROP TABLE IF EXISTS `otpstorage`;
CREATE TABLE IF NOT EXISTS `otpstorage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `hotp` varchar(6) DEFAULT NULL,
  `hotp_expiredtime` datetime DEFAULT NULL,
  `hotp_available` int(1) DEFAULT 1,
  `totp` varchar(6) DEFAULT NULL,
  `totp_expiredtime` datetime DEFAULT NULL,
  `totp_available` int(1) DEFAULT 1,
  `authenticator_totp` varchar(6) DEFAULT NULL,
  `authenticator_totp_available` int(1) DEFAULT 1,
  `randomnumberotp` varchar(6) DEFAULT NULL,
  `randomnumberotp_expiredtime` datetime DEFAULT NULL,
  `randomnumberotp_available` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `token_value` varchar(255) DEFAULT NULL,
  `token_key` varchar(255) DEFAULT NULL,
  `keypairs` int(10) NOT NULL,
  `otpstorage` int(11) NOT NULL,
  `accesslevel` int(5) NOT NULL,
  `activated` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `keys` (`keypairs`),
  KEY `accesslevel` (`accesslevel`),
  KEY `token_key` (`token_key`),
  KEY `otpstorage` (`otpstorage`),
  KEY `activated` (`activated`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`keypairs`) REFERENCES `keypairs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`accesslevel`) REFERENCES `accesslevel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`activated`) REFERENCES `activated` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`otpstorage`) REFERENCES `otpstorage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
