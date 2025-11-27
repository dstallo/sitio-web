@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Sucursales</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar sucursal</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_sucursal', $sucursal) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.sucursales._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.sucursales') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection

@section('script.abajo')
    @include('admin.parciales.tinymce-js')
@endsection