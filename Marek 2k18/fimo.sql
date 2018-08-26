-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Čtv 23. srp 2018, 08:58
-- Verze serveru: 5.7.21
-- Verze PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `fimo`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `nausnice`
--

DROP TABLE IF EXISTS `nausnice`;
CREATE TABLE IF NOT EXISTS `nausnice` (
  `id` int(11) NOT NULL,
  `nazev` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `velikost` varchar(3) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `barvajedna` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `barvadva` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `cena` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `nausnice`
--

INSERT INTO `nausnice` (`id`, `nazev`, `velikost`, `barvajedna`, `barvadva`, `cena`) VALUES
(1, 'naus1', 'm', 'fialova', 'ruzova', 85),
(2, 'naus2', 'm', 'modra', 'bila', 85),
(3, 'naus3', 'S', 'zelena', 'bila', 80),
(4, 'naus4', 'm', 'cervena', 'zluta', 85),
(5, 'naus5', 'm', 'cervena', 'hneda', 85),
(6, 'naus6', 'm', 'cervena', 'fialova', 85),
(7, 'naus7', 'm', 'hneda', 'zlata', 85),
(8, 'naus8', 'm', 'zlata', 'fialova', 85),
(9, 'naus9', 'm', 'cervena', 'fialova', 85),
(10, 'naus10', 'm', 'stribrna', 'seda', 85),
(11, 'naus11', 'm', 'hneda', 'modra', 85),
(12, 'naus12', 'm', 'modra', 'fialova', 85),
(13, 'naus13', 'm', 'cervena', 'fialova', 85),
(14, 'naus14', 'm', 'fialova', 'hneda', 85),
(15, 'naus15', 'm', 'modra', 'bila', 85),
(16, 'naus16', 'm', 'cervena,modra', 'zluta, hneda', 85),
(17, 'naus17', 'm', 'cerna', 'bila', 85),
(18, 'naus18', 'm', 'zelena', 'zelena', 85),
(19, 'naus19', 'm', 'hneda', 'bila', 85),
(20, 'naus20', 'm', 'cerna', 'fialova', 85);

-- --------------------------------------------------------

--
-- Struktura tabulky `retizky`
--

DROP TABLE IF EXISTS `retizky`;
CREATE TABLE IF NOT EXISTS `retizky` (
  `id` int(11) NOT NULL,
  `nazev` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `velikost` varchar(2) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `barvajedna` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `barvadva` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `cena` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `retizky`
--

INSERT INTO `retizky` (`id`, `nazev`, `velikost`, `barvajedna`, `barvadva`, `cena`) VALUES
(1, 'retizky1', 'm', 'hneda', 'bila', 100),
(2, 'retizky2', 'm', 'cerna', 'bila', 100),
(3, 'retizky3', 'm', 'fialova', 'zluta', 90),
(4, 'retizky4', 'm', 'fialova', 'oranzova', 110),
(5, 'retizky5', 'm', 'modra', 'bila', 90),
(6, 'retizky6', 'm', 'modra', 'bila', 90),
(7, 'retizky7', 'm', 'cerna', 'modra', 80),
(8, 'retizky8', 'm', 'modra', 'cerna', 120),
(9, 'retizky9', 'm', 'hneda', 'bila', 90),
(10, 'retizky10', 'm', 'cerna', 'hneda', 110),
(11, 'retizky11', 'm', 'oranzova', 'zluta', 90),
(12, 'retizky12', 'm', 'hneda', 'ruzova', 110),
(13, 'retizky13', 'm', 'cerna', 'bila', 110),
(14, 'retizky14', 'm', 'modra', 'cerna', 120),
(15, 'retizky15', 'm', 'modra', 'cerna', 120),
(16, 'retizky16', 'm', 'hneda', 'fialova', 110),
(17, 'retizky17', 'm', 'ruzova', 'bila', 110),
(18, 'retizky18', 'm', 'stribrna', 'seda', 100),
(19, 'retizky19', 'm', 'zlata', 'ruzova', 100),
(20, 'retizky20', 'm', 'cervena', 'ruzova', 100);

-- --------------------------------------------------------

--
-- Struktura tabulky `soupravy`
--

DROP TABLE IF EXISTS `soupravy`;
CREATE TABLE IF NOT EXISTS `soupravy` (
  `id` int(11) NOT NULL,
  `nazev` text COLLATE utf8_czech_ci NOT NULL,
  `velikost` varchar(3) COLLATE utf8_czech_ci NOT NULL,
  `barvajedna` text COLLATE utf8_czech_ci NOT NULL,
  `barvadva` text COLLATE utf8_czech_ci NOT NULL,
  `cena` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `soupravy`
--

INSERT INTO `soupravy` (`id`, `nazev`, `velikost`, `barvajedna`, `barvadva`, `cena`) VALUES
(1, 'soupravy1', 'm', 'hneda', 'bila', 150),
(2, 'soupravy2', 'm', 'cerna', 'bila', 160),
(3, 'soupravy3', 'm', 'zluta', 'fialova', 170),
(4, 'soupravy4', 'm', 'fialova', 'zlata', 170),
(5, 'soupravy5', 'm', 'hneda', 'bila', 160),
(6, 'soupravy6', 'm', 'cerna', 'zlata', 180),
(7, 'soupravy7', 'm', 'hneda', 'bila', 160),
(8, 'soupravy8', 'm', 'bila', 'bila', 180),
(9, 'soupravy9', 'm', 'cervena', 'zluta', 190),
(10, 'soupravy10', 'm', 'hneda', 'ruzova', 180),
(11, 'soupravy11', 'm', 'cervena', 'fialova', 200),
(12, 'soupravy12', 'm', 'bila', 'cerna', 170),
(13, 'soupravy13', 'm', 'fialova', 'zlata', 180),
(14, 'soupravy14', 'm', 'oranzova', 'fialova', 180),
(15, 'soupravy15', 'm', 'oranzova', 'fialova', 180);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
