<?php
    // запрос времени
    $sql_time = "SELECT * FROM `Classes_Time` WHERE `ID` = $time";
    // запрос наименований пар
    $sql_name = "SELECT * FROM `Classes`";
    // запрос типа пар
    $sql_type = "SELECT * FROM `Class_Type`";
    // запрос кабинета
    $sql_classroom = "SELECT * FROM `Classrooms`";