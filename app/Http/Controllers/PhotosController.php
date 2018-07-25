<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Storage;


class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->has('album_id')?$request->input('album_id') : null;

        $album = Album::firstOrNew(['id' => $id]);


        $photo = new Photo();
        $albums = $this->getAlbums();


        return view('images.editimage', compact('photo','album','albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $photo = new Photo();
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $request->input('album_id');


        $this->processFile($photo);
        $photo->save();
        return redirect(route('album.getimages',$photo->album_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
        dd($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
        $albums = $this->getAlbums();
        //metodo del model Photo
        $album = $photo->album;

        return view('images.editimage', compact('photo','albums','album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->processFile($photo);
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');

        $photo->album_id = $request->album_id;

        $res = $photo->save();

        $mess = $res ? 'Photo '.$photo->name.' Aggiornata' : 'Photo NON'.$photo->name.' Aggiornata';
        session()->flash('message',$mess);
        //return redirect()->route('photos.index');
        return redirect()->route('album.getimages', $photo->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)

    {
        $res = $photo->delete();
        if($res){
            $this->processFile($photo);
        }
        return ''.$res;
    }



    public function processFile(Photo &$photo, Request $req=null)
    {

        if(!$req){
            $req = request();
        }
        if(!$req->hasFile('img_path') ){
            return false;
        }
        $file = $req->file('img_path');
        if(!$file->isValid()){
            return false;
        }
        //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
        $fileName = $photo->id . '.' . $file->extension();
        $file->storeAs(env('IMG_DIR').'/'.$photo->album_id, $fileName);
        $photo->img_path = env('IMG_DIR').'/'.$photo->album_id ."/". $fileName;

        return  true;



    }

    public function deleteFile(Photo $photo){
        $disk = config('filesystem.default');
        if($photo->img_path && Storage::disk($disk)->has($photo->img_path)){
           return Storage::disk($disk)->delete($photo->img_path);
        }
        return false;
    }

    public function getAlbums(){
        return Album::orderBy('album_name')->get();
    }
}
