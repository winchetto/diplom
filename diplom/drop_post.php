<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if(!$_SESSION['user']){
    header('Location: /');
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Post by <?= $_SESSION['user']['nickname']?></title>
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
            <div class="wrap">
                <div class="hh">
                    <input type="text" class="name_post" name="name_post" id="name_post" placeholder="Название материала..." onkeypress="noDigits(event)">
                    <br>
                    <br>
                    <textarea class="description" name="description" id="description" cols="30" rows="4" placeholder="Описание материала..." onkeypress="noDigits(event)"></textarea>
                    <br>
                    <br>
                </div>

                <div class="hh" style="margin-left: 70px;">
                    <span style="color: #d957ce">Добавить аудиофайл</span>
                    <br>
                    <br>
                    <input type="file" class="audio" name="audio" id="audio" accept=".mp3,audio/*">
                    <br>
                    <br>
                    <input type="submit" class="btn_in_post" name="in_post" id="in_post" value="Отправить">
            <p class="errors no-display"></p>
                </div>
            </div>
        </form>

        </div>
    </div>

    <script src="scripts/jquery-3.4.1.min.js"></script>
    <script src="scripts/posts.js"></script>
</section>

<div style="height: 400px;"class=""></div>

<?php include("footer.php"); ?>

</body>
</html>
