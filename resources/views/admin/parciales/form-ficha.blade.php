@php
if (empty($equipos))
    $equipos = \App\Models\Equipo::list();
@endphp
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
<div class="col-md-4 form-group{{ has_error($errors,'equipo') }}">
    <label>Incluir equipo en la ficha</label>
    <select data-search-placeholder="Buscá el equipo" name="equipo" class="select2" data-allow-clear="true" data-placeholder="Elegí el equipo a incluir">
        <option></option>
    @foreach($equipos as $e)
        <option value="{{ $e }}" {{ old('equipo', $ficha?->equipo) == $e ? 'selected':'' }}>{{ $e }}</option>
    @endforeach
    </select>
</div>