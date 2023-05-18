@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Cuentas de inscripto</h1>
@stop

@section('js')
    
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar inscripto</h3>
                </div>
                <form method="post" enctype="multipart/form-data" action="{{ route('guardar_inscripto_newsletter', compact('inscripto')) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('admin.newsletter._form')
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('inscriptos_newsletter') }}" class="btn btn-info">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop