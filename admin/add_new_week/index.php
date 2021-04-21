<?php 
  require_once $_SERVER['DOCUMENT_ROOT'].'/button_back.php'; 
?>

<div id = 'main-text'>
<h1>Добавление расписания</h1>
</div>
<div id = main-cont>
<form method='post' action='#'>
    <p><input 
      list="GroupList"
      type="text" 
      name="model" 
      placeholder="Выберите группу" 
      required/>
    </p>
    <!-- week выводится в формате "2021-W15" -->
    <input id = 'week-select' type="week" required> 
    <input id = 'add-btn' type='submit' value="Добавить">
</form> <!-- загрузка групп из БД -->
<datalist id="GroupList"> 
<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php'; // подключаем скрипт

  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка " . mysqli_error($link));

  // выполняем операции с базой данных
  $query ="SELECT * FROM Groups";
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
  if($result)
  {
      while ($row = mysqli_fetch_array($result)) {
        echo '<option value="'.$row['Name'].'">';
      }
  }
  // закрываем подключение
  mysqli_close($link);
?>
</datalist>
</div>

<script src = '../../jquery.js'></script>
<script src = 'script_add_rasp.js'></script>