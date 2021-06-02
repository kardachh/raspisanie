<head>
    <title>Меню администратора</title>
    <link href="/../style.css" type="text/css" rel="stylesheet">
</head>
<script src="../../jquery.js"></script>




<?php
	require_once $_SERVER['DOCUMENT_ROOT'] .'/admin'.'/auth.php';

	if(isset($_POST['edit_groups'])){
		require_once 'forms/add_group.php';
		exit;
	}
	if(isset($_POST['edit_lessons'])){
		require_once 'forms/add_lessons.php';
		exit;
	}
	if(isset($_POST['edit_time'])){
		require_once 'forms/edit_time.php';
		exit;
	}
	if(isset($_POST['edit_teachers'])){
		require_once 'forms/add_teachers.php';
		exit;
	}
	if(isset($_POST['edit_group_classes'])){
		require_once 'forms/add_group_classes.php';
		exit;
	}
	if(isset($_POST['edit_classrooms'])){
		require_once 'forms/add_classrooms.php';
		exit;
	}
	if(isset($_POST['edit_types'])){
		require_once 'forms/add_types.php';
		exit;
	}
?>

<br>
<br>
<div id = all class = 'centered' style = "background-color:white; border: none;">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/button_back.php'; ?>

	<form method="post">
		<div id = "menu-cont">
			<input class = 'btn' type="submit" name='edit_groups' value="Группы">
			<input class = 'btn' type="submit" name='edit_lessons' value="Дисциплины">
			<input class = 'btn' type="submit" name='edit_classrooms' value="Кабинеты">
			<input class = 'btn' type="submit" name='edit_teachers' value="Преподаватели">
			<input class = 'btn' type="submit" name='edit_time' value="Время">
			<input class = 'btn' type="submit" name='edit_group_classes' value="Группировка дисциплин">
			<input class = 'btn' type="submit" name='edit_types' value="Типы пар">
		</div>
	</form>
</div>

