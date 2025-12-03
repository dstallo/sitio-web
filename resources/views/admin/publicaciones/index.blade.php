@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Publicaciones</h1>
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
                        <a href="{{ route('crear_publicacion') }}" class="btn btn-primary">Crear publicacion</a>
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
                        <div class="col-md-3 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-menu-hamburger"></i></span>
                                <select data-search-placeholder="Buscá la categoría" name="buscando_categoria" class="select2" data-tags="true" data-placeholder="Por categoría" data-allow-clear="true">
                                    <option></option>
                                @foreach($categorias as $m)
                                    <option value="{{ $m }}" {{ $listado->old('buscando_categoria') == $m ? 'selected':'' }}>{{ $m }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar publicación..." value="{{ $listado->old('buscando') }}">
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
            <p>* Para modificar el orden de las publicaciones, arrastralas con el mouse.</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="tabla-ordenable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><a href="?orden=orden&sentido=asc"><i class="fa fa-refresh" aria-hidden="true"></i></a></th>
                        <th><a href="{{ $listado->linkOrden('id') }}">#</a></th>
                        <th><a href="{{ $listado->linkOrden('categoria') }}">Categoría</a></th>
                        <th><a href="{{ $listado->linkOrden('titulo_es') }}">Título</a></th>
                        <th>Link</th>
                        <th width="100"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publicaciones as $publicacion)
                        <tr>
                            <td class="hidden">{{ $publicacion->orden }}</td>
                            <td><i class="fa fa-ellipsis-v drag" aria-hidden="true"></i></td>
                            <td>{{ $publicacion->id }}</td>
                            <td>{{ $publicacion->categoria ?? '-' }}</td>
                            <td>{{ $publicacion->titulo_es }}</td>
                            <td>
                                <a href="{{ $publicacion->href() }}" target="_blank">{{ $publicacion->link? $publicacion->link : 'Ver publicación' }}</a>
                                <a href="#" class="copiable copiable-link" data-clipboard-text="{{ $publicacion->href() }}"><i class="fa fa-clipboard"></i> Copiar link</a>
                            </td>
                            <td>@if ($publicacion->destacado)<i class="fa fa-star" aria-hidden="true"></i> Destacada @endif</td>
                            <td class="text-right">
                                {!! accion_visibilidad($publicacion->visible, route('visibilidad_publicacion',compact('publicacion'))) !!}
                                <a href="{{ route('editar_publicacion', compact('publicacion')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_publicacion', compact('publicacion')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td class="hidden">{{ $publicacion->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron publicaciones.</td>
                        </tr>
                    @endforelse
                    <?php $publicacion = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $publicaciones->links() }}
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
                        url:'{{ route("ordenar_publicaciones") }}',
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
