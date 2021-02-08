-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 08 2021 г., 21:03
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
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(2, 1),
(3, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `img_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `active`, `img_path`) VALUES
(6, 'Opel', 'black', 660, 1, '2323'),
(7, 'dege', 'debe', 3435, 0, ''),
(8, 'Opel', 'black', 5000, 1, ''),
(9, 'Opel', 'black', 5000, 1, 'C:fakepath\rGtRyurpYLk.jpg'),
(10, 'Opel', 'black', 66000, 1, 'this.querySelector(\"input[name=img_path]\").value'),
(11, 'Opel', 'black', 5000, 1, 'Array'),
(12, 'egfw', 'black', 5000, 1, 'src/img/'),
(13, 'Opel', 'black', 5000, 1, 'src/img/'),
(14, 'Mercedes', 'bvgwg', 4000, 1, '/src/img/'),
(15, 'Opel', 'black', 5000, 1, '/src/img/'),
(16, 'Opel', 'black', 66000, 1, '/src/img/'),
(17, 'Opel', 'black', 5000, 1, '/src/img/'),
(18, 'Opel', 'black', 5000, 1, 'W:/domains/back-end/Eshop/src/img/35b9859e28f06397740da494f0aa26f8.jpg'),
(19, 'Opel', 'black', 5000, 1, 'W:/domains/back-end/Eshop/src/img/6c5598630708b4157a9878b35da1a4e9.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `products_in_cart`
--

CREATE TABLE `products_in_cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_in_cart`
--

INSERT INTO `products_in_cart` (`id`, `product_id`, `quantity`, `cart_id`) VALUES
(1, 7, 12, 1),
(2, 10, 5, 1),
(3, 19, 8, 1),
(4, 6, 2, 2),
(5, 14, 3, 3),
(6, 12, 3, 1),
(7, 17, 5, 2),
(8, 7, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products_quantity`
--

CREATE TABLE `products_quantity` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_quantity`
--

INSERT INTO `products_quantity` (`id`, `store_id`, `product_id`, `quantity`) VALUES
(1, 1, 6, 12),
(2, 2, 7, 16),
(3, 2, 9, 0),
(4, 1, 9, 5),
(5, 1, 9, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id`, `name`, `address`, `city`) VALUES
(1, 'Автодилер', 'Ленина 1', 'Тула'),
(2, 'Продажи авто', 'Ленина 16', 'Москва');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `phone`) VALUES
(1, 'Олег', 45636436),
(2, 'Евгения', 474757457),
(3, 'Николай', 4578484);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products_in_cart`
--
ALTER TABLE `products_in_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products_quantity`
--
ALTER TABLE `products_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `products_in_cart`
--
ALTER TABLE `products_in_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products_quantity`
--
ALTER TABLE `products_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `products_in_cart`
--
ALTER TABLE `products_in_cart`
  ADD CONSTRAINT `products_in_cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `products_in_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
