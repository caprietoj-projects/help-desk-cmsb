<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFichasTecnicaRequest;
use App\Http\Requests\StoreFichasTecnicaRequest;
use App\Http\Requests\UpdateFichasTecnicaRequest;
use App\Models\Agente;
use App\Models\Componente;
use App\Models\FichasTecnica;
use App\Models\Sede;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FichasTecnicasController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fichas_tecnica_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FichasTecnica::with(['sede', 'componentes', 'quien_lo_realiza', 'created_by'])->select(sprintf('%s.*', (new FichasTecnica())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fichas_tecnica_show';
                $editGate = 'fichas_tecnica_edit';
                $deleteGate = 'fichas_tecnica_delete';
                $crudRoutePart = 'fichas-tecnicas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('encargado', function ($row) {
                return $row->encargado ? $row->encargado : '';
            });
            $table->editColumn('nombre_del_equipo', function ($row) {
                return $row->nombre_del_equipo ? $row->nombre_del_equipo : '';
            });
            $table->editColumn('modelo', function ($row) {
                return $row->modelo ? $row->modelo : '';
            });
            $table->editColumn('serial', function ($row) {
                return $row->serial ? $row->serial : '';
            });
            $table->addColumn('sede_sede', function ($row) {
                return $row->sede ? $row->sede->sede : '';
            });

            $table->editColumn('componentes', function ($row) {
                $labels = [];
                foreach ($row->componentes as $componente) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $componente->nombre_del_activo);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('observaciones', function ($row) {
                return $row->observaciones ? $row->observaciones : '';
            });

            $table->editColumn('descripcion_del_mantenimiento', function ($row) {
                return $row->descripcion_del_mantenimiento ? $row->descripcion_del_mantenimiento : '';
            });
            $table->addColumn('quien_lo_realiza_nombre', function ($row) {
                return $row->quien_lo_realiza ? $row->quien_lo_realiza->nombre : '';
            });

            $table->editColumn('estado_del_activo', function ($row) {
                return $row->estado_del_activo ? FichasTecnica::ESTADO_DEL_ACTIVO_RADIO[$row->estado_del_activo] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'sede', 'componentes', 'quien_lo_realiza']);

            return $table->make(true);
        }

        return view('admin.fichasTecnicas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fichas_tecnica_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sedes = Sede::pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $componentes = Componente::pluck('nombre_del_activo', 'id');

        $quien_lo_realizas = Agente::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.fichasTecnicas.create', compact('sedes', 'componentes', 'quien_lo_realizas'));
    }

    public function store(StoreFichasTecnicaRequest $request)
    {
        $fichasTecnica = FichasTecnica::create($request->all());
        $fichasTecnica->componentes()->sync($request->input('componentes', []));

        return redirect()->route('admin.fichas-tecnicas.index');
    }

    public function edit(FichasTecnica $fichasTecnica)
    {
        abort_if(Gate::denies('fichas_tecnica_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sedes = Sede::pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $componentes = Componente::pluck('nombre_del_activo', 'id');

        $quien_lo_realizas = Agente::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $fichasTecnica->load('sede', 'componentes', 'quien_lo_realiza', 'created_by');

        return view('admin.fichasTecnicas.edit', compact('sedes', 'componentes', 'quien_lo_realizas', 'fichasTecnica'));
    }

    public function update(UpdateFichasTecnicaRequest $request, FichasTecnica $fichasTecnica)
    {
        $fichasTecnica->update($request->all());
        $fichasTecnica->componentes()->sync($request->input('componentes', []));

        return redirect()->route('admin.fichas-tecnicas.index');
    }

    public function show(FichasTecnica $fichasTecnica)
    {
        abort_if(Gate::denies('fichas_tecnica_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fichasTecnica->load('sede', 'componentes', 'quien_lo_realiza', 'created_by');

        return view('admin.fichasTecnicas.show', compact('fichasTecnica'));
    }

    public function destroy(FichasTecnica $fichasTecnica)
    {
        abort_if(Gate::denies('fichas_tecnica_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fichasTecnica->delete();

        return back();
    }

    public function massDestroy(MassDestroyFichasTecnicaRequest $request)
    {
        FichasTecnica::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
