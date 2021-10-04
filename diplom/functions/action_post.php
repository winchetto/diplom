<?php
session_start();
require_once 'connect.php';
header('Content-Type: text/html; charset=utf-8');
if($_SESSION['user']['id'] == ''){
    die();
}else {

    $name_post = $_POST['name_post'];
    $description = $_POST['description'];
    $data = date("d.m.y - H:i");
    $author = $_SESSION['user']['id'];
    $path = 'music/' . time() . $_FILES['audio']['name'];
    move_uploaded_file($_FILES['audio']['tmp_name'], '../' . $path);

    $problem_fields = [];

    if ($name_post === '') {
        $problem_fields[] = 'name_post';
    }

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

    mysqli_query($mysql, "INSERT INTO `posts` (`id`, `author`, `name`, `data`, `audio`, `description`,`downloads`, `likes`) VALUES (NULL, '$author', '$name_post', '$data', '$path', '$description','0', '0')");

    $check_rating = mysqli_query($mysql, "SELECT * FROM `rating` WHERE `author` = '{$_SESSION['user']['id']}'");

    if (mysqli_num_rows($check_rating) == 0){
        mysqli_query($mysql,"INSERT INTO `rating` (`id`, `author`, `likes`, `downloads`) VALUES (NULL,'$author','0','0')");
    }

    $response = [
        "status" => true,
        "error" => "Отправили",
        //"fields" => $problem_fields
    ];
    echo json_encode($response);
}
?>