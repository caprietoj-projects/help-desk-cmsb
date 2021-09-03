@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hojasDeVidaMantenimiento.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hojas-de-vida-mantenimientos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.id') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.encargado') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->encargado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.nombre_del_equipo') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->nombre_del_equipo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.modelo') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->modelo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.serial') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->serial }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.sede') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->sede->sede ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.observaciones') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->observaciones }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.mantenimiento_preventivo') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->mantenimiento_preventivo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.mantenimiento_correctivo') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->mantenimiento_correctivo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.descripcion_del_mantenimiento') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->descripcion_del_mantenimiento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.quien_lo_realiza') }}
                        </th>
                        <td>
                            {{ $hojasDeVidaMantenimiento->quien_lo_realiza->nombre ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hojasDeVidaMantenimiento.fields.estado_del_activo') }}
                        </th>
                        <td>
                            {{ App\Models\HojasDeVidaMantenimiento::ESTADO_DEL_ACTIVO_RADIO[$hojasDeVidaMantenimiento->estado_del_activo] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hojas-de-vida-mantenimientos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection