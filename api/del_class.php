<?php

    $id = $_POST['id'];

    $info=array();
    foreach($_POST as $key=>$value){
        array_push($info, $key.' = '.$value);
    }
    echo json_encode($info);


    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка" . mysqli_error($link));
    // sql to delete a record
    $sql = "DELETE FROM List_Of_Classes WHERE ID=$id";

    if ($link->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $link->error;
    }
    // закрываем подключение
    mysqli_close($link);