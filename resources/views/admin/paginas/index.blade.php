@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Páginas</h1>
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
                        <a href="{{ route('crear_pagina') }}" class="btn btn-primary">Crear página</a>
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
                                <select data-search-placeholder="Buscá el menú" name="buscando_menu" class="select2" data-tags="true" data-placeholder="Por menú" data-allow-clear="true">
                                    <option></option>
                                @foreach($menues as $m)
                                    <option value="{{ $m }}" {{ $listado->old('buscando_menu') == $m ? 'selected':'' }}>{{ $m }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar página..." value="{{ $listado->old('buscando') }}">
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
            <p>* Para modificar el orden de las páginas, arrastralas con el mouse.</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="tabla-ordenable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><a href="{{ $listado->linkOrden('orden', 'asc') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a></th>
                        <th><a href="{{ $listado->linkOrden('id') }}">#</a></th>
                        <th><a href="{{ $listado->linkOrden('menu') }}">Menú</a></th>
                        <th><a href="{{ $listado->linkOrden('titulo_es') }}">Título</a></th>
                        <th>Link</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paginas as $pagina)
                        <tr>
                            <td class="hidden">{{ $pagina->orden }}</td>
                            <td><i class="fa fa-ellipsis-v drag" aria-hidden="true"></i></td>
                            <td>{{ $pagina->id }}</td>
                            <td>{{ $pagina->menu ?? '-' }}</td>
                            <td>{{ $pagina->titulo_es }}</td>
                            <td>
                                @if($pagina->link)
                                    <a href="{{ $pagina->link }}" target="_blank">{{ $pagina->link }}</a>
                                @elseif($pagina->ficha)
                                    <a href="{{ $pagina->href() }}" target="_blank">Ver página
                                @endif
                                <a href="#" class="copiable copiable-link" data-clipboard-text="{{ $pagina->href() }}"><i class="fa fa-clipboard"></i> Copiar link</a>
                            </td>
                            <td class="text-right">
                                {!! accion_visibilidad($pagina->visible, route('visibilidad_pagina',compact('pagina'))) !!}
                                <a href="{{ route('editar_pagina', compact('pagina')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_pagina', compact('pagina')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td class="hidden">{{ $pagina->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron páginas.</td>
                        </tr>
                    @endforelse
                    <?php $pagina = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $paginas->links() }}
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
                        url:'{{ route("ordenar_paginas") }}',
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
