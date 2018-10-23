<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
       'name' => $faker->word,
       'description' => $faker->realText(50),
       'created_at' => $faker->dateTimeThisYear,
       'updated_at' => $faker->dateTimeThisYear,
    ];
});
