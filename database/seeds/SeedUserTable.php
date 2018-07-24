<?php

use Illuminate\Database\Seeder;
//use Carbon\Carbon;
use App\User;

class SeedUserTable extends Seeder
{
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //User::truncate();
        factory(App\User::class,30)->create();

    }
}
