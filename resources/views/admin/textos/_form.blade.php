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
<?php $campo = 'texto_'.$kidioma; ?>
<div class="col-md-12 form-group{{ has_error($errors, $campo) }}">
    <label>Texto ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $texto->$campo) }}</textarea>
</div>
@endforeach
