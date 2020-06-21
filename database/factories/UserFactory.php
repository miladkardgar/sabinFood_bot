<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\role::class, function (Faker $faker) {
    $data = array(
        [
            'title' => 'مدیر کل سیستم',
            'status' => 1,
        ],
        [
            'title' => 'مدیر سیستم',
            'status' => 1,
        ],
        [
            'title' => 'کاربر',
            'status' => 1,
        ]
    );
    return $data;
});
