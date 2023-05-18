@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Encuestas de satisfacción</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar encuesta</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_encuesta', $encuesta) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.encuestas._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('encuestas') }}" class="btn btn-info">Volver</a>
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
                    <a href="{{ route('resultados_encuesta', [$encuesta]) }}" class="btn btn-info">Ver resultados</a>
                    <a href="{{ route('preguntas', [$encuesta]) }}" class="btn btn-primary">Configurar preguntas</a>
                </div>
            </div>
        </div>
    </div>
@endsection