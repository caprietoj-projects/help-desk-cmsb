<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstadoRequest;
use App\Http\Requests\StoreEstadoRequest;
use App\Http\Requests\UpdateEstadoRequest;
use App\Models\Estado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EstadoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('estado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Estado::query()->select(sprintf('%s.*', (new Estado())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'estado_show';
                $editGate = 'estado_edit';
                $deleteGate = 'estado_delete';
                $crudRoutePart = 'estados';

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
            $table->editColumn('estado', function ($row) {
                return $row->estado ? $row->estado : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.estados.index');
    }

    public function create()
    {
        abort_if(Gate::denies('estado_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estados.create');
    }

    public function store(StoreEstadoRequest $request)
    {
        $estado = Estado::create($request->all());

        return redirect()->route('admin.estados.index');
    }

    public function edit(Estado $estado)
    {
        abort_if(Gate::denies('estado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estados.edit', compact('estado'));
    }

    public function update(UpdateEstadoRequest $request, Estado $estado)
    {
        $estado->update($request->all());

        return redirect()->route('admin.estados.index');
    }

    public function show(Estado $estado)
    {
        abort_if(Gate::denies('estado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estados.show', compact('estado'));
    }

    public function destroy(Estado $estado)
    {
        abort_if(Gate::denies('estado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estado->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstadoRequest $request)
    {
        Estado::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
