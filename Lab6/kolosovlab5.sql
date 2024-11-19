-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 19 2024 г., 21:28
-- Версия сервера: 8.0.39
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kolosovlab5`
--

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE `log` (
  `ID` int UNSIGNED NOT NULL,
  `Событие` text NOT NULL,
  `Время` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_строки` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `log`
--

INSERT INTO `log` (`ID`, `Событие`, `Время`, `ID_строки`) VALUES
(1, 'insert', '2024-11-19 16:37:13', 1),
(2, 'insert', '2024-11-19 16:38:05', 2),
(3, 'insert', '2024-11-19 16:38:32', 3),
(5, 'update', '2024-11-19 16:43:42', 2),
(7, 'delete', '2024-11-19 16:46:01', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `table_колосов`
--

CREATE TABLE `table_колосов` (
  `id` int NOT NULL,
  `Сотрудник` varchar(45) NOT NULL,
  `Адрес` varchar(45) NOT NULL,
  `Номер_Телефона` varchar(12) NOT NULL,
  `Зарплата` mediumint NOT NULL,
  `Продолжительность_Трудовой_Деятельности` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `table_колосов`
--

INSERT INTO `table_колосов` (`id`, `Сотрудник`, `Адрес`, `Номер_Телефона`, `Зарплата`, `Продолжительность_Трудовой_Деятельности`) VALUES
(1, 'Колосов Данил', 'Пермь', '89824549228', 999999, 0),
(2, 'Гаина Георгий', 'Москва', '898245433328', 45000, 9),
(3, 'Серебряков Егор', 'Токио', '89123454922', 13000, 24),
(4, 'Масалкин Владимир', 'Санкт-Петербург', '89123454922', 130000, 25),
(5, 'Елохов Максим', 'Санкт-Петербург', '894323454922', 70000, 14),
(6, 'Андрюшкевич Адександра', 'Минск', '854323454922', 65000, 1),
(7, 'Карелин Виктор', 'Пермь', '8523454922', 90000, 17),
(8, 'Борисов Никита', 'Закамск', '8598454922', 44000, 123),
(9, 'Анджей Сапковсий', 'Минск', '8898454922', 14000, 65),
(10, 'Даут Андрей', 'Губаха', '8198454922', 33000, 23),
(11, 'Колесников Максим', 'Оса', '8498454922', 90000, 230),
(12, 'Коровина Ксения', 'Пермь', '8454454922', 95000, 20),
(13, 'Альянаки Светлана', 'Пермь', '8413454922', 100000, 95),
(14, 'Савельева Варвара', 'Хохловка', '8913454922', 150000, 7),
(15, 'Норов Илья', 'Пермь', '8943454922', 180000, 20),
(16, 'Субботин Егор', 'Екатеринбург', '8904454922', 750000, 12),
(17, 'Ямаев Денис', 'Пермь', '89043454922', 40000, 12),
(18, 'Рогозина Алина', 'Пермь', '89043954922', 54000, 14),
(19, 'Огнева Ксения', 'Санкт-Петербург', '89043956722', 94000, 14),
(20, 'Кукушкин Макар', 'Пермь', '89843956722', 99000, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `дом`
--

CREATE TABLE `дом` (
  `ID` int UNSIGNED NOT NULL,
  `Улица` text NOT NULL,
  `Номер` int UNSIGNED NOT NULL,
  `Этажи` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `дом`
--

INSERT INTO `дом` (`ID`, `Улица`, `Номер`, `Этажи`) VALUES
(1, 'Лукоморье', 13, 1),
(2, 'Новая', 111, 1);

--
-- Триггеры `дом`
--
DELIMITER $$
CREATE TRIGGER `ДомDelete` AFTER DELETE ON `дом` FOR EACH ROW BEGIN
	INSERT INTO log SET Событие = 'delete',  ID_строки= OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ДомInsert` AFTER INSERT ON `дом` FOR EACH ROW BEGIN
	INSERT INTO log SET Событие = 'insert',  ID_строки= NEW.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ДомUpdate` AFTER UPDATE ON `дом` FOR EACH ROW BEGIN
	INSERT INTO log SET Событие = 'update',  ID_строки= NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `представление_table_kolosovex1`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `представление_table_kolosovex1` (
`Заработная_плата` mediumint
,`Сотрудник` varchar(45)
,`Телефон` varchar(12)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `представление_table_kolosovex2`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `представление_table_kolosovex2` (
`Место_Жительства` varchar(45)
,`Сотрудник` varchar(45)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `представление_table_kolosovex3`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `представление_table_kolosovex3` (
`Опыт_Работы` int
,`Сотрудник` varchar(45)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `представление_дома`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `представление_дома` (
`Количествово_этажей` int unsigned
,`Ул` text
,`№` int unsigned
);

-- --------------------------------------------------------

--
-- Структура для представления `представление_table_kolosovex1`
--
DROP TABLE IF EXISTS `представление_table_kolosovex1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `представление_table_kolosovex1` (`Сотрудник`, `Телефон`, `Заработная_плата`) AS   select `table_колосов`.`Сотрудник` AS `Сотрудник`,`table_колосов`.`Номер_Телефона` AS `Номер_Телефона`,`table_колосов`.`Зарплата` AS `Зарплата` from `table_колосов`  ;

-- --------------------------------------------------------

--
-- Структура для представления `представление_table_kolosovex2`
--
DROP TABLE IF EXISTS `представление_table_kolosovex2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `представление_table_kolosovex2` (`Сотрудник`, `Место_Жительства`) AS   select `table_колосов`.`Сотрудник` AS `Сотрудник`,`table_колосов`.`Адрес` AS `Адрес` from `table_колосов` order by `table_колосов`.`Адрес`  ;

-- --------------------------------------------------------

--
-- Структура для представления `представление_table_kolosovex3`
--
DROP TABLE IF EXISTS `представление_table_kolosovex3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `представление_table_kolosovex3` (`Сотрудник`, `Опыт_Работы`) AS   select `table_колосов`.`Сотрудник` AS `Сотрудник`,`table_колосов`.`Продолжительность_Трудовой_Деятельности` AS `Продолжительность_Трудовой_Деятельности` from `table_колосов` where (`table_колосов`.`Продолжительность_Трудовой_Деятельности` > 4)  ;

-- --------------------------------------------------------

--
-- Структура для представления `представление_дома`
--
DROP TABLE IF EXISTS `представление_дома`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `представление_дома` (`Ул`, `№`, `Количествово_этажей`) AS   select `дом`.`Улица` AS `Улица`,`дом`.`Номер` AS `Номер`,`дом`.`Этажи` AS `Этажи` from `дом`  ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `table_колосов`
--
ALTER TABLE `table_колосов`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `дом`
--
ALTER TABLE `дом`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `log`
--
ALTER TABLE `log`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `table_колосов`
--
ALTER TABLE `table_колосов`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `дом`
--
ALTER TABLE `дом`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
