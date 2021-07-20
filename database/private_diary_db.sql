CREATE DATABASE private_diary_db;
USE private_diary_db;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 04:08 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `private_diary_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcompose`
--

CREATE TABLE IF NOT EXISTS `tblcompose` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `note` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblcompose`
--

INSERT INTO `tblcompose` (`id`, `title`, `note`, `date`, `time`, `username`, `status`) VALUES
(8, 'FIRST LOVE', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas ', '2021/07/10', '02:31:50 pm', 'Afolabi', 'Un-Archive'),
(10, 'SAMPLE TITLE 1', 'Sample Title 1 1 1', '2021/07/10', '04:37:57 pm', 'Afolabi', 'Un-Archive'),
(11, 'SAMPLE TITLE 2', 'Sample Title 2', '2021/07/10', '04:38:06 pm', 'Afolabi', 'Un-Archive'),
(12, 'SAMPLE TITLE 3', 'Sample Title 3', '2021/07/10', '04:38:13 pm', 'Afolabi', 'Un-Archive'),
(16, 'TEST TITLE YOUTUBE 1', 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas', '2021/07/18', '10:20:16 pm', 'Deb', 'Un-Archive');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `master_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `fullname`, `email`, `phone`, `gender`, `address`, `password`, `usertype`, `master_password`) VALUES
(4, 'Afolabi', 'Afolabi Temidayo Timothy', 'Afolabi8120@gmail.com', '08090949669', 'Male', 'Micheal O Babatunde Ave, off Jankara Rd, Ijaiye Ojokoro, Lagos State.                                                        ', '$2y$10$VfFU6N6/DxoEs7s5JAJ3wuMX/BS5AZo5r3Qhh.OldPp2O29tNfIBm', 'User', '$2y$10$Y3F6Gofo1dfw/rtj7QoIV.drArKY9tU/uy2PFygG3ZUShgh5J72du'),
(6, 'Youtube', 'Youtube Youtube One', 'youtube@yahoo.com', '08090949669', 'Male', 'N/A', '$2y$10$6vgFSzQDQ2MXIkA3ZrNL..fHd0d8nmJ2ou0G0J9/F9imrFgqcgPG6', 'User', '$2y$10$u4Vt2DWu1oFNQgSjNyKAFuqO6hYoCUnACmpPANZmxa5a8ZyFWS32y'),
(7, 'Deb', 'Afolabi Deborah Oluwaseun', 'Deb@gmail.com', '08090949669', 'Female', 'N/A', '$2y$10$.PlrEdJ2th.GJlRD6Jk/numcXruuimHceB5wJcRY9DzdWSJ6cN5VW', 'User', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
