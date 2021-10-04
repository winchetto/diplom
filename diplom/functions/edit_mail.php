<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';
$usermail = $_POST['usermail'];

if($_SESSION['user']['id'] == ''){
  die();
}else {

  $problem_fields = [];

  if ($usermail === '' || !filter_var($usermail, FILTER_VALIDATE_EMAIL)) {
    $problem_fields[] = 'usermail';
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

  mysqli_query($mysql, "UPDATE `users` SET `mail` = '$usermail' WHERE `id` = '{$_SESSION['user']['id']}'");

  $check = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");
  $result = mysqli_fetch_array($check);
  $new_mail = $result['mail'];
  $_SESSION['user']['mail'] = $new_mail;
  session_write_close();
}
?>
