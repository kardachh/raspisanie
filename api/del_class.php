<?php

    $group_id = $_POST['group'];
    $week_id;
    $week = $_POST['week'];
    // $week = '2021-W20';
    $day_of_week = $_POST['day_of_week'];
    $time = $_POST['time'];
    $name_id = $_POST['name_id'];
    $type_id = $_POST['type_id'];
    $classroom = $_POST['classroom'];


    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка" . mysqli_error($link));
    // проверка наличия недели в БД
    $query_week = "SELECT * FROM WEEK WHERE Week.Week = '$week'"; 
    $result = mysqli_query($link, $query_week) or die("Ошибка" . mysqli_error($link));
    if ($result) {
        if (mysqli_num_rows($result) == 0) { // если недели нет в БД, то создаем новую
            $sql_add_week = "INSERT INTO `Week`(`Week`) VALUES ('$week')";
            if ($link->query($sql_add_week) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql_add_week . "<br>" . $link->error;
            }
        }
    }
    $result = mysqli_query($link, $query_week) or die("Ошибка" . mysqli_error($link));
    if ($result) { // получение id недели
        while ($row = mysqli_fetch_array($result)) {
            $week_id = $row['ID'];
        }
    }
    // выполняем операции с базой данных
    $sql = "INSERT INTO `List_Of_Classes` (`ID_Group`, `ID_Week`, `ID_Day_Of_Week`, `ID_Classes_Time`, `ID_Classroom`, `ID_Class`, `ID_Type`)
    VALUES ('$group_id', $week_id, '$day_of_week', '$time', '$classroom', '$name_id', '$type_id')";

        if ($link->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
    }
    // закрываем подключение
    mysqli_close($link);

    $info=array( // возврат массива с информацией
        "group_id"=>$_POST['group'],
        "week"=>$_POST['week'],
        "week_id"=>$week_id,
		"day_of_week"=>$_POST['day_of_week'],
		"time"=>$_POST['time'],
		"name_id"=>$_POST['name_id'],
		"type_id"=>$_POST['type_id'],
		"classroom"=>$_POST['classroom'],
    );
    echo json_encode($info);