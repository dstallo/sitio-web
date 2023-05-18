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

<div class="col-md-4 form-group{{ has_error($errors,'nombre') }}">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre',$consulta->nombre) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'email') }}">
    <label>Email</label>
    <input type="email" class="form-control" name="email" value="{{ old('email',$consulta->email) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'telefono') }}">
    <label>Teléfono</label>
    <input type="text" class="form-control" name="telefono" value="{{ old('telefono',$consulta->telefono) }}">
</div>
<div class="col-md-8 form-group{{ has_error($errors,'mensaje') }}">
    <label>Mensaje</label>
    <textarea style="height:180px;" class="form-control" name="mensaje">{{ old('mensaje',$consulta->mensaje) }}</textarea>
</div>