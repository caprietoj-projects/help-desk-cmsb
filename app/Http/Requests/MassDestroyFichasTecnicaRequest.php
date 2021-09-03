<?php

namespace App\Http\Requests;

use App\Models\FichasTecnica;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFichasTecnicaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fichas_tecnica_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fichas_tecnicas,id',
        ];
    }
}
