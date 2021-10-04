<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$newpassword_2 = $_POST['newpassword_2'];

if($_SESSION['user']['id'] == ''){
    die();
}else {

    $problem_fields = [];

    if ($oldpassword === '') {
        $problem_fields[] = 'oldpassword';
    }
    if ($newpassword === '') {
        $problem_fields[] = 'newpassword';
    }
    if ($newpassword_2 === '') {
        $problem_fields[] = 'newpassword_2';
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

    $oldpassword = md5($oldpassword);
    $newpassword = md5($newpassword);
    $newpassword_2 = md5($newpassword_2);

    $check_me = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}' AND `password` = '$oldpassword'");

    if (mysqli_num_rows($check_me) > 0) {

        if ($newpassword === $newpassword_2) {
            mysqli_query($mysql, "UPDATE `users` SET `password` = '$newpassword' WHERE `id` = '{$_SESSION['user']['id']}'");
            unset($_SESSION['user']);
            $response = [
                "status" => true,
                "error" => "Готово!"
            ];
        } else {
            $response = [
                "status" => false,
                "error" => "Пароли не совпадают!"
            ];
        }
        echo json_encode($response);
    } else {
        $response = [
            "status" => false,
            "error" => "Cтарый пароль неверен!"
        ];
        echo json_encode($response);
    }
}
session_write_close();
?>