@extends('vendor.adminlte.page')

@section('content_header')
    <h4>
        <a href="{{ route('encuestas') }}">Encuestas</a> > <a href="{{ route('editar_encuesta', [$encuesta]) }}">{{ $encuesta->nombre }}</a> >
        <a href="{{ route('preguntas', $encuesta) }}">Preguntas</a> > <a href="{{ route('editar_pregunta', [$encuesta, $pregunta]) }}">{{ $pregunta->pregunta }}</a>
    </h4>
    <h1>Opciones</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar opción</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_opcion', [$encuesta, $pregunta, $opcion]) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.opciones._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('opciones', [$encuesta, $pregunta]) }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection