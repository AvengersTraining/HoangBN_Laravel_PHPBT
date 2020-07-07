<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->text,
        'thumbnail' => $faker->imageUrl(),
        'post_vote' => $faker->numberBetween(1, 10000),
        'post_view' => $faker->numberBetween(1, 10000),
        'is_published' => rand(0, 1),
    ];
});
