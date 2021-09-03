<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Agente;
use App\Models\Estado;
use App\Models\Incidente;
use App\Models\Prioridad;
use App\Models\Sede;
use App\Models\Ticket;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TicketsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ticket::with(['id_incidente', 'id_prioridad', 'id_sede', 'id_estado', 'id_asignado', 'created_by'])->select(sprintf('%s.*', (new Ticket())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ticket_show';
                $editGate = 'ticket_edit';
                $deleteGate = 'ticket_delete';
                $crudRoutePart = 'tickets';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : '';
            });
            $table->addColumn('id_incidente_tipo_de_incidente', function ($row) {
                return $row->id_incidente ? $row->id_incidente->tipo_de_incidente : '';
            });

            $table->addColumn('id_prioridad_tipo_de_prioridad', function ($row) {
                return $row->id_prioridad ? $row->id_prioridad->tipo_de_prioridad : '';
            });

            $table->addColumn('id_sede_sede', function ($row) {
                return $row->id_sede ? $row->id_sede->sede : '';
            });

            $table->editColumn('adjuntar_archivo', function ($row) {
                return $row->adjuntar_archivo ? '<a href="' . $row->adjuntar_archivo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('id_estado_estado', function ($row) {
                return $row->id_estado ? $row->id_estado->estado : '';
            });

            $table->addColumn('id_asignado_nombre', function ($row) {
                return $row->id_asignado ? $row->id_asignado->nombre : '';
            });

            $table->editColumn('id_asignado.correo', function ($row) {
                return $row->id_asignado ? (is_string($row->id_asignado) ? $row->id_asignado : $row->id_asignado->correo) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'id_incidente', 'id_prioridad', 'id_sede', 'adjuntar_archivo', 'id_estado', 'id_asignado']);

            return $table->make(true);
        }

        $incidentes = Incidente::get();
        $prioridads = Prioridad::get();
        $sedes      = Sede::get();
        $estados    = Estado::get();
        $agentes    = Agente::get();
        $users      = User::get();

        return view('admin.tickets.index', compact('incidentes', 'prioridads', 'sedes', 'estados', 'agentes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_incidentes = Incidente::pluck('tipo_de_incidente', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_prioridads = Prioridad::pluck('tipo_de_prioridad', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_sedes = Sede::pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_estados = Estado::pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tickets.create', compact('id_incidentes', 'id_prioridads', 'id_sedes', 'id_estados'));
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->all());

        if ($request->input('adjuntar_archivo', false)) {
            $ticket->addMedia(storage_path('tmp/uploads/' . basename($request->input('adjuntar_archivo'))))->toMediaCollection('adjuntar_archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ticket->id]);
        }

        return redirect()->route('admin.tickets.index');
    }

    public function edit(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_incidentes = Incidente::pluck('tipo_de_incidente', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_prioridads = Prioridad::pluck('tipo_de_prioridad', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_sedes = Sede::pluck('sede', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_estados = Estado::pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $id_asignados = Agente::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ticket->load('id_incidente', 'id_prioridad', 'id_sede', 'id_estado', 'id_asignado', 'created_by');

        return view('admin.tickets.edit', compact('id_incidentes', 'id_prioridads', 'id_sedes', 'id_estados', 'id_asignados', 'ticket'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());

        if ($request->input('adjuntar_archivo', false)) {
            if (!$ticket->adjuntar_archivo || $request->input('adjuntar_archivo') !== $ticket->adjuntar_archivo->file_name) {
                if ($ticket->adjuntar_archivo) {
                    $ticket->adjuntar_archivo->delete();
                }
                $ticket->addMedia(storage_path('tmp/uploads/' . basename($request->input('adjuntar_archivo'))))->toMediaCollection('adjuntar_archivo');
            }
        } elseif ($ticket->adjuntar_archivo) {
            $ticket->adjuntar_archivo->delete();
        }

        return redirect()->route('admin.tickets.index');
    }

    public function show(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->load('id_incidente', 'id_prioridad', 'id_sede', 'id_estado', 'id_asignado', 'created_by');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->delete();

        return back();
    }

    public function massDestroy(MassDestroyTicketRequest $request)
    {
        Ticket::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ticket_create') && Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ticket();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
