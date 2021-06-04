<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin' . '/auth.php';
?>

<head>
    <title>Авторизация</title>
    <link href="../style.css" type="text/css" rel="stylesheet">
</head>
<br>
<div id=all class='centered' style="background-color:white; border: none;">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>

    <div id="menu-cont">
        <a href='change_classes_list_new/'>
            <div class="btn">
                <div class="btn-text">
                    Изменение расписания
                </div>
            </div>
        </a>
        <a href='edit/'>
            <div class="btn">
                <div class="btn-text">
                    Изменение параметров
                </div>
            </div>
        </a>
    </div>
</div>