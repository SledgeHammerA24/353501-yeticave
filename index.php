<?php

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
// ...
$hours_delta_time=floor(($tomorrow-$now)/3600); // вычисляем часы
$minutes_delta_time=floor(($tomorrow-$now)%3600 / 60); // вычисляем минуты
$lot_time_remaining=sprintf("%02d:%02d", $hours_delta_time, $minutes_delta_time); // переопределяем переменную $lot_time_remaining


// подключение файла с данными о лотах data_lots.php
require_once 'data_lots.php';

// подключение файла с функциями-шаблонизаторами functions.php
require_once 'functions.php';

// формирование html-контента Главной страницы - передача в шаблонизатор данных - массивов $categories_array, $items_array, времени жизни лота $lot_time_remaining и путь к нужному шаблону
$page_main_content=renderTemplate('templates/main.php', ['categories' => $categories_array, 'items' => $items_array, 'lot_time_remaining' => $lot_time_remaining]);

// окончательное формирование Главной страницы - передача в шаблонизатор данных для layout - имя пользователя, аватар, html-контент страницы main
$layout_page_main=renderTemplate('templates/layout.php', ['page_title' => 'Главная', 'page_content' => $page_main_content, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth, 'categories' => $categories_array]);

// Вывод Главной страницы на экран
print ($layout_page_main);

?>
