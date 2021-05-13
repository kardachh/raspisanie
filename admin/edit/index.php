<style>
	<?php include $_SERVER['DOCUMENT_ROOT'] .'/style.css'; ?>
</style>
<script src="../../jquery.js"></script>


<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/button_back.php';
	require '../auth.php';

	if(isset($_POST['edit_groups'])){
		require_once 'forms/add_group.php';
		exit;
	}
	if(isset($_POST['edit_lessons'])){
		require_once 'forms/add_lessons.php';
		exit;
	}
?>


<form method="post">
	<input type="submit" name='edit_groups' value="Группы">
	<input type="submit" name='edit_lessons' value="Пары">
</form>
