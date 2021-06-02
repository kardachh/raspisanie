
<style>
	<?php include '../style.css'; ?>
</style>

<div id=all>`
	<?php
	require_once '../button_back.php';
	?>
	<div id='main-text'>
	<img class = logo src='/LOGO_VYATGU_VECTOR.svg'>
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
			<input id='week-select' type="input" placeholder="Выберите неделю" required style="display:none">
			<input id='add-btn' type='button' value="Добавить" style="display:none">
			<input type="button" value="Текущая неделя" onclick="swap_to_current_week()">
			<input type="button" value="Следующая неделя" onclick="swap_to_next_week()">
		</form> <!-- загрузка групп из БД -->
		<button id='csv-save' class = 'btn'>CSV File</button>
		<a href="#" id="test" onClick="javascript:fnExcelReport();" class = 'btn'>Excel</a>

	</div>
	<center><div id='table-space'></div></center>
</div>


<script src='../../moment.js'></script>
<script src='../../jquery.js'></script>
<!-- <script src = 'script_add_rasp.js'></script> -->
<script>
	function downloadCSV(csv, filename) {
		var csvFile;
		var downloadLink;

		// CSV file
		csvFile = new Blob([csv], {
			type: "text/csv"
		});

		// Download link
		downloadLink = document.createElement("a");

		// File name
		downloadLink.download = filename;

		// Create a link to the file
		downloadLink.href = window.URL.createObjectURL(csvFile);

		// Hide download link
		downloadLink.style.display = "none";

		// Add the link to DOM
		document.body.appendChild(downloadLink);

		// Click download link
		downloadLink.click();
	}

	function exportTableToCSV(filename) {
		var csv = [];
		var rows = document.querySelectorAll("table tr");

		for (var i = 0; i < rows.length; i++) {
			var row = [],
				cols = rows[i].querySelectorAll("td, th");
			for (var j = 0; j < cols.length; j++) {
				let str = (cols[j].innerText).replace('\n', "/")
				row.push(str);
				// console.log(str);
			}

			csv.push(row.join(","));
		}

		// Download CSV file
		downloadCSV(csv.join("\n"), filename);
		// console.log(csv);
	}

	$('#csv-save').click(function() {
		exportTableToCSV($('#week-select').val() + ' ' + $('#name_of_group option:selected').text())
	});

	let next_week = moment().add(1, 'weeks').format('W');
	let current_week = moment().format('W');

	$('#week-select').val(moment().format('YYYY-') + 'W' + current_week);

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
		$.ajax({
			type: "post",
			url: url,
			data: {
				week: $('#week-select').val(),
				group: $('#name_of_group option:selected').val(),
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
				$('table').remove();
				$('body').html('Ошибка получения расписания');
				console.log(response.responseText);
				console.log(response);
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
		let tdname = document.createElement('th');

		tdname.setAttribute('colspan', 5);
		tdname.innerHTML = $('#name_of_group option:selected').text()

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
		tdname.innerHTML = 'Наименование дисциплины';
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
		let start_week = moment($('#week-select').val());
		let day = document.createElement('tr');
		let trday = document.createElement('td');
		trday.setAttribute('colspan', 5);
		$.ajax({ // получение дня недели 
			type: "post",
			url: "../../api/date.php",
			data: 'number=' + number,
			dataType: 'text',
			success: function(response) {
				// let day_form = current_day.toISOString().split('T')[0];
				trday.innerHTML = response + ' (' + moment(start_week).add(number - 1, 'days').format('DD.MM.YYYY') + ')';
			},
			error: function(responce) {
				trday.innerHTML = 'Error'
			}
		});
		day.appendChild(trday);
		return day;
	}


	$('#add-btn').click(function() {
		tableCreate();
		document.title = 'Расписание ' + $('#name_of_group option:selected').text();
	});

	function swap_to_current_week() {
		$('#week-select').val(moment().year() + '-W' + current_week);
		tableCreate();
	}

	function swap_to_next_week() {
		$('#week-select').val(moment().year() + '-W' + next_week);
		tableCreate();
	}

	tableCreate();
	document.title = 'Расписание ' + $('#name_of_group option:selected').text();

	$('#week-select').on('change', function() {
		$('#add-btn').click();
	});

	$('#name_of_group').on('change', function() {
		$('#add-btn').click();
	});

	function fnExcelReport() {
    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

    tab_text = tab_text + '<x:Name>Test Sheet</x:Name>';

    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

    tab_text = tab_text + "<table border='1px'>";
    tab_text = tab_text + $('table').html().replaceAll('<hr>','<br>');
    tab_text = tab_text + '</table></body></html>';
	console.log(tab_text);

    var data_type = 'data:application/vnd.ms-excel';
    
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
            var blob = new Blob([tab_text], {
                type: "application/csv;charset=utf-8;"
            });
            navigator.msSaveBlob(blob, 'Test file.xls');
        }
    } else {
        $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
        $('#test').attr('download', $('#week-select').val() + ' ' + $('#name_of_group option:selected').text()+'.xls');
    }

}
</script>