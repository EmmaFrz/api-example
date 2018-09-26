<?php

use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
       'name' => $faker->jobTitle(),
       'description' => $faker->realText(50),
       'price' => $faker->numberBetween(50,300),
       'created_at' => $faker->dateTimeThisYear,
       'updated_at' => $faker->dateTimeThisYear,
    ];
});
