<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';
    $poluchatel = $_POST['poluchatel'];
    $textarea = $_POST['textarea'];
    $data = date("d.m.y - H:i");

  if (!mysqli_ping($mysql)) {
      echo 'Соединение потеряно, выходим после запроса #1';
      exit;
  }
if($_SESSION['user']['id'] == ''){
    die();
}else {

    $problem_fields = [];

    if ($mess === '') {
        $problem_fields[] = 'username';
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
    mysqli_query($mysql, "INSERT INTO `dialog` (`author`, `poluchatel`, `mess`, `data`) VALUES ('{$_SESSION['user']['id']}', '$poluchatel', '$textarea', '$data')");
    $check_mess = mysqli_query($mysql, "SELECT * FROM `messages` WHERE `author` = '{$_SESSION['user']['id']}' AND `poluchatel` = '$poluchatel'");
    $result_check_mess = mysqli_fetch_array($check_mess);

    if ($result_check_mess['id'] == '') {
        mysqli_query($mysql, "INSERT INTO `messages` (`author`, `poluchatel`, `mess`, `data`, `reading`) VALUES ('{$_SESSION['user']['id']}', '$poluchatel', '$textarea', '$data', '0')");

    } else {
        mysqli_query($mysql, "UPDATE `messages` SET `mess` = '$textarea',`data` = '$data', `reading` = '0' WHERE `poluchatel` = '$poluchatel'");
    }
    $response = [
        "status" => true,
        "error" => "написали",
    ];
    echo json_encode($response);
}
?>

