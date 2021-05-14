<h1>Пары</h1>
<div id="list_of_classes">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
    $query = "SELECT * FROM Classes ORDER BY Name";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {
        while ($row = mysqli_fetch_array($result)) { ?>
            <div class="class-edit">
                <div class="class-name class-<?=$row['ID']?>"> <?= $row['Name'] ?></div>
                <div class="btn-cont">
                    <input class="btn-edit-class" type="button" value="Изменить">
                    <input class="btn-del-class" type="button" value="Удалить">
                </div>
                <div class = "edit-cont">
                    Новое наименование:
                    <input class = "edit-input-name" type="text" placeholder="Новое наименование">
                    <input class = "btn-save-class" type="button" value="Сохранить">
                </div>
            </div>
    <?php }
    }
    mysqli_close($link);
    ?>
</div>

<input id="btn-add-class" type="button" value="Добавить предмет">
<br>
<br>
<div id="cont-add-class">
    <div id="name-new-class">
        <div id="name-new-class-text">
            Наименование пары
        </div>
        <div>
            <input id="name-new-class-input" type="text" placeholder="Введите наименование дисциплины" required>
        </div>
    </div>
    <br>
    <div id="enter-new-class">
        <input id="enter-new-class-btn" type="submit" value="Добавить">
    </div>
</div>

<script>
    url = '../../api/edit_info/class_edit.php';

    $(".class-edit").hover(function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
    }, function() {
        let btn_cont = $(this).find(".btn-cont");
        $(btn_cont).toggle(100);
        $('.edit-cont').hide(100);
        $('.btn-edit-class').val('Изменить');

    });

    $("#btn-add-class").click(function() {
        $("#cont-add-class").toggle(200);
        $("#btn-add-class").val() == 'Добавить предмет' ? $("#btn-add-class").val('Скрыть') : $("#btn-add-class").val('Добавить предмет');
    });

    $('.btn-edit-class').click(function() {
        let cont_edit = $(this).parent().parent().find('.edit-cont');

        $(cont_edit).toggle(200);
        $(this).val() == 'Изменить' ? $(this).val('Скрыть') : $(this).val('Изменить');
    });

    $('#enter-new-class-btn').click(function() {
        $.ajax({
            type: "post",
            url: url,
            data: {
                type: 'add',
                class: $('#name-new-class-input').val()
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

    $('.btn-save-class').click(function() {
        if ($(this).parent().find('.edit-input-name').val()!=""){
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'edit',
                    new_class_name:$(this).parent().find('.edit-input-name').val(),
                    class_id:$(this).parent().parent().find('.class-name').attr('class').slice(17),
                    class: $(this).parent().parent().find('.class-name').text()
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

    $('.btn-del-class').click(function() {
        let confirm_del = confirm("Вы уверены, что хотите удалить предмет '"+$(this).parent().parent().find('.class-name').text()+"?");
        console.log(confirm_del);
        if (confirm_del){
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'del',
                    class_id:$(this).parent().parent().find('.class-name').attr('class').slice(17),
                    class: $(this).parent().parent().find('.class-name').text()
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