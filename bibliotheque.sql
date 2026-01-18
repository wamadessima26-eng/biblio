-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 18 jan. 2026 à 11:17
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `lecteurs`
--

CREATE TABLE `lecteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lecteurs`
--

INSERT INTO `lecteurs` (`id`, `nom`, `prenom`, `email`) VALUES
(1, 'Dupont', 'Jean', 'jean@test.com'),
(2, 'Koffi', 'Abla', 'abla.koffi@email.tg'),
(3, 'Traoré', 'Moussa', 'moussa.traore@email.fr'),
(4, 'Diallo', 'Mariam', 'mariam.diallo@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `liste_lecture`
--

CREATE TABLE `liste_lecture` (
  `id_livre` int(11) DEFAULT NULL,
  `id_lecteur` int(11) DEFAULT NULL,
  `date_emprun` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liste_lecture`
--

INSERT INTO `liste_lecture` (`id_livre`, `id_lecteur`, `date_emprun`, `date_retour`) VALUES
(1, 1, '2026-01-15', '2026-02-15'),
(3, 1, '2026-01-15', NULL),
(2, 1, '2026-01-17', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `maison_edition` varchar(100) DEFAULT NULL,
  `nombre_exemplair` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'default.jpg',
  `categorie` varchar(50) DEFAULT 'Général'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`, `description`, `maison_edition`, `nombre_exemplair`, `image`, `categorie`) VALUES
(1, 'L\'Étranger', 'Albert Camus', 'Un homme indifférent au monde commet un meurtre sans raison apparente.', 'Gallimard', 5, 'etranger.jpg', 'Général'),
(2, 'Une si longue lettre', 'Mariama Bâ', 'Un roman épistolaire majeur sur la condition féminine au Sénégal.', 'NEA', 3, 'lettrelongue.jpg', 'Général'),
(3, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'Un conte philosophique sur l\'amitié, l\'amour et la nature humaine.', 'Reynal & Hitchcock', 10, 'petitprince.jpg', 'Général'),
(4, 'L\'Enfant Noir', 'Camara Laye', 'Récit autobiographique sur l\'enfance de l\'auteur en Guinée.', 'Plon', 4, 'noir.jpg', 'Général'),
(6, 'Sous l\'orage', 'Seydou Badian', 'Un conflit de générations dans l\'Afrique coloniale.', 'Présence Africaine', 6, 'téléchargement.jpg', 'Général'),
(8, 'La magie de voir grand', 'David J. Schwartz', 'La magie de voir grand est un livre de développement personnel qui apprend à voir plus grand pour réussir plus grand', 'Monde diffèrent', 50, 'voir grand.jpg', 'Developpement Personel'),
(9, 'L\'Alchimiste', 'Paulo Coelho', 'Pour la quête de soi et la poursuite de ses rêves.\r\n  ', 'Anne carrière', 2, 'default.jpg', 'Developpement Personnel'),
(10, 'Père Riche, père pauvre', 'Robert Kiyosaki', 'Les bases de l\'éducation financière', 'Un Monde différent', 1, 'default.jpg', 'Entreprenariat & Finance'),
(11, 'la 25ème Heure', 'Guillaume Declair ', 'Maitriser sa productivité et son temps', 'Le livre de Poche', 5, 'default.jpg', 'Entreprenariat & Finance');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste_lecture`
--
ALTER TABLE `liste_lecture`
  ADD KEY `id_livre` (`id_livre`),
  ADD KEY `id_lecteur` (`id_lecteur`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `liste_lecture`
--
ALTER TABLE `liste_lecture`
  ADD CONSTRAINT `liste_lecture_ibfk_1` FOREIGN KEY (`id_livre`) REFERENCES `livres` (`id`),
  ADD CONSTRAINT `liste_lecture_ibfk_2` FOREIGN KEY (`id_lecteur`) REFERENCES `lecteurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
