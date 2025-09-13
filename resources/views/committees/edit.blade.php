@extends('layouts.app')

@section('page-title', 'Editar Comité')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('committees.index') }}">Comités</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Comité</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('committees.update', $committee) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $committee->name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Responsable</label>
                        <select class="form-select" name="responsible_id">
                            <option value="">Seleccionar...</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('responsible_id', $committee->responsible_id) == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="status" required>
                            <option value="Creado" {{ old('status', $committee->status) == 'Creado' ? 'selected' : '' }}>Creado</option>
                            <option value="En Funciones" {{ old('status', $committee->status) == 'En Funciones' ? 'selected' : '' }}>En Funciones</option>
                            <option value="Suspendido" {{ old('status', $committee->status) == 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Creación</label>
                        <input type="date" class="form-control" name="creation_date" value="{{ old('creation_date', $committee->creation_date->format('Y-m-d')) }}" required>
                    </div>
                </div>
            </div>
            
            <!-- Functions Section -->
            <h6 class="mt-4">Funciones</h6>
            <div id="functions-section">
                @foreach($committee->functions as $index => $function)
                    <div class="function-item border p-3 mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="functions[{{ $index }}][nombre]" placeholder="Nombre" value="{{ $function->nombre }}">
                                <input type="hidden" name="functions[{{ $index }}][id]" value="{{ $function->id }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="functions[{{ $index }}][ref_act]" placeholder="Ref. Acta" value="{{ $function->ref_act }}">
                            </div>
                            <div class="col-md-4">
                                <textarea class="form-control" name="functions[{{ $index }}][descripcion]" placeholder="Descripción" rows="1">{{ $function->descripcion }}</textarea>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove-function">×</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="function-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="functions[{{ $committee->functions->count() }}][nombre]" placeholder="Nombre">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="functions[{{ $committee->functions->count() }}][ref_act]" placeholder="Ref. Acta">
                        </div>
                        <div class="col-md-4">
                            <textarea class="form-control" name="functions[{{ $committee->functions->count() }}][descripcion]" placeholder="Descripción" rows="1"></textarea>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-function">×</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-function">Agregar Función</button>
            
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('committees.show', $committee) }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
let functionIndex = {{ $committee->functions->count() + 1 }};

document.getElementById('add-function').addEventListener('click', function() {
    const section = document.getElementById('functions-section');
    const newItem = document.createElement('div');
    newItem.className = 'function-item border p-3 mb-3';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" name="functions[${functionIndex}][nombre]" placeholder="Nombre">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="functions[${functionIndex}][ref_act]" placeholder="Ref. Acta">
            </div>
            <div class="col-md-4">
                <textarea class="form-control" name="functions[${functionIndex}][descripcion]" placeholder="Descripción" rows="1"></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-function">×</button>
            </div>
        </div>
    `;
    section.appendChild(newItem);
    functionIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-function')) {
        e.target.closest('.function-item').remove();
    }
});
</script>
@endsection