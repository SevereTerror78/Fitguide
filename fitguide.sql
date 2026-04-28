-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Ápr 28. 16:20
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `fitguide`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL,
  `threshold` int(10) UNSIGNED DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `advices`
--

CREATE TABLE `advices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` enum('underweight','normal','overweight','obese') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `advices`
--

INSERT INTO `advices` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'underweight', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(2, 'normal', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(3, 'overweight', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(4, 'obese', '2026-03-24 20:39:12', '2026-03-24 20:39:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `discountCode` varchar(255) NOT NULL,
  `discountAmount` int(11) NOT NULL,
  `expiryDate` date DEFAULT NULL,
  `usedOrNot` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `discounts`
--

INSERT INTO `discounts` (`id`, `user_id`, `discountCode`, `discountAmount`, `expiryDate`, `usedOrNot`, `created_at`, `updated_at`) VALUES
(1, 1, 'WELCOME10', 10, '2026-09-24', 0, '2026-03-24 20:39:12', '2026-03-24 20:39:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `exercises`
--

CREATE TABLE `exercises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_hu` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `description_hu` text DEFAULT NULL,
  `video_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `name_hu`, `description`, `description_hu`, `video_url`, `created_at`, `updated_at`) VALUES
(1, 'Abs (Equipment)', 'Abs (eszközös)', 'Equipment exercise for Abdominal muscle', 'eszközös gyakorlat: Hasizom', 'videos/abs_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(2, 'Abs (Free)', 'Abs (szabad súlyos)', 'Free exercise for Abdominal muscle', 'szabad súlyos gyakorlat: Hasizom', 'videos/abs_free.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(3, 'Back (Equipment)', 'Back (eszközös)', 'Equipment exercise for Back muscle', 'eszközös gyakorlat: Hátizom', 'videos/back_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(4, 'Biceps (Equipment)', 'Biceps (eszközös)', 'Equipment exercise for Biceps', 'eszközös gyakorlat: Bicepsz', 'videos/biceps_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(5, 'Biceps (Free)', 'Biceps (szabad súlyos)', 'Free exercise for Biceps', 'szabad súlyos gyakorlat: Bicepsz', 'videos/biceps_free.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(6, 'Biceps (Free)', 'Biceps (szabad súlyos)', 'Free exercise for Biceps', 'szabad súlyos gyakorlat: Bicepsz', 'videos/biceps_free_meme.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(7, 'Butt (Equipment)', 'Butt (eszközös)', 'Equipment exercise for Buttock', 'eszközös gyakorlat: Farizom', 'videos/butt_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(8, 'Calf (Equipment)', 'Calf (eszközös)', 'Equipment exercise for Calf', 'eszközös gyakorlat: Vádli', 'videos/calf_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(9, 'Chest (Equipment)', 'Chest (eszközös)', 'Equipment exercise for Pectoral muscle', 'eszközös gyakorlat: Mellizom', 'videos/chest_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(10, 'Chest (Free)', 'Chest (szabad súlyos)', 'Free exercise for Pectoral muscle', 'szabad súlyos gyakorlat: Mellizom', 'videos/chest_free.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(11, 'Forearm (Equipment)', 'Forearm (eszközös)', 'Equipment exercise for Forearm', 'eszközös gyakorlat: Alkar', 'videos/forearm_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(12, 'Forearm (Free)', 'Forearm (szabad súlyos)', 'Free exercise for Forearm', 'szabad súlyos gyakorlat: Alkar', 'videos/forearm_free.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(13, 'Shoulder (Equipment)', 'Shoulder (eszközös)', 'Equipment exercise for Shoulder muscle', 'eszközös gyakorlat: Vállizom', 'videos/shoulder_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(14, 'Shoulder (Free)', 'Shoulder (szabad súlyos)', 'Free exercise for Shoulder muscle', 'szabad súlyos gyakorlat: Vállizom', 'videos/shoulder_free.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(15, 'Thigh (Equipment)', 'Thigh (eszközös)', 'Equipment exercise for Thigh', 'eszközös gyakorlat: Comb', 'videos/thigh_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(16, 'Triceps (Equipment)', 'Triceps (eszközös)', 'Equipment exercise for Triceps', 'eszközös gyakorlat: Tricepsz', 'videos/triceps_equipment.mp4', '2026-03-24 20:39:12', '2026-03-24 20:39:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `exercise_muscle`
--

CREATE TABLE `exercise_muscle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exercise_id` bigint(20) UNSIGNED NOT NULL,
  `muscle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `exercise_muscle`
--

INSERT INTO `exercise_muscle` (`id`, `exercise_id`, `muscle_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, NULL, NULL),
(2, 2, 7, NULL, NULL),
(3, 3, 5, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 10, NULL, NULL),
(8, 8, 9, NULL, NULL),
(9, 9, 4, NULL, NULL),
(10, 10, 4, NULL, NULL),
(11, 11, 3, NULL, NULL),
(12, 12, 3, NULL, NULL),
(13, 13, 6, NULL, NULL),
(14, 14, 6, NULL, NULL),
(15, 15, 8, NULL, NULL),
(16, 16, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `game`
--

CREATE TABLE `game` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `highScore` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(37, '0001_01_01_000000_create_users_table', 1),
(38, '0001_01_01_000001_create_cache_table', 1),
(39, '0001_01_01_000002_create_jobs_table', 1),
(40, '2025_08_16_112921_create_product_types_table', 1),
(41, '2025_08_16_202034_create_muscles_table', 1),
(42, '2025_08_16_202040_create_exercises_table', 1),
(43, '2025_08_16_202044_create_products_table', 1),
(44, '2025_08_16_202050_create_advices_table', 1),
(45, '2025_09_23_190852_create_orders_table', 1),
(46, '2025_09_23_190907_create_order_items_table', 1),
(47, '2025_09_29_112451_create_fitness_videos', 1),
(48, '2025_09_29_113050_create_discount', 1),
(49, '2025_09_29_120050_create_game', 1),
(50, '2025_11_27_080208_create_exercise_muscle_table', 1),
(51, '2025_12_04_104231_create_reward_shop_items_table', 1),
(52, '2025_12_04_104323_create_redeemed_rewards_table', 1),
(53, '2026_01_02_205237_create_stripe_webhook_events_table', 1),
(54, '2026_02_22_192525_create_admin_notifications', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `muscles`
--

CREATE TABLE `muscles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_hu` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `category` enum('arm','body','leg') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `muscles`
--

INSERT INTO `muscles` (`id`, `name`, `name_hu`, `slug`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Biceps', 'Bicepsz', 'biceps', 'arm', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(2, 'Triceps', 'Tricepsz', 'triceps', 'arm', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(3, 'Forearm', 'Alkar', 'forearm', 'arm', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(4, 'Pectoral muscle', 'Mellizom', 'pectoral', 'body', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(5, 'Back muscle', 'Hátizom', 'back_muscle', 'body', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(6, 'Shoulder muscle', 'Vállizom', 'vall', 'body', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(7, 'Abdominal muscle', 'Hasizom', 'abdominal_muscle', 'body', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(8, 'Thigh', 'Comb', 'thigh', 'leg', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(9, 'Calf', 'Vádli', 'calf', 'leg', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(10, 'Buttock', 'Farizom', 'buttock', 'leg', '2026-03-24 20:39:12', '2026-03-24 20:39:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'cart',
  `payment_method` varchar(20) NOT NULL DEFAULT 'card',
  `payment_status` varchar(20) NOT NULL DEFAULT 'unpaid',
  `fulfillment_status` varchar(30) NOT NULL DEFAULT 'new',
  `currency` varchar(3) NOT NULL DEFAULT 'EUR',
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `stripe_checkout_session_id` varchar(255) DEFAULT NULL,
  `stripe_payment_intent_id` varchar(255) DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_failed_at` timestamp NULL DEFAULT NULL,
  `payment_last_error` text DEFAULT NULL,
  `fulfilled_at` timestamp NULL DEFAULT NULL,
  `points_awarded` tinyint(1) NOT NULL DEFAULT 0,
  `points_awarded_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pickup_location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_items`
--

CREATE TABLE `order_items` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_hu` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `description_hu` text DEFAULT NULL,
  `price_huf` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 100,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `product_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `name`, `name_hu`, `description`, `description_hu`, `price_huf`, `image`, `stock`, `is_active`, `product_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Optimum Nutrition Gold Standard 100% Whey 2.27kg (Vanilla)', 'Optimum Nutrition Gold Standard 100% Whey 2,27 kg (Vanília)', 'Premium whey protein, fast absorption, ideal for post-workout recovery.', 'Prémium tejsavófehérje, gyors felszívódás, ideális edzés utáni regenerációhoz.', 28990, 'Optimum Nutrition Gold Standard 100% Whey 2.27kg (Vanilla).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(2, 'Optimum Nutrition Gold Standard 100% Whey 2.27kg (Chocolate)', 'Optimum Nutrition Gold Standard 100% Whey 2,27 kg (Csokoládé)', 'Classic chocolate flavored whey protein.', 'Klasszikus csokoládé ízű tejsavófehérje.', 28990, 'Optimum Nutrition Gold Standard 100% Whey 2.27kg (Chocolate).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(3, 'BioTechUSA Iso Whey Zero 2.27kg (Strawberry)', 'BioTechUSA Iso Whey Zero 2,27 kg (Eper)', 'Lactose-, gluten- and sugar-free whey isolate.', 'Laktóz-, glutén- és cukormentes tejsavó izolátum.', 31990, 'BioTechUSA Iso Whey Zero 2.27kg (Strawberry).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(4, 'Scitec 100% Whey Protein Professional 2.35kg (Banana)', 'Scitec 100% Whey Protein Professional 2,35 kg (Banán)', 'With added digestive enzymes.', 'Hozzáadott emésztőenzimekkel.', 27490, 'Scitec 100% Whey Protein Professional 2.35kg (Banana).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(5, 'Dymatize ISO100 Hydrolyzed 2.3kg (Cookies & Cream)', 'Dymatize ISO100 hidrolizált 2,3 kg (Keksz & Krém)', 'Hydrolyzed whey isolate for ultra-fast absorption.', 'Hidrolizált tejsavó izolátum az ultra-gyors felszívódásért.', 33990, 'Dymatize ISO100 Hydrolyzed 2.3kg (Cookies & Cream).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(6, 'MyProtein Impact Whey 2.5kg (Vanilla)', 'MyProtein Impact Whey 2,5 kg (Vanília)', 'Great value whey protein powder.', 'Kiváló ár-érték arányú tejsavófehérje por.', 24990, 'MyProtein Impact Whey 2.5kg (Vanilla).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(7, 'MyProtein Impact Whey 2.5kg (Salted Caramel)', 'MyProtein Impact Whey 2,5 kg (Sós karamell)', 'Salted caramel flavor, 21g protein per serving.', 'Sós karamell íz, adagonként 21 g fehérje.', 24990, 'MyProtein Impact Whey 2.5kg (Salted Caramel).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(8, 'Applied Nutrition Critical Whey 2kg (Chocolate)', 'Applied Nutrition Critical Whey 2 kg (Csokoládé)', 'Blend of concentrate, isolate and hydrolyzed whey.', 'Koncentrátum, izolátum és hidrolizált tejsavó keveréke.', 25990, 'Applied Nutrition Critical Whey 2kg (Chocolate).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(9, 'USN Blue Lab Whey 2kg (Strawberry)', 'USN Blue Lab Whey 2 kg (Eper)', '24g protein per serving, premium quality.', 'Adagonként 24 g fehérje, prémium minőség.', 27490, 'USN Blue Lab Whey 2kg (Strawberry).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(10, 'Rule1 R1 Whey Blend 2.3kg (Cookies & Cream)', 'Rule1 R1 Whey Blend 2,3 kg (Keksz & Krém)', 'Easy-mixing whey protein blend.', 'Könnyen keverhető tejsavófehérje keverék.', 28490, 'Rule1 R1 Whey Blend 2.3kg (Cookies & Cream).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(11, 'BioTechUSA Creatine Monohydrate 500g', 'BioTechUSA Kreatin-monohidrát 500 g', '100% micronized creatine monohydrate.', '100% mikronizált kreatin-monohidrát.', 7490, 'BioTechUSA Creatine Monohydrate 500g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(12, 'Scitec Creatine Monohydrate 300g', 'Scitec Kreatin-monohidrát 300 g', 'Classic creatine for strength and performance.', 'Klasszikus kreatin erő- és teljesítménynöveléshez.', 6990, 'Scitec Creatine Monohydrate 300g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(13, 'Creapure Creatine Monohydrate 500g', 'Creapure Kreatin-monohidrát 500 g', 'Pure German-made creatine monohydrate.', 'Tiszta, Németországban gyártott kreatin-monohidrát.', 8490, 'Creapure Creatine Monohydrate 500g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(14, 'MyProtein Creatine Monohydrate 500g', 'MyProtein Kreatin-monohidrát 500 g', '5g per serving, micronized formula.', 'Adagonként 5 g, mikronizált formula.', 6990, 'MyProtein Creatine Monohydrate 500g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(15, 'Optimum Nutrition Micronized Creatine 600g', 'Optimum Nutrition Mikronizált Kreatin 600 g', 'Fast-dissolving micronized creatine.', 'Gyorsan oldódó mikronizált kreatin.', 9490, 'Optimum Nutrition Micronized Creatine 600g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(16, 'BioTechUSA BCAA Zero 360g (Cola)', 'BioTechUSA BCAA Zero 360 g (Kóla)', '2:1:1 BCAA ratio, sugar-free.', '2:1:1 arányú BCAA, cukormentes.', 9990, 'BioTechUSA BCAA Zero 360g (Cola).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(17, 'Scitec BCAA Xpress 700g (Apple)', 'Scitec BCAA Xpress 700 g (Alma)', 'Large pack BCAA powder with apple flavor.', 'Nagy kiszerelésű BCAA por alma ízben.', 15490, 'Scitec BCAA Xpress 700g (Apple).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(18, 'Xtend BCAA 420g (Watermelon)', 'Xtend BCAA 420 g (Görögdinnye)', '7g BCAA per serving, zero sugar.', 'Adagonként 7 g BCAA, cukormentes.', 11490, 'Xtend BCAA 420g (Watermelon).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(19, 'Evlution Nutrition BCAA Energy 390g (Fruit Punch)', 'Evlution Nutrition BCAA Energy 390 g (Gyümölcs puncs)', 'BCAA with added energy complex.', 'BCAA hozzáadott energizáló komplexszel.', 12990, 'Evlution Nutrition BCAA Energy 390g (Fruit Punch).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(20, 'MyProtein Essential BCAA 2:1:1 500g (Unflavored)', 'MyProtein Essential BCAA 2:1:1 500 g (Ízesítetlen)', 'Classic unflavored BCAA powder.', 'Klasszikus, ízesítetlen BCAA por.', 10490, 'MyProtein Essential BCAA(Unflavored).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(21, 'Optimum Nutrition Gold Standard Pre-Workout 330g (Green Apple', 'Optimum Nutrition Gold Standard Edzés Előtti Formula 330 g (Zöld alma)', 'Caffeine, beta-alanine and citrulline mix.', 'Koffein, béta-alanin és citrullin keveréke.', 11990, 'Optimum Nutrition Gold Standard Pre-Workout 330g (Green Apple).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(22, 'BioTechUSA Black Blood NOX+ 330g (Cola)', 'BioTechUSA Black Blood NOX+ 330 g (Kóla)', 'Extra strong pre-workout booster.', 'Extra erős edzés előtti fokozó.', 12490, 'BioTechUSA Black Blood NOX.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(23, 'Scitec Hot Blood 3.0 375g (Orange)', 'Scitec Hot Blood 3.0 375 g (Narancs)', 'Creatine-based pre-workout complex.', 'Kreatin alapú edzés előtti komplex.', 10990, 'Scitec Hot Blood 3.0 375g (Orange).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(24, 'C4 Original Pre-Workout 390g (Icy Blue Razz)', 'C4 Original Edzés Előtti 390 g (Jeges kék málna)', 'World famous pre-workout formula.', 'Világhírű edzés előtti formula.', 13490, 'C4 Original Pre-Workout 390g (Icy Blue Razz).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(25, 'BSN N.O.-XPLODE 390g (Fruit Punch)', 'BSN N.O.-XPLODE 390 g (Gyümölcs puncs)', 'Legendary pre-workout booster.', 'Legendás edzés előtti teljesítményfokozó.', 12990, 'BSN N.O.-XPLODE 390g (Fruit Punch).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(26, 'Optimum Nutrition Serious Mass 5.4kg (Chocolate)', 'Optimum Nutrition Serious Mass 5,4 kg (Csokoládé)', 'Mass gainer with 1250 kcal per serving.', 'Tömegnövelő adagonként 1250 kcal értékkel.', 29990, 'Optimum Nutrition Serious Mass 5.4kg (Chocolate).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(27, 'Mutant Mass 6.8kg (Vanilla Ice Cream)', 'Mutant Mass 6,8 kg (Vanília fagylalt)', 'High calorie protein + carb gainer.', 'Magas kalóriatartalmú fehérje + szénhidrát tömegnövelő.', 31990, 'Mutant Mass 6.8kg (Vanilla Ice Cream).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(28, 'Dymatize Super Mass Gainer 5.4kg (Cookies & Cream)', 'Dymatize Super Mass Gainer 5,4 kg (Keksz & Krém)', 'High-calorie mass gainer powder.', 'Magas kalóriatartalmú tömegnövelő por.', 32990, 'Dymatize Super Mass Gainer 5.4kg (Cookies & Cream).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(29, 'Universal Nutrition Real Gains 4.8kg (Banana)', 'Universal Nutrition Real Gains 4,8 kg (Banán)', 'Premium quality gainer formula.', 'Prémium minőségű tömegnövelő formula.', 28490, 'Universal Nutrition Real Gains 4.8kg (Banana).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(30, 'MyProtein Weight Gainer Blend 5kg (Chocolate Smooth)', 'MyProtein Weight Gainer Blend 5 kg (Csokoládé krém)', 'Balanced protein-carb weight gainer.', 'Kiegyensúlyozott fehérje-szénhidrát arányú testsúlynövelő.', 26990, 'MyProtein Weight Gainer Blend 5kg (Chocolate Smooth).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(31, 'Animal Pak 44 packs', 'Animal Pak 44 csomag', 'Multivitamin pack designed for athletes.', 'Sportolóknak tervezett multivitamin csomag.', 17490, 'Animal Pak 44 packs.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(32, 'BioTechUSA Multivitamin for Men 60 tabs', 'BioTechUSA Multivitamin férfiaknak 60 tabletta', 'Daily multivitamin for men.', 'Napi multivitamin férfiaknak.', 5490, 'BioTechUSA Multivitamin for Men 60 tabs.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(33, 'Scitec Mega Daily One Plus 120 caps', 'Scitec Mega Daily One Plus 120 kapszula', 'Full spectrum daily vitamin complex.', 'Teljes spektrumú napi vitamin komplex.', 7990, 'Scitec Mega Daily One Plus 120 caps.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(34, 'Now Foods Daily Vits 100 tabs', 'Now Foods Daily Vits 100 tabletta', 'Daily multivitamin formula.', 'Napi multivitamin formula.', 6490, 'Now Foods Daily Vits 100 tabs.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(35, 'Centrum Women Multivitamin 60 tabs', 'Centrum Női Multivitamin 60 tabletta', 'Vitamin complex designed for women.', 'Nők számára tervezett vitamin komplex.', 5990, 'Centrum Women Multivitamin 60 tabs.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(36, 'Omega-3 Fish Oil 1000mg (200 caps)', 'Omega-3 halolaj 1000 mg (200 kapszula)', 'Supports heart and brain health.', 'Támogatja a szív- és agyműködést.', 6990, 'Omega-3 Fish Oil 1000mg (200 caps).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(37, 'BioTechUSA Omega 3 90 caps', 'BioTechUSA Omega 3 90 kapszula', 'EPA and DHA source.', 'EPA és DHA forrás.', 4990, 'BioTechUSA Omega 3 90 caps.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(38, 'Now Foods Omega-3 200 softgels', 'Now Foods Omega-3 200 lágyzselatin kapszula', 'High purity fish oil supplement.', 'Magas tisztaságú halolaj étrend-kiegészítő.', 8490, 'Now Foods Omega-3 200 softgels.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(39, 'Scitec Omega 3 100 caps', 'Scitec Omega 3 100 kapszula', 'Great value omega-3 fish oil.', 'Kiváló ár-érték arányú omega-3 halolaj.', 4490, 'Scitec Omega 3 100 caps.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(40, 'Nordic Naturals Ultimate Omega 60 caps', 'Nordic Naturals Ultimate Omega 60 kapszula', 'Premium quality omega-3 formula.', 'Prémium minőségű omega-3 formula.', 10490, 'Nordic Naturals Ultimate Omega 60 caps.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(41, 'Glucosamine Chondroitin MSM 180 tabs (Now Foods', 'Now Foods Glükózamin Kondroitin MSM 180 tabletta', 'Supports joint health and mobility.', 'Támogatja az ízületek egészségét és mozgékonyságát.', 11490, 'Glucosamine Chondroitin MSM 180 tabs (Now Foods).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(42, 'BioTechUSA Collagen Liquid 500ml (Peach)', 'BioTechUSA Kollagén folyékony 500 ml (Őszibarack)', 'Liquid collagen drink with hyaluronic acid.', 'Folyékony kollagén ital hialuronsavval.', 7990, 'BioTechUSA Collagen Liquid 500ml (Peach).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(43, 'Scitec Collagen Liquid 1000ml (Apple)', 'Scitec Kollagén folyékony 1000 ml (Alma)', 'Hydrolyzed collagen with added vitamins.', 'Hidrolizált kollagén hozzáadott vitaminokkal.', 9490, 'Scitec Collagen Liquid 1000ml (Apple).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(44, 'Now Foods Collagen Peptides Powder 200g', 'Now Foods Kollagén peptidek por 200 g', 'Collagen peptides powder for joints and skin.', 'Kollagén peptidek por ízületekhez és bőrhöz.', 8490, 'Now Foods Collagen Peptides Powder 200g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(45, 'MyProtein Collagen Powder 250g', 'MyProtein Kollagén por 250 g', 'Hydrolyzed collagen protein powder.', 'Hidrolizált kollagén fehérjepor.', 7490, 'MyProtein Collagen Powder 250g.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(46, 'BioTechUSA L-Carnitine 100000 Liquid 500ml (Pineapple)', 'BioTechUSA L-Karnitin 100000 folyékony 500 ml (Ananász)', 'Fat burner liquid with high L-carnitine dose.', 'Zsírégető folyadék magas L-karnitin dózissal.', 7990, 'BioTechUSA L-Carnitine 100000 Liquid 500ml (Pineapple).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(47, 'Now Foods L-Carnitine 500mg 60 caps', 'Now Foods L-Karnitin 500 mg 60 kapszula', 'Vegetarian capsule for energy support.', 'Vegetáriánus kapszula energiatámogatáshoz.', 9490, 'Now Foods L-Carnitine 500mg 60 caps.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(48, 'Applied Nutrition L-Carnitine 3000 Liquid 480ml (Cherry)', 'Applied Nutrition L-Karnitin 3000 folyékony 480 ml (Cseresznye)', 'Strong liquid L-carnitine formula.', 'Erős folyékony L-karnitin formula.', 8490, 'Applied Nutrition L-Carnitine 3000 Liquid 480ml (Cherry).png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(49, 'MyProtein L-Carnitine Amino 1000mg 180 tabs', 'MyProtein L-Karnitin Amino 1000 mg 180 tabletta', 'Supports energy metabolism during training.', 'Támogatja az energia-anyagcserét edzés közben.', 8490, 'MyProtein L-Carnitine Amino 500mg 180 tabs.png', 100, 1, 1, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(50, 'Adjustable Dumbbell 2×24kg Pair', 'Állítható kézisúlyzó 2×24 kg pár', 'Space-saving selectorized dumbbells up to 24kg each.', 'Helytakarékos, tárcsás állítható kézisúlyzók, akár 24 kg-ig darabonként.', 119900, 'Adjustable Dumbbell 2×24kg Pair.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(51, 'Adjustable Dumbbell 2×40kg Pair', 'Állítható kézisúlyzó 2×40 kg pár', 'Heavy selectorized dumbbells for advanced users.', 'Nehéz, tárcsás állítható kézisúlyzók haladóknak.', 189900, 'Adjustable Dumbbell 2×40kg Pair.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(52, 'Hex Dumbbell 10kg Pair', 'Hexa kézisúlyzó 10 kg pár', 'Rubber-coated hex dumbbells with ergonomic grip.', 'Gumiborítású hex kézisúlyzók ergonomikus fogással.', 24900, 'Hex Dumbbell 10kg Pair.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(53, 'Hex Dumbbell 20kg Pair', 'Hexa kézisúlyzó 20 kg pár', 'Durable rubber hex dumbbells for strength training.', 'Tartós gumiborítású hex kézisúlyzók erőedzéshez.', 49900, 'Hex Dumbbell 20kg Pair.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(54, 'Kettlebell 16kg', 'Kettlebell 16 kg', 'Cast-iron kettlebell with flat base.', 'Öntöttvas kettlebell lapos talppal.', 16900, 'Kettlebell 16kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(55, 'Kettlebell 24kg', 'Kettlebell 24 kg', 'Competition-style kettlebell with balanced handle.', 'Versenystílusú kettlebell kiegyensúlyozott fogantyúval.', 24900, 'Kettlebell 24kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(56, 'Olympic Barbell 20kg', 'Olimpiai rúd 20 kg', 'Standard Olympic barbell for men, 28 mm shaft.', 'Standard férfi olimpiai rúd, 28 mm-es markolattal.', 69900, 'Olympic Barbell 20kg (Men’s, 28 mm).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(57, 'Olympic Barbell 15kg', 'Olimpiai rúd 15 kg', 'Women’s Olympic barbell with 25 mm shaft.', 'Női olimpiai rúd 25 mm-es markolattal.', 64900, 'Olympic Barbell 15kg (Women’s, 25 mm).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(58, 'Bumper Plates 2×10kg', 'Bumper tárcsa 2×10 kg', 'Virgin rubber plates, low bounce, color-coded.', 'Szűz gumiból készült tárcsák, alacsony visszapattanással, színkódolt kivitelben.', 29900, 'Bumper Plates 2×10kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(59, 'Bumper Plates 2×20kg', 'Bumper tárcsa 2×20 kg', 'Durable plates for drops and WODs.', 'Tartós tárcsák ejtéshez és WOD edzésekhez.', 49900, 'Bumper Plates 2×20kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(60, 'Cast Iron Plates Set 2×5kg', 'Öntöttvas tárcsa szett 2×5 kg', 'Standard iron plates with 50 mm hole.', 'Standard vas tárcsák 50 mm-es furattal.', 9990, 'Cast Iron Plates Set 2×5kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(61, 'Spring Collars (Pair)', 'Rugós rögzítő (pár)', 'Quick spring barbell collars, 50 mm.', 'Gyors rugós rúdzár 50 mm-es rudakhoz.', 2490, 'Spring Collars (Pair).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(62, 'Lock-Jaw Collars (Pair)', 'Lock-Jaw rögzítő (pár)', 'Secure lock-jaw barbell collars.', 'Biztonságos lock-jaw rúdzár.', 5990, 'Lock-Jaw Collars (Pair).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(63, 'Flat Weight Bench', 'Lapos fekvenyomó pad', 'Heavy-duty flat bench rated up to 300kg.', 'Nagy teherbírású lapos pad, akár 300 kg terhelhetőséggel.', 39900, 'Flat Weight Bench.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(64, 'Adjustable Weight Bench (FID)', 'Állítható súlyzópad (FID)', 'Flat/Incline/Decline adjustable utility bench.', 'Lapos/Döntött/Hanyatt dönthető állítható edzőpad.', 79900, 'Adjustable Weight Bench (FID).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(65, 'Power Rack (Home)', 'Erőkeret (otthoni)', 'Full-size home power rack with J-cups and safety pins.', 'Teljes méretű otthoni erőkeret J-tartókkal és biztosító tüskékkel.', 159900, 'Power Rack (Home).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(66, 'Half Rack with Spotter Arms', 'Félkeret biztosító karokkal', 'Compact half rack with spotter arms.', 'Kompakt félkeret biztosító karokkal.', 119900, 'Half Rack with Spotter Arms.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(67, 'Squat Stands (Pair)', 'Guggoló állvány (pár)', 'Portable independent squat stands.', 'Hordozható, különálló guggoló állványok.', 59900, 'Squat Stands (Pair).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(68, 'Pull-Up Bar (Wall-Mounted)', 'Húzódzkodó rúd (falra szerelhető)', 'Wall-mounted pull-up bar with multi-grip design.', 'Falra szerelhető, többfogásos húzódzkodó rúd.', 19900, 'Pull-Up Bar (Wall-Mounted).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(69, 'Doorway Pull-Up Bar', 'Ajtókeretes húzódzkodó rúd', 'Tool-free doorway pull-up bar.', 'Szerszám nélkül rögzíthető ajtókeretes húzódzkodó rúd.', 9990, 'Doorway Pull-Up Bar.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(70, 'Dip Station (Stand-Alone)', 'Tolódzkodó állvány', 'Stable parallel bar dip station.', 'Stabil párhuzamos tolódzkodó állvány.', 39900, 'Dip Station (Stand-Alone).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(71, 'Power Tower', 'Power Tower', 'All-in-one tower for pull-ups, dips, and leg raises.', 'Minden az egyben torony húzódzkodáshoz, tolódzkodáshoz és lábemeléshez.', 89900, 'Power Tower.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(72, 'Adjustable Cable Pulley (Wall)', 'Állítható csigás lehúzó (falra)', 'Single-stack adjustable wall pulley system.', 'Egyoszlopos, állítható fali csigás rendszer.', 89900, 'Adjustable Cable Pulley (Wall).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(73, 'Lat Pulldown Machine', 'Széles hátlehúzó gép', 'Plate-loaded lat pulldown and low row combo.', 'Tárcsás terhelésű hátlehúzó és alsó evező kombináció.', 179900, 'Lat Pulldown.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(74, 'Landmine Attachment (Rack)', 'Landmine rögzítő (kerethez)', 'Rotating barbell attachment for landmine exercises.', 'Forgó rúdrögzítő landmine gyakorlatokhoz.', 14900, 'Landmine Attachment (Rack).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(75, 'T-Bar Row Handle', 'T-bar evező fogantyú', 'Parallel handle for T-bar rows.', 'Párhuzamos fogantyú T-rudas evezéshez.', 12900, 'T-Bar Row Handle.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(76, 'EZ Curl Bar (Olympic)', 'EZ rúd (olimpiai)', 'Olympic EZ curl bar with knurled grip.', 'Olimpiai EZ rúd recézett markolattal.', 24900, 'EZ Curl Bar (Olympic).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(77, 'Trap/Hex Bar (Olympic)', 'Trap/Hex rúd (olimpiai)', 'Hex trap bar for deadlifts and shrugs.', 'Hex (trap) rúd felhúzáshoz és vállvonogatáshoz.', 79900, 'Trap (Olympic).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(78, 'Weighted Vest 10kg', 'Súlymellény 10 kg', 'Adjustable 10kg weighted vest.', 'Állítható 10 kg-os súlymellény.', 24900, 'Weighted Vest 10kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(79, 'Weighted Vest 20kg', 'Súlymellény 20 kg', 'Adjustable 20kg weighted vest with removable plates.', 'Állítható 20 kg-os súlymellény kivehető súlylapokkal.', 39900, 'Weighted Vest 20kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(80, 'Resistance Bands Set (5)', 'Ellenállás szalag szett (5 db)', 'Set of 5 loop resistance bands from light to heavy.', '5 darabos, különböző erősségű gumiszalag szett.', 6990, 'Resistance Bands Set (5).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(81, 'Long Power Band (Medium)', 'Hosszú power band (közepes)', 'Medium tension long power band for mobility work.', 'Közepes ellenállású hosszú power band mobilizációhoz.', 5490, 'Long Power Band (Medium).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(82, 'Jump Rope (Bearing)', 'Ugrókötél (csapágyas)', 'Speed rope with ball bearings and adjustable length.', 'Csapágyas gyorsasági ugrókötél állítható hosszúsággal.', 4990, 'Jump Rope (Bearing).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(83, 'Battle Rope 12 m × 38 mm', 'Battle rope 12 m × 38 mm', '12m battle rope for conditioning workouts.', '12 m-es battle rope kondicionáló edzésekhez.', 34900, 'Battle Rope 12 m × 38 mm.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(84, 'Medicine Ball 6kg', 'Medicinal labda 6 kg', 'Textured-grip medicine ball for wall throws.', 'Texturált fogású medicinlabda falra dobáshoz.', 14900, 'Medicine Ball 6kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(85, 'Wall Ball 9kg', 'Wall ball 9 kg', 'Soft-shell wall ball for target training.', 'Puha borítású wall ball célzott edzéshez.', 24900, 'Wall Ball 9kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(86, 'Slam Ball 15kg', 'Slam labda 15 kg', 'No-bounce slam ball for explosive power training.', 'Nem pattogó slam labda robbanékony erőfejlesztéshez.', 19900, 'Slam Ball 15kg.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(87, 'Ab Wheel', 'Hasgörgő', 'Dual-wheel ab roller for core strength.', 'Dupla kerekes haskerék törzserősítéshez.', 4490, 'Ab Wheel.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(88, 'Sit-Up/Ab Bench', 'Felülőpad', 'Adjustable decline sit-up and ab bench.', 'Állítható dőlésszögű felülő- és haspad.', 49900, 'Ab Bench.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(89, 'Roman Chair/Back Extension', 'Római szék / hátfeszítő pad', '45-degree Roman chair for back extensions.', '45 fokos római szék hátfeszítéshez.', 59900, 'Roman Chair.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(90, 'Foam Roller 33 cm', 'Habhenger 33 cm', 'High-density EVA foam roller with grid texture.', 'Nagy sűrűségű EVA habhenger rácsos mintázattal.', 6490, 'Foam Roller 33 cm (Hollow Core).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(91, 'Yoga Mat 6 mm (TPE)', 'Jógaszőnyeg 6 mm (TPE)', 'Non-slip TPE yoga mat, 6 mm thick.', 'Csúszásmentes TPE jógaszőnyeg, 6 mm vastag.', 7490, 'Yoga Mat 6 mm (TPE).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(92, 'Plyometric Box (3-in-1, Wood)', 'Plyo doboz (3 az 1-ben, fa)', 'Wooden 3-in-1 plyometric jump box (50/60/75cm).', 'Fa 3 az 1-ben plyo ugródoboz (50/60/75 cm).', 29900, 'Plyometric Box (3-in-1, Wood).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(93, 'Adjustable Aerobic Step', 'Állítható aerobic step pad', 'Height-adjustable aerobic step platform.', 'Magasságban állítható aerobic step pad.', 14900, 'Adjustable Aerobic Step.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(94, 'Rowing Machine', 'Evezőgép', 'Foldable air + magnetic resistance rowing machine.', 'Összecsukható lég- és mágneses ellenállású evezőgép.', 199900, 'Rowing Machine.png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(95, 'Exercise Bike (Magnetic)', 'Szobakerékpár (mágneses)', 'Magnetic upright exercise bike with pulse sensors.', 'Mágneses szobakerékpár pulzusmérő szenzorokkal.', 119900, 'Exercise Bike (Magnetic).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(96, 'Treadmill (Foldable, 2.5 HP)', 'Futópad (összecsukható, 2,5 LE)', 'Foldable treadmill with 2.5 HP motor and programs.', 'Összecsukható futópad 2,5 LE motorral és programokkal.', 279900, 'Treadmill (Foldable, 2.5 HP).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(97, 'Elliptical Trainer (Magnetic)', 'Ellipszis tréner (mágneses)', 'Silent magnetic elliptical trainer with 8 levels.', 'Csendes mágneses ellipszis tréner 8 fokozattal.', 169900, 'Elliptical Trainer (Magnetic).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(98, 'Adjustable Parallel Bars (Parallettes)', 'Állítható párhuzamos korlát (parallettes)', 'Steel mini-parallettes for push-ups and dips.', 'Acél mini parallettes fekvőtámaszhoz és tolódzkodáshoz.', 19900, 'Adjustable Parallel Bars (Parallettes).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(99, 'Weight Plate Tree (Olympic)', 'Súlytárcsa tartó állvány (olimpiai)', 'Vertical Olympic plate tree with barbell holders.', 'Függőleges olimpiai súlytárcsa tartó rúdtartókkal.', 39900, 'Weight Plate Tree (Olympic).png', 100, 1, 3, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(100, 'FitGuide Performance T-Shirt (Men, Black)', 'FitGuide Performance póló (Férfi, fekete)', 'Lightweight moisture-wicking training shirt with logo on chest.', 'Könnyű, nedvességelvezető edzőpóló mellkasi logóval.', 7990, 'FitGuide Performance T-Shirt (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(101, 'FitGuide Performance T-Shirt (Women, White)', 'FitGuide Performance póló (Női, fehér)', 'Soft-touch, breathable tee with fitted cut.', 'Puha tapintású, légáteresztő, karcsúsított szabású póló.', 7990, 'FitGuide Performance T-Shirt (Women, White).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(102, 'FitGuide Oversized T-Shirt (Unisex, Grey)', 'FitGuide Oversized póló (Uniszex, szürke)', 'Relaxed fit cotton shirt with bold FitGuide print.', 'Laza szabású pamut póló feltűnő FitGuide mintával.', 8490, 'FitGuide Oversized T-Shirt (Unisex, Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(103, 'FitGuide Classic Tank Top (Men, Black)', 'FitGuide Klasszikus trikó (Férfi, fekete)', 'Sleeveless tank with racerback cut.', 'Ujjatlan trikó racerback szabással.', 6990, 'FitGuide Classic Tank Top (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(104, 'FitGuide Racerback Tank (Women, Turquoise)', 'FitGuide Racerback trikó (Női, türkiz)', 'Stretch-fit tank top with logo on side seam.', 'Rugalmas szabású trikó oldalsó logóval.', 6990, 'FitGuide Racerback Tank (Women, Turquoise).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(105, 'FitGuide Long Sleeve Tech Shirt (Black)', 'FitGuide Hosszú ujjú technikai felső (fekete)', 'DryFit long sleeve for all-season workouts.', 'DryFit hosszú ujjú felső egész éves edzésekhez.', 9490, 'FitGuide Long Sleeve Tech Shirt (Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(106, 'FitGuide Zip Hoodie', 'FitGuide Cipzáras kapucnis pulóver', 'Premium cotton-poly blend, front zip and logo on chest.', 'Prémium pamut–poliészter keverék, elöl cipzárral és mellkasi logóval.', 15990, 'FitGuide Zip Hoodie.png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(107, 'FitGuide Pullover Hoodie (Grey)', 'FitGuide Bebújós kapucnis pulóver (szürke)', 'Soft fleece hoodie with kangaroo pocket.', 'Puha polár kapucnis pulóver kenguruzsebbel.', 14990, 'FitGuide Pullover Hoodie (Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(108, 'FitGuide Crop Hoodie (Women, White)', 'FitGuide Rövid fazonú kapucnis pulóver (Női, fehér)', 'Stylish cropped hoodie with FitGuide logo.', 'Stílusos rövid fazonú kapucnis pulóver FitGuide logóval.', 13990, 'FitGuide Crop Hoodie (Women, White).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(109, 'FitGuide Joggers (Men, Black)', 'FitGuide Melegítőnadrág (Férfi, fekete)', 'Slim-fit stretch joggers, printed logo on thigh.', 'Karcsúsított, rugalmas melegítőnadrág, combon nyomott logóval.', 12990, 'FitGuide Joggers (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(110, 'FitGuide Joggers (Women, Turquoise)', 'FitGuide Melegítőnadrág (Női, türkiz)', 'High-waisted comfort joggers with embroidered logo.', 'Magas derekú kényelmes melegítőnadrág hímzett logóval.', 12990, 'FitGuide Joggers (Women, Turquoise).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(111, 'FitGuide Shorts (Men, Grey)', 'FitGuide Rövidnadrág (Férfi, szürke)', 'Lightweight training shorts, breathable mesh.', 'Könnyű edző rövidnadrág légáteresztő hálós anyaggal.', 8490, 'FitGuide Shorts (Men, Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(112, 'FitGuide Shorts (Women, Black)', 'FitGuide Rövidnadrág (Női, fekete)', 'Stretch shorts with elastic waistband and logo.', 'Rugalmas rövidnadrág gumis derékkal és logóval.', 8490, 'FitGuide Shorts (Women, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(113, 'FitGuide Leggings (Women, Black High Waist)', 'FitGuide Leggings (Női, fekete, magas derekú)', 'Seamless compression leggings with contour seams.', 'Varrásmentes kompressziós leggings formázó varrásokkal.', 11990, 'FitGuide Leggings (Women, Black High Waist).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(114, 'FitGuide Leggings (Women, Turquoise)', 'FitGuide Leggings (Női, türkiz)', 'Breathable performance leggings, squat-proof.', 'Légáteresztő performance leggings, guggolásbiztos anyagból.', 11990, 'FitGuide Leggings (Women, Turquoise).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(115, 'FitGuide Sports Bra (Black)', 'FitGuide Sportmelltartó (fekete)', 'Medium support bra, cross-back straps.', 'Közepes tartást adó sportmelltartó keresztezett pántokkal.', 8490, 'FitGuide Sports Bra (Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(116, 'FitGuide Sports Bra (White)', 'FitGuide Sportmelltartó (fehér)', 'Seamless support with soft padding.', 'Varrásmentes kialakítás puha párnázással.', 8490, 'FitGuide Sports Bra (White).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(117, 'FitGuide Windbreaker Jacket (Unisex, Black)', 'FitGuide Széldzseki (Uniszex, fekete)', 'Lightweight water-repellent windbreaker.', 'Könnyű, vízlepergető széldzseki.', 15490, 'FitGuide Windbreaker Jacket (Unisex, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(118, 'FitGuide Puffer Vest (Men, Black)', 'FitGuide Bélelt mellény (Férfi, fekete)', 'Insulated sleeveless vest for cold training days.', 'Bélelt ujjatlan mellény hideg edzésnapokra.', 17490, 'FitGuide Puffer Vest (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(119, 'FitGuide Track Jacket (Women, Turquoise)', 'FitGuide Melegítő felső (Női, türkiz)', 'Full-zip sporty jacket with white stripes.', 'Teljes cipzáras sportdzseki fehér csíkokkal.', 14990, 'FitGuide Track Jacket (Women, Turquoise).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(120, 'FitGuide Socks (3-Pack, Black)', 'FitGuide Zokni 3 db-os csomag (fekete)', 'Cushioned athletic socks with logo band.', 'Párnázott sportzokni logós szárrésszel.', 3490, 'FitGuide Socks (3-Pack, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(121, 'FitGuide Socks (3-Pack, White)', 'FitGuide Zokni 3 db-os csomag (fehér)', 'Breathable cotton-blend socks.', 'Légáteresztő pamutkeverék zokni.', 3490, 'FitGuide Socks (3-Pack, White).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(122, 'FitGuide Baseball Cap (Black)', 'FitGuide Baseball sapka (fekete)', 'Adjustable curved-brim cap with embroidered logo.', 'Állítható, ívelt sildes sapka hímzett logóval.', 5490, 'FitGuide Baseball Cap (Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(123, 'FitGuide Snapback Hat (Turquoise Logo)', 'FitGuide Snapback sapka (türkiz logó)', 'Flat visor snapback with embroidered front.', 'Egyenes sildes snapback sapka hímzett előlappal.', 5990, 'FitGuide Snapback Hat (Turquoise Logo).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(124, 'FitGuide Beanie (Winter Knit, Grey)', 'FitGuide Kötött téli sapka (szürke)', 'Warm knit beanie with subtle logo tag.', 'Meleg kötött sapka visszafogott logó címkével.', 4990, 'FitGuide Beanie (Winter Knit, Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(125, 'FitGuide Gym Gloves (Black)', 'FitGuide Edzőkesztyű (fekete)', 'Padded palm gloves for training comfort.', 'Párnázott tenyerű kesztyű a kényelmes edzésért.', 6490, 'FitGuide Gym Gloves (Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(126, 'FitGuide Training Belt (Neoprene)', 'FitGuide Edzőöv (neoprén)', 'Lightweight support belt for lifting.', 'Könnyű tartást biztosító emelőöv.', 9490, 'FitGuide Training Belt (Neoprene).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(127, 'FitGuide Headband (Turquoise)', 'FitGuide Fejpánt (türkiz)', 'Sweat-wicking elastic headband.', 'Izzadságelvezető rugalmas fejpánt.', 2490, 'FitGuide Headband (Turquoise).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(128, 'FitGuide Wristbands (Pair, Black)', 'FitGuide Csuklópánt (pár, fekete)', 'Cotton stretch wristbands with logo.', 'Rugalmas pamut csuklópánt logóval.', 1990, 'FitGuide Wristbands (Pair, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(129, 'FitGuide Gym Towel (Small, 50×100cm)', 'FitGuide Edzőtörölköző kicsi (50×100 cm)', 'Quick-dry microfiber towel for workouts.', 'Gyorsan száradó mikroszálas edzőtörölköző.', 3990, 'FitGuide Gym Towel (Small, 50×100cm).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(130, 'FitGuide Gym Towel (Large, 70×140cm)', 'FitGuide Edzőtörölköző nagy (70×140 cm)', 'Bath-size microfiber towel with logo.', 'Fürdőméretű mikroszálas törölköző logóval.', 5490, 'FitGuide Gym Towel (Large, 70×140cm).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(131, 'FitGuide Drawstring Bag (Black)', 'FitGuide Zsinóros tornazsák (fekete)', 'Compact gym bag with printed logo.', 'Kompakt sporttáska nyomott logóval.', 3990, 'FitGuide Drawstring Bag (Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(132, 'FitGuide Backpack (Performance)', 'FitGuide Hátizsák (Performance)', 'Multi-compartment training backpack.', 'Több rekeszes edző hátizsák.', 12990, 'FitGuide Backpack (Performance).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(133, 'FitGuide Compression Shirt (Men, Black)', 'FitGuide Kompressziós felső (Férfi, fekete)', 'Tight-fit compression shirt for performance.', 'Testhezálló kompressziós felső a teljesítményért.', 9990, 'FitGuide Compression Shirt (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(134, 'FitGuide Compression Shorts (Men, Black)', 'FitGuide Kompressziós rövidnadrág (Férfi, fekete)', 'Moisture-wicking base layer shorts.', 'Nedvességelvezető aláöltözet rövidnadrág.', 8490, 'FitGuide Compression Shorts (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(135, 'FitGuide Seamless Set (Women, Turquoise)', 'FitGuide Seamless szett (Női, türkiz)', 'Leggings + sports bra seamless combo.', 'Leggings + sportmelltartó varrásmentes szett.', 18990, 'FitGuide Seamless Set (Women, Turquoise).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(136, 'FitGuide Crop Top (Women, Black)', 'FitGuide Crop top (Női, fekete)', 'Short sleeve crop with logo print.', 'Rövid ujjú crop felső logó mintával.', 6990, 'FitGuide Crop Top (Women, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(137, 'FitGuide Oversized Hoodie (Unisex, Beige)', 'FitGuide Oversized kapucnis pulóver (Uniszex, bézs)', 'Streetwear-inspired oversized hoodie.', 'Utcai stílus ihlette oversized kapucnis pulóver.', 15490, 'FitGuide Oversized Hoodie (Unisex, Beige).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(138, 'FitGuide Sleeveless Hoodie (Men, Grey)', 'FitGuide Ujjatlan kapucnis pulóver (Férfi, szürke)', 'Gym-style sleeveless hoodie for layering.', 'Edzőtermi stílusú ujjatlan kapucnis pulóver rétegezéshez.', 12490, 'FitGuide Sleeveless Hoodie (Men, Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(139, 'FitGuide Training Shorts (Compression, Men)', 'FitGuide Edző rövidnadrág (kompressziós, férfi)', 'Underlayer compression shorts.', 'Kompressziós aláöltözet rövidnadrág.', 7990, 'FitGuide Training Shorts (Compression, Men).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(140, 'FitGuide Urban Joggers (Men, Beige)', 'FitGuide Urban melegítőnadrág (Férfi, bézs)', 'Casual tapered joggers with drawstring.', 'Laza, szűkülő szárú melegítőnadrág húzózsinórral.', 11990, 'FitGuide Urban Joggers (Men, Beige).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(141, 'FitGuide Cargo Joggers (Women, Olive)', 'FitGuide Cargo melegítőnadrág (Női, olívazöld)', 'Utility style joggers with pockets.', 'Praktikus stílusú melegítőnadrág zsebekkel.', 12490, 'FitGuide Cargo Joggers (Women, Olive).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(142, 'FitGuide Reflective Running Jacket', 'FitGuide Fényvisszaverő futókabát', 'Lightweight reflective shell jacket.', 'Könnyű, fényvisszaverő héjkabát.', 16990, 'FitGuide Reflective Running Jacket.png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(143, 'FitGuide Mesh Training Shorts (Men, White)', 'FitGuide Hálós edző rövidnadrág (Férfi, fehér)', 'Breathable mesh shorts for cardio.', 'Légáteresztő hálós rövidnadrág kardió edzésekhez.', 8490, 'FitGuide Mesh Training Shorts (Men, White).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(144, 'FitGuide Thermal Leggings (Women, Black)', 'FitGuide Thermo leggings (Női, fekete)', 'Fleece-lined leggings for outdoor workouts.', 'Polár bélelésű leggings szabadtéri edzésekhez.', 12990, 'FitGuide Thermal Leggings (Women, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(145, 'FitGuide Polo Shirt (Men, Black)', 'FitGuide Galléros póló (Férfi, fekete)', 'Smart casual polo with embroidered logo.', 'Sportosan elegáns galléros póló hímzett logóval.', 9490, 'FitGuide Polo Shirt (Men, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(146, 'FitGuide Padded Jacket (Unisex, Black)', 'FitGuide Bélelt kabát (Uniszex, fekete)', 'Warm insulated jacket for winter training.', 'Meleg, bélelt kabát téli edzésekhez.', 22990, 'FitGuide Padded Jacket (Unisex, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(147, 'FitGuide Yoga Pants (Women, Grey)', 'FitGuide Jóganadrág (Női, szürke)', 'Soft stretch yoga pants with logo print.', 'Puha, rugalmas jóganadrág logó mintával.', 10990, 'FitGuide Yoga Pants (Women, Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(148, 'FitGuide Lounge Shorts (Unisex, Black)', 'FitGuide Szabadidős rövidnadrág (Uniszex, fekete)', 'Cotton-blend shorts for casual wear.', 'Pamutkeverék rövidnadrág hétköznapi viseletre.', 7490, 'FitGuide Lounge Shorts (Unisex, Black).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(149, 'FitGuide Athletic Tee (Performance Grey)', 'FitGuide Sport póló (Performance szürke)', 'Breathable DryFit tee with mesh panels.', 'Légáteresztő DryFit póló hálós betétekkel.', 8490, 'FitGuide Athletic Tee (Performance Grey).png', 100, 1, 4, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(150, 'Jack Link’s Beef Jerky Original 70g', 'Jack Link’s Beef Jerky Original 70 g (Eredeti)', 'High protein, low fat beef jerky, perfect on-the-go snack.', 'Magas fehérjetartalmú, alacsony zsírtartalmú marhaszárított hús, tökéletes útközbeni snack.', 1990, 'Jack Link’s Beef Jerky Original 70g.png', 100, 1, 2, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(151, 'Jack Link’s Beef Jerky Teriyaki 70g', 'Jack Link’s Beef Jerky Teriyaki 70 g', 'Sweet and savory teriyaki flavored jerky.', 'Édes-sós teriyaki ízű marhaszárított hús.', 1990, 'Jack Link’s Beef Jerky Teriyaki 70g.png', 100, 1, 2, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(152, 'Jack Link’s Beef Jerky Sweet & Hot 70g', 'Jack Link’s Beef Jerky Sweet & Hot 70 g (Édes-csípős)', 'Spicy-sweet beef jerky with chili kick.', 'Csípős-édes marhaszárított hús chili ízesítéssel.', 1990, 'Jack Link’s Beef Jerky Sweet & Hot 70g.png', 100, 1, 2, '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(153, 'Jack Link’s Beef Jerky BBQ 70g', 'Jack Link’s Beef Jerky BBQ 70 g', 'Smoky BBQ flavored jerky, high in protein.', 'Füstös BBQ ízű, magas fehérjetartalmú marhaszárított hús.', 1990, 'Jack Link’s Beef Jerky BBQ 70g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(154, 'Jack Link’s Beef Jerky Peppered 70g', 'Jack Link’s Beef Jerky Peppered 70 g (Borsos)', 'Black pepper seasoned jerky for bold taste.', 'Fekete borssal fűszerezett marhaszárított hús az intenzív ízért.', 1990, 'Jack Link’s Beef Jerky Peppered 70g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(155, 'Rice Up Brown Rice Chips (Sea Salt) 60g', 'Rice Up barna rizs chips (Tengeri só) 60 g', 'Whole grain rice chips with sour cream & onion flavor.', 'Teljes kiőrlésű rizschips tejfölös-hagymás ízben.', 359, 'Rice Up Brown Rice Chips (Sea Salt) 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(156, 'Fropro High Protein Vegan Chips 40g (BBQ)', 'Fropro magas fehérjetartalmú vegán chips 40 g (BBQ)', 'Vegan protein chips.', 'Vegán fehérje chips.', 359, 'Fropro High Protein Vegan Chips 40g (BBQ).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(157, 'Foody Free Lentil Chips Salted 50g', 'Foody Free lencse chips sózott 50 g', 'Lentil-based chips.', 'Lencsealapú chips.', 349, 'Foody Free Lentil Chips Salted 50g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(158, 'Foody Free Hummus Chips Beetroot 50g', 'Foody Free hummusz chips céklás 50 g', 'Beetroot hummus chips.', 'Céklás hummusz chips.', 329, 'Foody Free Hummus Chips Beetroot 50g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(159, 'Vital Hummus Chips Yogurt & Herb 60g', 'Vital hummusz chips joghurt & fűszernövény 60 g', 'Yogurt & herb chickpea chips.', 'Joghurtos-fűszernövényes csicseriborsó chips.', 320, 'Vital Hummus Chips Yogurt & Herb 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(160, 'Hester’s Life Very Berry Granola 300g', 'Hester’s Life Very Berry granola 300 g', 'Berry granola mix.', 'Bogyós gyümölcsös granola keverék.', 840, 'Hester’s Life Very Berry Granola 300g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(161, 'Quest Protein Chips (Sour Cream & Onion) 32g', 'Quest Protein Chips (Tejföl & hagyma) 32 g', '19g protein chips.', '19 g fehérjét tartalmazó chips.', 563, 'Quest Protein Chips (Sour Cream & Onion) 32g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(162, 'Quest Protein Chips (BBQ) 32g', 'Quest Protein Chips (BBQ) 32 g', 'High protein BBQ crisps.', 'Magas fehérjetartalmú BBQ chips.', 1190, 'Quest Protein Chips (BBQ) 32g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(163, 'Barebells Protein Bar (Caramel Cashew) 55g', 'Barebells Protein szelet (Karamell–kesudió) 55 g', '20g protein bar.', '20 g fehérjét tartalmazó szelet.', 1190, 'Barebells Protein Bar (Caramel Cashew) 55g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(164, 'Barebells Protein Bar (Cookies & Cream) 55g', 'Barebells Protein szelet (Keksz & krém) 55 g', 'Creamy protein bar.', 'Krémes protein szelet.', 890, 'Barebells Protein Bar (Cookies & Cream) 55g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(165, 'Grenade Carb Killa Bar (Chocolate Chip Cookie Dough) 60g', 'Grenade Carb Killa szelet (Csokis süti tészta) 60 g', 'Low sugar protein bar.', 'Alacsony cukortartalmú protein szelet.', 890, 'Grenade Carb Killa Bar (Chocolate Chip Cookie Dough) 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(166, 'Grenade Carb Killa Bar (White Chocolate Salted Peanut) 60g', 'Grenade Carb Killa szelet (Fehér csoki sós mogyoró) 60 g', 'High protein bar.', 'Magas fehérjetartalmú szelet.', 1090, 'Grenade Carb Killa Bar (White Chocolate Salted Peanut) 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(167, 'MyProtein Protein Brownie 75g (Chocolate)', 'MyProtein Protein brownie 75 g (Csokoládé)', 'Brownie with protein.', 'Fehérjével dúsított brownie.', 1090, 'MyProtein Protein Brownie 75g (Chocolate).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(168, 'MyProtein Protein Cookie 75g (Double Chocolate)', 'MyProtein Protein cookie 75 g (Dupla csokoládé)', 'Protein cookie.', 'Protein keksz.', 690, 'MyProtein Protein Cookie 75g (Double Chocolate).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(169, 'Fulfil Vitamin & Protein Bar (Salted Caramel) 55g', 'Fulfil Vitamin & Protein szelet (Sós karamell) 55 g', 'Protein bar with added vitamins.', 'Vitaminokkal dúsított protein szelet.', 690, 'Fulfil Vitamin & Protein Bar (Salted Caramel) 55g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(170, 'Fulfil Vitamin & Protein Bar (Chocolate Peanut Butter) 55g', 'Fulfil Vitamin & Protein szelet (Csokis mogyoróvaj) 55 g', 'Peanut butter protein snack.', 'Mogyoróvajas protein snack.', 890, 'Fulfil Vitamin & Protein Bar (Chocolate Peanut Butter) 55g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(171, 'Mars Hi-Protein Bar 59g', 'Mars Hi-Protein szelet 59 g', 'Protein version of classic Mars.', 'A klasszikus Mars protein változata.', 890, 'Mars Hi-Protein Bar 59g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(172, 'Snickers Hi-Protein Bar 62g', 'Snickers Hi-Protein szelet 62 g', 'Protein Snickers bar.', 'Protein Snickers szelet.', 890, 'Snickers Hi-Protein Bar 62g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(173, 'Bounty Hi-Protein Bar 52g', 'Bounty Hi-Protein szelet 52 g', 'Protein-packed coconut bar.', 'Fehérjében gazdag kókuszos szelet.', 890, 'Bounty Hi-Protein Bar 52g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(174, 'KitKat Chunky Protein 60g', 'KitKat Chunky Protein 60 g', 'Protein KitKat.', 'Protein KitKat szelet.', 890, 'KitKat Chunky Protein 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(175, 'Rice up Oat Bar (Apple & Cinnamon) 60g', 'Rice Up zab szelet (Alma & fahéj) 60 g', 'Oat-based protein bar.', 'Zabalapú protein szelet.', 650, 'Rice up Protein Oat Bar (Apple & Cinnamon) 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(176, 'Rice up Protein Oat Bar (Chocolate) 60g', 'Rice Up Protein zab szelet (Csokoládé) 60 g', 'Oat and chocolate protein bar.', 'Zab és csokoládé protein szelet.', 650, 'Rice up Protein Oat Bar (Chocolate) 60g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(177, 'Nutrend Excelent Protein Bar 85g (Coconut)', 'Nutrend Excelent Protein szelet 85 g (Kókusz)', 'Czech premium protein bar.', 'Cseh prémium protein szelet.', 790, 'Nutrend Excelent Protein Bar 85g (Coconut).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(178, 'Nutrend Excelent Protein Bar 85g (Blackcurrant)', 'Nutrend Excelent Protein szelet 85 g (Feketeribizli)', 'Blackcurrant protein bar.', 'Feketeribizlis protein szelet.', 790, 'Nutrend Excelent Protein Bar 85g (Blackcurrant).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(179, 'Clif Bar Chocolate Chip 68g', 'Clif Bar (Csokidarabos) 68 g', 'Energy bar with oats.', 'Zabos energiaszelet.', 690, 'Clif Bar Chocolate Chip 68g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(180, 'Clif Bar Peanut Butter Crunch 68g', 'Clif Bar (Mogyoróvajas ropogós) 68 g', 'Classic oat energy bar.', 'Klasszikus zabos energiaszelet.', 690, 'Clif Bar Peanut Butter Crunch 68g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(181, 'Nakd Bar (Cocoa Orange) 35g', 'Nakd szelet (Kakaó–narancs) 35 g', 'Raw fruit & nut bar.', 'Nyers gyümölcs- és magalapú szelet.', 390, 'Nakd Bar (Cocoa Orange) 35g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(182, 'Nakd Bar (Blueberry Muffin) 35g', 'Nakd szelet (Áfonyás muffin) 35 g', 'Raw vegan snack.', 'Nyers vegán snack.', 390, 'Nakd Bar (Blueberry Muffin) 35g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12');
INSERT INTO `products` (`id`, `name`, `name_hu`, `description`, `description_hu`, `price_huf`, `image`, `stock`, `is_active`, `product_type_id`, `created_at`, `updated_at`) VALUES
(183, 'Eat Natural Protein Packed Bar 50g', 'Eat Natural Protein Packed szelet 50 g', 'Simple natural protein bar.', 'Egyszerű, természetes protein szelet.', 490, 'Eat Natural Protein Packed Bar 50g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(184, 'Eat Natural Almond & Apricot Bar 50g', 'Eat Natural Mandula & sárgabarack szelet 50 g', 'Fruit & nut snack bar.', 'Gyümölcsös-magos snack szelet.', 490, 'Eat Natural Almond & Apricot Bar 50g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(185, 'Nature Valley Crunchy Oats & Honey 42g', 'Nature Valley ropogós zab & méz 42 g', 'Wholegrain oat bars.', 'Teljes kiőrlésű zab szeletek.', 290, 'Nature Valley Crunchy Oats & Honey 42g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(186, 'Nature Valley Protein Peanut & Chocolate 40g', 'Nature Valley Protein mogyoró & csokoládé 40 g', 'Protein oat bar.', 'Fehérjés zab szelet.', 390, 'Nature Valley Protein Peanut & Chocolate 40g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(187, 'RXBAR Chocolate Sea Salt 52g', 'RXBAR Csokoládé tengeri só 52 g', 'Whole food protein bar.', 'Teljes értékű alapanyagokból készült protein szelet.', 790, 'RXBAR Chocolate Sea Salt 52g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(188, 'RXBAR Peanut Butter 52g', 'RXBAR Mogyoróvaj 52 g', 'Minimal ingredient protein bar.', 'Minimális összetevős protein szelet.', 790, 'RXBAR Peanut Butter 52g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(189, 'Lenny & Larry’s The Complete Cookie (Chocolate Chip) 113g', 'Lenny & Larry’s The Complete Cookie (Csokidarabos) 113 g', 'Vegan protein cookie.', 'Vegán protein keksz.', 890, 'Lenny & Larry’s The Complete Cookie (Chocolate Chip) 113g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(190, 'Lenny & Larry’s The Complete Cookie (Birthday Cake) 113g', 'Lenny & Larry’s The Complete Cookie (Születésnapi torta) 113 g', 'Big vegan cookie.', 'Nagy méretű vegán keksz.', 890, 'Lenny & Larry’s The Complete Cookie (Birthday Cake) 113g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(191, 'Skippy Peanut Butter Protein Balls 120g', 'Skippy mogyoróvajas protein golyók 120 g', 'Peanut butter snack balls.', 'Mogyoróvajas snack golyók.', 990, 'Skippy Peanut Butter Protein Balls 120g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(192, 'Prozis Protein Choco Muffin 90g', 'Prozis Protein csokis muffin 90 g', 'Protein muffin snack.', 'Protein muffin snack.', 690, 'Prozis Protein Choco Muffin 90g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(193, 'Nutlove Protein Pralines Hazelnut 150g', 'Nutlove Protein praliné mogyoró 150 g', 'Chocolate protein pralines.', 'Csokoládés protein praliné.', 1290, 'Nutlove Protein Pralines Hazelnut 150g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(194, 'Body&Fit Smart Protein Chips 40g (Sweet Chili)', 'Body&Fit Smart Protein chips 40 g (Édes chili)', 'High protein chips.', 'Magas fehérjetartalmú chips.', 590, 'Body&Fit Smart Protein Chips 40g (Sweet Chili).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(195, 'Body&Fit Smart Wafers 35g (white chocolate cookie)', 'Body&Fit Smart ostya 35 g (Fehér csokis süti)', 'Protein wafers.', 'Protein ostya.', 490, 'Body&Fit Smart Wafers 35g (White Chocolate Cookie).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(196, 'Protein Works Protein Popcorn 50g (Caramel)', 'Protein Works Protein popcorn 50 g (Karamell)', 'Protein caramel popcorn.', 'Fehérjés karamellás popcorn.', 890, 'Protein Works Protein Popcorn 50g (Caramel).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(197, 'AllNutrition Nutlove Crispy Rolls 140g', 'AllNutrition Nutlove ropogós tekercs 140 g', 'Protein wafer rolls.', 'Fehérjés ostyarudak.', 990, 'AllNutrition Nutlove Crispy Rolls 140g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(198, 'BioTechUSA Protein Bar (Double Chocolate)', 'BioTechUSA Protein szelet (Dupla csokoládé)', 'BioTech protein bar.', 'BioTech protein szelet.', 890, 'BioTechUSA Protein Bar (Double Chocolate).png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(199, 'BioTechUSA Protein Bar (Raspberry) 70g', 'BioTechUSA Protein szelet (Málna) 70 g', 'Dessert-style protein bar.', 'Desszert jellegű protein szelet.', 890, 'BioTechUSA Protein Bar (Raspberry) 70g.png', 100, 1, 2, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(200, 'FitGuide Shaker Bottle 700ml (Black)', 'FitGuide Shaker 700 ml (fekete)', 'Durable BPA-free shaker bottle with metal mixing ball.', 'Tartós, BPA-mentes shaker fém keverőgolyóval.', 2490, 'FitGuide Shaker Bottle 700ml (Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(201, 'FitGuide Shaker Bottle 700ml (White)', 'FitGuide Shaker 700 ml (fehér)', 'Matte white shaker with secure flip-top lid.', 'Matt fehér shaker biztonságos felhajtható kupakkal.', 2490, 'FitGuide Shaker Bottle 700ml (White).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(202, 'FitGuide Stainless Steel Bottle 1L (Silver)', 'FitGuide Rozsdamentes acél kulacs 1 L (ezüst)', 'Double-wall stainless steel bottle keeps drinks cold for 24h.', 'Duplafalú rozsdamentes acél palack, amely 24 órán át hidegen tartja az italt.', 5990, 'FitGuide Stainless Steel Bottle 1L (Silver).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(203, 'FitGuide Stainless Steel Bottle 1L (Black)', 'FitGuide Rozsdamentes acél kulacs 1 L (fekete)', 'Black insulated bottle with leak-proof cap.', 'Fekete, szigetelt palack szivárgásmentes kupakkal.', 5990, 'FitGuide Stainless Steel Bottle 1L (Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(204, 'FitGuide Water Jug 2.2L (Smoke Grey)', 'FitGuide Vizes kanna 2,2 L (füstszürke)', '2.2L water jug with integrated handle and screw-on lid.', '2,2 literes víztartály beépített fogantyúval és csavaros fedéllel.', 4990, 'FitGuide Water Jug 2.2L (Smoke Grey).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(205, 'FitGuide Meal Prep Box (3 Compartments)', 'FitGuide Ételtároló doboz (3 rekeszes)', '3-compartment BPA-free food container for meal prep.', '3 rekeszes, BPA-mentes ételtároló doboz meal prephez.', 2990, 'FitGuide Meal Prep Box (3 Compartments).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(206, 'FitGuide Meal Prep Bag (With Ice Packs)', 'FitGuide Ételtartó táska (jégakkuval)', 'Insulated meal prep bag with ice packs and strap.', 'Szigetelt ételtartó táska jégakkuval és vállpánttal.', 8990, 'FitGuide Meal Prep Bag (With Ice Packs).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(207, 'FitGuide Resistance Band Set (5 Levels)', 'FitGuide Ellenállás szalag szett (5 erősség)', 'Set of 5 latex resistance bands from light to extra heavy.', '5 darabos latex ellenállás szalag szett a könnyűtől az extra erősig.', 6490, 'FitGuide Resistance Band Set (5 Levels).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(208, 'FitGuide Power Band (Heavy)', 'FitGuide Power band (erős)', 'Heavy-duty resistance band for power training.', 'Erős kivitelű ellenállás szalag erőedzéshez.', 4490, 'FitGuide Power Band (Heavy).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(209, 'FitGuide Ankle Straps (Pair, Black)', 'FitGuide Bokapánt (pár, fekete)', 'Adjustable ankle straps with D-rings for cable workouts.', 'Állítható bokapántok D-gyűrűkkel csigás gyakorlatokhoz.', 3490, 'FitGuide Ankle Straps (Pair, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(210, 'FitGuide Jump Rope (Adjustable Steel Cable)', 'FitGuide Ugrókötél (állítható acél kábel)', 'Adjustable steel cable jump rope for speed training.', 'Állítható acélkábeles ugrókötél gyorsasági edzéshez.', 3990, 'FitGuide Jump Rope (Adjustable Steel Cable).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(211, 'FitGuide Yoga Strap (2m, Turquoise)', 'FitGuide Jóga heveder (2 m, türkiz)', 'Durable cotton yoga strap for stretching exercises.', 'Tartós pamut jóga heveder nyújtó gyakorlatokhoz.', 2490, 'FitGuide Yoga Strap (2m, Turquoise).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(212, 'FitGuide Yoga Block (Foam, Black)', 'FitGuide Jóga tégla (hab, fekete)', 'Non-slip EVA foam yoga block for support and balance.', 'Csúszásmentes EVA hab jóga tégla a stabilitásért.', 2990, 'FitGuide Yoga Block (Foam, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(213, 'FitGuide Foam Roller Mini (25cm, Black)', 'FitGuide Mini habhenger (25 cm, fekete)', 'Compact foam roller for recovery and travel use.', 'Kompakt habhenger regenerációhoz és utazáshoz.', 4490, 'FitGuide Foam Roller Mini (25cm, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(214, 'FitGuide Massage Ball (Hard, Black)', 'FitGuide Masszázslabda (kemény, fekete)', 'Hard massage ball for deep tissue release.', 'Kemény masszázslabda mélyszöveti lazításhoz.', 2490, 'FitGuide Massage Ball (Hard, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(215, 'FitGuide Massage Gun (Pro Series)', 'FitGuide Masszázspisztoly (Pro széria)', 'Professional percussion massage gun with multiple heads.', 'Professzionális ütőfejes masszázspisztoly több fejjel.', 29900, 'FitGuide Massage Gun (Pro Series).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(216, 'FitGuide Massage Gun Mini (Portable)', 'FitGuide Mini masszázspisztoly (hordozható)', 'Compact mini massage gun for portability.', 'Kompakt mini masszázspisztoly hordozható kivitelben.', 19900, 'FitGuide Massage Gun Mini (Portable).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(217, 'FitGuide Gym Belt (Leather)', 'FitGuide Edzőöv (bőr)', 'Genuine leather gym belt for strong back support.', 'Valódi bőr edzőöv erős deréktámaszhoz.', 12490, 'FitGuide Gym Belt (Leather).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(218, 'FitGuide Gym Belt (Neoprene)', 'FitGuide Edzőöv (neoprén)', 'Lightweight neoprene lifting belt for comfort.', 'Könnyű neoprén emelőöv a kényelemért.', 8990, 'FitGuide Gym Belt (Neoprene).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(219, 'FitGuide Lifting Straps (Pair, Black)', 'FitGuide Emelő heveder (pár, fekete)', 'Heavy-duty cotton lifting straps for better grip.', 'Erős pamut emelőheveder a jobb fogásért.', 3990, 'FitGuide Lifting Straps (Pair, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(220, 'FitGuide Wrist Wraps (Pair, Black)', 'FitGuide Csuklószorító (pár, fekete)', 'Elastic wrist wraps for lifting stability.', 'Rugalmas csuklószorító stabilitásért emelés közben.', 4990, 'FitGuide Wrist Wraps (Pair, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(221, 'FitGuide Knee Wraps', 'FitGuide Térdszorító (pár, piros/fekete)', 'Supportive knee wraps for squats and leg press.', 'Támogató térdszorító guggoláshoz és lábtolóhoz.', 6490, 'FitGuide Knee Wraps.png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(222, 'FitGuide Weight Lifting Hooks (Pair)', 'FitGuide Emelő kampó (pár)', 'Steel hook grips for heavy lifts and deadlifts.', 'Acél kampós fogássegítő nehéz emelésekhez és felhúzáshoz.', 6990, 'FitGuide Weight Lifting Hooks (Pair).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(223, 'FitGuide Grip Pads (Pair)', 'FitGuide Markolat párna (pár)', 'Non-slip grip pads for pull-ups and presses.', 'Csúszásmentes markolatpárna húzódzkodáshoz és nyomásokhoz.', 3490, 'FitGuide Grip Pads (Pair).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(224, 'FitGuide Training Gloves (Gel Padded)', 'FitGuide Edzőkesztyű (gél párnázott)', 'Breathable gloves with gel padding for extra comfort.', 'Légáteresztő kesztyű gél párnázással a nagyobb kényelemért.', 6490, 'FitGuide Training Gloves (Gel Padded).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(225, 'FitGuide Gym Bag (Black)', 'FitGuide Sporttáska (fekete)', 'Durable gym bag with shoe compartment and logo print.', 'Tartós sporttáska cipőtartó rekesszel és logó nyomattal.', 9990, 'FitGuide Gym Bag (Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(226, 'FitGuide Duffel Bag (Large, Grey)', 'FitGuide Utazótáska (nagy, szürke)', 'Extra-large duffel bag with separate wet pocket.', 'Extra nagy utazótáska külön nedves rekesszel.', 12990, 'FitGuide Duffel Bag (Large, Grey).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(227, 'FitGuide Backpack (Compact, Black)', 'FitGuide Hátizsák (kompakt, fekete)', 'Compact training backpack with padded straps.', 'Kompakt edző hátizsák párnázott vállpántokkal.', 8490, 'FitGuide Backpack (Compact, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(228, 'FitGuide Drawstring Bag (Logo Print)', 'FitGuide Zsinóros tornazsák (logós)', 'Drawstring bag with FitGuide logo print.', 'Zsinóros tornazsák FitGuide logóval.', 3490, 'FitGuide Drawstring Bag (Logo Print).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(229, 'FitGuide Microfiber Towel (Small)', 'FitGuide Mikroszálas törölköző (kicsi)', 'Soft small microfiber towel for gym workouts.', 'Puha, kis méretű mikroszálas törölköző edzéshez.', 5490, 'FitGuide Microfiber Towel (Small).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(230, 'FitGuide Microfiber Towel (Large)', 'FitGuide Mikroszálas törölköző (nagy)', 'Large microfiber towel ideal for post-shower use.', 'Nagy mikroszálas törölköző zuhanyzás utáni használatra.', 2490, 'FitGuide Microfiber Towel (Large).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(231, 'FitGuide Sweat Headband (Black)', 'FitGuide Izzadság felszívó fejpánt (fekete)', 'Sweat-absorbing stretch headband for workouts.', 'Izzadságfelszívó rugalmas fejpánt edzésekhez.', 1990, 'FitGuide Sweat Headband (Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(232, 'FitGuide Wristband (Logo, White)', 'FitGuide Csuklópánt (logós, fehér)', 'Elastic wristband with embroidered FitGuide logo.', 'Rugalmas csuklópánt hímzett FitGuide logóval.', 5490, 'FitGuide Wristband (Logo, White).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(233, 'FitGuide Cap (Logo, Black)', 'FitGuide Sapka (logós, fekete)', 'Curved-brim cap with embroidered FitGuide logo.', 'Ívelt sildes sapka hímzett FitGuide logóval.', 5990, 'FitGuide Cap (Logo, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(234, 'FitGuide Snapback Cap (Flat Brim, Grey)', 'FitGuide Snapback sapka (egyenes karimás, szürke)', 'Flat-brim snapback with structured crown.', 'Egyenes sildes snapback strukturált kialakítással.', 4990, 'FitGuide Snapback Cap (Flat Brim, Grey).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(235, 'FitGuide Beanie (Winter Knit, Black)', 'FitGuide Kötött sapka (téli, fekete)', 'Winter beanie made from soft knit material.', 'Puha kötött anyagból készült téli sapka.', 6490, 'FitGuide Beanie (Winter Knit, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(236, 'FitGuide Sunglasses (Sport Style)', 'FitGuide Sport napszemüveg', 'Lightweight UV-protection sport sunglasses.', 'Könnyű, UV-védelemmel ellátott sport napszemüveg.', 5490, 'FitGuide Sunglasses (Sport Style).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(237, 'FitGuide Phone Armband (Running)', 'FitGuide Telefon karpánt (futáshoz)', 'Phone armband with touchscreen window and key slot.', 'Telefontartó karpánt érintőképernyős ablakkal és kulcstartó zsebbel.', 3490, 'FitGuide Phone Armband (Running).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(238, 'FitGuide Smartwatch Band (Silicone, Black)', 'FitGuide Okosóra szíj (szilikon, fekete)', 'Black silicone smartwatch band, breathable and flexible.', 'Fekete szilikon okosóra szíj, légáteresztő és rugalmas.', 2990, 'FitGuide Smartwatch Band (Silicone, Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(239, 'FitGuide Water Bottle Holder (Neoprene)', 'FitGuide Kulacstartó (neoprén)', 'Insulated neoprene holder for standard bottles.', 'Szigetelt neoprén tartó standard kulacsokhoz.', 1490, 'FitGuide Water Bottle Holder (Neoprene).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(240, 'FitGuide Keychain (Logo Metal Tag)', 'FitGuide Kulcstartó (fém logó)', 'Metal keychain with engraved FitGuide logo tag.', 'Fém kulcstartó gravírozott FitGuide logóval.', 1490, 'FitGuide Keychain (Logo Metal Tag).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(241, 'FitGuide Lanyard (Black)', 'FitGuide Nyakpánt (fekete)', 'Durable black lanyard with printed FitGuide logo.', 'Tartós fekete nyakpánt nyomott FitGuide logóval.', 2990, 'FitGuide Lanyard (Black).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(242, 'FitGuide Gym Notebook (Workout Log)', 'FitGuide Edzőnapló (Workout Log)', 'Workout notebook for tracking sets and progress.', 'Edzésnapló a sorozatok és fejlődés követéséhez.', 1290, 'FitGuide Gym Notebook (Workout Log).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(243, 'FitGuide Pen (Logo Print)', 'FitGuide Toll (logós)', 'Smooth ballpoint pen with FitGuide logo print.', 'Sima golyóstoll FitGuide logó nyomattal.', 1490, 'FitGuide Pen (Logo Print).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(244, 'FitGuide Sticker Pack (10pcs)', 'FitGuide Matrica csomag (10 db)', 'Sticker set including 10 FitGuide-themed decals.', '10 darabos FitGuide témájú matrica szett.', 3490, 'FitGuide Sticker Pack (10pcs).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(245, 'FitGuide Shoe Bag (Black Mesh)', 'FitGuide Cipőtartó zsák (fekete hálós)', 'Mesh shoe bag for storage and ventilation.', 'Hálós cipőtartó zsák tároláshoz és szellőzéshez.', 2490, 'FitGuide Shoe Bag (Black Mesh).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(246, 'FitGuide Cable Organizer (Gym Bag Insert)', 'FitGuide Kábel rendszerező (sporttáskához)', 'Cable organizer insert to keep gym bag tidy.', 'Kábelrendező betét a sporttáska rendszerezéséhez.', 1990, 'FitGuide Cable Organizer (Gym Bag Insert).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(247, 'FitGuide Locker Padlock (Combination)', 'FitGuide Öltöző lakat (számzáras)', 'Combination padlock for locker or gym bag.', 'Számzáras lakat öltözőszekrényhez vagy sporttáskához.', 2990, 'FitGuide Locker Padlock (Combination).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(248, 'FitGuide Waist Pouch (Running Belt)', 'FitGuide Deréktáska (futóöv)', 'Running belt waist pouch with adjustable strap.', 'Futóöv deréktáska állítható pánttal.', 3490, 'FitGuide Waist Pouch (Running Belt).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(249, 'FitGuide Earbuds Case (Protective Hard Shell)', 'FitGuide Fülhallgató tok (kemény védőtok)', 'Protective hard case for wireless earbuds.', 'Kemény védőtok vezeték nélküli fülhallgatóhoz.', 2990, 'FitGuide Earbuds Case (Protective Hard Shell).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(250, 'FitGuide Cooling Towel (Blue)', 'FitGuide Hűsítő törölköző (kék)', 'Cooling towel that activates instantly when wet.', 'Hűsítő törölköző, amely víz hatására azonnal aktiválódik.', 2990, 'FitGuide Cooling Towel (Blue).png', 100, 1, 5, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(251, 'FitGuide Starter Pack', 'FitGuide Kezdő csomag', 'Perfect beginner’s package including shaker, towel, and resistance bands.', 'Tökéletes kezdőcsomag shakerrel, törölközővel és gumiszalagokkal.', 12990, 'FitGuide starter pack.png', 100, 1, 6, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(252, 'FitGuide Protein Bundle', 'FitGuide Protein csomag', 'High-protein combo pack with whey, protein bar, and shaker bottle.', 'Magas fehérjetartalmú kombinált csomag tejsavóval, protein szelettel és shakerrel.', 24990, 'FitGuide Protein Bundle.png', 100, 1, 6, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(253, 'FitGuide Athlete Gift Box', 'FitGuide Sportolói ajándékdoboz', 'Premium gift box with apparel, accessories, and FitGuide logo packaging.', 'Prémium ajándékdoboz ruházattal, kiegészítőkkel és FitGuide logós csomagolással.', 29990, 'FitGuide Athlete Gift Box.png', 100, 1, 6, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(254, 'FitGuide Gym Essentials Kit', 'FitGuide Edzőtermi alapcsomag', 'Daily essentials kit with gym towel, wristbands, and bottle.', 'Mindennapi alapcsomag edzőtörölközővel, csuklópántokkal és kulaccsal.', 14990, 'FitGuide Gym Essentials Kit.png', 100, 1, 6, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(255, 'FitGuide Deluxe Fitness Package', 'FitGuide Deluxe fitness csomag', 'Complete fitness bundle with hoodie, supplements, and gym bag.', 'Teljes fitness csomag kapucnis pulóverrel, étrend-kiegészítőkkel és sporttáskával.', 39990, 'FitGuide Deluxe Fitness Package.png', 100, 1, 6, '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(256, 'FitGuide Digital Gift Card', 'FitGuide Digitális ajándékkártya', 'Digital gift card usable across all FitGuide products and categories.', 'Digitális ajándékkártya, amely minden FitGuide termékre és kategóriára felhasználható.', 10000, 'FitGuide Digital Gift Card.png', 100, 1, 6, '2026-03-24 20:39:12', '2026-03-24 20:39:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_hu` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `name_hu`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Supplements', 'Kiegészítők', 'supplements', '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(2, 'Snacks', 'Snackek', 'snacks', '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(3, 'Equipment', 'Felszerelés', 'equipment', '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(4, 'Clothing', 'Ruházat', 'clothing', '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(5, 'Accessories', 'Kiegészítők', 'accessories', '2026-03-24 20:39:11', '2026-03-24 20:39:11'),
(6, 'Packages & Gift', 'Csomagok & Ajándék', 'packages-gift', '2026-03-24 20:39:11', '2026-03-24 20:39:11');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `redeemed_rewards`
--

CREATE TABLE `redeemed_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reward_shop_item_id` bigint(20) UNSIGNED NOT NULL,
  `points_spent` int(11) NOT NULL,
  `status` enum('pending','granted') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reward_shop_items`
--

CREATE TABLE `reward_shop_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `required_points` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `reward_shop_items`
--

INSERT INTO `reward_shop_items` (`id`, `name`, `description`, `required_points`, `image`, `created_at`, `updated_at`) VALUES
(1, '5% Discount Coupon', '5% off your next purchase', 200, 'images/discount5.png', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(2, '10% Discount Coupon', '10% off your next purchase', 500, 'images/discount10.png', '2026-03-24 20:39:12', '2026-03-24 20:39:12'),
(3, '20% Discount Coupon', '20% off your next purchase', 900, 'images/discount20.png', '2026-03-24 20:39:12', '2026-03-24 20:39:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `stripe_webhook_events`
--

CREATE TABLE `stripe_webhook_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `language` varchar(5) NOT NULL DEFAULT 'hu',
  `theme` varchar(20) NOT NULL DEFAULT 'dark',
  `currency` varchar(5) NOT NULL DEFAULT 'HUF',
  `phone` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `first_login_bonus_claimed` tinyint(1) NOT NULL DEFAULT 0,
  `profile_bonus_claimed` tinyint(1) NOT NULL DEFAULT 0,
  `first_login_bonus_claimed_at` timestamp NULL DEFAULT NULL,
  `profile_bonus_claimed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `language`, `theme`, `currency`, `phone`, `dob`, `gender`, `points`, `first_login_bonus_claimed`, `profile_bonus_claimed`, `first_login_bonus_claimed_at`, `profile_bonus_claimed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@fitguide.com', '2026-03-24 20:39:08', '$2y$12$ReRLzRRTOmK2O41JUAm8zekFaFkWNBK88M0wFovLM0E3M5svwOFsK', 'admin', 'hu', 'dark', 'HUF', NULL, NULL, NULL, 75, 0, 0, NULL, NULL, NULL, '2026-03-24 20:39:08', '2026-03-24 20:39:08');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_notifications_type_read_at_index` (`type`,`read_at`),
  ADD KEY `admin_notifications_product_id_index` (`product_id`);

--
-- A tábla indexei `advices`
--
ALTER TABLE `advices`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discounts_discountcode_unique` (`discountCode`),
  ADD KEY `discounts_user_id_foreign` (`user_id`);

--
-- A tábla indexei `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exercise_muscle_exercise_id_muscle_id_unique` (`exercise_id`,`muscle_id`),
  ADD KEY `exercise_muscle_muscle_id_foreign` (`muscle_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `muscles`
--
ALTER TABLE `muscles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `muscles_name_unique` (`name`),
  ADD UNIQUE KEY `muscles_slug_unique` (`slug`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_payment_method_index` (`payment_method`),
  ADD KEY `orders_payment_status_index` (`payment_status`),
  ADD KEY `orders_fulfillment_status_index` (`fulfillment_status`),
  ADD KEY `orders_stripe_checkout_session_id_index` (`stripe_checkout_session_id`),
  ADD KEY `orders_stripe_payment_intent_id_index` (`stripe_payment_intent_id`),
  ADD KEY `orders_fulfilled_at_index` (`fulfilled_at`),
  ADD KEY `orders_pickup_location_index` (`pickup_location`);

--
-- A tábla indexei `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_type_id_foreign` (`product_type_id`);

--
-- A tábla indexei `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_types_name_unique` (`name`),
  ADD UNIQUE KEY `product_types_slug_unique` (`slug`);

--
-- A tábla indexei `redeemed_rewards`
--
ALTER TABLE `redeemed_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `redeemed_rewards_user_id_foreign` (`user_id`),
  ADD KEY `redeemed_rewards_reward_shop_item_id_foreign` (`reward_shop_item_id`);

--
-- A tábla indexei `reward_shop_items`
--
ALTER TABLE `reward_shop_items`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `stripe_webhook_events`
--
ALTER TABLE `stripe_webhook_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stripe_webhook_events_event_id_unique` (`event_id`),
  ADD KEY `stripe_webhook_events_order_id_foreign` (`order_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `advices`
--
ALTER TABLE `advices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT a táblához `muscles`
--
ALTER TABLE `muscles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT a táblához `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `redeemed_rewards`
--
ALTER TABLE `redeemed_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `reward_shop_items`
--
ALTER TABLE `reward_shop_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `stripe_webhook_events`
--
ALTER TABLE `stripe_webhook_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  ADD CONSTRAINT `exercise_muscle_exercise_id_foreign` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercise_muscle_muscle_id_foreign` FOREIGN KEY (`muscle_id`) REFERENCES `muscles` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `redeemed_rewards`
--
ALTER TABLE `redeemed_rewards`
  ADD CONSTRAINT `redeemed_rewards_reward_shop_item_id_foreign` FOREIGN KEY (`reward_shop_item_id`) REFERENCES `reward_shop_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `redeemed_rewards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `stripe_webhook_events`
--
ALTER TABLE `stripe_webhook_events`
  ADD CONSTRAINT `stripe_webhook_events_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
