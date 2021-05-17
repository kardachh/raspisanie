<?php
    $type = $_POST['type'];
    $first_name =  $_POST['first_name'];
    $second_name =  $_POST['second_name'];
    $middle_name = $_POST['middle_name'];
    $teacher_id = $_POST['teacher_id'];
    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    if($type == 'add'){
        $sql_add = "INSERT INTO `Teachers`(`First_Name`, `Second_Name`, `Middle_Name`) VALUES ('$first_name','$second_name','$middle_name')";
    
        if ($link->query($sql_add) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_add . "<br>" . $link->error;
        }
    }
    if ($type=='edit'){
        $sql_edit = "UPDATE `Teachers`
        SET
        `First_Name`= '$first_name',
        `Second_Name`= '$second_name',
        `Middle_Name`= '$middle_name'
        WHERE ID = $teacher_id";
    
        if ($link->query($sql_edit) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error ." ".$sql_edit;
        }
    }

    if ($type=='del'){
        $sql_del = "DELETE FROM Teachers WHERE ID=$teacher_id";
    
        if ($link->query($sql_del) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $link->error ." ".$sql_del;
        }
    }
    mysqli_close($link);