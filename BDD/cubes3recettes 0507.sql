-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 juil. 2023 à 14:23
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cubes3recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

DROP TABLE IF EXISTS `commenter`;
CREATE TABLE IF NOT EXISTS `commenter` (
  `idRecette` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  `commentaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dateCommentaire` date NOT NULL,
  PRIMARY KEY (`idRecette`,`idUtilisateur`),
  KEY `commenter_utilisateur0_FK` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idRecette` int NOT NULL,
  `idIngredient` int NOT NULL,
  `idUniteMesure` int NOT NULL,
  `quantite` float NOT NULL,
  PRIMARY KEY (`idRecette`,`idIngredient`,`idUniteMesure`),
  KEY `contenir_ingredient0_FK` (`idIngredient`),
  KEY `contenir_uniteMesure1_FK` (`idUniteMesure`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`idRecette`, `idIngredient`, `idUniteMesure`, `quantite`) VALUES
(2, 102, 1, 100),
(2, 103, 1, 8),
(2, 104, 1, 24),
(2, 105, 1, 30),
(2, 106, 12, 3),
(2, 107, 1, 250),
(2, 108, 5, 50),
(3, 10, 1, 85),
(3, 72, 1, 250),
(3, 106, 12, 4),
(3, 109, 1, 130),
(3, 110, 1, 125),
(3, 111, 3, 25),
(3, 112, 1, 200),
(5, 5, 7, 2),
(5, 10, 1, 125),
(5, 57, 8, 1),
(5, 82, 8, 1),
(5, 109, 1, 185),
(5, 113, 1, 75),
(5, 114, 1, 170),
(8, 10, 1, 200),
(8, 109, 1, 400),
(8, 110, 7, 6),
(8, 114, 1, 500),
(17, 10, 1, 110),
(17, 21, 12, 1),
(17, 54, 1, 110),
(17, 57, 7, 1),
(17, 72, 1, 175),
(17, 109, 1, 225),
(17, 120, 1, 100),
(18, 10, 1, 110),
(18, 15, 1, 20),
(18, 21, 12, 1),
(18, 54, 1, 100),
(18, 57, 8, 1),
(18, 72, 1, 90),
(18, 109, 1, 225),
(18, 120, 1, 110),
(19, 10, 1, 50),
(19, 52, 1, 114),
(19, 95, 1, 7),
(19, 113, 1, 140),
(19, 121, 1, 280),
(19, 123, 1, 5),
(19, 124, 1, 30),
(19, 125, 8, 1),
(20, 5, 3, 150),
(20, 10, 1, 5),
(20, 73, 10, 1),
(20, 103, 8, 1),
(20, 106, 12, 2),
(20, 109, 1, 1225),
(20, 113, 7, 2),
(20, 128, 8, 1),
(21, 24, 7, 1),
(21, 107, 1, 250),
(21, 111, 1, 20),
(21, 129, 12, 20),
(21, 132, 7, 4),
(21, 133, 1, 150),
(22, 1, 6, 1),
(22, 20, 12, 1),
(22, 54, 6, 0.5),
(22, 57, 8, 1),
(22, 73, 8, 1),
(22, 103, 6, 1),
(22, 109, 6, 2),
(23, 10, 1, 125),
(23, 21, 12, 1),
(23, 57, 8, 1),
(23, 73, 10, 1),
(23, 109, 1, 220),
(23, 120, 1, 120),
(23, 133, 1, 200),
(23, 134, 1, 100);

-- --------------------------------------------------------

--
-- Structure de la table `continent`
--

DROP TABLE IF EXISTS `continent`;
CREATE TABLE IF NOT EXISTS `continent` (
  `idContinent` int NOT NULL AUTO_INCREMENT,
  `libContinent` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idContinent`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `continent`
--

INSERT INTO `continent` (`idContinent`, `libContinent`) VALUES
(1, 'Afrique'),
(2, 'Amérique du sud'),
(3, 'Amérique du nord'),
(4, 'Asie'),
(5, 'Europe'),
(6, 'Océanie');

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `idEtape` int NOT NULL AUTO_INCREMENT,
  `libEtape` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idRecette` int NOT NULL,
  PRIMARY KEY (`idEtape`),
  KEY `etape_recette_FK` (`idRecette`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`idEtape`, `libEtape`, `idRecette`) VALUES
(1, 'Séparer les blancs des jaunes d\'oeufs.', 2),
(2, 'Mélanger les jaunes avec le sucre roux et le sucre', 2),
(3, 'Ajouter le mascarpone au fouet.', 2),
(4, 'Monter les blancs en neige et les incorporer délic', 2),
(5, 'Mouiller les biscuits dans le café rapidement avan', 2),
(6, 'Recouvrir d\'une couche de crème au mascarpone puis', 2),
(7, 'Saupoudrer de cacao.', 2),
(8, 'Mettre au réfrigérateur 4 heures minimum puis dégu', 2),
(9, 'Faites fondre 35 g de beurre au micro-ondes.', 3),
(10, 'Mettez les jaunes d’œufs avec le sucre dans la cuve de votre robot. Mélangez au fouet jusqu’à ce que la préparation devienne mousseuse.', 3),
(11, 'Ajoutez petit à petit la farine puis le beurre tout en mélangeant.', 3),
(12, 'Incorporez vos blancs en neige à cette pâte à l’aide d’une maryse en soulevant la masse.', 3),
(13, 'Versez votre pâte sur une plaque de cuisson recouverte de papier sulfurisé ou d’une feuille de silicone. Enfournez à 200 °C pendant 7 minutes.', 3),
(14, 'Déposez votre génoise sur un torchon humide et laissez-le refroidir.', 3),
(16, 'Cassez le chocolat en morceaux.', 3),
(17, 'Faites fondre 50 g de beurre au micro-ondes.', 3),
(18, 'Dans une casserole, chauffez la crème liquide. Lorsque le crème bout coupez le feu.', 3),
(19, 'Versez petit à petit la crème sur le chocolat en morceaux tout mélangeant jusqu’à obtenir une préparation homogène.', 3),
(20, 'Ajoutez le beurre et mélangez. Laissez refroidir à température ambiante afin d’obtenir la consistance d’une pâte à tartiner.', 3),
(21, 'Tartinez la surface de votre génoise de ganache. Roulez délicatement l’ensemble. Éliminez les extrémités.', 3),
(22, 'Tartinez le pourtour de votre bûche de ganache puis appliquez des copeaux de chocolat.', 3),
(37, '1) préchauffer le four à 180°C .', 5),
(38, 'Préparer une feuille de papier sulfurisé.', 5),
(39, '2) travailler le beurre, le sucre et l\'essence de vanille dans un saladier jusqu\'à obtention d\'un mélange crémeux et clair.', 5),
(40, '3) ajouter la farine et la levure chimique ainsi que le lait à la prépation au beurre. Mélanger avec une cuiller en bois.', 5),
(41, '4) façonner de petites boulettes de pâte (une noix) avec les mains légèrement farinées, puis les poser sur la plaque de cuisson à 5 cm d\'intervalle. les aplatir avec la spatule de bois (3,5 cm). Avec le doigt creuser une cavité au centre de chaque galette et la remplir de confiture.', 5),
(42, '5) enfourner pendant 18 à 20 mn. Laisser reposer 2 à 3 mn. laisser refroidir sur une grille à pâtisserie. Conserver 8 jours dans une boîte métallique.', 5),
(43, 'Bon appétit.', 5),
(44, 'Mélanger la farine, le sucre et le beurre. Bien pétrir, d\'abord par morceaux.', 8),
(45, 'Former des fines rondelles, petites ou grandes, comme vous voulez !', 8),
(46, 'Les mettre sur une plaque de cuisson (beurrée) à 175°C (thermostat 6) jusqu\'à ce qu\'elles dorent légèrement.', 8),
(47, 'Etaler dessus la confiture de lait, couvrir avec une autre rondelle et saupoudrer de sucre glace.', 8),
(60, 'Battre le beurre mou et le sucre jusqu’à consistance mousseuse', 17),
(61, 'Ajouter l\'oeuf et battre jusqu’à incorporation totale', 17),
(62, 'Tamiser la farine avec le sel et la levure', 17),
(63, 'Ajouter la farine au mélange précédent et incorporer le tout', 17),
(64, 'Ajouter enfin les pépites de chocolat et malaxer le tout', 17),
(65, 'Préchauffer le four à 180°C', 17),
(66, 'Faire des boules de pâte que vous poserez sur le papier sulfurisé en les aplatissant un peu', 17),
(67, 'Faire cuire 8-10 min', 17),
(68, 'Laisser refroidir puis se régaler', 17),
(69, 'Battre le beurre mou et le sucre jusqu’à consistance mousseuse', 18),
(70, 'Ajouter l\'oeuf et battre jusqu’à incorporation totale', 18),
(71, 'Tamiser la farine avec le sel et la levure', 18),
(72, 'Ajouter la farine au mélange précédent et incorporer le tout', 18),
(73, 'Ajouter enfin les pépites de chocolat et malaxer le tout', 18),
(74, 'Préchauffer le four à 180°C', 18),
(75, 'Faire des boules de pates puis les placers sur une plaque en aplatissant légèrement les boules', 18),
(76, 'Enfourner pour 8-10 minutes', 18),
(77, 'laisser refroidir', 18),
(78, 'Dans un grand bol, mélangez les ingrédients secs : farine, levure, le sucre, 1 pincée de sel et un sachet de sucre vanillé', 20),
(79, 'Dans un autre bol, mélangez les 2 jaunes d\'oeuf avec le lait puis ajoutez aux ingrédients secs en mélangeant, vous obtenez une texture de pâte à crêpes bien épaisse, laissez reposer 15 à 30 minutes', 20),
(80, 'Battez les blancs en neige et ajoutez-les délicatement à la préparation (c\'est le secret de pancakes ultra moelleux)', 20),
(81, 'Battez les blancs en neige et ajoutez-les délicatement à la préparation (c\'est le secret de pancakes ultra moelleux)', 20),
(82, 'Le bord doit être doré, et des petites bulles doivent se former sur le dessus, c\'est le moment de retourner le pancake !', 20),
(83, 'Mélangez la levure dans un bol d’eau tiède.', 22),
(84, 'Dans un saladier, versez la farine, le sucre, le sel. Mélangez le tout et faites un puits au centre. Versez le mélange eau+levure dans le puits puis mélangez jusqu\'à obtenir une pâte élastique et homogène. Couvrez la pâte et laissez la doubler de volume dans un coin de la pièce.', 22),
(85, 'Dans un saladier, versez la farine, le sucre, le sel. Mélangez le tout et faites un puits au centre. Versez le mélange eau+levure dans le puits puis mélangez jusqu\'à obtenir une pâte élastique et homogène. Couvrez la pâte et laissez la doubler de volume dans un coin de la pièce.', 22),
(86, 'Dans un saladier, versez la farine, le sucre, le sel. Mélangez le tout et faites un puits au centre. Versez le mélange eau+levure dans le puits puis mélangez jusqu\'à obtenir une pâte élastique et homogène. Couvrez la pâte et laissez la doubler de volume dans un coin de la pièce.', 22),
(87, 'Égouttez les sur du papier absorbant. Quand c’est prêt servez chaud avec une sauce pimenté ou des haricots sautés !', 22),
(88, 'Préchauffez le four à 180 °C.', 23),
(89, 'Concassez grossièrement le chocolat blanc.', 23),
(90, 'Coupez le beurre en dés et malaxez-le avec la cassonade.', 23),
(91, 'Mélangez ensemble la farine, le chocolat blanc, la levure chimique et le sel. Ajoutez dans le saladier avec l’œuf.', 23),
(92, 'Ajouter les myrtilles et mélanger doucement', 23),
(93, 'Malaxez pour obtenir une pâte homogène. Façonnez des boules et aplatissez-les un peu entre vos mains.', 23),
(94, 'Déposez-les à intervalles réguliers sur une plaque couverte de papier cuisson.', 23),
(95, 'Enfournez 10 min puis laissez refroidir les cookies sur une grille.', 23);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `idIngredient` int NOT NULL AUTO_INCREMENT,
  `libIngredient` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idIngredient`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`idIngredient`, `libIngredient`) VALUES
(1, 'Eau'),
(2, 'Fruit'),
(3, 'Pâte de cacao'),
(4, 'E422'),
(5, 'Lait'),
(6, 'E471'),
(7, 'Chocolat'),
(8, 'Fructose'),
(9, 'Beurre de cacao'),
(10, 'Beurre'),
(11, 'E330'),
(12, 'Sirop de glucose-fructose'),
(13, 'Lécithine de soja'),
(14, 'Lait en poudre'),
(15, 'Poudre de cacao'),
(16, 'Sirop de glucose'),
(17, 'Conservateur'),
(18, 'Arôme vanille'),
(19, 'E450i'),
(20, 'Huile végétale'),
(21, 'Œuf entier'),
(22, 'E500ii'),
(23, 'Colorant'),
(24, 'Arôme naturel de vanille'),
(25, 'E202'),
(26, 'Fruits à coque'),
(27, 'E420'),
(28, 'E415'),
(29, 'Épaississant'),
(30, 'Correcteur d\'acidité'),
(31, 'en:Tree nut'),
(32, 'Œuf frais'),
(33, 'Lait en poudre écrémé'),
(34, 'Amidon de froment'),
(35, 'Huile et matière grasse de palme'),
(36, 'Graisse'),
(37, 'Poudre de cacao maigre'),
(38, 'Alcool'),
(39, 'Matière grasse lactique'),
(40, 'Sucre inverti'),
(41, 'Gélifiant'),
(42, 'Dextrose'),
(43, 'Acidifiant'),
(44, 'Matière grasse butyrique'),
(45, 'E440a'),
(46, 'Gluten'),
(47, 'Sirop de sucre'),
(48, 'Sirop de sucre inverti'),
(49, 'Amidon de maïs'),
(50, 'Huile de tournesol'),
(51, 'Huile de palme'),
(52, 'Blanc d\'œuf'),
(53, 'Amidon modifié'),
(54, 'Sucre de canne'),
(55, 'Jaune d\'œuf'),
(56, 'Amande'),
(57, 'Levure'),
(58, 'Agrume'),
(59, 'Lait entier en poudre'),
(60, 'Plante'),
(61, 'E503'),
(62, 'Petit-lait'),
(63, 'Protéine'),
(64, 'Crème'),
(65, 'Humectant'),
(66, 'Protéine animale'),
(67, 'Protéine de lait'),
(68, 'Soja'),
(69, 'en:Berries'),
(70, 'Lécithine de tournesol'),
(71, 'Légume'),
(72, 'Chocolat noir'),
(73, 'Sel marin'),
(74, 'Jus de fruits'),
(75, 'Riz'),
(76, 'Amidon de pommes de terre'),
(77, 'Lactosérum en poudre'),
(78, 'Lactose'),
(79, 'E412'),
(80, 'Noisette'),
(81, 'Morceaux de chocolat'),
(82, 'Vanille'),
(83, 'E160a'),
(84, 'E341'),
(85, 'Graisse de palme'),
(86, 'Amande en poudre'),
(87, 'Orange'),
(88, 'Raisin'),
(89, 'Légume-racine'),
(90, 'Huile de coco'),
(91, 'Matière grasse végétale'),
(92, 'Rhum'),
(93, 'Gluten de blé'),
(94, 'E300'),
(95, 'Jus de citron'),
(96, 'Farine de riz'),
(97, 'Miel'),
(98, 'Sucre non raffiné'),
(99, 'E160'),
(100, 'Citron'),
(101, 'Sucre de canne'),
(102, 'sucre roux'),
(103, 'sucre vanillé'),
(104, 'Biscuit à la cuillère'),
(105, 'cacao amer'),
(106, 'oeufs'),
(107, 'mascarpone'),
(108, 'café noir non sucré'),
(109, 'farine'),
(110, 'sucre'),
(111, 'crème liquide entière'),
(112, 'copeaux de chocolat noir'),
(113, 'sucre en poudre'),
(114, 'confiture au choix'),
(115, 'Nutella'),
(116, 'Banane'),
(117, 'Sucre'),
(118, 'Patate'),
(119, 'Farine'),
(120, 'Cassonade'),
(121, 'Purée de framboise'),
(122, 'Sucre en poudre'),
(123, 'Pectine jaune'),
(124, 'Glucose'),
(125, 'Arôme naturel de framboise'),
(126, 'Oeufs'),
(127, 'Sucre vanillé'),
(128, 'Bicarbonate'),
(129, 'Crêpes'),
(130, 'Mascarpone'),
(131, 'Crème liquide entière'),
(132, 'Sucre glace'),
(133, 'Chocolat blanc'),
(134, 'Myrtille');

-- --------------------------------------------------------

--
-- Structure de la table `memoriser`
--

DROP TABLE IF EXISTS `memoriser`;
CREATE TABLE IF NOT EXISTS `memoriser` (
  `idUtilisateur` int NOT NULL,
  `idRecette` int NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idRecette`),
  KEY `memoriser_recette0_FK` (`idRecette`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `noter`
--

DROP TABLE IF EXISTS `noter`;
CREATE TABLE IF NOT EXISTS `noter` (
  `idRecette` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  `note` int NOT NULL,
  PRIMARY KEY (`idRecette`,`idUtilisateur`),
  KEY `noter_utilisateur0_FK` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `noter`
--

INSERT INTO `noter` (`idRecette`, `idUtilisateur`, `note`) VALUES
(18, 10, 4),
(19, 10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `idPays` int NOT NULL AUTO_INCREMENT,
  `libPays` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idContinent` int NOT NULL,
  PRIMARY KEY (`idPays`),
  KEY `pays_continent_FK` (`idContinent`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`idPays`, `libPays`, `idContinent`) VALUES
(1, 'Afghanistan', 4),
(2, 'Afrique du Sud', 1),
(3, 'Albanie', 5),
(4, 'Algérie', 1),
(5, 'Allemagne', 5),
(6, 'Andorre', 5),
(7, 'Angola', 1),
(8, 'Antigua-et-Barbuda', 3),
(9, 'Arabie Saoudite', 4),
(10, 'Argentine', 2),
(11, 'Arménie', 4),
(12, 'Australie', 6),
(13, 'Autriche', 5),
(14, 'Azerbaïdjan', 4),
(15, 'Bahamas', 3),
(16, 'Bahreïn', 4),
(17, 'Bangladesh', 4),
(18, 'Barbade', 3),
(19, 'Bélarus', 5),
(20, 'Belgique', 5),
(21, 'Belize', 3),
(22, 'Bénin', 1),
(23, 'Bhoutan', 4),
(24, 'Bolivie', 2),
(25, 'Bosnie-Herzégovine', 5),
(26, 'Botswana', 1),
(27, 'Brésil', 2),
(28, 'Brunei', 4),
(29, 'Bulgarie', 5),
(30, 'Burkina Faso', 1),
(31, 'Burundi', 1),
(32, 'Cambodge', 4),
(33, 'Cameroun', 1),
(34, 'Canada', 3),
(35, 'Cap-Vert', 1),
(36, 'République centrafricaine', 1),
(37, 'Chili', 2),
(38, 'Chine', 4),
(39, 'Chypre', 4),
(40, 'Colombie', 2),
(41, 'Comores', 1),
(42, 'République du Congo', 1),
(43, 'République démocratique du Congo', 1),
(44, 'Corée du Nord', 4),
(45, 'Corée du Sud', 4),
(46, 'Costa Rica', 3),
(47, 'Côte d\'Ivoire', 1),
(48, 'Croatie', 5),
(49, 'Cuba', 3),
(50, 'Danemark', 5),
(51, 'Djibouti', 1),
(52, 'République dominicaine', 3),
(53, 'Dominique', 3),
(54, 'Égypte', 1),
(55, 'Émirats arabes unis', 4),
(56, 'Équateur', 2),
(57, 'Érythrée', 1),
(58, 'Espagne', 5),
(59, 'Estonie', 5),
(60, 'États-Unis', 3),
(61, 'Éthiopie', 1),
(62, 'Fidji', 6),
(63, 'Finlande', 5),
(64, 'France', 5),
(65, 'Gabon', 1),
(66, 'Gambie', 1),
(67, 'Géorgie', 4),
(68, 'Ghana', 1),
(69, 'Grèce', 5),
(70, 'Grenade', 3),
(71, 'Guatemala', 3),
(72, 'Guinée', 1),
(73, 'Guinée-Bissau', 1),
(74, 'Guinée équator', 1),
(75, 'Guyana', 2),
(76, 'Haïti', 3),
(77, 'Honduras', 2),
(78, 'Hongrie', 5),
(79, 'Îles Marshall', 6),
(80, 'Îles Salomon', 6),
(81, 'Inde', 4),
(82, 'Indonésie', 4),
(83, 'Iran', 4),
(84, 'Irak', 4),
(85, 'Irlande', 5),
(86, 'Islande', 5),
(87, 'Israël', 4),
(88, 'Italie', 5),
(89, 'Jamaïque', 3),
(90, 'Japon', 4),
(91, 'Jordanie', 4),
(92, 'Kazakhstan', 4),
(93, 'Kenya', 1),
(94, 'Kirghizistan', 4),
(95, 'Kiribati', 6),
(96, 'Koweït', 4),
(97, 'Laos', 4),
(98, 'Lesotho', 1),
(99, 'Lettonie', 5),
(100, 'Liban', 4),
(101, 'Libéria', 1),
(102, 'Libye', 1),
(103, 'Liechtenstein', 5),
(104, 'Lituanie', 5),
(105, 'Luxembourg', 5),
(106, 'Macédoine du Nord', 5),
(107, 'Madagascar', 1),
(108, 'Malaisie', 4),
(109, 'Malawi', 1),
(110, 'Maldives', 4),
(111, 'Mali', 1),
(112, 'Malte', 5),
(113, 'Maroc', 1),
(114, 'Maurice', 1),
(115, 'Mauritanie', 1),
(116, 'Mexique', 3),
(117, 'Micronésie', 6),
(118, 'Moldavie', 5),
(119, 'Monaco', 5),
(120, 'Mongolie', 4),
(121, 'Monténégro', 5),
(122, 'Mozambique', 1),
(123, 'Myanmar (Birmanie)', 4),
(124, 'Namibie', 1),
(125, 'Nauru', 6),
(126, 'Népal', 4),
(127, 'Nicaragua', 2),
(128, 'Niger', 1),
(129, 'Nigéria', 1),
(130, 'Niue', 6),
(131, 'Norvège', 5),
(132, 'Nouvelle-Zélande', 6),
(133, 'Oman', 4),
(134, 'Ouganda', 1),
(135, 'Ouzbékistan', 4),
(136, 'Pakistan', 4),
(137, 'Palaos', 6),
(138, 'Palestine', 4),
(139, 'Panama', 2),
(140, 'Papouasie-Nouvelle-Guinée', 6),
(141, 'Paraguay', 2),
(142, 'Pays-Bas', 5),
(143, 'Pérou', 2),
(144, 'Philippines', 4),
(145, 'Pologne', 5),
(146, 'Portugal', 5),
(147, 'Qatar', 4),
(148, 'République centrafricaine', 1),
(149, 'République dominicaine', 3),
(150, 'République tchèque', 5),
(151, 'Roumanie', 5),
(152, 'Royaume-Uni', 5),
(153, 'Russie', 5),
(154, 'Rwanda', 1),
(155, 'Saint-Christophe-et-Niévès', 3),
(156, 'Saint-Marin', 5),
(157, 'Saint-Vincent-et-les-Grenadines', 3),
(158, 'Sainte-Lucie', 3),
(159, 'Salvador', 3),
(160, 'Samoa', 6),
(161, 'Sao Tomé-et-Principe', 1),
(162, 'Sénégal', 1),
(163, 'Serbie', 5),
(164, 'Seychelles', 1),
(165, 'Sierra Leone', 1),
(166, 'Singapour', 4),
(167, 'Slovaquie', 5),
(168, 'Slovénie', 5),
(169, 'Somalie', 1),
(170, 'Soudan', 1),
(171, 'Soudan du Sud', 1),
(172, 'Sri Lanka', 4),
(173, 'Suède', 5),
(174, 'Suisse', 5),
(175, 'Suriname', 2),
(176, 'Eswatini', 1),
(177, 'Syrie', 4),
(178, 'Tadjikistan', 4),
(179, 'Tanzanie', 1),
(180, 'Tchad', 1),
(181, 'Thaïlande', 4),
(182, 'Timor oriental', 4),
(183, 'Togo', 1),
(184, 'Tonga', 6),
(185, 'Trinité-et-Tobago', 3),
(186, 'Tunisie', 1),
(187, 'Turkménistan', 4),
(188, 'Turquie', 5),
(189, 'Tuvalu', 6),
(190, 'Ukraine', 5),
(191, 'Uruguay', 2),
(192, 'Vanuatu', 6),
(193, 'Vatican', 5),
(194, 'Venezuela', 2),
(195, 'Viêt Nam', 4),
(196, 'Yémen', 4),
(197, 'Zambie', 1),
(198, 'Zimbabwe', 1);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
  `idRole` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`idRole`,`idUtilisateur`),
  KEY `posseder_utilisateur0_FK` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`idRole`, `idUtilisateur`) VALUES
(2, 1),
(1, 2),
(2, 9),
(1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `idRecette` int NOT NULL AUTO_INCREMENT,
  `dateRecette` date NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nbPersonnes` int NOT NULL,
  `histoire` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idUtilisateur` int NOT NULL,
  `idStatut` int NOT NULL,
  `idPays` int NOT NULL,
  PRIMARY KEY (`idRecette`),
  KEY `recette_utilisateur_FK` (`idUtilisateur`),
  KEY `recette_statutRecette0_FK` (`idStatut`),
  KEY `recette_pays1_FK` (`idPays`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`idRecette`, `dateRecette`, `titre`, `nbPersonnes`, `histoire`, `idUtilisateur`, `idStatut`, `idPays`) VALUES
(2, '2023-05-22', 'Tiramisu', 4, 'On raconte qu\'à la fin du XVIème siècle, la véritable recette du tiramisu a été inventée en Toscane en raison de la visite du grand-duc de Toscane Cosme III de Médicis. Ce dernier a tellement aimé ce dessert italien qu’il l’a partagé dans toutes les régions d’Italie. Au XVIIIème siècle, ce dessert i', 1, 2, 88),
(3, '2023-05-24', 'Bûche de Noël exceptio\'nnelle', 10, 'C\'est une création personnelle', 1, 2, 64),
(5, '2023-05-24', 'Biscuits à la confiture', 15, 'Biscuits for the tea time, évidemment !', 1, 2, 152),
(8, '2023-05-30', 'Alfajores', 8, 'c\'est en 1840 que l\'alfajor se démocratise en Amérique latine : lorsqu\'un Français (oui oui), Auguste Chammas, fonde une fabrique familiale en Argentine. Il y fabrique plusieurs sucreries et va s\'inspirer de l\'alajú pour créer l\'alfajor tel que vous pouvez le trouver aujourd\'hui en Amérique latine.', 1, 2, 10),
(17, '2023-07-05', 'Cookies', 4, 'Les meilleurs cookies sont à Disneyland', 10, 2, 60),
(18, '2023-07-05', 'Cookie full choco', 4, 'pour les amoureux de chocolat et de moelleux ', 10, 2, 60),
(19, '2023-07-05', 'Macarons', 5, 'Comme beaucoup d’autres pâtisseries à base d’amande, le macaron puise ses origines au Moyen-Orient où l’on estime qu’il était consommé au Moyen-Âge avant d’être découvert par les premiers navigateurs européens.', 10, 2, 64),
(20, '2023-07-05', 'Pancake', 4, 'Un pancake aussi appelé crêpe américaine1, est un type de crêpe épaisse de petit diamètre, servie habituellement le matin ou l\'après-midi au Royaume-Uni et au petit déjeuner en Amérique du Nord.', 10, 2, 152),
(21, '2023-07-05', 'Gâteau de crêpes au matcha', 4, 'Ma derniere découverte de la fusion entre la Bretagne et le Japon', 10, 2, 90),
(22, '2023-07-05', 'Beignet Africain', 6, 'Découvert lors d\'un voyage en Afrique, je vous présente c\'est beignet facile à réaliser', 10, 2, 61),
(23, '2023-07-05', 'Cookies Chocolat Blanc Myrtille', 4, 'Qui pourrait résister à ces merveilleux cookies !', 10, 2, 60);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int NOT NULL AUTO_INCREMENT,
  `libRole` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `libRole`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `statutrecette`
--

DROP TABLE IF EXISTS `statutrecette`;
CREATE TABLE IF NOT EXISTS `statutrecette` (
  `idStatut` int NOT NULL AUTO_INCREMENT,
  `libStatut` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idStatut`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statutrecette`
--

INSERT INTO `statutrecette` (`idStatut`, `libStatut`) VALUES
(1, 'Envoyé'),
(2, 'En cours de traitement'),
(3, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `unitemesure`
--

DROP TABLE IF EXISTS `unitemesure`;
CREATE TABLE IF NOT EXISTS `unitemesure` (
  `idUniteMesure` int NOT NULL AUTO_INCREMENT,
  `libUniteMesure` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idUniteMesure`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `unitemesure`
--

INSERT INTO `unitemesure` (`idUniteMesure`, `libUniteMesure`) VALUES
(1, 'g'),
(2, 'kg'),
(3, 'mg'),
(4, 'once'),
(5, 'livre'),
(6, 'tasse'),
(7, 'c. à soupe'),
(8, 'c. à café'),
(9, 'verre'),
(10, 'pincée'),
(11, 'trait'),
(12, ' ');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `validationProfil` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `mail`, `password`, `validationProfil`) VALUES
(1, 'HOUDAILLE', 'Valérie', 'hadriva@wanadoo.fr', '$2y$10$WsSP4/tOXqwA2pma6t6g1.L4eO0ZyRPEN16IrDZHmQrM5y2PnU7vC', 1),
(2, 'HOUDAILLE', 'Valérie', 'valerie.houdaille@viacesi.fr', '$2y$10$N2fFn/2yAqWiKhbu33Y/UeFbtkbbYzcz1xBOGkynkqUGKmNXY6gcq', 1),
(9, 'BLUE', 'Tom', 'tom.blue@mail.fr', '$2y$10$nnRafhu3BuUSZSzJVZYPDu8ptrp2fyUIWIZ5qnG9Jrn7GMmKlXLme', 0),
(10, 'Chev', 'Jni', 'jeannicolas.chevret@viacesi.fr', '$2y$10$jHy4DPUN8x3Mchrovddwou1Q5GzYK.p41ZaTK/4rv4e0pjttaXR9K', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_recette_FK` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `commenter_utilisateur0_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ingredient0_FK` FOREIGN KEY (`idIngredient`) REFERENCES `ingredient` (`idIngredient`),
  ADD CONSTRAINT `contenir_recette_FK` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `contenir_uniteMesure1_FK` FOREIGN KEY (`idUniteMesure`) REFERENCES `unitemesure` (`idUniteMesure`);

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `etape_recette_FK` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`);

--
-- Contraintes pour la table `memoriser`
--
ALTER TABLE `memoriser`
  ADD CONSTRAINT `memoriser_recette0_FK` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `memoriser_utilisateur_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `noter`
--
ALTER TABLE `noter`
  ADD CONSTRAINT `noter_recette_FK` FOREIGN KEY (`idRecette`) REFERENCES `recette` (`idRecette`),
  ADD CONSTRAINT `noter_utilisateur0_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `pays`
--
ALTER TABLE `pays`
  ADD CONSTRAINT `pays_continent_FK` FOREIGN KEY (`idContinent`) REFERENCES `continent` (`idContinent`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_role_FK` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`),
  ADD CONSTRAINT `posseder_utilisateur0_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `recette_pays1_FK` FOREIGN KEY (`idPays`) REFERENCES `pays` (`idPays`),
  ADD CONSTRAINT `recette_statutRecette0_FK` FOREIGN KEY (`idStatut`) REFERENCES `statutrecette` (`idStatut`),
  ADD CONSTRAINT `recette_utilisateur_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
