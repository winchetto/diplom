<?php
session_start();
if($_SESSION['user']){
  header('Location: main.php');
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/style.css">
      <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
  </head>
  <body>
    <div class="reg_box" id="reg_box">

      <h1>Регистрация</h1>

      <form>
        <div class="textbox">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
          <input type="text" placeholder="Имя" name="username" id="username" autocomplete="off" onkeypress="noDigits(event)">
        </div>

        <div class="textbox">
          <i class="fa fa-user-circle-o" aria-hidden="true"></i>
          <input type="text" placeholder="Фамилия" name="lastname" id="lastname" autocomplete="off" onkeypress="noDigits(event)">
        </div>

        <div class="textbox">
          <i class="fa fa-user" aria-hidden="true"></i>
          <input type="text" placeholder="Логин" name="nickname" id="nickname" autocomplete="off" onkeypress="noDigits2(event)">
        </div>

        <div class="textbox">
          <i class="fa fa-at" aria-hidden="true"></i>
          <input type="text" placeholder="Email" name="mail" id="mail" autocomplete="off"onkeypress="noDigits3(event)">
        </div>

        <div class="textbox">
          <i class="fa fa-lock" aria-hidden="true"></i>
          <input type="password" placeholder="Пароль" name="password" id="password" autocomplete="off" onkeypress="noDigits2(event)">
        </div>

        <div class="textbox">
          <i class="fa fa-lock" aria-hidden="true"></i>
          <input type="password" placeholder="Повторите пароль" name="repeat_pass" id="repeat_pass" autocomplete="off" onkeypress="noDigits2(event)">
        </div>

        <div class="textbox">
        <label for="avatar" class="custom-file-upload">
          <i class="fa fa-picture-o" aria-hidden="true"></i>
          <span>Добавить фото</span>
          <input type="file" class="avatar" name="avatar" id="avatar">
        </label>
        </div>

        <button class="reg-btn" name="reg-btn" type="submit">Let's Go</button>
        <!--<input class="reg_btn" type="button" name="reg_btn" value="Let's Go" >-->
          <p>Вы <a href="auth.php">зарегистрированы</a> и не знаете, как сюда попали?</p>

          <p class="errors no-display"></p>
      </form>

    </div>
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/script.js"></script>
  </body>
</html>
