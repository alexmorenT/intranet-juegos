-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2026 a las 15:32:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intranet_juegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('intranet-arcade-cache-test@example.com|127.0.0.1', 'i:1;', 1779786301),
('intranet-arcade-cache-test@example.com|127.0.0.1:timer', 'i:1779786301;', 1779786301),
('laravel-cache-tes@example.com|192.168.0.10', 'i:1;', 1775648320),
('laravel-cache-tes@example.com|192.168.0.10:timer', 'i:1775648320;', 1775648320),
('laravel-cache-test@examplee.com|127.0.0.1', 'i:1;', 1775729413),
('laravel-cache-test@examplee.com|127.0.0.1:timer', 'i:1775729413;', 1775729413);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Desarrollo', '2026-03-17 11:59:59', '2026-03-17 11:59:59'),
(2, 'Marketing', '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(3, 'Ventas', '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(4, 'Recursos Humanos', '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(5, 'Finanzas', '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(6, 'Atención al Cliente', '2026-04-28 10:45:57', '2026-04-28 10:45:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `frames`
--

CREATE TABLE `frames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `frames`
--

INSERT INTO `frames` (`id`, `name`, `image_path`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'NOVATO DE ARCADE', 'frames/frame-1.png', 0, 'El marco estándar para los nuevos reclutas del Arcade.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(2, 'JEFE DE ZONA', 'frames/frame-2.png', 500, 'Solo para aquellos que dominan el Wordle a la primera.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(3, 'MECANÓGRAFO PROFESIONAL', 'frames/frame-3.png', 1000, 'El marco para los que TypeSpeed es su segundo idioma.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(4, 'FUEGO INFERNAL', 'frames/frame-4.png', 1500, 'Para los que BombParty es un paseo.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(5, 'DIOS COMPETITIVO', 'frames/frame-5.png', 1750, 'Sólo los expertos en todos los juegos pueden obtenerlo.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(6, 'ESTADÍSTICAS RADIOACTIVAS', 'frames/frame-6.png', 2050, 'Exclusivo para los adictos a las estadísticas.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(7, 'DESIERTO DE MONEDAS', 'frames/frame-7.png', 2500, 'Para los que coleccionan monedas en el Arcade.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(8, 'MAGO DEL ARCADE', 'frames/frame-8.png', 2850, 'Quienes dominan el mundo del Arcade.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(9, 'SUPERESTRELLA', 'frames/frame-9.png', 3200, 'Marco para los jugadores estrellas del Arcade.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(10, 'ESMERALDA CELESTIAL', 'frames/frame-10.png', 3750, 'Jugadores que alcanzan la excelencia.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(11, 'HIELO INCESANTE', 'frames/frame-11.png', 4350, 'Para quienes tienen una mente fría y calculadora.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(12, 'RACHA INFERNAL', 'frames/frame-12.png', 4950, 'Si la racha es lo tuyo, este es tu marco.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(13, 'IMPARABLE', 'frames/frame-13.png', 5500, 'Nadie puede detenerte.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(14, 'BESTIA OCULTA', 'frames/frame-14.png', 5950, 'Para los que ocultan su potencial.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(15, 'ALQUIMISTA', 'frames/frame-15.png', 6500, 'Alquimista de los secretos del Arcade.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(16, 'INVENCIBLE', 'frames/frame-16.png', 7000, 'Imposible de vencer.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(17, 'JEFE PLANETARIO', 'frames/frame-17.png', 7500, 'Nadie sabe de donde vienes, pero de este planeta seguro que no.', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(18, 'REY DE LOS JUEGOS', 'frames/frame-18.png', 7900, 'Prestigio III', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(19, 'EMPERADOR DEL ARCADE', 'frames/frame-19.png', 8450, 'Prestigio II', '2026-05-20 11:06:52', '2026-05-20 11:06:52'),
(20, 'FINAL BOSS', 'frames/frame-20.png', 8900, 'Prestigio I', '2026-05-20 11:06:52', '2026-05-20 11:06:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frame_user`
--

CREATE TABLE `frame_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `frame_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `frame_user`
--

INSERT INTO `frame_user` (`id`, `user_id`, `frame_id`, `created_at`, `updated_at`) VALUES
(22, 1, 20, '2026-05-20 11:07:16', '2026-05-20 11:07:16'),
(23, 1, 5, '2026-05-20 11:07:26', '2026-05-20 11:07:26'),
(24, 1, 7, '2026-05-20 11:07:36', '2026-05-20 11:07:36'),
(25, 1, 1, '2026-05-20 11:07:51', '2026-05-20 11:07:51'),
(26, 1, 19, '2026-05-20 11:50:37', '2026-05-20 11:50:37'),
(27, 1, 2, '2026-05-21 09:10:38', '2026-05-21 09:10:38'),
(28, 4, 1, '2026-05-26 08:51:04', '2026-05-26 08:51:04'),
(29, 5, 5, '2026-05-26 08:53:51', '2026-05-26 08:53:51'),
(30, 6, 7, '2026-05-26 08:54:44', '2026-05-26 08:54:44'),
(31, 7, 1, '2026-05-26 08:55:44', '2026-05-26 08:55:44'),
(32, 7, 3, '2026-05-26 08:55:47', '2026-05-26 08:55:47'),
(33, 8, 7, '2026-05-26 08:56:38', '2026-05-26 08:56:38'),
(34, 9, 12, '2026-05-26 08:57:34', '2026-05-26 08:57:34'),
(35, 10, 17, '2026-05-26 08:58:50', '2026-05-26 08:58:50'),
(36, 11, 1, '2026-05-26 09:00:00', '2026-05-26 09:00:00'),
(37, 11, 12, '2026-05-26 09:00:34', '2026-05-26 09:00:34'),
(38, 12, 10, '2026-05-26 09:01:55', '2026-05-26 09:01:55'),
(39, 2, 1, '2026-05-26 09:06:25', '2026-05-26 09:06:25'),
(40, 2, 11, '2026-05-26 09:20:13', '2026-05-26 09:20:13'),
(41, 3, 1, '2026-05-26 09:20:57', '2026-05-26 09:20:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `games`
--

INSERT INTO `games` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Wordle', 'wordle', 'Adivina la palabra en 6 intentos', '2026-03-17 17:12:40', '2026-03-17 17:12:48'),
(2, 'TypeSpeed', 'typespeed', 'Prueba tu velocidad escribiendo', '2026-04-08 05:49:54', '2026-04-08 05:50:10'),
(3, 'BombParty', 'bombparty', 'Forma las palabras que puedas con las sílabas que te de la bomba, hazlo rápido para que no explote', '2026-04-09 13:23:06', '2026-04-09 13:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `job_batches`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_22_163652_create_departments_table', 1),
(5, '2026_02_22_165808_add_department_id_to_users_table', 1),
(6, '2026_02_22_170732_create_games_table', 1),
(7, '2026_02_22_170829_create_scores_table', 1),
(8, '2026_05_11_113404_add_avatar_and_frame_to_users_table', 2),
(9, '2026_05_11_125326_create_frames_table', 3),
(10, '2026_05_11_125413_add_foreign_key_to_users_frame', 4),
(11, '2026_05_14_100003_add_coins_to_users_table', 5),
(12, '2026_05_20_095905_create_frame_user_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('amoretroco@gmail.com', '$2y$12$VqZz9qvxXbLfC/pPQTbdQutUfu6xYc97a54mSykKqzGslOXCN42lO', '2026-04-09 08:10:18'),
('lucia@example.com', '$2y$12$a4Fj0xkjct7VMKxKtKr8oeNxZ2HemQytFVaz97ccSqv7TSrzx./lO', '2026-05-27 07:49:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `time_taken` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `game_id`, `points`, `time_taken`, `created_at`, `updated_at`) VALUES
(15, 1, 2, 283, 53, '2026-04-08 09:39:29', '2026-04-08 09:39:29'),
(16, 1, 1, 600, 22, '2026-04-09 07:33:15', '2026-04-09 07:33:15'),
(17, 1, 2, 290, 48, '2026-04-09 07:34:22', '2026-04-09 07:34:22'),
(26, 2, 2, 319, 42, '2026-04-09 10:53:48', '2026-04-09 10:53:48'),
(27, 1, 1, 600, 10, '2026-04-13 08:06:05', '2026-04-13 08:06:05'),
(28, 1, 2, 153, 56, '2026-04-13 08:07:25', '2026-04-13 08:07:25'),
(36, 2, 2, 285, 49, '2026-04-17 09:07:33', '2026-04-17 09:07:33'),
(37, 2, 1, 600, 4, '2026-04-17 09:07:42', '2026-04-17 09:07:42'),
(39, 2, 3, 770, 0, '2026-04-17 09:22:03', '2026-04-17 09:22:03'),
(40, 2, 1, 600, 7, '2026-04-28 07:47:08', '2026-04-28 07:47:08'),
(41, 2, 2, 206, 44, '2026-04-28 07:47:57', '2026-04-28 07:47:57'),
(42, 2, 3, 440, 0, '2026-04-28 07:49:17', '2026-04-28 07:49:17'),
(43, 3, 1, 600, 5, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(44, 4, 1, 400, 10, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(45, 5, 1, 200, 15, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(46, 6, 1, 500, 8, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(47, 7, 1, 600, 4, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(48, 8, 1, 300, 12, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(49, 9, 1, 400, 9, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(50, 10, 1, 600, 3, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(51, 3, 2, 85, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(52, 4, 2, 110, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(53, 5, 2, 45, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(54, 6, 2, 130, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(55, 7, 2, 95, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(56, 8, 2, 70, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(57, 9, 2, 155, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(58, 10, 2, 120, 60, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(59, 3, 3, 450, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(60, 4, 3, 890, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(61, 5, 3, 320, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(62, 6, 3, 1100, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(63, 7, 3, 560, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(64, 8, 3, 780, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(65, 9, 3, 920, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(66, 10, 3, 1050, 0, '2026-04-28 10:45:57', '2026-04-28 10:45:57'),
(67, 1, 1, 400, 5, '2026-04-27 10:45:57', '2026-04-27 10:45:57'),
(68, 1, 2, 120, 60, '2026-04-27 10:45:57', '2026-04-27 10:45:57'),
(69, 1, 3, 800, 0, '2026-04-26 10:45:57', '2026-04-26 10:45:57'),
(70, 2, 1, 600, 3, '2026-04-27 10:45:57', '2026-04-27 10:45:57'),
(71, 1, 1, 600, 8, '2026-05-21 09:03:42', '2026-05-21 09:03:42'),
(72, 1, 2, 348, 40, '2026-05-21 09:04:30', '2026-05-21 09:04:30'),
(73, 1, 3, 0, 0, '2026-05-21 09:05:35', '2026-05-21 09:05:35'),
(74, 1, 1, 400, 36, '2026-05-22 07:39:28', '2026-05-22 07:39:28'),
(75, 2, 1, 400, 11, '2026-05-22 07:41:14', '2026-05-22 07:41:14'),
(76, 3, 1, 400, 8, '2026-05-22 07:46:44', '2026-05-22 07:46:44'),
(77, 3, 2, 353, 40, '2026-05-22 08:03:20', '2026-05-22 08:03:20'),
(78, 3, 3, 570, 0, '2026-05-22 08:12:40', '2026-05-22 08:12:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EHRIrXQinKnVyTtvpVvh8IPa3ZZoQta2UO7ng6GH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnhvRHlRUVhVNjdSaXZSRGJWM0ZVYWs1Z3FjSnZUVFd6bE9OWHVNQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1779887478),
('jy1GWHycl6XPfmEWkCtGFwSOoU5zxkdY0vCquSnx', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYlEyM0tBcjJnRTFRRElPcWJORUt2MGZCMDRzYzg1d1lTclBjZnViVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yYW5raW5nIjtzOjU6InJvdXRlIjtzOjc6InJhbmtpbmciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1779794521);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `coins` int(11) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `frame_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `coins`, `avatar`, `frame_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `department_id`) VALUES
(1, 'Alexander Moreno', 'alexander@example.com', 5000, 'avatars/XWqr3Yge1yl8IbEOcOBdVwf6rfvdlfn0wSOG3Zpt.png', 20, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-03-17 12:00:00', '2026-05-26 09:19:13', 1),
(2, 'Miguel Troconis', 'miguel@example.com', 3150, 'avatars/zQnjuX6TYlJ2FY5BFbsHIqDEwEkCb4KAsBU3BmkC.png', 11, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-08 08:27:22', '2026-05-26 09:20:17', 1),
(3, 'Lucía García', 'lucia@example.com', 427, 'avatars/4O4MnbEEqSKrSfK9GazfWm0HwV7JFANJ4cTLRV30.png', NULL, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 09:21:54', 2),
(4, 'Marcos Pérez', 'marcos@example.com', 1500, 'avatars/zqzEn9JE1cvA0C4R4JYHGRzvZpqutZKedPpZhMmr.png', 1, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:51:09', 2),
(5, 'Elena Sanz', 'elena@example.com', 250, 'avatars/QGUj2wP0ziMYB6ZuslD0QJE1LD0MRJek1oA4DF2F.png', 5, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:53:57', 3),
(6, 'Roberto Gómez', 'roberto@example.com', 0, 'avatars/eK1NSfGk3x8dRlqV1imD4CnpMO2vDqoIk3aJ8t3M.png', 7, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:54:49', 3),
(7, 'Claudia Ruiz', 'claudia@example.com', 1500, 'avatars/ZmGCItixhlQmVWiWop61ya5ftRQXBFZW4AMdd8FD.png', 3, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:55:52', 4),
(8, 'David León', 'david@example.com', 0, 'avatars/UfCJVgPdhXhHa9lp1vd1UXIC5zGa9DDVf0M9ERyb.png', 7, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:56:43', 4),
(9, 'Sofía Torres', 'sofia@example.com', 5050, 'avatars/pp1jUqC01NJOlUeTy89PfEVSUQAeKEeLwwinkLGy.png', 12, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:57:54', 5),
(10, 'Javier Cano', 'javier@example.com', 1000, 'avatars/rAOeATflIjIjX2Pg3Te6sX3AwMRfSxtvBvlD8Z8J.png', 17, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 08:59:10', 5),
(11, 'Marta Beltrán', 'marta@example.com', 50, 'avatars/QX3oFrmDLdPO92ojYEH41bZz73Q63iaeHvz9UJnR.png', 12, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 09:00:43', 6),
(12, 'Raúl Morales', 'raul@example.com', 3250, 'avatars/n2yV7BXoTh35tBB1oj6veF3UXTdFmMiX474luZYr.png', 10, NULL, '$2y$12$ss4sEftwWcKcsb9FfkTaju9CVkZMGZMlDnWOLrL5.8CYHmDsBL1za', NULL, '2026-04-28 10:45:57', '2026-05-26 09:02:23', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `frames`
--
ALTER TABLE `frames`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `frame_user`
--
ALTER TABLE `frame_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frame_user_user_id_foreign` (`user_id`),
  ADD KEY `frame_user_frame_id_foreign` (`frame_id`);

--
-- Indices de la tabla `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `games_name_unique` (`name`),
  ADD UNIQUE KEY `games_slug_unique` (`slug`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scores_user_id_foreign` (`user_id`),
  ADD KEY `scores_game_id_foreign` (`game_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_frame_id_foreign` (`frame_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `frames`
--
ALTER TABLE `frames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `frame_user`
--
ALTER TABLE `frame_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `frame_user`
--
ALTER TABLE `frame_user`
  ADD CONSTRAINT `frame_user_frame_id_foreign` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `frame_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_frame_id_foreign` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
