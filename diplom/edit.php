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
    <title>Настройки</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">

    <script>
        function PopUpHide(){
            $("#popur_messages").fadeOut(500);
            $("#hover").fadeOut(500);
        }
    </script>
</head>
<body>

<?php include("header.php"); ?>


<div id="hover"></div>

<div id="popur_messages">

    <div class="new_mess_tittle">
        <div class="tittle_left">
            <p>Новая аватарка</p>
        </div>
        <div class="tittle_right">
            <a href="javascript:PopUpHide()"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
    </div>
    <form id="ff">
        <div class="elem_send">
            <input type="file" style="margin-top: 100px; margin-bottom: 20px;" class="audio" name="new_avatar">
        </div>
        <button class="send" name="send" id="send" type="submit" style="margin-left: 170px;">Добавить</button>
    </form>
</div>


<section>
    <div class="container main-info">
        <h1 style="margin-left: 35px; margin-right: 150px">Редактирование</h1>

        <div class="wrap">
            <div class="hh">
                <img src="<?= $_SESSION['user']['avatar']?> " style="width: 200px; max-height: 200px;">
                <br>
                <button type="button" name="btn_message" id="btn_message" class="btn_message"><i class="fa fa-upload" aria-hidden="true"></i> Загрузить</button>
                <p class="errors5 no-display"></p>
                <br>
            </div>

            <div class="hh2">

                <p class="heading_edit">Имя</p>
                <form class="edit_1">
                    <b>Изменить имя:</b><input type="text" name="username" value="<?=$_SESSION['user']['username']?>" onkeypress="noDigits(event)">
                    <p class="heading_edit">Фамилия</p>
                    <b>Изменить фамилию:</b><input type="text" name="userlastname" value="<?=$_SESSION['user']['lastname']?>" onkeypress="noDigits(event)">
                    <button class="send_2" name="send_2" id="send_2" type="submit">Изменить</button>
                    <p class="errors1 no-display"></p>
                </form>

                <p class="heading_edit">Никнейм</p>
                <form class="edit_1">
                    <b>Изменить никнейм:</b><input type="text" name="usernickname" value="<?=$_SESSION['user']['nickname']?>" onkeypress="noDigits2(event)">
                    <button class="send_4" name="send_4" id="send_4" type="submit">Изменить</button>
                    <p class="errors3 no-display"></p>
                </form>

                <p class="heading_edit">Почта</p>
                <form class="edit_1">
                    <b>Изменить почту:</b><input type="text" name="usermail" value="<?=$_SESSION['user']['mail']?>" onkeypress="noDigits3(event)">
                    <button class="send_5" name="send_5" id="send_5" type="submit">Изменить</button>
                    <p class="errors2 no-display"></p>
                </form>

                <p class="heading_edit">Пароль</p>
                <form class="edit_1">
                    <b>Старый пароль:</b><input name="oldpassword" type="password" onkeypress="noDigits2(event)">
                    <br>
                    <b>Новый пароль:</b><input name="newpassword" type="password" onkeypress="noDigits2(event)">
                    <br>
                    <b>Повторить пароль:</b><input name="newpassword_2" type="password" onkeypress="noDigits2(event)">
                    <br>
                    <p style="font-size: 12px; color: #2dbda2;;">*после смены пароля Вам придется перезайти в аккаунт</p>
                    <button class="send_6" name="send_6" id="send_6" type="send_6">Изменить</button>
                    <p class="errors4 no-display"></p>
                </form>

            </div>

        </div>
    </div>
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/edit_profile.js"></script>
</section>

<div style="height: 400px;"class=""></div>

<?php include("footer.php"); ?>

</body>
</html>
