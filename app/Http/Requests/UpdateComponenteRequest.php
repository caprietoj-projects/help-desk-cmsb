<?php

namespace App\Http\Requests;

use App\Models\Componente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComponenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('componente_edit');
    }

    public function rules()
    {
        return [
            'nombre_del_activo' => [
                'string',
                'required',
            ],
        ];
    }
}
