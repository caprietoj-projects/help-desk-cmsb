<?php

namespace App\Http\Requests;

use App\Models\HojasDeVidaMantenimiento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHojasDeVidaMantenimientoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hojas_de_vida_mantenimiento_edit');
    }

    public function rules()
    {
        return [
            'encargado' => [
                'string',
                'required',
            ],
            'nombre_del_equipo' => [
                'string',
                'required',
            ],
            'modelo' => [
                'string',
                'nullable',
            ],
            'serial' => [
                'string',
                'nullable',
            ],
            'sede_id' => [
                'required',
                'integer',
            ],
            'mantenimiento_preventivo' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'mantenimiento_correctivo' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'quien_lo_realiza_id' => [
                'required',
                'integer',
            ],
            'estado_del_activo' => [
                'required',
            ],
        ];
    }
}
