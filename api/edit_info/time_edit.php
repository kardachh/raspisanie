<?php
$data_time = $_GET['data'];
require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
foreach($data_time as $key=>$value){
    $key_plus = $key +1;
    $sql = "UPDATE `Classes_Time`
            SET
            `Time`= '$value'
            WHERE ID = $key_plus";
    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
    }
}
mysqli_close($link);
// echo($_POST['data'][0]);
// print_r($data_time);
