@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ticket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tickets.update", [$ticket->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">{{ trans('cruds.ticket.fields.nombre') }}</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', $ticket->nombre) }}" required>
                @if($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.nombre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="correo">{{ trans('cruds.ticket.fields.correo') }}</label>
                <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="email" name="correo" id="correo" value="{{ old('correo', $ticket->correo) }}" required>
                @if($errors->has('correo'))
                    <span class="text-danger">{{ $errors->first('correo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.correo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_incidente_id">{{ trans('cruds.ticket.fields.id_incidente') }}</label>
                <select class="form-control select2 {{ $errors->has('id_incidente') ? 'is-invalid' : '' }}" name="id_incidente_id" id="id_incidente_id" required>
                    @foreach($id_incidentes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('id_incidente_id') ? old('id_incidente_id') : $ticket->id_incidente->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_incidente'))
                    <span class="text-danger">{{ $errors->first('id_incidente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.id_incidente_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_prioridad_id">{{ trans('cruds.ticket.fields.id_prioridad') }}</label>
                <select class="form-control select2 {{ $errors->has('id_prioridad') ? 'is-invalid' : '' }}" name="id_prioridad_id" id="id_prioridad_id" required>
                    @foreach($id_prioridads as $id => $entry)
                        <option value="{{ $id }}" {{ (old('id_prioridad_id') ? old('id_prioridad_id') : $ticket->id_prioridad->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_prioridad'))
                    <span class="text-danger">{{ $errors->first('id_prioridad') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.id_prioridad_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="id_sede_id">{{ trans('cruds.ticket.fields.id_sede') }}</label>
                <select class="form-control select2 {{ $errors->has('id_sede') ? 'is-invalid' : '' }}" name="id_sede_id" id="id_sede_id" required>
                    @foreach($id_sedes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('id_sede_id') ? old('id_sede_id') : $ticket->id_sede->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_sede'))
                    <span class="text-danger">{{ $errors->first('id_sede') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.id_sede_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comentenos_mas_sobre_su_incidencia">{{ trans('cruds.ticket.fields.comentenos_mas_sobre_su_incidencia') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('comentenos_mas_sobre_su_incidencia') ? 'is-invalid' : '' }}" name="comentenos_mas_sobre_su_incidencia" id="comentenos_mas_sobre_su_incidencia">{!! old('comentenos_mas_sobre_su_incidencia', $ticket->comentenos_mas_sobre_su_incidencia) !!}</textarea>
                @if($errors->has('comentenos_mas_sobre_su_incidencia'))
                    <span class="text-danger">{{ $errors->first('comentenos_mas_sobre_su_incidencia') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.comentenos_mas_sobre_su_incidencia_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="adjuntar_archivo">{{ trans('cruds.ticket.fields.adjuntar_archivo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('adjuntar_archivo') ? 'is-invalid' : '' }}" id="adjuntar_archivo-dropzone">
                </div>
                @if($errors->has('adjuntar_archivo'))
                    <span class="text-danger">{{ $errors->first('adjuntar_archivo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.adjuntar_archivo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_estado_id">{{ trans('cruds.ticket.fields.id_estado') }}</label>
                <select class="form-control select2 {{ $errors->has('id_estado') ? 'is-invalid' : '' }}" name="id_estado_id" id="id_estado_id">
                    @foreach($id_estados as $id => $entry)
                        <option value="{{ $id }}" {{ (old('id_estado_id') ? old('id_estado_id') : $ticket->id_estado->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_estado'))
                    <span class="text-danger">{{ $errors->first('id_estado') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.id_estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_asignado_id">{{ trans('cruds.ticket.fields.id_asignado') }}</label>
                <select class="form-control select2 {{ $errors->has('id_asignado') ? 'is-invalid' : '' }}" name="id_asignado_id" id="id_asignado_id">
                    @foreach($id_asignados as $id => $entry)
                        <option value="{{ $id }}" {{ (old('id_asignado_id') ? old('id_asignado_id') : $ticket->id_asignado->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_asignado'))
                    <span class="text-danger">{{ $errors->first('id_asignado') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.id_asignado_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.tickets.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $ticket->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.adjuntarArchivoDropzone = {
    url: '{{ route('admin.tickets.storeMedia') }}',
    maxFilesize: 1024, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1024
    },
    success: function (file, response) {
      $('form').find('input[name="adjuntar_archivo"]').remove()
      $('form').append('<input type="hidden" name="adjuntar_archivo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="adjuntar_archivo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ticket) && $ticket->adjuntar_archivo)
      var file = {!! json_encode($ticket->adjuntar_archivo) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="adjuntar_archivo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection