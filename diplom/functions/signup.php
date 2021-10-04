<?php
session_start();
require_once 'connect.php';

$username = $_POST['username'];
$lastname = $_POST['lastname'];
$nickname = $_POST['nickname'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$repeat_pass = $_POST['repeat_pass'];

$check_nickname = mysqli_query($mysql,"SELECT * FROM `users` WHERE `nickname` = '$nickname'");
if (mysqli_num_rows($check_nickname) > 0){
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

if($username === ''){
  $problem_fields[] = 'username';
}

if($lastname === ''){
  $problem_fields[] = 'lastname';
}

if($nickname === ''){
  $problem_fields[] = 'nickname';
}

if($mail === '' || !filter_var($mail, FILTER_VALIDATE_EMAIL)){
  $problem_fields[] = 'mail';
}

if($password === ''){
  $problem_fields[] = 'password';
}

if($repeat_pass === ''){
  $problem_fields[] = 'repeat_pass';
}

if(!$_FILES['avatar']){
  $problem_fields[] = 'avatar';
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

if ($password === $repeat_pass){
$path = 'avatars/'.time().$_FILES['avatar']['name'];
move_uploaded_file($_FILES['avatar']['tmp_name'],'../'.$path);
if(!move_uploaded_file($_FILES['avatar']['tmp_name'],'../'.$path)){
  if(!empty($problem_fields)){
    $response = [
      "status" => false,
      "type" => 2,
      "error" => "Ошибка загрузки аватарки",
      //"fields" => $problem_fields
    ];
    echo json_encode($response);
    die();
  }
}
$password = md5($password);

mysqli_query($mysql, "INSERT INTO `users` (`id`, `mail`, `username`, `lastname`, `nickname`, `password`, `avatar`, `admin`) VALUES (NULL, '$mail', '$username', '$lastname', '$nickname', '$password', '$path', '0')");

$response = [
  "status" => true,

  "error" => "Регистрация успешна",
  //"fields" => $problem_fields
];
echo json_encode($response);

//$_SESSION['message'] = 'Регистрация успешна';
//header('location: ../auth.php');
}else{
  $response = [
    "status" => false,

    "error" => "Пароли не совпали",
    //"fields" => $problem_fields
  ];
  echo json_encode($response);
  //die();

  //$_SESSION['message'] = 'Пароли не совпали';
  //header('location: ../reg.php');

}
?>
