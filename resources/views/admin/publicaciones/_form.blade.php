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
<div class="col-md-3 form-group{{ has_error($errors, 'categoria') }}">
    <label>Menú</label>
    <select data-search-placeholder="Buscá o creá una categoría nueva" name="categoria" class="select2" data-tags="true" data-placeholder="Elegí la categoría">
        <option></option>
    @foreach($categorias as $m)
        <option value="{{ $m }}" {{ old('categoria', $publicacion->categoria) == $m ? 'selected':'' }}>{{ $m }}</option>
    @endforeach
    </select>
</div>
@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'titulo_'.$kidioma; ?>
<div class="col-md-4 form-group{{ has_error($errors, $campo) }}">
    <label>Título ({{ $idioma }})</label>
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $publicacion->$campo) }}">
</div>
@endforeach
<div class="col-md-6 form-group{{ has_error($errors,'link') }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" value="{{ old('link',$publicacion->link) }}">
    <span class="help-block">Dejar vacío si se carga una ficha.</span>
</div>
<div class="col-md-4 form-group{{ has_error($errors,'thumbnail') }}">
    <label>Thumbnail</label>
    @if($publicacion->tiene('thumbnail'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_publicacion', ['publicacion' => $publicacion, 'campo' => 'thumbnail']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $publicacion->url('thumbnail') }}" data-lity><img src="{{ $publicacion->url('thumbnail') }}"></a>
        </div>
    @else
        <input type="file" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}">
    @endif
</div>
<div class="col-md-4">
    <div class="checkbox icheck">
        <label>
            <input type="checkbox" name="destacado" {{ old('descatado', $publicacion->destacado) ? 'checked':'' }} /> Publicación destacada (Mostrar en Home)
        </label>
    </div>
</div>
@include('admin.parciales.form-ficha', ['ficha' => $publicacion->ficha])
