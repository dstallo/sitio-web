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
				@lang('textos.servicios.texto')
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
		<section class="novedades contenedor con-slick">
			<h2>@lang('textos.novedades.titulo')</h2>
			<div class="listado">
            @foreach($novedades as $novedad)
                <div class="novedad">
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
                </div>
            @endforeach
            </div>
		</section>
	@endif
    @if ($contenidos->count())
        <div class="ancla" id="nuestro-lugar"></div>
        <section class="galeria contenedor">
            <h2>@lang('textos.lugar.titulo')</h2>
            <div class="intro">
                @lang('textos.lugar.texto')
            </div>
            @if($contenidos->count())
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
    @endif
    @if($publicaciones->count())
		<div class="ancla" id="publicaciones"></div>
		<section class="publicaciones contenedor con-slick">
			<h2>@lang('textos.publicaciones.titulo')</h2>
			<x-publicaciones :publicaciones="$publicaciones" />
		</section>
	@endif

    @if($agenda->count())
		<div class="ancla" id="agenda"></div>
		<section class="agenda contenedor">
			<h2>@lang('textos.agenda.titulo')</h2>
            <div class="intro">
                @lang('textos.agenda.texto')
            </div>
			<ul class="listado">
            @foreach($agenda as $evento)
                <li>
                @if ($evento->link)
                    <a href="{{ $evento->link }}" title="Acceder" target="_blank">
                @endif
                @if ($evento->fecha)
                    <time>{{ $evento->fecha->format('d/m/Y - H:i').' hs.' }}</time>
                @endif
                <span>{{ $evento->titulo }}</span>
                @if ($evento->link)
                    </a>
                @endif
                </li>
            @endforeach
            </ul>
		</section>
	@endif

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