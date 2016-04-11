-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2016 at 06:44 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.6.14-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cektraining2`
--

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL,
  `owner_role_id` int(10) unsigned NOT NULL,
  `reviewer_id` int(10) unsigned NOT NULL,
  `reviewer_role_id` int(10) unsigned NOT NULL,
  `testimony` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `owner_id`, `owner_role_id`, `reviewer_id`, `reviewer_role_id`, `testimony`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 4, 2, 'Fandy is simply a rock star! His ability to deliver a well-prepared message in a funny, interesting way and engage everyone in the room is unparalleled in his industry. His research and thought-provoking educational material will resonate with our organiz', '2016-04-11 04:43:38', '2016-04-11 04:43:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
