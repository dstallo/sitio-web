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
<div class="col-md-6 form-group{{ has_error($errors,'titulo') }}">
    <label>Título</label>
    <input type="text" class="form-control" name="titulo" value="{{ old('titulo',$servicio->titulo) }}">
</div>
<div class="col-md-6 form-group{{ has_error($errors,'link') }}">
    <label>Link</label>
    <input type="text" class="form-control" name="link" value="{{ old('link',$servicio->link) }}">
    <span class="help-block">Dejar vacío si se carga una ficha.</span>
</div>
<div class="col-md-6 form-group{{ has_error($errors,'texto') }}">
    <label>Texto</label>
    <textarea style="height:180px;" class="form-control" name="texto">{{ old('texto',$servicio->texto) }}</textarea>
</div>
<div class="col-md-12"><hr><h4>Ficha</h4></div>
<div class="col-md-4 form-group{{ has_error($errors,'titulo') }}">
    <label>Título</label>
    <input type="text" class="form-control" name="ficha_titulo" value="{{ old('titulo',$servicio->ficha_titulo) }}">
</div>
<div class="col-md-8 form-group{{ has_error($errors,'bajada') }}">
    <label>Bajada</label>
    <textarea class="form-control" style="height:180px;" name="ficha_bajada">{{ old('ficha_bajada',$servicio->ficha_bajada) }}</textarea>
</div>
<div class="col-md-12 form-group{{ has_error($errors,'texto') }}">
    <label>Texto</label>
    <textarea class="tiny" style="height:180px;" name="ficha_texto">{{ old('ficha_texto',$servicio->ficha_texto) }}</textarea>
</div>
