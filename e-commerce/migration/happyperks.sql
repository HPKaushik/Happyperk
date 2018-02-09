-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 06:53 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hp_activity_log`
--

CREATE TABLE `hp_activity_log` (
  `log_id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `operation` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `corporate_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_activity_log`
--

INSERT INTO `hp_activity_log` (`log_id`, `module`, `operation`, `item_id`, `user_id`, `created_at`, `corporate_id`, `employee_id`) VALUES
(1, 'Admin', 'login', 408, 812, '2018-02-01 10:26:41', 1, 0),
(2, 'Admin', 'login', 409, 812, '2018-02-01 10:28:20', 1, 0),
(3, 'Admin', 'login', 1, 967, '2018-02-01 13:43:29', 2, 0),
(4, 'Admin', 'login', 2, 967, '2018-02-01 13:45:29', 2, 0),
(5, 'Admin', 'login', 3, 967, '2018-02-01 13:45:58', 2, 0),
(6, 'Admin', 'login', 4, 967, '2018-02-01 15:46:41', 2, 0),
(7, 'Admin', 'login', 5, 967, '2018-02-01 16:13:12', 2, 0),
(8, 'Admin', 'login', 6, 967, '2018-02-02 11:31:11', 2, 0),
(9, 'Admin', 'login', 7, 967, '2018-02-02 12:32:33', 2, 0),
(10, 'Admin', 'login', 8, 967, '2018-02-05 11:51:22', 2, 0),
(11, 'Admin', 'login', 9, 967, '2018-02-08 12:09:44', 2, 0),
(12, 'Admin', 'login', 10, 967, '2018-02-08 18:42:28', 2, 0),
(13, 'Admin', 'login', 11, 967, '2018-02-09 10:03:07', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hp_announcements`
--

CREATE TABLE `hp_announcements` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `announcement_id` varchar(30) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `corporate_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_announcements`
--

INSERT INTO `hp_announcements` (`id`, `name`, `announcement_id`, `image`, `description`, `corporate_id`, `department_id`, `created_at`, `updated_at`, `status`, `user_id`) VALUES
(1, 'dump', 'ANS0000001', NULL, 'assd', 2, 1, '2018-02-01 07:46:22', '2018-02-01 07:47:23', 1, 0),
(2, '\\Holiday', 'ANS0000002', NULL, 'Tomorrow is Holiday', 2, 2, '2018-02-01 09:29:45', '2018-02-01 09:29:45', 1, 967);

-- --------------------------------------------------------

--
-- Table structure for table `hp_available_locations`
--

CREATE TABLE `hp_available_locations` (
  `id` mediumint(10) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location_code` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1->enable, 0->disable',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_available_locations`
--

INSERT INTO `hp_available_locations` (`id`, `city_id`, `name`, `location_code`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'hyderabad', 'hyd', 'location_c797e715826d4115f558b16f2ce7ea41hyderabad.png', 1, '2017-10-26 00:00:00', '2017-11-27 07:02:42'),
(2, 1482, 'Kolkata', 'klt', 'location_e3cfa7a0a4d8ebcbe8a4512de072e7a5kolkata.png', 1, '2017-10-26 00:00:00', '2017-11-27 07:03:05'),
(3, 114, 'Delhi', 'del', 'location_a16f956083ff9c904c5e12bb51124825delhi.png', 1, '2017-11-27 05:56:25', '2017-11-27 07:02:21'),
(4, 451, 'chennai', 'chn', 'location_b86464e11f91a0bb52fa78be658b5c11chennai.png', 1, '2017-11-27 05:57:48', '2017-11-27 07:02:06'),
(5, 215, 'bangalore', 'bnglr', 'location_2b4d739678f2f1e8273b363ca052bbdabangalore.png', 1, '2017-11-27 05:59:59', '2017-11-27 07:01:52'),
(6, 116, 'Ahmedabad', 'amh', 'location_26a7e3fd7a028a83cac83d15fb182960ahmedabad.png', 1, '2017-11-27 06:00:36', '2017-11-27 07:01:26'),
(7, 319, 'Mumbai', 'mum', 'location_6a195dbdd3ce6b133a0089da90e103e6mumbai.png', 1, '2017-11-27 07:03:18', '2017-11-27 07:03:18'),
(8, 326, 'Pune', 'pun', 'location_b69616d09e14c6b38f32846774cfe54apune.png', 1, '2017-11-27 07:03:30', '2017-11-27 07:03:30'),
(9, 16, '', 'MG MALL ROAD', 'location_625a23b5111ffd07056932cdaea2b3e1location-marker-flat.png', 0, '2018-01-17 09:39:21', '2018-01-17 09:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `hp_awards`
--

CREATE TABLE `hp_awards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_awards`
--

INSERT INTO `hp_awards` (`id`, `user_id`, `corporate_id`, `employee`, `title`, `badge_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 967, 2, 2, 'dump', 29, 'jkljkl', 1, '2018-02-01 07:43:21', '2018-02-01 07:43:21'),
(2, 967, 2, 2, 'Perferendis aute vel omnis molestiae in est tenetur facilis numquam quo distinctio', 26, 'Molestiae et exercitationem ab consectetur excepturi', 1, '2018-02-01 09:30:26', '2018-02-02 09:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `hp_badges`
--

CREATE TABLE `hp_badges` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_badges`
--

INSERT INTO `hp_badges` (`id`, `image`, `title`, `description`, `updated_at`, `created_at`) VALUES
(19, 'best_learner.png', 'best learner', 'description', '2018-01-22 10:51:10', '2018-01-22 10:51:10'),
(20, 'excel_guru.png', 'excel guru', 'excel guru', '2018-01-22 11:04:38', '2018-01-22 11:04:38'),
(21, 'best_performer.png', 'best performer', 'desc', '2018-01-22 15:28:50', '2018-01-22 15:28:50'),
(22, 'best_team_player.png', 'best team player', 'desc', '2018-01-22 15:28:50', '2018-01-22 15:28:50'),
(23, 'helper.png', 'helper', 'desc', '2018-01-22 15:29:28', '2018-01-22 15:29:28'),
(24, 'initiator.png', 'initiator', 'desc', '2018-01-22 15:29:28', '2018-01-22 15:29:28'),
(25, 'night_owl.png', 'night owl', 'desc', '2018-01-22 15:30:02', '2018-01-22 15:30:02'),
(26, 'office_dj.png', 'office dj', 'desc', '2018-01-22 15:30:02', '2018-01-22 15:30:02'),
(27, 'party_boy.png', 'party boy', 'desc', '2018-01-22 15:30:40', '2018-01-22 15:30:40'),
(28, 'problem_solver.png', 'problem solver', 'desc', '2018-01-22 15:30:40', '2018-01-22 15:30:40'),
(29, 'team_hero.png', 'team hero', 'desc', '2018-01-22 15:30:58', '2018-01-22 15:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `hp_banners`
--

CREATE TABLE `hp_banners` (
  `banners_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `corporate_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `link` varchar(255) DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `position` varchar(255) DEFAULT NULL,
  `align` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `field_type` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_brands`
--

CREATE TABLE `hp_brands` (
  `id` int(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `category_id` int(11) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_brands`
--

INSERT INTO `hp_brands` (`id`, `name`, `description`, `category_id`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'carnival', 'Full body massages', 3, 'brand_93b120e388ba687e12e125397817c69dcarnival_cinemas.jpg', 1, '2018-01-04 09:12:15', '2018-01-04 09:12:15'),
(2, 'O2spa', 'Full body massages', 2, 'brand_ef9516f14eb54c684d0499e884b53f2co2spa.jpg', 1, '2018-01-04 09:37:53', '2018-01-04 09:37:53'),
(3, 'B-Lounge', 'Full Body massage & spa services', 2, 'brand_4f4bbc44abc3e93bfe4095b195aeef6dblounge.jpg', 1, '2018-01-04 12:14:36', '2018-01-04 12:14:36'),
(4, 'shathayu', 'Ayurvedic spa therepies', 2, NULL, 1, '2018-01-04 12:15:59', '2018-01-04 12:15:59'),
(5, 'The white spa', 'Full body massages', 2, 'brand_b240d0a999ec1f4af77bfd81bf9a2ee7whitespa.jpg', 1, '2018-01-04 12:18:22', '2018-01-04 12:18:22'),
(6, 'Dolphin Spa', 'Give in to your impulses and treat yourself with a pampering session at Dolphin Spa, located in Indiranagar. The spa offers a comprehensive set of therapies that are well-crafted in order to cater to all your rejuvenating and relaxing needs. All the services are provided by a team of skilled therapists who are well versed with the latest trends and techniques. Take a trip to Dolphin Spa and have yourself pampered thoroughly.', 2, 'brand_a92681cb61c79b64905dd6e5adbe598bdolphin spa.jpg', 1, '2018-01-08 11:15:50', '2018-01-08 11:15:50'),
(7, 'Tony & Guy', NULL, 1, 'brand_d0a12f368a928470f9ef126241f30701tony and guy.jpg', 1, '2018-01-09 06:37:35', '2018-01-09 06:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `hp_brands_redeem_locations`
--

CREATE TABLE `hp_brands_redeem_locations` (
  `id` int(100) NOT NULL,
  `brand_id` int(150) NOT NULL,
  `address` text,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_brands_redeem_locations`
--

INSERT INTO `hp_brands_redeem_locations` (`id`, `brand_id`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 1, '1st Cross Rd, Jakasandra Block, Koramangala 3 Block, Koramangala, Bengaluru, Karnataka 560034, India', '12.927941485198003', '77.63049256056547', '2018-01-04 09:12:15', '2018-01-04 09:12:15'),
(2, 1, '2073, Dr Ambedkar Medical College Rd, Kushal Nagar, Kadugondanahalli, Bengaluru, Karnataka 560045, India', '13.021324856590686', '77.61897347867489', '2018-01-04 09:12:15', '2018-01-04 09:12:15'),
(3, 2, 'Manyata Tech Park Road, Manyata Residency, Manayata Tech Park, Thanisandra, Bengaluru, Karnataka 560045, India', '13.05406135534684', '77.62058615684509', '2018-01-04 09:37:53', '2018-01-04 09:37:53'),
(4, 2, 'Sri Sukhi Nilayam, Shivapura, Peenya, Bengaluru, Karnataka 560058, India', '13.025965926333539', '77.50866293907166', '2018-01-04 09:37:53', '2018-01-04 09:37:53'),
(5, 2, 'A-27, Namjoshi Rd, Ramesh Nagar, Vimanapura, Bengaluru, Karnataka 560037, India', '12.964412428478395', '77.68238425254822', '2018-01-04 09:37:53', '2018-01-04 09:37:53'),
(6, 3, 'Suraksha Residency, KR Layout, JP Nagar Phase 6, JP Nagar, Bengaluru, Karnataka 560078, India', '12.903513010243165', '77.58419394493103', '2018-01-04 12:14:36', '2018-01-04 12:14:36'),
(7, 3, '313, K Channappa Rd, Peace Layout, Kacharakanahalli, Bengaluru, Karnataka 560084, India', '13.01392405202657', '77.63363242149353', '2018-01-04 12:14:36', '2018-01-04 12:14:36'),
(8, 3, '1, S.T. Bed, Cauvery Colony, Koramangala, Bengaluru, Karnataka 560095, India', '12.930953049543119', '77.64118552207947', '2018-01-04 12:14:36', '2018-01-04 12:14:36'),
(9, 4, 'Unnamed Road, Silicon Town, Electronic City, Bengaluru, Karnataka 560100, India', '12.85531834121792', '77.67826437950134', '2018-01-04 12:15:59', '2018-01-04 12:15:59'),
(10, 4, '257-258, 9th Main Rd, Lakkasandra, Lakkasandra Extension, Wilson Garden, Bengaluru, Karnataka 560030, India', '12.945675729694095', '77.60067343711853', '2018-01-04 12:15:59', '2018-01-04 12:15:59'),
(11, 4, '1/11, PSK Naidu Rd, Cox Town, Bengaluru, Karnataka 560005, India', '12.993852961834985', '77.62264609336853', '2018-01-04 12:15:59', '2018-01-04 12:15:59'),
(12, 4, '2388, 16th A Main Rd, HAL 2nd Stage, Indiranagar, Bengaluru, Karnataka 560008, India', '12.965081570216977', '77.64599204063416', '2018-01-04 12:15:59', '2018-01-04 12:15:59'),
(13, 4, 'Unnamed Road, Bengaluru, Karnataka 560095, India', '12.930953049543119', '77.64393210411072', '2018-01-04 12:15:59', '2018-01-04 12:15:59'),
(14, 5, '152/2/2, Sindhi Colony, Pulikeshi Nagar, Bengaluru, Karnataka 560005, India', '12.993852961834985', '77.6157796382904', '2018-01-04 12:18:22', '2018-01-04 12:18:22'),
(15, 5, 'Unnamed Road, Thirumalashettyhally, Bengaluru, Karnataka 562114, India', '12.97244201057838', '77.78332114219666', '2018-01-04 12:18:22', '2018-01-04 12:18:22'),
(16, 5, 'Unnamed Road, Bengaluru, Karnataka 562162, India', '13.023958987926509', '77.39261984825134', '2018-01-04 12:18:22', '2018-01-04 12:18:22'),
(17, 5, '80 Feet Rd, Volagalahalli, Stage II, Kengeri Satellite Town, Bengaluru, Karnataka 560060, India', '12.923591383664585', '77.49355673789978', '2018-01-04 12:18:22', '2018-01-04 12:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `hp_cart`
--

CREATE TABLE `hp_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `price` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `hp_categories`
--

CREATE TABLE `hp_categories` (
  `id` int(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `cashback_mode` tinyint(1) DEFAULT '0',
  `cashback_amount` decimal(10,2) DEFAULT NULL,
  `image` blob,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_categories`
--

INSERT INTO `hp_categories` (`id`, `name`, `cashback_mode`, `cashback_amount`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Salon', 0, NULL, NULL, 1, '2017-11-03 00:00:00', '2017-11-09 05:44:26'),
(2, 'Spa', 0, NULL, NULL, 1, '2017-11-09 05:44:35', '2017-11-09 05:44:35'),
(3, 'Movies', 0, NULL, NULL, 1, '2017-11-09 05:45:09', '2017-11-09 05:45:09'),
(4, 'Dine', 0, NULL, NULL, 0, '2017-11-16 05:21:13', '2017-11-16 05:21:48'),
(5, 'Food & Beverages', 1, '10.00', NULL, 1, '2017-12-05 10:32:21', '2017-12-05 10:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `hp_city`
--

CREATE TABLE `hp_city` (
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hp_city`
--

INSERT INTO `hp_city` (`city_id`, `state_id`, `city_name`) VALUES
(1, 1, 'Andaman & Nicobar Islands'),
(2, 2, 'Adilabad'),
(3, 2, 'Anantapur'),
(4, 2, 'Chittoor'),
(5, 2, 'East Godavari'),
(6, 2, 'Guntur'),
(7, 2, 'Hyderabad'),
(8, 2, 'Kadapa'),
(9, 2, 'Karimnagar'),
(10, 2, 'Khammam'),
(11, 2, 'Krishna'),
(12, 2, 'Kurnool'),
(13, 2, 'Mahbubnagar'),
(14, 2, 'Medak'),
(15, 2, 'Nalgonda'),
(16, 2, 'Nellore'),
(17, 2, 'Nizamabad'),
(18, 2, 'Prakasam'),
(19, 2, 'Rangareddi'),
(20, 2, 'Srikakulam'),
(21, 2, 'Vishakhapatnam'),
(22, 2, 'Vizianagaram'),
(23, 2, 'Warangal'),
(24, 2, 'West Godavari'),
(25, 3, 'Anjaw'),
(26, 3, 'Changlang'),
(27, 3, 'East Kameng'),
(28, 3, 'Lohit'),
(29, 3, 'Lower Subansiri'),
(30, 3, 'Papum Pare'),
(31, 3, 'Tirap'),
(32, 3, 'Dibang Valley'),
(33, 3, 'Upper Subansiri'),
(34, 3, 'West Kameng'),
(35, 4, 'Barpeta'),
(36, 4, 'Bongaigaon'),
(37, 4, 'Cachar'),
(38, 4, 'Darrang'),
(39, 4, 'Dhemaji'),
(40, 4, 'Dhubri'),
(41, 4, 'Dibrugarh'),
(42, 4, 'Goalpara'),
(43, 4, 'Golaghat'),
(44, 4, 'Hailakandi'),
(45, 4, 'Jorhat'),
(46, 4, 'Karbi Anglong'),
(47, 4, 'Karimganj'),
(48, 4, 'Kokrajhar'),
(49, 4, 'Lakhimpur'),
(50, 4, 'Marigaon'),
(51, 4, 'Nagaon'),
(52, 4, 'Nalbari'),
(53, 4, 'North Cachar Hills'),
(54, 4, 'Sibsagar'),
(55, 4, 'Sonitpur'),
(56, 4, 'Tinsukia'),
(57, 5, 'Araria'),
(58, 5, 'Aurangabad'),
(59, 5, 'Banka'),
(60, 5, 'Begusarai'),
(61, 5, 'Bhagalpur'),
(62, 5, 'Bhojpur'),
(63, 5, 'Buxar'),
(64, 5, 'Darbhanga'),
(65, 5, 'Purba Champaran'),
(66, 5, 'Gaya'),
(67, 5, 'Gopalganj'),
(68, 5, 'Jamui'),
(69, 5, 'Jehanabad'),
(70, 5, 'Khagaria'),
(71, 5, 'Kishanganj'),
(72, 5, 'Kaimur'),
(73, 5, 'Katihar'),
(74, 5, 'Lakhisarai'),
(75, 5, 'Madhubani'),
(76, 5, 'Munger'),
(77, 5, 'Madhepura'),
(78, 5, 'Muzaffarpur'),
(79, 5, 'Nalanda'),
(80, 5, 'Nawada'),
(81, 5, 'Patna'),
(82, 5, 'Purnia'),
(83, 5, 'Rohtas'),
(84, 5, 'Saharsa'),
(85, 5, 'Samastipur'),
(86, 5, 'Sheohar'),
(87, 5, 'Sheikhpura'),
(88, 5, 'Saran'),
(89, 5, 'Sitamarhi'),
(90, 5, 'Supaul'),
(91, 5, 'Siwan'),
(92, 5, 'Vaishali'),
(93, 5, 'Pashchim Champaran'),
(94, 6, 'Bastar'),
(95, 6, 'Bilaspur'),
(96, 6, 'Dantewada'),
(97, 6, 'Dhamtari'),
(98, 6, 'Durg'),
(99, 6, 'Jashpur'),
(100, 6, 'Janjgir-Champa'),
(101, 6, 'Korba'),
(102, 6, 'Koriya'),
(103, 6, 'Kanker'),
(104, 6, 'Kawardha'),
(105, 6, 'Mahasamund'),
(106, 6, 'Raigarh'),
(107, 6, 'Rajnandgaon'),
(108, 6, 'Raipur'),
(109, 6, 'Surguja'),
(110, 7, 'Chandigarh'),
(111, 8, 'Dadra and Nagar Haveli'),
(112, 9, 'Diu'),
(113, 9, 'Daman'),
(114, 10, 'New Delhi'),
(115, 11, 'Goa'),
(116, 12, 'Ahmedabad'),
(117, 12, 'Anand'),
(118, 12, 'Banaskantha'),
(119, 12, 'Bharuch'),
(120, 12, 'Bhavnagar'),
(121, 12, 'Dahod'),
(122, 12, 'The Dangs'),
(123, 12, 'Gandhinagar'),
(124, 12, 'Jamnagar'),
(125, 12, 'Junagadh'),
(126, 12, 'Kutch'),
(127, 12, 'Kheda'),
(128, 12, 'Mehsana'),
(129, 12, 'Narmada'),
(130, 12, 'Navsari'),
(131, 12, 'Patan'),
(132, 12, 'Panchmahal'),
(133, 12, 'Porbandar'),
(134, 12, 'Rajkot'),
(135, 12, 'Sabarkantha'),
(136, 12, 'Surendranagar'),
(137, 12, 'Surat'),
(138, 12, 'Vadodara'),
(139, 12, 'Valsad'),
(140, 13, 'Ambala'),
(141, 13, 'Bhiwani'),
(142, 13, 'Faridabad'),
(143, 13, 'Fatehabad'),
(144, 13, 'Gurgaon'),
(145, 13, 'Hissar'),
(146, 13, 'Jhajjar'),
(147, 13, 'Jind'),
(148, 13, 'Karnal'),
(149, 13, 'Kaithal'),
(150, 13, 'Kurukshetra'),
(151, 13, 'Mahendragarh'),
(152, 13, 'Mewat'),
(153, 13, 'Panchkula'),
(154, 13, 'Panipat'),
(155, 13, 'Rewari'),
(156, 13, 'Rohtak'),
(157, 13, 'Sirsa'),
(158, 13, 'Sonepat'),
(159, 13, 'Yamuna Nagar'),
(160, 13, 'Palwal'),
(161, 14, 'Bilaspur'),
(162, 14, 'Chamba'),
(163, 14, 'Hamirpur'),
(164, 14, 'Kangra'),
(165, 14, 'Kinnaur'),
(166, 14, 'Kulu'),
(167, 14, 'Lahaul and Spiti'),
(168, 14, 'Mandi'),
(169, 14, 'Shimla'),
(170, 14, 'Sirmaur'),
(171, 14, 'Solan'),
(172, 14, 'Una'),
(173, 15, 'Anantnag'),
(174, 15, 'Badgam'),
(175, 15, 'Bandipore'),
(176, 15, 'Baramula'),
(177, 15, 'Doda'),
(178, 15, 'Jammu'),
(179, 15, 'Kargil'),
(180, 15, 'Kathua'),
(181, 15, 'Kupwara'),
(182, 15, 'Leh'),
(183, 15, 'Poonch'),
(184, 15, 'Pulwama'),
(185, 15, 'Rajauri'),
(186, 15, 'Srinagar'),
(187, 15, 'Samba'),
(188, 15, 'Udhampur'),
(189, 16, 'Bokaro'),
(190, 16, 'Chatra'),
(191, 16, 'Deoghar'),
(192, 16, 'Dhanbad'),
(193, 16, 'Dumka'),
(194, 16, 'Purba Singhbhum'),
(195, 16, 'Garhwa'),
(196, 16, 'Giridih'),
(197, 16, 'Godda'),
(198, 16, 'Gumla'),
(199, 16, 'Hazaribagh'),
(200, 16, 'Koderma'),
(201, 16, 'Lohardaga'),
(202, 16, 'Pakur'),
(203, 16, 'Palamu'),
(204, 16, 'Ranchi'),
(205, 16, 'Sahibganj'),
(206, 16, 'Seraikela and Kharsawan'),
(207, 16, 'Pashchim Singhbhum'),
(208, 16, 'Ramgarh'),
(209, 17, 'Bidar'),
(210, 17, 'Belgaum'),
(211, 17, 'Bijapur'),
(212, 17, 'Bagalkot'),
(213, 17, 'Bellary'),
(214, 17, 'Bangalore Rural District'),
(215, 17, 'Bangalore'),
(216, 17, 'Chamarajnagar'),
(217, 17, 'Chikmagalur'),
(218, 17, 'Chitradurga'),
(219, 17, 'Davanagere'),
(220, 17, 'Dharwad'),
(221, 17, 'Dakshina Kannada'),
(222, 17, 'Gadag'),
(223, 17, 'Gulbarga'),
(224, 17, 'Hassan'),
(225, 17, 'Haveri District'),
(226, 17, 'Kodagu'),
(227, 17, 'Kolar'),
(228, 17, 'Koppal'),
(229, 17, 'Mandya'),
(230, 17, 'Mysore'),
(231, 17, 'Raichur'),
(232, 17, 'Shimoga'),
(233, 17, 'Tumkur'),
(234, 17, 'Udupi'),
(235, 17, 'Uttara Kannada'),
(236, 17, 'Ramanagara'),
(237, 17, 'Chikballapur'),
(238, 17, 'Yadagiri'),
(239, 18, 'Alappuzha'),
(240, 18, 'Ernakulam'),
(241, 18, 'Idukki'),
(242, 18, 'Kollam'),
(243, 18, 'Kannur'),
(244, 18, 'Kasaragod'),
(245, 18, 'Kottayam'),
(246, 18, 'Kozhikode'),
(247, 18, 'Malappuram'),
(248, 18, 'Palakkad'),
(249, 18, 'Pathanamthitta'),
(250, 18, 'Thrissur'),
(251, 18, 'Thiruvananthapuram'),
(252, 18, 'Wayanad'),
(253, 19, 'Lakshadweep'),
(254, 20, 'Alirajpur'),
(255, 20, 'Anuppur'),
(256, 20, 'Ashok Nagar'),
(257, 20, 'Balaghat'),
(258, 20, 'Barwani'),
(259, 20, 'Betul'),
(260, 20, 'Bhind'),
(261, 20, 'Bhopal'),
(262, 20, 'Burhanpur'),
(263, 20, 'Chhatarpur'),
(264, 20, 'Chhindwara'),
(265, 20, 'Damoh'),
(266, 20, 'Datia'),
(267, 20, 'Dewas'),
(268, 20, 'Dhar'),
(269, 20, 'Dindori'),
(270, 20, 'Guna'),
(271, 20, 'Gwalior'),
(272, 20, 'Harda'),
(273, 20, 'Hoshangabad'),
(274, 20, 'Indore'),
(275, 20, 'Jabalpur'),
(276, 20, 'Jhabua'),
(277, 20, 'Katni'),
(278, 20, 'Khandwa'),
(279, 20, 'Khargone'),
(280, 20, 'Mandla'),
(281, 20, 'Mandsaur'),
(282, 20, 'Morena'),
(283, 20, 'Narsinghpur'),
(284, 20, 'Neemuch'),
(285, 20, 'Panna'),
(286, 20, 'Rewa'),
(287, 20, 'Rajgarh'),
(288, 20, 'Ratlam'),
(289, 20, 'Raisen'),
(290, 20, 'Sagar'),
(291, 20, 'Satna'),
(292, 20, 'Sehore'),
(293, 20, 'Seoni'),
(294, 20, 'Shahdol'),
(295, 20, 'Shajapur'),
(296, 20, 'Sheopur'),
(297, 20, 'Shivpuri'),
(298, 20, 'Sidhi'),
(299, 20, 'Singrauli'),
(300, 20, 'Ujjain'),
(301, 20, 'Umaria'),
(302, 20, 'Vidisha'),
(303, 21, 'Ahmednagar'),
(304, 21, 'Akola'),
(305, 21, 'Amrawati'),
(306, 21, 'Aurangabad'),
(307, 21, 'Bhandara'),
(308, 21, 'Beed'),
(309, 21, 'Buldhana'),
(310, 21, 'Chandrapur'),
(311, 21, 'Dhule'),
(312, 21, 'Gadchiroli'),
(313, 21, 'Gondiya'),
(314, 21, 'Hingoli'),
(315, 21, 'Jalgaon'),
(316, 21, 'Jalna'),
(317, 21, 'Kolhapur'),
(318, 21, 'Latur'),
(319, 21, 'Mumbai'),
(320, 21, 'Nandurbar'),
(321, 21, 'Nanded'),
(322, 21, 'Nagpur'),
(323, 21, 'Nashik'),
(324, 21, 'Osmanabad'),
(325, 21, 'Parbhani'),
(326, 21, 'Pune'),
(327, 21, 'Raigad'),
(328, 21, 'Ratnagiri'),
(329, 21, 'Sindhudurg'),
(330, 21, 'Sangli'),
(331, 21, 'Solapur'),
(332, 21, 'Satara'),
(333, 21, 'Thane'),
(334, 21, 'Wardha'),
(335, 21, 'Washim'),
(336, 21, 'Yavatmal'),
(337, 22, 'Bishnupur'),
(338, 22, 'Churachandpur'),
(339, 22, 'Chandel'),
(340, 22, 'Imphal'),
(341, 22, 'Senapati'),
(342, 22, 'Tamenglong'),
(343, 22, 'Thoubal'),
(344, 22, 'Ukhrul'),
(345, 23, 'Garo Hills'),
(346, 23, 'Khasi Hills'),
(347, 23, 'Jaintia Hills'),
(348, 23, 'Ri-Bhoi'),
(349, 24, 'Aizawl'),
(350, 24, 'Champhai'),
(351, 24, 'Kolasib'),
(352, 24, 'Lawngtlai'),
(353, 24, 'Lunglei'),
(354, 24, 'Mamit'),
(355, 24, 'Saiha'),
(356, 24, 'Serchhip'),
(357, 25, 'Dimapur'),
(358, 25, 'Kohima'),
(359, 25, 'Mokokchung'),
(360, 25, 'Mon '),
(361, 25, 'Phek'),
(362, 25, 'Tuensang'),
(363, 25, 'Wokha'),
(364, 25, 'Zunheboto'),
(365, 26, 'Angul'),
(366, 26, 'Boudh'),
(367, 26, 'Bhadrak'),
(368, 26, 'Bolangir'),
(369, 26, 'Bargarh'),
(370, 26, 'Baleswar'),
(371, 26, 'Cuttack'),
(372, 26, 'Debagarh'),
(373, 26, 'Dhenkanal'),
(374, 26, 'Ganjam'),
(375, 26, 'Gajapati'),
(376, 26, 'Jharsuguda'),
(377, 26, 'Jajapur'),
(378, 26, 'Jagatsinghpur'),
(379, 26, 'Khordha'),
(380, 26, 'Kendujhar'),
(381, 26, 'Kalahandi'),
(382, 26, 'Kandhamal'),
(383, 26, 'Koraput'),
(384, 26, 'Kendrapara'),
(385, 26, 'Malkangiri'),
(386, 26, 'Mayurbhanj'),
(387, 26, 'Nabarangpur'),
(388, 26, 'Nuapada'),
(389, 26, 'Nayagarh'),
(390, 26, 'Puri'),
(391, 26, 'Rayagada'),
(392, 26, 'Sambalpur'),
(393, 26, 'Subarnapur'),
(394, 26, 'Sundargarh'),
(395, 27, 'Karaikal'),
(396, 27, 'Mahe'),
(397, 27, 'Puducherry'),
(398, 27, 'Yanam'),
(399, 28, 'Amritsar'),
(400, 28, 'Bathinda'),
(401, 28, 'Firozpur'),
(402, 28, 'Faridkot'),
(403, 28, 'Fatehgarh Sahib'),
(404, 28, 'Gurdaspur'),
(405, 28, 'Hoshiarpur'),
(406, 28, 'Jalandhar'),
(407, 28, 'Kapurthala'),
(408, 28, 'Ludhiana'),
(409, 28, 'Mansa'),
(410, 28, 'Moga'),
(411, 28, 'Mukatsar'),
(412, 28, 'Nawan Shehar'),
(413, 28, 'Patiala'),
(414, 28, 'Rupnagar'),
(415, 28, 'Sangrur'),
(416, 29, 'Ajmer'),
(417, 29, 'Alwar'),
(418, 29, 'Bikaner'),
(419, 28, 'Barmer'),
(420, 29, 'Banswara'),
(421, 29, 'Bharatpur'),
(422, 29, 'Baran'),
(423, 29, 'Bundi'),
(424, 29, 'Bhilwara'),
(425, 29, 'Churu'),
(426, 29, 'Chittorgarh'),
(427, 29, 'Dausa'),
(428, 29, 'Dholpur'),
(429, 29, 'Dungapur'),
(430, 29, 'Ganganagar'),
(431, 29, 'Hanumangarh'),
(432, 29, 'Juhnjhunun'),
(433, 29, 'Jalore'),
(434, 29, 'Jodhpur'),
(435, 29, 'Jaipur'),
(436, 29, 'Jaisalmer'),
(437, 29, 'Jhalawar'),
(438, 29, 'Karauli'),
(439, 29, 'Kota'),
(440, 29, 'Nagaur'),
(441, 29, 'Pali'),
(442, 29, 'Pratapgarh'),
(443, 29, 'Rajsamand'),
(444, 29, 'Sikar'),
(445, 29, 'Sawai Madhopur'),
(446, 29, 'Sirohi'),
(447, 29, 'Tonk'),
(448, 29, 'Udaipur'),
(449, 30, 'Sikkim'),
(450, 31, 'Ariyalur'),
(451, 31, 'Chennai'),
(452, 31, 'Coimbatore'),
(453, 31, 'Cuddalore'),
(454, 31, 'Dharmapuri'),
(455, 31, 'Dindigul'),
(456, 31, 'Erode'),
(457, 31, 'Kanchipuram'),
(458, 31, 'Kanyakumari'),
(459, 31, 'Karur'),
(460, 31, 'Madurai'),
(461, 31, 'Nagapattinam'),
(462, 31, 'The Nilgiris'),
(463, 31, 'Namakkal'),
(464, 31, 'Perambalur'),
(465, 31, 'Pudukkottai'),
(466, 31, 'Ramanathapuram'),
(467, 31, 'Salem'),
(468, 31, 'Sivagangai'),
(469, 31, 'Tiruppur'),
(470, 31, 'Tiruchirappalli'),
(471, 31, 'Theni'),
(472, 31, 'Tirunelveli'),
(473, 31, 'Thanjavur'),
(474, 31, 'Thoothukudi'),
(475, 31, 'Thiruvallur'),
(476, 31, 'Thiruvarur'),
(477, 31, 'Tiruvannamalai'),
(478, 31, 'Vellore'),
(479, 31, 'Villupuram'),
(480, 34, 'Achhnera\r'),
(481, 34, 'Achhnera\r'),
(482, 34, 'Amit\r'),
(483, 34, 'Fatehpur Sikri\r'),
(484, 34, 'Kalpi\r'),
(485, 34, 'Kumarganj Town\r'),
(486, 34, 'Laharpur\r'),
(487, 34, 'Lal Gopalganj Nindaura\r'),
(488, 34, 'Lalganj\r'),
(489, 34, 'Lar\r'),
(490, 34, 'Nagina\r'),
(491, 34, 'Najibabad\r'),
(492, 34, 'Nakur\r'),
(493, 34, 'Nanpara\r'),
(494, 34, 'Naraura\r'),
(495, 34, 'Naugawan Sadat\r'),
(496, 34, 'Nautanwa\r'),
(497, 34, 'Nawabganj\r'),
(498, 34, 'Nehtaur\r'),
(499, 34, 'Niwai\r'),
(500, 34, 'Noorpur\r'),
(501, 34, 'Obra\r'),
(502, 34, 'Padrauna\r'),
(503, 34, 'Palia Kalan\r'),
(504, 34, 'Parasi\r'),
(505, 34, 'Phulpur\r'),
(506, 34, 'Pihani\r'),
(507, 34, 'Pilkhuwa\r'),
(508, 34, 'Powayan\r'),
(509, 34, 'Pukhrayan\r'),
(510, 34, 'Puranpur\r'),
(511, 34, 'Purquazi\r'),
(512, 34, 'Purwa\r'),
(513, 34, 'Rajesultanpur\r'),
(514, 34, 'Rampur Maniharan\r'),
(515, 34, 'Rasra\r'),
(516, 34, 'Rath\r'),
(517, 34, 'Renukoot\r'),
(518, 34, 'Reoti\r'),
(519, 34, 'Robertsganj\r'),
(520, 34, 'Rudauli\r'),
(521, 34, 'Rudrapur\r'),
(522, 34, 'Sadabad\r'),
(523, 34, 'Safipur\r'),
(524, 34, 'Sahaspur\r'),
(525, 34, 'Sahaswan\r'),
(526, 34, 'Sahawar\r'),
(527, 34, 'Sahjanwa\r'),
(528, 34, 'Saidpur\r'),
(529, 34, 'Samdhan\r'),
(530, 34, 'Samthar\r'),
(531, 34, 'Sandi\r'),
(532, 34, 'Sandila\r'),
(533, 34, 'Sardhana\r'),
(534, 34, 'Seohara\r'),
(535, 34, 'Shahabad, Hardoi\r'),
(536, 34, 'Shahabad, Rampur\r'),
(537, 34, 'Shahganj\r'),
(538, 34, 'Shamli\r'),
(539, 34, 'Shamsabad, Agra\r'),
(540, 34, 'Shamsabad, Farrukhabad\r'),
(541, 34, 'Sherkot\r'),
(542, 34, 'Shikarpur, Bulandshahr\r'),
(543, 34, 'Shikohabad\r'),
(544, 34, 'Shishgarh\r'),
(545, 34, 'Siana\r'),
(546, 34, 'Sikanderpur\r'),
(547, 34, 'Sikandra Rao\r'),
(548, 34, 'Sikandrabad\r'),
(549, 34, 'Sirsaganj\r'),
(550, 34, 'Sirsi\r'),
(551, 34, 'Soron\r'),
(552, 34, 'Suar\r'),
(553, 34, 'Sumerpur\r'),
(554, 34, 'Tanda\r'),
(555, 34, 'Thakurdwara\r'),
(556, 34, 'Thana Bhawan\r'),
(557, 34, 'Tilhar\r'),
(558, 34, 'Tirwaganj\r'),
(559, 34, 'Tulsipur\r'),
(560, 34, 'Tundla\r'),
(561, 34, 'Ujhani\r'),
(562, 34, 'Utraula\r'),
(563, 34, 'Vrindavan\r'),
(564, 34, 'Warhapur\r'),
(565, 34, 'Zaidpur\r'),
(566, 34, 'Zamania\r'),
(567, 1, 'Port Blair\r'),
(568, 2, 'Amalapuram\r'),
(569, 2, 'Amaravathi\r'),
(570, 2, 'Anakapalle\r'),
(571, 2, 'Bapatla\r'),
(572, 2, 'Bheemunipatnam\r'),
(573, 2, 'Bobbili\r'),
(574, 2, 'Chirala\r'),
(575, 2, 'Gavaravaram\r'),
(576, 2, 'Gooty\r'),
(577, 2, 'Jaggaiahpet\r'),
(578, 2, 'Jammalamadugu\r'),
(579, 2, 'Kadiri\r'),
(580, 2, 'Kandukur\r'),
(581, 2, 'Kanigiri\r'),
(582, 2, 'Kavali\r'),
(583, 2, 'Kovvur\r'),
(584, 2, 'Macherla\r'),
(585, 2, 'Mandapeta\r'),
(586, 2, 'Markapur\r'),
(587, 2, 'Nagari\r'),
(588, 2, 'Naidupet\r'),
(589, 2, 'Narasapuram\r'),
(590, 2, 'Narsipatnam\r'),
(591, 2, 'Nidadavole\r'),
(592, 2, 'Nuzvid\r'),
(593, 2, 'Palacole\r'),
(594, 2, 'Palasa Kasibugga\r'),
(595, 2, 'Parvathipuram\r'),
(596, 2, 'Pedana\r'),
(597, 2, 'Peddapuram\r'),
(598, 2, 'Pithapuram\r'),
(599, 2, 'Ponnur\r'),
(600, 2, 'Punganur\r'),
(601, 2, 'Puttur\r'),
(602, 2, 'Rajam\r'),
(603, 2, 'Ramachandrapuram\r'),
(604, 2, 'Rayachoti\r'),
(605, 2, 'Rayadurg\r'),
(606, 2, 'Renigunta\r'),
(607, 2, 'Repalle\r'),
(608, 2, 'Salur\r'),
(609, 2, 'Samalkot\r'),
(610, 2, 'Sanivarapupeta\r'),
(611, 2, 'Satrampadu\r'),
(612, 2, 'Sattenapalle\r'),
(613, 2, 'Srikalahasti\r'),
(614, 2, 'Srisailam (RFC) Township\r'),
(615, 2, 'Sullurpeta\r'),
(616, 2, 'Tanuku\r'),
(617, 2, 'Tiruvuru\r'),
(618, 2, 'Tuni\r'),
(619, 2, 'Uravakonda\r'),
(620, 2, 'Venkatagiri\r'),
(621, 2, 'Vinukonda\r'),
(622, 2, 'Yemmiganur\r'),
(623, 2, 'Yerraguntla\r'),
(624, 2, 'Naharlagun\r'),
(625, 2, 'Pasighat\r'),
(626, 4, 'Barpeta\r'),
(627, 4, 'Bongaigaon?City\r'),
(628, 4, 'Dhubri\r'),
(629, 4, 'Diphu\r'),
(630, 4, 'Goalpara\r'),
(631, 4, 'Jorhat\r'),
(632, 4, 'Karimganj\r'),
(633, 4, 'Lanka\r'),
(634, 4, 'Lumding\r'),
(635, 4, 'Mangaldoi\r'),
(636, 4, 'Mankachar\r'),
(637, 4, 'Margherita\r'),
(638, 4, 'Mariani\r'),
(639, 4, 'Marigaon\r'),
(640, 4, 'Nalbari\r'),
(641, 4, 'North Lakhimpur\r'),
(642, 4, 'Rangia\r'),
(643, 4, 'Sibsagar\r'),
(644, 4, 'Silapathar\r'),
(645, 4, 'Tezpur\r'),
(646, 4, 'Tinsukia\r'),
(647, 5, 'Araria\r'),
(648, 5, 'Arwal\r'),
(649, 5, 'Asarganj\r'),
(650, 5, 'Bagha Kusmar\r'),
(651, 5, 'Barh\r'),
(652, 5, 'Bhabua\r'),
(653, 5, 'Dumraon\r'),
(654, 5, 'Forbesganj\r'),
(655, 5, 'Gopalganj\r'),
(656, 5, 'Jamui\r'),
(657, 5, 'Lakhisarai\r'),
(658, 5, 'Lalganj\r'),
(659, 5, 'Madhepura\r'),
(660, 5, 'Madhubani\r'),
(661, 5, 'Maharajganj\r'),
(662, 5, 'Mahnar Bazar\r'),
(663, 5, 'Makhdumpur\r'),
(664, 5, 'Maner\r'),
(665, 5, 'Manihari\r'),
(666, 5, 'Marhaura\r'),
(667, 5, 'Masaurhi\r'),
(668, 5, 'Mirganj\r'),
(669, 5, 'Mokameh\r'),
(670, 5, 'Motipur\r'),
(671, 5, 'Murliganj\r'),
(672, 5, 'Narkatiaganj\r'),
(673, 5, 'Naugachhia\r'),
(674, 5, 'Nawada\r'),
(675, 5, 'Nokha\r'),
(676, 5, 'Piro\r'),
(677, 5, 'Rafiganj\r'),
(678, 5, 'Rajgir\r'),
(679, 5, 'Ramnagar\r'),
(680, 5, 'Raxaul Bazar\r'),
(681, 5, 'Revelganj\r'),
(682, 5, 'Rosera\r'),
(683, 5, 'Samastipur\r'),
(684, 5, 'Sheikhpura\r'),
(685, 5, 'Sheohar\r'),
(686, 5, 'Sherghati\r'),
(687, 5, 'Silao\r'),
(688, 5, 'Sitamarhi\r'),
(689, 5, 'Sonepur\r'),
(690, 5, 'Sugauli\r'),
(691, 5, 'Sultanganj\r'),
(692, 5, 'Supaul\r'),
(693, 5, 'Warisaliganj\r'),
(694, 6, 'Bhatapara\r'),
(695, 6, 'Chirmiri\r'),
(696, 6, 'Dalli-Rajhara\r'),
(697, 6, 'Dhamtari\r'),
(698, 6, 'Mahasamund\r'),
(699, 6, 'Manendragarh\r'),
(700, 6, 'Mungeli\r'),
(701, 6, 'Naila Janjgir\r'),
(702, 6, 'Sakti\r'),
(703, 6, 'Tilda Newra\r'),
(704, 8, 'Silvassa\r'),
(705, 11, 'Mapusa\r'),
(706, 11, 'Margao\r'),
(707, 11, 'Panaji\r'),
(708, 12, 'Adalaj\r'),
(709, 12, 'Anjar\r'),
(710, 12, 'Ankleshwar\r'),
(711, 12, 'Chhapra\r'),
(712, 12, 'Dhoraji\r'),
(713, 12, 'Jamnagar\r'),
(714, 12, 'Kadi\r'),
(715, 12, 'Kapadvanj\r'),
(716, 12, 'Keshod\r'),
(717, 12, 'Khambhat\r'),
(718, 12, 'Lathi\r'),
(719, 12, 'Limbdi\r'),
(720, 12, 'Lunawada\r'),
(721, 12, 'Mahemdabad\r'),
(722, 12, 'Manavadar\r'),
(723, 12, 'Mandvi\r'),
(724, 12, 'Mangrol\r'),
(725, 12, 'Mansa\r'),
(726, 12, 'Modasa\r'),
(727, 12, 'Padra\r'),
(728, 12, 'Palitana\r'),
(729, 12, 'Pardi\r'),
(730, 12, 'Petlad\r'),
(731, 12, 'Radhanpur\r'),
(732, 12, 'Rajpipla\r'),
(733, 12, 'Rajula\r'),
(734, 12, 'Ranavav\r'),
(735, 12, 'Rapar\r'),
(736, 12, 'Salaya\r'),
(737, 12, 'Sanand\r'),
(738, 12, 'Savarkundla\r'),
(739, 12, 'Sidhpur\r'),
(740, 12, 'Sihor\r'),
(741, 12, 'Songadh\r'),
(742, 12, 'Talaja\r'),
(743, 12, 'Thangadh\r'),
(744, 12, 'Tharad\r'),
(745, 12, 'Umbergaon\r'),
(746, 12, 'Umreth\r'),
(747, 12, 'Una\r'),
(748, 12, 'Unjha\r'),
(749, 12, 'Upleta\r'),
(750, 12, 'Vadnagar\r'),
(751, 12, 'Vapi\r'),
(752, 12, 'Vijapur\r'),
(753, 12, 'Viramgam\r'),
(754, 12, 'Visnagar\r'),
(755, 12, 'Vyara\r'),
(756, 12, 'Wadhwan\r'),
(757, 12, 'Wankaner\r'),
(758, 13, 'Charkhi Dadri\r'),
(759, 13, 'Ellenabad\r'),
(760, 13, 'Fatehabad\r'),
(761, 13, 'Gohana\r'),
(762, 13, 'Hansi\r'),
(763, 13, 'Ladwa\r'),
(764, 13, 'Mahendragarh\r'),
(765, 13, 'Mandi Dabwali\r'),
(766, 13, 'Narnaul\r'),
(767, 13, 'Narwana\r'),
(768, 13, 'Pehowa\r'),
(769, 13, 'Rania\r'),
(770, 13, 'Ratia\r'),
(771, 13, 'Safidon\r'),
(772, 13, 'Samalkha\r'),
(773, 13, 'Sarsod\r'),
(774, 13, 'Shahbad\r'),
(775, 13, 'Sohna\r'),
(776, 13, 'Taraori\r'),
(777, 13, 'Tohana\r'),
(778, 14, 'Nahan\r'),
(779, 14, 'Palampur\r'),
(780, 14, 'Solan\r'),
(781, 14, 'Sundarnagar\r'),
(782, 15, 'Kathua\r'),
(783, 15, 'Punch\r'),
(784, 15, 'Rajauri\r'),
(785, 15, 'Sopore\r'),
(786, 15, 'Udhampur\r'),
(787, 16, 'Chaibasa\r'),
(788, 16, 'Chatra\r'),
(789, 16, 'Chirkunda\r'),
(790, 16, 'Dumka\r'),
(791, 16, 'Gumia\r'),
(792, 16, 'Jhumri Tilaiya\r'),
(793, 16, 'Lohardaga\r'),
(794, 16, 'Madhupur\r'),
(795, 16, 'Medininagar (Daltonganj)\r'),
(796, 16, 'Mihijam\r'),
(797, 16, 'Musabani\r'),
(798, 16, 'Pakaur\r'),
(799, 16, 'Patratu\r'),
(800, 16, 'Sahibganj\r'),
(801, 16, 'Saunda\r'),
(802, 16, 'Simdega\r'),
(803, 16, 'Tenu dam-cum-Kathhara\r'),
(804, 17, 'Adyar\r'),
(805, 17, 'Afzalpur\r'),
(806, 17, 'Arsikere\r'),
(807, 17, 'Athni\r'),
(808, 17, 'Gokak\r'),
(809, 17, 'Lakshmeshwar\r'),
(810, 17, 'Lingsugur\r'),
(811, 17, 'Maddur\r'),
(812, 17, 'Madhugiri\r'),
(813, 17, 'Madikeri\r'),
(814, 17, 'Magadi\r'),
(815, 17, 'Mahalingapura\r'),
(816, 17, 'Malavalli\r'),
(817, 17, 'Malur\r'),
(818, 17, 'Manvi\r'),
(819, 17, 'Mudabidri\r'),
(820, 17, 'Mudalagi\r'),
(821, 17, 'Muddebihal\r'),
(822, 17, 'Mudhol\r'),
(823, 17, 'Mulbagal\r'),
(824, 17, 'Mundargi\r'),
(825, 17, 'Nanjangud\r'),
(826, 17, 'Nargund\r'),
(827, 17, 'Navalgund\r'),
(828, 17, 'Nelamangala\r'),
(829, 17, 'Pavagada\r'),
(830, 17, 'Piriyapatna\r'),
(831, 17, 'Puttur\r'),
(832, 17, 'Rabkavi Banhatti\r'),
(833, 17, 'Ramanagaram\r'),
(834, 17, 'Ramdurg\r'),
(835, 17, 'Ranibennur\r'),
(836, 17, 'Ron\r'),
(837, 17, 'Sagara\r'),
(838, 17, 'Sakaleshapura\r'),
(839, 17, 'Sanduru\r'),
(840, 17, 'Sankeshwara\r'),
(841, 17, 'Saundatti-Yellamma\r'),
(842, 17, 'Savanur\r'),
(843, 17, 'Sedam\r'),
(844, 17, 'Shahabad\r'),
(845, 17, 'Shahpur\r'),
(846, 17, 'Shiggaon\r'),
(847, 17, 'Shikaripur\r'),
(848, 17, 'Shrirangapattana\r'),
(849, 17, 'Sidlaghatta\r'),
(850, 17, 'Sindagi\r'),
(851, 17, 'Sindhagi\r'),
(852, 17, 'Sindhnur\r'),
(853, 17, 'Sira\r'),
(854, 17, 'Sirsi\r'),
(855, 17, 'Siruguppa\r'),
(856, 17, 'Srinivaspur\r'),
(857, 17, 'Surapura\r'),
(858, 17, 'Talikota\r'),
(859, 17, 'Tarikere\r'),
(860, 17, 'Tekkalakote\r'),
(861, 17, 'Terdal\r'),
(862, 17, 'Tiptur\r'),
(863, 17, 'Vijayapura\r'),
(864, 17, 'Wadi\r'),
(865, 17, 'Yadgir\r'),
(866, 18, 'Adoor\r'),
(867, 18, 'Aluva\r'),
(868, 18, 'Attingal\r'),
(869, 18, 'Chalakudy\r'),
(870, 18, 'Changanassery\r'),
(871, 18, 'Chengannur\r'),
(872, 18, 'Cherthala\r'),
(873, 18, 'Chittur-Thathamangalam\r'),
(874, 18, 'Guruvayoor\r'),
(875, 18, 'Kanhangad\r'),
(876, 18, 'Kannur\r'),
(877, 18, 'Karipur\r'),
(878, 18, 'Kasaragod\r'),
(879, 18, 'Kayamkulam\r'),
(880, 18, 'Kodungallur\r'),
(881, 18, 'Kottayam\r'),
(882, 18, 'Koyilandy\r'),
(883, 18, 'Kunnamkulam\r'),
(884, 18, 'Mattannur\r'),
(885, 18, 'Mavelikkara\r'),
(886, 18, 'Mavoor\r'),
(887, 18, 'Muvattupuzha\r'),
(888, 18, 'Nedumangad\r'),
(889, 18, 'Nedumbassery\r'),
(890, 18, 'Neyyattinkara\r'),
(891, 18, 'Nilambur\r'),
(892, 18, 'Ottappalam\r'),
(893, 18, 'Palai\r'),
(894, 18, 'Panamattom\r'),
(895, 18, 'Panniyannur\r'),
(896, 18, 'Pappinisseri\r'),
(897, 18, 'Paravoor\r'),
(898, 18, 'Pathanamthitta\r'),
(899, 18, 'Peringathur\r'),
(900, 18, 'Perinthalmanna\r'),
(901, 18, 'Perumbavoor\r'),
(902, 18, 'Ponnani\r'),
(903, 18, 'Punalur\r'),
(904, 18, 'Puthuppally\r'),
(905, 18, 'Shoranur\r'),
(906, 18, 'Taliparamba\r'),
(907, 18, 'Thiruvalla\r'),
(908, 18, 'Thodupuzha\r'),
(909, 18, 'Thrippunithura\r'),
(910, 18, 'Thrissur\r'),
(911, 18, 'Tirur\r'),
(912, 18, 'Vaikom\r'),
(913, 18, 'Varandarappilly\r'),
(914, 18, 'Varkala\r'),
(915, 18, 'Vatakara\r'),
(916, 20, 'Alirajpur\r'),
(917, 20, 'Ashok Nagar\r'),
(918, 20, 'Balaghat\r'),
(919, 20, 'Itarsi\r'),
(920, 20, 'Lahar\r'),
(921, 20, 'Maharajpur\r'),
(922, 20, 'Maihar\r'),
(923, 20, 'Malaj Khand\r'),
(924, 20, 'Manasa\r'),
(925, 20, 'Manawar\r'),
(926, 20, 'Mandideep\r'),
(927, 20, 'Mandla\r'),
(928, 20, 'Mauganj\r'),
(929, 20, 'Mhow?Cantonment\r'),
(930, 20, 'Mhowgaon\r'),
(931, 20, 'Multai\r'),
(932, 20, 'Mundi\r'),
(933, 20, 'Nainpur\r'),
(934, 20, 'Narsinghgarh\r'),
(935, 20, 'Narsinghgarh\r'),
(936, 20, 'Nepanagar\r'),
(937, 20, 'Niwari\r'),
(938, 20, 'Nowgong\r'),
(939, 20, 'Nowrozabad?(Khodargama)\r'),
(940, 20, 'Pachore\r'),
(941, 20, 'Pali\r'),
(942, 20, 'Panagar\r'),
(943, 20, 'Pandhurna\r'),
(944, 20, 'Panna\r'),
(945, 20, 'Pasan\r'),
(946, 20, 'Pithampur\r'),
(947, 20, 'Porsa\r'),
(948, 20, 'Prithvipur\r'),
(949, 20, 'Raghogarh-Vijaypur\r'),
(950, 20, 'Rahatgarh\r'),
(951, 20, 'Raisen\r'),
(952, 20, 'Rajgarh\r'),
(953, 20, 'Rau\r'),
(954, 20, 'Rehli\r'),
(955, 20, 'Sabalgarh\r'),
(956, 20, 'Sanawad\r'),
(957, 20, 'Sarangpur\r'),
(958, 20, 'Sarni\r'),
(959, 20, 'Sausar\r'),
(960, 20, 'Sehore\r'),
(961, 20, 'Sendhwa\r'),
(962, 20, 'Seoni\r'),
(963, 20, 'Seoni-Malwa\r'),
(964, 20, 'Shahdol\r'),
(965, 20, 'Shajapur\r'),
(966, 20, 'Shamgarh\r'),
(967, 20, 'Sheopur\r'),
(968, 20, 'Shujalpur\r'),
(969, 20, 'Sidhi\r'),
(970, 20, 'Sihora\r'),
(971, 20, 'Sironj\r'),
(972, 20, 'Sohagpur\r'),
(973, 20, 'Tarana\r'),
(974, 20, 'Tikamgarh\r'),
(975, 20, 'Umaria\r'),
(976, 20, 'Vijaypur\r'),
(977, 20, 'Wara Seoni\r'),
(978, 21, 'Akot\r'),
(979, 21, 'Amalner\r'),
(980, 21, 'Ambejogai\r'),
(981, 21, 'Anjangaon\r'),
(982, 21, 'Arvi\r'),
(983, 21, 'Karjat\r'),
(984, 21, 'Loha\r'),
(985, 21, 'Lonar\r'),
(986, 21, 'Lonavla\r'),
(987, 21, 'Mahad\r'),
(988, 21, 'Malkapur\r'),
(989, 21, 'Mangalvedhe\r'),
(990, 21, 'Mangrulpir\r'),
(991, 21, 'Manjlegaon\r'),
(992, 21, 'Manmad\r'),
(993, 21, 'Manwath\r'),
(994, 21, 'Mehkar\r'),
(995, 21, 'Mhaswad\r'),
(996, 21, 'Morshi\r'),
(997, 21, 'Mukhed\r'),
(998, 21, 'Mul\r'),
(999, 21, 'Murtijapur\r'),
(1000, 21, 'Nandgaon\r'),
(1001, 21, 'Nandura\r'),
(1002, 21, 'Narkhed\r'),
(1003, 21, 'Nawapur\r'),
(1004, 21, 'Nilanga\r'),
(1005, 21, 'Ozar\r'),
(1006, 21, 'Pachora\r'),
(1007, 21, 'Paithan\r'),
(1008, 21, 'Palghar\r'),
(1009, 21, 'Pandharkaoda\r'),
(1010, 21, 'Pandharpur\r'),
(1011, 21, 'Parli\r'),
(1012, 21, 'Partur\r'),
(1013, 21, 'Pathardi\r'),
(1014, 21, 'Pathri\r'),
(1015, 21, 'Patur\r'),
(1016, 21, 'Pauni\r'),
(1017, 21, 'Pen\r'),
(1018, 21, 'Phaltan\r'),
(1019, 21, 'Pulgaon\r'),
(1020, 21, 'Purna\r'),
(1021, 21, 'Pusad\r'),
(1022, 21, 'Rahuri\r'),
(1023, 21, 'Rajura\r'),
(1024, 21, 'Ramtek\r'),
(1025, 21, 'Ratnagiri\r'),
(1026, 21, 'Raver\r'),
(1027, 21, 'Risod\r'),
(1028, 21, 'Sailu\r'),
(1029, 21, 'Sangamner\r'),
(1030, 21, 'Sangole\r'),
(1031, 21, 'Sasvad\r'),
(1032, 21, 'Satana\r'),
(1033, 21, 'Savner\r'),
(1034, 21, 'Sawantwadi\r'),
(1035, 21, 'Shahade\r'),
(1036, 21, 'Shegaon\r'),
(1037, 21, 'Shendurjana\r'),
(1038, 21, 'Shirdi\r'),
(1039, 21, 'Shirpur-Warwade\r'),
(1040, 21, 'Shirur\r'),
(1041, 21, 'Shrigonda\r'),
(1042, 21, 'Shrirampur\r'),
(1043, 21, 'Sillod\r'),
(1044, 21, 'Sinnar\r'),
(1045, 21, 'Soyagaon\r'),
(1046, 21, 'Talegaon Dabhade\r'),
(1047, 21, 'Talode\r'),
(1048, 21, 'Tasgaon\r'),
(1049, 21, 'Tirora\r'),
(1050, 21, 'Tuljapur\r'),
(1051, 21, 'Tumsar\r'),
(1052, 21, 'Uchgaon\r'),
(1053, 21, 'Umarga\r'),
(1054, 21, 'Umarkhed\r'),
(1055, 21, 'Umred\r'),
(1056, 21, 'Uran\r'),
(1057, 21, 'Uran Islampur\r'),
(1058, 21, 'Vadgaon Kasba\r'),
(1059, 21, 'Vaijapur\r'),
(1060, 21, 'Vita\r'),
(1061, 21, 'Wadgaon Road\r'),
(1062, 21, 'Wai\r'),
(1063, 21, 'Wani\r'),
(1064, 21, 'Warora\r'),
(1065, 21, 'Warud\r'),
(1066, 21, 'Washim\r'),
(1067, 21, 'Yawal\r'),
(1068, 21, 'Yevla\r'),
(1069, 22, 'Lilong\r'),
(1070, 22, 'Mayang Imphal\r'),
(1071, 22, 'Thoubal\r'),
(1072, 23, 'Nongstoin\r'),
(1073, 23, 'Tura\r'),
(1074, 24, 'Lunglei\r'),
(1075, 24, 'Saiha\r'),
(1076, 25, 'Kohima*\r'),
(1077, 25, 'Mokokchung\r'),
(1078, 25, 'Tuensang\r'),
(1079, 25, 'Wokha\r'),
(1080, 25, 'Zunheboto\r'),
(1081, 26, 'Balangir\r'),
(1082, 26, 'Barbil\r'),
(1083, 26, 'Bargarh\r'),
(1084, 26, 'Bhawanipatna\r'),
(1085, 26, 'Byasanagar\r'),
(1086, 26, 'Dhenkanal\r'),
(1087, 26, 'Jatani\r'),
(1088, 26, 'Jharsuguda\r'),
(1089, 26, 'Kendrapara\r'),
(1090, 26, 'Kendujhar\r'),
(1091, 26, 'Malkangiri\r'),
(1092, 26, 'Nabarangapur\r'),
(1093, 26, 'Paradip\r'),
(1094, 26, 'Parlakhemundi\r'),
(1095, 26, 'Pattamundai\r'),
(1096, 26, 'Phulabani\r'),
(1097, 26, 'Rairangpur\r'),
(1098, 26, 'Rajagangapur\r'),
(1099, 26, 'Rayagada\r'),
(1100, 26, 'Soro\r'),
(1101, 26, 'Sunabeda\r'),
(1102, 26, 'Sundargarh\r'),
(1103, 26, 'Talcher\r'),
(1104, 26, 'Tarbha\r'),
(1105, 26, 'Titlagarh\r'),
(1106, 27, 'Karaikal\r'),
(1107, 27, 'Mahe\r'),
(1108, 27, 'Yanam\r'),
(1109, 28, 'Dhuri\r'),
(1110, 28, 'Faridkot\r'),
(1111, 28, 'Fazilka\r'),
(1112, 28, 'Firozpur Cantt.\r'),
(1113, 28, 'Gobindgarh\r'),
(1114, 28, 'Gurdaspur\r'),
(1115, 28, 'Jagraon\r'),
(1116, 28, 'Jalandhar Cantt.\r'),
(1117, 28, 'Kharar\r'),
(1118, 28, 'Kot Kapura\r'),
(1119, 28, 'Longowal\r'),
(1120, 28, 'Malout\r'),
(1121, 28, 'Mansa\r'),
(1122, 28, 'Morinda, India\r'),
(1123, 28, 'Mukerian\r'),
(1124, 28, 'Muktsar\r'),
(1125, 28, 'Nabha\r'),
(1126, 28, 'Nakodar\r'),
(1127, 28, 'Nangal\r'),
(1128, 28, 'Nawanshahr\r'),
(1129, 28, 'Patti\r'),
(1130, 28, 'Pattran\r'),
(1131, 28, 'Phillaur\r'),
(1132, 28, 'Qadian\r'),
(1133, 28, 'Raikot\r'),
(1134, 28, 'Rajpura\r'),
(1135, 28, 'Rampura Phul\r'),
(1136, 28, 'Rupnagar\r'),
(1137, 28, 'Samana\r'),
(1138, 28, 'Sangrur\r'),
(1139, 28, 'Sirhind Fatehgarh Sahib\r'),
(1140, 28, 'Sujanpur\r'),
(1141, 28, 'Sunam\r'),
(1142, 28, 'Talwara\r'),
(1143, 28, 'Tarn Taran\r'),
(1144, 28, 'Urmar Tanda\r'),
(1145, 28, 'Zira\r'),
(1146, 28, 'Zirakpur\r'),
(1147, 29, 'Degana\r'),
(1148, 29, 'Lachhmangarh\r'),
(1149, 29, 'Ladnu\r'),
(1150, 29, 'Lakheri\r'),
(1151, 29, 'Lalsot\r'),
(1152, 29, 'Losal\r'),
(1153, 29, 'Makrana\r'),
(1154, 29, 'Malpura\r'),
(1155, 29, 'Mandalgarh\r'),
(1156, 29, 'Mandawa\r'),
(1157, 29, 'Mangrol\r'),
(1158, 29, 'Merta City\r'),
(1159, 29, 'Mount Abu\r'),
(1160, 29, 'Nadbai\r'),
(1161, 29, 'Nagar\r'),
(1162, 29, 'Nasirabad\r'),
(1163, 29, 'Nathdwara\r'),
(1164, 29, 'Neem-Ka-Thana\r'),
(1165, 29, 'Nimbahera\r'),
(1166, 29, 'Nohar\r'),
(1167, 29, 'Nokha\r'),
(1168, 29, 'Phalodi\r'),
(1169, 29, 'Phulera\r'),
(1170, 29, 'Pilani\r'),
(1171, 29, 'Pilibanga\r'),
(1172, 29, 'Pindwara\r'),
(1173, 29, 'Pipar City\r'),
(1174, 29, 'Prantij\r'),
(1175, 29, 'Pratapgarh\r'),
(1176, 29, 'Raisinghnagar\r'),
(1177, 29, 'Rajakhera\r'),
(1178, 29, 'Rajaldesar\r'),
(1179, 29, 'Rajgarh (Alwar)\r'),
(1180, 29, 'Rajgarh (Churu)\r'),
(1181, 29, 'Rajsamand\r'),
(1182, 29, 'Ramganj Mandi\r'),
(1183, 29, 'Ramngarh\r'),
(1184, 29, 'Ratangarh\r'),
(1185, 29, 'Rawatbhata\r'),
(1186, 29, 'Rawatsar\r'),
(1187, 29, 'Reengus\r'),
(1188, 29, 'Sadri\r'),
(1189, 29, 'Sadulshahar\r'),
(1190, 29, 'Sagwara\r'),
(1191, 29, 'Sambhar\r'),
(1192, 29, 'Sanchore\r'),
(1193, 29, 'Sangaria\r'),
(1194, 29, 'Sardarshahar\r'),
(1195, 29, 'Shahpura\r'),
(1196, 29, 'Shahpura\r'),
(1197, 29, 'Sheoganj\r'),
(1198, 29, 'Sirohi\r'),
(1199, 29, 'Sojat\r'),
(1200, 29, 'Sri Madhopur\r'),
(1201, 29, 'Sujangarh\r'),
(1202, 29, 'Sumerpur\r'),
(1203, 29, 'Suratgarh\r'),
(1204, 29, 'Takhatgarh\r'),
(1205, 29, 'Taranagar\r'),
(1206, 29, 'Todabhim\r'),
(1207, 29, 'Todaraisingh\r'),
(1208, 29, 'Udaipurwati\r'),
(1209, 29, 'Vijainagar, Ajmer\r'),
(1210, 31, 'Arakkonam\r'),
(1211, 31, 'Aruppukkottai\r'),
(1212, 31, 'Chidambaram\r'),
(1213, 31, 'Gobichettipalayam\r'),
(1214, 31, 'Karur\r'),
(1215, 31, 'Lalgudi\r'),
(1216, 31, 'Manachanallur\r'),
(1217, 31, 'Namagiripettai\r'),
(1218, 31, 'Namakkal\r'),
(1219, 31, 'Nandivaram-Guduvancheri\r'),
(1220, 31, 'Nanjikottai\r'),
(1221, 31, 'Natham\r'),
(1222, 31, 'Nellikuppam\r'),
(1223, 31, 'O\' Valley\r'),
(1224, 31, 'Oddanchatram\r'),
(1225, 31, 'P.N.Patti\r'),
(1226, 31, 'Pacode\r'),
(1227, 31, 'Padmanabhapuram\r'),
(1228, 31, 'Palani\r'),
(1229, 31, 'Palladam\r'),
(1230, 31, 'Pallapatti\r'),
(1231, 31, 'Pallikonda\r'),
(1232, 31, 'Panagudi\r'),
(1233, 31, 'Panruti\r'),
(1234, 31, 'Paramakudi\r'),
(1235, 31, 'Parangipettai\r'),
(1236, 31, 'Pattukkottai\r'),
(1237, 31, 'Perambalur\r'),
(1238, 31, 'Peravurani\r'),
(1239, 31, 'Periyakulam\r'),
(1240, 31, 'Periyasemur\r'),
(1241, 31, 'Pernampattu\r'),
(1242, 31, 'Polur\r'),
(1243, 31, 'Ponneri\r'),
(1244, 31, 'Pudupattinam\r'),
(1245, 31, 'Puliyankudi\r'),
(1246, 31, 'Punjaipugalur\r'),
(1247, 31, 'Ramanathapuram\r'),
(1248, 31, 'Rameshwaram\r'),
(1249, 31, 'Rasipuram\r'),
(1250, 31, 'Sankarankovil\r'),
(1251, 31, 'Sankari\r'),
(1252, 31, 'Sathyamangalam\r'),
(1253, 31, 'Sattur\r'),
(1254, 31, 'Shenkottai\r'),
(1255, 31, 'Sholavandan\r'),
(1256, 31, 'Sholingur\r'),
(1257, 31, 'Sirkali\r'),
(1258, 31, 'Sivaganga\r'),
(1259, 31, 'Sivagiri\r'),
(1260, 31, 'Srivilliputhur\r'),
(1261, 31, 'Surandai\r'),
(1262, 31, 'Suriyampalayam\r'),
(1263, 31, 'Tenkasi\r'),
(1264, 31, 'Thammampatti\r'),
(1265, 31, 'Tharamangalam\r'),
(1266, 31, 'Tharangambadi\r'),
(1267, 31, 'Theni Allinagaram\r'),
(1268, 31, 'Thirumangalam\r'),
(1269, 31, 'Thirupuvanam\r'),
(1270, 31, 'Thiruthuraipoondi\r'),
(1271, 31, 'Thiruvallur\r'),
(1272, 31, 'Thiruvarur\r'),
(1273, 31, 'Thuraiyur\r'),
(1274, 31, 'Tindivanam\r'),
(1275, 31, 'Tiruchendur\r'),
(1276, 31, 'Tiruchengode\r'),
(1277, 31, 'Tirukalukundram\r'),
(1278, 31, 'Tirukkoyilur\r'),
(1279, 31, 'Tirupathur\r'),
(1280, 31, 'Tirupathur\r'),
(1281, 31, 'Tiruppur\r'),
(1282, 31, 'Tiruttani\r'),
(1283, 31, 'Tiruvethipuram\r'),
(1284, 31, 'Tittakudi\r'),
(1285, 31, 'Udhagamandalam\r'),
(1286, 31, 'Udumalaipettai\r'),
(1287, 31, 'Unnamalaikadai\r'),
(1288, 31, 'Usilampatti\r'),
(1289, 31, 'Uthamapalayam\r'),
(1290, 31, 'Uthiramerur\r'),
(1291, 31, 'Vadakkuvalliyur\r'),
(1292, 31, 'Vadalur\r'),
(1293, 31, 'Vadipatti\r'),
(1294, 31, 'Valparai\r'),
(1295, 31, 'Vandavasi\r'),
(1296, 31, 'Vaniyambadi\r'),
(1297, 31, 'Vedaranyam\r'),
(1298, 31, 'Vellakoil\r'),
(1299, 31, 'Vikramasingapuram\r'),
(1300, 31, 'Viluppuram\r'),
(1301, 31, 'Virudhachalam\r'),
(1302, 31, 'Virudhunagar\r'),
(1303, 31, 'Viswanatham\r'),
(1304, 36, 'Bellampalle\r'),
(1305, 36, 'Bhadrachalam\r'),
(1306, 36, 'Bhainsa\r'),
(1307, 36, 'Bhongir\r'),
(1308, 36, 'Bodhan\r'),
(1309, 36, 'Farooqnagar\r'),
(1310, 36, 'Gadwal\r'),
(1311, 36, 'Jagtial\r'),
(1312, 36, 'Jangaon\r'),
(1313, 36, 'Kagaznagar\r'),
(1314, 36, 'Kamareddy\r'),
(1315, 36, 'Koratla\r'),
(1316, 36, 'Kothagudem\r'),
(1317, 36, 'Kyathampalle\r'),
(1318, 36, 'Mandamarri\r'),
(1319, 36, 'Manuguru\r'),
(1320, 36, 'Medak\r'),
(1321, 36, 'Miryalaguda\r'),
(1322, 36, 'Nagarkurnool\r'),
(1323, 36, 'Narayanpet\r'),
(1324, 36, 'Nirmal\r'),
(1325, 36, 'Palwancha\r'),
(1326, 36, 'Sadasivpet\r'),
(1327, 36, 'Sangareddy\r'),
(1328, 36, 'Siddipet\r'),
(1329, 36, 'Sircilla\r'),
(1330, 36, 'Tandur\r'),
(1331, 36, 'Vikarabad\r'),
(1332, 36, 'Wanaparthy\r'),
(1333, 36, 'Yellandu\r'),
(1334, 32, 'Belonia\r'),
(1335, 32, 'Dharmanagar\r'),
(1336, 32, 'Kailasahar\r'),
(1337, 32, 'Khowai\r'),
(1338, 32, 'Pratapgarh\r'),
(1339, 32, 'Udaipur\r'),
(1340, 33, 'Bageshwar\r'),
(1341, 33, 'Manglaur\r'),
(1342, 33, 'Mussoorie\r'),
(1343, 33, 'Nagla\r'),
(1344, 33, 'Nainital\r'),
(1345, 33, 'Pauri\r'),
(1346, 33, 'Pithoragarh\r'),
(1347, 33, 'Ramnagar\r'),
(1348, 33, 'Rishikesh\r'),
(1349, 33, 'Rudrapur\r'),
(1350, 33, 'Sitarganj\r'),
(1351, 33, 'Tehri\r'),
(1352, 35, 'Adra\r'),
(1353, 35, 'Alipurduar\r'),
(1354, 35, 'Arambagh\r'),
(1355, 35, 'Chandpara\r'),
(1356, 35, 'Cooch Behar\r'),
(1357, 35, 'Gangarampur\r'),
(1358, 35, 'Jhargram\r'),
(1359, 35, 'Kalimpong\r'),
(1360, 35, 'Mainaguri\r'),
(1361, 35, 'Malda\r'),
(1362, 35, 'Mathabhanga\r'),
(1363, 35, 'Medinipur\r'),
(1364, 35, 'Memari\r'),
(1365, 35, 'Monoharpur\r'),
(1366, 35, 'Murshidabad\r'),
(1367, 35, 'Panchla\r'),
(1368, 35, 'Pandua\r'),
(1369, 35, 'Paschim Punropara\r'),
(1370, 35, 'Raghunathpur\r'),
(1371, 35, 'Rampurhat\r'),
(1372, 35, 'Sainthia\r'),
(1373, 35, 'Sonamukhi\r'),
(1374, 35, 'Srirampore\r'),
(1375, 35, 'Suri\r'),
(1376, 35, 'Taki\r'),
(1377, 35, 'Tamluk\r'),
(1378, 35, 'Tarakeswar\r'),
(1479, 21, 'Nasik'),
(1480, 39, 'City Name'),
(1481, 40, NULL),
(1482, 41, 'Kolkata'),
(1483, 41, 'baa');

-- --------------------------------------------------------

--
-- Table structure for table `hp_contact_us`
--

CREATE TABLE `hp_contact_us` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_corporate`
--

CREATE TABLE `hp_corporate` (
  `corporate_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `founder` varchar(55) DEFAULT NULL,
  `short_name` varchar(6) DEFAULT NULL,
  `description` longtext,
  `tag_line` varchar(80) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `area_landmark` varchar(255) DEFAULT NULL,
  `street_building` varchar(255) DEFAULT NULL,
  `headoffice` varchar(60) DEFAULT NULL,
  `pincode` varchar(8) DEFAULT NULL,
  `company_established` text,
  `num_of_em` varchar(50) DEFAULT NULL,
  `domain` text,
  `domain_prefix` varchar(50) DEFAULT NULL,
  `wallet_balance` decimal(14,2) DEFAULT '0.00',
  `pan_number` varchar(12) DEFAULT NULL,
  `certificate_of_incorporation` varchar(255) DEFAULT NULL,
  `memorandum_of_understanding` varchar(255) DEFAULT NULL,
  `memorandum_of_association` varchar(255) DEFAULT NULL,
  `nature_of_bussiness` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `turnover` text CHARACTER SET utf8mb4,
  `logo` blob,
  `status` enum('1','0') DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_corporate`
--

INSERT INTO `hp_corporate` (`corporate_id`, `company_name`, `founder`, `short_name`, `description`, `tag_line`, `address`, `area_landmark`, `street_building`, `headoffice`, `pincode`, `company_established`, `num_of_em`, `domain`, `domain_prefix`, `wallet_balance`, `pan_number`, `certificate_of_incorporation`, `memorandum_of_understanding`, `memorandum_of_association`, `nature_of_bussiness`, `category`, `country_id`, `state_id`, `city_id`, `turnover`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Happyperks', 'Atul Thakkar', 'hp', NULL, 'product based', 'Next to Printo,Canar', 'CanaraBank Road', NULL, 'Bangalore', '560095', '2018-02-01', NULL, 'www.happyperks.com', NULL, '0.00', '11', NULL, NULL, NULL, NULL, NULL, 1, 17, 215, '2', 0x636338613665316262343064396431316231343961616333626161623066653568617070797065726b732e706e67, '1', '2018-02-01 06:05:40', '2018-02-01 06:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `hp_corporate_bank_details`
--

CREATE TABLE `hp_corporate_bank_details` (
  `id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `account_number` varchar(24) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `bankcheck` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_corporate_cashback_rules`
--

CREATE TABLE `hp_corporate_cashback_rules` (
  `id` int(50) UNSIGNED NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `amount_above` decimal(10,2) DEFAULT NULL,
  `cashback_mode` tinyint(1) DEFAULT '0',
  `cashback_amount` decimal(10,2) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_corporate_designations_map`
--

CREATE TABLE `hp_corporate_designations_map` (
  `id` bigint(22) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_corporate_designations_map`
--

INSERT INTO `hp_corporate_designations_map` (`id`, `corporate_id`, `designation_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2018-02-01 07:31:47', '2018-02-01 07:31:47'),
(2, 2, 1, '2018-02-01 07:31:47', '2018-02-01 07:31:47'),
(3, 2, 4, '2018-02-01 07:31:47', '2018-02-01 07:31:47'),
(4, 2, 2, '2018-02-01 07:31:47', '2018-02-01 07:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `hp_corporate_locations`
--

CREATE TABLE `hp_corporate_locations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `corporate_id` int(11) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `address` text,
  `city` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `pincode` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `primary_contact` varchar(18) DEFAULT NULL,
  `alternate_contact` varchar(18) DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_corporate_locations`
--

INSERT INTO `hp_corporate_locations` (`id`, `user_id`, `corporate_id`, `location_name`, `address`, `city`, `state`, `pincode`, `email`, `primary_contact`, `alternate_contact`, `telephone`, `status`, `created_at`, `updated_at`) VALUES
(45, 967, 2, 'Bangalore', NULL, 215, 12, '560095', 'hr@happperks.com', '123465790', NULL, '12346', 'active', '2018-02-01 06:05:40', '2018-02-01 07:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `hp_corporate_transactions`
--

CREATE TABLE `hp_corporate_transactions` (
  `id` bigint(11) NOT NULL,
  `transaction_code` varchar(100) DEFAULT NULL,
  `escr_transactionid` varchar(255) DEFAULT NULL,
  `corporate_id` int(11) NOT NULL,
  `transaction_type` smallint(11) NOT NULL,
  `credit_amount` decimal(16,2) NOT NULL,
  `begin_balance` decimal(16,2) NOT NULL,
  `end_balance` decimal(16,2) NOT NULL,
  `description` text,
  `employee_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `spent_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `received_amount` decimal(16,2) NOT NULL DEFAULT '0.00',
  `status` enum('Pending','Processing','Completed','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_corp_escrow_account`
--

CREATE TABLE `hp_corp_escrow_account` (
  `id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `account_id` varchar(100) DEFAULT NULL,
  `ac_name` varchar(150) DEFAULT NULL,
  `ac_number` varchar(22) DEFAULT NULL,
  `ifscode` varchar(15) DEFAULT NULL,
  `ac_type` enum('1','2','3','4','5') DEFAULT NULL COMMENT '''1->Saving'',''2->Current'',''3->Certificate of Deposit'',''4->Money market account'',''5->Money market account''',
  `bank_address` varchar(255) DEFAULT NULL,
  `bank_name` varchar(150) DEFAULT NULL,
  `bank_branch` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `notification` text,
  `ac_status` enum('1','2','3','4') DEFAULT NULL COMMENT '''1->Approved'',''2->Pending'',''3'',''4''',
  `status` enum('1','2') DEFAULT NULL COMMENT '''1->active'',''2->deactive'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_corp_escrow_account`
--

INSERT INTO `hp_corp_escrow_account` (`id`, `corporate_id`, `account_id`, `ac_name`, `ac_number`, `ifscode`, `ac_type`, `bank_address`, `bank_name`, `bank_branch`, `created_at`, `updated_at`, `created_by`, `notification`, `ac_status`, `status`) VALUES
(1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-24 07:31:10', '2018-01-24 07:31:10', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hp_departments`
--

CREATE TABLE `hp_departments` (
  `id` int(11) NOT NULL,
  `corporate_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `parent_department` int(11) DEFAULT NULL,
  `function_head` varchar(255) DEFAULT NULL,
  `department_site` varchar(255) DEFAULT NULL,
  `department_description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_departments`
--

INSERT INTO `hp_departments` (`id`, `corporate_id`, `user_id`, `department_name`, `parent_department`, `function_head`, `department_site`, `department_description`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 967, 'Developer', NULL, NULL, NULL, 'sas', '2018-02-01 08:05:03', '2018-02-01 08:05:03', 'active'),
(2, 2, 967, 'PHP Developer', NULL, NULL, NULL, 'Php developer', '2018-02-01 08:05:09', '2018-02-01 08:05:09', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `hp_designations`
--

CREATE TABLE `hp_designations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_designations`
--

INSERT INTO `hp_designations` (`id`, `name`, `status`) VALUES
(1, 'Account Manager', 1),
(2, 'Finance Manager', 1),
(3, 'UI Developer', 1),
(4, 'Web Developer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hp_email_templates`
--

CREATE TABLE `hp_email_templates` (
  `id` int(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `body` text,
  `send_from` varchar(150) DEFAULT NULL,
  `sender_name` varchar(150) DEFAULT NULL,
  `bcc` text,
  `cc` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_email_templates`
--

INSERT INTO `hp_email_templates` (`id`, `name`, `title`, `subject`, `body`, `send_from`, `sender_name`, `bcc`, `cc`, `created_at`, `updated_at`) VALUES
(2, 'Employee Account activation', 'Verification Link', 'Please verify your email address and activate your HappyPerks account.', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Hi <strong>{$username}</strong></p>\r\n<p>Help us secure your {$sitename} account by verifying your email address {$to}.&nbsp;This lets you access all of {$site_name}\'s features.</p>\r\n<div><a href=\"{$activation_link}\" target=\"_blank\" rel=\"noopener\">Verify email address</a></div>\r\n<hr />\r\n<p><br /> <a href=\"{$activation_link}\" target=\"_blank\" rel=\"noopener\">{$activation_link}</a></p>\r\n<p>&nbsp;<span style=\"background-color: #ffffff; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px;\">Arpit Panchal,</span></p>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\">PHP Developer</div>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\">Mob:+919806623446</div>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\"><a style=\"color: #598fde; cursor: pointer; word-wrap: break-word; word-break: break-word;\" href=\"http://www.happyperks.com/\" target=\"_blank\" rel=\"noopener\">www.happyperks.com</a></div>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\"><video controls=\"controls\" width=\"300\" height=\"150\">\r\n<source src=\"http://www.happyperks.com/hp/assets/frontend/img/logo.png\" /></video></div>\r\n</body>\r\n</html>', 'arpit.p@happyperks.com', 'Arpit', NULL, NULL, '2017-11-27 10:53:29', '2017-11-27 10:53:29'),
(3, 'Forgot Password', 'Employee Forgot Password', 'Reset Your Password', '<html>\n<head>\n</head>\n\n<body style=\"font-family: Arial; font-size: 12px;\">\n<h5 id=\"mcetoc_1bvukrq8f0\">Hi <strong>{$username}</strong></h5>\n<div>\n<h5>You have requested a password reset, please follow the link below to reset your password.</h5>\n<h5>Please ignore this email if you did not request a password change.</h5>\n<h5><a href=\"{resetPasswordLink}\"> Follow this link to reset your password. </a></h5>\n</div>\n<p>&nbsp;<span style=\"background-color: #ffffff; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px;\">Arpit Panchal,</span></p>\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\">PHP Developer</div>\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\">Mob:+919806623446</div>\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\"><a style=\"color: #598fde; cursor: pointer; word-wrap: break-word; word-break: break-word;\" href=\"http://www.happyperks.com/\" target=\"_blank\" rel=\"noopener\">www.happyperks.com</a></div>\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\"><img src=\"http://www.happyperks.com/hp/assets/frontend/img/logo-footer.png\" width=\"132\" height=\"40\" /></div>\n</body>\n</html>', 'arpit.p@happyperks.com', 'Kaushik', NULL, NULL, '2017-11-27 11:48:31', '2017-11-27 11:48:31'),
(4, 'Create Account', 'Create Account of Employee', 'Create Your Account', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<h5 id=\"mcetoc_1bvukrq8f0\">Hi <strong>{$username}</strong></h5>\r\n<div>\r\n<h5>Your account has been created.</h5>\r\n<h5>You can generate your account password by passing the url below.</h5>\r\n<h5><a href=\"{generatePasswordLink}\"> Please click this link to generate your account password.</a></h5>\r\n</div>\r\n<p>&nbsp;<span style=\"background-color: #ffffff; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px;\">Arpit Panchal,</span></p>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\">PHP Developer</div>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\">Mob:+919806623446</div>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\"><a style=\"color: #598fde; cursor: pointer; word-wrap: break-word; word-break: break-word;\" href=\"http://www.happyperks.com/\" target=\"_blank\" rel=\"noopener\">www.happyperks.com</a></div>\r\n<div style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13.3333px; background-color: #ffffff;\"><img src=\"http://www.happyperks.com/hp/assets/frontend/img/logo-footer.png\" width=\"132\" height=\"40\" /></div>\r\n</body>\r\n</html>', 'arpit.p@happyperks.com', 'Arpit', NULL, NULL, '2017-11-29 10:27:28', '2017-11-29 10:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `hp_employee`
--

CREATE TABLE `hp_employee` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `emp_code` varchar(50) NOT NULL DEFAULT '',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` char(20) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `last_location` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `band` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `marriage_date` text,
  `joining_date` text,
  `wallet_balance` decimal(14,2) DEFAULT '0.00',
  `cashback_balance` decimal(14,2) DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= Active, 0= Inactive',
  `manager_id` int(11) DEFAULT NULL,
  `reporting_to` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dob` date DEFAULT NULL,
  `alternate_email` varchar(50) DEFAULT NULL,
  `alternate_phone` varchar(15) DEFAULT NULL,
  `aadhar_number` varchar(18) DEFAULT NULL,
  `pan_no` varchar(15) DEFAULT NULL,
  `marriage_anniversary` date DEFAULT NULL,
  `passport_no` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_employee`
--

INSERT INTO `hp_employee` (`employee_id`, `user_id`, `corporate_id`, `emp_code`, `first_name`, `last_name`, `gender`, `designation_id`, `location_id`, `last_location`, `department_id`, `band`, `user_image`, `address`, `marital_status`, `marriage_date`, `joining_date`, `wallet_balance`, `cashback_balance`, `status`, `manager_id`, `reporting_to`, `created_at`, `updated_at`, `dob`, `alternate_email`, `alternate_phone`, `aadhar_number`, `pan_no`, `marriage_anniversary`, `passport_no`) VALUES
(2, 967, 2, 'emp01', 'Atul', 'Thakkar', NULL, 3, 45, 4, 1, NULL, NULL, NULL, NULL, NULL, '02/01/2018', '15092.00', '0.00', 1, NULL, NULL, '2018-02-01 06:05:40', '2018-02-08 18:45:30', '2018-02-02', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 968, 2, '13', 'kalesha', 'shaik', NULL, 3, 45, NULL, 2, NULL, NULL, NULL, NULL, NULL, '12/13/2017', '300.00', '0.00', 1, NULL, NULL, '2018-02-01 08:08:08', '2018-02-01 09:31:22', '1996-07-17', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 969, 2, '016', 'roopa', 'reddy', NULL, 4, 45, NULL, 2, NULL, NULL, NULL, NULL, NULL, '01/15/2018', '0.00', '0.00', 1, NULL, NULL, '2018-02-01 08:09:25', '2018-02-01 08:09:25', '2018-01-30', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hp_employee_address`
--

CREATE TABLE `hp_employee_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(18) DEFAULT NULL,
  `address` text,
  `pincode` int(6) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_employee_cashbacks`
--

CREATE TABLE `hp_employee_cashbacks` (
  `id` bigint(11) NOT NULL,
  `description` text,
  `employee_id` int(11) DEFAULT NULL,
  `order_code` varchar(100) DEFAULT NULL,
  `transaction_code` varchar(100) DEFAULT NULL,
  `transaction_type` smallint(11) NOT NULL,
  `cashback_amount` decimal(16,2) NOT NULL,
  `before_cashback` decimal(16,2) NOT NULL,
  `after_cashback` decimal(16,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('Pending','Processing','Completed','Cancelled','Expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_employee_transactions`
--

CREATE TABLE `hp_employee_transactions` (
  `id` bigint(11) NOT NULL,
  `order_code` varchar(100) DEFAULT NULL,
  `transaction_code` varchar(100) DEFAULT NULL,
  `transaction_type` smallint(11) DEFAULT NULL,
  `credit_amount` decimal(16,2) DEFAULT NULL,
  `begin_balance` decimal(16,2) DEFAULT '0.00',
  `end_balance` decimal(16,2) DEFAULT '0.00',
  `description` text,
  `employee_id` int(11) DEFAULT NULL,
  `to_employee` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `spent_amount` decimal(16,2) DEFAULT '0.00',
  `received_amount` decimal(16,2) DEFAULT '0.00',
  `status` enum('Pending','Processing','Completed','Cancelled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_employee_transactions`
--

INSERT INTO `hp_employee_transactions` (`id`, `order_code`, `transaction_code`, `transaction_type`, `credit_amount`, `begin_balance`, `end_balance`, `description`, `employee_id`, `to_employee`, `created_at`, `updated_at`, `spent_amount`, `received_amount`, `status`) VALUES
(1, NULL, 'HPE00000001', NULL, '150.00', '0.00', '150.00', 'Amount has been loaded.', 2, NULL, '2018-02-05 18:20:59', NULL, '0.00', '150.00', 'Pending'),
(2, NULL, 'HPE00000002', NULL, '150.00', '150.00', '300.00', 'Amount has been loaded.', 2, NULL, '2018-02-05 18:22:50', NULL, '0.00', '150.00', 'Pending'),
(3, NULL, 'HPE00000003', NULL, '150.00', '0.00', '150.00', 'Received amount', 3, NULL, '2018-02-05 18:25:07', NULL, '0.00', '150.00', 'Pending'),
(4, NULL, 'HPE00000004', NULL, '150.00', '300.00', '150.00', 'Amount has been sent to kalesha shaik', 2, 3, '2018-02-05 18:25:07', NULL, '150.00', '0.00', 'Pending'),
(5, NULL, 'HPE00000005', NULL, '15000.00', '150.00', '15150.00', 'Amount has been loaded.', 2, NULL, '2018-02-06 10:21:33', NULL, '0.00', '15000.00', 'Pending'),
(6, '1', 'HPE00000006', NULL, '149.00', '15150.00', '15001.00', 'Purchased product', 2, NULL, '2018-02-08 18:45:26', '2018-02-08 18:45:30', '149.00', '0.00', 'Completed'),
(7, NULL, 'HPE00000007', NULL, '156.00', '15001.00', '15157.00', 'Amount has been loaded.', 2, NULL, '2018-02-09 10:23:18', NULL, '0.00', '156.00', 'Pending'),
(8, NULL, 'HPE00000008', NULL, '150.00', '150.00', '300.00', 'Received amount', 3, NULL, '2018-02-09 10:23:28', NULL, '0.00', '150.00', 'Pending'),
(9, NULL, 'HPE00000009', NULL, '150.00', '15157.00', '15007.00', 'Amount has been sent to kalesha shaik', 2, 3, '2018-02-09 10:23:28', NULL, '150.00', '0.00', 'Pending'),
(10, NULL, 'HPE00000010', NULL, '85.00', '15007.00', '15092.00', 'Amount has been loaded.', 2, NULL, '2018-02-09 10:49:59', NULL, '0.00', '85.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `hp_hotels`
--

CREATE TABLE `hp_hotels` (
  `id` int(20) NOT NULL,
  `hotel_code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `logo` blob,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_hotel_packages`
--

CREATE TABLE `hp_hotel_packages` (
  `id` int(30) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sku` varchar(50) NOT NULL,
  `short_description` text,
  `description` text,
  `validity` smallint(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `offer_price` decimal(10,2) DEFAULT NULL,
  `cashback_mode` tinyint(1) DEFAULT NULL,
  `cashback_amount` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `stock_status` mediumint(11) DEFAULT '1',
  `how_to_redeem` text,
  `benefits` text,
  `image_1` blob,
  `image_2` blob,
  `image_3` blob,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_hotel_package_vouchers`
--

CREATE TABLE `hp_hotel_package_vouchers` (
  `id` bigint(20) NOT NULL,
  `hotel_package_id` int(20) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `benefits` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_logged_user_cookie`
--

CREATE TABLE `hp_logged_user_cookie` (
  `id` int(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cookie_id` varchar(60) NOT NULL,
  `ip_address` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_master_products`
--

CREATE TABLE `hp_master_products` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `hotel_package_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_master_products`
--

INSERT INTO `hp_master_products` (`id`, `voucher_id`, `hotel_package_id`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, '2018-01-04 09:22:51', '0000-00-00 00:00:00'),
(3, 3, NULL, '2018-01-04 09:44:35', '0000-00-00 00:00:00'),
(4, 4, NULL, '2018-01-04 12:26:29', '0000-00-00 00:00:00'),
(5, 5, NULL, '2018-01-05 07:04:26', '0000-00-00 00:00:00'),
(6, 6, NULL, '2018-01-05 07:37:32', '0000-00-00 00:00:00'),
(7, 7, NULL, '2018-01-08 11:30:31', '0000-00-00 00:00:00'),
(8, 8, NULL, '2018-01-08 11:37:51', '0000-00-00 00:00:00'),
(9, 9, NULL, '2018-01-08 11:44:35', '0000-00-00 00:00:00'),
(10, 10, NULL, '2018-01-08 11:51:20', '0000-00-00 00:00:00'),
(11, 11, NULL, '2018-01-09 06:53:58', '0000-00-00 00:00:00'),
(12, 12, NULL, '2018-01-09 09:37:02', '0000-00-00 00:00:00'),
(13, 13, NULL, '2018-01-09 11:43:01', '0000-00-00 00:00:00'),
(14, 14, NULL, '2018-01-15 05:27:13', '0000-00-00 00:00:00'),
(15, 15, NULL, '2018-01-15 05:39:38', '0000-00-00 00:00:00'),
(16, 16, NULL, '2018-01-15 05:55:30', '0000-00-00 00:00:00'),
(17, 17, NULL, '2018-01-15 05:57:54', '0000-00-00 00:00:00'),
(18, 18, NULL, '2018-01-15 06:01:41', '0000-00-00 00:00:00'),
(19, 19, NULL, '2018-01-15 06:04:24', '0000-00-00 00:00:00'),
(20, 20, NULL, '2018-01-15 06:06:50', '0000-00-00 00:00:00'),
(21, 21, NULL, '2018-01-15 06:19:09', '0000-00-00 00:00:00'),
(22, 22, NULL, '2018-01-25 09:40:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hp_master_settings`
--

CREATE TABLE `hp_master_settings` (
  `id` int(11) NOT NULL,
  `hp_key` text NOT NULL,
  `hp_value` text NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hp_master_settings`
--

INSERT INTO `hp_master_settings` (`id`, `hp_key`, `hp_value`, `added_on`, `updated_on`) VALUES
(1, 'smtp_auth', 'true', '2017-11-27 00:09:12', '2017-11-27 09:25:32'),
(937, 'smtp_host', 'smtp.zoho.com', '2017-11-27 00:09:12', '2017-11-27 09:25:38'),
(938, 'smtp_port', '465', '2017-11-27 00:09:12', '2017-11-27 09:25:46'),
(939, 'smtp_username', 'arpit.p@happyperks.com', '2017-11-27 00:09:12', '2017-11-27 09:25:10'),
(940, 'smtp_password', 'Happyperks', '2017-11-27 00:09:12', '2017-11-27 09:25:05'),
(944, 'smtp_secure', 'ssl', '2017-11-27 00:09:12', '2017-11-27 09:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `hp_master_user`
--

CREATE TABLE `hp_master_user` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT '4' COMMENT '1 = admin 3= corporate 2 = marchent 4 = employee',
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `salt` varchar(9) DEFAULT NULL,
  `email` varchar(96) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `newsletter` tinyint(4) DEFAULT '0',
  `ip` varchar(40) DEFAULT NULL,
  `approved` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `lastsignedinon` datetime DEFAULT NULL,
  `is_wallet_exist` tinyint(4) NOT NULL,
  `resetsenton` datetime DEFAULT NULL,
  `remark_reject_request` text,
  `status` tinyint(1) DEFAULT NULL COMMENT '1= Active, 0= Inactive',
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_primary` enum('1','0') DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hp_master_user`
--

INSERT INTO `hp_master_user` (`user_id`, `group_id`, `password`, `remember_token`, `salt`, `email`, `phone`, `image`, `newsletter`, `ip`, `approved`, `is_deleted`, `lastsignedinon`, `is_wallet_exist`, `resetsenton`, `remark_reject_request`, `status`, `added_on`, `updated_on`, `is_primary`, `updated_at`, `created_at`) VALUES
(967, 3, '$2a$08$UtRe9YPVhI7PlVImUbOT7O9.dX23/E376GgkXmHDcVjk0t.gG151u', NULL, NULL, 'kaushik.t@happyperks.com', 9409590342, NULL, 0, '::1', NULL, NULL, '2018-02-09 10:23:50', 1, NULL, NULL, 0, '2018-02-01 06:05:40', '2018-02-01 06:05:40', '1', '2018-02-01 06:05:40', '2018-02-01 06:05:40'),
(968, 4, '$2a$08$UtRe9YPVhI7PlVImUbOT7O9.dX23/E376GgkXmHDcVjk0t.gG151u', NULL, NULL, 'kalesha.sk@happyperks.com', 7997791346, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2018-02-01 08:08:08', '2018-02-01 08:08:08', NULL, '2018-02-01 08:09:22', '2018-02-01 08:08:08'),
(969, 4, '$2a$08$UtRe9YPVhI7PlVImUbOT7O9.dX23/E376GgkXmHDcVjk0t.gG151u', NULL, NULL, 'roopa.r@happyperks.com', 9880590572, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2018-02-01 08:09:25', '2018-02-01 08:09:25', NULL, '2018-02-01 08:09:25', '2018-02-01 08:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `hp_order`
--

CREATE TABLE `hp_order` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(100) DEFAULT NULL,
  `invoice_no` varchar(60) DEFAULT NULL,
  `oxigen_response` text,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `email` varchar(96) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `shipping_address_format` text,
  `shipping_custom_field` text,
  `shipping_method` varchar(128) DEFAULT NULL,
  `shipping_code` varchar(128) DEFAULT NULL,
  `comment` text,
  `total` decimal(15,4) DEFAULT '0.0000',
  `sub_total` decimal(10,2) DEFAULT NULL,
  `order_status_id` int(11) DEFAULT '0',
  `ip` varchar(40) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_for` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0->vouchers, 1->recharge'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hp_order`
--

INSERT INTO `hp_order` (`order_id`, `order_code`, `invoice_no`, `oxigen_response`, `user_id`, `firstname`, `lastname`, `email`, `telephone`, `location_id`, `shipping_address_format`, `shipping_custom_field`, `shipping_method`, `shipping_code`, `comment`, `total`, `sub_total`, `order_status_id`, `ip`, `user_agent`, `created_at`, `updated_at`, `order_for`) VALUES
(1, 'HP000001', 'HPO000001', '{\"ResponseCode\":\"0\",\"ResponseMessage\":\"Success\",\"TransactionNumber\":\"95193797011518095730\",\"ReferenceId\":\"51431\"}', 967, NULL, NULL, 'kaushik.t@happyperks.com', '9409590342', 8, NULL, NULL, NULL, NULL, NULL, '149.0000', '149.00', 1, NULL, NULL, '2018-02-08 18:45:25', '2018-02-08 18:45:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hp_order_comments`
--

CREATE TABLE `hp_order_comments` (
  `id` bigint(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `comment` text,
  `comment_by` smallint(11) DEFAULT NULL,
  `while_status` smallint(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_order_old`
--

CREATE TABLE `hp_order_old` (
  `order_id` int(11) NOT NULL,
  `invoice_no` int(11) DEFAULT '0',
  `invoice_prefix` varchar(26) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `email` varchar(96) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `shipping_address_format` text,
  `shipping_custom_field` text,
  `shipping_method` varchar(128) DEFAULT NULL,
  `shipping_code` varchar(128) DEFAULT NULL,
  `comment` text,
  `total` decimal(15,4) DEFAULT '0.0000',
  `sub_total` decimal(10,2) DEFAULT NULL,
  `order_status_id` int(11) DEFAULT '0',
  `ip` varchar(40) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hp_order_products_map`
--

CREATE TABLE `hp_order_products_map` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `master_product_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_order_products_map`
--

INSERT INTO `hp_order_products_map` (`id`, `order_id`, `master_product_id`, `vendor_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 15, 1, '149.00', '2018-02-08 18:45:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hp_order_recharge`
--

CREATE TABLE `hp_order_recharge` (
  `id` bigint(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_code` varchar(100) DEFAULT NULL,
  `mobile_recharge_no` varchar(10) DEFAULT NULL,
  `operator` varchar(50) NOT NULL,
  `region` varchar(100) NOT NULL,
  `recharge_amount` decimal(10,2) DEFAULT NULL,
  `recharge_of_type` tinyint(1) DEFAULT NULL COMMENT '1-MobileRecharge,2-LandlineRecharge,3-BroadbandRecharge,4-DatacardRecharge,5-DTHRecharge,6-ElectricityBillRecharge,7-GasBillRecharge',
  `sim_type` varchar(50) DEFAULT NULL,
  `offer_type` varchar(50) DEFAULT NULL,
  `broadband_package` varchar(255) DEFAULT NULL,
  `broadband_userid` varchar(20) DEFAULT NULL,
  `subscribe_id` varchar(20) DEFAULT NULL,
  `account_no` varchar(16) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_order_voucher_coupon_map`
--

CREATE TABLE `hp_order_voucher_coupon_map` (
  `Id` bigint(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `voucher_coupon_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_order_voucher_coupon_map`
--

INSERT INTO `hp_order_voucher_coupon_map` (`Id`, `order_id`, `voucher_coupon_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2018-02-08 18:45:26', '2018-02-08 18:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `hp_order_voucher_hotel_purchased_map`
--

CREATE TABLE `hp_order_voucher_hotel_purchased_map` (
  `id` int(11) NOT NULL,
  `voucher_coupon_id` int(11) DEFAULT NULL,
  `hotel_package_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_request_comment`
--

CREATE TABLE `hp_request_comment` (
  `id` bigint(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `sent_by` varchar(30) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_request_module`
--

CREATE TABLE `hp_request_module` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `corporate_id` int(11) NOT NULL,
  `occasion` varchar(255) DEFAULT NULL,
  `no_of_quantity` int(11) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `min_cost` int(11) DEFAULT NULL,
  `max_cost` int(11) DEFAULT NULL,
  `mode` int(11) DEFAULT NULL COMMENT '1-E-voucher,2-Printed',
  `coupon` tinyint(1) DEFAULT NULL COMMENT '1-singlecoupons,2-multiplecoupons',
  `sample_attachment` varchar(255) DEFAULT NULL,
  `date_by` date DEFAULT NULL COMMENT 'when you want coupon & voucher',
  `description` text,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0 - Inactive , 1- Active ,2 - Cancel'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_roles`
--

CREATE TABLE `hp_roles` (
  `role_id` int(11) NOT NULL,
  `name` text,
  `parent_role_id` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_send_token`
--

CREATE TABLE `hp_send_token` (
  `id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `expiry_token` enum('yes','no') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_slider_banners`
--

CREATE TABLE `hp_slider_banners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `content` text,
  `image` text NOT NULL,
  `sort_order` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_slider_banners`
--

INSERT INTO `hp_slider_banners` (`id`, `name`, `content`, `image`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner One', '<div style=\"width: 100%; float: left;\">\r\n<p class=\"content-top discount\">50%</p>\r\n</div>\r\n<h3 style=\"font-weight: 100; font-size: 35px;\">HEY!</h3>\r\n<h2>GRAB THE DELICIOUS <br />FOOD DEAL</h2>\r\n<div class=\"slider-actions\"><a class=\"btn btn-danger\" href=\"#\">BUY NOW !</a> <a class=\"\" style=\"color: #fff; font-size: 17px; font-weight: 100; margin-left: 30px;\" href=\"#\">View All Food Deals</a></div>\r\n<h2>Cafe Coffee Day <br /> <span class=\"offer-price\">Rs.200</span> <span class=\"actual-price underline\">Rs.400</span></h2>\r\n<p>Starting @ Just - Rs.200 Only</p>', 'slider_f3fd8460c5cb006da4c87bdbdadbfe381.jpg', '6', 1, '2018-01-05 06:19:43', '2018-01-17 09:47:17'),
(2, 'Banner two', '<div style=\"width: 100%; float: left;\">\r\n<p class=\"content-top discount\">50%</p>\r\n</div>\r\n<h3 style=\"font-weight: 100; font-size: 35px;\">HEY!</h3>\r\n<h2>GRAB THE DELICIOUS <br />FOOD DEAL</h2>\r\n<div class=\"slider-actions\"><a class=\"btn btn-danger\" href=\"#\">BUY NOW !</a> <a class=\"\" style=\"color: #fff; font-size: 17px; font-weight: 100; margin-left: 30px;\" href=\"#\">View All Food Deals</a></div>\r\n<h2>Cafe Coffee Day <br /> <span class=\"offer-price\">Rs.200</span> <span class=\"actual-price underline\">Rs.400</span></h2>\r\n<p>Starting @ Just - Rs.200 Only</p>', 'slider_43b07a3604de4745f94a30635b3077db2.jpg', '5', 1, '2018-01-05 06:39:08', '2018-01-06 09:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `hp_state`
--

CREATE TABLE `hp_state` (
  `state_id` int(11) NOT NULL,
  `state_code` varchar(200) DEFAULT NULL,
  `state_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hp_state`
--

INSERT INTO `hp_state` (`state_id`, `state_code`, `state_name`) VALUES
(1, 'AN', 'Andaman and Nicobar'),
(2, 'AP', 'Andhra Pradesh'),
(3, 'AR', 'Arunachal Pradesh'),
(4, 'AS', 'Assam'),
(5, 'BR', 'Bihar '),
(6, 'CG', 'Chhattisgarh'),
(7, 'CH', 'Chandigarh'),
(8, 'DH', 'Dadra and Nagar Haveli'),
(9, 'DD', 'Daman and Diu'),
(10, 'DL', 'Delhi'),
(11, 'GA', 'Goa'),
(12, 'GJ', 'Gujarat'),
(13, 'HR', 'Haryana'),
(14, 'HP', 'Himachal Pradesh'),
(15, 'JK', 'Jammu and Kashmir'),
(16, 'JH', 'Jharkhand '),
(17, 'KA', 'Karnataka'),
(18, 'KL', 'Kerala'),
(19, 'LD', 'Lakshadweep'),
(20, 'MP', 'Madhya Pradesh'),
(21, 'MH', 'Maharashtra'),
(22, 'MN', 'Manipur'),
(23, 'ML', 'Meghalaya'),
(24, 'MZ', 'Mizoram'),
(25, 'NL', 'Nagaland'),
(26, 'OR', 'Orissa'),
(27, 'PY', 'Puducherry'),
(28, 'PB', 'Punjab'),
(29, 'RJ', 'Rajasthan'),
(30, 'SK', 'Sikkim'),
(31, 'TN', 'Tamil Nadu'),
(32, 'TR', 'Tripura'),
(33, 'UK', 'Uttarakhand'),
(34, 'UP', 'Uttar Pradesh'),
(35, 'WB', 'West Bengal'),
(36, 'TS', 'Telangana');

-- --------------------------------------------------------

--
-- Table structure for table `hp_survey_contest`
--

CREATE TABLE `hp_survey_contest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_transaction_types`
--

CREATE TABLE `hp_transaction_types` (
  `id` mediumint(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hp_user_session_log`
--

CREATE TABLE `hp_user_session_log` (
  `id` int(11) NOT NULL,
  `logged_in_at` datetime DEFAULT NULL,
  `logged_out_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_user_session_log`
--

INSERT INTO `hp_user_session_log` (`id`, `logged_in_at`, `logged_out_at`, `user_id`) VALUES
(1, '2018-02-01 13:43:29', NULL, 967),
(2, '2018-02-01 13:45:29', NULL, 967),
(3, '2018-02-01 13:45:58', NULL, 967),
(4, '2018-02-01 15:46:41', NULL, 967),
(5, '2018-02-01 16:13:12', NULL, 967),
(6, '2018-02-02 11:31:11', NULL, 967),
(7, '2018-02-02 12:32:33', NULL, 967),
(8, '2018-02-05 11:51:22', NULL, 967),
(9, '2018-02-08 12:09:44', NULL, 967),
(10, '2018-02-08 18:42:28', NULL, 967),
(11, '2018-02-09 10:03:07', NULL, 967);

-- --------------------------------------------------------

--
-- Table structure for table `hp_vendors`
--

CREATE TABLE `hp_vendors` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `address` text,
  `phone` varchar(20) NOT NULL,
  `product_type` tinyint(2) NOT NULL,
  `support_name` varchar(100) DEFAULT NULL,
  `support_phone` varchar(100) DEFAULT NULL,
  `support_email` varchar(100) DEFAULT NULL,
  `cancellation_policy` text,
  `return_policy` text,
  `bank_name` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `gst_number` varchar(100) DEFAULT NULL,
  `pan_card_number` varchar(100) DEFAULT NULL,
  `logo` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_vendors`
--

INSERT INTO `hp_vendors` (`id`, `user_id`, `email`, `name`, `display_name`, `commission`, `address`, `phone`, `product_type`, `support_name`, `support_phone`, `support_email`, `cancellation_policy`, `return_policy`, `bank_name`, `customer_name`, `account_number`, `ifsc_code`, `gst_number`, `pan_card_number`, `logo`, `created_at`, `updated_at`) VALUES
(15, 25, 'first@gmail.com', 'first@gmail.com', NULL, NULL, 'hsr', '9721454545', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-12 09:10:36', '2018-01-12 09:10:36'),
(16, 31, 'vendorone@happyperks.com', 'vendorone', NULL, NULL, 'bangalore', '1234567890', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-15 06:13:10', '2018-01-15 06:13:10'),
(17, 32, 'vendortwo@happyperks.com', 'vendortwo', NULL, NULL, NULL, '1234567890', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-15 06:17:36', '2018-01-15 06:17:36'),
(18, 33, 'vendorthree@happyperks.com', 'vendorthree', NULL, NULL, 'bangalore', '1234567890', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-15 10:17:58', '2018-01-15 10:17:58'),
(19, 35, 'a@b.com', 'a', NULL, NULL, 'asd', '123', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-25 09:21:23', '2018-01-25 09:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `hp_vendors_brands_map`
--

CREATE TABLE `hp_vendors_brands_map` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_vendors_brands_map`
--

INSERT INTO `hp_vendors_brands_map` (`id`, `vendor_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(2, 18, 1, '2018-01-17 09:33:22', '2018-01-17 09:33:22'),
(3, 18, 5, '2018-01-17 09:33:22', '2018-01-17 09:33:22'),
(4, 15, 1, '2018-01-17 11:25:15', '2018-01-17 11:25:15'),
(5, 19, 2, '2018-01-25 09:21:35', '2018-01-25 09:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `hp_vendors_redeem_locations`
--

CREATE TABLE `hp_vendors_redeem_locations` (
  `id` int(100) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address` text,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_vendors_redeem_locations`
--

INSERT INTO `hp_vendors_redeem_locations` (`id`, `vendor_id`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(43, 16, '46, 6th Cross Rd, Varsova Layout, Kaggadasapura, Bengaluru, Karnataka 560093, India', '12.981809528732812', '77.67357587814331', '2018-01-15 06:13:10', '2018-01-15 06:13:10'),
(44, 18, 'Unnamed Road, Puttasandra, Karnataka 572129, India', '13.43236657581376', '77.30074882507324', '2018-01-15 10:17:58', '2018-01-15 10:17:58'),
(45, 18, 'Unnamed Road, Karnataka 563128, India', '13.27202630119995', '78.03133964538574', '2018-01-15 10:17:58', '2018-01-15 10:17:58'),
(46, 18, 'Unnamed Road, K.G. Kuntanahalli, Karnataka 562157, India', '13.239945499286314', '77.53146171569824', '2018-01-15 10:17:58', '2018-01-15 10:17:58'),
(47, 19, 'asf', '1223', '2222', '2018-01-25 09:21:23', '2018-01-25 09:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `hp_vouchers`
--

CREATE TABLE `hp_vouchers` (
  `id` int(150) NOT NULL,
  `voucher_code` varchar(100) DEFAULT NULL,
  `vendor_id` int(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `short_description` text,
  `sku` varchar(20) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `terms` text,
  `price` decimal(10,2) DEFAULT NULL,
  `offer_price` decimal(10,2) DEFAULT NULL,
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `use_before` varchar(50) DEFAULT NULL,
  `cashback_mode` tinyint(1) DEFAULT NULL COMMENT '0 - Percentage | 1 - Fixed Amount',
  `cashback` decimal(10,2) DEFAULT NULL,
  `cancellation_policy` text,
  `usage_per_user` smallint(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `things_to_remember` text,
  `next_step` text,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `image_1` blob,
  `image_2` blob,
  `image_3` blob,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_vouchers`
--

INSERT INTO `hp_vouchers` (`id`, `voucher_code`, `vendor_id`, `name`, `description`, `short_description`, `sku`, `brand`, `terms`, `price`, `offer_price`, `valid_from`, `valid_to`, `use_before`, `cashback_mode`, `cashback`, `cancellation_policy`, `usage_per_user`, `status`, `things_to_remember`, `next_step`, `meta_title`, `meta_keywords`, `meta_description`, `image_1`, `image_2`, `image_3`, `created_at`, `updated_at`) VALUES
(2, 'v000002', 15, 'Mon - Thu: Unlimited Movies for 30 Days', 'Valid for 30 days from the date of activation of MoviEcard | Timings mentioned on nearbuy are purchase timings. For show timings, please refer moviecardindia.com |', NULL, 'CCMS2654', '1', 'Weekday MoviEcard entitles the user for Unlimited New Moviesfrom Monday to Thursday\r\n\r\nAll Day MoviEcard entitles the user for Unlimited New Moviesfrom Monday to Sunday\r\n\r\nMoviEcard holder is entitled to use one mobile number percard\r\n\r\nMoviEcard holder is entitled to watch one \'movie title\' onceand a maximum of one movie a day', '250.00', '149.00', '2018-01-18 01:00:00', '2018-03-28 12:00:00', '2', 1, '100.00', 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x62656265656336373363333562376666633034643938613230386263306564326361726e6976616c5f63696e656d61732e6a7067, 0x62656265656336373363333562376666633034643938613230386263306564326361726e6976616c5f63696e656d61735f322e6a7067, 0x62656265656336373363333562376666633034643938613230386263306564326361726e6976616c5f63696e656d61735f6f666665722e6a7067, '2018-01-04 09:22:51', '2018-01-15 06:20:26'),
(3, 'v000003', 15, 'Weekend: Full Body Massage + Shower (Total Duration: 60min)', 'Choice of Massages: Aroma / Swedish / Deep Tissue | Blackout Dates: 25th Dec 2017 to 04th Jan 2018', NULL, 'O1SPA25SP', '2', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '4307.00', '1199.00', '2018-01-05 12:00:00', '2018-03-28 12:00:00', '2', 2, '20.00', 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 2, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, '', '', '', '2018-01-04 09:44:35', '2018-01-15 06:20:50'),
(4, 'v000004', 15, 'Foot, Head, Shoulder & Back Massage + Farewell Drink (30min)', 'Full body massage & spa services', NULL, 'paytm2231', '3', 'should not be used after validated or expired', '1000.00', '699.00', '2018-01-05 12:00:00', '2018-03-28 12:00:00', '2', 1, '100.00', 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x6532616337396666363139356437323230663835636264613466326166366335737061312e6a7067, 0x65326163373966663631393564373232306638356362646134663261663663357379312e6a7067, 0x65326163373966663631393564373232306638356362646134663261663663357379322e6a7067, '2018-01-04 12:26:29', '2018-01-08 11:48:46'),
(5, 'v000005', 15, 'Unlimited Movies for 30 Days', '*Valid for 30 days from the date of activation of MoviEcard | Timings mentioned on nearbuy are purchase timings. For show timings, please refer moviecardindia.com |', NULL, 'CARN0569', '1', '*Valid for 30 days from the date of activation of MoviEcard | \r\nTimings mentioned on nearbuy are purchase timings.\r\n For show timings, please refer moviecardindia.com', '520.00', '200.00', '2018-01-05 07:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x66393336386462643831613438336361623862353765666631363063666561326867662e6a7067, 0x66393336386462643831613438336361623862353765666631363063666561326361726e6976616c5f63696e656d61735f322e6a7067, 0x66393336386462643831613438336361623862353765666631363063666561326361726e6976616c5f63696e656d61735f6f666665722e6a7067, '2018-01-05 07:04:26', '2018-01-16 06:39:33'),
(6, 'v000006', 15, 'Welcome Drink + Swedish Full Body Massage (40min) + Head Massage (10min) + Shower + Farewell Drink', '', NULL, NULL, '6', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '2000.00', '1999.00', '2018-01-05 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x343765656366663130623162393136353938386566663239613234373865353364312e6a7067, 0x343765656366663130623162393136353938386566663239613234373865353364322e6a7067, 0x343765656366663130623162393136353938386566663239613234373865353364332e6a7067, '2018-01-05 07:37:32', '2018-01-08 11:24:09'),
(7, 'v000007', 16, 'Welcome Drink + Deep Tissue Full Body Massage(40min) + Head Massage(10min) + Shower + Farewell Drink', 'Give in to your impulses and treat yourself with a pampering session at Dolphin Spa, located in Indiranagar. The spa offers a comprehensive set of therapies that are well-crafted in order to cater to all your rejuvenating and relaxing needs. All the services are provided by a team of skilled therapists who are well versed with the latest trends and techniques. Take a trip to Dolphin Spa and have yourself pampered thoroughly.', NULL, NULL, '6', NULL, '2000.00', '999.00', '2018-01-09 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-08 11:30:31', '2018-01-15 06:23:43'),
(8, 'v000008', 15, 'Foot Massage (20min)', NULL, NULL, NULL, '6', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '700.00', '399.00', '2018-01-08 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x633232636530333636363864343434303336363639616137663439646436336461342e6a7067, 0x646531346539373665613865636334333938386264616465376333313662313761322e6a7067, 0x646531346539373665613865636334333938386264616465376333313662313761332e6a7067, '2018-01-08 11:37:51', '2018-01-08 11:45:37'),
(9, 'v000009', 16, 'Head, Neck, Back & Shoulder Massage (30min)', NULL, NULL, NULL, '4', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '799.00', '300.00', '2018-01-08 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x623665346237316432646636663935363033633566313664663066343962613361312e6a7067, 0x623665346237316432646636663935363033633566313664663066343962613361322e6a7067, 0x623665346237316432646636663935363033633566313664663066343962613361332e6a7067, '2018-01-08 11:44:35', '2018-01-15 06:23:54'),
(10, 'v000010', 15, 'Sat & Sun: Farewell Drink + Full Body Massage (Aroma/Swedish/Balinese)(45min) + Steam/Shower(15min)', NULL, NULL, NULL, '6', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '1800.00', '1099.00', '2018-01-08 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x3466333532303732366432613862326565663336343337646461353837376662737061322e6a7067, 0x34663335323037323664326138623265656633363433376464613538373766627773312e6a7067, 0x34663335323037323664326138623265656633363433376464613538373766627773332e6a7067, '2018-01-08 11:51:20', '2018-01-08 11:51:20'),
(11, 'v000011', 15, 'Men: Haircut(Sr.Stylist) + Hair Wash + Blow-Dry', 'Toni & Guy is a UK-based hairdressing company that provides professional quality beauty services. With over 400 outlets all over the world, Toni & Guy are among the leaders of the hair care industry. Having 2 outlets in Bangalore, Toni & Guy delivers creativity, quality and consistency with every product and service.', NULL, NULL, '7', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '826.00', '499.00', '2018-01-09 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x32653735646531353136613132366365646264346432633234346563613537627467312e6a7067, 0x32653735646531353136613132366365646264346432633234346563613537627467322e6a7067, 0x32653735646531353136613132366365646264346432633234346563613537627467332e6a7067, '2018-01-09 06:53:58', '2018-01-09 09:44:49'),
(12, 'v000012', 17, 'Men: Haircut (Senior Stylist) + Hair Wash + Blow-dry', NULL, NULL, NULL, '7', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '829.00', '400.00', '2018-01-09 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x39666636343538623431376163633362653231373035366566643236326263617467312e6a7067, 0x39666636343538623431376163633362653231373035366566643236326263617467322e6a7067, 0x39666636343538623431376163633362653231373035366566643236326263617467332e6a7067, '2018-01-09 09:37:02', '2018-01-15 06:23:16'),
(13, 'v000013', 17, 'Hair Wash + Basic Haircut + Hair Setting + Eyebrows Threading / Beard Trim', 'Located in Indiranagar, Fascinations is a unisex salon and spa that offers a range of beauty and wellness services. The staff here is professionally trained and the interiors sport a contemporary look.', NULL, NULL, '3', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '999.00', '399.00', '2018-01-09 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x633736363263646565653630333630393531363565663034383533386335373466312e6a7067, 0x633736363263646565653630333630393531363565663034383533386335373466322e6a7067, 0x633736363263646565653630333630393531363565663034383533386335373466332e6a7067, '2018-01-09 11:43:01', '2018-01-15 06:23:05'),
(14, 'v000014', 15, 'Women: Haircut (Style Director) + Hair Wash + Blow-Dry', 'Toni Guy is a UK-based hairdressing company that provides professional quality beauty services. With over 400 outlets all over the world, Toni & Guy is among the leaders of the hair care industry. Located in over 7 outlets in Chennai, it delivers creativity, quality and consistency with every product and service.', NULL, NULL, '7', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '2359.00', '1599.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x36396137343961663563663362626465343130646562653437613938613661357467312e6a7067, 0x36396137343961663563663362626465343130646562653437613938613661357467322e6a7067, 0x36396137343961663563663362626465343130646562653437613938613661357467332e6a7067, '2018-01-15 05:27:13', '2018-01-15 05:27:13');
INSERT INTO `hp_vouchers` (`id`, `voucher_code`, `vendor_id`, `name`, `description`, `short_description`, `sku`, `brand`, `terms`, `price`, `offer_price`, `valid_from`, `valid_to`, `use_before`, `cashback_mode`, `cashback`, `cancellation_policy`, `usage_per_user`, `status`, `things_to_remember`, `next_step`, `meta_title`, `meta_keywords`, `meta_description`, `image_1`, `image_2`, `image_3`, `created_at`, `updated_at`) VALUES
(15, 'v000015', 16, 'Open Voucher worth Rs.2500 (Not valid on Chemicals)', 'Toni Guy is a UK-based hairdressing company that provides professional quality beauty services. With over 400 outlets all over the world, Toni & Guy is among the leaders of the hair care industry. Located in over 7 outlets in Chennai, it delivers creativity, quality and consistency with every product and service.', NULL, NULL, '7', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '2500.00', '1499.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x38373533646431613234383831306162623233383034343762643430333963347467312e6a7067, 0x38373533646431613234383831306162623233383034343762643430333963347467322e6a7067, 0x38373533646431613234383831306162623233383034343762643430333963347467332e6a7067, '2018-01-15 05:39:38', '2018-01-15 06:22:24'),
(16, 'v000016', 15, 'Men: Salon package 2', 'A chain of salons offering premium hair and beauty services, B-Enzo stands true to it\'s name, which means \'Brilliant\'s Victory\'. Everything in and about the salon has been thoughtfully and passionately designed, right from the subtle aesthetics to the list of services offered. In the relaxing ambience of the salon, you get to embrace your beauty, both inner and outer with their range of specialised treatments, carried out by their skilled beauty artists. At B-Enzo, it\'s not just about paying attention to you, but about pampering you! After all, you deserve to feel like the special person that you are!', NULL, NULL, '3', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '1620.00', '1299.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x64353963306331383335386438386539396239633434623562613566643138376265312e6a7067, 0x64353963306331383335386438386539396239633434623562613566643138376265322e6a7067, 0x64353963306331383335386438386539396239633434623562613566643138376265342e6a7067, '2018-01-15 05:55:30', '2018-01-15 09:15:10'),
(17, 'v000017', 17, 'Haircut + Hair Wash', 'Lotus Family Salon is located in Jayanagar, Bengaluru. The experience it offers is truly exceptional and leaves you wanting to experience more & more. Open for men, women and kids, the salon has a calming ambience where you can find relaxation and rejuvenation. The staff is highly experienced and helps you in an easy transition from drab to fab. So why not experience the magic that Lotus Family Salon can create on you!', NULL, NULL, '3', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '200.00', '149.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x62373261303433646165326133316430386134363861613563663631303436346c312e6a7067, 0x62373261303433646165326133316430386134363861613563663631303436346c322e6a7067, 0x62373261303433646165326133316430386134363861613563663631303436346c332e6a7067, '2018-01-15 05:57:54', '2018-01-15 06:23:31'),
(18, 'v000018', 15, 'Spa Package 2', 'Swedish / Balinese Full Body Massage (30min) + Head Massage (10min) + Foot Massage Machine (15min) + Face Cleaning + Face Scrub + Body Cleaning + Body Scrub + Hair Spa + Steam Bath (10min)', NULL, NULL, '4', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '8200.00', '999.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x36333762353366343532343037303930633233333463376333666661303632396f312e6a7067, 0x36333762353366343532343037303930633233333463376333666661303632396f322e6a7067, 0x36333762353366343532343037303930633233333463376333666661303632396f332e6a7067, '2018-01-15 06:01:41', '2018-01-15 06:01:41'),
(19, 'v000019', 15, 'Women: Women: Hair Straightening/Smoothening/Keratin Treatment package', 'Toni & Guy is a UK-based hairdressing company that provides professional quality beauty services. With over 400 outlets all over the world, Toni & Guy are among the leaders of the hair care industry. Having 2 outlets in Bangalore, Toni & Guy delivers creativity, quality and consistency with every product and service.', NULL, NULL, '7', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '3954.00', '2299.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x33386534346132643331363965626534303835313861653139386361653131337467342e6a7067, 0x33386534346132643331363965626534303835313861653139386361653131337467332e6a7067, 0x33386534346132643331363965626534303835313861653139386361653131337467352e6a7067, '2018-01-15 06:04:24', '2018-01-15 10:22:07'),
(20, 'v000020', 15, 'Women: Bridal package', 'Flavoured Cartridge Wax(FH / FL / UA)+ Glow Dermi Facial (O2 C2)+ Crystal Pedicure+ crystal manicure + Hair Keratin Spa+ Premium Body Polishing+ Nail Art+ Threading+ De tan ( Face & Neck & Back)+ Full Body Bleach', NULL, NULL, '3', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '17255.00', '13999.00', NULL, '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x39303731363534623162613831393061653466383133376633323139303564306265312e6a7067, 0x39303731363534623162613831393061653466383133376633323139303564306265342e6a7067, 0x39303731363534623162613831393061653466383133376633323139303564306265322e6a7067, '2018-01-15 06:06:50', '2018-01-15 06:06:50'),
(21, 'v000021', 16, 'Couple Spa Package (Duration - 60min)', 'Package Includes: Welcome Drink + Full Body Massage + Full Body Polishing + Steam / Shower', NULL, NULL, '4', 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '4500.00', '2499.00', '2018-01-15 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', 1, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, 0x386561313564623936663439336562313266393035633734653734333534373363312e6a7067, '', '', '2018-01-15 06:19:09', '2018-01-17 10:08:25'),
(22, 'v000022', 19, 'Rs  200OFF  500', NULL, NULL, NULL, NULL, 'Each coupon is identified by a Coupon Code and has different requirements and rewards. Please check your coupon — all requirements stated on the coupon must be met to receive the discount.\n\nCoupon values are as specified on the coupon.\n\nLimit of one coupon per household.\n\nCoupons are intended for single use only.\n\nCoupons are applicable to Visa, MasterCard, or American Express purchases only.', '200.00', '150.00', '2018-01-25 12:00:00', '2018-03-28 12:00:00', NULL, NULL, NULL, 'this Site and all its Contents are intended solely for personal, non-commercial use. Except as expressly provided, nothing within the Site shall be construed as conferring any license under our or any third party\'s intellectual property rights, whether by estoppel, implication, waiver, or otherwise. Without limiting the generality of the foregoing, you acknowledge and agree that all content available through and used to operate the Site and its services is protected by copyright, trademark, patent, or other proprietary rights. You agree not to: (a) modify, alter, or deface any of the trademarks, service marks, trade dress (collectively \"Trademarks\") or other intellectual property made available by us in connection with the Site; (b) hold yourself out as in any way sponsored by, affiliated with, or endorsed by us, or any of our affiliates or service providers; (c) use any of the Trademarks or other content accessible through the Site for any purpose other than the purpose for which we have made it available to you; (d) defame or disparage us, our Trademarks, or any aspect of the Site; and (e) adapt, translate, modify, decompile, disassemble, or reverse engineer the Site or any software or programs used in connection with it or its products and services.\n\n', NULL, 1, 'A. If any provision of these Terms and Conditions is held to be invalid or unenforceable, the provision shall be removed (or interpreted, if possible, in a manner as to be enforceable), and the remaining provisions shall be enforced. Headings are for reference purposes only and in no way define, limit, construe or describe the scope or extent of such section. Our failure to act with respect to a breach by you or others does not waive our right to act with respect to subsequent or similar breaches. These Terms and Conditions set forth the entire understanding and agreement between us with respect to the subject matter contained herein and supersede any other agreement, proposals and communications, written or oral, between our representatives and you with respect to the subject matter hereof, including any terms and conditions on any of customer\'s documents or purchase orders.\n\nB. No Joint Venture, No Derogation of Rights. You agree that no joint venture, partnership, employment, or agency relationship exists between you and us as a result of these Terms and Conditions or your use of the Site. Our performance of these Terms and Conditions is subject to existing laws and legal process, and nothing contained herein is in derogation of our right to comply with governmental, court and law enforcement requests or requirements relating to your use of the Site or information provided to or gathered by us with respect to such use.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-25 09:40:24', '2018-01-25 09:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `hp_vouchers_couponcodes`
--

CREATE TABLE `hp_vouchers_couponcodes` (
  `id` int(100) NOT NULL,
  `voucher_id` int(150) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `is_purchased` tinyint(1) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_vouchers_couponcodes`
--

INSERT INTO `hp_vouchers_couponcodes` (`id`, `voucher_id`, `coupon_code`, `is_purchased`, `is_used`, `created_at`, `updated_at`) VALUES
(1, 2, 'CANidwtp', 1, 0, '2018-01-05 07:01:26', '2018-02-08 18:45:26'),
(2, 2, 'CANnzlsk', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:01:26'),
(3, 2, 'CANbqhoq', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:01:26'),
(4, 4, 'CANctmtj', 0, 0, '2018-01-05 07:01:26', '2018-01-18 13:35:18'),
(5, 4, 'CANxpilr', 0, 0, '2018-01-05 07:01:26', '2018-01-18 13:35:25'),
(6, 4, 'CANhxdzz', 0, 0, '2018-01-05 07:01:26', '2018-01-18 13:35:47'),
(7, 4, 'CANlidib', 0, 0, '2018-01-05 07:01:26', '2018-01-18 13:36:20'),
(8, 4, 'CANswadp', 0, 0, '2018-01-05 07:01:26', '2018-01-18 13:36:49'),
(9, 9, 'CANkfgst', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:01:26'),
(10, 9, 'CANwunjn', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:01:26'),
(11, 5, 'donidwtp', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:00:06'),
(12, 5, 'donnzlsk', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:00:06'),
(13, 5, 'donbqhoq', 0, 0, '2018-01-05 07:01:26', '2018-01-05 07:00:06'),
(14, 21, 'hyienbs', 0, 0, '2018-01-15 06:01:09', '0000-00-00 00:00:00'),
(15, 21, 'fvetxsb', 0, 0, '2018-01-15 06:01:09', '0000-00-00 00:00:00'),
(16, 21, 'crnrhho', 0, 0, '2018-01-15 06:01:09', '2018-01-17 14:30:26'),
(17, 21, 'mdgayiv', 0, 0, '2018-01-15 06:01:09', '0000-00-00 00:00:00'),
(18, 21, 'tzkaytf', 0, 0, '2018-01-15 06:01:09', '0000-00-00 00:00:00'),
(19, 21, 'mvyrqck', 0, 0, '2018-01-15 06:01:09', '0000-00-00 00:00:00'),
(20, 21, 'ovmrmzi', 0, 0, '2018-01-15 06:01:09', '0000-00-00 00:00:00'),
(21, 20, 'mrqix', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(22, 20, 'gwked', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(23, 20, 'rhnqn', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(24, 20, 'qopxa', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(25, 20, 'yhezx', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(26, 20, 'cmvzk', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(27, 20, 'tmcku', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(28, 20, 'zrqjv', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(29, 20, 'ubcir', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(30, 20, 'qygfv', 0, 0, '2018-01-15 09:01:34', '0000-00-00 00:00:00'),
(31, 16, 'geckd', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(32, 16, 'anpwm', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(33, 16, 'apyca', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(34, 16, 'tcrjm', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(35, 16, 'nenqm', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(36, 16, 'fgklm', 0, 0, '2018-01-15 09:01:00', '2018-01-18 13:16:22'),
(37, 16, 'grqic', 0, 0, '2018-01-15 09:01:00', '2018-01-18 13:16:43'),
(38, 16, 'ujpjf', 0, 0, '2018-01-15 09:01:00', '2018-01-18 13:34:46'),
(39, 16, 'ckvan', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(40, 16, 'vuqmd', 0, 0, '2018-01-15 09:01:00', '0000-00-00 00:00:00'),
(41, 15, 'pvyol', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(42, 15, 'wjvah', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(43, 15, 'aajmq', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(44, 15, 'wnzqw', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(45, 15, 'cvdcs', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(46, 15, 'adatm', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(47, 15, 'ujitx', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(48, 15, 'tqhor', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(49, 15, 'oorxb', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(50, 15, 'htphk', 0, 0, '2018-01-15 09:01:08', '0000-00-00 00:00:00'),
(51, 14, 'eyqrs', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(52, 14, 'wxpum', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(53, 14, 'byrhz', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(54, 14, 'kayxj', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(55, 14, 'xzuqx', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(56, 14, 'bkhrg', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(57, 14, 'cweto', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(58, 14, 'wqlmk', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(59, 14, 'ynipv', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(60, 14, 'havgy', 0, 0, '2018-01-15 09:01:16', '0000-00-00 00:00:00'),
(61, 13, 'cupia', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(62, 13, 'srbwx', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(63, 13, 'ehblp', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(64, 13, 'utglv', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(65, 13, 'tenlk', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(66, 13, 'hpuyj', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(67, 13, 'abdqk', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(68, 13, 'eicff', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(69, 13, 'zkmaw', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(70, 13, 'cvpjg', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(71, 12, 'fnqyq', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(72, 12, 'pehsb', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(73, 12, 'qrdjg', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(74, 12, 'dxrmy', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(75, 12, 'yocco', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(76, 12, 'nacvn', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(77, 12, 'eaauy', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(78, 12, 'rjdzb', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(79, 12, 'eqtia', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(80, 12, 'zlxry', 0, 0, '2018-01-15 09:01:36', '0000-00-00 00:00:00'),
(81, 11, 'rqluz', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(82, 11, 'idzjl', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(83, 11, 'ntfos', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(84, 11, 'sfvjm', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(85, 11, 'ismne', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(86, 11, 'slfze', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(87, 11, 'jqvul', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(88, 11, 'udotm', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(89, 11, 'zhgfw', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(90, 11, 'yycui', 0, 0, '2018-01-15 09:01:56', '0000-00-00 00:00:00'),
(91, 10, 'qzzvc', 0, 0, '2018-01-15 09:01:02', '2018-01-18 13:35:03'),
(92, 10, 'bzpmq', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(93, 10, 'wboiq', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(94, 10, 'vztip', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(95, 10, 'ociyt', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(96, 10, 'jrzma', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(97, 10, 'pcaox', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(98, 10, 'dqxtc', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(99, 10, 'opdcy', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(100, 10, 'uxxof', 0, 0, '2018-01-15 09:01:02', '0000-00-00 00:00:00'),
(101, 9, 'kmnea', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(102, 9, 'dhagg', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(103, 9, 'bejkv', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(104, 9, 'tcbtq', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(105, 9, 'xnrzs', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(106, 9, 'itcuy', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(107, 9, 'gfktj', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(108, 9, 'lwrmd', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(109, 9, 'xohgy', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(110, 9, 'daafu', 0, 0, '2018-01-15 09:01:13', '0000-00-00 00:00:00'),
(111, 8, 'fdxau', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(112, 8, 'vbect', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(113, 8, 'lfppz', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(114, 8, 'dmpoz', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(115, 8, 'ammic', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(116, 8, 'iqdex', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(117, 8, 'bjbzk', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(118, 8, 'vulaw', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(119, 8, 'flcub', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(120, 8, 'cxorm', 0, 0, '2018-01-15 09:01:22', '0000-00-00 00:00:00'),
(121, 7, 'vpmxr', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(122, 7, 'blsdg', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(123, 7, 'fhggc', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(124, 7, 'fylix', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(125, 7, 'nnogv', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(126, 7, 'ogglx', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(127, 7, 'fhnrf', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(128, 7, 'fsqxw', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(129, 7, 'wdedj', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(130, 7, 'giisr', 0, 0, '2018-01-15 09:01:29', '0000-00-00 00:00:00'),
(131, 6, 'gfeum', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(132, 6, 'zjsgv', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(133, 6, 'qlcdd', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(134, 6, 'iiwyg', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(135, 6, 'svjxy', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(136, 6, 'tehbw', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(137, 6, 'yicdc', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(138, 6, 'ocmhj', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(139, 6, 'hxvja', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(140, 6, 'yrjuq', 0, 0, '2018-01-15 09:01:37', '0000-00-00 00:00:00'),
(141, 5, 'kclyn', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(142, 5, 'vfcqe', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(143, 5, 'mqgqh', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(144, 5, 'quqsa', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(145, 5, 'vslit', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(146, 5, 'hkoxt', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(147, 5, 'viwgg', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(148, 5, 'jbmms', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(149, 5, 'qyjwo', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(150, 5, 'qnjgf', 0, 0, '2018-01-15 09:01:45', '0000-00-00 00:00:00'),
(151, 4, 'czhpq', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(152, 4, 'uuweg', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(153, 4, 'ikxyt', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(154, 4, 'atdpd', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(155, 4, 'isndt', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(156, 4, 'bznrm', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(157, 4, 'qtmyj', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(158, 4, 'cteyy', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(159, 4, 'kgjif', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(160, 4, 'ciygy', 0, 0, '2018-01-15 09:01:53', '0000-00-00 00:00:00'),
(161, 3, 'ocaaq', 0, 0, '2018-01-15 09:01:01', '2018-01-18 13:38:00'),
(162, 3, 'etcjs', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(163, 3, 'htjco', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(164, 3, 'uxrir', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(165, 3, 'eiyko', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(166, 3, 'vjmxd', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(167, 3, 'vlgvm', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(168, 3, 'wafzk', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(169, 3, 'ygdhi', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(170, 3, 'sbfjk', 0, 0, '2018-01-15 09:01:01', '0000-00-00 00:00:00'),
(171, 2, 'pnlzl', 0, 0, '2018-01-15 09:01:10', '0000-00-00 00:00:00'),
(172, 2, 'ksqru', 0, 0, '2018-01-15 09:01:10', '0000-00-00 00:00:00'),
(173, 2, 'nqcpt', 0, 0, '2018-01-15 09:01:10', '0000-00-00 00:00:00'),
(174, 2, 'fewrl', 0, 0, '2018-01-15 09:01:10', '2018-01-27 12:56:05'),
(175, 2, 'gyibi', 0, 0, '2018-01-15 09:01:10', '2018-01-27 13:01:30'),
(176, 2, 'jaatv', 0, 0, '2018-01-15 09:01:10', '2018-01-27 13:03:51'),
(177, 2, 'qjjci', 0, 0, '2018-01-15 09:01:10', '2018-01-27 13:08:07'),
(178, 2, 'umbld', 0, 0, '2018-01-15 09:01:10', '2018-01-27 13:10:22'),
(179, 2, 'vyuyo', 0, 0, '2018-01-15 09:01:10', '2018-01-27 13:11:41'),
(180, 2, 'ndskv', 0, 0, '2018-01-15 09:01:10', '2018-01-27 13:17:31'),
(181, 18, 'inbkc', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(182, 18, 'oleyt', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(183, 18, 'pqpmt', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(184, 18, 'jgfsr', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(185, 18, 'urpdg', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(186, 18, 'ttlvg', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(187, 18, 'tetuo', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(188, 18, 'wizah', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(189, 18, 'tqxic', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(190, 18, 'rsjwk', 0, 0, '2018-01-15 10:01:56', '0000-00-00 00:00:00'),
(191, 17, 'vjegz', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(192, 17, 'scbra', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(193, 17, 'uvxkg', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(194, 17, 'fqcsd', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(195, 17, 'wwnvy', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(196, 17, 'jvdgx', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(197, 17, 'ccggi', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(198, 17, 'fzkhr', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(199, 17, 'lbmjl', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(200, 17, 'spcuh', 0, 0, '2018-01-15 10:01:20', '0000-00-00 00:00:00'),
(201, 19, 'dtnih', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(202, 19, 'brwej', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(203, 19, 'qrfmg', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(204, 19, 'exmzm', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(205, 19, 'bwwzx', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(206, 19, 'agjhw', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(207, 19, 'xlpkt', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(208, 19, 'xmltr', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(209, 19, 'ujiav', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(210, 19, 'oftbe', 0, 0, '2018-01-15 10:01:31', '0000-00-00 00:00:00'),
(211, 21, 'gbkho', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(212, 21, 'pexpz', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(213, 21, 'xofdu', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(214, 21, 'nyvnt', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(215, 21, 'jhaxk', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(216, 21, 'brzll', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(217, 21, 'wsmhz', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(218, 21, 'aweym', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(219, 21, 'evajz', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00'),
(220, 21, 'uxxqk', 0, 0, '2018-01-17 09:01:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hp_voucher_available_locations_map`
--

CREATE TABLE `hp_voucher_available_locations_map` (
  `id` bigint(50) NOT NULL,
  `voucher_id` int(100) DEFAULT NULL,
  `hotel_package_id` int(20) DEFAULT NULL,
  `location_id` int(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_voucher_available_locations_map`
--

INSERT INTO `hp_voucher_available_locations_map` (`id`, `voucher_id`, `hotel_package_id`, `location_id`, `created_at`, `updated_at`) VALUES
(6, 6, NULL, 215, '2018-01-05 07:54:50', '2018-01-05 07:54:50'),
(7, 7, NULL, 215, '2018-01-08 11:30:31', '2018-01-08 11:30:31'),
(8, 8, NULL, 215, '2018-01-08 11:37:51', '2018-01-08 11:37:51'),
(9, 9, NULL, 215, '2018-01-08 11:44:35', '2018-01-08 11:44:35'),
(10, 4, NULL, 215, '2018-01-08 11:47:52', '2018-01-08 11:47:52'),
(11, 10, NULL, 215, '2018-01-08 11:51:20', '2018-01-08 11:51:20'),
(12, 11, NULL, 215, '2018-01-09 06:53:58', '2018-01-09 06:53:58'),
(13, 12, NULL, 215, '2018-01-09 09:37:02', '2018-01-09 09:37:02'),
(14, 13, NULL, 215, '2018-01-09 11:43:01', '2018-01-09 11:43:01'),
(15, 3, NULL, 215, '2018-01-11 13:05:44', '2018-01-11 13:05:44'),
(16, 5, NULL, 215, '2018-01-12 13:28:46', '2018-01-12 13:28:46'),
(17, 2, NULL, 215, '2018-01-12 13:29:46', '2018-01-12 13:29:46'),
(18, 14, NULL, 215, '2018-01-15 05:27:13', '2018-01-15 05:27:13'),
(19, 15, NULL, 215, '2018-01-15 05:39:38', '2018-01-15 05:39:38'),
(20, 16, NULL, 215, '2018-01-15 05:55:30', '2018-01-15 05:55:30'),
(21, 17, NULL, 215, '2018-01-15 05:57:54', '2018-01-15 05:57:54'),
(22, 18, NULL, 215, '2018-01-15 06:01:41', '2018-01-15 06:01:41'),
(23, 19, NULL, 215, '2018-01-15 06:04:24', '2018-01-15 06:04:24'),
(24, 20, NULL, 215, '2018-01-15 06:06:50', '2018-01-15 06:06:50'),
(25, 21, NULL, 215, '2018-01-15 06:19:09', '2018-01-15 06:19:09'),
(26, 22, NULL, 215, '2018-01-25 09:40:24', '2018-01-25 09:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `hp_voucher_categories_map`
--

CREATE TABLE `hp_voucher_categories_map` (
  `id` bigint(100) NOT NULL,
  `voucher_id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_voucher_categories_map`
--

INSERT INTO `hp_voucher_categories_map` (`id`, `voucher_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 2, 3, '2018-01-04 09:22:51', '2018-01-04 09:22:51'),
(3, 3, 2, '2018-01-04 09:44:35', '2018-01-04 09:44:35'),
(4, 4, 3, '2018-01-04 12:26:29', '2018-01-04 12:26:29'),
(5, 5, 3, '2018-01-05 07:04:26', '2018-01-05 07:04:26'),
(7, 6, 2, '2018-01-05 07:56:26', '2018-01-05 07:56:26'),
(8, 7, 2, '2018-01-08 11:30:31', '2018-01-08 11:30:31'),
(9, 8, 2, '2018-01-08 11:37:51', '2018-01-08 11:37:51'),
(10, 9, 2, '2018-01-08 11:44:35', '2018-01-08 11:44:35'),
(11, 10, 2, '2018-01-08 11:51:20', '2018-01-08 11:51:20'),
(12, 11, 1, '2018-01-09 06:53:58', '2018-01-09 06:53:58'),
(13, 13, 1, '2018-01-09 11:43:01', '2018-01-09 11:43:01'),
(14, 14, 2, '2018-01-15 05:27:13', '2018-01-15 05:27:13'),
(15, 15, 2, '2018-01-15 05:39:38', '2018-01-15 05:39:38'),
(16, 16, 1, '2018-01-15 05:55:30', '2018-01-15 05:55:30'),
(17, 17, 1, '2018-01-15 05:57:54', '2018-01-15 05:57:54'),
(18, 18, 1, '2018-01-15 06:01:41', '2018-01-15 06:01:41'),
(19, 19, 1, '2018-01-15 06:04:24', '2018-01-15 06:04:24'),
(20, 20, 1, '2018-01-15 06:06:50', '2018-01-15 06:06:50'),
(21, 21, 2, '2018-01-15 06:19:09', '2018-01-15 06:19:09'),
(22, 12, 0, '2018-01-15 06:23:16', '2018-01-15 06:23:16'),
(23, 22, 0, '2018-01-25 09:40:40', '2018-01-25 09:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `hp_voucher_companies_map`
--

CREATE TABLE `hp_voucher_companies_map` (
  `id` bigint(100) NOT NULL,
  `voucher_id` int(100) NOT NULL,
  `corporate_id` int(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hp_voucher_companies_map`
--

INSERT INTO `hp_voucher_companies_map` (`id`, `voucher_id`, `corporate_id`, `created_at`, `updated_at`) VALUES
(5, 5, 2, '2018-01-05 07:04:26', '2018-01-05 07:04:26'),
(38, 15, 0, '2018-01-15 09:12:08', '2018-01-15 09:12:08'),
(40, 12, 0, '2018-01-15 09:12:36', '2018-01-15 09:12:36'),
(41, 11, 0, '2018-01-15 09:12:56', '2018-01-15 09:12:56'),
(42, 6, 0, '2018-01-15 09:13:37', '2018-01-15 09:13:37'),
(44, 18, 0, '2018-01-15 10:09:56', '2018-01-15 10:09:56'),
(45, 21, 0, '2018-01-25 09:08:41', '2018-01-25 09:08:41');

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
(1, '2017_10_17_074741_entrust_setup_tables', 1),
(2, '2017_10_17_095957_entrust_setup_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('girish.technopro@gmail.com', '$2y$10$z4xnLEsyfbzFMNMzlRLTsOcUg2Zx/zGENiODuuzTMafeS3Q0x4/iK', '2017-11-16 06:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'all-users', 'Can See All Users', 'Can see the listing of all users', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(2, 'create-user', 'Can Create Users', 'Can create admin users', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(3, 'edit-user', 'Can Update Users', 'Can update admin user records', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(4, 'all-vendors', 'Can See All Vendors', 'Can see the list of vendors', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(5, 'create-vendor', 'Can Create Vendors', 'Can Create Vendors', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(6, 'edit-vendor', 'Can Update Vendors', 'Can update vendors', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(7, 'all-corporates', 'Can See All Corporates', 'Can See All Corporates', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(8, 'create-corporate', 'Can Create Corporates', 'Can Create Corporates', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(9, 'edit-corporate', 'Can Update Corporates', 'Can update Corporates', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(10, 'all-vouchers', 'Can See All Vouchers', 'Can See All Vouchers', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(11, 'create-voucher', 'Can Create Vouchers', 'Can Create Vouchers', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(12, 'edit-voucher', 'Can Update Vouchers', 'Can update Vouchers', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(13, 'view-customer', 'Can See One Customers', 'Can See One Customers', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(14, 'all-customers', 'Can See All Customers', 'Can See All Customers', '2017-11-01 18:30:00', '2017-11-01 18:30:00'),
(15, 'all-hotels', 'Can see all hotels', 'Can see all hotels', '2017-12-25 18:30:00', '2017-12-25 18:30:00'),
(16, 'create-hotels', 'Can create hotels', 'Can create hotels', '2017-12-25 18:30:00', '2017-12-25 18:30:00'),
(17, 'edit-hotels', 'Can edit hotels', 'Can edit hotels', '2017-12-25 18:30:00', '2017-12-25 18:30:00'),
(18, 'all-orders', 'Can see all orders', 'Can see all orders', '2017-12-25 18:30:00', '2017-12-25 18:30:00'),
(19, 'edit-orders', 'Can edit orders', 'Can edit orders', '2017-12-25 18:30:00', '2017-12-25 18:30:00'),
(20, 'all-enquiries', 'Can see all enquiries', 'Can see all enquiries', '2017-12-25 18:30:00', '2017-12-25 18:30:00'),
(21, 'edit-enquiries', 'Can edit enquiries', 'Can edit enquiries', '2017-12-25 18:30:00', '2017-12-25 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin', '2017-10-16 18:30:00', '2017-10-16 18:30:00'),
(2, 'voucher-vendor', 'Vendor', 'vendor role', '2017-10-16 18:30:00', '2017-10-16 18:30:00'),
(3, 'employee', 'Employee of HP', 'employee', '2017-10-16 18:30:00', '2017-10-16 18:30:00'),
(4, 'hotel-vendor', 'Hotel Vendor', 'hotel vendor', '2017-12-26 00:00:00', '2017-12-26 00:00:00'),
(5, 'simple-product', 'simple product', 'simple-product', '2018-01-05 06:12:44', '2018-01-05 06:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(13, 1),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(25, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 3),
(35, 2),
(36, 1),
(37, 1),
(38, 1),
(39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 > disable, 1 > enable',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Girishg', 'admin@admin.com', '$2y$10$m83mTq3eJex5adBGjhtmWOVoYhYCtyJU3mXpH3P4BzKp2tM0Iv9ke', 1, 'BoX1r0Fum7jyOzaAwDK8gh5PmbMToyCzpsjyuh8ALdTVWZegFCnQoioQ81Cv', '2017-10-28 05:21:15', '2017-12-05 08:50:02'),
(18, 'HCS', 'hcs@gmail.com', '$2y$10$CH.Zn3LQdgRiieISs7/dWuqqXJlHTvPnXdebrwSRFNf2IjhaHNbWC', 1, 'yj2A03ZgRNaKSmO4C8LU7pW79yA5OsyEWEJLSshoQnxlMEuCnIWWP2BaaMTs', '2018-01-04 09:14:32', '2018-01-04 09:14:32'),
(19, 'PAYTM', 'paytm@gmail.com', '$2y$10$yAytIqlCUumtRi2TYcypCe.qpL7Ettk2lPLljxh63ORjBSHDNJcw6', 1, 'HRRSIODN1vXIqfPBCxOBcwC3fq3uxnJ3NgsvNb4qQrlDSTyt2ANCkwSByi4S', '2018-01-04 12:08:00', '2018-01-04 12:08:00'),
(20, 'Vendor One', 'vendor@gmail.com', '$2y$10$rVWzc0qekTL7LSJbAnaOQey/I6MfZrvIedqTgMO8JQerDu5arL9Ki', 1, 'G6vEynMuG864jgZ9pZiTyiV2fHcN2vgNCfikFBpXn0Uir7iX7ttXuKCmjFG5', '2018-01-05 06:22:17', '2018-01-05 06:22:17'),
(21, 'vendor dummy', 'vendordummy@gmail.com', '$2y$10$KtQObATafDwqb/wSMg.WVOA0567xefnydL0/305q6QN821DdjZZBC', 1, 'oeTsahkPgfU6fkoNK3x0eS9tcPOHXyN8kaB8KjNpjAw3Wj28VZ5V5YgaTRLG', '2018-01-05 06:57:03', '2018-01-05 06:57:03'),
(25, 'first@gmail.com', 'first@gmail.com', '$2y$10$unccfkg.zWStKrsbkuYm/.Y/zuBSojKqVXl8k1AYpblfFHG5NV6W6', 1, 'UZfM2D0T18plT7CTRUAMRQUdQG3jto0VCJROvECvQdXpGF5H0CsRsk6xsn1c', '2018-01-12 09:10:36', '2018-01-12 09:10:36'),
(31, 'vendorone', 'vendorone@happyperks.com', '$2y$10$SAX1sUQEe1Lzrj6RQ5yVD.rC3dDj2PBuwex/tLcwzgmv2t5RZpdlq', 1, 'jyj6SyX3wG5xP76OlJPl2xjjbGxSDaICSr2uVJgevrzWbVaXphPqVVvYM7yV', '2018-01-15 06:13:10', '2018-01-15 06:13:10'),
(32, 'vendortwo', 'vendortwo@happyperks.com', '$2y$10$MmnphOzDiuydhycJ3VoU6.WmywONiLjFK4WOhZolQEd.dq9jqizlW', 1, 'fLAU0s4h0mDsp9TarqlynR3tNItTGjrQhNeTYb3FrncoM2NXXhLNGp83xylW', '2018-01-15 06:17:36', '2018-01-15 06:17:36'),
(33, 'vendorthree', 'vendorthree@happyperks.com', '$2y$10$agoYwyVHPNC43HZ.EZhn6.WRaZOccvnywopPeWGojalYncVfqLgwu', 1, '6MYCzBpgWQeaF7po3RNDDzskOhpMnTg41DPMIIzLRHG35COzVTFVpfXk3D8O', '2018-01-15 10:17:58', '2018-01-15 10:17:58'),
(34, 'user1', 'user@email.com', '$2y$10$hNz73gDSd2C.4GNy4EoI5uTsmIRsehcyoagi1RYj38ACTIvwBYHAG', 1, 'k0WDiP3onaOwxYemnULskmbR9rxJviGmTgf9DbJNILztVtsZYXBcVXzo3IzS', '2018-01-17 09:30:25', '2018-01-17 09:30:25'),
(35, 'a', 'a@b.com', '$2y$10$1uxWncG7QSRyUn/GEtim2ec7ofYumKSWjzuGsqZbS75yBAZ29K7De', 1, NULL, '2018-01-25 09:21:23', '2018-01-25 09:21:23'),
(36, 'kalesha shaik', 'kalesha.sk@happyperks.com', '$2y$10$xXIQvsvMZoo3Yp1rvTdVxO/KoaHLGWelNgpS8Js8XC9wduE1wZXZS', 1, 'Wr5ukwgLLQrbF3fssDayAj41vHzUj1Drix8mFVj0ztpJACFiLqghcFWVdspa', '2018-01-27 05:14:22', '2018-01-27 05:14:22'),
(37, 'Atul Thakkar', 'atul.t@happyperks.com', '$2y$10$wlHIQQ4YPqB0jsAul5TIN.rx/2mYjfm0cLvW6njoq73r3E1GSRzZS', 1, 'e55uXfyIBhlLRpgVbpMQuvLbYlS5u47y5kZU3UrrKwSeA4EId1XDiWM2CWvj', '2018-01-27 05:15:08', '2018-01-27 05:15:08'),
(38, 'Charkadhar Reddy', 'chakradhar.r@happyperks.com', '$2y$10$nrSTnpXmqYRKfp/Ks/KLTufEcub7zT6nDEH9Q4ukEYVXl1ajpcS8i', 1, 'Q7a3AQtWi24A7QmWtoIaIj4K7ANy9qduo784ljRBIRFJwD7d2YD4dy8DJdOp', '2018-01-27 05:16:24', '2018-01-27 05:16:24'),
(39, 'Girish G', 'girish.technopro@gmail.com', '$2y$10$g9nZnE62kwgd9l/H0i6DfujRrX4x5UkdNNTvihW73r8m3gWtDh9Hy', 1, NULL, '2018-01-27 05:19:13', '2018-01-27 05:19:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `hp_activity_log`
--
ALTER TABLE `hp_activity_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `hp_announcements`
--
ALTER TABLE `hp_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_available_locations`
--
ALTER TABLE `hp_available_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `hp_awards`
--
ALTER TABLE `hp_awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_badges`
--
ALTER TABLE `hp_badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_banners`
--
ALTER TABLE `hp_banners`
  ADD PRIMARY KEY (`banners_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hp_brands`
--
ALTER TABLE `hp_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `hp_brands_redeem_locations`
--
ALTER TABLE `hp_brands_redeem_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_id` (`brand_id`);

--
-- Indexes for table `hp_cart`
--
ALTER TABLE `hp_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `hp_categories`
--
ALTER TABLE `hp_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_city`
--
ALTER TABLE `hp_city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `hp_contact_us`
--
ALTER TABLE `hp_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_corporate`
--
ALTER TABLE `hp_corporate`
  ADD PRIMARY KEY (`corporate_id`);

--
-- Indexes for table `hp_corporate_bank_details`
--
ALTER TABLE `hp_corporate_bank_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_id` (`corporate_id`);

--
-- Indexes for table `hp_corporate_cashback_rules`
--
ALTER TABLE `hp_corporate_cashback_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_id` (`corporate_id`);

--
-- Indexes for table `hp_corporate_designations_map`
--
ALTER TABLE `hp_corporate_designations_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_id` (`corporate_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `hp_corporate_locations`
--
ALTER TABLE `hp_corporate_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_corporate_transactions`
--
ALTER TABLE `hp_corporate_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_id` (`corporate_id`);

--
-- Indexes for table `hp_corp_escrow_account`
--
ALTER TABLE `hp_corp_escrow_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corporate_id` (`corporate_id`);

--
-- Indexes for table `hp_departments`
--
ALTER TABLE `hp_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_designations`
--
ALTER TABLE `hp_designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_email_templates`
--
ALTER TABLE `hp_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_employee`
--
ALTER TABLE `hp_employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `corporate_id` (`corporate_id`),
  ADD KEY `fk_hp_designation_id_idx` (`designation_id`),
  ADD KEY `fk_hp_department_idx` (`department_id`);

--
-- Indexes for table `hp_employee_address`
--
ALTER TABLE `hp_employee_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hp_employee_cashbacks`
--
ALTER TABLE `hp_employee_cashbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_employee_transactions`
--
ALTER TABLE `hp_employee_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `hp_hotels`
--
ALTER TABLE `hp_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_hotel_packages`
--
ALTER TABLE `hp_hotel_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `fk_hotel_id` (`hotel_id`);

--
-- Indexes for table `hp_hotel_package_vouchers`
--
ALTER TABLE `hp_hotel_package_vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hotel_package_id` (`hotel_package_id`);

--
-- Indexes for table `hp_logged_user_cookie`
--
ALTER TABLE `hp_logged_user_cookie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cookie_id` (`cookie_id`);

--
-- Indexes for table `hp_master_products`
--
ALTER TABLE `hp_master_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hotel_id` (`hotel_package_id`),
  ADD KEY `fk_voucher_id` (`voucher_id`);

--
-- Indexes for table `hp_master_settings`
--
ALTER TABLE `hp_master_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_master_user`
--
ALTER TABLE `hp_master_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `hp_order`
--
ALTER TABLE `hp_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `hp_order_comments`
--
ALTER TABLE `hp_order_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Indexes for table `hp_order_old`
--
ALTER TABLE `hp_order_old`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `hp_order_products_map`
--
ALTER TABLE `hp_order_products_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `hp_order_recharge`
--
ALTER TABLE `hp_order_recharge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `hp_order_voucher_coupon_map`
--
ALTER TABLE `hp_order_voucher_coupon_map`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `hp_vouchers_couponcodes_fk` (`voucher_coupon_id`);

--
-- Indexes for table `hp_order_voucher_hotel_purchased_map`
--
ALTER TABLE `hp_order_voucher_hotel_purchased_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_coupon_id` (`voucher_coupon_id`),
  ADD KEY `hotel_package_id` (`hotel_package_id`);

--
-- Indexes for table `hp_request_comment`
--
ALTER TABLE `hp_request_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `hp_request_module`
--
ALTER TABLE `hp_request_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hp_roles`
--
ALTER TABLE `hp_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `hp_send_token`
--
ALTER TABLE `hp_send_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_slider_banners`
--
ALTER TABLE `hp_slider_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_state`
--
ALTER TABLE `hp_state`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `state1_id` (`state_id`);

--
-- Indexes for table `hp_survey_contest`
--
ALTER TABLE `hp_survey_contest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_transaction_types`
--
ALTER TABLE `hp_transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_user_session_log`
--
ALTER TABLE `hp_user_session_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_vendors`
--
ALTER TABLE `hp_vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hp_vendors_brands_map`
--
ALTER TABLE `hp_vendors_brands_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `hp_vendors_redeem_locations`
--
ALTER TABLE `hp_vendors_redeem_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_id` (`vendor_id`);

--
-- Indexes for table `hp_vouchers`
--
ALTER TABLE `hp_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_vouchers_couponcodes`
--
ALTER TABLE `hp_vouchers_couponcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hp_vouchers_couponcodes_ibfk_1` (`voucher_id`);

--
-- Indexes for table `hp_voucher_available_locations_map`
--
ALTER TABLE `hp_voucher_available_locations_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frk_hotel_package_id` (`hotel_package_id`);

--
-- Indexes for table `hp_voucher_categories_map`
--
ALTER TABLE `hp_voucher_categories_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hp_voucher_companies_map`
--
ALTER TABLE `hp_voucher_companies_map`
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
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hp_activity_log`
--
ALTER TABLE `hp_activity_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hp_announcements`
--
ALTER TABLE `hp_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hp_available_locations`
--
ALTER TABLE `hp_available_locations`
  MODIFY `id` mediumint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hp_awards`
--
ALTER TABLE `hp_awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hp_badges`
--
ALTER TABLE `hp_badges`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hp_banners`
--
ALTER TABLE `hp_banners`
  MODIFY `banners_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_brands`
--
ALTER TABLE `hp_brands`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hp_brands_redeem_locations`
--
ALTER TABLE `hp_brands_redeem_locations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hp_cart`
--
ALTER TABLE `hp_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_categories`
--
ALTER TABLE `hp_categories`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hp_city`
--
ALTER TABLE `hp_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1484;

--
-- AUTO_INCREMENT for table `hp_contact_us`
--
ALTER TABLE `hp_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_corporate`
--
ALTER TABLE `hp_corporate`
  MODIFY `corporate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hp_corporate_bank_details`
--
ALTER TABLE `hp_corporate_bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_corporate_cashback_rules`
--
ALTER TABLE `hp_corporate_cashback_rules`
  MODIFY `id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_corporate_designations_map`
--
ALTER TABLE `hp_corporate_designations_map`
  MODIFY `id` bigint(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_corporate_locations`
--
ALTER TABLE `hp_corporate_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `hp_corporate_transactions`
--
ALTER TABLE `hp_corporate_transactions`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_corp_escrow_account`
--
ALTER TABLE `hp_corp_escrow_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_departments`
--
ALTER TABLE `hp_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hp_designations`
--
ALTER TABLE `hp_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_email_templates`
--
ALTER TABLE `hp_email_templates`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_employee`
--
ALTER TABLE `hp_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hp_employee_address`
--
ALTER TABLE `hp_employee_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_employee_cashbacks`
--
ALTER TABLE `hp_employee_cashbacks`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_employee_transactions`
--
ALTER TABLE `hp_employee_transactions`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hp_hotels`
--
ALTER TABLE `hp_hotels`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_hotel_packages`
--
ALTER TABLE `hp_hotel_packages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_hotel_package_vouchers`
--
ALTER TABLE `hp_hotel_package_vouchers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_logged_user_cookie`
--
ALTER TABLE `hp_logged_user_cookie`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_master_products`
--
ALTER TABLE `hp_master_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hp_master_settings`
--
ALTER TABLE `hp_master_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=945;

--
-- AUTO_INCREMENT for table `hp_master_user`
--
ALTER TABLE `hp_master_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=970;

--
-- AUTO_INCREMENT for table `hp_order`
--
ALTER TABLE `hp_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_order_comments`
--
ALTER TABLE `hp_order_comments`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_order_old`
--
ALTER TABLE `hp_order_old`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_order_products_map`
--
ALTER TABLE `hp_order_products_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_order_recharge`
--
ALTER TABLE `hp_order_recharge`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_order_voucher_coupon_map`
--
ALTER TABLE `hp_order_voucher_coupon_map`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hp_order_voucher_hotel_purchased_map`
--
ALTER TABLE `hp_order_voucher_hotel_purchased_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_request_comment`
--
ALTER TABLE `hp_request_comment`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_request_module`
--
ALTER TABLE `hp_request_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_roles`
--
ALTER TABLE `hp_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_send_token`
--
ALTER TABLE `hp_send_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_slider_banners`
--
ALTER TABLE `hp_slider_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hp_state`
--
ALTER TABLE `hp_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `hp_survey_contest`
--
ALTER TABLE `hp_survey_contest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_transaction_types`
--
ALTER TABLE `hp_transaction_types`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hp_user_session_log`
--
ALTER TABLE `hp_user_session_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hp_vendors`
--
ALTER TABLE `hp_vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `hp_vendors_brands_map`
--
ALTER TABLE `hp_vendors_brands_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hp_vendors_redeem_locations`
--
ALTER TABLE `hp_vendors_redeem_locations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `hp_vouchers`
--
ALTER TABLE `hp_vouchers`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `hp_vouchers_couponcodes`
--
ALTER TABLE `hp_vouchers_couponcodes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `hp_voucher_available_locations_map`
--
ALTER TABLE `hp_voucher_available_locations_map`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hp_voucher_categories_map`
--
ALTER TABLE `hp_voucher_categories_map`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `hp_voucher_companies_map`
--
ALTER TABLE `hp_voucher_companies_map`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hp_available_locations`
--
ALTER TABLE `hp_available_locations`
  ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `hp_city` (`city_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_brands`
--
ALTER TABLE `hp_brands`
  ADD CONSTRAINT `fk_brand_category_id` FOREIGN KEY (`category_id`) REFERENCES `hp_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hp_brands_redeem_locations`
--
ALTER TABLE `hp_brands_redeem_locations`
  ADD CONSTRAINT `fk_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `hp_brands` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_corporate_bank_details`
--
ALTER TABLE `hp_corporate_bank_details`
  ADD CONSTRAINT `fk_bank_details_id` FOREIGN KEY (`corporate_id`) REFERENCES `hp_corporate` (`corporate_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_corporate_cashback_rules`
--
ALTER TABLE `hp_corporate_cashback_rules`
  ADD CONSTRAINT `fk_corporate_id` FOREIGN KEY (`corporate_id`) REFERENCES `hp_corporate` (`corporate_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_corp_escrow_account`
--
ALTER TABLE `hp_corp_escrow_account`
  ADD CONSTRAINT `hp_corp_escrow_account_ibfk_1` FOREIGN KEY (`corporate_id`) REFERENCES `hp_corporate` (`corporate_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_employee`
--
ALTER TABLE `hp_employee`
  ADD CONSTRAINT `fk_hp_corporate_id` FOREIGN KEY (`corporate_id`) REFERENCES `hp_corporate` (`corporate_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hp_department_id` FOREIGN KEY (`department_id`) REFERENCES `hp_departments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hp_designation_id` FOREIGN KEY (`designation_id`) REFERENCES `hp_designations` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hp_user_id` FOREIGN KEY (`user_id`) REFERENCES `hp_master_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_hotel_packages`
--
ALTER TABLE `hp_hotel_packages`
  ADD CONSTRAINT `fk_hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hp_hotels` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_hotel_package_vouchers`
--
ALTER TABLE `hp_hotel_package_vouchers`
  ADD CONSTRAINT `fk_hotel_package_id` FOREIGN KEY (`hotel_package_id`) REFERENCES `hp_hotel_packages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_master_products`
--
ALTER TABLE `hp_master_products`
  ADD CONSTRAINT `fk_package_id` FOREIGN KEY (`hotel_package_id`) REFERENCES `hp_hotel_packages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_voucher_id` FOREIGN KEY (`voucher_id`) REFERENCES `hp_vouchers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_order_comments`
--
ALTER TABLE `hp_order_comments`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `hp_order` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_order_products_map`
--
ALTER TABLE `hp_order_products_map`
  ADD CONSTRAINT `fk_order_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `hp_vendors` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_order_recharge`
--
ALTER TABLE `hp_order_recharge`
  ADD CONSTRAINT `fk_ordr_id` FOREIGN KEY (`order_id`) REFERENCES `hp_order` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_order_voucher_coupon_map`
--
ALTER TABLE `hp_order_voucher_coupon_map`
  ADD CONSTRAINT `hp_order_voucher_coupon_fk` FOREIGN KEY (`order_id`) REFERENCES `hp_order` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hp_vouchers_couponcodes_fk` FOREIGN KEY (`voucher_coupon_id`) REFERENCES `hp_vouchers_couponcodes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_request_comment`
--
ALTER TABLE `hp_request_comment`
  ADD CONSTRAINT `fk_request_id` FOREIGN KEY (`request_id`) REFERENCES `hp_request_module` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_request_module`
--
ALTER TABLE `hp_request_module`
  ADD CONSTRAINT `fk_request_user_id` FOREIGN KEY (`user_id`) REFERENCES `hp_master_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_vendors`
--
ALTER TABLE `hp_vendors`
  ADD CONSTRAINT `fk_vendor_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `hp_vouchers_couponcodes`
--
ALTER TABLE `hp_vouchers_couponcodes`
  ADD CONSTRAINT `hp_vouchers_couponcodes_ibfk_1` FOREIGN KEY (`voucher_id`) REFERENCES `hp_vouchers` (`id`);

--
-- Constraints for table `hp_voucher_available_locations_map`
--
ALTER TABLE `hp_voucher_available_locations_map`
  ADD CONSTRAINT `frk_hotel_package_id` FOREIGN KEY (`hotel_package_id`) REFERENCES `hp_hotel_packages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
