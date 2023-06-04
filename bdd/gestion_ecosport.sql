-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 27 mai 2023 à 15:21
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_ecosport`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertClient` (IN `c_nom` VARCHAR(50), IN `c_email` VARCHAR(50), IN `c_mdp` VARCHAR(50), IN `c_adresse` VARCHAR(50), IN `c_role` VARCHAR(50), IN `c_tel` VARCHAR(50), IN `c_prenom` VARCHAR(50))   Begin 
        Declare c_iduser int(5); 
        
        insert into user values (null, c_nom, c_email, c_mdp, c_adresse, c_role ); 
        select iduser into c_iduser 
        from user 
        where nom = c_nom and email =c_email and mdp=c_mdp and adresse = c_adresse; 
        insert into Client values (c_iduser, c_tel, c_prenom);
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEntreprise` (IN `c_nom` VARCHAR(50), IN `c_email` VARCHAR(50), IN `c_mdp` VARCHAR(50), IN `c_adresse` VARCHAR(50), IN `c_role` VARCHAR(50), IN `c_siret` VARCHAR(50))   Begin 
        Declare c_iduser int(5); 
        
        insert into user values (null, c_nom, c_email, c_mdp, c_adresse, c_role); 
        select iduser into c_iduser 
        from user 
        where nom = c_nom and email =c_email and mdp=c_mdp and adresse = c_adresse; 
        insert into Entreprise values (c_iduser, c_siret);
End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idarticle` int(5) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `idcategorie` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idarticle`, `nom`, `description`, `prix`, `image`, `stock`, `idcategorie`) VALUES
(1, 'Airforce', 'Paire de chaussure tendance', 120, 'airforce.png', 30, 1),
(2, 'Nike tn', 'Paire de chaussure tendance', 180, 'tn.png', 30, 1),
(3, 'Tee-shirt', 'Tee-shirt d ?t?', 35, 'tee-shirt.png', 30, 2),
(4, 'Survetement ', 'survetement nike tendance', 80, 'survet.png', 30, 2),
(5, 'Tee-shirt', 'Tee-shirt Nike', 15, 'Tee-shirt2.png', 30, 2),
(6, 'Jogging', 'Pantalon de surv?tement Jogging Adidas Hoodie, jogging, fermeture ? glissi?re', 25, 'pontalon.png', 30, 2),
(7, 'Jogging', 'Pantalon de jogging Nike Femme V?tements nike blanc,', 25, 'pontalon2.png', 30, 2),
(8, 'Airforce', 'Paire de chaussure tendance', 120, 'airforce.png', 30, 1),
(9, 'Nike tn', 'Paire de chaussure tendance', 180, 'tn.png', 30, 1),
(10, 'Tee-shirt', 'Tee-shirt d ?t?', 35, 'Tee-shirt.png', 30, 2),
(11, 'Jordan 4 Jumpman', 'La Air Jordan 4 est un mod?le de chaussures de la marque Jordan pr?sent? en 1988 dot? d un design unique l?ger et avec une unit? Air visible. Elle a ?t? cr?? pour am?liorer les performances en utilisant un mat?riau synth?tique innovant. Elle est devenue c?l?bre gr?ce ? un ?v?nement sportif en 1989.', 390, 'j4.jpg', 30, 1),
(12, 'asics', 'Asics Sport', 90, 'asics.png', 30, 1),
(13, 'Nike runing', 'Ideal pour le sport', 50, 'nikeruning.png', 30, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcategorie` int(3) NOT NULL,
  `image` varchar(50) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idcategorie`, `image`, `libelle`) VALUES
(1, 'logochauss.png', 'chaussure'),
(2, 'logovet.png', 'vetement'),
(3, 'accessoire.png', 'Accessoire');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `iduser` int(5) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`iduser`, `tel`, `prenom`) VALUES
(1, 'a', 'a');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idcommande` int(5) NOT NULL,
  `statut` enum('en cours','terminer') DEFAULT NULL,
  `DateCommande` datetime NOT NULL,
  `iduser` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE `commenter` (
  `idcommentaire` int(5) NOT NULL,
  `description` text NOT NULL,
  `iduser` int(5) NOT NULL,
  `idarticle` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `iduser` int(5) NOT NULL,
  `siret` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`iduser`, `siret`) VALUES
(2, 'e');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `IdCommande` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantite` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(5) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `role` enum('Client','Entreprise','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `nom`, `email`, `mdp`, `adresse`, `role`) VALUES
(1, 'Hassan', 'Client@gmail.com', '123', 'a', 'Client'),
(2, 'ShopHassan', 'Entreprise@gmail.com', '123', 'e', 'Entreprise'),
(3, 'nassar', 'admin@gmail.com', '123', '10 rue tkt', 'Admin');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `userpanierarticle`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `userpanierarticle` (
`iduser` int(5)
,`idcommande` int(11)
,`idarticle` int(5)
,`Nom` varchar(50)
,`image` varchar(50)
,`description` text
,`prix` float
,`quantite` int(3)
,`DateCommande` datetime
,`statut` enum('en cours','terminer')
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vueclients`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vueclients` (
`iduser` int(5)
,`nom` varchar(50)
,`email` varchar(50)
,`adresse` varchar(50)
,`tel` varchar(50)
,`prenom` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vueentreprise`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vueentreprise` (
`iduser` int(5)
,`nom` varchar(50)
,`email` varchar(50)
,`adresse` varchar(50)
,`siret` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `userpanierarticle`
--
DROP TABLE IF EXISTS `userpanierarticle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userpanierarticle`  AS   (select `u`.`iduser` AS `iduser`,`p`.`IdCommande` AS `idcommande`,`a`.`idarticle` AS `idarticle`,`a`.`nom` AS `Nom`,`a`.`image` AS `image`,`a`.`description` AS `description`,`a`.`prix` AS `prix`,`p`.`quantite` AS `quantite`,`c`.`DateCommande` AS `DateCommande`,`c`.`statut` AS `statut` from (((`user` `u` join `panier` `p`) join `article` `a`) join `commande` `c`) where `c`.`iduser` = `u`.`iduser` and `p`.`IdCommande` = `c`.`idcommande` and `p`.`idArticle` = `a`.`idarticle`)  ;

-- --------------------------------------------------------

--
-- Structure de la vue `vueclients`
--
DROP TABLE IF EXISTS `vueclients`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vueclients`  AS   (select `u`.`iduser` AS `iduser`,`u`.`nom` AS `nom`,`u`.`email` AS `email`,`u`.`adresse` AS `adresse`,`c`.`tel` AS `tel`,`c`.`prenom` AS `prenom` from (`user` `u` join `client` `c`) where `u`.`iduser` = `c`.`iduser`)  ;

-- --------------------------------------------------------

--
-- Structure de la vue `vueentreprise`
--
DROP TABLE IF EXISTS `vueentreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vueentreprise`  AS   (select `u`.`iduser` AS `iduser`,`u`.`nom` AS `nom`,`u`.`email` AS `email`,`u`.`adresse` AS `adresse`,`e`.`siret` AS `siret` from (`user` `u` join `entreprise` `e`) where `u`.`iduser` = `e`.`iduser`)  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idarticle`),
  ADD KEY `idcategorie` (`idcategorie`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idcategorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`iduser`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idcommande`),
  ADD KEY `iduser` (`iduser`);

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`idcommentaire`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idarticle` (`idarticle`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`iduser`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`IdCommande`,`idArticle`),
  ADD KEY `Panier_Article_FK` (`idArticle`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idarticle` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idcategorie` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idcommande` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commenter`
--
ALTER TABLE `commenter`
  MODIFY `idcommentaire` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idcategorie`) REFERENCES `categorie` (`idcategorie`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `client` (`iduser`);

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `commenter_ibfk_2` FOREIGN KEY (`idarticle`) REFERENCES `article` (`idarticle`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `entreprise_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `Panier_Article_FK` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idarticle`),
  ADD CONSTRAINT `Panier_Commande_FK` FOREIGN KEY (`IdCommande`) REFERENCES `commande` (`idcommande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
