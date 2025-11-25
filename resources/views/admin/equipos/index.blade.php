@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Equipos</h1>
@stop

@section('content')
    
    <div class="row">
        
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('crear_equipo') }}" class="btn btn-primary">Crear miembro</a>
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
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                <input type="text" class="form-control" name="buscando_id" placeholder="ID#" value="{{ $listado->old('buscando_id') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar miembro / equipo..." value="{{ $listado->old('buscando') }}">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="hidden">
                </form>    
            </div>
        </div>
    </div>

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">Listado</h3>
            <p>* Para modificar el orden de los miembros de un equipo, arrastralos con el mouse.</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="tabla-ordenable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Equipo</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($equipos as $equipo)
                        <tr>
                            <td class="hidden">{{ $equipo->orden }}</td>
                            <td><i class="fa fa-ellipsis-v drag" aria-hidden="true"></i></td>
                            <td>{{ $equipo->id }}</td>
                            <td>{{ $equipo->equipo }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td>{{ $equipo->descripcion }}</td>
                            <td class="text-right">
                                {!! accion_visibilidad($equipo->visible, route('visibilidad_equipo',compact('equipo'))) !!}
                                <a href="{{ route('editar_equipo', compact('equipo')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_equipo', compact('equipo')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td class="hidden">{{ $equipo->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron equipos.</td>
                        </tr>
                    @endforelse
                    <?php $equipo = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $equipos->links() }}
        </div>
    </div>
@endsection

@section('script.abajo')
    <script type="text/javascript" src="/js/lib/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/lib/jquery-ui/jquery-ui.touch-punch.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#tabla-ordenable tbody").sortable({
                update:function(){
                    array=[];
                    $(this).children().each(function(i){
                        array.push($(this).children().last().html());
                    });
                    $.ajax({
                        url:'{{ route("ordenar_equipo") }}',
                        method:'post',
                        data:{'ids':array},
                        success:function(ret){
                            if(ret.ok) {
                                orden=1;
                                $('#tabla-ordenable tbody').children().each(function(i){
                                    $(this).children().first().html(orden);
                                    orden+=1;
                                });
                            } else {
                                sweetAlert('Error', 'Hubo un error al actualizar el orden de los elementos, por favor intentá nuevamente.', 'error');
                            }
                        },
                        error:function(){ sweetAlert('Error', 'Hubo un error al actualizar el orden de los elementos, por favor recargá la página e intentá nuevamente.', 'error'); }
                    });
                }
            });
        });
    </script>
@endsection
