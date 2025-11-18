@extends('layout')

@section('titulo'){{ config('app.name') }} - {{ $ficha->ficha_titulo }}@endsection

@section('script.header')
	<link rel="stylesheet" type="text/css" href="{{ url('js/lib/slick/slick.css') }}">
    <script src="{{ url('js/lib/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    	$(function() {
    		if($('.multimedia').length > 0) {
	    		$('.multimedia').slick({
	    		    slidesToShow: 1,
	    		    slidesToScroll: 1,
	    		});
	    	}
    	});
    </script>
@endsection

@if($imagen = $ficha->contenidos->firstWhere('tipo', 'imagen'))
	@section('imagen'){{ $imagen->url('tn') }}@endsection
@endif

@section('contenido')
<div class="contenedor ficha">
	<div class="cuerpo-ficha">

		<h1>{!! $ficha->ficha_titulo !!}</h1>

		@if(count($ficha->contenidos))
			<div class="multimedia">
				@foreach($ficha->contenidos as $contenido)
					@if($contenido->tipo == 'video')
						@if($videoResuelto = $contenido->getVideo())
							<div>
								<div class="foto video" style="background-image:url({{ $contenido->tiene('imagen') ? $contenido->url('tn') : $videoResuelto->thumb([1290,585]) }});">
									<a class="glightbox-video" href="{{ $videoResuelto->embedUrl() }}" target="_blank"></a>
								</div>
							</div>
						@endif
			    	@elseif($contenido->tipo == 'imagen')
				        <div>
				            <div class="foto" style="background-image:url({{ $contenido->url('tn') }});">
				            	<a href="{{ $contenido->url('imagen') }}" data-lity></a>
				            </div>
				        </div>
				    @endif
			    @endforeach
			</div>
		@endif

		<div class="texto bajada">{!! $ficha->ficha_bajada !!}</div>

		<div class="texto">
			{!! $ficha->ficha_texto !!}
		</div>
    @if ($ficha->equipo && $ficha->miembrosEquipo?->count()>0)
        <div class="equipo">
			<ul>
            @foreach($ficha->miembrosEquipo as $equipo)
                <li>
                    <div class="imagen"><div style="background-image:url({{ $equipo->url('imagen') }})"></div></div>
                    <div class="info">
                        <div class="nombre">{{ $equipo->nombre }}</div>
                        <div class="puesto">{{ $equipo->descripcion }}</div>
                    </div>
                </li>
            @endforeach						
			</ul>
		</div>
    @endif
	</div>
</div>
@endsection