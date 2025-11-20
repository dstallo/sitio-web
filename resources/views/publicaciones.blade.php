@extends('layout')

@section('script.header')
    
@endsection

@section('contenido')

	@if($publicaciones->count())
		<section class="publicaciones contenedor">		
            <h2>@lang('textos.publicaciones.titulo')</h2>
			<div class="intro">
				@lang('textos.publicaciones.texto')
			</div>
			<x-publicaciones :publicaciones="$publicaciones" />
		</section>
	@endif

@endsection