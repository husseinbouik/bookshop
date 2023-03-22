-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 mars 2023 à 17:36
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
-- Base de données : `borrowing_books`
--

-- --------------------------------------------------------

--
-- Structure de la table `borrowings`
--

CREATE TABLE `borrowings` (
  `Borrowing_Code` int(11) NOT NULL,
  `Borrowing_Date` datetime DEFAULT NULL,
  `Borrowing_Return_Date` datetime DEFAULT NULL,
  `Collection_Code` int(11) NOT NULL,
  `Nickname` varchar(150) NOT NULL,
  `Reservation_Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

CREATE TABLE `collection` (
  `Collection_Code` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Author_Name` varchar(100) DEFAULT NULL,
  `Cover_Image` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Edition_Date` date DEFAULT NULL,
  `Buy_Date` date DEFAULT NULL,
  `Status` varchar(150) DEFAULT NULL,
  `Type_Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `collection`
--

INSERT INTO `collection` (`Collection_Code`, `Title`, `Author_Name`, `Cover_Image`, `State`, `Edition_Date`, `Buy_Date`, `Status`, `Type_Code`) VALUES
(1, 'Red,White & Royal blue ', 'Casey McQuiston', '../images/Group 54.png', 'Good condition', '2019-05-14', '2019-12-01', 'Available', 1),
(2, 'The Cruel Prince', ' Holly Black', '../images/Group 55.jpg', 'New', '2017-01-02', '2020-03-01', 'Available', 2),
(3, 'Rich Dad Poor Dad', 'Robert Kiyosaki&Sharon L. Lechter', '../images/Group 53.png', 'New', '2000-04-01', '2001-03-01', 'Available', 3),
(4, 'The Hating Game', 'Peter Hutchings', '../images/Group 52.png', 'Acceptable', '2021-12-10', '2022-04-11', 'Available', 4),
(5, 'Ugly Love', 'Colleen Hoover', '../images/Group 49.png', 'Good condition', '2014-08-05', '2015-05-21', 'Available', 5),
(6, 'The law of Human Nature', 'Robert Greene', '../images/Group 50.png', 'New', '2018-10-16', '2018-12-04', 'Available', 6),
(7, 'The Seven Husbands of Evelyn Hugo', 'Taylor Jenkins Reid', '../images/Group 51.png', 'Good condition', '2017-06-13', '2017-09-01', 'Available', 7),
(8, 'Ego is The Enemy', 'Ryan Holiday', '../images/Group 61.jpg', 'Acceptable', '2017-06-14', '2018-01-20', 'Available', 8),
(9, 'The Book Thief', 'Markus Zusak', '../images/Group 56.webp', 'Quite worn', '2006-03-01', '2007-11-10', 'Available', 9),
(10, 'They Both Die at the End', 'Adam Silvera', '../images/Group 57.jpg', 'New', '2017-09-05', '2018-12-21', 'Available', 10),
(11, 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', '../images/Group 47.png', 'Good condition', '2016-09-13', '2017-05-11', 'Available', 11),
(12, 'Call me by your Name', 'André Aciman', '../images/Group 48.png', 'Quite worn', '2007-01-23', '2008-06-21', 'Available', 12),
(13, 'The School for Good and Evil', ' Paul Feig', '../images/Group 58.jpg', 'Acceptable', '2022-10-18', '2023-01-01', 'Available', 13),
(14, 'Enola Holmes', 'Harry Bradbeer', '../images/Group 59.jpg', 'Good condition', '2020-09-23', '2020-12-11', 'Available', 14),
(15, 'Red Notice', ' Rawson Marshall Thurber', '../images/Group 60.jpg', 'Torn', '2023-03-01', '2021-11-04', 'Available', 15);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `Nickname` varchar(150) NOT NULL,
  `Firstname` varchar(150) DEFAULT NULL,
  `Lastname` varchar(150) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(100) DEFAULT NULL,
  `CIN` varchar(50) DEFAULT NULL,
  `Occupation` varchar(50) DEFAULT NULL,
  `Penalty_Count` int(11) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Creation_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`Nickname`, `Firstname`, `Lastname`, `Password`, `Admin`, `Address`, `Email`, `PhoneNumber`, `CIN`, `Occupation`, `Penalty_Count`, `Birth_Date`, `Creation_Date`) VALUES
('Admin', 'Sarah', 'Ingram', '$2y$10$CWwPpReTTbqmR7I2jDU11uNjJ7Dd.78qHVJkzXYKRv6fjFtHFFG8.', 1, 'Nisi quisquam qui mo', 'gajalyh@mailinator.com', '0632718980', 'Et dolorem ut quisqu', 'Etudiant', NULL, '1986-02-15', '2023-03-22'),
('husseinbk', 'hussein', 'bouik', '$2y$10$szgSPprz6krh7H8wVzVSWObHD4AXehZHPhwh0k0pnJUVRzW.K7p8m', 0, 'Totam quis modi elit', 'jefosew@mailinator.com', '0632718980', 'Aut consequatur Acc', 'Etudiant', NULL, '2013-07-11', '2023-03-22');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_Code` int(11) NOT NULL,
  `Reservation_Date` datetime DEFAULT NULL,
  `Reservation_Expiration_Date` datetime DEFAULT NULL,
  `Collection_Code` int(11) NOT NULL,
  `Nickname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `Type_Code` int(11) NOT NULL,
  `Type_Name` varchar(50) DEFAULT NULL,
  `pages_or_duration` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`Type_Code`, `Type_Name`, `pages_or_duration`) VALUES
(1, 'Book', '421'),
(2, 'Book', '370'),
(3, 'Book', '336'),
(4, 'Book', '384'),
(5, 'Book', '373'),
(6, 'Book', '624'),
(7, 'Book', '400'),
(8, 'Book', '226'),
(9, 'Book', '584'),
(10, 'Book', '384'),
(11, 'Book', '224'),
(12, 'Book', '256'),
(13, 'DVD', '147'),
(14, 'DVD', '123'),
(15, 'DVD', '118');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`Borrowing_Code`),
  ADD UNIQUE KEY `Reservation_Code` (`Reservation_Code`),
  ADD KEY `Collection_Code` (`Collection_Code`),
  ADD KEY `Nickname` (`Nickname`);

--
-- Index pour la table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`Collection_Code`),
  ADD KEY `Type_Code` (`Type_Code`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Nickname`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_Code`),
  ADD KEY `Collection_Code` (`Collection_Code`),
  ADD KEY `Nickname` (`Nickname`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Type_Code`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `Borrowing_Code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `collection`
--
ALTER TABLE `collection`
  MODIFY `Collection_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_Code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `Type_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`Collection_Code`) REFERENCES `collection` (`Collection_Code`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`Nickname`) REFERENCES `members` (`Nickname`),
  ADD CONSTRAINT `borrowings_ibfk_3` FOREIGN KEY (`Reservation_Code`) REFERENCES `reservation` (`Reservation_Code`);

--
-- Contraintes pour la table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`Type_Code`) REFERENCES `types` (`Type_Code`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Collection_Code`) REFERENCES `collection` (`Collection_Code`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Nickname`) REFERENCES `members` (`Nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
