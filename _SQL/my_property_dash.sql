-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 18, 2020 at 01:11 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_property_dash`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

DROP TABLE IF EXISTS `billings`;
CREATE TABLE IF NOT EXISTS `billings` (
  `billing_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `billing_tenant_id` bigint(20) UNSIGNED NOT NULL,
  `billing_date` date NOT NULL,
  `billing_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_amt` double(8,2) NOT NULL,
  `billing_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`billing_id`),
  KEY `billings_billing_tenant_id_foreign` (`billing_tenant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`billing_id`, `billing_tenant_id`, `billing_date`, `billing_desc`, `billing_amt`, `billing_status`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-06', 'Security Deposit (Rent)', 10000.00, 'paid', '', NULL, NULL),
(2, 1, '2020-07-06', 'Others', 2000.00, 'paid', '', NULL, NULL),
(3, 1, '2020-07-06', 'Advance Rent', 10000.00, 'paid', '', NULL, NULL),
(4, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(5, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(6, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(7, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(8, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(9, 2, '2020-07-07', 'Security Deposit (Rent)', 10000.00, 'paid', '', NULL, NULL),
(10, 2, '2020-07-07', 'Advance Rent', 10000.00, 'paid', '', NULL, NULL),
(11, 2, '2020-07-07', 'Security Deposit (Utilities)', 0.00, 'paid', '', NULL, NULL),
(12, 1, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(13, 2, '2020-07-01', 'Electric', 0.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(14, 1, '2020-07-01', 'Electric', 0.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(15, 2, '2020-07-01', 'Water', 0.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(16, 1, '2020-07-01', 'Water', 0.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(17, 2, '2020-07-01', 'Water', 0.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(18, 1, '2020-07-01', 'Water', 0.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(19, 1, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(20, 1, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(21, 1, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(22, 1, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(23, 1, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(24, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(25, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(26, 2, '2020-07-01', 'Electric', 0.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(27, 1, '2020-07-01', 'Electric', 0.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(28, 2, '2020-07-01', 'Water', 99.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(29, 1, '2020-07-01', 'Water', 100.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(30, 1, '2020-07-14', 'Surcharge', 6000.00, 'unpaid', '', NULL, NULL),
(31, 2, '2020-07-14', 'Surcharge', 1000.00, 'unpaid', '', NULL, NULL),
(32, 1, '2020-07-14', 'Surcharge', 7200.00, 'unpaid', '', NULL, NULL),
(33, 2, '2020-07-14', 'Surcharge', 1100.00, 'unpaid', '', NULL, NULL),
(34, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(35, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(36, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(37, 1, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(38, 2, '2020-07-01', 'Water', 0.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(39, 1, '2020-07-01', 'Water', 0.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(40, 3, '2020-07-10', 'Security Deposit (Rent)', 10000.00, 'paid', '', NULL, NULL),
(41, 3, '2020-07-10', 'Advance Rent', 10000.00, 'paid', '', NULL, NULL),
(42, 3, '2020-07-10', 'Management Fee', 1000.00, 'paid', '', NULL, NULL),
(43, 4, '2020-01-01', 'Security Deposit (Rent)', 10000.00, 'paid', '', NULL, NULL),
(44, 4, '2020-01-01', 'Advance Rent', 10000.00, 'paid', '', NULL, NULL),
(45, 4, '2020-01-01', 'Security Deposit (Utilities)', 2000.00, 'paid', '', NULL, NULL),
(46, 3, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(47, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(48, 4, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jul 01- 31 2020', NULL, NULL),
(49, 3, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jun 01- 31 2020', NULL, NULL),
(50, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'paid', 'Jun 01- 31 2020', NULL, NULL),
(51, 4, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jun 01- 31 2020', NULL, NULL),
(52, 3, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jun 01- 31 2020', NULL, NULL),
(53, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jun 01- 31 2020', NULL, NULL),
(54, 4, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jun 01- 31 2020', NULL, NULL),
(55, 3, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(56, 2, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL),
(57, 4, '2020-07-01', 'Monthly Rent', 10000.00, 'unpaid', 'Jul 01- 31 2020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_26_061523_create_unit_owners_table', 1),
(5, '2020_03_26_061525_create_units_table', 1),
(6, '2020_04_22_042313_create_tenants_table', 1),
(7, '2020_04_27_093931_create_billings_table', 1),
(8, '2020_05_03_070223_create_payments_table', 1),
(9, '2020_06_03_051720_add_renewal_history_to_tenants_table', 1),
(10, '2020_07_06_020440_add_property_type_users_table', 1),
(11, '2020_07_09_035411_add_login_fields_to_users_table', 2),
(12, '2020_07_09_064726_add_user_status_in_users_table', 3),
(13, '2020_07_14_074452_add_type_of_account_to_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_tenant_id` bigint(20) UNSIGNED NOT NULL,
  `payment_created` date NOT NULL,
  `amt_paid` double(8,2) NOT NULL,
  `form_of_payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `or_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ar_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_deposited` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `payments_payment_tenant_id_foreign` (`payment_tenant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_tenant_id`, `payment_created`, `amt_paid`, `form_of_payment`, `or_number`, `ar_number`, `bank_name`, `check_no`, `date_deposited`, `payment_note`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-06', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Security Deposit (Rent)', NULL, NULL),
(2, 1, '2020-07-06', 2000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Others', NULL, NULL),
(3, 1, '2020-07-06', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Advance Rent', NULL, NULL),
(4, 2, '2020-07-07', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Security Deposit (Rent)', NULL, NULL),
(5, 2, '2020-07-07', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Advance Rent', NULL, NULL),
(6, 2, '2020-07-07', 0.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Security Deposit (Utilities)', NULL, NULL),
(7, 1, '2020-07-07', 99300.00, 'cash', 'Jul 01- 31 2020', '123123', NULL, NULL, NULL, 'rent', NULL, NULL),
(8, 1, '2020-07-07', 19300.00, 'cash', 'Jul 01- 31 2020', '100', 'BDO', NULL, NULL, 'Rent', NULL, NULL),
(9, 3, '2020-07-10', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Security Deposit (Rent)', NULL, NULL),
(10, 3, '2020-07-10', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Advance Rent', NULL, NULL),
(11, 3, '2020-07-10', 1000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Management Fee', NULL, NULL),
(12, 4, '2020-01-01', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Security Deposit (Rent)', NULL, NULL),
(13, 4, '2020-01-01', 10000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Advance Rent', NULL, NULL),
(14, 4, '2020-01-01', 2000.00, 'cash', NULL, NULL, NULL, NULL, NULL, 'Security Deposit (Utilities)', NULL, NULL),
(15, 1, '2020-07-10', 19300.00, 'cash', 'Jul 01- 31 2020', '123123', NULL, NULL, NULL, 'rent', NULL, NULL),
(16, 1, '2020-07-14', 100.00, 'cash', 'Jul 01- 31 2020', '1231', NULL, NULL, NULL, 'Water', NULL, NULL),
(17, 1, '2020-07-14', 21120.00, 'Cash', 'Jul 01- 31 2020', '17', NULL, NULL, NULL, 'Rent', NULL, NULL),
(18, 1, '2020-07-14', 21120.00, 'Cash', 'Jul 01- 31 2020', '46', NULL, NULL, NULL, 'Rent', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

DROP TABLE IF EXISTS `tenants`;
CREATE TABLE IF NOT EXISTS `tenants` (
  `tenant_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unit_tenant_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_unique_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `civil_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_monthly_rent` double(10,2) NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `movein_date` date DEFAULT NULL,
  `moveout_date` date DEFAULT NULL,
  `type_of_tenant` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_relationship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_contact_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `high_school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `high_school_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_school_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years_of_employment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_contact_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenants_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_extended` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_move_out_date` date DEFAULT NULL,
  `reason_for_moving_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `renewal_history` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`tenant_id`),
  KEY `tenants_unit_tenant_id_foreign` (`unit_tenant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `unit_tenant_id`, `tenant_unique_id`, `first_name`, `middle_name`, `last_name`, `birthdate`, `civil_status`, `id_number`, `zip_code`, `country`, `province`, `city`, `barangay`, `contact_no`, `email_address`, `tenant_monthly_rent`, `gender`, `tenant_status`, `movein_date`, `moveout_date`, `type_of_tenant`, `guardian`, `guardian_relationship`, `guardian_contact_no`, `high_school`, `high_school_address`, `college_school`, `college_school_address`, `course`, `year_level`, `employer`, `employer_address`, `job`, `years_of_employment`, `employer_contact_no`, `tenants_note`, `has_extended`, `actual_move_out_date`, `reason_for_moving_out`, `created_at`, `updated_at`, `renewal_history`) VALUES
(1, 1, '', 'Landley', NULL, 'Bernado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '09752826318', NULL, 10000.00, NULL, 'inactive', '2020-07-06', '2020-07-30', 'walk-in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-01', 'delinquent', NULL, NULL, NULL),
(2, 13, '', 'asdasd', NULL, 'sdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0909090', NULL, 10000.00, NULL, 'active', '2020-07-07', '2021-01-01', 'walk-in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 13, '', 'Landley', NULL, 'Bernardo', NULL, NULL, NULL, '2600', 'Philippines', 'Isabela', 'Ramon', NULL, '09752826318', NULL, 10000.00, 'male', 'active', '2020-07-10', '2020-08-07', 'walk-in', 'Laurence Bernardo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, '', 'Landley', NULL, 'Bernado', NULL, 'single', NULL, NULL, 'Philippines', 'Benguet', 'Baguio City', NULL, '09752826318', NULL, 10000.00, 'male', 'active', '2020-01-01', '2020-02-01', 'walk-in', 'Landley Bernado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `unit_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_unit_owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `floor_no` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `monthly_rent` double(8,2) NOT NULL,
  `egr` double(8,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vacant',
  `type_of_units` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `unit_property` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`unit_id`),
  KEY `units_unit_unit_owner_id_foreign` (`unit_unit_owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_no`, `unit_unit_owner_id`, `floor_no`, `beds`, `monthly_rent`, `egr`, `status`, `type_of_units`, `discount`, `unit_property`, `building`, `created_at`, `updated_at`) VALUES
(1, 'CA1', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', '2020-07-05 16:00:00'),
(2, 'CA2', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(3, 'CA3', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(4, 'CA4', NULL, 1, 2, 10000.00, 0.00, 'occupied', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', '2019-12-31 16:00:00'),
(5, 'CA5', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(6, 'CA6', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(7, 'CA7', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(8, 'CA8', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(9, 'CA9', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(10, 'CA10', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(11, 'CA11', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(12, 'CA12', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:24', NULL),
(13, 'CA13', NULL, 1, 2, 10000.00, 0.00, 'occupied', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', '2020-07-09 16:00:00'),
(14, 'CA14', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(15, 'CA15', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(16, 'CA16', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(17, 'CA17', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(18, 'CA18', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(19, 'CA19', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(20, 'CA20', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(21, 'CA21', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(22, 'CA22', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(23, 'CA23', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(24, 'CA24', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(25, 'CA25', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(26, 'CA26', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(27, 'CA27', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(28, 'CA28', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(29, 'CA29', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(30, 'CA30', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(31, 'CA31', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(32, 'CA32', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(33, 'CA33', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(34, 'CA34', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(35, 'CA35', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(36, 'CA36', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(37, 'CA37', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(38, 'CA38', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(39, 'CA39', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(40, 'CA40', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(41, 'CA41', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(42, 'CA42', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(43, 'CA43', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(44, 'CA44', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(45, 'CA45', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(46, 'CA46', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(47, 'CA47', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(48, 'CA48', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(49, 'CA49', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(50, 'CA50', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(51, 'CA51', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(52, 'CA52', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(53, 'CA53', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(54, 'CA54', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(55, 'CA55', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(56, 'CA56', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(57, 'CA57', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(58, 'CA58', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(59, 'CA59', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(60, 'CA60', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(61, 'CA61', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(62, 'CA62', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(63, 'CA63', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(64, 'CA64', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(65, 'CA65', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(66, 'CA66', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(67, 'CA67', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(68, 'CA68', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(69, 'CA69', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(70, 'CA70', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(71, 'CA71', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(72, 'CA72', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(73, 'CA73', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(74, 'CA74', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(75, 'CA75', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(76, 'CA76', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(77, 'CA77', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(78, 'CA78', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(79, 'CA79', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(80, 'CA80', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(81, 'CA81', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(82, 'CA82', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(83, 'CA83', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(84, 'CA84', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(85, 'CA85', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(86, 'CA86', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(87, 'CA87', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(88, 'CA88', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(89, 'CA89', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(90, 'CA90', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(91, 'CA91', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(92, 'CA92', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(93, 'CA93', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(94, 'CA94', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(95, 'CA95', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(96, 'CA96', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(97, 'CA97', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(98, 'CA98', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(99, 'CA99', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(100, 'CA100', NULL, 1, 2, 10000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-A', '2020-07-05 19:54:25', NULL),
(101, 'CB-4B1', NULL, 0, 2, 5000.00, 0.00, 'vacant', 'leasing', 0.00, 'Staples Center', 'Building-B', '2020-07-05 19:56:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_owners`
--

DROP TABLE IF EXISTS `unit_owners`;
CREATE TABLE IF NOT EXISTS `unit_owners` (
  `unit_owner_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_invested` date DEFAULT NULL,
  `unit_owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investor_email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investor_contact_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investor_representative` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investor_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `investment_price` double(8,2) DEFAULT NULL,
  `investment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`unit_owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unregistered',
  `property` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_ownership` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_logout_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_current_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `property`, `user_type`, `property_type`, `property_ownership`, `last_login_at`, `last_logout_at`, `last_login_ip`, `user_current_status`, `account_type`) VALUES
(1, 'Laurence Bernardo', 'landleydgreat@gmail.com', NULL, '$2y$10$r7hgh0aiXlOQYvTaMfNWLe6uJ2yXQ5i7iqIfLfBhdwifUw.8.atxq', NULL, '2020-07-05 18:24:18', '2020-07-05 18:24:18', 'registered', 'Staples Center', 'manager', 'Commercial Complex', 'Multiple Owners', '2020-07-16 10:03:18', '2020-07-14 09:07:16', '127.0.0.1', 'online', NULL),
(2, 'Anand Perez', 'marthaoyonc@gmail.com', NULL, '$2y$10$Vwt9kvaZlM1xogwm.bU8.Oz7CHrVaaZXgnDOYvDNIBHB/I.Nt.dEK', NULL, '2020-07-05 18:54:32', NULL, 'registered', 'Staples Center', 'admin', 'Commercial Complex', 'Multiple Owners', NULL, NULL, NULL, NULL, NULL),
(3, 'Landley Bernado', 'laurence@gmail.com', NULL, '$2y$10$l5CSu6WqmtdXJ69sZOIh3.AngFlW2QlTcL1ACRL384UELMmVsdxLO', NULL, '2020-07-05 18:55:54', NULL, 'registered', 'Staples Center', 'admin', 'Commercial Complex', 'Multiple Owners', NULL, NULL, NULL, NULL, NULL),
(4, 'asdasdasd', 'sasdasds@asda.com', NULL, '$2y$10$718bu9ifjt0rqmEugL0f9e2W9fGO0AecoMgsr.LXl/VoCeZNs7MIS', NULL, '2020-07-06 19:55:22', NULL, 'registered', 'Staples Center', 'admin', 'Commercial Complex', 'Multiple Owners', NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billings`
--
ALTER TABLE `billings`
  ADD CONSTRAINT `billings_billing_tenant_id_foreign` FOREIGN KEY (`billing_tenant_id`) REFERENCES `tenants` (`tenant_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_payment_tenant_id_foreign` FOREIGN KEY (`payment_tenant_id`) REFERENCES `tenants` (`tenant_id`);

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_unit_tenant_id_foreign` FOREIGN KEY (`unit_tenant_id`) REFERENCES `units` (`unit_id`);

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_unit_unit_owner_id_foreign` FOREIGN KEY (`unit_unit_owner_id`) REFERENCES `unit_owners` (`unit_owner_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
