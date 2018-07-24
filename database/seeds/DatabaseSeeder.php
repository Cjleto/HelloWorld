<?php

use App\Models\Album;
use App\Models\Photo;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //se devo inviare più seeder contemporanemante, basta richiamare la classe del seeder interessato
        // $this->call(SeedUserTable::class);

        DB::STATEMENT('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Album::truncate();
        Photo::truncate();
        $this->call(SeedUserTable::class);
        $this->call(SeedAlbumTable::class);
        $this->call(SeedPhotoTable::class);
    }
}
