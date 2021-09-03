<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyImprimirRequest;
use App\Http\Requests\StoreImprimirRequest;
use App\Http\Requests\UpdateImprimirRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImprimirController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('imprimir_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('imprimir_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirs.create');
    }

    public function store(StoreImprimirRequest $request)
    {
        $imprimir = Imprimir::create($request->all());

        return redirect()->route('admin.imprimirs.index');
    }

    public function edit(Imprimir $imprimir)
    {
        abort_if(Gate::denies('imprimir_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirs.edit', compact('imprimir'));
    }

    public function update(UpdateImprimirRequest $request, Imprimir $imprimir)
    {
        $imprimir->update($request->all());

        return redirect()->route('admin.imprimirs.index');
    }

    public function show(Imprimir $imprimir)
    {
        abort_if(Gate::denies('imprimir_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirs.show', compact('imprimir'));
    }

    public function destroy(Imprimir $imprimir)
    {
        abort_if(Gate::denies('imprimir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $imprimir->delete();

        return back();
    }

    public function massDestroy(MassDestroyImprimirRequest $request)
    {
        Imprimir::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
