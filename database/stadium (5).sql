-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 06:46 PM
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
  `fullname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(5) NOT NULL,
  `stadium_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `fullname`, `username`, `password`, `role`, `stadium_id`) VALUES
(2, '', 'manager', '1234', '1', ''),
(3, 'KARAGWA Eric', 'footballagent', '1234', '0', ''),
(4, '', 'stadiumAgent', '1234', '2', ''),
(5, 'Mugisha James', 'manager@huyestadium', '1234', '1', '1'),
(6, 'NDIHO Peter', 'ndihopeter', '1234', '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `booking_teckets`
--

CREATE TABLE `booking_teckets` (
  `id` varchar(20) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `fixture_id` varchar(20) NOT NULL,
  `seat` varchar(20) NOT NULL,
  `n_of_seats` int(20) NOT NULL,
  `amount` int(123) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unused',
  `stadiumAgent_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_teckets`
--

INSERT INTO `booking_teckets` (`id`, `customer_id`, `fixture_id`, `seat`, `n_of_seats`, `amount`, `date`, `status`, `stadiumAgent_id`) VALUES
('0', '1', '8', 'VVIP', 5, 100000, '2021-03-05 00:05:03.', 'unused', ''),
('1', '1', '3', 'vvip', 2, 20000, '2021-02-21 08:00:51.', 'used', ''),
('2', '1', '4', 'VVIP', 2, 2000, '2021-03-02 13:05:48.', 'used', ''),
('3', '1', '4', 'VIP', 1, 5000, '2021-03-02 13:46:31.', 'used', '6'),
('0', '', '', '', 0, 0, '0000-00-00 00:00:00.', 'unused', ''),
('0', '1', '6', 'VIP', 1, 15000, '0000-00-00 00:00:00.', 'unused', ''),
('RNTC3690641', '1', '6', 'VVIP', 1, 20000, '0000-00-00 00:00:00.', 'unused', ''),
('RNTC4003685', '1', '6', 'VIP', 1, 15000, '2021-04-02', 'unused', ''),
('RNTC913418', '1', '10', 'VVIP', 10, 200000, '2021-03-06', 'unused', ''),
('RNTC7780444', '1', '10', 'VVIP', 10, 200000, '2021-03-06', 'unused', '');

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attending_division` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `name`, `attending_division`) VALUES
(1, 'Ikikombe cyi ntwari', 'D1,D2'),
(2, 'ikikombe cya champion', 'D1'),
(3, 'Ikikombe cya mahoro', 'D1,D2');

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
(1, 'Jean de Dieu', 'Male', '30', '0780591269', 'renzahoemmanuel8@gmail.com', '1234567', 9700),
(2, 'Kamana Eric', 'Male', '27', '0782666592', 'kamana@gmail.com', '12345678', 0);

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
(2, '2021-03-04', '15:45', 'Ikikombe cya amahoro', '1', '2', 'huye stadium', 'this match will make alot of changes on table', 'images/upload/250784170661_status_a8eefbfc28c74820be9c6bb7db21e197.jpg', 'end'),
(3, '2021-03-01', '16:00', 'peace cup', '2', '4', 'kigali nation stadium', 'djhjhfjdf', 'images/upload/IMG_3122.JPG', 'end'),
(4, '2021-04-05', '20:26', 'peace cup', '2', '1', 'kigali nation stadium', 'hhh sdhdhh asdhdshd hhhh', 'images/upload/IMG-20210228-WA0052.jpg', 'active'),
(5, '2021-03-04', '14:40', 'Ikikombe cyi ntwari', '1', '4', 'Mamagabe stadium', 'This is the best match in competition', 'images/upload/IMG-20210228-WA0031.jpg', 'end'),
(6, '2021-03-18', '01:02', 'ikikombe cya champion', '4', '5', 'huye stadium', 'gftu vytftyftu fvtrdft hfyu', 'images/upload/IMG-20210228-WA0021.jpg', 'active'),
(7, '2021-03-04', '07:10', 'Ikikombe cyi ntwari', '2', '4', 'MUSANZE Stadium', 'kjy chhh bjgyjf vjftf hjftf vfhgf bgg', 'images/upload/banner-no.png', 'end'),
(8, '2021-03-04', '02:23', 'Ikikombe cyi ntwari', '2', '1', 'hyuyt', 'ghgjgjkhj', 'images/upload/IMG-20210228-WA0038.jpg', 'end'),
(10, '2021-03-09', '23:57', 'Ikikombe cya mahoro', '2', '4', 'HUYE INTERNATIONAL STADIUM', 'this is last game of competition', 'images/upload/IMG-20210228-WA0049.jpg', 'active'),
(11, '2021-03-07', '02:00', 'Ikikombe cya mahoro', '1', '5', 'HUYE INTERNATIONAL STADIUM', 'the is for hkjhkljugy', 'images/upload/IMG-20210228-WA0061.jpg', 'active');

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
(1, '2', 'weather', '2021-03-04', '15:45', '2021-03-04', '15:45'),
(2, '4', 'some player has been tested positive covid 19', '2021-03-10', '16:00', '2021-04-05', '20:26');

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
(2, '4', '30', '1000', '20', '5000', '40', '2000', '50', '1000'),
(3, '7', '50', '15000', '200', '10000', '432', '5000', '4332', '2000'),
(4, '8', '50', '20000', '100', '15000', '432', '5000', '938', '2000'),
(5, '6', '30', '20000', '29', '15000', '400', '5000', '843', '2000'),
(6, '10', '10', '20000', '35', '15000', '300', '5000', '490', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `stadiums`
--

CREATE TABLE `stadiums` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `seats_nber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stadiums`
--

INSERT INTO `stadiums` (`id`, `name`, `province`, `district`, `seats_nber`) VALUES
(1, 'HUYE INTERNATIONAL STADIUM', 'SOUTH Province', 'HUYE District', '5000');

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
(1, 'APR FC', 'D1', 'images/upload/2.jpg'),
(2, 'mukura', 'D1', 'images/upload/2.jpg'),
(4, 'Amagaju', 'D2', 'images/upload/2.jpg'),
(5, 'as kigali', 'D1', 'images/upload/qr-code.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
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
-- Indexes for table `stadiums`
--
ALTER TABLE `stadiums`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `postponed_matchs`
--
ALTER TABLE `postponed_matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seats_and_prices`
--
ALTER TABLE `seats_and_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stadiums`
--
ALTER TABLE `stadiums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
