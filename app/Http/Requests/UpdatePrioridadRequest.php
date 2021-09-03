<?php

namespace App\Http\Requests;

use App\Models\Prioridad;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePrioridadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prioridad_edit');
    }

    public function rules()
    {
        return [
            'tipo_de_prioridad' => [
                'string',
                'required',
            ],
        ];
    }
}
