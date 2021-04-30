<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php';

    $time = $_POST['number_class'];

    // запрос времени
    $sql_time = "SELECT * FROM `Classes_Time` WHERE `ID` = $time";
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

    if ($_POST['query']=='create'){
        // подключаемся к серверу
        $link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link));

        // выполняем операции с базой данных
        $result_time = mysqli_query($link, $sql_time) or die("Ошибка " . mysqli_error($link)); 
        if($result_time)
        {
            while ($row = mysqli_fetch_array($result_time)) {
                array_push($arr_time,$row['Time']);
            }
        }
        // закрываем подключение
        mysqli_close($link);
    }


	// подключаемся к серверу
	$link = mysqli_connect($host, $user, $password, $database) 
		or die("Ошибка " . mysqli_error($link));

	// выполняем операции с базой данных
	$result_name = mysqli_query($link, $sql_name) or die("Ошибка " . mysqli_error($link)); 
	if($result_name)
	{
		while ($row = mysqli_fetch_array($result_name)) {
			array_push($arr_name,[$row['ID'],$row['Name']]);
		}
	}
	$result_type = mysqli_query($link, $sql_type) or die("Ошибка " . mysqli_error($link)); 
	if($result_type)
	{
		while ($row = mysqli_fetch_array($result_type)) {
			array_push($arr_type,[$row['ID'],$row['Name']]);
		}
	}
	$result_classroom = mysqli_query($link, $sql_classroom) or die("Ошибка " . mysqli_error($link)); 
	if($result_classroom)
	{
		while ($row = mysqli_fetch_array($result_classroom)) {
			array_push($arr_classroom,$row['Number']);
		}
	}
	// закрываем подключение
	mysqli_close($link);

    $info=array( // возврат массива с информацией
        "query"=>$_POST['query'],
        "time"=>implode('',$arr_time),
        "name"=>$arr_name,
		"type"=>$arr_type,
		"teacher"=>$arr_teacher,
		"classroom"=>$arr_classroom
    );
    echo json_encode($info);
