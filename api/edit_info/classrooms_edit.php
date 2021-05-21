<?php
    $type = $_POST['type'];
    $classroom_number =  $_POST['classroom_number'];
    $new_classroom_number =  $_POST['new_classroom_number'];
    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    if($type == 'add'){
        $sql_add = "INSERT INTO `Classrooms`(`Number`) VALUES ('$classroom_number')";
    
        if ($link->query($sql_add) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_add . "<br>" . $link->error;
        }
    }
    if ($type=='edit'){
        $sql_edit = "UPDATE `Classrooms`
        SET
        `Number`= '$new_classroom_number'
        WHERE Number = $classroom_number";
    
        if ($link->query($sql_edit) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error ." ".$sql_edit;
        }
    }

    if ($type=='del'){
        $sql_del = "DELETE FROM Classrooms WHERE Number=$classroom_number";
    
        if ($link->query($sql_del) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $link->error ." ".$sql_del;
        }
    }
    mysqli_close($link);