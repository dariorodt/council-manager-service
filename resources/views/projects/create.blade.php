@extends('layouts.app')

@section('page-title', 'Crear Proyecto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Proyectos</a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Crear Nuevo Proyecto</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('projects.store') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Comité</label>
                        <select class="form-select" name="committee_id" required>
                            <option value="">Seleccionar...</option>
                            @foreach($committees as $committee)
                                <option value="{{ $committee->id }}">{{ $committee->name }}</option>
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
                                <option value="{{ $function->id }}">{{ $function->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="status" required>
                            <option value="programado">Programado</option>
                            <option value="en_ejecucion">En Ejecución</option>
                            <option value="suspendido">Suspendido</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Inicio Planificado</label>
                        <input type="datetime-local" class="form-control" name="planned_start" value="{{ old('planned_start') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Fin Planificado</label>
                        <input type="datetime-local" class="form-control" name="planned_end" value="{{ old('planned_end') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Duración</label>
                        <input type="text" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="ej: 30 días">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Avance (%)</label>
                <input type="number" class="form-control" name="advance" value="{{ old('advance', 0) }}" min="0" max="100">
            </div>

            <h6 class="mt-4">Responsables</h6>
            <div class="mb-3">
                @foreach($members as $member)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="responsible_ids[]" value="{{ $member->id }}" id="member{{ $member->id }}">
                        <label class="form-check-label" for="member{{ $member->id }}">
                            {{ $member->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection