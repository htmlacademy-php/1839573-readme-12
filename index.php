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

