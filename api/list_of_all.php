<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php';
    
    $time = $_POST['number_class']; // номер пары
    $day = $_POST['number_day']; // день недели
    $week = $_POST['week']; // неделя
    $group = $_POST['group']; // группа
    // запрос времени
    $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = $time";
    // запрос наименований пар
    $sql_name = "SELECT * FROM `Classes`";
    // запрос типа пар
    $sql_type = "SELECT * FROM `Class_Type`";
    // запрос кабинета
    $sql_classroom = "SELECT * FROM `Classrooms`";



    $arr_time = [];
    $arr_name = [];
    $arr_type = [];
    $arr_teacher = [];
    $arr_classroom = [];

    // получение времени
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка получение времени" . mysqli_error($link));

    // выполняем операции с базой данных
    $result = mysqli_query($link, $sql_time) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr_time,$row['Time']);
        }
    }
    // закрываем подключение
    mysqli_close($link);

    // получение наименований пар
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка получение наименований пар" . mysqli_error($link));

    // выполняем операции с базой данных
    $result = mysqli_query($link, $sql_name) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr_name,$row['Name']);
        }
    }
    // закрываем подключение
    mysqli_close($link);

    // получение типа пары
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных
    $result = mysqli_query($link, $sql_type) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr_type,$row['Name']);
        }
    }
    // закрываем подключение
    mysqli_close($link);

    // // получение преподавателя
    // // подключаемся к серверу
    // $link = mysqli_connect($host, $user, $password, $database) 
    //     or die("Ошибка " . mysqli_error($link));

    // // выполняем операции с базой данных
    // $result = mysqli_query($link, $sql_all) or die("Ошибка " . mysqli_error($link)); 
    // if($result)
    // {
    //     while ($row = mysqli_fetch_array($result)) {
    //         $fio = $row['second_name'].' '.$row['first_name'].' '.$row['middle_name'];
    //         array_push($arr_teacher, $fio);
    //     }
    // }
    // // закрываем подключение
    // mysqli_close($link);

    // получение кабинета
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных
    $result = mysqli_query($link, $sql_classroom) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr_classroom, $row['Number']);
        }
    }
    // закрываем подключение
    mysqli_close($link);

    $info=array( // возврат массива с информацией
        "time"=>implode('',$arr_time),
        "name"=>$arr_name,
        "type"=>$arr_type,
        // "teacher"=>$arr_teacher,
        "classroom"=>$arr_classroom
    );
    echo json_encode($info);