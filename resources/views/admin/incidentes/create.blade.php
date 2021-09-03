@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.incidente.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incidentes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipo_de_incidente">{{ trans('cruds.incidente.fields.tipo_de_incidente') }}</label>
                <input class="form-control {{ $errors->has('tipo_de_incidente') ? 'is-invalid' : '' }}" type="text" name="tipo_de_incidente" id="tipo_de_incidente" value="{{ old('tipo_de_incidente', '') }}">
                @if($errors->has('tipo_de_incidente'))
                    <span class="text-danger">{{ $errors->first('tipo_de_incidente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.incidente.fields.tipo_de_incidente_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection