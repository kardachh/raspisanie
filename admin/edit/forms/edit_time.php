<h1>Изменение времени</h1>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
$query = "SELECT * FROM Classes_Time ORDER BY ID";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if ($result) {
    while ($row = mysqli_fetch_array($result)) { ?>
        <div class="time-edit time-<?= $row['ID'] ?>">
            <?= $row['ID'] ?> пара:
            <input class="input-edit-time" value="<?= $row['Time'] ?>" type="text" disabled="true">
        </div>
<?php
    }
}
mysqli_close($link);
?>
<br>
<input id="btn-edit-time" type = "button" value="Изменить">
<input id="btn-save-time" type = "button" value="Сохранить изменения">
<script>
    $('#btn-edit-time').click(function () { 
        $('#btn-save-time').toggle(200);
        if ($("#btn-edit-time").val() == 'Изменить') {
            $("#btn-edit-time").val('Отмена')
            $(".input-edit-time").prop('disabled', false);
        }   
        else {
            $("#btn-edit-time").val('Изменить');
            $(".input-edit-time").prop('disabled', true);
        }
    });

    $('#btn-save-time').click(function () { 
        let mass_time = [];
        $.each($('.input-edit-time'), function () {
            mass_time.push($(this).val());
        });
        let data = JSON.stringify(mass_time);
        // console.log(data);
        $.get("../../api/edit_info/time_edit.php", { "data": mass_time },function(responce){
            console.log(responce)
            location.reload();
        })
    });
    
</script>