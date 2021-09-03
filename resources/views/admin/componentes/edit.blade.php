@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.componente.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.componentes.update", [$componente->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombre_del_activo">{{ trans('cruds.componente.fields.nombre_del_activo') }}</label>
                <input class="form-control {{ $errors->has('nombre_del_activo') ? 'is-invalid' : '' }}" type="text" name="nombre_del_activo" id="nombre_del_activo" value="{{ old('nombre_del_activo', $componente->nombre_del_activo) }}" required>
                @if($errors->has('nombre_del_activo'))
                    <span class="text-danger">{{ $errors->first('nombre_del_activo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.componente.fields.nombre_del_activo_helper') }}</span>
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