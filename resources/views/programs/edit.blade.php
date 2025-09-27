@extends('layouts.app')

@section('page-title', 'Editar Programa')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('programs.index') }}">Programas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Programa</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('programs.update', $program) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $program->name) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="status" required>
                            <option value="activo" {{ old('status', $program->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('status', $program->status) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="finalizado" {{ old('status', $program->status) == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $program->description) }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $program->start_date ? $program->start_date->format('Y-m-d') : '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $program->end_date ? $program->end_date->format('Y-m-d') : '') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Presupuesto</label>
                        <input type="number" class="form-control" name="budget" value="{{ old('budget', $program->budget) }}" step="0.01" min="0">
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('programs.show', $program) }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection