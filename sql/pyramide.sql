-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour lapyramide_php
CREATE DATABASE IF NOT EXISTS `lapyramide_php` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lapyramide_php`;

-- Listage de la structure de la table lapyramide_php. events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `nb_inscrit` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table lapyramide_php.events : ~0 rows (environ)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `nom`, `type`, `date`, `nb_inscrit`) VALUES
	(1, 'Futsal', 'Sport', '2023-01-30', 2),
	(2, 'Ramassage Ordure', 'Environnement', '2023-03-15', 2);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Listage de la structure de la table lapyramide_php. events_users
CREATE TABLE IF NOT EXISTS `events_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `events_users_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `events_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Listage des données de la table lapyramide_php.events_users : ~4 rows (environ)
/*!40000 ALTER TABLE `events_users` DISABLE KEYS */;
INSERT INTO `events_users` (`id`, `event_id`, `user_id`) VALUES
	(23, 1, 28),
	(43, 2, 27),
	(44, 2, 29),
	(45, 1, 27);
/*!40000 ALTER TABLE `events_users` ENABLE KEYS */;

-- Listage de la structure de la table lapyramide_php. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `recever_id` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`recever_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recever_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table lapyramide_php.messages : ~0 rows (environ)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Listage de la structure de la table lapyramide_php. newsletters
CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table lapyramide_php.newsletters : ~0 rows (environ)
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
INSERT INTO `newsletters` (`id`, `nom`, `content`, `created_at`, `is_sent`) VALUES
	(1, 'Test', 'Test de newsletter', '2023-02-06 22:20:24', 0);
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;

-- Listage de la structure de la table lapyramide_php. newsletters_users
CREATE TABLE IF NOT EXISTS `newsletters_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `newsletter_id` (`newsletter_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `newsletters_users_ibfk_1` FOREIGN KEY (`newsletter_id`) REFERENCES `newsletters` (`id`),
  CONSTRAINT `newsletters_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table lapyramide_php.newsletters_users : ~0 rows (environ)
/*!40000 ALTER TABLE `newsletters_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters_users` ENABLE KEYS */;

-- Listage de la structure de la table lapyramide_php. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('ROLE_USER','ROLE_ADMIN') NOT NULL DEFAULT 'ROLE_USER',
  `nb_events` int(11) NOT NULL DEFAULT '0',
  `newsletter` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Listage des données de la table lapyramide_php.users : ~3 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nom`, `prenom`, `password`, `email`, `role`, `nb_events`, `newsletter`) VALUES
	(1, 'TABAR LABONNE', 'Baptiste', 'azerty', 'baptiste97296@gmail.com', 'ROLE_USER', 0, 1),
	(27, 'TABAR LABONNE', 'Baptiste', '$2y$10$BIbTx1NnL/Q1DxNNp0BTrOmwMprShZfB5oCe5W68m1g/Xi.uS.s5q', 'baptiste9729@gmail.com', 'ROLE_ADMIN', 2, 1),
	(28, 'TAB', 'Baptiste', '$2y$10$c9oeEDF30k/YJI7rZBnAo.f5eIBZVJ9vkPDM7Ngx8CZ7JVadvVeHa', 'baptiste@gmail.com', 'ROLE_USER', 1, 0),
	(29, 'LAROUI', 'Chakib', '$2y$10$ryhNLeMh0HxDaMlOfUMvYe.iTdDGAt0G7DpUy9AabntYferrRmg06', 'chakib@gmail.fr', 'ROLE_USER', 1, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
