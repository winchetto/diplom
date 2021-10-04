<?php
session_start();
$mysql = new mysqli('127.0.0.1','root','root','a82237_db');

if (!$mysql) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
 ?>
