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
<div class="col-md-4 form-group{{ has_error($errors,'equipo') }}">
    <label>Equipo</label>
    <select data-search-placeholder="Buscá o creá un equipo nuevo" name="equipo" class="select2" data-tags="true" data-placeholder="Elegí el equipo">
        <option></option>
    @foreach($equipos as $e)
        <option value="{{ $e }}" {{ old('equipo', $equipo->equipo) == $e ? 'selected':'' }}>{{ $e }}</option>
    @endforeach
    </select>
</div>
<div class="col-md-8 form-group{{ has_error($errors,'nombre') }}">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre',$equipo->nombre) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'imagen') }}">
    <label>Foto</label>
    @if($equipo->tiene('imagen'))
        <div style="position:relative;">
            <div style="position:absolute; left:-14px; top:4px;">
                <a href="{{ route('eliminar_archivo_equipo', ['equipo' => $equipo, 'campo' => 'imagen']) }}" class="btn btn-circle btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <a href="{{ $equipo->url('imagen') }}" data-lity style="padding-left:20px;"><img src="{{ $equipo->url('imagen') }}" width="100"></a>
        </div>
    @else
        <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}">
    @endif
</div>
<div class="col-md-8 form-group{{ has_error($errors,'descripcion') }}">
    <label>Descripción / Rol</label>
    <input type="text" class="form-control" name="descripcion" value="{{ old('link',$equipo->descripcion) }}">
</div>