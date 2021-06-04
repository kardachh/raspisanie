<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка БД");

if (isset($_POST['auth_name']) or isset($_SESSION['user_id'])) {
	$name = mysqli_real_escape_string($link, $_POST['auth_name']);
	$pass = mysqli_real_escape_string($link, $_POST['auth_pass']);
	$query = "SELECT * FROM users WHERE name='$name' AND pass='$pass'";
	$res = mysqli_query($link, $query);
	if ($row = mysqli_fetch_assoc($res)) {
		session_start();
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['phpsess_id'] = $_COOKIE['PHPSESSID'];
	}
	header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>
<?php
	exit;
}
session_start();
if (isset($_SESSION['user_id']) and $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) return;
else {
?>
	<div id=all class='centered' style="background-color:white; border: none;">
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>

		<head>
			<title>Авторизация</title>
			<link href="../style.css" type="text/css" rel="stylesheet">
		</head>
		<form method='post' id='auth'>
			<div style="width: 200px; margin: 0 auto">
				<div id='auth-text-cont'>
					Авторизация
				</div>

				<div id='auth-input-cont' style="text-align: left;">
					Логин: <br><input type="text" name='auth_name' required><br>
					Пароль: <br><input type="password" name="auth_pass" required><br>
				</div>

				<div id='auth-btn-cont'>
					<input class='btn' type="submit" value="Войти" style="width: 50%;"><br>
				</div>
			</div>
		</form>
	</div>
<?php
}
mysqli_close($link);
exit;
