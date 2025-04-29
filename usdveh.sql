-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 29 avr. 2025 à 11:59
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `usdveh`
--

-- --------------------------------------------------------

--
-- Structure de la table `bonus`
--

DROP TABLE IF EXISTS `bonus`;
CREATE TABLE IF NOT EXISTS `bonus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bonus_pv` int DEFAULT NULL,
  `bonus_atk` int DEFAULT NULL,
  `bonus_def` int DEFAULT NULL,
  `bonus_agi` int DEFAULT NULL,
  `bonus_int` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre`
--

DROP TABLE IF EXISTS `chapitre`;
CREATE TABLE IF NOT EXISTS `chapitre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `histoire_id` int NOT NULL,
  `stat_hero_id` int DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_chapitre` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8C62B025E0A17C54` (`stat_hero_id`),
  KEY `IDX_8C62B0259B94373` (`histoire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre_bonus`
--

DROP TABLE IF EXISTS `chapitre_bonus`;
CREATE TABLE IF NOT EXISTS `chapitre_bonus` (
  `chapitre_id` int NOT NULL,
  `bonus_id` int NOT NULL,
  PRIMARY KEY (`chapitre_id`,`bonus_id`),
  KEY `IDX_2B06D21B1FBEEF7B` (`chapitre_id`),
  KEY `IDX_2B06D21B69545666` (`bonus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre_equipement`
--

DROP TABLE IF EXISTS `chapitre_equipement`;
CREATE TABLE IF NOT EXISTS `chapitre_equipement` (
  `chapitre_id` int NOT NULL,
  `equipement_id` int NOT NULL,
  PRIMARY KEY (`chapitre_id`,`equipement_id`),
  KEY `IDX_D4C3A7901FBEEF7B` (`chapitre_id`),
  KEY `IDX_D4C3A790806F0F5C` (`equipement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre_malus`
--

DROP TABLE IF EXISTS `chapitre_malus`;
CREATE TABLE IF NOT EXISTS `chapitre_malus` (
  `chapitre_id` int NOT NULL,
  `malus_id` int NOT NULL,
  PRIMARY KEY (`chapitre_id`,`malus_id`),
  KEY `IDX_4A0DE6971FBEEF7B` (`chapitre_id`),
  KEY `IDX_4A0DE697AD839E9C` (`malus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre_monstre`
--

DROP TABLE IF EXISTS `chapitre_monstre`;
CREATE TABLE IF NOT EXISTS `chapitre_monstre` (
  `chapitre_id` int NOT NULL,
  `monstre_id` int NOT NULL,
  PRIMARY KEY (`chapitre_id`,`monstre_id`),
  KEY `IDX_768FF6881FBEEF7B` (`chapitre_id`),
  KEY `IDX_768FF688DAF13697` (`monstre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

DROP TABLE IF EXISTS `choix`;
CREATE TABLE IF NOT EXISTS `choix` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chapitre_id` int NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapitre_cible` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F4880911FBEEF7B` (`chapitre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250416073135', '2025-04-16 07:31:50', 42545),
('DoctrineMigrations\\Version20250416074847', '2025-04-16 07:48:54', 10368),
('DoctrineMigrations\\Version20250417095125', '2025-04-17 09:51:39', 1616),
('DoctrineMigrations\\Version20250417134256', '2025-04-17 13:43:10', 3621),
('DoctrineMigrations\\Version20250417140753', '2025-04-17 14:07:57', 1849),
('DoctrineMigrations\\Version20250417140929', '2025-04-17 14:09:34', 3286),
('DoctrineMigrations\\Version20250418090144', '2025-04-18 09:02:09', 1081),
('DoctrineMigrations\\Version20250418090358', '2025-04-18 09:04:02', 4247),
('DoctrineMigrations\\Version20250418091220', '2025-04-18 09:12:28', 856);

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

DROP TABLE IF EXISTS `emplacement`;
CREATE TABLE IF NOT EXISTS `emplacement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emplacement`
--

INSERT INTO `emplacement` (`id`, `name`) VALUES
(1, 'Tête'),
(2, 'Bras'),
(3, 'Torse'),
(4, 'jambes'),
(5, 'Pieds');

-- --------------------------------------------------------

--
-- Structure de la table `enchantement`
--

DROP TABLE IF EXISTS `enchantement`;
CREATE TABLE IF NOT EXISTS `enchantement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bonus_pv` int DEFAULT NULL,
  `bonus_atk` int DEFAULT NULL,
  `bonus_def` int DEFAULT NULL,
  `bonus_agi` int DEFAULT NULL,
  `bonus_int` int DEFAULT NULL,
  `malus_pv` int DEFAULT NULL,
  `malus_atk` int DEFAULT NULL,
  `malus_def` int DEFAULT NULL,
  `malus_agi` int DEFAULT NULL,
  `malus_int` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `enchantement`
--

INSERT INTO `enchantement` (`id`, `bonus_pv`, `bonus_atk`, `bonus_def`, `bonus_agi`, `bonus_int`, `malus_pv`, `malus_atk`, `malus_def`, `malus_agi`, `malus_int`, `name`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PV +1'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PV +2'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PV +3'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PV +4'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PV +5'),
(6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Attaque +1'),
(7, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Attaque +2'),
(8, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Attaque +3'),
(9, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Attaque +4'),
(10, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Attaque +5'),
(11, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Defense +1'),
(12, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Defense +2'),
(13, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Defense +3'),
(14, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Defense +4'),
(15, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Defense +5'),
(16, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Agilité +1'),
(17, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'Agilité +2'),
(18, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'Agilité +3'),
(19, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Agilité +4'),
(20, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'Agilité +5'),
(21, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 'intelligence +1'),
(22, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'intelligence +2'),
(23, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, 'intelligence +3'),
(24, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, 'intelligence +4'),
(25, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, 'intelligence +5'),
(26, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'PV -1'),
(27, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 'PV -2'),
(28, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 'PV -3'),
(29, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, 'PV -4'),
(30, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, 'PV -5'),
(31, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Attaque -1'),
(32, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'Attaque -2'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 'Attaque -3'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 'Attaque -4'),
(35, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 'Attaque -5'),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'Defense -1'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 'Defense -2'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 'Defense -3'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 'Defense -4'),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 'Defense -5'),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'Agilité -1'),
(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 'Agilité -2'),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 'Agilité -3'),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 'Agilité -4'),
(45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 'Agilité -5'),
(46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'intelligence -1'),
(47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'intelligence -2'),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'intelligence -3'),
(49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 'intelligence -4'),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 'intelligence -5');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createur_id` int DEFAULT NULL,
  `emplacement_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8B4C6F373A201E5` (`createur_id`),
  KEY `IDX_B8B4C6F3C4598A51` (`emplacement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `name`, `createur_id`, `emplacement_id`) VALUES
(1, 'sqfdqsd', NULL, 1),
(2, 'xwcwxcxwc', NULL, 1),
(3, 'sfgfdgfdgdfgdgdfgfdgfdgfdg', 1, 1),
(4, 'rrtytyrtyrtyrtyryrtyyrty', 1, 1),
(5, 'reyryrtytr', 1, 1),
(6, 'retretretretre', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipement_enchantement`
--

DROP TABLE IF EXISTS `equipement_enchantement`;
CREATE TABLE IF NOT EXISTS `equipement_enchantement` (
  `equipement_id` int NOT NULL,
  `enchantement_id` int NOT NULL,
  PRIMARY KEY (`equipement_id`,`enchantement_id`),
  KEY `IDX_9E7E520806F0F5C` (`equipement_id`),
  KEY `IDX_9E7E520FE7C9E74` (`enchantement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement_enchantement`
--

INSERT INTO `equipement_enchantement` (`equipement_id`, `enchantement_id`) VALUES
(1, 25),
(1, 39),
(1, 45),
(2, 1),
(2, 10),
(2, 11),
(3, 2),
(3, 17),
(3, 25),
(4, 2),
(4, 11),
(4, 20),
(4, 23),
(5, 3),
(6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `equipement_stat_hero`
--

DROP TABLE IF EXISTS `equipement_stat_hero`;
CREATE TABLE IF NOT EXISTS `equipement_stat_hero` (
  `equipement_id` int NOT NULL,
  `stat_hero_id` int NOT NULL,
  PRIMARY KEY (`equipement_id`,`stat_hero_id`),
  KEY `IDX_4C9AA00D806F0F5C` (`equipement_id`),
  KEY `IDX_4C9AA00DE0A17C54` (`stat_hero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hero`
--

DROP TABLE IF EXISTS `hero`;
CREATE TABLE IF NOT EXISTS `hero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pv` int NOT NULL,
  `atk` int NOT NULL,
  `def` int NOT NULL,
  `agi` int NOT NULL,
  `intel` int NOT NULL,
  `utilisateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_51CE6E86FB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hero`
--

INSERT INTO `hero` (`id`, `name`, `pv`, `atk`, `def`, `agi`, `intel`, `utilisateur_id`) VALUES
(4, 'paladin', 40, 3, 5, 1, 3, 1),
(5, 'Voleur', 30, 3, 2, 6, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `histoire`
--

DROP TABLE IF EXISTS `histoire`;
CREATE TABLE IF NOT EXISTS `histoire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createur_id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_FD74CD6873A201E5` (`createur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `histoire`
--

INSERT INTO `histoire` (`id`, `createur_id`, `titre`, `created_at`, `description`) VALUES
(7, 1, 'la forêt', '2025-04-18 11:32:30', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `malus`
--

DROP TABLE IF EXISTS `malus`;
CREATE TABLE IF NOT EXISTS `malus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `malus_pv` int DEFAULT NULL,
  `malus_atk` int DEFAULT NULL,
  `malus_def` int DEFAULT NULL,
  `malus_agi` int DEFAULT NULL,
  `malus_int` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `monstre`
--

DROP TABLE IF EXISTS `monstre`;
CREATE TABLE IF NOT EXISTS `monstre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createur_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pv` int NOT NULL,
  `atk` int NOT NULL,
  `def` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A20EC7A573A201E5` (`createur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `monstre`
--

INSERT INTO `monstre` (`id`, `createur_id`, `name`, `pv`, `atk`, `def`) VALUES
(1, 1, 'Lauriane', 2, 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `stat_hero`
--

DROP TABLE IF EXISTS `stat_hero`;
CREATE TABLE IF NOT EXISTS `stat_hero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hero_id` int NOT NULL,
  `histoire_id` int DEFAULT NULL,
  `pv_actu` int DEFAULT NULL,
  `atk_actu` int DEFAULT NULL,
  `def_actu` int DEFAULT NULL,
  `agi_actu` int DEFAULT NULL,
  `int_actu` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_708695D245B0BCD` (`hero_id`),
  KEY `IDX_708695D29B94373` (`histoire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`) VALUES
(1, 'denis.lamande2024@campus-eni.fr', '[]', '$2y$13$6pQRMUN78SakvNu.rF48GenyhyBqA8yf5jRTDOVvTPD6v9j7ZVKJy', 'Denis');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapitre`
--
ALTER TABLE `chapitre`
  ADD CONSTRAINT `FK_8C62B0259B94373` FOREIGN KEY (`histoire_id`) REFERENCES `histoire` (`id`),
  ADD CONSTRAINT `FK_8C62B025E0A17C54` FOREIGN KEY (`stat_hero_id`) REFERENCES `stat_hero` (`id`);

--
-- Contraintes pour la table `chapitre_bonus`
--
ALTER TABLE `chapitre_bonus`
  ADD CONSTRAINT `FK_2B06D21B1FBEEF7B` FOREIGN KEY (`chapitre_id`) REFERENCES `chapitre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2B06D21B69545666` FOREIGN KEY (`bonus_id`) REFERENCES `bonus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `chapitre_equipement`
--
ALTER TABLE `chapitre_equipement`
  ADD CONSTRAINT `FK_D4C3A7901FBEEF7B` FOREIGN KEY (`chapitre_id`) REFERENCES `chapitre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D4C3A790806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `chapitre_malus`
--
ALTER TABLE `chapitre_malus`
  ADD CONSTRAINT `FK_4A0DE6971FBEEF7B` FOREIGN KEY (`chapitre_id`) REFERENCES `chapitre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4A0DE697AD839E9C` FOREIGN KEY (`malus_id`) REFERENCES `malus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `chapitre_monstre`
--
ALTER TABLE `chapitre_monstre`
  ADD CONSTRAINT `FK_768FF6881FBEEF7B` FOREIGN KEY (`chapitre_id`) REFERENCES `chapitre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_768FF688DAF13697` FOREIGN KEY (`monstre_id`) REFERENCES `monstre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `FK_4F4880911FBEEF7B` FOREIGN KEY (`chapitre_id`) REFERENCES `chapitre` (`id`);

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `FK_B8B4C6F373A201E5` FOREIGN KEY (`createur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B8B4C6F3C4598A51` FOREIGN KEY (`emplacement_id`) REFERENCES `emplacement` (`id`);

--
-- Contraintes pour la table `equipement_enchantement`
--
ALTER TABLE `equipement_enchantement`
  ADD CONSTRAINT `FK_9E7E520806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9E7E520FE7C9E74` FOREIGN KEY (`enchantement_id`) REFERENCES `enchantement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `equipement_stat_hero`
--
ALTER TABLE `equipement_stat_hero`
  ADD CONSTRAINT `FK_4C9AA00D806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4C9AA00DE0A17C54` FOREIGN KEY (`stat_hero_id`) REFERENCES `stat_hero` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `hero`
--
ALTER TABLE `hero`
  ADD CONSTRAINT `FK_51CE6E86FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `histoire`
--
ALTER TABLE `histoire`
  ADD CONSTRAINT `FK_FD74CD6873A201E5` FOREIGN KEY (`createur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `monstre`
--
ALTER TABLE `monstre`
  ADD CONSTRAINT `FK_A20EC7A573A201E5` FOREIGN KEY (`createur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stat_hero`
--
ALTER TABLE `stat_hero`
  ADD CONSTRAINT `FK_708695D245B0BCD` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`id`),
  ADD CONSTRAINT `FK_708695D29B94373` FOREIGN KEY (`histoire_id`) REFERENCES `histoire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
