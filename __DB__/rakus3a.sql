-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: endora-db-11.stable.cz:3306
-- Čas generovania: Ne 26.Máj 2024, 10:52
-- Verzia serveru: 10.3.35-MariaDB
-- Verzia PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `rakus3a`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `typ_peciva` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `kategoria`
--

INSERT INTO `kategoria` (`id`, `typ_peciva`) VALUES
(1, 'Sladké'),
(2, 'Slané');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pecivo`
--

CREATE TABLE `pecivo` (
  `id` int(11) NOT NULL,
  `pecivo` varchar(50) NOT NULL,
  `datum_vyroby` date NOT NULL,
  `datum_spotreby` date NOT NULL,
  `predajca` varchar(50) NOT NULL,
  `cena` float NOT NULL,
  `fotka` varchar(300) NOT NULL,
  `gramaz` int(25) DEFAULT NULL,
  `typ` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `pecivo`
--

INSERT INTO `pecivo` (`id`, `pecivo`, `datum_vyroby`, `datum_spotreby`, `predajca`, `cena`, `fotka`, `gramaz`, `typ`) VALUES
(1, 'Rohlík', '2024-05-20', '2024-05-23', 'Tesco', 0.15, 'obrazky/Rohlik.jpg', 20, 2),
(2, 'Makovka', '2024-05-22', '2024-05-23', 'Billa', 0.55, 'obrazky/makovka.jpg', 55, 1),
(3, 'Kaizerka', '2024-05-18', '2024-05-22', 'Lidl', 0.18, 'obrazky/kaizerka.jpg', 36, 2),
(4, 'Chlieb ražný', '2024-05-26', '2024-06-02', 'Kaufland', 1.49, 'obrazky/Chlieb_razny.jpg', 300, 2),
(5, 'Chlieb domáci', '2024-07-11', '2024-07-19', 'Billa', 2.99, 'obrazky/Chlieb_domaci.jpg', 450, 2),
(6, 'Chlieb bezlepkový', '2024-05-30', '2024-06-04', 'Lidl', 2.5, 'obrazky/chlieb_bezlepkovy.jpg', 250, 2),
(7, 'Donut jahodový', '2024-04-09', '2024-04-09', 'Tesco', 0.79, 'obrazky/donut_jahodovy.jpg', 38, 1),
(8, 'Donut farebný', '2024-05-30', '2024-05-31', 'Tesco', 0.89, 'obrazky/donut_farebny.jpg', 40, 1),
(9, 'Donut čokoládový', '2024-11-01', '2024-11-03', 'Kaufland', 0.69, 'obrazky/donut_cokoladovy.jpg', 39, 1),
(10, 'Cesnaková bageta', '2024-09-09', '2024-09-14', 'Lidl', 1.29, 'obrazky/cesnakova_bageta.jpg', 180, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `email`) VALUES
(1, 'username', '$2y$10$NRZz2qPQq.pay/gkX9OuKeC9ipeYLdV29h.zSFwuWKZb.pzRVFEoS', 'mail@mail'),
(2, 'ds', '$2y$10$4XI1zBM6cDo/dTqPdXUnUeT9JdWRl8VR32bC3eExTPkAJl8m3rQVm', 'otomihalik100@gmail.com');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pecivo`
--
ALTER TABLE `pecivo`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pre tabuľku `pecivo`
--
ALTER TABLE `pecivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pre tabuľku `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
