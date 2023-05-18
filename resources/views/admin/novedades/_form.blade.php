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
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $novedad->$campo) }}">
</div>
@endforeach
<div class="col-md-6 form-group{{ has_error($errors,'link') }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" value="{{ old('link',$novedad->link) }}">
    <span class="help-block">Dejar vacío si se carga una ficha.</span>
</div>
<div class="col-md-4 form-group{{ has_error($errors,'thumbnail') }}">
    <label>Thumbnail</label>
    @if($novedad->tiene('thumbnail'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_novedad', ['novedad' => $novedad, 'campo' => 'thumbnail']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $novedad->url('thumbnail') }}" data-lity><img src="{{ $novedad->url('thumbnail') }}"></a>
        </div>
    @else
        <input type="file" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}">
    @endif
</div>
<div class="col-md-12"><hr><h4>Ficha</h4></div>
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_titulo_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Título ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $novedad->$campo) }}">
</div>
@endforeach
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_bajada_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Bajada ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $novedad->$campo) }}</textarea>
</div>
@endforeach
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_texto_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Texto ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $novedad->$campo) }}</textarea>
</div>
@endforeach
