<?php
session_start();
require_once 'functions/connect.php';
header('Content-Type: text/html; charset=utf-8');
if($_SESSION['user']['admin'] == '0' || !$_SESSION['user']){
    header('Location: /');
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
</head>
<body>

<?php include("header.php"); ?>

<section>
    <div class="container main-info">
        <div class="wrap">
            <div class="hh">
                <h1 style="font-size: 35px; margin-bottom: 50px;">Панель администратора</h1>
            </div>
        </div>
    </div>
    <?php
    $select_reports = mysqli_query($mysql,"SELECT * FROM `reportss`ORDER BY `id` DESC");
    while ($result_reports = mysqli_fetch_array($select_reports)){
        $id_report = $result_reports['id'];
        $author_report = $result_reports['author'];
        $id_post = $result_reports['id_post'];
        $desc = $result_reports['description'];
        $select_post = mysqli_query($mysql,"SELECT * FROM `posts` WHERE `id` = '$id_post'");
        while ($result_post = mysqli_fetch_array($select_post)){
            $id_p = $result_post['id'];
            $author_p = $result_post['author'];
            $name_p = $result_post['name'];
            $data_p = $result_post['data'];
            $audio_p = $result_post['audio'];
            $desc_p = $result_post['description'];
            $down_p = $result_post['downloads'];
            $lks_p = $result_post['likes'];
            $select_user = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author_p'");
            while ($result_users = mysqli_fetch_array($select_user)){
                $nickname = $result_users['nickname'];
                $avatar = $result_users['avatar'];
                $select_author_rep = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author_report'");
                while ($result_auth_rep = mysqli_fetch_array($select_author_rep)){
                    $nickname_rep = $result_auth_rep['nickname'];
                }
            }
        }
        ?>
        <div class="container main-info" style="padding-top: 10px; padding-bottom: 30px;">

            <div class="wrap">
                <img src="<?=$avatar?>" style="width: 200px; max-height: 200px; margin-left: 20px;">
                <div class="hh">
                    <h2 style="color: white; border-bottom: 3px solid #d957ce; padding-bottom: 7px; width: 50px; margin-top: 0;text-transform: uppercase;"><?=$name_p?></h2>
                    <p><?=$data_p?></p>
                    <a class="delete_p" href="<?=$audio_p?>" style="margin-left: auto; margin-left: 0px;color: white; text-decoration: none; border: 3px solid #2dbda2; padding: 5px 7px; border-radius: 3px;">Приговорить &emsp;<i class="fa fa-gavel" aria-hidden="true"></i></a>
                </div>
                <div class="hh">
                    <a href="main0.php?id=<?=$author_p?>" style="border-bottom: none;color: #2dbda2;"><?=$nickname?></a>
                    <p style="color:white; max-width: 500px;/*flex-basis: 100%;*/"><?=$desc_p?></p>
                    <audio id="player" style="margin-bottom: 20px; width: 350px; margin-top:  20px;" src="<?=$audio_p?>" controls controlsList="nodownload"></audio>
                    <p><b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Причина жалобы: </b><?=$desc?>&emsp;(<a href="main0.php?id=<?=$author_report?>" style="border-bottom: none;color: #2dbda2;"><?=$nickname_rep?></a>)</p>

                </div>

            </div>

        </div>
        <?php
    }
    ?>
    <script src="scripts/jquery-3.4.1.min.js"></script>
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