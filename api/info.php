<?php
$time = $_POST['number_class']; // номер пары
$day = $_POST['number_day']; // день недели
$week = $_POST['week']; // неделя
$group_id = $_POST['group']; // группа

// запрос к списку пар

$sql_classes_new =
    "SELECT
        WEEK.Week AS 'week',
        Day_Of_Week.Name AS 'day_of_week',
        Classes_Time.Time AS 'time',
        List_Of_Classes.ID as 'list_id',
        Group_Classes.ID as 'group_classes_id',
        Groups.Name as 'group_name',
        Classes.Name as 'class_name',
        Classrooms.Number AS 'classroom',
        Teachers.First_Name AS 'first_name',
        Teachers.Second_Name AS 'second_name',
        Teachers.Middle_Name AS 'middle_name',
        Class_Type.Name AS 'type'

    FROM
        List_Of_Classes,
        Group_Classes,
        Groups,
        Classes,
        Week,
        Day_Of_Week,
        Teachers,
        Classes_Time,
        Classrooms,
        Class_Type


    WHERE 
        List_Of_Classes.ID_Class = Group_Classes.ID
        AND
        Group_Classes.ID_Group = Groups.ID
        AND
        Group_Classes.ID_Class = Classes.ID
        and
        List_Of_Classes.ID_Week = Week.ID 
        AND
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
        Classes.ID_Teacher = Teachers.ID";

require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

// запрос времени
$sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = $time";
// запрос всего остального
$sql_all = "$sql_classes_new AND List_Of_Classes.ID_Classes_Time = $time AND Day_Of_Week.ID = $day AND WEEK.Week = '$week' AND Groups.ID = '$group_id'";

$arr_time = [];
$arr_name = [];
$arr_type = [];
$arr_teacher = [];
$arr_classroom = [];

// получение времени
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$result = mysqli_query($link, $sql_time) or die("Ошибка " . mysqli_error($link));
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arr_time, $row['Time']);
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
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arr_name, $row['class_name']);
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
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arr_type, $row['type']);
    }
}
// закрываем подключение
mysqli_close($link);

// получение преподавателя
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$result = mysqli_query($link, $sql_all) or die("Ошибка " . mysqli_error($link));
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        // $fio = $row['second_name'].' '.$row['first_name'].' '.$row['middle_name'];
        $fio = $row['second_name']
            . ' ' .
            mb_substr($row['first_name'], 0, 1 - mb_strlen($row['first_name']))
            . '.' .
            mb_substr($row['middle_name'], 0, 1 - mb_strlen($row['middle_name']))
            . '.';
        array_push($arr_teacher, $fio);
    }
}
// закрываем подключение
mysqli_close($link);

// получение кабинета
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$result = mysqli_query($link, $sql_all) or die("Ошибка " . mysqli_error($link));
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arr_classroom, $row['classroom']);
    }
}
// закрываем подключение
mysqli_close($link);

$info = array( // возврат массива с информацией
    "time" => implode('', $arr_time),
    "name" => implode('<hr>', $arr_name),
    "type" => implode('<hr>', $arr_type),
    "teacher" => implode('<hr>', $arr_teacher),
    "classroom" => implode('<hr>', $arr_classroom)
);
echo json_encode($info);
    // $info=array();
    // foreach($_POST as $key=>$value){
    //     array_push($info, $key.' = '.$value);
    // }
    // echo json_encode($info);