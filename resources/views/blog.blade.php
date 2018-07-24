@extends('template.layout')

@section('title',$title)


@section('content')	
	@component('components.card',
					[
						'img_title' => 'Image Blog',
						'img_url' => 'https://picsum.photos/200/300/?random'
					]
				)
		{{-- tutto ciò che non è passato all'interno del parametro component, viene ricevuto come $slot nel component --}}
		<p>Simple image with description</p>

	@endcomponent

	@component('components.card')
		@slot('img_url','https://picsum.photos/200/300/?random')
		@slot('img_title','Altro modo di passare variabili al component')	
		<p>Simple image with description</p>

	@endcomponent


@endsection

@section('footer')
	@parent {{-- senza questa direttiva, il contenuto della section presente nel layout, verrebbe sovreascritta --}}
	<script type="text/javascript">
		console.log('appendo alla sezione footer dichiarata nel layout');
	</script>
@endsection