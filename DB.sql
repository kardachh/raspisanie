-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 20 2021 г., 16:57
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Classes_Time`
--

DROP TABLE IF EXISTS `Classes_Time`;
CREATE TABLE IF NOT EXISTS `Classes_Time` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Time` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Classrooms`
--

DROP TABLE IF EXISTS `Classrooms`;
CREATE TABLE IF NOT EXISTS `Classrooms` (
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Day_Of_Week`
--

DROP TABLE IF EXISTS `Day_Of_Week`;
CREATE TABLE IF NOT EXISTS `Day_Of_Week` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=' 13';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `Week`
--

DROP TABLE IF EXISTS `Week`;
CREATE TABLE IF NOT EXISTS `Week` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Week` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
