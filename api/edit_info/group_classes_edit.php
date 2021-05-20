<?php
$class_id = $_POST['class_id'];
$group_id = $_POST['group_id'];
$group_class_id = $_POST['group_class_id'];
$type = $_POST['type'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

if ($type == 'find'){
    $query_group_classes = 
    // "SELECT * FROM `Group_Classes` WHERE `ID_Group` = $group_id";
    "SELECT Group_Classes.`ID`, `ID_Group`, `ID_Class`,Teachers.Second_Name,Teachers.First_Name,Teachers.Middle_Name,Classes.Name
    FROM `Group_Classes`,Teachers,Classes 
    WHERE Group_Classes.ID_Class = Classes.ID AND Teachers.ID = Classes.ID_Teacher AND Group_Classes.ID_Group = $group_id";
    $rows=[];
    $result = mysqli_query($link, $query_group_classes) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)){
                $rows[] = $row;
            }
        }
    // echo json_encode($rows);
    $text = "
    <select size='25' class='group-class".$value['ID']."'>";
    foreach ($rows as $key => $value) {
        $text= $text.
        "<option value='".$value['ID']."'>".$value['Name']." (".$value['Second_Name']." ". mb_substr($value['First_Name'], 0, 1 - mb_strlen($value['First_Name'])).".".mb_substr($value['Middle_Name'], 0, 1 - mb_strlen($value['Middle_Name'])).".".")</option>";
    }
    $text = $text. '</select>';
    $text = $text.
    "
        <div class = 'btn-cont'>
            <input class = 'btn-add-to-group' type = 'button' value = 'Добавить пары'>
            <input class = 'btn-del'type = 'button' value = 'Удалить'>
        </div>
    ";
    echo $text;
}

if ($type == 'del'){
    $sql_del = "DELETE FROM Group_Classes WHERE ID=$group_class_id";
    
        if ($link->query($sql_del) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $link->error ." ".$sql_del;
        }
}

if($type == 'add'){
    $sql_add = "INSERT INTO `Group_Classes`(`ID_Group`, `ID_Class`) VALUES ($group_id,$class_id)";

    if ($link->query($sql_add) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_add . "<br>" . $link->error;
    }
}


mysqli_close($link);