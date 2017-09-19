<?php

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

// Организация и описание работы функции по преобразованию машинного времени на человеческий лад
function lot_life($bet_time) //
{
  $now = strtotime('now'); // вычисляем текущее время.
  $delta_time = $now - $bet_time; // вычисляем разницу во времени между сделанной ставкой и текущим моментом в сек в 1970г.
  $days_delta_time=floor($delta_time/86400); // вычисляем дельту в днях.
  $hours_delta_time=floor($delta_time%86400 / 3600); // вычисляем дельту в часах.
  $minutes_delta_time=floor(($delta_time%86400- $hours_delta_time*3600)/ 60); // вычисляем дельту в минутах.

  // условие для корректного вывода даты $outbound_bet_time в человеческом виде в зависимости от времени сделанной ставки.
  if ($delta_time<=86400 && $delta_time>=3600) { // если ставка была сделана меньше суток назад и больше часа назад.
    $outbound_bet_time=sprintf($hours_delta_time. ' часов назад'); // определяем переменную $outbound_bet_time.
  }
  else if ($delta_time>86400) { // если ставка была сделана больше суток назад.
    $outbound_bet_time=date("d.m.y в H:i", $bet_time); // определяем переменную $outbound_bet_time.
  }
  else { // если ставка была сделана меньше часа назад.
    $outbound_bet_time=sprintf($minutes_delta_time. ' минут назад'); // определяем переменную $outbound_bet_time в третьем случае.
  } //.

  return $outbound_bet_time;  //
}

// подключение файла с данными о лотах data_lots.php
require_once 'data_lots.php';

// подключение файла с функциями-шаблонизаторами functions.php
require_once 'functions.php';

// подсчитываем сколько всего элементов в массиве
//$number_of_items = count($items_array);


// при вызове страницы по ссылке проверяем установлена ли переменная itemId в глобальном массиве $_GET (указан ли параметр запроса - идентификатор itemId) с помощью функции isset, а также
// проверяем наличие в массиве лотов items_array элемента с (переданным) индексом itemId
    $id = $_GET['itemId'] ?? null;
    if (!array_key_exists($id, $items_array)) {
    http_response_code(404);
    print("Такой страницы не существует (ошибка 404)");
}

// формирование html-контента страницы Страница Лота - передача пути к нужному шаблону
$page_lot_content=renderTemplate('templates/page_lot_main.php', ['categories' => $categories_array, 'item' => $items_array, 'bets' => $bets, 'id' => $id]);

// окончательное формирование страницы Страница Лота - передача в шаблонизатор данных для layout - название страницы(=названию Лота), html-контент страницы main
$layout_page_lot=renderTemplate('templates/layout.php', ['page_title' => $items_array[$id]['lot_name'], 'page_content' => $page_lot_content, 'categories' => $categories_array]);

// Вывод Главной страницы на экран
print ($layout_page_lot);
