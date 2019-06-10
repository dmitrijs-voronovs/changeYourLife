<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text,
        'story_id' => rand(1,App\Story::count()),
        'user_id' => rand(1,App\User::count()),
    ];
});
