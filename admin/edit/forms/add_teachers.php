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
                <div class="teacher-name teacher-<?=$row['ID']?>"> <?= $row['Second_Name']." ".$row['First_Name']." ".$row['Middle_Name'] ?></div>
                <div class="btn-cont">
                    <input class="btn-edit-teacher" type="button" value="Изменить">
                    <input class="btn-del-teacher" type="button" value="Удалить">
                </div>
                <div class = "edit-cont">
                    <div class = "edit-cont-second-name">
                        Фамилия:
                        <input class = "edit-input-name" type="text" placeholder="Фамилия">
                    </div>
                    <div class = "edit-cont-first-name">
                        Имя:
                        <input class = "edit-input-name edit-input-first-name" type="text" placeholder="Имя">
                    </div>
                    <div class = "edit-cont-middle-name">
                        Отчество:
                        <input class = "edit-input-name" type="text" placeholder="Отчество">
                    </div>
                    <input class = "btn-save-teacher" type="button" value="Сохранить">
                </div>
                
            </div>
    <?php }
    }
    mysqli_close($link);
    ?>
</div>

<input id="btn-add-teacher" type="button" value="Добавить группу">
<br>
<br>
<div id="cont-add-teacher">
    <div id="name-new-teacher">
        <div id="name-new-teacher-text">
            Наименование группы
        </div>
        <div>
            <input id="name-new-teacher-input" type="text" placeholder="Введите наименование группы" required>
        </div>
    </div>
    <br>
    <div id="enter-new-teacher">
        <input id="enter-new-teacher-btn" type="submit" value="Добавить">
    </div>
</div>

<script>
    url = '../../api/edit_info/group_edit.php';

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
        $("#btn-add-teacher").val() == 'Добавить группу' ? $("#btn-add-teacher").val('Скрыть') : $("#btn-add-teacher").val('Добавить группу');
    });

    $('.btn-edit-teacher').click(function() {
        let cont_edit = $(this).parent().parent().find('.edit-cont');

        $(cont_edit).toggle(200);
        $(this).val() == 'Изменить' ? $(this).val('Скрыть') : $(this).val('Изменить');
    });

    $('#enter-new-teacher-btn').click(function() {
        $.ajax({
            type: "post",
            url: url,
            data: {
                type: 'add',
                teacher: $('#name-new-teacher-input').val()
            },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function() {
                console.log(response);
            }
        });
    });

    $('.btn-save-teacher').click(function() {
        if ($(this).parent().find('.edit-input-name').val()!=""){
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'edit',
                    new_group_name:$(this).parent().find('.edit-input-name').val(),
                    teacher_id:$(this).parent().parent().find('.teacher-name').attr('class').slice(17),
                    teacher: $(this).parent().parent().find('.teacher-name').text()
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

    $('.btn-del-teacher').click(function() {
        let confirm_del = confirm("Вы уверены, что хотите удалить группу"+$(this).parent().parent().find('.teacher-name').text()+"?");
        console.log(confirm_del);
        if (confirm_del){
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'del',
                    teacher_id:$(this).parent().parent().find('.teacher-name').attr('class').slice(17),
                    teacher: $(this).parent().parent().find('.teacher-name').text()
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