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

// Организация простого массива - список категорий товаров
$categories_array = ["Все категории", "Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

// Организация двумерного массива - лоты (6 шт) уложены в простой индексированный массив
$items_array = [
     [
    'Название' => '2014 Rossignol District Snowboard',
    'Категория' => 'Доски и лыжи',
    'Цена' => 10999,
    'URL Картинки' => 'img/lot-1.jpg'
     ],
     [
  'Название' => 'DC Ply Mens 2016/2017 Snowboard',
  'Категория' => 'Доски и лыжи',
  'Цена' => 159999,
  'URL Картинки' => 'img/lot-2.jpg'
     ],
     [
  'Название' => 'Крепления Union Contact Pro 2015 года размер L/XL',
  'Категория' => 'Крепления',
  'Цена' => 8000,
  'URL Картинки' => 'img/lot-3.jpg'
     ],
     [
  'Название' => 'Ботинки для сноуборда DC Mutiny Charocal',
  'Категория' => 'Ботинки',
  'Цена' => 10999,
  'URL Картинки' => 'img/lot-4.jpg'
     ],
     [
  'Название' => 'Куртка для сноуборда DC Mutiny Charocal',
  'Категория' => 'Одежда',
  'Цена' => 7500,
  'URL Картинки' => 'img/lot-5.jpg'
     ],
     [
  'Название' => 'Маска Oakley Canopy',
  'Категория' => 'Разное',
  'Цена' => 5400,
  'URL Картинки' => 'img/lot-6.jpg'
    ]
            ];

// подключение файла с функциями-шаблонизаторами functions.php
require_once 'functions.php';

// формирование html-контента Главной страницы - передача в шаблонизатор данных - массивов $categories_array, $items_array, времени жизни лота $lot_time_remaining и путь к нужному шаблону
$page_main_content=renderTemplate('templates/main.php', ['categories' => $categories_array, 'items' => $items_array, 'lot_time_remaining' => $lot_time_remaining]);

// окончательное формирование Главной страницы - передача в шаблонизатор данных для layout - имя пользователя, аватар, html-контент страницы main
$layout_page_main=renderTemplate('templates/layout.php', ['page_title' => 'Главная', 'page_content' => $page_main_content, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth]);

// Вывод Главной страницы на экран
print ($layout_page_main);

?>
