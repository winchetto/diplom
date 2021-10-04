<?php
session_start();
require_once ('connect.php');
header('Content-Type: text/html; charset=utf-8');
$counter_l = $_POST['counter_l'];

if($_SESSION['user']['id'] == ''){
    die();
}else{

    $check_post = mysqli_query($mysql,"SELECT * FROM `posts` WHERE `audio` = '$counter_l'");
    $res_check_post = mysqli_fetch_array($check_post);
    $author = $res_check_post['author'];

    $check_likes = mysqli_query($mysql,"SELECT * FROM `likes` WHERE `user` = '{$_SESSION['user']['id']}' AND `audio` = '$counter_l'");
    if (mysqli_num_rows($check_likes) > 0){
        $res_check_rating = mysqli_query($mysql,"UPDATE `rating` SET `likes` = `likes` - 1 WHERE `author` = '$author'");
        $update_posts = mysqli_query($mysql,"UPDATE `posts` SET `likes` = `likes` - 1 WHERE `audio` = '$counter_l'");
        $delete_likes = mysqli_query($mysql,"DELETE FROM `likes` WHERE `user` = '{$_SESSION['user']['id']}' AND `audio` = '$counter_l'");
    }else{
        $sql = mysqli_query($mysql,"UPDATE `posts` SET `likes` = `likes` + 1 WHERE `audio` = '$counter_l'");
        $like_insert = mysqli_query($mysql,"INSERT INTO `likes`(`id`, `user`, `audio`) VALUES (NULL, '{$_SESSION['user']['id']}', '$counter_l')");
        $res_check_rating = mysqli_query($mysql,"UPDATE `rating` SET `likes` = `likes` + 1 WHERE `author` = '$author'");
    }

}
?>