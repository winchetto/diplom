<?php
session_start();
require_once ('connect.php');
header('Content-Type: text/html; charset=utf-8');

if($_SESSION['user']['id'] == ''){
    die();
}else{
    $delete_post = $_POST['delete_post'];
    if ($_SESSION['user']){
        $check_post = mysqli_query($mysql, "SELECT * FROM `posts` WHERE `audio` = '$delete_post'");
        $result_check_posts = mysqli_fetch_array($check_post);

        $id_post = $result_check_posts['id'];
        $likes = $result_check_posts['likes'];
        $downloads = $result_check_posts['downloads'];
        $author = $result_check_posts['author'];

        $delete_pst = mysqli_query($mysql, "DELETE FROM `posts` WHERE `audio` = '$delete_post'");
        $delete_dwn = mysqli_query($mysql, "DELETE FROM `downloads` WHERE `audio` = '$delete_post'");
        $delete_lks = mysqli_query($mysql, "DELETE FROM `likes` WHERE `audio` = '$delete_post'");
        $delete_comm = mysqli_query($mysql, "DELETE FROM `comments` WHERE `post` = '$id_post'");

        $upt_rat_lik = mysqli_query($mysql,"UPDATE `rating` SET `likes` = `likes` - '$likes' WHERE `author` = '$author'");
        $upt_rat_down = mysqli_query($mysql,"UPDATE `rating` SET `downloads` = `downloads` - '$downloads' WHERE `author` = '$author'");

        $check_rep_post = mysqli_query($mysql, "SELECT * FROM `reportss` WHERE `id_post` = '$id_post'");
        if (mysqli_num_rows($check_rep_post) > 0){
            $delete_from_reports = mysqli_query($mysql,"DELETE FROM `reportss` WHERE `id_post` = '$id_post'");
        }
        $path = $_SERVER['DOCUMENT_ROOT'] . $delete_post;
        unlink($path);
    }else{
        die();
    }
}
?>