@extends('layouts.app')

@section('page-title', 'Editar Asamblea')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('assemblies.index') }}">Asambleas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Asamblea</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('assemblies.update', $assembly) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Correlativo</label>
                        <input type="text" class="form-control" name="correlative" value="{{ old('correlative', $assembly->correlative) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="type" required>
                            <option value="General" {{ old('type', $assembly->type) == 'General' ? 'selected' : '' }}>General</option>
                            <option value="Extraordinaria" {{ old('type', $assembly->type) == 'Extraordinaria' ? 'selected' : '' }}>Extraordinaria</option>
                            <option value="De Ciudadanos" {{ old('type', $assembly->type) == 'De Ciudadanos' ? 'selected' : '' }}>De Ciudadanos</option>
                            <option value="Informativa" {{ old('type', $assembly->type) == 'Informativa' ? 'selected' : '' }}>Informativa</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="status" required>
                            <option value="Programada" {{ old('status', $assembly->status) == 'Programada' ? 'selected' : '' }}>Programada</option>
                            <option value="Finalizada" {{ old('status', $assembly->status) == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha Programada</label>
                        <input type="datetime-local" class="form-control" name="scheduled_date" value="{{ old('scheduled_date', $assembly->scheduled_date->format('Y-m-d\TH:i')) }}" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Motivo</label>
                <textarea class="form-control" name="reason" rows="3" required>{{ old('reason', $assembly->reason) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Fecha Real (opcional)</label>
                <input type="datetime-local" class="form-control" name="actual_date" value="{{ old('actual_date', $assembly->actual_date ? $assembly->actual_date->format('Y-m-d\TH:i') : '') }}">
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('assemblies.show', $assembly) }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection