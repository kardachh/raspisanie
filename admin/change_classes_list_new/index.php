<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/button_back.php';
  require '../auth.php';
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/connection.php'; ?>
<style>
	<?php include '../../style.css'; ?>
</style>
<div id='main-text'>
	<h1>Расписание</h1>
</div>
<div id='select-cont'>
	<form method='post'>
		<p>
			<select id='name_of_group'>
				<?php
				// require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт

				// подключаемся к серверу
				$link = mysqli_connect($host, $user, $password, $database)
					or die("Ошибка " . mysqli_error($link));

				// выполняем операции с базой данных
				$query = "SELECT * FROM Groups ORDER BY Name";
				$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
				if ($result) {
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value=', $row['ID'], '>', $row['Name'], '</option>';
					}
				}
				// закрываем подключение
				mysqli_close($link);
				?>
			</select>
		</p>
		<!-- week выводится в формате "2021-W15" -->
		<input id='week-select' type="week" placeholder="Выберите неделю" required>
		<input id='add-btn' type='button' value="Выбрать">
	</form> <!-- загрузка групп из БД -->
</div>

<div id = table>
	<?php 
        // require 'form.php';
    ?>
</div>
<script src='../../moment.js'></script>
<script src='../../jquery.js'></script>
<script>
    $(document).ready(function () {
		$('#week-select').val(moment().format('YYYY-')+'W'+moment().format('W'));      
    });

	$('#add-btn').click(function (e) { 
		$.ajax({
			type: "post",
			url: "form.php",
			data: {
				week:$('#week-select').val(),
				group:$('#name_of_group').val()
			},
			// dataType: "dataType",
			success: function (response) {
				// console.log(response);
				$('#table').html(response);
			},
			error: function (response) {
				// console.log(response.responseText);
				$('#table').html(response.responseText);
			}
		});
	});

	$('#week-select').on('change', function() {
		$('#add-btn').click();
	});

	$('#name_of_group').on('change', function() {
		$('#add-btn').click();
	});
</script>