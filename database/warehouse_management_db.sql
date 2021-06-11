-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 11, 2021 lúc 11:55 AM
-- Phiên bản máy phục vụ: 5.7.21
-- Phiên bản PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `warehouse_management_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` enum('1','2','3','4') COLLATE utf8_unicode_ci DEFAULT '1',
  `level_id_1` int(10) UNSIGNED DEFAULT NULL,
  `level_id_2` int(10) UNSIGNED DEFAULT NULL,
  `level_id_3` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `title`, `status`, `created_at`, `updated_at`, `level`, `level_id_1`, `level_id_2`, `level_id_3`) VALUES
(24, 'Danh mục a - cấp 3', '0', NULL, NULL, '3', 20, 23, NULL),
(23, 'Danh mục c - cấp 2', '0', NULL, NULL, '2', 20, NULL, NULL),
(22, 'Danh mục b - cấp 2', '1', NULL, NULL, '2', NULL, NULL, NULL),
(20, 'Danh mục c - cấp 1', '1', NULL, NULL, '1', NULL, NULL, NULL),
(21, 'Danh mục a - cấp 2', '1', NULL, NULL, '2', NULL, NULL, NULL),
(19, 'Danh mục b - cấp 1', '1', NULL, NULL, '1', NULL, NULL, NULL),
(18, 'Danh mục a - cấp 1', '1', NULL, NULL, '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `tel` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `tel`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Phạm Quốc Tiến', '0939432055', 'Hồng Ngự, Đồng tháp', NULL, NULL),
(8, 'asd', '093492055', '1234567', '2021-06-04 21:58:00', '2021-06-04 21:58:00'),
(7, 'asdasd', '0985793801', '123456789', '2021-06-04 21:53:39', '2021-06-04 21:53:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_31_135351_create_category_table', 2),
(5, '2021_06_01_082016_create_product_table', 3),
(6, '2021_06_01_083806_add_column_field_product', 4),
(7, '2021_06_01_132936_add_to_field_column_specification', 5),
(8, '2021_06_02_064948_add_to_column_filed_category', 6),
(9, '2021_06_02_072620_add_to_column_filed_level_id_category', 7),
(10, '2021_06_04_070329_create_order_table', 8),
(11, '2021_06_04_070345_create_order_detail__table', 9),
(12, '2021_06_04_072104_create_customer_table', 9),
(13, '2021_06_06_114825_drop_table_order_detail', 10),
(14, '2021_06_06_115046_create_order_detail', 11),
(16, '2021_06_06_115628_add_column_serial_in_order', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `total_price` text COLLATE utf8_unicode_ci,
  `delivery_date` text COLLATE utf8_unicode_ci,
  `delivery_form` text COLLATE utf8_unicode_ci,
  `status` enum('success','wait','cancel','fail') COLLATE utf8_unicode_ci DEFAULT 'wait',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serical` text COLLATE utf8_unicode_ci,
  `serial` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_id`, `address`, `total_price`, `delivery_date`, `delivery_form`, `status`, `created_at`, `updated_at`, `serical`, `serial`) VALUES
(18, 1, 'Hồng Ngự, Đồng tháp', NULL, '1623456000', NULL, 'wait', '2021-06-11 04:42:22', '2021-06-11 04:49:49', NULL, 'iDI5XAsMcv'),
(17, 1, 'Hồng Ngự, Đồng tháp', NULL, '1622937600', NULL, 'success', '2021-06-06 05:07:46', '2021-06-11 01:42:30', NULL, 'ILH288ClRy'),
(16, 1, 'Hồng Ngự, Đồng tháp', NULL, '1622937600', NULL, 'cancel', '2021-06-06 05:07:40', '2021-06-11 01:49:47', NULL, 'ojXergeSAj'),
(15, 1, 'Hồng Ngự, Đồng tháp', NULL, '1622937600', NULL, 'wait', '2021-06-06 05:07:18', '2021-06-06 05:07:18', NULL, 'dHH2e2qkAp'),
(14, 1, 'Hồng Ngự, Đồng tháp', NULL, '1622937600', NULL, 'wait', '2021-06-06 05:07:03', '2021-06-06 05:07:03', NULL, 'hgfULK1XCr'),
(13, 1, 'Hồng Ngự, Đồng tháp', NULL, '1622937600', NULL, 'wait', '2021-06-06 05:03:05', '2021-06-06 05:03:05', NULL, 'mPGStgnya8'),
(12, 1, 'Hồng Ngự, Đồng tháp', NULL, '1622937600', NULL, 'wait', '2021-06-06 05:02:14', '2021-06-06 05:02:14', NULL, 'MYrTBrlz5u');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` text COLLATE utf8_unicode_ci,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `created_at`, `updated_at`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(16, '2021-06-06 05:07:18', '2021-06-06 05:07:18', 15, 7, '190000', 1),
(15, '2021-06-06 05:07:18', '2021-06-06 05:07:18', 15, 6, '190000', 1),
(14, '2021-06-06 05:07:03', '2021-06-06 05:07:03', 14, 7, '190000', 1),
(13, '2021-06-06 05:07:03', '2021-06-06 05:07:03', 14, 6, '190000', 1),
(12, '2021-06-06 05:03:05', '2021-06-06 05:03:05', 13, 7, '190000', 1),
(11, '2021-06-06 05:03:05', '2021-06-06 05:03:05', 13, 6, '190000', 1),
(10, '2021-06-06 05:02:14', '2021-06-06 05:02:14', 9, 7, '190000', 1),
(9, '2021-06-06 05:02:14', '2021-06-06 05:02:14', 12, 6, '190000', 1),
(17, '2021-06-06 05:07:40', '2021-06-06 05:07:40', 16, 6, '190000', 1),
(18, '2021-06-06 05:07:40', '2021-06-06 05:07:40', 16, 7, '190000', 1),
(19, '2021-06-06 05:07:46', '2021-06-11 01:40:35', 17, 6, '190000', 10),
(20, '2021-06-06 05:07:46', '2021-06-11 01:40:35', 17, 7, '190000', 10),
(21, '2021-06-11 04:42:22', '2021-06-11 04:49:35', 18, 7, '190000', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `price_sale` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail` text COLLATE utf8_unicode_ci,
  `category_id_1` text COLLATE utf8_unicode_ci,
  `category_id_2` text COLLATE utf8_unicode_ci,
  `category_id_3` text COLLATE utf8_unicode_ci,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `specification` enum('Bin','Box','Piece','Pill') COLLATE utf8_unicode_ci DEFAULT 'Bin',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `price_sale`, `thumbnail`, `category_id_1`, `category_id_2`, `category_id_3`, `status`, `created_at`, `updated_at`, `quantity`, `specification`) VALUES
(6, 'Sản phẩm A', 190000, 190000, 'upload/product/4vl7_1.jpg', '20', '23', '24', '1', NULL, NULL, 11, 'Bin'),
(7, 'Sản phẩm B', 190000, 190000, 'upload/product/4vl7_1.jpg', '20', '23', '24', '1', NULL, NULL, 6, 'Bin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'quoctienphamm', 'quoctienphamm@gmail.com', NULL, '$2y$10$6/DCiwIfbFQHUqpeulgt0.R8ukvsymHivCJ/2gEPwy18Mm86JBFzG', NULL, '2021-05-23 08:36:32', '2021-05-31 04:58:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
