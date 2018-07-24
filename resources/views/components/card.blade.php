<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="{{$img_url}}" alt="{{$img_title}}">
  <div class="card-body">
    <h5 class="card-title">{{$img_title}}</h5>
	{{-- il resto lo passo dal template --}}
	{{$slot}}
  </div>
</div>