<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php'; // подключаем скрипт
  // подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database);
if(isset($_POST['number'])){
    $day = $_POST['number'];
    $query ="SELECT * FROM Day_Of_Week WHERE `ID`=$day";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        while ($row = mysqli_fetch_array($result)) {
            echo $row['Name'];
        }
    }
}
mysqli_close($link);
?>