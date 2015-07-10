<?php

$arr['result'] = false;

if (@$_FILES['file']) {

    $arr['name'] = $_FILES['file']['name'];
    $arr['type'] = $_FILES['file']['type'];
    $arr['tmp_name'] = $_FILES['file'] ['tmp_name'];
    $arr['time'] = time();

    $newName = 'U/' . $arr['time'] . '_' . $arr['name'];

    move_uploaded_file($_FILES["file"]["tmp_name"], $newName);
    $arr['url'] = $newName;
    $arr['result'] = true;
}


echo json_encode($arr);

