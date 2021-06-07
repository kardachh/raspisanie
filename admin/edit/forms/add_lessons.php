<div id='all'>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>

    <h1>Дисциплины</h1>
    <div id="list_of_classes">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query = "SELECT First_Name,
    Second_Name,
    Middle_Name,
    Classes.ID as 'class_id', 
    Teachers.ID as 'teacher_id',
    Classes.Name
    FROM Teachers,Classes 
    WHERE Classes.ID_Teacher = Teachers.ID
    ORDER BY Classes.Name";
        $teachers = [];
        $query_teachers = "SELECT * FROM Teachers ORDER BY Second_Name";
        $result_teachers = mysqli_query($link, $query_teachers) or die("Ошибка " . mysqli_error($link));
        if ($result_teachers) {
            while ($row = mysqli_fetch_assoc($result_teachers)) {
                $teachers[$row['ID']] = $row;
            }
        }
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_array($result)) { ?>
                <div class="class-edit">
                    <div class="class-name class-<?= $row['class_id'] ?>">
                        <?= $row['Name']?>
                        <span style="color: #737a85;">
                            <?=' ('.$row['Second_Name'] 
                            . " " . 
                            mb_substr($row['First_Name'], 0, 1 - mb_strlen($row['First_Name'])) 
                            . "." . 
                            mb_substr($row['Middle_Name'], 0, 1 - mb_strlen($row['Middle_Name']))
                            . ".)"
                            ?>
                        </span>
                        
                    </div>
                    <div class="btn-cont">
                        <input class="btn-edit-class" type="button" value="Изменить">
                        <input class="btn-del-class" type="button" value="Удалить">
                    </div>
                    <div class="edit-cont">
                        <div>
                            Новое наименование:
                            <input class="edit-input-name" type="text" placeholder="Новое наименование" value="<?= $row['Name'] ?>">
                        </div>
                        <div>
                            Преподаватель:
                            <select class="edit-teacher-select">
                                <?php
                                foreach ($teachers as $value) {
                                ?>
                                    <option value="<?= $value['ID'] ?>"><?= $value['Second_Name'] . " " . $value['First_Name'] . " " . $value['Middle_Name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <input class="btn-save-class" type="button" value="Сохранить">
                    </div>
                </div>
        <?php }
        }
        mysqli_close($link);
        ?>
    </div>

    <input id="btn-add-class" type="button" value="Добавить дисциплину">
    <br>
    <br>
    <div id="cont-add-class">
        <div id="name-new-class">
            <div id="name-new-class-text">
                Наименование пары
            </div>
            <div>
                <input id="name-new-class-input" type="text" placeholder="Введите наименование дисциплины" style="width: 300px;" required>
            </div>
        </div>
        <div id="teacher-new-class">
            <div id="teacher-new-class-text">
                Преподаватель
            </div>
            <div>
                <select id="teacher-new-class-select" style="width: 300px;">
                    <?php
                    foreach ($teachers as $value) {
                    ?>
                        <option value="<?= $value['ID'] ?>"><?= $value['Second_Name'] . " " . $value['First_Name'] . " " . $value['Middle_Name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <div id="enter-new-class">
            <input id="enter-new-class-btn" type="submit" value="Добавить">
        </div>
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
        $("#btn-add-class").val() == 'Добавить дисциплину' ? $("#btn-add-class").val('Отмена') : $("#btn-add-class").val('Добавить дисциплину');
    });

    $('.btn-edit-class').click(function() {
        let cont_edit = $(this).parent().parent().find('.edit-cont');

        $(cont_edit).toggle(200);
        $(this).val() == 'Изменить' ? $(this).val('Отмена') : $(this).val('Изменить');
    });

    $('#enter-new-class-btn').click(function() {
        if ($("#name-new-class-input").val() != '') {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'add',
                    teacher_id: $('#teacher-new-class-select').val(),
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
        } else alert("Введите наименование дисциплины");
    });

    $('.btn-save-class').click(function() {
        if ($(this).parent().find('.edit-input-name').val() != "") {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'edit',
                    class: $(this).parent().find('.edit-input-name').val(),
                    teacher_id: $(this).parent().find('.edit-teacher-select').val(),
                    class_id: $(this).parent().parent().find('.class-name').attr('class').slice(17),
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function() {
                    console.log(response);
                }
            });
        } else alert("Введите наименование дисциплины");
    });

    $('.btn-del-class').click(function() {
        let confirm_del = confirm("Вы уверены, что хотите удалить дисциплину " + $(this).parent().parent().find('.class-name').text() + "?");
        console.log(confirm_del);
        if (confirm_del) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    type: 'del',
                    class_id: $(this).parent().parent().find('.class-name').attr('class').slice(17),
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