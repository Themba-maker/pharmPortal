-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2019 at 11:29 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblitems`
--

CREATE TABLE `tblitems` (
  `item_id` int(11) NOT NULL,
  `shop` varchar(300) NOT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblitems`
--

INSERT INTO `tblitems` (`item_id`, `shop`, `category`, `name`, `price`) VALUES
(7, 'shoprite', 'food', 'Bread', '300');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE `tbllogin` (
  `login_id` int(11) NOT NULL,
  `fk_studentNumber` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`login_id`, `fk_studentNumber`, `password`, `role`, `status`) VALUES
(2, '212274828', '$2y$10$Caf66JzbwJODx0/VlK.bR.1eEE1F/fZWs0NEtKLbVRLnSf7R4feXe', 'admin', 'Active'),
(12, '123444444', '$2y$10$WUEsXCv1UAfA3P2wXiBDwe6vgrL6E.8hFkVpCo1fUkTGOeteoPyNa', 'admin', 'Active'),
(19, '212274888', '$2y$10$/Tsrn0ueVv9VpXYXVEAjsO3YMaaJiLfjNkhOPUP2DeT/9ysObt5dq', 'Student', 'Active'),
(21, '21611', '$2y$10$t975lORWPQAFY0PYA818COxAOGph5iLV0G45p5N4RzrzT.m.e9M7u', 'admin', 'Active'),
(23, '212274823', '$2y$10$8eZmZAzzInkgwxOKIlDWz.wb4zVNMmAJh8RuLsBkxq1m6MG7qIPiG', 'Student', 'Active'),
(24, '21227', '$2y$10$4jiuwbsyJt1ESfGX9lGBzuyTsKTl.uAsPb/hsy7paL6jhIq7H6XT2', '', 'Active'),
(25, '56678', '$2y$10$TXotJfzd3PvCC03YwbwAfuyooBht024HF3.OxgXez0wJ4avhpMkpy', 'admin', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentaccount`
--

CREATE TABLE `tblstudentaccount` (
  `studentAccount_id` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `fk_studentNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudentaccount`
--

INSERT INTO `tblstudentaccount` (`studentAccount_id`, `month`, `amount`, `fk_studentNumber`) VALUES
(31, 'Jun-2019', '2000.00', '123444444'),
(32, 'Jul-2019', '600', '212274888'),
(35, 'Aug-2019', '700.00', '123444444'),
(36, 'Aug-2019', '700.00', '212274888'),
(38, 'Aug-2019', '700.00', '21611'),
(39, 'Aug-2019', '700.00', '212274823'),
(40, 'Sep-2019', '100.00', '123444444'),
(41, 'Sep-2019', '1790', '212274888'),
(43, 'Sep-2019', '100.00', '21611'),
(44, 'Sep-2019', '100.00', '212274823'),
(45, 'Oct-2019', '700.00', '123444444'),
(46, 'Oct-2019', '600', '212274888'),
(47, 'Oct-2019', '700.00', '21611'),
(48, 'Oct-2019', '700.00', '212274823'),
(52, 'Oct-2019', '500.00', '212274828');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE `tbltransaction` (
  `transaction_id` int(11) NOT NULL,
  `fk_studentNumber` varchar(14) NOT NULL,
  `category` varchar(100) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `month` varchar(50) NOT NULL,
  `purchaseDate` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransaction`
--

INSERT INTO `tbltransaction` (`transaction_id`, `fk_studentNumber`, `category`, `itemName`, `price`, `month`, `purchaseDate`, `qty`) VALUES
(21, '212274888', 'food', 'Bread', '10', 'Sep-2019', 'Thu-Sep-2019', 3),
(22, '212274888', 'food', 'Bread', '300', 'Oct-2019', 'Thu-Oct-2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `fk_studentNumber` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `cellNumber` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `fk_studentNumber`, `name`, `lastname`, `cellNumber`, `email`, `dob`) VALUES
(2, '212274828', 'Ntshuxeko', 'Mabasa', '0788461928', 'n@gmail.com', ''),
(12, '123444444', 'Josh', 'Test', '0909999999', 'test@gmail.com', ''),
(19, '212274888', 'Ntshuxeko', 'Mabasa', '0999999999', 'test@gmail.com', ''),
(21, '21611', 'hlophego', 'seomana', '0796251455', 'hluphi@gmail.com', ''),
(23, '212274823', 'Joshua', 'Mabasa', '0788461928', 'test@gmail.com', '1994-04-04'),
(24, '21227', 'Test', '0999998888', 'test@gmaai', 'abcde', 'Test'),
(25, '56678', 'Ntshuxeko', 'Mabasa', '0999998888', 'nm@gmail.com', '2019-10-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblitems`
--
ALTER TABLE `tblitems`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbllogin`
--
ALTER TABLE `tbllogin`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tblstudentaccount`
--
ALTER TABLE `tblstudentaccount`
  ADD PRIMARY KEY (`studentAccount_id`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblitems`
--
ALTER TABLE `tblitems`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbllogin`
--
ALTER TABLE `tbllogin`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblstudentaccount`
--
ALTER TABLE `tblstudentaccount`
  MODIFY `studentAccount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
