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
<div class="col-md-4 form-group{{ has_error($errors,'email') }}">
    <label>E-Mail</label>
    <input type="text" class="form-control" name="email" value="{{ old('email',$inscripto->email) }}">
</div>