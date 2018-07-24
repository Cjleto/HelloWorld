<div class="form-group">
    <label for="">Thumbnail</label>
    <input type="file" class="form-control" name="img_path" id="img_path" placeholder="Img Thumbnail" >
</div>
@if($photo->img_path)
    <div class="form-group">
        <img src="{{asset($photo->img_path)}}" name="{{$photo->name}}" title="{{$photo->name}}" width="300" >
    </div>
@endif