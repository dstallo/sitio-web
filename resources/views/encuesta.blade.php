@extends('layout')

@section('titulo')Hotel El Galeón - Encuesta de satisfacción@endsection

@section('script.header')
    
@endsection

@section('contenido')

	<div class="encuesta contenedor">
		
		<div class="intro">
			<p>
				Te invitamos a completar esta encuesta  de satisfacción.<br>
				Tu participación nos ayudan a seguir mejorando nuestro servicio.
			</p>
		</div>

		<div class="titulo">
			<span>Encuesta de satisfacción</span>
		</div>

		<form method="post">
			{{ csrf_field() }}
			<ul class="preguntas">
				@foreach($encuesta->preguntas as $pregunta)
					<li>
						<div class="pregunta"><p>{{ $pregunta->pregunta }}</p></div>
						<ul class="opciones">
							@foreach($pregunta->opciones as $opcion)
								<li>
									<input type="radio" value="{{ $opcion->id }}" id="opcion_{{ $opcion->id }}" name="pregunta_{{ $pregunta->id }}" required>
									<label for="opcion_{{ $opcion->id }}">{{ $opcion->valor }}</label>
								</li>
							@endforeach
						</ul>
					</li>
				@endforeach
			</ul>
			<div class="boton">
				<button type="submit">ENVIAR</button>
			</div>
		</form>
	</div>

@endsection