 <?php

use Faker\Generator as Faker;
use App\User;

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

$factory->define(App\Models\Album::class, function (Faker $faker) {
    $c = array('abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife','fashion', 'people', 'nature', 'sports', 'technics', 'transport');
    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'album_thumb' => $faker->imageUrl(640,480, $faker->randomElement($c)),
        'user_id' => User::inRandomOrder()->first()->id
    ];
});
