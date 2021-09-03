<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPrioridadRequest;
use App\Http\Requests\StorePrioridadRequest;
use App\Http\Requests\UpdatePrioridadRequest;
use App\Models\Prioridad;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PrioridadController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('prioridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Prioridad::query()->select(sprintf('%s.*', (new Prioridad())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'prioridad_show';
                $editGate = 'prioridad_edit';
                $deleteGate = 'prioridad_delete';
                $crudRoutePart = 'prioridads';

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
            $table->editColumn('tipo_de_prioridad', function ($row) {
                return $row->tipo_de_prioridad ? $row->tipo_de_prioridad : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.prioridads.index');
    }

    public function create()
    {
        abort_if(Gate::denies('prioridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prioridads.create');
    }

    public function store(StorePrioridadRequest $request)
    {
        $prioridad = Prioridad::create($request->all());

        return redirect()->route('admin.prioridads.index');
    }

    public function edit(Prioridad $prioridad)
    {
        abort_if(Gate::denies('prioridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prioridads.edit', compact('prioridad'));
    }

    public function update(UpdatePrioridadRequest $request, Prioridad $prioridad)
    {
        $prioridad->update($request->all());

        return redirect()->route('admin.prioridads.index');
    }

    public function show(Prioridad $prioridad)
    {
        abort_if(Gate::denies('prioridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.prioridads.show', compact('prioridad'));
    }

    public function destroy(Prioridad $prioridad)
    {
        abort_if(Gate::denies('prioridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prioridad->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrioridadRequest $request)
    {
        Prioridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
