-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2023 at 10:31 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_stock`
--

CREATE TABLE `all_stock` (
  `stock_id` int(11) NOT NULL,
  `purchase_id` bigint(20) NOT NULL,
  `purchase_ret_id` int(11) NOT NULL,
  `sale_id` bigint(20) NOT NULL,
  `sale_ret_id` int(11) NOT NULL,
  `opening_stk_id` bigint(20) NOT NULL,
  `stk_adj_id` bigint(20) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `purchase_price` decimal(10,0) NOT NULL,
  `sale_price` decimal(10,0) NOT NULL,
  `total_pur_price` decimal(10,0) NOT NULL,
  `total_pur_ret_price` decimal(10,0) NOT NULL,
  `total_sale_price` decimal(10,0) NOT NULL,
  `total_sale_ret_price` decimal(11,0) NOT NULL,
  `total_stk_adj_price` decimal(10,0) NOT NULL,
  `stock_in_qty` decimal(10,0) NOT NULL,
  `stock_out_qty` decimal(10,0) NOT NULL,
  `dis_per` int(11) NOT NULL,
  `dis_amt` int(11) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_stock`
--

INSERT INTO `all_stock` (`stock_id`, `purchase_id`, `purchase_ret_id`, `sale_id`, `sale_ret_id`, `opening_stk_id`, `stk_adj_id`, `supplier_id`, `customer_id`, `product_id`, `invoice_date`, `purchase_price`, `sale_price`, `total_pur_price`, `total_pur_ret_price`, `total_sale_price`, `total_sale_ret_price`, `total_stk_adj_price`, `stock_in_qty`, `stock_out_qty`, `dis_per`, `dis_amt`, `created_by`, `created_at`) VALUES
(5, 2, 0, 0, 0, 0, 0, 41, 0, 1, '2023-01-23', '12', '15', '12', '0', '0', '0', '0', '1', '2', 0, 0, '', '2023-01-23 13:22:21'),
(6, 2, 0, 0, 0, 0, 0, 41, 0, 2, '2023-01-23', '100', '120', '100', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-01-23 13:22:21'),
(7, 2, 0, 0, 0, 0, 0, 41, 0, 5, '2023-01-23', '200', '250', '200', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-01-23 13:22:21'),
(8, 2, 0, 0, 0, 0, 0, 41, 0, 6, '2023-01-23', '250', '300', '250', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-01-23 13:22:21'),
(23, 0, 0, 4, 0, 0, 0, 0, 27, 2, '2023-01-31', '0', '120', '0', '0', '228', '0', '0', '0', '2', 5, 12, '', '2023-01-31 13:31:04'),
(24, 0, 0, 4, 0, 0, 0, 0, 27, 5, '2023-01-31', '0', '250', '0', '0', '235', '0', '0', '0', '1', 6, 15, '', '2023-01-31 13:31:04'),
(25, 0, 0, 4, 0, 0, 0, 0, 27, 6, '2023-01-31', '0', '300', '0', '0', '279', '0', '0', '0', '1', 7, 21, '', '2023-01-31 13:31:05'),
(26, 0, 0, 4, 0, 0, 0, 0, 27, 1, '2023-01-31', '0', '15', '0', '0', '14', '0', '0', '0', '1', 10, 2, '', '2023-01-31 13:31:05'),
(27, 0, 0, 5, 0, 0, 0, 0, 32, 1, '2023-02-01', '0', '15', '0', '0', '27', '0', '0', '0', '2', 10, 3, '', '2023-02-01 12:20:16'),
(28, 0, 0, 5, 0, 0, 0, 0, 32, 6, '2023-02-01', '0', '300', '0', '0', '855', '0', '0', '0', '3', 5, 45, '', '2023-02-01 12:20:16'),
(29, 0, 0, 6, 0, 0, 0, 0, 27, 2, '2023-02-01', '0', '120', '0', '0', '120', '0', '0', '0', '1', 0, 0, '', '2023-02-01 13:30:31'),
(30, 3, 0, 0, 0, 0, 0, 56, 0, 2, '2023-02-02', '100', '120', '1000', '0', '0', '0', '0', '10', '0', 0, 0, '', '2023-02-02 21:04:50'),
(31, 3, 0, 0, 0, 0, 0, 56, 0, 5, '2023-02-02', '200', '250', '2000', '0', '0', '0', '0', '10', '0', 0, 0, '', '2023-02-02 21:04:50'),
(46, 0, 8, 0, 0, 0, 0, 56, 0, 2, '2023-02-05', '100', '0', '0', '800', '0', '0', '0', '0', '8', 0, 0, '', '2023-02-05 18:43:35'),
(47, 0, 8, 0, 0, 0, 0, 56, 0, 5, '2023-02-05', '200', '0', '0', '1400', '0', '0', '0', '0', '7', 0, 0, '', '2023-02-05 18:43:35'),
(49, 0, 0, 0, 1, 0, 0, 0, 32, 1, '2023-02-05', '0', '15', '0', '0', '0', '27', '0', '2', '0', 10, 3, '', '2023-02-05 23:37:49'),
(50, 0, 0, 0, 1, 0, 0, 0, 32, 6, '2023-02-05', '0', '300', '0', '0', '0', '570', '0', '2', '0', 5, 30, '', '2023-02-05 23:37:49'),
(55, 5, 0, 0, 0, 0, 0, 13, 0, 1, '2023-02-06', '12', '15', '12', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-06 11:53:24'),
(56, 5, 0, 0, 0, 0, 0, 13, 0, 2, '2023-02-06', '100', '120', '100', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-06 11:53:24'),
(69, 0, 0, 0, 0, 1, 0, 0, 0, 1, '2023-02-08', '12', '15', '12', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-10 23:23:32'),
(70, 0, 0, 0, 0, 1, 0, 0, 0, 2, '2023-02-08', '100', '120', '200', '0', '0', '0', '0', '2', '0', 0, 0, '', '2023-02-10 23:23:32'),
(80, 0, 0, 0, 0, 0, 1, 0, 0, 1, '2023-02-09', '12', '15', '0', '0', '0', '0', '15', '0', '1', 0, 0, '', '2023-02-13 22:33:16'),
(81, 0, 0, 0, 0, 0, 1, 0, 0, 5, '2023-02-09', '200', '250', '0', '0', '0', '0', '500', '0', '2', 0, 0, '', '2023-02-13 22:33:16'),
(82, 0, 0, 0, 0, 0, 1, 0, 0, 6, '2023-02-09', '250', '300', '0', '0', '0', '0', '900', '0', '3', 0, 0, '', '2023-02-13 22:33:16'),
(83, 0, 0, 0, 0, 0, 1, 0, 0, 2, '2023-02-09', '100', '120', '0', '0', '0', '0', '480', '0', '4', 0, 0, '', '2023-02-13 22:33:16'),
(84, 6, 0, 0, 0, 0, 0, 59, 0, 7, '2023-02-13', '50', '60', '500', '0', '0', '0', '0', '10', '0', 0, 0, '', '2023-02-14 00:06:35'),
(85, 7, 0, 0, 0, 0, 0, 57, 0, 7, '2023-02-13', '50', '60', '50', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-14 00:09:08'),
(86, 0, 0, 7, 0, 0, 0, 0, 30, 7, '2023-02-13', '0', '60', '0', '0', '120', '0', '0', '0', '2', 0, 0, '', '2023-02-14 00:10:44'),
(87, 8, 0, 0, 0, 0, 0, 59, 0, 9, '2023-02-14', '100', '120', '5000', '0', '0', '0', '0', '50', '0', 0, 0, '', '2023-02-14 14:20:25'),
(88, 9, 0, 0, 0, 0, 0, 60, 0, 9, '2023-02-14', '100', '120', '1000', '0', '0', '0', '0', '10', '0', 0, 0, '', '2023-02-14 14:20:44'),
(89, 0, 0, 8, 0, 0, 0, 0, 28, 9, '2023-02-14', '0', '120', '0', '0', '6000', '0', '0', '0', '50', 0, 0, '', '2023-02-14 14:21:19'),
(90, 0, 0, 9, 0, 0, 0, 0, 28, 9, '2023-02-14', '0', '120', '0', '0', '600', '0', '0', '0', '5', 0, 0, '', '2023-02-14 14:22:21'),
(91, 10, 0, 0, 0, 0, 0, 59, 0, 9, '2023-02-14', '100', '120', '4500', '0', '0', '0', '0', '45', '0', 0, 0, '', '2023-02-14 14:23:08'),
(92, 0, 10, 0, 0, 0, 0, 59, 0, 9, '2023-02-14', '100', '0', '0', '2500', '0', '0', '0', '0', '25', 0, 0, '', '2023-02-14 14:24:44'),
(93, 0, 0, 0, 4, 0, 0, 0, 28, 9, '2023-02-14', '0', '120', '0', '0', '0', '1200', '0', '10', '0', 0, 0, '', '2023-02-14 14:25:46'),
(94, 0, 0, 0, 0, 3, 0, 0, 0, 9, '2023-02-14', '100', '120', '400', '0', '0', '0', '0', '4', '0', 0, 0, '', '2023-02-14 14:26:16'),
(95, 0, 0, 0, 0, 0, 3, 0, 0, 9, '2023-02-14', '100', '120', '0', '0', '0', '0', '600', '0', '5', 0, 0, '', '2023-02-14 14:26:36'),
(96, 0, 11, 0, 0, 0, 0, 13, 0, 1, '2023-02-14', '12', '0', '0', '24', '0', '0', '0', '0', '2', 0, 0, '', '2023-02-14 14:30:01'),
(97, 11, 0, 0, 0, 0, 0, 61, 0, 9, '2023-02-21', '100', '120', '400', '0', '0', '0', '0', '4', '0', 0, 0, '', '2023-02-21 09:19:35'),
(98, 11, 0, 0, 0, 0, 0, 61, 0, 7, '2023-02-21', '50', '60', '150', '0', '0', '0', '0', '3', '0', 0, 0, '', '2023-02-21 09:19:35'),
(99, 11, 0, 0, 0, 0, 0, 61, 0, 6, '2023-02-21', '250', '300', '500', '0', '0', '0', '0', '2', '0', 0, 0, '', '2023-02-21 09:19:35'),
(100, 12, 0, 0, 0, 0, 0, 62, 0, 2, '2023-02-21', '100', '120', '800', '0', '0', '0', '0', '8', '0', 0, 0, '', '2023-02-21 11:58:39'),
(101, 12, 0, 0, 0, 0, 0, 62, 0, 7, '2023-02-21', '50', '60', '200', '0', '0', '0', '0', '4', '0', 0, 0, '', '2023-02-21 11:58:39'),
(102, 13, 0, 0, 0, 0, 0, 61, 0, 1, '2023-02-23', '12', '15', '12', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-23 12:31:00'),
(103, 13, 0, 0, 0, 0, 0, 61, 0, 2, '2023-02-23', '100', '120', '100', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-23 12:31:00'),
(104, 13, 0, 0, 0, 0, 0, 61, 0, 5, '2023-02-23', '200', '250', '200', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-23 12:31:00'),
(105, 14, 0, 0, 0, 0, 0, 61, 0, 5, '2023-02-23', '200', '250', '200', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-23 15:11:16'),
(106, 14, 0, 0, 0, 0, 0, 61, 0, 6, '2023-02-23', '250', '300', '250', '0', '0', '0', '0', '1', '0', 0, 0, '', '2023-02-23 15:11:16'),
(107, 15, 0, 0, 0, 0, 0, 61, 0, 7, '2023-02-23', '50', '60', '850', '0', '0', '0', '0', '17', '0', 0, 0, '', '2023-02-23 15:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `account_title`, `account_no`, `branch_code`, `address`, `cr_by`, `cr_at`) VALUES
(1, 'mcb', 'haseeb', '11111111111111', '1111', 'aaaaa', 0, '2023-02-16 14:36:20'),
(3, 'hbl', 'naeem', '111111111111', '2222', 'mureed', 0, '2023-02-16 14:41:06'),
(4, 'nbp', 'ali', '1111111111111', '3333', 'walaa', 0, '2023-02-16 14:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`cat_id`, `cat_name`, `created_by`, `created_at`) VALUES
(1, 'Fruits', '', '2022-12-30 20:27:20'),
(8, 'Vegetables', '', '2023-02-11 12:50:14'),
(9, 'Dairy', '', '2023-02-11 12:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Haseeb', '03334814361', 'eng.haseeb252@gmail.com', 'Faisalabad', '2022-12-13 13:13:59', '2022-12-13 13:13:59'),
(27, 'M.Haseeb', '03317540252', 'has@a', 'Faisalabad', '2022-12-15 13:01:41', '2022-12-15 13:01:41'),
(28, 'ali', '12345645111', 'has@b', 'asdfg', '2022-12-15 13:48:12', '2022-12-15 13:48:12'),
(29, 'sdgd', '12345678901', 'has@c', 'ghfhggjk', '2022-12-15 14:11:57', '2022-12-15 14:11:57'),
(30, 'dsadfdf', '12345678964', 'has@d', 'sadfgg', '2022-12-15 14:24:20', '2022-12-15 14:24:20'),
(31, 'gdsf', '21432375426', 'has@e', 'sdfgh', '2022-12-15 14:43:12', '2022-12-15 14:43:12'),
(32, 'naeem', '21232342343', 'na@eem', 'chak491', '2023-02-01 11:59:13', '2023-02-01 11:59:13'),
(33, 'akhtar', '11111111111', 'asd@a', 'chak191', '2023-02-01 12:10:11', '2023-02-01 12:10:11'),
(34, 'aaa', '11111111111', 'a@a', 'aaaaa', '2023-02-16 14:23:17', '2023-02-16 14:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `exp_detail` text NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_date`, `exp_detail`, `grand_total`, `cr_by`, `cr_at`) VALUES
(1, '2023-02-01', 'ok', '300', 0, '2023-02-09 10:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `expense_cat`
--

CREATE TABLE `expense_cat` (
  `expense_cat_id` int(11) NOT NULL,
  `expense_cat_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_cat`
--

INSERT INTO `expense_cat` (`expense_cat_id`, `expense_cat_name`, `created_by`, `created_at`) VALUES
(2, 'Electricity', 0, '2023-02-08 20:55:35'),
(3, 'Gas', 0, '2023-02-08 21:21:23'),
(4, 'Water', 0, '2023-02-08 22:10:30'),
(5, 'abc', 0, '2023-02-08 22:11:25'),
(6, 'def', 0, '2023-02-08 22:14:00'),
(7, 'aaa', 0, '2023-02-08 22:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `expense_detail`
--

CREATE TABLE `expense_detail` (
  `expense_detail_id` int(11) NOT NULL,
  `exp_id` int(11) NOT NULL,
  `exp_cat_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_detail`
--

INSERT INTO `expense_detail` (`expense_detail_id`, `exp_id`, `exp_cat_id`, `date`, `total`) VALUES
(7, 1, 2, '2023-02-01', '100'),
(8, 1, 3, '2023-02-02', '50'),
(9, 1, 4, '2023-02-03', '100'),
(10, 1, 5, '2023-02-04', '50');

-- --------------------------------------------------------

--
-- Table structure for table `opening_stock`
--

CREATE TABLE `opening_stock` (
  `opening_stock_id` int(11) NOT NULL,
  `os_date` date NOT NULL,
  `os_detail` text NOT NULL,
  `osg_total` decimal(10,0) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opening_stock`
--

INSERT INTO `opening_stock` (`opening_stock_id`, `os_date`, `os_detail`, `osg_total`, `cr_by`, `cr_at`) VALUES
(1, '2023-02-08', 'upd.', '212', 0, '2023-02-10 21:48:32'),
(3, '2023-02-14', '', '400', 0, '2023-02-14 14:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `owner_phone` varchar(255) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `owner_name`, `owner_email`, `owner_phone`, `cr_by`, `cr_at`) VALUES
(1, 'Haseeb', 'has@a', '11111111111', 0, '2023-02-17 20:36:03'),
(2, 'Ali', 'has@b', '11111111111', 0, '2023-02-17 20:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_catagory` varchar(255) NOT NULL,
  `pro_serial` varchar(255) NOT NULL,
  `pro_barcode` varchar(255) NOT NULL,
  `pro_purchase_price` varchar(255) NOT NULL,
  `pro_sale_price` varchar(255) NOT NULL,
  `pro_detail` longtext NOT NULL,
  `pro_photo` varchar(255) NOT NULL,
  `cr_by` varchar(200) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_catagory`, `pro_serial`, `pro_barcode`, `pro_purchase_price`, `pro_sale_price`, `pro_detail`, `pro_photo`, `cr_by`, `cr_at`) VALUES
(1, 'apple', 'fruits', '11111111', 'bar', '12', '15', 'details', '', '', '2022-12-30 22:10:18'),
(2, 'bnana', 'fru', 'aa', 'aaa', '100', '120', 'a', '20150104_1936482033001672420428.jpg', '', '2022-12-30 22:13:48'),
(5, 'mango', 'fruits', '2222', '111', '200', '250', 'asd', '', '', '2023-01-11 12:06:20'),
(6, 'orange', 'fruits', '111', '111', '250', '300', 'qwe', '', '', '2023-01-11 12:07:33'),
(7, 'potato', 'veg', '', 'asd', '50', '60', 'awla', '', '', '2023-02-06 14:09:31'),
(9, 'pro1', 'Dairy', '', '444', '100', '120', 'aaa', '', '', '2023-02-14 14:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `pur_date` date NOT NULL,
  `pur_detail` text NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `discount_percent` decimal(10,0) NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL,
  `due_amount` decimal(10,0) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `supplier_id`, `pur_date`, `pur_detail`, `subtotal`, `discount_percent`, `discount_amount`, `total`, `paid_amount`, `due_amount`, `status`, `created_by`, `created_at`) VALUES
(2, 41, '2023-01-23', '', '562', '0', '0', '562', '0', '562', 0, 0, '2023-01-23 13:22:21'),
(3, 56, '2023-02-02', '', '3000', '20', '600', '3600', '4000', '-400', 0, 0, '2023-02-02 21:04:50'),
(5, 13, '2023-02-06', '', '112', '10', '11', '123', '120', '3', 0, 0, '2023-02-06 11:53:24'),
(6, 59, '2023-02-13', '', '500', '5', '25', '475', '500', '-25', 0, 0, '2023-02-14 00:06:35'),
(7, 57, '2023-02-13', '', '50', '5', '3', '48', '50', '-3', 0, 0, '2023-02-14 00:09:08'),
(8, 59, '2023-02-14', '', '5000', '0', '0', '5000', '0', '5000', 0, 0, '2023-02-14 14:20:25'),
(9, 60, '2023-02-14', '', '1000', '0', '0', '1000', '0', '1000', 0, 0, '2023-02-14 14:20:44'),
(10, 59, '2023-02-14', '', '4500', '0', '0', '4500', '0', '4500', 0, 0, '2023-02-14 14:23:08'),
(11, 61, '2023-02-21', 'led', '1050', '0', '0', '1050', '1100', '-50', 0, 0, '2023-02-21 09:19:35'),
(12, 62, '2023-02-21', '', '1000', '0', '0', '1000', '500', '500', 0, 0, '2023-02-21 11:58:39'),
(13, 61, '2023-02-23', '', '312', '5', '16', '296', '300', '-4', 0, 0, '2023-02-23 12:31:00'),
(14, 61, '2023-02-23', '', '450', '2', '9', '441', '400', '41', 0, 0, '2023-02-23 15:11:16'),
(15, 61, '2023-02-23', '', '850', '0', '0', '850', '800', '50', 0, 0, '2023-02-23 15:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `pur_return_id` int(11) NOT NULL,
  `pur_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `pur_date` date NOT NULL,
  `pur_ret_date` date NOT NULL,
  `ret_detail` text NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `deduction_per` decimal(10,0) NOT NULL,
  `deduction_amt` decimal(10,0) NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `paid_amt` decimal(10,0) NOT NULL,
  `due_amt` decimal(10,0) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`pur_return_id`, `pur_id`, `supp_id`, `pur_date`, `pur_ret_date`, `ret_detail`, `subtotal`, `deduction_per`, `deduction_amt`, `grand_total`, `paid_amt`, `due_amt`, `cr_by`, `cr_at`) VALUES
(8, 3, 56, '2023-02-02', '2023-02-05', 'waooo', '1760', '50', '880', '880', '900', '-20', 0, '2023-02-05 18:42:24'),
(10, 8, 59, '2023-02-14', '2023-02-14', '', '2500', '0', '0', '2500', '0', '2500', 0, '2023-02-14 14:24:44'),
(11, 1, 13, '2023-01-22', '2023-02-14', 'ok.', '12', '0', '0', '12', '0', '12', 0, '2023-02-14 14:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_detail` text NOT NULL,
  `subtotal` int(11) NOT NULL,
  `dis_percent` int(11) NOT NULL,
  `dis_amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `due_amount` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `cust_id`, `sale_date`, `sale_detail`, `subtotal`, `dis_percent`, `dis_amount`, `total`, `paid_amount`, `due_amount`, `created_by`, `created_at`) VALUES
(4, 27, '2023-01-31', 'yes', 756, 40, 302, 453, 500, -47, 0, '2023-01-31 13:27:19'),
(5, 32, '2023-02-01', 'ok', 882, 50, 441, 441, 500, -59, 0, '2023-02-01 12:20:15'),
(6, 27, '2023-02-01', '', 120, 50, 60, 60, 0, 60, 0, '2023-02-01 13:30:31'),
(7, 30, '2023-02-13', '', 120, 5, 6, 114, 115, -1, 0, '2023-02-14 00:10:44'),
(8, 28, '2023-02-14', '', 6000, 0, 0, 6000, 0, 6000, 0, '2023-02-14 14:21:19'),
(9, 28, '2023-02-14', '', 600, 0, 0, 600, 0, 600, 0, '2023-02-14 14:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `sale_return`
--

CREATE TABLE `sale_return` (
  `sale_return_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_ret_date` date NOT NULL,
  `ret_detail` text NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `ded_per` decimal(10,0) NOT NULL,
  `ded_amt` decimal(10,0) NOT NULL,
  `g_total` decimal(10,0) NOT NULL,
  `paid_amt` decimal(10,0) NOT NULL,
  `due_amt` decimal(10,0) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_return`
--

INSERT INTO `sale_return` (`sale_return_id`, `sale_id`, `cust_id`, `sale_date`, `sale_ret_date`, `ret_detail`, `subtotal`, `ded_per`, `ded_amt`, `g_total`, `paid_amt`, `due_amt`, `cr_by`, `cr_at`) VALUES
(1, 5, 32, '2023-02-01', '2023-02-05', 'res', '299', '40', '119', '179', '200', '-21', 0, '2023-02-05 23:37:49'),
(4, 8, 28, '2023-02-14', '2023-02-14', '', '1200', '0', '0', '1200', '0', '1200', 0, '2023-02-14 14:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `stk_adjustment`
--

CREATE TABLE `stk_adjustment` (
  `stk_adjustment_id` int(11) NOT NULL,
  `adj_date` date NOT NULL,
  `adj_detail` text NOT NULL,
  `adj_gtotal` decimal(10,0) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stk_adjustment`
--

INSERT INTO `stk_adjustment` (`stk_adjustment_id`, `adj_date`, `adj_detail`, `adj_gtotal`, `cr_by`, `cr_at`) VALUES
(1, '2023-02-09', 'adju', '1895', 0, '2023-02-13 21:43:42'),
(3, '2023-02-14', '', '600', 0, '2023-02-14 14:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `company` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_designation` varchar(100) NOT NULL,
  `c_phone` varchar(100) NOT NULL,
  `c_email` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `company`, `phone`, `email`, `address`, `website`, `c_name`, `c_designation`, `c_phone`, `c_email`, `created_at`, `updated_at`) VALUES
(13, 'Oriento Tec', '0331-7540252', 'oriento@gmail.com', 'Mureedwala', 'www.oriento.com', 'M.Haseeb', 'CEO', '03334814361', 'eng.haseeb252@gmai.com', '2022-12-16 13:27:22', '2022-12-16 13:27:22'),
(41, 'aaa', '11111111111', 'has@a', '', '', 'aaa', 'CEO', '11111111111', 'has@b', '2022-12-18 19:29:49', '2022-12-18 19:29:49'),
(43, 'aaa', '11111111111', 'has@q', '', '', 'aaa', 'CEO', '11111111111', '', '2022-12-18 19:31:23', '2022-12-18 19:31:23'),
(45, 'aaa', '11111111111', 'has@e', '', '', 'aaa', 'CEO', '11111111111', 'has@e', '2022-12-18 19:54:20', '2022-12-18 19:54:20'),
(55, 'aaa', '11111111111', '', '', '', 'aaa', 'CEO', '11111111111', '', '2022-12-24 15:01:49', '2022-12-24 15:01:49'),
(56, '111', '11111111111', 'ali@123', '', '', '111', 'CEO', '11111111111', '', '2022-12-24 15:02:59', '2022-12-24 15:02:59'),
(57, 'qqq', '11111111111', '', '', '', 'qqq', 'CEO', '11111111111', '', '2022-12-26 12:55:03', '2022-12-26 12:55:03'),
(59, 'ccccccc', '12345678912', '', '', '', 'cccc', 'CEO', '23456789123', '', '2023-02-06 11:50:36', '2023-02-06 11:50:36'),
(60, 'ccccccc', '12345678912', '', '', '', 'cccc', 'CEO', '23456789123', '', '2023-02-06 11:50:36', '2023-02-06 11:50:36'),
(61, 'klash', '22222222222', 'has@y', 'chak252', 'www.com', 'haseeb', 'CEO', '33333333333', 'has@z', '2023-02-21 09:17:08', '2023-02-21 09:17:08'),
(62, 'naeem', '33333333333', '', '', '', 'asad', 'Manager', '11111111111', '', '2023-02-21 11:57:47', '2023-02-21 11:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `supp_ledger`
--

CREATE TABLE `supp_ledger` (
  `ledger_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `pur_id` int(11) NOT NULL,
  `ret_id` int(11) NOT NULL,
  `pro_id` varchar(255) NOT NULL,
  `pro_qty` varchar(255) NOT NULL,
  `trn_date` date NOT NULL,
  `trn_detail` text NOT NULL,
  `trn_type` varchar(255) NOT NULL,
  `paid` decimal(10,0) NOT NULL,
  `received` decimal(10,0) NOT NULL,
  `cr_by` int(11) NOT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supp_ledger`
--

INSERT INTO `supp_ledger` (`ledger_id`, `supp_id`, `pur_id`, `ret_id`, `pro_id`, `pro_qty`, `trn_date`, `trn_detail`, `trn_type`, `paid`, `received`, `cr_by`, `cr_at`) VALUES
(1, 61, 0, 0, '', '', '2023-02-21', 'Opening Balance', '1', '0', '0', 0, '2023-02-21 09:17:08'),
(2, 61, 11, 0, '9,7,6', '4,3,2', '2023-02-21', 'Buy Products', '2', '1100', '1050', 0, '2023-02-21 09:19:35'),
(3, 62, 0, 0, '', '', '2023-02-21', 'Opening Balance', '1', '0', '0', 0, '2023-02-21 11:57:47'),
(4, 62, 12, 0, '2,7', '8,4', '2023-02-21', 'Buy Products', '2', '500', '1000', 0, '2023-02-21 11:58:39'),
(5, 61, 13, 0, '1,2,5', '1,1,1', '2023-02-23', 'Buy Products', '2', '300', '296', 0, '2023-02-23 12:31:00'),
(6, 61, 14, 0, '5,6', '1,1', '2023-02-23', 'Buy Products', '2', '400', '441', 0, '2023-02-23 15:11:16'),
(7, 61, 15, 0, '7', '17', '2023-02-23', 'Buy Products', '2', '800', '850', 0, '2023-02-23 15:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `created_by`, `created_at`) VALUES
(2, 'Ltrs', '', '2022-12-29 21:27:39'),
(3, 'Grms', '', '2022-12-29 21:53:58'),
(4, 'KGs', '', '2022-12-29 22:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `e_mail` varchar(200) NOT NULL,
  `p_word` varchar(255) NOT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gen` varchar(200) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` timestamp NULL DEFAULT NULL,
  `v_fied` tinyint(4) DEFAULT 0,
  `blocked` tinyint(4) DEFAULT 1,
  `role` varchar(200) DEFAULT NULL,
  `permissions` longtext DEFAULT NULL,
  `cr_by` int(11) DEFAULT NULL,
  `cr_at` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `u_name`, `e_mail`, `p_word`, `phone`, `address`, `gen`, `photo`, `token`, `t_expire`, `v_fied`, `blocked`, `role`, `permissions`, `cr_by`, `cr_at`, `upd_at`) VALUES
(58, 'asif', 'check', 'muhammadhaseeb494@gmail.com', '$2y$10$XX20PK3vw.bQtv4V2tXbPucs7f6u7g6suH9VAd.crYgNzbY5YdqX2', '', NULL, 'Male', NULL, '138263a619a3f', '2022-12-19 16:16:12', 0, 1, 'Manager', NULL, NULL, '2022-12-20 22:58:36', '2022-12-20 22:58:36'),
(61, 'ali', 'ali191', 'ar2672aliraza@gmail.com', '$2y$10$loUG5JvcQwuR6VqY0BbJrOggw7vstDXa3L0tn30l9kWMnu5Nh6B2S', '', NULL, 'Male', NULL, '2b219adc60b43', '2022-12-19 16:16:12', 0, 1, 'Admin', NULL, NULL, '2022-12-21 12:27:57', '2022-12-21 12:27:57'),
(62, 'M.Haseeb', 'haseeb252', 'eng.haseeb252@gmail.com', '$2y$10$W2gQwkFBpqKG6zEERPGKt.UuYp2rkjPT0NiYv906P73GvmJKEREMC', '03334814361', NULL, 'Male', 'a8690771672159687.jpg', '', '2023-02-24 11:00:57', 0, 1, 'Manager', NULL, NULL, '2022-12-21 20:45:40', '2022-12-21 20:45:40'),
(79, 'Muhammad Haseeb', 'haseeb', 'eng.haseeb22@gmail.com', '$2y$10$cPnKdsh9WnKOK7crTgT/O.6Da/O93QU9hoCEx5AyBH8GXbGMZlz0S', NULL, NULL, 'Male', 'pexels-cottonbro-studio-47092906435461677222830.jpg', NULL, NULL, 0, 1, 'Admin', NULL, NULL, '2023-02-24 12:13:50', '2023-02-24 12:13:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_stock`
--
ALTER TABLE `all_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `expense_cat`
--
ALTER TABLE `expense_cat`
  ADD PRIMARY KEY (`expense_cat_id`);

--
-- Indexes for table `expense_detail`
--
ALTER TABLE `expense_detail`
  ADD PRIMARY KEY (`expense_detail_id`);

--
-- Indexes for table `opening_stock`
--
ALTER TABLE `opening_stock`
  ADD PRIMARY KEY (`opening_stock_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`pur_return_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_return`
--
ALTER TABLE `sale_return`
  ADD PRIMARY KEY (`sale_return_id`);

--
-- Indexes for table `stk_adjustment`
--
ALTER TABLE `stk_adjustment`
  ADD PRIMARY KEY (`stk_adjustment_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supp_ledger`
--
ALTER TABLE `supp_ledger`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_stock`
--
ALTER TABLE `all_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_cat`
--
ALTER TABLE `expense_cat`
  MODIFY `expense_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expense_detail`
--
ALTER TABLE `expense_detail`
  MODIFY `expense_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `opening_stock`
--
ALTER TABLE `opening_stock`
  MODIFY `opening_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `pur_return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_return`
--
ALTER TABLE `sale_return`
  MODIFY `sale_return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stk_adjustment`
--
ALTER TABLE `stk_adjustment`
  MODIFY `stk_adjustment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `supp_ledger`
--
ALTER TABLE `supp_ledger`
  MODIFY `ledger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
