-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2025 at 09:17 PM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpqylzet_wpb`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` char(36) NOT NULL,
  `layout_id` char(36) DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agendas`
--

INSERT INTO `agendas` (`id`, `layout_id`, `cover`, `name`, `slug`, `description`, `location`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
('9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', '9ee496f4-bc03-4461-8c98-7f84efca5b78', 'images/agenda/3f9ff189-1321-4f9f-a1ce-67efe3c00d64.jpeg', 'BRAWIJAYA CAREER EXPO 2025', 'brawijaya-career-expo-2025', '<p>BRAWIJAYA CAREER EXPO 2025</p>', 'Gedung Samantha Krida Universitas Brawijaya', '2025-06-28', '2025-06-29', 1, '2025-05-12 11:55:11', '2025-05-12 11:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `agenda_participants`
--

CREATE TABLE `agenda_participants` (
  `id` char(36) NOT NULL,
  `agenda_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda_participants`
--

INSERT INTO `agenda_participants` (`id`, `agenda_id`, `user_id`, `created_at`, `updated_at`) VALUES
('9ef6b8f5-4a5a-463f-a68e-dfeff148fed2', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', 'c0c5a9d7-48f8-4d18-ad90-7beacd981dd6', '2025-05-21 03:57:02', '2025-05-21 03:57:02'),
('9eff3bb1-b55b-4a56-87b8-9e90f7445608', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', 'c0c5a9d7-48f8-4d18-ad90-7beacd981dd6', '2025-05-25 09:29:13', '2025-05-25 09:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `booths`
--

CREATE TABLE `booths` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `default_price` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `length_in_m` decimal(8,2) NOT NULL,
  `width_in_m` decimal(8,2) NOT NULL,
  `height_in_m` decimal(8,2) NOT NULL,
  `facilities` text NOT NULL,
  `branding_facilities` text NOT NULL,
  `lo_count` int(11) NOT NULL,
  `lo_performance` varchar(255) NOT NULL,
  `is_buyable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booths`
--

INSERT INTO `booths` (`id`, `name`, `type`, `color`, `description`, `default_price`, `created_at`, `updated_at`, `length_in_m`, `width_in_m`, `height_in_m`, `facilities`, `branding_facilities`, `lo_count`, `lo_performance`, `is_buyable`) VALUES
('9ee49151-89fc-4543-b752-aae6453a300f', 'Paket Kerjasama Career', 'S', '#b36800', '<p>Paket Kerjasama Career (Stan S)</p>', '2.000.000', '2025-05-12 03:21:17', '2025-05-12 03:21:17', 3.00, 2.00, 2.50, 'satu meja, dua kursi, daya listrik 2 Ampere, dan satu lampu neon TL 40 W', 'penempatan logo perusahaan pada channel publikasi DPKA UB (Instagram, Facebook, Twitter, LinkedIn \ndan website) dan baliho pada pintu masuk dan keluar Universitas Brawijaya', 1, 'standard', 1),
('9ee49151-89fc-4543-b752-aae6453a300g', 'Paket Kerjasama Scholarship', 'S', '#b36800', '<p>Paket Kerjasama Scholarship(Stan S)</p>', '1.000.000', '2025-05-12 03:21:17', '2025-05-12 03:21:17', 3.00, 2.00, 2.50, 'satu meja, dua kursi, daya listrik 2 Ampere, dan satu lampu neon TL 40 W', 'penempatan logo perusahaan pada channel publikasi DPKA UB (Instagram, Facebook, Twitter, LinkedIn \r\ndan website) dan baliho pada pintu masuk dan keluar Universitas Brawijaya', 1, 'standard', 1),
('9ee49151-89fc-4543-b752-aae6453a300h', 'Paket Kerjasama Standar Internship', 'S', '#b36800', '<p>Paket Kerjasama Standar Internship(Stan S)</p>', '1.000.000', '2025-05-12 03:21:17', '2025-05-12 03:21:17', 3.00, 2.00, 2.50, 'satu meja, dua kursi, daya listrik 2 Ampere, dan satu lampu neon TL 40 W', 'penempatan logo perusahaan pada channel publikasi DPKA UB (Instagram, Facebook, Twitter, LinkedIn \r\ndan website) dan baliho pada pintu masuk dan keluar Universitas Brawijaya', 1, 'standard', 1),
('9ee49151-89fc-4543-b752-aae6453a300i', 'Paket Kerjasama Enterpreneurship', 'S', '#b36800', '<p>Paket Kerjasama Enterpreneurship (Stan S)</p>', '1.000.000', '2025-05-12 03:21:17', '2025-05-12 03:21:17', 3.00, 2.00, 2.50, 'satu meja, dua kursi, daya listrik 2 Ampere, dan satu lampu neon TL 40 W', 'penempatan logo perusahaan pada channel publikasi DPKA UB (Instagram, Facebook, Twitter, LinkedIn \r\ndan website) dan baliho pada pintu masuk dan keluar Universitas Brawijaya', 1, 'standard', 1),
('9eea2a1d-835b-471f-994c-3558f449a27e', 'Booth Universitas Brawijaya', 'UB', '#000ba8', '<p>Booth untuk UB, tidak dijual</p>', '2.000.000', '2025-05-14 22:07:41', '2025-05-20 20:12:13', 3.00, 2.00, 2.50, '-', '-', 0, 'standard', 1),
('9eea3790-b674-4930-95df-2b8c3a614b62', 'Paket Kerjasama Gold', 'G', '#fff700', '<p>Paket Kerjasama Gold&nbsp;</p>', '5.000.000', '2025-05-14 22:45:17', '2025-05-14 22:45:17', 6.00, 3.00, 2.50, '3 meja, 6 kursi, daya listrik 6 Ampere, dan 3 lampu neon TL 40 W', 'Penempatan logo perusahaan pada channel publikasi DPKA UB (Instagram, Facebook, Twitter, LinkedIn \r\ndan website) dan Baliho pada pintu masuk dan keluar Universitas Brawijaya.', 1, 'good', 1),
('9eea380e-fa95-435c-9c78-e4731739f545', 'Paket Kerjasama Platinum', 'P', '#f50000', '<p>Paket Kerjasama Platinum</p>', '10.000.000', '2025-05-14 22:46:40', '2025-05-14 22:46:40', 8.00, 4.00, 2.50, '4 meja, 8 kursi, daya listrik 10 Ampere, dan 4 lampu neon TL 40 W', 'Penempatan logo perusahaan pada channel publikasi DPKA UB (Instagram, Facebook, Twitter, LinkedIn \r\ndan website) dan baliho pada pintu masuk dan keluar Universitas Brawijaya', 2, 'good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booth_layouts`
--

CREATE TABLE `booth_layouts` (
  `id` char(36) NOT NULL,
  `layout_id` char(36) DEFAULT NULL,
  `booth_id` char(36) DEFAULT NULL,
  `label` varchar(10) DEFAULT NULL,
  `positions` varchar(255) NOT NULL,
  `booth_pov_file` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `need_label` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booth_layouts`
--

INSERT INTO `booth_layouts` (`id`, `layout_id`, `booth_id`, `label`, `positions`, `booth_pov_file`, `created_at`, `updated_at`, `need_label`) VALUES
('9ee68551-17ac-4371-a8cf-bed888d0ed3b', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '14', '[\"1_4\",\"1_5\",\"1_6\",\"2_4\",\"2_5\",\"2_6\"]', 'images/booth/pov/73c897dc-b16f-4a40-86d7-bd8fb34e4406.JPG', '2025-05-13 02:39:23', '2025-05-13 02:39:23', 1),
('9eea1bf6-3264-47c4-b6c4-31a30e2edcf3', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '13', '[\"1_7\",\"1_8\",\"1_9\",\"2_7\",\"2_8\",\"2_9\"]', 'images/booth/pov/848d38fc-f554-4889-9c5f-86331749c7b2.JPG', '2025-05-14 21:28:07', '2025-05-14 21:28:07', 1),
('9eea1c13-5bf2-4901-b39d-f3a5a4e688dd', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '12', '[\"1_10\",\"1_11\",\"1_12\",\"2_10\",\"2_11\",\"2_12\"]', 'images/booth/pov/5d212789-a172-4a5b-81fa-c7a61c0a35be.JPG', '2025-05-14 21:28:25', '2025-05-14 21:28:25', 1),
('9eea1c33-b479-42a8-b809-89468e591d56', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '11', '[\"1_13\",\"1_14\",\"1_15\",\"2_13\",\"2_14\",\"2_15\"]', 'images/booth/pov/6c7e9c6c-7426-4e90-b3dc-99add64a9908.JPG', '2025-05-14 21:28:46', '2025-05-14 21:28:46', 1),
('9eea1c56-b49d-46ca-b965-695e6e5e0999', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '10', '[\"1_16\",\"1_17\",\"1_18\",\"2_16\",\"2_17\",\"2_18\"]', 'images/booth/pov/c51999c1-24ac-455a-805c-fa6bbd3215c8.JPG', '2025-05-14 21:29:09', '2025-05-14 21:29:09', 1),
('9eea1c76-908c-4a14-8b69-4464189e5a58', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '09', '[\"1_19\",\"1_20\",\"1_21\",\"2_19\",\"2_20\",\"2_21\"]', 'images/booth/pov/9d519fe8-60d8-42ea-9ebd-4b587518d4cf.JPG', '2025-05-14 21:29:30', '2025-05-14 21:30:09', 1),
('9eea1ca1-2d3f-4684-800c-84428e64441f', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '08', '[\"1_22\",\"1_23\",\"1_24\",\"2_22\",\"2_23\",\"2_24\"]', 'images/booth/pov/ab5523ef-5c77-4ab4-bdc9-dcb2d2747d58.JPG', '2025-05-14 21:29:58', '2025-05-14 21:29:58', 1),
('9eea1cdb-926c-40a6-b508-3f9581c2c5c1', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '07', '[\"1_25\",\"1_26\",\"1_27\",\"2_25\",\"2_26\",\"2_27\"]', 'images/booth/pov/8d9ce405-f16c-4d0b-9ae2-c8957131be66.JPG', '2025-05-14 21:30:36', '2025-05-14 21:30:36', 1),
('9eea1cf8-e81b-4fd5-8e02-aa916bfaeb62', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '06', '[\"1_28\",\"1_29\",\"1_30\",\"2_28\",\"2_29\",\"2_30\"]', 'images/booth/pov/59dedb64-36df-4f65-b275-b97868037129.JPG', '2025-05-14 21:30:56', '2025-05-14 21:30:56', 1),
('9eea1d49-765b-4c8c-ad4a-998b681bb6c3', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '15', '[\"4_1\",\"4_2\",\"5_1\",\"5_2\",\"6_1\",\"6_2\"]', 'images/booth/pov/9a4cbd4a-cbdc-4f25-be25-eee955a49a85.JPG', '2025-05-14 21:31:48', '2025-05-14 21:31:48', 1),
('9eea1d6c-57e1-4543-8d18-c50b5e227a2e', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '16', '[\"7_1\",\"7_2\",\"8_1\",\"8_2\",\"9_1\",\"9_2\"]', 'images/booth/pov/f7c10a62-3aa8-4b38-9856-6261b4a68b89.JPG', '2025-05-14 21:32:11', '2025-05-14 21:32:11', 1),
('9eea1d91-778f-46cf-b3b5-9adb607441fe', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '17', '[\"10_1\",\"10_2\",\"11_1\",\"11_2\",\"12_1\",\"12_2\"]', 'images/booth/pov/46b14469-89e4-462f-8df0-a294561454cd.JPG', '2025-05-14 21:32:36', '2025-05-14 21:32:36', 1),
('9eea1daf-c45e-4f08-bc20-1eede87a1710', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '18', '[\"13_1\",\"13_2\",\"14_1\",\"14_2\",\"15_1\",\"15_2\"]', 'images/booth/pov/2e377d6e-3785-4894-912d-6b94c138f084.JPG', '2025-05-14 21:32:55', '2025-05-14 21:32:55', 1),
('9eea1df7-5d6a-4ef7-b7de-be3fb8f45f4c', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '47', '[\"7_7\",\"7_8\",\"7_9\",\"8_7\",\"8_8\",\"8_9\"]', 'images/booth/pov/ad5b5718-1ec5-449e-8a7a-f94d8a352b86.JPG', '2025-05-14 21:33:42', '2025-05-14 21:33:42', 1),
('9eea1e24-5d22-45d0-8c11-1f7e1dd07fe8', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '46', '[\"7_10\",\"7_11\",\"7_12\",\"8_10\",\"8_11\",\"8_12\"]', 'images/booth/pov/4b1a9a8d-a908-4b90-8b59-6fe92ae64d47.JPG', '2025-05-14 21:34:12', '2025-05-14 21:34:12', 1),
('9eea1e47-eedc-4ab3-8864-1d1cb70489a8', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '45', '[\"7_13\",\"7_14\",\"7_15\",\"8_13\",\"8_14\",\"8_15\"]', 'images/booth/pov/0c479ce2-8cdc-42fb-8f98-90453c5b8818.JPG', '2025-05-14 21:34:35', '2025-05-14 21:34:35', 1),
('9eea1e65-2f2b-48a1-afe0-ca5261720de9', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '44', '[\"7_16\",\"7_17\",\"7_18\",\"8_16\",\"8_17\",\"8_18\"]', 'images/booth/pov/1b078a61-b8b5-4e73-8da7-e109321da7fe.JPG', '2025-05-14 21:34:54', '2025-05-14 21:34:54', 1),
('9eea1e82-ca69-4599-974c-d10f9134f2a0', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '43', '[\"7_19\",\"7_20\",\"7_21\",\"8_19\",\"8_20\",\"8_21\"]', 'images/booth/pov/019e1291-fc8a-4d13-81bb-095ba7e26559.JPG', '2025-05-14 21:35:14', '2025-05-14 21:35:14', 1),
('9eea1e9a-8b38-4b02-ba76-5bdc4e4ef972', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '42', '[\"7_22\",\"7_23\",\"7_24\",\"8_22\",\"8_23\",\"8_24\"]', 'images/booth/pov/13bab6e1-1ef8-4b7a-ab3a-bc105dc8c79b.JPG', '2025-05-14 21:35:29', '2025-05-14 21:35:29', 1),
('9eea1eb9-1f45-431c-80ed-53efca2a1993', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '41', '[\"7_25\",\"7_26\",\"7_27\",\"8_25\",\"8_26\",\"8_27\"]', 'images/booth/pov/67377bf1-28f7-4f40-88c0-aba138682407.JPG', '2025-05-14 21:35:49', '2025-05-14 21:35:49', 1),
('9eea1eef-a87d-4496-8467-a818a0408b85', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '34', '[\"9_7\",\"9_8\",\"9_9\",\"10_7\",\"10_9\",\"10_8\"]', 'images/booth/pov/2397e90d-65c5-4ef0-832a-8c96dd3f7566.JPG', '2025-05-14 21:36:25', '2025-05-14 21:36:25', 1),
('9eea1f28-bd9b-4114-9a61-b3deda2c22f7', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '35', '[\"9_10\",\"9_11\",\"10_10\",\"10_11\",\"10_12\",\"9_12\"]', 'images/booth/pov/e9ebc685-696e-40c3-954b-288aff427c00.JPG', '2025-05-14 21:37:02', '2025-05-14 21:37:02', 1),
('9eea2248-29ae-4f00-a599-52f407a63dfc', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '36', '[\"9_13\",\"9_14\",\"9_15\",\"10_13\",\"10_14\",\"10_15\"]', 'images/booth/pov/3ff4fd87-a1bb-4f98-9d06-1fd56dfc6a31.JPG', '2025-05-14 21:45:46', '2025-05-14 21:49:09', 1),
('9eea2590-3771-4cc6-b45b-dd4c86cdd77c', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '37', '[\"9_16\",\"9_17\",\"9_18\",\"10_16\",\"10_17\",\"10_18\"]', 'images/booth/pov/5629c9ad-b46f-44d4-aa58-3f9b4f75035f.JPG', '2025-05-14 21:54:57', '2025-05-14 21:54:57', 1),
('9eea25b2-9108-4bee-a1da-ac35e831bca7', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '38', '[\"9_19\",\"9_20\",\"9_21\",\"10_19\",\"10_20\",\"10_21\"]', 'images/booth/pov/0c1f23f2-ff2a-48b0-8f71-c111db35d54a.JPG', '2025-05-14 21:55:19', '2025-05-14 21:55:19', 1),
('9eea25d8-98de-4aa7-8f97-63920ab02e85', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300h', '39', '[\"9_22\",\"9_23\",\"9_24\",\"10_22\",\"10_23\",\"10_24\"]', 'images/booth/pov/291bfd32-880c-4bc8-9d78-13348d1c5b34.JPG', '2025-05-14 21:55:44', '2025-05-14 21:55:44', 1),
('9eea25ff-49b1-4854-8881-41bb1621cd0c', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '19', '[\"16_1\",\"16_2\",\"17_1\",\"17_2\",\"18_1\",\"18_2\"]', 'images/booth/pov/477059bc-ea3f-401d-9c6c-c556bacb099a.JPG', '2025-05-14 21:56:10', '2025-05-14 21:56:10', 1),
('9eea2bad-084f-4774-9016-67e23b9a4530', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '33', '[\"13_7\",\"13_8\",\"13_9\",\"14_7\",\"14_8\",\"14_9\"]', 'images/booth/pov/742aae99-d129-4220-884d-20880290e3f5.JPG', '2025-05-14 22:12:02', '2025-05-14 22:13:34', 1),
('9eea2bd4-9592-4bb5-b5b1-7ed98c441eac', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '32', '[\"13_10\",\"13_11\",\"13_12\",\"14_11\",\"14_10\",\"14_12\"]', 'images/booth/pov/5afeaf84-636a-4884-8e9f-37840e7b3216.JPG', '2025-05-14 22:12:28', '2025-05-14 22:13:49', 1),
('9eea2bf1-131e-42e3-b121-0892d62f4641', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '31', '[\"13_13\",\"13_14\",\"13_15\",\"14_13\",\"14_14\",\"14_15\"]', 'images/booth/pov/9126d623-8459-49b9-8801-21565f74dd93.JPG', '2025-05-14 22:12:47', '2025-05-14 22:13:56', 1),
('9eea2c23-7e7a-4575-b9f7-2f07aec77b83', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '30', '[\"13_16\",\"13_17\",\"13_18\",\"14_16\",\"14_17\",\"14_18\"]', 'images/booth/pov/e6b87075-6413-44ff-853c-e0f3e567eead.JPG', '2025-05-14 22:13:20', '2025-05-14 22:13:20', 1),
('9eea2c7f-0809-4032-930c-5920b98c81e3', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '29', '[\"13_19\",\"13_20\",\"13_21\",\"14_19\",\"14_20\",\"14_21\"]', 'images/booth/pov/46b5b538-86b4-4f59-9070-c67b2adc1ef1.JPG', '2025-05-14 22:14:20', '2025-05-14 22:14:20', 1),
('9eea2ca0-35e7-4a48-9797-f43f5ce5ee0a', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '28', '[\"13_22\",\"13_23\",\"13_24\",\"14_23\",\"14_24\",\"14_22\"]', 'images/booth/pov/79240a27-88dc-4584-8852-548e87991c31.JPG', '2025-05-14 22:14:42', '2025-05-14 22:14:42', 1),
('9eea2cbc-7ef3-4d24-b6d7-bcbd0d6714f6', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '27', '[\"13_25\",\"13_26\",\"13_27\",\"14_25\",\"14_26\",\"14_27\"]', 'images/booth/pov/4da9653f-fdd3-40a7-a9de-f51659b9290e.JPG', '2025-05-14 22:15:00', '2025-05-14 22:15:00', 1),
('9eea2cde-7bc2-4cb1-b221-dbacac1a7d4c', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '20', '[\"15_7\",\"15_8\",\"15_9\",\"16_7\",\"16_8\",\"16_9\"]', 'images/booth/pov/aea69b7a-3800-43d8-99ae-827ebd54b849.JPG', '2025-05-14 22:15:23', '2025-05-14 22:15:23', 1),
('9eea2cfe-4ff3-4f75-b717-f1dc998219f7', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '21', '[\"15_10\",\"15_11\",\"15_12\",\"16_10\",\"16_11\",\"16_12\"]', 'images/booth/pov/f3211efb-c551-4264-abaf-74069fd36db6.JPG', '2025-05-14 22:15:44', '2025-05-14 22:15:44', 1),
('9eea2d60-2139-440b-846b-7418aa94689a', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea2a1d-835b-471f-994c-3558f449a27e', NULL, '[\"15_13\",\"15_14\",\"15_15\",\"16_13\",\"16_14\",\"16_15\"]', 'images/booth/pov/e1ee964e-3e3b-4224-bbf1-353bc0fccbc8.JPG', '2025-05-14 22:16:48', '2025-05-14 22:16:48', 0),
('9eea3285-2339-4e3d-925c-733b122b3780', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea2a1d-835b-471f-994c-3558f449a27e', NULL, '[\"15_16\",\"15_17\",\"15_18\",\"16_16\",\"16_17\",\"16_18\"]', 'images/booth/pov/6098c319-1eec-4179-b762-efc4799c3d3c.JPG', '2025-05-14 22:31:11', '2025-05-14 22:31:11', 0),
('9eea3354-7b00-4a11-b6a4-3db211f5e09d', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea2a1d-835b-471f-994c-3558f449a27e', NULL, '[\"15_19\",\"15_20\",\"15_21\",\"16_19\",\"16_20\",\"16_21\"]', 'images/booth/pov/547b46f8-ad5e-4e61-9133-49abdf1018dd.JPG', '2025-05-14 22:33:27', '2025-05-14 22:33:27', 0),
('9eea35f1-fb80-4b0c-9251-7b1f6ba62d01', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '25', '[\"15_22\",\"15_23\",\"15_24\",\"16_22\",\"16_23\",\"16_24\"]', 'images/booth/pov/a6a9a7a0-05c2-4dad-a0e2-0ba7e2364bc6.JPG', '2025-05-14 22:40:45', '2025-05-14 22:40:45', 1),
('9eea360e-4679-4b1e-8b04-8cedb9add001', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300i', '26', '[\"15_25\",\"15_26\",\"15_27\",\"16_25\",\"16_26\",\"16_27\"]', 'images/booth/pov/ed52307d-1cfa-4b4e-a29c-e54d2a799d35.JPG', '2025-05-14 22:41:04', '2025-05-14 22:41:04', 1),
('9eea3667-a81a-4c1e-a031-3339eb7f25ce', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '05', '[\"4_32\",\"4_33\",\"5_32\",\"5_33\",\"6_32\",\"6_33\"]', 'images/booth/pov/7df7ab6a-759c-45df-bda2-1557daa09089.JPG', '2025-05-14 22:42:02', '2025-05-14 22:42:02', 1),
('9eea368a-8cda-4d34-b14b-353da76e8e94', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '04', '[\"7_32\",\"7_33\",\"8_32\",\"8_33\",\"9_32\",\"9_33\"]', 'images/booth/pov/bc6e3db5-5a8c-4dfd-a604-df38156262a1.JPG', '2025-05-14 22:42:25', '2025-05-14 22:42:25', 1),
('9eea36a1-daab-495b-b456-293c69a021c4', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '03', '[\"10_32\",\"10_33\",\"11_32\",\"11_33\",\"12_32\",\"12_33\"]', 'images/booth/pov/806bbd9c-0a1a-49c2-8423-911a2333b640.JPG', '2025-05-14 22:42:41', '2025-05-14 22:42:41', 1),
('9eea36be-37f1-4cd5-8616-8e3a66df57e4', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '02', '[\"13_32\",\"13_33\",\"14_32\",\"14_33\",\"15_32\",\"15_33\"]', 'images/booth/pov/3b6b9c65-c769-4ad1-a521-e4ef1faa1bbe.JPG', '2025-05-14 22:42:59', '2025-05-14 22:42:59', 1),
('9eea36d9-755e-4287-8fec-1ffc8a1fbd46', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300g', '01', '[\"16_32\",\"16_33\",\"17_32\",\"17_33\",\"18_32\",\"18_33\"]', 'images/booth/pov/f58a402e-597b-4eec-a374-5371852891ce.JPG', '2025-05-14 22:43:17', '2025-05-14 22:43:17', 1),
('9eea38a1-c4a6-47ba-8535-4ae220e5b48a', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea3790-b674-4930-95df-2b8c3a614b62', '6', '[\"22_1\",\"22_2\",\"23_1\",\"23_2\",\"24_1\",\"24_2\",\"22_3\",\"23_3\",\"24_3\",\"25_1\",\"25_2\",\"25_3\",\"26_1\",\"26_2\",\"26_3\",\"27_1\",\"27_2\",\"27_3\"]', 'images/booth/pov/be8c3cc0-ab61-4e16-a55d-47baff52e3f7.JPG', '2025-05-14 22:48:16', '2025-05-14 22:48:16', 1),
('9eea3906-d43c-49fa-8486-8ea2881713be', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea3790-b674-4930-95df-2b8c3a614b62', '5', '[\"22_9\",\"22_10\",\"22_11\",\"23_9\",\"23_10\",\"23_11\",\"24_9\",\"25_9\",\"26_9\",\"27_9\",\"24_10\",\"25_10\",\"26_10\",\"27_10\",\"24_11\",\"25_11\",\"26_11\",\"27_11\"]', 'images/booth/pov/2f0e5dd8-4153-4a97-8b0e-b344f14b7f09.JPG', '2025-05-14 22:49:22', '2025-05-14 22:49:22', 1),
('9eea392d-4d88-4e33-9e4b-546113b96920', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea3790-b674-4930-95df-2b8c3a614b62', '4', '[\"22_12\",\"22_13\",\"22_14\",\"23_12\",\"23_13\",\"23_14\",\"24_12\",\"24_13\",\"24_14\",\"25_12\",\"25_13\",\"25_14\",\"26_12\",\"26_13\",\"26_14\",\"27_12\",\"27_13\",\"27_14\"]', 'images/booth/pov/f4b58440-bb23-47fa-bc9c-82b606594302.JPG', '2025-05-14 22:49:48', '2025-05-14 22:49:48', 1),
('9eea3980-6987-44a4-9578-914fa36b8541', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea3790-b674-4930-95df-2b8c3a614b62', '3', '[\"22_21\",\"22_22\",\"22_23\",\"23_21\",\"23_22\",\"23_23\",\"24_21\",\"24_22\",\"24_23\",\"25_21\",\"25_22\",\"25_23\",\"26_21\",\"26_22\",\"26_23\",\"27_21\",\"27_22\",\"27_23\"]', 'images/booth/pov/86bb4bbb-70f5-4a83-bf1c-15e770dd3cd4.JPG', '2025-05-14 22:50:42', '2025-05-14 22:50:42', 1),
('9eea39d9-9cb1-4ee3-bb7c-d51aecd1144a', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea3790-b674-4930-95df-2b8c3a614b62', '2', '[\"22_24\",\"22_25\",\"22_26\",\"23_24\",\"23_25\",\"23_26\",\"24_26\",\"25_26\",\"27_26\",\"26_26\",\"27_25\",\"27_24\",\"26_25\",\"26_24\",\"25_25\",\"25_24\",\"24_25\",\"24_24\"]', 'images/booth/pov/c1a17a45-db8a-4e52-9d7f-bbc577d75c74.JPG', '2025-05-14 22:51:40', '2025-05-14 22:51:40', 1),
('9eea3a45-73da-414b-a3f6-615ae6b0a65f', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea380e-fa95-435c-9c78-e4731739f545', '2', '[\"30_9\",\"30_10\",\"30_11\",\"30_12\",\"30_13\",\"30_14\",\"30_15\",\"31_15\",\"32_15\",\"33_15\",\"33_14\",\"32_14\",\"31_14\",\"30_8\",\"31_8\",\"31_9\",\"31_13\",\"31_12\",\"31_11\",\"31_10\",\"32_8\",\"32_9\",\"32_10\",\"32_11\",\"32_12\",\"32_13\",\"33_13\",\"33_12\",\"33_11\",\"33_10\",\"33_9\",\"33_8\"]', 'images/booth/pov/6b0dbf55-6ad5-4b00-9ba6-7fd358d2e999.JPG', '2025-05-14 22:52:51', '2025-05-14 22:52:51', 1),
('9ef610be-0fa2-4016-b979-7ea0609110c0', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9eea3790-b674-4930-95df-2b8c3a614b62', '1', '[\"22_31\",\"22_32\",\"22_33\",\"23_31\",\"23_32\",\"23_33\",\"24_31\",\"24_32\",\"24_33\",\"25_31\",\"25_32\",\"25_33\",\"26_31\",\"26_32\",\"26_33\",\"27_31\",\"27_32\",\"27_33\"]', 'images/booth/pov/6a8aebdf-abf9-413f-b987-fc9204aedb79.JPG', '2025-05-20 20:06:40', '2025-05-20 20:06:40', 1),
('9efb0e35-69a4-40d8-81f9-47232de584f8', '9ef60fcd-5eec-492e-a8cc-414e86c0a3b1', '9ee49151-89fc-4543-b752-aae6453a300f', '01', '[\"1_5\",\"1_6\",\"1_7\",\"2_5\",\"2_6\",\"2_7\"]', 'images/booth/pov/75475be8-8210-496f-818e-f5d53cd72655.JPG', '2025-05-23 07:38:44', '2025-05-23 07:38:44', 1),
('9f048085-5a53-48f9-a4fd-e6d2d5695d94', '9ee496f4-bc03-4461-8c98-7f84efca5b78', '9ee49151-89fc-4543-b752-aae6453a300f', '40', '[\"9_25\",\"9_26\",\"9_27\",\"10_25\",\"10_26\",\"10_27\"]', 'images/booth/pov/51c3bf24-a782-4db4-945a-fd06e80198fb.JPG', '2025-05-28 00:20:49', '2025-05-28 00:20:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booth_transactions`
--

CREATE TABLE `booth_transactions` (
  `id` char(36) NOT NULL,
  `transaction_number` int(11) NOT NULL,
  `participant_id` char(36) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `total_price` int(11) NOT NULL,
  `additional_fee_price` text DEFAULT NULL,
  `feature_request` text DEFAULT NULL,
  `additional_request` text DEFAULT NULL,
  `additional_transaction_items` text DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` date DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_payment_verified` tinyint(1) NOT NULL DEFAULT 0,
  `rejection_reason` text DEFAULT NULL,
  `surat_permohonan_file` varchar(1000) DEFAULT NULL,
  `faktur_file` varchar(1000) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_proof_file` varchar(1000) DEFAULT NULL,
  `tax_payment_proof_file` varchar(1000) DEFAULT NULL,
  `documentation_link` text DEFAULT NULL,
  `applicant_recap_link` text DEFAULT NULL,
  `invoice_file` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booth_transactions`
--

INSERT INTO `booth_transactions` (`id`, `transaction_number`, `participant_id`, `status`, `total_price`, `additional_fee_price`, `feature_request`, `additional_request`, `additional_transaction_items`, `is_paid`, `payment_date`, `is_verified`, `is_payment_verified`, `rejection_reason`, `surat_permohonan_file`, `faktur_file`, `payment_type`, `payment_proof_file`, `tax_payment_proof_file`, `documentation_link`, `applicant_recap_link`, `invoice_file`, `created_at`, `updated_at`) VALUES
('9ef6b8f5-53b6-4ec6-908f-c6919f07a2b7', 1, '9ef6b8f5-4a5a-463f-a68e-dfeff148fed2', 'selesai', 2000000, '[{\"name\":\"PPN\",\"tax_type\":\"tax\",\"amount\":198198.1981981982},{\"name\":\"PPh\",\"tax_type\":\"tax\",\"amount\":100000},{\"name\":\"Service Charge\",\"tax_type\":\"non-tax\",\"amount\":2500}]', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 'misc/transaction/9ef6b8f5-53b6-4ec6-908f-c6919f07a2b7/surat_permohonan_file.docx', NULL, 'transfer', 'misc/transaction/9ef6b8f5-53b6-4ec6-908f-c6919f07a2b7/payment_proof_file.png', 'misc/transaction/9ef6b8f5-53b6-4ec6-908f-c6919f07a2b7/tax_payment_proof_file.jpg', '[\"https:\\/\\/drive.google.com\\/file\\/d\\/11ypR9TpGCGZ8VY8Ib6HwHsiDTPtkaqOl\\/view?usp=sharing\"]', NULL, NULL, '2025-05-21 03:57:02', '2025-05-25 03:53:58'),
('9eff3bb1-c4e1-4cb7-82fb-c0b29332953a', 2, '9eff3bb1-b55b-4a56-87b8-9e90f7445608', 'belum upload surat permohonan', 10000000, '[{\"name\":\"PPN\",\"tax_type\":\"tax\",\"amount\":990990.990990991},{\"name\":\"PPh\",\"tax_type\":\"tax\",\"amount\":500000},{\"name\":\"Service Charge\",\"tax_type\":\"non-tax\",\"amount\":2500}]', NULL, 'Kursi 2', NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'transfer', NULL, NULL, NULL, NULL, NULL, '2025-05-25 09:29:13', '2025-05-27 22:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` char(36) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `job_vacancies_link` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bidang_perusahaan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `logo`, `job_vacancies_link`, `created_at`, `updated_at`, `bidang_perusahaan`) VALUES
('9ee6bfe4-cb05-4202-b60a-bda5ea1cdcf7', 'PT Bank OCBC NISP', 'images/company/logo/1979e1e7-1c9a-400d-b441-8b5744c9be83.png', 'https://drive.google.com/ngetes', '2025-05-13 05:23:11', '2025-05-13 07:26:37', NULL),
('9ef0af56-14e9-4bea-a5b4-355af913c530', 'PT Otsuka Indonesia', 'images/company/logo/0f0d1548-6110-4928-bdde-87b184910b89.jpg', 'https://drive.google.com/ngetes', '2025-05-18 03:55:10', '2025-05-18 03:55:11', NULL),
('9efb2b0b-8c40-4fa0-b0ea-95e331679b78', 'PT Jamaica', NULL, NULL, '2025-05-23 08:59:21', '2025-05-23 08:59:21', 'Ekspor');

-- --------------------------------------------------------

--
-- Table structure for table `company_contacts`
--

CREATE TABLE `company_contacts` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_contacts`
--

INSERT INTO `company_contacts` (`id`, `name`, `email`, `phone_number`, `created_at`, `updated_at`) VALUES
('9eead8c8-ce20-4e78-8fff-facfa9e8fc23', 'PT Krisna Putra', 'krisnap2002@gmail.com', '081459018579', '2025-05-15 06:16:05', '2025-05-27 21:32:36'),
('9f0444f1-d6d4-4ec7-966a-0f44641172c6', 'PT Jamaica', 'krisnaputra1530@gmail.com', '0895365990827', '2025-05-27 21:34:13', '2025-05-27 21:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `company_registration_inputs`
--

CREATE TABLE `company_registration_inputs` (
  `id` char(36) NOT NULL,
  `column_name` varchar(500) NOT NULL,
  `column_label` varchar(500) NOT NULL,
  `column_type` varchar(255) NOT NULL,
  `is_nullable` tinyint(1) NOT NULL DEFAULT 0,
  `default_value` varchar(500) DEFAULT NULL,
  `list_value` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_registration_inputs`
--

INSERT INTO `company_registration_inputs` (`id`, `column_name`, `column_label`, `column_type`, `is_nullable`, `default_value`, `list_value`, `created_at`, `updated_at`) VALUES
('9ef2f6d0-d358-4e66-b12f-4978b13b0db7', 'bidang_perusahaan', 'Bidang Perusahaan', 'text', 0, NULL, NULL, '2025-05-19 07:06:41', '2025-05-19 07:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `video_link` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `slug`, `cover`, `type`, `description`, `is_active`, `video_link`, `created_at`, `updated_at`) VALUES
('9ef60cb3-83bf-4cdc-9538-109346ab33cf', 'Galeri 1', 'galeri-1', 'images/content/e32da09a-7eca-4ce4-ab33-6c0ce6734b2d.jpg', 'gallery', '-', 1, '[null]', '2025-05-20 19:55:22', '2025-05-20 19:55:22'),
('9efece39-e0c6-49aa-88cc-df21b1fb844b', 'Acara ini gratis atau berbayar?', 'acara-ini-gratis-atau-berbayar', NULL, 'faq', 'Acara ini gratis atau berbayar?', 1, '[null]', '2025-05-25 04:23:08', '2025-05-25 04:23:08'),
('9efecf7b-b6b1-4929-a5af-67491e263a2f', 'Brawijaya Career Expo 2025 Dibuka!', 'brawijaya-career-expo-2025-dibuka-diikuti-puluhan-perusahaan-hingga-instansi-yang-jadi-jembatan-emas-menuju-karier-impian', 'images/content/41559d7d-9edc-49ad-9900-d22035bc3d3e.jpeg', 'article', '<p>irektorat Pengembangan&nbsp;<a href=\"https://radarmalang.jawapos.com/tag/karier\">Karier</a>&nbsp;dan Alumni&nbsp;<a href=\"https://radarmalang.jawapos.com/tag/universitas\">Universitas</a>&nbsp;<a href=\"https://radarmalang.jawapos.com/tag/brawijaya\">Brawijaya</a>&nbsp;(<a href=\"https://radarmalang.jawapos.com/tag/ub\">UB</a>) kembali menggelar Career&nbsp;<a href=\"https://radarmalang.jawapos.com/tag/expo\">Expo</a>&nbsp;secara offline dimulai pukul 09.00 - 16.00 WIB.</p>\r\n<p>Acara yang digelar selama dua hari yakni Sabtu-Minggu (24-25 Mei 2025) tersebut bekerja sama dengan Engineeds FT-UB dan Mata Project FIA-UB dan diikuti oleh perusahaan, universitas, lembaga, instansi nasional dan multi nasional.</p>\r\n<p>Bertempat di Gedung Samantha Krida UB, Brawijaya Career Expo tersebut tidak hanya memberikan informasi mengenai karier atau lowongan pekerjaan (loker) dan magang saja, tetapi juga terdapat Pameran Beasiswa Studi Lanjut, Presentasi dan Seminar dari Perusahaan, Konseling Karier, Pameran Wirausaha, serta Bazar.</p>\r\n<div data-type=\"_mgwidget\" data-widget-id=\"1732839\">&nbsp;</div>\r\n<p>&rdquo;Pameran beasiswa ini akan memberikan informasi beasiswa studi lanjut yang sedang dibuka oleh berbagai instansi nasional dan multi nasional,\" terang Direktur Direktorat Pengembangan Karier Karuniawan Puji Wicaksono, S.P., M.P., Ph.D.</p>\r\n<p>Sementara untuk Pameran Beasiswa akan menginformasikan berbagai beasiswa baik dari dalam maupun luar negeri.</p>\r\n<center>\r\n<div class=\"ads mt3 clearfix\">\r\n<div class=\"ads__box\">&nbsp;</div>\r\n</div>\r\n</center>\r\n<p>Di mana ada pula Konseling Karier yang akan memberikan layanan konsultasi secara gratis terkait pengembangan karier.</p>\r\n<p>Sedangkan Bazar akan menampilkan berbagai macam makanan, minuman, dan souvenir dari berbagai UMKM yang dikelola UB.</p>\r\n<p>Selain gratis, Brawijaya Career Expo 2025 juga terbuka untuk umum, baik mereka para pencari kerja, pengunjung seminar, ataupun sekadar untuk menikmati expo.</p>\r\n<p>Dengan diikuti oleh 49 perusahaan, universitas, instansi, lembaga terbaik, dengan setidaknya ada 300 posisi karier yang dapat ditemukan dalam Brawijaya Career Expo 2025 itu.</p>\r\n<p>Untuk dapat mengikuti acara ini dapat mendaftar secara online melalui website https://careerexpo.ub.ac.id/. \"Jika Anda datang sebagai pencari kerja, hendaknya mempersiapkan dokumen yang sekiranya diperlukan saat melamar pekerjaan, karena bisa jadi perusahaan membuka lowongan membutuhkan kelengkapan itu,\" tutupnya.(Vid)</p>', 1, '[null]', '2025-05-25 04:26:38', '2025-05-25 04:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `x_length` tinyint(4) NOT NULL,
  `y_length` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `name`, `x_length`, `y_length`, `created_at`, `updated_at`) VALUES
('9ee496f4-bc03-4461-8c98-7f84efca5b78', 'BRAWIJAYA CAREER EXPO 2025 1', 33, 33, '2025-05-12 03:37:03', '2025-05-12 03:37:03'),
('9ef60fcd-5eec-492e-a8cc-414e86c0a3b1', 'BRAWIJAYA CAREER EXPO 2', 33, 33, '2025-05-20 20:04:02', '2025-05-20 20:04:02'),
('9f047e46-72f8-4741-a57d-421e488d9fc0', 'BRAWIJAYA CAREER EXPO 2026', 11, 13, '2025-05-28 00:14:32', '2025-05-28 00:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_12_065206_create_company_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2025_01_12_111418_create_personal_access_tokens_table', 1),
(6, '2025_01_16_135928_create_booths_table', 1),
(7, '2025_01_16_174638_create_company_registration_inputs_table', 1),
(8, '2025_01_17_092231_create_layouts_table', 1),
(9, '2025_01_18_071221_create_booth_layouts_table', 1),
(10, '2025_01_18_140547_add_column_to_booths_table', 1),
(11, '2025_01_19_164411_create_company_contacts_table', 1),
(12, '2025_01_20_135239_create_agendas_table', 1),
(13, '2025_01_20_173136_create_contents_table', 1),
(14, '2025_01_22_093504_create_settings_table', 1),
(15, '2025_01_24_162617_add_column_to_companies_table', 1),
(16, '2025_01_25_064613_create_agenda_participants_table', 1),
(17, '2025_01_25_064624_create_booth_transactions_table', 1),
(18, '2025_01_25_064630_create_registered_booths_table', 1),
(19, '2025_01_29_160604_add_column_to_booth_transactions_table', 1),
(20, '2025_01_29_162637_change_column_on_booth_transactions_table', 1),
(21, '2025_01_31_134929_add_column_to_booth_transactions_table', 1),
(22, '2025_01_31_135344_add_column_to_settings_table', 1),
(23, '2025_01_31_154322_add_column_to_booth_transactions_table', 1),
(24, '2025_01_31_185324_add_column_to_booth_transactions_table', 1),
(25, '2025_02_01_043654_add_column_to_settings_table', 1),
(26, '2025_02_01_043847_add_column_to_booth_transactions_table', 1),
(27, '2025_02_01_051513_add_column_to_settings_table', 1),
(28, '2025_02_02_065027_add_column_to_booth_transactions_table', 1),
(29, '2025_02_05_164615_add_column_to_contents_table', 1),
(30, '2025_02_05_191103_add_column_to_agendas_table', 1),
(31, '2025_05_06_174652_add_column_to_setting_table', 1),
(32, '2025_05_09_023558_add_column_to_booths_table', 1),
(33, '2025_05_09_024704_addcolumn_to_settings_table', 1),
(34, '2025_05_12_043507_add_column_to_booth_layouts_table', 1),
(35, '2025_05_13_113242_add_column_to_booth_transactions_table', 2),
(36, '2025_05_15_045820_add_column_to_booths_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered_booths`
--

CREATE TABLE `registered_booths` (
  `id` char(36) NOT NULL,
  `booth_layout_id` char(36) NOT NULL,
  `agenda_id` char(36) NOT NULL,
  `booth_transaction_id` char(36) DEFAULT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0,
  `fixed_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registered_booths`
--

INSERT INTO `registered_booths` (`id`, `booth_layout_id`, `agenda_id`, `booth_transaction_id`, `is_booked`, `fixed_price`, `created_at`, `updated_at`) VALUES
('0562f8ea-abe7-465a-a5b7-654fe6d4992e', '9eea2d60-2139-440b-846b-7418aa94689a', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 22:16:48', '2025-05-20 20:13:36'),
('06ce6702-1f1f-4a4e-8e3b-ec2814944a19', '9eea3667-a81a-4c1e-a031-3339eb7f25ce', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:42:03', '2025-05-14 22:42:03'),
('07143a96-9238-4e42-ba3d-0095c5bc1485', '9ee68551-17ac-4371-a8cf-bed888d0ed3b', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-13 02:39:23', '2025-05-13 07:53:39'),
('0afd895d-d439-46f9-bd7f-cad6103b8f1c', '9eea1daf-c45e-4f08-bc20-1eede87a1710', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:32:55', '2025-05-14 21:32:55'),
('0e3d7c8c-f30d-4a79-b1c7-5dcf0bc2b3a4', '9eea3980-6987-44a4-9578-914fa36b8541', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 5000000, '2025-05-14 22:50:42', '2025-05-14 22:50:42'),
('0f4d7056-fd89-464d-a07f-c4120d6c9d56', '9eea1e82-ca69-4599-974c-d10f9134f2a0', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:35:14', '2025-05-14 21:35:14'),
('1088d88d-9b71-458e-aa76-58bd7434d0e5', '9eea1df7-5d6a-4ef7-b7de-be3fb8f45f4c', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:33:42', '2025-05-14 21:33:42'),
('14e899a4-b753-4ceb-a54a-ae364230fa11', '9eea3a45-73da-414b-a3f6-615ae6b0a65f', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', '9eff3bb1-c4e1-4cb7-82fb-c0b29332953a', 1, 10000000, '2025-05-14 22:52:51', '2025-05-25 09:29:13'),
('15ab1bd3-d609-4922-9def-a1498a9caba0', '9eea1c33-b479-42a8-b809-89468e591d56', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', '9ef6b8f5-53b6-4ec6-908f-c6919f07a2b7', 1, 2000000, '2025-05-14 21:28:46', '2025-05-21 03:57:02'),
('197f6ae6-34a5-48ed-9dcd-ddaf308f2a63', '9eea3285-2339-4e3d-925c-733b122b3780', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 22:31:11', '2025-05-20 20:13:36'),
('1ec5a0d9-30ff-472c-a7d5-c24f2c40265a', '9eea1e9a-8b38-4b02-ba76-5bdc4e4ef972', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:35:29', '2025-05-14 21:35:29'),
('212d9bb4-271d-49bf-ba9a-f440826dadeb', '9eea2248-29ae-4f00-a599-52f407a63dfc', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:45:46', '2025-05-14 21:45:46'),
('251a52eb-d7fd-4abe-afc6-147bfd2ddfa9', '9eea36be-37f1-4cd5-8616-8e3a66df57e4', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:42:59', '2025-05-14 22:42:59'),
('2e87402e-ed6e-4997-b8de-4c90834f05a9', '9eea2cfe-4ff3-4f75-b717-f1dc998219f7', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:15:44', '2025-05-14 22:15:44'),
('3f4e54ce-bc12-4df3-b9c7-b98d5bc4a0c8', '9f048085-5a53-48f9-a4fd-e6d2d5695d94', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-28 00:20:49', '2025-05-28 00:20:49'),
('40fb12ba-e5ba-424e-903a-e8cb0a263e6e', '9eea1eb9-1f45-431c-80ed-53efca2a1993', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:35:49', '2025-05-14 21:35:49'),
('434f8a02-fd37-4043-81c7-d37878ad500a', '9eea2ca0-35e7-4a48-9797-f43f5ce5ee0a', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:14:42', '2025-05-14 22:14:42'),
('44a55c9c-6f84-4765-8acd-24b32d30fc72', '9eea368a-8cda-4d34-b14b-353da76e8e94', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:42:25', '2025-05-14 22:42:25'),
('4b1c7157-e558-444a-b7c6-edc534b64cc5', '9eea1cf8-e81b-4fd5-8e02-aa916bfaeb62', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:30:56', '2025-05-14 21:30:56'),
('57b5b9bd-8335-4d5b-a1e7-9d1d38b6c654', '9eea360e-4679-4b1e-8b04-8cedb9add001', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:41:04', '2025-05-14 22:41:04'),
('5f8a47fe-3330-4c15-a34a-610cad7be222', '9eea2bd4-9592-4bb5-b5b1-7ed98c441eac', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:12:28', '2025-05-14 22:12:28'),
('644554d1-a994-4873-bef0-3956c2887a75', '9eea1ca1-2d3f-4684-800c-84428e64441f', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:29:58', '2025-05-14 21:29:58'),
('67ae3ef5-2e5c-4dfb-8dcb-794c4696f756', '9eea1d6c-57e1-4543-8d18-c50b5e227a2e', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:32:11', '2025-05-14 21:32:11'),
('6c8d15e8-2157-47bb-8bb4-9681b08126b6', '9eea1c76-908c-4a14-8b69-4464189e5a58', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:29:30', '2025-05-14 21:29:30'),
('6e53c54c-e9d5-4fa5-8429-4940d8f665c4', '9eea2590-3771-4cc6-b45b-dd4c86cdd77c', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:54:57', '2025-05-14 21:54:57'),
('7161cf11-49c5-4367-8237-23c2ca4cb83b', '9eea3906-d43c-49fa-8486-8ea2881713be', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 5000000, '2025-05-14 22:49:22', '2025-05-14 22:49:22'),
('738e48db-11fa-44a9-a69a-2caa4b96b489', '9eea1c56-b49d-46ca-b965-695e6e5e0999', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:29:09', '2025-05-14 21:29:09'),
('752888f8-e469-49d7-ad02-62676a561d4f', '9eea1d49-765b-4c8c-ad4a-998b681bb6c3', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:31:48', '2025-05-14 21:31:48'),
('78cbdde1-356a-45d2-a63b-70cc1cd63c22', '9eea2cde-7bc2-4cb1-b221-dbacac1a7d4c', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:15:23', '2025-05-14 22:15:23'),
('7df47f8e-b177-43c9-84c3-c445ba97ac54', '9eea1e24-5d22-45d0-8c11-1f7e1dd07fe8', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:34:12', '2025-05-14 21:34:12'),
('8037f1c0-0224-42ff-a262-fd1768c1d726', '9eea36a1-daab-495b-b456-293c69a021c4', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:42:41', '2025-05-14 22:42:41'),
('8927582c-2f3a-458b-96fb-f4c5174dcfbe', '9eea38a1-c4a6-47ba-8535-4ae220e5b48a', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 5000000, '2025-05-14 22:48:16', '2025-05-14 22:48:16'),
('8acf86bb-9faf-4ade-99dd-7ee1c7c9a390', '9eea1f28-bd9b-4114-9a61-b3deda2c22f7', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:37:03', '2025-05-14 21:37:03'),
('8ebddff4-a532-490f-bad3-82446fed8f9b', '9eea1eef-a87d-4496-8467-a818a0408b85', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:36:25', '2025-05-14 21:36:25'),
('9c29a186-3d3c-457e-9578-b4cc8b95a2ca', '9eea1bf6-3264-47c4-b6c4-31a30e2edcf3', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:28:07', '2025-05-15 06:03:38'),
('9ca53e4e-b398-4f2c-8fa2-9204232e0e12', '9eea1e47-eedc-4ab3-8864-1d1cb70489a8', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:34:35', '2025-05-14 21:34:35'),
('a3ff251d-e85b-4bbe-990e-bb4080099907', '9eea25d8-98de-4aa7-8f97-63920ab02e85', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:55:44', '2025-05-14 21:55:44'),
('ac01544e-7d81-4a8e-afa2-1037364faae2', '9eea2bad-084f-4774-9016-67e23b9a4530', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:12:02', '2025-05-14 22:12:02'),
('aed4c166-c1f2-4a7b-b411-2481853c4a38', '9eea1cdb-926c-40a6-b508-3f9581c2c5c1', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:30:36', '2025-05-14 21:30:36'),
('af189864-1a2d-49f5-98c2-b4f6f654fc2a', '9eea2bf1-131e-42e3-b121-0892d62f4641', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:12:47', '2025-05-20 20:13:36'),
('b05ac5c8-8cc8-473c-b36c-95abc6a16225', '9eea1d91-778f-46cf-b3b5-9adb607441fe', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:32:36', '2025-05-14 21:32:36'),
('b354e84b-7609-4852-b424-729b083683b6', '9ef610be-0fa2-4016-b979-7ea0609110c0', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 5000000, '2025-05-20 20:06:40', '2025-05-20 20:06:40'),
('c37638fd-5d90-4a59-a170-cd9e8044a5eb', '9eea36d9-755e-4287-8fec-1ffc8a1fbd46', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:43:17', '2025-05-14 22:43:17'),
('c7bbf046-eeb7-4936-bd01-a65f108d6aea', '9eea25b2-9108-4bee-a1da-ac35e831bca7', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:55:19', '2025-05-14 21:55:19'),
('ceaa92c8-6a2b-4e8b-a2e0-69563d71950e', '9eea3354-7b00-4a11-b6a4-3db211f5e09d', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 22:33:27', '2025-05-20 20:13:36'),
('d136afb7-fa2c-446c-a144-533c1e5b4a7d', '9eea392d-4d88-4e33-9e4b-546113b96920', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 5000000, '2025-05-14 22:49:48', '2025-05-14 22:49:48'),
('d2aeed34-0292-4bce-93b4-b3934cae593c', '9eea1e65-2f2b-48a1-afe0-ca5261720de9', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:34:54', '2025-05-14 21:34:54'),
('ddd2cef8-56d9-4471-94a8-8669fec37963', '9eea2cbc-7ef3-4d24-b6d7-bcbd0d6714f6', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:15:00', '2025-05-14 22:15:00'),
('e9c2b0ad-5162-4d3f-ba33-eac70fd95cf5', '9eea2c7f-0809-4032-930c-5920b98c81e3', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:14:20', '2025-05-20 20:13:36'),
('e9f43bd1-9903-4a1e-a7b4-fc214ccaa0f2', '9eea1c13-5bf2-4901-b39d-f3a5a4e688dd', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 2000000, '2025-05-14 21:28:25', '2025-05-15 06:03:38'),
('f2980979-cd27-49db-a1f6-43b8f8ed3926', '9eea2c23-7e7a-4575-b9f7-2f07aec77b83', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:13:20', '2025-05-20 20:13:36'),
('f394600f-4566-408d-a726-340e4b7e2286', '9eea35f1-fb80-4b0c-9251-7b1f6ba62d01', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 22:40:45', '2025-05-14 22:40:45'),
('f8e687dd-14de-4519-a7ea-bb2f1e24175b', '9eea39d9-9cb1-4ee3-bb7c-d51aecd1144a', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 5000000, '2025-05-14 22:51:40', '2025-05-14 22:51:40'),
('fbf3c635-afbd-4ed1-a36a-727207c06d34', '9eea25ff-49b1-4854-8881-41bb1621cd0c', '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c', NULL, 0, 1000000, '2025-05-14 21:56:10', '2025-05-14 21:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('30YTR7U11OCCl419SwiCdbPct0FNhCEGfiN0ujot', NULL, '3.255.229.77', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNTMzRzI5dm1GZ2xmSFplRmt6V2lyZUIzSzRITzR6ZXBKazRFam82UiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovL21haWwua3Jpc25hcHV0cmEuYml6LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748775065),
('55aH9vP7TMI4PQTrNTc6LwnzFwoaLJtbRkJvpJsL', NULL, '172.245.241.123', 'Mozilla/5.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMFRPelZTeHBET1VuRlRmYmQ4MzJncXhzWWt5dlFQeVg2VVRVcU1TdSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748466668),
('6LuU4YRSicHCfzfsus4hW7hbKvLYv7rgWzpp2wHl', NULL, '40.69.66.139', '', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVVoxc20xVGRNSmhsb3Y3NnNqSFhWN0xTV0tCOWZVbUtXM2lXTXVmayI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZC9nYWxsZXJ5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748514167),
('7kTRSgxU4xdKo50D0DshKcgGTGv7COgNOIWTfEIO', '9ee489c9-ff0f-4f55-92aa-7cc114e77f37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiamdkNjBROUFzTTlyM1N0cXB2VUFtcXRCeERXSmVWM0kxRU94WHNXQyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NvbXBhbnktY29udGFjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiI5ZWU0ODljOS1mZjBmLTRmNTUtOTJhYS03Y2MxMTRlNzdmMzciO30=', 1748406854),
('bhzFRKfaeV6pUuBrmahXLzG7XzG6XWReuYU52o03', NULL, '3.232.134.131', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1RIUmRCSkZwWkFCU2NUMnFwc0ZOclFWblpoOEFVZXJydDNzWlVSTSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748781121),
('gdpRsSF4rckq4P90xPJ2zUDF17wxSIBBpktiVPpt', NULL, '108.136.234.48', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1V0OUhka0xrelFKNDBtalBGYThHTno4OWhDT2xSUW1OUUxLcFZ1aCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNTM6Imh0dHBzOi8va3Jpc25hcHV0cmEuYml6LmlkL25ld3MvYnJhd2lqYXlhLWNhcmVlci1leHBvLTIwMjUtZGlidWthLWRpaWt1dGktcHVsdWhhbi1wZXJ1c2FoYWFuLWhpbmdnYS1pbnN0YW5zaS15YW5nLWphZGktamVtYmF0YW4tZW1hcy1tZW51anUta2FyaWVyLWltcGlhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748527671),
('gEcqZlFNgLiU5X4dPIqJyJBElCwlG8hnLzqCksNt', '9ee489c9-ff0f-4f55-92aa-7cc114e77f25', '175.45.190.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieUc2YzZVbkVSSHVhaW5xdUQweTAxMkFLQXhiQnE2SXhrYlFBN052MyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo4MjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQvYWRtaW4vbGF5b3V0LzllZTQ5NmY0LWJjMDMtNDQ2MS04Yzk4LTdmODRlZmNhNWI3OC9ib290aCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiI5ZWU0ODljOS1mZjBmLTRmNTUtOTJhYS03Y2MxMTRlNzdmMjUiO30=', 1748416849),
('gh80cGYdytYoOX0V1Q4DypZl7bn0vFWolrCl1pJv', NULL, '54.244.38.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFU1bmxuWlhPcVZuUThhaU1FM0phVFBwNHQ5b3FvNzdFVjZKUUt4TSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748520050),
('h9VyPtXGkv4iX4aCSGRK3yX4qYMYbYYRxlMu9Xvo', 'c0c5a9d7-48f8-4d18-ad90-7beacd981dd6', '175.45.190.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaFhBVGh6cndWcmk3bFZJb1RrSFlQZUpSUlNhVFBSbVdtSktqeDBBVSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo5NzoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQvYWRtaW4vYm9vdGgtb3JkZXIvOWVlNTQ5MWEtMzFkMS00ZWUwLWI4YWQtNWFlZjc5OWRkMThjL2Jvb3RoLXNlbGVjdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiJjMGM1YTlkNy00OGY4LTRkMTgtYWQ5MC03YmVhY2Q5ODFkZDYiO30=', 1748416893),
('Hu0wPhmaKsyWchfFck9Is9NgcSjpGMtZauv3JFPH', NULL, '198.199.66.251', 'Mozilla/5.0 (X11; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWDVFZkpaSnBHaGVLSG4xTVZmREZDSHZieGluMjhDTVVYMzNaWWRPTSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748414249),
('iaLHn4MNp9ikGTf0xo5EWREPsR5rMJh9dX1Xl4VC', NULL, '34.31.179.137', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:21.0) Gecko/20130331 Firefox/21.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOXY1amd3cTVyWjV1dFVnMTVYWk52TGdhcnJFbG5hZEF3S3VlZGpLaCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748480925),
('IvFF1KdeCXuDsBfavpicXY2l30ioRcghgUiEIv2d', NULL, '167.172.84.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzRMSXJ6dmgxenNzeVZUc3dsVWJhbmhmOXN2OTRtd0t4VDlPMHFOZCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748413999),
('JF4st03djv6Bf2bm1BvqoZl5Ddmy9Nm20iluH0Dv', NULL, '94.247.172.129', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUk9qZkxwMVpxYUVRTDZTWXRsdzFRaFZFN05xYlpWcnhPQklWeHBINCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cHM6Ly93d3cua3Jpc25hcHV0cmEuYml6LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748550792),
('jSaQwOexWBxq6iyUTbg5pa3eSg7UvWmTjcUdFjmE', NULL, '43.218.226.229', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicG9XaUExbWF5Tk5QUk9xeHFhbkI1cUpMTjNhTFBZRE1Oa3JXdUYxOCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoxNTc6Imh0dHBzOi8vd3d3LmtyaXNuYXB1dHJhLmJpei5pZC9uZXdzL2JyYXdpamF5YS1jYXJlZXItZXhwby0yMDI1LWRpYnVrYS1kaWlrdXRpLXB1bHVoYW4tcGVydXNhaGFhbi1oaW5nZ2EtaW5zdGFuc2kteWFuZy1qYWRpLWplbWJhdGFuLWVtYXMtbWVudWp1LWthcmllci1pbXBpYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748506087),
('oh1YFhBy6tINSR5zD1rBSgeEnjtcUDDD7S3Kxs7T', NULL, '3.232.134.131', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOEkzUGZ5OHFreDZGMUxzOG9xWUI0dzhvYThjaFVnUldWd21rd3d1TyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyOToiaHR0cDovL3d3dy5rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748781122),
('PbbAoLaDBOKcFya0VdI5O3rm9KdR0hqLdapk6Q21', NULL, '34.141.215.20', 'Scrapy/2.12.0 (+https://scrapy.org)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGp3VWhTaVprd2ZiMjF0bm9zZTdnUVF4UzJqODhkU2lmeTZxWENVbyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cHM6Ly93d3cua3Jpc25hcHV0cmEuYml6LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748502925),
('QnbR6nQwipXnM64Ub5VSzuqsRpHlJkfLzuiUSv2F', NULL, '84.39.118.42', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibEhGYkFpczFia00wRzdwcG0wSFNrbDBiRUNoamg2WkxzODd3QjRSbyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQvZ2FsbGVyeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748412082),
('rjVnraLqxy9kzu4UYLPbXX9exRXmtxY81vaR4qwl', NULL, '136.243.228.178', 'Mozilla/5.0 (compatible; DataForSeoBot/1.0; +https://dataforseo.com/dataforseo-bot)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWpFd3ZLdWVVZTVQRmFmTWNXcldCYndiNVpBbEw3QnA1NjNUVnB1diI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NzoiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZC9uZXdzLzllZmVjZjdiLWI2YjEtNDkyOS1hNWFmLTY3NDkxZTI2M2EyZiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748640586),
('SkIwtvGaT44bnJnHbP4dLl3bk3ECatOGOrzNi0SA', NULL, '103.186.60.23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMmR1NHdkc2c5Y3NucFNZMXBpaG9KZ1BzTnJvemZvQjJDSWZ2R3VtTCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748692812),
('suzCBJOXPUI6dUfuCiCOeY6gHQzhypehqbrH53aX', NULL, '45.156.129.65', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVB1eFBJZFJCcEtham80bjAzb2ZUVVRwUVJmOFo5STREdERFUnN1MCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748608760),
('u1UbnbEfHc3bdtkVbbddcj1aSYyPlPhHihyVAB7Q', NULL, '35.204.145.47', 'Scrapy/2.12.0 (+https://scrapy.org)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWUpERkVaMG4zV2RCMXlQQjIxd0FQSWV1ank4anFwYmM5c2s2a0Y0ciI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMToiaHR0cHM6Ly9tYWlsLmtyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748502938),
('UCMzyDxJbx2F9XnnitVxLvbI1TmfLGfpBR1eJeQS', NULL, '185.247.137.123', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjJJa3J1STlXdDBIU24wd3BkejJFY2dUbWFvS3RUU29zVHduV0hLMyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovL21haWwua3Jpc25hcHV0cmEuYml6LmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748709813),
('uNH2BipJs9rvC7b8NViXffeV5YZ48NyWYbT3fHBH', NULL, '198.199.66.251', 'Mozilla/5.0 (X11; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSm92VTUyT0RtZEVua2RaUFp5U3BCcWlDUkNvckFVaWFNSWw3OFM3cCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748414251),
('v1OFMjtzRUXDxnEFC4XnhoM9vvKdA4Teda07jPOc', NULL, '130.89.144.164', 'OI-Crawler/Nutch (https://openintel.nl/webcrawl/)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWTU3NDNGYjAweTNteVNIWkdRbEJOWFFiNW14TzQ5UFpIY01DakF2YiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748416584),
('wlDoyTNswNjwYk65RWfNPAB6Xq02EkOnvekfjYHx', NULL, '88.210.34.75', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQk9IVDdRZDEzZTB5U1N6akJpVTdSdG90UFlMSWp5RTdWWmtnNGJobCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748675795),
('xHlrBxVFqAalMHVnHoCYQwfqB11IkEkXtOuDHWmI', NULL, '172.236.137.112', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFZCcDBjZHNLM3VYUlpvc1R5WFlXcERmRG9vdmZ6ajBtdURIdVp4RiI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748513888),
('xJ8CyMIVY0IBP8Kmtz4Evkgo4PWZI03g9ZmXcUi2', NULL, '52.12.243.100', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaHZtRXVZbmFJQjRZU2hXQlczdGdHUnF2dHJFTkI2RFRjVndSUm1KNCI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly9rcmlzbmFwdXRyYS5iaXouaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748411790),
('y6hjlG4VX3zQIWKYiuebCcQJhGotdw09nh4NACps', NULL, '142.93.119.234', 'Go-http-client/1.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiODltNTNFSEpoOHI5dkJURGQ0Qk9OSzZGdzZsbEtVUXRTMVo1MWRLZSI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748622303),
('Z7Uj6kDGGrz8x7k5VqxU3jHFZLWzwoSrYi37IWMP', NULL, '109.199.118.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36 Edg/91.0.864.54', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUjI0a2JuZXRraVVuNmZkaEFqZFhURUhXQ3JpdG51UWVSTGVqakl1UyI7czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL2tyaXNuYXB1dHJhLmJpei5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748548381);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` char(36) NOT NULL,
  `default_email` varchar(500) DEFAULT NULL,
  `message_template` text DEFAULT NULL,
  `wa_message_template` text DEFAULT NULL,
  `default_wa_number` varchar(15) DEFAULT NULL,
  `booth_bank_account_code` varchar(4) DEFAULT NULL,
  `booth_bank_account_name` varchar(255) DEFAULT NULL,
  `booth_bank_account_number` varchar(255) DEFAULT NULL,
  `booth_bank_account_owner` varchar(255) DEFAULT NULL,
  `tax_bank_account_code` varchar(4) DEFAULT NULL,
  `tax_bank_account_name` varchar(255) DEFAULT NULL,
  `tax_bank_account_number` varchar(255) DEFAULT NULL,
  `tax_bank_account_owner` varchar(255) DEFAULT NULL,
  `surat_permohonan_template_file` varchar(500) DEFAULT NULL,
  `invoice_number_format` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `additional_fee_settings` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `default_email`, `message_template`, `wa_message_template`, `default_wa_number`, `booth_bank_account_code`, `booth_bank_account_name`, `booth_bank_account_number`, `booth_bank_account_owner`, `tax_bank_account_code`, `tax_bank_account_name`, `tax_bank_account_number`, `tax_bank_account_owner`, `surat_permohonan_template_file`, `invoice_number_format`, `created_at`, `updated_at`, `additional_fee_settings`) VALUES
('9ee4efce-ed77-411b-8812-477a1955954b', '', NULL, 'baby, aku kecewa sama kamu. mulai saat ini, kita adalah teman:(', '081459018579', '008', 'BANK MANDIRI', '891186155', 'Virtual Account', '009', 'BANK BNI', '785078508', 'Transactional   Bank Service', 'misc/setting/surat_permohonan_template.docx', '{}/BCE-I/DPKA/II/', '2025-05-12 07:45:30', '2025-05-15 06:20:43', '{\"fee_name\":[\"PPN\",\"PPh\",\"Service Charge\"],\"fee_type\":[\"formula\",\"percentage\",\"exact\"],\"fee_tax_type\":[\"tax\",\"tax\",\"non-tax\"],\"fee_value\":[\"11\\/100 * (100\\/111 * {})\",\"5\",\"2500\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `company_id` char(36) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `fullname`, `username`, `password`, `role`, `phone_number`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
('5c37ea81-aca8-4220-b84e-b140c787c5d3', '9efb2b0b-8c40-4fa0-b0ea-95e331679b78', 'Breana Broom', 'breana30', '$2y$12$JY0GF6YH9F8Az5NrPdSlWu.p/gQh5fXfi2gaaxIYm6aZW7V/rxjz6', 'perwakilan-perusahaan', '081459018579', 1, NULL, '2025-05-23 08:57:43', '2025-05-23 08:59:21'),
('9ee489c9-ff0f-4f55-92aa-7cc114e77f25', NULL, 'Administrator', 'administrator', '$2y$12$iuco8pINjPLA5xzz/kPCPePAqMrdV5KS5XlKbKrH7RkrVbkZuD4Ze', 'administrator', '081459018579', 1, NULL, '2025-05-12 03:00:14', '2025-05-12 03:17:06'),
('9ee489c9-ff0f-4f55-92aa-7cc114e77f37', NULL, NULL, 'humas', '$2y$12$iuco8pINjPLA5xzz/kPCPePAqMrdV5KS5XlKbKrH7RkrVbkZuD4Ze', 'humas', NULL, 1, NULL, '2025-05-12 03:00:14', '2025-05-12 03:00:14'),
('c0c5a9d7-48f8-4d18-ad90-7beacd981dd6', '9ee6bfe4-cb05-4202-b60a-bda5ea1cdcf7', 'Savanna Monica', 'savanna88', '$2y$12$iuco8pINjPLA5xzz/kPCPePAqMrdV5KS5XlKbKrH7RkrVbkZuD4Ze', 'perwakilan-perusahaan', '081459018579', 1, NULL, '2025-05-12 03:36:29', '2025-05-13 07:26:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agendas_slug_unique` (`slug`),
  ADD KEY `agendas_layout_id_foreign` (`layout_id`);

--
-- Indexes for table `agenda_participants`
--
ALTER TABLE `agenda_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_participants_agenda_id_foreign` (`agenda_id`),
  ADD KEY `agenda_participants_user_id_foreign` (`user_id`);

--
-- Indexes for table `booths`
--
ALTER TABLE `booths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booth_layouts`
--
ALTER TABLE `booth_layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booth_layouts_layout_id_foreign` (`layout_id`),
  ADD KEY `booth_layouts_booth_id_foreign` (`booth_id`);

--
-- Indexes for table `booth_transactions`
--
ALTER TABLE `booth_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booth_transactions_participant_id_foreign` (`participant_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_contacts`
--
ALTER TABLE `company_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_registration_inputs`
--
ALTER TABLE `company_registration_inputs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contents_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `registered_booths`
--
ALTER TABLE `registered_booths`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registered_booths_booth_layout_id_foreign` (`booth_layout_id`),
  ADD KEY `registered_booths_agenda_id_foreign` (`agenda_id`),
  ADD KEY `registered_booths_booth_transaction_id_foreign` (`booth_transaction_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agendas`
--
ALTER TABLE `agendas`
  ADD CONSTRAINT `agendas_layout_id_foreign` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`);

--
-- Constraints for table `agenda_participants`
--
ALTER TABLE `agenda_participants`
  ADD CONSTRAINT `agenda_participants_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`),
  ADD CONSTRAINT `agenda_participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `booth_layouts`
--
ALTER TABLE `booth_layouts`
  ADD CONSTRAINT `booth_layouts_booth_id_foreign` FOREIGN KEY (`booth_id`) REFERENCES `booths` (`id`),
  ADD CONSTRAINT `booth_layouts_layout_id_foreign` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`);

--
-- Constraints for table `booth_transactions`
--
ALTER TABLE `booth_transactions`
  ADD CONSTRAINT `booth_transactions_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `agenda_participants` (`id`);

--
-- Constraints for table `registered_booths`
--
ALTER TABLE `registered_booths`
  ADD CONSTRAINT `registered_booths_agenda_id_foreign` FOREIGN KEY (`agenda_id`) REFERENCES `agendas` (`id`),
  ADD CONSTRAINT `registered_booths_booth_layout_id_foreign` FOREIGN KEY (`booth_layout_id`) REFERENCES `booth_layouts` (`id`),
  ADD CONSTRAINT `registered_booths_booth_transaction_id_foreign` FOREIGN KEY (`booth_transaction_id`) REFERENCES `booth_transactions` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
