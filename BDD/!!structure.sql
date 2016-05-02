-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Mars 2016 à 11:29
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cross`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `classe_id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_libelle` varchar(15) NOT NULL,
  `classe_effectif` int(11) NOT NULL,
  `classe_inscription` tinyint(1) NOT NULL,
  `prof_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`classe_id`),
  KEY `prof_id` (`prof_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `groupe_id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_id` int(11) NOT NULL,
  `type_groupe_id` int(11) NOT NULL,
  `groupe_nb_inscrit` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupe_id`,`classe_id`),
  KEY `type_groupe_id` (`type_groupe_id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `point_id` int(11) NOT NULL AUTO_INCREMENT,
  `point_libelle` varchar(15) DEFAULT NULL,
  `point_situation` varchar(255) DEFAULT NULL,
  `point_nb_max` int(11) NOT NULL,
  `point_nb_min` int(11) NOT NULL,
  PRIMARY KEY (`point_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_groupe`
--

CREATE TABLE IF NOT EXISTS `type_groupe` (
  `type_groupe_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_groupe_libelle` varchar(30) NOT NULL,
  `type_groupe_points` int(11) NOT NULL,
  PRIMARY KEY (`type_groupe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_login` varchar(30) DEFAULT NULL,
  `utilisateur_mdp` varchar(16) DEFAULT NULL,
  `utilisateur_type` int(11) NOT NULL,
  `utilisateur_prenom` varchar(30) NOT NULL,
  `utilisateur_nom` varchar(30) NOT NULL,
  `utilisateur_sexe` char(1) NOT NULL,
  `utilisateur_date_naissance` date NOT NULL,
  `classe_id` int(11) NOT NULL,
  `point_id` int(11) DEFAULT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `utilisateur_nb_points_malus` int(11) DEFAULT NULL,
  `utilisateur_nb_points_bonus` int(11) DEFAULT NULL,
  PRIMARY KEY (`utilisateur_id`),
  KEY `classe_id` (`classe_id`),
  KEY `point_id` (`point_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`prof_id`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`type_groupe_id`) REFERENCES `type_groupe` (`type_groupe_id`),
  ADD CONSTRAINT `groupe_ibfk_2` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`classe_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`classe_id`),
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`point_id`) REFERENCES `point` (`point_id`),
  ADD CONSTRAINT `utilisateur_ibfk_3` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
