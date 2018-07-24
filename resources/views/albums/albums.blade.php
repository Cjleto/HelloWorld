@extends('template.layout')
@section('content')

    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        @component('components.alert-info')
            {{session()->get('message')}}
        @endcomponent
    @endif
    <form>
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" >

        <ul class="list-group">

            @foreach($albums as $album)
                <li class="list-group-item justify-content-between ">

                    @if($album->album_thumb)
                        <!-- asset crea url completo, path è un metodo dichiarato nel model album per modificare url-->
                        <img src="{{asset($album->path)}}" title="{{$album->album_name}}" name="{{$album->album_name}}" width="150">
                    @endif

                    {{$album->id}} {{$album->album_name}}

                    <div class="float-right">
                        <a href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-primary edit">New Image</a>

                        @if($album->photos_count > 0)
                            <a href="/albums/{{$album->id}}/images" class="btn btn-primary edit">VIEW IMAGES ({{$album->photos_count}} )</a>
                        @endif

                        <a href="/albums/{{$album->id}}/edit" class="btn btn-primary edit">EDIT</a>

                        <a href="/albums/{{$album->id}}" class="btn btn-danger delete">DELETE</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </form>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {

            $('div.alert').fadeOut(3000);

            $('ul').on('click','a.delete',function(ele){
                 ele.preventDefault();
                 var urlAlbum = $(this).attr('href');
                 var li = ele.target.parentNode.parentNode;
                 //console.log(li);
                 $.ajax(
                     urlAlbum,
                     {
                         method: 'DELETE',
                         data: {
                             '_token': $('#_token').val()
                         },
                         complete: function (resp) {
                             if(resp.responseText == 1){
                                 $(li).remove();
                             } else {
                                 alert('Problema ajax albums.blade');
                             }
                         }
                     }
                 ) //fine ajax

            });
        });
    </script>
@endsection