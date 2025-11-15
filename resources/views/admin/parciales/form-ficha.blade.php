<div class="col-md-12"><hr><h4>Ficha</h4></div>
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_titulo_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Título ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $ficha?->$campo) }}">
</div>
@endforeach
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_bajada_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Bajada ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $ficha?->$campo) }}</textarea>
</div>
@endforeach
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'ficha_texto_'.$kidioma; ?>
<div class="col-md-12 form-group{{ has_error($errors, $campo) }}">
    <label>Texto ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $ficha?->$campo) }}</textarea>
</div>
@endforeach