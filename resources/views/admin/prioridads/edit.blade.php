@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.prioridad.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prioridads.update", [$prioridad->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="tipo_de_prioridad">{{ trans('cruds.prioridad.fields.tipo_de_prioridad') }}</label>
                <input class="form-control {{ $errors->has('tipo_de_prioridad') ? 'is-invalid' : '' }}" type="text" name="tipo_de_prioridad" id="tipo_de_prioridad" value="{{ old('tipo_de_prioridad', $prioridad->tipo_de_prioridad) }}" required>
                @if($errors->has('tipo_de_prioridad'))
                    <span class="text-danger">{{ $errors->first('tipo_de_prioridad') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.prioridad.fields.tipo_de_prioridad_helper') }}</span>
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