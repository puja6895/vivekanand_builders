-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 02:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 'Ramdhar Singh', 0, '2021-09-24 11:09:49', '2021-09-24 11:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `bill_details`
--

CREATE TABLE `bill_details` (
  `bill_id` int(10) UNSIGNED NOT NULL,
  `bill_date` date NOT NULL,
  `bill_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `due_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_details`
--

INSERT INTO `bill_details` (`bill_id`, `bill_date`, `bill_no`, `admin_id`, `customer_id`, `from_date`, `to_date`, `amount`, `due_amount`, `created_at`, `updated_at`) VALUES
(2, '2021-09-25', 'VNB-1-09-21', 1, 26, '2021-09-16', '2021-09-18', '8150.00', 8150.00, '2021-09-25 11:41:06', '2021-09-25 11:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Cement', NULL, '2020-07-16 07:17:47', '2020-07-16 07:17:47'),
(2, 'Sand', NULL, '2020-07-22 01:51:16', '2020-07-22 01:51:16'),
(3, 'Bricks', NULL, '2020-07-22 01:51:28', '2020-07-22 01:51:28'),
(4, 'Stone', NULL, '2020-07-22 01:52:34', '2020-07-22 01:52:34'),
(5, 'Rod', NULL, '2020-07-22 01:55:21', '2020-07-22 01:55:21'),
(6, 'test2', '2020-08-26 13:56:50', '2020-08-26 13:56:33', '2020-08-26 13:56:50'),
(7, 'Chemical', NULL, '2020-11-01 22:12:39', '2020-11-01 22:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_mobile`, `customer_email`, `customer_address`, `gst_no`, `created_at`, `updated_at`, `isDeleted`) VALUES
(1, 'Ankur', '0', NULL, 'rabber factory', NULL, '2021-09-21 11:21:10', '2021-09-21 11:21:10', 0),
(2, 'Gopal jaiswal', '0', NULL, NULL, NULL, '2021-09-21 11:27:27', '2021-09-21 11:27:27', 0),
(3, 'Haldiram', '0', NULL, NULL, NULL, '2021-09-21 11:39:13', '2021-09-21 11:39:13', 0),
(4, 'Nilu da', '0', NULL, NULL, NULL, '2021-09-22 10:42:52', '2021-09-22 10:42:52', 0),
(5, 'Bijoy babu', '0', NULL, NULL, NULL, '2021-09-22 10:49:25', '2021-09-22 10:49:25', 0),
(6, 'Vivek sangh', '0', NULL, NULL, NULL, '2021-09-22 10:55:55', '2021-09-22 10:55:55', 0),
(7, 'Pradhan', '0', NULL, NULL, NULL, '2021-09-23 10:34:17', '2021-09-23 10:34:17', 0),
(8, 'Shshil Jaiswal', '0', NULL, NULL, NULL, '2021-09-23 11:09:06', '2021-09-28 05:00:19', 1),
(9, 'Mahesh Surekha', '0', NULL, NULL, NULL, '2021-09-23 11:15:37', '2021-09-23 11:15:37', 0),
(10, 'Surjit Singh', '0', NULL, NULL, NULL, '2021-09-24 03:34:14', '2021-09-24 03:34:14', 0),
(11, 'Sohan Lal School', '0', NULL, NULL, NULL, '2021-09-24 04:01:19', '2021-09-24 04:01:19', 0),
(12, 'Ram mohan', '0', NULL, 'Ruber factory', NULL, '2021-09-24 04:15:04', '2021-09-24 04:15:04', 0),
(13, 'Bika', '0', NULL, NULL, NULL, '2021-09-25 01:41:10', '2021-09-25 01:41:10', 0),
(14, 'Rammohan', '0', NULL, NULL, NULL, '2021-09-25 03:32:17', '2021-10-04 02:53:32', 1),
(15, 'Rajesh jaiswal', '0', NULL, NULL, NULL, '2021-09-25 03:52:47', '2021-09-25 03:52:47', 0),
(16, 'Gangotri', '0', NULL, NULL, NULL, '2021-09-25 06:32:15', '2021-09-25 06:32:15', 0),
(17, 'Gangotri', '0', NULL, NULL, NULL, '2021-09-25 06:35:11', '2021-09-25 07:13:00', 1),
(18, 'Kamlesh yadav', '0', NULL, NULL, NULL, '2021-09-25 07:26:13', '2021-09-25 07:26:13', 0),
(19, 'Tonu', '0', NULL, 'rabber factory', NULL, '2021-09-25 07:39:50', '2021-09-28 03:45:30', 1),
(20, 'Anand pur trust', '0', NULL, NULL, NULL, '2021-09-25 07:41:48', '2021-09-25 07:41:48', 0),
(21, 'Amit jaiswal', '0', NULL, NULL, NULL, '2021-09-25 07:42:46', '2021-09-25 07:42:46', 0),
(22, 'Daya  shukla', '0', NULL, NULL, NULL, '2021-09-25 07:44:38', '2021-09-25 07:44:38', 0),
(23, 'Durgesh jaiswal', '0', NULL, NULL, NULL, '2021-09-25 07:45:56', '2021-09-25 07:45:56', 0),
(24, 'Hanuman babu', '0', NULL, NULL, NULL, '2021-09-25 07:46:43', '2021-09-25 07:46:43', 0),
(25, 'Sunil jaiswal', '0', NULL, NULL, NULL, '2021-09-25 07:48:03', '2021-09-25 07:48:03', 0),
(26, 'Puja Singh', '0', NULL, NULL, NULL, '2021-09-25 11:35:56', '2021-10-11 12:00:05', 0),
(27, 'Nagendra Singh', '0', NULL, NULL, NULL, '2021-09-26 10:03:08', '2021-09-26 10:03:08', 0),
(28, 'Chotu Tiwari', '0', NULL, NULL, NULL, '2021-09-26 10:13:19', '2021-09-26 10:13:19', 0),
(29, 'Uma pani tank', '0', NULL, NULL, NULL, '2021-09-27 05:32:13', '2021-09-27 05:32:13', 0),
(30, 'Bimla choubey', '0', NULL, NULL, NULL, '2021-09-28 02:41:24', '2021-09-28 02:41:24', 0),
(31, 'Harish chand', '0', NULL, NULL, NULL, '2021-09-28 03:00:14', '2021-09-28 03:00:14', 0),
(32, 'Govind sohan lal school', '0', NULL, NULL, NULL, '2021-09-28 03:09:35', '2021-09-28 03:09:35', 0),
(33, 'Tonu jaiswal', '0', NULL, NULL, NULL, '2021-09-28 03:37:42', '2021-09-28 03:37:42', 0),
(34, 'shushil jaiswal', '0', NULL, NULL, NULL, '2021-09-28 05:01:09', '2021-09-28 05:01:09', 0),
(35, 'Ajoy TDS', '0', NULL, NULL, NULL, '2021-09-28 10:59:45', '2021-10-07 04:11:27', 1),
(36, 'Rajender singh', '0', NULL, 'Badamtalla', NULL, '2021-09-28 11:01:40', '2021-09-28 11:01:40', 0),
(37, 'Rakesh Kharda', '0', NULL, NULL, NULL, '2021-09-28 11:02:45', '2021-09-28 11:02:45', 0),
(38, 'MA TARA TRANSPORT', '0', NULL, NULL, NULL, '2021-09-28 11:03:59', '2021-09-28 11:03:59', 0),
(39, 'Aditya gupta', '0', NULL, NULL, NULL, '2021-09-29 03:37:41', '2021-09-29 03:37:41', 0),
(40, 'Dinesh gupta', '0', NULL, NULL, NULL, '2021-09-29 03:38:34', '2021-09-29 03:38:34', 0),
(41, 'Gola', '0', NULL, NULL, NULL, '2021-09-29 09:37:22', '2021-09-29 09:37:22', 0),
(42, 'Jhinak singh', '0', NULL, NULL, NULL, '2021-09-30 06:06:22', '2021-09-30 06:06:22', 0),
(43, 'Sanju agrawal', '0', NULL, NULL, NULL, '2021-10-02 05:16:20', '2021-10-02 05:16:20', 0),
(44, 'Singh mobil', '0', NULL, NULL, NULL, '2021-10-02 05:17:06', '2021-10-02 05:17:06', 0),
(45, 'Guddu', '0', NULL, 'hati kothi', NULL, '2021-10-04 04:12:50', '2021-10-04 04:12:50', 0),
(46, 'Vivek parekh', '0', NULL, 'Vishnu batika', NULL, '2021-10-04 04:13:49', '2021-10-04 04:13:49', 0),
(47, 'Satish panwala', '0', NULL, NULL, NULL, '2021-10-04 04:14:33', '2021-10-04 04:14:33', 0),
(48, 'Tanu jaiswal', '0', NULL, 'Rubber factorry', NULL, '2021-10-05 04:26:02', '2021-10-05 04:26:02', 0),
(49, 'Munna singh', '0', NULL, 'Bajrang bali', NULL, '2021-10-06 04:10:24', '2021-10-06 04:10:24', 0),
(50, 'Rajeswar sharma', '0', NULL, NULL, NULL, '2021-10-06 04:11:14', '2021-10-06 04:11:14', 0),
(51, 'Ajoy singh', '0', NULL, 'T.D.S.', NULL, '2021-10-07 04:10:32', '2021-10-07 04:10:32', 0),
(52, 'Manoj giri', '0', NULL, 'Bombay road', NULL, '2021-10-07 05:45:09', '2021-10-07 05:45:09', 0),
(53, 'Ugar babu', '0', NULL, NULL, NULL, '2021-10-08 03:05:15', '2021-10-08 03:05:15', 0),
(54, 'universal forging', '0', NULL, NULL, NULL, '2021-10-08 03:06:17', '2021-10-08 03:06:17', 0),
(55, 'Bijoy master', '0', NULL, NULL, NULL, '2021-10-08 03:08:13', '2021-10-08 03:08:13', 0),
(56, 'shu', '0', NULL, NULL, NULL, '2021-10-10 02:46:49', '2021-10-10 02:46:49', 0),
(57, 'Sandeep yadav', '0', NULL, NULL, NULL, '2021-10-11 04:49:01', '2021-10-11 04:49:01', 0),
(58, 'Vivek moter', '0', NULL, NULL, NULL, '2021-10-12 03:46:04', '2021-10-12 03:46:04', 0),
(59, 'Rajender singh', '0', NULL, NULL, NULL, '2021-10-12 03:46:38', '2021-10-12 03:55:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `default__products`
--

CREATE TABLE `default__products` (
  `default_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `sell_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `purchase_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `default__products`
--

INSERT INTO `default__products` (`default_id`, `product_id`, `unit_id`, `sell_price`, `purchase_price`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '140.00', '5.00', 0, '2021-09-21 10:18:21', '2021-09-21 10:18:21'),
(2, 2, 1, '160.00', '100.00', 0, '2021-09-21 11:17:35', '2021-09-21 11:17:35'),
(3, 5, 2, '12.50', '11.50', 0, '2021-09-22 10:01:43', '2021-09-22 10:01:43'),
(4, 7, 1, '140.00', '120.00', 0, '2021-09-22 10:02:23', '2021-09-22 10:02:23'),
(5, 9, 1, '120.00', '100.00', 0, '2021-09-22 10:02:50', '2021-09-22 10:02:50'),
(6, 3, 1, '360.00', '340.00', 0, '2021-09-22 10:03:34', '2021-09-22 10:03:34'),
(7, 4, 1, '360.00', '340.00', 0, '2021-09-22 10:03:54', '2021-09-22 10:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gst_payments`
--

CREATE TABLE `gst_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `pay_date` date NOT NULL,
  `pay_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_received` double(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gst_sells`
--

CREATE TABLE `gst_sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `sell_date` date NOT NULL,
  `total_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gst_sell_products`
--

CREATE TABLE `gst_sell_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sell_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` double(10,2) NOT NULL,
  `gst` double(10,2) NOT NULL DEFAULT 0.00,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invent`
--

CREATE TABLE `invent` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lorries`
--

CREATE TABLE `lorries` (
  `lorry_id` int(10) UNSIGNED NOT NULL,
  `lorry_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lorries`
--

INSERT INTO `lorries` (`lorry_id`, `lorry_no`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 'WB/41D-9311', 0, '2021-09-27 04:00:24', '2021-09-27 04:00:24'),
(2, 'WB/41E-7990', 0, '2021-09-28 10:48:03', '2021-09-28 10:48:03'),
(3, 'WB/41-6701', 0, '2021-09-28 10:49:12', '2021-09-28 10:49:12'),
(4, 'WB/41C-1224', 0, '2021-09-28 10:50:01', '2021-09-28 10:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `lorry_reports`
--

CREATE TABLE `lorry_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `lorry_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `lorry_date` date NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `weight` double(10,2) NOT NULL DEFAULT 0.00,
  `rate` double(10,2) NOT NULL DEFAULT 0.00,
  `detain_days` int(11) NOT NULL DEFAULT 0,
  `detain_amount` double NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `advance_amount` double(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lorry_reports`
--

INSERT INTO `lorry_reports` (`id`, `lorry_id`, `customer_id`, `lorry_date`, `product_id`, `from`, `to`, `unit_id`, `weight`, `rate`, `detain_days`, `detain_amount`, `amount`, `created_at`, `updated_at`, `advance_amount`) VALUES
(4, 1, 36, '2021-09-15', 1, 'Aram bag', 'belur', 4, 245.00, 90.00, 0, 0, 22050.00, '2021-09-28 11:25:41', '2021-09-28 11:25:41', 0.00),
(6, 1, 41, '2021-09-12', 1, 'Aram bag', 'belur', 4, 250.00, 76.00, 0, 0, 19000.00, '2021-09-29 09:47:40', '2021-09-29 09:47:40', 0.00),
(9, 2, 41, '2021-09-13', 1, 'Aram bag', 'belur', 4, 250.00, 76.00, 0, 0, 19000.00, '2021-09-29 10:01:29', '2021-09-29 10:01:29', 0.00),
(10, 1, 41, '2021-09-21', 1, 'Aram bag', 'belur', 4, 250.00, 76.00, 0, 0, 19000.00, '2021-09-29 10:49:31', '2021-09-29 10:49:31', 0.00),
(11, 2, 41, '2021-09-22', 1, 'Aram bag', 'belur', 4, 250.00, 76.00, 0, 0, 19000.00, '2021-09-29 10:51:57', '2021-09-29 10:51:57', 0.00),
(12, 2, 41, '2021-09-15', 1, 'Aram bag', 'belur', 4, 250.00, 76.00, 0, 0, 19000.00, '2021-10-11 05:21:06', '2021-10-11 05:21:06', 0.00),
(13, 2, 51, '2021-09-25', 1, 'Aram bag', 'Guha road T D S', 4, 400.00, 6.00, 0, 0, 2400.00, '2021-10-11 05:38:40', '2021-10-11 05:38:40', 0.00),
(14, 2, 51, '2021-09-26', 1, 'Aram bag', 'Guha road T D S', 4, 400.00, 6.00, 0, 0, 2400.00, '2021-10-11 05:40:24', '2021-10-11 05:40:24', 0.00),
(15, 2, 37, '2021-09-28', 1, 'Aram bag', 'KHARDA', 4, 250.00, 100.00, 0, 0, 25000.00, '2021-10-11 05:43:19', '2021-10-11 05:43:19', 0.00),
(16, 2, 41, '2021-09-30', 1, 'Aram bag', 'belur', 4, 250.00, 8.00, 0, 0, 2000.00, '2021-10-11 05:45:58', '2021-10-11 05:45:58', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_31_094506_create_customers_table', 1),
(5, '2020_06_02_130756_add_is_deleted_to_customers_table', 1),
(6, '2020_06_03_111851_create_units_table', 1),
(7, '2020_06_05_100457_add_soft_delete_to_units', 1),
(8, '2020_06_07_090929_create_products_table', 1),
(9, '2020_06_09_125052_categories', 1),
(10, '2020_06_11_134406_create_sells_table', 1),
(11, '2020_06_12_134405_sell_products', 1),
(12, '2020_06_13_101454_add_category_id_to_products', 1),
(13, '2020_06_19_074431_sell_pay_amounts', 1),
(14, '2020_06_23_044049_create_inventories_table', 1),
(15, '2020_06_23_083704_drop_inventories', 1),
(16, '2020_06_23_084715_inventories', 1),
(17, '2020_06_24_121258_rename_column_unit_id_to_unit_name', 1),
(18, '2020_06_24_124355_drop_index_add_index_to_inventories', 1),
(19, '2020_06_24_133038_add_column_to_inventories', 1),
(20, '2020_06_25_035822_add_closing_stock_to_inventories', 1),
(21, '2020_06_25_053236_add_opening_stock_to_inventories', 1),
(22, '2020_06_25_073756_add_closingg_stock_to_inventories', 1),
(23, '2020_06_29_080543_add_status_to_sells', 1),
(24, '2020_07_02_160322_create_bill_details_table', 1),
(25, '2020_07_03_074648_add_amount_to_bill_details', 1),
(26, '2020_07_05_144054_add_column_to_bill_details', 1),
(27, '2020_07_06_085825_add_status_to_payment', 1),
(28, '2020_07_09_125419_add_bill_date_to_bill_details', 1),
(29, '2020_07_14_105028_create_purchasers_table', 1),
(30, '2020_07_15_133636_create_purchases_table', 1),
(31, '2020_07_15_135345_purchase_products', 1),
(32, '2020_07_18_140317_purchase_payments', 2),
(33, '2020_07_19_160808_drop_column_to_purchase_payments', 3),
(34, '2020_07_20_181700_gst_sells', 4),
(35, '2020_07_20_181728_gst_sell_products', 4),
(36, '2020_07_21_095431_modify_column_to_gst_sells', 5),
(37, '2020_07_21_101102_drop_table', 6),
(38, '2020_07_24_075644_drop_tables__gst_sell_products_drop_table', 7),
(39, '2020_07_25_031415_create_lorries_table', 8),
(40, '2020_07_25_193721_create_admins_table', 9),
(41, '2020_07_26_034855_add_column_admin_to_bill_details', 10),
(42, '2020_07_27_152303_create_default__products_table', 11),
(43, '2020_07_27_180035_drop_column_and_add_column_to_default__products', 12),
(44, '2020_07_27_181252_add_column_to_default__products', 13),
(45, '2020_07_28_152804_create_lorry_reports_table', 14),
(46, '2020_07_28_180613_add_column_date_to_lorry_reports', 15),
(47, '2020_07_28_180859_drop_and_add_column_date_to_lorry_reports', 16),
(48, '2020_07_28_190238_add_advance__to_lorry_reports', 17),
(49, '2020_07_29_040920_create_gst_sells_table', 18),
(50, '2020_07_29_041005_create_gst_sell_products_table', 18),
(51, '2020_07_29_063338_create_gst_payments_table', 19),
(52, '2020_07_30_112050_drop_inventories_table', 20),
(53, '2020_08_05_041411_inventory', 21),
(54, '2020_08_05_090110_drop_gstinventory_payments', 22),
(55, '2020_08_05_090806_inventoryy', 22),
(56, '2020_08_05_091215_invent', 23),
(57, '2020_08_08_165215_add_column_invent_sell_products_purchase_products', 24),
(58, '2020_08_10_065216_add_column_product_unit_id_sell_product_purchase_product_invent', 25),
(59, '2020_08_13_080454_add_column_description_to_sell_pay_amounts', 26),
(60, '2020_08_13_121930_previous_due', 27),
(61, '2020_08_15_051555_add_column_freight_to_purchase_payments', 28),
(62, '2020_08_15_105418_drop_column_to_sell_products', 29),
(63, '2020_08_22_085131_add_column_to_lorry_reports', 30),
(64, '2020_08_26_160917_add_column_to_gst_sell_products', 31);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `previous_due`
--

CREATE TABLE `previous_due` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `previous_due_date` date NOT NULL,
  `previous_due_amount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_due`
--

INSERT INTO `previous_due` (`id`, `customer_id`, `previous_due_date`, `previous_due_amount`, `created_at`, `updated_at`) VALUES
(3, 28, '2021-08-30', 41128, '2021-09-26 10:15:11', '2021-09-26 10:15:11'),
(4, 10, '2021-08-31', 14815, '2021-09-26 11:23:48', '2021-09-26 11:23:48'),
(5, 21, '2021-08-31', 60809, '2021-09-27 11:12:18', '2021-09-27 11:12:18'),
(6, 33, '2021-09-07', 500, '2021-09-28 03:55:26', '2021-09-28 03:55:26'),
(7, 34, '2021-08-31', 37694, '2021-09-28 05:57:24', '2021-09-28 05:57:24'),
(10, 42, '2021-07-15', 14840, '2021-09-30 07:14:15', '2021-09-30 07:14:15'),
(12, 44, '2021-09-28', 400, '2021-10-03 10:06:44', '2021-10-03 10:06:44'),
(13, 12, '2021-08-31', 11100, '2021-10-04 03:27:27', '2021-10-04 03:27:27'),
(15, 51, '2021-08-31', 285705, '2021-10-07 04:41:16', '2021-10-07 04:41:16'),
(16, 2, '2021-08-31', 235802, '2021-10-07 05:00:01', '2021-10-07 05:00:01'),
(18, 57, '2021-09-01', 27610, '2021-10-11 04:55:03', '2021-10-11 04:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `deleted_at`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Medium sand', NULL, '2021-09-21 09:51:01', '2021-09-21 09:51:01', 2),
(2, 'core sand', NULL, '2021-09-21 09:51:17', '2021-09-21 09:51:17', 2),
(3, 'ambuja cement', NULL, '2021-09-21 09:51:36', '2021-09-21 09:51:36', 1),
(4, 'Ultratech cement', NULL, '2021-09-21 09:52:06', '2021-09-21 09:52:06', 1),
(5, '1st class bricks', NULL, '2021-09-21 09:52:50', '2021-09-21 09:52:50', 3),
(6, '2nd class bricks', NULL, '2021-09-21 09:53:12', '2021-09-21 09:53:12', 3),
(7, '5/8 stone', NULL, '2021-09-21 09:53:28', '2021-09-21 09:53:28', 4),
(8, '3/4 stone', NULL, '2021-09-21 09:53:40', '2021-09-21 09:53:40', 4),
(9, '1/4', NULL, '2021-09-21 09:53:53', '2021-09-21 09:53:53', 4),
(10, '6mm', NULL, '2021-09-21 09:54:21', '2021-09-21 09:54:21', 5),
(11, '8mm', NULL, '2021-09-21 09:54:31', '2021-09-21 09:54:31', 5),
(12, '10mm', NULL, '2021-09-21 09:54:40', '2021-10-07 11:36:25', 5),
(13, '12mm', NULL, '2021-09-21 09:54:50', '2021-10-07 11:36:28', 5),
(14, '16mm', NULL, '2021-09-21 09:55:03', '2021-10-07 11:36:32', 5),
(15, 'silver sand', NULL, '2021-09-21 09:55:22', '2021-09-21 09:55:22', 2),
(16, 'M seal', NULL, '2021-10-05 03:40:10', '2021-10-05 03:40:10', 7),
(17, 'TMT Bar', NULL, '2021-10-07 11:32:03', '2021-10-07 11:32:03', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchasers`
--

CREATE TABLE `purchasers` (
  `purchaser_id` int(10) UNSIGNED NOT NULL,
  `purchaser_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchaser_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchaser_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchaser_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchasers`
--

INSERT INTO `purchasers` (`purchaser_id`, `purchaser_name`, `company`, `purchaser_mobile`, `purchaser_email`, `purchaser_address`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 'Sujoy Biswas', NULL, NULL, NULL, NULL, 0, '2021-09-27 11:34:38', '2021-09-27 11:34:38'),
(2, 'Kishan jindal', NULL, NULL, NULL, NULL, 0, '2021-09-29 08:33:23', '2021-09-29 08:33:23'),
(3, 'Ambuja cement', NULL, NULL, NULL, NULL, 0, '2021-09-29 08:34:23', '2021-09-29 08:34:23'),
(4, 'Ultra tech cement', NULL, NULL, NULL, NULL, 0, '2021-09-29 08:35:36', '2021-09-29 08:35:36'),
(5, 'Praveen rampurhot', NULL, NULL, NULL, NULL, 0, '2021-09-29 08:48:50', '2021-09-29 08:48:50'),
(6, 'Tonm0y', NULL, NULL, NULL, NULL, 0, '2021-09-29 08:50:39', '2021-09-29 08:50:39'),
(7, 'Gola', NULL, NULL, NULL, NULL, 0, '2021-09-29 09:05:28', '2021-09-29 09:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `purchaser_dues_amt`
--

CREATE TABLE `purchaser_dues_amt` (
  `id` int(11) NOT NULL,
  `purchaser_id` int(11) NOT NULL,
  `previous_due_date` date NOT NULL,
  `previous_due_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaser_dues_amt`
--

INSERT INTO `purchaser_dues_amt` (`id`, `purchaser_id`, `previous_due_date`, `previous_due_amount`, `created_at`, `updated_at`) VALUES
(3, 1, '2021-08-31', 473050, '2021-10-06 05:05:04', '2021-10-06 05:05:04'),
(4, 2, '2021-08-28', 59900, '2021-10-06 05:07:31', '2021-10-06 05:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `purchaser_id` int(10) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `total_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `purchaser_id`, `purchase_date`, `total_amount`, `created_at`, `updated_at`) VALUES
(2, 1, '2021-09-08', 32800.00, '2021-09-29 06:18:21', '2021-09-29 06:18:21'),
(3, 1, '2021-09-09', 29100.00, '2021-09-29 06:19:09', '2021-09-29 06:19:09'),
(4, 1, '2021-09-13', 29100.00, '2021-09-29 06:19:47', '2021-09-29 06:19:47'),
(5, 2, '2021-09-03', 94400.00, '2021-09-29 10:57:22', '2021-09-29 10:57:22'),
(6, 3, '2021-08-18', 126000.00, '2021-09-29 11:00:22', '2021-09-29 11:00:22'),
(7, 3, '2021-09-25', 118000.00, '2021-09-29 11:02:26', '2021-09-29 11:02:26'),
(8, 5, '2021-09-24', 28645.40, '2021-09-30 04:56:21', '2021-09-30 04:56:21'),
(9, 5, '2021-08-22', 25120.00, '2021-09-30 05:02:04', '2021-09-30 05:02:04'),
(10, 2, '2021-10-05', 78000.00, '2021-10-06 05:31:50', '2021-10-06 05:31:50'),
(11, 1, '2021-10-03', 54600.00, '2021-10-06 05:44:13', '2021-10-06 05:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `purchase_payment_id` int(10) UNSIGNED NOT NULL,
  `purchaser_id` int(10) UNSIGNED NOT NULL,
  `paid_date` date NOT NULL,
  `paid_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` double(8,2) NOT NULL DEFAULT 0.00,
  `credit` double(8,2) NOT NULL DEFAULT 0.00,
  `freight` double(8,2) NOT NULL DEFAULT 0.00,
  `paid` double(10,2) NOT NULL DEFAULT 0.00,
  `final_paid` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_payments`
--

INSERT INTO `purchase_payments` (`purchase_payment_id`, `purchaser_id`, `paid_date`, `paid_mode`, `debit`, `credit`, `freight`, `paid`, `final_paid`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-09-03', 'CASH', 0.00, 0.00, 0.00, 49500.00, 49500.00, '2021-09-29 06:20:30', '2021-09-29 06:20:30'),
(2, 1, '2021-09-08', 'FARE', 0.00, 0.00, 0.00, 11500.00, 11500.00, '2021-09-29 06:21:39', '2021-09-29 06:21:39'),
(3, 1, '2021-09-09', 'FARE', 0.00, 0.00, 0.00, 7500.00, 7500.00, '2021-09-29 06:22:04', '2021-09-29 06:22:04'),
(4, 1, '2021-09-11', 'CASH', 0.00, 0.00, 0.00, 49500.00, 49500.00, '2021-09-29 06:22:32', '2021-09-29 06:22:32'),
(5, 1, '2021-09-13', 'FARE', 0.00, 0.00, 0.00, 7500.00, 7500.00, '2021-09-29 06:23:05', '2021-09-29 06:23:05'),
(6, 1, '2021-09-21', 'CASH', 0.00, 0.00, 0.00, 50000.00, 50000.00, '2021-09-29 06:23:31', '2021-09-29 06:23:31'),
(7, 3, '2021-09-24', 'cheque', 0.00, 0.00, 0.00, 70000.00, 70000.00, '2021-09-29 11:07:55', '2021-09-29 11:07:55'),
(8, 5, '2021-08-22', 'CASH', 0.00, 0.00, 0.00, 17700.00, 17700.00, '2021-09-30 05:08:46', '2021-09-30 05:08:46'),
(9, 2, '2021-09-07', 'CASH', 0.00, 0.00, 0.00, 50000.00, 50000.00, '2021-10-06 05:14:44', '2021-10-06 05:14:44'),
(10, 2, '2021-09-26', 'CASH', 0.00, 0.00, 0.00, 50000.00, 50000.00, '2021-10-06 05:23:46', '2021-10-06 05:23:46'),
(11, 1, '2021-10-04', 'CASH', 0.00, 0.00, 0.00, 25000.00, 25000.00, '2021-10-06 05:40:26', '2021-10-06 05:40:26'),
(12, 1, '2021-09-07', 'CASH', 0.00, 0.00, 0.00, 20000.00, 20000.00, '2021-10-06 05:41:26', '2021-10-06 05:41:26'),
(13, 1, '2021-10-03', 'FARE', 0.00, 0.00, 0.00, 13800.00, 13800.00, '2021-10-06 05:45:51', '2021-10-06 05:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `purchase_product_id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` double(10,2) NOT NULL,
  `gst` double(10,2) NOT NULL DEFAULT 0.00,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`purchase_product_id`, `purchase_id`, `product_id`, `unit_id`, `quantity`, `rate`, `gst`, `amount`, `created_at`, `updated_at`) VALUES
(2, 2, 5, 2, 1000, 9.70, 0.00, 9700.00, '2021-09-29 06:18:21', '2021-09-29 06:18:21'),
(3, 2, 6, 2, 3000, 7.70, 0.00, 23100.00, '2021-09-29 06:18:21', '2021-09-29 06:18:21'),
(4, 3, 5, 2, 3000, 9.70, 0.00, 29100.00, '2021-09-29 06:19:09', '2021-09-29 06:19:09'),
(5, 4, 5, 2, 3000, 9.70, 0.00, 29100.00, '2021-09-29 06:19:47', '2021-09-29 06:19:47'),
(6, 5, 3, 1, 320, 295.00, 0.00, 94400.00, '2021-09-29 10:57:22', '2021-09-29 10:57:22'),
(7, 6, 3, 1, 400, 315.00, 0.00, 126000.00, '2021-09-29 11:00:22', '2021-09-29 11:00:22'),
(8, 7, 3, 1, 400, 295.00, 0.00, 118000.00, '2021-09-29 11:02:26', '2021-09-29 11:02:26'),
(9, 8, 7, 3, 18, 1580.00, 0.00, 28645.40, '2021-09-30 04:56:21', '2021-09-30 04:56:21'),
(10, 9, 7, 3, 16, 1570.00, 0.00, 25120.00, '2021-09-30 05:02:04', '2021-09-30 05:02:04'),
(11, 10, 3, 1, 260, 300.00, 0.00, 78000.00, '2021-10-06 05:31:50', '2021-10-06 05:31:50'),
(12, 11, 5, 2, 6000, 9.10, 0.00, 54600.00, '2021-10-06 05:44:13', '2021-10-06 05:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `sell_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `sell_date` date NOT NULL,
  `payment_received` double(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`sell_id`, `customer_id`, `sell_date`, `payment_received`, `total_amount`, `created_at`, `updated_at`, `status`) VALUES
(2, 2, '2021-09-01', 0.00, 3675.00, '2021-09-21 11:35:48', '2021-09-27 04:49:34', 0),
(3, 3, '2021-09-01', 0.00, 1225.00, '2021-09-21 11:44:09', '2021-09-24 11:10:40', 0),
(4, 1, '2021-09-01', 0.00, 4825.00, '2021-09-21 11:50:22', '2021-09-21 11:50:22', 0),
(5, 3, '2021-09-02', 0.00, 4475.00, '2021-09-22 10:12:20', '2021-09-24 11:10:40', 0),
(6, 3, '2021-09-03', 0.00, 1100.00, '2021-09-22 10:17:33', '2021-09-24 11:10:40', 0),
(7, 3, '2021-09-04', 0.00, 1350.00, '2021-09-22 10:19:56', '2021-09-24 11:10:40', 0),
(8, 3, '2021-09-05', 0.00, 1350.00, '2021-09-22 10:21:18', '2021-09-24 11:10:40', 0),
(9, 3, '2021-09-06', 0.00, 1650.00, '2021-09-22 10:23:53', '2021-09-24 11:10:40', 0),
(10, 3, '2021-09-08', 0.00, 3800.00, '2021-09-22 10:25:36', '2021-09-24 11:10:40', 0),
(11, 3, '2021-09-12', 0.00, 2400.00, '2021-09-22 10:28:41', '2021-09-22 10:28:41', 0),
(12, 4, '2021-09-01', 0.00, 360.00, '2021-09-22 10:45:55', '2021-09-22 10:45:55', 0),
(13, 5, '2021-09-02', 0.00, 2410.00, '2021-09-22 10:53:42', '2021-09-22 10:53:42', 0),
(14, 7, '2021-09-09', 0.00, 2950.00, '2021-09-23 11:02:03', '2021-09-23 11:02:03', 0),
(16, 9, '2021-09-03', 0.00, 12800.00, '2021-09-23 11:23:49', '2021-09-23 11:23:49', 0),
(19, 11, '2021-09-13', 0.00, 3720.00, '2021-09-24 04:11:46', '2021-09-24 04:11:46', 0),
(24, 16, '2021-09-25', 0.00, 1397.50, '2021-09-25 06:38:58', '2021-09-25 06:38:58', 0),
(25, 18, '2021-09-08', 0.00, 2760.00, '2021-09-25 07:31:54', '2021-09-25 07:31:54', 0),
(26, 3, '2021-09-13', 0.00, 2650.00, '2021-09-25 11:22:41', '2021-09-26 10:22:44', 0),
(27, 3, '2021-09-14', 0.00, 2600.00, '2021-09-25 11:23:10', '2021-09-26 10:23:12', 0),
(28, 3, '2021-09-19', 0.00, 3300.00, '2021-09-25 11:23:52', '2021-09-26 10:23:48', 0),
(32, 22, '2021-09-12', 0.00, 7550.00, '2021-09-26 05:15:12', '2021-09-26 05:15:12', 0),
(34, 22, '2021-09-13', 0.00, 3000.00, '2021-09-26 05:32:50', '2021-09-26 05:32:50', 0),
(38, 22, '2021-09-14', 0.00, 1200.00, '2021-09-26 09:44:48', '2021-09-26 09:46:17', 0),
(39, 22, '2021-09-15', 0.00, 2400.00, '2021-09-26 09:47:36', '2021-09-26 09:47:36', 0),
(40, 22, '2021-09-18', 0.00, 7700.00, '2021-09-26 09:54:13', '2021-09-26 09:54:13', 0),
(41, 22, '2021-09-20', 0.00, 3600.00, '2021-09-26 09:54:47', '2021-09-26 09:54:47', 0),
(42, 22, '2021-09-21', 0.00, 7200.00, '2021-09-26 09:55:23', '2021-09-26 09:55:23', 0),
(43, 22, '2021-09-22', 0.00, 2200.00, '2021-09-26 09:56:03', '2021-09-26 09:56:03', 0),
(44, 22, '2021-09-23', 0.00, 7400.00, '2021-09-26 09:59:49', '2021-10-05 02:22:47', 0),
(45, 22, '2021-09-23', 0.00, 560.00, '2021-09-26 10:00:20', '2021-09-26 10:00:20', 0),
(46, 22, '2021-09-24', 0.00, 2600.00, '2021-09-26 10:00:44', '2021-10-05 02:38:30', 0),
(48, 27, '2021-09-16', 0.00, 22500.00, '2021-09-26 10:04:59', '2021-09-26 10:04:59', 0),
(49, 27, '2021-09-21', 0.00, 11500.00, '2021-09-26 10:05:56', '2021-09-26 10:05:56', 0),
(50, 27, '2021-09-25', 0.00, 11770.00, '2021-09-26 10:08:07', '2021-09-26 10:08:07', 0),
(51, 27, '2021-09-25', 0.00, 2610.00, '2021-09-26 10:09:33', '2021-09-26 10:09:33', 0),
(52, 28, '2021-09-24', 0.00, 3600.00, '2021-09-26 10:14:40', '2021-09-26 10:14:40', 0),
(53, 3, '2021-09-25', 0.00, 1300.00, '2021-09-26 10:17:46', '2021-09-26 10:17:46', 0),
(55, 10, '2021-09-13', 0.00, 3840.00, '2021-09-26 11:28:25', '2021-10-05 05:01:45', 0),
(56, 10, '2021-09-14', 0.00, 1950.00, '2021-09-26 11:30:13', '2021-09-26 11:30:13', 0),
(57, 10, '2021-09-16', 0.00, 1020.00, '2021-09-26 11:32:54', '2021-10-05 05:03:55', 0),
(58, 10, '2021-09-21', 0.00, 1700.00, '2021-09-26 11:34:45', '2021-10-05 05:07:03', 0),
(59, 10, '2021-09-22', 0.00, 1040.00, '2021-09-26 11:35:45', '2021-09-26 11:35:45', 0),
(60, 10, '2021-09-23', 0.00, 1350.00, '2021-09-26 11:37:40', '2021-10-05 05:10:33', 0),
(61, 10, '2021-09-24', 0.00, 1050.00, '2021-09-26 11:38:38', '2021-10-05 05:12:41', 0),
(62, 2, '2021-09-02', 0.00, 3600.00, '2021-09-27 04:21:10', '2021-09-27 04:21:10', 0),
(63, 2, '2021-09-07', 0.00, 450.00, '2021-09-27 04:22:36', '2021-09-27 04:50:48', 0),
(64, 2, '2021-09-13', 0.00, 3600.00, '2021-09-27 04:24:21', '2021-09-27 04:24:21', 0),
(65, 2, '2021-09-16', 0.00, 1400.00, '2021-09-27 04:27:16', '2021-09-27 04:27:16', 0),
(66, 2, '2021-09-19', 0.00, 1400.00, '2021-09-27 04:29:17', '2021-09-27 04:29:17', 0),
(67, 2, '2021-09-20', 0.00, 1875.00, '2021-09-27 04:30:55', '2021-09-27 04:30:55', 0),
(68, 2, '2021-09-22', 0.00, 1950.00, '2021-09-27 04:33:00', '2021-09-27 04:33:00', 0),
(69, 2, '2021-09-23', 0.00, 4680.00, '2021-09-27 04:35:19', '2021-09-27 04:35:19', 0),
(70, 2, '2021-09-24', 0.00, 3960.00, '2021-09-27 04:36:59', '2021-09-27 04:36:59', 0),
(71, 29, '2021-09-10', 0.00, 3000.00, '2021-09-27 05:39:48', '2021-09-27 05:39:48', 0),
(72, 29, '2021-09-11', 0.00, 1720.00, '2021-09-27 05:43:16', '2021-09-27 06:20:41', 0),
(73, 29, '2021-09-12', 0.00, 6300.00, '2021-09-27 05:47:25', '2021-09-27 05:47:25', 0),
(74, 29, '2021-09-13', 0.00, 3000.00, '2021-09-27 05:48:51', '2021-09-27 05:48:51', 0),
(75, 29, '2021-09-18', 0.00, 2600.00, '2021-09-27 06:24:19', '2021-09-27 06:24:19', 0),
(76, 29, '2021-09-25', 0.00, 2020.00, '2021-09-27 06:26:20', '2021-09-27 06:26:20', 0),
(77, 21, '2021-09-07', 0.00, 9000.00, '2021-09-27 11:03:00', '2021-09-27 11:03:00', 0),
(78, 21, '2021-09-10', 0.00, 7000.00, '2021-09-27 11:04:36', '2021-09-27 11:04:36', 0),
(79, 21, '2021-09-11', 0.00, 3125.00, '2021-09-27 11:07:19', '2021-09-27 11:07:19', 0),
(80, 21, '2021-09-15', 0.00, 5250.00, '2021-09-27 11:08:43', '2021-09-27 11:08:43', 0),
(82, 30, '2021-09-27', 0.00, 3940.00, '2021-09-28 02:54:39', '2021-09-30 11:15:04', 0),
(83, 31, '2021-09-25', 0.00, 1490.00, '2021-09-28 03:04:00', '2021-09-28 03:04:00', 0),
(84, 31, '2021-09-26', 0.00, 620.00, '2021-09-28 03:06:03', '2021-09-28 03:06:03', 0),
(85, 32, '2021-09-27', 0.00, 1300.00, '2021-09-28 03:11:11', '2021-09-28 03:11:11', 0),
(86, 22, '2021-09-26', 0.00, 2600.00, '2021-09-28 03:25:21', '2021-09-28 03:25:21', 0),
(87, 10, '2021-09-26', 0.00, 1700.00, '2021-09-28 03:35:25', '2021-10-05 05:14:33', 0),
(89, 33, '2021-09-12', 0.00, 9075.00, '2021-09-28 03:49:05', '2021-09-28 03:49:05', 0),
(90, 33, '2021-09-21', 0.00, 1800.00, '2021-09-28 03:50:39', '2021-09-28 03:50:39', 0),
(91, 33, '2021-09-26', 0.00, 720.00, '2021-09-28 03:52:18', '2021-09-28 03:52:18', 0),
(92, 29, '2021-09-26', 0.00, 3390.00, '2021-09-28 04:23:59', '2021-09-28 04:23:59', 0),
(93, 3, '2021-09-27', 0.00, 2020.00, '2021-09-28 04:30:01', '2021-09-28 04:30:01', 0),
(94, 34, '2021-09-03', 0.00, 5600.00, '2021-09-28 05:05:52', '2021-09-28 05:05:52', 0),
(95, 34, '2021-09-05', 0.00, 5000.00, '2021-09-28 05:09:03', '2021-09-28 05:09:03', 0),
(96, 34, '2021-09-07', 0.00, 2200.00, '2021-09-28 05:11:10', '2021-09-28 05:11:10', 0),
(97, 34, '2021-09-10', 0.00, 4375.00, '2021-09-28 05:12:33', '2021-09-28 05:12:33', 0),
(98, 34, '2021-09-11', 0.00, 3125.00, '2021-09-28 05:14:03', '2021-09-28 05:14:03', 0),
(99, 34, '2021-09-13', 0.00, 3600.00, '2021-09-28 05:15:08', '2021-09-28 05:15:08', 0),
(100, 34, '2021-09-14', 0.00, 2700.00, '2021-09-28 05:16:56', '2021-09-28 05:31:56', 0),
(101, 34, '2021-09-15', 0.00, 4600.00, '2021-09-28 05:19:41', '2021-09-28 05:33:58', 0),
(102, 34, '2021-09-16', 0.00, 2800.00, '2021-09-28 05:23:42', '2021-09-28 05:23:42', 0),
(103, 34, '2021-09-18', 0.00, 3200.00, '2021-09-28 05:27:05', '2021-09-28 05:27:05', 0),
(104, 34, '2021-09-20', 0.00, 4200.00, '2021-09-28 05:28:26', '2021-09-28 05:28:26', 0),
(105, 34, '2021-09-04', 0.00, 1520.00, '2021-09-28 05:52:37', '2021-09-28 05:52:37', 0),
(107, 40, '2021-09-28', 0.00, 5250.00, '2021-09-29 03:42:46', '2021-10-01 07:31:51', 0),
(109, 22, '2021-09-28', 0.00, 3700.00, '2021-09-29 03:46:58', '2021-10-05 02:29:32', 0),
(110, 23, '2021-09-28', 0.00, 3500.00, '2021-09-29 03:48:42', '2021-09-29 03:48:42', 0),
(111, 2, '2021-09-28', 0.00, 650.00, '2021-09-29 03:50:10', '2021-09-29 03:50:10', 0),
(112, 4, '2021-09-28', 0.00, 1010.00, '2021-09-29 03:52:48', '2021-09-29 03:52:48', 0),
(113, 12, '2021-09-28', 0.00, 7000.00, '2021-09-29 03:55:49', '2021-09-29 03:55:49', 0),
(114, 32, '2021-09-28', 0.00, 1100.00, '2021-09-29 03:59:07', '2021-09-29 03:59:07', 0),
(115, 34, '2021-09-28', 0.00, 2700.00, '2021-09-29 04:07:27', '2021-10-05 02:51:17', 0),
(116, 13, '2021-08-31', 0.00, 4500.00, '2021-09-29 05:57:46', '2021-09-29 05:57:46', 0),
(117, 13, '2021-09-04', 0.00, 3700.00, '2021-09-29 05:58:50', '2021-10-04 06:02:09', 0),
(118, 13, '2021-09-05', 0.00, 2700.00, '2021-09-29 05:59:39', '2021-10-04 06:03:21', 0),
(119, 13, '2021-09-09', 0.00, 5500.00, '2021-09-29 06:00:54', '2021-10-04 06:05:17', 0),
(120, 13, '2021-09-10', 0.00, 5350.00, '2021-09-29 06:02:46', '2021-09-29 06:02:46', 0),
(121, 13, '2021-09-18', 0.00, 2400.00, '2021-09-29 06:03:39', '2021-09-29 06:03:40', 0),
(122, 30, '2021-09-29', 0.00, 1460.00, '2021-09-30 04:32:41', '2021-09-30 11:16:17', 0),
(123, 22, '2021-09-29', 0.00, 2400.00, '2021-09-30 04:41:34', '2021-10-05 02:13:39', 0),
(124, 15, '2021-09-06', 0.00, 3000.00, '2021-09-30 06:18:37', '2021-09-30 06:18:37', 0),
(125, 15, '2021-09-08', 0.00, 3000.00, '2021-09-30 06:20:31', '2021-09-30 06:20:31', 0),
(126, 15, '2021-09-08', 0.00, 7200.00, '2021-09-30 06:22:13', '2021-09-30 06:22:13', 0),
(127, 15, '2021-09-11', 0.00, 8000.00, '2021-09-30 06:24:25', '2021-09-30 06:24:25', 0),
(128, 15, '2021-09-15', 0.00, 1740.00, '2021-09-30 06:28:03', '2021-09-30 06:28:03', 0),
(129, 15, '2021-09-16', 0.00, 1300.00, '2021-09-30 06:29:09', '2021-09-30 06:29:09', 0),
(130, 15, '2021-09-21', 0.00, 1520.00, '2021-09-30 06:30:55', '2021-09-30 06:30:55', 0),
(132, 15, '2021-09-25', 0.00, 1600.00, '2021-09-30 06:38:38', '2021-09-30 06:38:38', 0),
(135, 42, '2021-06-23', 0.00, 37800.00, '2021-09-30 07:01:50', '2021-09-30 07:01:50', 0),
(136, 42, '2021-06-27', 0.00, 3800.00, '2021-09-30 07:03:27', '2021-09-30 07:03:27', 0),
(137, 42, '2021-07-07', 0.00, 32000.00, '2021-09-30 07:08:19', '2021-09-30 07:08:19', 0),
(138, 42, '2021-08-03', 0.00, 55000.00, '2021-09-30 07:09:41', '2021-09-30 07:09:41', 0),
(139, 42, '2021-08-22', 0.00, 33000.00, '2021-09-30 07:10:55', '2021-09-30 07:10:55', 0),
(140, 30, '2021-09-26', 0.00, 3025.00, '2021-09-30 11:17:58', '2021-09-30 11:17:58', 0),
(141, 30, '2021-09-28', 0.00, 875.00, '2021-09-30 11:19:18', '2021-09-30 11:19:18', 0),
(146, 34, '2021-09-30', 0.00, 1200.00, '2021-10-01 07:12:51', '2021-10-01 07:12:51', 0),
(147, 39, '2021-09-30', 0.00, 880.00, '2021-10-01 07:18:58', '2021-10-01 07:18:58', 0),
(148, 22, '2021-09-30', 0.00, 7180.00, '2021-10-01 07:22:06', '2021-10-05 02:15:02', 0),
(149, 23, '2021-09-30', 0.00, 1100.00, '2021-10-01 07:23:18', '2021-10-01 07:23:18', 0),
(150, 28, '2021-09-30', 0.00, 3500.00, '2021-10-01 07:25:08', '2021-10-01 07:25:08', 0),
(151, 22, '2021-10-01', 0.00, 4900.00, '2021-10-02 05:10:06', '2021-10-02 05:10:06', 0),
(152, 2, '2021-10-01', 0.00, 1400.00, '2021-10-02 05:11:21', '2021-10-02 05:11:21', 0),
(153, 3, '2021-10-02', 0.00, 1760.00, '2021-10-02 05:13:21', '2021-10-02 05:13:21', 0),
(155, 43, '2021-10-01', 0.00, 3500.00, '2021-10-02 05:18:39', '2021-10-02 05:18:39', 0),
(156, 44, '2021-09-29', 0.00, 1650.00, '2021-10-02 05:22:57', '2021-10-02 05:22:57', 0),
(157, 44, '2021-09-30', 0.00, 1430.00, '2021-10-02 05:27:00', '2021-10-02 05:27:00', 0),
(158, 44, '2021-10-01', 0.00, 1200.00, '2021-10-02 05:28:06', '2021-10-02 05:28:06', 0),
(159, 30, '2021-10-02', 0.00, 360.00, '2021-10-04 02:37:45', '2021-10-04 02:37:45', 0),
(160, 22, '2021-10-02', 0.00, 3700.00, '2021-10-04 02:39:54', '2021-10-04 02:39:54', 0),
(161, 22, '2021-10-03', 0.00, 3900.00, '2021-10-04 02:40:57', '2021-10-05 02:18:35', 0),
(162, 28, '2021-10-02', 0.00, 3240.00, '2021-10-04 02:42:31', '2021-10-04 02:42:31', 0),
(163, 27, '2021-10-02', 0.00, 3500.00, '2021-10-04 02:43:57', '2021-10-04 02:43:57', 0),
(166, 12, '2021-09-06', 0.00, 7687.50, '2021-10-04 03:03:05', '2021-10-04 03:18:58', 0),
(167, 12, '2021-09-07', 0.00, 8212.50, '2021-10-04 03:05:53', '2021-10-04 03:20:51', 0),
(168, 12, '2021-09-27', 0.00, 3500.00, '2021-10-04 03:07:33', '2021-10-04 03:13:25', 0),
(169, 12, '2021-09-08', 0.00, 5000.00, '2021-10-04 03:22:56', '2021-10-04 03:22:56', 0),
(170, 12, '2021-09-05', 0.00, 3500.00, '2021-10-04 03:46:01', '2021-10-04 03:46:01', 0),
(171, 12, '2021-09-24', 0.00, 12000.00, '2021-10-04 03:48:08', '2021-10-04 03:48:08', 0),
(172, 12, '2021-09-04', 0.00, 3500.00, '2021-10-04 03:50:24', '2021-10-04 03:50:24', 0),
(173, 12, '2021-10-01', 0.00, 7788.00, '2021-10-04 03:54:08', '2021-10-04 03:54:08', 0),
(174, 12, '2021-10-02', 0.00, 2112.00, '2021-10-04 03:55:40', '2021-10-04 03:55:41', 0),
(175, 12, '2021-10-03', 0.00, 1100.00, '2021-10-04 03:56:51', '2021-10-04 03:56:51', 0),
(176, 43, '2021-10-02', 0.00, 3500.00, '2021-10-04 03:59:10', '2021-10-04 03:59:10', 0),
(177, 1, '2021-10-03', 0.00, 2550.00, '2021-10-04 04:04:34', '2021-10-04 04:04:34', 0),
(178, 4, '2021-10-03', 0.00, 360.00, '2021-10-04 04:05:35', '2021-10-04 04:05:35', 0),
(179, 11, '2021-10-03', 0.00, 2200.00, '2021-10-04 04:10:45', '2021-10-04 04:10:45', 0),
(180, 45, '2021-10-03', 0.00, 1300.00, '2021-10-04 04:15:49', '2021-10-04 04:15:50', 0),
(181, 46, '2021-10-03', 0.00, 1760.00, '2021-10-04 04:17:10', '2021-10-04 04:17:10', 0),
(182, 47, '2021-09-19', 0.00, 2120.00, '2021-10-04 04:21:44', '2021-10-04 04:21:44', 0),
(183, 47, '2021-09-21', 0.00, 1980.00, '2021-10-04 04:24:06', '2021-10-04 04:24:06', 0),
(184, 47, '2021-10-03', 0.00, 260.00, '2021-10-04 04:26:34', '2021-10-04 04:26:34', 0),
(185, 47, '2021-09-29', 0.00, 1110.00, '2021-10-04 04:31:11', '2021-10-04 04:31:11', 0),
(186, 22, '2021-09-25', 0.00, 4800.00, '2021-10-05 02:32:13', '2021-10-05 02:32:13', 0),
(187, 34, '2021-09-27', 0.00, 5937.50, '2021-10-05 02:54:16', '2021-10-05 02:54:16', 0),
(188, 34, '2021-09-28', 0.00, 190.00, '2021-10-05 03:44:13', '2021-10-05 03:44:13', 0),
(189, 48, '2021-09-11', 0.00, 6600.00, '2021-10-05 04:31:38', '2021-10-05 04:31:38', 0),
(191, 48, '2021-09-26', 0.00, 720.00, '2021-10-05 04:35:18', '2021-10-05 04:35:18', 0),
(192, 48, '2021-10-04', 0.00, 720.00, '2021-10-05 04:36:22', '2021-10-05 04:36:22', 0),
(193, 33, '2021-09-12', 0.00, 3600.00, '2021-10-05 04:40:12', '2021-10-05 04:40:12', 0),
(194, 48, '2021-09-21', 0.00, 1800.00, '2021-10-05 04:41:28', '2021-10-05 04:41:28', 0),
(195, 48, '2021-09-12', 0.00, 3600.00, '2021-10-05 04:45:16', '2021-10-05 04:45:16', 0),
(196, 10, '2021-09-03', 0.00, 1960.00, '2021-10-05 05:33:51', '2021-10-05 05:33:51', 0),
(197, 10, '2021-09-05', 0.00, 2600.00, '2021-10-05 05:34:54', '2021-10-05 05:34:54', 0),
(198, 10, '2021-09-08', 0.00, 4760.00, '2021-10-05 05:37:32', '2021-10-05 05:37:32', 0),
(199, 10, '2021-09-09', 0.00, 5120.00, '2021-10-05 05:39:37', '2021-10-05 05:39:37', 0),
(200, 10, '2021-09-11', 0.00, 2600.00, '2021-10-05 05:40:49', '2021-10-05 05:40:49', 0),
(201, 10, '2021-09-12', 0.00, 720.00, '2021-10-05 05:41:55', '2021-10-05 05:41:55', 0),
(202, 28, '2021-10-05', 0.00, 3600.00, '2021-10-06 03:32:46', '2021-10-06 03:32:47', 0),
(203, 28, '2021-10-04', 0.00, 3600.00, '2021-10-06 03:40:05', '2021-10-06 03:40:05', 0),
(204, 2, '2021-10-04', 0.00, 3200.00, '2021-10-06 03:43:28', '2021-10-06 03:43:28', 0),
(205, 34, '2021-10-04', 0.00, 1800.00, '2021-10-06 03:45:31', '2021-10-06 03:45:31', 0),
(206, 34, '2021-10-05', 0.00, 2600.00, '2021-10-06 03:48:18', '2021-10-06 04:05:25', 0),
(207, 25, '2021-10-04', 0.00, 1400.00, '2021-10-06 03:55:57', '2021-10-06 04:03:07', 0),
(208, 25, '2021-10-05', 0.00, 11000.00, '2021-10-06 03:59:55', '2021-10-06 03:59:55', 0),
(209, 40, '2021-10-06', 0.00, 3500.00, '2021-10-06 04:08:24', '2021-10-06 04:08:24', 0),
(210, 49, '2021-10-05', 0.00, 1800.00, '2021-10-06 04:12:47', '2021-10-11 04:59:29', 0),
(211, 50, '2021-10-04', 0.00, 1120.00, '2021-10-06 04:16:01', '2021-10-06 04:16:01', 0),
(212, 50, '2021-10-05', 0.00, 2320.00, '2021-10-06 04:18:22', '2021-10-06 04:18:22', 0),
(213, 25, '2021-08-21', 0.00, 6360.00, '2021-10-07 03:36:31', '2021-10-07 03:36:31', 0),
(214, 25, '2021-09-14', 0.00, 3600.00, '2021-10-07 03:38:28', '2021-10-07 03:54:23', 0),
(215, 25, '2021-09-15', 0.00, 32400.00, '2021-10-07 03:41:41', '2021-10-07 03:47:26', 0),
(216, 25, '2021-10-06', 0.00, 9000.00, '2021-10-07 03:46:00', '2021-10-07 03:46:00', 0),
(217, 51, '2021-09-03', 0.00, 35964.00, '2021-10-07 04:17:35', '2021-10-07 04:17:35', 0),
(218, 51, '2021-09-10', 0.00, 40000.00, '2021-10-07 04:23:25', '2021-10-07 04:23:25', 0),
(219, 51, '2021-09-13', 0.00, 24000.00, '2021-10-07 04:24:56', '2021-10-07 04:24:56', 0),
(220, 51, '2021-09-24', 0.00, 32814.00, '2021-10-07 04:26:49', '2021-10-07 04:26:49', 0),
(221, 51, '2021-09-25', 0.00, 24000.00, '2021-10-07 04:28:18', '2021-10-07 04:28:18', 0),
(223, 51, '2021-09-26', 0.00, 24000.00, '2021-10-07 04:32:45', '2021-10-07 04:32:45', 0),
(224, 51, '2021-10-03', 0.00, 55000.00, '2021-10-07 04:36:20', '2021-10-07 04:36:20', 0),
(225, 51, '2021-10-06', 0.00, 45000.00, '2021-10-07 04:37:37', '2021-10-07 04:37:37', 0),
(226, 52, '2021-07-12', 0.00, 32000.00, '2021-10-07 05:47:38', '2021-10-07 05:47:38', 0),
(227, 52, '2021-07-15', 0.00, 37350.00, '2021-10-07 05:49:44', '2021-10-07 05:49:44', 0),
(228, 52, '2021-07-17', 0.00, 27300.00, '2021-10-07 05:52:42', '2021-10-07 05:52:42', 0),
(230, 22, '2021-10-06', 0.00, 1990.00, '2021-10-08 02:43:47', '2021-10-08 02:43:47', 0),
(231, 12, '2021-10-06', 0.00, 11200.00, '2021-10-08 02:46:29', '2021-10-08 02:46:29', 0),
(232, 12, '2021-10-07', 0.00, 8800.00, '2021-10-08 02:50:33', '2021-10-08 02:50:33', 0),
(233, 25, '2021-10-07', 0.00, 9000.00, '2021-10-08 02:55:00', '2021-10-08 02:55:00', 0),
(234, 4, '2021-10-07', 0.00, 920.00, '2021-10-08 02:57:41', '2021-10-08 02:57:41', 0),
(235, 2, '2021-10-07', 0.00, 7200.00, '2021-10-08 03:00:17', '2021-10-08 03:00:17', 0),
(236, 34, '2021-10-07', 0.00, 6200.00, '2021-10-08 03:03:05', '2021-10-08 03:03:05', 0),
(237, 55, '2021-10-07', 0.00, 1960.00, '2021-10-08 03:11:45', '2021-10-08 03:11:45', 0),
(238, 54, '2021-09-10', 0.00, 1580.00, '2021-10-08 03:14:33', '2021-10-08 03:14:33', 0),
(239, 54, '2021-09-11', 0.00, 1000.00, '2021-10-08 03:15:49', '2021-10-08 03:15:49', 0),
(240, 54, '2021-10-06', 0.00, 1060.00, '2021-10-08 03:18:08', '2021-10-08 03:18:08', 0),
(241, 53, '2021-10-06', 0.00, 1760.00, '2021-10-08 03:22:58', '2021-10-08 03:22:58', 0),
(242, 53, '2021-10-07', 0.00, 2670.00, '2021-10-08 03:24:45', '2021-10-08 03:24:45', 0),
(243, 55, '2021-10-07', 0.00, 900.00, '2021-10-08 04:00:13', '2021-10-08 04:00:13', 0),
(244, 52, '2021-07-21', 0.00, 5650.00, '2021-10-08 05:19:16', '2021-10-08 05:19:16', 0),
(245, 52, '2021-07-22', 0.00, 16950.00, '2021-10-08 05:21:21', '2021-10-08 05:21:21', 0),
(246, 52, '2021-08-07', 0.00, 7600.00, '2021-10-08 05:23:26', '2021-10-08 05:23:26', 0),
(247, 52, '2021-08-12', 0.00, 8320.00, '2021-10-08 05:25:20', '2021-10-08 05:25:20', 0),
(248, 52, '2021-08-14', 0.00, 18900.00, '2021-10-08 05:27:26', '2021-10-08 05:27:26', 0),
(249, 52, '2021-08-23', 0.00, 3500.00, '2021-10-08 05:28:56', '2021-10-08 05:28:56', 0),
(250, 52, '2021-07-17', 0.00, 42717.80, '2021-10-08 05:36:34', '2021-10-08 05:36:34', 0),
(251, 55, '2021-10-08', 0.00, 2950.00, '2021-10-09 07:00:51', '2021-10-09 07:00:51', 0),
(252, 2, '2021-10-08', 0.00, 6700.00, '2021-10-09 07:03:48', '2021-10-09 07:03:48', 0),
(253, 22, '2021-10-08', 0.00, 2880.00, '2021-10-09 07:06:37', '2021-10-09 07:06:37', 0),
(254, 4, '2021-10-08', 0.00, 5800.00, '2021-10-09 07:10:06', '2021-10-09 07:10:06', 0),
(255, 11, '2021-10-08', 0.00, 1300.00, '2021-10-09 07:14:25', '2021-10-09 07:14:25', 0),
(256, 53, '2021-10-08', 0.00, 1200.00, '2021-10-09 07:15:22', '2021-10-09 07:15:22', 0),
(257, 34, '2021-10-08', 0.00, 4400.00, '2021-10-09 07:33:23', '2021-10-09 07:33:24', 0),
(258, 51, '2021-10-09', 0.00, 7200.00, '2021-10-10 02:31:47', '2021-10-10 02:31:47', 0),
(259, 55, '2021-10-09', 0.00, 5600.00, '2021-10-10 02:33:28', '2021-10-10 02:33:28', 0),
(260, 12, '2021-10-09', 0.00, 7200.00, '2021-10-10 02:34:45', '2021-10-10 02:34:45', 0),
(261, 25, '2021-10-09', 0.00, 9600.00, '2021-10-10 02:36:26', '2021-10-10 02:36:26', 0),
(263, 53, '2021-10-09', 0.00, 2740.00, '2021-10-10 02:38:56', '2021-10-10 02:38:56', 0),
(264, 34, '2021-10-09', 0.00, 1400.00, '2021-10-10 02:48:49', '2021-10-10 02:48:49', 0),
(265, 55, '2021-10-10', 0.00, 1300.00, '2021-10-11 04:36:47', '2021-10-11 04:36:47', 0),
(266, 49, '2021-10-10', 0.00, 1800.00, '2021-10-11 04:37:54', '2021-10-11 04:37:54', 0),
(267, 27, '2021-10-10', 0.00, 3500.00, '2021-10-11 04:40:31', '2021-10-11 04:40:31', 0),
(268, 12, '2021-10-10', 0.00, 8000.00, '2021-10-11 04:43:21', '2021-10-11 04:43:21', 0),
(269, 43, '2021-10-10', 0.00, 3150.00, '2021-10-11 04:45:33', '2021-10-11 04:45:33', 0),
(270, 34, '2021-10-10', 0.00, 1200.00, '2021-10-11 04:47:28', '2021-10-11 04:47:28', 0),
(272, 57, '2021-10-10', 0.00, 1800.00, '2021-10-11 04:51:37', '2021-10-11 04:51:37', 0),
(273, 55, '2021-10-11', 0.00, 650.00, '2021-10-12 03:34:27', '2021-10-12 03:34:27', 0),
(274, 55, '2021-10-11', 0.00, 350.00, '2021-10-12 03:35:30', '2021-10-12 03:35:30', 0),
(275, 51, '2021-10-11', 0.00, 2520.00, '2021-10-12 03:36:51', '2021-10-12 03:36:51', 0),
(276, 22, '2021-10-11', 0.00, 650.00, '2021-10-12 03:38:16', '2021-10-12 03:38:16', 0),
(277, 4, '2021-10-11', 0.00, 3520.00, '2021-10-12 03:39:46', '2021-10-12 03:39:46', 0),
(278, 58, '2021-09-24', 0.00, 980.00, '2021-10-12 03:48:51', '2021-10-12 03:48:51', 0),
(279, 58, '2021-09-28', 0.00, 130.00, '2021-10-12 03:49:39', '2021-10-12 03:49:39', 0),
(280, 58, '2021-09-29', 0.00, 130.00, '2021-10-12 03:50:34', '2021-10-12 03:50:34', 0),
(281, 58, '2021-10-11', 0.00, 380.00, '2021-10-12 03:52:41', '2021-10-12 03:52:41', 0),
(282, 36, '2021-10-11', 0.00, 1400.00, '2021-10-12 03:58:34', '2021-10-12 03:58:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sell_payamounts`
--

CREATE TABLE `sell_payamounts` (
  `pay_amount_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `pay_date` date NOT NULL,
  `pay_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_received` double(10,2) NOT NULL DEFAULT 0.00,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sell_payamounts`
--

INSERT INTO `sell_payamounts` (`pay_amount_id`, `customer_id`, `pay_date`, `pay_mode`, `pay_received`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 9, '2021-09-03', 'cash', 10000.00, 'NULL', '2021-09-23 11:25:54', '2021-09-23 11:25:54', 0),
(3, 26, '2021-09-19', 'cash', 1000.00, 'NULL', '2021-09-25 11:38:40', '2021-09-25 11:38:40', 0),
(4, 22, '2021-09-15', 'Cash', 10000.00, 'NULL', '2021-09-26 04:54:29', '2021-09-26 04:54:29', 0),
(6, 22, '2021-09-23', 'cash', 24500.00, 'NULL', '2021-09-26 09:58:20', '2021-09-26 09:58:20', 1),
(7, 22, '2021-09-23', 'cash', 350.00, 'Discount', '2021-09-26 09:58:20', '2021-09-26 09:58:20', 2),
(8, 27, '2021-09-25', 'cash', 30000.00, 'NULL', '2021-09-26 10:11:23', '2021-09-26 10:11:23', 0),
(9, 28, '2021-09-25', 'cas', 10000.00, 'NULL', '2021-09-26 10:15:49', '2021-09-26 10:15:49', 0),
(10, 3, '2021-09-21', 'cash', 15000.00, 'NULL', '2021-09-26 10:18:06', '2021-09-26 10:18:06', 0),
(12, 29, '2021-09-10', 'cash', 2000.00, 'NULL', '2021-09-27 06:02:19', '2021-09-27 06:02:19', 0),
(13, 29, '2021-09-17', 'cash', 12020.00, 'NULL', '2021-09-27 06:12:36', '2021-09-27 06:12:36', 0),
(14, 21, '2021-09-06', 'cash', 20000.00, 'NULL', '2021-09-27 11:26:41', '2021-09-27 11:26:41', 0),
(17, 42, '2021-07-05', 'cash', 20000.00, 'NULL', '2021-09-30 07:16:47', '2021-09-30 07:16:47', 0),
(19, 42, '2021-07-12', 'cash', 20000.00, 'NULL', '2021-09-30 07:18:45', '2021-09-30 07:18:45', 0),
(21, 42, '2021-07-26', 'cash', 20000.00, 'NULL', '2021-09-30 07:20:01', '2021-09-30 07:20:01', 0),
(23, 42, '2021-08-10', 'cash', 20000.00, 'NULL', '2021-09-30 07:21:07', '2021-09-30 07:21:07', 0),
(26, 30, '2021-09-30', 'cash', 9000.00, 'NULL', '2021-09-30 11:21:29', '2021-09-30 11:21:29', 0),
(27, 30, '2021-09-30', 'cash', 300.00, 'Discount Only', '2021-09-30 11:21:29', '2021-09-30 11:21:29', 2),
(30, 40, '2021-09-30', 'cash', 5250.00, 'NULL', '2021-10-01 07:37:51', '2021-10-01 07:37:51', 0),
(32, 21, '2021-10-01', 'cash', 20000.00, 'NULL', '2021-10-01 07:51:49', '2021-10-01 07:51:49', 0),
(34, 12, '2021-09-10', 'cash', 39000.00, 'NULL', '2021-10-04 03:40:09', '2021-10-04 03:40:09', 0),
(35, 12, '2021-10-04', 'cash', 22500.00, 'NULL', '2021-10-04 03:51:37', '2021-10-04 03:51:37', 0),
(36, 13, '2021-09-25', 'cash', 15300.00, 'NULL', '2021-10-04 06:12:18', '2021-10-04 06:12:18', 0),
(37, 13, '2021-10-02', 'cash', 13000.00, 'NULL', '2021-10-04 06:13:15', '2021-10-04 06:13:15', 0),
(38, 22, '2021-10-05', 'cash', 20000.00, 'NULL', '2021-10-05 02:41:55', '2021-10-05 02:41:55', 0),
(39, 34, '2021-10-02', 'cash', 50000.00, 'NULL', '2021-10-05 03:21:43', '2021-10-05 03:21:43', 0),
(40, 34, '2021-10-05', 'cash', 7530.00, 'Discount for 251 k.g tmt return', '2021-10-05 03:55:49', '2021-10-05 03:55:49', 2),
(41, 28, '2021-10-04', 'cash', 10000.00, 'NULL', '2021-10-06 03:35:40', '2021-10-06 03:35:40', 0),
(42, 25, '2021-10-01', 'cash', 20000.00, 'NULL', '2021-10-07 04:03:28', '2021-10-07 04:03:28', 0),
(44, 2, '2021-09-09', 'cheque', 50000.00, 'NULL', '2021-10-07 05:02:36', '2021-10-07 05:02:36', 0),
(45, 42, '2021-10-06', 'cash', 20500.00, 'NULL', '2021-10-08 03:27:11', '2021-10-08 03:27:11', 0),
(47, 51, '2021-09-16', 'cash', 100000.00, 'NULL', '2021-10-08 03:45:14', '2021-10-08 03:45:14', 0),
(48, 51, '2021-10-07', 'cash', 100000.00, 'NULL', '2021-10-08 03:49:14', '2021-10-08 03:49:14', 0),
(49, 47, '2021-10-08', 'cash', 5200.00, 'NULL', '2021-10-08 04:02:54', '2021-10-08 04:02:54', 0),
(50, 47, '2021-10-08', 'cash', 270.00, 'less disount', '2021-10-08 04:02:54', '2021-10-08 04:02:54', 2),
(54, 52, '2021-08-05', 'cash', 50000.00, 'NULL', '2021-10-08 05:45:54', '2021-10-08 05:45:54', 0),
(55, 52, '2021-08-13', 'cash', 50000.00, 'NULL', '2021-10-08 05:48:30', '2021-10-08 05:48:30', 0),
(57, 10, '2021-10-08', 'cash', 15000.00, 'NULL', '2021-10-11 05:12:47', '2021-10-11 05:12:47', 0),
(59, 31, '2021-10-12', 'cash', 1960.00, 'NULL', '2021-10-12 04:06:56', '2021-10-12 04:06:56', 0),
(60, 31, '2021-10-12', 'cash', 150.00, 'discount', '2021-10-12 04:06:56', '2021-10-12 04:06:56', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sell_products`
--

CREATE TABLE `sell_products` (
  `sell_products_id` int(10) UNSIGNED NOT NULL,
  `sell_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` double(10,2) NOT NULL,
  `gst` double(10,2) NOT NULL DEFAULT 0.00,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sell_products`
--

INSERT INTO `sell_products` (`sell_products_id`, `sell_id`, `product_id`, `unit_id`, `quantity`, `rate`, `gst`, `amount`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 1, 20, 90.00, 0.00, 1800.00, '2021-09-21 11:35:48', '2021-09-21 11:35:48'),
(5, 2, 5, 2, 150, 12.50, 0.00, 1875.00, '2021-09-21 11:35:48', '2021-09-21 11:35:48'),
(6, 3, 1, 1, 5, 110.00, 0.00, 550.00, '2021-09-21 11:44:09', '2021-09-21 11:44:09'),
(7, 3, 5, 2, 50, 13.50, 0.00, 675.00, '2021-09-21 11:44:09', '2021-09-21 11:44:09'),
(8, 4, 1, 1, 15, 140.00, 0.00, 2100.00, '2021-09-21 11:50:22', '2021-09-21 11:50:22'),
(9, 4, 5, 2, 50, 12.50, 0.00, 625.00, '2021-09-21 11:50:22', '2021-09-21 11:50:22'),
(10, 4, 7, 1, 15, 140.00, 0.00, 2100.00, '2021-09-21 11:50:22', '2021-09-21 11:50:22'),
(11, 5, 1, 1, 10, 110.00, 0.00, 1100.00, '2021-09-22 10:12:20', '2021-09-22 10:12:20'),
(12, 5, 5, 2, 250, 13.50, 0.00, 3375.00, '2021-09-22 10:12:20', '2021-09-22 10:12:20'),
(13, 6, 1, 1, 5, 110.00, 0.00, 550.00, '2021-09-22 10:17:33', '2021-09-22 10:17:33'),
(14, 6, 9, 1, 5, 110.00, 0.00, 550.00, '2021-09-22 10:17:33', '2021-09-22 10:17:33'),
(15, 7, 5, 2, 100, 13.50, 0.00, 1350.00, '2021-09-22 10:19:56', '2021-09-22 10:19:56'),
(16, 8, 5, 2, 100, 13.50, 0.00, 1350.00, '2021-09-22 10:21:18', '2021-09-22 10:21:18'),
(18, 10, 1, 1, 10, 110.00, 0.00, 1100.00, '2021-09-22 10:25:36', '2021-09-22 10:25:36'),
(19, 10, 5, 2, 200, 13.50, 0.00, 2700.00, '2021-09-22 10:25:36', '2021-09-22 10:25:36'),
(20, 11, 7, 1, 10, 130.00, 0.00, 1300.00, '2021-09-22 10:28:41', '2021-09-22 10:28:41'),
(21, 11, 1, 1, 10, 110.00, 0.00, 1100.00, '2021-09-22 10:28:41', '2021-09-22 10:28:41'),
(22, 9, 1, 1, 15, 110.00, 0.00, 1650.00, '2021-09-22 10:36:39', '2021-09-22 10:36:39'),
(23, 12, 3, 1, 1, 360.00, 0.00, 360.00, '2021-09-22 10:45:55', '2021-09-22 10:45:55'),
(24, 13, 1, 1, 13, 130.00, 0.00, 1690.00, '2021-09-22 10:53:42', '2021-09-22 10:53:42'),
(25, 13, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-22 10:53:42', '2021-09-22 10:53:42'),
(26, 14, 3, 1, 2, 350.00, 0.00, 700.00, '2021-09-23 11:02:03', '2021-09-23 11:02:03'),
(27, 14, 1, 1, 5, 120.00, 0.00, 600.00, '2021-09-23 11:02:03', '2021-09-23 11:02:03'),
(28, 14, 3, 1, 3, 350.00, 0.00, 1050.00, '2021-09-23 11:02:03', '2021-09-23 11:02:03'),
(29, 14, 7, 1, 5, 120.00, 0.00, 600.00, '2021-09-23 11:02:03', '2021-09-23 11:02:03'),
(32, 16, 3, 1, 20, 320.00, 0.00, 6400.00, '2021-09-23 11:23:49', '2021-09-23 11:23:49'),
(33, 16, 3, 1, 20, 320.00, 0.00, 6400.00, '2021-09-23 11:23:49', '2021-09-23 11:23:49'),
(46, 19, 1, 1, 6, 120.00, 0.00, 720.00, '2021-09-24 04:11:46', '2021-09-24 04:11:46'),
(47, 19, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-24 04:11:46', '2021-09-24 04:11:46'),
(48, 19, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-24 04:11:46', '2021-09-24 04:11:46'),
(49, 19, 1, 1, 7, 120.00, 0.00, 840.00, '2021-09-24 04:11:46', '2021-09-24 04:11:46'),
(50, 19, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-24 04:11:46', '2021-09-24 04:11:46'),
(88, 24, 1, 1, 5, 120.00, 0.00, 600.00, '2021-09-25 06:38:58', '2021-09-25 06:38:58'),
(89, 24, 3, 0, 1, 360.00, 0.00, 360.00, '2021-09-25 06:38:58', '2021-09-25 06:38:58'),
(90, 24, 5, 2, 35, 12.50, 0.00, 437.50, '2021-09-25 06:38:58', '2021-09-25 06:38:58'),
(91, 25, 1, 1, 8, 120.00, 0.00, 960.00, '2021-09-25 07:31:54', '2021-09-25 07:31:54'),
(92, 25, 3, 1, 3, 360.00, 0.00, 1080.00, '2021-09-25 07:31:54', '2021-09-25 07:31:54'),
(93, 25, 3, 0, 1, 360.00, 0.00, 360.00, '2021-09-25 07:31:54', '2021-09-25 07:31:54'),
(94, 25, 1, 1, 3, 120.00, 0.00, 360.00, '2021-09-25 07:31:54', '2021-09-25 07:31:54'),
(95, 26, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-25 11:22:41', '2021-09-25 11:22:41'),
(96, 26, 5, 2, 100, 13.50, 0.00, 1350.00, '2021-09-25 11:22:41', '2021-09-25 11:22:41'),
(97, 27, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-09-25 11:23:10', '2021-09-25 11:23:10'),
(98, 28, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-09-25 11:23:52', '2021-09-25 11:23:52'),
(99, 28, 7, 1, 5, 140.00, 0.00, 700.00, '2021-09-25 11:23:52', '2021-09-25 11:23:52'),
(110, 32, 1, 1, 10, 100.00, 0.00, 1000.00, '2021-09-26 05:15:12', '2021-09-26 05:15:12'),
(111, 32, 3, 1, 5, 350.00, 0.00, 1750.00, '2021-09-26 05:15:12', '2021-09-26 05:15:12'),
(112, 32, 5, 2, 400, 12.00, 0.00, 4800.00, '2021-09-26 05:15:12', '2021-09-26 05:15:12'),
(116, 34, 5, 2, 250, 12.00, 0.00, 3000.00, '2021-09-26 05:32:50', '2021-09-26 05:32:50'),
(133, 38, 1, 0, 10, 120.00, 0.00, 1200.00, '2021-09-26 09:44:48', '2021-09-26 09:44:48'),
(134, 39, 1, 1, 20, 120.00, 0.00, 2400.00, '2021-09-26 09:47:36', '2021-09-26 09:47:36'),
(135, 40, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-09-26 09:54:13', '2021-09-26 09:54:13'),
(136, 40, 5, 2, 350, 12.00, 0.00, 4200.00, '2021-09-26 09:54:13', '2021-09-26 09:54:13'),
(137, 41, 1, 1, 30, 120.00, 0.00, 3600.00, '2021-09-26 09:54:47', '2021-09-26 09:54:47'),
(138, 42, 1, 1, 10, 120.00, 0.00, 1200.00, '2021-09-26 09:55:23', '2021-09-26 09:55:23'),
(139, 42, 5, 2, 500, 12.00, 0.00, 6000.00, '2021-09-26 09:55:23', '2021-09-26 09:55:23'),
(140, 43, 1, 2, 10, 120.00, 0.00, 1200.00, '2021-09-26 09:56:03', '2021-09-26 09:56:03'),
(141, 43, 9, 1, 10, 100.00, 0.00, 1000.00, '2021-09-26 09:56:03', '2021-09-26 09:56:03'),
(142, 44, 1, 1, 30, 130.00, 0.00, 3900.00, '2021-09-26 09:59:49', '2021-09-26 09:59:49'),
(143, 44, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-09-26 09:59:49', '2021-09-26 09:59:49'),
(144, 45, 11, 2, 2, 280.00, 0.00, 560.00, '2021-09-26 10:00:20', '2021-09-26 10:00:20'),
(145, 46, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-09-26 10:00:44', '2021-09-26 10:00:44'),
(148, 48, 1, 4, 250, 90.00, 0.00, 22500.00, '2021-09-26 10:04:59', '2021-09-26 10:04:59'),
(149, 49, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-09-26 10:05:56', '2021-09-26 10:05:56'),
(150, 49, 7, 4, 100, 80.00, 0.00, 8000.00, '2021-09-26 10:05:56', '2021-09-26 10:05:56'),
(151, 50, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-09-26 10:08:07', '2021-09-26 10:08:07'),
(152, 50, 14, 3, 95, 56.00, 0.00, 5320.00, '2021-09-26 10:08:07', '2021-09-26 10:08:07'),
(153, 50, 11, 3, 50, 59.00, 0.00, 2950.00, '2021-09-26 10:08:07', '2021-09-26 10:08:07'),
(154, 51, 12, 0, 45, 58.00, 0.00, 2610.00, '2021-09-26 10:09:33', '2021-09-26 10:09:33'),
(155, 52, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-26 10:14:40', '2021-09-26 10:14:40'),
(156, 53, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-26 10:17:46', '2021-09-26 10:17:46'),
(166, 55, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-09-26 11:28:25', '2021-09-26 11:28:25'),
(167, 55, 3, 1, 8, 350.00, 0.00, 2800.00, '2021-09-26 11:28:25', '2021-09-26 11:28:25'),
(168, 56, 1, 1, 15, 130.00, 0.00, 1950.00, '2021-09-26 11:30:13', '2021-09-26 11:30:13'),
(169, 57, 1, 1, 4, 130.00, 0.00, 520.00, '2021-09-26 11:32:54', '2021-09-26 11:32:54'),
(170, 57, 7, 1, 2, 130.00, 0.00, 260.00, '2021-09-26 11:32:54', '2021-09-26 11:32:54'),
(171, 57, 9, 1, 2, 120.00, 0.00, 240.00, '2021-09-26 11:32:54', '2021-09-26 11:32:54'),
(172, 58, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-26 11:34:45', '2021-09-26 11:34:45'),
(173, 58, 3, 1, 3, 350.00, 0.00, 1050.00, '2021-09-26 11:34:45', '2021-09-26 11:34:45'),
(174, 59, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-09-26 11:35:45', '2021-09-26 11:35:45'),
(175, 60, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-26 11:37:40', '2021-09-26 11:37:40'),
(176, 60, 3, 1, 2, 350.00, 0.00, 700.00, '2021-09-26 11:37:40', '2021-09-26 11:37:40'),
(177, 61, 3, 1, 3, 350.00, 0.00, 1050.00, '2021-09-26 11:38:38', '2021-09-26 11:38:38'),
(178, 62, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-27 04:21:10', '2021-09-27 04:21:10'),
(179, 63, 1, 1, 5, 90.00, 0.00, 450.00, '2021-09-27 04:22:36', '2021-09-27 04:22:36'),
(180, 64, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-27 04:24:21', '2021-09-27 04:24:21'),
(181, 65, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-09-27 04:27:16', '2021-09-27 04:27:16'),
(182, 66, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-09-27 04:29:17', '2021-09-27 04:29:17'),
(183, 67, 5, 2, 150, 12.50, 0.00, 1875.00, '2021-09-27 04:30:55', '2021-09-27 04:30:55'),
(184, 68, 1, 1, 5, 140.00, 0.00, 700.00, '2021-09-27 04:33:00', '2021-09-27 04:33:00'),
(185, 68, 5, 2, 100, 12.50, 0.00, 1250.00, '2021-09-27 04:33:00', '2021-09-27 04:33:00'),
(186, 68, 5, 0, 1, 0.00, 0.00, 0.00, '2021-09-27 04:33:00', '2021-09-27 04:33:00'),
(187, 69, 1, 1, 30, 140.00, 0.00, 4200.00, '2021-09-27 04:35:19', '2021-09-27 04:35:19'),
(188, 69, 9, 1, 4, 120.00, 0.00, 480.00, '2021-09-27 04:35:19', '2021-09-27 04:35:19'),
(189, 70, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-27 04:36:59', '2021-09-27 04:36:59'),
(190, 70, 9, 1, 3, 120.00, 0.00, 360.00, '2021-09-27 04:36:59', '2021-09-27 04:36:59'),
(191, 71, 5, 2, 250, 12.00, 0.00, 3000.00, '2021-09-27 05:39:48', '2021-09-27 05:39:48'),
(192, 72, 1, 1, 6, 100.00, 0.00, 600.00, '2021-09-27 05:43:16', '2021-09-27 05:43:16'),
(193, 72, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-27 05:43:16', '2021-09-27 05:43:16'),
(195, 73, 1, 1, 15, 100.00, 0.00, 1500.00, '2021-09-27 05:47:25', '2021-09-27 05:47:25'),
(196, 73, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-09-27 05:47:25', '2021-09-27 05:47:25'),
(197, 73, 5, 2, 250, 12.00, 0.00, 3000.00, '2021-09-27 05:47:25', '2021-09-27 05:47:25'),
(198, 74, 5, 2, 250, 12.00, 0.00, 3000.00, '2021-09-27 05:48:51', '2021-09-27 05:48:51'),
(199, 72, 9, 1, 4, 100.00, 0.00, 400.00, '2021-09-27 06:20:41', '2021-09-27 06:20:41'),
(200, 75, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-27 06:24:19', '2021-09-27 06:24:19'),
(201, 75, 7, 0, 10, 130.00, 0.00, 1300.00, '2021-09-27 06:24:19', '2021-09-27 06:24:19'),
(202, 76, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-27 06:26:20', '2021-09-27 06:26:20'),
(203, 76, 3, 0, 2, 360.00, 0.00, 720.00, '2021-09-27 06:26:20', '2021-09-27 06:26:20'),
(204, 77, 7, 4, 100, 90.00, 0.00, 9000.00, '2021-09-27 11:03:00', '2021-09-27 11:03:00'),
(205, 78, 3, 1, 20, 350.00, 0.00, 7000.00, '2021-09-27 11:04:36', '2021-09-27 11:04:36'),
(206, 79, 5, 2, 250, 12.50, 0.00, 3125.00, '2021-09-27 11:07:19', '2021-09-27 11:07:19'),
(207, 80, 3, 1, 15, 350.00, 0.00, 5250.00, '2021-09-27 11:08:43', '2021-09-27 11:08:43'),
(210, 82, 1, 0, 23, 125.00, 0.00, 2875.00, '2021-09-28 02:54:39', '2021-09-28 02:54:39'),
(211, 82, 3, 1, 3, 355.00, 0.00, 1065.00, '2021-09-28 02:54:39', '2021-09-28 02:54:39'),
(212, 83, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-28 03:04:00', '2021-09-28 03:04:00'),
(213, 83, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-28 03:04:00', '2021-09-28 03:04:00'),
(214, 83, 9, 1, 1, 120.00, 0.00, 120.00, '2021-09-28 03:04:00', '2021-09-28 03:04:00'),
(215, 84, 1, 1, 2, 130.00, 0.00, 260.00, '2021-09-28 03:06:03', '2021-09-28 03:06:03'),
(216, 84, 3, 1, 1, 360.00, 0.00, 360.00, '2021-09-28 03:06:03', '2021-09-28 03:06:03'),
(217, 85, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-28 03:11:11', '2021-09-28 03:11:11'),
(218, 86, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-09-28 03:25:21', '2021-09-28 03:25:21'),
(223, 87, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-28 03:35:25', '2021-09-28 03:35:25'),
(224, 87, 3, 1, 3, 350.00, 0.00, 1050.00, '2021-09-28 03:35:25', '2021-09-28 03:35:25'),
(226, 89, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-28 03:49:05', '2021-09-28 03:49:05'),
(227, 89, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-28 03:49:05', '2021-09-28 03:49:05'),
(228, 89, 5, 2, 150, 12.50, 0.00, 1875.00, '2021-09-28 03:49:05', '2021-09-28 03:49:05'),
(229, 90, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-09-28 03:50:39', '2021-09-28 03:50:39'),
(230, 91, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-28 03:52:18', '2021-09-28 03:52:18'),
(231, 92, 1, 1, 15, 130.00, 0.00, 1950.00, '2021-09-28 04:23:59', '2021-09-28 04:23:59'),
(232, 92, 3, 1, 4, 360.00, 0.00, 1440.00, '2021-09-28 04:23:59', '2021-09-28 04:23:59'),
(233, 93, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-28 04:30:01', '2021-09-28 04:30:01'),
(234, 93, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-28 04:30:01', '2021-09-28 04:30:01'),
(235, 94, 1, 1, 20, 100.00, 0.00, 2000.00, '2021-09-28 05:05:52', '2021-09-28 05:05:52'),
(236, 94, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-28 05:05:52', '2021-09-28 05:05:52'),
(237, 95, 1, 1, 50, 100.00, 0.00, 5000.00, '2021-09-28 05:09:03', '2021-09-28 05:09:03'),
(238, 96, 1, 1, 10, 100.00, 0.00, 1000.00, '2021-09-28 05:11:10', '2021-09-28 05:11:10'),
(239, 96, 7, 1, 10, 120.00, 0.00, 1200.00, '2021-09-28 05:11:10', '2021-09-28 05:11:10'),
(240, 97, 5, 2, 350, 12.50, 0.00, 4375.00, '2021-09-28 05:12:33', '2021-09-28 05:12:33'),
(241, 98, 5, 2, 250, 12.50, 0.00, 3125.00, '2021-09-28 05:14:03', '2021-09-28 05:14:03'),
(242, 99, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-28 05:15:08', '2021-09-28 05:15:08'),
(243, 100, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-09-28 05:16:56', '2021-09-28 05:16:56'),
(244, 100, 7, 1, 10, 130.00, 0.00, 1300.00, '2021-09-28 05:16:56', '2021-09-28 05:16:56'),
(245, 101, 1, 1, 20, 140.00, 0.00, 2800.00, '2021-09-28 05:19:41', '2021-09-28 05:19:41'),
(246, 101, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-09-28 05:19:41', '2021-09-28 05:19:41'),
(247, 102, 1, 1, 20, 140.00, 0.00, 2800.00, '2021-09-28 05:23:42', '2021-09-28 05:23:42'),
(248, 103, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-09-28 05:27:05', '2021-09-28 05:27:05'),
(249, 103, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-09-28 05:27:05', '2021-09-28 05:27:05'),
(250, 104, 1, 1, 30, 140.00, 0.00, 4200.00, '2021-09-28 05:28:26', '2021-09-28 05:28:26'),
(251, 105, 1, 1, 8, 100.00, 0.00, 800.00, '2021-09-28 05:52:37', '2021-09-28 05:52:37'),
(252, 105, 3, 1, 2, 360.00, 0.00, 720.00, '2021-09-28 05:52:37', '2021-09-28 05:52:37'),
(255, 107, 3, 1, 15, 350.00, 0.00, 5250.00, '2021-09-29 03:42:46', '2021-09-29 03:42:46'),
(257, 109, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-29 03:46:58', '2021-09-29 03:46:58'),
(258, 109, 5, 2, 200, 12.00, 0.00, 2400.00, '2021-09-29 03:46:58', '2021-09-29 03:46:58'),
(259, 110, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-09-29 03:48:42', '2021-09-29 03:48:42'),
(260, 111, 5, 2, 50, 13.00, 0.00, 650.00, '2021-09-29 03:50:10', '2021-09-29 03:50:10'),
(261, 112, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-29 03:52:48', '2021-09-29 03:52:48'),
(262, 112, 3, 1, 1, 360.00, 0.00, 360.00, '2021-09-29 03:52:48', '2021-09-29 03:52:48'),
(263, 113, 7, 1, 50, 140.00, 0.00, 7000.00, '2021-09-29 03:55:49', '2021-09-29 03:55:49'),
(264, 114, 9, 1, 10, 110.00, 0.00, 1100.00, '2021-09-29 03:59:07', '2021-09-29 03:59:07'),
(265, 115, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-09-29 04:07:27', '2021-09-29 04:07:27'),
(266, 115, 3, 1, 2, 350.00, 0.00, 700.00, '2021-09-29 04:07:27', '2021-09-29 04:07:27'),
(267, 115, 9, 1, 5, 120.00, 0.00, 600.00, '2021-09-29 04:07:27', '2021-09-29 04:07:27'),
(268, 116, 1, 1, 50, 90.00, 0.00, 4500.00, '2021-09-29 05:57:46', '2021-09-29 05:57:46'),
(269, 117, 3, 1, 10, 370.00, 0.00, 3700.00, '2021-09-29 05:58:50', '2021-09-29 05:58:50'),
(270, 118, 1, 1, 30, 90.00, 0.00, 2700.00, '2021-09-29 05:59:39', '2021-09-29 05:59:39'),
(271, 119, 1, 1, 20, 90.00, 0.00, 1800.00, '2021-09-29 06:00:54', '2021-09-29 06:00:54'),
(272, 119, 3, 1, 10, 370.00, 0.00, 3700.00, '2021-09-29 06:00:54', '2021-09-29 06:00:54'),
(273, 120, 1, 1, 10, 120.00, 0.00, 1200.00, '2021-09-29 06:02:46', '2021-09-29 06:02:46'),
(274, 120, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-09-29 06:02:46', '2021-09-29 06:02:46'),
(275, 120, 9, 1, 5, 110.00, 0.00, 550.00, '2021-09-29 06:02:46', '2021-09-29 06:02:46'),
(276, 121, 1, 1, 5, 120.00, 0.00, 600.00, '2021-09-29 06:03:40', '2021-09-29 06:03:40'),
(277, 121, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-09-29 06:03:40', '2021-09-29 06:03:40'),
(278, 122, 1, 1, 6, 125.00, 0.00, 750.00, '2021-09-30 04:32:41', '2021-09-30 04:32:41'),
(279, 122, 3, 1, 2, 355.00, 0.00, 710.00, '2021-09-30 04:32:42', '2021-09-30 04:32:42'),
(280, 123, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-30 04:41:34', '2021-09-30 04:41:34'),
(281, 123, 3, 1, 5, 350.00, 0.00, 1750.00, '2021-09-30 04:41:34', '2021-09-30 04:41:34'),
(282, 124, 1, 1, 16, 100.00, 0.00, 1600.00, '2021-09-30 06:18:37', '2021-09-30 06:18:37'),
(283, 124, 3, 1, 4, 350.00, 0.00, 1400.00, '2021-09-30 06:18:37', '2021-09-30 06:18:37'),
(284, 125, 1, 1, 16, 100.00, 0.00, 1600.00, '2021-09-30 06:20:31', '2021-09-30 06:20:31'),
(285, 125, 3, 1, 4, 350.00, 0.00, 1400.00, '2021-09-30 06:20:31', '2021-09-30 06:20:31'),
(286, 126, 5, 2, 600, 12.00, 0.00, 7200.00, '2021-09-30 06:22:13', '2021-09-30 06:22:13'),
(287, 127, 1, 1, 20, 100.00, 0.00, 2000.00, '2021-09-30 06:24:25', '2021-09-30 06:24:25'),
(288, 127, 5, 2, 500, 12.00, 0.00, 6000.00, '2021-09-30 06:24:25', '2021-09-30 06:24:25'),
(289, 128, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-09-30 06:28:03', '2021-09-30 06:28:03'),
(290, 128, 3, 1, 2, 350.00, 0.00, 700.00, '2021-09-30 06:28:03', '2021-09-30 06:28:03'),
(291, 129, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-09-30 06:29:09', '2021-09-30 06:29:09'),
(292, 130, 1, 1, 9, 130.00, 0.00, 1170.00, '2021-09-30 06:30:55', '2021-09-30 06:30:55'),
(293, 130, 3, 1, 1, 350.00, 0.00, 350.00, '2021-09-30 06:30:55', '2021-09-30 06:30:55'),
(297, 132, 1, 1, 5, 130.00, 0.00, 650.00, '2021-09-30 06:38:38', '2021-09-30 06:38:38'),
(298, 132, 3, 1, 1, 350.00, 0.00, 350.00, '2021-09-30 06:38:38', '2021-09-30 06:38:38'),
(299, 132, 5, 2, 50, 12.00, 0.00, 600.00, '2021-09-30 06:38:38', '2021-09-30 06:38:38'),
(304, 135, 7, 4, 600, 63.00, 0.00, 37800.00, '2021-09-30 07:01:50', '2021-09-30 07:01:50'),
(305, 136, 3, 1, 10, 380.00, 0.00, 3800.00, '2021-09-30 07:03:27', '2021-09-30 07:03:27'),
(306, 137, 1, 0, 500, 64.00, 0.00, 32000.00, '2021-09-30 07:08:19', '2021-09-30 07:08:19'),
(307, 138, 5, 2, 5000, 11.00, 0.00, 55000.00, '2021-09-30 07:09:41', '2021-09-30 07:09:41'),
(308, 139, 5, 2, 3000, 11.00, 0.00, 33000.00, '2021-09-30 07:10:55', '2021-09-30 07:10:55'),
(314, 140, 1, 1, 10, 125.00, 0.00, 1250.00, '2021-09-30 11:17:58', '2021-09-30 11:17:58'),
(315, 140, 3, 1, 5, 355.00, 0.00, 1775.00, '2021-09-30 11:17:58', '2021-09-30 11:17:58'),
(316, 141, 1, 1, 7, 125.00, 0.00, 875.00, '2021-09-30 11:19:18', '2021-09-30 11:19:18'),
(324, 146, 9, 1, 10, 120.00, 0.00, 1200.00, '2021-10-01 07:12:51', '2021-10-01 07:12:51'),
(325, 147, 1, 1, 4, 130.00, 0.00, 520.00, '2021-10-01 07:18:58', '2021-10-01 07:18:58'),
(326, 147, 3, 1, 1, 360.00, 0.00, 360.00, '2021-10-01 07:18:58', '2021-10-01 07:18:58'),
(327, 148, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-10-01 07:22:06', '2021-10-01 07:22:06'),
(328, 148, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-01 07:22:06', '2021-10-01 07:22:06'),
(329, 148, 5, 2, 90, 12.00, 0.00, 1080.00, '2021-10-01 07:22:06', '2021-10-01 07:22:06'),
(330, 149, 9, 1, 10, 110.00, 0.00, 1100.00, '2021-10-01 07:23:18', '2021-10-01 07:23:18'),
(331, 150, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-01 07:25:08', '2021-10-01 07:25:08'),
(332, 151, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-02 05:10:06', '2021-10-02 05:10:06'),
(333, 151, 5, 2, 300, 12.00, 0.00, 3600.00, '2021-10-02 05:10:06', '2021-10-02 05:10:06'),
(334, 152, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-02 05:11:21', '2021-10-02 05:11:21'),
(335, 153, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-10-02 05:13:21', '2021-10-02 05:13:21'),
(336, 153, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-02 05:13:21', '2021-10-02 05:13:21'),
(338, 155, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-02 05:18:39', '2021-10-02 05:18:39'),
(339, 156, 1, 1, 5, 120.00, 0.00, 600.00, '2021-10-02 05:22:57', '2021-10-02 05:22:57'),
(340, 156, 3, 1, 3, 350.00, 0.00, 1050.00, '2021-10-02 05:22:57', '2021-10-02 05:22:57'),
(341, 157, 1, 1, 9, 120.00, 0.00, 1080.00, '2021-10-02 05:27:00', '2021-10-02 05:27:00'),
(342, 157, 3, 1, 1, 350.00, 0.00, 350.00, '2021-10-02 05:27:00', '2021-10-02 05:27:00'),
(343, 158, 1, 1, 10, 120.00, 0.00, 1200.00, '2021-10-02 05:28:06', '2021-10-02 05:28:06'),
(344, 159, 1, 1, 1, 360.00, 0.00, 360.00, '2021-10-04 02:37:45', '2021-10-04 02:37:45'),
(345, 160, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-04 02:39:54', '2021-10-04 02:39:54'),
(346, 160, 5, 2, 200, 12.00, 0.00, 2400.00, '2021-10-04 02:39:54', '2021-10-04 02:39:54'),
(347, 161, 1, 1, 30, 130.00, 0.00, 3900.00, '2021-10-04 02:40:57', '2021-10-04 02:40:57'),
(348, 162, 3, 1, 9, 360.00, 0.00, 3240.00, '2021-10-04 02:42:31', '2021-10-04 02:42:31'),
(349, 163, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-04 02:43:57', '2021-10-04 02:43:57'),
(352, 166, 5, 2, 375, 12.50, 0.00, 4687.50, '2021-10-04 03:03:05', '2021-10-04 03:03:05'),
(353, 166, 7, 1, 25, 120.00, 0.00, 3000.00, '2021-10-04 03:03:05', '2021-10-04 03:03:05'),
(354, 167, 5, 0, 225, 12.50, 0.00, 2812.50, '2021-10-04 03:05:53', '2021-10-04 03:05:53'),
(355, 167, 7, 1, 45, 120.00, 0.00, 5400.00, '2021-10-04 03:05:53', '2021-10-04 03:05:53'),
(356, 168, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-04 03:07:33', '2021-10-04 03:07:33'),
(357, 169, 5, 2, 400, 12.50, 0.00, 5000.00, '2021-10-04 03:22:56', '2021-10-04 03:22:56'),
(358, 170, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-04 03:46:01', '2021-10-04 03:46:01'),
(359, 171, 15, 4, 400, 30.00, 0.00, 12000.00, '2021-10-04 03:48:08', '2021-10-04 03:48:08'),
(360, 172, 3, 0, 10, 350.00, 0.00, 3500.00, '2021-10-04 03:50:24', '2021-10-04 03:50:24'),
(361, 173, 5, 0, 708, 11.00, 0.00, 7788.00, '2021-10-04 03:54:08', '2021-10-04 03:54:08'),
(362, 174, 5, 2, 192, 11.00, 0.00, 2112.00, '2021-10-04 03:55:41', '2021-10-04 03:55:41'),
(363, 175, 5, 2, 100, 11.00, 0.00, 1100.00, '2021-10-04 03:56:51', '2021-10-04 03:56:51'),
(364, 176, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-04 03:59:10', '2021-10-04 03:59:10'),
(365, 177, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-04 04:04:34', '2021-10-04 04:04:34'),
(366, 177, 5, 0, 100, 12.50, 0.00, 1250.00, '2021-10-04 04:04:34', '2021-10-04 04:04:34'),
(367, 178, 3, 2, 1, 360.00, 0.00, 360.00, '2021-10-04 04:05:35', '2021-10-04 04:05:35'),
(368, 179, 1, 1, 4, 130.00, 0.00, 520.00, '2021-10-04 04:10:45', '2021-10-04 04:10:45'),
(369, 179, 3, 1, 4, 360.00, 0.00, 1440.00, '2021-10-04 04:10:45', '2021-10-04 04:10:45'),
(370, 179, 9, 1, 2, 120.00, 0.00, 240.00, '2021-10-04 04:10:45', '2021-10-04 04:10:45'),
(371, 180, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-04 04:15:50', '2021-10-04 04:15:50'),
(372, 181, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-10-04 04:17:10', '2021-10-04 04:17:10'),
(373, 181, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-04 04:17:10', '2021-10-04 04:17:10'),
(374, 182, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-10-04 04:21:44', '2021-10-04 04:21:44'),
(375, 182, 3, 1, 3, 360.00, 0.00, 1080.00, '2021-10-04 04:21:44', '2021-10-04 04:21:44'),
(376, 183, 1, 1, 6, 130.00, 0.00, 780.00, '2021-10-04 04:24:06', '2021-10-04 04:24:06'),
(377, 183, 3, 0, 3, 360.00, 0.00, 1080.00, '2021-10-04 04:24:06', '2021-10-04 04:24:06'),
(378, 183, 9, 1, 1, 120.00, 0.00, 120.00, '2021-10-04 04:24:06', '2021-10-04 04:24:06'),
(379, 184, 1, 1, 2, 130.00, 0.00, 260.00, '2021-10-04 04:26:34', '2021-10-04 04:26:34'),
(380, 185, 1, 1, 3, 130.00, 0.00, 390.00, '2021-10-04 04:31:11', '2021-10-04 04:31:11'),
(381, 185, 3, 0, 2, 360.00, 0.00, 720.00, '2021-10-04 04:31:11', '2021-10-04 04:31:11'),
(382, 186, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-05 02:32:13', '2021-10-05 02:32:13'),
(383, 186, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-05 02:32:13', '2021-10-05 02:32:13'),
(384, 187, 5, 2, 475, 12.50, 0.00, 5937.50, '2021-10-05 02:54:16', '2021-10-05 02:54:16'),
(385, 188, 16, 7, 1, 190.00, 0.00, 190.00, '2021-10-05 03:44:13', '2021-10-05 03:44:13'),
(386, 189, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-05 04:31:38', '2021-10-05 04:31:38'),
(387, 189, 5, 2, 250, 12.00, 0.00, 3000.00, '2021-10-05 04:31:38', '2021-10-05 04:31:38'),
(389, 191, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-05 04:35:18', '2021-10-05 04:35:18'),
(390, 192, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-05 04:36:22', '2021-10-05 04:36:22'),
(391, 193, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-05 04:40:12', '2021-10-05 04:40:12'),
(392, 194, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-05 04:41:28', '2021-10-05 04:41:28'),
(393, 195, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-05 04:45:16', '2021-10-05 04:45:16'),
(394, 196, 1, 1, 4, 130.00, 0.00, 520.00, '2021-10-05 05:33:51', '2021-10-05 05:33:51'),
(395, 196, 3, 1, 4, 360.00, 0.00, 1440.00, '2021-10-05 05:33:51', '2021-10-05 05:33:51'),
(396, 197, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-10-05 05:34:54', '2021-10-05 05:34:54'),
(397, 198, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-10-05 05:37:32', '2021-10-05 05:37:32'),
(398, 198, 3, 1, 6, 360.00, 0.00, 2160.00, '2021-10-05 05:37:32', '2021-10-05 05:37:32'),
(399, 199, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-10-05 05:39:37', '2021-10-05 05:39:37'),
(400, 199, 3, 1, 7, 360.00, 0.00, 2520.00, '2021-10-05 05:39:37', '2021-10-05 05:39:37'),
(401, 200, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-10-05 05:40:49', '2021-10-05 05:40:49'),
(402, 201, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-05 05:41:55', '2021-10-05 05:41:55'),
(403, 202, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-06 03:32:47', '2021-10-06 03:32:47'),
(404, 203, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-06 03:40:05', '2021-10-06 03:40:05'),
(405, 204, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-06 03:43:28', '2021-10-06 03:43:28'),
(406, 204, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-06 03:43:28', '2021-10-06 03:43:28'),
(407, 205, 3, 0, 5, 360.00, 0.00, 1800.00, '2021-10-06 03:45:31', '2021-10-06 03:45:31'),
(408, 206, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-06 03:48:18', '2021-10-06 03:48:18'),
(409, 206, 9, 1, 10, 120.00, 0.00, 1200.00, '2021-10-06 03:48:18', '2021-10-06 03:48:18'),
(410, 207, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-06 03:55:57', '2021-10-06 03:55:57'),
(411, 208, 5, 2, 800, 12.00, 0.00, 9600.00, '2021-10-06 03:59:55', '2021-10-06 03:59:55'),
(412, 208, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-06 03:59:55', '2021-10-06 03:59:55'),
(413, 209, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-06 04:08:24', '2021-10-06 04:08:24'),
(414, 210, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-06 04:12:47', '2021-10-06 04:12:47'),
(415, 211, 1, 1, 5, 130.00, 0.00, 650.00, '2021-10-06 04:16:01', '2021-10-06 04:16:01'),
(416, 211, 3, 1, 1, 350.00, 0.00, 350.00, '2021-10-06 04:16:01', '2021-10-06 04:16:01'),
(417, 211, 9, 1, 1, 120.00, 0.00, 120.00, '2021-10-06 04:16:01', '2021-10-06 04:16:01'),
(418, 212, 1, 1, 5, 130.00, 0.00, 650.00, '2021-10-06 04:18:22', '2021-10-06 04:18:22'),
(419, 212, 3, 0, 1, 350.00, 0.00, 350.00, '2021-10-06 04:18:22', '2021-10-06 04:18:22'),
(420, 212, 5, 2, 100, 12.00, 0.00, 1200.00, '2021-10-06 04:18:22', '2021-10-06 04:18:22'),
(421, 212, 9, 1, 1, 120.00, 0.00, 120.00, '2021-10-06 04:18:22', '2021-10-06 04:18:22'),
(422, 213, 1, 1, 20, 90.00, 0.00, 1800.00, '2021-10-07 03:36:31', '2021-10-07 03:36:31'),
(423, 213, 3, 1, 6, 360.00, 0.00, 2160.00, '2021-10-07 03:36:31', '2021-10-07 03:36:31'),
(424, 213, 7, 1, 20, 120.00, 0.00, 2400.00, '2021-10-07 03:36:31', '2021-10-07 03:36:31'),
(425, 214, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-07 03:38:28', '2021-10-07 03:38:28'),
(426, 215, 1, 4, 150, 90.00, 0.00, 13500.00, '2021-10-07 03:41:41', '2021-10-07 03:41:41'),
(427, 215, 7, 4, 150, 90.00, 0.00, 13500.00, '2021-10-07 03:41:41', '2021-10-07 03:41:41'),
(428, 215, 3, 1, 15, 360.00, 0.00, 5400.00, '2021-10-07 03:41:41', '2021-10-07 03:41:41'),
(429, 216, 1, 1, 30, 140.00, 0.00, 4200.00, '2021-10-07 03:46:00', '2021-10-07 03:46:00'),
(430, 216, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-07 03:46:00', '2021-10-07 03:46:00'),
(431, 216, 5, 2, 100, 12.00, 0.00, 1200.00, '2021-10-07 03:46:00', '2021-10-07 03:46:00'),
(432, 217, 7, 3, 20, 1800.00, 0.00, 35964.00, '2021-10-07 04:17:35', '2021-10-07 04:17:35'),
(433, 218, 2, 4, 500, 80.00, 0.00, 40000.00, '2021-10-07 04:23:25', '2021-10-07 04:23:25'),
(434, 219, 1, 4, 400, 60.00, 0.00, 24000.00, '2021-10-07 04:24:56', '2021-10-07 04:24:56'),
(435, 220, 7, 3, 18, 1800.00, 0.00, 32814.00, '2021-10-07 04:26:49', '2021-10-07 04:26:49'),
(436, 221, 1, 4, 400, 60.00, 0.00, 24000.00, '2021-10-07 04:28:18', '2021-10-07 04:28:18'),
(437, 223, 1, 4, 400, 60.00, 0.00, 24000.00, '2021-10-07 04:32:45', '2021-10-07 04:32:45'),
(438, 224, 5, 2, 5000, 11.00, 0.00, 55000.00, '2021-10-07 04:36:20', '2021-10-07 04:36:20'),
(439, 225, 2, 4, 600, 75.00, 0.00, 45000.00, '2021-10-07 04:37:37', '2021-10-07 04:37:37'),
(440, 226, 1, 4, 500, 64.00, 0.00, 32000.00, '2021-10-07 05:47:38', '2021-10-07 05:47:38'),
(441, 227, 7, 4, 498, 75.00, 0.00, 37350.00, '2021-10-07 05:49:44', '2021-10-07 05:49:44'),
(442, 228, 3, 1, 70, 390.00, 0.00, 27300.00, '2021-10-07 05:52:42', '2021-10-07 05:52:42'),
(444, 230, 1, 1, 7, 130.00, 0.00, 910.00, '2021-10-08 02:43:47', '2021-10-08 02:43:47'),
(445, 230, 3, 1, 3, 360.00, 0.00, 1080.00, '2021-10-08 02:43:47', '2021-10-08 02:43:47'),
(446, 231, 7, 1, 80, 140.00, 0.00, 11200.00, '2021-10-08 02:46:29', '2021-10-08 02:46:29'),
(447, 232, 1, 1, 40, 130.00, 0.00, 5200.00, '2021-10-08 02:50:33', '2021-10-08 02:50:33'),
(448, 232, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-08 02:50:33', '2021-10-08 02:50:33'),
(449, 233, 1, 1, 30, 140.00, 0.00, 4200.00, '2021-10-08 02:55:00', '2021-10-08 02:55:00'),
(450, 233, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-08 02:55:00', '2021-10-08 02:55:00'),
(451, 233, 5, 2, 100, 12.00, 0.00, 1200.00, '2021-10-08 02:55:00', '2021-10-08 02:55:00'),
(452, 234, 1, 1, 4, 140.00, 0.00, 560.00, '2021-10-08 02:57:41', '2021-10-08 02:57:41'),
(453, 234, 3, 1, 1, 360.00, 0.00, 360.00, '2021-10-08 02:57:41', '2021-10-08 02:57:41'),
(454, 235, 1, 1, 30, 140.00, 0.00, 4200.00, '2021-10-08 03:00:17', '2021-10-08 03:00:17'),
(455, 235, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-08 03:00:17', '2021-10-08 03:00:17'),
(456, 235, 9, 1, 10, 120.00, 0.00, 1200.00, '2021-10-08 03:00:17', '2021-10-08 03:00:17'),
(457, 236, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-08 03:03:05', '2021-10-08 03:03:05'),
(458, 236, 3, 1, 10, 360.00, 0.00, 3600.00, '2021-10-08 03:03:05', '2021-10-08 03:03:05'),
(459, 236, 9, 1, 10, 120.00, 0.00, 1200.00, '2021-10-08 03:03:05', '2021-10-08 03:03:05'),
(460, 237, 1, 1, 6, 130.00, 0.00, 780.00, '2021-10-08 03:11:45', '2021-10-08 03:11:45'),
(461, 237, 3, 1, 2, 350.00, 0.00, 700.00, '2021-10-08 03:11:45', '2021-10-08 03:11:45'),
(462, 237, 9, 1, 4, 120.00, 0.00, 480.00, '2021-10-08 03:11:45', '2021-10-08 03:11:45'),
(463, 238, 3, 1, 3, 360.00, 0.00, 1080.00, '2021-10-08 03:14:33', '2021-10-08 03:14:33'),
(464, 238, 9, 1, 5, 100.00, 0.00, 500.00, '2021-10-08 03:14:33', '2021-10-08 03:14:33'),
(465, 239, 1, 1, 10, 100.00, 0.00, 1000.00, '2021-10-08 03:15:49', '2021-10-08 03:15:49'),
(466, 240, 1, 1, 5, 140.00, 0.00, 700.00, '2021-10-08 03:18:08', '2021-10-08 03:18:08'),
(467, 240, 3, 1, 1, 360.00, 0.00, 360.00, '2021-10-08 03:18:08', '2021-10-08 03:18:08'),
(468, 241, 1, 1, 8, 130.00, 0.00, 1040.00, '2021-10-08 03:22:58', '2021-10-08 03:22:58'),
(469, 241, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-08 03:22:58', '2021-10-08 03:22:58'),
(470, 242, 1, 1, 15, 130.00, 0.00, 1950.00, '2021-10-08 03:24:45', '2021-10-08 03:24:45'),
(471, 242, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-08 03:24:45', '2021-10-08 03:24:45'),
(472, 243, 11, 2, 3, 300.00, 0.00, 900.00, '2021-10-08 04:00:13', '2021-10-08 04:00:13'),
(473, 244, 5, 2, 500, 11.30, 0.00, 5650.00, '2021-10-08 05:19:16', '2021-10-08 05:19:16'),
(474, 245, 5, 2, 1500, 11.30, 0.00, 16950.00, '2021-10-08 05:21:21', '2021-10-08 05:21:21'),
(475, 246, 3, 1, 5, 390.00, 0.00, 1950.00, '2021-10-08 05:23:26', '2021-10-08 05:23:26'),
(476, 246, 5, 2, 500, 11.30, 0.00, 5650.00, '2021-10-08 05:23:26', '2021-10-08 05:23:26'),
(477, 247, 3, 1, 10, 380.00, 0.00, 3800.00, '2021-10-08 05:25:20', '2021-10-08 05:25:20'),
(478, 247, 5, 2, 400, 11.30, 0.00, 4520.00, '2021-10-08 05:25:20', '2021-10-08 05:25:20'),
(479, 248, 3, 1, 20, 380.00, 0.00, 7600.00, '2021-10-08 05:27:26', '2021-10-08 05:27:26'),
(480, 248, 5, 2, 1000, 11.30, 0.00, 11300.00, '2021-10-08 05:27:26', '2021-10-08 05:27:26'),
(481, 249, 1, 4, 50, 70.00, 0.00, 3500.00, '2021-10-08 05:28:56', '2021-10-08 05:28:56'),
(482, 250, 14, 3, 314, 55.50, 0.00, 17404.80, '2021-10-08 05:36:34', '2021-10-08 05:36:34'),
(483, 250, 11, 3, 283, 58.50, 0.00, 16555.50, '2021-10-08 05:36:34', '2021-10-08 05:36:34'),
(484, 250, 13, 3, 155, 56.50, 0.00, 8757.50, '2021-10-08 05:36:34', '2021-10-08 05:36:34'),
(485, 251, 3, 1, 5, 350.00, 0.00, 1750.00, '2021-10-09 07:00:51', '2021-10-09 07:00:51'),
(486, 251, 5, 2, 100, 12.00, 0.00, 1200.00, '2021-10-09 07:00:51', '2021-10-09 07:00:51'),
(487, 252, 1, 1, 20, 140.00, 0.00, 2800.00, '2021-10-09 07:03:48', '2021-10-09 07:03:48'),
(488, 252, 5, 2, 300, 13.00, 0.00, 3900.00, '2021-10-09 07:03:48', '2021-10-09 07:03:48'),
(489, 253, 3, 1, 3, 360.00, 0.00, 1080.00, '2021-10-09 07:06:37', '2021-10-09 07:06:37'),
(490, 253, 5, 2, 100, 12.00, 0.00, 1200.00, '2021-10-09 07:06:37', '2021-10-09 07:06:37'),
(491, 253, 9, 0, 5, 120.00, 0.00, 600.00, '2021-10-09 07:06:37', '2021-10-09 07:06:37'),
(492, 254, 1, 1, 20, 140.00, 0.00, 2800.00, '2021-10-09 07:10:06', '2021-10-09 07:10:06'),
(493, 254, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-09 07:10:06', '2021-10-09 07:10:06'),
(494, 254, 9, 1, 10, 120.00, 0.00, 1200.00, '2021-10-09 07:10:06', '2021-10-09 07:10:06'),
(495, 255, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-09 07:14:25', '2021-10-09 07:14:25'),
(496, 256, 5, 2, 100, 12.00, 0.00, 1200.00, '2021-10-09 07:15:22', '2021-10-09 07:15:22'),
(497, 257, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-09 07:33:24', '2021-10-09 07:33:24'),
(498, 257, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-09 07:33:24', '2021-10-09 07:33:24'),
(499, 257, 9, 1, 10, 120.00, 0.00, 1200.00, '2021-10-09 07:33:24', '2021-10-09 07:33:24'),
(500, 258, 3, 1, 20, 360.00, 0.00, 7200.00, '2021-10-10 02:31:47', '2021-10-10 02:31:47'),
(501, 259, 1, 1, 20, 130.00, 0.00, 2600.00, '2021-10-10 02:33:28', '2021-10-10 02:33:28'),
(502, 259, 5, 2, 250, 12.00, 0.00, 3000.00, '2021-10-10 02:33:28', '2021-10-10 02:33:28'),
(503, 260, 3, 1, 20, 360.00, 0.00, 7200.00, '2021-10-10 02:34:45', '2021-10-10 02:34:45'),
(504, 261, 3, 2, 10, 360.00, 0.00, 3600.00, '2021-10-10 02:36:26', '2021-10-10 02:36:26'),
(505, 261, 5, 2, 500, 12.00, 0.00, 6000.00, '2021-10-10 02:36:26', '2021-10-10 02:36:26'),
(507, 263, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-10 02:38:56', '2021-10-10 02:38:56'),
(508, 263, 3, 1, 4, 360.00, 0.00, 1440.00, '2021-10-10 02:38:56', '2021-10-10 02:38:56'),
(509, 264, 1, 1, 10, 140.00, 0.00, 1400.00, '2021-10-10 02:48:49', '2021-10-10 02:48:49'),
(510, 265, 1, 1, 10, 130.00, 0.00, 1300.00, '2021-10-11 04:36:47', '2021-10-11 04:36:47'),
(511, 266, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-11 04:37:54', '2021-10-11 04:37:54'),
(512, 267, 3, 1, 10, 350.00, 0.00, 3500.00, '2021-10-11 04:40:31', '2021-10-11 04:40:31'),
(513, 268, 1, 1, 40, 130.00, 0.00, 5200.00, '2021-10-11 04:43:21', '2021-10-11 04:43:21'),
(514, 268, 7, 1, 20, 140.00, 0.00, 2800.00, '2021-10-11 04:43:21', '2021-10-11 04:43:21'),
(515, 269, 6, 2, 300, 10.50, 0.00, 3150.00, '2021-10-11 04:45:33', '2021-10-11 04:45:33'),
(516, 270, 11, 2, 1, 300.00, 0.00, 300.00, '2021-10-11 04:47:28', '2021-10-11 04:47:28'),
(517, 270, 14, 2, 1, 900.00, 0.00, 900.00, '2021-10-11 04:47:28', '2021-10-11 04:47:28'),
(519, 272, 3, 1, 5, 360.00, 0.00, 1800.00, '2021-10-11 04:51:37', '2021-10-11 04:51:37'),
(520, 273, 1, 1, 5, 130.00, 0.00, 650.00, '2021-10-12 03:34:27', '2021-10-12 03:34:27'),
(521, 274, 3, 1, 1, 350.00, 0.00, 350.00, '2021-10-12 03:35:30', '2021-10-12 03:35:30'),
(522, 275, 3, 1, 7, 360.00, 0.00, 2520.00, '2021-10-12 03:36:51', '2021-10-12 03:36:51'),
(523, 276, 1, 1, 5, 130.00, 0.00, 650.00, '2021-10-12 03:38:16', '2021-10-12 03:38:16'),
(524, 277, 1, 1, 16, 130.00, 0.00, 2080.00, '2021-10-12 03:39:46', '2021-10-12 03:39:46'),
(525, 277, 3, 1, 4, 360.00, 0.00, 1440.00, '2021-10-12 03:39:46', '2021-10-12 03:39:46'),
(526, 278, 1, 1, 2, 130.00, 0.00, 260.00, '2021-10-12 03:48:51', '2021-10-12 03:48:51'),
(527, 278, 3, 1, 2, 360.00, 0.00, 720.00, '2021-10-12 03:48:51', '2021-10-12 03:48:51'),
(528, 279, 1, 1, 1, 130.00, 0.00, 130.00, '2021-10-12 03:49:39', '2021-10-12 03:49:39'),
(529, 280, 1, 1, 1, 130.00, 0.00, 130.00, '2021-10-12 03:50:34', '2021-10-12 03:50:34'),
(530, 281, 1, 1, 2, 130.00, 0.00, 260.00, '2021-10-12 03:52:41', '2021-10-12 03:52:41'),
(531, 281, 9, 1, 1, 120.00, 0.00, 120.00, '2021-10-12 03:52:41', '2021-10-12 03:52:41'),
(532, 282, 7, 1, 10, 140.00, 0.00, 1400.00, '2021-10-12 03:58:34', '2021-10-12 03:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `isDeleted`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'bag', 0, '2020-07-16 07:17:37', '2020-07-16 07:17:37', NULL),
(2, 'pcs', 0, '2020-07-22 01:57:32', '2020-07-22 01:57:32', NULL),
(3, 'kg', 0, '2020-07-23 04:20:24', '2020-07-23 04:20:24', NULL),
(4, 'cft', 0, '2020-07-23 04:31:45', '2020-07-23 04:31:45', NULL),
(5, 'mm', 0, '2020-07-28 06:31:48', '2020-07-28 06:31:48', NULL),
(6, 'test1', 0, '2020-08-26 13:55:49', '2020-08-26 13:56:05', '2020-08-26 13:56:05'),
(7, 'liter', 0, '2020-11-01 22:11:38', '2020-11-01 22:11:38', NULL),
(8, 'tan', 0, '2020-11-02 21:50:00', '2020-11-02 21:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Puja Singh', 'puja@gmail.com', NULL, '$2y$10$S.nZ75JaY0lc4.ZOIZ8qfuuzWi486uHUZ2TRPBPE25.6q3LenZIN.', 'C52TeZY2yE6GACxEeD60M1ZdU9oFe2Fvw156MHNOsEzGBJ2PlEmbcCafZ1nv', '2020-07-16 07:17:17', '2020-07-16 07:17:17'),
(2, 'Ram', 'ram@gmail.com', NULL, '$2y$10$Vd6MExgd4RgyKHYFRHDNqedcUA5CZp5hjjUl5Ro1/GqQvGQbCGn0C', NULL, '2021-09-17 07:03:56', '2021-09-17 07:03:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`bill_id`),
  ADD UNIQUE KEY `bill_details_bill_no_unique` (`bill_no`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `default__products`
--
ALTER TABLE `default__products`
  ADD PRIMARY KEY (`default_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst_payments`
--
ALTER TABLE `gst_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst_sells`
--
ALTER TABLE `gst_sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gst_sell_products`
--
ALTER TABLE `gst_sell_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invent`
--
ALTER TABLE `invent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lorries`
--
ALTER TABLE `lorries`
  ADD PRIMARY KEY (`lorry_id`);

--
-- Indexes for table `lorry_reports`
--
ALTER TABLE `lorry_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `previous_due`
--
ALTER TABLE `previous_due`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `purchasers`
--
ALTER TABLE `purchasers`
  ADD PRIMARY KEY (`purchaser_id`);

--
-- Indexes for table `purchaser_dues_amt`
--
ALTER TABLE `purchaser_dues_amt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`purchase_payment_id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`purchase_product_id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `sells_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sell_payamounts`
--
ALTER TABLE `sell_payamounts`
  ADD PRIMARY KEY (`pay_amount_id`);

--
-- Indexes for table `sell_products`
--
ALTER TABLE `sell_products`
  ADD PRIMARY KEY (`sell_products_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill_details`
--
ALTER TABLE `bill_details`
  MODIFY `bill_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `default__products`
--
ALTER TABLE `default__products`
  MODIFY `default_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gst_payments`
--
ALTER TABLE `gst_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gst_sells`
--
ALTER TABLE `gst_sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gst_sell_products`
--
ALTER TABLE `gst_sell_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invent`
--
ALTER TABLE `invent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lorries`
--
ALTER TABLE `lorries`
  MODIFY `lorry_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lorry_reports`
--
ALTER TABLE `lorry_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `previous_due`
--
ALTER TABLE `previous_due`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchasers`
--
ALTER TABLE `purchasers`
  MODIFY `purchaser_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchaser_dues_amt`
--
ALTER TABLE `purchaser_dues_amt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `purchase_payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `purchase_product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `sell_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `sell_payamounts`
--
ALTER TABLE `sell_payamounts`
  MODIFY `pay_amount_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sell_products`
--
ALTER TABLE `sell_products`
  MODIFY `sell_products_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `sells_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
