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
<?php $campo = 'valor_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Valor ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $opcion->$campo) }}">
</div>
@endforeach