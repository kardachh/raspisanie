<?php
    $id = $_POST['id'];
    $name_id = $_POST['name_id'];
    $type_id = $_POST['type_id'];
    $classroom = $_POST['classroom'];


    $info=array();
    foreach($_POST as $key=>$value){
        array_push($info, $key.' = '.$value);
    }
    echo json_encode($info);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка" . mysqli_error($link));

    $sql = "UPDATE `List_Of_Classes`
            SET
            `ID_Classroom`=$classroom,
            `ID_Class`=$name_id,
            `ID_Type`=$type_id 
            WHERE List_Of_Classes.ID = $id";

    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "\nError updating record: " . $link->error;
    }
    mysqli_close($link);