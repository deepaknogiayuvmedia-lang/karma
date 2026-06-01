-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2026 at 05:43 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u661149129_cropshopindia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `admin_role_id` bigint(20) NOT NULL DEFAULT 2,
  `image` varchar(30) NOT NULL DEFAULT 'def.png',
  `email` varchar(80) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(80) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `tally_sync` tinyint(4) NOT NULL DEFAULT 0,
  `wherehouse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `phone`, `admin_role_id`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `tally_sync`, `wherehouse`) VALUES
(1, 'Admin', '8058164478', 1, '2026-01-17-696b17208e360.png', 'admin@gmail.com', NULL, '$2y$12$8dSLdz2cX.aOp4wWjtz1MOjkpgeTeh8QD6Qa4wghm66Kw360LtCKu', 'VYn85b6SAeCKRk2TWRohaH7r1usqQ58ABLfAGPZdTR48dKALtHJctWVDEO25', '2023-03-21 11:48:51', '2026-05-15 15:36:32', 1, 0, '{\"address_line1\":\"1\\/244, huose\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"phone\":\"7877011230\",\"country\":\"India\"}'),
(2, 'test', '6544984967', 7, '2025-11-25-69254132ac511.png', 'true@gmail.com', NULL, '$2y$12$8dSLdz2cX.aOp4wWjtz1MOjkpgeTeh8QD6Qa4wghm66Kw360LtCKu', 'b4jMCS0YFTmSsQtdrEEpiRV1Q0MoLg294UmyfG3UAOAJMuJzimstbpgmu5nb', '2025-11-25 06:10:02', '2025-11-25 06:10:02', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `module_access` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `module_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', NULL, 1, NULL, NULL),
(7, 'test', '[\"product_management\",\"support_section\"]', 1, '2025-11-25 06:09:05', '2025-11-28 06:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallets`
--

CREATE TABLE `admin_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `inhouse_earning` double NOT NULL DEFAULT 0,
  `withdrawn` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission_earned` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_charge_earned` double(8,2) NOT NULL DEFAULT 0.00,
  `pending_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `total_tax_collected` double(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_wallets`
--

INSERT INTO `admin_wallets` (`id`, `admin_id`, `inhouse_earning`, `withdrawn`, `created_at`, `updated_at`, `commission_earned`, `delivery_charge_earned`, `pending_amount`, `total_tax_collected`) VALUES
(1, 1, 270166.68, 0, NULL, '2026-03-17 04:16:25', 0.00, 30.00, 0.00, 29859.30),
(2, 1, 0, 0, '2023-03-21 11:48:51', '2023-03-21 11:48:51', 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallet_histories`
--

CREATE TABLE `admin_wallet_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `order_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `payment` varchar(191) NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'gms', '2026-01-19 04:57:49', '2026-01-19 04:57:49'),
(4, 'Weight', '2026-01-19 04:57:55', '2026-01-19 06:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `banner_type` varchar(255) NOT NULL,
  `published` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `resource_type` varchar(191) DEFAULT NULL,
  `resource_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `photo`, `banner_type`, `published`, `created_at`, `updated_at`, `url`, `resource_type`, `resource_id`) VALUES
(10, '2026-01-17-696b179fe2e1a.png', 'Main Banner', 1, '2026-01-15 23:48:13', '2026-05-20 17:04:46', 'https://cropshopindia.com/products?id=20&data_from=category&page=1', 'product', 103),
(12, '2026-01-17-696b1781c8590.png', 'Main Banner', 1, '2026-01-15 23:50:03', '2026-05-20 17:04:14', 'https://cropshopindia.com/products?id=19&data_from=category&page=1', 'product', 103),
(13, '2026-01-17-696b17609ca26.png', 'Main Banner', 1, '2026-01-15 23:50:31', '2026-05-20 17:03:25', 'https://cropshopindia.com/products?id=17&data_from=category&page=1', 'product', 103),
(14, '2026-01-22-6972047259e9d.png', 'Footer Banner', 1, '2026-01-20 01:53:57', '2026-01-22 05:35:22', '#', 'product', 50),
(15, '2026-01-20-696f32ff68fd0.png', 'Popup Banner', 1, '2026-01-20 02:17:11', '2026-01-20 02:17:15', '#', 'shop', 3),
(16, '2026-01-22-6972049a1aa7c.png', 'Footer Banner', 1, '2026-01-22 05:36:02', '2026-01-22 05:36:07', '#', 'product', 54),
(17, '2026-01-22-697204b45c132.png', 'Footer Banner', 1, '2026-01-22 05:36:28', '2026-01-22 05:36:32', '#', 'product', 50),
(18, '2026-01-22-697204c7cb627.png', 'Footer Banner', 1, '2026-01-22 05:36:47', '2026-01-22 05:37:04', '#', 'product', 54);

-- --------------------------------------------------------

--
-- Table structure for table `biddings`
--

CREATE TABLE `biddings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `product_id` varchar(191) DEFAULT NULL,
  `product_name` varchar(191) DEFAULT NULL,
  `product_qty` varchar(191) DEFAULT NULL,
  `product_bit` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `bedders` varchar(191) DEFAULT NULL,
  `vendor_invoice` varchar(255) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_addresses`
--

CREATE TABLE `billing_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_person_name` varchar(191) DEFAULT NULL,
  `address_type` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `zip` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'def.png',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Growth Promoters', '2026-01-16-696a301aa4473.png', 1, '2023-03-21 13:06:20', '2026-01-16 07:03:30'),
(2, 'Herbicides', '2026-01-16-696a3041505f4.png', 1, '2025-11-25 05:53:02', '2026-01-16 07:04:09'),
(3, 'Fungicides', '2026-01-16-696a30660f5a6.png', 1, '2026-01-16 06:21:00', '2026-01-16 07:04:46'),
(4, 'Insecticides', '2026-01-16-696a308d3e354.png', 1, '2026-01-16 06:21:42', '2026-01-16 07:05:25'),
(5, 'Nutrients', '2026-01-16-696a30ab83116.png', 1, '2026-01-16 06:22:09', '2026-01-16 07:05:55'),
(6, 'UPl', '2026-01-22-6971c151f1ede.png', 1, '2026-01-22 00:48:58', '2026-01-22 00:48:58'),
(7, 'emmbi', '2026-01-22-6971c891b33b0.png', 1, '2026-01-22 01:19:53', '2026-01-22 01:19:53'),
(8, 'Kaveri seeds', '2026-01-22-6971c8b7c4d53.png', 1, '2026-01-22 01:20:31', '2026-01-22 01:20:31'),
(9, 'Gaia gen', '2026-01-22-6971c8ef0f6f6.png', 1, '2026-01-22 01:21:27', '2026-01-22 01:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'system_default_currency', '3', '2020-10-11 02:13:44', '2025-11-25 04:16:43'),
(2, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true},{\"id\":2,\"name\":\"Hindi\",\"direction\":\"ltr\",\"code\":\"in\",\"status\":1,\"default\":false}]', '2020-10-11 02:23:02', '2026-03-17 02:11:38'),
(3, 'mail_config', '{\"status\":\"1\",\"name\":\"smtp\",\"host\":\"smtp.hostinger.com\",\"driver\":\"smtp\",\"port\":\"587\",\"username\":\"info@cropshopindia.com\",\"email_id\":\"info@cropshopindia.com\",\"encryption\":\"TLS\",\"password\":\"uw@=7cO0#\"}', '2020-10-12 04:59:18', '2026-04-01 10:34:42'),
(4, 'cash_on_delivery', '{\"status\":\"1\"}', NULL, '2021-05-25 15:51:15'),
(6, 'ssl_commerz_payment', '{\"status\":null,\"environment\":null,\"store_id\":null,\"store_password\":null}', '2020-11-09 03:06:51', '2026-02-10 00:49:42'),
(7, 'paypal', '{\"status\":\"0\",\"environment\":\"sandbox\",\"paypal_client_id\":\"\",\"paypal_secret\":\"\"}', '2020-11-09 03:21:39', '2023-01-10 00:21:56'),
(8, 'stripe', '{\"status\":\"0\",\"api_key\":null,\"published_key\":null}', '2020-11-09 03:31:47', '2021-07-06 07:00:05'),
(10, 'company_phone', '6283444803', NULL, '2020-12-08 08:45:01'),
(11, 'company_name', 'Pro Kissan', NULL, '2021-02-27 12:41:53'),
(12, 'company_web_logo', '2026-01-21-6970dcf8cbb3a.png', NULL, '2026-01-21 08:34:40'),
(13, 'company_mobile_logo', '2026-05-16-6a081180a4705.png', NULL, '2026-05-16 12:11:04'),
(14, 'terms_condition', '<p>terms and conditions</p>', NULL, '2021-06-10 20:21:36'),
(15, 'about_us', '<p>About Us - FarmFresh Market<!-- HERO --></p>\r\n\r\n<h1>About FarmFresh Market</h1>\r\n\r\n<p>Connecting farmers, vendors, and customers through a trusted multi-vendor farming marketplace delivering fresh, organic, and quality farm products directly to homes and businesses.</p>\r\n<!-- ABOUT -->\r\n\r\n<p><img alt=\"\" src=\"https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&amp;w=1200&amp;auto=format&amp;fit=crop\" /></p>\r\n\r\n<p>Who We Are</p>\r\n\r\n<h2>Empowering Farmers Through Digital Agriculture</h2>\r\n\r\n<p>FarmFresh Market is a modern agriculture multi-vendor platform designed to help local farmers and agriculture businesses sell products online with ease and transparency.</p>\r\n\r\n<p>We believe fresh food should come directly from farms to customers while ensuring fair pricing, better profits for farmers, and healthier choices for families.</p>\r\n\r\n<p>Our platform supports organic vegetables, fruits, dairy products, grains, seeds, fertilizers, farming tools, and much more.</p>\r\n\r\n<p><a href=\"#\">Explore Marketplace</a></p>\r\n<!-- FEATURES -->\r\n\r\n<h2>Why Choose Us</h2>\r\n\r\n<p>We provide a trusted and technology-driven farming marketplace experience for both sellers and buyers.</p>\r\n\r\n<p>🌱</p>\r\n\r\n<h3>Fresh Products</h3>\r\n\r\n<p>Freshly harvested vegetables, fruits, and organic products directly from farms.</p>\r\n\r\n<p>🚜</p>\r\n\r\n<h3>Verified Farmers</h3>\r\n\r\n<p>Trusted and verified vendors ensuring quality agricultural products and services.</p>\r\n\r\n<p>📦</p>\r\n\r\n<h3>Fast Delivery</h3>\r\n\r\n<p>Secure and fast delivery system connecting farms directly to your doorstep.</p>\r\n\r\n<p>💚</p>\r\n\r\n<h3>Organic Focus</h3>\r\n\r\n<p>Promoting sustainable farming and healthy organic food for a better future.</p>\r\n<!-- STATS -->\r\n\r\n<h2>500+</h2>\r\n\r\n<p>Farm Vendors</p>\r\n\r\n<h2>10K+</h2>\r\n\r\n<p>Happy Customers</p>\r\n\r\n<h2>120+</h2>\r\n\r\n<p>Organic Products</p>\r\n\r\n<h2>24/7</h2>\r\n\r\n<p>Customer Support</p>\r\n<!-- TEAM -->\r\n\r\n<h2>Meet Our Team</h2>\r\n\r\n<p>Passionate people working together to transform the future of agriculture commerce.</p>\r\n\r\n<p><img alt=\"\" src=\"https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&amp;w=900&amp;auto=format&amp;fit=crop\" /></p>\r\n\r\n<h3>Rahul Sharma</h3>\r\n\r\n<p>Founder &amp; CEO</p>\r\n\r\n<p>Leading the mission to empower farmers through digital innovation and smart farming solutions.</p>\r\n\r\n<p><img alt=\"\" src=\"https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&amp;w=900&amp;auto=format&amp;fit=crop\" /></p>\r\n\r\n<h3>Anjali Verma</h3>\r\n\r\n<p>Operations Head</p>\r\n\r\n<p>Managing vendor operations and ensuring smooth customer experiences across the platform.</p>\r\n\r\n<p><img alt=\"\" src=\"https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&amp;w=900&amp;auto=format&amp;fit=crop\" /></p>\r\n\r\n<h3>Vikram Singh</h3>\r\n\r\n<p>Marketing Manager</p>\r\n\r\n<p>Building strong connections between local farms and customers through strategic marketing.</p>\r\n<!-- CTA -->\r\n\r\n<h2>Join Our Farming Community</h2>\r\n\r\n<p>Become a vendor, support local agriculture, and enjoy fresh farm products delivered directly to you.</p>\r\n\r\n<p><a href=\"#\">Become a Vendor</a></p>\r\n<!-- FOOTER -->\r\n\r\n<p>&copy; 2026 FarmFresh Market. All Rights Reserved.</p>', NULL, '2026-05-18 13:53:08'),
(16, 'sms_nexmo', '{\"status\":\"0\",\"nexmo_key\":\"custo5cc042f7abf4c\",\"nexmo_secret\":\"custo5cc042f7abf4c@ssl\"}', NULL, NULL),
(17, 'company_email', 'cropshopind@gmail.com', NULL, '2021-03-15 06:59:51'),
(18, 'colors', '{\"primary\":\"#00695c\",\"secondary\":\"#dc6d15\"}', '2020-10-11 08:23:02', '2026-05-20 15:48:08'),
(19, 'company_footer_logo', '2026-05-18-6a0af156ea79e.png', NULL, '2026-05-18 16:30:38'),
(20, 'company_copyright_text', 'All Rights Reserved by Crop Shop India ptd ltd.', NULL, '2021-03-15 07:00:47'),
(21, 'download_app_apple_stroe', '{\"status\":\"0\",\"link\":\"https:\\/\\/www.target.com\\/s\\/apple+store++now?ref=tgt_adv_XS000000&AFID=msn&fndsrc=tgtao&DFA=71700000012505188&CPNG=Electronics_Portable+Computers&adgroup=Portable+Computers&LID=700000001176246&LNM=apple+store+near+me+now&MT=b&network=s&device=c&location=12&targetid=kwd-81913773633608:loc-12&ds_rl=1246978&ds_rl=1248099&gclsrc=ds\"}', NULL, '2025-12-10 07:11:20'),
(22, 'download_app_google_stroe', '{\"status\":\"0\",\"link\":\"https:\\/\\/play.google.com\\/store?hl=en_US&gl=US\"}', NULL, '2025-12-10 07:11:14'),
(23, 'company_fav_icon', '2026-05-16-6a081180a5f24.png', '2020-10-11 08:23:02', '2026-05-16 12:11:04'),
(24, 'fcm_topic', '', NULL, NULL),
(25, 'fcm_project_id', 'multi-vendor-5d507', NULL, NULL),
(26, 'push_notification_key', 'BJs_58yzI8dDNoQpdmcAKYSuZ6-eJ1HK_a9jPwa9ElhPpmiei_OpgmbZWlA0ZSkYeRcPiEcvROlHsxVy3TZ5bl0', NULL, NULL),
(27, 'order_pending_message', '{\"status\":\"1\",\"message\":\"order pending message\"}', NULL, NULL),
(28, 'order_confirmation_msg', '{\"status\":\"1\",\"message\":\"Order confirmation Message\"}', NULL, NULL),
(29, 'order_processing_message', '{\"status\":\"1\",\"message\":\"Order processing Message\"}', NULL, NULL),
(30, 'out_for_delivery_message', '{\"status\":\"1\",\"message\":\"Order out for delivery Message\"}', NULL, NULL),
(31, 'order_delivered_message', '{\"status\":\"1\",\"message\":\"Order delvered Message\"}', NULL, NULL),
(32, 'razor_pay', '{\"status\":\"0\",\"razor_key\":null,\"razor_secret\":null}', NULL, '2021-07-06 07:00:14'),
(33, 'sales_commission', '0', NULL, '2021-06-11 12:43:13'),
(34, 'seller_registration', '1', NULL, '2021-06-04 15:32:48'),
(35, 'pnc_language', '[\"en\",\"in\"]', NULL, NULL),
(36, 'order_returned_message', '{\"status\":\"1\",\"message\":\"Order Returned Message\"}', NULL, NULL),
(37, 'order_failed_message', '{\"status\":null,\"message\":\"Order fa Message\"}', NULL, NULL),
(40, 'delivery_boy_assign_message', '{\"status\":0,\"message\":null}', NULL, NULL),
(41, 'delivery_boy_start_message', '{\"status\":0,\"message\":null}', NULL, NULL),
(42, 'delivery_boy_delivered_message', '{\"status\":0,\"message\":null}', NULL, NULL),
(43, 'terms_and_conditions', '', NULL, NULL),
(44, 'minimum_order_value', '1', NULL, NULL),
(45, 'privacy_policy', '  <!-- HERO SECTION -->\r\n\r\n  <section\r\n    style=\"\r\n      background:\r\n      linear-gradient(rgba(38,53,15,0.82),rgba(38,53,15,0.82)),\r\n      url(\'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=1400&auto=format&fit=crop\');\r\n      background-size:cover;\r\n      background-position:center;\r\n      padding:120px 20px;\r\n      text-align:center;\r\n      color:white;\r\n    \"\r\n  >\r\n\r\n    <div class=\"container\">\r\n\r\n      <h1\r\n        style=\"\r\n          font-size:60px;\r\n          font-weight:700;\r\n          margin-bottom:20px;\r\n        \"\r\n      >\r\n        Privacy Policy\r\n      </h1>\r\n\r\n      <p\r\n        style=\"\r\n          max-width:750px;\r\n          margin:auto;\r\n          font-size:18px;\r\n          line-height:1.8;\r\n        \"\r\n      >\r\n        Your privacy matters to Pro Kissan. Learn how we collect,\r\n        use, and protect your personal information on our farming\r\n        multi-vendor marketplace.\r\n      </p>\r\n\r\n    </div>\r\n\r\n  </section>\r\n\r\n  <!-- MAIN CONTENT -->\r\n\r\n  <section style=\"padding:80px 0;\">\r\n\r\n    <div class=\"container\">\r\n\r\n      <div\r\n        class=\"bg-white\"\r\n        style=\"\r\n          padding:60px;\r\n          border-radius:24px;\r\n          box-shadow:0 10px 30px rgba(0,0,0,0.06);\r\n        \"\r\n      >\r\n\r\n        <!-- INTRODUCTION -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Introduction\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n            margin-bottom:18px;\r\n          \"\r\n        >\r\n          Welcome to Pro Kissan. This Privacy Policy explains\r\n          how we collect, use, disclose, and safeguard your\r\n          information when you use our website and services.\r\n        </p>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n            margin-bottom:25px;\r\n          \"\r\n        >\r\n          By accessing or using our platform, you agree to\r\n          the practices described in this Privacy Policy.\r\n        </p>\r\n\r\n        <!-- HIGHLIGHT -->\r\n\r\n        <div\r\n          style=\"\r\n            background:rgba(230,126,34,0.08);\r\n            border-left:5px solid #E67E22;\r\n            padding:25px;\r\n            border-radius:14px;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n\r\n          <p\r\n            style=\"\r\n              margin:0;\r\n              color:#1f1f1f;\r\n              font-weight:500;\r\n            \"\r\n          >\r\n            We are committed to protecting your personal\r\n            data and ensuring a secure farming marketplace\r\n            experience.\r\n          </p>\r\n\r\n        </div>\r\n\r\n        <!-- INFORMATION -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Information We Collect\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n          \"\r\n        >\r\n          We may collect the following types of information:\r\n        </p>\r\n\r\n        <ul\r\n          style=\"\r\n            color:#666;\r\n            line-height:2;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n          <li>Full name and contact details</li>\r\n          <li>Email address and phone number</li>\r\n          <li>Shipping and billing addresses</li>\r\n          <li>Payment and transaction details</li>\r\n          <li>Vendor store information</li>\r\n          <li>Device information and IP address</li>\r\n          <li>Website usage and browsing activity</li>\r\n        </ul>\r\n\r\n        <!-- HOW WE USE -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          How We Use Your Information\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n          \"\r\n        >\r\n          We use collected information for various purposes,\r\n          including:\r\n        </p>\r\n\r\n        <ul\r\n          style=\"\r\n            color:#666;\r\n            line-height:2;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n          <li>Processing orders and transactions</li>\r\n          <li>Managing vendor and customer accounts</li>\r\n          <li>Providing customer support</li>\r\n          <li>Improving platform performance and security</li>\r\n          <li>Sending updates and promotional offers</li>\r\n          <li>Preventing fraud and unauthorized activities</li>\r\n        </ul>\r\n\r\n        <!-- COOKIES -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Cookies & Tracking Technologies\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n            margin-bottom:18px;\r\n          \"\r\n        >\r\n          Pro Kissan uses cookies and similar technologies\r\n          to improve user experience, analyze traffic,\r\n          and personalize content.\r\n        </p>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n          You can disable cookies through your browser\r\n          settings, but some platform features may not\r\n          function properly.\r\n        </p>\r\n\r\n        <!-- PAYMENT -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Payment Security\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n          We use secure payment gateways and industry-standard\r\n          encryption methods to protect your payment data.\r\n          However, no online system is completely secure,\r\n          and we cannot guarantee absolute security.\r\n        </p>\r\n\r\n        <!-- USER RIGHTS -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Your Rights\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n          \"\r\n        >\r\n          Depending on your region and applicable laws,\r\n          you may have the right to:\r\n        </p>\r\n\r\n        <ul\r\n          style=\"\r\n            color:#666;\r\n            line-height:2;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n          <li>Access your personal data</li>\r\n          <li>Request correction of inaccurate information</li>\r\n          <li>Delete your account and personal data</li>\r\n          <li>Withdraw marketing communication consent</li>\r\n          <li>Request data portability</li>\r\n        </ul>\r\n\r\n        <!-- POLICY UPDATE -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Policy Updates\r\n        </h2>\r\n\r\n        <p\r\n          style=\"\r\n            color:#666;\r\n            line-height:1.9;\r\n            margin-bottom:40px;\r\n          \"\r\n        >\r\n          We may update this Privacy Policy periodically.\r\n          Any changes will be posted on this page with\r\n          an updated revision date.\r\n        </p>\r\n\r\n        <!-- CONTACT -->\r\n\r\n        <h2\r\n          style=\"\r\n            color:#3D4F17;\r\n            font-weight:700;\r\n            margin-bottom:20px;\r\n          \"\r\n        >\r\n          Contact Us\r\n        </h2>\r\n\r\n        <div\r\n          style=\"\r\n            background:rgba(61,79,23,0.05);\r\n            padding:30px;\r\n            border-radius:18px;\r\n          \"\r\n        >\r\n\r\n          <h4\r\n            style=\"\r\n              color:#3D4F17;\r\n              font-weight:600;\r\n              margin-bottom:15px;\r\n            \"\r\n          >\r\n            Pro Kissan Support\r\n          </h4>\r\n\r\n          <p style=\"margin-bottom:10px; color:#666;\">\r\n            Email: support@prokissan.com\r\n          </p>\r\n\r\n          <p style=\"margin-bottom:10px; color:#666;\">\r\n            Phone: +91 98765 43210\r\n          </p>\r\n\r\n          <p style=\"margin-bottom:0; color:#666;\">\r\n            Address: Rajasthan, India\r\n          </p>\r\n\r\n        </div>\r\n\r\n      </div>\r\n\r\n    </div>\r\n\r\n  </section>', NULL, '2026-05-18 14:18:44'),
(46, 'paystack', '{\"status\":\"0\",\"publicKey\":null,\"secretKey\":null,\"paymentUrl\":\"https:\\/\\/api.paystack.co\",\"merchantEmail\":null}', NULL, '2021-07-06 07:00:35'),
(47, 'senang_pay', '{\"status\":\"0\",\"secret_key\":null,\"merchant_id\":null}', NULL, '2021-07-06 07:00:23'),
(48, 'currency_model', 'multi_currency', NULL, NULL),
(49, 'social_login', '[{\"login_medium\":\"google\",\"client_id\":\"593155222746-c81c28kifi9bq8fttok4ht5n2gmuaoh0.apps.googleusercontent.com\",\"client_secret\":\"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\",\"status\":\"1\"},{\"login_medium\":\"facebook\",\"client_id\":\"1589241935554288\",\"client_secret\":\"38ddfecb91ed97b82df0303e9261f0e8\",\"status\":null}]', NULL, '2026-04-01 11:50:00'),
(50, 'digital_payment', '{\"status\":\"1\"}', NULL, NULL),
(51, 'phone_verification', '0', NULL, NULL),
(52, 'email_verification', '1', NULL, NULL),
(53, 'order_verification', '1', NULL, NULL),
(54, 'country_code', 'IN', NULL, NULL),
(55, 'pagination_limit', '5', NULL, NULL),
(56, 'shipping_method', 'sellerwise_shipping', NULL, NULL),
(57, 'paymob_accept', '{\"status\":\"0\",\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\",\"hmac\":\"\"}', NULL, NULL),
(58, 'bkash', '{\"status\":\"0\",\"environment\":\"sandbox\",\"api_key\":\"\",\"api_secret\":\"\",\"username\":\"\",\"password\":\"\"}', NULL, '2023-01-10 00:21:56'),
(59, 'forgot_password_verification', 'email', NULL, NULL),
(60, 'paytabs', '{\"status\":0,\"profile_id\":\"\",\"server_key\":\"\",\"base_url\":\"https:\\/\\/secure-egypt.paytabs.com\\/\"}', NULL, '2021-11-20 21:31:40'),
(61, 'stock_limit', '10', NULL, NULL),
(62, 'flutterwave', '{\"status\":1,\"public_key\":\"\",\"secret_key\":\"\",\"hash\":\"\"}', NULL, NULL),
(63, 'mercadopago', '{\"status\":null,\"environment\":\"sandbox\",\"public_key\":null,\"access_token\":null}', NULL, '2026-02-10 00:40:40'),
(64, 'announcement', '{\"status\":\"0\",\"color\":\"#5a8b23\",\"text_color\":\"#79560c\",\"announcement\":\"50% OFF\"}', NULL, NULL),
(65, 'fawry_pay', '{\"status\":0,\"merchant_code\":\"\",\"security_key\":\"\"}', NULL, '2022-01-18 04:16:30'),
(66, 'recaptcha', '{\"status\":0,\"site_key\":\"\",\"secret_key\":\"\"}', NULL, '2022-01-18 04:16:30'),
(67, 'seller_pos', '0', NULL, NULL),
(68, 'liqpay', '{\"status\":0,\"public_key\":\"\",\"private_key\":\"\"}', NULL, NULL),
(69, 'paytm', '{\"status\":0,\"environment\":\"sandbox\",\"paytm_merchant_key\":\"\",\"paytm_merchant_mid\":\"\",\"paytm_merchant_website\":\"\",\"paytm_refund_url\":\"\"}', NULL, '2023-01-10 00:21:56'),
(70, 'refund_day_limit', '30', NULL, NULL),
(71, 'business_mode', 'multi', NULL, '2026-01-23 00:02:20'),
(72, 'mail_config_sendgrid', '{\"status\":0,\"name\":\"\",\"host\":\"\",\"driver\":\"\",\"port\":\"\",\"username\":\"\",\"email_id\":\"\",\"encryption\":\"\",\"password\":\"\"}', NULL, '2026-04-01 10:34:42'),
(73, 'decimal_point_settings', '2', NULL, NULL),
(74, 'shop_address', 'New grain market Malout, shri muktsar sahib Punjab  152107', NULL, NULL),
(75, 'billing_input_by_customer', '1', NULL, NULL),
(76, 'wallet_status', '1', NULL, NULL),
(77, 'loyalty_point_status', '1', NULL, NULL),
(78, 'wallet_add_refund', '1', NULL, NULL),
(79, 'loyalty_point_exchange_rate', '100', NULL, NULL),
(80, 'loyalty_point_item_purchase_point', '12', NULL, NULL),
(81, 'loyalty_point_minimum_point', '10', NULL, NULL),
(82, 'minimum_order_limit', '1', NULL, NULL),
(83, 'product_brand', '1', NULL, '2025-12-10 23:41:51'),
(84, 'digital_product', '1', NULL, '2025-12-10 23:41:46'),
(85, 'delivery_boy_expected_delivery_date_message', '{\"status\":0,\"message\":null}', NULL, NULL),
(86, 'order_canceled', '{\"status\":0,\"message\":null}', NULL, NULL),
(87, 'refund-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 00:55:36'),
(88, 'return-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 00:55:36'),
(89, 'cancellation-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 00:55:36'),
(90, 'offline_payment', '{\"status\":0}', NULL, '2023-03-04 00:55:36'),
(91, 'temporary_close', '{\"status\":0}', NULL, '2023-03-04 00:55:36'),
(92, 'vacation_add', '{\"status\":0,\"vacation_start_date\":null,\"vacation_end_date\":null,\"vacation_note\":null}', NULL, '2023-03-04 00:55:36'),
(93, 'cookie_setting', '{\"status\":\"1\",\"cookie_text\":null}', NULL, '2026-01-19 00:17:40'),
(94, 'currency_symbol_position', 'left', '2025-11-25 06:29:24', '2025-12-11 01:08:02'),
(95, 'timezone', 'Asia/Calcutta', NULL, NULL),
(96, 'loader_gif', '2026-05-20-6a0d8a6072902.png', NULL, NULL),
(97, 'default_location', '{\"lat\":\"cdc\",\"lng\":\"cd\"}', NULL, NULL),
(98, 'whatsapp', '{\"status\":null,\"phone\":null}', '2026-03-24 12:38:01', '2026-03-24 12:38:01'),
(99, 'delivery_zip_code_area_restriction', '1', NULL, '2025-12-08 07:16:32'),
(100, 'delivery_country_restriction', '1', NULL, '2025-12-08 07:16:29'),
(101, 'maintenance_mode', '0', '2025-11-25 23:56:30', '2025-12-08 07:47:45'),
(102, 'shop_banner', '2026-01-20-696f29a77128c.png', NULL, NULL),
(103, 'new_product_approval', '1', NULL, NULL),
(104, 'product_wise_shipping_cost_approval', '1', NULL, NULL),
(106, 'fcm_api_key', 'AIzaSyAB2BkJP_9iQiFVyjLeRftIfs7DJEumWoo', NULL, NULL),
(107, 'fcm_auth_domain', 'multi-vendor-5d507.firebaseapp.com', NULL, NULL),
(108, 'fcm_storage_bucket', 'https://multi-vendor-5d507-default-rtdb.firebaseio.com', NULL, NULL),
(109, 'fcm_messaging_sender_id', '593155222746', NULL, NULL),
(110, 'fcm_app_id', '1:593155222746:web:107a9a6d16bd534f4309e3', NULL, NULL),
(111, 'fcm_vapid_key', 'BJs_58yzI8dDNoQpdmcAKYSuZ6-eJ1HK_a9jPwa9ElhPpmiei_OpgmbZWlA0ZSkYeRcPiEcvROlHsxVy3TZ5bl0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `cart_group_id` varchar(191) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_type` varchar(20) NOT NULL DEFAULT 'physical',
  `digital_product_type` varchar(30) DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL,
  `choices` text DEFAULT NULL,
  `variations` text DEFAULT NULL,
  `variant` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` double NOT NULL DEFAULT 1,
  `tax` double NOT NULL DEFAULT 1,
  `discount` double NOT NULL DEFAULT 1,
  `tax_model` varchar(20) NOT NULL DEFAULT 'exclude',
  `slug` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `thumbnail` varchar(191) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `seller_is` varchar(191) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_info` varchar(191) DEFAULT NULL,
  `shipping_cost` double(8,2) DEFAULT NULL,
  `shipping_type` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_shippings`
--

CREATE TABLE `cart_shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_group_id` varchar(191) DEFAULT NULL,
  `shipping_method_id` bigint(20) DEFAULT NULL,
  `shipping_cost` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_status` tinyint(1) NOT NULL DEFAULT 0,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `parent_id`, `position`, `created_at`, `updated_at`, `home_status`, `priority`) VALUES
(17, 'Insecticides', 'insecticides', '2026-01-19-696de59624fc8.png', 0, 0, '2026-01-16 07:26:22', '2026-01-19 02:46:49', 1, 1),
(19, 'Nutrients', 'nutrients', '2026-01-19-696de86de3498.png', 0, 0, '2026-01-19 02:46:45', '2026-01-19 02:46:49', 1, 2),
(20, 'Fungicides', 'fungicides', '2026-01-19-696de88970908.png', 0, 0, '2026-01-19 02:47:13', '2026-01-19 02:47:17', 1, 4),
(21, 'Vegetable & Fruit Seeds', 'vegetable-fruit-seeds', '2026-01-19-696de8ab72b89.png', 0, 0, '2026-01-19 02:47:47', '2026-01-19 02:54:04', 1, 3),
(22, 'Flower Seeds', 'flower-seeds', '2026-01-22-6971ccc1d795a.png', 0, 0, '2026-01-22 01:37:45', '2026-01-22 01:38:41', 1, 4),
(24, 'seeds', 'seeds', NULL, 21, 1, '2026-03-05 06:19:19', '2026-03-05 06:19:19', 0, 0),
(25, 'veg seeds', 'veg-seeds', NULL, 24, 2, '2026-03-05 06:19:54', '2026-03-05 06:19:54', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_shipping_costs`
--

CREATE TABLE `category_shipping_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `cost` double(8,2) DEFAULT NULL,
  `multiply_qty` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_shipping_costs`
--

INSERT INTO `category_shipping_costs` (`id`, `seller_id`, `category_id`, `cost`, `multiply_qty`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 0.00, NULL, '2023-04-22 17:58:50', '2023-04-22 17:58:50'),
(2, 0, 10, 0.00, NULL, '2025-11-25 23:49:25', '2025-11-25 23:49:25'),
(3, 0, 17, 0.00, NULL, '2026-01-19 00:17:23', '2026-01-19 00:17:23'),
(4, 0, 19, 0.00, NULL, '2026-01-21 01:57:17', '2026-01-21 01:57:17'),
(5, 0, 20, 0.00, NULL, '2026-01-21 01:57:17', '2026-01-21 01:57:17'),
(6, 0, 21, 0.00, NULL, '2026-01-21 01:57:17', '2026-01-21 01:57:17'),
(7, 0, 22, 0.00, NULL, '2026-01-22 23:55:16', '2026-01-22 23:55:16'),
(8, 0, 23, 0.00, NULL, '2026-01-22 23:55:16', '2026-01-22 23:55:16'),
(9, 4, 17, 0.00, NULL, '2026-02-10 05:05:26', '2026-02-10 05:05:26'),
(10, 4, 19, 0.00, NULL, '2026-02-10 05:05:26', '2026-02-10 05:05:26'),
(11, 4, 20, 0.00, NULL, '2026-02-10 05:05:26', '2026-02-10 05:05:26'),
(12, 4, 21, 0.00, NULL, '2026-02-10 05:05:26', '2026-02-10 05:05:26'),
(13, 4, 22, 0.00, NULL, '2026-02-10 05:05:26', '2026-02-10 05:05:26'),
(14, 4, 23, 0.00, NULL, '2026-02-10 05:05:26', '2026-02-10 05:05:26'),
(15, 3, 17, 0.00, NULL, '2026-03-17 02:09:36', '2026-03-17 02:09:36'),
(16, 3, 19, 0.00, NULL, '2026-03-17 02:09:36', '2026-03-17 02:09:36'),
(17, 3, 20, 0.00, NULL, '2026-03-17 02:09:36', '2026-03-17 02:09:36'),
(18, 3, 21, 0.00, NULL, '2026-03-17 02:09:36', '2026-03-17 02:09:36'),
(19, 3, 22, 0.00, NULL, '2026-03-17 02:09:36', '2026-03-17 02:09:36'),
(20, 3, 23, 0.00, NULL, '2026-03-17 02:09:36', '2026-03-17 02:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `chanals`
--

CREATE TABLE `chanals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chanals`
--

INSERT INTO `chanals` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'test', '2025-11-25 11:57:16', '2025-11-25 11:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `chattings`
--

CREATE TABLE `chattings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `delivery_man_id` bigint(20) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_by_customer` tinyint(1) NOT NULL DEFAULT 0,
  `sent_by_seller` tinyint(1) NOT NULL DEFAULT 0,
  `sent_by_admin` tinyint(1) DEFAULT NULL,
  `sent_by_delivery_man` tinyint(1) DEFAULT NULL,
  `seen_by_customer` tinyint(1) NOT NULL DEFAULT 1,
  `seen_by_seller` tinyint(1) NOT NULL DEFAULT 1,
  `seen_by_admin` tinyint(1) DEFAULT NULL,
  `seen_by_delivery_man` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chattings`
--

INSERT INTO `chattings` (`id`, `user_id`, `seller_id`, `admin_id`, `delivery_man_id`, `message`, `sent_by_customer`, `sent_by_seller`, `sent_by_admin`, `sent_by_delivery_man`, `seen_by_customer`, `seen_by_seller`, `seen_by_admin`, `seen_by_delivery_man`, `status`, `created_at`, `updated_at`, `shop_id`) VALUES
(1, 4, NULL, NULL, 1, 'hello', 1, 0, NULL, NULL, 0, 1, NULL, NULL, 1, '2025-11-28 07:09:46', '2025-11-28 07:09:46', NULL),
(2, 5, NULL, NULL, 1, 'hello', 1, 0, NULL, NULL, 1, 1, NULL, NULL, 1, '2026-01-21 05:16:47', '2026-01-21 05:30:43', NULL),
(3, 5, NULL, NULL, 1, 'cvxvbc', 1, 0, NULL, NULL, 1, 1, NULL, NULL, 1, '2026-01-21 05:30:37', '2026-01-21 05:30:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'IndianRed', '#CD5C5C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(2, 'LightCoral', '#F08080', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(3, 'Salmon', '#FA8072', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(4, 'DarkSalmon', '#E9967A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(5, 'LightSalmon', '#FFA07A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(6, 'Crimson', '#DC143C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(7, 'Red', '#FF0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(8, 'FireBrick', '#B22222', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(9, 'DarkRed', '#8B0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(10, 'Pink', '#FFC0CB', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(11, 'LightPink', '#FFB6C1', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(12, 'HotPink', '#FF69B4', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(13, 'DeepPink', '#FF1493', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(14, 'MediumVioletRed', '#C71585', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(15, 'PaleVioletRed', '#DB7093', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(17, 'Coral', '#FF7F50', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(18, 'Tomato', '#FF6347', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(19, 'OrangeRed', '#FF4500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(20, 'DarkOrange', '#FF8C00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(21, 'Orange', '#FFA500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(22, 'Gold', '#FFD700', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(23, 'Yellow', '#FFFF00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(24, 'LightYellow', '#FFFFE0', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(25, 'LemonChiffon', '#FFFACD', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(26, 'LightGoldenrodYellow', '#FAFAD2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(27, 'PapayaWhip', '#FFEFD5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(28, 'Moccasin', '#FFE4B5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(29, 'PeachPuff', '#FFDAB9', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(30, 'PaleGoldenrod', '#EEE8AA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(31, 'Khaki', '#F0E68C', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(32, 'DarkKhaki', '#BDB76B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(33, 'Lavender', '#E6E6FA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(34, 'Thistle', '#D8BFD8', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(35, 'Plum', '#DDA0DD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(36, 'Violet', '#EE82EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(37, 'Orchid', '#DA70D6', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(39, 'Magenta', '#FF00FF', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(40, 'MediumOrchid', '#BA55D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(41, 'MediumPurple', '#9370DB', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(42, 'Amethyst', '#9966CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(43, 'BlueViolet', '#8A2BE2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(44, 'DarkViolet', '#9400D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(45, 'DarkOrchid', '#9932CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(46, 'DarkMagenta', '#8B008B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(47, 'Purple', '#800080', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(48, 'Indigo', '#4B0082', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(49, 'SlateBlue', '#6A5ACD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(50, 'DarkSlateBlue', '#483D8B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(51, 'MediumSlateBlue', '#7B68EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(52, 'GreenYellow', '#ADFF2F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(53, 'Chartreuse', '#7FFF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(54, 'LawnGreen', '#7CFC00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(55, 'Lime', '#00FF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(56, 'LimeGreen', '#32CD32', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(57, 'PaleGreen', '#98FB98', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(58, 'LightGreen', '#90EE90', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(59, 'MediumSpringGreen', '#00FA9A', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(60, 'SpringGreen', '#00FF7F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(61, 'MediumSeaGreen', '#3CB371', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(62, 'SeaGreen', '#2E8B57', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(63, 'ForestGreen', '#228B22', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(64, 'Green', '#008000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(65, 'DarkGreen', '#006400', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(66, 'YellowGreen', '#9ACD32', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(67, 'OliveDrab', '#6B8E23', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(68, 'Olive', '#808000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(69, 'DarkOliveGreen', '#556B2F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(70, 'MediumAquamarine', '#66CDAA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(71, 'DarkSeaGreen', '#8FBC8F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(72, 'LightSeaGreen', '#20B2AA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(73, 'DarkCyan', '#008B8B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(74, 'Teal', '#008080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(75, 'Aqua', '#00FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(77, 'LightCyan', '#E0FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(78, 'PaleTurquoise', '#AFEEEE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(79, 'Aquamarine', '#7FFFD4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(80, 'Turquoise', '#40E0D0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(81, 'MediumTurquoise', '#48D1CC', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(82, 'DarkTurquoise', '#00CED1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(83, 'CadetBlue', '#5F9EA0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(84, 'SteelBlue', '#4682B4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(85, 'LightSteelBlue', '#B0C4DE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(86, 'PowderBlue', '#B0E0E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(87, 'LightBlue', '#ADD8E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(88, 'SkyBlue', '#87CEEB', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(89, 'LightSkyBlue', '#87CEFA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(90, 'DeepSkyBlue', '#00BFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(91, 'DodgerBlue', '#1E90FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(92, 'CornflowerBlue', '#6495ED', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(94, 'RoyalBlue', '#4169E1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(95, 'Blue', '#0000FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(96, 'MediumBlue', '#0000CD', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(97, 'DarkBlue', '#00008B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(98, 'Navy', '#000080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(99, 'MidnightBlue', '#191970', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(100, 'Cornsilk', '#FFF8DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(101, 'BlanchedAlmond', '#FFEBCD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(102, 'Bisque', '#FFE4C4', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(103, 'NavajoWhite', '#FFDEAD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(104, 'Wheat', '#F5DEB3', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(105, 'BurlyWood', '#DEB887', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(106, 'Tan', '#D2B48C', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(107, 'RosyBrown', '#BC8F8F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(108, 'SandyBrown', '#F4A460', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(109, 'Goldenrod', '#DAA520', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(110, 'DarkGoldenrod', '#B8860B', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(111, 'Peru', '#CD853F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(112, 'Chocolate', '#D2691E', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(113, 'SaddleBrown', '#8B4513', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(114, 'Sienna', '#A0522D', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(115, 'Brown', '#A52A2A', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(116, 'Maroon', '#800000', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(117, 'White', '#FFFFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(118, 'Snow', '#FFFAFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(119, 'Honeydew', '#F0FFF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(120, 'MintCream', '#F5FFFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(121, 'Azure', '#F0FFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(122, 'AliceBlue', '#F0F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(123, 'GhostWhite', '#F8F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(124, 'WhiteSmoke', '#F5F5F5', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(125, 'Seashell', '#FFF5EE', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(126, 'Beige', '#F5F5DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(127, 'OldLace', '#FDF5E6', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(128, 'FloralWhite', '#FFFAF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(129, 'Ivory', '#FFFFF0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(130, 'AntiqueWhite', '#FAEBD7', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(131, 'Linen', '#FAF0E6', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(132, 'LavenderBlush', '#FFF0F5', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(133, 'MistyRose', '#FFE4E1', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(134, 'Gainsboro', '#DCDCDC', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(135, 'LightGrey', '#D3D3D3', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(136, 'Silver', '#C0C0C0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(137, 'DarkGray', '#A9A9A9', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(138, 'Gray', '#808080', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(139, 'DimGray', '#696969', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(140, 'LightSlateGray', '#778899', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(141, 'SlateGray', '#708090', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(142, 'DarkSlateGray', '#2F4F4F', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(143, 'Black', '#000000', '2018-11-05 02:12:30', '2018-11-05 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile_number` varchar(191) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `feedback` varchar(191) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reply` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `mobile_number`, `subject`, `message`, `seen`, `feedback`, `created_at`, `updated_at`, `reply`) VALUES
(1, 'Roxanna Doran', 'domains@search-cropshopindia.com', '661490374', 'cropshopindia.com', 'Hey\r\n\r\nInsert cropshopindia.com in Google Search Index to appear in online search results!\r\n\r\nRegister cropshopindia.com at  https://searchregister.org', 0, '0', '2026-04-01 22:34:38', '2026-04-01 22:34:38', NULL),
(2, 'Leeza Bindra', 'leeza.rocketdigitaltech@gmail.com', '7532833829', 'Let’s redesign your website for better leads and conversions', 'Hello http://cropshopindia.com,\r\n \r\nWe offer professional website design and development services for businesses looking to build a strong online presence.\r\n\r\nIf you are planning to create a new website or redesign your existing one, I would be happy to share our portfolio and pricing details.\r\n\r\nPlease let me know if you would like more information.\r\n \r\nBest Regards,\r\nLeeza', 0, '0', '2026-04-02 16:07:18', '2026-04-02 16:07:18', NULL),
(3, 'Brook Lyne', 'domains@search-cropshopindia.com', '3680559281', 'cropshopindia.com', 'Hi\r\n\r\nPlace cropshopindia.com in Google Search Index to be displayed in web search results!\r\n\r\nRegister cropshopindia.com at  https://searchregister.net', 0, '0', '2026-04-03 20:32:26', '2026-04-03 20:32:26', NULL),
(4, 'Annett Parris', 'domains@search-cropshopindia.com', '353197173', 'cropshopindia.com', 'Hey\r\n\r\nAdd cropshopindia.com in GoogleSearchIndex and have it be displayed in online search results!\r\n\r\nFeature cropshopindia.com now: https://searchregister.org', 0, '0', '2026-05-07 22:07:10', '2026-05-07 22:07:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` varchar(191) NOT NULL DEFAULT 'admin',
  `coupon_type` varchar(50) DEFAULT NULL,
  `coupon_bearer` varchar(191) NOT NULL DEFAULT 'inhouse',
  `seller_id` bigint(20) DEFAULT NULL COMMENT 'NULL=in-house, 0=all seller',
  `customer_id` bigint(20) DEFAULT NULL COMMENT '0 = all customer',
  `title` varchar(100) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `min_purchase` decimal(8,2) NOT NULL DEFAULT 0.00,
  `max_discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(15) NOT NULL DEFAULT 'percentage',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `symbol` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `exchange_rate` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `code`, `exchange_rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 'USD', '0.016666666666667', 1, NULL, '2025-11-25 04:16:43'),
(2, 'BDT', '৳', 'BDT', '1.4', 1, NULL, '2025-11-25 04:16:43'),
(3, 'Indian Rupi', '₹', 'INR', '1', 1, '2020-10-15 17:23:04', '2025-11-25 04:16:43'),
(4, 'Euro', '€', 'EUR', '1.6666666666667', 1, '2021-05-25 21:00:23', '2025-11-25 04:16:43'),
(5, 'YEN', '¥', 'JPY', '1.8333333333333', 1, '2021-06-10 22:08:31', '2025-11-25 04:16:43'),
(6, 'Ringgit', 'RM', 'MYR', '0.069333333333333', 1, '2021-07-03 11:08:33', '2025-11-25 04:16:43'),
(7, 'Rand', 'R', 'ZAR', '0.23766666666667', 1, '2021-07-03 11:12:38', '2025-11-25 04:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `customer_wallets`
--

CREATE TABLE `customer_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `royality_points` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_wallet_histories`
--

CREATE TABLE `customer_wallet_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `transaction_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `transaction_type` varchar(20) DEFAULT NULL,
  `transaction_method` varchar(30) DEFAULT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_of_the_days`
--

CREATE TABLE `deal_of_the_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(12) NOT NULL DEFAULT 'amount',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deal_of_the_days`
--

INSERT INTO `deal_of_the_days` (`id`, `title`, `product_id`, `discount`, `discount_type`, `status`, `created_at`, `updated_at`) VALUES
(2, '50% OFF', 54, 0.00, 'percent', 0, '2026-01-21 01:25:48', '2026-01-21 01:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_notifications`
--

CREATE TABLE `deliveryman_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_man_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `description` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_wallets`
--

CREATE TABLE `deliveryman_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_man_id` bigint(20) NOT NULL,
  `current_balance` decimal(50,2) NOT NULL DEFAULT 0.00,
  `cash_in_hand` decimal(50,2) NOT NULL DEFAULT 0.00,
  `pending_withdraw` decimal(50,2) NOT NULL DEFAULT 0.00,
  `total_withdraw` decimal(50,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveryman_wallets`
--

INSERT INTO `deliveryman_wallets` (`id`, `delivery_man_id`, `current_balance`, `cash_in_hand`, `pending_withdraw`, `total_withdraw`, `created_at`, `updated_at`) VALUES
(1, 1, 166.66, -1358.65, 0.00, 0.00, '2025-11-28 07:14:06', '2026-02-11 00:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_country_codes`
--

CREATE TABLE `delivery_country_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_country_codes`
--

INSERT INTO `delivery_country_codes` (`id`, `country_code`, `created_at`, `updated_at`) VALUES
(2, 'IN', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_histories`
--

CREATE TABLE `delivery_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `deliveryman_id` bigint(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `location` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_man_transactions`
--

CREATE TABLE `delivery_man_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_man_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `transaction_id` char(36) NOT NULL,
  `debit` decimal(50,2) NOT NULL DEFAULT 0.00,
  `credit` decimal(50,2) NOT NULL DEFAULT 0.00,
  `transaction_type` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_man_transactions`
--

INSERT INTO `delivery_man_transactions` (`id`, `delivery_man_id`, `user_id`, `user_type`, `transaction_id`, `debit`, `credit`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'admin', '5eba79b5-1dc6-4529-89f0-1ea76f44afbb', 0.00, 83.33, 'deliveryman_charge', '2025-11-28 07:14:07', '2025-11-28 07:14:07'),
(2, 1, 0, 'admin', '', 0.00, 25.67, 'cash_in_hand', '2025-12-08 07:25:54', '2025-12-08 07:25:54'),
(3, 1, 0, 'admin', '4f4da867-ed1e-4a38-8944-483cff178a90', 0.00, 83.33, 'deliveryman_charge', '2026-02-11 00:06:36', '2026-02-11 00:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_men`
--

CREATE TABLE `delivery_men` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country_code` varchar(20) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `identity_number` varchar(30) DEFAULT NULL,
  `identity_type` varchar(50) DEFAULT NULL,
  `identity_image` varchar(191) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `branch` varchar(191) DEFAULT NULL,
  `account_no` varchar(191) DEFAULT NULL,
  `holder_name` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_online` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth_token` varchar(191) NOT NULL DEFAULT '6yIRXJRRfp78qJsAoKZZ6TTqhzuNJ3TcdvPBmk6n',
  `fcm_token` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_men`
--

INSERT INTO `delivery_men` (`id`, `seller_id`, `f_name`, `l_name`, `address`, `country_code`, `phone`, `email`, `identity_number`, `identity_type`, `identity_image`, `image`, `password`, `bank_name`, `branch`, `account_no`, `holder_name`, `is_active`, `is_online`, `created_at`, `updated_at`, `auth_token`, `fcm_token`) VALUES
(1, 0, 'test', 'tes5t', 'pkhj', '91', '85509 58709', 'true123@gmail.com', 'kj-656120-jh', 'passport', '[\"2025-11-25-692540b007a3b.png\"]', '2025-11-25-692540b009f33.png', '$2y$10$7fR11kGAfMJAsfOnN.I5Su.x1kSj6KD5DDYqY5qGyG8lpz92ourFq', NULL, NULL, NULL, NULL, 1, 1, '2025-11-25 06:07:52', '2026-02-09 23:58:12', '6yIRXJRRfp78qJsAoKZZ6TTqhzuNJ3TcdvPBmk6n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zip_codes`
--

CREATE TABLE `delivery_zip_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zipcode` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_zip_codes`
--

INSERT INTO `delivery_zip_codes` (`id`, `zipcode`, `created_at`, `updated_at`) VALUES
(3, '305003', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `user_id`, `name`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Satta Genius', '6544984967', 1, '2025-11-25 06:08:38', '2025-11-25 06:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_deals`
--

CREATE TABLE `feature_deals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deals`
--

CREATE TABLE `flash_deals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `background_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `deal_type` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flash_deals`
--

INSERT INTO `flash_deals` (`id`, `title`, `start_date`, `end_date`, `status`, `featured`, `background_color`, `text_color`, `banner`, `slug`, `created_at`, `updated_at`, `product_id`, `deal_type`) VALUES
(1, 'test', '2025-11-07', '2025-11-30', 0, 0, NULL, NULL, '2025-11-25-69253e6e513ad.png', 'test', '2025-11-25 05:58:14', '2025-11-25 23:35:43', NULL, 'flash_deal'),
(2, 'test', '2025-11-08', '2025-12-04', 1, 0, NULL, NULL, 'def.png', 'test', '2025-11-25 05:59:45', '2026-01-21 03:31:37', NULL, 'feature_deal'),
(3, '50% OFF', '2026-01-22', '2026-01-24', 1, 0, NULL, NULL, '2026-01-21-69707969e51d8.png', '50-off', '2026-01-21 01:29:54', '2026-01-21 01:30:00', NULL, 'flash_deal');

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_products`
--

CREATE TABLE `flash_deal_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flash_deal_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help_topics`
--

CREATE TABLE `help_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `ranking` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_point_transactions`
--

CREATE TABLE `loyalty_point_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` char(36) NOT NULL,
  `credit` decimal(24,3) NOT NULL DEFAULT 0.000,
  `debit` decimal(24,3) NOT NULL DEFAULT 0.000,
  `balance` decimal(24,3) NOT NULL DEFAULT 0.000,
  `reference` varchar(191) DEFAULT NULL,
  `transaction_type` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loyalty_point_transactions`
--

INSERT INTO `loyalty_point_transactions` (`id`, `user_id`, `transaction_id`, `credit`, `debit`, `balance`, `reference`, `transaction_type`, `created_at`, `updated_at`) VALUES
(1, 4, 'd530fcd1-ea36-42de-aa44-199b6c42c715', 8276.000, 0.000, 8276.000, '100005', 'order_place', '2025-12-12 07:46:02', '2025-12-12 07:46:02'),
(2, 4, 'e40ce012-b6b6-422c-b840-60741044f001', 0.000, 8276.000, 0.000, '918330bc-a0d0-41fc-8f78-7515b0c7c01b', 'point_to_wallet', '2025-12-12 07:52:36', '2025-12-12 07:52:36'),
(3, 12, '9075bd01-6d4a-4cd0-9017-3f8053901c93', 28.000, 0.000, 28.000, '100006', 'order_place', '2026-02-11 00:06:36', '2026-02-11 00:06:36'),
(4, 4, '62c6aaf4-5cc0-4d74-b512-3183bf36b3e7', 8276.000, 0.000, 8276.000, '100005', 'order_place', '2026-02-25 07:54:13', '2026-02-25 07:54:13'),
(5, 4, 'a9b25e32-0c90-4626-9a22-6ff1c23220ea', 8276.000, 0.000, 16552.000, '100005', 'order_place', '2026-02-25 07:56:20', '2026-02-25 07:56:20'),
(6, 4, 'b269b2d8-79c6-487e-9324-a6f41e257d29', 8276.000, 0.000, 24828.000, '100005', 'order_place', '2026-02-25 07:59:00', '2026-02-25 07:59:00'),
(7, 12, '3279d193-d759-4486-87d2-24ea971caad9', 40.000, 0.000, 68.000, '100007', 'order_place', '2026-02-25 08:15:25', '2026-02-25 08:15:25'),
(8, 12, '1955a751-4470-4b40-8137-0e2825227126', 40.000, 0.000, 108.000, '100007', 'order_place', '2026-02-28 01:27:28', '2026-02-28 01:27:28'),
(9, 12, 'bb161610-0178-4754-938f-3d0be4b55e08', 34560.000, 0.000, 34668.000, '100012', 'order_place', '2026-03-17 04:16:25', '2026-03-17 04:16:25'),
(10, 12, 'f6e7457f-6229-4670-b559-12c8019bf966', 0.000, 30000.000, 4668.000, 'a9a7ef79-7f4e-4876-b420-98029cda3d9e', 'point_to_wallet', '2026-03-20 01:40:38', '2026-03-20 01:40:38'),
(11, 12, '2e632501-9410-43f3-a4fc-92b8f9b4df8c', 0.000, 4668.000, 0.000, 'c5882529-a272-4f23-8366-d069c90db8c1', 'point_to_wallet', '2026-03-20 01:42:07', '2026-03-20 01:42:07'),
(12, 12, '87797d82-d856-4af4-b52a-273d7d4b7416', 600.000, 0.000, 600.000, '100004', 'order_place', '2026-03-21 06:47:16', '2026-03-21 06:47:16'),
(13, 12, '4c3a7c95-e1a6-4cbf-9778-7213cce8fcb4', 87.000, 0.000, 687.000, '100005', 'order_place', '2026-05-15 16:18:11', '2026-05-15 16:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `features` text DEFAULT NULL,
  `price` double(24,2) NOT NULL DEFAULT 0.00,
  `duration` int(11) NOT NULL DEFAULT 0,
  `duration_type` varchar(191) NOT NULL DEFAULT 'month',
  `user_type` varchar(191) NOT NULL DEFAULT 'customer',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `name`, `features`, `price`, `duration`, `duration_type`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '[\"Field Assistant Visit\",\"Soil Testing\",\"Fast Shipping\",\"Rewards Free Or Paid\"]', 0.00, 1000, 'year', 'customer', 1, '2026-03-27 11:54:40', '2026-03-27 11:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_08_105159_create_admins_table', 1),
(5, '2020_09_08_111837_create_admin_roles_table', 1),
(6, '2020_09_16_142451_create_categories_table', 2),
(7, '2020_09_16_181753_create_categories_table', 3),
(8, '2020_09_17_134238_create_brands_table', 4),
(9, '2020_09_17_203054_create_attributes_table', 5),
(10, '2020_09_19_112509_create_coupons_table', 6),
(11, '2020_09_19_161802_create_curriencies_table', 7),
(12, '2020_09_20_114509_create_sellers_table', 8),
(13, '2020_09_23_113454_create_shops_table', 9),
(14, '2020_09_23_115615_create_shops_table', 10),
(15, '2020_09_23_153822_create_shops_table', 11),
(16, '2020_09_21_122817_create_products_table', 12),
(17, '2020_09_22_140800_create_colors_table', 12),
(18, '2020_09_28_175020_create_products_table', 13),
(19, '2020_09_28_180311_create_products_table', 14),
(20, '2020_10_04_105041_create_search_functions_table', 15),
(21, '2020_10_05_150730_create_customers_table', 15),
(22, '2020_10_08_133548_create_wishlists_table', 16),
(23, '2016_06_01_000001_create_oauth_auth_codes_table', 17),
(24, '2016_06_01_000002_create_oauth_access_tokens_table', 17),
(25, '2016_06_01_000003_create_oauth_refresh_tokens_table', 17),
(26, '2016_06_01_000004_create_oauth_clients_table', 17),
(27, '2016_06_01_000005_create_oauth_personal_access_clients_table', 17),
(28, '2020_10_06_133710_create_product_stocks_table', 17),
(29, '2020_10_06_134636_create_flash_deals_table', 17),
(30, '2020_10_06_134719_create_flash_deal_products_table', 17),
(31, '2020_10_08_115439_create_orders_table', 17),
(32, '2020_10_08_115453_create_order_details_table', 17),
(33, '2020_10_08_121135_create_shipping_addresses_table', 17),
(34, '2020_10_10_171722_create_business_settings_table', 17),
(35, '2020_09_19_161802_create_currencies_table', 18),
(36, '2020_10_12_152350_create_reviews_table', 18),
(37, '2020_10_12_161834_create_reviews_table', 19),
(38, '2020_10_12_180510_create_support_tickets_table', 20),
(39, '2020_10_14_140130_create_transactions_table', 21),
(40, '2020_10_14_143553_create_customer_wallets_table', 21),
(41, '2020_10_14_143607_create_customer_wallet_histories_table', 21),
(42, '2020_10_22_142212_create_support_ticket_convs_table', 21),
(43, '2020_10_24_234813_create_banners_table', 22),
(44, '2020_10_27_111557_create_shipping_methods_table', 23),
(45, '2020_10_27_114154_add_url_to_banners_table', 24),
(46, '2020_10_28_170308_add_shipping_id_to_order_details', 25),
(47, '2020_11_02_140528_add_discount_to_order_table', 26),
(48, '2020_11_03_162723_add_column_to_order_details', 27),
(49, '2020_11_08_202351_add_url_to_banners_table', 28),
(50, '2020_11_10_112713_create_help_topic', 29),
(51, '2020_11_10_141513_create_contacts_table', 29),
(52, '2020_11_15_180036_add_address_column_user_table', 30),
(53, '2020_11_18_170209_add_status_column_to_product_table', 31),
(54, '2020_11_19_115453_add_featured_status_product', 32),
(55, '2020_11_21_133302_create_deal_of_the_days_table', 33),
(56, '2020_11_20_172332_add_product_id_to_products', 34),
(57, '2020_11_27_234439_add__state_to_shipping_addresses', 34),
(58, '2020_11_28_091929_create_chattings_table', 35),
(59, '2020_12_02_011815_add_bank_info_to_sellers', 36),
(60, '2020_12_08_193234_create_social_medias_table', 37),
(61, '2020_12_13_122649_shop_id_to_chattings', 37),
(62, '2020_12_14_145116_create_seller_wallet_histories_table', 38),
(63, '2020_12_14_145127_create_seller_wallets_table', 38),
(64, '2020_12_15_174804_create_admin_wallets_table', 39),
(65, '2020_12_15_174821_create_admin_wallet_histories_table', 39),
(66, '2020_12_15_214312_create_feature_deals_table', 40),
(67, '2020_12_17_205712_create_withdraw_requests_table', 41),
(68, '2021_02_22_161510_create_notifications_table', 42),
(69, '2021_02_24_154706_add_deal_type_to_flash_deals', 43),
(70, '2021_03_03_204349_add_cm_firebase_token_to_users', 44),
(71, '2021_04_17_134848_add_column_to_order_details_stock', 45),
(72, '2021_05_12_155401_add_auth_token_seller', 46),
(73, '2021_06_03_104531_ex_rate_update', 47),
(74, '2021_06_03_222413_amount_withdraw_req', 48),
(75, '2021_06_04_154501_seller_wallet_withdraw_bal', 49),
(76, '2021_06_04_195853_product_dis_tax', 50),
(77, '2021_05_27_103505_create_product_translations_table', 51),
(78, '2021_06_17_054551_create_soft_credentials_table', 51),
(79, '2021_06_29_212549_add_active_col_user_table', 52),
(80, '2021_06_30_212619_add_col_to_contact', 53),
(81, '2021_07_01_160828_add_col_daily_needs_products', 54),
(82, '2021_07_04_182331_add_col_seller_sales_commission', 55),
(83, '2021_08_07_190655_add_seo_columns_to_products', 56),
(84, '2021_08_07_205913_add_col_to_category_table', 56),
(85, '2021_08_07_210808_add_col_to_shops_table', 56),
(86, '2021_08_14_205216_change_product_price_col_type', 56),
(87, '2021_08_16_201505_change_order_price_col', 56),
(88, '2021_08_16_201552_change_order_details_price_col', 56),
(89, '2019_09_29_154000_create_payment_cards_table', 57),
(90, '2021_08_17_213934_change_col_type_seller_earning_history', 57),
(91, '2021_08_17_214109_change_col_type_admin_earning_history', 57),
(92, '2021_08_17_214232_change_col_type_admin_wallet', 57),
(93, '2021_08_17_214405_change_col_type_seller_wallet', 57),
(94, '2021_08_22_184834_add_publish_to_products_table', 57),
(95, '2021_09_08_211832_add_social_column_to_users_table', 57),
(96, '2021_09_13_165535_add_col_to_user', 57),
(97, '2021_09_19_061647_add_limit_to_coupons_table', 57),
(98, '2021_09_20_020716_add_coupon_code_to_orders_table', 57),
(99, '2021_09_23_003059_add_gst_to_sellers_table', 57),
(100, '2021_09_28_025411_create_order_transactions_table', 57),
(101, '2021_10_02_185124_create_carts_table', 57),
(102, '2021_10_02_190207_create_cart_shippings_table', 57),
(103, '2021_10_03_194334_add_col_order_table', 57),
(104, '2021_10_03_200536_add_shipping_cost', 57),
(105, '2021_10_04_153201_add_col_to_order_table', 57),
(106, '2021_10_07_172701_add_col_cart_shop_info', 57),
(107, '2021_10_07_184442_create_phone_or_email_verifications_table', 57),
(108, '2021_10_07_185416_add_user_table_email_verified', 57),
(109, '2021_10_11_192739_add_transaction_amount_table', 57),
(110, '2021_10_11_200850_add_order_verification_code', 57),
(111, '2021_10_12_083241_add_col_to_order_transaction', 57),
(112, '2021_10_12_084440_add_seller_id_to_order', 57),
(113, '2021_10_12_102853_change_col_type', 57),
(114, '2021_10_12_110434_add_col_to_admin_wallet', 57),
(115, '2021_10_12_110829_add_col_to_seller_wallet', 57),
(116, '2021_10_13_091801_add_col_to_admin_wallets', 57),
(117, '2021_10_13_092000_add_col_to_seller_wallets_tax', 57),
(118, '2021_10_13_165947_rename_and_remove_col_seller_wallet', 57),
(119, '2021_10_13_170258_rename_and_remove_col_admin_wallet', 57),
(120, '2021_10_14_061603_column_update_order_transaction', 57),
(121, '2021_10_15_103339_remove_col_from_seller_wallet', 57),
(122, '2021_10_15_104419_add_id_col_order_tran', 57),
(123, '2021_10_15_213454_update_string_limit', 57),
(124, '2021_10_16_234037_change_col_type_translation', 57),
(125, '2021_10_16_234329_change_col_type_translation_1', 57),
(126, '2021_10_27_091250_add_shipping_address_in_order', 58),
(127, '2021_01_24_205114_create_paytabs_invoices_table', 59),
(128, '2021_11_20_043814_change_pass_reset_email_col', 59),
(129, '2021_11_25_043109_create_delivery_men_table', 60),
(130, '2021_11_25_062242_add_auth_token_delivery_man', 60),
(131, '2021_11_27_043405_add_deliveryman_in_order_table', 60),
(132, '2021_11_27_051432_create_delivery_histories_table', 60),
(133, '2021_11_27_051512_add_fcm_col_for_delivery_man', 60),
(134, '2021_12_15_123216_add_columns_to_banner', 60),
(135, '2022_01_04_100543_add_order_note_to_orders_table', 60),
(136, '2022_01_10_034952_add_lat_long_to_shipping_addresses_table', 60),
(137, '2022_01_10_045517_create_billing_addresses_table', 60),
(138, '2022_01_11_040755_add_is_billing_to_shipping_addresses_table', 60),
(139, '2022_01_11_053404_add_billing_to_orders_table', 60),
(140, '2022_01_11_234310_add_firebase_toke_to_sellers_table', 60),
(141, '2022_01_16_121801_change_colu_type', 60),
(142, '2022_01_22_101601_change_cart_col_type', 61),
(143, '2022_01_23_031359_add_column_to_orders_table', 61),
(144, '2022_01_28_235054_add_status_to_admins_table', 61),
(145, '2022_02_01_214654_add_pos_status_to_sellers_table', 61),
(146, '2019_12_14_000001_create_personal_access_tokens_table', 62),
(147, '2022_02_11_225355_add_checked_to_orders_table', 62),
(148, '2022_02_14_114359_create_refund_requests_table', 62),
(149, '2022_02_14_115757_add_refund_request_to_order_details_table', 62),
(150, '2022_02_15_092604_add_order_details_id_to_transactions_table', 62),
(151, '2022_02_15_121410_create_refund_transactions_table', 62),
(152, '2022_02_24_091236_add_multiple_column_to_refund_requests_table', 62),
(153, '2022_02_24_103827_create_refund_statuses_table', 62),
(154, '2022_03_01_121420_add_refund_id_to_refund_transactions_table', 62),
(155, '2022_03_10_091943_add_priority_to_categories_table', 63),
(156, '2022_03_13_111914_create_shipping_types_table', 63),
(157, '2022_03_13_121514_create_category_shipping_costs_table', 63),
(158, '2022_03_14_074413_add_four_column_to_products_table', 63),
(159, '2022_03_15_105838_add_shipping_to_carts_table', 63),
(160, '2022_03_16_070327_add_shipping_type_to_orders_table', 63),
(161, '2022_03_17_070200_add_delivery_info_to_orders_table', 63),
(162, '2022_03_18_143339_add_shipping_type_to_carts_table', 63),
(163, '2022_04_06_020313_create_subscriptions_table', 64),
(164, '2022_04_12_233704_change_column_to_products_table', 64),
(165, '2022_04_19_095926_create_jobs_table', 64),
(166, '2022_05_12_104247_create_wallet_transactions_table', 65),
(167, '2022_05_12_104511_add_two_column_to_users_table', 65),
(168, '2022_05_14_063309_create_loyalty_point_transactions_table', 65),
(169, '2022_05_26_044016_add_user_type_to_password_resets_table', 65),
(170, '2022_04_15_235820_add_provider', 66),
(171, '2022_07_21_101659_add_code_to_products_table', 66),
(172, '2022_07_26_103744_add_notification_count_to_notifications_table', 66),
(173, '2022_07_31_031541_add_minimum_order_qty_to_products_table', 66),
(174, '2022_08_11_172839_add_product_type_and_digital_product_type_and_digital_file_ready_to_products', 67),
(175, '2022_08_11_173941_add_product_type_and_digital_product_type_and_digital_file_to_order_details', 67),
(176, '2022_08_20_094225_add_product_type_and_digital_product_type_and_digital_file_ready_to_carts_table', 67),
(177, '2022_10_04_160234_add_banking_columns_to_delivery_men_table', 68),
(178, '2022_10_04_161339_create_deliveryman_wallets_table', 68),
(179, '2022_10_04_184506_add_deliverymanid_column_to_withdraw_requests_table', 68),
(180, '2022_10_11_103011_add_deliverymans_columns_to_chattings_table', 68),
(181, '2022_10_11_144902_add_deliverman_id_cloumn_to_reviews_table', 68),
(182, '2022_10_17_114744_create_order_status_histories_table', 68),
(183, '2022_10_17_120840_create_order_expected_delivery_histories_table', 68),
(184, '2022_10_18_084245_add_deliveryman_charge_and_expected_delivery_date', 68),
(185, '2022_10_18_130938_create_delivery_zip_codes_table', 68),
(186, '2022_10_18_130956_create_delivery_country_codes_table', 68),
(187, '2022_10_20_164712_create_delivery_man_transactions_table', 68),
(188, '2022_10_27_145604_create_emergency_contacts_table', 68),
(189, '2022_10_29_182930_add_is_pause_cause_to_orders_table', 68),
(190, '2022_10_31_150604_add_address_phone_country_code_column_to_delivery_men_table', 68),
(191, '2022_11_05_185726_add_order_id_to_reviews_table', 68),
(192, '2022_11_07_190749_create_deliveryman_notifications_table', 68),
(193, '2022_11_08_132745_change_transaction_note_type_to_withdraw_requests_table', 68),
(194, '2022_11_10_193747_chenge_order_amount_seller_amount_admin_commission_delivery_charge_tax_toorder_transactions_table', 68),
(195, '2022_12_17_035723_few_field_add_to_coupons_table', 69),
(196, '2022_12_26_231606_add_coupon_discount_bearer_and_admin_commission_to_orders', 69),
(197, '2023_01_04_003034_alter_billing_addresses_change_zip', 69),
(198, '2023_01_05_121600_change_id_to_transactions_table', 69),
(199, '2023_02_02_113330_create_product_tag_table', 70),
(200, '2023_02_02_114518_create_tags_table', 70),
(201, '2023_02_02_152248_add_tax_model_to_products_table', 70),
(202, '2023_02_02_152718_add_tax_model_to_order_details_table', 70),
(203, '2023_02_02_171034_add_tax_type_to_carts', 70),
(204, '2023_02_06_124447_add_color_image_column_to_products_table', 70),
(205, '2023_02_07_120136_create_withdrawal_methods_table', 70),
(206, '2023_02_07_175939_add_withdrawal_method_id_and_withdrawal_method_fields_to_withdraw_requests_table', 70),
(207, '2023_02_08_143314_add_vacation_start_and_vacation_end_and_vacation_not_column_to_shops_table', 70),
(208, '2023_02_09_104656_add_payment_by_and_payment_not_to_orders_table', 70),
(209, '2023_02_09_104656_create_product_querys_table', 71),
(210, '2025_12_13_132128_create_bidings_table', 72),
(213, '2025_12_15_052953_create_biddings_table', 73),
(215, '2026_02_23_065650_create_whatsapp_settings_table', 74),
(216, '2026_02_23_075221_create_third_party_shipping_methods_table', 75),
(219, '2026_02_23_101842_create_whatsapp_templetes_table', 76),
(220, '2026_02_24_053925_add_is_active_to_whatsapp_templetes_table', 77),
(221, '2026_03_17_101812_add_wherehouse_to_admins_table', 78),
(222, '2026_03_18_173110_create_tempproducts_table', 79),
(223, '2026_03_19_121646_create_tally_companies_table', 80),
(224, '2026_03_19_132733_add_tally_sync_to_admins_table', 81),
(225, '2026_03_19_132857_add_tally_sync_to_sellers_table', 81),
(226, '2026_03_21_123235_add_product_package_and_condition_images_to_reviews_table', 82),
(227, '2026_03_21_161049_add_indexing_to_products_table', 83),
(228, '2026_03_23_121041_create_recently_viewed_products_table', 84),
(229, '2026_03_23_134013_add_ranking_to_sellers_table', 85),
(230, '2026_03_23_163145_add_suggested_price_to_products_table', 86),
(231, '2026_03_24_102331_add_discount_amount_to_products_table', 87),
(232, '2026_03_24_102842_add_actual_amount_to_products_table', 88),
(233, '2026_03_24_135240_create_seller_notifications_table', 89),
(234, '2026_03_26_083000_add_cron_sent_to_notifications_table', 90),
(235, '2026_03_26_172641_create_notification_reads_table', 91),
(236, '2026_03_27_124151_add_role_type_and_notification_type_to_notifications_table', 92),
(237, '2026_03_27_172000_create_membership_plans_table', 93);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `role_type` varchar(191) DEFAULT NULL,
  `notification_type` varchar(191) DEFAULT NULL,
  `notification_count` int(11) NOT NULL DEFAULT 0,
  `cron_sent` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `role_type`, `notification_type`, `notification_count`, `cron_sent`, `image`, `status`, `created_at`, `updated_at`) VALUES
(30, 'offer', '39%', NULL, NULL, 4, 1, '2026-03-27-69c61e90d4ed8.png', 1, '2026-03-27 06:07:12', '2026-03-27 06:28:27'),
(31, 'offer', '50%', 'customer', 'seller', 1, 1, '2026-03-27-69c62ffe7e265.png', 1, '2026-03-27 07:21:34', '2026-03-27 07:22:22'),
(32, '12', 'go', 'seller', 'warning', 1, 1, '2026-03-27-69c63b3aa5de9.png', 1, '2026-03-27 08:09:30', '2026-03-27 08:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `notification_reads`
--

CREATE TABLE `notification_reads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_reads`
--

INSERT INTO `notification_reads` (`id`, `notification_id`, `user_id`, `read_at`, `created_at`, `updated_at`) VALUES
(4, 30, 12, '2026-03-27 06:43:49', '2026-03-27 06:43:49', '2026-03-27 06:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0432335a684029c10828e7d7623a891e7ebd1cd3f98a1883e72302959851c4065fee87fa3d0f2ed6', 3, 1, 'LaravelAuthApp', '[]', 0, '2023-04-02 14:27:23', '2023-04-02 14:27:23', '2024-04-02 14:27:23'),
('6840b7d4ed685bf2e0dc593affa0bd3b968065f47cc226d39ab09f1422b5a1d9666601f3f60a79c1', 98, 1, 'LaravelAuthApp', '[]', 1, '2021-07-05 09:25:41', '2021-07-05 09:25:41', '2022-07-05 15:25:41'),
('bf3a29f5de6ba250bc5b55807d3fb24b75d4e0d131d9017c3d093326bb490b5aef05cb27a683ca08', 2, 1, 'LaravelAuthApp', '[]', 0, '2023-04-02 13:41:49', '2023-04-02 13:41:49', '2024-04-02 13:41:49'),
('c42cdd5ae652b8b2cbac4f2f4b496e889e1a803b08672954c8bbe06722b54160e71dce3e02331544', 98, 1, 'LaravelAuthApp', '[]', 1, '2021-07-05 09:24:36', '2021-07-05 09:24:36', '2022-07-05 15:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`, `provider`) VALUES
(1, NULL, '6amtech', 'GEUx5tqkviM6AAQcz4oi1dcm1KtRdJPgw41lj0eI', 'http://localhost', 1, 0, 0, '2020-10-21 18:27:22', '2020-10-21 18:27:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-10-21 18:27:23', '2020-10-21 18:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(15) DEFAULT NULL,
  `customer_type` varchar(10) DEFAULT NULL,
  `payment_status` varchar(15) NOT NULL DEFAULT 'unpaid',
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(100) DEFAULT NULL,
  `transaction_ref` varchar(30) DEFAULT NULL,
  `payment_by` varchar(191) DEFAULT NULL,
  `payment_note` text DEFAULT NULL,
  `order_amount` double NOT NULL DEFAULT 0,
  `admin_commission` decimal(8,2) NOT NULL DEFAULT 0.00,
  `is_pause` varchar(20) NOT NULL DEFAULT '0',
  `cause` varchar(191) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_amount` double NOT NULL DEFAULT 0,
  `discount_type` varchar(30) DEFAULT NULL,
  `coupon_code` varchar(191) DEFAULT NULL,
  `coupon_discount_bearer` varchar(191) NOT NULL DEFAULT 'inhouse',
  `shipping_method_id` bigint(20) NOT NULL DEFAULT 0,
  `shipping_cost` double(8,2) NOT NULL DEFAULT 0.00,
  `order_group_id` varchar(191) NOT NULL DEFAULT 'def-order-group',
  `verification_code` varchar(191) NOT NULL DEFAULT '0',
  `seller_id` bigint(20) DEFAULT NULL,
  `seller_is` varchar(191) DEFAULT NULL,
  `shipping_address_data` text DEFAULT NULL,
  `delivery_man_id` bigint(20) DEFAULT NULL,
  `deliveryman_charge` double NOT NULL DEFAULT 0,
  `expected_delivery_date` date DEFAULT NULL,
  `order_note` text DEFAULT NULL,
  `billing_address` bigint(20) UNSIGNED DEFAULT NULL,
  `billing_address_data` text DEFAULT NULL,
  `order_type` varchar(191) NOT NULL DEFAULT 'default_type',
  `extra_discount` double(8,2) NOT NULL DEFAULT 0.00,
  `extra_discount_type` varchar(191) DEFAULT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_type` varchar(191) DEFAULT NULL,
  `delivery_type` varchar(191) DEFAULT NULL,
  `delivery_service_name` varchar(191) DEFAULT NULL,
  `third_party_delivery_tracking_id` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `customer_type`, `payment_status`, `order_status`, `payment_method`, `transaction_ref`, `payment_by`, `payment_note`, `order_amount`, `admin_commission`, `is_pause`, `cause`, `shipping_address`, `created_at`, `updated_at`, `discount_amount`, `discount_type`, `coupon_code`, `coupon_discount_bearer`, `shipping_method_id`, `shipping_cost`, `order_group_id`, `verification_code`, `seller_id`, `seller_is`, `shipping_address_data`, `delivery_man_id`, `deliveryman_charge`, `expected_delivery_date`, `order_note`, `billing_address`, `billing_address_data`, `order_type`, `extra_discount`, `extra_discount_type`, `checked`, `shipping_type`, `delivery_type`, `delivery_service_name`, `third_party_delivery_tracking_id`) VALUES
(100004, '12', 'customer', 'paid', 'delivered', 'cash_on_delivery', '', NULL, NULL, 5005, 0.00, '0', NULL, '3', '2026-03-09 04:57:28', '2026-03-21 06:47:15', 0, NULL, '0', 'inhouse', 2, 5.00, '2225-NrUQ4-1773052048', '268411', 1, 'admin', '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, NULL, 3, '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', 'default_type', 0.00, NULL, 1, 'order_wise', NULL, NULL, NULL),
(100005, '12', 'customer', 'paid', 'canceled', 'cash_on_delivery', '', NULL, NULL, 728.95, 0.00, '0', NULL, '4', '2026-03-27 05:23:56', '2026-05-15 16:19:25', 0, NULL, '0', 'inhouse', 0, 0.00, '5582-HiWag-1774589036', '308051', 1, 'admin', '{\"id\":4,\"customer_id\":12,\"contact_person_name\":\"Deepak Nogia\",\"address_type\":\"home\",\"address\":\"home\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"7688927161\",\"created_at\":\"2026-03-27T05:23:52.000000Z\",\"updated_at\":\"2026-03-27T05:23:52.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, NULL, NULL, NULL, 'default_type', 0.00, NULL, 1, 'order_wise', 'third_party_delivery', 'Delhivery', '85100410000136'),
(100006, '12', 'customer', 'unpaid', 'canceled', 'cash_on_delivery', '', NULL, NULL, 308, 0.00, '0', NULL, '4', '2026-05-20 15:57:10', '2026-05-20 15:59:00', 0, NULL, '0', 'inhouse', 0, 0.00, '5604-355IT-1779272830', '543644', 1, 'admin', '{\"id\":4,\"customer_id\":12,\"contact_person_name\":\"Deepak Nogia\",\"address_type\":\"home\",\"address\":\"home\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"7688927161\",\"created_at\":\"2026-03-26T23:53:52.000000Z\",\"updated_at\":\"2026-03-26T23:53:52.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, NULL, 4, '{\"id\":4,\"customer_id\":12,\"contact_person_name\":\"Deepak Nogia\",\"address_type\":\"home\",\"address\":\"home\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"7688927161\",\"created_at\":\"2026-03-26T23:53:52.000000Z\",\"updated_at\":\"2026-03-26T23:53:52.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', 'default_type', 0.00, NULL, 1, 'order_wise', NULL, NULL, NULL),
(100007, '12', 'customer', 'unpaid', 'canceled', 'cash_on_delivery', '', NULL, NULL, 725.19, 0.00, '0', NULL, '4', '2026-05-20 15:57:42', '2026-05-20 15:59:00', 0, NULL, '0', 'inhouse', 0, 0.00, '8039-mDtfg-1779272862', '863997', 1, 'admin', '{\"id\":4,\"customer_id\":12,\"contact_person_name\":\"Deepak Nogia\",\"address_type\":\"home\",\"address\":\"home\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"7688927161\",\"created_at\":\"2026-03-26T23:53:52.000000Z\",\"updated_at\":\"2026-03-26T23:53:52.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, NULL, 4, '{\"id\":4,\"customer_id\":12,\"contact_person_name\":\"Deepak Nogia\",\"address_type\":\"home\",\"address\":\"home\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"7688927161\",\"created_at\":\"2026-03-26T23:53:52.000000Z\",\"updated_at\":\"2026-03-26T23:53:52.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', 'default_type', 0.00, NULL, 1, 'order_wise', NULL, NULL, NULL),
(100009, '12', 'customer', 'unpaid', 'canceled', 'cash_on_delivery', '', NULL, NULL, 46415, 0.00, '0', NULL, '3', '2026-03-03 02:40:40', '2026-03-19 02:08:29', 0, NULL, '0', 'inhouse', 2, 5.00, '4468-2jyWl-1772525440', '604847', 1, 'admin', '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, NULL, 3, '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', 'default_type', 0.00, NULL, 1, 'order_wise', 'third_party_delivery', 'Delhivery', '85100410000114'),
(100010, '12', 'customer', 'unpaid', 'canceled', 'cash_on_delivery', '', NULL, NULL, 21845, 0.00, '0', NULL, '3', '2026-03-03 02:56:45', '2026-04-01 10:59:39', 0, NULL, '0', 'inhouse', 2, 5.00, '3599-XQ5Ee-1772526405', '867324', 1, 'admin', '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, NULL, 3, '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', 'default_type', 0.00, NULL, 1, 'order_wise', 'third_party_delivery', 'Delhivery', '85100410000103'),
(100011, '12', 'customer', 'unpaid', 'canceled', 'cash_on_delivery', '', NULL, NULL, 35000, 0.00, '0', NULL, '3', '2026-03-19 04:08:56', '2026-03-19 04:27:23', 0, NULL, '0', 'inhouse', 0, 0.00, '5288-LbtHl-1773913136', '279599', 3, 'seller', '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', NULL, 0, NULL, 'fghfg', 3, '{\"id\":3,\"customer_id\":5,\"contact_person_name\":\"test\",\"address_type\":\"home\",\"address\":\"vbncvb\",\"city\":\"Ajmer\",\"zip\":\"305003\",\"phone\":\"6544984967\",\"created_at\":\"2026-01-21T06:27:25.000000Z\",\"updated_at\":\"2026-01-21T06:27:25.000000Z\",\"state\":null,\"country\":\"India\",\"latitude\":\"cdc\",\"longitude\":\"cd\",\"is_billing\":0}', 'default_type', 0.00, NULL, 1, 'order_wise', 'third_party_delivery', 'Delhivery', '85100410000125');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `digital_file_after_sell` varchar(191) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `tax` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `tax_model` varchar(20) NOT NULL DEFAULT 'exclude',
  `delivery_status` varchar(15) NOT NULL DEFAULT 'pending',
  `payment_status` varchar(15) NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_method_id` bigint(20) DEFAULT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `variation` varchar(255) DEFAULT NULL,
  `discount_type` varchar(30) DEFAULT NULL,
  `is_stock_decreased` tinyint(1) NOT NULL DEFAULT 1,
  `refund_request` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `seller_id`, `digital_file_after_sell`, `product_details`, `qty`, `price`, `tax`, `discount`, `tax_model`, `delivery_status`, `payment_status`, `created_at`, `updated_at`, `shipping_method_id`, `variant`, `variation`, `discount_type`, `is_stock_decreased`, `refund_request`) VALUES
(11, 100009, 67, 1, NULL, '{\"id\":67,\"added_by\":\"admin\",\"user_id\":1,\"pid\":null,\"name\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"slug\":\"iris-hybrid-dahlia-mix-flower-seeds-15-2J5IjV\",\"tally_name\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"21\\\",\\\"position\\\":1}]\",\"brand_id\":8,\"unit\":\"pc\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-03-03-69a68ed69da1f.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-03-03-69a68ed705da3.png\",\"featured\":1,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"4\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_4\\\",\\\"title\\\":\\\"Weight\\\",\\\"options\\\":[\\\"100seeds\\\",\\\"12seeds\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"100seeds\\\",\\\"price\\\":500,\\\"sku\\\":\\\"IHDMFS(-100seeds\\\",\\\"qty\\\":120},{\\\"type\\\":\\\"12seeds\\\",\\\"price\\\":500,\\\"sku\\\":\\\"IHDMFS(-12seeds\\\",\\\"qty\\\":120}]\",\"published\":0,\"unit_price\":500,\"purchase_price\":800,\"tax\":41,\"tax_type\":\"percent\",\"tax_model\":\"exclude\",\"discount\":50,\"discount_type\":\"percent\",\"current_stock\":240,\"minimum_order_qty\":1,\"details\":\"<p>Overview<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Product Name<\\/th>\\r\\n\\t\\t\\t<td>IRIS HYBRID FLOWER SEEDS DAHLIA MIX (15 SEEDS)<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Brand<\\/th>\\r\\n\\t\\t\\t<td>RS ENTERPRISES<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Type<\\/th>\\r\\n\\t\\t\\t<td>Flower<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Name<\\/th>\\r\\n\\t\\t\\t<td>Dahlia Seeds<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>Product Description<\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Light-&nbsp;<\\/strong>Full Direct Sunlight<\\/li>\\r\\n\\t<li><strong>Watering-&nbsp;<\\/strong>Twice to Thrice a Week<\\/li>\\r\\n\\t<li><strong>Where to grow-&nbsp;<\\/strong>Outdoor<\\/li>\\r\\n\\t<li><strong>Time till harvest-&nbsp;<\\/strong>12-15 Weeks<\\/li>\\r\\n\\t<li><strong>Seasonal Information-<\\/strong>&nbsp;Annuals<\\/li>\\r\\n\\t<li>Dahlias are one of the most rewarding plants and once you grow a dahlia, you don&#39;t go back.<\\/li>\\r\\n\\t<li>With a seemingly endless supply of varieties, there is a dahlia for every gardener.<\\/li>\\r\\n\\t<li>These sun-loving plants need full sun for 6-8 hours in a well draining soil. Grow them in containers or as borders in your garden, they will be the star in any show<\\/li>\\r\\n<\\/ul>\",\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-03-03T07:33:43.000000Z\",\"updated_at\":\"2026-03-03T08:06:04.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"meta_description\":\"These sun-loving plants need full sun for 6-8 hours in a well draining soil. Grow them in containers or as borders in your garden, they will be the star in any show\",\"meta_image\":\"2026-03-03-69a68ed70607c.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":0,\"temp_shipping_cost\":null,\"is_shipping_cost_updated\":null,\"code\":\"110371\",\"reviews_count\":0,\"translations\":[{\"translationable_type\":\"App\\\\Model\\\\Product\",\"translationable_id\":67,\"locale\":\"in\",\"key\":\"name\",\"value\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"id\":13},{\"translationable_type\":\"App\\\\Model\\\\Product\",\"translationable_id\":67,\"locale\":\"in\",\"key\":\"description\",\"value\":\"<p>Overview<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Product Name<\\/th>\\r\\n\\t\\t\\t<td>IRIS HYBRID FLOWER SEEDS DAHLIA MIX (15 SEEDS)<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Brand<\\/th>\\r\\n\\t\\t\\t<td>RS ENTERPRISES<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Type<\\/th>\\r\\n\\t\\t\\t<td>Flower<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Name<\\/th>\\r\\n\\t\\t\\t<td>Dahlia Seeds<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>Product Description<\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Light-&nbsp;<\\/strong>Full Direct Sunlight<\\/li>\\r\\n\\t<li><strong>Watering-&nbsp;<\\/strong>Twice to Thrice a Week<\\/li>\\r\\n\\t<li><strong>Where to grow-&nbsp;<\\/strong>Outdoor<\\/li>\\r\\n\\t<li><strong>Time till harvest-&nbsp;<\\/strong>12-15 Weeks<\\/li>\\r\\n\\t<li><strong>Seasonal Information-<\\/strong>&nbsp;Annuals<\\/li>\\r\\n\\t<li>Dahlias are one of the most rewarding plants and once you grow a dahlia, you don&#39;t go back.<\\/li>\\r\\n\\t<li>With a seemingly endless supply of varieties, there is a dahlia for every gardener.<\\/li>\\r\\n\\t<li>These sun-loving plants need full sun for 6-8 hours in a well draining soil. Grow them in containers or as borders in your garden, they will be the star in any show<\\/li>\\r\\n<\\/ul>\",\"id\":14}],\"reviews\":[]}', 102, 500, 20910, 25500, 'exclude', 'pending', 'unpaid', '2026-03-03 02:40:40', '2026-03-03 02:40:40', NULL, '12seeds', '{\"Weight\":\"12seeds\"}', 'discount_on_product', 1, 0),
(12, 100010, 67, 1, NULL, '{\"id\":67,\"added_by\":\"admin\",\"user_id\":1,\"pid\":null,\"name\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"slug\":\"iris-hybrid-dahlia-mix-flower-seeds-15-2J5IjV\",\"tally_name\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"21\\\",\\\"position\\\":1}]\",\"brand_id\":8,\"unit\":\"pc\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-03-03-69a68ed69da1f.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-03-03-69a68ed705da3.png\",\"featured\":1,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"4\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_4\\\",\\\"title\\\":\\\"Weight\\\",\\\"options\\\":[\\\"100seeds\\\",\\\"12seeds\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"100seeds\\\",\\\"price\\\":500,\\\"sku\\\":\\\"IHDMFS(-100seeds\\\",\\\"qty\\\":120},{\\\"type\\\":\\\"12seeds\\\",\\\"price\\\":500,\\\"sku\\\":\\\"IHDMFS(-12seeds\\\",\\\"qty\\\":48}]\",\"published\":0,\"unit_price\":500,\"purchase_price\":800,\"tax\":41,\"tax_type\":\"percent\",\"tax_model\":\"exclude\",\"discount\":50,\"discount_type\":\"percent\",\"current_stock\":168,\"minimum_order_qty\":1,\"details\":\"<p>Overview<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Product Name<\\/th>\\r\\n\\t\\t\\t<td>IRIS HYBRID FLOWER SEEDS DAHLIA MIX (15 SEEDS)<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Brand<\\/th>\\r\\n\\t\\t\\t<td>RS ENTERPRISES<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Type<\\/th>\\r\\n\\t\\t\\t<td>Flower<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Name<\\/th>\\r\\n\\t\\t\\t<td>Dahlia Seeds<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>Product Description<\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Light-&nbsp;<\\/strong>Full Direct Sunlight<\\/li>\\r\\n\\t<li><strong>Watering-&nbsp;<\\/strong>Twice to Thrice a Week<\\/li>\\r\\n\\t<li><strong>Where to grow-&nbsp;<\\/strong>Outdoor<\\/li>\\r\\n\\t<li><strong>Time till harvest-&nbsp;<\\/strong>12-15 Weeks<\\/li>\\r\\n\\t<li><strong>Seasonal Information-<\\/strong>&nbsp;Annuals<\\/li>\\r\\n\\t<li>Dahlias are one of the most rewarding plants and once you grow a dahlia, you don&#39;t go back.<\\/li>\\r\\n\\t<li>With a seemingly endless supply of varieties, there is a dahlia for every gardener.<\\/li>\\r\\n\\t<li>These sun-loving plants need full sun for 6-8 hours in a well draining soil. Grow them in containers or as borders in your garden, they will be the star in any show<\\/li>\\r\\n<\\/ul>\",\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-03-03T07:33:43.000000Z\",\"updated_at\":\"2026-03-03T08:10:59.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"meta_description\":\"These sun-loving plants need full sun for 6-8 hours in a well draining soil. Grow them in containers or as borders in your garden, they will be the star in any show\",\"meta_image\":\"2026-03-03-69a68ed70607c.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":0,\"temp_shipping_cost\":null,\"is_shipping_cost_updated\":null,\"code\":\"110371\",\"reviews_count\":0,\"translations\":[{\"translationable_type\":\"App\\\\Model\\\\Product\",\"translationable_id\":67,\"locale\":\"in\",\"key\":\"name\",\"value\":\"Iris Hybrid Dahlia Mix Flower Seeds (15)\",\"id\":13},{\"translationable_type\":\"App\\\\Model\\\\Product\",\"translationable_id\":67,\"locale\":\"in\",\"key\":\"description\",\"value\":\"<p>Overview<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Product Name<\\/th>\\r\\n\\t\\t\\t<td>IRIS HYBRID FLOWER SEEDS DAHLIA MIX (15 SEEDS)<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Brand<\\/th>\\r\\n\\t\\t\\t<td>RS ENTERPRISES<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Type<\\/th>\\r\\n\\t\\t\\t<td>Flower<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Name<\\/th>\\r\\n\\t\\t\\t<td>Dahlia Seeds<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>Product Description<\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Light-&nbsp;<\\/strong>Full Direct Sunlight<\\/li>\\r\\n\\t<li><strong>Watering-&nbsp;<\\/strong>Twice to Thrice a Week<\\/li>\\r\\n\\t<li><strong>Where to grow-&nbsp;<\\/strong>Outdoor<\\/li>\\r\\n\\t<li><strong>Time till harvest-&nbsp;<\\/strong>12-15 Weeks<\\/li>\\r\\n\\t<li><strong>Seasonal Information-<\\/strong>&nbsp;Annuals<\\/li>\\r\\n\\t<li>Dahlias are one of the most rewarding plants and once you grow a dahlia, you don&#39;t go back.<\\/li>\\r\\n\\t<li>With a seemingly endless supply of varieties, there is a dahlia for every gardener.<\\/li>\\r\\n\\t<li>These sun-loving plants need full sun for 6-8 hours in a well draining soil. Grow them in containers or as borders in your garden, they will be the star in any show<\\/li>\\r\\n<\\/ul>\",\"id\":14}],\"reviews\":[]}', 48, 500, 9840, 12000, 'exclude', 'pending', 'unpaid', '2026-03-03 02:56:46', '2026-03-03 02:56:46', NULL, '12seeds', '{\"Weight\":\"12seeds\"}', 'discount_on_product', 1, 0),
(15, 100004, 101, 1, NULL, '{\"id\":101,\"added_by\":\"admin\",\"user_id\":1,\"pid\":null,\"name\":\"Pakeeza Watermelon Seeds - F1 Hybrid & High Yielding Variety\",\"slug\":\"pakeeza-watermelon-seeds-f1-hybrid-high-yielding-variety-InFF5t\",\"tally_name\":\"Pakeeza Watermelon Seeds\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"22\\\",\\\"position\\\":1},{\\\"id\\\":\\\"26\\\",\\\"position\\\":2}]\",\"brand_id\":1,\"unit\":\"pc\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-03-07-69ac12badc42d.png\\\",\\\"2026-03-07-69ac12badd70e.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-03-07-69ac12badd984.png\",\"featured\":null,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"4\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_4\\\",\\\"title\\\":\\\"Weight\\\",\\\"options\\\":[\\\"1000seeds\\\",\\\"1500seeds\\\",\\\"2000seeds\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"1000seeds\\\",\\\"price\\\":5000,\\\"sku\\\":\\\"PWS-FH&HYV-1000seeds\\\",\\\"qty\\\":180},{\\\"type\\\":\\\"1500seeds\\\",\\\"price\\\":5000,\\\"sku\\\":\\\"PWS-FH&HYV-1500seeds\\\",\\\"qty\\\":150},{\\\"type\\\":\\\"2000seeds\\\",\\\"price\\\":5000,\\\"sku\\\":\\\"PWS-FH&HYV-2000seeds\\\",\\\"qty\\\":140}]\",\"published\":0,\"unit_price\":5000,\"purchase_price\":7000,\"tax\":10,\"tax_type\":\"percent\",\"tax_model\":\"exclude\",\"discount\":10,\"discount_type\":\"percent\",\"current_stock\":470,\"minimum_order_qty\":1,\"details\":null,\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-03-07T11:57:46.000000Z\",\"updated_at\":\"2026-03-07T11:57:46.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"Fantac Plus Growth Promoter\",\"meta_description\":\"fgfghfhshdfghfgh\",\"meta_image\":\"2026-03-07-69ac12baddc15.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":0,\"temp_shipping_cost\":null,\"is_shipping_cost_updated\":null,\"code\":\"123853\",\"reviews_count\":0,\"translations\":[],\"reviews\":[]}', 1, 5000, 500, 500, 'exclude', 'pending', 'unpaid', '2026-03-09 04:57:29', '2026-03-09 04:57:29', NULL, '1000seeds', '{\"Weight\":\"1000seeds\"}', 'discount_on_product', 1, 0),
(16, 100011, 64, 3, NULL, '{\"id\":64,\"added_by\":\"seller\",\"user_id\":3,\"pid\":50,\"name\":\"Acrobat Fungicide | Stop Late Blight & Downy Mildew Before They Ruin Your Harves\",\"slug\":\"acrobat-fungicide-stop-late-blight-downy-mildew-before-they-ruin-your-harvest-Kgz7vc-h7WJjM\",\"tally_name\":\"Acrobat Fungicide\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"20\\\",\\\"position\\\":1}]\",\"brand_id\":3,\"unit\":\"kg\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-01-19-696e091cb8d46.png\\\",\\\"2026-01-19-696e091d0e39b.png\\\",\\\"2026-01-19-696e091d0e670.png\\\",\\\"2026-01-19-696e091d0e905.png\\\",\\\"2026-01-19-696e091d0eb97.png\\\",\\\"2026-01-19-696e091d0ee97.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-01-19-696e091d0f113.png\",\"featured\":1,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"4\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_4\\\",\\\"title\\\":\\\"Weight\\\",\\\"options\\\":[\\\"100g\\\",\\\"        200g\\\",\\\"        1kg\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"100g\\\",\\\"price\\\":7000,\\\"sku\\\":\\\"AF|SLB&DMBTRYH-100g\\\",\\\"qty\\\":18},{\\\"type\\\":\\\"200g\\\",\\\"price\\\":7000,\\\"sku\\\":\\\"AF|SLB&DMBTRYH-200g\\\",\\\"qty\\\":132},{\\\"type\\\":\\\"1kg\\\",\\\"price\\\":7000,\\\"sku\\\":\\\"AF|SLB&DMBTRYH-1kg\\\",\\\"qty\\\":141}]\",\"published\":0,\"unit_price\":7000,\"purchase_price\":5000,\"tax\":0,\"tax_type\":\"percent\",\"tax_model\":\"include\",\"discount\":0,\"discount_type\":\"percent\",\"current_stock\":291,\"minimum_order_qty\":1,\"details\":\"<p>About Acrobat Fungicide Acrobat Fungicide is from one of most trusted and oldest brand to control Downy Mildew and Late blight fungal diseases. Acrobat Fungicide technical name - Dimethomorph 50% WP Acrobat is supporting Indian Fruits &amp; Vegetable growers to manage their crops most devastating diseases in a highly effective way. It acts fast and effectively against Pythium and Phytophthora species. Acrobat Fungicide Technical Details Technical Content: Dimethomorph 50% WP Mode of Entry: Systemic Action Mode of Action: Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action. Key Features and Benefits Dimethomorph is a systemic morpholine fungicide Effective against all the stages of fungi Acrobat Fungicide has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection Acrobat Fungicide Usage and Crops Recommended Crops: Crops Target Disease Dosage\\/ Acre in (g) Dilution in water (L) Dosage(g) \\/ Litre of water Waiting from last spray to harvest (days) Potato Downy Mildew &amp; Late blight 400 300 L 1.3 16 Grapes Downy Mildew &amp; Late blight 400 300 L 1.3 34 Method of Application: Foliar spray Disclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.<\\/p>\",\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-02-28T06:48:18.000000Z\",\"updated_at\":\"2026-03-19T09:36:14.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"Acrobat Fungicide\",\"meta_description\":\"0000-00-00 00:00:00\",\"meta_image\":\"2026-01-20-696f2734c1579.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":1,\"temp_shipping_cost\":5,\"is_shipping_cost_updated\":0,\"code\":\"895900\",\"reviews_count\":0,\"translations\":[],\"reviews\":[]}', 5, 7000, 0, 0, 'include', 'canceled', 'unpaid', '2026-03-19 04:08:56', '2026-03-19 04:27:22', NULL, '100g', '{\"Weight\":\"100g\"}', 'discount_on_product', 0, 0),
(17, 100005, 50, 1, NULL, '{\"id\":50,\"added_by\":\"admin\",\"user_id\":1,\"pid\":50,\"name\":\"Acrobat Fungicide | Stop Late Blight & Downy Mildew Before They Ruin Your Harves\",\"slug\":\"acrobat-fungicide-stop-late-blight-downy-mildew-before-they-ruin-your-harvest-Kgz7vc\",\"tally_name\":\"Acrobat Fungicide\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"21\\\",\\\"position\\\":1},{\\\"id\\\":\\\"24\\\",\\\"position\\\":2},{\\\"id\\\":\\\"25\\\",\\\"position\\\":3}]\",\"brand_id\":3,\"unit\":\"kg\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-01-19-696e091cb8d46.png\\\",\\\"2026-01-19-696e091d0e39b.png\\\",\\\"2026-01-19-696e091d0e670.png\\\",\\\"2026-01-19-696e091d0e905.png\\\",\\\"2026-01-19-696e091d0eb97.png\\\",\\\"2026-01-19-696e091d0ee97.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-01-19-696e091d0f113.png\",\"featured\":1,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"4\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_4\\\",\\\"title\\\":\\\"Weight\\\",\\\"options\\\":[\\\"100g\\\",\\\"          200g\\\",\\\"          1kg\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"100g\\\",\\\"price\\\":14.15,\\\"sku\\\":\\\"AF|SLB&DMBTRYH-100g\\\",\\\"qty\\\":10},{\\\"type\\\":\\\"200g\\\",\\\"price\\\":14.15,\\\"sku\\\":\\\"AF|SLB&DMBTRYH-200g\\\",\\\"qty\\\":10},{\\\"type\\\":\\\"1kg\\\",\\\"price\\\":145.79,\\\"sku\\\":\\\"AF|SLB&DMBTRYH-1kg\\\",\\\"qty\\\":1852}]\",\"published\":0,\"unit_price\":8000,\"suggested_price\":3150,\"lowest_market_price\":3500,\"purchase_price\":14.15,\"tax\":29,\"tax_type\":\"percent\",\"tax_model\":\"include\",\"discount\":50,\"discount_amount\":4000,\"actual_amount\":4000,\"discount_type\":\"percent\",\"current_stock\":1872,\"minimum_order_qty\":2,\"details\":\"<p>About Acrobat Fungicide Acrobat Fungicide is from one of most trusted and oldest brand to control Downy Mildew and Late blight fungal diseases. Acrobat Fungicide technical name - Dimethomorph 50% WP Acrobat is supporting Indian Fruits &amp; Vegetable growers to manage their crops most devastating diseases in a highly effective way. It acts fast and effectively against Pythium and Phytophthora species. Acrobat Fungicide Technical Details Technical Content: Dimethomorph 50% WP Mode of Entry: Systemic Action Mode of Action: Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action. Key Features and Benefits Dimethomorph is a systemic morpholine fungicide Effective against all the stages of fungi Acrobat Fungicide has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection Acrobat Fungicide Usage and Crops Recommended Crops: Crops Target Disease Dosage\\/ Acre in (g) Dilution in water (L) Dosage(g) \\/ Litre of water Waiting from last spray to harvest (days) Potato Downy Mildew &amp; Late blight 400 300 L 1.3 16 Grapes Downy Mildew &amp; Late blight 400 300 L 1.3 34 Method of Application: Foliar spray Disclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.<\\/p>\",\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-01-19T05:06:13.000000Z\",\"updated_at\":\"2026-03-27T05:19:58.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"Acrobat Fungicide\",\"meta_description\":\"0000-00-00 00:00:00\",\"meta_image\":\"2026-01-20-696f2734c1579.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":0,\"temp_shipping_cost\":null,\"is_shipping_cost_updated\":null,\"code\":\"169395\",\"indexing\":1,\"reviews_count\":0,\"translations\":[],\"reviews\":[]}', 10, 103.5109, 422.791, 728.95, 'include', 'canceled', 'unpaid', '2026-03-27 05:23:57', '2026-05-15 16:19:24', NULL, '1kg', '{\"Weight\":\"1kg\"}', 'discount_on_product', 0, 0),
(18, 100006, 125, 1, NULL, '{\"id\":125,\"added_by\":\"admin\",\"user_id\":1,\"pid\":null,\"name\":\"IRIS IMPORTED OP ROCKET LEAVES WILD\",\"slug\":\"iris-imported-op-rocket-leaves-wild-vAnRLY\",\"tally_name\":\"IRIS IMPORTED OP ROCKET LEAVES WILD\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"22\\\",\\\"position\\\":1}]\",\"brand_id\":9,\"unit\":\"gms\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-05-18-6a0abc1ad98d3.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-05-18-6a0abc1ad9e2f.png\",\"featured\":null,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"4\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_4\\\",\\\"title\\\":\\\"Weight\\\",\\\"options\\\":[\\\"10gms\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"10gms\\\",\\\"price\\\":700,\\\"sku\\\":\\\"IIORLW-10gms\\\",\\\"qty\\\":198}]\",\"published\":0,\"unit_price\":700,\"suggested_price\":0,\"lowest_market_price\":0,\"purchase_price\":700,\"tax\":0,\"tax_type\":\"percent\",\"tax_model\":\"include\",\"discount\":56,\"discount_amount\":392,\"actual_amount\":308,\"discount_type\":\"percent\",\"current_stock\":198,\"minimum_order_qty\":1,\"details\":\"<p>Overview<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Product Name<\\/th>\\r\\n\\t\\t\\t<td>IRIS IMPORTED OP ROCKET LEAVES WILD<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Brand<\\/th>\\r\\n\\t\\t\\t<td>RS ENTERPRISES<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Type<\\/th>\\r\\n\\t\\t\\t<td>Flower<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Crop Name<\\/th>\\r\\n\\t\\t\\t<td>Arugula Seeds<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>Product Description<\\/p>\\r\\n\\r\\n<p><strong>About Seeds<\\/strong><\\/p>\\r\\n\\r\\n<ul>\\r\\n\\t<li>Plant Character : Leaves are edible in nature<\\/li>\\r\\n\\t<li>Leaf Character : Thin lance shaped Leaves<\\/li>\\r\\n\\t<li>Number of Cuttings : Regular pruning when the plant matures. As per requirement.<\\/li>\\r\\n\\t<li>Flavour : Delicate Strong peppery flavour<\\/li>\\r\\n\\t<li>Colour : Bright green<\\/li>\\r\\n<\\/ul>\",\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-05-18T07:13:30.000000Z\",\"updated_at\":\"2026-05-20T07:26:43.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"IRIS IMPORTED OP ROCKET LEAVES WILD\",\"meta_description\":\"Overview\\r\\nProduct Name\\tIRIS IMPORTED OP ROCKET LEAVES WILD\\r\\nBrand\\tRS ENTERPRISES\\r\\nCrop Type\\tFlower\\r\\nCrop Name\\tArugula Seeds\\r\\nProduct Description\\r\\nAbout Seeds\\r\\n\\r\\nPlant Character : Leaves are edible in nature\\r\\nLeaf Character : Thin lance shaped Leaves\\r\\nNumber of Cuttings : Regular pruning when the plant matures. As per requirement.\\r\\nFlavour : Delicate Strong peppery flavour\\r\\nColour : Bright green\",\"meta_image\":\"2026-05-18-6a0abc1ad9f96.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":0,\"temp_shipping_cost\":null,\"is_shipping_cost_updated\":null,\"code\":\"119246\",\"indexing\":1,\"reviews_count\":0,\"translations\":[],\"reviews\":[]}', 1, 700, 0, 392, 'exclude', 'canceled', 'unpaid', '2026-05-20 15:57:10', '2026-05-20 15:58:41', NULL, '10gms', '{\"Weight\":\"10gms\"}', 'discount_on_product', 0, 0),
(19, 100007, 122, 1, NULL, '{\"id\":122,\"added_by\":\"admin\",\"user_id\":1,\"pid\":null,\"name\":\"Dhanuka Godiwa Super Fungicide (Azoxystrobin 18.2% + Difenoconazole 11.4% SC)\",\"slug\":\"dhanuka-godiwa-super-fungicide-azoxystrobin-182-difenoconazole-114-sc-wGYbH4\",\"tally_name\":\"Dhanuka Godiwa Super Fungicide\",\"product_type\":\"physical\",\"category_ids\":\"[{\\\"id\\\":\\\"20\\\",\\\"position\\\":1}]\",\"brand_id\":3,\"unit\":\"ltrs\",\"min_qty\":1,\"refundable\":1,\"digital_product_type\":null,\"digital_file_ready\":null,\"images\":\"[\\\"2026-05-18-6a0ab2f34def7.png\\\",\\\"2026-05-18-6a0ab2f34e4b3.png\\\",\\\"2026-05-18-6a0ab2f34e700.png\\\",\\\"2026-05-18-6a0ab2f34e8dc.png\\\"]\",\"color_image\":\"[]\",\"thumbnail\":\"2026-05-18-6a0ab2f34ead4.png\",\"featured\":null,\"flash_deal\":null,\"video_provider\":\"youtube\",\"video_url\":null,\"colors\":\"[]\",\"variant_product\":0,\"attributes\":\"[\\\"3\\\"]\",\"choice_options\":\"[{\\\"name\\\":\\\"choice_3\\\",\\\"title\\\":\\\"gms\\\",\\\"options\\\":[\\\"200ml\\\",\\\"  500ml\\\",\\\"  1ltr\\\"]}]\",\"variation\":\"[{\\\"type\\\":\\\"200ml\\\",\\\"price\\\":1051,\\\"sku\\\":\\\"DGSF(1+D1S-200ml\\\",\\\"qty\\\":125},{\\\"type\\\":\\\"500ml\\\",\\\"price\\\":2505,\\\"sku\\\":\\\"DGSF(1+D1S-500ml\\\",\\\"qty\\\":149},{\\\"type\\\":\\\"1ltr\\\",\\\"price\\\":4905,\\\"sku\\\":\\\"DGSF(1+D1S-1ltr\\\",\\\"qty\\\":1686}]\",\"published\":0,\"unit_price\":1051,\"suggested_price\":0,\"lowest_market_price\":0,\"purchase_price\":1051,\"tax\":0,\"tax_type\":\"percent\",\"tax_model\":\"include\",\"discount\":31,\"discount_amount\":325.81,\"actual_amount\":725.19,\"discount_type\":\"percent\",\"current_stock\":1960,\"minimum_order_qty\":1,\"details\":\"<p>Overview<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Product Name<\\/th>\\r\\n\\t\\t\\t<td>GODIWA SUPER FUNGICIDE<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Brand<\\/th>\\r\\n\\t\\t\\t<td>Dhanuka<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Category<\\/th>\\r\\n\\t\\t\\t<td>Fungicides<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Technical Content<\\/th>\\r\\n\\t\\t\\t<td>Azoxystrobin 18.2% + Difenoconazole 11.4% w\\/w SC<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Classification<\\/th>\\r\\n\\t\\t\\t<td>Chemical<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<th>Toxicity<\\/th>\\r\\n\\t\\t\\t<td>Blue<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>Product Description<\\/p>\\r\\n\\r\\n<h2>About GODIWA SUPER FUNGICIDE<\\/h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Godiwa Super<\\/strong>&nbsp;is a new generation, systemic broad-spectrum fungicide with protective and curative action.<\\/li>\\r\\n\\t<li>It offers disease control and improves crop health, quality and yield.<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h2>Godiwa Super Technical Details<\\/h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Technical Content:<\\/strong>&nbsp;Azoxystrobin 18.2% + Difenoconazole 11.4% SC<\\/li>\\r\\n\\t<li><strong>Mode of Action:<\\/strong>&nbsp;It&rsquo;s a dual systemic fungicide which inhibits spore germination at the early stage of fungal development. Thus, it protects the crop against invasion by fungal pathogens. It&rsquo;s taken up by the plants and acts on the fungal pathogen during penetration and haustoria formation. Thus, it stops the development of fungi by interfering with the biosynthesis of sterols in the cell membrane.<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h2>Key Features &amp; Benefits<\\/h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li><em>Godiwa Super<\\/em>&nbsp;Dhanuka is a combination of two advanced chemistry and has multisite mode of action which is effective and provides longer duration control on diseases.<\\/li>\\r\\n\\t<li>It&rsquo;s an excellent tool for resistance management.<\\/li>\\r\\n\\t<li>Godiwa Super Fungicide has translaminar and acropetal movement help in quicker and even dispersion in plant system.<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h2>Godiwa Super Fungicide Usage &amp; Crops<\\/h2>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Recommendations:<\\/strong><\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><strong>Recommended Crops<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><strong>Target Pest\\/ Disease<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><strong>Dosage \\/ Acre (ml)<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Paddy<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Sheath blight, blast<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>200<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Tomato<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Early blight, late blight<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>200<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Chilli<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Anthracnose, powdery mildew<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>200<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Maize<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Blight, downy mildew<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>200<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Wheat<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>Powdery mildew, rust<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p>200<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<ul>\\r\\n\\t<li><strong>Method of Application:<\\/strong>&nbsp;Foliar spray<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<p><strong>Disclaimer:<\\/strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.<\\/p>\",\"free_shipping\":0,\"attachment\":null,\"created_at\":\"2026-05-18T06:34:27.000000Z\",\"updated_at\":\"2026-05-20T07:29:29.000000Z\",\"status\":1,\"featured_status\":1,\"meta_title\":\"Dhanuka Godiwa Super Fungicide (Azoxystrobin 18.2% + Difenoconazole 11.4% SC)\",\"meta_description\":\"Overview\\r\\nProduct Name\\tGODIWA SUPER FUNGICIDE\\r\\nBrand\\tDhanuka\\r\\nCategory\\tFungicides\\r\\nTechnical Content\\tAzoxystrobin 18.2% + Difenoconazole 11.4% w\\/w SC\\r\\nClassification\\tChemical\\r\\nToxicity\\tBlue\\r\\nProduct Description\\r\\nAbout GODIWA SUPER FUNGICIDE\\r\\nGodiwa Super is a new generation, systemic broad-spectrum fungicide with protective and curative action.\\r\\nIt offers disease control and improves crop health, quality and yield.\\r\\nGodiwa Super Technical Details\\r\\nTechnical Content: Azoxystrobin 18.2% + Difenoconazole 11.4% SC\\r\\nMode of Action: It\\u2019s a dual systemic fungicide which inhibits spore germination at the early stage of fungal development. Thus, it protects the crop against invasion by fungal pathogens. It\\u2019s taken up by the plants and acts on the fungal pathogen during penetration and haustoria formation. Thus, it stops the development of fungi by interfering with the biosynthesis of sterols in the cell membrane.\\r\\nKey Features & Benefits\\r\\nGodiwa Super Dhanuka is a combination of two advanced chemistry and has multisite mode of action which is effective and provides longer duration control on diseases.\\r\\nIt\\u2019s an excellent tool for resistance management.\\r\\nGodiwa Super Fungicide has translaminar and acropetal movement help in quicker and even dispersion in plant system.\\r\\nGodiwa Super Fungicide Usage & Crops\\r\\nRecommendations:\\r\\nRecommended Crops\\r\\n\\r\\nTarget Pest\\/ Disease\\r\\n\\r\\nDosage \\/ Acre (ml)\\r\\n\\r\\nPaddy\\r\\n\\r\\nSheath blight, blast\\r\\n\\r\\n200\\r\\n\\r\\nTomato\\r\\n\\r\\nEarly blight, late blight\\r\\n\\r\\n200\\r\\n\\r\\nChilli\\r\\n\\r\\nAnthracnose, powdery mildew\\r\\n\\r\\n200\\r\\n\\r\\nMaize\\r\\n\\r\\nBlight, downy mildew\\r\\n\\r\\n200\\r\\n\\r\\nWheat\\r\\n\\r\\nPowdery mildew, rust\\r\\n\\r\\n200\\r\\n\\r\\nMethod of Application: Foliar spray\\r\\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.\",\"meta_image\":\"2026-05-18-6a0ab2f34ed06.png\",\"request_status\":1,\"denied_note\":null,\"shipping_cost\":0,\"multiply_qty\":0,\"temp_shipping_cost\":null,\"is_shipping_cost_updated\":null,\"code\":\"137346\",\"indexing\":1,\"reviews_count\":0,\"translations\":[],\"reviews\":[]}', 1, 1051, 0, 325.81, 'include', 'canceled', 'unpaid', '2026-05-20 15:57:42', '2026-05-20 15:58:44', NULL, '200ml', '{\"gms\":\"200ml\"}', 'discount_on_product', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_expected_delivery_histories`
--

CREATE TABLE `order_expected_delivery_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_type` varchar(191) NOT NULL,
  `expected_delivery_date` date NOT NULL,
  `cause` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status_histories`
--

CREATE TABLE `order_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_type` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `cause` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status_histories`
--

INSERT INTO `order_status_histories` (`id`, `order_id`, `user_id`, `user_type`, `status`, `cause`, `created_at`, `updated_at`) VALUES
(1, 100001, 4, 'customer', 'pending', NULL, '2025-11-25 00:51:27', '2025-11-25 00:51:27'),
(2, 100001, 0, 'admin', 'confirmed', NULL, '2025-11-25 02:32:48', '2025-11-25 02:32:48'),
(3, 100001, 0, 'admin', 'processing', NULL, '2025-11-25 02:33:21', '2025-11-25 02:33:21'),
(4, 100001, 0, 'admin', 'out_for_delivery', NULL, '2025-11-25 02:33:41', '2025-11-25 02:33:41'),
(5, 100001, 0, 'admin', 'delivered', NULL, '2025-11-25 02:35:30', '2025-11-25 02:35:30'),
(6, 100001, 0, 'admin', 'returned', NULL, '2025-11-25 02:37:00', '2025-11-25 02:37:00'),
(7, 100001, 0, 'admin', 'failed', NULL, '2025-11-25 02:37:14', '2025-11-25 02:37:14'),
(8, 100001, 0, 'admin', 'canceled', NULL, '2025-11-25 02:37:27', '2025-11-25 02:37:27'),
(9, 100001, 0, 'admin', 'pending', NULL, '2025-11-25 02:39:30', '2025-11-25 02:39:30'),
(10, 100001, 0, 'admin', 'confirmed', NULL, '2025-11-25 04:13:28', '2025-11-25 04:13:28'),
(11, 100001, 0, 'admin', 'processing', NULL, '2025-11-25 04:13:45', '2025-11-25 04:13:45'),
(12, 100001, 0, 'admin', 'pending', NULL, '2025-11-28 05:20:43', '2025-11-28 05:20:43'),
(13, 100001, 0, 'admin', 'delivered', NULL, '2025-11-28 07:05:46', '2025-11-28 07:05:46'),
(14, 100001, 0, 'admin', 'out_for_delivery', NULL, '2025-11-28 07:05:54', '2025-11-28 07:05:54'),
(15, 100002, 4, 'customer', 'pending', NULL, '2025-11-28 07:08:51', '2025-11-28 07:08:51'),
(16, 100001, 0, 'admin', 'delivered', NULL, '2025-11-28 07:14:07', '2025-11-28 07:14:07'),
(17, 100003, 4, 'customer', 'pending', NULL, '2025-11-28 07:51:18', '2025-11-28 07:51:18'),
(18, 100004, 4, 'customer', 'pending', NULL, '2025-11-28 07:55:54', '2025-11-28 07:55:54'),
(19, 100004, 1, 'seller', 'processing', NULL, '2025-11-28 07:56:56', '2025-11-28 07:56:56'),
(20, 100004, 0, 'admin', 'delivered', NULL, '2025-11-28 07:58:23', '2025-11-28 07:58:23'),
(21, 100005, 4, 'customer', 'pending', NULL, '2025-12-12 07:42:32', '2025-12-12 07:42:32'),
(22, 100005, 0, 'admin', 'delivered', NULL, '2025-12-12 07:46:02', '2025-12-12 07:46:02'),
(23, 100006, 5, 'customer', 'pending', NULL, '2026-01-21 00:57:30', '2026-01-21 00:57:30'),
(24, 100006, 0, 'admin', 'out_for_delivery', NULL, '2026-01-21 05:15:27', '2026-01-21 05:15:27'),
(25, 100007, 5, 'customer', 'pending', NULL, '2026-01-22 04:10:43', '2026-01-22 04:10:43'),
(26, 100006, 0, 'admin', 'delivered', NULL, '2026-02-11 00:06:36', '2026-02-11 00:06:36'),
(27, 100006, 0, 'admin', 'out_for_delivery', NULL, '2026-02-11 00:06:39', '2026-02-11 00:06:39'),
(28, 100006, 0, 'admin', 'processing', NULL, '2026-02-11 00:06:44', '2026-02-11 00:06:44'),
(29, 100006, 0, 'admin', 'out_for_delivery', NULL, '2026-02-11 00:07:22', '2026-02-11 00:07:22'),
(30, 100006, 0, 'admin', 'pending', NULL, '2026-02-11 00:07:31', '2026-02-11 00:07:31'),
(31, 100006, 0, 'admin', 'out_for_delivery', NULL, '2026-02-11 00:07:35', '2026-02-11 00:07:35'),
(32, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 00:21:41', '2026-02-24 00:21:41'),
(33, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 00:21:45', '2026-02-24 00:21:45'),
(34, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 00:34:41', '2026-02-24 00:34:41'),
(35, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 00:38:32', '2026-02-24 00:38:32'),
(36, 100007, 0, 'admin', 'processing', NULL, '2026-02-24 00:50:32', '2026-02-24 00:50:32'),
(37, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 00:50:45', '2026-02-24 00:50:45'),
(38, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 00:53:18', '2026-02-24 00:53:18'),
(39, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 00:54:03', '2026-02-24 00:54:03'),
(40, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 00:58:54', '2026-02-24 00:58:54'),
(41, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:06:21', '2026-02-24 01:06:21'),
(42, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 01:06:25', '2026-02-24 01:06:25'),
(43, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:07:10', '2026-02-24 01:07:10'),
(44, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:09:43', '2026-02-24 01:09:43'),
(45, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:10:28', '2026-02-24 01:10:28'),
(46, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:11:45', '2026-02-24 01:11:45'),
(47, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 01:11:50', '2026-02-24 01:11:50'),
(48, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:14:08', '2026-02-24 01:14:08'),
(49, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 01:14:15', '2026-02-24 01:14:15'),
(50, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:16:31', '2026-02-24 01:16:31'),
(51, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:19:18', '2026-02-24 01:19:18'),
(52, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:19:29', '2026-02-24 01:19:29'),
(53, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:23:20', '2026-02-24 01:23:20'),
(54, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:34:59', '2026-02-24 01:34:59'),
(55, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:40:06', '2026-02-24 01:40:06'),
(56, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:40:47', '2026-02-24 01:40:47'),
(57, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:48:31', '2026-02-24 01:48:31'),
(58, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:52:51', '2026-02-24 01:52:51'),
(59, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 01:53:19', '2026-02-24 01:53:19'),
(60, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 02:14:49', '2026-02-24 02:14:49'),
(61, 100007, 0, 'admin', 'pending', NULL, '2026-02-24 02:15:04', '2026-02-24 02:15:04'),
(62, 100007, 0, 'admin', 'confirmed', NULL, '2026-02-24 02:15:49', '2026-02-24 02:15:49'),
(63, 100007, 0, 'admin', 'pending', NULL, '2026-02-25 06:56:59', '2026-02-25 06:56:59'),
(64, 100005, 0, 'admin', 'pending', NULL, '2026-02-25 07:54:01', '2026-02-25 07:54:01'),
(65, 100005, 0, 'admin', 'delivered', NULL, '2026-02-25 07:54:13', '2026-02-25 07:54:13'),
(66, 100005, 0, 'admin', 'pending', NULL, '2026-02-25 07:55:22', '2026-02-25 07:55:22'),
(67, 100005, 0, 'admin', 'delivered', NULL, '2026-02-25 07:56:20', '2026-02-25 07:56:20'),
(68, 100005, 0, 'admin', 'processing', NULL, '2026-02-25 07:58:52', '2026-02-25 07:58:52'),
(69, 100005, 0, 'admin', 'delivered', NULL, '2026-02-25 07:59:00', '2026-02-25 07:59:00'),
(70, 100007, 0, 'admin', 'pending', NULL, '2026-02-25 08:15:19', '2026-02-25 08:15:19'),
(71, 100007, 0, 'admin', 'delivered', NULL, '2026-02-25 08:15:25', '2026-02-25 08:15:25'),
(72, 100006, 0, 'admin', 'processing', NULL, '2026-02-26 02:45:45', '2026-02-26 02:45:45'),
(73, 100006, 0, 'admin', 'canceled', NULL, '2026-02-26 02:46:19', '2026-02-26 02:46:19'),
(74, 100006, 0, 'admin', 'processing', NULL, '2026-02-26 02:47:10', '2026-02-26 02:47:10'),
(75, 100006, 0, 'admin', 'canceled', NULL, '2026-02-26 02:47:17', '2026-02-26 02:47:17'),
(76, 100006, 0, 'admin', 'confirmed', NULL, '2026-02-26 02:48:33', '2026-02-26 02:48:33'),
(77, 100006, 0, 'admin', 'canceled', NULL, '2026-02-26 02:48:45', '2026-02-26 02:48:45'),
(78, 100006, 0, 'admin', 'confirmed', NULL, '2026-02-26 02:49:46', '2026-02-26 02:49:46'),
(79, 100006, 0, 'admin', 'returned', NULL, '2026-02-26 02:49:57', '2026-02-26 02:49:57'),
(80, 100006, 0, 'admin', 'canceled', NULL, '2026-02-26 02:52:44', '2026-02-26 02:52:44'),
(81, 100006, 0, 'admin', 'confirmed', NULL, '2026-02-26 02:53:17', '2026-02-26 02:53:17'),
(82, 100006, 0, 'admin', 'canceled', NULL, '2026-02-26 03:14:03', '2026-02-26 03:14:03'),
(83, 100007, 0, 'admin', 'delivered', NULL, '2026-02-28 01:27:28', '2026-02-28 01:27:28'),
(84, 100008, 5, 'customer', 'pending', NULL, '2026-03-03 02:36:04', '2026-03-03 02:36:04'),
(85, 100009, 5, 'customer', 'pending', NULL, '2026-03-03 02:40:40', '2026-03-03 02:40:40'),
(86, 100010, 5, 'customer', 'pending', NULL, '2026-03-03 02:56:45', '2026-03-03 02:56:45'),
(87, 100011, 5, 'customer', 'pending', NULL, '2026-03-03 03:01:04', '2026-03-03 03:01:04'),
(88, 100012, 5, 'customer', 'pending', NULL, '2026-03-05 00:13:19', '2026-03-05 00:13:19'),
(89, 100011, 0, 'admin', 'canceled', NULL, '2026-03-05 00:45:44', '2026-03-05 00:45:44'),
(90, 100011, 0, 'admin', 'pending', NULL, '2026-03-05 00:55:09', '2026-03-05 00:55:09'),
(91, 100011, 0, 'admin', 'confirmed', NULL, '2026-03-05 06:37:09', '2026-03-05 06:37:09'),
(92, 100004, 5, 'customer', 'pending', NULL, '2026-03-09 04:57:28', '2026-03-09 04:57:28'),
(93, 100012, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 04:15:54', '2026-03-17 04:15:54'),
(94, 100012, 0, 'admin', 'delivered', NULL, '2026-03-17 04:16:25', '2026-03-17 04:16:25'),
(95, 100012, 0, 'admin', 'pending', NULL, '2026-03-17 04:16:38', '2026-03-17 04:16:38'),
(96, 100012, 0, 'admin', 'confirmed', NULL, '2026-03-17 04:16:51', '2026-03-17 04:16:51'),
(97, 100012, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 04:16:51', '2026-03-17 04:16:51'),
(98, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 04:17:18', '2026-03-17 04:17:18'),
(99, 100012, 0, 'admin', 'processing', NULL, '2026-03-17 05:14:15', '2026-03-17 05:14:15'),
(100, 100012, 0, 'admin', 'pending', NULL, '2026-03-17 05:14:17', '2026-03-17 05:14:17'),
(101, 100010, 0, 'admin', 'pending', NULL, '2026-03-17 05:14:31', '2026-03-17 05:14:31'),
(102, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 05:45:17', '2026-03-17 05:45:17'),
(103, 100010, 0, 'admin', 'pending', NULL, '2026-03-17 05:47:42', '2026-03-17 05:47:42'),
(104, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 05:47:48', '2026-03-17 05:47:48'),
(105, 100010, 0, 'admin', 'pending', NULL, '2026-03-17 05:49:56', '2026-03-17 05:49:56'),
(106, 100012, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 06:26:16', '2026-03-17 06:26:16'),
(107, 100012, 0, 'admin', 'pending', NULL, '2026-03-17 06:27:20', '2026-03-17 06:27:20'),
(108, 100012, 0, 'admin', 'out_for_delivery', NULL, '2026-03-17 06:37:56', '2026-03-17 06:37:56'),
(109, 100012, 0, 'admin', 'pending', NULL, '2026-03-17 06:38:34', '2026-03-17 06:38:34'),
(110, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-18 07:49:05', '2026-03-18 07:49:05'),
(111, 100010, 0, 'admin', 'pending', NULL, '2026-03-18 07:50:24', '2026-03-18 07:50:24'),
(112, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-18 07:51:29', '2026-03-18 07:51:29'),
(113, 100010, 0, 'admin', 'pending', NULL, '2026-03-18 07:53:42', '2026-03-18 07:53:42'),
(114, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-18 07:54:49', '2026-03-18 07:54:49'),
(115, 100010, 0, 'admin', 'pending', NULL, '2026-03-18 07:55:06', '2026-03-18 07:55:06'),
(116, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-18 23:36:12', '2026-03-18 23:36:12'),
(117, 100010, 0, 'admin', 'canceled', NULL, '2026-03-19 01:39:22', '2026-03-19 01:39:22'),
(118, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-19 01:41:12', '2026-03-19 01:41:12'),
(119, 100010, 0, 'admin', 'canceled', NULL, '2026-03-19 01:42:37', '2026-03-19 01:42:37'),
(120, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-03-19 01:45:12', '2026-03-19 01:45:12'),
(121, 100010, 0, 'admin', 'canceled', NULL, '2026-03-19 01:50:00', '2026-03-19 01:50:00'),
(122, 100009, 0, 'admin', 'out_for_delivery', NULL, '2026-03-19 02:06:32', '2026-03-19 02:06:32'),
(123, 100009, 0, 'admin', 'canceled', NULL, '2026-03-19 02:08:29', '2026-03-19 02:08:29'),
(124, 100011, 5, 'customer', 'pending', NULL, '2026-03-19 04:08:56', '2026-03-19 04:08:56'),
(125, 100011, 3, 'seller', 'out_for_delivery', NULL, '2026-03-19 04:24:23', '2026-03-19 04:24:23'),
(126, 100011, 3, 'seller', 'canceled', NULL, '2026-03-19 04:27:23', '2026-03-19 04:27:23'),
(127, 100004, 0, 'admin', 'delivered', NULL, '2026-03-21 06:47:16', '2026-03-21 06:47:16'),
(128, 100005, 12, 'customer', 'pending', NULL, '2026-03-27 05:23:56', '2026-03-27 05:23:56'),
(129, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 05:25:13', '2026-03-27 05:25:13'),
(130, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 05:37:07', '2026-03-27 05:37:07'),
(131, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 05:37:39', '2026-03-27 05:37:39'),
(132, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 05:41:05', '2026-03-27 05:41:05'),
(133, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 05:42:53', '2026-03-27 05:42:53'),
(134, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 05:45:57', '2026-03-27 05:45:57'),
(135, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 05:47:17', '2026-03-27 05:47:17'),
(136, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 05:48:04', '2026-03-27 05:48:04'),
(137, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 05:48:57', '2026-03-27 05:48:57'),
(138, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 05:53:39', '2026-03-27 05:53:39'),
(139, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 05:59:47', '2026-03-27 05:59:47'),
(140, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 06:00:09', '2026-03-27 06:00:09'),
(141, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 06:00:32', '2026-03-27 06:00:32'),
(142, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 06:00:53', '2026-03-27 06:00:53'),
(143, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 06:29:09', '2026-03-27 06:29:09'),
(144, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 06:29:20', '2026-03-27 06:29:20'),
(145, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 06:29:51', '2026-03-27 06:29:51'),
(146, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 06:35:45', '2026-03-27 06:35:45'),
(147, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 10:18:06', '2026-03-27 10:18:06'),
(148, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 10:19:43', '2026-03-27 10:19:43'),
(149, 100005, 0, 'admin', 'pending', NULL, '2026-03-27 10:20:14', '2026-03-27 10:20:14'),
(150, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 10:33:19', '2026-03-27 10:33:19'),
(151, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 10:45:50', '2026-03-27 10:45:50'),
(152, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 10:47:18', '2026-03-27 10:47:18'),
(153, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 10:49:09', '2026-03-27 10:49:09'),
(154, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 10:50:13', '2026-03-27 10:50:13'),
(155, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 10:54:42', '2026-03-27 10:54:42'),
(156, 100005, 0, 'admin', 'out_for_delivery', NULL, '2026-03-27 10:57:43', '2026-03-27 10:57:43'),
(157, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 10:59:27', '2026-03-27 10:59:27'),
(158, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 10:59:55', '2026-03-27 10:59:55'),
(159, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-27 11:00:27', '2026-03-27 11:00:27'),
(160, 100005, 0, 'admin', 'processing', NULL, '2026-03-27 11:01:07', '2026-03-27 11:01:07'),
(161, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:19:27', '2026-03-28 06:19:27'),
(162, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 06:20:55', '2026-03-28 06:20:55'),
(163, 100005, 0, 'admin', 'canceled', NULL, '2026-03-28 06:21:45', '2026-03-28 06:21:45'),
(164, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:23:12', '2026-03-28 06:23:12'),
(165, 100005, 0, 'admin', 'canceled', NULL, '2026-03-28 06:24:44', '2026-03-28 06:24:44'),
(166, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:25:36', '2026-03-28 06:25:36'),
(167, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 06:26:05', '2026-03-28 06:26:05'),
(168, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:27:16', '2026-03-28 06:27:16'),
(169, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 06:29:26', '2026-03-28 06:29:26'),
(170, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:37:06', '2026-03-28 06:37:06'),
(171, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:38:28', '2026-03-28 06:38:28'),
(172, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:41:33', '2026-03-28 06:41:33'),
(173, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:54:10', '2026-03-28 06:54:10'),
(174, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 06:57:05', '2026-03-28 06:57:05'),
(175, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:57:30', '2026-03-28 06:57:30'),
(176, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 06:59:06', '2026-03-28 06:59:06'),
(177, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 06:59:15', '2026-03-28 06:59:15'),
(178, 100005, 0, 'admin', 'canceled', NULL, '2026-03-28 06:59:28', '2026-03-28 06:59:28'),
(179, 100005, 0, 'admin', 'failed', NULL, '2026-03-28 07:00:33', '2026-03-28 07:00:33'),
(180, 100005, 0, 'admin', 'returned', NULL, '2026-03-28 07:01:56', '2026-03-28 07:01:56'),
(181, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 07:05:26', '2026-03-28 07:05:26'),
(182, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 07:06:28', '2026-03-28 07:06:28'),
(183, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 07:08:36', '2026-03-28 07:08:36'),
(184, 100005, 0, 'admin', 'processing', NULL, '2026-03-28 07:12:17', '2026-03-28 07:12:17'),
(185, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 07:12:39', '2026-03-28 07:12:39'),
(186, 100005, 0, 'admin', 'returned', NULL, '2026-03-28 07:12:52', '2026-03-28 07:12:52'),
(187, 100005, 0, 'admin', 'canceled', NULL, '2026-03-28 07:13:00', '2026-03-28 07:13:00'),
(188, 100005, 0, 'admin', 'failed', NULL, '2026-03-28 07:16:21', '2026-03-28 07:16:21'),
(189, 100005, 0, 'admin', 'returned', NULL, '2026-03-28 07:16:54', '2026-03-28 07:16:54'),
(190, 100005, 0, 'admin', 'out_for_delivery', NULL, '2026-03-28 07:17:13', '2026-03-28 07:17:13'),
(191, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 07:17:29', '2026-03-28 07:17:29'),
(192, 100005, 0, 'admin', 'canceled', NULL, '2026-03-28 07:17:58', '2026-03-28 07:17:58'),
(193, 100005, 0, 'admin', 'failed', NULL, '2026-03-28 07:18:23', '2026-03-28 07:18:23'),
(194, 100005, 0, 'admin', 'canceled', NULL, '2026-03-28 07:24:23', '2026-03-28 07:24:23'),
(195, 100005, 0, 'admin', 'failed', NULL, '2026-03-28 07:27:21', '2026-03-28 07:27:21'),
(196, 100005, 0, 'admin', 'confirmed', NULL, '2026-03-28 07:35:57', '2026-03-28 07:35:57'),
(197, 100005, 0, 'admin', 'out_for_delivery', NULL, '2026-04-01 10:57:56', '2026-04-01 10:57:56'),
(198, 100010, 0, 'admin', 'out_for_delivery', NULL, '2026-04-01 10:58:48', '2026-04-01 10:58:48'),
(199, 100010, 0, 'admin', 'canceled', NULL, '2026-04-01 10:59:39', '2026-04-01 10:59:39'),
(200, 100005, 0, 'admin', 'delivered', NULL, '2026-05-15 16:18:11', '2026-05-15 16:18:11'),
(201, 100005, 0, 'admin', 'canceled', NULL, '2026-05-15 16:19:25', '2026-05-15 16:19:25'),
(202, 100006, 12, 'customer', 'pending', NULL, '2026-05-20 15:57:10', '2026-05-20 15:57:10'),
(203, 100007, 12, 'customer', 'pending', NULL, '2026-05-20 15:57:42', '2026-05-20 15:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

CREATE TABLE `order_transactions` (
  `seller_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_amount` decimal(50,2) NOT NULL DEFAULT 0.00,
  `seller_amount` decimal(50,2) NOT NULL DEFAULT 0.00,
  `admin_commission` decimal(50,2) NOT NULL DEFAULT 0.00,
  `received_by` varchar(191) NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `delivery_charge` decimal(50,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(50,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `seller_is` varchar(191) DEFAULT NULL,
  `delivered_by` varchar(191) NOT NULL DEFAULT 'admin',
  `payment_method` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_transactions`
--

INSERT INTO `order_transactions` (`seller_id`, `order_id`, `order_amount`, `seller_amount`, `admin_commission`, `received_by`, `status`, `delivery_charge`, `tax`, `created_at`, `updated_at`, `customer_id`, `seller_is`, `delivered_by`, `payment_method`, `transaction_id`, `id`) VALUES
(1, 100001, 9868.00, 9868.00, 0.00, 'admin', 'disburse', 5.00, 998.80, '2025-11-25 02:35:30', '2025-11-25 02:35:30', 4, 'admin', 'admin', 'cash_on_delivery', '8038-oj8k8-1764057930', 1),
(1, 100004, 9975.00, 9975.00, 0.00, 'admin', 'disburse', 5.00, 1125.00, '2025-11-28 07:58:23', '2025-11-28 07:58:23', 4, 'seller', 'admin', 'cash_on_delivery', '2639-8bALW-1764336503', 2),
(1, 100005, 1089.00, 1089.00, 0.00, 'admin', 'disburse', 5.00, 60.50, '2025-12-12 07:46:02', '2025-12-12 07:46:02', 4, 'admin', 'admin', 'cash_on_delivery', '2414-YdD3o-1765545362', 3),
(1, 100006, 4.01, 4.01, 0.00, 'admin', 'disburse', 5.00, 0.00, '2026-02-11 00:06:36', '2026-02-11 00:06:36', 5, 'admin', 'admin', 'cash_on_delivery', '1846-x5gWX-1770788196', 4),
(1, 100007, 5.67, 5.67, 0.00, 'admin', 'disburse', 5.00, 0.00, '2026-02-25 08:15:25', '2026-02-25 08:15:25', 5, 'admin', 'admin', 'cash_on_delivery', '6574-msyXV-1772027125', 5),
(1, 100012, 259200.00, 259200.00, 0.00, 'admin', 'disburse', 5.00, 28800.00, '2026-03-17 04:16:25', '2026-03-17 04:16:25', 5, 'admin', 'admin', 'cash_on_delivery', '5086-AUBMx-1773740785', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `identity` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(191) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paytabs_invoices`
--

CREATE TABLE `paytabs_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `result` text NOT NULL,
  `response_code` int(10) UNSIGNED NOT NULL,
  `pt_invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `currency` varchar(191) DEFAULT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `card_brand` varchar(191) DEFAULT NULL,
  `card_first_six_digits` int(10) UNSIGNED DEFAULT NULL,
  `card_last_four_digits` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_or_email_verifications`
--

CREATE TABLE `phone_or_email_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_or_email` varchar(191) DEFAULT NULL,
  `token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `tally_name` varchar(255) DEFAULT NULL,
  `product_type` varchar(20) NOT NULL DEFAULT 'physical',
  `category_ids` varchar(80) DEFAULT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `unit` varchar(191) DEFAULT NULL,
  `min_qty` int(11) NOT NULL DEFAULT 1,
  `refundable` tinyint(1) NOT NULL DEFAULT 1,
  `digital_product_type` varchar(30) DEFAULT NULL,
  `digital_file_ready` varchar(191) DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `color_image` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `featured` varchar(255) DEFAULT NULL,
  `flash_deal` varchar(255) DEFAULT NULL,
  `video_provider` varchar(30) DEFAULT NULL,
  `video_url` varchar(150) DEFAULT NULL,
  `colors` varchar(150) DEFAULT NULL,
  `variant_product` tinyint(1) NOT NULL DEFAULT 0,
  `attributes` varchar(255) DEFAULT NULL,
  `choice_options` text DEFAULT NULL,
  `variation` text DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `unit_price` double NOT NULL DEFAULT 0,
  `suggested_price` double(24,2) NOT NULL DEFAULT 0.00,
  `lowest_market_price` double(24,2) NOT NULL DEFAULT 0.00,
  `purchase_price` double NOT NULL DEFAULT 0,
  `tax` varchar(191) NOT NULL DEFAULT '0.00',
  `tax_type` varchar(80) DEFAULT NULL,
  `tax_model` varchar(20) NOT NULL DEFAULT 'exclude',
  `discount` varchar(191) NOT NULL DEFAULT '0.00',
  `discount_amount` double(12,2) NOT NULL DEFAULT 0.00,
  `actual_amount` double(12,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(80) DEFAULT NULL,
  `current_stock` int(11) DEFAULT NULL,
  `minimum_order_qty` int(11) NOT NULL DEFAULT 1,
  `details` text DEFAULT NULL,
  `free_shipping` tinyint(1) NOT NULL DEFAULT 0,
  `attachment` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `featured_status` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_image` varchar(191) DEFAULT NULL,
  `request_status` tinyint(1) NOT NULL DEFAULT 0,
  `denied_note` varchar(191) DEFAULT NULL,
  `shipping_cost` double(8,2) DEFAULT NULL,
  `multiply_qty` tinyint(1) DEFAULT NULL,
  `temp_shipping_cost` double(8,2) DEFAULT NULL,
  `is_shipping_cost_updated` tinyint(1) DEFAULT NULL,
  `code` varchar(191) DEFAULT NULL,
  `indexing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `added_by`, `user_id`, `pid`, `name`, `slug`, `tally_name`, `product_type`, `category_ids`, `brand_id`, `unit`, `min_qty`, `refundable`, `digital_product_type`, `digital_file_ready`, `images`, `color_image`, `thumbnail`, `featured`, `flash_deal`, `video_provider`, `video_url`, `colors`, `variant_product`, `attributes`, `choice_options`, `variation`, `published`, `unit_price`, `suggested_price`, `lowest_market_price`, `purchase_price`, `tax`, `tax_type`, `tax_model`, `discount`, `discount_amount`, `actual_amount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `free_shipping`, `attachment`, `created_at`, `updated_at`, `status`, `featured_status`, `meta_title`, `meta_description`, `meta_image`, `request_status`, `denied_note`, `shipping_cost`, `multiply_qty`, `temp_shipping_cost`, `is_shipping_cost_updated`, `code`, `indexing`) VALUES
(103, 'admin', 1, NULL, 'Biovita Liquid Biofertilizer (Seaweed Extract – Ascophyllum nodosum)', 'biovita-liquid-biofertilizer-seaweed-extract-ascophyllum-nodosum-4rC5XV', 'Biovita Liquid Biofertilizer', 'physical', '[{\"id\":\"19\",\"position\":1}]', 5, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-15-6a07090cacd64.png\",\"2026-05-15-6a07090cad35b.png\",\"2026-05-15-6a07090cad5b0.png\",\"2026-05-15-6a07090cad90b.png\",\"2026-05-15-6a07090cadb2a.png\",\"2026-05-15-6a07090cadcf9.png\",\"2026-05-15-6a07090cade97.png\",\"2026-05-15-6a07090cae07b.png\",\"2026-05-15-6a07090cae259.png\",\"2026-05-15-6a07090cae408.png\"]', '[]', '2026-05-15-6a07090cae601.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"1LTR\",\"  100ML\",\"  250ML\"]}]', '[{\"type\":\"1LTR\",\"price\":1357,\"sku\":\"Biovita Liquid Biofertilizer-1LTR\",\"qty\":100},{\"type\":\"100ML\",\"price\":182,\"sku\":\"Biovita Liquid Biofertilizer-100ML\",\"qty\":120},{\"type\":\"250ML\",\"price\":390,\"sku\":\"Biovita Liquid Biofertilizer-250ML\",\"qty\":150}]', 0, 1357, 0.00, 0.00, 1357, '0.00', 'percent', 'include', '41', 556.37, 800.63, 'percent', 370, 10, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Biovita Liquid BioFertilizer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>PI Industries</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Biostimulants</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Seaweed extracts (Ascophyllum nodosum)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Bio/Organic</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Biovita Liquid BioFertilizer</h2>\r\n\r\n<ul>\r\n	<li><strong>Biovita&nbsp;</strong>is a liquid seaweed biofertilizer offered by PI Industries.</li>\r\n	<li><strong>Biovita technical name -&nbsp;<em>Ascophyllum nodosum</em></strong></li>\r\n	<li>It is a natural biostimulant that contains a concentrated extract of seaweed&nbsp;<em>Ascophyllum nodosum.</em></li>\r\n	<li>It is an organic product that provides over 60 naturally occurring nutrients and plant development substances, including enzymes, proteins, cytokinin, amino acids, vitamins, gibberellins, auxins, betains, etc., in organic form.</li>\r\n	<li>It&rsquo;s designed to enhance plant growth and productivity and can be used on various types of plants, whether indoor, outdoor, garden, nursery, lawns, turf, agriculture, or plantation crops.</li>\r\n</ul>\r\n\r\n<h2><strong>Biovita Liquid BioFertilizer&nbsp;</strong>Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Composition:</strong></li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Component</td>\r\n			<td>Percentage</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Natural Seaweed Extract</td>\r\n			<td>20.00 min</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Preservatives</td>\r\n			<td>0.25 max</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aquoeus diluent</td>\r\n			<td>100 to makeup</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li><strong>Mode of Entry:&nbsp;</strong>Systemic</li>\r\n	<li><strong>Mode of Action:</strong>PI Biovita works by stimulating the plant&#39;s natural growth processes. The nutrients in Biovita help to increase the plant&#39;s ability to absorb water and nutrients, and they also help to improve the plant&#39;s resistance to stress.</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features and Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li><em>BIOVITA&nbsp;</em>provides over 60 naturally occurring major and minor nutrients and plant development substances comprising of enzymes, proteins, cytokinins, amino acids, vitamins, gibberellins, auxins, betains etc. in organic form.</li>\r\n	<li>It provides all constituents in balanced form for healthier plant growth.</li>\r\n	<li>It contributes to greater microbial activity when applied to soil and thus increasing the nutrient availability to plants.</li>\r\n	<li>It is an ideal organic product for better growth and productivity, which can be used on all types of plants, whether indoor, outdoor, garden, nursery, lawns, turf, agriculture or plantation crops.</li>\r\n	<li>Biovita improves root and shoot growth and higher flower and fruit set.</li>\r\n</ul>\r\n\r\n<h2>Biovita Usage and Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommended Crops:&nbsp;</strong>Field crops, Vegetables, Fruits, Plantation crops, Flowers &amp; pot plants, Turf and Lawns.</li>\r\n	<li><strong>Dosage:&nbsp;</strong>2 ml /1 L of water &amp; 400 ml/ Acre</li>\r\n	<li><strong>Method of Application:&nbsp;</strong>Foliar Application during Vegetative, Flowering and Fruit Development stage</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-15 17:22:44', '2026-05-15 17:43:08', 1, 1, 'Biovita Liquid Biofertilizer', 'Overview\r\nProduct Name	Biovita Liquid BioFertilizer\r\nBrand	PI Industries\r\nCategory	Biostimulants\r\nTechnical Content	Seaweed extracts (Ascophyllum nodosum)\r\nClassification	Bio/Organic\r\nProduct Description\r\nAbout Biovita Liquid BioFertilizer\r\nBiovita is a liquid seaweed biofertilizer offered by PI Industries.\r\nBiovita technical name - Ascophyllum nodosum\r\nIt is a natural biostimulant that contains a concentrated extract of seaweed Ascophyllum nodosum.\r\nIt is an organic product that provides over 60 naturally occurring nutrients and plant development substances, including enzymes, proteins, cytokinin, amino acids, vitamins, gibberellins, auxins, betains, etc., in organic form.\r\nIt’s designed to enhance plant growth and productivity and can be used on various types of plants, whether indoor, outdoor, garden, nursery, lawns, turf, agriculture, or plantation crops.\r\nBiovita Liquid BioFertilizer Technical Details\r\nComposition:\r\nComponent	Percentage\r\nNatural Seaweed Extract	20.00 min\r\nPreservatives	0.25 max\r\nAquoeus diluent	100 to makeup\r\n \r\n\r\nMode of Entry: Systemic\r\nMode of Action:PI Biovita works by stimulating the plant\'s natural growth processes. The nutrients in Biovita help to increase the plant\'s ability to absorb water and nutrients, and they also help to improve the plant\'s resistance to stress.\r\nKey Features and Benefits\r\nBIOVITA provides over 60 naturally occurring major and minor nutrients and plant development substances comprising of enzymes, proteins, cytokinins, amino acids, vitamins, gibberellins, auxins, betains etc. in organic form.\r\nIt provides all constituents in balanced form for healthier plant growth.\r\nIt contributes to greater microbial activity when applied to soil and thus increasing the nutrient availability to plants.\r\nIt is an ideal organic product for better growth and productivity, which can be used on all types of plants, whether indoor, outdoor, garden, nursery, lawns, turf, agriculture or plantation crops.\r\nBiovita improves root and shoot growth and higher flower and fruit set.\r\nBiovita Usage and Crops\r\nRecommended Crops: Field crops, Vegetables, Fruits, Plantation crops, Flowers & pot plants, Turf and Lawns.\r\nDosage: 2 ml /1 L of water & 400 ml/ Acre\r\nMethod of Application: Foliar Application during Vegetative, Flowering and Fruit Development stage\r\nDisclaimer:\r\nThis information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-15-6a07090cae8a1.png', 1, NULL, 0.00, 0, NULL, NULL, '164322', 1),
(104, 'admin', 1, NULL, 'Fantac Plus Growth Promoter (Amino Acid & Vitamins) for Vegetables, Flowers & Mo', 'fantac-plus-growth-promoter-amino-acid-vitamins-for-vegetables-flowers-more-Iq7BKV', 'Fantac Plus Growth Promoter', 'physical', '[{\"id\":\"19\",\"position\":1}]', 8, 'kg', 1, 1, NULL, NULL, '[\"2026-05-16-6a080c0d5a8b4.png\",\"2026-05-16-6a080c0d5cb1f.png\",\"2026-05-16-6a080c0d5cce5.png\",\"2026-05-16-6a080c0d5cec6.png\",\"2026-05-16-6a080c0d5d04f.png\",\"2026-05-16-6a080c0d5d21c.png\",\"2026-05-16-6a080c0d5d3f9.png\",\"2026-05-16-6a080c0d5d5b8.png\",\"2026-05-16-6a080c0d5d92e.png\",\"2026-05-16-6a080c0d5dae8.png\"]', '[]', '2026-05-16-6a080c0d5dcb0.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"100ml\",\"  250ml\",\"  500ml\"]}]', '[{\"type\":\"100ml\",\"price\":1050,\"sku\":\"FPGP(A&VfVF&M-100ml\",\"qty\":189},{\"type\":\"250ml\",\"price\":1050,\"sku\":\"FPGP(A&VfVF&M-250ml\",\"qty\":165},{\"type\":\"500ml\",\"price\":1050,\"sku\":\"FPGP(A&VfVF&M-500ml\",\"qty\":187}]', 0, 1050, 0.00, 0.00, 1050, '0.00', 'percent', 'include', '34', 357.00, 693.00, 'percent', 541, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Fantac Plus Growth Promoter</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Coromandel International</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Growth Boosters/Promoters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Amino Acids &amp; Vitamins</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Bio/Organic</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Fantac Plus Growth Promoter</h2>\r\n\r\n<ul>\r\n	<li><strong>Fantac Plus</strong>&nbsp;growth promoter is an L-cysteine-based plant growth regulator, it is a combination of all essential amino acids and vitamins required for both vegetative and reproductive growth of plants.</li>\r\n	<li>Depending upon the specific requirement of the plant it supplies the essential amino acids.</li>\r\n	<li>It enhances stomatal growth &amp; chlorophyll synthesis.</li>\r\n	<li>It increases plant resistance to extreme temperatures, high humidity, frost, pest attack, floods and drought.</li>\r\n</ul>\r\n\r\n<h2>Composition &amp; Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:</strong>&nbsp;Amino Acids and Vitamins.</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;It is an amino acid-based product. They represent building blocks for several other biosynthesis pathways and play pivotal roles during signaling processes as well as in plant stress response.</li>\r\n</ul>\r\n\r\n<h2>Key Features and Benefits</h2>\r\n\r\n<ul>\r\n	<li>It helps in both vegetative and reproductive growth.</li>\r\n	<li><em>Fantac Plus</em>&nbsp;helps to overcome stressful conditions.</li>\r\n	<li>It helps in better flowering, fruit development and yield.</li>\r\n	<li>It promotes femaleness in dioecious flowers.</li>\r\n	<li>It ensures better fruit quality and thus ensures better prices.</li>\r\n</ul>\r\n\r\n<h2>Fantac Plus Usage &amp; Crops</h2>\r\n\r\n<ul>\r\n	<li>Recommended Crops: Vegetables, Cucurbits, Potato, Cash Crops, Cereals, Flowers &amp; Horticultural Crops</li>\r\n	<li><strong>Dosage:</strong>&nbsp;100 &ndash; 150 ml / Acre</li>\r\n	<li><strong>Method of Application:</strong>&nbsp;Foliar Application.</li>\r\n</ul>\r\n\r\n<h2>Additional Information</h2>\r\n\r\n<ul>\r\n	<li>Fantac Plus&nbsp;is compatible with all the insecticides and fungicides available in the market.</li>\r\n	<li>No phytotoxicity observed when used as per recommended label.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 11:47:49', '2026-05-20 13:54:38', 1, 1, 'Fantac Plus Growth Promoter', 'Overview\r\nProduct Name	Fantac Plus Growth Promoter\r\nBrand	Coromandel International\r\nCategory	Growth Boosters/Promoters\r\nTechnical Content	Amino Acids & Vitamins\r\nClassification	Bio/Organic\r\nProduct Description\r\nAbout Fantac Plus Growth Promoter\r\nFantac Plus growth promoter is an L-cysteine-based plant growth regulator, it is a combination of all essential amino acids and vitamins required for both vegetative and reproductive growth of plants.\r\nDepending upon the specific requirement of the plant it supplies the essential amino acids.\r\nIt enhances stomatal growth & chlorophyll synthesis.\r\nIt increases plant resistance to extreme temperatures, high humidity, frost, pest attack, floods and drought.\r\nComposition & Technical Details\r\nTechnical Content: Amino Acids and Vitamins.\r\nMode of Action: It is an amino acid-based product. They represent building blocks for several other biosynthesis pathways and play pivotal roles during signaling processes as well as in plant stress response.\r\nKey Features and Benefits\r\nIt helps in both vegetative and reproductive growth.\r\nFantac Plus helps to overcome stressful conditions.\r\nIt helps in better flowering, fruit development and yield.\r\nIt promotes femaleness in dioecious flowers.\r\nIt ensures better fruit quality and thus ensures better prices.\r\nFantac Plus Usage & Crops\r\nRecommended Crops: Vegetables, Cucurbits, Potato, Cash Crops, Cereals, Flowers & Horticultural Crops\r\nDosage: 100 – 150 ml / Acre\r\nMethod of Application: Foliar Application.\r\nAdditional Information\r\nFantac Plus is compatible with all the insecticides and fungicides available in the market.\r\nNo phytotoxicity observed when used as per recommended label.\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a080c0d5df00.png', 1, NULL, 0.00, 0, NULL, NULL, '117147', 1),
(105, 'admin', 1, NULL, 'Multiplex Allbor Boron 20% Fertilizer for Boron Deficiency Correction in Crops', 'multiplex-allbor-boron-20-fertilizer-for-boron-deficiency-correction-in-crops-jl9sCU', 'Multiplex Allbor Boron', 'physical', '[{\"id\":\"19\",\"position\":1}]', 4, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-16-6a080e116e5e9.png\",\"2026-05-16-6a080e116ec0e.png\",\"2026-05-16-6a080e116eec1.png\",\"2026-05-16-6a080e116f395.png\",\"2026-05-16-6a080e116f84c.png\",\"2026-05-16-6a080e116fb04.png\",\"2026-05-16-6a080e117001f.png\",\"2026-05-16-6a080e11702be.png\",\"2026-05-16-6a080e1170577.png\"]', '[]', '2026-05-16-6a080e1170877.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"250 gm\",\"  500mg\",\"  1kg\"]}]', '[{\"type\":\"250gm\",\"price\":270,\"sku\":\"MAB2FfBDCiC-250gm\",\"qty\":16},{\"type\":\"500mg\",\"price\":485,\"sku\":\"MAB2FfBDCiC-500mg\",\"qty\":189},{\"type\":\"1kg\",\"price\":920,\"sku\":\"MAB2FfBDCiC-1kg\",\"qty\":1231}]', 0, 270, 0.00, 0.00, 270, '0.00', 'percent', 'include', '28', 75.60, 194.40, 'percent', 1436, 10, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Allbor - 20% Boron (Minimum) Multi Micronutrient Fertilizer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Multiplex</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fertilizers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Boron 20%</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Allbor - 20% Boron (Minimum) Multi Micronutrient Fertilizer</h2>\r\n\r\n<ul>\r\n	<li><strong>Multiplex Allbor - Boron 20%</strong>&nbsp;is a boron micronutrient fertiliser that contains 20% boron in a water-soluble form.</li>\r\n	<li>It is particularly formulated to prevent and correct boron deficiency in various crops.</li>\r\n	<li>It is recommended for use in fruit and vegetable crops like tomatoes, chillies, and capsicums.</li>\r\n</ul>\r\n\r\n<h2><strong>Multiplex Allbor - Boron 20% Composition &amp; Technical Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:</strong>&nbsp;Boron 20 %</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>It helps to control flower shedding.</li>\r\n	<li>Its application increases sweetness, size, colour, and yield of the crop.</li>\r\n	<li>It helps to increase root elongation in seedlings, regulates growth hormones.</li>\r\n	<li>It increases flower initiation, and fruit setting.</li>\r\n	<li>It enhances grain filling, sugar content of fruits, and size of fruits.</li>\r\n	<li>It increases the pigmentation and water retention capacity in leaves.</li>\r\n</ul>\r\n\r\n<h2><strong>Multiplex Allbor - Boron 20% Usage &amp; Crops</strong></h2>\r\n\r\n<p><strong>Recommended Crops:</strong>&nbsp;All fruit and vegetable crops</p>\r\n\r\n<p><strong>Dosage:</strong>&nbsp;1 gm/ 1 L of water</p>\r\n\r\n<p><strong>Method of Application:</strong>&nbsp;Foliar Spray</p>\r\n\r\n<ul>\r\n	<li><strong>First Spray:</strong>&nbsp;Just before flowering and</li>\r\n	<li><strong>Second spray:</strong>&nbsp;10 -12 days after first spray.</li>\r\n</ul>\r\n\r\n<p>Two sprays during the cropping season are enough to meet the boron requirement of the crop.</p>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>Application of all boron products should be applied cautiously, because the gap between deficiency and sufficiency is very narrow as far as boron requirement of the plant is concerned.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 11:56:25', '2026-05-20 13:56:27', 1, 1, 'Multiplex Allbor Boron 20% Fertilizer for Boron Deficiency Correction in Crops', 'Overview\r\nProduct Name	Allbor - 20% Boron (Minimum) Multi Micronutrient Fertilizer\r\nBrand	Multiplex\r\nCategory	Fertilizers\r\nTechnical Content	Boron 20%\r\nClassification	Chemical\r\nProduct Description\r\nAbout Allbor - 20% Boron (Minimum) Multi Micronutrient Fertilizer\r\nMultiplex Allbor - Boron 20% is a boron micronutrient fertiliser that contains 20% boron in a water-soluble form.\r\nIt is particularly formulated to prevent and correct boron deficiency in various crops.\r\nIt is recommended for use in fruit and vegetable crops like tomatoes, chillies, and capsicums.\r\nMultiplex Allbor - Boron 20% Composition & Technical Details\r\nTechnical Content: Boron 20 %\r\nKey Features & Benefits\r\nIt helps to control flower shedding.\r\nIts application increases sweetness, size, colour, and yield of the crop.\r\nIt helps to increase root elongation in seedlings, regulates growth hormones.\r\nIt increases flower initiation, and fruit setting.\r\nIt enhances grain filling, sugar content of fruits, and size of fruits.\r\nIt increases the pigmentation and water retention capacity in leaves.\r\nMultiplex Allbor - Boron 20% Usage & Crops\r\nRecommended Crops: All fruit and vegetable crops\r\n\r\nDosage: 1 gm/ 1 L of water\r\n\r\nMethod of Application: Foliar Spray\r\n\r\nFirst Spray: Just before flowering and\r\nSecond spray: 10 -12 days after first spray.\r\nTwo sprays during the cropping season are enough to meet the boron requirement of the crop.\r\n\r\nAdditional Information\r\nApplication of all boron products should be applied cautiously, because the gap between deficiency and sufficiency is very narrow as far as boron requirement of the plant is concerned.\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a080e1170b43.png', 1, NULL, 0.00, 0, NULL, NULL, '182975', 1),
(106, 'admin', 1, NULL, 'Tata Ralligold (Mycorrhizal Biofertilizer) VAM-Based Root Growth Enhancer', 'tata-ralligold-mycorrhizal-biofertilizer-vam-based-root-growth-enhancer-3oDrsd', 'Tata Ralligold', 'physical', '[{\"id\":\"19\",\"position\":1}]', 2, 'gms', 1, 1, NULL, NULL, '[\"2026-05-16-6a081e3e4598a.png\",\"2026-05-16-6a081e3e45f23.png\",\"2026-05-16-6a081e3e464c8.png\",\"2026-05-16-6a081e3e46a77.png\",\"2026-05-16-6a081e3e46d6e.png\",\"2026-05-16-6a081e3e47019.png\"]', '[]', '2026-05-16-6a081e3e4751e.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"4kg\"]}]', '[{\"type\":\"4kg\",\"price\":860,\"sku\":\"TR(BVRGE-4kg\",\"qty\":149}]', 0, 860, 0.00, 0.00, 860, '0.00', 'percent', 'include', '1', 8.60, 851.40, 'percent', 149, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Ralligold GR Biofertilizer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Tata Rallis</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Bio Fertilizers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Vesicular Arbuscular Mycorhiza</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Bio/Organic</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Ralligold GR Biofertilizer</h2>\r\n\r\n<ul>\r\n	<li><strong>Tata Ralligold</strong>&nbsp;is a biofertilizer product designed for agricultural use.</li>\r\n	<li>It Is a unique mycorrhizal rooting stimulant that contains a blend of humic acids, Vesicular-Arbuscular Mycorrhizae (VAM), kelp, vitamins, and amino acids.</li>\r\n	<li>This product is known for enhancing plant growth.</li>\r\n</ul>\r\n\r\n<h2><strong>Tata Ralligold Composition &amp; Technical Details</strong></h2>\r\n\r\n<p><strong>Composition:</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Component</td>\r\n			<td>Percentage</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mycorrhiza</td>\r\n			<td>23.30%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Humic acid</td>\r\n			<td>28.90%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cold water kelp extract</td>\r\n			<td>18.00%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ascorbic acid</td>\r\n			<td>12.30%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Amino acid</td>\r\n			<td>08.30%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Myoinositol</td>\r\n			<td>03.50%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Surfactant</td>\r\n			<td>02.50%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thiamine</td>\r\n			<td>2%</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Alpha tocopherol</td>\r\n			<td>1%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Better germination, better grain filling.</li>\r\n	<li>Rapid root growth and nutrient uptake.</li>\r\n	<li>increased no of tillers.</li>\r\n	<li>Improves uptake of phosphorus by the crop.</li>\r\n	<li>Excellent yield enhancement</li>\r\n	<li>Helps in imparting disease resistance in plant and nematode control to some extent.</li>\r\n</ul>\r\n\r\n<h2><strong>Recommended</strong></h2>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<th>Crop</th>\r\n			<th>Dose g/acre</th>\r\n			<th>Time Of Application</th>\r\n			<th>Remarks</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Brinjal</td>\r\n			<td>Soil application: 4kg per acre</td>\r\n			<td>Apply Ralligold GR just before transplanting</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cauliflower</td>\r\n			<td>4 kg per acre Soil application</td>\r\n			<td>Final land preparation</td>\r\n			<td>Along with Geogreen/Organic manure</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chilly</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Apply Ralligold GR just before transplanting</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cotton</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Within 20 - 25 DAS with first fertiliser application</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cumin</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Garlic</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>With basal fertiliser application</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ginger</td>\r\n			<td>Soil application: 8 to 10 kg per acre</td>\r\n			<td>At the time planting, after mixing with manure/ organic fertilisers during final land preparation; mix well with soil and irrigate.</td>\r\n			<td>In case conventional method of irrigation, use Ralligold GR; In case of drip irrigation, use Ralligold SP.<br />\r\n			Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ground Nut</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Litchi</td>\r\n			<td>Soil application:<br />\r\n			0 to 5 years &ndash; 50 g/plant<br />\r\n			Above 5 years &ndash; 100 g/plant</td>\r\n			<td>After harvest</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Maize</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mango</td>\r\n			<td>Soil application:<br />\r\n			0 to 5 years &ndash; 200 g/tree<br />\r\n			Above 5 years &ndash; 400 g/tree</td>\r\n			<td>After harvest</td>\r\n			<td>To be co-applied with Geogreen/Organic manure</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mentha</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Musk Melon</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Final land preparation</td>\r\n			<td>Along with Geogreen/Organic manure</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Onion</td>\r\n			<td>Soil Application: 4 kg per acre</td>\r\n			<td>With basal fertiliser application</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Opium</td>\r\n			<td>Soil application: 16 kg per acre</td>\r\n			<td>One month after sowing (Final thinning)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Paddy</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>For transplanted: 10 &ndash; 15 days after transplanting<br />\r\n			For Wet DSR: 20-25 days after sowing<br />\r\n			For Dry DSR: 20-25 days after sowing</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Potato</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>During final land preparation</td>\r\n			<td>Along with Geogreen/Organic manure</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Soybean</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sugarcane</td>\r\n			<td>Soil application: 8 kg per acre</td>\r\n			<td>1st application &ndash; after mixing with Geogreen, apply during final land preparation<br />\r\n			2nd application: 75 days after planting</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tomato</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Apply Ralligold GR just before transplanting</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Turmeric</td>\r\n			<td>Soil application: 8 to 10 kg per acre</td>\r\n			<td>At the time planting, after mixing with manure/ organic fertilisers during final land preparation; mix well with soil and irrigate.</td>\r\n			<td>In case conventional method of irrigation, use Ralligold GR; In case of drip irrigation, use Ralligold SP.<br />\r\n			Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Watermelon</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Final land preparation</td>\r\n			<td>Along with GeoGreen/Organic manure</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Wheat</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Apple</td>\r\n			<td>Soil application: 100 g per tree</td>\r\n			<td>Feb. /March</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Black Gram</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bengal Gram</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Peas</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Capsicum</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Apply Ralligold GR just before transplanting</td>\r\n			<td>Can be mixed with any insecticide or fertiliser</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cabbage</td>\r\n			<td>Soil application: 4 kg/acre</td>\r\n			<td>Final land preparation</td>\r\n			<td>Along with Geogreen/Organic manure</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Gourd</td>\r\n			<td>Soil application: 4 kg per acre</td>\r\n			<td>Final land preparation</td>\r\n			<td>Along with Geogreen/Organic manure</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 13:05:26', '2026-05-20 13:53:14', 1, 1, 'Tata Ralligold (Mycorrhizal Biofertilizer) VAM-Based Root Growth Enhancer', 'Overview\r\nProduct Name	Ralligold GR Biofertilizer\r\nBrand	Tata Rallis\r\nCategory	Bio Fertilizers\r\nTechnical Content	Vesicular Arbuscular Mycorhiza\r\nClassification	Bio/Organic\r\nProduct Description\r\nAbout Ralligold GR Biofertilizer\r\nTata Ralligold is a biofertilizer product designed for agricultural use.\r\nIt Is a unique mycorrhizal rooting stimulant that contains a blend of humic acids, Vesicular-Arbuscular Mycorrhizae (VAM), kelp, vitamins, and amino acids.\r\nThis product is known for enhancing plant growth.\r\nTata Ralligold Composition & Technical Details\r\nComposition:\r\n\r\nComponent	Percentage\r\nMycorrhiza	23.30%\r\nHumic acid	28.90%\r\nCold water kelp extract	18.00%\r\nAscorbic acid	12.30%\r\nAmino acid	08.30%\r\nMyoinositol	03.50%\r\nSurfactant	02.50%\r\nThiamine	2%\r\nAlpha tocopherol	1%\r\nKey Features & Benefits\r\nBetter germination, better grain filling.\r\nRapid root growth and nutrient uptake.\r\nincreased no of tillers.\r\nImproves uptake of phosphorus by the crop.\r\nExcellent yield enhancement\r\nHelps in imparting disease resistance in plant and nematode control to some extent.\r\nRecommended\r\nCrop	Dose g/acre	Time Of Application	Remarks\r\nBrinjal	Soil application: 4kg per acre	Apply Ralligold GR just before transplanting	Can be mixed with any insecticide or fertiliser\r\nCauliflower	4 kg per acre Soil application	Final land preparation	Along with Geogreen/Organic manure\r\nChilly	Soil application: 4 kg per acre	Apply Ralligold GR just before transplanting	Can be mixed with any insecticide or fertiliser\r\nCotton	Soil application: 4 kg per acre	Within 20 - 25 DAS with first fertiliser application	Can be mixed with any insecticide or fertiliser\r\nCumin	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)	Can be mixed with any insecticide or fertiliser\r\nGarlic	Soil application: 4 kg per acre	With basal fertiliser application	Can be mixed with any insecticide or fertiliser\r\nGinger	Soil application: 8 to 10 kg per acre	At the time planting, after mixing with manure/ organic fertilisers during final land preparation; mix well with soil and irrigate.	In case conventional method of irrigation, use Ralligold GR; In case of drip irrigation, use Ralligold SP.\r\nCan be mixed with any insecticide or fertiliser\r\nGround Nut	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)	Can be mixed with any insecticide or fertiliser\r\nLitchi	Soil application:\r\n0 to 5 years – 50 g/plant\r\nAbove 5 years – 100 g/plant	After harvest	Can be mixed with any insecticide or fertiliser\r\nMaize	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)	Can be mixed with any insecticide or fertiliser\r\nMango	Soil application:\r\n0 to 5 years – 200 g/tree\r\nAbove 5 years – 400 g/tree	After harvest	To be co-applied with Geogreen/Organic manure\r\nMentha	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)	Can be mixed with any insecticide or fertiliser\r\nMusk Melon	Soil application: 4 kg per acre	Final land preparation	Along with Geogreen/Organic manure\r\nOnion	Soil Application: 4 kg per acre	With basal fertiliser application	Can be mixed with any insecticide or fertiliser\r\nOpium	Soil application: 16 kg per acre	One month after sowing (Final thinning)	Can be mixed with any insecticide or fertiliser\r\nPaddy	Soil application: 4 kg per acre	For transplanted: 10 – 15 days after transplanting\r\nFor Wet DSR: 20-25 days after sowing\r\nFor Dry DSR: 20-25 days after sowing	Can be mixed with any insecticide or fertiliser\r\nPotato	Soil application: 4 kg per acre	During final land preparation	Along with Geogreen/Organic manure\r\nSoybean	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)	Can be mixed with any insecticide or fertiliser\r\nSugarcane	Soil application: 8 kg per acre	1st application – after mixing with Geogreen, apply during final land preparation\r\n2nd application: 75 days after planting	Can be mixed with any insecticide or fertiliser\r\nTomato	Soil application: 4 kg per acre	Apply Ralligold GR just before transplanting	Can be mixed with any insecticide or fertiliser\r\nTurmeric	Soil application: 8 to 10 kg per acre	At the time planting, after mixing with manure/ organic fertilisers during final land preparation; mix well with soil and irrigate.	In case conventional method of irrigation, use Ralligold GR; In case of drip irrigation, use Ralligold SP.\r\nCan be mixed with any insecticide or fertiliser\r\nWatermelon	Soil application: 4 kg per acre	Final land preparation	Along with GeoGreen/Organic manure\r\nWheat	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)	Can be mixed with any insecticide or fertiliser\r\nApple	Soil application: 100 g per tree	Feb. /March\r\nBlack Gram	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)\r\nBengal Gram	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)\r\nPeas	Soil application: 4 kg per acre	After mixing with manure/ organic fertilisers during final land preparation (at the time of sowing)\r\nCapsicum	Soil application: 4 kg per acre	Apply Ralligold GR just before transplanting	Can be mixed with any insecticide or fertiliser\r\nCabbage	Soil application: 4 kg/acre	Final land preparation	Along with Geogreen/Organic manure\r\nGourd	Soil application: 4 kg per acre	Final land preparation	Along with Geogreen/Organic manure\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a081e3e4772d.png', 1, NULL, 0.00, 0, NULL, NULL, '187283', 1),
(107, 'admin', 1, NULL, 'AJAY BIOTECH VAM (MYCORRHIZAL BIOFERTILIZER)', 'ajay-biotech-vam-mycorrhizal-biofertilizer-d48pXh', 'AJAY BIOTECH VAM', 'physical', '[{\"id\":\"19\",\"position\":1}]', 9, 'kg', 1, 1, NULL, NULL, '[\"2026-05-16-6a082094b9702.png\",\"2026-05-16-6a082094b9b4f.png\"]', '[]', '2026-05-16-6a082094b9d6e.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"200gm\"]}]', '[{\"type\":\"200gm\",\"price\":1150,\"sku\":\"ABV(B-200gm\",\"qty\":1506}]', 0, 1150, 0.00, 0.00, 1150, '0.00', 'percent', 'include', '16', 184.00, 966.00, 'percent', 1506, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>AJAY BIOTECH VAM (MYCORRHIZAL BIOFERTILIZER)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>AJAY BIO-TECH</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Bio Fertilizers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Vesicular Arbuscular Mycorhiza</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Bio/Organic</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<ul>\r\n	<li>Biofix Ajay VAM is a novel fungus &amp; Mycorrhizae tissue culture-based biofertilizer. Helps to provide mineral elements like N, P, K, Ca, S and Zn to the host plant. Improves plant root growth and development, helps in increase drought resistance &amp; crop yield</li>\r\n	<li><strong>Benefits:</strong></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Improves plant root growth and development.</li>\r\n	<li>Increases the uptake and mobilization of phosphate in all crops.</li>\r\n	<li>Overcoming stress conditions like drought, disease incidence and deficiency of nutrients.</li>\r\n	<li>Increases the immunity of the crop.</li>\r\n	<li>Maintain Turgidity in plants</li>\r\n	<li>&nbsp;</li>\r\n	<li><strong>Dosage:</strong></li>\r\n	<li>Soil application: For 1 acre of land, mix 100 grams of Ajay VAM .Apply at a depth of 3-5 cm.</li>\r\n	<li>At planting time<strong>:</strong>&nbsp;50 g / medium-sized tree, 100 g / large sized tree</li>\r\n	<li>&nbsp;</li>\r\n	<li><strong>Recommended Crops:</strong></li>\r\n	<li>Ajay VAM is suitable for all crops.</li>\r\n</ul>', 0, NULL, '2026-05-16 13:15:24', '2026-05-20 13:51:57', 1, 1, 'AJAY BIOTECH VAM (MYCORRHIZAL BIOFERTILIZER)', 'Overview\r\nProduct Name	AJAY BIOTECH VAM (MYCORRHIZAL BIOFERTILIZER)\r\nBrand	AJAY BIO-TECH\r\nCategory	Bio Fertilizers\r\nTechnical Content	Vesicular Arbuscular Mycorhiza\r\nClassification	Bio/Organic\r\nProduct Description\r\nBiofix Ajay VAM is a novel fungus & Mycorrhizae tissue culture-based biofertilizer. Helps to provide mineral elements like N, P, K, Ca, S and Zn to the host plant. Improves plant root growth and development, helps in increase drought resistance & crop yield\r\nBenefits:\r\nImproves plant root growth and development.\r\nIncreases the uptake and mobilization of phosphate in all crops.\r\nOvercoming stress conditions like drought, disease incidence and deficiency of nutrients.\r\nIncreases the immunity of the crop.\r\nMaintain Turgidity in plants\r\n\r\nDosage:\r\nSoil application: For 1 acre of land, mix 100 grams of Ajay VAM .Apply at a depth of 3-5 cm.\r\nAt planting time: 50 g / medium-sized tree, 100 g / large sized tree\r\n\r\nRecommended Crops:\r\nAjay VAM is suitable for all crops.', '2026-05-16-6a082094ba001.png', 1, NULL, 0.00, 0, NULL, NULL, '145475', 1);
INSERT INTO `products` (`id`, `added_by`, `user_id`, `pid`, `name`, `slug`, `tally_name`, `product_type`, `category_ids`, `brand_id`, `unit`, `min_qty`, `refundable`, `digital_product_type`, `digital_file_ready`, `images`, `color_image`, `thumbnail`, `featured`, `flash_deal`, `video_provider`, `video_url`, `colors`, `variant_product`, `attributes`, `choice_options`, `variation`, `published`, `unit_price`, `suggested_price`, `lowest_market_price`, `purchase_price`, `tax`, `tax_type`, `tax_model`, `discount`, `discount_amount`, `actual_amount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `free_shipping`, `attachment`, `created_at`, `updated_at`, `status`, `featured_status`, `meta_title`, `meta_description`, `meta_image`, `request_status`, `denied_note`, `shipping_cost`, `multiply_qty`, `temp_shipping_cost`, `is_shipping_cost_updated`, `code`, `indexing`) VALUES
(108, 'admin', 1, NULL, '– Chlorantraniliprole 18.5% SC – Safe, Effective Pest Control', 'chlorantraniliprole-185-sc-safe-effective-pest-control-V6xfIW', 'Coragen Insecticide', 'physical', '[{\"id\":\"17\",\"position\":1}]', 3, 'kg', 1, 1, NULL, NULL, '[\"2026-05-16-6a0824f2e0cd9.png\",\"2026-05-16-6a0824f2e1265.png\",\"2026-05-16-6a0824f2e1444.png\",\"2026-05-16-6a0824f2e15e7.png\",\"2026-05-16-6a0824f2e1938.png\",\"2026-05-16-6a0824f2e1ad5.png\",\"2026-05-16-6a0824f2e1c5d.png\",\"2026-05-16-6a0824f2e1dd7.png\",\"2026-05-16-6a0824f2e1f9c.png\"]', '[]', '2026-05-16-6a0824f2e2137.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"150ml\",\"  10ml\",\"  60ml\"]}]', '[{\"type\":\"150ml\",\"price\":2792,\"sku\":\"Coragen Insecticide-150ml\",\"qty\":150},{\"type\":\"10ml\",\"price\":2792,\"sku\":\"Coragen Insecticide-10ml\",\"qty\":201},{\"type\":\"60ml\",\"price\":2792,\"sku\":\"Coragen Insecticide-60ml\",\"qty\":620}]', 0, 2792, 0.00, 0.00, 2792, '0.00', 'percent', 'include', '60', 1675.20, 1116.80, 'percent', 971, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Coragen Insecticide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>FMC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Insecticides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Chlorantraniliprole 18.50% SC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Coragen Insecticide</h2>\r\n\r\n<ul>\r\n	<li><strong>Coragen Insecticide</strong>&nbsp;is an anthranilic diamide. Broad spectrum insecticide in the form of a suspension concentrate.</li>\r\n	<li><strong>Coragen technical name - Chlorantraniliprole 18.5 % W/W</strong></li>\r\n	<li>It is powered by the active ingredient Rynaxypyr which has a unique mode of action that controls pests resistant to other insecticides.</li>\r\n	<li>Exposed insects stop feeding within minutes and extended residual activity protects crops longer than competitive options.</li>\r\n	<li><em>Coragen Insecticide</em>&nbsp;spreads and acts fast, resulting in quick control of insects.</li>\r\n</ul>\r\n\r\n<h2>Coragen Insecticide Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:&nbsp;</strong>Chlorantraniliprole 18.5 % W/W</li>\r\n	<li><strong>Mode of Entry:&nbsp;</strong>Dual action: Systemic and Contact</li>\r\n	<li><strong>Mode of Action:&nbsp;</strong>Citigen (Chlorantraniliprole - CAP) is a plant systemic insecticide that belongs to the group anthranilic diamide, which has a unique mode of action called Ryanodine Receptor activators that disrupt normal muscle functions within the pest.</li>\r\n</ul>\r\n\r\n<h2>Key Features and Benefits</h2>\r\n\r\n<ul>\r\n	<li>Coragen Insecticide is broad-spectrum insecticide which controls wide range of pests.</li>\r\n	<li>It controls insects at all stages from immature to adult stage.</li>\r\n	<li>Coragen Insecticide is effective against chewing pests.</li>\r\n	<li>Provides superior protection from pests, enabling crops to achieve maximum yield potential.</li>\r\n	<li>FMC Coragen Insecticide acts have a translaminar action, that protects both sides of the leaves and ensures rain fastness, Controls hatching insects all the way through to adult stages of development.</li>\r\n</ul>\r\n\r\n<h2>Coragen Insecticide Usage and Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommended Crops:</strong><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Crops</td>\r\n			<td>Target Pest</td>\r\n			<td>Dosage / Acre (ml)</td>\r\n			<td>Dilution in water (L/Acre)</td>\r\n			<td>Dosage (ml) / of Water</td>\r\n			<td>Waiting period (Days)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Paddy</td>\r\n			<td>Stem borer, leaf folder</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td>37</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sugarcane</td>\r\n			<td>Termite<br />\r\n			Top borer<br />\r\n			Early shoot borer</td>\r\n			<td>100-120 75 75</td>\r\n			<td>200l</td>\r\n			<td>0.5-0.6<br />\r\n			0.37<br />\r\n			0.37</td>\r\n			<td>28</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Soybean</td>\r\n			<td>Green semi-loopers, Stem fly Girdle beetle</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td><br />\r\n			0.3</td>\r\n			<td>29</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bengal gram</td>\r\n			<td>Pod borer</td>\r\n			<td>50</td>\r\n			<td>500</td>\r\n			<td>0.25</td>\r\n			<td>11</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Maize</td>\r\n			<td>Spotted stem borer, Pink Stem borer, Fall Armyworm</td>\r\n			<td>80</td>\r\n			<td>200</td>\r\n			<td>0.4</td>\r\n			<td>10</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Groundnut</td>\r\n			<td>Tobacco caterpillar</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td>28</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cotton</td>\r\n			<td>American Bollworm</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td>9</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cabbage</td>\r\n			<td>Diamond Back Moth</td>\r\n			<td>20</td>\r\n			<td>200</td>\r\n			<td>0.1</td>\r\n			<td>3</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tomato</td>\r\n			<td>Fruit Borer</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td>3</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chilli</td>\r\n			<td>Fruit Borer, Tobacco Caterpillar</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td>3</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Brinjal</td>\r\n			<td>Fruit Borer, shoot borer</td>\r\n			<td>80</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td><br />\r\n			3</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pigeon pea/Red gram</td>\r\n			<td>Pod borer, pod fly</td>\r\n			<td>60</td>\r\n			<td>200</td>\r\n			<td>0.3</td>\r\n			<td>22</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Blackgram</td>\r\n			<td>Pod borer</td>\r\n			<td>40</td>\r\n			<td>200</td>\r\n			<td>0.2</td>\r\n			<td>20</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bitter gourd</td>\r\n			<td>Fruit borer, Leaf Caterpillar</td>\r\n			<td>40-50</td>\r\n			<td>200</td>\r\n			<td>0.2-0.25</td>\r\n			<td>7</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Okra</td>\r\n			<td>Fruit borer</td>\r\n			<td>50</td>\r\n			<td>200</td>\r\n			<td>0.25</td>\r\n			<td>5</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li><strong>Method of Application:&nbsp;</strong>Foliar spray</li>\r\n</ul>\r\n\r\n<h2>Coragen Insecticide Expert Advice</h2>\r\n\r\n<p>&quot;Farmers are advised to spray Coragen in maize if leaves are found damaged by fall armyworm&quot;<em>&nbsp;- BigHaat Agronomy Expert</em></p>\r\n\r\n<h2>Additional Information</h2>\r\n\r\n<ul>\r\n	<li>It is selective &amp; safe for non-target arthropods and conserves natural parasitoids, predators, and pollinator.</li>\r\n	<li>Coragen Insecticide should not be used on crops other than specified on the label.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 13:34:02', '2026-05-20 13:49:12', 1, 1, 'Coragen Insecticide', 'Overview\r\nProduct Name	Coragen Insecticide\r\nBrand	FMC\r\nCategory	Insecticides\r\nTechnical Content	Chlorantraniliprole 18.50% SC\r\nClassification	Chemical\r\nToxicity	Blue\r\nProduct Description\r\nAbout Coragen Insecticide\r\nCoragen Insecticide is an anthranilic diamide. Broad spectrum insecticide in the form of a suspension concentrate.\r\nCoragen technical name - Chlorantraniliprole 18.5 % W/W\r\nIt is powered by the active ingredient Rynaxypyr which has a unique mode of action that controls pests resistant to other insecticides.\r\nExposed insects stop feeding within minutes and extended residual activity protects crops longer than competitive options.\r\nCoragen Insecticide spreads and acts fast, resulting in quick control of insects.\r\nCoragen Insecticide Technical Details\r\nTechnical Content: Chlorantraniliprole 18.5 % W/W\r\nMode of Entry: Dual action: Systemic and Contact\r\nMode of Action: Citigen (Chlorantraniliprole - CAP) is a plant systemic insecticide that belongs to the group anthranilic diamide, which has a unique mode of action called Ryanodine Receptor activators that disrupt normal muscle functions within the pest.\r\nKey Features and Benefits\r\nCoragen Insecticide is broad-spectrum insecticide which controls wide range of pests.\r\nIt controls insects at all stages from immature to adult stage.\r\nCoragen Insecticide is effective against chewing pests.\r\nProvides superior protection from pests, enabling crops to achieve maximum yield potential.\r\nFMC Coragen Insecticide acts have a translaminar action, that protects both sides of the leaves and ensures rain fastness, Controls hatching insects all the way through to adult stages of development.\r\nCoragen Insecticide Usage and Crops\r\nRecommended Crops:\r\n\r\nCrops	Target Pest	Dosage / Acre (ml)	Dilution in water (L/Acre)	Dosage (ml) / of Water	Waiting period (Days)\r\nPaddy	Stem borer, leaf folder	60	200	0.3	37\r\nSugarcane	Termite\r\nTop borer\r\nEarly shoot borer	100-120 75 75	200l	0.5-0.6\r\n0.37\r\n0.37	28\r\nSoybean	Green semi-loopers, Stem fly Girdle beetle	60	200	\r\n0.3	29\r\nBengal gram	Pod borer	50	500	0.25	11\r\nMaize	Spotted stem borer, Pink Stem borer, Fall Armyworm	80	200	0.4	10\r\nGroundnut	Tobacco caterpillar	60	200	0.3	28\r\nCotton	American Bollworm	60	200	0.3	9\r\nCabbage	Diamond Back Moth	20	200	0.1	3\r\nTomato	Fruit Borer	60	200	0.3	3\r\nChilli	Fruit Borer, Tobacco Caterpillar	60	200	0.3	3\r\nBrinjal	Fruit Borer, shoot borer	80	200	0.3	\r\n3\r\nPigeon pea/Red gram	Pod borer, pod fly	60	200	0.3	22\r\nBlackgram	Pod borer	40	200	0.2	20\r\nBitter gourd	Fruit borer, Leaf Caterpillar	40-50	200	0.2-0.25	7\r\nOkra	Fruit borer	50	200	0.25	5\r\n \r\n\r\nMethod of Application: Foliar spray\r\nCoragen Insecticide Expert Advice\r\n\"Farmers are advised to spray Coragen in maize if leaves are found damaged by fall armyworm\" - BigHaat Agronomy Expert\r\n\r\nAdditional Information\r\nIt is selective & safe for non-target arthropods and conserves natural parasitoids, predators, and pollinator.\r\nCoragen Insecticide should not be used on crops other than specified on the label.\r\nDisclaimer:\r\nThis information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a0824f2e22ca.png', 1, NULL, 0.00, 0, NULL, NULL, '100870', 1),
(109, 'admin', 1, NULL, '(Diafenthiuron 50% WP) – Broad Spectrum Insecticide & Miticide', 'diafenthiuron-50-wp-broad-spectrum-insecticide-miticide-hDB8nM', 'Pegasus Insecticide', 'physical', '[{\"id\":\"17\",\"position\":1}]', 9, 'pc', 1, 1, NULL, NULL, '[\"2026-05-16-6a0826b6a40c6.png\",\"2026-05-16-6a0826b6a45d8.png\"]', '[]', '2026-05-16-6a0826b6a4932.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"250gm\",\"  500gm\"]}]', '[{\"type\":\"250gm\",\"price\":1415,\"sku\":\"Pegasus Insecticide-250ml\",\"qty\":150},{\"type\":\"500gm\",\"price\":1415,\"sku\":\"Pegasus Insecticide-500ml\",\"qty\":146}]', 0, 1415, 0.00, 0.00, 1415, '0.00', 'percent', 'exclude', '032', 452.80, 962.20, 'percent', 296, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Pegasus Insecticide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Syngenta</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Insecticides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Diafenthiuron 50% WP</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Pegasus Insecticide</h2>\r\n\r\n<ul>\r\n	<li>Pegasus is an insecticide and miticide effective against a wide range of sucking pests.</li>\r\n	<li><strong>Pegasus Insecticide</strong>&nbsp;contains Diafenthiuron, effective against a variety of pests.</li>\r\n	<li>It provides long-lasting control with ovicidal action, affecting eggs, nymphs, and adults.</li>\r\n	<li>It features a novel chemistry and a new mode of action, making it distinct in pest control.</li>\r\n</ul>\r\n\r\n<h2><strong>Pegasus Insecticide Technical Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Name:</strong>&nbsp;Diafenthiuron - 50% WP</li>\r\n	<li><strong>Mode of Entry:</strong>&nbsp;Contact and Stomach</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;<em>Pegasus Insecticide</em>, which contains Diafenthiuron as its active ingredient, operates by inhibiting mitochondrial ATP synthase. This mode of action disrupts the energy production in pests, leading to paralysis and eventual death. After the pest comes into contact with or ingests the insecticide, it becomes immobile and stops causing damage to the crop. Death typically occurs within 3-4 days.</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Pegasus Syngenta effectively controls a wide range of sucking pests, including aphids, whiteflies, thrips, and mites, providing comprehensive protection for your crops.</li>\r\n	<li>Pegasus offers extended residual activity, reducing the frequency of applications needed and ensuring prolonged protection for your crops.</li>\r\n	<li>Translaminar and Vapor Action: The insecticide penetrates leaf tissues and reaches hidden pests on the lower leaf surfaces, ensuring thorough pest control.</li>\r\n	<li>Pegasus is soft on beneficial insects, making it suitable for use in Integrated Pest Management (IPM) and Integrated Crop Management (ICM) programs, promoting sustainable agriculture.</li>\r\n	<li>It can be used on a variety of crops, including vegetables, fruits, and ornamentals, providing flexibility for different farming needs.</li>\r\n	<li>Long lasting and strong phytotonic effect which usually enhances yield.</li>\r\n</ul>\r\n\r\n<h2><strong>Pegasus Insecticide Usage &amp; Crops</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Recommendations</strong></li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Target Pest</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dosage/ Acre</strong></p>\r\n\r\n			<p><strong>(gm)</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dilution in water</strong></p>\r\n\r\n			<p><strong>(L/Acre)</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Waiting period (days)</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cotton</p>\r\n			</td>\r\n			<td>\r\n			<p>Jassids, Whitefly, Thrips, Aphids</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>200-400</p>\r\n			</td>\r\n			<td>\r\n			<p>21</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Chilli</p>\r\n			</td>\r\n			<td>\r\n			<p>Mites</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>200-400</p>\r\n			</td>\r\n			<td>\r\n			<p>6</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cabbage</p>\r\n			</td>\r\n			<td>\r\n			<p>Diamond back moth</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>200-400</p>\r\n			</td>\r\n			<td>\r\n			<p>7</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Brinjal</p>\r\n			</td>\r\n			<td>\r\n			<p>White fly</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>200-400</p>\r\n			</td>\r\n			<td>\r\n			<p>3</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cardamom</p>\r\n			</td>\r\n			<td>\r\n			<p>Thrips, Capsule borer</p>\r\n			</td>\r\n			<td>\r\n			<p>320</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>7</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Watermelon</p>\r\n			</td>\r\n			<td>\r\n			<p>White flies, red spider mites</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>400</p>\r\n			</td>\r\n			<td>\r\n			<p>5</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Tomato</p>\r\n			</td>\r\n			<td>\r\n			<p>White flies, red spider mites, Jassids</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>400</p>\r\n			</td>\r\n			<td>\r\n			<p>5</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Okra</p>\r\n			</td>\r\n			<td>\r\n			<p>White flies, spider mites</p>\r\n			</td>\r\n			<td>\r\n			<p>240</p>\r\n			</td>\r\n			<td>\r\n			<p>400</p>\r\n			</td>\r\n			<td>\r\n			<p>5</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<ul>\r\n	<li><strong>Method of Application:</strong>&nbsp;Foliar Spray</li>\r\n</ul>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>Pegasus Insecticide&nbsp;is compatible with most chemicals.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 13:41:34', '2026-05-20 12:42:45', 1, 1, 'Pegasus Insecticide', 'Overview\r\n\r\nProduct Name	Pegasus Insecticide\r\nBrand	Syngenta\r\nCategory	Insecticides\r\nTechnical Content	Diafenthiuron 50% WP\r\nClassification	Chemical\r\nToxicity	Blue\r\nProduct Description\r\n\r\nAbout Pegasus Insecticide\r\nPegasus is an insecticide and miticide effective against a wide range of sucking pests.\r\nPegasus Insecticide contains Diafenthiuron, effective against a variety of pests.\r\nIt provides long-lasting control with ovicidal action, affecting eggs, nymphs, and adults.\r\nIt features a novel chemistry and a new mode of action, making it distinct in pest control.\r\nPegasus Insecticide Technical Details\r\nTechnical Name: Diafenthiuron - 50% WP\r\nMode of Entry: Contact and Stomach\r\nMode of Action: Pegasus Insecticide, which contains Diafenthiuron as its active ingredient, operates by inhibiting mitochondrial ATP synthase. This mode of action disrupts the energy production in pests, leading to paralysis and eventual death. After the pest comes into contact with or ingests the insecticide, it becomes immobile and stops causing damage to the crop. Death typically occurs within 3-4 days.\r\nKey Features & Benefits\r\nPegasus Syngenta effectively controls a wide range of sucking pests, including aphids, whiteflies, thrips, and mites, providing comprehensive protection for your crops.\r\nPegasus offers extended residual activity, reducing the frequency of applications needed and ensuring prolonged protection for your crops.\r\nTranslaminar and Vapor Action: The insecticide penetrates leaf tissues and reaches hidden pests on the lower leaf surfaces, ensuring thorough pest control.\r\nPegasus is soft on beneficial insects, making it suitable for use in Integrated Pest Management (IPM) and Integrated Crop Management (ICM) programs, promoting sustainable agriculture.\r\nIt can be used on a variety of crops, including vegetables, fruits, and ornamentals, providing flexibility for different farming needs.\r\nLong lasting and strong phytotonic effect which usually enhances yield.\r\nPegasus Insecticide Usage & Crops\r\nRecommendations\r\nCrops\r\n\r\nTarget Pest\r\n\r\nDosage/ Acre\r\n\r\n(gm)\r\n\r\nDilution in water\r\n\r\n(L/Acre)\r\n\r\nWaiting period (days)\r\n\r\nCotton\r\n\r\nJassids, Whitefly, Thrips, Aphids\r\n\r\n240\r\n\r\n200-400\r\n\r\n21\r\n\r\nChilli\r\n\r\nMites\r\n\r\n240\r\n\r\n200-400\r\n\r\n6\r\n\r\nCabbage\r\n\r\nDiamond back moth\r\n\r\n240\r\n\r\n200-400\r\n\r\n7\r\n\r\nBrinjal\r\n\r\nWhite fly\r\n\r\n240\r\n\r\n200-400\r\n\r\n3\r\n\r\nCardamom\r\n\r\nThrips, Capsule borer\r\n\r\n320\r\n\r\n500\r\n\r\n7\r\n\r\nWatermelon\r\n\r\nWhite flies, red spider mites\r\n\r\n240\r\n\r\n400\r\n\r\n5\r\n\r\nTomato\r\n\r\nWhite flies, red spider mites, Jassids\r\n\r\n240\r\n\r\n400\r\n\r\n5\r\n\r\nOkra\r\n\r\nWhite flies, spider mites\r\n\r\n240\r\n\r\n400\r\n\r\n5\r\n\r\nMethod of Application: Foliar Spray\r\nAdditional Information\r\nPegasus Insecticide is compatible with most chemicals.\r\nDisclaimer: This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a0826b6a4b72.png', 1, NULL, 0.00, 0, NULL, NULL, '122486', 1),
(110, 'admin', 1, NULL, 'Sonic Flo Insecticide (Fipronil 5% SC) for Sucking Pests & Caterpillar Pests', 'sonic-flo-insecticide-fipronil-5-sc-for-sucking-pests-caterpillar-pests-nAhXO7', 'Sonic Flo Insecticide', 'physical', '[{\"id\":\"17\",\"position\":1}]', 1, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-16-6a082d24ba5ea.png\",\"2026-05-16-6a082d24baab6.png\",\"2026-05-16-6a082d24bace1.png\",\"2026-05-16-6a082d24bafce.png\"]', '[]', '2026-05-16-6a082d24bb28b.png', '1', NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"1ltr\",\"  250ml\",\"  500ml\"]}]', '[{\"type\":\"1ltr\",\"price\":1284,\"sku\":\"SFI(5SfSP&CP-1ltr\",\"qty\":1574},{\"type\":\"250ml\",\"price\":399,\"sku\":\"SFI(5SfSP&CP-250ml\",\"qty\":1452},{\"type\":\"500ml\",\"price\":705,\"sku\":\"SFI(5SfSP&CP-500ml\",\"qty\":1452}]', 0, 1284, 0.00, 0.00, 1284, '0.00', 'percent', 'include', '028', 359.52, 924.48, 'percent', 4478, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Sonic Flo Insecticide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Tata Rallis</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Insecticides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Fipronil 05% SC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Yellow</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Sonic Flo Insecticide</h2>\r\n\r\n<ul>\r\n	<li>Sonic Flo is a phenyl pyrazole insecticide offered by Rallis India limited.</li>\r\n	<li><strong>Sonic Flo Insecticide</strong>&nbsp;is effective for the management of sucking pests and caterpillar pests.</li>\r\n	<li>It has both contact and ingestion activity.</li>\r\n</ul>\r\n\r\n<h2>Sonic Flo Insecticide Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Name:</strong>&nbsp;Fipronil 5% SC</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;Fipronil blocks the GABA-gated chloride channels in the insect&#39;s CNS, preventing chloride ions from being absorbed. This results in excess neuronal stimulation and the death of the insect.</li>\r\n</ul>\r\n\r\n<h2>Key Features &amp; Benefits</h2>\r\n\r\n<ul>\r\n	<li><em>Sonic Flo Insecticide</em>&nbsp;Fipronil 5% SC has Plant Growth Enhancement (PGE) effect in many crops.</li>\r\n	<li>It causes cessation of feeding, which may be noted soon after treatment.</li>\r\n	<li>It has excellent residual control after foliar application.</li>\r\n	<li>It is an excellent control of thrips.</li>\r\n</ul>\r\n\r\n<h2>Sonic Flo Insecticide Usage &amp; Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommendations:</strong></li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Recommended Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Targeted Pests</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Rice</p>\r\n			</td>\r\n			<td>\r\n			<p>Green Leaf Hopper, Gall midge, Whorl Maggot, Stem Borer, Leaf Folder, Brown Plant Hopper, White Backed Plant Hopper</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Chilli</p>\r\n			</td>\r\n			<td>\r\n			<p>Thrips, Aphids and Fruit Borer</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cabbage</p>\r\n			</td>\r\n			<td>\r\n			<p>Diamond backmoth</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Sugarcane</p>\r\n			</td>\r\n			<td>\r\n			<p>Early Shoot Borer and Root Borer</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cotton</p>\r\n			</td>\r\n			<td>\r\n			<p>Aphid, Jassid, Thrips, White Fly, &amp; Bollworms</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<ul>\r\n	<li><strong>Dosage:</strong>&nbsp;2 ml/ L of water</li>\r\n	<li><strong>Method of Application:</strong>&nbsp;Foliar spray evenly over the crop.</li>\r\n</ul>\r\n\r\n<h2>Additional Information</h2>\r\n\r\n<ul>\r\n	<li>Sonic Flo Insecticide&nbsp;can be mixed with many herbicides without issues. However, always perform a jar test to ensure physical compatibility before large-scale mixing.</li>\r\n	<li>It is usually safe to mix Sonic Flo with fungicides, but again, a jar test is recommended to avoid any adverse reactions.</li>\r\n	<li>Sonic Flo (Fipronil 5% SC) is compatible with several foliar fertilizers, which can be beneficial for integrated pest and nutrient management.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 14:09:00', '2026-05-20 13:48:03', 1, 1, 'Sonic Flo Insecticide (Fipronil 5% SC) for Sucking Pests & Caterpillar Pests', 'Overview\r\n\r\nProduct Name	Sonic Flo Insecticide\r\nBrand	Tata Rallis\r\nCategory	Insecticides\r\nTechnical Content	Fipronil 05% SC\r\nClassification	Chemical\r\nToxicity	Yellow\r\nProduct Description\r\n\r\nAbout Sonic Flo Insecticide\r\nSonic Flo is a phenyl pyrazole insecticide offered by Rallis India limited.\r\nSonic Flo Insecticide is effective for the management of sucking pests and caterpillar pests.\r\nIt has both contact and ingestion activity.\r\nSonic Flo Insecticide Technical Details\r\nTechnical Name: Fipronil 5% SC\r\nMode of Action: Fipronil blocks the GABA-gated chloride channels in the insect\'s CNS, preventing chloride ions from being absorbed. This results in excess neuronal stimulation and the death of the insect.\r\nKey Features & Benefits\r\nSonic Flo Insecticide Fipronil 5% SC has Plant Growth Enhancement (PGE) effect in many crops.\r\nIt causes cessation of feeding, which may be noted soon after treatment.\r\nIt has excellent residual control after foliar application.\r\nIt is an excellent control of thrips.\r\nSonic Flo Insecticide Usage & Crops\r\nRecommendations:\r\nRecommended Crops\r\n\r\nTargeted Pests\r\n\r\nRice\r\n\r\nGreen Leaf Hopper, Gall midge, Whorl Maggot, Stem Borer, Leaf Folder, Brown Plant Hopper, White Backed Plant Hopper\r\n\r\nChilli\r\n\r\nThrips, Aphids and Fruit Borer\r\n\r\nCabbage\r\n\r\nDiamond backmoth\r\n\r\nSugarcane\r\n\r\nEarly Shoot Borer and Root Borer\r\n\r\nCotton\r\n\r\nAphid, Jassid, Thrips, White Fly, & Bollworms\r\n\r\nDosage: 2 ml/ L of water\r\nMethod of Application: Foliar spray evenly over the crop.\r\nAdditional Information\r\nSonic Flo Insecticide can be mixed with many herbicides without issues. However, always perform a jar test to ensure physical compatibility before large-scale mixing.\r\nIt is usually safe to mix Sonic Flo with fungicides, but again, a jar test is recommended to avoid any adverse reactions.\r\nSonic Flo (Fipronil 5% SC) is compatible with several foliar fertilizers, which can be beneficial for integrated pest and nutrient management.\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a082d24bb47c.png', 1, NULL, 0.00, 0, NULL, NULL, '108536', 1),
(111, 'admin', 1, NULL, 'Exponus Insecticide by BASF (Broflanilide 300G/L SC) for Effective Pest Control', 'exponus-insecticide-by-basf-broflanilide-300gl-sc-for-effective-pest-control-WGIEzf', 'Exponus Insecticide by BASF', 'physical', '[{\"id\":\"17\",\"position\":1}]', 2, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-16-6a08675f98c19.png\",\"2026-05-16-6a08675f9acb4.png\",\"2026-05-16-6a08675f9ae69.png\",\"2026-05-16-6a08675f9b00b.png\"]', '[]', '2026-05-16-6a08675f9b21b.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"34ml\",\"  25ml\",\"  8.5ml\"]}]', '[{\"type\":\"34ml\",\"price\":2482,\"sku\":\"EIbB(3SfEPC-34ml\",\"qty\":120},{\"type\":\"25ml\",\"price\":1858,\"sku\":\"EIbB(3SfEPC-25ml\",\"qty\":102},{\"type\":\"8.5ml\",\"price\":731,\"sku\":\"EIbB(3SfEPC-8.5ml\",\"qty\":102}]', 0, 2482, 0.00, 0.00, 2482, '0.00', 'percent', 'include', '034', 843.88, 1638.12, 'percent', 324, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Exponus Insecticide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>BASF</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Insecticides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Broflanilide 300 g/l SC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Exponus Insecticide</h2>\r\n\r\n<ul>\r\n	<li><strong>Exponus Insecticide</strong>&nbsp;is a revolutionary insecticide that gives you the power over difficult insects.</li>\r\n	<li><strong>Exponus technical name - Broflanilide 300G/L SC</strong></li>\r\n	<li>Exponus insecticide is powerful and versatile insecticide for farmers who want the top performing pest control.</li>\r\n	<li>It is a new mode of action targeted to control even the toughest chewing pests, certain thrips &amp; leaf miner.</li>\r\n	<li>Exponus spreads and acts fast, resulting in quick control of insects.</li>\r\n</ul>\r\n\r\n<h2>Exponus Insecticide Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:&nbsp;</strong>Broflanilide 300G/L SC</li>\r\n	<li><strong>Mode of Entry:&nbsp;</strong>Both Contact and Systemic</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;Exponus Basf has a new way of killing insects, Broflanilide - the main ingredient in Exponus, changes the nerve signals of insects by interfering with GABA receptors.</li>\r\n</ul>\r\n\r\n<h2>Key Features and Benefits</h2>\r\n\r\n<ul>\r\n	<li>BASF Exponus is a broad-spectrum insecticide, effectively targets Lepidopteran and few sucking insects.</li>\r\n	<li><em>Exponus Insecticide</em>&nbsp;is effective on all stages of the pests from immature to adult stage.</li>\r\n	<li>It is versatile, effectively controls many insects in different crops at different stages.</li>\r\n	<li>Exponus Basf Insecticide is effective on biting &amp; chewing, certain sucking type of insects like thrips.</li>\r\n	<li>BASF Exponus has excellent translaminar action, when sprayed on the upper surface of leaf, it immediately percolates down to lower surface of the leaf so that it effectively controls targeted insect pest.</li>\r\n</ul>\r\n\r\n<h2>Exponus Insecticide Usage and Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommended Crops:</strong><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Crops</td>\r\n			<td>Target Pest</td>\r\n			<td>Dosage / Acre (ml)</td>\r\n			<td>Dilution in water (L/Acre)</td>\r\n			<td>Dosage (ml) /L of water</td>\r\n			<td>Waiting period (In Days)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tomato</td>\r\n			<td>Lepidoptera spp</td>\r\n			<td>25</td>\r\n			<td>200</td>\r\n			<td>0.125</td>\r\n			<td>1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Brinjal</td>\r\n			<td>Shoot &amp; fruit borer</td>\r\n			<td>25</td>\r\n			<td>200</td>\r\n			<td>0.125</td>\r\n			<td>1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chilli</td>\r\n			<td>Fruit Borer, Thrips</td>\r\n			<td>34</td>\r\n			<td>200</td>\r\n			<td>0.17</td>\r\n			<td>1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Red gram</td>\r\n			<td>Maruca and Helicoverpa</td>\r\n			<td>17</td>\r\n			<td>200</td>\r\n			<td>0.085</td>\r\n			<td>25</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Soya bean</td>\r\n			<td>Helicoverpa, Spodoptera &amp; Semi loopers</td>\r\n			<td><br />\r\n			17</td>\r\n			<td>200</td>\r\n			<td>0.085</td>\r\n			<td>37</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<ul>\r\n	<li><strong>Method of Application:&nbsp;</strong>Foliar Spray</li>\r\n	<li><strong>Time of Application</strong></li>\r\n</ul>\r\n\r\n<p><strong>First Spray</strong></p>\r\n\r\n<ul>\r\n	<li>Soybean: With pest incidence</li>\r\n	<li>Red gram: With pest incidence</li>\r\n	<li>Chilli: Active vegetative growth stage with Thrips incidence</li>\r\n	<li>Tomato: Before Flower initiation</li>\r\n	<li>Brinjal:Active vegetative growth stage</li>\r\n</ul>\r\n\r\n<p><strong>Second Spray</strong></p>\r\n\r\n<ul>\r\n	<li>Soybean: 12 to 15 days after 1st application</li>\r\n	<li>Red Gram: 20 to 25 days after 1st application</li>\r\n	<li>Chilli: 7-10 days after 1st application</li>\r\n	<li>Tomato: Fruit initiation stage</li>\r\n	<li>7-10 days after 1st application</li>\r\n</ul>\r\n\r\n<h2><strong>Disclaimer:&nbsp;</strong><strong>This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</strong></h2>', 0, NULL, '2026-05-16 18:17:27', '2026-05-20 13:46:26', 1, 1, 'Exponus Insecticide by BASF (Broflanilide 300G/L SC) for Effective Pest Control', 'Overview\r\nProduct Name	Exponus Insecticide\r\nBrand	BASF\r\nCategory	Insecticides\r\nTechnical Content	Broflanilide 300 g/l SC\r\nClassification	Chemical\r\nToxicity	Blue\r\nProduct Description\r\nAbout Exponus Insecticide\r\nExponus Insecticide is a revolutionary insecticide that gives you the power over difficult insects.\r\nExponus technical name - Broflanilide 300G/L SC\r\nExponus insecticide is powerful and versatile insecticide for farmers who want the top performing pest control.\r\nIt is a new mode of action targeted to control even the toughest chewing pests, certain thrips & leaf miner.\r\nExponus spreads and acts fast, resulting in quick control of insects.\r\nExponus Insecticide Technical Details\r\nTechnical Content: Broflanilide 300G/L SC\r\nMode of Entry: Both Contact and Systemic\r\nMode of Action: Exponus Basf has a new way of killing insects, Broflanilide - the main ingredient in Exponus, changes the nerve signals of insects by interfering with GABA receptors.\r\nKey Features and Benefits\r\nBASF Exponus is a broad-spectrum insecticide, effectively targets Lepidopteran and few sucking insects.\r\nExponus Insecticide is effective on all stages of the pests from immature to adult stage.\r\nIt is versatile, effectively controls many insects in different crops at different stages.\r\nExponus Basf Insecticide is effective on biting & chewing, certain sucking type of insects like thrips.\r\nBASF Exponus has excellent translaminar action, when sprayed on the upper surface of leaf, it immediately percolates down to lower surface of the leaf so that it effectively controls targeted insect pest.\r\nExponus Insecticide Usage and Crops\r\nRecommended Crops:\r\n\r\nCrops	Target Pest	Dosage / Acre (ml)	Dilution in water (L/Acre)	Dosage (ml) /L of water	Waiting period (In Days)\r\nTomato	Lepidoptera spp	25	200	0.125	1\r\nBrinjal	Shoot & fruit borer	25	200	0.125	1\r\nChilli	Fruit Borer, Thrips	34	200	0.17	1\r\nRed gram	Maruca and Helicoverpa	17	200	0.085	25\r\nSoya bean	Helicoverpa, Spodoptera & Semi loopers	\r\n17	200	0.085	37\r\nMethod of Application: Foliar Spray\r\nTime of Application\r\nFirst Spray\r\n\r\nSoybean: With pest incidence\r\nRed gram: With pest incidence\r\nChilli: Active vegetative growth stage with Thrips incidence\r\nTomato: Before Flower initiation\r\nBrinjal:Active vegetative growth stage\r\nSecond Spray\r\n\r\nSoybean: 12 to 15 days after 1st application\r\nRed Gram: 20 to 25 days after 1st application\r\nChilli: 7-10 days after 1st application\r\nTomato: Fruit initiation stage\r\n7-10 days after 1st application\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a08675f9b3bb.png', 1, NULL, 0.00, 0, NULL, NULL, '130892', 1),
(112, 'admin', 1, NULL, 'Volax Insecticide- Emamectin benzoate 5% SG Control Bollworms in Cotton, Fruit &', 'volax-insecticide-emamectin-benzoate-5-sg-control-bollworms-in-cotton-fruit-shoot-borer-in-okra-36TZN1', 'Volax Insecticide- Emamectin benzoate', 'physical', '[{\"id\":\"17\",\"position\":1}]', 3, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-16-6a08686b5266d.png\"]', '[]', '2026-05-16-6a08686b52ab7.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"100ml\",\"  250ml\"]}]', '[{\"type\":\"100ml\",\"price\":487,\"sku\":\"VIEb5SCBiCF&SBiO-100ml\",\"qty\":1524},{\"type\":\"250ml\",\"price\":1140,\"sku\":\"VIEb5SCBiCF&SBiO-250ml\",\"qty\":16546}]', 0, 487, 0.00, 0.00, 487, '0.00', 'percent', 'include', '37', 180.19, 306.81, 'percent', 18070, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Volax Insecticide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Indofil</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Insecticides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Emamectin benzoate 05% SG</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Yellow</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Volax Insecticide</h2>\r\n\r\n<ul>\r\n	<li><strong>Volax Insecticide</strong>&nbsp;is a non-systemic insecticide which penetrates leaf tissues by trans-laminar movement.</li>\r\n</ul>\r\n\r\n<h2>Volax Insecticide Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Name:</strong>&nbsp;Emamectin benzoate 5% SG</li>\r\n	<li><strong>Mode of Entry:</strong>&nbsp;Contact</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;It acts on chloride channel activation which causes elimination of signal transmission and paralyzed insects&rsquo; muscles which stops feeding in just 2 hours after ingestion and death occurs in 48 to 72 hours.</li>\r\n</ul>\r\n\r\n<h2>Key Features &amp; Benefits</h2>\r\n\r\n<ul>\r\n	<li>The active ingredient penetrates leaf tissues and form a toxic reservoir within the treated leaves</li>\r\n	<li>This toxic reservoir provides excellent residual activity against foliage feeding caterpillar</li>\r\n	<li>Gives simultaneous control on Heliothis and Spodoptera</li>\r\n	<li>The rain-fastness action prevents the washing away of the product from the leaf surface even if it rains 4 hours after the application</li>\r\n	<li><em>Indofil Volax Insecticide</em>&nbsp;is safer to beneficial insects like predator and parasites.</li>\r\n</ul>\r\n\r\n<h2>Volax Insecticide (Emamectin benzoate 5% SG) Usage &amp; Crops</h2>\r\n\r\n<p><strong>Recommendations:</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Target Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Target Insect/Pest/Disease</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dose/acre (gm)</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Water/acre (liter)</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cotton</p>\r\n			</td>\r\n			<td>\r\n			<p>Bollworms</p>\r\n			</td>\r\n			<td>\r\n			<p>76-88gm</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Okra</p>\r\n			</td>\r\n			<td>\r\n			<p>Fruit &amp; Shoot Borer</p>\r\n			</td>\r\n			<td>\r\n			<p>54-69gm</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>Method of Application:</strong>&nbsp;Foliar Spray.</p>\r\n\r\n<h2>Additional Information</h2>\r\n\r\n<ul>\r\n	<li>Volax Insecticide&nbsp;(Emamectin benzoate 5% SG) can be used in combination with other insecticides and fungicides</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 18:21:55', '2026-05-20 13:45:33', 1, 1, 'Volax Insecticide- Emamectin benzoate', 'Overview\r\n\r\nProduct Name	Volax Insecticide\r\nBrand	Indofil\r\nCategory	Insecticides\r\nTechnical Content	Emamectin benzoate 05% SG\r\nClassification	Chemical\r\nToxicity	Yellow\r\nProduct Description\r\n\r\nAbout Volax Insecticide\r\nVolax Insecticide is a non-systemic insecticide which penetrates leaf tissues by trans-laminar movement.\r\nVolax Insecticide Technical Details\r\nTechnical Name: Emamectin benzoate 5% SG\r\nMode of Entry: Contact\r\nMode of Action: It acts on chloride channel activation which causes elimination of signal transmission and paralyzed insects’ muscles which stops feeding in just 2 hours after ingestion and death occurs in 48 to 72 hours.\r\nKey Features & Benefits\r\nThe active ingredient penetrates leaf tissues and form a toxic reservoir within the treated leaves\r\nThis toxic reservoir provides excellent residual activity against foliage feeding caterpillar\r\nGives simultaneous control on Heliothis and Spodoptera\r\nThe rain-fastness action prevents the washing away of the product from the leaf surface even if it rains 4 hours after the application\r\nIndofil Volax Insecticide is safer to beneficial insects like predator and parasites.\r\nVolax Insecticide (Emamectin benzoate 5% SG) Usage & Crops\r\nRecommendations:\r\n\r\nTarget Crops\r\n\r\nTarget Insect/Pest/Disease\r\n\r\nDose/acre (gm)\r\n\r\nWater/acre (liter)\r\n\r\nCotton\r\n\r\nBollworms\r\n\r\n76-88gm\r\n\r\n200\r\n\r\nOkra\r\n\r\nFruit & Shoot Borer\r\n\r\n54-69gm\r\n\r\n200\r\n\r\nMethod of Application: Foliar Spray.\r\n\r\nAdditional Information\r\nVolax Insecticide (Emamectin benzoate 5% SG) can be used in combination with other insecticides and fungicides\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a08686b52c0b.png', 1, NULL, 0.00, 0, NULL, NULL, '150789', 1),
(113, 'admin', 1, NULL, 'Dragon King Watermelon Seeds by Syngenta - Sweet & Hybrid Variety', 'dragon-king-watermelon-seeds-by-syngenta-sweet-hybrid-variety-6ui5gE', 'Dragon King Watermelon Seeds by Syngenta', 'physical', '[{\"id\":\"21\",\"position\":1},{\"id\":\"24\",\"position\":2},{\"id\":\"25\",\"position\":3}]', 5, 'pc', 1, 1, NULL, NULL, '[\"2026-05-16-6a086bce0a2e2.png\",\"2026-05-16-6a086bce0a8b5.png\",\"2026-05-16-6a086bce0aab1.png\"]', '[]', '2026-05-16-6a086bce0ac28.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"500seeds\"]}]', '[{\"type\":\"500seeds\",\"price\":575,\"sku\":\"DKWSbS-S&HV-500seeds\",\"qty\":1250}]', 0, 575, 0.00, 0.00, 575, '0.00', 'percent', 'include', '8', 46.00, 529.00, 'percent', 1250, 10, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Dragon King Watermelon Seeds</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Syngenta</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Fruit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Watermelon Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2><strong>Key Features</strong></h2>\r\n\r\n<ul>\r\n	<li>The&nbsp;<strong>Dragon King Watermelon Seeds</strong>&nbsp;is known for its sweet and juicy flesh.</li>\r\n	<li>It has a durable rind that is good for long-distance transportability.</li>\r\n	<li><em>Dragon King Watermelon</em>&nbsp;Seeds has a prolific fruit set and good yield</li>\r\n</ul>\r\n\r\n<h2>Dragon King Watermelon Seeds Characteristics</h2>\r\n\r\n<ul>\r\n	<li><strong>Plant Type:</strong>&nbsp;Asian Jubili Type Watermelon</li>\r\n	<li><strong>Fruit Colour:</strong>&nbsp;Light green with dark green stripes, bright red crisp flesh</li>\r\n	<li><strong>Fruit Shape:</strong>&nbsp;Oblong</li>\r\n	<li><strong>Fruit Weight:</strong>&nbsp;8-12 kg</li>\r\n	<li><strong>Total Soluble Sugars (Sweetness):</strong>&nbsp;TSS 10% to 11%</li>\r\n	<li><strong>Average Yield:</strong>&nbsp;18 MT/acre (depending on season and cultural practice)</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Sowing Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Sowing Season &amp; Recommended States:</strong></li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Season</td>\r\n			<td>States</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kharif</td>\r\n			<td>KA, TN, AP, TS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rabi</td>\r\n			<td>AP, TS, BR, CG, GJ, HP, PB, KA, MP, OD, RJ, TN, UP, WB, AS ,TR</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Summer</td>\r\n			<td>KA, RJ, TN</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<ul>\r\n	<li><strong>Seed Rate:</strong>&nbsp;300 - 350 gm per Acre</li>\r\n	<li><strong>Time of Transplanting:</strong>&nbsp;Dragon King watermelon Seeds can also be transplanted. Seedlings at 4 leaves or 20 days old are planted.</li>\r\n	<li><strong>Spacing:</strong>&nbsp;Row to Row and Plant to Plant -120 &times; 30 cm (Single Row) or 240 &times; 30 cm (Double Row)</li>\r\n	<li><strong>First Harvest:</strong>&nbsp;Harvest the fruit at the time of physiological maturity. Date of maturity or days after sowing (85-90 days)</li>\r\n</ul>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>Total N:P: K requirement for watermelon crop is 80:100:120 kg per acre.</li>\r\n	<li>Do not spray during the peak pollination period.</li>\r\n	<li>The maturity of watermelon can be judged by the following steps:</li>\r\n	<li>A dead tendril attaches to the vine</li>\r\n	<li>Dull appearance of the fruit compared to their slick appearance</li>\r\n	<li>Maturity is also judged by metallic sounds</li>\r\n	<li>After harvesting fruits should not be left long in the sun otherwise sun scaled may develop</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 18:36:22', '2026-05-20 13:44:09', 1, 1, 'Dragon King Watermelon Seeds by Syngenta - Sweet & Hybrid Variety', 'Overview\r\n\r\nProduct Name	Dragon King Watermelon Seeds\r\nBrand	Syngenta\r\nCrop Type	Fruit\r\nCrop Name	Watermelon Seeds\r\nProduct Description\r\n\r\nKey Features\r\nThe Dragon King Watermelon Seeds is known for its sweet and juicy flesh.\r\nIt has a durable rind that is good for long-distance transportability.\r\nDragon King Watermelon Seeds has a prolific fruit set and good yield\r\nDragon King Watermelon Seeds Characteristics\r\nPlant Type: Asian Jubili Type Watermelon\r\nFruit Colour: Light green with dark green stripes, bright red crisp flesh\r\nFruit Shape: Oblong\r\nFruit Weight: 8-12 kg\r\nTotal Soluble Sugars (Sweetness): TSS 10% to 11%\r\nAverage Yield: 18 MT/acre (depending on season and cultural practice)\r\n\r\n\r\nSowing Details\r\nSowing Season & Recommended States:\r\nSeason	States\r\nKharif	KA, TN, AP, TS\r\nRabi	AP, TS, BR, CG, GJ, HP, PB, KA, MP, OD, RJ, TN, UP, WB, AS ,TR\r\nSummer	KA, RJ, TN\r\nSeed Rate: 300 - 350 gm per Acre\r\nTime of Transplanting: Dragon King watermelon Seeds can also be transplanted. Seedlings at 4 leaves or 20 days old are planted.\r\nSpacing: Row to Row and Plant to Plant -120 × 30 cm (Single Row) or 240 × 30 cm (Double Row)\r\nFirst Harvest: Harvest the fruit at the time of physiological maturity. Date of maturity or days after sowing (85-90 days)\r\nAdditional Information\r\nTotal N:P: K requirement for watermelon crop is 80:100:120 kg per acre.\r\nDo not spray during the peak pollination period.\r\nThe maturity of watermelon can be judged by the following steps:\r\nA dead tendril attaches to the vine\r\nDull appearance of the fruit compared to their slick appearance\r\nMaturity is also judged by metallic sounds\r\nAfter harvesting fruits should not be left long in the sun otherwise sun scaled may develop\r\nDisclaimer: This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a086bce0aee5.png', 1, NULL, 0.00, 0, NULL, NULL, '155078', 1);
INSERT INTO `products` (`id`, `added_by`, `user_id`, `pid`, `name`, `slug`, `tally_name`, `product_type`, `category_ids`, `brand_id`, `unit`, `min_qty`, `refundable`, `digital_product_type`, `digital_file_ready`, `images`, `color_image`, `thumbnail`, `featured`, `flash_deal`, `video_provider`, `video_url`, `colors`, `variant_product`, `attributes`, `choice_options`, `variation`, `published`, `unit_price`, `suggested_price`, `lowest_market_price`, `purchase_price`, `tax`, `tax_type`, `tax_model`, `discount`, `discount_amount`, `actual_amount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `free_shipping`, `attachment`, `created_at`, `updated_at`, `status`, `featured_status`, `meta_title`, `meta_description`, `meta_image`, `request_status`, `denied_note`, `shipping_cost`, `multiply_qty`, `temp_shipping_cost`, `is_shipping_cost_updated`, `code`, `indexing`) VALUES
(114, 'admin', 1, NULL, 'Heemsohna Tomato Seeds by Syngenta | Indeterminate, Hybrid Variety', 'heemsohna-tomato-seeds-by-syngenta-indeterminate-hybrid-variety-SjoE9o', 'Heemsohna Tomato Seeds by Syngenta', 'physical', '[{\"id\":\"21\",\"position\":1},{\"id\":\"24\",\"position\":2},{\"id\":\"25\",\"position\":3}]', 7, 'pc', 1, 1, NULL, NULL, '[\"2026-05-16-6a0870f9cadb5.png\",\"2026-05-16-6a0870f9cb20d.png\"]', '[]', '2026-05-16-6a0870f9cb4d1.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"300seeds\",\"  3000seeds\",\"  10gm\"]}]', '[{\"type\":\"300seeds\",\"price\":1231,\"sku\":\"HTSbS|IHV-300seeds\",\"qty\":1544},{\"type\":\"3000seeds\",\"price\":1170,\"sku\":\"HTSbS|IHV-3000seeds\",\"qty\":1547},{\"type\":\"10gm\",\"price\":665,\"sku\":\"HTSbS|IHV-10gm\",\"qty\":1563}]', 0, 1231, 0.00, 0.00, 1231, '0.00', 'percent', 'include', '13', 160.03, 1070.97, 'percent', 4654, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Heemsohna Tomato</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Syngenta</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Vegetable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Tomato Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2><strong>Key Features</strong></h2>\r\n\r\n<ul>\r\n	<li>Heemsohna Tomato produces indeterminate tall vigorous plants</li>\r\n	<li>Medium foliage cover with profuse branching</li>\r\n	<li>High yield potential</li>\r\n	<li>Long duration crop variety</li>\r\n	<li>Good for long distance transportation</li>\r\n</ul>\r\n\r\n<h2><strong>Characteristics</strong></h2>\r\n\r\n<ul>\r\n	<li>Plant Type: Indeterminate</li>\r\n	<li>Fruit Colour: Red &amp; glossy fruit</li>\r\n	<li>Pack size: Medium size</li>\r\n	<li>Fruit Shape: Oblate</li>\r\n	<li>Fruit weight: 90-100 gm</li>\r\n	<li>Yield: 25- 30 MT/acre (depending on season and cultural practice)</li>\r\n</ul>\r\n\r\n<h2><strong>Sowing Details</strong></h2>\r\n\r\n<p>Sowing Season &amp; Recommended states</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>Season</p>\r\n			</td>\r\n			<td>\r\n			<p>States</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Kharif</p>\r\n			</td>\r\n			<td>\r\n			<p>MH, MP, GJ, TN, KA, AP, TS, RJ, HR, PB, UP, BH, WB, CH, OD, JH, AS, HP, NE, &amp; UK</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Rabi</p>\r\n			</td>\r\n			<td>\r\n			<p>MH, MP, GJ, TN, KA, AP, TS, RJ, HY, PB, UP, BH, WB, CH, OD, JH, AS, HP, NE, &amp; UK</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Summer</p>\r\n			</td>\r\n			<td>\r\n			<p>MH, MP, GJ, TN, KA, AP, TS, RJ, HY, PB, UP, BH, WB, CH, OD, JH, AS, HP, NE, &amp; UK</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Seed Rate: 40-50 gm/acre</p>\r\n\r\n<p>Method of Sowing: Line sowing</p>\r\n\r\n<p>Time of transplanting: Transplanting should be done at 21-25 days after sowing.</p>\r\n\r\n<p>Spacing: Row to Row and Plant to Plant - 120 x 45 or 90 x 45 cm</p>\r\n\r\n<p>First Harvest (DAT): 65- 70</p>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-16 18:58:25', '2026-05-20 13:58:13', 1, 1, 'Heemsohna Tomato Seeds by Syngenta', 'Overview\r\nProduct Name	Heemsohna Tomato\r\nBrand	Syngenta\r\nCrop Type	Vegetable\r\nCrop Name	Tomato Seeds\r\nProduct Description\r\nKey Features\r\nHeemsohna Tomato produces indeterminate tall vigorous plants\r\nMedium foliage cover with profuse branching\r\nHigh yield potential\r\nLong duration crop variety\r\nGood for long distance transportation\r\nCharacteristics\r\nPlant Type: Indeterminate\r\nFruit Colour: Red & glossy fruit\r\nPack size: Medium size\r\nFruit Shape: Oblate\r\nFruit weight: 90-100 gm\r\nYield: 25- 30 MT/acre (depending on season and cultural practice)\r\nSowing Details\r\nSowing Season & Recommended states\r\n\r\nSeason\r\n\r\nStates\r\n\r\nKharif\r\n\r\nMH, MP, GJ, TN, KA, AP, TS, RJ, HR, PB, UP, BH, WB, CH, OD, JH, AS, HP, NE, & UK\r\n\r\nRabi\r\n\r\nMH, MP, GJ, TN, KA, AP, TS, RJ, HY, PB, UP, BH, WB, CH, OD, JH, AS, HP, NE, & UK\r\n\r\nSummer\r\n\r\nMH, MP, GJ, TN, KA, AP, TS, RJ, HY, PB, UP, BH, WB, CH, OD, JH, AS, HP, NE, & UK\r\n\r\nSeed Rate: 40-50 gm/acre\r\n\r\nMethod of Sowing: Line sowing\r\n\r\nTime of transplanting: Transplanting should be done at 21-25 days after sowing.\r\n\r\nSpacing: Row to Row and Plant to Plant - 120 x 45 or 90 x 45 cm\r\n\r\nFirst Harvest (DAT): 65- 70\r\n\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-16-6a0870f9cb6a8.png', 1, NULL, 0.00, 0, NULL, NULL, '129312', 1),
(115, 'admin', 1, NULL, 'Bhoomi Coriander Seeds: Aromatic, Multi-Cut, High-Yield Variety', 'bhoomi-coriander-seeds-aromatic-multi-cut-high-yield-variety-ZePIVM', 'Bhoomi Coriander Seeds', 'physical', '[{\"id\":\"21\",\"position\":1},{\"id\":\"24\",\"position\":2},{\"id\":\"25\",\"position\":3}]', 9, 'pc', 1, 1, NULL, NULL, '[\"2026-05-18-6a0a9ba6755ec.png\"]', '[]', '2026-05-18-6a0a9ba677c78.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"500seeds\"]}]', '[{\"type\":\"500seeds\",\"price\":280,\"sku\":\"BCSAMHV-500seeds\",\"qty\":150}]', 0, 280, 0.00, 0.00, 280, '0.00', 'percent', 'include', '05', 14.00, 266.00, 'percent', 150, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Bhoomi Coriander Seeds</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Namdhari Seeds</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Vegetable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Coriander Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<p><strong>Seed Specifications</strong></p>\r\n\r\n<ul>\r\n	<li>Temperature : 18&ndash;21&deg;C</li>\r\n	<li>Excellent multi cut variety</li>\r\n	<li>Broad green leaves with strong aroma</li>\r\n	<li>More number of branches.</li>\r\n	<li>First cutting in 28-30 days.</li>\r\n</ul>', 0, NULL, '2026-05-18 10:25:02', '2026-05-20 13:15:50', 1, 1, 'Bhoomi Coriander Seeds: Aromatic, Multi-Cut, High-Yield Variety', 'Overview\r\nProduct Name	Bhoomi Coriander Seeds\r\nBrand	Namdhari Seeds\r\nCrop Type	Vegetable\r\nCrop Name	Coriander Seeds\r\nProduct Description\r\nSeed Specifications\r\n\r\nTemperature : 18–21°C\r\nExcellent multi cut variety\r\nBroad green leaves with strong aroma\r\nMore number of branches.\r\nFirst cutting in 28-30 days.', '2026-05-20-6a0d66ae47cfb.png', 1, NULL, 0.00, 0, NULL, NULL, '105715', 1),
(116, 'admin', 1, NULL, 'VNR 109 F1 Hybrid Chilli Seeds - Early maturity, Light Green, Medium Pungent, Hi', 'vnr-109-f1-hybrid-chilli-seeds-early-maturity-light-green-medium-pungent-high-yield-NHkWFR', 'VNR 109 F1 Hybrid Chilli Seeds', 'physical', '[{\"id\":\"21\",\"position\":1},{\"id\":\"24\",\"position\":2},{\"id\":\"25\",\"position\":3}]', 9, 'pc', 1, 1, NULL, NULL, '[\"2026-05-18-6a0aa130cc532.png\"]', '[]', '2026-05-18-6a0aa130cc93d.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"10gms\"]}]', '[{\"type\":\"10gms\",\"price\":640,\"sku\":\"V1FHCS-EmLGMPHY-10gms\",\"qty\":115}]', 0, 640, 0.00, 0.00, 640, '0.00', 'percent', 'include', '19', 121.60, 518.40, 'percent', 115, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>109 F1 Hybrid Chilli Seeds</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>VNR</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Vegetable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Chilli Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2><strong>Key Features</strong></h2>\r\n\r\n<ul>\r\n	<li>VNR 109 is a early hybrid with very good heat set</li>\r\n	<li>It produces light green, medium pungent, tough fruits, suitable for distant transportation</li>\r\n	<li>Short picking interval &amp; high yield potential</li>\r\n	<li>It produces umbrella canopy</li>\r\n</ul>\r\n\r\n<h2><strong>Characteristics</strong></h2>\r\n\r\n<ul>\r\n	<li>Fruit Colour: Light green</li>\r\n	<li>Fruit Length: 13-17 cm</li>\r\n	<li>Fruit Width: 1.4-1.7 cm</li>\r\n</ul>\r\n\r\n<h2><strong>Sowing Details:</strong></h2>\r\n\r\n<p><strong>Sowing Season &amp; Recommended states</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Season</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>States</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Kharif</p>\r\n			</td>\r\n			<td>\r\n			<p>UP, BR, JH, OD, CH, WB, HR, PB, DL, RJ, HP, UK, GJ, MH, MP, AP, KA, TN, KL and NES.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Rabi</p>\r\n			</td>\r\n			<td>\r\n			<p>UP, BR, JH, OD, CH, WB, HR, PB, DL, RJ, HP, UK, GJ, MH, MP, AP, KA, TN, KL and NES.</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Summer</p>\r\n			</td>\r\n			<td>\r\n			<p>UP, BR, JH, OD, CH, WB, HR, PB, DL, RJ, HP, UK, GJ, MH, MP, AP, KA, TN, KL and NES.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Seed Rate: 60 - 80 gm/acre</p>\r\n\r\n<p>Spacing: Row to Ridges is 3 - 5 ft and Plant to Plant is 1.5 - 2 ft</p>\r\n\r\n<p>First harvest: 40 &ndash; 45 days</p>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 10:48:40', '2026-05-20 13:12:57', 1, 1, 'VNR 109 F1 Hybrid Chilli Seeds - Early maturity, Light Green, Medium Pungent, High Yield', 'Overview\r\nProduct Name	109 F1 Hybrid Chilli Seeds\r\nBrand	VNR\r\nCrop Type	Vegetable\r\nCrop Name	Chilli Seeds\r\nProduct Description\r\nKey Features\r\nVNR 109 is a early hybrid with very good heat set\r\nIt produces light green, medium pungent, tough fruits, suitable for distant transportation\r\nShort picking interval & high yield potential\r\nIt produces umbrella canopy\r\nCharacteristics\r\nFruit Colour: Light green\r\nFruit Length: 13-17 cm\r\nFruit Width: 1.4-1.7 cm\r\nSowing Details:\r\nSowing Season & Recommended states\r\n\r\nSeason\r\n\r\nStates\r\n\r\nKharif\r\n\r\nUP, BR, JH, OD, CH, WB, HR, PB, DL, RJ, HP, UK, GJ, MH, MP, AP, KA, TN, KL and NES.\r\n\r\nRabi\r\n\r\nUP, BR, JH, OD, CH, WB, HR, PB, DL, RJ, HP, UK, GJ, MH, MP, AP, KA, TN, KL and NES.\r\n\r\nSummer\r\n\r\nUP, BR, JH, OD, CH, WB, HR, PB, DL, RJ, HP, UK, GJ, MH, MP, AP, KA, TN, KL and NES.\r\n\r\nSeed Rate: 60 - 80 gm/acre\r\n\r\nSpacing: Row to Ridges is 3 - 5 ft and Plant to Plant is 1.5 - 2 ft\r\n\r\nFirst harvest: 40 – 45 days\r\n\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-18-6a0aa130ccaa0.png', 1, NULL, 0.00, 0, NULL, NULL, '114608', 1),
(117, 'admin', 1, NULL, 'ANMOL YELLOW WATERMELON', 'anmol-yellow-watermelon-54bmKv', 'ANMOL YELLOW WATERMELON', 'physical', '[{\"id\":\"21\",\"position\":1},{\"id\":\"24\",\"position\":2},{\"id\":\"25\",\"position\":3}]', 9, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0aa5443ffef.png\",\"2026-05-18-6a0aa54440c2b.png\"]', '[]', '2026-05-18-6a0aa54440d7b.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"20gms\",\"  50gms\",\"  10gms\"]}]', '[{\"type\":\"20gms\",\"price\":1890,\"sku\":\"AYW-20gms\",\"qty\":1524},{\"type\":\"50gms\",\"price\":4500,\"sku\":\"AYW-50gms\",\"qty\":1452},{\"type\":\"10gms\",\"price\":743,\"sku\":\"AYW-10gms\",\"qty\":124}]', 0, 1890, 0.00, 0.00, 1890, '0.00', 'percent', 'include', '29', 548.10, 1341.90, 'percent', 3100, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>ANMOL YELLOW WATERMELON ( अनमोल पीला तरबूज )</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Known-You</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Fruit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Watermelon Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<p><strong>Description:</strong></p>\r\n\r\n<ul>\r\n	<li>A revolutionary type of yellow-fleshed watermelon.</li>\r\n	<li><strong>Fruit:</strong>&nbsp;Dark skin with vague stripes, tall globe-shaped, crisp and fine quality flesh</li>\r\n	<li><strong>Fruit weight:</strong>&nbsp;around 3-5 Kg in weight,</li>\r\n	<li><strong>Specific feature</strong>: Strong tolerance against diseases.</li>\r\n	<li><strong>Harvesting:</strong>&nbsp;75-80 days from sowing to harvest</li>\r\n	<li><strong>Season</strong>&nbsp;: Late kharif, early summer</li>\r\n</ul>', 0, NULL, '2026-05-18 11:06:04', '2026-05-20 13:07:48', 1, 1, 'ANMOL YELLOW WATERMELON', 'Overview\r\nProduct Name	ANMOL YELLOW WATERMELON\r\nBrand	Known-You\r\nCrop Type	Fruit\r\nCrop Name	Watermelon Seeds\r\nProduct Description\r\nDescription:\r\n\r\nA revolutionary type of yellow-fleshed watermelon.\r\nFruit: Dark skin with vague stripes, tall globe-shaped, crisp and fine quality flesh\r\nFruit weight: around 3-5 Kg in weight,\r\nSpecific feature: Strong tolerance against diseases.\r\nHarvesting: 75-80 days from sowing to harvest\r\nSeason : Late kharif, early summer', '2026-05-18-6a0aa54440ee9.png', 1, NULL, 0.00, 0, NULL, NULL, '185865', 1),
(118, 'admin', 1, NULL, 'Antracol Fungicide by Bayer (Propineb 70% WP) for Fungal Diseases', 'antracol-fungicide-by-bayer-propineb-70-wp-for-fungal-diseases-kESUkG', 'Antracol Fungicide by Bayer', 'physical', '[{\"id\":\"20\",\"position\":1}]', 2, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0aaa4336a15.png\",\"2026-05-18-6a0aaa43379b2.png\",\"2026-05-18-6a0aaa4337bc7.png\",\"2026-05-18-6a0aaa4337dab.png\",\"2026-05-18-6a0aaa4337f51.png\",\"2026-05-18-6a0aaa4338136.png\",\"2026-05-18-6a0aaa43382ec.png\",\"2026-05-18-6a0aaa43384c3.png\",\"2026-05-18-6a0aaa4338641.png\",\"2026-05-18-6a0aaa43387fd.png\"]', '[]', '2026-05-18-6a0aaa4338a0e.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"250gms\",\"  1kg\",\"  500gms\"]}]', '[{\"type\":\"250gms\",\"price\":350,\"sku\":\"AFbB(7WfFD-250gms\",\"qty\":156},{\"type\":\"1kg\",\"price\":1160,\"sku\":\"AFbB(7WfFD-1kg\",\"qty\":1445},{\"type\":\"500gms\",\"price\":600,\"sku\":\"AFbB(7WfFD-500gms\",\"qty\":1457}]', 0, 350, 0.00, 0.00, 350, '0.00', 'percent', 'include', '018', 63.00, 287.00, 'percent', 3058, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Antracol Fungicide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Bayer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Propineb 70% WP</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Antracol Fungicide</h2>\r\n\r\n<ul>\r\n	<li><strong>Antracol Fungicide</strong>&nbsp;is formulated with Propineb.</li>\r\n	<li><strong>Antracol technical name - Propineb 70% WP</strong></li>\r\n	<li>It is recognized for its wide-ranging efficacy in combating diseases that affect crops such as rice, chilli, grapes, potatoes, and a variety of other vegetables and fruits.</li>\r\n	<li>Propineb is a polymeric zinc-containing dithiocarbamate. Due to the release of zinc, the application of Antracol results in greening effect on the crop.</li>\r\n	<li><em>Antracol Fungicide</em>&nbsp;helps to improve the quality of produce.</li>\r\n</ul>\r\n\r\n<h2><strong>Antracol Fungicide Technical Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:</strong>&nbsp;Propineb 70% WP</li>\r\n	<li><strong>Mode of Entry:</strong>&nbsp;Contact</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;Propineb interferes at different locations in the metabolism of the fungi; on several points of the respiration chain, in the metabolism of carbohydrates and proteins, in the cell membranes. This multi-site mode of action of Propineb prevents development of resistance in the fungi.</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Antracol Fungicide&nbsp;has a broad spectrum of activity.</li>\r\n	<li>Both contact and preventive action.</li>\r\n	<li>As a result of its multi-site complex mode of action, Antracol is particularly suited for use in spraying programs to combat and prevent the selection of resistant population of fungal pathogen.</li>\r\n	<li>Superior formulation: fine particle size, better suspension in water.</li>\r\n	<li>Rain fastness leading to better efficacy.</li>\r\n	<li>Availability of zinc &ndash; positive effect on crops and improves immunity of plants resulting in higher yields and improvement in quality.</li>\r\n</ul>\r\n\r\n<h2><strong>Antracol Fungicide Usage &amp; Crops</strong></h2>\r\n\r\n<p><strong>Recommendations:</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Crop</td>\r\n			<td>Target Diseases</td>\r\n			<td>Dosage (gm) /Acre</td>\r\n			<td>Dilution in water (L)/Acre</td>\r\n			<td>Waiting Period (PHI) in days</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Apple</td>\r\n			<td>Scab</td>\r\n			<td>600</td>\r\n			<td>200</td>\r\n			<td>30</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pomegranate</td>\r\n			<td>Leaf and Fruit Spots</td>\r\n			<td>600</td>\r\n			<td>200</td>\r\n			<td>10</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Potato</td>\r\n			<td>Early and Late Blight</td>\r\n			<td>600</td>\r\n			<td>200</td>\r\n			<td>15</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chilli</td>\r\n			<td>Die Back</td>\r\n			<td>1000</td>\r\n			<td>200</td>\r\n			<td>10</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tomato</td>\r\n			<td>Buck Eye Rot</td>\r\n			<td>600</td>\r\n			<td>200</td>\r\n			<td>10</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Grapes</td>\r\n			<td>Downy Mildew</td>\r\n			<td>600</td>\r\n			<td>200</td>\r\n			<td>40</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rice</td>\r\n			<td>Brown Leaf Spot, Narrow Leaf Spot</td>\r\n			<td>600-800</td>\r\n			<td>200</td>\r\n			<td>27</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Method of Application:</strong>&nbsp;Foliar Spray</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>Antracol should be applied as a protectant fungicide.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 11:27:23', '2026-05-20 13:04:45', 1, 1, 'Antracol Fungicide by Bayer (Propineb 70% WP) for Fungal Diseases', 'Overview\r\nProduct Name	Antracol Fungicide\r\nBrand	Bayer\r\nCategory	Fungicides\r\nTechnical Content	Propineb 70% WP\r\nClassification	Chemical\r\nToxicity	Blue\r\nProduct Description\r\nAbout Antracol Fungicide\r\nAntracol Fungicide is formulated with Propineb.\r\nAntracol technical name - Propineb 70% WP\r\nIt is recognized for its wide-ranging efficacy in combating diseases that affect crops such as rice, chilli, grapes, potatoes, and a variety of other vegetables and fruits.\r\nPropineb is a polymeric zinc-containing dithiocarbamate. Due to the release of zinc, the application of Antracol results in greening effect on the crop.\r\nAntracol Fungicide helps to improve the quality of produce.\r\nAntracol Fungicide Technical Details\r\nTechnical Content: Propineb 70% WP\r\nMode of Entry: Contact\r\nMode of Action: Propineb interferes at different locations in the metabolism of the fungi; on several points of the respiration chain, in the metabolism of carbohydrates and proteins, in the cell membranes. This multi-site mode of action of Propineb prevents development of resistance in the fungi.\r\nKey Features & Benefits\r\nAntracol Fungicide has a broad spectrum of activity.\r\nBoth contact and preventive action.\r\nAs a result of its multi-site complex mode of action, Antracol is particularly suited for use in spraying programs to combat and prevent the selection of resistant population of fungal pathogen.\r\nSuperior formulation: fine particle size, better suspension in water.\r\nRain fastness leading to better efficacy.\r\nAvailability of zinc – positive effect on crops and improves immunity of plants resulting in higher yields and improvement in quality.\r\nAntracol Fungicide Usage & Crops\r\nRecommendations:\r\n\r\nCrop	Target Diseases	Dosage (gm) /Acre	Dilution in water (L)/Acre	Waiting Period (PHI) in days\r\nApple	Scab	600	200	30\r\nPomegranate	Leaf and Fruit Spots	600	200	10\r\nPotato	Early and Late Blight	600	200	15\r\nChilli	Die Back	1000	200	10\r\nTomato	Buck Eye Rot	600	200	10\r\nGrapes	Downy Mildew	600	200	40\r\nRice	Brown Leaf Spot, Narrow Leaf Spot	600-800	200	27\r\n \r\n\r\nMethod of Application: Foliar Spray\r\n\r\n \r\n\r\nAdditional Information\r\nAntracol should be applied as a protectant fungicide.\r\n \r\n\r\nDisclaimer: This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-18-6a0aaa4338bf0.png', 1, NULL, 0.00, 0, NULL, NULL, '135167', 1),
(119, 'admin', 1, NULL, 'Acrobat Fungicide by BASF (Dimethomorph 50% WP) for Downy Mildew & Late Blight', 'acrobat-fungicide-by-basf-dimethomorph-50-wp-for-downy-mildew-late-blight-kypysD', 'Acrobat Fungicide by BASF', 'physical', '[{\"id\":\"20\",\"position\":1}]', 1, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0aae4984898.png\",\"2026-05-18-6a0aae4984ce2.png\",\"2026-05-18-6a0aae4984e93.png\",\"2026-05-18-6a0aae4985019.png\",\"2026-05-18-6a0aae49852c4.png\",\"2026-05-18-6a0aae498543b.png\",\"2026-05-18-6a0aae49855d1.png\",\"2026-05-18-6a0aae49857f3.png\",\"2026-05-18-6a0aae498598f.png\",\"2026-05-18-6a0aae4985b23.png\"]', '[]', '2026-05-18-6a0aae4985d10.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"100gms\",\"  200gms\",\"  1kg\"]}]', '[{\"type\":\"100gms\",\"price\":849,\"sku\":\"AFbB(5WfDM&LB-100gms\",\"qty\":1},{\"type\":\"200gms\",\"price\":1568,\"sku\":\"AFbB(5WfDM&LB-200gms\",\"qty\":1},{\"type\":\"1kg\",\"price\":7291,\"sku\":\"AFbB(5WfDM&LB-1kg\",\"qty\":1}]', 0, 849, 0.00, 0.00, 849, '0.00', 'percent', 'include', '29', 246.21, 602.79, 'percent', 3, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Acrobat Fungicide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>BASF</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Dimethomorph 50% WP</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Acrobat Fungicide</h2>\r\n\r\n<ul>\r\n	<li><strong>Acrobat Fungicide</strong>&nbsp;is from one of most trusted and oldest brand to&nbsp;<strong>control Downy Mildew and Late blight fungal diseases.</strong></li>\r\n	<li><strong>Acrobat Fungicide technical name - Dimethomorph 50% WP</strong></li>\r\n	<li>Acrobat is supporting Indian Fruits &amp; Vegetable growers to manage their crops most devastating diseases in a highly effective way.</li>\r\n	<li>It acts fast and effectively against Pythium and Phytophthora species.</li>\r\n</ul>\r\n\r\n<h2>Acrobat Fungicide Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:&nbsp;</strong>Dimethomorph 50% WP</li>\r\n	<li><strong>Mode of Entry:&nbsp;</strong>Systemic Action</li>\r\n	<li><strong>Mode of Action:&nbsp;</strong>Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action.</li>\r\n</ul>\r\n\r\n<h2>Key Features and Benefits</h2>\r\n\r\n<ul>\r\n	<li>Dimethomorph is a systemic morpholine fungicide</li>\r\n	<li>Effective against all the stages of fungi</li>\r\n	<li><em>Acrobat Fungicide</em>&nbsp;has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection</li>\r\n</ul>\r\n\r\n<h2>Acrobat Fungicide Usage and Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommended Crops:</strong><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Crops</td>\r\n			<td>Target Disease</td>\r\n			<td>Dosage/ Acre in (g)</td>\r\n			<td>Dilution in water (L)</td>\r\n			<td>Dosage(g) / Litre of water</td>\r\n			<td>Waiting from last spray to harvest (days)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Potato</td>\r\n			<td>Downy Mildew &amp; Late blight</td>\r\n			<td>400</td>\r\n			<td>300 L</td>\r\n			<td>1.3</td>\r\n			<td>16</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Grapes</td>\r\n			<td>Downy Mildew &amp; Late blight</td>\r\n			<td>400</td>\r\n			<td>300 L</td>\r\n			<td>1.3</td>\r\n			<td>34</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li><strong>Method of Application:&nbsp;</strong>Foliar spray</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 11:44:33', '2026-05-20 13:03:37', 1, 1, 'Acrobat Fungicide by BASF', 'Overview\r\nProduct Name	Acrobat Fungicide\r\nBrand	BASF\r\nCategory	Fungicides\r\nTechnical Content	Dimethomorph 50% WP\r\nClassification	Chemical\r\nToxicity	Blue\r\nProduct Description\r\nAbout Acrobat Fungicide\r\nAcrobat Fungicide is from one of most trusted and oldest brand to control Downy Mildew and Late blight fungal diseases.\r\nAcrobat Fungicide technical name - Dimethomorph 50% WP\r\nAcrobat is supporting Indian Fruits & Vegetable growers to manage their crops most devastating diseases in a highly effective way.\r\nIt acts fast and effectively against Pythium and Phytophthora species.\r\nAcrobat Fungicide Technical Details\r\nTechnical Content: Dimethomorph 50% WP\r\nMode of Entry: Systemic Action\r\nMode of Action: Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action.\r\nKey Features and Benefits\r\nDimethomorph is a systemic morpholine fungicide\r\nEffective against all the stages of fungi\r\nAcrobat Fungicide has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection\r\nAcrobat Fungicide Usage and Crops\r\nRecommended Crops:\r\n\r\nCrops	Target Disease	Dosage/ Acre in (g)	Dilution in water (L)	Dosage(g) / Litre of water	Waiting from last spray to harvest (days)\r\nPotato	Downy Mildew & Late blight	400	300 L	1.3	16\r\nGrapes	Downy Mildew & Late blight	400	300 L	1.3	34\r\n\r\nMethod of Application: Foliar spray\r\nDisclaimer:\r\nThis information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-18-6a0aae4985eba.png', 1, NULL, 0.00, 0, NULL, NULL, '164438', 1),
(120, 'admin', 1, NULL, 'Dhanuka M45 Fungicide (Mancozeb 75% WP) for Fungal Disease Control', 'dhanuka-m45-fungicide-mancozeb-75-wp-for-fungal-disease-control-4eWJDP', 'Dhanuka M45 Fungicide', 'physical', '[{\"id\":\"20\",\"position\":1}]', 3, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0ab01196933.png\",\"2026-05-18-6a0ab01196edd.png\",\"2026-05-18-6a0ab01197134.png\",\"2026-05-18-6a0ab0119731c.png\",\"2026-05-18-6a0ab011974b4.png\"]', '[]', '2026-05-18-6a0ab0119785b.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"250gms\",\"  1kg\",\"  500gm\"]}]', '[{\"type\":\"250gms\",\"price\":156,\"sku\":\"DMF(7WfFDC-250gms\",\"qty\":156},{\"type\":\"1kg\",\"price\":561,\"sku\":\"DMF(7WfFDC-1kg\",\"qty\":147},{\"type\":\"500gm\",\"price\":291,\"sku\":\"DMF(7WfFDC-500gm\",\"qty\":134}]', 0, 156, 0.00, 0.00, 156, '0.00', 'percent', 'include', '15', 23.40, 132.60, 'percent', 437, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Dhanuka M45 Fungicide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Dhanuka</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Mancozeb 75% WP</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Green</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Dhanuka M45 Fungicide</h2>\r\n\r\n<ul>\r\n	<li><strong>Dhanuka M45 Fungicide</strong>&nbsp;is a broad-spectrum contact fungicide containing Mancozeb.</li>\r\n	<li>It is primarily used to control the growth of fungi and prevent the spread of diseases in various crops.</li>\r\n	<li>Offers long-term cost benefits due to its nutritional advantages and superior crop protection, leading to higher yields and better-quality crops.</li>\r\n</ul>\r\n\r\n<h2><strong>Dhanuka M45 Fungicide&nbsp;Technical Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:&nbsp;</strong>Mancozeb 75% WP</li>\r\n	<li><strong>Mode of Entry:</strong>&nbsp;Contact fungicide</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;It is broad-spectrum. fungicide with protective action. The product is fungitoxic when exposed to air. It is converted to an isothiocyanate, which inactivates the sulphahydral (SH) groups in enzymes of fungi. Sometimes the metals are exchanged between mancozeb and enzymes of fungi, thus causing disturbance in fungal enzyme functioning.</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Broad spectrum fungicide, which controls large number of diseases (with its multisite action), caused by phycomycetes, advance fungi and other group of fungi infecting many crops.</li>\r\n	<li>Used for foliar sprays, nursery drenching and seed treatments in many crops.</li>\r\n	<li><em>Dhanuka M45 Fungicide</em>&nbsp;can be used repeatedly, without any danger of resistance development, for number of years.</li>\r\n	<li>Best fungicide to be used along with systemic fungicides to prevent and/or delay resistance development.</li>\r\n	<li>In addition to disease control, it also provides manganese and zinc in traces to crop, there by keeps plants green and healthy.</li>\r\n	<li>It is quite safe to natural enemies and environment. Thus, part of Integrated Disease Management.</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>As compared to other fungicides, it is less expensive in the long run-on account of nutritional benefits and superior crop protection, which results in high yields and better quality.</li>\r\n</ul>\r\n\r\n<h2><strong>Dhanuka M45 Fungicide&nbsp;Usage &amp; Crops</strong></h2>\r\n\r\n<p><strong>Recommendations:</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Target Disease</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dosage Per/Acre</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Paddy</p>\r\n			</td>\r\n			<td>\r\n			<p>Blast</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Wheat</p>\r\n			</td>\r\n			<td>\r\n			<p>Brown and Black rust</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Potato</p>\r\n			</td>\r\n			<td>\r\n			<p>Early and Late Blight</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Tomato</p>\r\n			</td>\r\n			<td>\r\n			<p>Early blight, Leaf spot</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Groundnut</p>\r\n			</td>\r\n			<td>\r\n			<p>Tikka and rust</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Grapes</p>\r\n			</td>\r\n			<td>\r\n			<p>Downy mildew, Anthracnose</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Chilli</p>\r\n			</td>\r\n			<td>\r\n			<p>Fruit rot, Leaf spot</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Banana</p>\r\n			</td>\r\n			<td>\r\n			<p>Sigatoka leaf spot</p>\r\n			</td>\r\n			<td>\r\n			<p>600-800 gm</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Method of Application:&nbsp;</strong>Foliar Spray</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>Dhanuka M45 Fungicide can also be used for nursery drenching and seed treatments in many crops.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>Disclaimer</strong></h2>\r\n\r\n<p>This information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 11:52:09', '2026-05-20 13:02:07', 1, 1, 'Dhanuka M45 Fungicide (Mancozeb 75% WP) for Fungal Disease Control', 'Overview\r\nProduct Name	Dhanuka M45 Fungicide\r\nBrand	Dhanuka\r\nCategory	Fungicides\r\nTechnical Content	Mancozeb 75% WP\r\nClassification	Chemical\r\nToxicity	Green\r\nProduct Description\r\nAbout Dhanuka M45 Fungicide\r\nDhanuka M45 Fungicide is a broad-spectrum contact fungicide containing Mancozeb.\r\nIt is primarily used to control the growth of fungi and prevent the spread of diseases in various crops.\r\nOffers long-term cost benefits due to its nutritional advantages and superior crop protection, leading to higher yields and better-quality crops.\r\nDhanuka M45 Fungicide Technical Details\r\nTechnical Content: Mancozeb 75% WP\r\nMode of Entry: Contact fungicide\r\nMode of Action: It is broad-spectrum. fungicide with protective action. The product is fungitoxic when exposed to air. It is converted to an isothiocyanate, which inactivates the sulphahydral (SH) groups in enzymes of fungi. Sometimes the metals are exchanged between mancozeb and enzymes of fungi, thus causing disturbance in fungal enzyme functioning.\r\nKey Features & Benefits\r\nBroad spectrum fungicide, which controls large number of diseases (with its multisite action), caused by phycomycetes, advance fungi and other group of fungi infecting many crops.\r\nUsed for foliar sprays, nursery drenching and seed treatments in many crops.\r\nDhanuka M45 Fungicide can be used repeatedly, without any danger of resistance development, for number of years.\r\nBest fungicide to be used along with systemic fungicides to prevent and/or delay resistance development.\r\nIn addition to disease control, it also provides manganese and zinc in traces to crop, there by keeps plants green and healthy.\r\nIt is quite safe to natural enemies and environment. Thus, part of Integrated Disease Management.\r\nAs compared to other fungicides, it is less expensive in the long run-on account of nutritional benefits and superior crop protection, which results in high yields and better quality.\r\nDhanuka M45 Fungicide Usage & Crops\r\nRecommendations:\r\n\r\nCrops\r\n\r\nTarget Disease\r\n\r\nDosage Per/Acre\r\n\r\nPaddy\r\n\r\nBlast\r\n\r\n600-800 gm\r\n\r\nWheat\r\n\r\nBrown and Black rust\r\n\r\n600-800 gm\r\n\r\nPotato\r\n\r\nEarly and Late Blight\r\n\r\n600-800 gm\r\n\r\nTomato\r\n\r\nEarly blight, Leaf spot\r\n\r\n600-800 gm\r\n\r\nGroundnut\r\n\r\nTikka and rust\r\n\r\n600-800 gm\r\n\r\nGrapes\r\n\r\nDowny mildew, Anthracnose\r\n\r\n600-800 gm\r\n\r\nChilli\r\n\r\nFruit rot, Leaf spot\r\n\r\n600-800 gm\r\n\r\nBanana\r\n\r\nSigatoka leaf spot\r\n\r\n600-800 gm\r\n\r\n \r\n\r\nMethod of Application: Foliar Spray\r\n\r\n \r\n\r\nAdditional Information\r\nDhanuka M45 Fungicide can also be used for nursery drenching and seed treatments in many crops.\r\n \r\n\r\nDisclaimer\r\nThis information is provided for reference purposes only. Always follow to the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-18-6a0ab01197a0b.png', 1, NULL, 0.00, 0, NULL, NULL, '100978', 1),
(121, 'admin', 1, NULL, 'Tata Ergon Fungicide (Kresoxim-methyl 44.3% SC) - Broad Spectrum Systemic Fungic', 'tata-ergon-fungicide-kresoxim-methyl-443-sc-broad-spectrum-systemic-fungicide-El2kOq', 'Tata Ergon Fungicide', 'physical', '[{\"id\":\"20\",\"position\":1}]', 3, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-18-6a0ab139ee5a0.png\",\"2026-05-18-6a0ab139ee9bd.png\"]', '[]', '2026-05-18-6a0ab139eeb0f.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"100ml\",\"    500ml\",\"    1ltr\"]}]', '[{\"type\":\"100ml\",\"price\":875,\"sku\":\"TEF(4S-BSSF-100ml\",\"qty\":1556},{\"type\":\"500ml\",\"price\":3555,\"sku\":\"TEF(4S-BSSF-500ml\",\"qty\":1345},{\"type\":\"1ltr\",\"price\":6300,\"sku\":\"TEF(4S-BSSF-1ltr\",\"qty\":1678}]', 0, 875, 0.00, 0.00, 875, '0.00', 'percent', 'include', '35', 840.00, 35.00, 'flat', 4579, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Ergon Fungicide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Tata Rallis</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Kresoxim-methyl 44.3% SC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Green</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Ergon Fungicide</h2>\r\n\r\n<ul>\r\n	<li><strong>Ergon Fungicide</strong>&nbsp;is a cutting-edge fungicide that has gained prominence in modern agriculture for its efficacy in managing fungal diseases.</li>\r\n	<li><strong>Tata Ergon technical name - Kresoxim-methyl 44.3% SC</strong></li>\r\n	<li>It is a broad spectrum Strobilurin fungicide with a protective, curative and eradicative action.</li>\r\n	<li>It gives good residual activity and hence extended duration of control.</li>\r\n	<li><em>Ergon Fungicide</em>&nbsp;influences a variety of physiological processes thereby enhancing the quality and yield.</li>\r\n</ul>\r\n\r\n<h2><strong>Ergon Fungicide Technical Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:</strong>&nbsp;Kresoxim-methyl 44.3% SC</li>\r\n	<li><strong>Mode of Entry:</strong>&nbsp;Systemic and Contact</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;Ergon is a Quinone outside inhibitor, inhibits mitochondrial electron transfer between cytochrome b and Cytochrome C1 and involves interfering with the respiration process of fungal cells disrupting energy production. It acts by inhibiting spore germination, as a result, fungal growth is suppressed, and the spread of infections within the plant is halted.</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Ergon Fungicide&nbsp;is a one-shot solution for major classes of fungus.</li>\r\n	<li>It is very effective against powdery mildew for most of the crops and has a good greening effect.</li>\r\n	<li>It has excellent translaminar and vapor actions.</li>\r\n	<li>Rapidly translocated in entire plant parts.</li>\r\n	<li>It is known for its excellent rainfastness,</li>\r\n	<li>It has a good phytotonic effect.</li>\r\n	<li>Ergon versatility makes it valuable for integrated pest management in diverse crops.</li>\r\n</ul>\r\n\r\n<h2><strong>Ergon Fungicide Usage &amp; Crops</strong></h2>\r\n\r\n<p><strong>Recommendations:</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Target Disease</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dosage / ha (ml)</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dilution in water (L/ha)</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Paddy</p>\r\n			</td>\r\n			<td>\r\n			<p>Blast, Sheath blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Grapes</p>\r\n			</td>\r\n			<td>\r\n			<p>Powdery mildew, Downey mildew</p>\r\n			</td>\r\n			<td>\r\n			<p>600-700</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Chilli</p>\r\n			</td>\r\n			<td>\r\n			<p>Powdery mildew, Fruit rot, Die back, Twig blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Soybean</p>\r\n			</td>\r\n			<td>\r\n			<p>Rust</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Potato</p>\r\n			</td>\r\n			<td>\r\n			<p>Late blight, Early blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cotton</p>\r\n			</td>\r\n			<td>\r\n			<p>Leaf spot, Grey mildew</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Wheat</p>\r\n			</td>\r\n			<td>\r\n			<p>Rust, Leaf blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Maize</p>\r\n			</td>\r\n			<td>\r\n			<p>Turcicum leaf blight, rust</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Method of Application:</strong>&nbsp;Foliar Spray</p>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>The compatibility of Kresoxim-methyl with other fungicides allows for synergistic effects when combined in tank-mixtures.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 11:57:05', '2026-05-20 13:06:47', 1, 1, 'Tata Ergon Fungicide (Kresoxim-methyl 44.3% SC) - Broad Spectrum Systemic Fungicide', 'Overview\r\nProduct Name	Ergon Fungicide\r\nBrand	Tata Rallis\r\nCategory	Fungicides\r\nTechnical Content	Kresoxim-methyl 44.3% SC\r\nClassification	Chemical\r\nToxicity	Green\r\nProduct Description\r\nAbout Ergon Fungicide\r\nErgon Fungicide is a cutting-edge fungicide that has gained prominence in modern agriculture for its efficacy in managing fungal diseases.\r\nTata Ergon technical name - Kresoxim-methyl 44.3% SC\r\nIt is a broad spectrum Strobilurin fungicide with a protective, curative and eradicative action.\r\nIt gives good residual activity and hence extended duration of control.\r\nErgon Fungicide influences a variety of physiological processes thereby enhancing the quality and yield.\r\nErgon Fungicide Technical Details\r\nTechnical Content: Kresoxim-methyl 44.3% SC\r\nMode of Entry: Systemic and Contact\r\nMode of Action: Ergon is a Quinone outside inhibitor, inhibits mitochondrial electron transfer between cytochrome b and Cytochrome C1 and involves interfering with the respiration process of fungal cells disrupting energy production. It acts by inhibiting spore germination, as a result, fungal growth is suppressed, and the spread of infections within the plant is halted.\r\nKey Features & Benefits\r\nErgon Fungicide is a one-shot solution for major classes of fungus.\r\nIt is very effective against powdery mildew for most of the crops and has a good greening effect.\r\nIt has excellent translaminar and vapor actions.\r\nRapidly translocated in entire plant parts.\r\nIt is known for its excellent rainfastness,\r\nIt has a good phytotonic effect.\r\nErgon versatility makes it valuable for integrated pest management in diverse crops.\r\nErgon Fungicide Usage & Crops\r\nRecommendations:\r\n\r\nCrops\r\n\r\nTarget Disease\r\n\r\nDosage / ha (ml)\r\n\r\nDilution in water (L/ha)\r\n\r\nPaddy\r\n\r\nBlast, Sheath blight\r\n\r\n500\r\n\r\n500\r\n\r\nGrapes\r\n\r\nPowdery mildew, Downey mildew\r\n\r\n600-700\r\n\r\n500\r\n\r\nChilli\r\n\r\nPowdery mildew, Fruit rot, Die back, Twig blight\r\n\r\n500\r\n\r\n500\r\n\r\nSoybean\r\n\r\nRust\r\n\r\n500\r\n\r\n500\r\n\r\nPotato\r\n\r\nLate blight, Early blight\r\n\r\n500\r\n\r\n500\r\n\r\nCotton\r\n\r\nLeaf spot, Grey mildew\r\n\r\n500\r\n\r\n500\r\n\r\nWheat\r\n\r\nRust, Leaf blight\r\n\r\n500\r\n\r\n500\r\n\r\nMaize\r\n\r\nTurcicum leaf blight, rust\r\n\r\n500\r\n\r\n500\r\n\r\n\r\nMethod of Application: Foliar Spray\r\n\r\nAdditional Information\r\nThe compatibility of Kresoxim-methyl with other fungicides allows for synergistic effects when combined in tank-mixtures.\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-18-6a0ab139eec66.png', 1, NULL, 0.00, 0, NULL, NULL, '172007', 1);
INSERT INTO `products` (`id`, `added_by`, `user_id`, `pid`, `name`, `slug`, `tally_name`, `product_type`, `category_ids`, `brand_id`, `unit`, `min_qty`, `refundable`, `digital_product_type`, `digital_file_ready`, `images`, `color_image`, `thumbnail`, `featured`, `flash_deal`, `video_provider`, `video_url`, `colors`, `variant_product`, `attributes`, `choice_options`, `variation`, `published`, `unit_price`, `suggested_price`, `lowest_market_price`, `purchase_price`, `tax`, `tax_type`, `tax_model`, `discount`, `discount_amount`, `actual_amount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `free_shipping`, `attachment`, `created_at`, `updated_at`, `status`, `featured_status`, `meta_title`, `meta_description`, `meta_image`, `request_status`, `denied_note`, `shipping_cost`, `multiply_qty`, `temp_shipping_cost`, `is_shipping_cost_updated`, `code`, `indexing`) VALUES
(122, 'admin', 1, NULL, 'Dhanuka Godiwa Super Fungicide (Azoxystrobin 18.2% + Difenoconazole 11.4% SC)', 'dhanuka-godiwa-super-fungicide-azoxystrobin-182-difenoconazole-114-sc-wGYbH4', 'Dhanuka Godiwa Super Fungicide', 'physical', '[{\"id\":\"20\",\"position\":1}]', 3, 'ltrs', 1, 1, NULL, NULL, '[\"2026-05-18-6a0ab2f34def7.png\",\"2026-05-18-6a0ab2f34e4b3.png\",\"2026-05-18-6a0ab2f34e700.png\",\"2026-05-18-6a0ab2f34e8dc.png\"]', '[]', '2026-05-18-6a0ab2f34ead4.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"200ml\",\"  500ml\",\"  1ltr\"]}]', '[{\"type\":\"200ml\",\"price\":1051,\"sku\":\"DGSF(1+D1S-200ml\",\"qty\":125},{\"type\":\"500ml\",\"price\":2505,\"sku\":\"DGSF(1+D1S-500ml\",\"qty\":149},{\"type\":\"1ltr\",\"price\":4905,\"sku\":\"DGSF(1+D1S-1ltr\",\"qty\":1686}]', 0, 1051, 0.00, 0.00, 1051, '0.00', 'percent', 'include', '031', 325.81, 725.19, 'percent', 1960, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>GODIWA SUPER FUNGICIDE</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Dhanuka</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Azoxystrobin 18.2% + Difenoconazole 11.4% w/w SC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About GODIWA SUPER FUNGICIDE</h2>\r\n\r\n<ul>\r\n	<li><strong>Godiwa Super</strong>&nbsp;is a new generation, systemic broad-spectrum fungicide with protective and curative action.</li>\r\n	<li>It offers disease control and improves crop health, quality and yield.</li>\r\n</ul>\r\n\r\n<h2>Godiwa Super Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:</strong>&nbsp;Azoxystrobin 18.2% + Difenoconazole 11.4% SC</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;It&rsquo;s a dual systemic fungicide which inhibits spore germination at the early stage of fungal development. Thus, it protects the crop against invasion by fungal pathogens. It&rsquo;s taken up by the plants and acts on the fungal pathogen during penetration and haustoria formation. Thus, it stops the development of fungi by interfering with the biosynthesis of sterols in the cell membrane.</li>\r\n</ul>\r\n\r\n<h2>Key Features &amp; Benefits</h2>\r\n\r\n<ul>\r\n	<li><em>Godiwa Super</em>&nbsp;Dhanuka is a combination of two advanced chemistry and has multisite mode of action which is effective and provides longer duration control on diseases.</li>\r\n	<li>It&rsquo;s an excellent tool for resistance management.</li>\r\n	<li>Godiwa Super Fungicide has translaminar and acropetal movement help in quicker and even dispersion in plant system.</li>\r\n</ul>\r\n\r\n<h2>Godiwa Super Fungicide Usage &amp; Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommendations:</strong></li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Recommended Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Target Pest/ Disease</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dosage / Acre (ml)</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Paddy</p>\r\n			</td>\r\n			<td>\r\n			<p>Sheath blight, blast</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Tomato</p>\r\n			</td>\r\n			<td>\r\n			<p>Early blight, late blight</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Chilli</p>\r\n			</td>\r\n			<td>\r\n			<p>Anthracnose, powdery mildew</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Maize</p>\r\n			</td>\r\n			<td>\r\n			<p>Blight, downy mildew</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Wheat</p>\r\n			</td>\r\n			<td>\r\n			<p>Powdery mildew, rust</p>\r\n			</td>\r\n			<td>\r\n			<p>200</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<ul>\r\n	<li><strong>Method of Application:</strong>&nbsp;Foliar spray</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 12:04:27', '2026-05-20 15:58:44', 1, 1, 'Dhanuka Godiwa Super Fungicide (Azoxystrobin 18.2% + Difenoconazole 11.4% SC)', 'Overview\r\nProduct Name	GODIWA SUPER FUNGICIDE\r\nBrand	Dhanuka\r\nCategory	Fungicides\r\nTechnical Content	Azoxystrobin 18.2% + Difenoconazole 11.4% w/w SC\r\nClassification	Chemical\r\nToxicity	Blue\r\nProduct Description\r\nAbout GODIWA SUPER FUNGICIDE\r\nGodiwa Super is a new generation, systemic broad-spectrum fungicide with protective and curative action.\r\nIt offers disease control and improves crop health, quality and yield.\r\nGodiwa Super Technical Details\r\nTechnical Content: Azoxystrobin 18.2% + Difenoconazole 11.4% SC\r\nMode of Action: It’s a dual systemic fungicide which inhibits spore germination at the early stage of fungal development. Thus, it protects the crop against invasion by fungal pathogens. It’s taken up by the plants and acts on the fungal pathogen during penetration and haustoria formation. Thus, it stops the development of fungi by interfering with the biosynthesis of sterols in the cell membrane.\r\nKey Features & Benefits\r\nGodiwa Super Dhanuka is a combination of two advanced chemistry and has multisite mode of action which is effective and provides longer duration control on diseases.\r\nIt’s an excellent tool for resistance management.\r\nGodiwa Super Fungicide has translaminar and acropetal movement help in quicker and even dispersion in plant system.\r\nGodiwa Super Fungicide Usage & Crops\r\nRecommendations:\r\nRecommended Crops\r\n\r\nTarget Pest/ Disease\r\n\r\nDosage / Acre (ml)\r\n\r\nPaddy\r\n\r\nSheath blight, blast\r\n\r\n200\r\n\r\nTomato\r\n\r\nEarly blight, late blight\r\n\r\n200\r\n\r\nChilli\r\n\r\nAnthracnose, powdery mildew\r\n\r\n200\r\n\r\nMaize\r\n\r\nBlight, downy mildew\r\n\r\n200\r\n\r\nWheat\r\n\r\nPowdery mildew, rust\r\n\r\n200\r\n\r\nMethod of Application: Foliar spray\r\nDisclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.', '2026-05-18-6a0ab2f34ed06.png', 1, NULL, 0.00, 0, NULL, NULL, '137346', 1),
(123, 'admin', 1, NULL, 'Iris Hybrid Marigold Yellow Seeds – Vibrant Double-Petal Flowers', 'iris-hybrid-marigold-yellow-seeds-vibrant-double-petal-flowers-buTtuk', 'Iris Hybrid Marigold Yellow Seeds – Vibrant Double-Petal Flowers', 'physical', '[{\"id\":\"22\",\"position\":1}]', 9, 'pc', 1, 1, NULL, NULL, '[\"2026-05-18-6a0ab5f76f2ea.png\",\"2026-05-18-6a0ab5f76f8b9.png\",\"2026-05-18-6a0ab5f76fa62.png\"]', '[]', '2026-05-18-6a0ab5f76fc5f.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"15seeds\"]}]', '[{\"type\":\"15seeds\",\"price\":299,\"sku\":\"Iris Hybrid Marigold Yellow Seeds\",\"qty\":1232}]', 0, 299, 0.00, 0.00, 299, '0.00', 'percent', 'include', '51', 152.49, 146.51, 'percent', 1232, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Marigold Yellow Flower Seeds</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>RS ENTERPRISES</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Flower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Marigold Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2><strong>About Marigold Yellow</strong></h2>\r\n\r\n<p>Marigold Yellow Flower Seeds from RS Enterprises produce attractive marigold plants with bright yellow flowers. The flowers have a double set of petal rows, giving them a fuller and fluffier appearance.</p>\r\n\r\n<p>These marigold flower plants are taller than most other marigold varieties, so they look impressive when used as tall bedding in gardens and landscape areas. They also add variety to marigold bedding and help protect the garden from insects, as mentioned in the product information.</p>\r\n\r\n<p>Marigold Yellow Flower Seeds can be grown both outdoors and indoors. The plant is annual, and flowers are expected in about 8 to 10 weeks under suitable care.</p>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Bright yellow marigold flowers with a fluffy appearance</li>\r\n	<li>Double set of rows of petals</li>\r\n	<li>Taller than most other marigold varieties</li>\r\n	<li>Marigold flower yellow is Suitable for tall bedding in landscapes and gardens</li>\r\n	<li>Adds variety to marigold bedding</li>\r\n	<li>Helps protect the garden from insects, as mentioned in the product information</li>\r\n	<li>Can be grown outdoors and indoors</li>\r\n	<li>Annual flowering plant</li>\r\n	<li>Minimum germination of 70 percent</li>\r\n	<li>Flowers are ready in about 8 to 10 weeks</li>\r\n</ul>\r\n\r\n<h2><strong>Marigold yellow flower Characteristics</strong></h2>\r\n\r\n<table>\r\n	<thead>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Parameter</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Details</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Product Name</p>\r\n			</td>\r\n			<td>\r\n			<p>Marigold Yellow Seeds</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Plant Type</p>\r\n			</td>\r\n			<td>\r\n			<p>Annual</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Flower Colour</p>\r\n			</td>\r\n			<td>\r\n			<p>Bright yellow</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Flower Type</p>\r\n			</td>\r\n			<td>\r\n			<p>Double row of petals</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Flower Appearance</p>\r\n			</td>\r\n			<td>\r\n			<p>Fluffy and dramatic</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Plant Height</p>\r\n			</td>\r\n			<td>\r\n			<p>Taller than most other marigold varieties</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Growing Location</p>\r\n			</td>\r\n			<td>\r\n			<p>Outdoor and indoor</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Time Till Harvest</p>\r\n			</td>\r\n			<td>\r\n			<p>8 to 10 weeks</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Germination</p>\r\n			</td>\r\n			<td>\r\n			<p>70 percent minimum</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Number of Seeds</p>\r\n			</td>\r\n			<td>\r\n			<p>15</p>\r\n			</td>\r\n		</tr>\r\n	</thead>\r\n</table>\r\n\r\n<h2><strong>Recommended Season</strong></h2>\r\n\r\n<p><strong>Seasonal Information&nbsp;</strong>Annual</p>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;The details provided are for informational guidance only. Always follow the recommended instructions given on the product label and accompanying leaflet.</p>', 0, NULL, '2026-05-18 12:17:19', '2026-05-20 12:58:15', 1, 1, 'Iris Hybrid Marigold Yellow Seeds – Vibrant Double-Petal Flowers', 'Overview\r\nProduct Name	Marigold Yellow Flower Seeds\r\nBrand	RS ENTERPRISES\r\nCrop Type	Flower\r\nCrop Name	Marigold Seeds\r\nProduct Description\r\nMarigold bears flowers with a double set of rows of petals in bright yellow shades, making the flower wonderfully fluffy. These flowers are taller than most other marigold varieties and look far more dramatic and appealing as tall bedding in your landscape. These will add variety to your marigold bedding and protect your garden from insects as well.\r\n\r\nName:\r\nMarigold Orange\r\n\r\nNo. of seeds-\r\n15\r\n\r\nSeasonal Information:\r\nAnnual\r\n\r\nTime till harvest:\r\n8-10 weeks\r\n\r\nWhere to grow:\r\nOutdoor/Indoor\r\n\r\nWatering:\r\nTwice to thrice a week\r\n\r\nLight:\r\nFull Direct – Partial Sunlight\r\n\r\nGermination:\r\n70% minimum', '2026-05-18-6a0ab5f76fe25.png', 1, NULL, 0.00, 0, NULL, NULL, '118620', 1),
(124, 'admin', 1, NULL, 'GENTEX MARIGOLD FIREBALL SEEDS', 'gentex-marigold-fireball-seeds-vYUknh', 'GENTEX MARIGOLD FIREBALL SEEDS', 'physical', '[{\"id\":\"22\",\"position\":1}]', 6, 'pc', 1, 1, NULL, NULL, '[\"2026-05-18-6a0ab902f0ea1.png\"]', '[]', '2026-05-18-6a0ab902f152d.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"1000seeds\"]}]', '[{\"type\":\"1000seeds\",\"price\":3241,\"sku\":\"GMFS-1000seeds\",\"qty\":1223}]', 0, 3241, 0.00, 0.00, 3241, '0.00', 'percent', 'include', '0.00', 3241.00, 0.00, 'flat', 1223, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>GENTEX MARIGOLD FIREBALL SEEDS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>GENETEX AGRI INPUTS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Flower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Marigold Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<p><strong>About Seeds</strong></p>\r\n\r\n<ul>\r\n	<li>Marigold Fireball: Vibrant, compact marigold with bright orange blooms, ideal for garden beds, borders, and landscaping.</li>\r\n</ul>\r\n\r\n<p><strong>Seed Specifications</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Height : 12 - 16 Inches tall</li>\r\n	<li>Shape/size : 7 - 8 cm round</li>\r\n	<li>Crop/Veg/Fruit - Colour : Bright orange with golden yellow hues.</li>\r\n	<li>Weight (resulting fruit/nut/veg/flower&hellip;etc): 20 - 50 gram per unit</li>\r\n	<li>Maturity (How many days?): 60 - 70 days</li>\r\n	<li>Dosage(seeds required for an acre) : 100 - 150 gram</li>\r\n	<li>Germination : 85-90%</li>\r\n	<li>Category (flower/vegetable/Nut/Fruit&hellip;&hellip;etc): Flower</li>\r\n	<li>Suitable Region/season: Summer.</li>\r\n</ul>', 0, NULL, '2026-05-18 12:30:18', '2026-05-20 13:38:16', 1, 1, 'GENTEX MARIGOLD FIREBALL SEEDS', 'Overview\r\nProduct Name	GENTEX MARIGOLD FIREBALL SEEDS\r\nBrand	GENETEX AGRI INPUTS\r\nCrop Type	Flower\r\nCrop Name	Marigold Seeds\r\nProduct Description\r\nAbout Seeds\r\n\r\nMarigold Fireball: Vibrant, compact marigold with bright orange blooms, ideal for garden beds, borders, and landscaping.\r\nSeed Specifications\r\n\r\nPlant Height : 12 - 16 Inches tall\r\nShape/size : 7 - 8 cm round\r\nCrop/Veg/Fruit - Colour : Bright orange with golden yellow hues.\r\nWeight (resulting fruit/nut/veg/flower…etc): 20 - 50 gram per unit\r\nMaturity (How many days?): 60 - 70 days\r\nDosage(seeds required for an acre) : 100 - 150 gram\r\nGermination : 85-90%\r\nCategory (flower/vegetable/Nut/Fruit……etc): Flower\r\nSuitable Region/season: Summer.', '2026-05-18-6a0ab902f17a8.png', 1, NULL, 0.00, 0, NULL, NULL, '144220', 1),
(125, 'admin', 1, NULL, 'IRIS IMPORTED OP ROCKET LEAVES WILD', 'iris-imported-op-rocket-leaves-wild-vAnRLY', 'IRIS IMPORTED OP ROCKET LEAVES WILD', 'physical', '[{\"id\":\"22\",\"position\":1}]', 9, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0abc1ad98d3.png\"]', '[]', '2026-05-18-6a0abc1ad9e2f.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"10gms\"]}]', '[{\"type\":\"10gms\",\"price\":700,\"sku\":\"IIORLW-10gms\",\"qty\":198}]', 0, 700, 0.00, 0.00, 700, '0.00', 'percent', 'include', '56', 392.00, 308.00, 'percent', 198, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>IRIS IMPORTED OP ROCKET LEAVES WILD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>RS ENTERPRISES</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Flower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Arugula Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<p><strong>About Seeds</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Character : Leaves are edible in nature</li>\r\n	<li>Leaf Character : Thin lance shaped Leaves</li>\r\n	<li>Number of Cuttings : Regular pruning when the plant matures. As per requirement.</li>\r\n	<li>Flavour : Delicate Strong peppery flavour</li>\r\n	<li>Colour : Bright green</li>\r\n</ul>', 0, NULL, '2026-05-18 12:43:30', '2026-05-20 15:58:41', 1, 1, 'IRIS IMPORTED OP ROCKET LEAVES WILD', 'Overview\r\nProduct Name	IRIS IMPORTED OP ROCKET LEAVES WILD\r\nBrand	RS ENTERPRISES\r\nCrop Type	Flower\r\nCrop Name	Arugula Seeds\r\nProduct Description\r\nAbout Seeds\r\n\r\nPlant Character : Leaves are edible in nature\r\nLeaf Character : Thin lance shaped Leaves\r\nNumber of Cuttings : Regular pruning when the plant matures. As per requirement.\r\nFlavour : Delicate Strong peppery flavour\r\nColour : Bright green', '2026-05-18-6a0abc1ad9f96.png', 1, NULL, 0.00, 0, NULL, NULL, '119246', 1),
(126, 'admin', 1, NULL, 'IAHS CELOSIA CRISTATA', 'iahs-celosia-cristata-sCNeHY', 'IAHS CELOSIA CRISTATA', 'physical', '[{\"id\":\"22\",\"position\":1}]', 9, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0abdb76f095.png\"]', '[]', '2026-05-18-6a0abdb76f587.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"4\"]', '[{\"name\":\"choice_4\",\"title\":\"Weight\",\"options\":[\"25seeds\"]}]', '[{\"type\":\"25seeds\",\"price\":55,\"sku\":\"ICC-25seeds\",\"qty\":1453}]', 0, 55, 0.00, 0.00, 55, '0.00', 'percent', 'include', '027', 14.85, 40.15, 'percent', 1453, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>IAHS CELOSIA CRISTATA</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Indo American Hybrid Seeds (India) Pvt. Ltd</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Flower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Celosia Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<p><strong>About Seeds</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Exposure: Sun</li>\r\n	<li>Duration (Sowing to finish): 9-12 weeks</li>\r\n	<li>These heat loving and moderately drought tolerant plants thrive in sunny locations with rich, well drained soil.</li>\r\n	<li>Gorgeous dwarf plants produce large heads around 8&rdquo; in size.</li>\r\n	<li>Excellent for bedding, containers and borders.</li>\r\n</ul>', 0, NULL, '2026-05-18 12:50:23', '2026-05-20 12:55:32', 1, 1, 'IAHS CELOSIA CRISTATA', 'Overview\r\nProduct Name	IAHS CELOSIA CRISTATA\r\nBrand	Indo American Hybrid Seeds (India) Pvt. Ltd\r\nCrop Type	Flower\r\nCrop Name	Celosia Seeds\r\nProduct Description\r\nAbout Seeds\r\nExposure: Sun\r\nDuration (Sowing to finish): 9-12 weeks\r\nThese heat loving and moderately drought tolerant plants thrive in sunny locations with rich, well drained soil.\r\nGorgeous dwarf plants produce large heads around 8” in size.\r\nExcellent for bedding, containers and borders.', '2026-05-18-6a0abdb76f7d4.png', 1, NULL, 0.00, 0, NULL, NULL, '127276', 1),
(127, 'admin', 1, NULL, 'VOKKAL - KEERTHI - Marigold', 'vokkal-keerthi-marigold-rUb8DU', 'VOKKAL - KEERTHI - Marigold', 'physical', '[{\"id\":\"22\",\"position\":1}]', 4, 'gms', 1, 1, NULL, NULL, '[\"2026-05-18-6a0ac17ea54ef.png\"]', '[]', '2026-05-18-6a0ac17ea617d.png', NULL, NULL, 'youtube', NULL, '[]', 0, '[\"3\"]', '[{\"name\":\"choice_3\",\"title\":\"gms\",\"options\":[\"1000seeds\",\"  5000seeds\",\"  10000seeds\"]}]', '[{\"type\":\"1000seeds\",\"price\":1980,\"sku\":\"V-K-M-1000seeds\",\"qty\":1645},{\"type\":\"5000seeds\",\"price\":1980,\"sku\":\"V-K-M-5000seeds\",\"qty\":1546},{\"type\":\"10000seeds\",\"price\":1980,\"sku\":\"V-K-M-10000seeds\",\"qty\":1798}]', 0, 1980, 0.00, 0.00, 1980, '0.00', 'percent', 'include', '045', 891.00, 1089.00, 'percent', 4989, 1, '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>VOKKAL - KEERTHI - Marigold</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>VOKKAL SEEDS PVT LTD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Flower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Marigold Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<ul>\r\n	<li>Flowers are deep orange in color and compact, flower weighs about 16-20gm.</li>\r\n</ul>\r\n\r\n<h2>Specifications</h2>\r\n\r\n<ul>\r\n	<li>Bushy dwarf plant which is 80-100cm long, first harvest 45-50 days after transplanting,</li>\r\n	<li>recommended spacing is 60cm*45cm</li>\r\n</ul>\r\n\r\n<h2>Features</h2>\r\n\r\n<ul>\r\n	<li>High yieding Flowers are firm with long shelf life</li>\r\n	<li>suitable for long distance transportation</li>\r\n</ul>\r\n\r\n<h2>Seed Rate</h2>\r\n\r\n<ul>\r\n	<li>7000 seeds/ acre</li>\r\n</ul>\r\n\r\n<h2>Additional Information</h2>\r\n\r\n<ul>\r\n	<li>Crop Suitability - Suitable for Rainy season</li>\r\n</ul>', 0, NULL, '2026-05-18 13:06:30', '2026-05-20 12:54:29', 1, 1, 'VOKKAL - KEERTHI - Marigold', 'Overview\r\nProduct Name	VOKKAL - KEERTHI - Marigold\r\nBrand	VOKKAL SEEDS PVT LTD\r\nCrop Type	Flower\r\nCrop Name	Marigold Seeds\r\nProduct Description\r\nFlowers are deep orange in color and compact, flower weighs about 16-20gm.\r\nSpecifications\r\nBushy dwarf plant which is 80-100cm long, first harvest 45-50 days after transplanting,\r\nrecommended spacing is 60cm*45cm\r\nFeatures\r\nHigh yieding Flowers are firm with long shelf life\r\nsuitable for long distance transportation\r\nSeed Rate\r\n7000 seeds/ acre\r\nAdditional Information\r\nCrop Suitability - Suitable for Rainy season\r\nAdd to Cart', '2026-05-18-6a0ac17ea63f3.png', 1, NULL, 0.00, 0, NULL, NULL, '123087', 1),
(128, NULL, NULL, NULL, NULL, NULL, NULL, 'physical', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0.00, 0.00, 0, '0.00', NULL, 'exclude', '0.00', 0.00, 0.00, NULL, NULL, 1, NULL, 0, NULL, '2026-05-20 14:07:44', '2026-05-20 14:07:44', 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, NULL, NULL, NULL, NULL, NULL, NULL, 'physical', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0.00, 0.00, 0, '0.00', NULL, 'exclude', '0.00', 0.00, 0.00, NULL, NULL, 1, NULL, 0, NULL, '2026-05-20 14:07:52', '2026-05-20 14:07:52', 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, NULL, NULL, NULL, NULL, NULL, NULL, 'physical', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0.00, 0.00, 0, '0.00', NULL, 'exclude', '0.00', 0.00, 0.00, NULL, NULL, 1, NULL, 0, NULL, '2026-05-20 15:39:46', '2026-05-20 15:39:46', 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_queries`
--

CREATE TABLE `product_queries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `chanal_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `mobile` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `address` longtext NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=>Active 2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_querys`
--

CREATE TABLE `product_querys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `mobile` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `address` longtext NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=>Active 2=>Deactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`id`, `product_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 6, 4, NULL, NULL),
(5, 6, 5, NULL, NULL),
(6, 7, 6, NULL, NULL),
(7, 8, 7, NULL, NULL),
(8, 8, 8, NULL, NULL),
(9, 11, 9, NULL, NULL),
(10, 11, 10, NULL, NULL),
(11, 11, 11, NULL, NULL),
(12, 10, 12, NULL, NULL),
(14, 11, 13, NULL, NULL),
(15, 22, 14, NULL, NULL),
(16, 22, 15, NULL, NULL),
(17, 22, 16, NULL, NULL),
(18, 44, 17, NULL, NULL),
(19, 44, 18, NULL, NULL),
(20, 44, 19, NULL, NULL),
(21, 45, 20, NULL, NULL),
(22, 46, 21, NULL, NULL),
(23, 46, 22, NULL, NULL),
(24, 46, 23, NULL, NULL),
(25, 47, 24, NULL, NULL),
(26, 47, 25, NULL, NULL),
(27, 47, 13, NULL, NULL),
(28, 50, 26, NULL, NULL),
(32, 52, 27, NULL, NULL),
(33, 53, 28, NULL, NULL),
(34, 57, 29, NULL, NULL),
(35, 51, 30, NULL, NULL),
(36, 51, 31, NULL, NULL),
(37, 51, 32, NULL, NULL),
(38, 63, 33, NULL, NULL),
(39, 63, 34, NULL, NULL),
(40, 63, 35, NULL, NULL),
(41, 63, 36, NULL, NULL),
(42, 67, 37, NULL, NULL),
(43, 67, 38, NULL, NULL),
(44, 67, 39, NULL, NULL),
(45, 72, 40, NULL, NULL),
(46, 74, 41, NULL, NULL),
(47, 76, 42, NULL, NULL),
(48, 98, 43, NULL, NULL),
(49, 99, 43, NULL, NULL),
(50, 100, 44, NULL, NULL),
(51, 101, 45, NULL, NULL),
(52, 101, 46, NULL, NULL),
(53, 101, 47, NULL, NULL),
(54, 102, 48, NULL, NULL),
(55, 103, 49, NULL, NULL),
(56, 104, 29, NULL, NULL),
(57, 105, 50, NULL, NULL),
(58, 106, 51, NULL, NULL),
(59, 107, 52, NULL, NULL),
(60, 108, 53, NULL, NULL),
(61, 109, 54, NULL, NULL),
(62, 110, 55, NULL, NULL),
(63, 111, 56, NULL, NULL),
(64, 113, 57, NULL, NULL),
(65, 114, 58, NULL, NULL),
(66, 115, 59, NULL, NULL),
(67, 115, 60, NULL, NULL),
(68, 115, 61, NULL, NULL),
(69, 116, 62, NULL, NULL),
(70, 116, 63, NULL, NULL),
(71, 116, 64, NULL, NULL),
(72, 116, 65, NULL, NULL),
(73, 117, 66, NULL, NULL),
(74, 118, 67, NULL, NULL),
(75, 119, 68, NULL, NULL),
(76, 120, 69, NULL, NULL),
(77, 121, 70, NULL, NULL),
(78, 122, 71, NULL, NULL),
(79, 123, 72, NULL, NULL),
(80, 124, 73, NULL, NULL),
(81, 125, 74, NULL, NULL),
(82, 126, 75, NULL, NULL),
(83, 127, 76, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed_products`
--

CREATE TABLE `recently_viewed_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recently_viewed_products`
--

INSERT INTO `recently_viewed_products` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(6, 12, 122, '2026-05-20 15:57:27', '2026-05-20 15:57:27'),
(7, 12, 104, '2026-05-20 16:40:25', '2026-05-20 16:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

CREATE TABLE `refund_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_details_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `refund_reason` longtext NOT NULL,
  `images` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_note` longtext DEFAULT NULL,
  `rejected_note` longtext DEFAULT NULL,
  `payment_info` longtext DEFAULT NULL,
  `change_by` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_statuses`
--

CREATE TABLE `refund_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `refund_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `change_by` varchar(191) DEFAULT NULL,
  `change_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_transactions`
--

CREATE TABLE `refund_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_for` varchar(191) DEFAULT NULL,
  `payer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_by` varchar(191) DEFAULT NULL,
  `paid_to` varchar(191) DEFAULT NULL,
  `payment_method` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `transaction_type` varchar(191) DEFAULT NULL,
  `order_details_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `refund_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `delivery_man_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_saved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_package` int(11) DEFAULT NULL,
  `product_delivery` int(11) DEFAULT NULL,
  `product_quality` int(11) DEFAULT NULL,
  `condition_images` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `customer_id`, `delivery_man_id`, `order_id`, `comment`, `attachment`, `rating`, `status`, `is_saved`, `created_at`, `updated_at`, `product_package`, `product_delivery`, `product_quality`, `condition_images`) VALUES
(5, 104, 12, NULL, 100004, 'good', '[\"2026-03-21-69be55fcdeeb8.png\",\"2026-03-21-69be55fce0257.png\",\"2026-03-21-69be55fce046f.png\",\"2026-03-21-69be55fce066b.png\"]', 5, 1, 0, '2026-03-21 08:25:32', '2026-03-21 08:25:32', 3, NULL, 1, NULL),
(6, 115, 12, NULL, 100004, 'good', '[\"2026-03-21-69be55fcdeeb8.png\",\"2026-03-21-69be55fce0257.png\",\"2026-03-21-69be55fce046f.png\",\"2026-03-21-69be55fce066b.png\"]', 5, 1, 0, '2026-03-21 08:25:32', '2026-03-21 08:25:32', 3, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_managers`
--

CREATE TABLE `sale_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_managers`
--

INSERT INTO `sale_managers` (`id`, `name`, `mobile`, `email`, `password`, `status`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'test', '6544984967', 'true@gmail.com', '$2y$10$Ag8gDGDhq7mB4pQxwXIib.S0gySJOEKe6BiIFNfquO0uiuMurOqre', 1, '2025-11-25-69254e84b962a.png', '2025-11-25 01:06:52', '2025-11-25 01:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `search_functions`
--

CREATE TABLE `search_functions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(150) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `visible_for` varchar(191) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_functions`
--

INSERT INTO `search_functions` (`id`, `key`, `url`, `visible_for`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'admin/dashboard', 'admin', NULL, NULL),
(2, 'Order All', 'admin/orders/list/all', 'admin', NULL, NULL),
(3, 'Order Pending', 'admin/orders/list/pending', 'admin', NULL, NULL),
(4, 'Order Processed', 'admin/orders/list/processed', 'admin', NULL, NULL),
(5, 'Order Delivered', 'admin/orders/list/delivered', 'admin', NULL, NULL),
(6, 'Order Returned', 'admin/orders/list/returned', 'admin', NULL, NULL),
(7, 'Order Failed', 'admin/orders/list/failed', 'admin', NULL, NULL),
(8, 'Brand Add', 'admin/brand/add-new', 'admin', NULL, NULL),
(9, 'Brand List', 'admin/brand/list', 'admin', NULL, NULL),
(10, 'Banner', 'admin/banner/list', 'admin', NULL, NULL),
(11, 'Category', 'admin/category/view', 'admin', NULL, NULL),
(12, 'Sub Category', 'admin/category/sub-category/view', 'admin', NULL, NULL),
(13, 'Sub sub category', 'admin/category/sub-sub-category/view', 'admin', NULL, NULL),
(14, 'Attribute', 'admin/attribute/view', 'admin', NULL, NULL),
(15, 'Product', 'admin/product/list', 'admin', NULL, NULL),
(16, 'Coupon', 'admin/coupon/add-new', 'admin', NULL, NULL),
(17, 'Custom Role', 'admin/custom-role/create', 'admin', NULL, NULL),
(18, 'Employee', 'admin/employee/add-new', 'admin', NULL, NULL),
(19, 'Seller', 'admin/sellers/seller-list', 'admin', NULL, NULL),
(20, 'Contacts', 'admin/contact/list', 'admin', NULL, NULL),
(21, 'Flash Deal', 'admin/deal/flash', 'admin', NULL, NULL),
(22, 'Deal of the day', 'admin/deal/day', 'admin', NULL, NULL),
(23, 'Language', 'admin/business-settings/language', 'admin', NULL, NULL),
(24, 'Mail', 'admin/business-settings/mail', 'admin', NULL, NULL),
(25, 'Shipping method', 'admin/business-settings/shipping-method/add', 'admin', NULL, NULL),
(26, 'Currency', 'admin/currency/view', 'admin', NULL, NULL),
(27, 'Payment method', 'admin/business-settings/payment-method', 'admin', NULL, NULL),
(28, 'SMS Gateway', 'admin/business-settings/sms-gateway', 'admin', NULL, NULL),
(29, 'Support Ticket', 'admin/support-ticket/view', 'admin', NULL, NULL),
(30, 'FAQ', 'admin/helpTopic/list', 'admin', NULL, NULL),
(31, 'About Us', 'admin/business-settings/about-us', 'admin', NULL, NULL),
(32, 'Terms and Conditions', 'admin/business-settings/terms-condition', 'admin', NULL, NULL),
(33, 'Web Config', 'admin/business-settings/web-config', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(30) DEFAULT NULL,
  `l_name` varchar(30) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `image` varchar(30) NOT NULL DEFAULT 'def.png',
  `email` varchar(80) NOT NULL,
  `password` varchar(80) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `seller_rank` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rank_score` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tally_sync` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `branch` varchar(191) DEFAULT NULL,
  `account_no` varchar(191) DEFAULT NULL,
  `holder_name` varchar(191) DEFAULT NULL,
  `auth_token` text DEFAULT NULL,
  `sales_commission_percentage` double(8,2) DEFAULT NULL,
  `gst` varchar(191) DEFAULT NULL,
  `cm_firebase_token` varchar(191) DEFAULT NULL,
  `pos_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `f_name`, `l_name`, `phone`, `image`, `email`, `password`, `status`, `seller_rank`, `rank_score`, `tally_sync`, `remember_token`, `created_at`, `updated_at`, `bank_name`, `branch`, `account_no`, `holder_name`, `auth_token`, `sales_commission_percentage`, `gst`, `cm_firebase_token`, `pos_status`) VALUES
(1, 'test1', 'test', '6544984967', '2026-01-20-696f1eab7271f.png', 'test@gmail.com', '$2y$12$8dSLdz2cX.aOp4wWjtz1MOjkpgeTeh8QD6Qa4wghm66Kw360LtCKu', 'approved', 2, 0.00, 0, 'a19PGYxIO8l6pTABH5ZBMUEjzMxPup4Z8Pk2w8xW7v2Z0WjA9uePfNSnriJi', '2025-11-25 00:56:04', '2026-03-23 11:11:45', 'SBI', 'hmt', '9678540768547', 'deepak', 'TpJfpX4YeXeLHTLRnJs74OCi1DvlcL9SFuKnYYVGJYskjpPsgzBjmkTv8TxnwEoRSOc7CW7Iqi7J6hmE', NULL, NULL, NULL, 0),
(2, 'Deepak', 'Nogia', '6544984967', '2026-01-19-696e0ff4134c5.png', 'vaibhavprop@gmail.com', '$2y$12$8dSLdz2cX.aOp4wWjtz1MOjkpgeTeh8QD6Qa4wghm66Kw360LtCKu', 'approved', 3, 0.00, 0, 'mOqGWO02huZ5Fetmzt46O6stvxOIo1Xaf0gXG79uaksbSmu92cxs2j9tImzk', '2025-11-26 23:46:50', '2026-03-23 11:11:45', NULL, NULL, NULL, NULL, 'TEqq13yVWYqXmXT5mUR5ZnxkGoOgleTMjWPTaUwdlwCeARqagGnDs72Kw6K0QSB6ENbIS5sh6fdTAWE7', NULL, NULL, NULL, 0),
(3, 'test1234', 'test', '6544984967', '2025-12-10-693925097d5ed.png', 'vaibhavprop123@gmail.com', '$2y$12$8dSLdz2cX.aOp4wWjtz1MOjkpgeTeh8QD6Qa4wghm66Kw360LtCKu', 'approved', 1, 15.00, 0, '13HfWSXd7atvhdTYf68nkfq8L1dBlz7HpKF5KTw876ZCX51Qv1oo08n1EPg5', '2025-12-10 02:15:14', '2026-03-23 11:11:45', 'SBI', 'hmt', '14785236901', 'deepak', NULL, NULL, NULL, NULL, 0),
(4, 'Deepak', 'Nogia', '6544984968', '2026-02-10-698afd8a81e93.png', 'deepaknogia@gmail.com', '$2y$12$8dSLdz2cX.aOp4wWjtz1MOjkpgeTeh8QD6Qa4wghm66Kw360LtCKu', 'approved', 4, 0.00, 0, 'lROE10WuAvmwLrpsmFvVpCvlPcDyzTFEqLsUFSMgpp7NEQ9VcLeABUInqx0M', '2026-02-10 04:12:34', '2026-03-27 08:08:59', NULL, NULL, NULL, NULL, 'O5HX5u7y2FjSCUe1UjDZ1GnLemxh7fi8NNykAnrjYKmDr8UAEdtrThGjtf6BQzhv72liEF6Vr0BHGtZs', NULL, NULL, 'eAddhKI6gH03uH1Co1rUMy:APA91bE2V-WWjmwoohlCKRBFZ1uQXZieM5acQOxXPzX3V-R91PPh3RfwqX9QIzOO4PzeFa_YqRtLLhSLWgkSQmk5fuDJfxgLBm4sbg5pei7UkAEoqnwR87s', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller_broadcasts`
--

CREATE TABLE `seller_broadcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'offer',
  `image` varchar(191) DEFAULT NULL,
  `total_sent` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_notifications`
--

CREATE TABLE `seller_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `broadcast_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'offer',
  `image` varchar(191) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_wallets`
--

CREATE TABLE `seller_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `total_earning` double NOT NULL DEFAULT 0,
  `withdrawn` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission_given` double(8,2) NOT NULL DEFAULT 0.00,
  `pending_withdraw` double(8,2) NOT NULL DEFAULT 0.00,
  `delivery_charge_earned` double(8,2) NOT NULL DEFAULT 0.00,
  `collected_cash` double(8,2) NOT NULL DEFAULT 0.00,
  `total_tax_collected` double(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_wallets`
--

INSERT INTO `seller_wallets` (`id`, `seller_id`, `total_earning`, `withdrawn`, `created_at`, `updated_at`, `commission_given`, `pending_withdraw`, `delivery_charge_earned`, `collected_cash`, `total_tax_collected`) VALUES
(1, 1, 0, 11100, '2025-11-25 00:56:04', '2026-03-23 10:20:40', 0.00, 0.00, 0.00, 0.00, 1125.00),
(2, 2, 0, 0, '2025-11-26 23:46:50', '2025-11-26 23:46:50', 0.00, 0.00, 0.00, 0.00, 0.00),
(3, 3, 0, 0, '2025-12-10 02:15:14', '2025-12-10 02:15:14', 0.00, 0.00, 0.00, 0.00, 0.00),
(4, 4, 0, 0, '2026-02-10 04:12:35', '2026-02-10 04:12:35', 0.00, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `seller_wallet_histories`
--

CREATE TABLE `seller_wallet_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `order_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `payment` varchar(191) NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(15) DEFAULT NULL,
  `contact_person_name` varchar(50) DEFAULT NULL,
  `address_type` varchar(20) NOT NULL DEFAULT 'home',
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `is_billing` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `customer_id`, `contact_person_name`, `address_type`, `address`, `city`, `zip`, `phone`, `created_at`, `updated_at`, `state`, `country`, `latitude`, `longitude`, `is_billing`) VALUES
(1, '4', 'test', 'home', 'ajmer', 'Ajmer', '305003', '6544984967', '2025-12-12 07:41:55', '2025-12-12 07:41:55', NULL, 'India', 'cdc', 'cd', 0),
(2, '4', 'test', 'home', 'erwf', 'Ajmer', '305003', '6544984967', '2025-12-08 04:11:43', '2025-12-08 04:11:43', NULL, 'Afghanistan', 'cdc', 'cd', 0),
(3, '5', 'test', 'home', 'vbncvb', 'Ajmer', '305003', '6544984967', '2026-01-21 00:57:25', '2026-01-21 00:57:25', NULL, 'India', 'cdc', 'cd', 0),
(4, '12', 'Deepak Nogia', 'home', 'home', 'Ajmer', '305003', '7688927161', '2026-03-27 05:23:52', '2026-03-27 05:23:52', NULL, 'India', 'cdc', 'cd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` bigint(20) DEFAULT NULL,
  `creator_type` varchar(191) NOT NULL DEFAULT 'admin',
  `title` varchar(100) DEFAULT NULL,
  `cost` decimal(8,2) NOT NULL DEFAULT 0.00,
  `duration` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `creator_id`, `creator_type`, `title`, `cost`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'admin', 'Company Vehicle', 5.00, '2 Week', 1, '2021-05-25 20:57:04', '2021-05-25 20:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_types`
--

CREATE TABLE `shipping_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_type` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_types`
--

INSERT INTO `shipping_types` (`id`, `seller_id`, `shipping_type`, `created_at`, `updated_at`) VALUES
(1, 3, 'category_wise', '2026-03-20 00:14:35', '2026-03-20 00:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `image` varchar(30) NOT NULL DEFAULT 'def.png',
  `vacation_start_date` date DEFAULT NULL,
  `vacation_end_date` date DEFAULT NULL,
  `vacation_note` varchar(255) DEFAULT NULL,
  `vacation_status` tinyint(4) NOT NULL DEFAULT 0,
  `temporary_close` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banner` varchar(191) NOT NULL,
  `whatsapp_no` varchar(255) NOT NULL,
  `gst_no` varchar(255) NOT NULL,
  `gst_doc` varchar(255) NOT NULL,
  `pen_no` varchar(255) NOT NULL,
  `pen_doc` varchar(255) NOT NULL,
  `business_address` longtext NOT NULL,
  `wherehouse` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `seller_id`, `name`, `address`, `contact`, `image`, `vacation_start_date`, `vacation_end_date`, `vacation_note`, `vacation_status`, `temporary_close`, `status`, `created_at`, `updated_at`, `banner`, `whatsapp_no`, `gst_no`, `gst_doc`, `pen_no`, `pen_doc`, `business_address`, `wherehouse`) VALUES
(1, 1, 'test', 'home', '6544984967', '2026-01-20-696f1f11d4e8d.png', '2025-10-28', '2025-11-04', 'test', 1, 0, 'Pending', '2025-11-25 00:56:04', '2026-03-16 06:43:54', '2026-01-20-696f1f53b8486.png', '7688927161', '54565269', '1773663234_gst.pdf', '213zk22344', '1773663234_pan.pdf', '{\"address_line1\":\"1\\/244, huose\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}', '{\"address_line1\":\"we\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}'),
(2, 2, 'test', 'home', '6544984967', '2026-01-19-696e1950c240e.png', NULL, NULL, NULL, 0, 0, 'Pending', '2025-11-26 23:46:50', '2026-03-17 00:45:33', '2026-01-20-696f28a6ea513.png', '7688927161', '54565269', '1773664728_gst.pdf', '213zk22344', '1773664728_pan.pdf', '{\"address_line1\":\"1\\/244, huose\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}', '{\"address_line1\":\"we\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}'),
(3, 3, 'Devender bhai', 'home', '7896541230', '2026-01-20-696f297abf8e1.png', NULL, NULL, NULL, 0, 0, 'approved', '2025-12-10 02:15:14', '2026-03-18 07:39:04', '2026-01-20-696f297abfdbd.png', '7877011230', '54565269', '1773723802_gst.pdf', '213zk22344', '1773723803_pan.pdf', '{\"address_line1\":\"1\\/244, huose\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}', '{\"address_line1\":\"1\\/244, huose\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}'),
(4, 4, 'Deepak', 'ajmer', '6544984968', '2026-02-10-698afd8b00282.png', NULL, NULL, NULL, 0, 0, 'approved', '2026-02-10 04:12:35', '2026-03-18 07:20:52', '2026-02-10-698afd8b005c3.png', '7688927161', '54565269', '1770729268_gst.pdf', 'sfsdfrdf', '1770728842_pan.pdf', '{\"address_line1\":\"1\\/244, huose\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}', '{\"address_line1\":\"we\",\"city\":\"Ajmer\",\"state\":\"Rajasthan\",\"pincode\":\"305003\",\"country\":\"India\"}');

-- --------------------------------------------------------

--
-- Table structure for table `social_medias`
--

CREATE TABLE `social_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `active_status` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_medias`
--

INSERT INTO `social_medias` (`id`, `name`, `link`, `icon`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'twitter', 'https://www.w3schools.com/howto/howto_css_table_responsive.asp', 'fa fa-twitter', 1, 1, '2020-12-31 21:18:03', '2020-12-31 21:18:25'),
(2, 'linkedin', 'https://dev.6amtech.com/', 'fa fa-linkedin', 1, 1, '2021-02-27 16:23:01', '2021-02-27 16:23:05'),
(3, 'google-plus', 'https://dev.6amtech.com/', 'fa fa-google-plus-square', 1, 1, '2021-02-27 16:23:30', '2021-02-27 16:23:33'),
(4, 'pinterest', 'https://dev.6amtech.com/', 'fa fa-pinterest', 1, 1, '2021-02-27 16:24:14', '2021-02-27 16:24:26'),
(5, 'instagram', 'https://dev.6amtech.com/', 'fa fa-instagram', 1, 1, '2021-02-27 16:24:36', '2021-02-27 16:24:41'),
(6, 'facebook', 'facebook.com', 'fa fa-facebook', 1, 1, '2021-02-27 19:19:42', '2021-06-11 17:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `soft_credentials`
--

CREATE TABLE `soft_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'deepaknogia2000@gmail.com', '2026-02-09 23:54:58', '2026-02-09 23:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `priority` varchar(15) NOT NULL DEFAULT 'low',
  `description` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `customer_id`, `subject`, `type`, `priority`, `description`, `reply`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'test', 'Complaint', 'Urgent', 'test', NULL, 'close', '2025-11-26 07:17:49', '2026-03-27 06:47:31'),
(2, 4, 'test', 'Partner request', 'High', 'trtgf', NULL, 'close', '2025-12-08 06:45:46', '2026-03-27 06:47:34'),
(3, 5, 'test', 'Complaint', 'Medium', 'ssdsd', NULL, 'close', '2026-01-21 05:11:07', '2026-03-27 06:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_convs`
--

CREATE TABLE `support_ticket_convs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` bigint(20) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `customer_message` varchar(191) DEFAULT NULL,
  `admin_message` varchar(191) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_ticket_convs`
--

INSERT INTO `support_ticket_convs` (`id`, `support_ticket_id`, `admin_id`, `customer_message`, `admin_message`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'ok', 0, '2025-11-26 07:20:11', '2025-11-26 07:20:11'),
(2, 1, NULL, 'by', NULL, 0, '2025-11-26 07:20:31', '2025-11-26 07:20:31'),
(3, 1, 1, NULL, 'ok', 0, '2025-11-26 07:20:55', '2025-11-26 07:20:55'),
(4, 2, 1, NULL, 'wewde', 0, '2025-12-08 06:47:50', '2025-12-08 06:47:50'),
(5, 2, NULL, 'asas', NULL, 0, '2025-12-08 07:03:34', '2025-12-08 07:03:34'),
(6, 2, 1, NULL, '28148', 0, '2025-12-08 07:08:29', '2025-12-08 07:08:29'),
(7, 2, 1, NULL, '4848', 0, '2025-12-08 07:08:34', '2025-12-08 07:08:34'),
(8, 3, 1, NULL, 'szxdZScfcxzc', 0, '2026-01-21 05:50:30', '2026-01-21 05:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `created_at`, `updated_at`) VALUES
(1, 'Car light', '2023-03-21 15:14:58', '2023-03-21 15:14:58'),
(2, 'Tvs Girling Rear Brake Pad', '2023-03-21 15:18:36', '2023-03-21 15:18:36'),
(3, 'REAR BRAKE PAD SET', '2023-03-21 15:18:36', '2023-03-21 15:18:36'),
(4, 'WALLMATE Black Vinyl Car Wrap Sheet Roll Film Sticker Decal Waterproof Car Styling Wrap Auto Vehicle Accessories (18 x 66 inch', '2023-03-21 15:31:11', '2023-03-21 15:31:11'),
(5, 'Black Matte)', '2023-03-21 15:31:11', '2023-03-21 15:31:11'),
(6, 'Mass Pro 4inch Band Ratchet Installer Tool Car Engine Piston Rings Compressor 3-175mm Motorcycle Engine Parts Piston Ring Kit 1 Piston Ring Compressor Mp Single Sided Specialty', '2023-03-21 15:34:11', '2023-03-21 15:34:11'),
(7, '750', '2023-03-21 15:36:06', '2023-03-21 15:36:06'),
(8, 'NIKAVI Leather Steering Wheel Cover (Medium -O)(38cm) Black', '2023-03-21 15:36:06', '2023-03-21 15:36:06'),
(9, '321', '2025-12-08 01:09:42', '2025-12-08 01:09:42'),
(10, 'weqw', '2025-12-08 01:09:42', '2025-12-08 01:09:42'),
(11, 'sdas', '2025-12-08 01:09:42', '2025-12-08 01:09:42'),
(12, 'asaa', '2025-12-08 02:37:04', '2025-12-08 02:37:04'),
(13, '', '2025-12-08 03:33:46', '2025-12-08 03:33:46'),
(14, 'dad', '2025-12-09 05:50:35', '2025-12-09 05:50:35'),
(15, 'dfvcf', '2025-12-09 05:50:35', '2025-12-09 05:50:35'),
(16, 'dfgfd', '2025-12-09 05:50:35', '2025-12-09 05:50:35'),
(17, 'drgf\'ju', '2025-12-10 06:57:31', '2025-12-10 06:57:31'),
(18, 'gyhjg', '2025-12-10 06:57:31', '2025-12-10 06:57:31'),
(19, 'gjgymj.', '2025-12-10 06:57:31', '2025-12-10 06:57:31'),
(20, 'hyuj', '2025-12-10 07:14:55', '2025-12-10 07:14:55'),
(21, '345', '2025-12-10 07:49:37', '2025-12-10 07:49:37'),
(22, 'dfg', '2025-12-10 07:49:37', '2025-12-10 07:49:37'),
(23, 'ghf', '2025-12-10 07:49:37', '2025-12-10 07:49:37'),
(24, 'bkmn', '2025-12-11 01:20:28', '2025-12-11 01:20:28'),
(25, 'bghj', '2025-12-11 01:20:28', '2025-12-11 01:20:28'),
(26, 'Acrobat Fungicide', '2026-01-19 05:06:13', '2026-01-19 05:06:13'),
(27, 'V-Bind Bio Viricide', '2026-01-20 00:11:16', '2026-01-20 00:11:16'),
(28, 'Indam Patanegra Watermelon Seeds', '2026-01-20 00:44:39', '2026-01-20 00:44:39'),
(29, 'Fantac Plus Growth Promoter', '2026-01-20 01:03:49', '2026-01-20 01:03:49'),
(30, 'sdsds', '2026-02-05 03:28:57', '2026-02-05 03:28:57'),
(31, 'jkj.', '2026-02-05 03:28:57', '2026-02-05 03:28:57'),
(32, 'jkj', '2026-02-05 03:28:57', '2026-02-05 03:28:57'),
(33, 'yty', '2026-02-27 07:33:09', '2026-02-27 07:33:09'),
(34, 'jkh', '2026-02-27 07:33:09', '2026-02-27 07:33:09'),
(35, 'jk', '2026-02-27 07:33:09', '2026-02-27 07:33:09'),
(36, 'iloj', '2026-02-27 07:33:09', '2026-02-27 07:33:09'),
(37, 'fdfg', '2026-03-03 02:03:43', '2026-03-03 02:03:43'),
(38, 'fgd', '2026-03-03 02:03:43', '2026-03-03 02:03:43'),
(39, 'fg', '2026-03-03 02:03:43', '2026-03-03 02:03:43'),
(40, 'df', '2026-03-07 02:06:14', '2026-03-07 02:06:14'),
(41, 'fesf', '2026-03-07 02:10:08', '2026-03-07 02:10:08'),
(42, '435', '2026-03-07 02:13:42', '2026-03-07 02:13:42'),
(43, '34', '2026-03-07 03:16:44', '2026-03-07 03:16:44'),
(44, '545', '2026-03-07 03:26:37', '2026-03-07 03:26:37'),
(45, 'dsf', '2026-03-07 06:27:46', '2026-03-07 06:27:46'),
(46, 'dfgh', '2026-03-07 06:27:46', '2026-03-07 06:27:46'),
(47, 'gv', '2026-03-07 06:27:46', '2026-03-07 06:27:46'),
(48, '6756', '2026-03-18 05:20:31', '2026-03-18 05:20:31'),
(49, 'Biovita Liquid Biofertilizer', '2026-05-15 17:22:44', '2026-05-15 17:22:44'),
(50, 'Multiplex Allbor Boron 20% Fertilizer for Boron Deficiency Correction in Crops', '2026-05-16 11:56:25', '2026-05-16 11:56:25'),
(51, 'Tata Ralligold', '2026-05-16 13:05:26', '2026-05-16 13:05:26'),
(52, 'AJAY BIOTECH VAM', '2026-05-16 13:15:24', '2026-05-16 13:15:24'),
(53, 'Coragen Insecticide', '2026-05-16 13:34:02', '2026-05-16 13:34:02'),
(54, 'Pegasus Insecticide', '2026-05-16 13:41:34', '2026-05-16 13:41:34'),
(55, 'Sonic Flo Insecticide (Fipronil 5% SC) for Sucking Pests & Caterpillar Pests', '2026-05-16 14:09:00', '2026-05-16 14:09:00'),
(56, 'Exponus Insecticide by BASF (Broflanilide 300G/L SC) for Effective Pest Control', '2026-05-16 18:17:27', '2026-05-16 18:17:27'),
(57, 'Dragon King Watermelon Seeds by Syngenta - Sweet & Hybrid Variety', '2026-05-16 18:36:22', '2026-05-16 18:36:22'),
(58, 'Heemsohna Tomato Seeds by Syngenta', '2026-05-16 18:58:25', '2026-05-16 18:58:25'),
(59, 'Bhoomi Coriander Seeds: Aromatic', '2026-05-18 10:25:02', '2026-05-18 10:25:02'),
(60, 'Multi-Cut', '2026-05-18 10:25:02', '2026-05-18 10:25:02'),
(61, 'High-Yield Variety', '2026-05-18 10:25:02', '2026-05-18 10:25:02'),
(62, 'VNR 109 F1 Hybrid Chilli Seeds - Early maturity', '2026-05-18 10:48:40', '2026-05-18 10:48:40'),
(63, 'Light Green', '2026-05-18 10:48:40', '2026-05-18 10:48:40'),
(64, 'Medium Pungent', '2026-05-18 10:48:40', '2026-05-18 10:48:40'),
(65, 'High Yield', '2026-05-18 10:48:40', '2026-05-18 10:48:40'),
(66, 'ANMOL YELLOW WATERMELON', '2026-05-18 11:06:04', '2026-05-18 11:06:04'),
(67, 'Antracol Fungicide by Bayer (Propineb 70% WP) for Fungal Diseases', '2026-05-18 11:27:23', '2026-05-18 11:27:23'),
(68, 'Acrobat Fungicide by BASF', '2026-05-18 11:44:33', '2026-05-18 11:44:33'),
(69, 'Dhanuka M45 Fungicide (Mancozeb 75% WP) for Fungal Disease Control', '2026-05-18 11:52:09', '2026-05-18 11:52:09'),
(70, 'Tata Ergon Fungicide (Kresoxim-methyl 44.3% SC) - Broad Spectrum Systemic Fungicide', '2026-05-18 11:57:05', '2026-05-18 11:57:05'),
(71, 'Dhanuka Godiwa Super Fungicide (Azoxystrobin 18.2% + Difenoconazole 11.4% SC)', '2026-05-18 12:04:27', '2026-05-18 12:04:27'),
(72, 'Iris Hybrid Marigold Yellow Seeds – Vibrant Double-Petal Flowers', '2026-05-18 12:17:19', '2026-05-18 12:17:19'),
(73, 'GENTEX MARIGOLD FIREBALL SEEDS', '2026-05-18 12:30:18', '2026-05-18 12:30:18'),
(74, 'IRIS IMPORTED OP ROCKET LEAVES WILD', '2026-05-18 12:43:30', '2026-05-18 12:43:30'),
(75, 'IAHS CELOSIA CRISTATA', '2026-05-18 12:50:23', '2026-05-18 12:50:23'),
(76, 'VOKKAL - KEERTHI - Marigold', '2026-05-18 13:06:30', '2026-05-18 13:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `tally_companies`
--

CREATE TABLE `tally_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(191) NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tally_companies`
--

INSERT INTO `tally_companies` (`id`, `company_name`, `seller_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Deepak', 1, 1, NULL, '2026-03-19 23:43:14'),
(6, 'Nitesh Bhai', 1, 0, NULL, '2026-03-19 08:12:00'),
(7, 'Deepak', 3, 0, NULL, '2026-03-19 08:11:46'),
(8, 'Nitesh Bhai', 3, 1, NULL, '2026-03-19 08:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `tempproducts`
--

CREATE TABLE `tempproducts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tally_name` varchar(191) DEFAULT NULL,
  `variant` varchar(191) DEFAULT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `rate` double NOT NULL DEFAULT 0,
  `unit` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `third_party_shipping_methods`
--

CREATE TABLE `third_party_shipping_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `api_key` varchar(191) DEFAULT NULL,
  `api_secret` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `third_party_shipping_methods`
--

INSERT INTO `third_party_shipping_methods` (`id`, `user_id`, `api_key`, `api_secret`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'ewerwr', '7c42a20bc183692c18454fc5dc7e6195e1c04e82', 1, '2026-02-23 02:27:34', '2026-04-01 10:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `payment_for` varchar(100) DEFAULT NULL,
  `payer_id` bigint(20) DEFAULT NULL,
  `payment_receiver_id` bigint(20) DEFAULT NULL,
  `paid_by` varchar(15) DEFAULT NULL,
  `paid_to` varchar(15) DEFAULT NULL,
  `payment_method` varchar(15) DEFAULT NULL,
  `payment_status` varchar(10) NOT NULL DEFAULT 'success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `transaction_type` varchar(191) DEFAULT NULL,
  `order_details_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `translationable_type` varchar(191) NOT NULL,
  `translationable_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(191) NOT NULL,
  `key` varchar(191) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`translationable_type`, `translationable_id`, `locale`, `key`, `value`, `id`) VALUES
('App\\Model\\Product', 51, 'in', 'name', 'Acrobat Fungicide | Stop Late Blight & Downy Mildew Before They Ruin Your Harves', 3),
('App\\Model\\Product', 51, 'in', 'description', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Acrobat Fungicide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>BASF</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Dimethomorph 50% WP</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Blue</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h1>Product Description</h1>\r\n\r\n<h2>About Acrobat Fungicide</h2>\r\n\r\n<ul>\r\n	<li><strong>Acrobat Fungicide</strong>&nbsp;is from one of most trusted and oldest brand to&nbsp;<strong>control Downy Mildew and Late blight fungal diseases.</strong></li>\r\n	<li><strong>Acrobat Fungicide technical name - Dimethomorph 50% WP</strong></li>\r\n	<li>Acrobat is supporting Indian Fruits &amp; Vegetable growers to manage their crops most devastating diseases in a highly effective way.</li>\r\n	<li>It acts fast and effectively against Pythium and Phytophthora species.</li>\r\n</ul>\r\n\r\n<h2>Acrobat Fungicide Technical Details</h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:&nbsp;</strong>Dimethomorph 50% WP</li>\r\n	<li><strong>Mode of Entry:&nbsp;</strong>Systemic Action</li>\r\n	<li><strong>Mode of Action:&nbsp;</strong>Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action.</li>\r\n</ul>\r\n\r\n<h2>Key Features and Benefits</h2>\r\n\r\n<ul>\r\n	<li>Dimethomorph is a systemic morpholine fungicide</li>\r\n	<li>Effective against all the stages of fungi</li>\r\n	<li><em>Acrobat Fungicide</em>&nbsp;has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection</li>\r\n</ul>\r\n\r\n<h2>Acrobat Fungicide Usage and Crops</h2>\r\n\r\n<ul>\r\n	<li><strong>Recommended Crops:</strong><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Crops</td>\r\n			<td>Target Disease</td>\r\n			<td>Dosage/ Acre in (g)</td>\r\n			<td>Dilution in water (L)</td>\r\n			<td>Dosage(g) / Litre of water</td>\r\n			<td>Waiting from last spray to harvest (days)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Potato</td>\r\n			<td>Downy Mildew &amp; Late blight</td>\r\n			<td>400</td>\r\n			<td>300 L</td>\r\n			<td>1.3</td>\r\n			<td>16</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Grapes</td>\r\n			<td>Downy Mildew &amp; Late blight</td>\r\n			<td>400</td>\r\n			<td>300 L</td>\r\n			<td>1.3</td>\r\n			<td>34</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li><strong>Method of Application:&nbsp;</strong>Foliar spray</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 4),
('App\\Model\\Product', 64, 'in', 'name', 'Acrobat Fungicide | Stop Late Blight & Downy Mildew Before They Ruin Your Harves', 15),
('App\\Model\\Product', 64, 'in', 'description', '<p>About Acrobat Fungicide Acrobat Fungicide is from one of most trusted and oldest brand to control Downy Mildew and Late blight fungal diseases. Acrobat Fungicide technical name - Dimethomorph 50% WP Acrobat is supporting Indian Fruits &amp; Vegetable growers to manage their crops most devastating diseases in a highly effective way. It acts fast and effectively against Pythium and Phytophthora species. Acrobat Fungicide Technical Details Technical Content: Dimethomorph 50% WP Mode of Entry: Systemic Action Mode of Action: Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action. Key Features and Benefits Dimethomorph is a systemic morpholine fungicide Effective against all the stages of fungi Acrobat Fungicide has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection Acrobat Fungicide Usage and Crops Recommended Crops: Crops Target Disease Dosage/ Acre in (g) Dilution in water (L) Dosage(g) / Litre of water Waiting from last spray to harvest (days) Potato Downy Mildew &amp; Late blight 400 300 L 1.3 16 Grapes Downy Mildew &amp; Late blight 400 300 L 1.3 34 Method of Application: Foliar spray Disclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 16),
('App\\Model\\Product', 54, 'in', 'name', 'Acrobat Fungicide | Stop Late Blight & Downy Mildew Before They Ruin Your Harves', 20),
('App\\Model\\Product', 54, 'in', 'description', '<p>About Acrobat Fungicide Acrobat Fungicide is from one of most trusted and oldest brand to control Downy Mildew and Late blight fungal diseases. Acrobat Fungicide technical name - Dimethomorph 50% WP Acrobat is supporting Indian Fruits &amp; Vegetable growers to manage their crops most devastating diseases in a highly effective way. It acts fast and effectively against Pythium and Phytophthora species. Acrobat Fungicide Technical Details Technical Content: Dimethomorph 50% WP Mode of Entry: Systemic Action Mode of Action: Its mode of action is the inhibition of sterol (ergosterol) synthesis. Acrobat Fungicide is effective against all the stages of fungi with its unique mode of action of Cell wall lysis. It can be used as preventive application which provides effective results due to its translaminar and anti-sporulant action. Key Features and Benefits Dimethomorph is a systemic morpholine fungicide Effective against all the stages of fungi Acrobat Fungicide has translaminar properties, it can move from one side of the leaf to the other and protect both the upper and lower leaf surfaces from fungal infection Acrobat Fungicide Usage and Crops Recommended Crops: Crops Target Disease Dosage/ Acre in (g) Dilution in water (L) Dosage(g) / Litre of water Waiting from last spray to harvest (days) Potato Downy Mildew &amp; Late blight 400 300 L 1.3 16 Grapes Downy Mildew &amp; Late blight 400 300 L 1.3 34 Method of Application: Foliar spray Disclaimer: This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 21),
('App\\Model\\Product', 103, 'in', 'name', 'Biovita Liquid Biofertilizer (Seaweed Extract – Ascophyllum nodosum)', 22),
('App\\Model\\Product', 126, 'in', 'name', 'IAHS CELOSIA CRISTATA', 23),
('App\\Model\\Product', 109, 'in', 'name', '(Diafenthiuron 50% WP) – Broad Spectrum Insecticide & Miticide', 24),
('App\\Model\\Product', 127, 'in', 'name', 'VOKKAL - KEERTHI - Marigold', 25),
('App\\Model\\Product', 125, 'in', 'name', 'IRIS IMPORTED OP ROCKET LEAVES WILD', 26),
('App\\Model\\Product', 124, 'in', 'name', 'GENTEX MARIGOLD FIREBALL SEEDS', 27),
('App\\Model\\Product', 123, 'in', 'name', 'Iris Hybrid Marigold Yellow Seeds – Vibrant Double-Petal Flowers', 28),
('App\\Model\\Product', 122, 'in', 'name', 'Dhanuka Godiwa Super Fungicide (Azoxystrobin 18.2% + Difenoconazole 11.4% SC)', 29),
('App\\Model\\Product', 121, 'in', 'name', 'Tata Ergon Fungicide (Kresoxim-methyl 44.3% SC) - Broad Spectrum Systemic Fungic', 30),
('App\\Model\\Product', 120, 'in', 'name', 'Dhanuka M45 Fungicide (Mancozeb 75% WP) for Fungal Disease Control', 31),
('App\\Model\\Product', 119, 'in', 'name', 'Acrobat Fungicide by BASF (Dimethomorph 50% WP) for Downy Mildew & Late Blight', 32),
('App\\Model\\Product', 118, 'in', 'name', 'Antracol Fungicide by Bayer (Propineb 70% WP) for Fungal Diseases', 33),
('App\\Model\\Product', 121, 'in', 'description', '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>Ergon Fungicide</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>Tata Rallis</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Category</th>\r\n			<td>Fungicides</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Technical Content</th>\r\n			<td>Kresoxim-methyl 44.3% SC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Classification</th>\r\n			<td>Chemical</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Toxicity</th>\r\n			<td>Green</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<h2>About Ergon Fungicide</h2>\r\n\r\n<ul>\r\n	<li><strong>Ergon Fungicide</strong>&nbsp;is a cutting-edge fungicide that has gained prominence in modern agriculture for its efficacy in managing fungal diseases.</li>\r\n	<li><strong>Tata Ergon technical name - Kresoxim-methyl 44.3% SC</strong></li>\r\n	<li>It is a broad spectrum Strobilurin fungicide with a protective, curative and eradicative action.</li>\r\n	<li>It gives good residual activity and hence extended duration of control.</li>\r\n	<li><em>Ergon Fungicide</em>&nbsp;influences a variety of physiological processes thereby enhancing the quality and yield.</li>\r\n</ul>\r\n\r\n<h2><strong>Ergon Fungicide Technical Details</strong></h2>\r\n\r\n<ul>\r\n	<li><strong>Technical Content:</strong>&nbsp;Kresoxim-methyl 44.3% SC</li>\r\n	<li><strong>Mode of Entry:</strong>&nbsp;Systemic and Contact</li>\r\n	<li><strong>Mode of Action:</strong>&nbsp;Ergon is a Quinone outside inhibitor, inhibits mitochondrial electron transfer between cytochrome b and Cytochrome C1 and involves interfering with the respiration process of fungal cells disrupting energy production. It acts by inhibiting spore germination, as a result, fungal growth is suppressed, and the spread of infections within the plant is halted.</li>\r\n</ul>\r\n\r\n<h2><strong>Key Features &amp; Benefits</strong></h2>\r\n\r\n<ul>\r\n	<li>Ergon Fungicide&nbsp;is a one-shot solution for major classes of fungus.</li>\r\n	<li>It is very effective against powdery mildew for most of the crops and has a good greening effect.</li>\r\n	<li>It has excellent translaminar and vapor actions.</li>\r\n	<li>Rapidly translocated in entire plant parts.</li>\r\n	<li>It is known for its excellent rainfastness,</li>\r\n	<li>It has a good phytotonic effect.</li>\r\n	<li>Ergon versatility makes it valuable for integrated pest management in diverse crops.</li>\r\n</ul>\r\n\r\n<h2><strong>Ergon Fungicide Usage &amp; Crops</strong></h2>\r\n\r\n<p><strong>Recommendations:</strong></p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><strong>Crops</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Target Disease</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dosage / ha (ml)</strong></p>\r\n			</td>\r\n			<td>\r\n			<p><strong>Dilution in water (L/ha)</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Paddy</p>\r\n			</td>\r\n			<td>\r\n			<p>Blast, Sheath blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Grapes</p>\r\n			</td>\r\n			<td>\r\n			<p>Powdery mildew, Downey mildew</p>\r\n			</td>\r\n			<td>\r\n			<p>600-700</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Chilli</p>\r\n			</td>\r\n			<td>\r\n			<p>Powdery mildew, Fruit rot, Die back, Twig blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Soybean</p>\r\n			</td>\r\n			<td>\r\n			<p>Rust</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Potato</p>\r\n			</td>\r\n			<td>\r\n			<p>Late blight, Early blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Cotton</p>\r\n			</td>\r\n			<td>\r\n			<p>Leaf spot, Grey mildew</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Wheat</p>\r\n			</td>\r\n			<td>\r\n			<p>Rust, Leaf blight</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Maize</p>\r\n			</td>\r\n			<td>\r\n			<p>Turcicum leaf blight, rust</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n			<td>\r\n			<p>500</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Method of Application:</strong>&nbsp;Foliar Spray</p>\r\n\r\n<h2><strong>Additional Information</strong></h2>\r\n\r\n<ul>\r\n	<li>The compatibility of Kresoxim-methyl with other fungicides allows for synergistic effects when combined in tank-mixtures.</li>\r\n</ul>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;This information is provided for reference purposes only. Always follow the recommended application guidelines outlined on the product label and accompanying leaflet.</p>', 34),
('App\\Model\\Product', 117, 'in', 'name', 'ANMOL YELLOW WATERMELON', 35),
('App\\Model\\Product', 116, 'in', 'name', 'VNR 109 F1 Hybrid Chilli Seeds - Early maturity, Light Green, Medium Pungent, Hi', 36),
('App\\Model\\Product', 115, 'in', 'name', 'Bhoomi Coriander Seeds: Aromatic, Multi-Cut, High-Yield Variety', 37),
('App\\Model\\Product', 124, 'in', 'description', '<p>Overview</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Product Name</th>\r\n			<td>GENTEX MARIGOLD FIREBALL SEEDS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>GENETEX AGRI INPUTS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Type</th>\r\n			<td>Flower</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Crop Name</th>\r\n			<td>Marigold Seeds</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Product Description</p>\r\n\r\n<p><strong>About Seeds</strong></p>\r\n\r\n<ul>\r\n	<li>Marigold Fireball: Vibrant, compact marigold with bright orange blooms, ideal for garden beds, borders, and landscaping.</li>\r\n</ul>\r\n\r\n<p><strong>Seed Specifications</strong></p>\r\n\r\n<ul>\r\n	<li>Plant Height : 12 - 16 Inches tall</li>\r\n	<li>Shape/size : 7 - 8 cm round</li>\r\n	<li>Crop/Veg/Fruit - Colour : Bright orange with golden yellow hues.</li>\r\n	<li>Weight (resulting fruit/nut/veg/flower&hellip;etc): 20 - 50 gram per unit</li>\r\n	<li>Maturity (How many days?): 60 - 70 days</li>\r\n	<li>Dosage(seeds required for an acre) : 100 - 150 gram</li>\r\n	<li>Germination : 85-90%</li>\r\n	<li>Category (flower/vegetable/Nut/Fruit&hellip;&hellip;etc): Flower</li>\r\n	<li>Suitable Region/season: Summer.</li>\r\n</ul>', 38),
('App\\Model\\Product', 113, 'in', 'name', 'Dragon King Watermelon Seeds by Syngenta - Sweet & Hybrid Variety', 39),
('App\\Model\\Product', 112, 'in', 'name', 'Volax Insecticide- Emamectin benzoate 5% SG Control Bollworms in Cotton, Fruit &', 40),
('App\\Model\\Product', 111, 'in', 'name', 'Exponus Insecticide by BASF (Broflanilide 300G/L SC) for Effective Pest Control', 41),
('App\\Model\\Product', 110, 'in', 'name', 'Sonic Flo Insecticide (Fipronil 5% SC) for Sucking Pests & Caterpillar Pests', 42),
('App\\Model\\Product', 108, 'in', 'name', '– Chlorantraniliprole 18.5% SC – Safe, Effective Pest Control', 43),
('App\\Model\\Product', 107, 'in', 'name', 'AJAY BIOTECH VAM (MYCORRHIZAL BIOFERTILIZER)', 44),
('App\\Model\\Product', 106, 'in', 'name', 'Tata Ralligold (Mycorrhizal Biofertilizer) VAM-Based Root Growth Enhancer', 45),
('App\\Model\\Product', 104, 'in', 'name', 'Fantac Plus Growth Promoter (Amino Acid & Vitamins) for Vegetables, Flowers & Mo', 46),
('App\\Model\\Product', 105, 'in', 'name', 'Multiplex Allbor Boron 20% Fertilizer for Boron Deficiency Correction in Crops', 47),
('App\\Model\\Product', 114, 'in', 'name', 'Heemsohna Tomato Seeds by Syngenta | Indeterminate, Hybrid Variety', 48);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `phone` varchar(25) NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'def.png',
  `email` varchar(80) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(80) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `street_address` varchar(250) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `apartment_no` varchar(50) DEFAULT NULL,
  `cm_firebase_token` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `payment_card_last_four` varchar(191) DEFAULT NULL,
  `payment_card_brand` varchar(191) DEFAULT NULL,
  `payment_card_fawry_token` text DEFAULT NULL,
  `login_medium` varchar(191) DEFAULT NULL,
  `social_id` varchar(191) DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `temporary_token` varchar(191) DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `wallet_balance` double(8,2) DEFAULT NULL,
  `loyalty_point` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `f_name`, `l_name`, `phone`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `street_address`, `country`, `city`, `zip`, `house_no`, `apartment_no`, `cm_firebase_token`, `is_active`, `payment_card_last_four`, `payment_card_brand`, `payment_card_fawry_token`, `login_medium`, `social_id`, `is_phone_verified`, `temporary_token`, `is_email_verified`, `wallet_balance`, `loyalty_point`) VALUES
(1, 'walking customer', 'walking', 'customer', '000000000000', 'def.png', 'walking@customer.com', NULL, '', NULL, NULL, '2022-02-03 03:46:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL),
(2, NULL, 'Manish', 'Pal', '+8808949319995', 'def.png', 'manishpal2710@gmail.com', NULL, '$2y$10$vos6/dHxX7VVr5JE/jJHqeIdpe6BVKelNnvKrMljtFmt4ECETInOS', NULL, '2023-04-02 13:41:49', '2025-12-14 23:41:23', NULL, NULL, NULL, NULL, NULL, NULL, 'dE3ytvtHRwi_h2yxxcsc7J:APA91bEnKBtsDjIfuzZt3u8OWNVpxQfHXWn7CdAdWrxp_xI-aZEXXKwKHmFwwK3hPguSphNcYNtYPdhnMB1oVceWTxMhL6WmzxZ495nzT3VuuFJF_en0pfs4hhFLKZZdsJ1oazQjg4HL', 1, NULL, NULL, NULL, NULL, NULL, 0, 'sQ28CzkkacNK80TCEOYFzpAr4CjO2HGRED2VbcR6', 0, 833.33, NULL),
(3, NULL, 'Gaurav', 'Sharma', '+8807976085291', 'def.png', 'cooldudegaurav.sharma781@gmail.com', NULL, '$2y$10$OU270929HtW.qyTmEJQHhOFDBE0wFOypGOU0h/cL96rkuwgmC6wLa', NULL, '2023-04-02 14:27:23', '2025-12-14 23:39:59', NULL, NULL, NULL, NULL, NULL, NULL, 'fap_RwTyQ4aB5EZYFIOo4a:APA91bGrwgww-c_t4FK0aN9DjSzX4axj_RTW5qHrgInN26ve3_n5SRv7FxrXwuZcgCgiMiepxwKBTCMdfs-67YJA70tkLy0OTxaQuj7Yn4cd3iZuRnWyQViGFfICAoPD8cYF_LJ0Axwk', 1, NULL, NULL, NULL, NULL, NULL, 0, 'YDX08zPe4wJounVfrAAMFpClgbmq2phOnKT2HGzD', 0, 83.33, NULL),
(4, NULL, 'test', 'test', '7688927161', '2025-11-25-69258e7aad740.png', 'true@gmail.com', NULL, '$2y$10$zdWADYLn3R4WwwC6NByATOR/RB0SNeJqjAZVABhDZR8dXmEIxrfOi', 'wOan7uwmvnnaUtVdO8yXVCeEbL3bFxaTxAbcj13XfdvFL9D5i5p1avFai2VC', '2025-11-25 00:44:53', '2026-02-25 07:59:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 82.76, 24828.00),
(12, NULL, 'Deepak', 'Nogia', '7688927161', '2026-03-21-69be33a67e0de.png', 'deepaknogia.yuvmedia@gmail.com', NULL, '$2y$10$kgRRX8GvvsnDRqidhOQxNOvdRIVz.i0RVf6mh661Vatw19cgFUpE.', '3haJrezzI4bwfPixuqaJFqymW1plAg6x7UvLkUmmQ0WU1txMhG1nlyrgB3E8', '2026-03-21 05:59:02', '2026-05-15 16:18:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'google', '103684412375387462597', 0, 'dYVDiIvMOcGqKfr3ecRhCnjAaZuPNDdTnPTIwZ7x', 0, 346.68, 687.00),
(13, NULL, 'Devendra', 'Yuvmedia', '', '2026-03-30-69ca1bb8c6ca2.png', 'devendrayuvmedia@gmail.com', NULL, '$2y$10$BfLiWW2zYAAboVlYZDxf.uokMhVnbUO.WUX0MqzCvnlvnNxoMZM8e', 'CCGU3UKSpJJJv9nGlbrjIiBcpw0kvWrn9TLTAHIioHODTHYZvXjPEoCVGJrS', '2026-03-30 12:14:08', '2026-03-30 12:14:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'google', '115113952597179946394', 0, 'h3uowITxxNW03MJyfZPH2pzJGo7QTXipGT3zwAFX', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` char(36) NOT NULL,
  `credit` decimal(24,3) NOT NULL DEFAULT 0.000,
  `debit` decimal(24,3) NOT NULL DEFAULT 0.000,
  `admin_bonus` decimal(24,3) NOT NULL DEFAULT 0.000,
  `balance` decimal(24,3) NOT NULL DEFAULT 0.000,
  `transaction_type` varchar(191) DEFAULT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user_id`, `transaction_id`, `credit`, `debit`, `admin_bonus`, `balance`, `transaction_type`, `reference`, `created_at`, `updated_at`) VALUES
(1, 4, '918330bc-a0d0-41fc-8f78-7515b0c7c01b', 82.760, 0.000, 0.000, 82.760, 'loyalty_point', 'point_to_wallet', '2025-12-12 07:52:36', '2025-12-12 07:52:36'),
(2, 3, '215055b6-2a1b-4bd7-9122-a4273701a1b0', 83.333, 0.000, 0.000, 83.333, 'add_fund_by_admin', '55821', '2025-12-14 23:39:59', '2025-12-14 23:39:59'),
(3, 2, '8a4675af-5bb4-4ca9-bb67-d61eb5ded39b', 833.333, 0.000, 0.000, 833.333, 'add_fund_by_admin', '55821', '2025-12-14 23:41:23', '2025-12-14 23:41:23'),
(4, 12, 'a9a7ef79-7f4e-4876-b420-98029cda3d9e', 300.000, 0.000, 0.000, 300.000, 'loyalty_point', 'point_to_wallet', '2026-03-20 01:40:38', '2026-03-20 01:40:38'),
(5, 12, 'c5882529-a272-4f23-8366-d069c90db8c1', 46.680, 0.000, 0.000, 346.680, 'loyalty_point', 'point_to_wallet', '2026-03-20 01:42:07', '2026-03-20 01:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_settings`
--

CREATE TABLE `whatsapp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `app_id` varchar(191) DEFAULT NULL,
  `api_secret_key` longtext DEFAULT NULL,
  `phone_number_id` varchar(191) DEFAULT NULL,
  `whatsapp_business_account_id` varchar(191) DEFAULT NULL,
  `access_token` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whatsapp_settings`
--

INSERT INTO `whatsapp_settings` (`id`, `user_id`, `app_id`, `api_secret_key`, `phone_number_id`, `whatsapp_business_account_id`, `access_token`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '1550535460191729', '19c47a3dae57a5ce66ba78da062cee56', '1084340194769869', '4442920485996322', 'EAAWCNCtQZCfEBRg04zbBw4Nq9wrZA3ZCjj9S5JiOQTqlYPlh9qanUNiyMqh585t1LM91EhA4kJrBP8DfOoShGJOrDB9bKGAAffEFVJEHcYx8XVcRRYAX6Dhy23ZBweN5pMwsTs4STlMkr5jWXJZBh5RtS1ZAMNPbvbHSL6PE5ZCYzTLZCwk13ZAre7kuHY2W1TwZDZD', 0, '2026-02-23 01:46:58', '2026-05-23 18:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_templetes`
--

CREATE TABLE `whatsapp_templetes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `template_id` varchar(191) NOT NULL,
  `components` varchar(191) NOT NULL,
  `category` varchar(191) NOT NULL,
  `language` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whatsapp_templetes`
--

INSERT INTO `whatsapp_templetes` (`id`, `name`, `template_id`, `components`, `category`, `language`, `status`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'hello_world', '1574449583665427', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Hello World\"},{\"type\":\"BODY\",\"text\":\"Welcome and congratulations!! This message demonstrates your ability to send a WhatsApp message notification fro', 'UTILITY', 'en_US', 'approved', 'confirmed', 1, '2026-02-23 23:30:35', '2026-03-27 11:05:11'),
(8, 'order_pending', '2653295401732126', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"order pending {{1}}\",\"example\":{\"header_text\":[\"#1234\"]}},{\"type\":\"BODY\",\"text\":\"Hi {{1}},\\nYour order {{2}} is currently pending.\\nWe will update yo', 'UTILITY', 'en_US', 'pending', NULL, 1, '2026-02-24 07:40:20', '2026-02-24 07:40:20'),
(9, 'order_pending', '1435576531361248', '[{\"type\":\"BODY\",\"text\":\"Hi {{name}},\\nYour order {{id}} is currently pending.\\nWe will update you shortly.\",\"example\":{\"body_text_named_params\":[{\"param_name\":\"name\",\"example\":\"John\"},{\"param', 'UTILITY', 'en', 'pending', NULL, 1, '2026-02-24 07:49:04', '2026-02-24 08:05:17'),
(10, 'order_processing', '1423614746213033', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Order Processing\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}},\\nYour order {{id}} is being processed.\",\"example\":{\"body_text_named_params\":[{\"param_name\":\"na', 'UTILITY', 'en', 'pending', NULL, 1, '2026-02-24 07:53:53', '2026-02-24 08:05:17'),
(11, 'order_confirmation', '1416252416430592', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Order Confirmation\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}},\\nYour order {{id}} worth \\u20b9{{amount}} has been confirmed.\",\"example\":{\"body_text_named_p', 'UTILITY', 'en', 'pending', NULL, 1, '2026-02-24 07:53:53', '2026-02-24 08:05:17'),
(12, 'order_confirmation_2', '1982688169264296', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Order Confirmation\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}}! \\ud83c\\udfa7\\ud83d\\uded2\\n\\nCongratulations! \\ud83c\\udf89 Your order for the *{{p_name1}}* h', 'UTILITY', 'en', 'pending', NULL, 1, '2026-02-24 09:59:47', '2026-03-27 11:05:11'),
(13, 'order_cancelled', '1242255024012598', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Order Cancelled\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}}!\\n\\nYour order {{id}} amounting to {{amount}} has been cancelled. \\n\\nWe\\u2019re sorry that this', 'MARKETING', 'en_US', 'approved', NULL, 1, '2026-02-24 09:59:47', '2026-03-27 11:05:11'),
(14, 'delivery_failed_1', '1153662613379364', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Could not deliver your order\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}}, \\n\\nWe attempted to deliver your order on {{date}} but were not successful. \\n\\nPl', 'UTILITY', 'en_US', 'pending', NULL, 1, '2026-02-24 10:38:37', '2026-02-24 10:38:37'),
(15, 'refund_confirmation_1', '1460464365595272', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"You were refunded Order\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}},\\n\\nYour refund for {{amount}} has been processed for order {{p_name}}. You\'ll be credit', 'UTILITY', 'en_US', 'pending', NULL, 1, '2026-02-24 10:38:37', '2026-02-25 01:52:37'),
(16, 'packaging_order', '35064359163162815', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Packaging order\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}}! \\ud83d\\udce6\\u2728\\n\\nGood news! \\ud83c\\udf89  \\nYour order {{o_id}} is now being carefully pac', 'UTILITY', 'en_US', 'approved', 'processing', 1, '2026-02-24 10:38:37', '2026-03-27 11:05:11'),
(17, 'order_recovery', '744896218500573', '[{\"type\":\"HEADER\",\"format\":\"TEXT\",\"text\":\"Order return\"},{\"type\":\"BODY\",\"text\":\"Hi {{name}}, \\n\\nyour broadband connection has been disconnected. To return your device, please follow these st', 'UTILITY', 'en_US', 'approved', NULL, 1, '2026-02-25 01:52:37', '2026-03-27 11:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `customer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 4, 9, '2025-12-08 06:54:49', '2025-12-08 06:54:49'),
(7, 5, 64, '2026-03-18 02:23:57', '2026-03-18 02:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_methods`
--

CREATE TABLE `withdrawal_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_name` varchar(191) NOT NULL,
  `method_fields` text NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_methods`
--

INSERT INTO `withdrawal_methods` (`id`, `method_name`, `method_fields`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bank', '[{\"input_type\":\"number\",\"input_name\":\"limit\",\"placeholder\":\"Enter amount\",\"is_required\":1}]', 1, 1, '2025-12-08 07:58:00', '2026-03-23 10:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `delivery_man_id` bigint(20) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `amount` varchar(191) NOT NULL DEFAULT '0.00',
  `withdrawal_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `withdrawal_method_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`withdrawal_method_fields`)),
  `transaction_note` text DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_requests`
--

INSERT INTO `withdraw_requests` (`id`, `seller_id`, `delivery_man_id`, `admin_id`, `amount`, `withdrawal_method_id`, `withdrawal_method_fields`, `transaction_note`, `approved`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '11100', 1, '{\"method_name\":\"bank\",\"limit\":\"452\"}', 'done', 1, '2026-03-23 10:19:47', '2026-03-23 10:20:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_wallets`
--
ALTER TABLE `admin_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_wallet_histories`
--
ALTER TABLE `admin_wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biddings`
--
ALTER TABLE `biddings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_shippings`
--
ALTER TABLE `cart_shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_shipping_costs`
--
ALTER TABLE `category_shipping_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chanals`
--
ALTER TABLE `chanals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chattings`
--
ALTER TABLE `chattings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_wallets`
--
ALTER TABLE `customer_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_wallet_histories`
--
ALTER TABLE `customer_wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deal_of_the_days`
--
ALTER TABLE `deal_of_the_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_notifications`
--
ALTER TABLE `deliveryman_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryman_wallets`
--
ALTER TABLE `deliveryman_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_country_codes`
--
ALTER TABLE `delivery_country_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_histories`
--
ALTER TABLE `delivery_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_man_transactions`
--
ALTER TABLE `delivery_man_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_men`
--
ALTER TABLE `delivery_men`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_zip_codes`
--
ALTER TABLE `delivery_zip_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_deals`
--
ALTER TABLE `feature_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deals`
--
ALTER TABLE `flash_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_topics`
--
ALTER TABLE `help_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `loyalty_point_transactions`
--
ALTER TABLE `loyalty_point_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_reads`
--
ALTER TABLE `notification_reads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_reads_notification_id_foreign` (`notification_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_expected_delivery_histories`
--
ALTER TABLE `order_expected_delivery_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_transactions`
--
ALTER TABLE `order_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`identity`);

--
-- Indexes for table `paytabs_invoices`
--
ALTER TABLE `paytabs_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone_or_email_verifications`
--
ALTER TABLE `phone_or_email_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_querys`
--
ALTER TABLE `product_querys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recently_viewed_products_user_id_foreign` (`user_id`),
  ADD KEY `recently_viewed_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_statuses`
--
ALTER TABLE `refund_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_transactions`
--
ALTER TABLE `refund_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_managers`
--
ALTER TABLE `sale_managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_managers_email_unique` (`email`);

--
-- Indexes for table `search_functions`
--
ALTER TABLE `search_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_email_unique` (`email`);

--
-- Indexes for table `seller_broadcasts`
--
ALTER TABLE `seller_broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_notifications`
--
ALTER TABLE `seller_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_notifications_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `seller_wallets`
--
ALTER TABLE `seller_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_wallet_histories`
--
ALTER TABLE `seller_wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_types`
--
ALTER TABLE `shipping_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_medias`
--
ALTER TABLE `social_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soft_credentials`
--
ALTER TABLE `soft_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_convs`
--
ALTER TABLE `support_ticket_convs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tally_companies`
--
ALTER TABLE `tally_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempproducts`
--
ALTER TABLE `tempproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_party_shipping_methods`
--
ALTER TABLE `third_party_shipping_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD UNIQUE KEY `transactions_id_unique` (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translations_translationable_id_index` (`translationable_id`),
  ADD KEY `translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_templetes`
--
ALTER TABLE `whatsapp_templetes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_methods`
--
ALTER TABLE `withdrawal_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_wallets`
--
ALTER TABLE `admin_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_wallet_histories`
--
ALTER TABLE `admin_wallet_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `biddings`
--
ALTER TABLE `biddings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `billing_addresses`
--
ALTER TABLE `billing_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart_shippings`
--
ALTER TABLE `cart_shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category_shipping_costs`
--
ALTER TABLE `category_shipping_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chanals`
--
ALTER TABLE `chanals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chattings`
--
ALTER TABLE `chattings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_wallets`
--
ALTER TABLE `customer_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_wallet_histories`
--
ALTER TABLE `customer_wallet_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deal_of_the_days`
--
ALTER TABLE `deal_of_the_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deliveryman_notifications`
--
ALTER TABLE `deliveryman_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveryman_wallets`
--
ALTER TABLE `deliveryman_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_country_codes`
--
ALTER TABLE `delivery_country_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_histories`
--
ALTER TABLE `delivery_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_man_transactions`
--
ALTER TABLE `delivery_man_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_men`
--
ALTER TABLE `delivery_men`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_zip_codes`
--
ALTER TABLE `delivery_zip_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_deals`
--
ALTER TABLE `feature_deals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_deals`
--
ALTER TABLE `flash_deals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `help_topics`
--
ALTER TABLE `help_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loyalty_point_transactions`
--
ALTER TABLE `loyalty_point_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notification_reads`
--
ALTER TABLE `notification_reads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100013;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_expected_delivery_histories`
--
ALTER TABLE `order_expected_delivery_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status_histories`
--
ALTER TABLE `order_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `order_transactions`
--
ALTER TABLE `order_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paytabs_invoices`
--
ALTER TABLE `paytabs_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_or_email_verifications`
--
ALTER TABLE `phone_or_email_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `product_querys`
--
ALTER TABLE `product_querys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `refund_requests`
--
ALTER TABLE `refund_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_statuses`
--
ALTER TABLE `refund_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_transactions`
--
ALTER TABLE `refund_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_managers`
--
ALTER TABLE `sale_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `search_functions`
--
ALTER TABLE `search_functions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_broadcasts`
--
ALTER TABLE `seller_broadcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_notifications`
--
ALTER TABLE `seller_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_wallets`
--
ALTER TABLE `seller_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_wallet_histories`
--
ALTER TABLE `seller_wallet_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping_types`
--
ALTER TABLE `shipping_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_medias`
--
ALTER TABLE `social_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `soft_credentials`
--
ALTER TABLE `soft_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `support_ticket_convs`
--
ALTER TABLE `support_ticket_convs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tally_companies`
--
ALTER TABLE `tally_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tempproducts`
--
ALTER TABLE `tempproducts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `third_party_shipping_methods`
--
ALTER TABLE `third_party_shipping_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `whatsapp_templetes`
--
ALTER TABLE `whatsapp_templetes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `withdrawal_methods`
--
ALTER TABLE `withdrawal_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification_reads`
--
ALTER TABLE `notification_reads`
  ADD CONSTRAINT `notification_reads_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  ADD CONSTRAINT `recently_viewed_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recently_viewed_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seller_notifications`
--
ALTER TABLE `seller_notifications`
  ADD CONSTRAINT `seller_notifications_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
this my database file 

https://whatsappbusiness.com/policy/