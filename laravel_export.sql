-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 19 mai 2025 à 14:37
-- Version du serveur : 8.2.0
-- Version de PHP : 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

DROP TABLE IF EXISTS `absences`;
CREATE TABLE IF NOT EXISTS `absences` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` int NOT NULL,
  `year` int NOT NULL,
  `cp_value` decimal(5,1) NOT NULL DEFAULT '0.0',
  `m_value` decimal(5,1) NOT NULL DEFAULT '0.0',
  `a_value` decimal(5,1) NOT NULL DEFAULT '0.0',
  `day_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_number` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `nombre_formation_suivi` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agents_service_id_index` (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agents`
--

INSERT INTO `agents` (`id`, `nom`, `prenom`, `service_id`, `nombre_formation_suivi`, `created_at`, `updated_at`) VALUES
(37, 'KABRANE', 'dounia', 3, 1, '2025-05-16 09:46:37', '2025-05-16 09:46:37'),
(2, 'aoujil', 'ali', 3, 1, '2025-04-16 10:03:09', '2025-04-16 10:03:09'),
(36, 'JAABAK', 'sanae', 3, 1, '2025-05-16 09:45:46', '2025-05-16 09:45:46'),
(35, 'HANNOUTI', 'narjisse', 3, 1, '2025-05-16 09:45:25', '2025-05-16 09:50:50'),
(14, 'ehud', ',', 3, 1, '2025-04-24 11:14:52', '2025-04-24 11:14:52'),
(34, 'EL HADAD', 'soumaya', 3, 1, '2025-05-16 09:44:49', '2025-05-16 09:44:49'),
(33, 'FARROUHA', 'safae', 3, 1, '2025-05-16 09:44:26', '2025-05-16 09:44:26'),
(21, 'ABIDAR', 'meriame', 3, 1, '2025-05-16 09:34:43', '2025-05-16 09:34:43'),
(32, 'EL MERZOUGI', 'zineb', 3, 1, '2025-05-16 09:44:00', '2025-05-16 09:44:00'),
(22, 'BA', 'aboubacar', 3, 1, '2025-05-16 09:35:13', '2025-05-16 09:35:13'),
(23, 'BELRHIT', 'malak', 3, 1, '2025-05-16 09:35:35', '2025-05-16 09:35:35'),
(24, 'BENDRAOUI', 'abdelwahed', 3, 1, '2025-05-16 09:36:07', '2025-05-16 09:36:07'),
(25, 'BIKRI', 'fatima', 3, 1, '2025-05-16 09:36:37', '2025-05-16 09:36:37'),
(26, 'BOUAAZA', 'hayat', 3, 1, '2025-05-16 09:36:58', '2025-05-16 09:36:58'),
(27, 'BOULAICH', 'amal', 3, 1, '2025-05-16 09:37:22', '2025-05-16 09:37:22'),
(28, 'BOUZID', 'sonia', 3, 1, '2025-05-16 09:37:43', '2025-05-16 09:37:43'),
(29, 'CHOUAIB', 'hasnae', 3, 1, '2025-05-16 09:38:05', '2025-05-16 09:38:05'),
(30, 'EL FAZAZI', 'saad', 3, 1, '2025-05-16 09:38:54', '2025-05-16 09:38:54'),
(31, 'EL HILALI', 'nisrine', 3, 1, '2025-05-16 09:39:18', '2025-05-16 09:39:18'),
(38, 'KASSEMI', 'oumaima', 3, 1, '2025-05-16 09:46:59', '2025-05-16 09:46:59'),
(39, 'KOUBAITI', 'hind', 3, 0, '2025-05-16 09:47:19', '2025-05-16 09:47:19'),
(40, 'LAARAJ', 'ibrahim', 3, 1, '2025-05-16 09:47:42', '2025-05-16 09:47:42'),
(41, 'LAAROUSSI', 'houssam', 3, 1, '2025-05-16 09:48:08', '2025-05-16 09:48:08'),
(42, 'LEGROUBI', 'yassine', 3, 1, '2025-05-16 09:48:51', '2025-05-16 09:48:51'),
(43, 'MOUSLIH', 'el hassan', 3, 1, '2025-05-16 09:49:16', '2025-05-16 09:49:16'),
(44, 'RHANDOUR', 'hala', 3, 1, '2025-05-16 09:49:41', '2025-05-16 09:49:41'),
(45, 'SABIRI', 'maha', 3, 1, '2025-05-16 09:49:58', '2025-05-16 09:49:58'),
(46, 'SEDRA', 'wissal', 3, 1, '2025-05-16 09:51:34', '2025-05-16 09:51:34'),
(47, 'SOUDANI', 'mohammed', 3, 1, '2025-05-16 09:54:09', '2025-05-16 09:54:09'),
(48, 'TOUILE', 'ilane', 3, 1, '2025-05-16 09:54:28', '2025-05-16 09:54:28'),
(49, 'YAKOLA', 'saint cyre', 3, 1, '2025-05-16 09:54:50', '2025-05-16 09:54:50'),
(50, 'ZEHOUANI', 'rachida', 3, 1, '2025-05-16 09:55:12', '2025-05-16 09:55:12'),
(51, 'ABILA', 'zahira', 1, 1, '2025-05-16 09:55:56', '2025-05-16 09:55:56'),
(52, 'AFAZZAZ', 'oumayma', 1, 1, '2025-05-16 09:56:17', '2025-05-16 09:56:17'),
(53, 'ALILOU', 'bouchra', 1, 1, '2025-05-16 09:56:37', '2025-05-16 09:56:37'),
(54, 'ANASS', 'radouane', 1, 1, '2025-05-16 09:56:58', '2025-05-16 09:56:58'),
(55, 'AZGHIN', 'hanae', 1, 1, '2025-05-16 09:57:22', '2025-05-16 09:57:22'),
(56, 'BA AWA', 'merieme', 1, 1, '2025-05-16 09:57:46', '2025-05-16 09:57:46'),
(57, 'BEAUTY', ',', 1, 1, '2025-05-16 09:58:02', '2025-05-16 09:58:02'),
(58, 'BENNANI', 'hanane', 1, 1, '2025-05-16 09:58:23', '2025-05-16 09:58:23'),
(59, 'BOUZARI', 'fatima zehra', 1, 1, '2025-05-16 10:01:34', '2025-05-16 10:01:34'),
(60, 'BEN CHEKROUN', 'el mehdi', 1, 1, '2025-05-16 10:02:08', '2025-05-16 10:02:08'),
(61, 'ABOUBAKR', 'mourig', 1, 1, '2025-05-16 10:02:29', '2025-05-16 10:02:29'),
(62, 'CHOUAIB', 'imane', 1, 1, '2025-05-16 10:10:45', '2025-05-16 10:10:45'),
(63, 'DRISSI', 'chaymae', 1, 1, '2025-05-16 10:11:06', '2025-05-16 10:11:06'),
(64, 'DAMAOUN', 'fatima zehra', 1, 1, '2025-05-16 10:11:36', '2025-05-16 10:11:36'),
(65, 'FILALI', 'salma', 1, 1, '2025-05-16 10:14:43', '2025-05-16 10:14:43'),
(66, 'AMZIANE', 'mohammed', 1, 1, '2025-05-16 10:15:17', '2025-05-16 10:15:17'),
(67, 'HAOURI', 'fatima zahra', 1, 1, '2025-05-16 10:15:53', '2025-05-16 10:15:53'),
(68, 'JABIR', 'sahar', 1, 1, '2025-05-16 10:16:17', '2025-05-16 10:16:17'),
(69, 'KOUBAITI', 'nada', 1, 1, '2025-05-16 10:47:53', '2025-05-16 10:47:53'),
(70, 'MAKHLOU', 'meriame', 1, 1, '2025-05-16 10:48:16', '2025-05-16 10:48:16'),
(71, 'MOUAA', 'wissal', 1, 1, '2025-05-16 10:48:38', '2025-05-16 10:48:38'),
(72, 'NAKSIS', 'narjis', 1, 1, '2025-05-16 10:49:02', '2025-05-16 10:49:02'),
(73, 'NDIYAE', 'zeynab', 1, 1, '2025-05-16 10:49:21', '2025-05-16 10:49:21'),
(74, 'OUMOUDOU', 'bouchra', 1, 1, '2025-05-16 10:49:46', '2025-05-16 10:49:46'),
(75, 'ELHOUR', 'imane', 1, 1, '2025-05-16 10:50:02', '2025-05-16 10:50:02'),
(76, 'RADI', 'safae', 1, 1, '2025-05-16 10:50:30', '2025-05-16 10:50:30'),
(77, 'ATTIKOATI', 'gratias', 1, 1, '2025-05-16 10:50:57', '2025-05-16 10:50:57'),
(78, 'CHERQAOUI', 'nada', 1, 1, '2025-05-16 10:51:15', '2025-05-16 10:51:15'),
(79, 'ZEROUALI', 'souad', 1, 1, '2025-05-16 10:51:41', '2025-05-16 10:51:41'),
(80, 'DUIEB', 'yassin', 1, 1, '2025-05-16 10:53:57', '2025-05-16 10:53:57'),
(81, 'BOUBOUE', 'tresor', 1, 1, '2025-05-16 10:54:20', '2025-05-16 10:54:20'),
(82, 'TELUIN', 'sohaib', 1, 1, '2025-05-16 10:54:36', '2025-05-16 10:54:36'),
(83, 'BANLCAEM', 'najlae', 5, 1, '2025-05-16 11:05:22', '2025-05-16 11:05:22'),
(84, 'OLIVIA', ',', 5, 1, '2025-05-16 11:05:48', '2025-05-16 11:05:48'),
(85, 'SECK', 'awa', 5, 1, '2025-05-16 11:06:02', '2025-05-16 11:06:02'),
(86, 'HORMA', 'nada', 5, 1, '2025-05-16 11:06:18', '2025-05-16 11:06:18'),
(87, 'SOUIRI', 'houda', 5, 1, '2025-05-16 11:06:38', '2025-05-16 11:06:38'),
(88, 'AUBRY', 'kenza', 5, 1, '2025-05-16 11:07:06', '2025-05-16 11:07:06'),
(89, 'ELKHAOUA', 'dalal', 2, 1, '2025-05-16 11:07:26', '2025-05-16 11:07:26'),
(90, 'HAMMICH', 'mariam', 2, 1, '2025-05-16 11:07:44', '2025-05-16 11:07:44'),
(91, 'RAMZY', 'nizar', 2, 1, '2025-05-16 11:07:59', '2025-05-16 11:07:59'),
(92, 'CHEKROUNE', 'salah eddin', 4, 1, '2025-05-16 11:08:27', '2025-05-16 11:08:27'),
(93, 'AOUGESTON', ',', 4, 1, '2025-05-16 11:08:43', '2025-05-16 11:08:43');

-- --------------------------------------------------------

--
-- Structure de la table `agent_ribs`
--

DROP TABLE IF EXISTS `agent_ribs`;
CREATE TABLE IF NOT EXISTS `agent_ribs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `agent_id` bigint UNSIGNED NOT NULL,
  `rib` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','new rib') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agent_ribs_agent_id_foreign` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agent_ribs`
--

INSERT INTO `agent_ribs` (`id`, `agent_id`, `rib`, `status`, `created_at`, `updated_at`) VALUES
(15, 29, '350810000000001177164334', 'new', '2025-05-19 11:16:21', '2025-05-19 11:16:21'),
(12, 21, '022640000104002858536321', 'new', '2025-05-19 11:12:23', '2025-05-19 11:12:23'),
(14, 23, '011640000024200000904091', 'new', '2025-05-19 11:15:46', '2025-05-19 11:15:46'),
(13, 43, '007640001216700030231305', 'new', '2025-05-19 11:15:21', '2025-05-19 11:15:21'),
(16, 39, '022640000104002905959621', 'new', '2025-05-19 11:17:00', '2025-05-19 11:17:00'),
(17, 36, '164640211113008537000208', 'new', '2025-05-19 11:17:34', '2025-05-19 11:17:34'),
(18, 41, '164640211112075762000829', 'new', '2025-05-19 11:18:03', '2025-05-19 11:18:03'),
(19, 47, '230810301822921100610117', 'new', '2025-05-19 11:19:33', '2025-05-19 11:19:33'),
(20, 38, '230690370657421100750030', 'new', '2025-05-19 11:20:21', '2025-05-19 11:20:21'),
(21, 44, '011640000003200001714606', 'new', '2025-05-19 11:23:07', '2025-05-19 11:23:07'),
(22, 30, '007640000532230040117770', 'new', '2025-05-19 11:23:54', '2025-05-19 11:23:54'),
(23, 49, '007640000536500030488221', 'new', '2025-05-19 11:24:17', '2025-05-19 11:24:17'),
(24, 92, '164640211117505133000129', 'new', '2025-05-19 11:24:40', '2025-05-19 11:24:40'),
(25, 34, '350810000000000113101882', 'new', '2025-05-19 11:31:18', '2025-05-19 11:31:18'),
(26, 48, '164640211115136425001205', 'new', '2025-05-19 11:31:49', '2025-05-19 11:31:49'),
(27, 46, '007090000346900030523662', 'new', '2025-05-19 11:32:28', '2025-05-19 11:32:28'),
(28, 32, '230791737206821102640011', 'new', '2025-05-19 11:32:51', '2025-05-19 11:32:51'),
(29, 52, '230780811837921100230090', 'new', '2025-05-19 11:33:07', '2025-05-19 11:33:07'),
(30, 56, '022640000396002822466821', 'new', '2025-05-19 11:33:28', '2025-05-19 11:33:28'),
(31, 63, '181330211110596557000438', 'new', '2025-05-19 11:41:55', '2025-05-19 11:41:55'),
(32, 62, '350810000000001193433853', 'new', '2025-05-19 11:42:18', '2025-05-19 11:42:18'),
(33, 67, '022640000018003186526721', 'new', '2025-05-19 11:43:30', '2025-05-19 11:43:30'),
(34, 69, '164640211406069473001411', 'new', '2025-05-19 11:44:22', '2025-05-19 11:44:22'),
(35, 70, '230270297946821103220043', 'new', '2025-05-19 11:44:43', '2025-05-19 11:44:43'),
(36, 73, '350810000000001104524914', 'new', '2025-05-19 11:47:03', '2025-05-19 11:47:03'),
(37, 71, '007640000250100030899465', 'new', '2025-05-19 11:47:28', '2025-05-19 11:47:28'),
(38, 74, '230640403254721101170054', 'new', '2025-05-19 11:55:01', '2025-05-19 11:55:01'),
(39, 68, '230640262421521101170096', 'new', '2025-05-19 11:55:22', '2025-05-19 11:55:22'),
(40, 82, '007640000092430040030247', 'new', '2025-05-19 11:55:42', '2025-05-19 12:25:12'),
(41, 51, '230821269221321102050068', 'new', '2025-05-19 11:56:09', '2025-05-19 11:56:09'),
(42, 83, '007640000244530040100921', 'new', '2025-05-19 11:57:09', '2025-05-19 11:57:09'),
(43, 86, '181341211112987852001380', 'new', '2025-05-19 11:58:14', '2025-05-19 11:58:14'),
(44, 87, '011640000025200000311177', 'new', '2025-05-19 11:59:42', '2025-05-19 11:59:42'),
(45, 91, '007 640 0013687000305247 93', 'new', '2025-05-19 12:01:07', '2025-05-19 12:01:07'),
(46, 26, '164640211117489487000039', 'new', '2025-05-19 12:13:25', '2025-05-19 12:13:25'),
(47, 25, '007640000536900030311564', 'new', '2025-05-19 12:13:46', '2025-05-19 12:13:46'),
(48, 76, '230640713642221101720184', 'new', '2025-05-19 12:14:11', '2025-05-19 12:14:11'),
(49, 31, '022640000104002915310421', 'new', '2025-05-19 12:16:12', '2025-05-19 12:16:12'),
(50, 45, '230640429758521101690095', 'new', '2025-05-19 12:16:45', '2025-05-19 12:16:45'),
(51, 59, '230640411663121101180023', 'new', '2025-05-19 12:17:13', '2025-05-19 12:17:13'),
(52, 53, '021720000006400125434778', 'new', '2025-05-19 12:19:57', '2025-05-19 12:19:57'),
(53, 58, '164640211114635250000654', 'new', '2025-05-19 12:20:22', '2025-05-19 12:20:22'),
(54, 72, '230640370716621101180066', 'new', '2025-05-19 12:20:52', '2025-05-19 12:20:52'),
(55, 2, '007330000022330031007847', 'new', '2025-05-19 12:21:42', '2025-05-19 12:21:42'),
(56, 14, '350810000000001249832563', 'new', '2025-05-19 12:22:01', '2025-05-19 12:22:01'),
(57, 50, '230640282849321100600047', 'new', '2025-05-19 12:24:07', '2025-05-19 12:24:07'),
(58, 24, '230610317190121100160063', 'new', '2025-05-19 12:24:42', '2025-05-19 12:24:42'),
(59, 40, '230640460441621101680004', 'new', '2025-05-19 12:25:53', '2025-05-19 12:25:53'),
(60, 88, '007780000360100030895667', 'new', '2025-05-19 12:26:19', '2025-05-19 12:26:19'),
(61, 22, '007640001368500030145824', 'new', '2025-05-19 12:26:54', '2025-05-19 12:26:54'),
(62, 33, '007640001234830040001645', 'new', '2025-05-19 12:28:29', '2025-05-19 12:28:29'),
(63, 35, '230640773044821101180001', 'new', '2025-05-19 12:28:49', '2025-05-19 12:28:49'),
(64, 37, '007640001368900030527305', 'new', '2025-05-19 12:29:25', '2025-05-19 12:29:25'),
(65, 90, '230 640 3301156211016900 29', 'new', '2025-05-19 12:44:16', '2025-05-19 12:44:16'),
(66, 93, '007 640 0005361000305050 22', 'new', '2025-05-19 12:44:38', '2025-05-19 12:44:38');

-- --------------------------------------------------------

--
-- Structure de la table `agent_session`
--

DROP TABLE IF EXISTS `agent_session`;
CREATE TABLE IF NOT EXISTS `agent_session` (
  `agent_id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`agent_id`,`session_id`),
  KEY `agent_session_session_id_foreign` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agent_session`
--

INSERT INTO `agent_session` (`agent_id`, `session_id`) VALUES
(3, 3),
(9, 7),
(16, 5),
(16, 6),
(38, 6);

-- --------------------------------------------------------

--
-- Structure de la table `conge_agents`
--

DROP TABLE IF EXISTS `conge_agents`;
CREATE TABLE IF NOT EXISTS `conge_agents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp_total` decimal(5,1) NOT NULL DEFAULT '0.0',
  `date_suivi` date NOT NULL,
  `jour_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conge_agents_agent_id_foreign` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conge_agents`
--

INSERT INTO `conge_agents` (`id`, `agent_id`, `service`, `nom`, `prenom`, `cp_total`, `date_suivi`, `jour_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 'Courrier', 'elkhoua', 'dalal', 0.0, '2025-05-02', 'VENDREDI', 'C', '2025-05-02 12:33:40', '2025-05-02 12:33:40'),
(2, 7, 'Recouvrement', 'horma', 'nada', 0.0, '2025-05-05', 'LUNDI', 'A', '2025-05-05 09:04:36', '2025-05-05 09:04:36'),
(3, 14, 'Relance', 'ehud', ',', 0.0, '2025-05-05', 'LUNDI', 'M', '2025-05-05 09:06:00', '2025-05-05 09:06:00'),
(5, 10, 'Qualité', 'chekroune', 'salah eddin', 0.0, '2025-05-09', 'VENDREDI', 'C', '2025-05-05 12:59:46', '2025-05-05 12:59:46'),
(6, 9, 'Courrier', 'hammich', 'mariam', 0.0, '2025-05-05', 'LUNDI', 'M', '2025-05-14 08:46:50', '2025-05-14 08:46:50'),
(7, 16, 'Verif', 'filali', 'salma', 0.0, '2025-05-14', 'MERCREDI', 'A', '2025-05-14 09:42:24', '2025-05-14 09:42:24'),
(8, 2, 'Relance', 'aoujil', 'ali', 0.0, '2025-05-07', 'MERCREDI', 'M', '2025-05-14 10:18:30', '2025-05-14 10:18:30'),
(9, 5, 'Verif', 'afazzaz', 'oumayma', 0.0, '2025-05-04', 'DIMANCHE', 'C', '2025-05-14 12:58:55', '2025-05-14 12:58:55'),
(10, 7, 'Recouvrement', 'horma', 'nada', 0.0, '2025-05-26', 'LUNDI', 'A', '2025-05-15 12:37:36', '2025-05-15 12:37:36'),
(18, 93, 'Qualité', 'AOUGESTON', ',', 0.0, '2025-05-09', 'VENDREDI', 'C', '2025-05-17 22:57:27', '2025-05-17 22:57:27'),
(21, 34, 'Relance', 'EL HADAD', 'soumaya', 0.0, '2025-05-15', 'JEUDI', 'C', '2025-05-19 11:00:19', '2025-05-19 11:00:19'),
(16, 91, 'Courrier', 'RAMZY', 'nizar', 0.0, '2025-05-31', 'SAMEDI', 'C', '2025-05-16 13:44:02', '2025-05-16 13:44:02');

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_embauche` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `nom`, `prenom`, `date_embauche`, `created_at`, `updated_at`) VALUES
(6, 'rh', 'chaimae', '2024-10-25', '2025-05-10 13:57:58', '2025-05-10 13:57:58'),
(5, 'mef', 'souha', '2025-03-05', '2025-05-10 13:13:24', '2025-05-10 13:13:24'),
(3, 'meftah', 'souhaila', '2025-02-07', '2025-05-07 10:45:23', '2025-05-07 10:45:23'),
(7, 'afazzaz', 'oumayma', '2024-08-14', '2025-05-14 11:09:10', '2025-05-14 11:09:10'),
(8, 'AZGHIN', 'hanae', '2024-10-07', '2025-05-16 13:17:59', '2025-05-16 13:17:59');

-- --------------------------------------------------------

--
-- Structure de la table `leave_records`
--

DROP TABLE IF EXISTS `leave_records`;
CREATE TABLE IF NOT EXISTS `leave_records` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `conges_pris` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_records_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `leave_records`
--

INSERT INTO `leave_records` (`id`, `employee_id`, `conges_pris`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, '2025-05-07 10:24:24', '2025-05-07 10:24:24'),
(2, 2, 0.00, '2025-05-07 10:26:38', '2025-05-07 10:26:38'),
(3, 3, 1.00, '2025-05-07 10:45:23', '2025-05-07 13:55:22'),
(4, 4, 3.00, '2025-05-07 13:55:52', '2025-05-07 13:56:39'),
(5, 5, 1.00, '2025-05-10 13:13:24', '2025-05-10 13:14:15'),
(6, 6, 4.00, '2025-05-10 13:57:58', '2025-05-10 13:58:38'),
(7, 7, 7.00, '2025-05-14 11:09:10', '2025-05-15 14:12:49'),
(8, 8, 0.00, '2025-05-16 13:17:59', '2025-05-16 13:17:59');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_01_01_000000_create_agents_table', 1),
(2, '2023_01_01_000001_create_services_table', 2),
(3, '2025_04_10_093935_create_modules_table', 3),
(4, '2025_04_10_103340_create_sessions_table', 4),
(5, '2025_04_10_103504_create_agent_session_table', 5),
(6, '2025_04_10_130454_create_suivi_formation_table', 6),
(7, '2025_04_11_141207_create_suivi_qualites_table', 7),
(8, '2025_04_11_143027_add_titre_to_sessions_table', 8),
(9, '2025_04_30_152425_create_rib_agent_table', 9),
(10, '2025_05_02_113221_create_conge_agents_table', 10),
(11, '2025_05_07_093718_create_employees_table', 11),
(12, '2025_05_14_134947_create_absences_table', 12);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competences` text COLLATE utf8mb4_unicode_ci,
  `objectifs` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `service`, `titre`, `competences`, `objectifs`, `created_at`, `updated_at`) VALUES
(2, 'Courrier', 'module2', 'test2test2test', 'test2', '2025-04-16 10:09:23', '2025-05-05 09:20:39'),
(4, 'Qualité', 'module4', 'test4', 'test4', '2025-04-16 10:12:03', '2025-04-16 10:12:03'),
(7, 'Recouvrement', 'module2', 'tzst', 'test', '2025-04-23 09:07:23', '2025-04-23 09:07:23'),
(6, 'Relance', 'module6', 'test6', 'test6', '2025-04-16 11:27:57', '2025-04-16 11:27:57'),
(15, 'Verif', 'kjqjkjbcvoq', 'n cq', 'nq c', '2025-05-17 23:48:06', '2025-05-17 23:48:06'),
(8, 'Courrier', 'mod', 'test', 'test', '2025-04-23 12:50:01', '2025-04-23 12:50:01'),
(9, 'Courrier, Relance', 'module10', 'jbzosv', 'jboqeuvc', '2025-04-24 13:44:55', '2025-04-24 13:44:55'),
(16, 'Relance, Qualité, Recouvrement', 'CKJ', 'CJVQBD', 'n vj', '2025-05-17 23:48:25', '2025-05-17 23:48:25');

-- --------------------------------------------------------

--
-- Structure de la table `monthly_leaves`
--

DROP TABLE IF EXISTS `monthly_leaves`;
CREATE TABLE IF NOT EXISTS `monthly_leaves` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint UNSIGNED NOT NULL,
  `month_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_value` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monthly_leaves_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `monthly_leaves`
--

INSERT INTO `monthly_leaves` (`id`, `employee_id`, `month_key`, `leave_value`, `created_at`, `updated_at`) VALUES
(1, 3, '05/2025', 2.50, '2025-05-07 13:53:34', '2025-05-10 13:37:34'),
(2, 5, '05/2025', 1.50, '2025-05-10 13:53:28', '2025-05-10 13:53:28'),
(3, 6, '05/2025', 2.00, '2025-05-10 13:58:38', '2025-05-19 08:23:31'),
(4, 7, '05/2025', 2.50, '2025-05-15 14:12:49', '2025-05-15 14:12:49');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `couleur`, `created_at`, `updated_at`) VALUES
(1, 'Verif', '#90EE90', '2025-04-15 13:06:57', '2025-04-15 13:06:57'),
(2, 'Courrier', '#FFFF99', '2025-04-15 13:06:57', '2025-04-15 13:06:57'),
(3, 'Relance', '#DDA0DD', '2025-04-15 13:06:57', '2025-04-15 13:06:57'),
(4, 'Qualité', '#FFA07A', '2025-04-15 13:06:57', '2025-04-15 13:06:57'),
(5, 'Recouvrement', '#87CEFA', '2025-04-15 13:06:57', '2025-04-15 13:06:57');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_formation` date NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `nombre_agents` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_module_id_foreign` (`module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `date_formation`, `module_id`, `nombre_agents`, `created_at`, `updated_at`, `titre`) VALUES
(6, '2025-04-28', 9, 2, '2025-04-25 12:36:47', '2025-05-17 23:52:35', NULL),
(3, '2025-04-15', 2, 1, '2025-04-16 10:14:25', '2025-04-16 10:14:25', NULL),
(5, '2025-04-30', 7, 1, '2025-04-25 09:22:00', '2025-04-25 09:22:00', NULL),
(7, '2025-04-26', 6, 1, '2025-04-25 13:22:26', '2025-05-05 09:22:49', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `suivi_formation`
--

DROP TABLE IF EXISTS `suivi_formation`;
CREATE TABLE IF NOT EXISTS `suivi_formation` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` bigint UNSIGNED NOT NULL,
  `agent_id` bigint UNSIGNED NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INSCRIT',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suivi_formation_session_id_foreign` (`session_id`),
  KEY `suivi_formation_agent_id_foreign` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `suivi_formation`
--

INSERT INTO `suivi_formation` (`id`, `session_id`, `agent_id`, `statut`, `created_at`, `updated_at`) VALUES
(58, 6, 38, 'TERMINÉE', '2025-05-18 19:43:04', '2025-05-18 19:43:04');

-- --------------------------------------------------------

--
-- Structure de la table `suivi_qualites`
--

DROP TABLE IF EXISTS `suivi_qualites`;
CREATE TABLE IF NOT EXISTS `suivi_qualites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `agent_id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `date_fin_formation` date DEFAULT NULL,
  `analyse` enum('Conforme','Passable','Non conforme') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suivi_qualite_id` bigint UNSIGNED DEFAULT NULL,
  `numero_dossier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_traitement_dossier` date DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suivi_qualites_agent_id_foreign` (`agent_id`),
  KEY `suivi_qualites_module_id_foreign` (`module_id`),
  KEY `suivi_qualites_suivi_qualite_id_foreign` (`suivi_qualite_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `suivi_qualites`
--

INSERT INTO `suivi_qualites` (`id`, `agent_id`, `module_id`, `date_fin_formation`, `analyse`, `suivi_qualite_id`, `numero_dossier`, `date_traitement_dossier`, `commentaire`, `created_at`, `updated_at`) VALUES
(4, 14, 6, '2025-04-26', 'Non conforme', 3, '7293', '2025-04-25', 'non pas conforme', '2025-04-25 13:23:47', '2025-04-25 13:23:47'),
(2, 5, 2, '2025-04-20', 'Conforme', 2, '2567', '2025-04-16', 'bien conformer a la formation', '2025-04-16 10:17:52', '2025-04-22 08:05:42'),
(3, 4, 2, '2025-04-15', 'Passable', 3, '0009', '2025-04-17', 'bien', '2025-04-17 08:53:18', '2025-04-17 08:53:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'agent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(4, 'meftah', 'souha.mefath07@gmail.com', '$2y$10$PZUf2zg.x.JhtTjoa0gMHe1MIENA0DP2lLRMjYanesHgiEb/4KYPS', 'agent', '2025-04-15 21:37:39', '2025-04-15 21:37:39'),
(2, 'CHAKROUNE Salah Eddine', 'chakroune@example.com', '$2y$10$MgprCOFfFlxsLhtpYd4S2ujlyNaRDF0b3AzG38wNKh1v2pkd/tAcK', 'responsable', '2025-04-15 21:16:20', '2025-04-15 21:16:20'),
(3, 'AUGUSTIN DIATTA', 'augustin@example.com', '$2y$10$eseoT57ZZ.7hefj3I/5WlOrBFKorqSxK2Eg5AOMiSv0xHYeTwRQQW', 'responsable', '2025-04-15 21:16:20', '2025-04-15 21:16:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
