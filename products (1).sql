-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 12:01 AM
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
  `product_id` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `lead_count` int(11) NOT NULL,
  `type1` varchar(255) NOT NULL,
  `type2` varchar(255) NOT NULL,
  `type3` varchar(255) NOT NULL,
  `type4` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_quantity` int(11) NOT NULL,
  `quantity_per_set` int(11) NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `product_id`, `place`, `package`, `lead_count`, `type1`, `type2`, `type3`, `type4`, `quantity`, `min_quantity`, `quantity_per_set`, `remark`) VALUES
(1, 'TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A', 'A001', 'GPM', 'TO-10 HIGH SPEED', 10, 'Blank', 'Degate', 'Punch', 'A', 5, 4, 3, 'check before september'),
(68, 'TO-10 MATRIX SE DEF/BLANK DAMBAR PUNCH A', 'AA#3', 'GPM', 'TO-10 HIGH SPEED', 10, 'Blank', 'Dambar', 'Punch', 'A', 10, 2, 11, ''),
(69, 'TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT A', 'BB#1', 'GPM', 'TO-10 HIGH SPEED', 9, 'Blank', 'Dambar', 'Die Insert', 'A', 5, 10, 10, 'repair'),
(70, 'TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT B', 'A1013', 'GPM', 'TO-10 HIGH SPEED', 10, 'Blank', 'Dambar', 'Die Insert', 'B', 10, 19, 0, ''),
(71, 'TO-10 MATRIX SE DEF/BLANK DAMBAR PUNCH B', 'U2005259', 'GPM', 'TO-10 HIGH SPEED', 10, 'Blank', 'Dambar', 'Punch', 'B', 4, 5, 5, ''),
(72, 'SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A', 'ABCD', 'GPM', 'SSOT33-HIGH SPEED', 6, 'Trim', 'Preform 1', 'Punch', 'A', 10, 20, 20, 'add stock'),
(73, 'SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH B', 'AA1123', 'GPM', 'SSOT33-HIGH SPEED', 6, 'Trim', 'Preform 1', 'Punch', 'B', 10, 5, 5, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
