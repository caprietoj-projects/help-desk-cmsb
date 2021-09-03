@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hojasDeVidaMantenimiento.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hojas-de-vida-mantenimientos.update", [$hojasDeVidaMantenimiento->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="encargado">{{ trans('cruds.hojasDeVidaMantenimiento.fields.encargado') }}</label>
                <input class="form-control {{ $errors->has('encargado') ? 'is-invalid' : '' }}" type="text" name="encargado" id="encargado" value="{{ old('encargado', $hojasDeVidaMantenimiento->encargado) }}" required>
                @if($errors->has('encargado'))
                    <span class="text-danger">{{ $errors->first('encargado') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.encargado_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nombre_del_equipo">{{ trans('cruds.hojasDeVidaMantenimiento.fields.nombre_del_equipo') }}</label>
                <input class="form-control {{ $errors->has('nombre_del_equipo') ? 'is-invalid' : '' }}" type="text" name="nombre_del_equipo" id="nombre_del_equipo" value="{{ old('nombre_del_equipo', $hojasDeVidaMantenimiento->nombre_del_equipo) }}" required>
                @if($errors->has('nombre_del_equipo'))
                    <span class="text-danger">{{ $errors->first('nombre_del_equipo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.nombre_del_equipo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="modelo">{{ trans('cruds.hojasDeVidaMantenimiento.fields.modelo') }}</label>
                <input class="form-control {{ $errors->has('modelo') ? 'is-invalid' : '' }}" type="text" name="modelo" id="modelo" value="{{ old('modelo', $hojasDeVidaMantenimiento->modelo) }}">
                @if($errors->has('modelo'))
                    <span class="text-danger">{{ $errors->first('modelo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.modelo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serial">{{ trans('cruds.hojasDeVidaMantenimiento.fields.serial') }}</label>
                <input class="form-control {{ $errors->has('serial') ? 'is-invalid' : '' }}" type="text" name="serial" id="serial" value="{{ old('serial', $hojasDeVidaMantenimiento->serial) }}">
                @if($errors->has('serial'))
                    <span class="text-danger">{{ $errors->first('serial') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.serial_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sede_id">{{ trans('cruds.hojasDeVidaMantenimiento.fields.sede') }}</label>
                <select class="form-control select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}" name="sede_id" id="sede_id" required>
                    @foreach($sedes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('sede_id') ? old('sede_id') : $hojasDeVidaMantenimiento->sede->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sede'))
                    <span class="text-danger">{{ $errors->first('sede') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.sede_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observaciones">{{ trans('cruds.hojasDeVidaMantenimiento.fields.observaciones') }}</label>
                <textarea class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" name="observaciones" id="observaciones">{{ old('observaciones', $hojasDeVidaMantenimiento->observaciones) }}</textarea>
                @if($errors->has('observaciones'))
                    <span class="text-danger">{{ $errors->first('observaciones') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.observaciones_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mantenimiento_preventivo">{{ trans('cruds.hojasDeVidaMantenimiento.fields.mantenimiento_preventivo') }}</label>
                <input class="form-control date {{ $errors->has('mantenimiento_preventivo') ? 'is-invalid' : '' }}" type="text" name="mantenimiento_preventivo" id="mantenimiento_preventivo" value="{{ old('mantenimiento_preventivo', $hojasDeVidaMantenimiento->mantenimiento_preventivo) }}">
                @if($errors->has('mantenimiento_preventivo'))
                    <span class="text-danger">{{ $errors->first('mantenimiento_preventivo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.mantenimiento_preventivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mantenimiento_correctivo">{{ trans('cruds.hojasDeVidaMantenimiento.fields.mantenimiento_correctivo') }}</label>
                <input class="form-control date {{ $errors->has('mantenimiento_correctivo') ? 'is-invalid' : '' }}" type="text" name="mantenimiento_correctivo" id="mantenimiento_correctivo" value="{{ old('mantenimiento_correctivo', $hojasDeVidaMantenimiento->mantenimiento_correctivo) }}">
                @if($errors->has('mantenimiento_correctivo'))
                    <span class="text-danger">{{ $errors->first('mantenimiento_correctivo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.mantenimiento_correctivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion_del_mantenimiento">{{ trans('cruds.hojasDeVidaMantenimiento.fields.descripcion_del_mantenimiento') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion_del_mantenimiento') ? 'is-invalid' : '' }}" name="descripcion_del_mantenimiento" id="descripcion_del_mantenimiento">{{ old('descripcion_del_mantenimiento', $hojasDeVidaMantenimiento->descripcion_del_mantenimiento) }}</textarea>
                @if($errors->has('descripcion_del_mantenimiento'))
                    <span class="text-danger">{{ $errors->first('descripcion_del_mantenimiento') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.descripcion_del_mantenimiento_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quien_lo_realiza_id">{{ trans('cruds.hojasDeVidaMantenimiento.fields.quien_lo_realiza') }}</label>
                <select class="form-control select2 {{ $errors->has('quien_lo_realiza') ? 'is-invalid' : '' }}" name="quien_lo_realiza_id" id="quien_lo_realiza_id" required>
                    @foreach($quien_lo_realizas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('quien_lo_realiza_id') ? old('quien_lo_realiza_id') : $hojasDeVidaMantenimiento->quien_lo_realiza->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quien_lo_realiza'))
                    <span class="text-danger">{{ $errors->first('quien_lo_realiza') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.quien_lo_realiza_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.hojasDeVidaMantenimiento.fields.estado_del_activo') }}</label>
                @foreach(App\Models\HojasDeVidaMantenimiento::ESTADO_DEL_ACTIVO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('estado_del_activo') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="estado_del_activo_{{ $key }}" name="estado_del_activo" value="{{ $key }}" {{ old('estado_del_activo', $hojasDeVidaMantenimiento->estado_del_activo) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="estado_del_activo_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('estado_del_activo'))
                    <span class="text-danger">{{ $errors->first('estado_del_activo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hojasDeVidaMantenimiento.fields.estado_del_activo_helper') }}</span>
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