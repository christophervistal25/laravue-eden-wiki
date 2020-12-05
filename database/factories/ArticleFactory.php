<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->sentence(),
        'slug' => Str::slug($faker->title),
    ];
});
