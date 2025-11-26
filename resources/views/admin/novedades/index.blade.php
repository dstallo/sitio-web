@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Novedades</h1>
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
                        <a href="{{ route('crear_novedad') }}" class="btn btn-primary">Crear novedad</a>
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
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar novedad..." value="{{ $listado->old('buscando') }}">
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
            <table id="tabla-ordenable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><a href="{{ $listado->linkOrden('orden', 'asc') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a></th>
                        <th><a href="{{ $listado->linkOrden('id') }}">#</a></th>
                        <th><a href="{{ $listado->linkOrden('titulo_es') }}">Título</a></th>
                        <th>Link</th>
                        <th width="100"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($novedades as $novedad)
                        <tr>
                            <td class="hidden">{{ $novedad->orden }}</td>
                            <td><i class="fa fa-ellipsis-v drag" aria-hidden="true"></i></td>
                            <td>{{ $novedad->id }}</td>
                            <td>{{ $novedad->titulo_es }}</td>
                            <td>
                                @if($novedad->link)
                                    <a href="{{ $novedad->link }}" target="_blank">{{ $novedad->link }}</a>
                                @elseif($novedad->ficha)
                                    <a href="{{ $novedad->href() }}" target="_blank">Ver novedad
                                @endif
                                <a href="#" class="copiable copiable-link" data-clipboard-text="{{ $novedad->href() }}"><i class="fa fa-clipboard"></i> Copiar link</a>
                            </td>
                            <td>@if ($novedad->destacado)<i class="fa fa-star" aria-hidden="true"></i> Destacada @endif</td>
                            <td class="text-right">
                                {!! accion_visibilidad($novedad->visible, route('visibilidad_novedad',compact('novedad'))) !!}
                                <a href="{{ route('editar_novedad', compact('novedad')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_novedad', compact('novedad')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td class="hidden">{{ $novedad->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron novedades.</td>
                        </tr>
                    @endforelse
                    <?php $novedad = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $novedades->links() }}
        </div>
    </div>
@endsection

@section('script.abajo')
    <x-admin.ordenable :url="route('ordenar_novedades')" />
@endsection
