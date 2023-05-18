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
		<h2>Información enviada</h2>
		<div class="intro">
			<p>
				Gracias por ponerte en contacto con nosotros.
			</p>
			<p>
				Muy pronto nos podremos en contacto con vos.
			</p>
		</div>
	</section>

@endsection