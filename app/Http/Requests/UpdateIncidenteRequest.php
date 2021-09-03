<?php

namespace App\Http\Requests;

use App\Models\Incidente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIncidenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('incidente_edit');
    }

    public function rules()
    {
        return [
            'tipo_de_incidente' => [
                'string',
                'nullable',
            ],
        ];
    }
}
