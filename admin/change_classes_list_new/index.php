<?php
// require_once '../button_back.php';
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
		<input id='add-btn' type='button' value="Выбрать">
	</form> <!-- загрузка групп из БД -->
</div>



<div id = table>
	<?php
        for ($i=1; $i < 7; $i++) { ?>
            <div id = <?=$i?> class = 'day day-<?= $i ?>'>
                <?php 
                    for ($j=1; $j < 8; $j++) {  ?>
                        <form class = 'time time <?= $j ?>'>
                            <div class='number-cont'><?=$j?></div>
                            <select class = 'class_select'>
                                <option value="-1">нет</option>
                                <?php
                                    // подключаемся к серверу
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));

                                    // выполняем операции с базой данных
                                    $query = "SELECT * FROM Classes";
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
                            <select class = 'type_select'>
                            <option value="-1">нет</option>
                                <?php
                                    // подключаемся к серверу
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));

                                    // выполняем операции с базой данных
                                    $query = "SELECT * FROM Class_Type";
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
                            <select class = 'classroom_select'>
                            <option value="-1">нет</option>
                                <?php
                                    // подключаемся к серверу
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));

                                    // выполняем операции с базой данных
                                    $query = "SELECT * FROM Classrooms";
                                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value=', $row['Number'], '>', $row['Number'], '</option>';
                                        }
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                ?>
                            </select>
                            <div class='buttons-area'>
                                <button>Add</button>
                                <button>Del</button>
                            </div>
                        </form>
                    <?php
                    }
                ?>
            </div>
        <?php
        }
    ?>
</div>
<script src='../../jquery.js'></script>