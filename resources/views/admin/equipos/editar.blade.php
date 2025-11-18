@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Equipos</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar miembro</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_equipo', $equipo) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.equipos._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('equipos') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection

