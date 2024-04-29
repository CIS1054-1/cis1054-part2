-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Apr 29, 2024 alle 13:01
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cis1054-part2`
--
CREATE DATABASE IF NOT EXISTS `cis1054-part2` DEFAULT CHARACTER SET latin2 COLLATE latin2_bin;
USE `cis1054-part2`;

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE `foods` (
  `ID` int(11) NOT NULL,
  `categories_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `ingradients` text NOT NULL,
  `image` text NOT NULL,
  `price` double NOT NULL,
  `allergies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`allergies`)),
  `time_of_preparation` int(11) NOT NULL,
  `bio` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `ID` int(11) NOT NULL,
  `users_ID` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `book_duration` double NOT NULL DEFAULT 1.5
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` set('user','moderator','admin','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `ID` int(11) NOT NULL,
  `users_ID` int(11) NOT NULL,
  `foods_ID` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_bin;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `foods`
--
ALTER TABLE `foods`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
