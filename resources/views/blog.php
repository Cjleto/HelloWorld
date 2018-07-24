	@component('components.card',
					[
						'img_title' => 'Image Blog',
						'img_url' => 'http://placeholder.pics/svg/300'
					]
				)
		{{-- tutto ciò che non è passato all'interno del parametro component, viene ricevuto come $slot nel component --}}
		<p>Simple image with description</p>

	@endcomponent

	@component('components.card')
		@slot('img_url','http://placeholder.pics/svg/300')
		@slot('img_title','Altro modo di passare variabili al component')	
		<p>Simple image with description</p>

	@endcomponent