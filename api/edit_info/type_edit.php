<?php
    $type = $_POST['type'];
    $type_id =  $_POST['type_id'];
    $type_name =  $_POST['type_name'];
    $new_type_name = $_POST['new_type_name'];
    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    if($type == 'add'){
        $sql_add = "INSERT INTO `Class_Type`(`Name`) VALUES ('$type_name')";
    
        if ($link->query($sql_add) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql_add . "<br>" . $link->error;
        }
    }
    if ($type=='edit'){
        $sql_edit = "UPDATE `Class_Type`
        SET
        `Name`= '$new_type_name'
        WHERE ID = $type_id";
    
        if ($link->query($sql_edit) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error ." ".$sql_edit;
        }
    }

    if ($type=='del'){
        $sql_del = "DELETE FROM Class_Type WHERE ID=$type_id";
    
        if ($link->query($sql_del) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $link->error ." ".$sql_del;
        }
    }
    // $info=array();
    // foreach($_POST as $key=>$value){
    //     array_push($info, $key.' = '.$value);
    // }
    // echo json_encode($info);
    mysqli_close($link);