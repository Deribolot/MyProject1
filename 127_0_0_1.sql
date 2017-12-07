-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 06 2017 г., 20:51
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `verified_admin`) VALUES
(23, 'Погода', 1),
(24, 'Люди', 1),
(25, 'Транспорт', 1),
(26, 'ЧП', 1),
(27, 'События', 1),
(28, 'Врачи', 0),
(29, 'Важное', 1),
(30, 'Рецепты', 0),
(31, 'Гороскоп', 0),
(32, 'Праздники', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `login_autor` varchar(15) NOT NULL,
  `data_create` datetime NOT NULL,
  `text` varchar(700) NOT NULL,
  `verified_admin` tinyint(1) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `login_autor`, `data_create`, `text`, `verified_admin`, `rating`) VALUES
(83, 'Гороскоп на сегодня ', 'Oleg', '2012-04-17 02:47:35', '16-17 лунные сутки. Событийный ряд этих суток изобилует мнимыми случайностями и совпадениями, пробуждает двойственные чувства, неоднозначные ассоциации. Оппозиция Луны к ретроградному Меркурию вынуждает задуматься. Вопросов будет больше, чем ответов. Интенсивная работа мысли не помешает мобильности и сотрудничеству. Не стоит откладывать визиты, короткие поездки, обмен мнениями. Возможны задержки при оформлении документов. Нежелательно ставить подписи, утверждать планы и маршруты. Интересующие явления полезно рассмотреть с разных сторон, привлекая альтернативные мнения. Подходящий момент для работы с архивами, программами, корреспонденцией, словарями, справочниками, новостными лентами.', 0, 0),
(84, 'Прогноз', 'Oleg', '2012-04-17 02:48:25', 'Сегодня ожидается минус 1—4 °C, обложной снег, замерзающий (переохлажденный) туман\r\n, слабый ветер. Завтра: минус 1—3 °C, преимущественно без осадков, замерзающий (переохлажденный) туман\r\n, слабый ветер.', 0, 0),
(85, 'Погода в Смоленске', 'Oleg', '2012-04-17 02:50:44', '3 часа назад на метеостанции было -0.9 °C, пасмурная погода, атмосферное давление в пределах нормы, высокая влажность (83%), тихий ветер (1 м/с), дующий с юго-юго-востока.', 0, 0),
(86, 'Гороскоп для раков', 'Oleg', '2012-04-17 02:51:28', 'Время сесть за курсач.', 0, 0),
(87, 'Альтернатива, бунт и драйв: RockestraLi', 'Oleg', '2012-04-17 02:51:58', '24 ноября набирающий популярность в России оркестр RockestraLive исполнил хиты британских и американских групп в симфонической обработке. Шоу, где воедино сплелись красота и торжественность симфонического оркестра с необузданной свободой и драйвом рок-музыки, прошло на сцене КДЦ Губернский. ', 1, 0),
(88, '«Мамаша Кураж» ', 'Oleg', '2012-04-17 02:55:00', '«Мамаша Кураж» в постановке «Театрального квадрата»: от смеха к тишине. От смеха к гробовому молчанию. Такой путь проходят зрители спектакля по пьесе Бертольда Брехта «Мамаша Кураж и ее дети» в исполнении театра-студии «Театральный квадрат». Жаль только, что не так много зрителей прочувствовали это 20 ноября (около половины мест в ДК Профсоюзов пустовало). ', 1, 0),
(89, 'Грезы, грозы и смех', 'Oleg', '2012-04-17 02:55:45', 'Гастроли Орловского государственного академического театра имени И.С. Тургенева начались в Смоленске 22 ноября со спектакля «Первая любовь».', 0, 0),
(90, '«Тапки, выходите!»', 'Oleg', '2012-04-17 02:57:17', '18 ноября в Смоленске выступила одна из самых успешных кавер-групп России RADIO TAPOK. Концерт прошел на неформальной площадке города — в А-клубе.\r\n', 1, 0),
(91, 'В Смоленске пройдет «Кросс Нации — 2017»', 'Oleg', '2012-04-17 03:00:10', '\r\nНачало спортивных забегов — 10:00, массового забега — 11:00. Принять участие сможет любой желающий вне зависимости от пола, возраста и уровня подготовки.', 1, 0),
(92, 'Велосипед — спасение смолян на ближайшие', 'Julia', '2012-04-17 03:01:50', 'Чтобы выйти из осенней хандры, предлагаем вам заняться велоспортом. Это самый простой и быстрый способ получить дозу гормонов счастья. Монотонные движения и размеренное дыхание автоматически приводят в порядок мысли и чувства. Из организма выводится стрессовый гормон кортизол нормализуется сон. ', 1, 0),
(93, 'Чудеса науки', 'Julia', '2012-04-17 03:02:52', '30 августа в культурно-выставочном центре имени Тенишевых состоялось открытие научной выставки «Элементарно, Эйнштейн». ', 0, 0),
(94, 'Лешка', 'Julia', '2012-04-17 03:04:13', 'Выживший после поджога щенок Лешка нашел хозяев в Краснодаре ', 0, 0),
(95, 'В Праге разрушился мост для пешеходов\r\n', 'Julia', '2012-04-17 03:06:04', ' Пешеходный мост через реку Влатву рухнул сегодня, 2 декабря, в чешской столице Праге. При этом пострадали четыре человека, сообщает местное издание e15.cz. Все получившие травмы сейчас находятся в городской больнице. В настоящее время на месте проходит операция по поиску других возможных жертв инцидента. В ней задействован вертолет, пожарные и представители правоохранительных органов.', 0, 0),
(96, 'Без тепла', 'Vania', '2012-04-17 03:08:09', 'Порядка 2х миллионов москвичей остались без тепла и горячей воды в морозы. На ТЭЦ №23 случилась крупная авария. Несколько округов столицы остались без тепла.\r\n', 1, 0),
(97, 'Вторая рука убитой', 'Sergey', '2012-04-17 03:14:14', 'Водолазы обнаружили вторую руку убитой шведской журналистки. Возможно, находка относится к делу о владельце подлодки Nautilus Петера Мадсена. В бухте около Копенгагена водолазы нашли ещё одну человеческую руку, которая может принадлежать погибшей шведской журналистке Ким Валль. Об этом сообщают местные СМИ со ссылкой на заявление датской полиции. Останки были направлены на экспертизу. В сообщении не уточняется, о какой руке идёт речь — правой или левой. Однако ранее полицейские нашли левую руку, которая, как показало исследование, принадлежала погибшей на подлодке журналистке.', 1, 0),
(98, 'Врачи', 'Vania', '2012-04-17 03:32:40', 'Врачи', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `relationships`
--

CREATE TABLE IF NOT EXISTS `relationships` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relationships`
--

INSERT INTO `relationships` (`id`, `id_news`, `id_category`) VALUES
(13, 83, 29),
(14, 83, 31),
(15, 84, 23),
(16, 85, 23),
(17, 86, 24),
(18, 86, 31),
(19, 87, 24),
(20, 87, 27),
(21, 87, 32),
(22, 88, 27),
(23, 89, 27),
(24, 90, 24),
(25, 90, 27),
(26, 92, 23),
(27, 92, 24),
(28, 92, 25),
(29, 92, 28),
(30, 93, 27),
(31, 94, 26),
(32, 95, 23),
(33, 95, 24),
(34, 95, 25),
(35, 95, 26),
(36, 96, 23),
(37, 96, 24),
(38, 96, 26),
(39, 97, 26),
(40, 97, 29),
(41, 98, 28);

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
('Julia', 'Julia.Voka@ya.ru', 'Julia', '2012-04-17 02:15:45', 1, '2012-04-17 02:15:45', 0),
('Kirill', 'Kirill@gmail.ru', 'Kirill', '2012-04-17 02:19:57', 0, '2012-04-17 02:19:57', 0),
('Oleg', 'Oleg@gmail.ru', 'Oleg', '2012-04-17 02:19:30', 1, '2012-04-17 02:19:30', 0),
('Sergey', 'Sergey@gmail.com', 'Sergey', '2012-04-17 03:13:29', 0, '2012-04-17 03:13:29', 0),
('Vania', 'Vania@gmail.ru', 'Vania', '2012-04-17 03:07:22', 0, '2012-04-17 03:07:22', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT для таблицы `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`login_autor`) REFERENCES `users` (`login`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`login_autor`) REFERENCES `users` (`login`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `relationships`
--
ALTER TABLE `relationships`
  ADD CONSTRAINT `relationships_ibfk_1` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relationships_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
