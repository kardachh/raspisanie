<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; ?>
<?php
$week = $_POST['week'];
$group_id = $_POST['group'];
$time = [];

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка подключения");
$query_time = "SELECT * FROM `Classes_Time`";
$result_time = mysqli_query($link, $query_time) or die("Ошибка " . mysqli_error($link));
if ($result_time) {
    while ($row = mysqli_fetch_array($result_time)) {
        array_push($time, $row['Time']);
    }
}
mysqli_close($link);

$days_of_week = ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"];
for ($i = 1; $i < 7; $i++) { ?>
    <div id=<?= $i ?> class='day day-<?= $i ?>'>
        <div class='day_of_week'><?= $days_of_week[$i - 1] ?></div>
        <?php
        for ($j = 1; $j < 8; $j++) {  ?>
            <form class='time time <?= $j ?>'>
                <div class='number-cont'><?= $time[$j - 1] ?></div>
                <div class='class-cont'>
                    <?php
                    // подключаемся к серверу
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка " . mysqli_error($link));

                    // выполняем операции с базой данных
                    $query = "SELECT
                                    List_Of_Classes.ID AS 'id',
                                    WEEK.Week AS 'week',
                                    Groups.Name AS 'group',
                                    Day_Of_Week.Name AS 'day_of_week',
                                    Classes_Time.Time AS 'time',
                                    Classrooms.Number AS 'classroom',
                                    Classes.Name AS 'name_of_class',
                                    Class_Type.Name AS 'type',
                                    Teachers.First_Name AS 'first_name',
                                    Teachers.Second_Name AS 'second_name',
                                    Teachers.Middle_Name AS 'middle_name'
                                FROM
                                    List_Of_Classes,
                                    WEEK,
                                    Day_Of_Week,
                                    Classes_Time,
                                    Classrooms,
                                    Classes,
                                    Class_Type,
                                    Groups,
                                    Teachers
                                WHERE
                                    List_Of_Classes.ID_Week = Week.ID 
                                    AND
                                    List_Of_Classes.ID_Day_Of_Week = Day_Of_Week.ID 
                                    AND 
                                    List_Of_Classes.ID_Classes_Time = Classes_Time.ID 
                                    AND 
                                    List_Of_Classes.ID_Classroom = Classrooms.Number 
                                    AND 
                                    List_Of_Classes.ID_Class = Classes.ID 
                                    AND 
                                    List_Of_Classes.ID_Type = Class_Type.ID
                                    AND
                                    List_Of_Classes.ID_Group = Groups.ID
                                    AND
                                    Classes.ID_Teacher = Teachers.ID
                                    AND
                                    Day_Of_Week.ID = $i
                                    AND
                                    Classes_Time.ID = $j
                                    AND
                                    Week.Week = '$week'
                                    AND
                                    Groups.ID = $group_id
                                    ";
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                    if ($result) {
                        // print_r($result);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $fio = $row['second_name']
                                        . ' ' .
                                        mb_substr($row['first_name'], 0, 1 - mb_strlen($row['first_name']))
                                        . '.' .
                                        mb_substr($row['middle_name'], 0, 1 - mb_strlen($row['middle_name']))
                                        . '.';
                    ?>
                                <div class='class class-<?= $row['id'] ?>'>
                                    <?= $row['name_of_class'], ' ', $row['type'], ' ', $row['classroom'], ' ', $fio?>
                                    <div class='buttons-area'>
                                        <button type='button' class="btn-edit">Изменить</button>
                                        <button type='button' class="btn-del">Удалить</button>
                                    </div>
                                    <br>
                                    <div class="editable-select">
                                        <select class="select-name">
                                            <?php
                                            $query_name = "SELECT Classes.ID,Classes.Name,Teachers.Second_Name,Teachers.First_Name,Teachers.Middle_Name FROM Classes,Teachers WHERE Classes.ID_Teacher = Teachers.ID";
                                            $result_name = mysqli_query($link, $query_name) or die("Ошибка " . mysqli_error($link));
                                            if ($result_name) {
                                                while ($row = mysqli_fetch_array($result_name)) {
                                                    $fio = $row['Second_Name']
                                                        . ' ' .
                                                        mb_substr($row['First_Name'], 0, 1 - mb_strlen($row['First_Name']))
                                                        . '.' .
                                                        mb_substr($row['Middle_Name'], 0, 1 - mb_strlen($row['Middle_Name']))
                                                        . '.';
                                                    echo '<option value=', $row['ID'], '>', $row['Name'], ' (', $fio, ')</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <select class="select-type">
                                            <?php
                                            $query_type = "SELECT * FROM Class_Type";
                                            $result_type = mysqli_query($link, $query_type) or die("Ошибка " . mysqli_error($link));
                                            if ($result_type) {
                                                while ($row = mysqli_fetch_array($result_type)) {
                                                    echo '<option value=', $row['ID'], '>', $row['Name'], '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <select class="select-classroom">
                                            <?php
                                            $query_classroom = "SELECT * FROM Classrooms";
                                            $result_classroom = mysqli_query($link, $query_classroom) or die("Ошибка " . mysqli_error($link));
                                            if ($result_classroom) {
                                                while ($row = mysqli_fetch_array($result_classroom)) {
                                                    echo '<option value=', $row['Number'], '>', $row['Number'], '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <button type="button" class="btn-save">Сохранить</button>
                                    </div>

                                </div>

                            <?php
                            }
                        } else {
                            ?>
                            <div class='class'>
                                Пусто
                            </div>
                    <?php
                        };
                    }
                    ?>
                    <br>
                    <button type='button' class="btn-add">Добавить</button>
                    <div class="add-select">
                        <select class="select-name">
                            <?php
                            $query_name = "SELECT Classes.ID,Classes.Name,Teachers.Second_Name,Teachers.First_Name,Teachers.Middle_Name FROM Classes,Teachers WHERE Classes.ID_Teacher = Teachers.ID";
                            $result_name = mysqli_query($link, $query_name) or die("Ошибка " . mysqli_error($link));
                            if ($result_name) {
                                while ($row = mysqli_fetch_array($result_name)) {
                                    $fio = $row['Second_Name']
                                        . ' ' .
                                        mb_substr($row['First_Name'], 0, 1 - mb_strlen($row['First_Name']))
                                        . '.' .
                                        mb_substr($row['Middle_Name'], 0, 1 - mb_strlen($row['Middle_Name']))
                                        . '.';
                                    echo '<option value=', $row['ID'], '>', $row['Name'], ' (', $fio, ')</option>';
                                }
                            }
                            ?>
                        </select>
                        <select class="select-type">
                            <?php
                            $query_type = "SELECT * FROM Class_Type";
                            $result_type = mysqli_query($link, $query_type) or die("Ошибка " . mysqli_error($link));
                            if ($result_type) {
                                while ($row = mysqli_fetch_array($result_type)) {
                                    echo '<option value=', $row['ID'], '>', $row['Name'], '</option>';
                                }
                            }
                            ?>
                        </select>
                        <select class="select-classroom">
                            <?php
                            $query_classroom = "SELECT * FROM Classrooms";
                            $result_classroom = mysqli_query($link, $query_classroom) or die("Ошибка " . mysqli_error($link));
                            if ($result_classroom) {
                                while ($row = mysqli_fetch_array($result_classroom)) {
                                    echo '<option value=', $row['Number'], '>', $row['Number'], '</option>';
                                }
                            }
                            ?>
                        </select>
                        <button type="button" class="btn-submit">Добавить</button>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    </div>

<?php
}
mysqli_close($link);
?>

<script>
    $('.btn-add').click(function(e) {
        let parent = $(e.target).parent()[0];
        let field = $(parent).find('.add-select');
        $(field).toggle(300);
    });

    $('.btn-edit').click(function(e) {
        let parent = $(e.target).parent().parent()[0];
        let field = $(parent).find('.editable-select');
        $(field).toggle(300);
    });

    $('.btn-save').click(function(e) {
        let parent = $(e.target).parent()[0];
        let id = $(parent).parent().attr('class').slice(12);
        let fields = $(parent).children();
        let select_name = $(fields[0]).val(); // id пары
        let select_type = $(fields[1]).val(); // id типа
        let select_classroom = $(fields[2]).val(); // id кабинета
        let day_of_week = $(parent).parent().parent().parent().attr('id'); // день недели
        let time = $(parent).parent().parent().attr('class')[10]; // номер пары
        $.ajax({
            type: "post",
            url: "/api/edit_class.php",
            data: {
                id: id,
                name_id: select_name,
                type_id: select_type,
                classroom: select_classroom
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('#add-btn').click();
            },
            error: function(response) {
                console.log(response.responseText);
                $('#add-btn').click();
            }
        });
    });

    $('.btn-submit').click(function(e) {
        let parent = $(e.target).parent()[0];
        let fields = $(parent).children();
        let select_name = $(fields[0]).val(); // id пары
        let select_type = $(fields[1]).val(); // id типа
        let select_classroom = $(fields[2]).val(); // id кабинета
        let day_of_week = $(parent).parent().parent().parent().attr('id'); // день недели
        let time = $(parent).parent().parent().attr('class')[10]; // номер пары
        $.ajax({
            type: "post",
            url: "/api/add_class.php",
            data: {
                group: $('#name_of_group').val(),
                week: $('#week-select').val(),
                day_of_week: day_of_week,
                time: time,
                name_id: select_name,
                type_id: select_type,
                classroom: select_classroom
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('#add-btn').click();
            },
            error: function(response) {
                console.log(response.responseText);
                $('#add-btn').click();
            }
        });
    });

    $('.btn-del').click(function(e) {
        let parent = $(e.target).parent()[0];
        let id = $(parent).parent().attr('class').slice(12);
        console.log(id);

        $.ajax({
            type: "post",
            url: "/api/del_class.php",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('#add-btn').click();
            },
            error: function(response) {
                console.log(response.responseText);
                $('#add-btn').click();
            }
        });
    });
</script>