-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 03 avr. 2025 à 15:29
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stampee`
--

-- --------------------------------------------------------

--
-- Structure de la table `certification`
--

CREATE TABLE `certification` (
  `id` int(11) NOT NULL,
  `statut_certification` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `certification`
--

INSERT INTO `certification` (`id`, `statut_certification`) VALUES
(1, 'Certifié Authentique'),
(2, 'Non certifié');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `id` int(11) NOT NULL,
  `coup_de_coeur` tinyint(4) DEFAULT 0,
  `date_debut` datetime NOT NULL,
  `prix_minimale` double DEFAULT 0,
  `timbre_id` int(11) NOT NULL,
  `date_fin` varchar(45) NOT NULL,
  `statut_enchere` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id`, `coup_de_coeur`, `date_debut`, `prix_minimale`, `timbre_id`, `date_fin`, `statut_enchere`) VALUES
(6, 1, '2025-03-29 08:00:00', 560, 23, '2025-04-03T16:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etat_timbre`
--

CREATE TABLE `etat_timbre` (
  `id` int(11) NOT NULL,
  `etat` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat_timbre`
--

INSERT INTO `etat_timbre` (`id`, `etat`) VALUES
(1, 'Nouveau'),
(2, 'Parfait'),
(3, 'Usé');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `enchere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `image_principale` varchar(45) NOT NULL,
  `timbre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `image_principale`, `timbre_id`) VALUES
(20, '67e60fb699446_2025.jpg', 23),
(22, '67ed89ec16975_Maroc_01.jpg', 25),
(24, '67ede476d8fb0_Maroc_02.jpg', 29),
(25, '67ee05035fc2d_Maison des têtes noires.jpg', 30),
(26, '67ee05ac7a796_Opéra national.jpg', 31);

-- --------------------------------------------------------

--
-- Structure de la table `mise`
--

CREATE TABLE `mise` (
  `id` int(11) NOT NULL,
  `montant_mise` double NOT NULL,
  `date` date NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `enchere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `nom_pays` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `nom_pays`) VALUES
(1, 'Maroc'),
(2, 'Canada'),
(3, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `privilege` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `privilege`
--

INSERT INTO `privilege` (`id`, `privilege`) VALUES
(1, 'Administrateur'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `timbre`
--

CREATE TABLE `timbre` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `annee` varchar(45) DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `certification_id` int(11) DEFAULT NULL,
  `etat_timbre_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `timbre`
--

INSERT INTO `timbre` (`id`, `nom`, `description`, `annee`, `pays_id`, `certification_id`, `etat_timbre_id`, `utilisateur_id`, `image`) VALUES
(23, 'France2025', 'francais', '1800', 3, 2, 3, NULL, 20),
(25, 'Mosquée à Issaousas', 'Mosquée de Issaousas', '1900', 1, 1, 2, 21, 22),
(29, 'mosqué', 'Maroc_Mosquée_de_Issaousas', '1900', 1, 1, 2, 21, 24),
(30, 'Maison des têtes noires', 'Capitales européennes Riga\r\nMaison des têtes noires', '2015', 3, 1, 1, 5, 25),
(31, 'Opéra national', 'Capitales européennes Riga\r\nOpéra national', '2015', 3, 1, 1, 21, 26);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `nom_utilisateur` varchar(45) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `privilege_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `mot_de_passe`, `nom_utilisateur`, `adresse`, `privilege_id`) VALUES
(5, 'david web 2000', 'david@david.co', '$2y$10$hNtZQvkzHRSI2L8yO0HQhunGMVLoGyOIvYttYzBh9CnYo0Bu8F93.', 'david@david.co', '123 côte des neiges', 2),
(6, 'Lord Reginal Stampee', 'stampee@stampee.com', '$2y$10$Qhv77IYnXX2/AfLYEQcaa.VxEXrMF6UoITG3vciEAAlJphdZW46cG', 'stampee@stampee.com', 'Cité belle vue', 1),
(14, 'Adil  EL AMRANI2025', 'amelamrani@gmail.com', '$2y$10$XwK2FKiEX6d9WhdsLBTvyet7T56xzVBlO/jU03xolKYHsH6EDwpAC', 'amelamrani1@gmail.com', 'Cité belle vue', 1),
(15, 'Scofield Michael', 'Smichael@dot.com', '$2y$10$hlxTMk84aXUkcRhdxsQ9AefD6tLcI6YpvDujwUy3b.VRpBlME2P9i', 'Smichael@dot.com', 'street dance', 1),
(16, 'Carol mai', 'Cmai@dot.com', '$2y$10$kfk4FTkLy4XYETy7FJqcF.lLmE0bOOmiY.76nr.ikULdpK8fjZ3eq', 'Cmai@dot.com', '2020 Marie ville street', 1),
(17, 'admin', 'admin@admin.com', '$2y$10$PjZDKQ7GfIGHwP2bd8D45OCYCswnisY7ofzt/VjrtAaElaySaQO1K', 'admin@admin.com', '3500 Maisonneuve ouest', 1),
(19, 'fred', 'fred@dot.com', '$2y$10$4o57BITcu.c.CBtohXhtE.jyjs2paKX6JAD7vSQz1FYxeQ1Pv8Klm', 'fred@dot.com', 'fil de fer', 1),
(21, 'brad pitt', 'brad@dot.com', '$2y$10$IveoRFd9e2ldtc1VgWRqluO0ooCl.wuCbd4PS1aqmkNNPL6iMljZm', 'brad@dot.com', 'Cité belle vue', 1),
(24, 'Blanche neige', 'blanche@dot.com', '$2y$10$OMuyXeDOBKsmXLhzIGEVi.PX.fkTRjY9IOU4lFvaLp2Iit7inRdHa', 'blanche@dot.com', 'Cité belle vue', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timbre_id` (`timbre_id`);

--
-- Index pour la table `etat_timbre`
--
ALTER TABLE `etat_timbre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`,`utilisateur_id`,`enchere_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `enchere_id` (`enchere_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timbre_id` (`timbre_id`);

--
-- Index pour la table `mise`
--
ALTER TABLE `mise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `enchere_id` (`enchere_id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pays_id` (`pays_id`),
  ADD KEY `certification_id` (`certification_id`),
  ADD KEY `etat_timbre_id` (`etat_timbre_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `certification`
--
ALTER TABLE `certification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `etat_timbre`
--
ALTER TABLE `etat_timbre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `mise`
--
ALTER TABLE `mise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `timbre`
--
ALTER TABLE `timbre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`timbre_id`) REFERENCES `timbre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`enchere_id`) REFERENCES `enchere` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`timbre_id`) REFERENCES `timbre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mise`
--
ALTER TABLE `mise`
  ADD CONSTRAINT `mise_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mise_ibfk_2` FOREIGN KEY (`enchere_id`) REFERENCES `enchere` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `timbre`
--
ALTER TABLE `timbre`
  ADD CONSTRAINT `timbre_ibfk_1` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`),
  ADD CONSTRAINT `timbre_ibfk_2` FOREIGN KEY (`certification_id`) REFERENCES `certification` (`id`),
  ADD CONSTRAINT `timbre_ibfk_3` FOREIGN KEY (`etat_timbre_id`) REFERENCES `etat_timbre` (`id`),
  ADD CONSTRAINT `timbre_ibfk_4` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
