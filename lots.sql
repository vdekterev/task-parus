-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 22 2024 г., 07:58
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task-parus`
--

-- --------------------------------------------------------

--
-- Структура таблицы `trades`
--

CREATE TABLE `lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(512) NOT NULL,
  `lot_number` smallint(5) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `initial_price` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `debtor_inn` varchar(12) NOT NULL,
  `case_number` varchar(32) NOT NULL,
  `start_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `trades`
--

INSERT INTO `lots` (`id`, `url`, `lot_number`, `content`, `initial_price`, `email`, `phone`, `debtor_inn`, `case_number`, `start_date`) VALUES
(77, 'https://nistp.ru/bankrot/trade_view.php?trade_nid=355520', 1, 'Жилое помещение (квартира), кадастровый номер: 54:35:071135:556, Новосибирская область, r. Новосибирск, ул. Бориса Боrаткова, д. 194/5, кв. 152, 31,5 кв. м.', '5100000.00', 'samsonov.arbitr@gmail.com', '89031091167', '540543385578', '№А40-2493/23-157-4 «Ф»', '2024-04-02 12:00:00'),
(78, 'https://nistp.ru/bankrot/trade_view.php?trade_nid=355541', 1, 'Транспортное средство Lada Granta, идентификационный номер (VIN): XTA219170M0423727.', '682875.00', 'finarbitrzolotavina@gmail.com', '89220418539', '860303935123', 'А75-10650/2023', '2024-04-03 10:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `trades`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lots_nc_idx` (`lot_number`,`case_number`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `trades`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
