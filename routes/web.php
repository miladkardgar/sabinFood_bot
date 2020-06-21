<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\reserve;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/setWebhook', 'Controller@setWebhook');
Route::get('/getUpdates', 'Controller@getUpdate');
Route::get('/getWebhookInfo', 'Controller@getWebhookInfo');
Route::get('/', 'Controller@index');
Route::get('/bot', 'Controller@botController');

Route::resource('/foodList', 'foodList');
Route::resource('/foodDay', 'foodDay');
Route::post('/foodDay/reserve', 'foodDay@reserve')->name('foodDay.reserve');
Route::post('/foodDay/reserve/list', 'foodDay@reserveList')->name('foodDay.reserveList');
Route::post('/foodDay/reserve/list/day', 'foodDay@reserveListDay')->name('foodDay.reserveListDay');
Route::get('/reserve', 'foodDay@reserveUser')->name('foodDay.reserveUser');


Route::get('/test',function (){
        $lists = reserve::with('foodDay')->where('user_id',1)->get();
        dd($lists);
        foreach ($lists as $list) {
            dd($list);
        }
});
