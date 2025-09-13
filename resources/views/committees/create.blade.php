@extends('layouts.app')

@section('page-title', 'Crear Comité')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('committees.index') }}">Comités</a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Crear Nuevo Comité</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('committees.store') }}">
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
                        <label class="form-label">Responsable</label>
                        <select class="form-select" name="responsible_id">
                            <option value="">Seleccionar...</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
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
                            <option value="Creado">Creado</option>
                            <option value="En Funciones">En Funciones</option>
                            <option value="Suspendido">Suspendido</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Creación</label>
                        <input type="date" class="form-control" name="creation_date" value="{{ old('creation_date') }}" required>
                    </div>
                </div>
            </div>

            <h6 class="mt-4">Miembros</h6>
            <div class="mb-3">
                @foreach($members as $member)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="member_ids[]" value="{{ $member->id }}" id="member{{ $member->id }}">
                        <label class="form-check-label" for="member{{ $member->id }}">
                            {{ $member->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <h6 class="mt-4">Documentos</h6>
            <div class="mb-3">
                <select class="form-select" name="document_ids[]" multiple size="6">
                    @foreach($documents as $document)
                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Mantén Ctrl presionado para seleccionar múltiples documentos.</small>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('committees.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection