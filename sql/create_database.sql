-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/

START TRANSACTION;

--
-- Struktura tabeli dla tabeli `convert`
--

CREATE TABLE IF NOT EXISTS `convert` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `id` int(11) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `code` char(3) NOT NULL,
  `mid` decimal(8,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `convert`
--
ALTER TABLE `convert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `convert_from_rate` (`from`),
  ADD KEY `convert_to_rate` (`to`) USING BTREE;

--
-- Indeksy dla tabeli `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `convert`
--
ALTER TABLE `convert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `convert`
--
ALTER TABLE `convert`
  ADD CONSTRAINT `convert_from_rate` FOREIGN KEY (`from`) REFERENCES `rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `convert_to_rate` FOREIGN KEY (`to`) REFERENCES `rate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
