<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';

$post = $_POST['post'];
$comment = $_POST['comment'];
$data = date("d.m.y - H:i");

if($_SESSION['user']['id'] == ''){
    die();
}else {
    $problem_fields = [];

    if ($mess === '') {
        $problem_fields[] = 'comment';
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

    mysqli_query($mysql, "INSERT INTO `comments` (`author`,`comment`,`post`,`data`) VALUE ('{$_SESSION['user']['id']}','$comment','$post','$data')");

    $response = [
        "status" => true,
        "error" => "написали",
    ];
    echo json_encode($response);
}
?>