-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 06:28 AM
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
-- Database: `agri_division`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `num` int(100) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `mun` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `zip` int(50) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `profileimg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `num`, `prov`, `mun`, `brgy`, `street`, `longitude`, `latitude`, `zip`, `dob`, `password`, `profileimg`) VALUES
(1, 'Charles', 'Doe', 'john@gmail.com', 2147483647, 'Iloilo', 'Jaro', 'Buntatala', '', 122.585, 10.7683, 5000, '2001-08-11', 'zxcvbnm', 'ChaDoe20010811');

-- --------------------------------------------------------

--
-- Table structure for table `approved_transaction`
--

CREATE TABLE `approved_transaction` (
  `id` int(11) NOT NULL,
  `farmer_id` int(255) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_prov` varchar(200) NOT NULL,
  `farmer_mun` varchar(200) NOT NULL,
  `farmer_brgy` varchar(200) NOT NULL,
  `farmer_street` varchar(200) NOT NULL,
  `farmer_zip` int(50) NOT NULL,
  `farmer_longitude` float NOT NULL,
  `farmer_latitude` float NOT NULL,
  `business_id` int(255) NOT NULL,
  `business_fname` varchar(100) NOT NULL,
  `business_lname` varchar(100) NOT NULL,
  `business_prov` varchar(200) NOT NULL,
  `business_mun` varchar(200) NOT NULL,
  `business_brgy` varchar(200) NOT NULL,
  `business_street` varchar(200) NOT NULL,
  `business_zip` int(50) NOT NULL,
  `business_longitude` float NOT NULL,
  `business_latitude` float NOT NULL,
  `crop` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `price` double NOT NULL,
  `amount_buy` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approved_transaction`
--

INSERT INTO `approved_transaction` (`id`, `farmer_id`, `farmer_lname`, `farmer_fname`, `farmer_prov`, `farmer_mun`, `farmer_brgy`, `farmer_street`, `farmer_zip`, `farmer_longitude`, `farmer_latitude`, `business_id`, `business_fname`, `business_lname`, `business_prov`, `business_mun`, `business_brgy`, `business_street`, `business_zip`, `business_longitude`, `business_latitude`, `crop`, `amount`, `price`, `amount_buy`, `date`) VALUES
(21, 14, 'Trinidad', 'Royce Emmanuel', 'Iloilo', 'Miagao', 'Baybay Sur', 'Hinolan Street', 5023, 122.235, 10.64, 60, 'Angelica', 'Ortega', 'Iloilo', 'Tigbauan', 'Buyu-an', '', 5021, 122.353, 10.6748, 'Corn', 200, 50, 1, '2024-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_tech`
--

CREATE TABLE `brgy_tech` (
  `id` int(11) NOT NULL,
  `municipal_agriculturist_id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `num` int(100) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `mun` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `zip` int(50) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `profileimg` varchar(100) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brgy_tech`
--

INSERT INTO `brgy_tech` (`id`, `municipal_agriculturist_id`, `fname`, `lname`, `email`, `num`, `prov`, `mun`, `brgy`, `street`, `longitude`, `latitude`, `zip`, `dob`, `password`, `profileimg`, `regdate`) VALUES
(2, 0, 'Adrianne Blu', 'Sanchez', 'adrian@gmail.com', 2132321, 'Iloilo', 'Lapaz', 'Lapuz Norte', '', 122.58, 10.6981, 5000, '2001-12-19', 'zxcvbnm', 'AdrSan20011219', '2023-12-22'),
(3, 6, 'Humphrey', 'Callado', 'humphrey@gmail.com', 323232, 'Iloilo', 'Miagao', 'Baybay Sur', '', 122.236, 10.6384, 5023, '2024-01-03', 'zxcvbnm', 'HumCal20240103', '2024-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `business_owner`
--

CREATE TABLE `business_owner` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `num` int(50) NOT NULL,
  `busspermit` int(100) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `mun` varchar(50) NOT NULL,
  `brgy` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `password` varchar(50) NOT NULL,
  `profileimg` varchar(200) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_owner`
--

INSERT INTO `business_owner` (`id`, `fname`, `lname`, `email`, `num`, `busspermit`, `crop`, `prov`, `mun`, `brgy`, `street`, `zip`, `dob`, `longitude`, `latitude`, `password`, `profileimg`, `regdate`) VALUES
(60, 'Angelica', 'Ortega', 'angel@gmail.com', 2424324, 1321323, 'Corn', 'Iloilo', 'Miagao', 'Baybay Sur', '', '5021', '2001-11-28', 122.353, 10.6748, 'zxcvbnm', 'AngOrt20011128', '2023-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `business_stocks`
--

CREATE TABLE `business_stocks` (
  `id` int(255) NOT NULL,
  `business_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `crop` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_stocks`
--

INSERT INTO `business_stocks` (`id`, `business_id`, `fname`, `lname`, `crop`, `amount`, `date`) VALUES
(2, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-04'),
(3, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-07'),
(4, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-04'),
(5, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-07'),
(6, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-07'),
(7, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-07'),
(8, 60, 'Angelica', 'Ortega', 'Corn', 4, '2023-12-07'),
(9, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-19'),
(10, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-19'),
(11, 60, 'Angelica', 'Ortega', 'Corn', 1, '2023-12-19'),
(12, 60, 'Angelica', 'Ortega', 'Corn', 50, '2024-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `coconut_data`
--

CREATE TABLE `coconut_data` (
  `id` int(255) NOT NULL,
  `Jan` double NOT NULL,
  `Feb` double NOT NULL,
  `Mar` double NOT NULL,
  `Apr` double NOT NULL,
  `May` double NOT NULL,
  `Jun` double NOT NULL,
  `Jul` double NOT NULL,
  `Aug` double NOT NULL,
  `Sep` double NOT NULL,
  `Oct` double NOT NULL,
  `Nov` double NOT NULL,
  `Dec` double NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coconut_data`
--

INSERT INTO `coconut_data` (`id`, `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`, `Year`) VALUES
(1, 77, 88, 63, 80, 76, 90, 94, 65, 83, 71, 81, 76, 2022),
(2, 85, 81, 83, 85, 82, 74, 93, 68, 61, 76, 94, 71, 2021),
(3, 80, 77, 84, 81, 69, 76, 98, 94, 71, 71, 68, 83, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `coffee_data`
--

CREATE TABLE `coffee_data` (
  `id` int(255) NOT NULL,
  `Jan` double NOT NULL,
  `Feb` double NOT NULL,
  `Mar` double NOT NULL,
  `Apr` double NOT NULL,
  `May` double NOT NULL,
  `Jun` double NOT NULL,
  `Jul` double NOT NULL,
  `Aug` double NOT NULL,
  `Sep` double NOT NULL,
  `Oct` double NOT NULL,
  `Nov` double NOT NULL,
  `Dec` double NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coffee_data`
--

INSERT INTO `coffee_data` (`id`, `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`, `Year`) VALUES
(1, 87, 58, 87, 62, 61, 55, 69, 60, 60, 64, 56, 58, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `corn_data`
--

CREATE TABLE `corn_data` (
  `id` int(255) NOT NULL,
  `Jan` double NOT NULL,
  `Feb` double NOT NULL,
  `Mar` double NOT NULL,
  `Apr` double NOT NULL,
  `May` double NOT NULL,
  `Jun` double NOT NULL,
  `Jul` double NOT NULL,
  `Aug` double NOT NULL,
  `Sep` double NOT NULL,
  `Oct` double NOT NULL,
  `Nov` double NOT NULL,
  `Dec` double NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corn_data`
--

INSERT INTO `corn_data` (`id`, `Jan`, `Feb`, `Mar`, `Apr`, `May`, `Jun`, `Jul`, `Aug`, `Sep`, `Oct`, `Nov`, `Dec`, `Year`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2024),
(1, 56, 79, 63, 78, 84, 75, 68, 61, 62, 67, 60, 63, 2022),
(2, 50, 79, 62, 79, 83, 76, 67, 61, 60, 68, 56, 62, 2021),
(3, 56, 79, 62, 72, 83, 77, 69, 60, 60, 68, 62, 68, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `crop_information`
--

CREATE TABLE `crop_information` (
  `id` int(11) NOT NULL,
  `farmer_id` int(255) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `prov` varchar(200) NOT NULL,
  `mun` varchar(200) NOT NULL,
  `brgy` varchar(200) NOT NULL,
  `street` varchar(200) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_information`
--

INSERT INTO `crop_information` (`id`, `farmer_id`, `farmer_fname`, `farmer_lname`, `crop`, `prov`, `mun`, `brgy`, `street`, `zip`, `longitude`, `latitude`, `price`, `amount`, `date`) VALUES
(34, 14, 'Royce Emmanuel', 'Trinidad', 'Corn', 'Iloilo', 'Miagao', 'Baybay Sur', '', '5023', 122.235, 10.64, 50, 149, '2024-01-06'),
(45, 14, 'Royce Emmanuel', 'Trinidad', 'Coffee', 'Iloilo', 'Miagao', 'Baybay Sur', '', '5023', 122.235, 10.64, 50, 100, '2024-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `declined_transaction`
--

CREATE TABLE `declined_transaction` (
  `id` int(11) NOT NULL,
  `farmer_id` int(255) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_prov` varchar(200) NOT NULL,
  `farmer_mun` varchar(200) NOT NULL,
  `farmer_brgy` varchar(200) NOT NULL,
  `farmer_street` varchar(200) NOT NULL,
  `farmer_zip` varchar(200) NOT NULL,
  `farmer_longitude` float NOT NULL,
  `farmer_latitude` float NOT NULL,
  `business_id` int(255) NOT NULL,
  `business_fname` varchar(100) NOT NULL,
  `business_lname` varchar(100) NOT NULL,
  `business_prov` varchar(200) NOT NULL,
  `business_mun` varchar(200) NOT NULL,
  `business_brgy` varchar(200) NOT NULL,
  `business_street` varchar(200) NOT NULL,
  `business_zip` varchar(200) NOT NULL,
  `business_longitude` float NOT NULL,
  `business_latitude` float NOT NULL,
  `crop` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `price` int(11) NOT NULL,
  `amount_buy` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `declined_transaction`
--

INSERT INTO `declined_transaction` (`id`, `farmer_id`, `farmer_lname`, `farmer_fname`, `farmer_prov`, `farmer_mun`, `farmer_brgy`, `farmer_street`, `farmer_zip`, `farmer_longitude`, `farmer_latitude`, `business_id`, `business_fname`, `business_lname`, `business_prov`, `business_mun`, `business_brgy`, `business_street`, `business_zip`, `business_longitude`, `business_latitude`, `crop`, `amount`, `price`, `amount_buy`, `date`) VALUES
(1, 14, 'Trinidad', 'Royce Emmanuel', 'Iloilo', 'Miagao', 'Baybay Sur', 'Hinolan Street', '5023', 122.235, 10.64, 60, 'Angelica', 'Ortega', 'Iloilo', 'Tigbauan', 'Buyu-an', '', '5021', 122.353, 10.6748, 'Corn', 80, 50, 30, '2023-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `done_transaction`
--

CREATE TABLE `done_transaction` (
  `id` int(11) NOT NULL,
  `farmer_id` int(255) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_prov` varchar(200) NOT NULL,
  `farmer_mun` varchar(200) NOT NULL,
  `farmer_brgy` varchar(200) NOT NULL,
  `farmer_street` varchar(200) NOT NULL,
  `farmer_zip` varchar(200) NOT NULL,
  `farmer_longitude` float NOT NULL,
  `farmer_latitude` float NOT NULL,
  `business_id` int(255) NOT NULL,
  `business_fname` varchar(100) NOT NULL,
  `business_lname` varchar(100) NOT NULL,
  `business_prov` varchar(200) NOT NULL,
  `business_mun` varchar(200) NOT NULL,
  `business_brgy` varchar(200) NOT NULL,
  `business_street` varchar(200) NOT NULL,
  `business_zip` varchar(200) NOT NULL,
  `business_longitude` float NOT NULL,
  `business_latitude` float NOT NULL,
  `crop` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `price` double NOT NULL,
  `amount_buy` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `done_transaction`
--

INSERT INTO `done_transaction` (`id`, `farmer_id`, `farmer_lname`, `farmer_fname`, `farmer_prov`, `farmer_mun`, `farmer_brgy`, `farmer_street`, `farmer_zip`, `farmer_longitude`, `farmer_latitude`, `business_id`, `business_fname`, `business_lname`, `business_prov`, `business_mun`, `business_brgy`, `business_street`, `business_zip`, `business_longitude`, `business_latitude`, `crop`, `amount`, `price`, `amount_buy`, `date`) VALUES
(16, 14, 'Trinidad', 'Royce Emmanuel', 'Iloilo', 'Miagao', 'Baybay Sur', 'Hinolan Street', '5023', 122.235, 10.64, 60, 'Angelica', 'Ortega', 'Iloilo', 'Tigbauan', 'Buyu-an', '', '5021', 122.353, 10.6748, 'Corn', 200, 50, 1, '2023-12-19'),
(17, 14, 'Trinidad', 'Royce Emmanuel', 'Iloilo', 'Miagao', 'Baybay Sur', 'Hinolan Street', '5023', 122.235, 10.64, 60, 'Angelica', 'Ortega', 'Iloilo', 'Tigbauan', 'Buyu-an', '', '5021', 122.353, 10.6748, 'Corn', 199, 50, 50, '2024-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `id` int(11) NOT NULL,
  `brgy_tech_id` int(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `num` int(50) NOT NULL,
  `rsbsanum` int(100) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `prov` varchar(50) NOT NULL,
  `mun` varchar(50) NOT NULL,
  `brgy` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zip` int(50) NOT NULL,
  `dob` date NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `password` varchar(50) NOT NULL,
  `profileimg` varchar(100) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`id`, `brgy_tech_id`, `fname`, `lname`, `email`, `num`, `rsbsanum`, `crop`, `prov`, `mun`, `brgy`, `street`, `zip`, `dob`, `longitude`, `latitude`, `password`, `profileimg`, `regdate`) VALUES
(14, 0, 'Royce Emmanuel', 'Trinidad', 'royce@gmail.com', 1213131, 1313131313, 'Corn', 'Iloilo', 'Miagao', 'Baybay Sur', 'Hinolan Street', 5023, '2001-12-20', 122.235, 10.64, 'zxcvbnm', 'RoyTri20011220', '2023-10-05'),
(15, 2, 'Nichol John', 'Momblan', 'nichol@gmail.com', 23232, 3324322, 'Corn', 'Iloilo', 'Miagao', 'Baybay Sur', '', 5023, '2024-01-20', 122.236, 10.6384, 'zxcvbnm', 'NicMom20240120', '2024-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_stocks`
--

CREATE TABLE `farmer_stocks` (
  `id` int(11) NOT NULL,
  `farmer_id` int(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `crop` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer_stocks`
--

INSERT INTO `farmer_stocks` (`id`, `farmer_id`, `fname`, `lname`, `crop`, `amount`, `date`) VALUES
(20, 14, 'Royce Emmanuel', 'Trinidad', 'Corn', 110, '2023-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `municipal_agriculturist`
--

CREATE TABLE `municipal_agriculturist` (
  `id` int(11) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `num` varchar(100) NOT NULL,
  `prov` varchar(100) NOT NULL,
  `mun` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `zip` int(50) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `profileimg` varchar(100) NOT NULL,
  `regdate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `municipal_agriculturist`
--

INSERT INTO `municipal_agriculturist` (`id`, `admin_id`, `fname`, `lname`, `email`, `num`, `prov`, `mun`, `brgy`, `street`, `longitude`, `latitude`, `zip`, `dob`, `password`, `profileimg`, `regdate`) VALUES
(3, 0, 'Bryan Kyle', 'Fantilaga', 'bryan@gmail.com', '09561895614', 'Iloilo', 'Lapaz', 'Bo Obrero', '', 122.588, 10.6985, 5000, '2001-03-15', 'zxcvbnm', 'BryFan20010315', '2023-08-25'),
(4, 0, 'Andrea Joane', 'Agustin', 'andrea@gmail.com', '323212', 'Iloilo', 'Jaro', 'San Isidro', '', 122.547, 10.7394, 5000, '2001-11-17', 'zxcvbnm', 'AndAgu20011117', '2023-12-22'),
(5, 0, 'Charles Agustin', 'Monreal', 'charlesagustin.monreal@wvsu.edu.ph', '09667137186', 'Iloilo', 'Miagao', 'Baybay Sur', 'HINOLAN STREET', 122.235, 10.6397, 5023, '2024-01-04', 'zxcvbnm', 'ChaMon20240104', '2024-01-04'),
(6, 1, 'Chardine Marie', 'Monreal', 'chardine@gmail.com', '23232', 'Iloilo', 'Miagao', 'Baybay Sur', '', 122.236, 10.6384, 5023, '2024-01-04', 'zxcvbnm', 'ChaMon20240104', '2024-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `pending_transaction`
--

CREATE TABLE `pending_transaction` (
  `id` int(11) NOT NULL,
  `farmer_id` int(255) NOT NULL,
  `farmer_lname` varchar(100) NOT NULL,
  `farmer_fname` varchar(100) NOT NULL,
  `farmer_prov` varchar(200) NOT NULL,
  `farmer_mun` varchar(200) NOT NULL,
  `farmer_brgy` varchar(200) NOT NULL,
  `farmer_street` varchar(200) NOT NULL,
  `farmer_zip` varchar(200) NOT NULL,
  `farmer_longitude` float NOT NULL,
  `farmer_latitude` float NOT NULL,
  `business_id` int(255) NOT NULL,
  `business_fname` varchar(100) NOT NULL,
  `business_lname` varchar(100) NOT NULL,
  `business_prov` varchar(200) NOT NULL,
  `business_mun` varchar(200) NOT NULL,
  `business_brgy` varchar(200) NOT NULL,
  `business_street` varchar(200) NOT NULL,
  `business_zip` varchar(200) NOT NULL,
  `business_longitude` float NOT NULL,
  `business_latitude` float NOT NULL,
  `crop` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `price` double NOT NULL,
  `amount_buy` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `total_order`
--

CREATE TABLE `total_order` (
  `id` int(11) NOT NULL,
  `business_id` int(100) NOT NULL,
  `business_fname` varchar(255) NOT NULL,
  `business_lname` varchar(255) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `total_amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_order`
--

INSERT INTO `total_order` (`id`, `business_id`, `business_fname`, `business_lname`, `crop`, `total_amount`, `date`) VALUES
(5, 60, 'Angelica', 'Ortega', 'Corn', 52, '2023-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `total_stocks`
--

CREATE TABLE `total_stocks` (
  `id` int(11) NOT NULL,
  `farmer_id` varchar(255) NOT NULL,
  `farmer_fname` varchar(255) NOT NULL,
  `farmer_lname` varchar(255) NOT NULL,
  `crop` varchar(100) NOT NULL,
  `total_amount` double NOT NULL,
  `farmer_prov` varchar(255) NOT NULL,
  `farmer_mun` varchar(255) NOT NULL,
  `farmer_brgy` varchar(255) NOT NULL,
  `farmer_street` varchar(255) NOT NULL,
  `farmer_zip` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_stocks`
--

INSERT INTO `total_stocks` (`id`, `farmer_id`, `farmer_fname`, `farmer_lname`, `crop`, `total_amount`, `farmer_prov`, `farmer_mun`, `farmer_brgy`, `farmer_street`, `farmer_zip`, `date`) VALUES
(10, '14', 'Royce Emmanuel', 'Trinidad', 'Corn', 300, 'Iloilo', 'Lapaz', 'Lapuz Norte', 'Hinolan Street', '5023', '2024-01-13'),
(11, '15', 'Awaw', 'Trinidad', 'Coffee', 300, 'Iloilo', 'Miagao', 'Lapuz Norte', 'Hinolan Street', '5023', '2024-01-06'),
(12, '16', 'dsdsds', 'Trinidad', 'Coconut', 300, 'Iloilo', 'Oton', 'Baybay Sur', 'Hinolan Street', '5023', '2024-01-09'),
(13, '10', 'dsdsdsdsass', 'Trinidad', 'Coconut', 300, 'Iloilo', 'Oton', 'Baybay Sur', 'Hinolan Street', '5023', '2023-12-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_transaction`
--
ALTER TABLE `approved_transaction`
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
-- Indexes for table `business_stocks`
--
ALTER TABLE `business_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coconut_data`
--
ALTER TABLE `coconut_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coffee_data`
--
ALTER TABLE `coffee_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corn_data`
--
ALTER TABLE `corn_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_information`
--
ALTER TABLE `crop_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declined_transaction`
--
ALTER TABLE `declined_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `done_transaction`
--
ALTER TABLE `done_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmer_stocks`
--
ALTER TABLE `farmer_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipal_agriculturist`
--
ALTER TABLE `municipal_agriculturist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_transaction`
--
ALTER TABLE `pending_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_order`
--
ALTER TABLE `total_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_stocks`
--
ALTER TABLE `total_stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approved_transaction`
--
ALTER TABLE `approved_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `brgy_tech`
--
ALTER TABLE `brgy_tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_owner`
--
ALTER TABLE `business_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `business_stocks`
--
ALTER TABLE `business_stocks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `crop_information`
--
ALTER TABLE `crop_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `declined_transaction`
--
ALTER TABLE `declined_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `done_transaction`
--
ALTER TABLE `done_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `farmer_stocks`
--
ALTER TABLE `farmer_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `municipal_agriculturist`
--
ALTER TABLE `municipal_agriculturist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pending_transaction`
--
ALTER TABLE `pending_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `total_order`
--
ALTER TABLE `total_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `total_stocks`
--
ALTER TABLE `total_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
