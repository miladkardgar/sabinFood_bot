<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('/start', BotManController::class.'@start');
$botman->hears('/setting', BotManController::class . '@setting');
$botman->hears('/my_symbol_list', BotManController::class . '@my_symbol');
$botman->hears('/add_symbol', BotManController::class . '@add_symbol');
$botman->hears('/SendMessageToAll', BotManController::class . '@manager');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
