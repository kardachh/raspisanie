<div id='all'>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>

    <h1>Преподаватели</h1>
    <div id="list_of_teachers">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query = "SELECT * FROM Teachers ORDER BY Second_Name";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_array($result)) { ?>
                <div class="teacher">
                    <div class="teacher-name teacher-<?= $row['ID'] ?>"> <?= $row['Second_Name'] . " " . $row['First_Name'] . " " . $row['Middle_Name'] ?></div>
                    <div class="btn-cont">
                        <input class="btn-edit-teacher" type="button" value="Изменить">
                        <input class="btn-del-teacher" type="button" value="Удалить">
                    </div>
                    <div class="edit-cont">
                        <div class="edit-cont-second-name">
                            Фамилия:
                            <input class="edit-input-name edit-input-second-name" type="text" placeholder="Фамилия" value="<?= $row['Second_Name'] ?>">
                        </div>
                        <div class="edit-cont-first-name">
                            Имя:
                            <input class="edit-input-name edit-input-first-name" type="text" placeholder="Имя" value="<?= $row['First_Name'] ?>">
                        </div>
                        <div class="edit-cont-middle-name">
                            Отчество:
                            <input class="edit-input-name edit-input-middle-name" type="text" placeholder="Отчество" value="<?= $row['Middle_Name'] ?>">
                        </div>
                        <input class="btn-save-teacher" type="button" value="Сохранить">
                    </div>

                </div>
        <?php }
        }
        mysqli_close($link);
        ?>
    </div>

    <input id="btn-add-teacher" type="button" value="Добавить преподавателя">
    <br>
    <br>
    <div id="cont-add-teacher">
        <div id="name-new-teacher">
            <div class="add-cont-second-name">
                Фамилия:
                <input id="add-input-second-name" class="add-input-name" type="text" placeholder="Фамилия">
            </div>
            <div class="add-cont-first-name">
                Имя:
                <input id="add-input-first-name" class="add-input-name" type="text" placeholder="Имя">
            </div>
            <div class="add-cont-middle-name">
                Отчество:
                <input id="add-input-middle-name" class="add-input-name" type="text" placeholder="Отчество">
            </div>
        </div>
        <br>
        <div id="enter-new-teacher">
            <input id="enter-new-teacher-btn" type="submit" value="Добавить">
        </div>
    </div>
</div>


<script>
    url = '../../api/edit_info/teacher_edit.php';

    $(".teacher").hover(function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
    }, function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
        $('.edit-cont').hide(100);
        $('.btn-edit-teacher').val('Изменить');

    });

    $("#btn-add-teacher").click(function() {
        $("#cont-add-teacher").toggle(200);
        $("#btn-add-teacher").val() == 'Добавить преподавателя' ? $("#btn-add-teacher").val('Скрыть') : $("#btn-add-teacher").val('Добавить преподавателя');
    });

    $('.btn-edit-teacher').click(function() {
        let cont_edit = $(this).parent().parent().find('.edit-cont');

        $(cont_edit).toggle(200);
        $(this).val() == 'Изменить' ? $(this).val('Скрыть') : $(this).val('Изменить');
    });

    $('#enter-new-teacher-btn').click(function() {
        if ($('#add-input-first-name').val() != '' && $('#add-input-second-name').val() != '' && $('#add-input-middle-name').val() != '') {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'add',
                    first_name: $('#add-input-first-name').val(),
                    second_name: $('#add-input-second-name').val(),
                    middle_name: $('#add-input-middle-name').val()
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert('Заполните пустые поля');
    });

    $('.btn-save-teacher').click(function() {
        if ($(this).parent().find('.edit-input-first-name').val() != '' && $(this).parent().find('.edit-input-second-name').val() != '' && $(this).parent().find('.edit-input-middle-name').val() != '') {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'edit',
                    teacher_id: $(this).parent().parent().find('.teacher-name').attr('class').slice(21),
                    first_name: $(this).parent().find('.edit-input-first-name').val(),
                    second_name: $(this).parent().find('.edit-input-second-name').val(),
                    middle_name: $(this).parent().find('.edit-input-middle-name').val(),
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert("Заполните все поля");


    });

    $('.btn-del-teacher').click(function() {
        let confirm_del = confirm("Вы уверены, что хотите удалить преподавателя " + $(this).parent().parent().find('.teacher-name').text() + "?");
        console.log(confirm_del);
        if (confirm_del) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'del',
                    teacher_id: $(this).parent().parent().find('.teacher-name').attr('class').slice(21),
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