<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';
$username = $_POST['username'];
$userlastname = $_POST['userlastname'];

if($_SESSION['user']['id'] == ''){
  die();
}else {

  $problem_fields = [];

  if ($username === '') {
    $problem_fields[] = 'username';
  }

  if ($userlastname === '') {
    $problem_fields[] = 'userlastname';
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

  mysqli_query($mysql, "UPDATE `users` SET `username` = '$username', `lastname` = '$userlastname' WHERE `id` = '{$_SESSION['user']['id']}'");

  $check = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");
  $result = mysqli_fetch_array($check);
  $new_name = $result['username'];
  $new_lname = $result['lastname'];
  $_SESSION['user']['username'] = $new_name;
  $_SESSION['user']['lastname'] = $new_lname;
  $response = [
      "status" => true,
      "error" => "Готово!"
  ];
}
session_write_close();
?>
