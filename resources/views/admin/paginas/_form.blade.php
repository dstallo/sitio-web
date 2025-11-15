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

@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'titulo_'.$kidioma; ?>
<div class="col-md-4 form-group{{ has_error($errors, $campo) }}">
    <label>Título ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $pagina->$campo) }}">
</div>
@endforeach
<div class="col-md-6 form-group{{ has_error($errors,'link') }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" value="{{ old('link',$pagina->link) }}">
    <span class="help-block">Dejar vacío si se carga una ficha.</span>
</div>
<div class="col-md-4 form-group{{ has_error($errors,'thumbnail') }}">
    <label>Thumbnail</label>
    @if($pagina->tiene('thumbnail'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_pagina', ['pagina' => $pagina, 'campo' => 'thumbnail']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $pagina->url('thumbnail') }}" data-lity><img src="{{ $pagina->url('thumbnail') }}"></a>
        </div>
    @else
        <input type="file" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}">
    @endif
</div>
@include('admin.parciales.form-ficha', ['ficha' => $pagina->ficha])
