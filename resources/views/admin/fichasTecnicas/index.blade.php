@extends('layouts.admin')
@section('content')
@can('fichas_tecnica_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fichas-tecnicas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fichasTecnica.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'FichasTecnica', 'route' => 'admin.fichas-tecnicas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.fichasTecnica.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-FichasTecnica">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.encargado') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.nombre_del_equipo') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.modelo') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.serial') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.sede') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.componentes') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.observaciones') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.mantenimiento_preventivo') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.mantenimiento_correctivo') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.descripcion_del_mantenimiento') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.quien_lo_realiza') }}
                    </th>
                    <th>
                        {{ trans('cruds.fichasTecnica.fields.estado_del_activo') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fichas_tecnica_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fichas-tecnicas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.fichas-tecnicas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'encargado', name: 'encargado' },
{ data: 'nombre_del_equipo', name: 'nombre_del_equipo' },
{ data: 'modelo', name: 'modelo' },
{ data: 'serial', name: 'serial' },
{ data: 'sede_sede', name: 'sede.sede' },
{ data: 'componentes', name: 'componentes.nombre_del_activo' },
{ data: 'observaciones', name: 'observaciones' },
{ data: 'mantenimiento_preventivo', name: 'mantenimiento_preventivo' },
{ data: 'mantenimiento_correctivo', name: 'mantenimiento_correctivo' },
{ data: 'descripcion_del_mantenimiento', name: 'descripcion_del_mantenimiento' },
{ data: 'quien_lo_realiza_nombre', name: 'quien_lo_realiza.nombre' },
{ data: 'estado_del_activo', name: 'estado_del_activo' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-FichasTecnica').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection