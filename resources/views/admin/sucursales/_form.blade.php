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

    <div class="col-md-4 form-group{{ has_error($errors, "nombre") }}">
        <label>Nombre</label>
        <input type="text" class="form-control" name="nombre" value="{{ old("nombre", $sucursal->nombre) }}">
    </div>

    <div class="col-md-4 form-group{{ has_error($errors,'link') }}">
        <label>Link</label>
        <input type="text" class="form-control" name="link" value="{{ old('link',$sucursal->link) }}">
        <span class="help-block">Opcional link a sitio web de la sucursal.</span>
    </div>
    <div class="col-md-4 form-group{{ has_error($errors,'thumbnail') }}">
        <label>Thumbnail</label>
        @if($sucursal->tiene('thumbnail'))
            <div style="position:relative;">
                <div style="position:absolute; left:-14px; top:4px;">
                    <a href="{{ route('eliminar_archivo_sucursal', ['sucursal' => $sucursal, 'campo' => 'thumbnail']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <a href="{{ $sucursal->url('thumbnail') }}" data-lity><img src="{{ $sucursal->url('thumbnail') }}"></a>
            </div>
        @else
            <input type="file" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}">
        @endif
    </div>
<div style="clear:both;"></div>

    <div class="col-md-3 form-group{{ has_error($errors, "direccion") }}">
        <label>Dirección</label>
        <input type="text" class="form-control" name="direccion" value="{{ old("direccion", $sucursal->direccion) }}">
    </div>
    <div class="col-md-3 form-group{{ has_error($errors, "horarios") }}">
        <label>Horarios</label>
        <input type="text" class="form-control" name="horarios" value="{{ old("horarios", $sucursal->horarios) }}">
    </div>
    <div class="col-md-3 form-group{{ has_error($errors, "telefono") }}">
        <label>Teléfono</label>
        <input type="text" class="form-control" name="telefono" value="{{ old("telefono", $sucursal->telefono) }}">
    </div>
    <div class="col-md-3 form-group{{ has_error($errors, "email") }}">
        <label>E-Mail</label>
        <input type="text" class="form-control" name="email" value="{{ old("email", $sucursal->email) }}">
    </div>

@foreach(config('idiomas.idiomas') as $kidioma => $idioma)
<?php $campo = 'bajada_'.$kidioma; ?>
<div class="col-md-6 form-group{{ has_error($errors, $campo) }}">
    <label>Bajada ({{ $idioma }})</label>
    <textarea style="height:180px;" class="tiny" name="{{ $campo }}">{{ old($campo, $sucursal->$campo) }}</textarea>
</div>
@endforeach

