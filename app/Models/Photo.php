<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    //Accessor, modifico valore dopo averlo letto da DB. Eloquent cerca il campo img_path nel db
    public function getImgPathAttribute($value){

        if(stristr($value, 'http') === false ){
            $value = 'storage/'.$value;
        }
        return $value;
    }

    //Mutators, modifico il valore prima dell'inserimento nel db
    public  function  setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }

    //relazione tra photos e albums
    public function album(){
       return $this->belongsTo(Album::class,'album_id','id');
    }
}
