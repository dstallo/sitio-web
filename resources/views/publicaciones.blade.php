@extends('layout')

@section('script.header')
    
@endsection

@section('contenido')

	@if($publicaciones->count())
		<section class="publicaciones contenedor">
        @if (lang('textos.publicaciones.titulo'))
            <h2>@lang('textos.publicaciones.titulo')</h2>
        @endif
        @if (lang('textos.publicaciones.texto'))
			<div class="intro">
				@lang('textos.publicaciones.texto')
			</div>
        @endif
			<x-publicaciones :publicaciones="$publicaciones" />
		</section>
	@endif

@endsection