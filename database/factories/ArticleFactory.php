<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => str_replace('.', '', $faker->sentence),
        'content' => $faker->paragraph(100),
        'status_id' => 'public',
    ];
});
