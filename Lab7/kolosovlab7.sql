-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 26 2024 г., 20:08
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
-- База данных: `kolosovlab7`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_количество_этажей_на_улице` (INOUT `allFloors` INT, `streetName` TEXT)   BEGIN
SELECT SUM(Этажи) INTO allFloors FROM Дом WHERE Улица = streetName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_procedureДом` (`street` TEXT, `numb` INT, `floor` INT)   BEGIN
INSERT INTO Дом (Улица, Номер, Этажи) VALUES (street, numb, floor);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_procedureДом` (`goalId` INT, `street` TEXT, `numb` INT, `floors` INT)   BEGIN
UPDATE Дом 
SET 
Улица = street,
Номер = numb,
Этажи = floors
WHERE id = goalId;
END$$

DELIMITER ;

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
(2, 'Новая', 111, 1),
(3, 'Лукоморье', 15, 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `дом`
--
ALTER TABLE `дом`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `дом`
--
ALTER TABLE `дом`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
