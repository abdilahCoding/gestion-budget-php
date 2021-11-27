-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 08:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pfe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `passwords`, `role`) VALUES
(24, 'salma', 'salma', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id_budget` int(11) NOT NULL,
  `Budget` float NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_Commande` int(11) NOT NULL,
  `Num_Commande` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Prix_Unitaire` float NOT NULL,
  `Quantité` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Date` date NOT NULL,
  `Fournisseur` varchar(255) NOT NULL,
  `Rest_Payer` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_Commande`, `Num_Commande`, `Description`, `Prix_Unitaire`, `Quantité`, `Total`, `Date`, `Fournisseur`, `Rest_Payer`) VALUES
(47, 'ddd', 'hhgg', 5, 22, 600, '2021-05-22', 'bata', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deplacement`
--

CREATE TABLE `deplacement` (
  `id_dep` int(11) NOT NULL,
  `id_ens` int(11) NOT NULL,
  `frais_transport` float NOT NULL,
  `decoucher` float NOT NULL,
  `repas_midi` float NOT NULL,
  `repas_soir` float NOT NULL,
  `route_kms` float NOT NULL,
  `total_depl` float NOT NULL,
  `Date` date NOT NULL,
  `Rest_Payer` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deplacement`
--

INSERT INTO `deplacement` (`id_dep`, `id_ens`, `frais_transport`, `decoucher`, `repas_midi`, `repas_soir`, `route_kms`, `total_depl`, `Date`, `Rest_Payer`) VALUES
(9, 11, 22, 333, 2, 222, 333, 222, '2021-05-20', 0),
(13, 11, 777, 77, 666, 777, 6667, 1000, '2021-05-20', 0),
(14, 11, 77, 666, 7777, 777, 777, 1000, '2021-05-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_Ens` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(60) NOT NULL,
  `Grade` varchar(30) NOT NULL,
  `Echelle` varchar(255) NOT NULL,
  `Puissance` varchar(255) NOT NULL,
  `Marque` varchar(255) NOT NULL,
  `Residence` varchar(255) NOT NULL,
  `Groupe` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_Ens`, `Nom`, `Prenom`, `Grade`, `Echelle`, `Puissance`, `Marque`, `Residence`, `Groupe`, `Date`) VALUES
(11, 'salma', 'salma', 'DD', '3FF', 'dd', 'dd', 'SSD', 2, '2021-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id_operation` int(11) NOT NULL,
  `Deplacement` float NOT NULL,
  `Commandes` float NOT NULL,
  `budget` float NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id_operation`, `Deplacement`, `Commandes`, `budget`, `Date`) VALUES
(39, 1000, 0, 1000, '2021-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `paiment de vente`
--

CREATE TABLE `paiment de vente` (
  `idPv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rubrique`
--

CREATE TABLE `rubrique` (
  `id_rubrique` int(11) NOT NULL,
  `Num` varchar(30) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `tarifFix` float NOT NULL,
  `budget` float NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rubrique`
--

INSERT INTO `rubrique` (`id_rubrique`, `Num`, `Description`, `tarifFix`, `budget`, `Date`) VALUES
(182, '907', 'Enseignement Supperieur', 2000, 2000, '2021-05-20'),
(183, '908', 'Recherche Scientifique et Technologique', 2000, 2000, '2021-05-20'),
(184, '909', 'Appui sociale aux étudiants', 2000, 2000, '2021-05-20'),
(185, '911', 'Formation continue et Traveaux de recherche et prestation de service', 2000, 2000, '2021-05-20'),
(186, '920', 'Pilotage et Gouverance', 2000, 2000, '2021-05-20'),
(187, '907', 'Enseignement Supperieur', 1000, 1000, '2022-05-10'),
(188, '908', 'Recherche Scientifique et Technologique', 1000, 1000, '2022-05-10'),
(189, '909', 'Appui sociale aux étudiants', 1000, 1000, '2022-05-10'),
(190, '911', 'Formation continue et Traveaux de recherche et prestation de service', 1000, 1000, '2022-05-10'),
(191, '920', 'Pilotage et Gouverance', 1000, 1000, '2022-05-10'),
(192, '907', 'Enseignement Supperieur', 1000, 1000, '2021-05-20'),
(193, '908', 'Recherche Scientifique et Technologique', 1000, 1000, '2021-05-20'),
(194, '909', 'Appui sociale aux étudiants', 1000, 1000, '2021-05-20'),
(195, '911', 'Formation continue et Traveaux de recherche et prestation de service', 1000, 1000, '2021-05-20'),
(196, '920', 'Pilotage et Gouverance', 1000, 1000, '2021-05-20'),
(197, '907', 'Enseignement Supperieur', 1000, 1000, '2021-05-20'),
(198, '908', 'Recherche Scientifique et Technologique', 1000, 1000, '2021-05-20'),
(199, '909', 'Appui sociale aux étudiants', 1000, 1000, '2021-05-20'),
(200, '911', 'Formation continue et Traveaux de recherche et prestation de service', 1000, 1000, '2021-05-20'),
(201, '920', 'Pilotage et Gouverance', 1000, 1000, '2021-05-20'),
(202, '907', 'Enseignement Supperieur', 1000, 1000, '2021-05-20'),
(203, '908', 'Recherche Scientifique et Technologique', 1000, 1000, '2021-05-20'),
(204, '909', 'Appui sociale aux étudiants', 1000, 1000, '2021-05-20'),
(205, '911', 'Formation continue et Traveaux de recherche et prestation de service', 1000, 1000, '2021-05-20'),
(206, '920', 'Pilotage et Gouverance', 1000, 1000, '2021-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `société`
--

CREATE TABLE `société` (
  `Ids` int(10) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Ville` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `société`
--

INSERT INTO `société` (`Ids`, `Nom`, `Ville`, `Email`) VALUES
(6, 'bata', 'safi', 'abdilah@gmail.com'),
(7, 'go', 'safi', 'abdilah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sous rubrique`
--

CREATE TABLE `sous rubrique` (
  `NumSr` int(14) NOT NULL,
  `Description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sous sous rubrique`
--

CREATE TABLE `sous sous rubrique` (
  `NumSSR` int(14) NOT NULL,
  `Code` int(11) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id_budget`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_Commande`);

--
-- Indexes for table `deplacement`
--
ALTER TABLE `deplacement`
  ADD PRIMARY KEY (`id_dep`),
  ADD KEY `fk_ens` (`id_ens`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_Ens`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id_operation`);

--
-- Indexes for table `paiment de vente`
--
ALTER TABLE `paiment de vente`
  ADD PRIMARY KEY (`idPv`);

--
-- Indexes for table `rubrique`
--
ALTER TABLE `rubrique`
  ADD PRIMARY KEY (`id_rubrique`);

--
-- Indexes for table `société`
--
ALTER TABLE `société`
  ADD PRIMARY KEY (`Ids`);

--
-- Indexes for table `sous rubrique`
--
ALTER TABLE `sous rubrique`
  ADD PRIMARY KEY (`NumSr`);

--
-- Indexes for table `sous sous rubrique`
--
ALTER TABLE `sous sous rubrique`
  ADD PRIMARY KEY (`NumSSR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_Commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `deplacement`
--
ALTER TABLE `deplacement`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_Ens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id_operation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `paiment de vente`
--
ALTER TABLE `paiment de vente`
  MODIFY `idPv` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubrique`
--
ALTER TABLE `rubrique`
  MODIFY `id_rubrique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `société`
--
ALTER TABLE `société`
  MODIFY `Ids` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sous rubrique`
--
ALTER TABLE `sous rubrique`
  MODIFY `NumSr` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sous sous rubrique`
--
ALTER TABLE `sous sous rubrique`
  MODIFY `NumSSR` int(14) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deplacement`
--
ALTER TABLE `deplacement`
  ADD CONSTRAINT `fk_ens` FOREIGN KEY (`id_ens`) REFERENCES `enseignant` (`id_Ens`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
