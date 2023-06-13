<?php
// https://github.com/dejurin/php-google-translate-for-free

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/TelegramBot.php';

use \Dejurin\GoogleTranslateForFree;

$token = '6292313365:AAFTv8gkQwbYgAyhJjLl-syLbp17IB9oWvw';

$telegram = new TelegramBot($token);

$update = $telegram->getWebhookUpdates();

file_put_contents(__DIR__ . '/logs.txt', print_r($update, 1), FILE_APPEND);

$chat_id = $update['message']['chat']['id'];
$text = $update['message']['text'];

if ($text == '/start') {
    $data = get_chat_id($chat_id);

    if (empty($data)) {
        add_chat_id($chat_id, $update['message']['chat']['first_name'], 'en');
        $check = 'en';
    } else {
        $check = $data['lang'];
    }

    $response = $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => "Оставьте отмеченный язык для перевода с него или выберите другой",
        'reply_markup' => $telegram->replyKeyboardMarkup([
            'inline_keyboard' => [
                [
                    ['text' => 'en', 'callback_data' => 'en'],
                    ['text' => 'ru', 'callback_data' => 'ru'],
                ]
            ]
        ])
    ]);
}

