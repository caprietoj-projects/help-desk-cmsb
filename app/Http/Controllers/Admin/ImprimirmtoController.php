<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyImprimirmtoRequest;
use App\Http\Requests\StoreImprimirmtoRequest;
use App\Http\Requests\UpdateImprimirmtoRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImprimirmtoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('imprimirmto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirmtos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('imprimirmto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirmtos.create');
    }

    public function store(StoreImprimirmtoRequest $request)
    {
        $imprimirmto = Imprimirmto::create($request->all());

        return redirect()->route('admin.imprimirmtos.index');
    }

    public function edit(Imprimirmto $imprimirmto)
    {
        abort_if(Gate::denies('imprimirmto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirmtos.edit', compact('imprimirmto'));
    }

    public function update(UpdateImprimirmtoRequest $request, Imprimirmto $imprimirmto)
    {
        $imprimirmto->update($request->all());

        return redirect()->route('admin.imprimirmtos.index');
    }

    public function show(Imprimirmto $imprimirmto)
    {
        abort_if(Gate::denies('imprimirmto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.imprimirmtos.show', compact('imprimirmto'));
    }

    public function destroy(Imprimirmto $imprimirmto)
    {
        abort_if(Gate::denies('imprimirmto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $imprimirmto->delete();

        return back();
    }

    public function massDestroy(MassDestroyImprimirmtoRequest $request)
    {
        Imprimirmto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
