<?php

use Faker\Generator as Faker;

/**
 * Created by PhpStorm.
 * User: alfred
 * Date: 2017/10/20
 * Time: 20:46
 **/

$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'title' => $faker->sentence(6),
        'content' => $faker->paragraph(10),
    ];
});