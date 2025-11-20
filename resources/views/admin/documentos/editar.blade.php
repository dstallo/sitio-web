@extends('vendor.adminlte.page')

@section('content_header')
    @if ($ficha?->articulo)
        <h4>
            <a href="{{ $ficha->articulo->href('list') }}">Todos</a> > 
            <a href="{{ $ficha->articulo->href('edit') }}">{{ $ficha->articulo->titulo }}</a> > 
            <a href="{{ route('documentos_ficha', $ficha) }}">Documentos</a> > 
            Editar documento</h4>
    @endif
    <h1>Documentos</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar documento</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ $ficha ? route('guardar_documento_ficha', [$ficha, $documento]) : route('guardar_documento', $documento) }}">
            @csrf
            <div class="box-body">
                <div class="col-md-12">
                    @if (count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 form-group{{ has_error($errors, 'nombre') }}">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $documento->nombre) }}">
                </div>
                <div class="col-md-6 form-group{{ has_error($errors, 'descripcion') }}">
                    <label>Descripción</label>
                    <textarea class="form-control" name="descripcion">{{ old('descripcion', $documento->epigrafe) }}</textarea>
                </div>
                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-6 form-group{{ has_error($errors,'archivo') }}">
                    <label>Archivo</label>
                    @if($documento->tiene('archivo'))
                        <div style="position:relative;">
                            <div style="position:absolute; left:-14px; top:4px;">
                                <a href="{{ $ficha ? route('eliminar_archivo_documento_ficha', compact('ficha', 'documento')) : route('eliminar_archivo_documento', compact('documento')) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                            <a href="{{ $documento->url('archivo') }}" target="_blank"><img src="{{ $documento->href('logo') }}" alt="" style="width:100px;" /></a>
                        </div>
                    @else
                        <input type="file" class="form-control" name="archivo" value="{{ old('archivo') }}">
                    @endif
                </div>
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
            @if ($ficha)
                <a href="{{ $ficha->articulo->href('edit') }}" class="btn btn-info">Volver</a>
            @endif
            </div>
        </form>
    </div>
@endsection