@extends('vendor.adminlte.page')

@section('content_header')
    <h4><a href="{{ route('encuestas') }}">Encuestas</a> > <a href="{{ route('editar_encuesta', $encuesta) }}">{{ $encuesta->nombre }}</a></h4>
    <h1>Preguntas</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar pregunta</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_pregunta', [$encuesta, $pregunta]) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.preguntas._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('preguntas', [$encuesta]) }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('opciones', [$encuesta, $pregunta]) }}" class="btn btn-primary">Cargar opciones</a>
                </div>
            </div>
        </div>
    </div>
@endsection