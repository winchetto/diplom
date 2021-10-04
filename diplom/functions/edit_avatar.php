<?php
session_start();
require_once 'connect.php';

$path = 'avatars/'.time().$_FILES['new_avatar']['name'];
move_uploaded_file($_FILES['new_avatar']['tmp_name'],'../'.$path);

if($_SESSION['user']['id'] == ''){
    die();
}else {

    $problem_fields = [];

    if (!$_FILES['new_avatar']) {
        $problem_fields[] = 'new_avatar';
    }

    if (!empty($problem_fields)) {
        $response = [
            "status" => false,
            "type" => 1,
            "error" => "Заполните все поля!",
            "fields" => $problem_fields
        ];
        echo json_encode($response);
        die();
    }

    if (!move_uploaded_file($_FILES['new_avatar']['tmp_name'], '../' . $path)) {
        if (!empty($problem_fields)) {
            $response = [
                "status" => false,
                "type" => 2,
                "error" => "Ошибка загрузки аватарки",
            ];
            echo json_encode($response);
            die();
        }
        mysqli_query($mysql, "UPDATE `users` SET `avatar` = '$path' WHERE `id` = '{$_SESSION['user']['id']}'");

        $check = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");
        $result = mysqli_fetch_array($check);
        $new_avatar = $result['avatar'];
        $_SESSION['user']['avatar'] = $new_avatar;

        $response = [
            "status" => true,
            "error" => "Готово!",
            //"fields" => $problem_fields
        ];
        echo json_encode($response);
    }
}
session_write_close();
?>