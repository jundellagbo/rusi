-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 07:14 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dealers`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `account_id` varchar(100) NOT NULL,
  `model_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `terms` varchar(100) NOT NULL,
  `monthly_installment` decimal(10,2) NOT NULL,
  `totalpaid` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `contract_price` decimal(10,2) NOT NULL,
  `months` int(11) NOT NULL,
  `datepayment` date NOT NULL,
  `downpayment` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_id`, `model_id`, `status`, `terms`, `monthly_installment`, `totalpaid`, `deposit`, `rebate`, `contract_price`, `months`, `datepayment`, `downpayment`) VALUES
(1, 'CUSTOMERID-BLWROM1WT', '1', 'current', '12', '6466.67', '9466.67', '0.00', '0.00', '80600.00', 1, '2016-04-09', 3000.00),
(2, 'CUSTOMERID-15EE300CK', '7', 'current', '12', '8883.33', '31649.99', '1116.67', '0.00', '111600.00', 3, '2016-03-31', 5000.00),
(3, 'CUSTOMERID-NEHSL1XN5', '', 'open', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0000-00-00', 0.00),
(4, 'CUSTOMERID-SZAHY5GZF', '', 'open', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0000-00-00', 0.00),
(5, 'CUSTOMERID-JYX2MD1FL', '', 'open', '', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0000-00-00', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `account_history`
--

CREATE TABLE `account_history` (
  `account_id` varchar(100) NOT NULL,
  `stock_id` varchar(100) NOT NULL,
  `date_transaction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'kymco');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `model_name` text NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customerlists`
--

CREATE TABLE `customerlists` (
  `id` int(11) NOT NULL,
  `customerid` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `tin` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerlists`
--

INSERT INTO `customerlists` (`id`, `customerid`, `firstname`, `middlename`, `lastname`, `tin`, `address`, `contact`, `profile`) VALUES
(1, 'CUSTOMERID-BLWROM1WT', 'misa', 'shalou', 'ragasi', '0987654321', 'aclc mandaue', '0987654321', ''),
(2, 'CUSTOMERID-15EE300CK', 'hala', 'haha', 'lala', '0987654321', 'aclc', '0987654321', ''),
(3, 'CUSTOMERID-NEHSL1XN5', 'hhh', 'uuu', 'uu', 'uuu', 'uuu', '868', ''),
(4, 'CUSTOMERID-SZAHY5GZF', 'hhh', 'hhhh', 'hh', 'hh', 'uuhuhuhu', '988888898989', ''),
(5, 'CUSTOMERID-JYX2MD1FL', 'AKJDHAWD', 'HAKJWD', 'DAHWDKJAD', 'DAKJWHD', 'AWJDHAWD', '123', '<p>AWDHAKJWDHKJ</p>');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `categoryid` varchar(20) NOT NULL,
  `modelid` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `chassis` varchar(50) NOT NULL,
  `enginenumber` varchar(50) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `activityid` int(11) NOT NULL,
  `activity` text NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`activityid`, `activity`, `user_id`, `date`) VALUES
(1, 'SALES INVOICE CREATED: GK4384F3J3J3DJ3 ', 'admin', '2016-04-09 08:50:40'),
(2, 'SALES INVOICE CREATED: DJVNKD23FHJHF ', 'admin', '2016-03-31 05:53:56'),
(3, 'ADDING USERS: test ', 'admin', '2016-04-16 08:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `category_name`, `model_name`, `price`, `downpayment`) VALUES
(1, 'KYMCO', 'super125', '65000.00', '2500.00'),
(2, 'KYMCO', 'super110', '75000.00', '2500.00'),
(3, 'KYMCO', 'super120', '45000.00', '2000.00'),
(4, 'KYMCO', 'super150', '90000.00', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `penalty_rate` decimal(10,2) NOT NULL,
  `id` int(11) NOT NULL,
  `monthly_rate` decimal(10,2) NOT NULL,
  `addons` decimal(10,2) NOT NULL,
  `rebate_rate` decimal(10,2) NOT NULL,
  `extend_days` int(11) NOT NULL,
  `months_notify` int(11) NOT NULL,
  `lcp_rate` decimal(10,2) NOT NULL,
  `constant_rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`penalty_rate`, `id`, `monthly_rate`, `addons`, `rebate_rate`, `extend_days`, `months_notify`, `lcp_rate`, `constant_rate`) VALUES
('0.05', 1, '0.02', '0.00', '300.00', 0, 0, '0.10', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `sold_items`
--

CREATE TABLE `sold_items` (
  `id` int(11) NOT NULL,
  `transid` varchar(111) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `engine` varchar(100) NOT NULL,
  `chassis` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(100) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold_items`
--

INSERT INTO `sold_items` (`id`, `transid`, `customer_id`, `type`, `category_name`, `model_name`, `engine`, `chassis`, `price`, `color`, `note`) VALUES
(1, 'CLT-PL63TD20R', 'CUSTOMERID-BLWROM1WT', 'terms', 'kymco', 'super125', 'GK4384F3J3J3DJ3', 'FK2H32JH2J3H23', '0.00', '', ''),
(2, 'CLT-YQM2GBUDF', 'CUSTOMERID-15EE300CK', 'terms', 'kymco', 'super150', 'DJVNKD23FHJHF', 'ADH123H123H', '0.00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `model_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `model_name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  `color` varchar(100) NOT NULL,
  `engine_number` varchar(30) NOT NULL,
  `chassis` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='stocks';

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`model_id`, `category_name`, `model_name`, `price`, `downpayment`, `color`, `engine_number`, `chassis`, `status`, `branch`) VALUES
(1, 'kymco', 'super125', '65000.00', '2500.00', 'RED', 'GK4384F3J3J3DJ3', 'FK2H32JH2J3H23', 'sold', 'Mandaue'),
(2, 'kymco', 'super125', '65000.00', '2500.00', 'MAROON', 'KA3HDH2SAHJH3', 'H3J2KDHJ2J3', 'new', 'Mandaue'),
(3, 'kymco', 'super125', '65000.00', '2500.00', 'BLUE', 'ASN3JFBKJBQ2JH3G', 'AHDH2HD3J3GDG', 'new', 'Mandaue'),
(4, 'kymco', 'super125', '65000.00', '2500.00', 'BLACK', 'JFH2DH34HEJDH3H3', 'DJFJ3UEGFDG', 'new', 'Mandaue'),
(5, 'kymco', 'super110', '75000.00', '2500.00', 'GRAY', 'DAN1J2H3H', 'DAH2KWDH3', 'new', 'Mandaue'),
(6, 'kymco', 'super110', '75000.00', '2500.00', 'ORANGE', 'ASDH12H3DHDK2', 'DH2D2K4J5FJ', 'new', 'Mandaue'),
(7, 'kymco', 'super150', '90000.00', '5000.00', 'WHITE/BLACK', 'DJVNKD23FHJHF', 'ADH123H123H', 'sold', 'Liloan'),
(8, 'kymco', 'super110', '75000.00', '2500.00', 'BLUE/WHITE', 'FH23KF3HFHJ3H4', 'DJ3FJMDLORR2', 'new', 'Liloan'),
(9, 'kymco', 'super110', '75000.00', '2500.00', 'WHITE/RED', 'HRYVIWJ123HFKJF', 'FASFHJK23HAHKJ23', 'new', 'Mandaue'),
(10, 'kymco', 'super120', '45000.00', '2000.00', 'RED/ORANGE/BLACK', 'AWDH123DH', '123ASHDKAJHE1', 'new', 'Mandaue'),
(11, 'kymco', 'super125', '65000.00', '2500.00', 'KAKY', 'DH123HJASDJH123', 'ZXBQ3GASFG4', 'new', 'Mandaue'),
(12, 'kymco', 'super125', '65000.00', '2500.00', 'RED', 'ADKJASHJDKHASD', 'AHSDJKHASD', 'new', 'Mandaue');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `model_id` varchar(100) NOT NULL,
  `datepayment` date NOT NULL,
  `total_paid` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rebate` double(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `due_date` date NOT NULL,
  `months` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trans_id`, `customerid`, `model_id`, `datepayment`, `total_paid`, `amount`, `rebate`, `deposit`, `penalty`, `user_id`, `branch`, `due_date`, `months`) VALUES
(1, 'CLT-PL63TD20R', 'CUSTOMERID-BLWROM1WT', '1', '2016-04-09', '3000.00', '3000.00', 0.00, '0.00', '0.00', 'admin', 'any', '0000-00-00', 0),
(2, 'CLT-DBZAC', 'CUSTOMERID-BLWROM1WT', '1', '2016-04-09', '6466.67', '6466.67', 300.00, '0.00', '0.00', 'admin', 'any', '2016-05-09', 1),
(3, 'CLT-YQM2GBUDF', 'CUSTOMERID-15EE300CK', '7', '2016-03-31', '5000.00', '5000.00', 0.00, '0.00', '0.00', 'admin', 'any', '0000-00-00', 0),
(4, 'CLT-Y2RNI', 'CUSTOMERID-15EE300CK', '7', '2016-03-31', '8883.33', '10000.00', 300.00, '0.00', '0.00', 'admin', 'any', '2016-04-30', 1),
(5, 'CLT-YCYMD', 'CUSTOMERID-15EE300CK', '7', '2016-03-31', '8883.33', '10000.00', 300.00, '0.00', '0.00', 'admin', 'any', '2016-05-31', 1),
(6, 'CLT-MVGMW', 'CUSTOMERID-15EE300CK', '7', '2016-03-31', '8883.33', '10000.00', 300.00, '1116.67', '0.00', 'admin', 'any', '2016-06-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `contact`, `picture`, `type`, `status`, `branchid`) VALUES
(1, 'admin', 'admin', 'Fejie', 'Sorono', 'Fariolen', '09322324465', '', 'Administrator', 'active', 'any'),
(2, 'andie', 'andie123', 'Shalou', 'Ragasi', 'Misa', '09322324571', '', 'Accounting', 'active', 'Mandaue'),
(3, 'genufuk', '123123', 'fejie', 'sorono', 'fariolen', '01239010239', '', 'Branch Manager', 'active', 'Liloan'),
(4, 'kathryn_bree', '123456', 'Kathryn', 'chan', 'Bernado', '0932736721', '', 'Accounting', 'active', 'Mandaue'),
(5, 'test', 'testing', 'test77', 'test', 'test', '123456789', '', 'Branch Manager', 'not active', 'Mandaue');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerlists`
--
ALTER TABLE `customerlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`activityid`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold_items`
--
ALTER TABLE `sold_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customerlists`
--
ALTER TABLE `customerlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `activityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sold_items`
--
ALTER TABLE `sold_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
