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
    <title>Люди</title>
    <link rel="stylesheet" href="styles/index.css">
      <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
  </head>
  <body>

<?php include("header.php"); ?>

<section>
<?php while ($result = mysqli_fetch_array($show_acconts)){
  //echo $result['nickname'];
  //var_dump ($result['id']);
  ?>

  <div class="container main-info2"><div class="acc"><a href="main0.php?id=<?=$result['id']?>"><img src="<?=$result['avatar']?>"><?=$result['nickname']?></a></div></div>

  <?php
}
   ?>
</section>

<div style="height: 800px;"class=""></div>

<?php include("footer.php"); ?>

  </body>
</html>
