<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка БД");


if (isset($_POST['auth_name']) or isset($_SESSION['user_id'])) {
	echo $host;
	$name = mysqli_real_escape_string($link, $_POST['auth_name']);
	$pass = mysqli_real_escape_string($link, $_POST['auth_pass']);
	$query = "SELECT * FROM users WHERE name='$name' AND pass='$pass'";
	$res = mysqli_query($link, $query);
	if ($row = mysqli_fetch_assoc($res)) {
		session_start();
		$_SESSION['user_id'] = $row['id'];
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	}
	header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	exit;
}

// if (isset($_GET['action']) and $_GET['action'] == "logout") {
// 	session_start();
// 	session_destroy();
// 	header("Location: http://" . $_SERVER['HTTP_HOST'] . "/");
// 	exit;
// }
session_start();
if (isset($_SESSION['user_id']) and $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) return;
else {
?>
	<form method="post">
		<input type="text" name='auth_name' value="kardachh"required><br>
		<input type="password" name="auth_pass" value="123"required><br>
		<input type="submit"><br>
	</form>
<?php
}
exit;