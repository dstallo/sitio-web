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
    <input type="text" class="form-control" name="{{ $campo }}" value="{{ old($campo, $slide->$campo) }}">
    <span class="help-block">Empezar con . para que no sea visible en el front</span>
</div>
@endforeach
<div class="col-md-12">&nbsp;</div>
<div class="col-md-6 form-group{{ has_error($errors,'link') }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" value="{{ old('link',$slide->link) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'imagen') }}">
    <label>Imagen</label>
    @if($slide->tiene('imagen'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_slide', ['slide' => $slide, 'campo' => 'imagen']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $slide->url('imagen') }}" data-lity><img src="{{ $slide->url('imagen') }}"></a>
        </div>
    @else
        <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}">
    @endif
</div>
<div class="col-md-4 form-group{{ has_error($errors,'imagen_vertical') }}">
    <label>Imagen vertical</label>
    @if($slide->tiene('imagen_vertical'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_slide', ['slide' => $slide, 'campo' => 'imagen_vertical']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $slide->url('imagen_vertical') }}" data-lity><img src="{{ $slide->url('imagen_vertical') }}"></a>
        </div>
    @else
        <input type="file" class="form-control" name="imagen_vertical" value="{{ old('imagen_vertical') }}">
    @endif
</div>