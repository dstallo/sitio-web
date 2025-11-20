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
                <a href="{{ route('admin.novedades') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
    @if ($novedad->ficha)
        @include('admin.parciales.acciones-ficha', ['ficha' => $novedad->ficha])
    @endif
@endsection

@section('script.abajo')
    @include('admin.parciales.tinymce-js')
@endsection