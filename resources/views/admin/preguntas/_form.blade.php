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
<div class="col-md-6 form-group{{ has_error($errors,'pregunta') }}">
    <label>Pregunta</label>
    <input type="text" class="form-control" name="pregunta" value="{{ old('pregunta',$pregunta->pregunta) }}">
</div>