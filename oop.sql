-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2023 at 02:26 PM
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
-- Database: `oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` blob NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `date` date NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category`, `content`, `price`, `date`, `approved`, `author_id`) VALUES
(3, 'Articol_Artistic_1', 'Artistic', 0x54657874756c207072696d756c75692061727469636f6c204172746973746963, '100.00', '2023-01-14', 1, 10),
(6, 'Articol_moda_1', 'Moda', 0x416365737461206573746520756e2061727469636f6c206465206d6f646120696e206361726520736520646574616c69617a6120756c74696d656c65207472656e6475726920696e206d6174657269652064652066617368696f6e2c206d6f64612c20616c6520616e756c75692032303233, '100.00', '2023-01-13', 1, 9),
(10, 'Articol_Tehnic_1', 'Tehnic', 0x436f6e74696e75742041727469636f6c205465686e69630d0a, '111.00', '2023-01-13', 1, 9),
(11, 'Articol_Science_1', 'Science', 0x0d0a436f6e74696e756c20616c2061727469636f6c756c756920536369656e6365, '150.00', '2023-01-13', 1, 9),
(12, 'Articol_moda_2', 'Moda', 0x436f6e74696e7574756c2061727469636f6c756c75692032206465206d6f64610d0a, '111.00', '2023-01-14', 1, 9),
(13, 'TITLU', 'Science', 0x0d0a434f4e54494e5554, '100.00', '2023-01-14', 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `activated`) VALUES
(5, 'Popescu Ion', 'editor', 'editor@email.com', 'fc9e30d0d5b3738a2895709b0de10986', 'Editor', 1),
(8, 'Paula Pliot', 'cititor', 'cititor@email.com', 'fc9e30d0d5b3738a2895709b0de10986', 'Cititor', 1),
(9, 'Chihaia Andreea', 'jurnalist2', 'emailjurnalist2@email.com', 'fc9e30d0d5b3738a2895709b0de10986', 'Jurnalist', 1),
(10, 'Vasile Grigore', 'jurnalist1', 'emailjurnalist1@email.com', 'fc9e30d0d5b3738a2895709b0de10986', 'Jurnalist', 1),
(13, 'nume nume', 'jurnalist4', 'emailjurnalist4@email.com', 'fc9e30d0d5b3738a2895709b0de10986', 'Jurnalist', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
