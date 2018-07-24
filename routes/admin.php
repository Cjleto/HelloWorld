<?php
/**
 * Created by PhpStorm.
 * User: siggei
 * Date: 04/06/18
 * Time: 17:57
 */

Route::get('/', function(){
    return "Hello ADMIN!";
});

Route::get('/dashboard', function(){
    return "Admin DASHBOARD";
});

