-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 21 2024 г., 08:19
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
-- Структура таблицы `lots`
--

CREATE TABLE `lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(512) NOT NULL,
  `content` text NOT NULL,
  `initial_price` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `debtor_inn` varchar(12) NOT NULL,
  `case_number` varchar(32) NOT NULL,
  `start_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`id`, `url`, `content`, `initial_price`, `email`, `phone`, `debtor_inn`, `case_number`, `start_date`) VALUES
(57, 'https://nistp.ru/bankrot/trade_view.php?trade_nid=355845', 'Автомобиль требует капитального ремонта ходовой и кузовной части. Нуждается в замене двигателя внутреннего сгорания. Является совместно нажитым имуществом.', '150000.00', 'sablinada@mail.ru', '89231702128', '421503704802', 'А27-14381/2023', '2024-04-03 08:00:00'),
(58, 'https://nistp.ru/bankrot/trade_view.php?trade_nid=355630', 'Гараж, площадью 21 кв.м., расположенный по адресу: Свердловская обл., городской округ «Город Лесной», Лесной г., Гаражный массив 1, бокс №2, гараж №9, с кадастровым номером: 66:54:0116004:731', '58500.00', 'torgi@kurilin.ru', '+79226322840', '663001479410', 'А60-43197/2023', '2024-03-29 10:00:00'),
(59, 'https://nistp.ru/bankrot/trade_view.php?trade_nid=355583', 'Права и обязанности по договору долгосрочной аренды земельного участка площадью 50 000 кв. м., кадастровый номер № 50:08:0010107:12, по адресу: обл. Московская, р-н Истринский, г. Истра, ул. Урицкого, дом 114 (примерно в 1020 м, по направлению на северо-запад от ориентира), заключенному 01.08.2019 с Администрацией Истринского муниципального района Московской области на сроком на 49 лет (действие договора до 19.07.2062). Категория земель: земли населенных пунктов. Вид разрешенного использования: под производственные цели.', '106934608.80', 'a.a.boravchenkov@mail.ru', '+79112185558', '5044047125', 'А41-66241/2020', '2024-02-26 10:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lots`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
