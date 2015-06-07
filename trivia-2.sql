-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 07 Juin 2015 à 23:32
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `trivia`
--

-- --------------------------------------------------------

--
-- Structure de la table `couronne`
--

CREATE TABLE IF NOT EXISTS `couronne` (
  `idPartie` int(11) NOT NULL,
  `idJoueur` int(11) NOT NULL,
  `idDomaine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE IF NOT EXISTS `domaine` (
`id` int(11) NOT NULL,
  `idMonde` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `description` text,
  `icon` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `domaine`
--

INSERT INTO `domaine` (`id`, `idMonde`, `libelle`, `description`, `icon`) VALUES
(1, 1, 'Laptops', 'Domaine des ordinateurs portables du monde informatique.', 'laptop.png'),
(2, 1, 'Desktops', 'Domaine des ordinateurs de bureau du monde informatique.', 'desktop.png'),
(3, 2, 'Thrillers', 'Domaine des thrillers du monde de la librairie.', 'coin.png'),
(4, 2, 'Couronne', 'Domaine des biographies du monde de la librairie.', 'couronne.png'),
(5, 1, 'tablet', 'Questions portant sur les tablettes', 'tablet.png'),
(6, 1, 'smartphone', 'Domaine portant sur les smartphones', 'smartphone.png'),
(7, 1, 'apple', 'Domaine portant sur la marque apple', 'apple.png'),
(8, 1, 'microsoft', 'Domaine portant sur Microsoft', 'microsoft.png');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE IF NOT EXISTS `joueur` (
`id` int(11) NOT NULL,
  `idMonde` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `niveau` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`id`, `idMonde`, `nom`, `prenom`, `mail`, `login`, `password`, `niveau`) VALUES
(12, 1, 'Lecomte', 'Matthias', 'matthias.lecomte@sts-sio-caen.info', 'matthias', 'e388d34fd3c0456122779e95f262c0d70198a168', 1),
(13, 1, 'Leducq', 'Charles', 'charles.leducq@sts-sio-caen.info', 'charles', 'cbdb0cc7f3f5b4be81a75fa7242590e3e9882e1e', 10),
(14, 1, 'Binet', 'Maxime', 'maxime.binet@sts-sio-caen.info', 'maxime', '1acc295174379ec718e1123290d06dcd8d68feb6', 100);

-- --------------------------------------------------------

--
-- Structure de la table `monde`
--

CREATE TABLE IF NOT EXISTS `monde` (
`id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `monde`
--

INSERT INTO `monde` (`id`, `libelle`) VALUES
(1, 'Informatique'),
(2, 'Librairie');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE IF NOT EXISTS `partie` (
`id` int(11) NOT NULL,
  `idJoueurEnCours` int(11) DEFAULT NULL,
  `idJoueur1` int(11) NOT NULL,
  `idJoueur2` int(11) DEFAULT NULL,
  `dernierCoup` datetime DEFAULT NULL,
  `partieFini` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

CREATE TABLE IF NOT EXISTS `probleme` (
`id` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`id` int(11) NOT NULL,
  `idDomaine` int(11) NOT NULL,
  `idJoueur` int(11) DEFAULT NULL,
  `libelle` text,
  `validation` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `idDomaine`, `idJoueur`, `libelle`, `validation`) VALUES
(1, 1, 14, 'Quel modèle d''ordinateurs Apple n''existe pas?', 1),
(2, 3, 13, 'De quelle couleur est le cheval blanc d''Henri IV?', 1),
(3, 2, 12, 'Question 1 desktop ?', 1),
(4, 2, 12, 'Question 2 desktop ?', 1),
(5, 3, 12, 'Pas censé avoir cette question ?', 1),
(6, 3, 12, 'Pas censé avoir cette question ?', 1),
(9, 5, 12, 'Question pour tablette ?', 1),
(10, 6, 12, 'Question pour smartphone ? ', 1),
(11, 7, 14, 'Question sur apple ?', 1),
(12, 8, 12, 'Question sur microsoft ?', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
`id` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `estBonne` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `idQuestion`, `libelle`, `estBonne`) VALUES
(1, 1, 'MacBook Air', 0),
(2, 1, 'Mac Pro', 0),
(3, 1, 'MacBook Pro', 0),
(4, 1, 'Power MacBook', 1),
(5, 2, 'Arc-en-ciel', 0),
(6, 2, 'Blanc', 0),
(7, 2, 'Bleu canard', 1),
(8, 2, 'La réponse D.', 0),
(9, 3, 'Bonne réponse', 1),
(10, 3, 'Mauvaise', 0),
(11, 3, 'Mauvaise', 0),
(12, 3, 'Mauvaise', 0),
(13, 4, 'Mauvaise', 0),
(14, 4, 'Bonne', 1),
(15, 4, 'Mauvaise', 0),
(16, 4, 'Mauvaise', 0),
(17, 5, 'Bonne', 1),
(18, 5, 'mauvaise', 0),
(19, 5, 'mauvaise', 0),
(20, 5, 'mauvaise', 0),
(21, 6, 'Mauvaise', 0),
(22, 6, 'Bonne', 1),
(23, 6, 'mauvaise', 0),
(24, 6, 'mauvaise', 0),
(25, 12, 'bonne', 1),
(26, 12, 'mauvaise', 0),
(27, 12, 'mauvaise', 0),
(28, 12, 'pas celle la ', 0),
(29, 11, 'clic en dessous', 0),
(30, 11, 'Bonne reponse', 1),
(31, 11, 'mauvaise', 0),
(32, 11, 'mauvaise', 0),
(33, 10, 'mauvause', 0),
(34, 10, 'mauvaise', 0),
(35, 10, 'bonne', 1),
(36, 10, 'mauvaise', 0),
(37, 9, 'bonne', 1),
(38, 9, 'mauvaise', 0),
(39, 9, 'mauvaise', 0),
(40, 9, 'mauvaise', 0);

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `idPartie` int(11) NOT NULL,
  `idJoueur` int(11) NOT NULL,
  `nbBonnesReponses` int(11) NOT NULL,
  `nbManches` int(11) NOT NULL,
  `repSuccessives` int(11) NOT NULL,
  `gagne` tinyint(1) NOT NULL,
  `egalite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE IF NOT EXISTS `signalement` (
  `idProbleme` int(11) NOT NULL,
  `idJoueur` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `dateS` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE IF NOT EXISTS `statistiques` (
  `idDomaine` int(11) NOT NULL,
  `idJoueur` int(11) NOT NULL,
  `nbBonnesReponses` int(6) DEFAULT NULL,
  `nbReponses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `couronne`
--
ALTER TABLE `couronne`
 ADD PRIMARY KEY (`idPartie`,`idJoueur`,`idDomaine`), ADD KEY `FK_score` (`idDomaine`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_appartenir` (`idMonde`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_travailler` (`idMonde`);

--
-- Index pour la table `monde`
--
ALTER TABLE `monde`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_doitJouer` (`idJoueur1`), ADD KEY `FK_participer1` (`idJoueur2`), ADD KEY `FK_participer2` (`idJoueurEnCours`);

--
-- Index pour la table `probleme`
--
ALTER TABLE `probleme`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_definir` (`idDomaine`), ADD KEY `FK_soumettre` (`idJoueur`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_correspondre` (`idQuestion`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
 ADD PRIMARY KEY (`idPartie`,`idJoueur`), ADD KEY `idJoueur` (`idJoueur`);

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
 ADD PRIMARY KEY (`idProbleme`,`idJoueur`,`idQuestion`), ADD KEY `FK_signalement` (`idJoueur`);

--
-- Index pour la table `statistiques`
--
ALTER TABLE `statistiques`
 ADD PRIMARY KEY (`idDomaine`,`idJoueur`), ADD KEY `idjoueur` (`idJoueur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `monde`
--
ALTER TABLE `monde`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT pour la table `probleme`
--
ALTER TABLE `probleme`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `couronne`
--
ALTER TABLE `couronne`
ADD CONSTRAINT `FK_score` FOREIGN KEY (`idDomaine`) REFERENCES `domaine` (`id`);

--
-- Contraintes pour la table `domaine`
--
ALTER TABLE `domaine`
ADD CONSTRAINT `FK_appartenir` FOREIGN KEY (`idMonde`) REFERENCES `monde` (`id`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
ADD CONSTRAINT `FK_travailler` FOREIGN KEY (`idMonde`) REFERENCES `monde` (`id`);

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
ADD CONSTRAINT `FK_doitJouer` FOREIGN KEY (`idJoueur1`) REFERENCES `joueur` (`id`),
ADD CONSTRAINT `FK_participer1` FOREIGN KEY (`idJoueur2`) REFERENCES `joueur` (`id`),
ADD CONSTRAINT `FK_participer2` FOREIGN KEY (`idJoueurEnCours`) REFERENCES `joueur` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
ADD CONSTRAINT `FK_definir` FOREIGN KEY (`idDomaine`) REFERENCES `domaine` (`id`),
ADD CONSTRAINT `FK_soumettre` FOREIGN KEY (`idJoueur`) REFERENCES `joueur` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
ADD CONSTRAINT `FK_correspondre` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`idPartie`) REFERENCES `partie` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`idJoueur`) REFERENCES `joueur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `signalement`
--
ALTER TABLE `signalement`
ADD CONSTRAINT `FK_signalement` FOREIGN KEY (`idJoueur`) REFERENCES `joueur` (`id`),
ADD CONSTRAINT `signalement_ibfk_1` FOREIGN KEY (`idProbleme`) REFERENCES `probleme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `statistiques`
--
ALTER TABLE `statistiques`
ADD CONSTRAINT `FK_statistiques` FOREIGN KEY (`idDomaine`) REFERENCES `domaine` (`id`),
ADD CONSTRAINT `statistiques_ibfk_1` FOREIGN KEY (`idJoueur`) REFERENCES `joueur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
