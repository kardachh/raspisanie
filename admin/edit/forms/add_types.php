<div id='all'>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>

    <h1>Типы пар</h1>
    <div id="list_of_types">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query = "SELECT * FROM Class_Type ORDER BY Name";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_array($result)) { ?>
                <div class="type">
                    <div class="type-name type-<?= $row['ID'] ?>"> <?= $row['Name'] ?></div>
                    <div class="btn-cont">
                        <input class="btn-edit-type" type="button" value="Изменить">
                        <input class="btn-del-type" type="button" value="Удалить">
                    </div>
                    <div class="edit-cont">
                        Новое наименование:
                        <input class="edit-input-name" type="text" placeholder="Новое наименование">
                        <input class="btn-save-type" type="button" value="Сохранить">
                    </div>
                </div>
        <?php }
        }
        mysqli_close($link);
        ?>
    </div>

    <input id="btn-add-type" type="button" value="Добавить тип">
    <br>
    <br>
    <div id="cont-add-type">
        <div id="name-new-type">
            <div id="name-new-type-text">
                Наименование типа
            </div>
            <div>
                <input id="name-new-type-input" type="text" placeholder="Введите наименование типа" required>
            </div>
        </div>
        <br>
        <div id="enter-new-type">
            <input id="enter-new-type-btn" type="submit" value="Добавить">
        </div>
    </div>
</div>


<script>
    url = '../../api/edit_info/type_edit.php';

    $(".type").hover(function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
    }, function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
        $('.edit-cont').hide(100);
        $('.btn-edit-type').val('Изменить');

    });

    $("#btn-add-type").click(function() {
        $("#cont-add-type").toggle(200);
        $("#btn-add-type").val() == 'Добавить тип' ? $("#btn-add-type").val('Скрыть') : $("#btn-add-type").val('Добавить тип');
    });

    $('.btn-edit-type').click(function() {
        let cont_edit = $(this).parent().parent().find('.edit-cont');

        $(cont_edit).toggle(200);
        $(this).val() == 'Изменить' ? $(this).val('Скрыть') : $(this).val('Изменить');
    });

    $('#enter-new-type-btn').click(function() {
        if ($('#name-new-type-input').val() != '') {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'add',
                    type_name: $('#name-new-type-input').val()
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert('Введите наименование типа');

    });

    $('.btn-save-type').click(function() {
        if ($(this).parent().find('.edit-input-name').val() != "") {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'edit',
                    new_type_name: $(this).parent().find('.edit-input-name').val(),
                    type_id: $(this).parent().parent().find('.type-name').attr('class').slice(15),
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert("Введите наименование типа");


    });

    $('.btn-del-type').click(function() {
        let confirm_del = confirm("Вы уверены, что хотите удалить тип " + $(this).parent().parent().find('.type-name').text() + "?");
        console.log(confirm_del);
        if (confirm_del) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'del',
                    type_id: $(this).parent().parent().find('.type-name').attr('class').slice(15),
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