@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Textos</h1>
@stop

@section('content')
    
    <div class="row">
        
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
                                <input type="text" class="form-control" name="buscando_id" placeholder="ID" value="{{ $listado->old('buscando_id') }}">
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><a href="{{ $listado->linkOrden('id') }}">ID</a></th>
                        <th><a href="{{ $listado->linkOrden('texto_es') }}">Texto</a></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($textos as $texto)
                        <tr>
                            <td>{{ $texto->id }}</td>
                            <td>{!! substr(strip_tags($texto->texto_es), 0, 250) !!}</td>
                            <td class="text-right">
                                
                                <a href="{{ route('editar_texto', compact('texto')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron textos.</td>
                        </tr>
                    @endforelse
                    <?php $texto = null; ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
