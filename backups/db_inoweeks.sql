-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 05 Juin 2024 à 14:08
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_inoweeks`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_person`
--

CREATE TABLE `t_person` (
  `numeroAVS` varchar(20) NOT NULL,
  `perNom` varchar(50) NOT NULL,
  `perPrenom` varchar(50) NOT NULL,
  `perSexe` tinyint(1) NOT NULL,
  `perDateNaissance` date NOT NULL,
  `perNationalite` varchar(40) NOT NULL,
  `perLieuDeNaissance` varchar(50) NOT NULL,
  `perLieuOrigine` varchar(50) NOT NULL,
  `perQuotaDisponible` decimal(10,2) NOT NULL,
  `perMotDePasse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_person`
--

INSERT INTO `t_person` (`numeroAVS`, `perNom`, `perPrenom`, `perSexe`, `perDateNaissance`, `perNationalite`, `perLieuDeNaissance`, `perLieuOrigine`, `perQuotaDisponible`, `perMotDePasse`) VALUES
('756.9731.4784.83', 'Oyarzabal', 'Mikel', 1, '1997-04-21', 'Espagnol', 'Eibar', 'Eibar', '4000.00', NULL),
('756.9731.4785.86', 'Scary', 'Yann', 1, '1975-09-11', 'Martinique', 'Fort-de-France', 'Fort-de-France', '4000.00', NULL),
('756.9731.4785.89', 'Pérez', 'Lucas', 1, '1988-09-10', 'Espagnol', 'A Coruña', 'A Coruña', '4000.00', NULL),
('756.9731.4795.90', 'Sierro', 'Félix', 1, '1998-04-07', 'Suisse', 'Vevey', 'Vevey', '4000.00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_voyage`
--

CREATE TABLE `t_voyage` (
  `idVoyage` int(11) NOT NULL,
  `voyDateDepart` datetime NOT NULL,
  `voyDateArrive` datetime NOT NULL,
  `voyDepart` varchar(50) NOT NULL,
  `voyArrive` varchar(50) NOT NULL,
  `voyMotif` varchar(255) NOT NULL,
  `voyCoutCO2` decimal(10,2) NOT NULL,
  `numeroAVS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_voyage`
--

INSERT INTO `t_voyage` (`idVoyage`, `voyDateDepart`, `voyDateArrive`, `voyDepart`, `voyArrive`, `voyMotif`, `voyCoutCO2`, `numeroAVS`) VALUES
(1, '2024-01-10 08:00:00', '2024-03-20 09:30:00', 'Genève(GVA)', 'San Sebastian(EAS)', 'Voir un ami Yago Iglesias Rodriguez', '218.00', '756.9731.4784.83'),
(2, '2023-03-20 07:00:00', '2024-03-20 13:15:00', 'Genève(GVA)', 'Abu Dhabi(AUH)', 'Visiter le Japon', '857.00', '756.9731.4785.86'),
(3, '2023-03-20 15:00:00', '2024-03-21 01:00:00', 'Abu Dhabi(AUH)', 'Tokyo(NRT)', 'Visiter le Japon', '1600.00', '756.9731.4785.86'),
(4, '2024-04-26 10:00:00', '2024-02-26 12:15:00', 'Genève(GVA)', 'A Coruña(LCG)', 'Voir un match avec un ami Yago Iglesias Rodriguez à Riazor', '299.00', '756.9731.4785.89'),
(5, '2023-12-23 08:00:00', '2024-03-20 10:00:00', 'Genève(GVA)', 'Catane(CTA)', 'Visiter la famille pour Noël', '305.00', '756.9731.4795.90');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_person`
--
ALTER TABLE `t_person`
  ADD PRIMARY KEY (`numeroAVS`);

--
-- Index pour la table `t_voyage`
--
ALTER TABLE `t_voyage`
  ADD PRIMARY KEY (`idVoyage`),
  ADD KEY `numeroAVS` (`numeroAVS`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_voyage`
--
ALTER TABLE `t_voyage`
  MODIFY `idVoyage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_voyage`
--
ALTER TABLE `t_voyage`
  ADD CONSTRAINT `t_voyage_ibfk_1` FOREIGN KEY (`numeroAVS`) REFERENCES `t_person` (`numeroAVS`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
