<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgenteRequest;
use App\Http\Requests\StoreAgenteRequest;
use App\Http\Requests\UpdateAgenteRequest;
use App\Models\Agente;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgentesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('agente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Agente::query()->select(sprintf('%s.*', (new Agente())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'agente_show';
                $editGate = 'agente_edit';
                $deleteGate = 'agente_delete';
                $crudRoutePart = 'agentes';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('cargo', function ($row) {
                return $row->cargo ? $row->cargo : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.agentes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentes.create');
    }

    public function store(StoreAgenteRequest $request)
    {
        $agente = Agente::create($request->all());

        return redirect()->route('admin.agentes.index');
    }

    public function edit(Agente $agente)
    {
        abort_if(Gate::denies('agente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentes.edit', compact('agente'));
    }

    public function update(UpdateAgenteRequest $request, Agente $agente)
    {
        $agente->update($request->all());

        return redirect()->route('admin.agentes.index');
    }

    public function show(Agente $agente)
    {
        abort_if(Gate::denies('agente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agentes.show', compact('agente'));
    }

    public function destroy(Agente $agente)
    {
        abort_if(Gate::denies('agente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agente->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgenteRequest $request)
    {
        Agente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
