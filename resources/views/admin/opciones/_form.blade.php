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
<div class="col-md-6 form-group{{ has_error($errors,'valor') }}">
    <label>Valor</label>
    <input type="text" class="form-control" name="valor" value="{{ old('valor',$opcion->valor) }}">
</div>