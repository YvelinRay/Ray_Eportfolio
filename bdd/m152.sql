-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 27 fév. 2020 à 11:20
-- Version du serveur :  10.3.18-MariaDB-0+deb10u1
-- Version de PHP :  7.3.11-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `m152`
--
CREATE DATABASE IF NOT EXISTS `m152` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `m152`;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `idMedia` int(11) UNSIGNED NOT NULL,
  `typeMedia` varchar(50) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `nameMedia` varchar(200) NOT NULL,
  `dateCreation` date NOT NULL,
  `dateModification` date DEFAULT NULL,
  `pathImg` varchar(100) NOT NULL,
  `idPost` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`idMedia`, `typeMedia`, `extension`, `nameMedia`, `dateCreation`, `dateModification`, `pathImg`, `idPost`) VALUES
(29, 'video', 'webm', 'If Programming Was An Anime-pKO9UjSeLew.webm', '2020-02-27', NULL, 'media/video/5e578c831da40If Programming Was An Anime-pKO9UjSeLew.webm', 46),
(30, 'audio', 'mpeg', '01. 어떤 별보다 (online-audio-converter.com).mp3', '2020-02-27', NULL, 'media/audio/5e578e6ed919301. 어떤 별보다 (online-audio-converter.com).mp3', 48),
(44, 'image', 'jpeg', 'raspiLogo.jpg', '2020-02-27', NULL, 'media/image/5e5796ab5d674raspiLogo.jpg', 61),
(45, 'image', 'jpeg', 'raspiLogo.jpg', '2020-02-27', NULL, 'media/image/5e5796b693dd6raspiLogo.jpg', 62),
(46, 'image', 'webp', 'raspiLogo.webp', '2020-02-27', NULL, 'media/image/5e5796b696159raspiLogo.webp', 62);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) UNSIGNED NOT NULL,
  `commentaire` varchar(250) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `dateModification` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`idPost`, `commentaire`, `dateCreation`, `dateModification`) VALUES
(39, 'SUNSET ', '2020-02-27 00:00:00', NULL),
(40, 'Bonjour', '2020-02-27 00:00:00', NULL),
(41, 'Video', '2020-02-27 00:00:00', NULL),
(42, 'asdsa', '2020-02-27 00:00:00', NULL),
(43, 'video test 2', '2020-02-27 00:00:00', NULL),
(44, 'adssdsaad', '2020-02-27 00:00:00', NULL),
(45, '', '2020-02-27 00:00:00', NULL),
(46, 'videage test 3', '2020-02-27 00:00:00', NULL),
(47, '', '2020-02-27 00:00:00', NULL),
(48, 'sound on :*', '2020-02-27 00:00:00', NULL),
(61, 'asdsa', '2020-02-27 11:15:07', NULL),
(62, 'raspi 2', '2020-02-27 11:15:18', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idMedia`),
  ADD KEY `idPost` (`idPost`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `idMedia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
