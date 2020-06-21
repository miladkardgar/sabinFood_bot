<?php

$botman = resolve('botman');

$botman->hears('/start', \App\Http\Controllers\foodController::class.'@startConversation');
$botman->hears('/reserve', \App\Http\Controllers\foodReserveController::class.'@startConversation');
$botman->hears('/reserveList', \App\Http\Controllers\reserveListController::class.'@startConversation');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
