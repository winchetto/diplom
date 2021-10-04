<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if($_SESSION['user']){
  header('Location: main.php');
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" href="styles/index.css">
      <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
  </head>
  <body>

    <header>
      <div class="container header-info">
        <a href="#" class="logo">
            <img src="picters/logo2.png" style="width: 120px; max-height: 60px;">
        </a>

        <div class="leftbar">
          <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <button type="button" name="btn_log" class="btn_log" onclick="window.location.href='auth.php'"><i class="fa fa-user" aria-hidden="true"></i> Войти</button>
        </div>
      </div>
    </header>

<section>
  <div class="container block-info">

    <h1>Приветствуем!</h1>

    <p>Добро пожаловать в семью SoundPark! Здесь мы поможем тебе в твоих начинаниях музыкального композитора. Тебя встретят работы таких же творческих личностей, желающих проявить себя и обрести имя. Слушай, используй работы в своих проектах, знакомься, общайся, делись своими наработками, почувствуй свободу в творчестве! Или же ты музыкальный продюссер или музыкант, которому нужны таланты? Тогда тебе тоже к нам.<a href="reg.php" class="todev"> Зарегистрируйся</a> и стань членом нашей семьи!</p>
    <br>
    <p>
        Как это работает? Трудись, публикуй свои работы, зарабатывай лайки и скачивания, попадай в топы сайта, и тебя заметят. Все в твоих руках! Будь честным, не выдавай чужие работы за свои. В нашей семье такое не любят и за такое наказывают. И не забывай оценивать работы, которые тебе понравились. Тебе не сложно - автору приятно! Мы сделали все, чтобы тебе здесь было удобно и просто. Так что откинься в кресле поудобнее, расслабься и пробуй! «Отказаться от риска – значит отказаться от творчества» – Александр Пушкин. Данный прототип web-сервиса был разработан в качестве дипломной работы. Узнать информациию об разработчиках или звязаться с ними ты можешь, нажав
        <a href="develop.php" class="todev"> сюда</a>.</p>
    <br>
  </div>
</section>

<div style="height: 400px;"class=""></div>

<?php include("footer.php"); ?>

  </body>
</html>
