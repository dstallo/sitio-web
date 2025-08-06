@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Páginas</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Crear página</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_pagina') }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.paginas._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('paginas') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection

@section('script.abajo')
    @include('admin.parciales.tinymce-js')
@endsection