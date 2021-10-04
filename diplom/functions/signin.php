<?php
session_start();
require_once 'connect.php';

$nickname = $_POST['nickname'];
$password = $_POST['password'];

$problem_fields = [];

if($nickname === ''){
  $problem_fields[] = 'nickname';
}
if($password === ''){
  $problem_fields[] = 'password';
}

if(!empty($problem_fields)){
  $response = [
    "status" => false,
    "type" => 1,
    "error" => "Заполните все поля!",
    "fields" => $problem_fields
  ];
  echo json_encode($response);
  die();
}

$password = md5($password);

$check_me = mysqli_query($mysql,"SELECT * FROM `users` WHERE `nickname` = '$nickname' AND `password` = '$password'");

if(mysqli_num_rows($check_me) > 0){

$user = mysqli_fetch_assoc($check_me);

$_SESSION['user'] = [
  "id" => $user['id'],
  "username" => $user['username'],
  "lastname" => $user['lastname'],
  "nickname" => $user['nickname'],
  "mail" => $user['mail'],
  "avatar" => $user['avatar'],
  "admin" => $user['admin'],
];

$response = [
  "status" => true
];
//header('Location: ../main.php');
//echo 'авторизация успешна';
echo json_encode($response);

}else{
  $response = [
    "status" => false,
    "error" => "Логин или пароль неверны"
  ];
  //$_SESSION['message'] = 'Неверный логин или пароль';
  //header('location: ../auth.php');
  //echo 'ne procnulo';
  echo json_encode($response);
}
?>
