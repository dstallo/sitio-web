@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Centros</h1>
@stop

@section('content')
    
    <div class="row">
        
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <a href="{{ route('crear_sucursal') }}" class="btn btn-primary">Crear centro</a>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Filtros</h3>
                </div>
                <form>
                    <div class="box-body">
                        <div class="col-md-3 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                <input type="text" class="form-control" name="buscando_id" placeholder="ID#" value="{{ $listado->old('buscando_id') }}">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar centro..." value="{{ $listado->old('buscando') }}">
                            </div>
                        </div>
                        <input type="submit" class="hidden">
                    </div>
                </form>    
            </div>
        </div>
    </div>

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">Listado</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><a href="{{ $listado->linkOrden('id') }}">#</a></th>
                        <th><a href="{{ $listado->linkOrden('nombre') }}">Nombre</a></th>
                        <th>Link</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sucursales as $sucursal)
                        <tr>
                            <td>{{ $sucursal->id }}</td>
                            <td>{{ $sucursal->nombre }}</td>
                            <td>
                                @if($sucursal->link)
                                    <a href="{{ $sucursal->link }}" target="_blank">{{ $sucursal->link }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-right">
                                {!! accion_visibilidad($sucursal->visible, route('visibilidad_sucursal',compact('sucursal'))) !!}
                                <a href="{{ route('editar_sucursal', compact('sucursal')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_sucursal', compact('sucursal')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron centros.</td>
                        </tr>
                    @endforelse
                    <?php $sucursal = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $sucursales->links() }}
        </div>
    </div>
@endsection
