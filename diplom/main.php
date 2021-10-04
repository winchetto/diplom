<?php
session_start();
require_once ('functions/connect.php');
header('Content-Type: text/html; charset=utf-8');
if(!$_SESSION['user']){
    header('Location: /');
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <meta charset="utf-8">
    <title>Profile <?= $_SESSION['user']['nickname']?></title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
    <script>
        function PopUpHide(){$("#popur_comm").fadeOut(500);}
    </script>
</head>
<body>

<?php include("header.php"); ?>

<section>
    <div class="container main-info">
        <div class="wrap">
            <img src="<?= $_SESSION['user']['avatar']?>" style="width: 200px; max-height: 200px;">
            <div class="hh">

                <h1><?= $_SESSION['user']['nickname']?></h1>
                <p><b>ФИО: </b><?= $_SESSION['user']['username'].' '.$_SESSION['user']['lastname']?></p>
                <p><b>Почта: </b><?= $_SESSION['user']['mail']?></p>
            </div>
            <div class="hh">
                <?php
                if($_SESSION['user']['admin'] == '1'){
                    ?>
                    <p><b>Admin</b></p>
                    <button class="btn_in_post" onclick="window.location.href='admin_panel.php'" style="width: 45px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></button>
                    <?php
                };
                ?>
            </div>
        </div>
        <button class="btn_in_post" onclick="window.location.href='drop_post.php'"><i class="fa fa-plus" aria-hidden="true"></i> Новый пост</button>
    </div>
    <?php
    $show_news = mysqli_query($mysql,"SELECT * FROM `posts` WHERE `author` = '{$_SESSION['user']['id']}'ORDER BY `id` DESC");
    while ($res_show_news = mysqli_fetch_array($show_news)){
        $id = $res_show_news['id'];
        $name = $res_show_news['name'];
        $data = $res_show_news['data'];
        $audio = $res_show_news['audio'];
        $description = $res_show_news['description'];
        $downloads = $res_show_news['downloads'];
        $likes = $res_show_news['likes'];
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
            <h2 style="color: white; border-bottom: 3px solid #d957ce; padding-bottom: 7px; width: 50px; margin-left: 20px;text-transform: uppercase;"><?=$name ?></h2>
            <p style="margin-left: 20px"><?=$data?></p>
            <p style="color:white; margin-left: 20px;/*flex-basis: 100%;*/ max-width: 500px;"><?=$description?></p>
            <audio style="margin-left: 20px; margin-bottom: 20px; width: 350px;" src="<?=$audio?>" controls controlsList="nodownload"></audio>
            <br>
            <a class="counter" href="<?=$audio?>" download style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Скачать &emsp;<i class="fa fa-angle-double-down" aria-hidden="true"></i> <?=$downloads?></a>
            <a class="counter_l" href="<?=$audio?>" style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Like &emsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$likes?></a>

            <a class="counter_c" id="btn_comm" style="cursor: pointer;margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Комментарии &emsp;<i class="fa fa-commenting" aria-hidden="true"></i> </a>
            <?php
            if ($_SESSION['user']){
                ?>
                <a class="delete_p" href="<?=$audio?>" style="margin-left: auto; margin-left: 20px;color: white; text-decoration: none; border-bottom: 3px solid #2dbda2; padding-bottom: 5px;">Удалить &emsp;<i class="fa fa-trash" aria-hidden="true"></i></a>
                <?php
            }
            ?>
        </div>
        <?php
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
