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

<div class="row">
    @foreach(config('idiomas.idiomas') as $kidioma => $idioma)
    <?php $campo = 'titulo_'.$kidioma; ?>
    <div class="col-md-4 form-group{{ has_error($errors, $campo) }}">
        <label>Título ({{ $idioma }})</label>
        <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $evento->$campo) }}">
    </div>
    @endforeach
    <div class="col-md-4 form-group{{ has_error($errors,'fecha') }}">
        <label>Fecha</label>
        <input type="datetime-local" class="form-control" name="fecha" value="{{ old('link', $evento->fecha) }}">
    </div>
    <div class="col-md-4 form-group{{ has_error($errors,'link') }}">
        <label>Link</label>
        <input type="text" class="form-control" name="link" value="{{ old('link',$evento->link) }}">
        <span class="help-block">Opcional link a sitio web del evento.</span>
    </div>
</div>
