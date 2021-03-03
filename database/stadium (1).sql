-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 10:56 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stadium`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`) VALUES
(2, 'manager', '1234', '1'),
(3, 'footballagent', '1234', '0'),
(4, 'stadiumAgent', '1234', '2');

-- --------------------------------------------------------

--
-- Table structure for table `booking_teckets`
--

CREATE TABLE `booking_teckets` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `seat` varchar(20) NOT NULL,
  `n_of_seats` int(20) NOT NULL,
  `amount` int(123) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `status` varchar(20) NOT NULL DEFAULT 'unused'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_teckets`
--

INSERT INTO `booking_teckets` (`id`, `customer_id`, `fixture_id`, `seat`, `n_of_seats`, `amount`, `date`, `status`) VALUES
(1, '1', '3', 'vvip', 0, 0, '2021-02-21 06:00:51.000000', 'unused'),
(2, '1', '4', 'VVIP', 2, 2000, '2021-03-02 11:05:48.439222', 'used'),
(3, '1', '4', 'VIP', 1, 5000, '2021-03-02 11:46:31.788564', 'unused');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `age` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `totalAmount` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `gender`, `age`, `telephone`, `email`, `password`, `totalAmount`) VALUES
(1, 'Jean de Dieu', 'Male', '30', '0780640237', 'renzahoemmanuel8@gmail.com', '1234567', 9700);

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `competition` varchar(200) NOT NULL,
  `home_team` varchar(200) NOT NULL,
  `away_team` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `cover_image` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `date`, `time`, `competition`, `home_team`, `away_team`, `location`, `description`, `cover_image`, `status`) VALUES
(2, '2021-03-04', '15:45', 'ikikombe cya mahoro', '1', '2', 'huye stadium', 'this match will make alto of changes on table', '../images/upload/250784170661_status_a8eefbfc28c74820be9c6bb7db21e197.jpg', 'postponed'),
(3, '2021-03-01', '16:00', 'peace cup', '2', '4', 'kigali nation stadium', 'djhjhfjdf', '../images/upload/IMG_3122.JPG', 'end'),
(4, '2021-03-10', '16:00', 'peace cup', '2', '1', 'kigali nation stadium', 'hhh sdhdhh asdhdshd hhhh', '../images/upload/IMG-20210228-WA0052.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `postponed_matchs`
--

CREATE TABLE `postponed_matchs` (
  `id` int(11) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `fromOn` varchar(20) NOT NULL,
  `fromAt` varchar(20) NOT NULL,
  `moved_date` varchar(20) NOT NULL,
  `moved_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postponed_matchs`
--

INSERT INTO `postponed_matchs` (`id`, `fixture_id`, `reason`, `fromOn`, `fromAt`, `moved_date`, `moved_time`) VALUES
(1, '2', 'weather', '2021-03-01', '09:00', '2021-03-04', '15:45');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `home_tem_result` varchar(20) NOT NULL,
  `away_team_result` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `fixture_id`, `home_tem_result`, `away_team_result`) VALUES
(1, '3', '2', '4');

-- --------------------------------------------------------

--
-- Table structure for table `seats_and_prices`
--

CREATE TABLE `seats_and_prices` (
  `id` int(11) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `vvip_seats` varchar(20) NOT NULL,
  `vvip_price` varchar(20) NOT NULL,
  `vip_seats` varchar(20) NOT NULL,
  `vip_price` varchar(20) NOT NULL,
  `roofed_seats` varchar(20) NOT NULL,
  `roofed_price` varchar(20) NOT NULL,
  `unroofed_seats` varchar(20) NOT NULL,
  `unroofed_price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats_and_prices`
--

INSERT INTO `seats_and_prices` (`id`, `fixture_id`, `vvip_seats`, `vvip_price`, `vip_seats`, `vip_price`, `roofed_seats`, `roofed_price`, `unroofed_seats`, `unroofed_price`) VALUES
(1, '3', '2', '10000', '2', '5000', '2', '2000', '2', '1000'),
(2, '4', '30', '1000', '20', '5000', '40', '2000', '50', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `division` varchar(20) NOT NULL,
  `logo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `division`, `logo`) VALUES
(1, 'APR', 'D1', ''),
(2, 'mukura', 'D1', '...'),
(4, 'Amagaju', 'D2', '../images/upload/2.jpg'),
(5, 'as kigali', 'D1', '../images/upload/qr-code.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_teckets`
--
ALTER TABLE `booking_teckets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postponed_matchs`
--
ALTER TABLE `postponed_matchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats_and_prices`
--
ALTER TABLE `seats_and_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking_teckets`
--
ALTER TABLE `booking_teckets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `postponed_matchs`
--
ALTER TABLE `postponed_matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seats_and_prices`
--
ALTER TABLE `seats_and_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
