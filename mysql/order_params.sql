-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2021 г., 21:14
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ecom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order_params`
--

CREATE TABLE `order_params` (
  `id` int(11) NOT NULL,
  `name` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_params`
--

INSERT INTO `order_params` (`id`, `name`, `surname`, `address`, `user_id`, `cart_id`) VALUES
(1, 'egye', 'gheh', 'eheh', 3, 0),
(2, 'rhr', 'ehe', 'eghe', 1, 0),
(3, 'fgh', 'hhh', 'hhh', 1, 0),
(4, 'ewew', 'www', 'eee', 1, 0),
(5, 'wwe', 'tyty', 'qqqq', 1, 0),
(6, 'Олег', 'В', 'Тула', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `order_params`
--
ALTER TABLE `order_params`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `order_params`
--
ALTER TABLE `order_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
