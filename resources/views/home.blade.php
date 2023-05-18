@extends('layout')

@section('script.header')
    
@endsection

@section('contenido')

	@if($slides->count())
		<div class="slides">
			@foreach($slides as $slide)
				<div class="slide">
					<div class="imagen" style="background-image:url({{ $slide->url('imagen') }});"></div>
					<div class="imagen_vertical" style="background-image:url({{ $slide->url('imagen_vertical') }});"></div>
					@if($slide->titulo && substr($slide->titulo, 0, 1) != '.')
						<div class="titulo">{{ $slide->titulo }}</div>
					@endif
					@if($slide->link)
						<a href="{{ $slide->link }}" target="_blank"></a>
					@endif
				</div>
			@endforeach
		</div>
	@endif

	@if($servicios->count())
		<div class="ancla" id="servicios"></div>
		<section class="servicios contenedor">		
			<div class="intro">
				<p>Una tradicional casa de campo de los años cuarenta, para disfrutar de la tranquilidad, admirar nuestra decoración inspirada en muebles antiguos y artesanías de nuestros viajes, elejir un libro de la biblioteca y descansar con una buena película.</p>
			</div>
			<ul>
				@foreach($servicios as $servicio)
					<li>
						<article>
							@if($servicio->tiene('imagen'))
								<i><img src="{{ $servicio->url('imagen') }}"></i>
							@endif
							<h3>{{ $servicio->titulo }}</h3>
							<p>{!! nl2br($servicio->texto) !!}</p>
							@if(!empty($servicio->link))
								<a href="{{ $servicio->link }}" target="_blank"></a>
							@elseif($href = $servicio->href())
								<a href="{{ $href }}"></a>
							@endif
						</article>
					</li>
				@endforeach
			</ul>
		</section>
	@endif

	@if($novedades->count())
		<div class="ancla" id="novedades"></div>
		<section class="novedades contenedor">
			<h2>Novedades y Promociones</h2>
			<ul>
				@foreach($novedades as $novedad)
					<li data-mantener-relacion-alto="100">
						<article>
							<div class="imagen" style="background-image:url({{ $novedad->url('thumbnail') }})"></div>
							<div class="over"></div>
							<h3>{{ $novedad->titulo }}</h3>
							@if($novedad->link)
								<a href="{{ $novedad->link }}" target="_blank"></a>
							@elseif($href = $novedad->href())
								<a href="{{ $href }}"></a>
							@endif
						</article>
					</li>
				@endforeach
			</ul>
		</section>
	@endif

	<div class="ancla" id="gym"></div>
	<section class="galeria contenedor">
		<h2>Nuestro lugar</h2>
		<div class="intro">
			<p>Casa Ganesha posee un gran jardín para tomar sol, bañarse en el estanque, comer una fruta de un árbol, disfrutar el cantar de los pájaros y tambien jugar en familia. Nuestra galería, con una infusión o comida de por medio, es el lugar propicio para relajarse y observar la vista del campo abierto, sus animales y los cambios de colores a la puesta del sol.</p>
		</div>
		@if($contenidos->count())
			<div class="ancla" id="galeria"></div>
			<div class="contenidos">
				@foreach($contenidos as $contenido)
					<article>
						@if($contenido->tipo == 'imagen')
							<a class="imagen" href="{{ $contenido->url('imagen') }}" data-lity><img src="{{ $contenido->url('imagen') }}" title="{{ $contenido->nombre }}"></a>
						@endif
						@if($contenido->tipo == 'video')
							@if($videoResuelto = $contenido->getVideo())
	                            <a class="imagen video glightbox-video" href="{{ $videoResuelto->embedUrl() }}">
	                                <img src="{{ $contenido->tiene('tn') ? $contenido->url('tn') : $videoResuelto->thumb([550,236]) }}">
	                            </a>
	                        @endif
						@endif
					</article>
				@endforeach
			</div>
			<ul class="nav">
				@foreach($contenidos as $contenido)
					<li>
						@if($contenido->tipo == 'imagen')
							<a class="imagen"><img src="{{ $contenido->url('tn') }}" title="{{ $contenido->nombre }}"></a>
						@endif
						@if($contenido->tipo == 'video')
							@if($videoResuelto = $contenido->getVideo())
	                            <a class="imagen video">
	                                <img src="{{ $contenido->tiene('tn') ? $contenido->url('tn') : $videoResuelto->thumb([550,236]) }}">
	                            </a>
	                        @endif
						@endif
					</li>
				@endforeach
			</ul>
		@endif
	</section>

	@if(($popup ?? null) && $popup->tiene('imagen'))
		<a href="#popup_general" data-lity data-auto-abrir-popup="{{ $popup->tiene('imagen_vertical') ? '600' : '' }}"></a>
		<div class="popup lity-hide" id="popup_general">
		    @if($popup->link)
		        <a href="{{ $popup->link }}" target="_blank"><img src="{{ $popup->url('imagen') }}"></a>
		    @else
		        <img src="{{ $popup->url('imagen') }}">
		    @endif
		</div>
	@endif
	@if(($popup ?? null) && $popup->tiene('imagen_vertical'))
		<a href="#popup_general_vertical" data-lity data-auto-abrir-popup></a>
		<div class="popup lity-hide" id="popup_general_vertical">
		    @if($popup->link)
		        <a href="{{ $popup->link }}" target="_blank"><img src="{{ $popup->url('imagen_vertical') }}"></a>
		    @else
		        <img src="{{ $popup->url('imagen_vertical') }}">
		    @endif
		</div>
	@endif

@endsection