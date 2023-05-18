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
<div class="col-md-4 form-group{{ has_error($errors,'imagen') }}">
    <label>Imagen p/ícono</label>
    @if($servicio->tiene('imagen'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_servicio', ['servicio' => $servicio, 'campo' => 'imagen']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $servicio->url('imagen') }}" data-lity style="padding-left:20px;"><img src="{{ $servicio->url('imagen') }}" width="50"></a>
        </div>
    @else
        <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}">
    @endif
</div>
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'titulo_'.$kidioma; ?>
<div class="col-md-4 form-group{{ has_error($errors, $campo) }}">
    <label>Título ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $servicio->$campo) }}">
</div>
@endforeach
<div class="col-md-6 form-group{{ has_error($errors,'link') }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" value="{{ old('link',$servicio->link) }}">
    <span class="help-block">Dejar vacío si se carga una ficha.</span>
</div>
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'texto_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Texto ({{ $idioma }})</label>
    <textarea style="height:180px;" class="form-control" name="{{ $campo }}">{{ old($campo, $servicio->$campo) }}</textarea>
</div>
@endforeach
<div class="col-md-12"><hr><h4>Ficha</h4></div>
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_titulo_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Título ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $servicio->$campo) }}">
</div>
@endforeach
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_bajada_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Bajada ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $servicio->$campo) }}</textarea>
</div>
@endforeach
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_texto_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Texto ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $servicio->$campo) }}</textarea>
</div>
@endforeach
