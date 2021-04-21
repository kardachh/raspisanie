<div id = 'main-text'>
<h1>Добавление расписания</h1>
</div>
<div id = main-cont>
<form>
    <p><input 
      list="GroupList"
      type="text" 
      name="model" 
      placeholder="Выберите группу" />
    </p>
</form> <!-- брать группы из БД -->
  <datalist id="GroupList"> 
    <!-- 
    <option value="ИСПк-301-52-00">
    <option value="ИСПк-202-52-00">
    <option value="ИСПк-101-52-00">
    -->

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
    else {
      echo 'проблема';
    }
    // закрываем подключение
    mysqli_close($link);
?>
  </datalist>
</div>