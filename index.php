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

