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
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `history_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`history_id`, `username`, `action`, `description`, `timestamp`) VALUES
(1, 'user1', 'create', 'created Product 1( GPM, Package, 100, 50,  A, B, C, D )', '2023-08-20 09:37:58'),
(32, 'admin', 'DELETE', 'Deleted (woohoo le, m, k, 9, 8, 9, k, h, k, )', '2023-08-20 14:10:54'),
(33, 'admin', 'CREATE', 'Created (re, r, r, 1, 2, 9, r, r, r, remarkable memory)', '2023-08-20 14:17:08'),
(34, 'admin', 'UPDATE', 'Updated Product#57 from (re, r, r, 1, 2, 9, r, r, r, remarkable memory) to (re, r, r, 1, 2, 9, r, r, r, )', '2023-08-20 14:17:22'),
(35, 'admin', 'DELETE', 'Deleted (re, r, r, 1, 2, 9, r, r, r, )', '2023-08-20 14:17:30'),
(36, 'admin', 'UPDATE', 'Updated Product#67 from (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH B, GPM, TO-10 HIGH SPEED, 10, 100, Blank, Degate, Punch, B, Need More This) to (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH B, GPM, TO-10 HIGH SPEED, 10, 5, Blank, Degate, Punch, B, Need More This)', '2023-08-20 14:31:59'),
(37, 'admin', 'UPDATE', 'Updated Product#1 from (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A, GPM, TO-10 HIGH SPEED, 10, 5, Blank, Degate, Punch, B, this is super cool) to (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A, GPM, TO-10 HIGH SPEED, 10, 5, Blank, Degate, Punch, B, Stop using)', '2023-08-20 14:32:44'),
(38, 'admin', 'UPDATE', 'Updated Product#72 from (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, GPM, SSOT33-HIGH SPEED, 6, 30, Trim, Preform 1, Punch, A, ) to (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, GPM, SSOT33-HIGH SPEED, 6, 30, Trim, Preform 1, Punch, A, check this later)', '2023-08-20 14:32:53'),
(39, 'admin', 'CREATE', 'Created (ONE, Place1, Package1, 10, 50, Blank, Degate, Punch, A, )', '2023-08-20 14:40:06'),
(40, 'admin', 'CREATE', 'Created (TWO, Place2, Package1, 10, 2, Blank, Trim, Punch, A, )', '2023-08-20 14:40:40'),
(41, 'admin', 'CREATE', 'Created (THREE, Place1, Package2, 5, 20, Trim, Dambar, Punch, A, )', '2023-08-20 14:41:06'),
(42, 'admin', 'UPDATE', 'Updated Product#77 from \n(THREE, Place1, Package2, 5, 20, Trim, Dambar, Punch, A, ) to \n(THREE, Place1, Package2, 8, 20, Trim, Dambar, Punch, A, )', '2023-08-20 14:52:04'),
(43, 'admin', 'UPDATE', 'Updated Product#72 from \n(SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, GPM, SSOT33-HIGH SPEED, 6, 30, Trim, Preform 1, Punch, A, check this later) to \n(SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, GPM, SSOT33-HIGH SPEED, 6, 30, Trim, Preform 1, Punch, A, check this later ya\r\n)', '2023-08-20 14:53:06'),
(44, 'admin', 'UPDATE', 'Updated Product#72 from \n(SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, GPM, SSOT33-HIGH SPEED, 6, 30, Trim, Preform 1, Punch, A, check this later ya\r\n) to \n(SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, GPM, SSOT33-HIGH SPEED, 6, 30, Trim, Preform 1, Punch, A, check this later ya can\r\n)', '2023-08-20 14:53:42'),
(45, 'admin', 'UPDATE', 'Updated Product#76 from (TWO, Place2, Package1, 10, 2, Blank, Trim, Punch, A, ) to (TWO, Place 2, Package1, 10, 2, Blank, Trim, Punch, A, )', '2023-08-20 15:05:24'),
(46, 'admin', 'CREATE', 'Created (nama, place1, pack, 10, 5, blank, degate, punch, A, )', '2023-08-20 15:09:18'),
(47, 'admin', 'DELETE', 'Deleted (TWO, Place 2, Package1, 10, 2, Blank, Trim, Punch, A, )', '2023-08-20 15:10:04'),
(48, 'admin', 'UPDATE', 'Updated Product#74 from (test, 1, 3, 5, 5, a, s, s, g, ) to (test, PLace3, 3, 5, 5, a, s, s, g, change it soon)', '2023-08-20 15:12:31'),
(49, 'admin', 'UPDATE', 'Updated Product#74 from (test, PLace3, 3, 5, 5, a, s, s, g, change it soon) to (test, PLace3, 3, 5, 5, a, s, s, g, )', '2023-08-20 15:12:45'),
(50, 'admin', 'UPDATE', 'Updated Product#1 from (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A, GPM, TO-10 HIGH SPEED, 10, Blank, Degate, Punch, B, 1, 2, 3, Stop using) to (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A, GPM, TO-10 HIGH SPEED, 10, Blank, Degate, Punch, B, 10, 55, 1, hahaha)', '2023-08-22 13:23:51'),
(59, 'admin', 'UPDATE', 'Updated from (666, 666, 666, 666, 66, 66, 6, 6, 6, 6, 6, 6, 6) to (SIXXXER, 78, 78, 98, 78, 98, 69, 8, 789, 67, 56, 545, 576)', '2023-08-22 14:45:28'),
(60, 'admin', 'DELETE', 'Deleted (6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6)', '2023-08-22 15:01:02'),
(61, 'admin', 'DELETE', 'Deleted (SIXXXER, 78, 78, 98, 78, 98, 69, 8, 789, 67, 56, 545, 576)', '2023-08-22 15:01:08'),
(62, 'admin', 'UPDATE', 'Updated from (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, ABCD, GPM, SSOT33-HIGH SPEED, 6, Trim, Preform 1, Punch, A, 0, 0, 0, check this later ya can\r\n) to (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, ABCD, GPM, SSOT33-HIGH SPEED, 6, Trim, Preform 1, Punch, A, 10, 0, 0, check this later ya can\r\n)', '2023-08-22 17:29:43'),
(63, 'admin', 'UPDATE', 'Updated from (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH B, AA1123, GPM, SSOT33-HIGH SPEED, 6, Trim, Preform 1, Punch, B, 0, 0, 0, ) to (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH B, AA1123, GPM, SSOT33-HIGH SPEED, 6, Trim, Preform 1, Punch, B, 0, 5, 0, )', '2023-08-22 17:30:18'),
(64, 'admin', 'CREATE', 'Created (crazy, R19, 123, 3, 3, 3, 9, 8, 9, 8, 9, 8,  )', '2023-08-22 17:36:55'),
(65, 'admin', 'UPDATE', 'Updated from (crazy, R19, 123, 3, 3, 3, 9, 8, 9, 8, 9, 8, ) to (crazy, R19, 123, 3, 3, 3, 9, 8, 9, 8, 9, 8, \"/\"<>\r\n)', '2023-08-22 18:49:47'),
(66, 'admin', 'UPDATE', 'Updated from (TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT A, BB#1, GPM, TO-10 HIGH SPEED, 10, Blank, Dambar, Die Insert, A, 0, 0, 0, ) to (TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT A, BB#1, GPM, TO-10 HIGH SPEED, 10, Blank, Dambar, Die Insert, A, 0, 0, 0, ho\r\n)', '2023-08-22 19:03:53'),
(67, 'admin', 'CREATE', 'Created (\';\', 79, 79, 79, 79, 79, 79, 79, 79, 79, 79, 79,  )', '2023-08-22 19:04:54'),
(68, 'admin', 'CREATE', 'Created (\'\'\', \'\'\', \'\'\', \'\'\', 2, ;, \"\", 3, \"\', 2, 3, 4,  )', '2023-08-22 19:05:23'),
(69, 'admin', 'CREATE', 'Created (\', \', \', \', 10, 9, 9, 8, 9, 8, 9, 8, \'99\r\n\" )', '2023-08-22 19:06:02'),
(70, 'admin', 'DELETE', 'Deleted (crazy, R19, 123, 3, 3, 3, 9, 8, 9, 8, 9, 8, \"/\"<>\r\n)', '2023-08-22 19:06:47'),
(71, 'admin', 'UPDATE', 'Updated from (TO-10 MATRIX SE DEF/BLANK DAMBAR PUNCH A, AA#3, GPM, TO-10 HIGH SPEED, 10, Blank, Dambar, Punch, A, 1, 2, 5, ) to (TO-10 MATRIX SE DEF/BLANK DAMBAR PUNCH A, AA#3, GPM, TO-10 HIGH SPEED, 10, Blank, Dambar, Punch, A, 10, 2, 5, )', '2023-08-22 19:13:20'),
(72, 'admin', 'UPDATE', 'Updated from (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, ABCD, GPM, SSOT33-HIGH SPEED, 6, Trim, Preform 1, Punch, A, 10, 0, 0, check this later ya can\r\n) to (SSOT33 6LDS AUTO GPM SE DDTS TNF PREFORM 1 PUNCH A, ABCD, GPM, SSOT33-HIGH SPEED, 6, Trim, Preform 1, Punch, A, 10, 20, 20, check this later ya can\r\n)', '2023-08-22 19:13:59'),
(73, 'admin', 'CREATE', 'Created (woleo, AM, KL, pack, 10, 20, 10, B, C, 51, 10, 20,  )', '2023-08-22 20:03:20'),
(74, 'admin', 'UPDATE', 'Updated from (TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT A, BB#1, GPM, TO-10 HIGH SPEED, 10, Blank, Dambar, Die Insert, A, 0, 0, 0, ho\r\n) to (TO-10 MATRIX SE DEF/BLANK DAMBAR DIE INSERT A, BB#1, GPM, TO-10 HIGH SPEED, 9, Blank, Dambar, Die Insert, A, 0, 0, 0, ho\r\n)', '2023-08-22 20:09:07'),
(75, 'admin', 'UPDATE', 'Updated from (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A, A001, GPM, TO010 HIGH SPEED, 10, Blank, Degate, Punch, A, 5, 4, 3, 100) to (TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH A, A001, GPM, TO-10 HIGH SPEED, 10, Blank, Degate, Punch, A, 5, 4, 3, 100)', '2023-08-22 21:01:18'),
(76, 'admin', 'DELETE', 'Deleted (woleo, AM, KL, pack, 10, 20, 10, B, C, 51, 10, 20, )', '2023-08-22 21:03:06'),
(77, 'admin', 'UPDATE', 'Updated the following fields:\nQuantity: 0 => 10\nMin Quantity: 0 => 19', '2023-08-22 21:08:14'),
(78, 'admin', 'UPDATE', 'Updated the following fields:\nProduct ID: AA#2 => A001', '2023-08-22 21:09:23'),
(79, 'admin', 'UPDATE', 'Updated the following fields:\nProduct ID: A001 => A002', '2023-08-22 21:09:39'),
(80, 'admin', 'UPDATE', 'Updated the following fields:\nName: TO-10 MATRIX SE DEF/BLANK DEGATE PUNCH B => 1, \nProduct ID: A002 => 2, \nPlace: GPM => 3, \nPackage: TO-10 HIGH SPEED => 4, \nLead Count: 10 => 5, \nType 1: Blank => 6, \nType 2: Degate => 7, \nType 3: Punch => 8, \nType 4: B => 9, \nQuantity: 4 => 10, \nMin Quantity: 5 => 11, \nQuantity Per Set: 3 => 12, \nRemark: Need More This => 13', '2023-08-22 21:10:03'),
(81, 'admin', 'UPDATE', 'Updated the following fields:\nName: 1 => Super Cool Product Name  |  Product ID: 2 => A002', '2023-08-22 21:15:01'),
(82, 'admin', 'UPDATE', 'Updated the following fields:Type 4: 9 => A', '2023-08-22 21:16:06'),
(83, 'admin', 'CREATE', 'Created (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 )', '2023-08-22 21:18:11'),
(84, 'admin', 'UPDATE', 'Updated the following fields:Name: 1 => one   ,   Product ID: 2 => two   ,   Quantity: 10 => 9   ,   Min Quantity: 11 => 13', '2023-08-22 21:18:22'),
(85, 'admin', 'DELETE', 'Deleted (one, two, 3, 4, 5, 6, 7, 8, 9, 9, 13, 12, 13)', '2023-08-22 21:18:40'),
(86, 'admin', 'CREATE', 'Created (8, 8, 7, 9, 7, 9, 7, 9, 7, 9, 8, 8, 7 )', '2023-08-22 21:50:31'),
(87, 'admin', 'CREATE', 'Created (6, 6, 6, 6, 7, 6, 7, 6, 7, 6, 76, 7, 6 )', '2023-08-22 21:51:09'),
(88, 'admin', 'CREATE', 'Created (78, 78, 78, 98, 8, 8, 8, 78, 9, 8, 7, 89,  )', '2023-08-22 21:51:30'),
(89, 'admin', 'CREATE', 'Created (78, 78, 78, 98, 8, 8, 8, 78, 9, 8, 7, 89,  )', '2023-08-22 21:51:48'),
(90, 'admin', 'CREATE', 'Created (7, 8, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7 )', '2023-08-22 21:51:59'),
(91, 'admin', 'CREATE', 'Created (1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1 )', '2023-08-22 21:52:14'),
(92, 'admin', 'CREATE', 'Created (0, 0, 9, 0, 9, 0, 8, 9, 9, 9, 9, 9,  )', '2023-08-22 21:52:48'),
(93, 'admin', 'CREATE', 'Created (7, 7, 67, 6, 78, 78, 87, 7, 78, 78, 78, 78,  )', '2023-08-22 21:54:26'),
(94, 'admin', 'CREATE', 'Created (6, 67, 67, 67, 27, 878, 6, 8, 7, 7, 68, 2,  )', '2023-08-22 21:54:43'),
(95, 'admin', 'UPDATE', 'Updated the following fields:Quantity: 5 => 4', '2023-08-22 21:55:58'),
(96, 'admin', 'UPDATE', 'Updated the following fields:Quantity Per Set: 5 => 11', '2023-08-22 21:56:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`history_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
