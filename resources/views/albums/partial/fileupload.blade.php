<div class="form-group">
    <label for="">Thumbnail</label>
    <input type="file" class="form-control" name="album_thumb" id="album_thumb" placeholder="Album Thumbnail" >
</div>
@if($album->album_thumb)
    <div class="form-group">
        <img src="{{asset($album->path)}}" name="{{$album->album_name}}" title="{{$album->album_name}}" width="300" >
    </div>
@endif