-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 03 2021 г., 13:22
-- Версия сервера: 5.7.26
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `raspisanie_new`
--
CREATE DATABASE IF NOT EXISTS `raspisanie_new` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `raspisanie_new`;

-- --------------------------------------------------------

--
-- Структура таблицы `Classes`
--

DROP TABLE IF EXISTS `Classes`;
CREATE TABLE IF NOT EXISTS `Classes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `ID_Teacher` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Teacher` (`ID_Teacher`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Classes`
--

INSERT INTO `Classes` (`ID`, `Name`, `ID_Teacher`) VALUES
(1, 'ММ', 1),
(2, 'Учебная практика', 2),
(9, 'Программирование', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `Classes_Time`
--

DROP TABLE IF EXISTS `Classes_Time`;
CREATE TABLE IF NOT EXISTS `Classes_Time` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Time` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Classes_Time`
--

INSERT INTO `Classes_Time` (`ID`, `Time`) VALUES
(1, '8:20 – 9:50'),
(2, '10:00 – 11:30'),
(3, '11:40 – 13:10'),
(4, '14:10 – 15:40'),
(5, '15:50 – 17:20'),
(6, '17:25 – 18:55'),
(7, '19:00 – 20:30');

-- --------------------------------------------------------

--
-- Структура таблицы `Classrooms`
--

DROP TABLE IF EXISTS `Classrooms`;
CREATE TABLE IF NOT EXISTS `Classrooms` (
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Number`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Classrooms`
--

INSERT INTO `Classrooms` (`Number`) VALUES
(100),
(101),
(102),
(103),
(104),
(105),
(106);

-- --------------------------------------------------------

--
-- Структура таблицы `Class_Type`
--

DROP TABLE IF EXISTS `Class_Type`;
CREATE TABLE IF NOT EXISTS `Class_Type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Class_Type`
--

INSERT INTO `Class_Type` (`ID`, `Name`) VALUES
(1, 'Лекция'),
(2, 'Практика'),
(3, 'Семинар'),
(4, 'Лаб. занятие');

-- --------------------------------------------------------

--
-- Структура таблицы `Day_Of_Week`
--

DROP TABLE IF EXISTS `Day_Of_Week`;
CREATE TABLE IF NOT EXISTS `Day_Of_Week` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Day_Of_Week`
--

INSERT INTO `Day_Of_Week` (`ID`, `Name`) VALUES
(1, 'Понедельник'),
(2, 'Вторник'),
(3, 'Среда'),
(4, 'Четверг'),
(5, 'Пятница'),
(6, 'Суббота'),
(7, 'Воскресенье');

-- --------------------------------------------------------

--
-- Структура таблицы `Groups`
--

DROP TABLE IF EXISTS `Groups`;
CREATE TABLE IF NOT EXISTS `Groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`,`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT=' 13';

--
-- Дамп данных таблицы `Groups`
--

INSERT INTO `Groups` (`ID`, `Name`) VALUES
(1, 'ИСПк-301-52-00 (ИСПк-201-51-00)'),
(18, 'ИСПк-202-52-00');

--
-- Триггеры `Groups`
--
DROP TRIGGER IF EXISTS `auto-delete`;
DELIMITER $$
CREATE TRIGGER `auto-delete` BEFORE DELETE ON `Groups` FOR EACH ROW BEGIN
    	DELETE FROM Group_Classes WHERE Group_Classes.ID_Group = OLD.ID;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `Group_Classes`
--

DROP TABLE IF EXISTS `Group_Classes`;
CREATE TABLE IF NOT EXISTS `Group_Classes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Group` int(11) NOT NULL,
  `ID_Class` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_Group_2` (`ID_Group`,`ID_Class`),
  KEY `ID_Group` (`ID_Group`),
  KEY `ID_Class` (`ID_Class`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Group_Classes`
--

INSERT INTO `Group_Classes` (`ID`, `ID_Group`, `ID_Class`) VALUES
(1, 1, 1),
(57, 1, 9),
(56, 18, 1),
(61, 18, 2),
(64, 18, 9);

--
-- Триггеры `Group_Classes`
--
DROP TRIGGER IF EXISTS `auto-delete_from_list`;
DELIMITER $$
CREATE TRIGGER `auto-delete_from_list` BEFORE DELETE ON `Group_Classes` FOR EACH ROW DELETE FROM List_Of_Classes WHERE List_Of_Classes.ID_Class = OLD.ID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `List_Of_Classes`
--

DROP TABLE IF EXISTS `List_Of_Classes`;
CREATE TABLE IF NOT EXISTS `List_Of_Classes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Week` int(11) NOT NULL,
  `ID_Day_Of_Week` int(11) NOT NULL,
  `ID_Classes_Time` int(11) NOT NULL,
  `ID_Class` int(11) NOT NULL,
  `ID_Classroom` int(11) NOT NULL,
  `ID_Type` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Day_Of_Week` (`ID_Day_Of_Week`),
  KEY `ID_Classes_Time` (`ID_Classes_Time`),
  KEY `ID_Week` (`ID_Week`),
  KEY `ID_Classroom` (`ID_Classroom`),
  KEY `ID_Type` (`ID_Type`),
  KEY `ID_Class` (`ID_Class`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `List_Of_Classes`
--

INSERT INTO `List_Of_Classes` (`ID`, `ID_Week`, `ID_Day_Of_Week`, `ID_Classes_Time`, `ID_Class`, `ID_Classroom`, `ID_Type`) VALUES
(19, 3, 1, 1, 1, 105, 1),
(22, 3, 1, 1, 1, 100, 3),
(24, 4, 1, 1, 56, 100, 1),
(28, 4, 1, 1, 1, 100, 1),
(29, 4, 1, 2, 57, 100, 2),
(30, 4, 1, 3, 1, 100, 1),
(35, 6, 1, 1, 56, 104, 4),
(36, 6, 2, 1, 61, 100, 3),
(37, 6, 2, 7, 61, 105, 4),
(38, 6, 1, 1, 56, 100, 1),
(39, 6, 1, 1, 56, 100, 1),
(40, 6, 2, 1, 56, 103, 3),
(41, 6, 1, 1, 64, 100, 1),
(42, 7, 1, 2, 56, 104, 4),
(43, 7, 1, 2, 64, 104, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Teachers`
--

DROP TABLE IF EXISTS `Teachers`;
CREATE TABLE IF NOT EXISTS `Teachers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(255) NOT NULL,
  `Second_Name` varchar(255) NOT NULL,
  `Middle_Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Teachers`
--

INSERT INTO `Teachers` (`ID`, `First_Name`, `Second_Name`, `Middle_Name`) VALUES
(1, 'Елизавета', 'Сергеева', 'Григорьевна'),
(2, 'Александра', 'Авдеева', 'Всеволодовна'),
(7, 'Денис', 'Кардаков', 'Алексеевич');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `pass`) VALUES
(1, 'kardachh', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `Week`
--

DROP TABLE IF EXISTS `Week`;
CREATE TABLE IF NOT EXISTS `Week` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Week` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Week`
--

INSERT INTO `Week` (`ID`, `Week`) VALUES
(1, '2021-W18'),
(2, '2021-W17'),
(3, '2021-W19'),
(4, '2021-W20'),
(5, '2021-W21'),
(6, '2021-W22'),
(7, '2021-W23');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`ID_Teacher`) REFERENCES `Teachers` (`ID`);

--
-- Ограничения внешнего ключа таблицы `Group_Classes`
--
ALTER TABLE `Group_Classes`
  ADD CONSTRAINT `group_classes_ibfk_1` FOREIGN KEY (`ID_Group`) REFERENCES `Groups` (`ID`),
  ADD CONSTRAINT `group_classes_ibfk_2` FOREIGN KEY (`ID_Class`) REFERENCES `Classes` (`ID`);

--
-- Ограничения внешнего ключа таблицы `List_Of_Classes`
--
ALTER TABLE `List_Of_Classes`
  ADD CONSTRAINT `list_of_classes_ibfk_1` FOREIGN KEY (`ID_Day_Of_Week`) REFERENCES `Day_Of_Week` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_3` FOREIGN KEY (`ID_Classes_Time`) REFERENCES `Classes_Time` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_4` FOREIGN KEY (`ID_Week`) REFERENCES `Week` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_6` FOREIGN KEY (`ID_Classroom`) REFERENCES `Classrooms` (`Number`),
  ADD CONSTRAINT `list_of_classes_ibfk_7` FOREIGN KEY (`ID_Type`) REFERENCES `Class_Type` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_8` FOREIGN KEY (`ID_Class`) REFERENCES `Group_Classes` (`ID`);
