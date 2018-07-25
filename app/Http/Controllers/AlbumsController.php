<?php

namespace App\Http\Controllers;



use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use DB;


class AlbumsController extends Controller
{
    //
    public function index( Request $request){
        //return Album::all();
        $queryBuilder = Album::orderByDesc('id')->withCount('photos');
        //dd($queryBuilder->toSql());
        if($request->has('id')){
            $queryBuilder->where('id','=', $request->id);
        }

        if($request->has('album_name')){
            $queryBuilder->where('album_name','like', '%'.$request->album_name.'%');
        }

        //$albums = $queryBuilder->get();
        $albums = $queryBuilder->paginate(env('IMG_PER_PAGE'));
        //dd($queryBuilder);
        //dd($albums);
        return view('albums.albums', ['albums' => $albums] );
    }


    public function delete($id){
//        dd($id);
        $res = Album::where('id', $id)->delete();
        return $res;
    }

    public function show($id){
//        dd($id);
        $res = Album::where('id',$id)->get();
        return $res;
    }

    public function edit($id){
        //$sql = "SELECT id, album_name, description FROM albums WHERE id = :id";
        //$album = DB::select($sql, ['id' => $id]);
        $album = Album::select('id','album_name','description','album_thumb')
            ->where('id',$id)
            ->get();
        //dd($album);
        return view('albums.edit')->with('album',$album[0]);
    }

    public function store($id, Request $req){

        $album = Album::find($id);
        $album->album_name = $req->input('name');
        $album->description = $req->input('description');
        $album->user_id = 1;



        //verifico se nella chiamata HTTP è presente un file
        $this->processFile($id, $req, $album);

        $res = $album->save();

        $mess = $res ? 'Album '.$id.' Aggiornato' : 'Album NON'.$id.' Aggiornato';
        session()->flash('message',$mess);
        return redirect()->route('albums');
    }

    public function create(){
        $album = new Album();
        //passo istanza della var album in quanto la partial fileupload che avevamo creato nell'edit
        //passandolo alla create, vuole in ingresso un'istanza album. quindi se ne crea una vuota
        return view('albums.createalbum', ['album' => $album]);
    }

    public function save(){

        $album = new Album();
        $album->album_name = request()->input('name');
        $album->album_thumb = '';
        $album->description = request()->input('description');
        $album->user_id =  1;

        $res = $album->save();

        //dd($album);

        if($res){

            if($this->processFile($album->id, request(), $album)){
                $album->save();
            }
        }


        $message = $res ? "Album ".$album->album_name. " creato." : "Album ".$album->album_name. " NON creato.";
        session()->flash('message',$message);
        return redirect()->route('albums');
    }

    public function testlll(){
        return 'asdasd';
    }

    public function processFile($id, Request $req, &$album)
    {
        if(!$req->hasFile('album_thumb') ){
            return false;
        }
        $file = $req->file('album_thumb');
        if(!$file->isValid()){
            return false;
        }
        //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
        $fileName = $id . '.' . $file->extension();
        $file->storeAs(env('ALBUM_THUMB_DIR'), $fileName);
        $album->album_thumb = env('ALBUM_THUMB_DIR') ."/". $fileName;

        return  true;



    }

    public function getImages(Album $album){
        //seleziono tutte le photos dell'album con id passato  nell'url
        $images = Photo::where('album_id',$album->id)->paginate(env('IMG_PER_PAGE'));
        //passo alla view sia album, per i dati principali e tutte le photo legate all'album
        return view('images.albumimages', compact('album','images'));

    }





}

