<?php
    session_start();
    session_destroy();
?>
<head><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<style>
	<?php include 'style.css'; ?>
</style>


<div id = "menu-cont">
    <a href='check/'>
        <div class = "btn">
            <div class = "btn-text">Просмотр расписания</div>
        </div>
    </a>
    <a href='admin/'>
        <div class = "btn">
            <div class = "btn-text">Админ</div>
        </div>
    </a>
</div>

