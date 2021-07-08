<?php
require('helpers.php');

$is_auth = rand(0, 1);

$user_name = 'Nikita'; // укажите здесь ваше имя

function cropText(string $text, int $length = 300): array {
    if (strlen($text) <= $length) {
        return [$text, false];
    }

    $sumSymbols = 0;
    $words = explode(' ', $text);
    $out = [];

    foreach ($words as $word) {
        if ($sumSymbols <= $length) {
            $sumSymbols += strlen($word);
            $out[] = $word;
            
        } else {
            array_pop($out);
            $result = implode(' ', $out) . '&hellip;';
            
            return [$result, true];
        }   
    }
}

function postDate(array $post):array {
    $date = generate_random_date($post);
    $unix_date = strtotime($date);
    $current_unix_date = date_format(date_create("now"), 'U');
    $date_dif = $current_unix_date - $unix_date;

    if ($date_dif < 60 * 60) {
        $current_time = round($date_dif / 60);
        $relative_time =  "{$current_time} " . get_noun_plural_form($current_time, 'минуту', 'минуты', 'минут');
    } elseif ($date_dif >= 60 * 60 && $date_dif < 60 * 60 * 24) {
        $current_time = round($date_dif / (60 * 60));
        $relative_time =  "{$current_time} " . get_noun_plural_form($current_time, 'час', 'часа', 'часов');
    } elseif ($date_dif >= 60 * 60 * 24 && $date_dif < 60 * 60 * 24 * 7) {
        $current_time = round($date_dif / (60 * 60 * 24));
        $relative_time =  "{$current_time} " . get_noun_plural_form($current_time, 'день', 'дня', 'дней');
    } elseif ($date_dif >= 60 * 60 * 24 * 7 && $date_dif < 60 * 60 * 24 * 7 * 5) {
        $current_time = round($date_dif / (60 * 60 * 24 * 7));
        $relative_time =  "{$current_time} " . get_noun_plural_form($current_time, 'неделю', 'недели', 'недель');
    } else {
        $current_time = round($date_dif / (60 * 60 * 24 * 7 * 5));
        $relative_time =  "{$current_time} " . get_noun_plural_form($current_time, 'месяц', 'месяца', 'месяцев');
    }

    return ['relative_time' => $relative_time, 'date' => $date];
}

$posts = [
    [
        'title' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'author' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
    ],
    [
        'title' => 'Игра престолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
        'author' => 'Владик',
        'avatar' => 'userpic.jpg',
    ],
    [
        'title' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'author' => 'Виктор',
        'avatar' => 'userpic-mark.jpg',
    ],
    [
        'title' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'author' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
    ],
    [
        'title' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'author' => 'Владик',
        'avatar' => 'userpic.jpg',
    ],

];

$page_content = include_template('main.php', ['posts' => $posts]);

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => 'readme: популярное', 'is_auth' => $is_auth]);

print($layout_content);

