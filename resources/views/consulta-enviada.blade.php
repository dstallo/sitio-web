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
		<h2>@lang('textos.consulta.exito.titulo')</h2>
		<div class="intro">
			@lang('textos.consulta.exito.texto')
		</div>
	</section>

@endsection