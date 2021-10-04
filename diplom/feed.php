<?php

session_start();
require_once 'functions/connect.php';
header('Content-Type: text/html; charset=utf-8');

if(!$_SESSION['user']){
    header('Location: /');
};

$show_acconts = mysqli_query ($mysql, "SELECT * FROM `users`");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Новости</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
    <script>
        function PopUpHide(){$("#popur_comm").fadeOut(500);}
    </script>
</head>
<body>

<?php include("header.php"); ?>

<section>
    <div class="container header-info2" style="background: #111112; margin-top: 15px; margin-bottom: 20px; border-radius: 5px; opacity: 0.9">
        <p id="h1_feed" style="color: white; border-bottom: 1px solid #2dbda2; font-size: 16px; padding-bottom: 2px;font-family: 'Ubuntu', sans-serif;">Новости:</p>
        <div class="leftbar">
            <button type="button" name="btn_log" class="btn_log" onclick="window.location.href='rating.php'"><i class="fa fa-bar-chart" aria-hidden="true"></i> Рейтинг</button>
        </div>
    </div>
    <!--  <div class="container main-info4" style="border: 1px solid #d957ce; align-items: center; justify-content: center; margin-top: 20px; margin-bottom: 20px;">

          <a href=""><p style="color: white; border-right: 1px solid #d957ce; padding-right: 10px;">лайки <i class="fa fa-heart" aria-hidden="true"></i></p></a>
        <a href=""><p style="color: white; margin-left: 10px;"><i class="fa fa-angle-double-down" aria-hidden="true"></i> скачивания</p></a>
    </div>-->

    <?php
    $show_news = mysqli_query($mysql,"SELECT * FROM `posts` ORDER BY `id` DESC");
    while ($res_show_news = mysqli_fetch_array($show_news)){
        $id = $res_show_news['id'];
        $author = $res_show_news['author'];
        $name = $res_show_news['name'];
        $data = $res_show_news['data'];
        $audio = $res_show_news['audio'];
        $description = $res_show_news['description'];
        $downloads = $res_show_news['downloads'];
        $likes = $res_show_news['likes'];
        $select_author_post = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author'");
        while ($result = mysqli_fetch_array($select_author_post)){
            $id_a = $result['id'];
            $nick_a = $result['nickname'];
            $ava_a = $result['avatar'];

            ?>


            <div id="popur_comm">
                <div class="new_mess_tittle">

                    <div class="tittle_right">
                        <a href="javascript:PopUpHide()"><i class="fa fa-times" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="select_comm"style="height: 610px;">
                    <?php
                    $show_comm = mysqli_query($mysql,"SELECT * FROM `comments` WHERE `post` = '{$res_show_news['id']}'ORDER BY `id` ASC");
                    while ($res_comm = mysqli_fetch_array($show_comm)) {
                        $id_comm = $res_comm['id'];
                        $author_comm = $res_comm['author'];
                        $comm = $res_comm['comment'];
                        $post_comm = $res_comm['post'];
                        $data_comm = $res_comm['data'];

                        $show_user = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author_comm'");
                        while ($res_user =  mysqli_fetch_array($show_user)){
                            $nickname = $res_user['nickname'];
                            $avatar = $res_user['avatar'];
                            ?>
                            <div class="act">
                                <div class="inlin_act_comm">
                                    <img src="<?=$res_user['avatar'];?>" style="border-radius: 50px; width: 50px; height: 50px; ">
                                </div>
                                <div class="inlin_act_comm">
                                    <p style="color: #d957ce"><?=$nickname?> &emsp; <?=$data_comm?></p><p><?=$comm?></p>
                                </div>
                            </div>
                            <?php
                        }

                    }
                    ?>
                </div>

                <form id="ff">
                    <div class="elem_send_comm">
                        <input type="hidden" id="post" name="post" value="<?=$id?>">
                        <textarea class="textarea" name="comment" id="comment" rows="1" cols="80" placeholder="Напишите комментарий..."></textarea>
                    </div>
                    <button class="send_2" name="send_2" id="send_2" type="submit">Отправить</button>
                </form>
            </div>

            <div class="container main-info2" style="padding-top: 10px; padding-bottom: 30px;">

                <div class="wrap">
                    <img src="<?=$ava_a?>" style="width: 200px; max-height: 200px; margin-left: 20px;">
                    <div class="hh">
                        <h2 style="color: white; border-bottom: 3px solid #d957ce; padding-bottom: 7px; width: 50px; margin-top: 0;text-transform: uppercase;"><?=$name?></h2>
                        <p><?=$data?></p>
                    </div>
                    <div class="hh">
                        <a href="main0.php?id=<?=$result['id']?>" style="border-bottom: none;color: #2dbda2;"><?=$nick_a?></a>
                        <p style="color:white; max-width: 500px;/*flex-basis: 100%;*/"><?=$description?></p>
                        <audio id="player" style="margin-bottom: 20px; width: 350px; margin-top:  20px;" src="<?=$audio?>" controls controlsList="nodownload"></audio>
                    </div>
                </div>
                <br>
                <a class="counter" href="<?=$audio?>" download style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Скачать &emsp;<i class="fa fa-angle-double-down" aria-hidden="true"></i> <?=$downloads?></a>
                <a class="counter_l" href="<?=$audio?>" style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Like &emsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$likes?></a>
                <a class="counter_c" id="btn_comm" style="cursor: pointer;margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Комментарии &emsp;<i class="fa fa-commenting" aria-hidden="true"></i></a>
                <?php
                if ($_SESSION['user']['nickname'] === $nick_a){
                    ?>
                    <a class="delete_p" href="<?=$audio?>" style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Удалить &emsp;<i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php
                }
                else{
                    ?>
                    <a class="counter_r" href="page_report.php?id=<?=$res_show_news['id'];?>" style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Репорт &emsp;<i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/comments.js"></script>
    <script src="scripts/download.js"></script>
    <script src="scripts/like.js"></script>
    <script src="scripts/delete_p.js"></script>
    <script>
        const audios = Array.from(document.querySelectorAll('audio'));
        let playing = true;

        audios.forEach(audio => {
            audio.addEventListener('play', function() {
                if (playing) {
                    audios.forEach(el => {
                        el.pause();
                    });
                }
                if (this.paused) {
                    playing = false;
                    this.play();
                } else {
                    playing = true;
                }
            });
        });
    </script>
</section>

<div style="height: 800px;"class=""></div>

<?php include("footer.php"); ?>

</body>
</html>