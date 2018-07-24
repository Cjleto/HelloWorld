@extends('template.layout')
@section('content')
    <h1>NEW ALBUM</h1>

    <form action="{{route('album.save')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Album Name" >
        </div>
        @include('albums.partial.fileupload')
        <div class="form-group">
            <label for="">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Album Description"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
    </form>
@stop
