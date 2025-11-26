@extends('layout')

@section('script.header')
    <script>
    	$(function(){
    		setTimeout(() => {window.location.href = '/'}, 10000);
    	});
    </script>
@endsection

@section('contenido')

	<section class="ubicacion contenedor">
    @if (lang('textos.encuesta.exito.titulo'))
		<h2>@lang('textos.encuesta.exito.titulo')</h2>
    @endif
    @if (lang('textos.encuesta.exito.texto'))
		<div class="intro">
			@lang('textos.encuesta.exito.texto')
		</div>
    @endif
	</section>

@endsection