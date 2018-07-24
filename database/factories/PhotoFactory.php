<?php

use Faker\Generator as Faker;
use App\User;
use App\Models\Album;

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

$factory->define(App\Models\Photo::class, function (Faker $faker) {
    $c = array('abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife','fashion', 'people', 'nature', 'sports', 'technics', 'transport');
    return [
        'album_id' => Album::inRandomOrder()->first()->id,
        'description' => $faker->text(128),
        'name' => $faker->text(64),
        'img_path' => $faker->imageUrl(640,480, $faker->randomElement($c))

    ];
});
