<?php
    $type = $_POST['type'];
    $group_id =  $_POST['group_id'];
    $group_name =  $_POST['group'];
    $new_group_name = $_POST['new_group_name'];
    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    if($type == 'add'){
        $sql_add = "INSERT INTO `Groups`(`Name`) VALUES ('$group_name')";
    
        if ($link->query($sql_add) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_add . "<br>" . $link->error;
        }
    }
    if ($type=='edit'){
        $sql_edit = "UPDATE `Groups`
        SET
        `Name`= '$new_group_name'
        WHERE ID = $group_id";
    
        if ($link->query($sql_edit) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error ." ".$sql_edit;
        }
    }

    if ($type=='del'){
        $sql_del = "DELETE FROM Groups WHERE ID=$group_id";
    
        if ($link->query($sql_del) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $link->error ." ".$sql_del;
        }
    }
    mysqli_close($link);