@extends('layout')

@section('titulo') {{ config('app.name') }} - @lang('textos.encuesta.titulo') @endsection

@section('script.header')
    
@endsection

@section('contenido')

	<div class="encuesta contenedor">
		
		<div class="intro">
			@lang('textos.encuesta.intro')
		</div>

		<div class="titulo">
			<span>@lang('textos.encuesta.titulo')</span>
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
				<button type="submit">@lang('textos.encuesta.boton')</button>
			</div>
		</form>
	</div>

@endsection