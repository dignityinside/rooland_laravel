<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {

    $title = str_replace('.', '', $faker->sentence);

    return [
        'category_id' => 1,
        'status_id' => \App\Material::STATUS_PUBLIC,
        'slug' => Str::slug($title),
        'thumbnail' => 'https://example.com/1.jpg',
        'title' => $title,
        'content' => $faker->paragraph(100),
        'meta_title' => $title,
        'meta_description' => $faker->paragraph(1),
        'allow_comments' => 1,
        'hits' => $faker->randomDigit
    ];
});
