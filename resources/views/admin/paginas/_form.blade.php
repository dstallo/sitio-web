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
<div class="col-md-3 form-group{{ has_error($errors, 'menu') }}">
    <label>Menú</label>
    <select data-search-placeholder="Buscá o creá un menú nuevo" name="menu" class="select2" data-tags="true" data-placeholder="Elegí el menú">
        <option></option>
    @foreach($menues as $m)
        <option value="{{ $m }}" {{ old('menu', $pagina->menu) == $m ? 'selected':'' }}>{{ $m }}</option>
    @endforeach
    </select>
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
<div class="col-md-4 form-group">
    <label>Visibilidad</label>
    <div class="checkbox icheck">
        <label>
            <input type="checkbox" value="1" name="visible" {{ old('visible', $pagina->visible) ? 'checked':'' }} /> Página visible en el menú
        </label>
    </div>
</div>
@include('admin.parciales.form-ficha', ['ficha' => $pagina->ficha])
