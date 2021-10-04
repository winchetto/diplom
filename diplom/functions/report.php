<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once 'connect.php';

$id_post = $_POST['id_post'];
$description = $_POST['description'];

if($_SESSION['user']['id'] == '') {
    die();
}else{
    $problem_fields = [];

    if ($description === '') {
        $problem_fields[] = 'description';
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

    $insert_report = mysqli_query($mysql,"INSERT INTO `reportss`(`author`, `id_post`, `description`) VALUES ('{$_SESSION['user']['id']}', '$id_post', '$description')");

    $response = [
        "status" => true,
        "error" => "написали",
    ];
    echo json_encode($response);
}
?>