-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 12 2021 г., 14:17
-- Версия сервера: 5.7.26
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `raspisanie`
--
CREATE DATABASE IF NOT EXISTS `raspisanie` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `raspisanie`;

-- --------------------------------------------------------

--
-- Структура таблицы `Classes`
--

CREATE TABLE `Classes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ID_Teacher` int(11) NOT NULL,
  `ID_Group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Classes`
--

INSERT INTO `Classes` (`ID`, `Name`, `ID_Teacher`, `ID_Group`) VALUES
(1, 'ММ', 1, 0),
(2, 'Учебная практика', 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Classes_Time`
--

CREATE TABLE `Classes_Time` (
  `ID` int(11) NOT NULL,
  `Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `Classrooms` (
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `Class_Type` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `Day_Of_Week` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `Groups` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=' 13';

--
-- Дамп данных таблицы `Groups`
--

INSERT INTO `Groups` (`ID`, `Name`) VALUES
(1, 'ИСПк-301-52-00 (ИСПк-201-51-00)'),
(2, 'ПСО'),
(3, 'ИСПк-202-52-00');

-- --------------------------------------------------------

--
-- Структура таблицы `List_Of_Classes`
--

CREATE TABLE `List_Of_Classes` (
  `ID` int(11) NOT NULL,
  `ID_Group` int(11) NOT NULL,
  `ID_Week` int(11) NOT NULL,
  `ID_Day_Of_Week` int(11) NOT NULL,
  `ID_Classes_Time` int(11) NOT NULL,
  `ID_Classroom` int(11) NOT NULL,
  `ID_Class` int(11) NOT NULL,
  `ID_Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `List_Of_Classes`
--

INSERT INTO `List_Of_Classes` (`ID`, `ID_Group`, `ID_Week`, `ID_Day_Of_Week`, `ID_Classes_Time`, `ID_Classroom`, `ID_Class`, `ID_Type`) VALUES
(3, 1, 1, 1, 1, 100, 1, 1),
(4, 1, 1, 2, 4, 105, 1, 1),
(5, 2, 1, 3, 3, 101, 2, 2),
(7, 1, 1, 1, 5, 104, 2, 1),
(8, 1, 1, 1, 1, 102, 1, 3),
(9, 1, 3, 1, 1, 100, 1, 1),
(11, 1, 1, 1, 1, 103, 2, 2),
(13, 1, 3, 1, 2, 100, 2, 4),
(14, 1, 3, 1, 4, 102, 1, 3),
(15, 1, 3, 1, 1, 105, 2, 3),
(16, 3, 3, 1, 1, 100, 2, 1),
(17, 1, 4, 1, 1, 102, 1, 1),
(18, 3, 4, 1, 1, 104, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `Teachers`
--

CREATE TABLE `Teachers` (
  `ID` int(11) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Second_Name` varchar(255) NOT NULL,
  `Middle_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Teachers`
--

INSERT INTO `Teachers` (`ID`, `First_Name`, `Second_Name`, `Middle_Name`) VALUES
(1, 'Елизавета', 'Сергеева', 'Григорьевна'),
(2, 'Александра', 'Авдеева', 'Всеволодовна');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
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

CREATE TABLE `Week` (
  `ID` int(11) NOT NULL,
  `Week` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Week`
--

INSERT INTO `Week` (`ID`, `Week`) VALUES
(1, '2021-W18'),
(2, '2021-W17'),
(3, '2021-W19'),
(4, '2021-W20'),
(5, '2021-W21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Teacher` (`ID_Teacher`);

--
-- Индексы таблицы `Classes_Time`
--
ALTER TABLE `Classes_Time`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Classrooms`
--
ALTER TABLE `Classrooms`
  ADD PRIMARY KEY (`Number`);

--
-- Индексы таблицы `Class_Type`
--
ALTER TABLE `Class_Type`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Индексы таблицы `Day_Of_Week`
--
ALTER TABLE `Day_Of_Week`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`,`Name`);

--
-- Индексы таблицы `List_Of_Classes`
--
ALTER TABLE `List_Of_Classes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Day_Of_Week` (`ID_Day_Of_Week`),
  ADD KEY `ID_Classes_Time` (`ID_Classes_Time`),
  ADD KEY `ID_Week` (`ID_Week`),
  ADD KEY `ID_Class` (`ID_Class`),
  ADD KEY `ID_Classroom` (`ID_Classroom`),
  ADD KEY `ID_Type` (`ID_Type`),
  ADD KEY `ID_Group` (`ID_Group`) USING BTREE;

--
-- Индексы таблицы `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Week`
--
ALTER TABLE `Week`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Classes`
--
ALTER TABLE `Classes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Classes_Time`
--
ALTER TABLE `Classes_Time`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Classrooms`
--
ALTER TABLE `Classrooms`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT для таблицы `Class_Type`
--
ALTER TABLE `Class_Type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Day_Of_Week`
--
ALTER TABLE `Day_Of_Week`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Groups`
--
ALTER TABLE `Groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `List_Of_Classes`
--
ALTER TABLE `List_Of_Classes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `Teachers`
--
ALTER TABLE `Teachers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Week`
--
ALTER TABLE `Week`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`ID_Teacher`) REFERENCES `Teachers` (`ID`);

--
-- Ограничения внешнего ключа таблицы `List_Of_Classes`
--
ALTER TABLE `List_Of_Classes`
  ADD CONSTRAINT `list_of_classes_ibfk_1` FOREIGN KEY (`ID_Day_Of_Week`) REFERENCES `Day_Of_Week` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_2` FOREIGN KEY (`ID_Group`) REFERENCES `Groups` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_3` FOREIGN KEY (`ID_Classes_Time`) REFERENCES `Classes_Time` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_4` FOREIGN KEY (`ID_Week`) REFERENCES `Week` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_5` FOREIGN KEY (`ID_Class`) REFERENCES `Classes` (`ID`),
  ADD CONSTRAINT `list_of_classes_ibfk_6` FOREIGN KEY (`ID_Classroom`) REFERENCES `Classrooms` (`Number`),
  ADD CONSTRAINT `list_of_classes_ibfk_7` FOREIGN KEY (`ID_Type`) REFERENCES `Class_Type` (`ID`);
