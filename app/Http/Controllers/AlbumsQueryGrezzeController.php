<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use DB;


class AlbumsController extends Controller
{
    //
    public function index( Request $request){
        //return Album::all();
        $sql = 'SELECT * FROM albums WHERE 1=1';
        $where = [];
        if($request->has('id')){
            $where['id'] = $request->get('id');
            $sql .= " AND id=:id";
        }

        if($request->has('album_name')){
            $where['album_name'] = $request->get('album_name');
            $sql .= " AND album_name=:album_name";
        }

        //dd($sql);
        $albums =  DB::select($sql, $where);
        return view('albums.albums', ['albums' => $albums] );
    }


    public function delete($id){
//        dd($id);
        $sql = "DELETE FROM albums WHERE id = :id";
        return DB::delete($sql, ['id' => $id]);
    }

    public function show($id){
//        dd($id);
        $sql = "SELECT * FROM albums WHERE id = :id";
        return DB::select($sql, ['id' => $id]);
    }

    public function edit($id){
        $sql = "SELECT id, album_name, description FROM albums WHERE id = :id";
        $album = DB::select($sql, ['id' => $id]);
        //dd($album);
        return view('albums.edit')->with('album',$album[0]);
    }

    public function store($id, Request $req){
        $data = request()->only(['name','description']);
        $data['id'] = $id;
        $sql = "UPDATE albums SET album_name=:name, description=:description WHERE id=:id";
        $res = DB::update($sql,$data);
        $mess = $res ? 'Album '.$id.' Aggiornato' : 'Album NON'.$id.' Aggiornato';
        session()->flash('message',$mess);
        return redirect()->route('albums');
    }

    public function create(){

        return view('albums.createalbum');
    }

    public function save(){
        $data = request()->only(['name','description']);
        $data['user_id'] = 1;
        $sql = "INSERT INTO albums (album_name, description, user_id) VALUES (:name, :description, :user_id)";
        $res = DB::insert($sql, $data);
        $message = $res ? "Album ".$data['name']. " creato." : "Album ".$data['name']. " NON creato.";
        session()->flash('message',$message);
        return redirect()->route('albums');
    }
}
