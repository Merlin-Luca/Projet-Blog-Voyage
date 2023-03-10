-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 fév. 2023 à 16:47
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `nomArticle` varchar(255) NOT NULL,
  `nomPays` varchar(50) NOT NULL,
  `photoResume` varchar(255) NOT NULL,
  `texteResume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articlephoto`
--

CREATE TABLE `articlephoto` (
  `photoID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `photoA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articletexte`
--

CREATE TABLE `articletexte` (
  `IdText` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `ContenuArticle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idComm` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `UserSuivi` int(11) NOT NULL,
  `UserQuiSuit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `like article`
--

CREATE TABLE `like article` (
  `idUser` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `paysFavoris` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `profilePicture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `article_ibfk_1` (`idUser`);

--
-- Index pour la table `articlephoto`
--
ALTER TABLE `articlephoto`
  ADD PRIMARY KEY (`photoID`),
  ADD KEY `efef` (`articleID`);

--
-- Index pour la table `articletexte`
--
ALTER TABLE `articletexte`
  ADD PRIMARY KEY (`IdText`),
  ADD KEY `adzad` (`articleID`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`idComm`),
  ADD KEY `articleID` (`articleID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD KEY `UserFollowed` (`UserSuivi`),
  ADD KEY `UserFollowing` (`UserQuiSuit`);

--
-- Index pour la table `like article`
--
ALTER TABLE `like article`
  ADD KEY `idArticle` (`idArticle`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articlephoto`
--
ALTER TABLE `articlephoto`
  MODIFY `photoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articletexte`
--
ALTER TABLE `articletexte`
  MODIFY `IdText` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `idComm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateurs` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articlephoto`
--
ALTER TABLE `articlephoto`
  ADD CONSTRAINT `efef` FOREIGN KEY (`articleID`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `articletexte`
--
ALTER TABLE `articletexte`
  ADD CONSTRAINT `adzad` FOREIGN KEY (`articleID`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`articleID`) REFERENCES `article` (`idArticle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `utilisateurs` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`UserSuivi`) REFERENCES `utilisateurs` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`UserQuiSuit`) REFERENCES `utilisateurs` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `like article`
--
ALTER TABLE `like article`
  ADD CONSTRAINT `like article_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like article_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `utilisateurs` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
