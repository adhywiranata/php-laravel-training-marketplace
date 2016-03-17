-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2016 at 01:50 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.6.18-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cektraining`
--

-- --------------------------------------------------------

--
-- Table structure for table `feature_tracking`
--

CREATE TABLE IF NOT EXISTS `feature_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `feature_tracking`
--

INSERT INTO `feature_tracking` (`id`, `feature_name`, `user_id`, `ip`) VALUES
(1, 'add_to_contact', 0, ''),
(2, 'add_to_contact', 0, '127.0.0.1'),
(3, 'add_to_contact', 0, '127.0.0.1'),
(4, 'send_message', 0, '127.0.0.1'),
(5, 'training_program', 0, '127.0.0.1'),
(6, 'training_program', 0, '127.0.0.1'),
(7, 'testimonial', 0, '127.0.0.1'),
(8, 'certification', 0, '127.0.0.1'),
(9, 'awards', 0, '127.0.0.1'),
(10, 'skill', 0, '127.0.0.1'),
(11, 'video', 0, '127.0.0.1'),
(12, 'training_experience', 0, '127.0.0.1'),
(13, 'work_experience', 0, '127.0.0.1'),
(14, 'training_program', 0, '127.0.0.1'),
(15, 'testimonial', 0, '127.0.0.1'),
(16, 'certification', 0, '127.0.0.1'),
(17, 'awards', 0, '127.0.0.1'),
(18, 'skill', 0, '127.0.0.1'),
(19, 'video', 0, '127.0.0.1'),
(20, 'training_experience', 0, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
