<?php
    $type = $_POST['type'];
    $teacher_id =  $_POST['teacher_id'];
    $class_name =  $_POST['class'];
    $class_id = $_POST['class_id'];
    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    if($type == 'add'){
        $sql_add = "INSERT INTO `Classes`(`Name`, `ID_Teacher`) VALUES ('$class_name',$teacher_id)";
    
        if ($link->query($sql_add) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_add . "<br>" . $link->error;
        }
    }
    if ($type=='edit'){
        // $sql_edit = "UPDATE `Classes` SET `Name`= '$class_name' , 'ID_Teacher'= $teacher_id WHERE ID = $class_id";
        $sql_edit = "UPDATE `Classes` SET `Name`='$class_name',`ID_Teacher`=$teacher_id WHERE ID = $class_id";
    
        if ($link->query($sql_edit) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error ." ".$sql_edit;
        }
    }

    if ($type=='del'){
        $sql_del = "DELETE FROM Classes WHERE ID=$class_id";
    
        if ($link->query($sql_del) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $link->error ." ".$sql_del;
        }
    }
    mysqli_close($link);