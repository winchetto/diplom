<?php
session_start();
require_once ('connect.php');
header('Content-Type: text/html; charset=utf-8');
$counter = $_POST['counter'];
if($_SESSION['user']['id'] == ''){
    die();
}else {
    $check_post = mysqli_query($mysql,"SELECT * FROM `posts` WHERE `audio` = '$counter'");
    $res_check_post = mysqli_fetch_array($check_post);
    $author = $res_check_post['author'];

    $check_downloads = mysqli_query($mysql, "SELECT * FROM `downloads` WHERE `user` = '{$_SESSION['user']['id']}' AND `audio` = '$counter'");
    if (mysqli_num_rows($check_downloads) > 0) {
        die();
    } else {
        $sql = mysqli_query($mysql, "UPDATE `posts` SET `downloads` = `downloads` + 1 WHERE `audio` = '$counter'");
        $downl_insert = mysqli_query($mysql, "INSERT INTO `downloads`(`id`, `user`, `audio`) VALUES (NULL, '{$_SESSION['user']['id']}', '$counter')");
        $res_check_rating = mysqli_query($mysql,"UPDATE `rating` SET `downloads` = `downloads` + 1 WHERE `author` = '$author'");
    }
}
?>