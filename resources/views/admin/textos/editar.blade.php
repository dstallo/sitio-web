@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Textos</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar texto</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_texto', $texto) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.textos._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('textos') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection

@section('script.abajo')
    @include('admin.parciales.tinymce-js')
@endsection