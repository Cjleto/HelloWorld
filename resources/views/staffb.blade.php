@extends('template.layout')

@section('title',$title)


@section('content')

	<h1>
		{{$title}}
		Bladexs

	</h1>


	@if($staff)
		<ul>
		@foreach ($staff as $person) 
			<li>{{$loop->remaining}}  {{$person['name']}}  {{$person['lastname']}}</li>
		@endforeach
		</ul>
	@else

		<h1>No Staff </h1>

	@endif




@endsection

@section('footer')
	@parent {{-- senza questa direttiva, il contenuto della section presente nel layout, verrebbe sovreascritta --}}
	<script type="text/javascript">
		console.log('appendo alla sezione footer dichiarata nel layout');
	</script>
@endsection