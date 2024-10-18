-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 11:27 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agridivision`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `name`, `email`, `phone_number`, `province`, `password`, `regdate`) VALUES
(1, 'DA1', 'Department of Agriculture', 'deptagri@gmail.com', '(033) 333 1378', 'Iloilo', 'zxcvbnm', '2024-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_tech`
--

CREATE TABLE `brgy_tech` (
  `id` int(11) NOT NULL,
  `brgy_tech_id` varchar(100) NOT NULL,
  `municipal_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brgy_tech`
--

INSERT INTO `brgy_tech` (`id`, `brgy_tech_id`, `municipal_id`, `name`, `province`, `municipality`, `barangay`, `email`, `phone`, `password`, `regdate`) VALUES
(1, 'BT1', 'MA9', 'Adcadarao Barangay Technician', 'Iloilo', 'Ajuy', 'Adcadarao', 'charlesagustin.monreal@wvsu.edu.ph', '09667137186', 'zxcvbnm', '2024-01-09'),
(2, 'BT2', 'MA31', 'Botong Barangay Technician', 'Iloilo', 'Badiangan', 'Botong', 'botong.brgy@gmail.com', '09667137186', 'BadBot', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `business_owner`
--

CREATE TABLE `business_owner` (
  `id` int(11) NOT NULL,
  `business_id` varchar(100) NOT NULL,
  `business_fname` varchar(100) NOT NULL,
  `business_mname` varchar(100) NOT NULL,
  `business_lname` varchar(100) NOT NULL,
  `business_gender` varchar(100) NOT NULL,
  `business_email` varchar(100) NOT NULL,
  `business_phone` varchar(100) NOT NULL,
  `business_permit` varchar(100) NOT NULL,
  `business_province` varchar(100) NOT NULL,
  `business_municipality` varchar(100) NOT NULL,
  `business_barangay` varchar(100) NOT NULL,
  `business_street` varchar(100) NOT NULL,
  `business_dob` date NOT NULL,
  `business_latitude` float NOT NULL,
  `business_longitude` float NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_owner`
--

INSERT INTO `business_owner` (`id`, `business_id`, `business_fname`, `business_mname`, `business_lname`, `business_gender`, `business_email`, `business_phone`, `business_permit`, `business_province`, `business_municipality`, `business_barangay`, `business_street`, `business_dob`, `business_latitude`, `business_longitude`, `commodity_id`, `commodity_name`, `password`, `date`) VALUES
(1, 'BO1', 'Charles Agustin', 'Callado', 'Monreal', 'Male', 'charles@gmail.com', '09667137186', '213321', 'Iloilo', 'Miagao', 'Baybay Sur', '', '0000-00-00', 10.7048, 122.562, 'CM1, CM2', 'Corn, Coffee', 'zxcvbnm', '2024-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `commodity`
--

CREATE TABLE `commodity` (
  `id` int(11) NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `commodity_variant` varchar(100) NOT NULL,
  `pricing` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commodity`
--

INSERT INTO `commodity` (`id`, `commodity_id`, `commodity_name`, `commodity_variant`, `pricing`) VALUES
(1, 'CM1', 'Corn', 'Dent Corn', 35.95),
(2, 'CM2', 'Coffee', 'Robusta', 780),
(3, 'CM3', 'Coconut', 'Golden Malay', 240.89);

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `id` int(11) NOT NULL,
  `farm_id` varchar(100) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `farm_area` float NOT NULL,
  `ancestral_domain` varchar(100) NOT NULL,
  `farm_document_no` varchar(100) NOT NULL,
  `agrarian_beneficiary` varchar(100) NOT NULL,
  `ownership_type` varchar(100) NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `farm_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`id`, `farm_id`, `farmer_id`, `farm_area`, `ancestral_domain`, `farm_document_no`, `agrarian_beneficiary`, `ownership_type`, `commodity_id`, `commodity_name`, `farm_type`) VALUES
(1, 'F1', 'FM1', 4, 'Yes', '23232', 'Yes', 'Tenant', 'CM1, CM2', 'Corn, Coffee', 'Irrigated');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `id` int(11) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `brgy_tech_id` varchar(100) NOT NULL,
  `rsbsanum` varchar(100) NOT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `civil_status` varchar(100) DEFAULT NULL,
  `mother_lname` varchar(100) DEFAULT NULL,
  `mother_fname` varchar(100) DEFAULT NULL,
  `mother_mname` varchar(100) DEFAULT NULL,
  `household_head` varchar(100) DEFAULT NULL,
  `household_head_name` varchar(100) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `household_members` varchar(100) DEFAULT NULL,
  `household_male` varchar(100) DEFAULT NULL,
  `household_female` varchar(100) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `disability` varchar(100) DEFAULT NULL,
  `beneficiary` varchar(100) DEFAULT NULL,
  `indigenous` varchar(100) DEFAULT NULL,
  `indigenous_group` varchar(100) DEFAULT NULL,
  `government_id` varchar(100) DEFAULT NULL,
  `id_type` varchar(100) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `farmer_association` varchar(100) DEFAULT NULL,
  `association_name` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_person_phone` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `livelihood` varchar(100) NOT NULL,
  `regdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`id`, `farmer_id`, `brgy_tech_id`, `rsbsanum`, `lname`, `fname`, `mname`, `extension`, `gender`, `house`, `street`, `barangay`, `province`, `municipality`, `latitude`, `longitude`, `phone`, `email`, `dob`, `religion`, `civil_status`, `mother_lname`, `mother_fname`, `mother_mname`, `household_head`, `household_head_name`, `relationship`, `household_members`, `household_male`, `household_female`, `education`, `disability`, `beneficiary`, `indigenous`, `indigenous_group`, `government_id`, `id_type`, `id_number`, `farmer_association`, `association_name`, `contact_person`, `contact_person_phone`, `password`, `livelihood`, `regdate`) VALUES
(1, 'FM1', 'BT1', '323232', 'Monreal', 'Charles Agustin', 'Callado', 'None', 'Male', '', 'Hinolan Street', 'Adcadarao', 'Iloilo', 'Ajuy', 11.213, 123.014, '09667137186', 'charlesagustin@gmail.com', '2024-01-11', 'Roman Catholic', 'Single', 'Tomesa', 'Angel', 'Ann', 'Yes', '', '', '4', '2', '2', 'Pre-school', 'Yes', 'Yes', 'No', '', 'No', '', '', 'No', '', 'Charles Agustin Callado Monreal', '09667137186', 'CHAMON202', '', '2024-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `market_id` varchar(100) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_province` varchar(100) NOT NULL,
  `farmer_municipality` varchar(100) NOT NULL,
  `farmer_barangay` varchar(100) NOT NULL,
  `farmer_lat` varchar(100) NOT NULL,
  `farmer_long` varchar(100) NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `commodity_price` float NOT NULL,
  `commodity_quantity` float NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `market_id`, `farmer_id`, `farmer_fname`, `farmer_lname`, `farmer_province`, `farmer_municipality`, `farmer_barangay`, `farmer_lat`, `farmer_long`, `commodity_id`, `commodity_name`, `commodity_price`, `commodity_quantity`, `phone_number`, `description`, `image_name`, `date`) VALUES
(5, 'M5', 'FM1', 'Charles Agustin', 'Monreal', 'Iloilo', 'Ajuy', 'Adcadarao', '11.213', '123.014', 'CM1', 'Corn', 100, 284, '09667137186', 'aaaaa', 'Charles AgustinMonreal_1706695122_8891.jpg', '2024-01-31'),
(6, 'M6', 'FM1', 'Charles Agustin', 'Monreal', 'Iloilo', 'Ajuy', 'Adcadarao', '10.6705', '122.1973', 'CM2', 'Coffee', 200, 281, '09667137186', '', 'Charles AgustinMonreal_1706696067_8352.jpg', '2024-01-31'),
(8, 'M8', 'FM1', 'Charles Agustin', 'Monreal', 'Iloilo', 'Ajuy', 'Adcadarao', '11.213', '123.014', 'CM2', 'Coffee', 30, 288, '09667137186', '', 'Charles AgustinMonreal_1706848316_4050.jpg', '2024-02-02'),
(12, 'M12', 'FM1', 'Charles Agustin', 'Monreal', 'Iloilo', 'Oton', 'Poblacion East', '10.7240', '122.4563', 'CM2', 'Coffee', 30, 224, '09667137186', '', 'Charles AgustinMonreal_1706848316_4050.jpg', '2024-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `municipal_agriculturist`
--

CREATE TABLE `municipal_agriculturist` (
  `id` int(11) NOT NULL,
  `municipal_id` varchar(100) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `municipal_agriculturist`
--

INSERT INTO `municipal_agriculturist` (`id`, `municipal_id`, `admin_id`, `name`, `province`, `municipality`, `email`, `phone`, `password`, `regdate`) VALUES
(9, 'MA9', '1', 'Ajuy Municipal Agriculturist', 'Iloilo', 'Ajuy', 'charlesagustin.monreal@gmail.com', '09667137186', 'zxcvbnm', '2024-01-08'),
(31, 'MA31', 'DA1', 'Badiangan Municipal Agriculturist', 'Iloilo', 'Badiangan', 'badiangan.agri@gmail.com', '09667137186', 'IloBad', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `production_id` varchar(100) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_latitude` varchar(100) NOT NULL,
  `farmer_longitude` varchar(100) NOT NULL,
  `farmer_province` varchar(100) NOT NULL,
  `farmer_municipality` varchar(100) NOT NULL,
  `farmer_barangay` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `production_id`, `farmer_id`, `commodity_id`, `commodity_name`, `farmer_fname`, `farmer_lname`, `farmer_latitude`, `farmer_longitude`, `farmer_province`, `farmer_municipality`, `farmer_barangay`, `amount`) VALUES
(20, 'P20', 'FM1', 'CM1', 'Corn', 'Charles Agustin', 'Monreal', '11.213', '123.014', 'Iloilo', 'Ajuy', 'Adcadarao', 100);

-- --------------------------------------------------------

--
-- Table structure for table `total_production`
--

CREATE TABLE `total_production` (
  `id` int(11) NOT NULL,
  `production_id` varchar(100) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `farmer_province` varchar(100) NOT NULL,
  `farmer_municipality` varchar(100) NOT NULL,
  `farmer_barangay` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_production`
--

INSERT INTO `total_production` (`id`, `production_id`, `farmer_id`, `commodity_id`, `commodity_name`, `farmer_province`, `farmer_municipality`, `farmer_barangay`, `amount`, `date`) VALUES
(53, 'TP53', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 3, '2024-02-04'),
(54, 'TP54', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 5, '2024-02-04'),
(55, 'TP55', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 40, '2024-02-04'),
(56, 'TP56', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 50, '2024-02-04'),
(57, 'TP57', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 50, '2024-02-04'),
(58, 'TP58', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 20, '2024-02-04'),
(59, 'TP59', 'FM1', 'CM1', 'Coffee', 'Iloilo', 'Ajuy', 'Adcadarao', 70, '2024-02-04'),
(60, 'TP60', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 60, '2024-02-04'),
(61, 'TP61', 'FM1', 'CM1', 'Corn', 'Iloilo', 'Ajuy', 'Adcadarao', 100, '2024-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `market_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `commodity_id` varchar(100) NOT NULL,
  `commodity_name` varchar(100) NOT NULL,
  `farmer_id` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_province` varchar(100) NOT NULL,
  `farmer_municipality` varchar(100) NOT NULL,
  `farmer_barangay` varchar(100) NOT NULL,
  `commodity_quantity` int(11) NOT NULL,
  `commodity_price` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `business_id` varchar(100) NOT NULL,
  `business_fname` varchar(100) NOT NULL,
  `business_lname` varchar(100) NOT NULL,
  `business_latitude` float NOT NULL,
  `business_longitude` float NOT NULL,
  `amount_purchase` int(11) NOT NULL,
  `spent_amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_id`, `market_id`, `status`, `commodity_id`, `commodity_name`, `farmer_id`, `farmer_fname`, `farmer_lname`, `farmer_province`, `farmer_municipality`, `farmer_barangay`, `commodity_quantity`, `commodity_price`, `description`, `business_id`, `business_fname`, `business_lname`, `business_latitude`, `business_longitude`, `amount_purchase`, `spent_amount`, `date`) VALUES
(45, 'TR45', 'M5', 'Pending', 'CM1', 'Corn', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 286, 100, 'aaaaa', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 2, 200, '2024-02-03'),
(46, 'TR46', 'M6', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 288, 200, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 2, 400, '2024-02-03'),
(47, 'TR47', 'M12', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 288, 30, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 55, 1650, '2023-02-16'),
(50, 'TR50', 'M6', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 286, 200, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 2, 400, '2024-02-03'),
(51, 'TR51', 'M12', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 229, 30, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 2, 60, '2024-02-03'),
(52, 'TR52', 'M12', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 227, 30, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 1, 30, '2024-02-03'),
(53, 'TR53', 'M12', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', '', '', '', 226, 30, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 2, 60, '2024-02-03'),
(54, 'TR54', 'M6', 'Pending', 'CM2', 'Coffee', 'FM1', 'Charles Agustin', 'Monreal', 'Iloilo', 'Ajuy', 'Adcadarao', 284, 200, '', 'BO1', 'Charles Agustin', 'Monreal', 10.7048, 122.562, 3, 600, '2024-02-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brgy_tech`
--
ALTER TABLE `brgy_tech`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_owner`
--
ALTER TABLE `business_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipal_agriculturist`
--
ALTER TABLE `municipal_agriculturist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_production`
--
ALTER TABLE `total_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brgy_tech`
--
ALTER TABLE `brgy_tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_owner`
--
ALTER TABLE `business_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commodity`
--
ALTER TABLE `commodity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farm`
--
ALTER TABLE `farm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `municipal_agriculturist`
--
ALTER TABLE `municipal_agriculturist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `total_production`
--
ALTER TABLE `total_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
