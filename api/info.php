<?php
    // запрос к списку пар
    // добавить в конец необходимый селектор 
    $sql_classes_selector = 
        "SELECT
            WEEK.Week AS 'week',
            Groups.Name AS 'group',
            Day_Of_Week.Name AS 'day_of_week',
            Classes_Time.Time AS 'time',
            Classrooms.Number AS 'classroom',
            Classes.Name AS 'name_of_class',
            Class_Type.Name AS 'type'
        FROM
            List_Of_Classes,
            WEEK,
            Day_Of_Week,
            Classes_Time,
            Classrooms,
            Classes,
            Class_Type,
            Groups
        WHERE
            List_Of_Classes.ID_Day_Of_Week = Day_Of_Week.ID 
            AND 
            List_Of_Classes.ID_Classes_Time = Classes_Time.ID 
            AND 
            List_Of_Classes.ID_Classroom = Classrooms.Number 
            AND 
            List_Of_Classes.ID_Class = Classes.ID 
            AND 
            List_Of_Classes.ID_Type = Class_Type.ID
            AND
            List_Of_Classes.ID_Group = Groups.ID";

    require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php';
    $time = $_POST['number_class']; // номер пары
    $day = $_POST['number_day']; // день недели
    $week = $_POST['week']; // неделя
    $group = $_POST['group']; // группа

    $sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = $time";
    $sql_all = "$sql_classes_selector AND List_Of_Classes.ID_Class = $time AND Day_Of_Week.ID = $day AND WEEK.Week = '$week' AND Groups.Name = '$group'";

    $arr_time = [];
    $arr_name = [];
    $arr_type = [];
    // $arr_time;
    // $arr_time;

    // получение времени
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

    // получение наименований пар
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных
    $result = mysqli_query($link, $sql_all) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr_name,$row['name_of_class']);
        }
    }
    // закрываем подключение
    mysqli_close($link);

    // получение типа пары
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных
    $result = mysqli_query($link, $sql_all) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr_type,$row['type']);
        }
    }
    // закрываем подключение
    mysqli_close($link);

    $info=array( // возврат массива с информацией

        "time"=>implode(' ',$arr_time),
        "name"=>implode('\n',$arr_name),
        "type"=>implode(' ',$arr_type),
        // "teacher"=>
        // "classroom"=>
    );
    echo json_encode($info);