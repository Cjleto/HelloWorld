<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function welcome($name = '', $lastname = '', Request $req){
        $res = $req->input('poppo');
        //return "Ciao  ".$name." ".$lastname." - ".$res." -- ".$req->input('rete');
        return "Prova di tets Ciao  ".$name." ".$lastname." - ".$res." -- ".$req->input('rete');
    }
}