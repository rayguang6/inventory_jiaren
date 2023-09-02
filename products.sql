-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 07:25 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myinventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `drawing_id` varchar(255) NOT NULL,
  `part_id` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `type1` varchar(255) NOT NULL,
  `type2` varchar(255) NOT NULL,
  `type3` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_quantity` int(11) NOT NULL,
  `quantity_per_set` int(11) NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `drawing_id`, `part_id`, `type`, `package`, `type1`, `type2`, `type3`, `cost`, `location`, `quantity`, `min_quantity`, `quantity_per_set`, `remark`) VALUES
(1, 'TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A', 'A001', 'B001', 'A', 'TO-10 HIGH SPEED', 'Blank', 'Degate', 'Punch', 10, 'GPM', 5, 4, 3, 'check before september'),
(70, 'TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT B', 'A1013', 'B1013', 'B', 'TO-10 HIGH SPEED', 'Blank', 'Dambar', 'Die Insert', 10, 'GPM', 10, 19, 0, 'checkmate\r\n'),
(71, 'TO-10 MATRIX SE DEF/BLANK DAMBAR PUNCH B', 'U2005259', 'B5259', 'B', 'TO-10 HIGH SPEED', 'Blank', 'Dambar', 'Punch', 10, 'GPM', 10, 8, 8, ''),
(72, 'SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A', 'ABCD', 'DCBA', 'B', 'SSOT33-HIGH SPEED', 'Trim', 'Preform 1', 'Punch', 6, 'GPM', 10, 5, 20, 'rem\r\n\r\njack\r\n\r\n123\r\n333'),
(73, 'SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH B', 'AA1123', 'ZYXWVUTS', 'B', 'SSOT33-HIGH SPEED', 'Trim', 'Preform 1', 'Punch', 6, 'GPM', 10, 5, 5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=683;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
