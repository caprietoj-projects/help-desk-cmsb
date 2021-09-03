<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHojasDeVidaMantenimientoRequest;
use App\Http\Requests\StoreHojasDeVidaMantenimientoRequest;
use App\Http\Requests\UpdateHojasDeVidaMantenimientoRequest;
use App\Models\Agente;
use App\Models\HojasDeVidaMantenimiento;
use App\Models\Sede;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HojasDeVidaMantenimientoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hojas_de_vida_mantenimiento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HojasDeVidaMantenimiento::with(['sede', 'quien_lo_realiza', 'created_by'])->select(sprintf('%s.*', (new HojasDeVidaMantenimiento())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hojas_de_vida_mantenimiento_show';
                $editGate = 'hojas_de_vida_mantenimiento_edit';
                $deleteGate = 'hojas_de_vida_mantenimiento_delete';
                $crudRoutePart = 'hojas-de-vida-mantenimientos';

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
                return $row->estado_del_activo ? HojasDeVidaMantenimiento::ESTADO_DEL_ACTIVO_RADIO[$row->estado_del_activo] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'sede', 'quien_lo_realiza']);

            return $table->make(true);
        }

        return view('admin.hojasDeVidaMantenimientos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hojas_de_vida_mantenimiento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sedes = Sede::pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quien_lo_realizas = Agente::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hojasDeVidaMantenimientos.create', compact('sedes', 'quien_lo_realizas'));
    }

    public function store(StoreHojasDeVidaMantenimientoRequest $request)
    {
        $hojasDeVidaMantenimiento = HojasDeVidaMantenimiento::create($request->all());

        return redirect()->route('admin.hojas-de-vida-mantenimientos.index');
    }

    public function edit(HojasDeVidaMantenimiento $hojasDeVidaMantenimiento)
    {
        abort_if(Gate::denies('hojas_de_vida_mantenimiento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sedes = Sede::pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quien_lo_realizas = Agente::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hojasDeVidaMantenimiento->load('sede', 'quien_lo_realiza', 'created_by');

        return view('admin.hojasDeVidaMantenimientos.edit', compact('sedes', 'quien_lo_realizas', 'hojasDeVidaMantenimiento'));
    }

    public function update(UpdateHojasDeVidaMantenimientoRequest $request, HojasDeVidaMantenimiento $hojasDeVidaMantenimiento)
    {
        $hojasDeVidaMantenimiento->update($request->all());

        return redirect()->route('admin.hojas-de-vida-mantenimientos.index');
    }

    public function show(HojasDeVidaMantenimiento $hojasDeVidaMantenimiento)
    {
        abort_if(Gate::denies('hojas_de_vida_mantenimiento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hojasDeVidaMantenimiento->load('sede', 'quien_lo_realiza', 'created_by');

        return view('admin.hojasDeVidaMantenimientos.show', compact('hojasDeVidaMantenimiento'));
    }

    public function destroy(HojasDeVidaMantenimiento $hojasDeVidaMantenimiento)
    {
        abort_if(Gate::denies('hojas_de_vida_mantenimiento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hojasDeVidaMantenimiento->delete();

        return back();
    }

    public function massDestroy(MassDestroyHojasDeVidaMantenimientoRequest $request)
    {
        HojasDeVidaMantenimiento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
