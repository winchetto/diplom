<?php

if(!$_SESSION['user']){

} else{
?>
    <div class="spisok"><div class="in_spisok"><a href="me.php?act=<?=vhod?>">Входящие</a><br><a href="me.php?act=<?=ishod?>">Исходящие</a><br><a href="me.php?act=<?=read_1?>">Прочитанные</a><br><a href="me.php?act=<?=read_0?>">Непрочитанные</a></div></div>
<?php
};
?>