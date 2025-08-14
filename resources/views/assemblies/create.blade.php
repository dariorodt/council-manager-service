@extends('layouts.app')

@section('page-title', 'Create Assembly')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('assemblies.index') }}">Asambleas</a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Crear Nueva Asamblea</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('assemblies.store') }}">
            @csrf
            
            <!-- Basic Assembly Info -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Correlativo</label>
                        <input type="text" class="form-control" name="correlative" value="{{ old('correlative') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="type" required>
                            <option value="">Selecciona...</option>
                            <option value="General">General</option>
                            <option value="Extraordinaria">Extraordinaria</option>
                            <option value="De Ciudadanos">De Ciudadanos</option>
                            <option value="Informativa">Informativa</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="status" required>
                            <option value="Programada">Programada</option>
                            <option value="Finalizada">Finalizada</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha Programada</label>
                        <input type="datetime-local" class="form-control" name="scheduled_date" value="{{ old('scheduled_date') }}" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Motivo</label>
                <textarea class="form-control" name="reason" rows="3" required>{{ old('reason') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Fecha Real (opcional)</label>
                <input type="datetime-local" class="form-control" name="actual_date" value="{{ old('actual_date') }}">
            </div>

            <!-- Attendees Section -->
            <h6 class="mt-4">Asistentes</h6>
            <div id="attendees-section">
                <div class="attendee-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="attendees[0][name]" placeholder="Nombre">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="attendees[0][position]" placeholder="Cargo">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="attendees[0][is_member]">
                                <option value="0">No miembro</option>
                                <option value="1">Miembro</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="attendees[0][attended]">
                                <option value="0">No asistió</option>
                                <option value="1">Asistió</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-attendee">×</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-attendee">Agregar Asistente</button>

            <!-- Subjects Section -->
            <h6 class="mt-4">Asuntos</h6>
            <div id="subjects-section">
                <div class="subject-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="subjects[0][title]" placeholder="Título">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="subjects[0][proposed_by]" placeholder="Propuesto por">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="subjects[0][state]">
                                <option value="Programado">Programado</option>
                                <option value="Debatido">Debatido</option>
                                <option value="Solventado">Solventado</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-subject">×</button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <textarea class="form-control" name="subjects[0][description]" placeholder="Descripción" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-subject">Agregar Asunto</button>

            <!-- Documents Section -->
            <h6 class="mt-4">Documentos</h6>
            <div class="mb-3">
                <select class="form-select" name="document_ids[]" multiple size="6" id="documents-select">
                    @foreach($documents as $document)
                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Mantén Ctrl presionado para seleccionar múltiples documentos. Usa el campo de búsqueda para filtrar.</small>
                <input type="text" class="form-control mt-2" id="document-search" placeholder="Buscar documentos...">
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('assemblies.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
let attendeeIndex = 1;
let subjectIndex = 1;

document.getElementById('add-attendee').addEventListener('click', function() {
    const section = document.getElementById('attendees-section');
    const newItem = document.createElement('div');
    newItem.className = 'attendee-item border p-3 mb-3';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="attendees[${attendeeIndex}][name]" placeholder="Nombre">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="attendees[${attendeeIndex}][position]" placeholder="Cargo">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="attendees[${attendeeIndex}][is_member]">
                    <option value="0">No miembro</option>
                    <option value="1">Miembro</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="attendees[${attendeeIndex}][attended]">
                    <option value="0">No asistió</option>
                    <option value="1">Asistió</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-attendee">×</button>
            </div>
        </div>
    `;
    section.appendChild(newItem);
    attendeeIndex++;
});

document.getElementById('add-subject').addEventListener('click', function() {
    const section = document.getElementById('subjects-section');
    const newItem = document.createElement('div');
    newItem.className = 'subject-item border p-3 mb-3';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="subjects[${subjectIndex}][title]" placeholder="Título">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="subjects[${subjectIndex}][proposed_by]" placeholder="Propuesto por">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="subjects[${subjectIndex}][state]">
                    <option value="Programado">Programado</option>
                    <option value="Debatido">Debatido</option>
                    <option value="Solventado">Solventado</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-subject">×</button>
            </div>
        </div>
        <div class="mt-2">
            <textarea class="form-control" name="subjects[${subjectIndex}][description]" placeholder="Descripción" rows="2"></textarea>
        </div>
    `;
    section.appendChild(newItem);
    subjectIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-attendee')) {
        e.target.closest('.attendee-item').remove();
    }
    if (e.target.classList.contains('remove-subject')) {
        e.target.closest('.subject-item').remove();
    }
});

// Document search functionality
document.getElementById('document-search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const select = document.getElementById('documents-select');
    const options = select.querySelectorAll('option');
    
    options.forEach(option => {
        const text = option.textContent.toLowerCase();
        option.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endsection