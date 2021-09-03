<?php

namespace App\Http\Requests;

use App\Models\HojasDeVidaMantenimiento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHojasDeVidaMantenimientoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hojas_de_vida_mantenimiento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hojas_de_vida_mantenimientos,id',
        ];
    }
}
