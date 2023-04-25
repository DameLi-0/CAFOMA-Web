-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 22 avr. 2023 à 22:32
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
-- Base de données : `cafoma`
--
CREATE DATABASE IF NOT EXISTS `cafoma` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cafoma`;

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
  `video` text NOT NULL,
  PRIMARY KEY (`formation_id`),
  KEY `fk_user_id` (`fk_user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `inscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_formation_id` int(10) UNSIGNED NOT NULL,
  `fk_user_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`inscription_id`),
  KEY `fk_formation_id` (`fk_formation_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

DROP TABLE IF EXISTS `ressource`;
CREATE TABLE IF NOT EXISTS `ressource` (
  `ressource_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_formation_id` int(11) UNSIGNED NOT NULL,
  `fk_sequence_id` int(11) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `extension` varchar(4) NOT NULL,
  PRIMARY KEY (`ressource_id`,`fk_formation_id`,`fk_sequence_id`),
  KEY `fk_Fid_Sid` (`fk_formation_id`,`fk_sequence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sequence`
--

DROP TABLE IF EXISTS `sequence`;
CREATE TABLE IF NOT EXISTS `sequence` (
  `sequence_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_formation_id` int(11) UNSIGNED NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`sequence_id`,`fk_formation_id`),
  KEY `fk_formation_id` (`fk_formation_id`) USING BTREE
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
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `login`, `mdp`, `email`, `img`, `role`, `valid`) VALUES
(1, 'a', '$2y$10$C3pa2eh7aIAIMuWykPpR3.0VBk552qJz4HQhATOX6nRODgUsS/lY6', 'maxducroizet@gmail.com', '57577_Max_Chibi1.jpg', 'Responsable', 1),
(27, 'admin', '$2y$10$mKyduV1sjxQNmluYq3oSgew1RVhqWMam7xdh6EZPzZQNVwp1UuNQy', 'maxanceducroizet@gmail.com', '27501_Max_Chibi1.jpg', 'Admin', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`fk_formation_id`) REFERENCES `formation` (`formation_id`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD CONSTRAINT `fkc_Fid_Sid` FOREIGN KEY (`fk_formation_id`,`fk_sequence_id`) REFERENCES `sequence` (`fk_formation_id`, `sequence_id`);

--
-- Contraintes pour la table `sequence`
--
ALTER TABLE `sequence`
  ADD CONSTRAINT `fk_formation_id` FOREIGN KEY (`fk_formation_id`) REFERENCES `formation` (`formation_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
