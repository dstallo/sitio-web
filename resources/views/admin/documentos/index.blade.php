@extends('vendor.adminlte.page')

@section('css')
    <style type="text/css">
        .contenedor { display:flex; flex-flow:row wrap; }
    </style>
@stop

@section('content_header')
@if ($ficha)
    @if ($ficha->articulo)
        <h4>
            <a href="{{ $ficha->articulo->href('list') }}">Todos</a> > 
            <a href="{{ $ficha->articulo->href('edit') }}">{{ $ficha->articulo->titulo }}</a> > 
            Documentos
        </h4>
    @endif
@endif
    <h1>Documentos</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Documentos subidos</h3>
      <p>* Arrastrar para cambiar el orden.</p>
    </div>
    <div class="box-body">
        <div class="row row-grid">
            <div class="contenedor" id="ordenable">
                @forelse($documentos as $documento)
                <div class="col-md-2 col-xs-6" data-id-documento="{{ $documento->id }}" style="position:relative; margin-bottom:20px;">
                    <div style="position:absolute; left:0; top:4px;">
                        <a href="{{ $documento->href('edit') }}" class="btn btn-circle btn-sm btn-warning" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ $documento->href('delete') }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                    <a href="{{ $documento->url('archivo') }}" target="_blank"><img src="{{ $documento->href('logo') }}" style="width:100px"></a>
                    <p>{{ $documento->nombre }}</p>
                </div>
                @empty
                    <div class="col-md-12"><p>No hay documentos</p></div>
                @endforelse
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 form-group">
                <h4>Subir documentos</h4>
                
                <div 
                    class="dropzone" 
                    data-input="archivo" 
                    data-cantidad="multi" 
                    data-mimes="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv, application/zip" 
                    data-url="{{ $ficha ? route('subir_archivo_ficha', $ficha) : route('subir_archivo') }}" 
                    max="10" 
                    data-reload="si"
                >
                    <div class="dz-message" data-dz-message><span>Arrastrá los archivos o clickeá para subir.</span></div>
                </div>
                <input type="file" style="display:none;" name="archivo" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ $ficha?->articulo ? $ficha->articulo->href('edit') : '#' }}" class="btn btn-info">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script.header')
    @include('admin.parciales.dropzone-js')
@endsection

@section('script.abajo')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css" />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>
    <script>
        var ordenable = dragula([document.getElementById('ordenable')]);
        ordenable.on('dragend', function(el) {
            ids = [];
            $('#ordenable > div').each(function(i) {
                ids.push($(this).data('id-documento'));
            });
            $.ajax({
                url:'{{ route("ordenar_documentos_ficha", compact("ficha")) }}',
                method:'post',
                data:{'ids':ids},
                success:function(ret){
                    if(!ret.ok) {
                        sweetAlert('Error', 'Hubo un error al actualizar el orden de los documentos, por favor intentá nuevamente.', 'error');
                    }
                },
                error:function(){ sweetAlert('Error', 'Hubo un error al actualizar el orden de los documentos, por favor recargá la página e intentá nuevamente.', 'error'); }
            });
        })
    </script>
@endsection
