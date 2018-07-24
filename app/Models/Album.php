<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Album extends Model{

    protected $table = 'albums';
    protected $primaryKey = 'id';
    protected $fillable = ['album_name','description','user_id'];

    /**
     * @return mixed|string
     */
    public function getPathAttribute(){
        $url = $this->album_thumb;
        if(stristr($this->album_thumb, 'http') === false ){
            $url = 'storage/'.$this->album_thumb;
        }
        return $url;
    }


    //dichiaro relazione con le photo
    public function photos(){
        // l'id della tabella albums mappa con la chiave album_id della tb photos
        //si potrebbe evitare di dichiararle dato che i nomi di queste chiavi sono come se le aspetta laravel di default
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }

    //Accessor di test
    public  function  getAlbumNameAttribute($value){
        $value = strtoupper($value);
        return $value;
    }
}

