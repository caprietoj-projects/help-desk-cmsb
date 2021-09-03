<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReporteRequest;
use App\Http\Requests\StoreReporteRequest;
use App\Http\Requests\UpdateReporteRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reporte_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('reporte_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportes.create');
    }

    public function store(StoreReporteRequest $request)
    {
        $reporte = Reporte::create($request->all());

        return redirect()->route('admin.reportes.index');
    }

    public function edit(Reporte $reporte)
    {
        abort_if(Gate::denies('reporte_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportes.edit', compact('reporte'));
    }

    public function update(UpdateReporteRequest $request, Reporte $reporte)
    {
        $reporte->update($request->all());

        return redirect()->route('admin.reportes.index');
    }

    public function show(Reporte $reporte)
    {
        abort_if(Gate::denies('reporte_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportes.show', compact('reporte'));
    }

    public function destroy(Reporte $reporte)
    {
        abort_if(Gate::denies('reporte_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reporte->delete();

        return back();
    }

    public function massDestroy(MassDestroyReporteRequest $request)
    {
        Reporte::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
