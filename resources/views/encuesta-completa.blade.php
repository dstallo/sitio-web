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
		<h2>Encuesta completa</h2>
		<div class="intro">
			<p>
				Gracias por darnos tu opinión.
			</p>
		</div>
	</section>

@endsection