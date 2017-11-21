-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 22 2017 г., 01:45
-- Версия сервера: 5.5.48
-- Версия PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `news`
--
CREATE DATABASE IF NOT EXISTS `news` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `news`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `verified_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `verified_admin`) VALUES
(1, 'category1', 0),
(2, 'category2', 0),
(3, 'category3', 1),
(5, 'category5', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `login_autor` varchar(15) NOT NULL,
  `data_create` datetime NOT NULL,
  `text` varchar(500) NOT NULL,
  `verified_admin` tinyint(1) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_news`, `login_autor`, `data_create`, `text`, `verified_admin`, `rating`) VALUES
(19, 4, 'log6', '2017-10-31 23:03:29', 'Cat is walking,', 0, 0),
(20, 5, 'log7', '2017-10-31 23:03:29', 'Cat is walking,', 0, 0),
(21, 6, 'log1', '2017-10-31 23:03:29', 'Cat is walking,', 1, 0),
(22, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(23, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(24, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(25, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(26, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(27, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(28, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(29, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(30, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(31, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(32, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(33, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(34, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(35, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(36, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(37, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(38, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(39, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(40, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(41, 45, 'log7', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(42, 45, 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `login_autor` varchar(15) NOT NULL,
  `data_create` datetime NOT NULL,
  `text` varchar(500) NOT NULL,
  `verified_admin` tinyint(1) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `login_autor`, `data_create`, `text`, `verified_admin`, `rating`) VALUES
(4, 'ПриветПривет', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(5, 'Катюша', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(6, 'Катюша2', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(7, 'Sat is walking,', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(15, 'WWSat is walkin', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(39, 'Катюша4', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(43, 'Катюша5', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(45, 'Уникальная 66', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(53, 'Катюша6666', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(54, 'Катюша9999', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0),
(55, 'Катюша888887', 'log6', '2017-10-31 22:55:36', 'Cat is walking,', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relationships`
--

INSERT INTO `relationships` (`id`, `id_news`, `id_category`) VALUES
(1, 4, 1),
(2, 5, 2),
(3, 6, 3),
(4, 45, 5),
(5, 45, 5),
(6, 45, 5),
(7, 45, 5),
(8, 45, 5),
(9, 45, 5),
(10, 45, 5),
(11, 45, 5),
(12, 45, 5),
(13, 45, 5),
(14, 45, 5),
(15, 45, 5),
(16, 45, 5),
(17, 45, 5),
(18, 45, 5),
(19, 45, 5),
(20, 45, 5),
(21, 45, 5),
(22, 45, 5),
(23, 45, 5),
(24, 45, 5),
(25, 45, 5),
(26, 45, 5),
(27, 45, 5),
(28, 55, 5),
(29, 55, 5),
(30, 55, 5),
(31, 55, 5),
(32, 55, 5),
(33, 55, 5),
(34, 55, 5),
(35, 55, 5),
(36, 55, 5),
(37, 55, 3),
(38, 55, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `login` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `user_password` varchar(15) NOT NULL,
  `data_checkin` datetime NOT NULL,
  `admin_rights` tinyint(1) NOT NULL DEFAULT '0',
  `data_assumption` datetime DEFAULT NULL,
  `locking` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`login`, `email`, `user_password`, `data_checkin`, `admin_rights`, `data_assumption`, `locking`) VALUES
('log1', 'log1@ya.ru', 'log1', '2017-10-31 22:41:04', 0, NULL, 0),
('log2', 'log2@ya.ru', 'log1', '2017-10-31 22:41:41', 0, NULL, 1),
('log6', 'log6@ya.ru', 'log6', '2017-10-31 22:50:21', 1, '2017-10-31 22:50:21', 0),
('log7', 'log7@ya.ru', 'log7', '2017-10-31 22:50:21', 1, '2017-10-31 22:50:21', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_autor` (`login_autor`),
  ADD KEY `id_news` (`id_news`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `login_autor` (`login_autor`);

--
-- Индексы таблицы `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_news` (`id_news`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT для таблицы `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`login_autor`) REFERENCES `users` (`login`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`);

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`login_autor`) REFERENCES `users` (`login`);

--
-- Ограничения внешнего ключа таблицы `relationships`
--
ALTER TABLE `relationships`
  ADD CONSTRAINT `relationships_ibfk_1` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `relationships_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
