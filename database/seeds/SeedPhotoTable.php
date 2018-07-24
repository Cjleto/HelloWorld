<?php

use App\Models\Photo;
use Illuminate\Database\Seeder;
use App\Models\Album;

class SeedPhotoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $albums = Album::get();
        foreach ($albums as $album){
            //per ogni album creo 200 photo, forzo quindi  l'album_id
            factory(App\Models\Photo::class, 200)->create(
                ['album_id' => $album->id]
            );

        }
    }
}
