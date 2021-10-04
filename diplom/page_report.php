<?php
session_start();
require_once 'functions/connect.php';
header('Content-Type: text/html; charset=utf-8');
$id_post = (int) $_GET['id'];
if(!$_SESSION['user']){
    header('Location: /');
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Репорт</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="shortcut icon" href="/picters/logo_fav.png" type="image/png">
</head>
<body>

<?php include("header.php"); ?>

<section>
    <div class="container block-info">
        <h1>Внимание!</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et neque in purus convallis pharetra. Donec dui neque, varius et tristique sit amet, elementum id lectus. Donec vel dui nec metus accumsan iaculis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc mattis ac est molestie lacinia. Sed vulputate augue a risus iaculis, ut varius leo efficitur. Nam sagittis id urna vitae dapibus. Nam tincidunt magna enim, luctus venenatis ante posuere in. Vestibulum quis finibus lorem. Nulla at arcu neque. Nullam nec nibh vel leo tincidunt pharetra vitae vitae elit. Sed rutrum auctor mattis. Nunc.</p>
    </div>

    <div class="container main-info4">
        <div class="form_post">
            <form>
                <div class="wrap" style="margin-top: 0px;">
                    <div class="hh">
                        <input type="hidden" id="id_post" name="id_post" value="<?=$id_post?>">
                        <textarea class="description" name="description" id="description" cols="20" rows="4" placeholder="Описание материала..."></textarea>
                        <p style="color: #2dbda2; font-size: 12px">Опишите причину репорта</p>
                    </div>
                    <div class="hh">
                        <input type="submit" class="btn_in_post" name="in_post" id="rep" value="Отправить" style="margin-top: 0px;">
                        <p class="errors1 no-display"></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/report.js"></script>
</section>

<div style="height: 800px;"class=""></div>

<?php include("footer.php"); ?>

</body>
</html>