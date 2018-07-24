<?php

use App\Models\Album;
use App\Models\Photo;
use App\User;

Route::get('/', function(){
    return "Rooooot";
});


Route::get('/albums', 'AlbumsController@index')->name('albums');

Route::delete('/albums/{id}', 'AlbumsController@delete')->where('id','[0-9]+');
Route::get('/albums/{id}', 'AlbumsController@show')->where('id','[0-9]+');
Route::get('/albums/{id}/edit', 'AlbumsController@edit');
Route::patch('/albums/{id}','AlbumsController@store');

Route::get('/albums/create','AlbumsController@create')->name('album.create');
Route::post('/albums','AlbumsController@save')->name('album.save');

Route::get('/albums/{album}/images', 'AlbumsController@getImages')->name('album.getimages')->where('album', '[0-9]+');


Route::get('/photos', function(){
    return Photo::all();
});

Route::get('/users', function(){
    return User::all();
});



Route::get('welcome/{name?}/{lastname?}', 'WelcomeController@welcome')
   /* ->where('name','[a-zA-Z]+')
    ->where('lastname','[a-zA-Z]+');*/
   ->where([
       'name' => '[a-zA-Z]+',
       'lastname' => '[a-zA-Z]+'
   ]);

Route::get('usersnoalbums', function (){
    $usersnoalbums = DB::table('users as u')
        ->leftJoin('albums as a','u.id','=','a.user_id')
        ->select('u.id','email','name','album_name')
        ->whereNull('album_name')
        ->get();
    return $usersnoalbums;
});

Route::get('sql_test', function(){
    $sql = DB::table('albums')
        ->select('user_id', 'users.name', DB::raw('count(0) as total'))
        ->join('users','users.id','=','albums.user_id')
        ->groupBy('user_id')
        ->get();
    return $sql;
});



//images, dato che ho creato il controller tramite artisan con parametro --resource
//posso dichiararlo senza specificare il metodo. vedi documentazione
//assegna direttamente il nome
//php artisan route:list per verificare
Route::resource('photos','PhotosController');

