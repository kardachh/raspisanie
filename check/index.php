<?php
require_once '../button_back.php';
?>
<style>
	<?php include '../style.css'; ?>
</style>
<div id='main-text'>
	<h1>Расписание</h1>
</div>
<div id=main-cont>
	<form method='post'>
		<p>
			<select id='name_of_group'>
				<?php
				require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт

				// подключаемся к серверу
				$link = mysqli_connect($host, $user, $password, $database)
					or die("Ошибка " . mysqli_error($link));

				// выполняем операции с базой данных
				$query = "SELECT * FROM Groups";
				$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
				if ($result) {
					while ($row = mysqli_fetch_array($result)) {
						echo '<option value=', $row['Name'], '>', $row['Name'], '</option>';
					}
				}
				// закрываем подключение
				mysqli_close($link);
				?>
			</select>
		</p>
		<!-- week выводится в формате "2021-W15" -->
		<input id='week-select' type="week" placeholder="Выберите неделю" required>
		<input id='add-btn' type='button' value="Добавить">
	</form> <!-- загрузка групп из БД -->
	<datalist id="GroupList">
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт

		// подключаемся к серверу
		$link = mysqli_connect($host, $user, $password, $database)
			or die("Ошибка " . mysqli_error($link));

		// выполняем операции с базой данных
		$query = "SELECT * FROM Groups";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		if ($result) {
			while ($row = mysqli_fetch_array($result)) {
				echo '<option value="' . $row['Name'] . '">';
			}
		}
		// закрываем подключение
		mysqli_close($link);
		?>
	</datalist>
</div>

<div id='table-space'></div>

<script src='../../moment.js'></script>
<script src='../../jquery.js'></script>
<!-- <script src = 'script_add_rasp.js'></script> -->
<script>
	$(document).ready(function() {
		$('#week-select').val(moment().format('YYYY-')+'W'+moment().format('W'));
		

		function tableCreate() {
			$('table').remove();
			let body = document.getElementById('table-space'),
				tbl = document.createElement('table');
			tbl.appendChild(nameCreate());
			tbl.appendChild(descriptionCreate());

			for (let i = 1; i < 7; i++) {
				tbl.appendChild(dayCreate(i));
				for (let j = 1; j < 8; j++) {
					tbl.appendChild(classCreate(i, j));
				}
			}

			body.appendChild(tbl);
		}

		function classCreate(number_day, number_class) {
			let _class = document.createElement('tr'); // пара
			let time = document.createElement('td'); // время
			let name = document.createElement('td'); // название пары
			let type = document.createElement('td'); // тип
			let teacher = document.createElement('td'); // препод
			let classroom = document.createElement('td'); // кабинет
			let url = '../../api/info.php';
			// time.innerHTML = 'time'+number_class;
			// name.innerHTML = 'name'+number_class;
			// type.innerHTML = 'type'+number_class;
			// teacher.innerHTML = 'teacher'+number_class;
			// classroom.innerHTML = 'classroom'+number_class;

			$.ajax({
				type: "post",
				url: url,
				data: {
					week: $('#week-select').val(),
					group: $('#name_of_group option:selected').text(),
					number_day: number_day,
					number_class: number_class
				},
				dataType: "json",
				success: function(response) {
					// console.log(response);
					time.innerHTML = response.time;
					name.innerHTML = response.name;
					type.innerHTML = response.type;
					teacher.innerHTML = response.teacher;
					classroom.innerHTML = response.classroom;
				},
				error: function(response) {
					console.log(response.responseText);
				}
			});

			_class.appendChild(time);
			_class.appendChild(name);
			_class.appendChild(type);
			_class.appendChild(teacher);
			_class.appendChild(classroom);
			return _class
		}

		function nameCreate() {
			let trname = document.createElement('tr');
			let tdname = document.createElement('td');

			tdname.setAttribute('colspan', 5);
			tdname.innerHTML = $('#name_of_group').val();

			trname.appendChild(tdname)
			return trname;
		}

		function descriptionCreate() {
			let trdescription = document.createElement('tr');
			let tdtime = document.createElement('td');
			let tdname = document.createElement('td');
			let tdtype = document.createElement('td');
			let tdteacher = document.createElement('td');
			let tdclassroom = document.createElement('td');

			tdtime.innerHTML = 'Время';
			tdname.innerHTML = 'Наименование предмета';
			tdtype.innerHTML = 'Тип';
			tdteacher.innerHTML = 'Преподаватель';
			tdclassroom.innerHTML = 'Кабинет';

			let disc_mass = [tdtime, tdname, tdtype, tdteacher, tdclassroom];
			$.each(disc_mass, function() {
				trdescription.appendChild(this);
			});
			return trdescription
		}

		function dayCreate(number) {
			let start_week = new Date(document.getElementById('week-select').valueAsDate);
			let current_day = start_week.addDays(number - 1);
			let day = document.createElement('tr');
			let trday = document.createElement('td');
			trday.setAttribute('colspan', 5);
			$.ajax({ // получение дня недели 
				type: "post",
				url: "../../api/date.php",
				data: 'number=' + number,
				dataType: 'text',
				success: function(response) {
					let day_form = current_day.toISOString().split('T')[0];
					trday.innerHTML = response + ' (' + day_form + ')';
				},
				error: function(responce) {
					trday.innerHTML = 'Error'
				}
			});
			day.appendChild(trday);
			return day;
		}

		Date.prototype.addDays = function(days) {
			var date = new Date(this.valueOf());
			date.setDate(date.getDate() + days);
			return date;
		}

		$('#add-btn').click(function() {
			let week = new Date(document.getElementById('week-select').valueAsDate);
			if ($('#name_of_group option:selected').text() != "" && $('#week-select').val() != "") {
				tableCreate();
			}
		});
		tableCreate();
	});

	$('#week-select').on('change', function() {
		$('#add-btn').click();
	});

	$('#name_of_group').on('change', function() {
		$('#add-btn').click();
	});
</script>