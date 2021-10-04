<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';
$usernickname = $_POST['usernickname'];

if($_SESSION['user']['id'] == ''){
  die();
}else {

  $check_nickname = mysqli_query($mysql, "SELECT * FROM `users` WHERE `nickname` = '$usernickname'");
  if (mysqli_num_rows($check_nickname) > 0) {
    $response = [
        "status" => false,
        "type" => 1,
        "error" => "Этот никнейм занят",
        "fields" => ['nickname']
    ];
    echo json_encode($response);
    die();
  }


  $problem_fields = [];

  if ($usernickname === '') {
    $problem_fields[] = 'usernickname';
  }

  if (!empty($problem_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "error" => "Некорректная почта!",
        "fields" => $problem_fields
    ];
    echo json_encode($response);
    die();
  }

  mysqli_query($mysql, "UPDATE `users` SET `nickname` = '$usernickname' WHERE `id` = '{$_SESSION['user']['id']}'");

  $check = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");
  $result = mysqli_fetch_array($check);
  $new_nickname = $result['nickname'];
  $_SESSION['user']['nickname'] = $new_nickname;
}
session_write_close();
?>
