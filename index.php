<style>
	<?php include 'style.css'; ?>
</style>
<div id = "menu-cont">
    <a href='check/'>
        <div class = "btn">
            <div class = "btn-text">Просмотр расписания</div>
        </div>
    </a>
    <br>
    <a href='admin/'>
        <div class = "btn">
            <div class = "btn-text">Админ</div>
        </div>
    </a>
</div>


<?php
    session_start();
    session_destroy();
?>
