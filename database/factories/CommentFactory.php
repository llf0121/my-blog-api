<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'favor_num' => 0,
        'created_at' => $date_time,
        'updated_at' => $date_time,
        'content' =>$faker->sentence
        ];
});
