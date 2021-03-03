-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 09:28 AM
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
(2, 'footballagent', '1234', '0'),
(3, 'manger', '1234', '1'),
(4, 'stadium agent', '1234', '2');

-- --------------------------------------------------------

--
-- Table structure for table `booking_teckets`
--

CREATE TABLE `booking_teckets` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `seat` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `gender`, `age`, `telephone`, `email`, `password`) VALUES
(1, 'Jean de Dieu', 'Male', '30', '0780640237', 'renzahoemmanuel8@gmail.com', '1234567');

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
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `date`, `time`, `competition`, `home_team`, `away_team`, `location`, `description`, `cover_image`, `status`) VALUES
(2, '2021-03-01', '09:00', 'Ikikombe cya mahoro', '1', '2', 'huye stadium', 'this match will make alto of changes on table', '../images/upload/250784170661_status_a8eefbfc28c74820be9c6bb7db21e197.jpg', 'end'),
(3, '2021-03-03', '14:20', 'Ikikombe cya mahoro', '4', '2', 'Mamagabe stadium', 'it is final match in group D', '../images/upload/a3.jpg', 'active'),
(4, '2021-03-02', '08:25', 'Ikikombe cya mahoro', '5', '4', 'MUSANZE Stadium', 'the final match of the competition', '../images/upload/IMG-20210228-WA0047.jpg', 'end');

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
(4, '3', 'This match is postponed because some of player have been tested positive covid19', '2021-03-03', '14:20', '2021-03-03', '14:20');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `home_team_result` varchar(20) NOT NULL,
  `away_team_result` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `fixture_id`, `home_team_result`, `away_team_result`) VALUES
(2, '2', '2', '3'),
(3, '3', '2', '1');

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
(2, '3', '10', '200000', '20', '10000', '500', '5000', '999', '2000'),
(3, '2', '30', '10000', '50', '7000', '574', '2000', '2742', '1000');

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
(5, 'MUSANZE FC', 'D1', '../images/upload/IMG-20210228-WA0017.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seats_and_prices`
--
ALTER TABLE `seats_and_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
