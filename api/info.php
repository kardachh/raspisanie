<?php
    $sql_saint = 'SELECT Week.Week,Groups.Name,Day_Of_Week.Name,Classes_Time.Time,Classes.Name,Class_Type.Name 
    FROM List_Of_Classes,Groups,Week,Day_Of_Week,Classes_Time,Classrooms,Classes,Class_Type 
    WHERE List_Of_Classes.ID_Day_Of_Week=Day_Of_Week.ID 
        AND Classes_Time.ID = List_Of_Classes.ID_Classes_Time 
        AND List_Of_Classes.ID_Type = Class_Type.ID 
        and List_Of_Classes.ID_Group = Groups.ID 
        AND List_Of_Classes.ID_Classroom = Classrooms.Number';

    require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php'; // подключаем скрипт
    $time = $_POST['number_class'];
    // $time = $_POST['number_class'];
    // $time = $_POST['number_class'];
    // $time = $_POST['number_class'];
    // $time = $_POST['number_class'];

    $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = $time";
    // $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = 1";
    // $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = 1";
    // $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = 1";
    // $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = 1";

    $arr_time = [];
    // $arr_time;
    // $arr_time;
    // $arr_time;
    // $arr_time;

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

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

    $info=array(
        // "status"=>1,
        "err"=>$_POST['number_day'],
        
        "time"=>implode(' ',$arr_time),
        // "name"=>
        // "type"=>
        // "teacher"=>
        // "classroom"=>
    );
    echo json_encode($info);