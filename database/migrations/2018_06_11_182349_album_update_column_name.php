<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlbumUpdateColumnName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('albums', function (Blueprint $table) {
            //modifico il campo album_name. change() corrisponde a ALTER TABLE
            $table->string('album_name',200)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('albums', function (Blueprint $table) {
            //riporto la situazione prima del lancio del migrate ovvero della funzione UP soprra descritta
            $table->string('album_name',128)->change();
        });
    }
}
