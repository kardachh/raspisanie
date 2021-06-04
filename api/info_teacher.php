<?php
// POST [Log] ["week = 2021-W22", "teacher = 2", "number_day = 5", "number_class = 5"] (4) (teachers, line 555)
$day = $_POST['number_day'];
$class = $_POST['number_class'];
$teacher = $_POST['teacher'];
$week = $_POST['week'];


$arr_time = [];
$arr_name = [];
$arr_type = [];
$arr_group = [];
$arr_classroom = [];

require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
$sql_classes_teacher =
"SELECT
WEEK.Week AS 'week',
Day_Of_Week.Name AS 'day_of_week',
Classes_Time.Time AS 'time',
List_Of_Classes.ID as 'list_id',
Group_Classes.ID as 'group_classes_id',
Groups.Name as 'group_name',
List_Of_Classes.ID as 'class_id',
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
List_Of_Classes.ID_Type = Class_Type.ID
AND
Classes.ID_Teacher = Teachers.ID
AND
Day_Of_Week.ID = $day
AND
Classes_Time.ID = $class
AND
Week.Week = '$week'
AND
Teachers.ID = $teacher
";
$sql_time = "SELECT `Time` FROM Classes_Time WHERE `ID` = $class";
$result = mysqli_query($link, $sql_time) or die("Ошибка " . mysqli_error($link));
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arr_time, $row['Time']);
    }
}

$result = mysqli_query($link, $sql_classes_teacher) or die("Ошибка " . mysqli_error($link));
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($arr_name, $row['class_name']);
        array_push($arr_type, $row['type']);
        array_push($arr_group, $row['group_name']);
        array_push($arr_classroom, $row['classroom']);
    }
}

$info = array( // возврат массива с информацией
    "time" => implode('', $arr_time),
    "name" => implode('<hr>', $arr_name),
    "type" => implode('<hr>', $arr_type),
    "group" => implode('<hr>', $arr_group),
    "classroom" => implode('<hr>', $arr_classroom)
);
echo json_encode($info);

// $info=array();
// foreach($_POST as $key=>$value){
//     array_push($info, $key.' = '.$value);
// }
// echo json_encode($info);
