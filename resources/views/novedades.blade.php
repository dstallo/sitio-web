@extends('layout')

@section('script.header')
    
@endsection

@section('contenido')

	@if($novedades->count())
		<section class="novedades contenedor">
        @if (lang('textos.novedades.titulo'))
            <h2>@lang('textos.novedades.titulo')</h2>
        @endif
        @if (lang('textos.novedades.texto'))
			<div class="intro">
				@lang('textos.novedades.texto')
			</div>
        @endif
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
                    {!! $novedad->ficha?->ficha_bajada !!}
                </div>
            @endforeach
            </div>
		</section>
	@endif

@endsection