@extends('layouts.app')

@section('page-title', 'Editar Proyecto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Proyectos</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Proyecto</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $project->name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Comité</label>
                        <select class="form-select" name="committee_id" required>
                            <option value="">Seleccionar...</option>
                            @foreach($committees as $committee)
                                <option value="{{ $committee->id }}" {{ old('committee_id', $project->committee_id) == $committee->id ? 'selected' : '' }}>
                                    {{ $committee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Función</label>
                        <select class="form-select" name="function_id">
                            <option value="">Seleccionar...</option>
                            @foreach($functions as $function)
                                <option value="{{ $function->id }}" {{ old('function_id', $project->function_id) == $function->id ? 'selected' : '' }}>
                                    {{ $function->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="status" required>
                            <option value="programado" {{ old('status', $project->status) == 'programado' ? 'selected' : '' }}>Programado</option>
                            <option value="en_ejecucion" {{ old('status', $project->status) == 'en_ejecucion' ? 'selected' : '' }}>En Ejecución</option>
                            <option value="suspendido" {{ old('status', $project->status) == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                            <option value="completado" {{ old('status', $project->status) == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="cancelado" {{ old('status', $project->status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Inicio Planificado</label>
                        <input type="datetime-local" class="form-control" name="planned_start" value="{{ old('planned_start', $project->planned_start ? $project->planned_start->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Fin Planificado</label>
                        <input type="datetime-local" class="form-control" name="planned_end" value="{{ old('planned_end', $project->planned_end ? $project->planned_end->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Duración</label>
                        <input type="text" class="form-control" name="duration" value="{{ old('duration', $project->duration) }}" placeholder="ej: 30 días">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Avance (%)</label>
                <input type="number" class="form-control" name="advance" value="{{ old('advance', $project->advance) }}" min="0" max="100">
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection