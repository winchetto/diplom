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
    <title>Сообщения</title>
    <link rel="stylesheet" href="styles/index.css">
      <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
      <script src="scripts/jquery-3.4.1.min.js"></script>
      <script src="scripts/messages.js"></script>
  </head>
  <body>

<?php include("header.php"); ?>

<section>
    <div class="container main-info3">

        <?php
        include ("users_mess.php");
        ?>

      <div class="messanger">

          <?php
          $act = $_GET['act'];
          switch ($act){
              default:
              case "vhod":
                  $vhod = $_GET['vhod'];
                  //$check_me = mysqli_query($mysql,"SELECT * FROM `users` WHERE `nickname` = '$nickname' AND `password` = '$password'");
                  $q = mysqli_query($mysql,"SELECT * FROM `messages` WHERE `poluchatel` = '{$_SESSION['user']['id']}' ORDER BY `data` DESC");
                  while ($r = mysqli_fetch_array($q)){
                      $id = $r['id'];
                      $author = $r['author'];
                      $poluchatel = $r['poluchatel'];
                      $mess = $r['mess'];
                      $data = $r['data'];
                      $reading = $r['reading'];
                      //echo $mess;
                      $q_1 = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author'");
                      while ($r_1 = mysqli_fetch_array($q_1)){
                          $id = $r_1['id'];
                          $nickname = $r_1['nickname'];
                          $avatar = $r_1['avatar'];
                          if($r['reading'] == 0 ){
                              ?>
                              <div class="act">
                                  <div class="inlin_act">
                                      <img src="<?=$r_1['avatar'] ?>"style="border-radius: 50px; width: 50px; height: 50px;">
                                  </div>
                                  <div class="inlin_act">
                                      <p id="nickname"><?php echo $r_1['nickname'] ?> &emsp; &emsp; <?php echo $r['data']; ?></p>
                                      <a style="text-decoration: none;" href="me.php?act=inbox&id=<?=$r_1['id'] ?>"><p style="color: #d957ce; font-size: 13px;"><?php echo $mess ?></p></a>
                                  </div>
                                  </div>
                              </div>
                              <?php
                          }else{
                        ?>
                          <div class="act">
                              <div class="inlin_act">
                                  <img src="<?=$r_1['avatar'] ?>"style="border-radius: 50px; width: 50px; height: 50px;">
                              </div>
                              <div class="inlin_act">
                                  <p id="nickname"><?php echo $r_1['nickname'] ?> &emsp; &emsp; <?php echo $r['data']; ?></p>
                                  <a style="color:white; text-decoration: none;" href="me.php?act=inbox&id=<?=$r_1['id'] ?>"><p style="font-size: 13px;"><?php echo $mess ?></p></a>
                              </div>

                          </div>
                        <?php
                          }
                      }
                  }
                  break;
              case "ishod":
                  $ishod = $_GET['ishod'];
                  $q_2 = mysqli_query($mysql,"SELECT * FROM `messages` WHERE `author` = '{$_SESSION['user']['id']}' ORDER BY `data` DESC");
                  while ($r_2 = mysqli_fetch_array($q_2)){
                      $id = $r_2['id'];
                      $author = $r_2['author'];
                      $poluchatel = $r_2['poluchatel'];
                      $mess = $r_2['mess'];
                      $mess = iconv('utf-8','windows-1251',$mess);
                      $mess = substr($mess, 0,64);
                      $mess = iconv('windows-1251','utf-8',$mess);
                      $data = $r_2['data'];
                      $reading = $r_2['reading'];
                      //echo $mess;
                      $q_3 = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$poluchatel'");
                      while ($r_3 = mysqli_fetch_array($q_3)){
                          $id = $r_3['id'];
                          $nickname = $r_3['nickname'];
                          $avatar = $r_3['avatar'];
                          if($r_2['reading'] == 0 ){
                              ?>
                              <div class="act"><div class="inlin_act">
                                      <img src="<?=$r_3['avatar'] ?>"style="border-radius: 50px; width: 50px; height: 50px;">
                                  </div>
                                  <div class="inlin_act">
                                      <p id="nickname"><?php echo $r_3['nickname'] ?> &emsp; &emsp; <?php echo $r_2['data']; ?></p>
                                      <p style="color: #d957ce;font-size: 13px;"><?php echo $mess ?></p>
                                  </div>

                              </div>
                              <?php
                          }else{
                              ?>
                              <div class="act">
                                  <div class="inlin_act">
                                      <img src="<?=$r_3['avatar'] ?>"style="border-radius: 50px; width: 50px; height: 50px;">
                                  </div>
                                  <div class="inlin_act">
                                      <p id="nickname"><?php echo $r_3['nickname'] ?> &emsp; &emsp; <?php echo $r_2['data']; ?></p>
                                      <p style="font-size: 13px;"><?php echo $mess ?></p>
                                  </div>

                                  </div>
                              </div>
                              <?php
                          }
                      }
                  }
                  break;
              case "read_1":
                  $read_1 = $_GET['read_1'];
                  $q_4 = mysqli_query($mysql,"SELECT * FROM `messages` WHERE `poluchatel` = '{$_SESSION['user']['id']}' AND `reading` = '1' ORDER BY `data` DESC");
                  while ($r_4 = mysqli_fetch_array($q_4)){
                      $id = $r_4['id'];
                      $author = $r_4['author'];
                      $poluchatel = $r_4['poluchatel'];
                      $mess = $r_4['mess'];
                      $mess = iconv('utf-8','windows-1251',$mess);
                      $mess = substr($mess, 0,64);
                      $mess = iconv('windows-1251','utf-8',$mess);
                      $data = $r_4['data'];
                      //echo $mess;
                      $q_5 = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author'");
                      while ($r_5 = mysqli_fetch_array($q_5)){
                          $id = $r_5['id'];
                          $nickname = $r_5['nickname'];
                          $avatar = $r_5['avatar'];
                          ?>
                          <div class="act">
                              <div class="inlin_act">
                                  <img src="<?=$r_5['avatar']; ?>"style="border-radius: 50px; width: 50px; height: 50px;">
                              </div>
                              <div class="inlin_act">
                                  <p id="nickname"><?php echo $r_5['nickname']; ?> &emsp; &emsp; <?php echo $r_4['data']; ?></p>
                                  <p style="font-size: 13px;"><?php echo $mess ?></p>
                              </div>
\
                          </div>
                          <?php
                      }
                  }
                  break;
              case "read_0":
                  $read_0 = $_GET['read_0'];
                  $q_6 = mysqli_query($mysql,"SELECT * FROM `messages` WHERE `poluchatel` = '{$_SESSION['user']['id']}' AND `reading` = '0' ORDER BY `data` DESC");
                  while ($r_6 = mysqli_fetch_array($q_6)){
                      $id = $r_6['id'];
                      $author = $r_6['author'];
                      $poluchatel = $r_6['poluchatel'];
                      $mess = $r_6['mess'];
                      $mess = iconv('utf-8','windows-1251',$mess);
                      $mess = substr($mess, 0,64);
                      $mess = iconv('windows-1251','utf-8',$mess);
                      $data = $r_6['data'];
                      //echo $mess;
                      $q_7 = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author'");
                      while ($r_7 = mysqli_fetch_array($q_7)){
                          $id = $r_7['id'];
                          $nickname = $r_7['nickname'];
                          $avatar = $r_7['avatar'];
                          ?>
                              <div class="act"><div class="inlin_act"><img src="<?=$r_7['avatar']; ?>"style="border-radius: 50px; width: 50px; height: 50px;"></div><div class="inlin_act"> <p id="nickname"><?php echo $r_7['nickname']; ?></p><p style="font-size: 13px;"><?php echo $mess ?></p></div><div class="inlin_act"><small><?php echo $r_6['data']; ?></small></div></div>
                          <?php
                      }
                  }
                  break;
                  case "inbox";
                  $inbox = $_GET['inbox'];
                      $qq = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '{$_GET['id']}' ");
                      $rr = mysqli_fetch_array($qq);
                      $id = $rr['id'];

                      mysqli_query($mysql, "UPDATE `messages` SET `reading` = '1' WHERE `author` = '{$rr['id']} 'AND `poluchatel` = '{$_SESSION['user']['id']}'");
                        $query_2 = mysqli_query($mysql, "SELECT * FROM `dialog` WHERE `poluchatel` = '{$_SESSION['user']['id']}' AND `author` = '{$rr['id']}' OR `poluchatel` = '{$rr['id']}' AND `author` = '{$_SESSION['user']['id']}' ORDER BY `id` ASC");

                        while($result_2 = mysqli_fetch_array($query_2)){
                            $author = $result_2['author'];
                            $poluchatel = $result_2['poluchatel'];
                            $mess = $result_2 ['mess'];
                            $data = $result_2 ['data'];
                            //echo $result_2 ['mess'];

                            $query_3 = mysqli_query($mysql,"SELECT * FROM `users` WHERE `id` = '$author'");
                            while($result_3 = mysqli_fetch_array($query_3)){
                            $id = $result_3['id'];
                            $nickname = $result_3['nickname'];
                            $avatar = $result_3['avatar'];
                                ?>
                                <div class="act_2">
                                    <div class="inlin_act">
                                        <img src="<?=$result_3['avatar'];?>" style="border-radius: 50px; width: 50px; height: 50px; margin-left: 10px">
                                    </div>
                                    <div class="inlin_act">
                                        <p id="nickname"><?php echo $result_3['nickname'];?> &emsp; &emsp; <?php echo $result_2 ['data']; ?></p>
                                        <p style="font-size: 13px;"><?php echo $mess;?></p>
                                    </div>

                                </div>
                                <?php
                            }


                        }
                        ?>
                        <div class="bottom_mes">
                            <form action="action_message_2" method="post">
                                <div id="inform"></div>
                                <input type="hidden" id="poluchatel" class="poluchatel" name="poluchatel" value="<?=$_GET['id']?>">
                                <div>
                                    <textarea class="textarea" id="textarea" name="textarea" cols="30" rows="1" placeholder="Введите сообщение..."></textarea>
                                    <input type="submit" id="submit_5" value="Отправить">
                                </div>

                            </form>
                        </div>
                        <?php

                      break;
                            }
                        ?>

          </div>




      </div>

    <div class="container main_mess">

    </div>
</section>

<div style="height: 400px;"class=""></div>

<?php include("footer.php"); ?>

  </body>
</html>
