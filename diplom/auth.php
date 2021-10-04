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
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css">
      <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
  </head>
  <body>

    <div class="reg_box">
      <h1>Вход</h1>

      <form>

        <div class="textbox">
          <i class="fa fa-user" aria-hidden="true"></i>
          <input type="text" placeholder="Введите логин" name="nickname" id="nickname" autocomplete="off" onkeypress="noDigits2(event)">
        </div>

        <div class="textbox">
          <i class="fa fa-lock" aria-hidden="true"></i>
          <input type="password" placeholder="Введите пароль" name="password" id="password" autocomplete="off" onkeypress="noDigits2(event)">
        </div>

        <button class="log-btn" type="submit">Let's Go</button>
        <p>Вы не зарегистрированы? Давайте это исправим! <a href="/reg.php">Зарегистрироваться</a></p>
        <p class="errors no-display"></p>

      </form>

    </div>

    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/script.js"></script>
  </body>
</html>
