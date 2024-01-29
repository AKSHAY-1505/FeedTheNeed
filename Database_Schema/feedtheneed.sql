-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 10:24 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedtheneed`
--

-- --------------------------------------------------------

--
-- Table structure for table `charities`
--

CREATE TABLE `charities` (
  `id` int NOT NULL,
  `c_name` varchar(128) NOT NULL,
  `c_email` varchar(128) NOT NULL,
  `c_phone` varchar(128) NOT NULL,
  `c_addr` varchar(512) NOT NULL,
  `c_pswd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `charities`
--

INSERT INTO `charities` (`id`, `c_name`, `c_email`, `c_phone`, `c_addr`, `c_pswd`) VALUES
(11, 'Charity1', 'Charity1@gmail.com', '8973214569', 'Address of Charity1', 'Charity1'),
(12, 'Charity2', 'Charity2@gmail.com', '6789213548', 'Address of Charity2', 'Charity2'),
(13, 'Charity13', 'Charity3@gmail.com', '8456791328', 'Address of Charity3', 'Charity3');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mid` int NOT NULL,
  `sender` varchar(128) NOT NULL,
  `receiver` varchar(128) NOT NULL,
  `sname` varchar(128) NOT NULL,
  `semail` varchar(128) NOT NULL,
  `phno` varchar(128) NOT NULL,
  `msg` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mid`, `sender`, `receiver`, `sname`, `semail`, `phno`, `msg`) VALUES
(35, '26', '27', 'Ayesha', 'ayehsa@queen.com', '456789132', 'We require food for christmas celebration.'),
(36, '25', '27', 'Samantha', 'sam@amma.com', '7981365421', 'We require food for 20 people.\r\n'),
(37, '25', '27', 'Deepak', 'deepak@amma.com', '945321678', 'Feed the Need, Feel the need. Contact me to donate and bring smiles to peoples face.');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `rid` int NOT NULL,
  `r_name` varchar(128) NOT NULL,
  `r_email` varchar(256) NOT NULL,
  `r_phone` varchar(128) NOT NULL,
  `r_addr` varchar(512) NOT NULL,
  `r_pswd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rid`, `r_name`, `r_email`, `r_phone`, `r_addr`, `r_pswd`) VALUES
(9, 'McDonalds', 'mcd@gmail.com', '7983214569', 'Kolkata Airport', 'Res1'),
(10, 'Leon Grill', 'leon@gmail.com', '6599367789', 'Bigg Boss Road, Rajasthan', 'Res2'),
(11, 'Selvi Mess', 'selvi@gmail.com', '9845572136', 'Andal, Bihar', 'Res3');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `request_id` int NOT NULL,
  `rid` int NOT NULL,
  `cid` int NOT NULL,
  `items` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`request_id`, `rid`, `cid`, `items`, `status`) VALUES
(13, 27, 26, '10x McChicken Burger,\r\n15x Chicken Nuggets,\r\n10x McVeggie Burger.', 'Order Confirmed'),
(14, 29, 26, '20x Parotta,\r\n10x Mutta Kothu Parotta.', 'Requested'),
(15, 27, 25, '20x McChicken Happy Meal.', 'Order Confirmed'),
(16, 0, 0, '10x Mutta Parrota, 5x Chicken 65.\r\n', 'Requested'),
(17, 28, 25, '20 Burgers, 10 Chicken wings\r\n', 'Out For Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pswd` varchar(128) NOT NULL,
  `type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pswd`, `type`) VALUES
(24, 'Padmini Charity', 'padmini@gmail.com', 'padmini', 2),
(25, 'Amma Charity', 'amma@gmail.com', 'amma', 2),
(26, 'Queen Meera Trust', 'queen@gmail.com', 'queen', 2),
(27, 'McDonalds', 'mcd@gmail.com', 'mcd', 1),
(28, 'Leon Grill', 'leon@gmail.com', 'leon', 1),
(29, 'Selvi Mess', 'selvi@gmail.com', 'selvi', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charities`
--
ALTER TABLE `charities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charities`
--
ALTER TABLE `charities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
