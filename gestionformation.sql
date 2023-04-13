-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 mars 2023 à 10:11
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionformation`
--
CREATE DATABASE IF NOT EXISTS `gestionformation` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestionformation`;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `formation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) UNSIGNED NOT NULL,
  `libelle` varchar(64) NOT NULL,
  `acronyme` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY (`formation_id`),
  UNIQUE KEY `fk_formation_id` (`formation_id`),
  KEY `fk_user_id` (`fk_user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sequence`
--

DROP TABLE IF EXISTS `sequence`;
CREATE TABLE IF NOT EXISTS `sequence` (
  `sequence_id` int(11) NOT NULL,
  `fk_formation_id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`sequence_id`,`fk_formation_id`),
  KEY `fk_formation_id` (`fk_formation_id`) USING BTREE
  CONSTRAINT `fk_formation_id` FOREIGN KEY (`fk_formation_id`) REFERENCES `formation`(`formation_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(144) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(144) CHARACTER SET latin1 NOT NULL,
  `email` varchar(144) CHARACTER SET latin1 NOT NULL,
  `img` text CHARACTER SET latin1 NOT NULL,
  `role` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `login`, `mdp`, `email`, `img`, `role`) VALUES
(32, 'admin', '$2y$10$vR.D45QP1fzOQ/et6NR9FuezQ.hF4HdJaSwLpCJXanqAp9erCe8.W', 'admin@gmail.com', '20678_', 'Admin'),
(33, 'abo', '$2y$10$VBmbhpwBfIVQf2hx56/kzOCirdA3KiAHSUtew.GRD2edgvslCJDW.', 'abo@gmail.com', '82130_Max_Chibi1.jpg', 'Abonner');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `addBy` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
