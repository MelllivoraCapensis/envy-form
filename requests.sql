-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 19 2019 г., 11:41
-- Версия сервера: 5.6.43
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `envy_form`
--

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `name`, `phone`, `message`) VALUES
(49, 'bob', '+7-234-434-12-23', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. '),
(50, 'gleb', '+7-234-434-12-24', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore deleniti adipisci architecto dicta, fugit sapiente vero dolorem maiores quas, quidem'),
(52, 'dima', '+7-234-434-12-24', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore deleniti adipisci architecto dicta, fugit sapiente vero dolorem maiores quas, quidem'),
(53, 'petr', '+7-234-434-52-23', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore deleniti adipisci architecto dicta, fugit sapiente vero dolorem maiores quas, quidem'),
(54, 'fillip', '+7-134-434-12-24', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore deleniti adipisci architecto dicta, fugit sapiente vero dolorem maiores quas, quidem');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
