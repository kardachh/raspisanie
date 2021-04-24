<?php
    $options=array(
        "status"=>1,
        "err"=>$_POST['number_day'],
        );
    echo json_encode($options);