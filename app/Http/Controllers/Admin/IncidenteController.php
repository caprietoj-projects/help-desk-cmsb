<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncidenteRequest;
use App\Http\Requests\StoreIncidenteRequest;
use App\Http\Requests\UpdateIncidenteRequest;
use App\Models\Incidente;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IncidenteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('incidente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Incidente::query()->select(sprintf('%s.*', (new Incidente())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'incidente_show';
                $editGate = 'incidente_edit';
                $deleteGate = 'incidente_delete';
                $crudRoutePart = 'incidentes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('tipo_de_incidente', function ($row) {
                return $row->tipo_de_incidente ? $row->tipo_de_incidente : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.incidentes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('incidente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.incidentes.create');
    }

    public function store(StoreIncidenteRequest $request)
    {
        $incidente = Incidente::create($request->all());

        return redirect()->route('admin.incidentes.index');
    }

    public function edit(Incidente $incidente)
    {
        abort_if(Gate::denies('incidente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.incidentes.edit', compact('incidente'));
    }

    public function update(UpdateIncidenteRequest $request, Incidente $incidente)
    {
        $incidente->update($request->all());

        return redirect()->route('admin.incidentes.index');
    }

    public function show(Incidente $incidente)
    {
        abort_if(Gate::denies('incidente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.incidentes.show', compact('incidente'));
    }

    public function destroy(Incidente $incidente)
    {
        abort_if(Gate::denies('incidente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidente->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidenteRequest $request)
    {
        Incidente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
