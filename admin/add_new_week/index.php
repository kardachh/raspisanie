<?php 
  
?>
<style>
  <?php include '../../style.css'; ?>
</style>
<?php echo $_SERVER['DOCUMENT_ROOT'].'/api/date.php'?>
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
    <input id = 'week-select' type="week" placeholder="Выберите неделю" required> 
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

<div id = 'table-space'>
  <table>
  <tr><td class="full">Имя группы</td></tr>
  <tr><td class="full">day_of_week1</td></tr>
  <tr>
    <td>time1</td>
    <td>name_of_class1</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time2</td>
    <td>name_of_class2</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time3</td>
    <td>name_of_class3</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time4</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time5</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time6</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time7</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr><td class="full">day_of_week2</td></tr>
  <tr>
    <td>time1</td>
    <td>name_of_class1</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time2</td>
    <td>name_of_class2</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time3</td>
    <td>name_of_class3</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time4</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time5</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time6</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time7</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr><td class="full">day_of_week3</td></tr>
  <tr>
    <td>time1</td>
    <td>name_of_class1</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time2</td>
    <td>name_of_class2</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time3</td>
    <td>name_of_class3</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time4</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time5</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time6</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time7</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr><td class="full">day_of_week4</td></tr>
  <tr>
    <td>time1</td>
    <td>name_of_class1</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time2</td>
    <td>name_of_class2</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time3</td>
    <td>name_of_class3</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time4</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time5</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time6</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time7</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr><td class="full">day_of_week5</td></tr>
  <tr>
    <td>time1</td>
    <td>name_of_class1</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time2</td>
    <td>name_of_class2</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time3</td>
    <td>name_of_class3</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time4</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time5</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time6</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time7</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr><td class="full">day_of_week6</td></tr>
  <tr>
    <td>time1</td>
    <td>name_of_class1</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time2</td>
    <td>name_of_class2</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time3</td>
    <td>name_of_class3</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>

  </tr>
  <tr>
    <td>time4</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time5</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time6</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
  <tr>
    <td>time7</td>
    <td>name_of_class4</td>
    <td>type</td>
    <td>teacher</td>
    <td>classroom</td>
  </tr>
</table>
</div>



<script src = '../../jquery.js'></script>
<!-- <script src = 'script_add_rasp.js'></script> -->
<script>
  $(document).ready(function () {
    $('#add-btn').click(function () {
      let week = new Date(document.getElementById('week-select').valueAsDate);
      console.log(week);
    });
    
    function tableCreate(){
      let body = document.getElementById('table-space'),
        tbl  = document.createElement('table');
        tbl.appendChild(nameCreate());
        
        for (let i = 1; i < 7; i++){
        tbl.appendChild(dayCreate(i));
      }
      // for(let i = 0; i < 3; i++){
      //   let tr = tbl.insertRow();
      //     for(let j = 0; j < 2; j++){
      //         if(i == 2 && j == 1){
      //             break;
      //         } else {
      //           let td = tr.insertCell();
      //             td.appendChild(document.createTextNode('Cell'));
      //             if(i == 1 && j == 1){
      //                 td.setAttribute('rowSpan', '2');
      //             }
      //         }
      //     }
      // }
      body.appendChild(tbl);
    }

    function nameCreate(){
      let name = document.createElement('tr');
      let trname = document.createElement('td');
      trname.setAttribute('colspan',5);
      trname.innerHTML = 'name_of_group';
      name.appendChild(trname)
      return name;
    }

    function dayCreate(number){

      let day = document.createElement('tr');
      let trday = document.createElement('td');
      trday.setAttribute('colspan', 5);
      $.ajax({
        type: "post",
        url: "../../api/date.php",
        data: 'number=' + number,
        dataType: 'text',
        success: function (response) {
          console.log(response);
          trday.innerHTML = response;
        },
        error:function(responce){
          trday.innerHTML = 'Error'
        }
      });
      day.appendChild(trday);
      return day;
    }

    tableCreate();
});
</script>