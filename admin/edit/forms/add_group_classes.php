<div id='all' style='width:70%'>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/button_back.php'; ?>

    <h1>Группировка дисциплин по группам</h1>
    <div id='col-cont'>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
        $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
        $query_groups = "SELECT * FROM Groups ORDER BY Name";
        $query_classes = "SELECT Classes.ID,Classes.Name,Classes.ID_Teacher,Teachers.Second_Name,Teachers.First_Name,Teachers.Middle_Name FROM Classes,Teachers WHERE Classes.ID_Teacher = Teachers.ID  ORDER BY Name";
        $mass_of_groups = [];
        $mass_of_classes = [];

        $result = mysqli_query($link, $query_groups) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $mass_of_groups[$row['ID']] = $row;
            }
        }
        $result = mysqli_query($link, $query_classes) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $mass_of_classes[$row['ID']] = $row;
            }
        }
        ?>
        <br>
        <div class="col col-1">
            <div class="col-text">Группа:</div>
            <div id="list_of_groups">
                <select id="select-group">
                    <?php
                    foreach ($mass_of_groups as $value) {
                    ?>
                        <option value="<?= $value['ID'] ?>"><?= $value['Name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div id='cont-btn-find'>
                <input id='btn-find' type='button' value="Найти">
            </div>
        </div>

        <div class="col col-2" style="display:none">
            <div class="col-text">Связанные с группой пары:</div>
            <div id="list_of_group_classes">

            </div>
        </div>

        <div class="col col-3" style="display:none">
            <div class="col-text">Пары:</div>
            <div id="list_of_classes">
                <select id="select-class" size='25'>
                    <?php
                    foreach ($mass_of_classes as $value) {
                    ?>
                        <option value="<?= $value['ID'] ?>"><?= $value['Name'] . " (" . $value['Second_Name'] . " " . mb_substr($value['First_Name'], 0, 1 - mb_strlen($value['First_Name'])) . "." . mb_substr($value['Middle_Name'], 0, 1 - mb_strlen($value['Middle_Name'])) . ")" ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div style="text-align: center;">
                    <input type="button" id='btn-add' value="Добавить">
                </div>
            </div>
        </div>

    </div>
</div>

<?php
mysqli_close($link);
?>
<script>
    $('#btn-find').click(function(e) {
        $('.col-2').show(400);
        let group_id = $('#select-group').val();
        if (group_id) {
            $.ajax({
                type: "post",
                url: "../../api/edit_info/group_classes_edit.php",
                data: {
                    group_id: group_id,
                    type: 'find'
                },
                success: function(response) {
                    // let mass = JSON.parse(response);
                    // $.each(mass, function (key, value) { 
                    //     console.log(value);
                    // });
                    $('.group-class').remove();
                    $('.btn-cont').remove();
                    // console.log(response);
                    $('#list_of_group_classes').append(response);

                    $('.btn-del').click(function() {
                        let group_class_id = $('.group-class option:selected').val();
                        if (group_class_id) {
                            $.ajax({
                                type: "post",
                                url: "../../api/edit_info/group_classes_edit.php",
                                data: {
                                    type: 'del',
                                    group_class_id: group_class_id
                                },
                                success: function(response) {
                                    console.log(response);
                                    $('#btn-find').click();
                                },
                                error: function() {
                                    console.log(response);
                                }
                            });
                            $('#btn-find').click();
                        }
                    });

                    $('.btn-add-to-group').click(function() {
                        if ($(this).val() == 'Добавить пары') {
                            $('.col-3').show(400);
                            $('.btn-del').hide()
                            $(this).val('Отмена');
                            $('#select-group').prop('disabled', true);
                            $('#btn-find').prop('disabled', true);
                            $('.group-class').prop('disabled', true);

                        } else {
                            $('.col-3').hide(400);
                            $('.btn-del').show()
                            $('.btn-add-to-group').val('Добавить пары');
                            $('#select-group').prop('disabled', false);
                            $('#btn-find').prop('disabled', false);
                            $('.group-class').prop('disabled', false);


                        }
                    });
                },
                error: function() {
                    console.log(response);
                }
            });
        }
    });

    $('#btn-add').click(function() {
        if ($('#select-class').val()) {
            $('.col-3').hide(400)
            let group_id = $('#select-group').val();
            let class_id = $('#select-class').val();
            if (group_id) {
                $.ajax({
                    type: "post",
                    url: "../../api/edit_info/group_classes_edit.php",
                    data: {
                        type: 'add',
                        group_id: group_id,
                        class_id: class_id
                    },
                    success: function(response) {
                        console.log(response);
                        $('#select-group').prop('disabled', false);
                        $('#btn-find').prop('disabled', false);
                        $('.col-2').prop('disabled', false);

                        $('#btn-find').click();
                    },
                    error: function() {
                        console.log(response);
                    }
                });
            }
        }
    });

    $('#select-group').on('change', function() {
		$('#btn-find').click();
	});
</script>