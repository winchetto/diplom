<header>
  <div class="container header-info">
    <a href="feed.php" class="logo">
      <img src="picters/logo22.png" style="width: 120px; max-height: 60px;">
    </a>

    <div class="leftbar">
      <?php
      if($_SESSION['user']){
      ?>
      <a href="me.php"><i class="fa fa-envelope" aria-hidden="true"></i></a>
      <a href="accounts.php"><i class="fa fa-users" aria-hidden="true"></i></a>
      <a href="feed.php"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>
      <a href="edit.php"><i class="fa fa-cog" aria-hidden="true"></i></a>

          <a href="main.php"><p style="display: none;font-size: 20px;"><?= $_SESSION['user']['nickname']?></p>
              &emsp;<img src="<?= $_SESSION['user']['avatar']?>" style="margin-right: 10px ;width: 39px;height: 39px; border-radius: 50%;"></a>

      <button type="button" name="btn_log" class="btn_log" onclick="window.location.href='functions/exit.php'"><i class="fa fa-user" aria-hidden="true"></i> Выйти</button>
      <?php
            };
       ?>
       <?php
       if(!$_SESSION['user']){
       ?>
       <button type="button" name="btn_log" class="btn_log" onclick="window.location.href='auth.php'"><i class="fa fa-user" aria-hidden="true"></i> Войти</button>
       <?php
             };
        ?>
    </div>
  </div>
</header>
