@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Novedades</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar novedad</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_novedad', $novedad) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.novedades._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('novedades') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@if ($novedad->ficha)
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('contenidos_ficha', $novedad->ficha) }}" class="btn btn-warning">Cargar contenido multimedia</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('script.abajo')
    @include('admin.parciales.tinymce-js')
@endsection