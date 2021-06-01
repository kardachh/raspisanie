<div id='all'>
    <h1>Кабинеты</h1>
    <div id="list_of_classrooms">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query = "SELECT * FROM Classrooms ORDER BY Number";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_array($result)) { ?>
                <div class="classroom">
                    <div class="classroom-name classroom-<?= $row['Number'] ?>"> <?= $row['Number'] ?></div>
                    <div class="btn-cont">
                        <input class="btn-edit-classroom" type="button" value="Изменить">
                        <input class="btn-del-classroom" type="button" value="Удалить">
                    </div>
                    <div class="edit-cont">
                        Новый номер кабинета:
                        <input class="edit-input-name" type="text" placeholder="Введите номер кабинета">
                        <input class="btn-save-classroom" type="button" value="Сохранить">
                    </div>
                </div>
        <?php }
        }
        mysqli_close($link);
        ?>
    </div>

    <input id="btn-add-classroom" type="button" value="Добавить кабинет">
    <br>
    <br>
    <div id="cont-add-classroom">
        <div id="name-new-classroom">
            <div id="name-new-classroom-text">
                Номер кабинета
            </div>
            <div>
                <input id="name-new-classroom-input" type="text" placeholder="Введите номер кабинета" required>
            </div>
        </div>
        <br>
        <div id="enter-new-classroom">
            <input id="enter-new-classroom-btn" type="submit" value="Добавить">
        </div>
    </div>
</div>
<script>
    url = '../../api/edit_info/classrooms_edit.php';

    $(".classroom").hover(function() {
    let btn_cont = $(this).find(".btn-cont");
    $(btn_cont).toggle(100);
    }, function() {
    let btn_cont = $(this).find(".btn-cont");
    $(btn_cont).toggle(100);
    $('.edit-cont').hide(100);
    $('.btn-edit-classroom').val('Изменить');

    });

    $("#btn-add-classroom").click(function() {
    $("#cont-add-classroom").toggle(200);
    $("#btn-add-classroom").val() == 'Добавить группу' ? $("#btn-add-classroom").val('Скрыть') : $("#btn-add-classroom").val('Добавить группу');
    });

    $('.btn-edit-classroom').click(function() {
    let cont_edit = $(this).parent().parent().find('.edit-cont');

    $(cont_edit).toggle(200);
    $(this).val() == 'Изменить' ? $(this).val('Скрыть') : $(this).val('Изменить');
    });

    $('#enter-new-classroom-btn').click(function() {
    if ($('#name-new-classroom-input').val()!=''){
    $.ajax({
    type: "post",
    url: url,
    data: {
    type: 'add',
    classroom_number: $('#name-new-classroom-input').val()
    },
    success: function(response) {
    console.log(response);
    location.reload();
    },
    error: function() {
    console.log(response);
    }
    });
    }
    else alert('Введите наименование группы');

    });

    $('.btn-save-classroom').click(function() {
    if ($(this).parent().find('.edit-input-name').val()!=""){
    $.ajax({
    type: "post",
    url: url,
    data: {
    type: 'edit',
    new_classroom_number:$(this).parent().find('.edit-input-name').val(),
    classroom_number:$(this).parent().parent().find('.classroom-name').attr('class').slice(25),
    },
    success: function(response) {
    console.log(response);
    location.reload();
    },
    error: function() {
    console.log(response);
    }
    });
    } else alert("Введите номер кабинета");


    });

    $('.btn-del-classroom').click(function() {
    let confirm_del = confirm("Вы уверены, что хотите удалить кабинет "+$(this).parent().parent().find('.classroom-name').text()+"?");
    console.log(confirm_del);
    if (confirm_del){
    $.ajax({
    type: "post",
    url: url,
    data: {
    type: 'del',
    classroom_number:$(this).parent().parent().find('.classroom-name').attr('class').slice(25),
    },
    success: function(response) {
    console.log(response);
    location.reload();
    },
    error: function() {
    console.log(response);
    }
    });
    }
    });
    //
    </script>