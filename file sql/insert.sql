-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2022 at 01:11 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Character Set Config
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `db_shop_laravel`
-- (Renamed from `db_toko_laravel`)

-- Table structure for `failed_jobs`
CREATE TABLE `failed_jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` LONGTEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `categories`
CREATE TABLE `categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `categories`
INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Smartphones', '2021-12-13 01:50:13', NULL, NULL),
(2, 'Laptops', '2021-12-13 01:51:21', NULL, NULL),
(3, 'Smartwatches', '2021-12-13 02:13:01', NULL, NULL),
(4, 'Headphones', '2021-12-13 02:13:16', NULL, NULL),
(5, 'Cameras', '2021-12-13 02:13:25', NULL, NULL),
(6, 'Gaming Consoles', '2021-12-13 02:13:30', NULL, NULL),
(7, 'Accessories', '2021-12-13 02:14:00', NULL, NULL);

-- Table structure for `migrations`
CREATE TABLE `migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Migrations data
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- Table structure for `password_resets`
CREATE TABLE `password_resets` (
  `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `personal_access_tokens`
CREATE TABLE `personal_access_tokens` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` VARCHAR(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `tokenable_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for `products`
CREATE TABLE `products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `product_name` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `price` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data for `products`
-- (Translations included in `product_name` and `description`)
INSERT INTO `products` (`id`, `category_id`, `image`, `product_name`, `description`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'samsung.jpg', 'Samsung Galaxy S22', 'Flagship smartphone with Dynamic AMOLED display and Snapdragon processor.', 68000, NOW(), NOW(), NULL),
(2, 2, 'asus.jpg', 'ASUS ROG Zephyrus G14', 'Powerful gaming laptop with Ryzen 9 CPU and RTX graphics.', 120000, NOW(), NOW(), NULL),
(3, 3, 'apple.jpg', 'Apple Watch Series 8', 'Smartwatch with health tracking and seamless iOS integration.', 52000, NOW(), NOW(), NULL),
(4, 4, 'sony.jpg', 'Sony WH-1000XM5', 'Industry-leading noise-canceling headphones with crisp sound.', 29500, NOW(), NOW(), NULL),
(5, 5, 'canon.jpg', 'Canon EOS M50 Mark II', 'Compact mirrorless camera with 4K video and dual-pixel AF.', 85000, NOW(), NOW(), NULL),
(6, 7, 'product_1643112115.jpg', 'Anker Power Bank 20000mAh', 'Fast-charging power bank with dual USB output.', 1900, NOW(), NOW(), NULL),
(7, 6, 'playstation.jpg', 'PlayStation 5', 'Latest Sony gaming console with ultra-fast SSD and immersive gaming.', 99000, NOW(), NOW(), NULL),
(8, 1, 'iphone.jpg', 'iPhone 14 Pro Max', 'Apple flagship with ProMotion display and powerful A16 chip.', 115000, NOW(), NOW(), NULL);

-- Table structure for `users`
CREATE TABLE `users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` VARCHAR(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` TEXT COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` VARCHAR(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User data
INSERT INTO `users` 
(`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) 
VALUES 
(1, 'Rishav', 'rishavraj4273@gmail.com', '8340112134', 'LPU, Phagwara', NULL, '$2y$10$izeDM6c/.WiL8W024xndXeWr3tLq9uz81dsDZVBF5zhx4F5FOHtJS', NULL, NOW(), NOW());


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
