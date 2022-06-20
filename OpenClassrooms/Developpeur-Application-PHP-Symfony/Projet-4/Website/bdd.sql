-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mydb
DROP DATABASE IF EXISTS `mydb`;
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mydb`;

-- Dumping structure for table mydb.commande
DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(45) NOT NULL,
  `prix` int NOT NULL DEFAULT '0',
  `date_commande` datetime NOT NULL,
  `utilisateur_id` int NOT NULL,
  `livreur_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_commande_utilisateur_idx` (`utilisateur_id`),
  KEY `fk_commande_livreur_idx` (`livreur_id`),
  CONSTRAINT `fk_commandes_livreurs1` FOREIGN KEY (`livreur_id`) REFERENCES `livreur` (`id`),
  CONSTRAINT `fk_commandes_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.commande: ~2 rows (approximately)
DELETE FROM `commande`;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` (`id`, `statut`, `prix`, `date_commande`, `utilisateur_id`, `livreur_id`) VALUES
	(1, 'Livraison en cours', 58, '2022-06-01 07:03:59', 1, 2),
	(2, 'Livré', 27, '2022-06-09 07:03:59', 1, 2),
	(3, 'Livré', 35, '2022-06-09 07:03:59', 4, 2);
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;

-- Dumping structure for table mydb.commande_produit
DROP TABLE IF EXISTS `commande_produit`;
CREATE TABLE IF NOT EXISTS `commande_produit` (
  `produit_id` int NOT NULL,
  `commande_id` int NOT NULL,
  `quantite_produit` int NOT NULL,
  PRIMARY KEY (`produit_id`,`commande_id`),
  KEY `fk_produit_has_commande_commande_idx` (`commande_id`),
  KEY `fk_produit_has_commande_produit_idx` (`produit_id`),
  CONSTRAINT `fk_produits_has_commandes_commandes1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  CONSTRAINT `fk_produits_has_commandes_produits1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.commande_produit: ~9 rows (approximately)
DELETE FROM `commande_produit`;
/*!40000 ALTER TABLE `commande_produit` DISABLE KEYS */;
INSERT INTO `commande_produit` (`produit_id`, `commande_id`, `quantite_produit`) VALUES
	(1, 1, 1),
	(1, 2, 1),
	(2, 1, 1),
	(2, 3, 1),
	(4, 1, 2),
	(4, 2, 1),
	(5, 2, 1),
	(6, 1, 2),
	(6, 3, 1),
	(7, 3, 1);
/*!40000 ALTER TABLE `commande_produit` ENABLE KEYS */;

-- Dumping structure for table mydb.livreur
DROP TABLE IF EXISTS `livreur`;
CREATE TABLE IF NOT EXISTS `livreur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(45) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.livreur: ~0 rows (approximately)
DELETE FROM `livreur`;
/*!40000 ALTER TABLE `livreur` DISABLE KEYS */;
INSERT INTO `livreur` (`id`, `statut`, `latitude`, `longitude`) VALUES
	(2, 'Livraison en cours', '41.40338', '2.17403');
/*!40000 ALTER TABLE `livreur` ENABLE KEYS */;

-- Dumping structure for table mydb.plat_du_jour
DROP TABLE IF EXISTS `plat_du_jour`;
CREATE TABLE IF NOT EXISTS `plat_du_jour` (
  `produit_id` int NOT NULL,
  `prix` int NOT NULL,
  KEY `fk_plat_du_jour_produit_idx` (`produit_id`),
  CONSTRAINT `fk_platDuJour_produits1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.plat_du_jour: ~5 rows (approximately)
DELETE FROM `plat_du_jour`;
/*!40000 ALTER TABLE `plat_du_jour` DISABLE KEYS */;
INSERT INTO `plat_du_jour` (`produit_id`, `prix`) VALUES
	(1, 3),
	(2, 3),
	(3, 7),
	(5, 15),
	(7, 10);
/*!40000 ALTER TABLE `plat_du_jour` ENABLE KEYS */;

-- Dumping structure for table mydb.produit
DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `categorie` int NOT NULL DEFAULT '0',
  `description` longtext,
  `ingredient` varchar(255) DEFAULT NULL,
  `prix` int NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.produit: ~7 rows (approximately)
DELETE FROM `produit`;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` (`id`, `nom`, `categorie`, `description`, `ingredient`, `prix`, `image`, `date_creation`) VALUES
	(1, 'Coca-cola', 1, 'Canette de Coca-cola 33cl', NULL, 3, NULL, '2022-06-01 07:16:04'),
	(2, 'Fanta', 1, 'Canette de Fanta 33cl', NULL, 3, NULL, '2022-06-01 07:16:04'),
	(3, 'Salade composée', 2, 'La salade composée ou salade mixte est une recette de cuisine à base de mélange de salade et de composition de divers ingrédients', 'maïs, pâtes, mozzarella, poulet, laitue', 7, NULL, '2022-06-01 07:16:04'),
	(4, 'Salade césar', 2, 'La salade César est une recette de cuisine de salade composée de la cuisine américaine.', 'laitue romaine, œuf dur, croûtons...', 9, NULL, '2022-06-01 07:16:04'),
	(5, 'Lasagne', 3, 'Recette de cuisine italienne à base de couches alternées de pâtes lasagnes', 'viande hachée de boeuf, feuilles de lasagnes, oignon, coulis de tomates', 15, NULL, '2022-06-01 07:16:04'),
	(6, 'Gratin dauphinois', 3, 'Le gratin dauphinois ou pommes de terre à la dauphinoise est un plat gratiné traditionnel de la cuisine française, d\'origine dauphinoise, à base de pommes de terre et de lait', 'pommes de terre, crème liquide, ail, noix de muscade', 17, NULL, '2022-06-01 07:16:04'),
	(7, 'Tiramisu', 4, 'Pâtisserie traditionnel de la cuisine italienne.', 'sucre roux, sucre vanillé, biscuits à la cuillère, cacao amer, oeufs, mascarpone, café noir non sucré', 10, NULL, '2022-06-01 07:16:04');
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;

-- Dumping structure for table mydb.produit_categorie
DROP TABLE IF EXISTS `produit_categorie`;
CREATE TABLE IF NOT EXISTS `produit_categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.produit_categorie: ~4 rows (approximately)
DELETE FROM `produit_categorie`;
/*!40000 ALTER TABLE `produit_categorie` DISABLE KEYS */;
INSERT INTO `produit_categorie` (`id`, `nom`) VALUES
	(1, 'Boisson'),
	(2, 'Entrée'),
	(3, 'Plat'),
	(4, 'Dessert');
/*!40000 ALTER TABLE `produit_categorie` ENABLE KEYS */;

-- Dumping structure for table mydb.produit_livreur
DROP TABLE IF EXISTS `produit_livreur`;
CREATE TABLE IF NOT EXISTS `produit_livreur` (
  `produit_id` int NOT NULL,
  `livreur_id` int NOT NULL,
  `quantite_produit` int NOT NULL,
  PRIMARY KEY (`produit_id`,`livreur_id`),
  KEY `fk_produit_has_livreur_livreur_idx` (`livreur_id`),
  KEY `fk_produit_has_livreur_produit_idx` (`produit_id`),
  CONSTRAINT `fk_produits_has_livreurs_livreurs1` FOREIGN KEY (`livreur_id`) REFERENCES `livreur` (`id`),
  CONSTRAINT `fk_produits_has_livreurs_produits1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.produit_livreur: ~5 rows (approximately)
DELETE FROM `produit_livreur`;
/*!40000 ALTER TABLE `produit_livreur` DISABLE KEYS */;
INSERT INTO `produit_livreur` (`produit_id`, `livreur_id`, `quantite_produit`) VALUES
	(1, 2, 5),
	(2, 2, 4),
	(3, 2, 3),
	(5, 2, 4),
	(7, 2, 4);
/*!40000 ALTER TABLE `produit_livreur` ENABLE KEYS */;

-- Dumping structure for table mydb.utilisateur
DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `mot_de_passe` varchar(70) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `date_creation` datetime NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.utilisateur: ~3 rows (approximately)
DELETE FROM `utilisateur`;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`id`, `email`, `mot_de_passe`, `nom`, `prenom`, `telephone`, `date_creation`, `role`) VALUES
	(1, 'tomdurant@email.com', 'password', 'Durant', 'Tom', '0102030405', '2022-06-01 06:54:55', 'user'),
	(2, 'leotauret@email.com', 'password', 'Tauret', 'Leo', '0102030405', '2022-06-01 06:56:05', 'livreur'),
	(3, 'auroreparet@email.com', 'password', 'Paret', 'Aurore', '0102030405', '2022-06-01 06:57:00', 'admin'),
	(4, 'loicduchamp@email.com', 'password', 'Duchamp', 'Loic', '0102030405', '2022-06-01 06:54:55', 'user');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

-- Dumping structure for table mydb.utilisateur_adresse
DROP TABLE IF EXISTS `utilisateur_adresse`;
CREATE TABLE IF NOT EXISTS `utilisateur_adresse` (
  `adresse` varchar(255) NOT NULL,
  `complement_adresse` varchar(255) DEFAULT NULL,
  `code_postal` varchar(50) NOT NULL DEFAULT '',
  `ville` varchar(45) NOT NULL,
  `utilisateur_id` int NOT NULL,
  KEY `fk_utilisateur_adresse_utilisateur_idx` (`utilisateur_id`),
  CONSTRAINT `fk_utilisateursAdresse_utilisateurs1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table mydb.utilisateur_adresse: ~0 rows (approximately)
DELETE FROM `utilisateur_adresse`;
/*!40000 ALTER TABLE `utilisateur_adresse` DISABLE KEYS */;
INSERT INTO `utilisateur_adresse` (`adresse`, `complement_adresse`, `code_postal`, `ville`, `utilisateur_id`) VALUES
	('12 Rue des champs', 'Batiment B, 2ème étage', '13000', 'Marseille', 1);
/*!40000 ALTER TABLE `utilisateur_adresse` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
