<!-- добавить в запрос селектор группы и недели -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php'; ?>
<?php
$week = $_POST['week'];
$group = $_POST['group'];
$days_of_week = ['Понедельник', 'Вторник', "Среда", "Четверг", "Пятница", "Суббота"];
for ($i = 1; $i < 7; $i++) { ?>
    <div id=<?= $i ?> class='day day-<?= $i ?>'>
        <div class='day_of_week'><?= $days_of_week[$i - 1] ?></div>
        <?php
        for ($j = 1; $j < 8; $j++) {  ?>
            <form class='time time <?= $j ?>'>
                <div class='number-cont'><?= $j ?></div>
                <div class='class-cont'>
                    <?php
                    // подключаемся к серверу
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка " . mysqli_error($link));

                    // выполняем операции с базой данных
                    $query = "SELECT
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
                                Classes_Time.ID = $j";
                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                    if ($result) {
                        // print_r($result);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                    ?>
                                <div class='class'>
                                    <?= $row['name_of_class'], ' ', $row['type'], ' ', $row['classroom'] ?>
                                    <div class='buttons-area'>
                                        <button>Edit</button>
                                        <button>Del</button>
                                    </div>
                                </div>
                    <?php
                                // echo '<hr>',$row['name_of_class'],$row['type'],$row['classroom'],'<hr>';
                            }
                        } else echo 'Пусто';
                    }
                    // закрываем подключение
                    mysqli_close($link);
                    ?>
                </div>

                <!-- <select class = 'class_select'>
                        <option value="-1">нет</option>
                        
                    </select>
                    <select class = 'type_select'>
                    <option value="-1">нет</option>
                        <?php
                        // // подключаемся к серверу
                        // $link = mysqli_connect($host, $user, $password, $database)
                        //     or die("Ошибка " . mysqli_error($link));

                        // // выполняем операции с базой данных
                        // $query = "SELECT * FROM Class_Type";
                        // $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                        // if ($result) {
                        //     while ($row = mysqli_fetch_array($result)) {
                        //         echo '<option value=', $row['ID'], '>', $row['Name'], '</option>';
                        //     }
                        // }
                        // // закрываем подключение
                        // mysqli_close($link);
                        ?>
                    </select>
                    <select class = 'classroom_select'>
                    <option value="-1">нет</option>
                        <?php
                        // подключаемся к серверу
                        // $link = mysqli_connect($host, $user, $password, $database)
                        //     or die("Ошибка " . mysqli_error($link));

                        // // выполняем операции с базой данных
                        // $query = "SELECT * FROM Classrooms";
                        // $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                        // if ($result) {
                        //     while ($row = mysqli_fetch_array($result)) {
                        //         echo '<option value=', $row['Number'], '>', $row['Number'], '</option>';
                        //     }
                        // }
                        // // закрываем подключение
                        // mysqli_close($link);
                        ?>
                    </select> -->
            </form>
        <?php
        }
        ?>
    </div>
<?php
}
// echo $week,' ',$group;
?>