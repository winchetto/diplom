<?php
session_start();
require_once 'functions/connect.php';
header('Content-Type: text/html; charset=utf-8');
if(!$_SESSION['user']){
    header('Location: /');
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Рейтинг</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
</head>
<body>

<?php include("header.php"); ?>

<section>
    <div style=" background: #d957ce; margin-top: 35px;" class="container main-info4">
        <p style="color: #111112"><i class="fa fa-trophy" aria-hidden="true"></i>&emsp;Топ лайков</p>
    </div>
    <?php
    $select_rating = mysqli_query($mysql, "SELECT * FROM `rating` ORDER BY `likes` DESC LIMIT 10");
    $i = 0;
    while ($res_sel_rating = mysqli_fetch_array($select_rating)){
        $i = $i + 1;
        $id = $res_sel_rating['id'];
        $author_id = $res_sel_rating['author'];
        $likes = $res_sel_rating['likes'];
        $select_author = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '$author_id'");
        while ($res_sel_author = mysqli_fetch_array($select_author)){
            $id_author = $res_sel_author['id'];
            $nick = $res_sel_author['nickname'];
            $avatar = $res_sel_author['avatar'];
            ?>
            <a href="main0.php?id=<?=$id_author?>" style="text-decoration: none;"><div class="container main-info4" id="scale">
                <p style="color: #d957ce;"><?=$i?>.&emsp;<?=$nick?>&emsp;-&emsp;<?=$likes?>&emsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></p>
            </div></a>
            <?php
        }
    }
    ?>
    <div style=" background: #2dbda2; margin-top: 35px;" class="container main-info4">
        <p style="color: #111112"><i class="fa fa-trophy" aria-hidden="true"></i>&emsp;Топ скачиваний</p>
    </div>
    <?php
    $select_rating2 = mysqli_query($mysql, "SELECT * FROM `rating` ORDER BY `downloads` DESC LIMIT 10");
    $u = 0;
    while ($res_sel_rating2 = mysqli_fetch_array($select_rating2)){
        $u = $u + 1;
        $id2 = $res_sel_rating2['id'];
        $author_id2 = $res_sel_rating2['author'];
        $downloads2 = $res_sel_rating2['downloads'];
        $select_author2 = mysqli_query($mysql, "SELECT * FROM `users` WHERE `id` = '$author_id2'");
        while ($res_sel_author2 = mysqli_fetch_array($select_author2)){
            $id_author2 = $res_sel_author2['id'];
            $nick2 = $res_sel_author2['nickname'];
            $avatar2 = $res_sel_author2['avatar'];
            ?>
            <a href="main0.php?id=<?=$id_author2?>" style="text-decoration: none;"><div class="container main-info4" id="scale">
                <p style="color: #2dbda2"><?=$u?>.&emsp;<?=$nick2?>&emsp;-&emsp;<?=$downloads2?>&emsp;<i class="fa fa-angle-double-down" aria-hidden="true"></i></p>
            </div></a>
            <?php
        }
    }
    ?>

    <script src="scripts/jquery-3.4.1.min.js"></script>
</section>

<div style="height: 800px;"class=""></div>

<?php include("footer.php"); ?>

</body>
</html>