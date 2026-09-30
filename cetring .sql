-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2025 at 02:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cetring`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '7601606d9b1d812d4d0ed7d568561047', '2025-11-16 13:49:53'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '792306687b87487f383d8f294a1c564f', '2025-11-26 12:32:55'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '792306687b87487f383d8f294a1c564f', '2025-11-26 12:38:58'),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '792306687b87487f383d8f294a1c564f', '2025-11-26 12:51:57'),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'cc0a8192e4458f64e9d119c402dc008a', '2025-11-27 05:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator full access'),
(2, 'user', 'Regular user with limited access');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 4),
(2, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'zay', 1, '2025-11-16 13:49:36', 0),
(2, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-16 13:50:05', 1),
(3, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-18 11:56:34', 1),
(4, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-19 10:14:29', 1),
(5, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-23 11:37:19', 1),
(6, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-24 08:05:56', 1),
(7, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-26 07:04:09', 1),
(8, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-26 08:04:32', 1),
(9, '::1', 'zay', NULL, '2025-11-26 12:20:51', 0),
(10, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-26 12:21:03', 1),
(11, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 12:33:12', 1),
(12, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 12:39:15', 1),
(13, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 12:46:12', 1),
(14, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 12:49:40', 1),
(15, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 12:52:18', 1),
(16, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 12:54:34', 1),
(17, '::1', 'pwebcoba@gmail.com', 4, '2025-11-26 13:24:23', 1),
(18, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-26 14:01:43', 1),
(19, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 01:04:11', 1),
(20, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 01:26:09', 1),
(21, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 05:08:50', 1),
(22, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 05:19:16', 1),
(23, '::1', 'namiradavina7@gmail.com', 6, '2025-11-27 05:31:06', 1),
(24, '::1', 'nami', NULL, '2025-11-27 05:33:17', 0),
(25, '::1', 'nami', NULL, '2025-11-27 05:33:29', 0),
(26, '::1', 'namiradavina7@gmail.com', 6, '2025-11-27 05:33:51', 1),
(27, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 06:17:28', 1),
(28, '::1', 'nami', NULL, '2025-11-27 06:21:41', 0),
(29, '::1', 'nami', NULL, '2025-11-27 06:21:51', 0),
(30, '::1', 'pwebcoba@gmail.com', 4, '2025-11-27 06:23:59', 1),
(31, '::1', 'nami', NULL, '2025-11-27 06:24:56', 0),
(32, '::1', 'nami', NULL, '2025-11-27 06:25:06', 0),
(33, '::1', 'nami', NULL, '2025-11-27 06:25:32', 0),
(34, '::1', 'namiradavina7@gmail.com', 6, '2025-11-27 06:25:55', 1),
(35, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 06:42:30', 1),
(36, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 06:51:24', 1),
(37, '::1', 'zayanamiraalya@gmail.com', 1, '2025-11-27 06:51:39', 1),
(38, '::1', 'pwebcoba@gmail.com', 4, '2025-11-27 06:51:55', 1),
(39, '::1', 'namiradavinarm@gmail.com', 7, '2025-11-30 12:08:54', 1),
(40, '::1', 'namiradavinarm@gmail.com', 7, '2025-11-30 12:09:05', 1),
(41, '::1', 'namiradavinarm@gmail.com', 7, '2025-11-30 12:12:32', 1),
(42, '::1', 'namiradavinarm@gmail.com', 7, '2025-11-30 12:45:30', 1),
(43, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-01 10:43:37', 1),
(44, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-01 10:56:47', 1),
(45, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-01 12:45:22', 1),
(46, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-01 12:47:13', 1),
(47, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-01 13:36:26', 1),
(48, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-03 03:38:00', 1),
(49, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-03 05:36:17', 1),
(50, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-04 04:23:16', 1),
(51, '::1', 'namiradavinarm@gmail.com', 7, '2025-12-05 14:20:37', 1),
(52, '::1', 'zaza@gmail.com', 8, '2025-12-11 01:57:12', 1),
(53, '::1', 'zaza@gmail.com', 8, '2025-12-11 02:02:40', 1),
(54, '::1', 'zaza@gmail.com', 8, '2025-12-11 02:51:00', 1),
(55, '::1', 'zaza@gmail.com', 8, '2025-12-11 02:59:16', 1),
(56, '::1', 'zaza@gmail.com', 8, '2025-12-11 08:02:35', 1),
(57, '::1', 'zaza@gmail.com', 8, '2025-12-22 11:51:48', 1),
(58, '::1', 'zaza@gmail.com', 8, '2025-12-26 14:21:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_reset_attempts`
--

INSERT INTO `auth_reset_attempts` (`id`, `email`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, 'namiradavina7@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '232e44d8bd850a4440f1fe0674f828d9', '2025-11-27 05:33:07'),
(2, 'pwebcoba@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'f432caf0ac3dcce59ce5aff7ee2ff602', '2025-11-27 06:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int NOT NULL,
  `nama_menu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `ket` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Sampul` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `ket`, `Sampul`) VALUES
(1, 'Paket Hemat 1', 10000, 'Ayam Bakar', 'ayambakar.jpg'),
(2, 'Paket Hemat 2', 11000, 'Ayam Goreng', 'ayamgoreng.jpg'),
(3, 'Paket Hemat 3', 12000, 'Ayam Panggang', 'ayampanggang.jpg'),
(4, 'Paket Hemat 4', 13000, 'Rendang', 'rendang.jpg'),
(5, 'Paket Hemat 5', 14000, 'Ikan Goreng', 'ikangoreng.jpg'),
(6, 'Paket Hemat 6', 15000, 'Ikan Bakar', 'ikanbakar.jpg'),
(7, 'Paket Hemat 7', 16000, 'Bebek Bakar', 'bebekbakar.jpg'),
(8, 'Paket Hemat 8', 17000, 'Bebek Goreng', 'bebekgoreng.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1763297696, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_paket` int NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `payment_method` enum('QRIS','COD') COLLATE utf8mb4_general_ci NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','sedang_dibuat','diantar','selesai') COLLATE utf8mb4_general_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `mobile`, `jumlah_paket`, `address`, `catatan`, `payment_method`, `menu_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'namira', '08090878', 2, 'jl bromo', 'kdacbabd', 'QRIS', 1, '2025-12-01 18:19:48', NULL, 'pending'),
(2, 'namira', '08090878', 2, 'jl bromo', 'kdacbabd', 'COD', 1, '2025-12-01 18:19:52', NULL, 'pending'),
(3, 'namira', '08090878', 2, 'jl bromo', 'kdacbabd', 'QRIS', 1, '2025-12-01 18:19:57', NULL, 'pending'),
(4, 'davina', '098789188766', 10, 'jl bromo', 'tambahkan sendok', 'QRIS', 2, '2025-12-03 11:39:46', NULL, 'pending'),
(5, 'davina', '098789188766', 10, 'jl bromo', 'tambahkan sendok', 'COD', 2, '2025-12-03 11:40:00', NULL, 'pending'),
(6, 'davina', '098789188766', 10, 'jl bromo', 'tambahkan sendok', 'QRIS', 2, '2025-12-03 11:40:05', NULL, 'pending'),
(7, 'davina', '098789188766', 10, 'jl bromo', 'tambahkan sendok', 'COD', 2, '2025-12-03 12:03:03', NULL, 'pending'),
(8, 'namira', '9809890987', 4, 'jl bromo', '', 'QRIS', 1, '2025-12-03 14:18:40', NULL, 'pending'),
(9, 'namira', '14131', 2, 'jlnfaj', 'knfskafsk', 'QRIS', 1, '2025-12-03 16:25:40', NULL, 'pending'),
(10, 'namira', '14131', 2, 'jlnfaj', 'knfskafsk', 'COD', 1, '2025-12-03 16:25:47', NULL, 'pending'),
(11, 'namira', '14131', 10, 'badbafk', 'dskbfkadfkj', 'QRIS', 1, '2025-12-03 17:28:16', NULL, 'pending'),
(12, 'namira', '897787807', 2, 'jl bromo', 'hbsvskjabvj', 'QRIS', 1, '2025-12-03 17:31:01', NULL, 'pending'),
(13, 'namira', '4874289647', 4, 'jl bromo', 'tambah minum 2', 'QRIS', 1, '2025-12-04 11:24:22', NULL, 'pending'),
(14, 'namira', '4874289647', 4, 'jl bromo', 'tambah minum 2', 'QRIS', 1, '2025-12-04 11:24:40', NULL, 'sedang_dibuat'),
(15, 'namira', '4874289647', 4, 'jl bromo', 'tambah minum 2', 'COD', 1, '2025-12-04 11:24:44', NULL, 'sedang_dibuat'),
(16, 'nami', '111111', 20, 'jl bromo', 'kkjadfadf', 'COD', 1, '2025-12-05 14:21:19', NULL, 'selesai'),
(17, 'namira', '14131', 2, 'jl bromo', 'bdkhaba', 'QRIS', 2, '2025-12-05 14:39:54', NULL, 'selesai'),
(18, 'zaza', '089939374832', 5, 'jalan garuda', 'kasih sendok ya', 'COD', 6, '2025-12-11 02:04:16', NULL, 'pending'),
(19, 'zaza', '089939374832', 6, 'jalan garuda', 'diskon ya', 'QRIS', 6, '2025-12-11 02:06:21', NULL, 'diantar'),
(20, 'zaza', '089939374832', 5, 'jalan garuda', 'banyakin kuah rendangnya', 'QRIS', 4, '2025-12-11 03:05:08', NULL, 'sedang_dibuat'),
(21, 'HANA', '0826378420284', 7, 'jalan jalan', 'KASIH KERIUKAN', 'COD', 7, '2025-12-11 04:31:08', NULL, 'selesai'),
(22, 'zaza', '082994282', 7, 'jalan jalan', 'diskonin dong', 'QRIS', 1, '2025-12-11 06:41:27', NULL, 'sedang_dibuat'),
(23, 'zaza', '0882003240520', 1, 'jalan jalan', 'tambah minum        ', 'QRIS', 1, '2025-12-11 07:12:16', '2025-12-11 07:59:02', 'selesai'),
(24, 'zaza', '0882003240520', 1, 'jalan jalan', ' sadfghh     ', 'QRIS', 2, '2025-12-11 08:03:08', '2025-12-11 08:03:59', 'selesai'),
(25, 'zaza', '0882003240520', 1, 'jalan jalan', 'tambah minum', 'QRIS', 1, '2025-12-11 08:26:07', '2025-12-11 08:26:40', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'namiradavinarm@gmail.com', 'ee854e6961800ae09e75750686f7fb5abbec907ced0b1f8a7bdc735dad92c2e2', '2025-12-01 12:24:46'),
(2, 'namiradavinarm@gmail.com', 'f99a7793554f6712eced886ac5bc1d80227efb78bc9232e3e81ed9fa137da4a4', '2025-12-01 12:26:10'),
(3, 'namiradavinarm@gmail.com', '8be6a7b7a9aec2ac43019cb80534212d9b93134a4cc925d56680f8ac91f47f50', '2025-12-01 12:26:17'),
(4, 'namiradavinarm@gmail.com', '0f95fd9e050509b900f6102e524e71b5162709dfdb435c769e761db9ac60fc59', '2025-12-01 12:26:43'),
(5, 'namiradavinarm@gmail.com', '8ae6552479a15675f65064aced8ea49006c42b5680159cf1ce7b1efc200b1cb3', '2025-12-01 12:32:24'),
(6, 'namiradavinarm@gmail.com', '39d1ccdc1ae5a945a52f66c8cb133b97407ff9b897392cb1e423ff6908c88c22', '2025-12-01 12:35:38'),
(7, 'namiradavinarm@gmail.com', '3303ae1ef9f4308ab34bb8aea9119cf0ddefa2d96f14fa828075a2f663ce7c32', '2025-12-01 12:35:47'),
(8, 'namiradavinarm@gmail.com', '620c83700691793941e4f25f0d1e9b4678e60ae19cf1a8469e8c11b3dd4b89a0', '2025-12-01 12:36:03'),
(9, 'namiradavinarm@gmail.com', 'dce35b788ef806e25f46582acd6c034ba5ff8a016d9319e3a1c15d7452a822a3', '2025-12-01 12:37:41'),
(10, 'namiradavinarm@gmail.com', '88a60ddb46f4b7d52dc2ff7599ed53604af6db8b84364b749e44e2253de247d5', '2025-12-01 12:42:03'),
(12, 'namiradavinarm@gmail.com', 'aae3d54a15f27ad8a221c19a686ff2058f8b2244ed6f7ee8802d934243a5ad7d', '2025-12-01 13:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`, `role`) VALUES
(1, 'zayanamiraalya@gmail.com', 'zay', '$2y$10$EqDSg5N8ODFa3hFD8SW2L.ww1HBDhbHkQfyIQ8LzcCaFQYw/b/RW.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-11-16 13:49:20', '2025-11-16 13:49:53', NULL, 'admin'),
(4, 'pwebcoba@gmail.com', 'nami', '$2y$10$cdW9Eey/jAy/liHxpLBWpuXA.EFahoxUSni9B.iWWVZjw0oDaRviy', NULL, '2025-11-27 06:23:49', NULL, NULL, NULL, NULL, 1, 0, '2025-11-26 12:32:31', '2025-11-27 06:23:49', NULL, 'user'),
(6, 'namiradavina7@gmail.com', 'mulia', '$2y$10$cDGgiwDFLmFu5q7cdH5fuuF6WjsqZ6QZoxwQQYnVuCfUWyAQAmA1a', NULL, '2025-11-27 05:33:08', NULL, NULL, NULL, NULL, 1, 0, '2025-11-27 05:29:56', '2025-11-27 05:33:08', NULL, 'user'),
(7, 'namiradavinarm@gmail.com', 'davina', '$2y$10$La4LoJwQc1PU52ufIrApT.yp9b1jEJ8dQdEotxV/.1XU3Zp6S003u', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 'user'),
(8, 'zaza@gmail.com', 'zaza', '$2y$10$X0XffNC5iJzFWVb/hZrLI.H/ho5NmiT/1OHq8dS3PzS./ZCDPRm5a', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu` (`menu_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
