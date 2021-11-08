-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 fév. 2021 à 11:32
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `doctolib`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date_appointment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour_appointment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`id`, `date_appointment`, `hour_appointment`, `patient_id`, `doctor_id`) VALUES
(2, '23/01/2021', '12h00', 1, 2),
(3, '23/01/2021', '12h00', 1, 3),
(4, '23/01/2021', '12h00', 1, 4),
(5, '23/01/2021', '12h00', 2, 1),
(6, '23/01/2021', '12h00', 2, 2),
(7, '23/01/2021', '12h00', 2, 3),
(8, '23/01/2021', '12h00', 2, 4),
(9, '23/01/2021', '12h00', 3, 1),
(10, '23/01/2021', '12h00', 3, 2),
(11, '23/01/2021', '12h00', 3, 3),
(12, '23/01/2021', '12h00', 3, 4),
(13, '23/01/2021', '12h00', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_num` int(11) NOT NULL,
  `address_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code_address` int(11) NOT NULL,
  `town_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `doctor`
--

INSERT INTO `doctor` (`id`, `email`, `password`, `last_name`, `first_name`, `specialty`, `address_num`, `address_street`, `postal_code_address`, `town_address`, `profil`) VALUES
(1, 'doctor1@doctor.com', 'doctor1', 'doctor1lastname', 'doctor1firstname', 'kine', 1, 'rue test', 5900, 'test', 'medecin'),
(2, 'doctor2@doctor.com', 'doctor2', 'doctor2lastname', 'doctor1firstname', 'dentiste', 1, 'rue test', 5900, 'test', 'medecin'),
(3, 'doctor3@doctor.com', 'doctor3', 'doctor3lastname', 'doctor1firstname', 'généraliste', 1, 'rue test', 5900, 'test', 'medecin'),
(4, 'doctor4@doctor.com', 'doctor4', 'doctor4lastname', 'doctor4firstname', 'kine', 1, 'rue test', 5900, 'test', 'medecin'),
(5, 'doctor5@doctor.com', 'doctor5', 'doctor5lastname', 'doctor5firstname', 'orl', 1, 'rue test', 59000, 'test', 'medecin'),
(6, 'doctor6@doctor.com', 'doctor6', 'doctor6lastname', 'doctor6firstname', 'orl', 1, 'rue test', 59000, 'test', 'medecin');

-- --------------------------------------------------------

--
-- Structure de la table `doctor_patient`
--

CREATE TABLE `doctor_patient` (
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201216125742', '2021-02-01 15:23:01', 681),
('DoctrineMigrations\\Version20201217072656', '2021-02-01 15:23:02', 5312),
('DoctrineMigrations\\Version20210201143201', '2021-02-01 15:32:10', 1519),
('DoctrineMigrations\\Version20210204140226', '2021-02-04 15:02:57', 1634);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_num` int(11) NOT NULL,
  `address_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code_address` int(11) NOT NULL,
  `town_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `email`, `password`, `last_name`, `first_name`, `birth_date`, `address_num`, `address_street`, `postal_code_address`, `town_address`, `profil`) VALUES
(1, 'patient1@patient.com', 'patient1', 'patient1lastname', 'patient1fistname', '16/09/1992', 1, 'rue test', 59000, 'test', 'patient'),
(2, 'patient2@patient.com', 'patient2', 'patient2lastname', 'patient2fistname', '16/09/1992', 1, 'rue test', 59000, 'test', 'patient'),
(3, 'patient3@patient.com', 'patient3', 'patient3lastname', 'patient3fistname', '16/09/1992', 1, 'rue test', 59000, 'test', 'patient'),
(4, 'patient4@patient.com', 'patient4', 'patient4lastname', 'patient4fistname', '16/09/1992', 1, 'rue test', 59000, 'test', 'patient'),
(5, 'patient5@patient.com', 'patient5', 'patient5lastname', 'patient1firstname', '16/09/1992', 1, 'rue test', 59000, 'test', 'patient'),
(7, 'patient5@patient.com', 'patient5', 'patient5lastname', 'patient1firstname', '16/09/1992', 1, 'rue test', 59000, 'test', 'patient');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE38F8446B899279` (`patient_id`),
  ADD KEY `IDX_FE38F84487F4FB17` (`doctor_id`);

--
-- Index pour la table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctor_patient`
--
ALTER TABLE `doctor_patient`
  ADD PRIMARY KEY (`doctor_id`,`patient_id`),
  ADD KEY `IDX_8977B44687F4FB17` (`doctor_id`),
  ADD KEY `IDX_8977B4466B899279` (`patient_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK_FE38F8446B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `FK_FE38F84487F4FB17` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`);

--
-- Contraintes pour la table `doctor_patient`
--
ALTER TABLE `doctor_patient`
  ADD CONSTRAINT `FK_8977B4466B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8977B44687F4FB17` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
