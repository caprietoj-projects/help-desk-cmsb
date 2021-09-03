<?php

namespace App\Http\Requests;

use App\Models\Agente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAgenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('agente_edit');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'required',
            ],
            'cargo' => [
                'string',
                'required',
            ],
            'correo' => [
                'required',
            ],
        ];
    }
}
