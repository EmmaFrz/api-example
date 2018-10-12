<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
       'content' => $faker->realText(160),
       'user_id' => $faker->numberBetween(1,10),
       'job_id' =>  $faker->numberBetween(1,50),
       'created_at' => $faker->dateTimeThisYear,
       'updated_at' => $faker->dateTimeThisYear,
    ];
});
