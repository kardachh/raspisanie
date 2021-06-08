<div id='all'>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>
    <div id=main>
        <h1>Группы</h1>
    </div>
    <div id="list_of_groups">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query = "SELECT * FROM Groups ORDER BY Name";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_array($result)) { ?>
                <div class="group">
                    <div class="group-name group-<?= $row['ID'] ?>"> <?= $row['Name'] ?></div>
                    <div class="btn-cont">
                        <input class="btn-edit-group" type="button" value="Изменить">
                        <input class="btn-del-group" type="button" value="Удалить">
                    </div>
                    <div class="edit-cont">
                        Новое наименование:
                        <input class="edit-input-name" type="text" placeholder="Новое наименование">
                        <input class="btn-save-group" type="button" value="Сохранить">
                    </div>
                </div>
        <?php }
        }
        mysqli_close($link);
        ?>
    </div>

    <input id="btn-add-group" class=btn type="button" value="Добавить группу">
    <br>
    <br>
    <div id="cont-add-group">
        <div id="name-new-group">
            <div id="name-new-group-text">
                Наименование группы
            </div>
            <div>
                <input id="name-new-group-input" type="text" placeholder="Введите наименование группы" required>
            </div>
        </div>
        <br>
        <div id="enter-new-group">
            <input id="enter-new-group-btn" type="submit" value="Добавить">
        </div>
    </div>
</div>

<script>
    url = '../../api/edit_info/group_edit.php';

    $(".group").hover(function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
    }, function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
        $('.edit-cont').hide(100);
        $('.btn-edit-group').val('Изменить');

    });

    $("#btn-add-group").click(function() {
        $("#cont-add-group").toggle(200);
        $("#btn-add-group").val() == 'Добавить группу' ? $("#btn-add-group").val('Отмена') : $("#btn-add-group").val('Добавить группу');
    });

    $('.btn-edit-group').click(function() {
        let cont_edit = $(this).parent().parent().find('.edit-cont');

        $(cont_edit).toggle(200);
        $(this).val() == 'Изменить' ? $(this).val('Отмена') : $(this).val('Изменить');
    });

    $('#enter-new-group-btn').click(function() {
        if ($('#name-new-group-input').val() != '') {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'add',
                    group: $('#name-new-group-input').val()
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert('Введите наименование группы');

    });

    $('.btn-save-group').click(function() {
        if ($(this).parent().find('.edit-input-name').val() != "") {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'edit',
                    new_group_name: $(this).parent().find('.edit-input-name').val(),
                    group_id: $(this).parent().parent().find('.group-name').attr('class').slice(17),
                    group: $(this).parent().parent().find('.group-name').text()
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert("Введите наименование группы");


    });

    $('.btn-del-group').click(function() {
        let confirm_del = confirm("Вы уверены, что хотите удалить группу " + $(this).parent().parent().find('.group-name').text() + "?");
        console.log(confirm_del);
        if (confirm_del) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'del',
                    group_id: $(this).parent().parent().find('.group-name').attr('class').slice(17),
                    group: $(this).parent().parent().find('.group-name').text()
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