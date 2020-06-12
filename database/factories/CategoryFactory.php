<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {

    $title = str_replace('.', '', $faker->word);

    return [
        'name' => $title,
        'description' => $faker->paragraph(5),
        'slug' => Str::slug($title),
        'material_id' => 1,
        'order' => $faker->randomDigit
    ];
});
