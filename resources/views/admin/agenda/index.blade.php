@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Agenda</h1>
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
                        <a href="{{ route('crear_evento') }}" class="btn btn-primary">Crear evento</a>
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
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar evento..." value="{{ $listado->old('buscando') }}">
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
                        <th><a href="{{ $listado->linkOrden('fecha') }}">Fecha</a></th>
                        <th><a href="{{ $listado->linkOrden('titulo_es') }}">Título</a></th>
                        <th>Link</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agenda as $evento)
                        <tr>
                            <td>{{ $evento->id }}</td>
                            <td>{{ $evento->fecha?->format('d/m/Y H:i') }}</td>
                            <td>{{ $evento->titulo }}</td>
                            <td>
                                @if($evento->link)
                                    <a href="{{ $evento->link }}" target="_blank">{{ $evento->link }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-right">
                                {!! accion_visibilidad($evento->visible, route('visibilidad_evento',compact('evento'))) !!}
                                <a href="{{ route('editar_evento', compact('evento')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_evento', compact('evento')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron eventos.</td>
                        </tr>
                    @endforelse
                    <?php $evento = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $agenda->links() }}
        </div>
    </div>
@endsection
