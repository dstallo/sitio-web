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
    @if ($texto->raw)
        <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $texto->$campo) }}" />
    @else
        <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $texto->$campo) }}</textarea>
    @endif
</div>
@endforeach
