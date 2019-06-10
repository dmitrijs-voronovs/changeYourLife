<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Keyword;
use Faker\Generator as Faker;

$factory->define(Keyword::class, function (Faker $faker) {

    return [
        // 'word'=>$word_list[array_rand($word_list)]
        'word'=>$faker->name
    ];
});
