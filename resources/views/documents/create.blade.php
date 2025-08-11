@extends('layouts.app')

@section('page-title', 'Create Document')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item">Ejecutiva</li>
    <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documentos</a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Crear Nuevo Documento</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('documents.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Cargar Archivo</label>
                <input type="file" class="form-control" id="fileUpload" accept=".pdf,.doc,.docx,.txt,.jpg,.png">
                <div class="form-text">Selecciona un archivo para cargar</div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="fileName" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Extensión</label>
                        <input type="text" class="form-control" name="extension" id="fileExtension" value="{{ old('extension') }}" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" class="form-control" name="url" id="fileUrl" value="{{ old('url') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Transcripción</label>
                <textarea class="form-control" name="transcription" rows="5">{{ old('transcription') }}</textarea>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('fileUpload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('file', file);
        
        fetch('{{ route("documents.upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('fileName').value = data.name;
            document.getElementById('fileExtension').value = data.extension;
            document.getElementById('fileUrl').value = data.url;
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
@endsection