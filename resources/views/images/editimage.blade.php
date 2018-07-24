@extends('template.layout')
@section('content')
    <h1>

        @if($photo->id)  {{--//se sto modificando una immagine--}}
            Update Image
        @else
            New Image
        @endif
    </h1>

    @if($photo->id)
        <form action="{{route('photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">

            {{method_field('PATCH')}}
    @else
        <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">

    @endif
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" required name="name" id="name" class="form-control" value="{{$photo->name}}" placeholder="Image name">

            </div>

            <input type="hidden" name="'album_id" value="{{$photo->album_id?$photo->album_id:$album->id}}" >

            {{csrf_field()}}
            @include('images.partial.fileupload')
            <div class="form-group">
                <label for="">Description</label>
                <textarea  name="description" id="description" class="form-control" placeholder="Album description">{{$photo->description}}</textarea>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@stop