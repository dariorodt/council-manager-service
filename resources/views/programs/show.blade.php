@extends('layouts.app')

@section('page-title', 'Ver Programa')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('programs.index') }}">Programas</a></li>
    <li class="breadcrumb-item active">Ver</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">{{ $program->name }}</h5>
        <div>
            <a href="{{ route('programs.edit', $program) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('programs.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Estado:</strong> 
                    <span class="badge bg-{{ $program->status == 'activo' ? 'success' : ($program->status == 'finalizado' ? 'primary' : 'secondary') }}">
                        {{ ucfirst($program->status) }}
                    </span>
                </p>
                <p><strong>Fecha de Inicio:</strong> {{ $program->start_date ? $program->start_date->format('d/m/Y') : 'No definida' }}</p>
                <p><strong>Fecha de Fin:</strong> {{ $program->end_date ? $program->end_date->format('d/m/Y') : 'No definida' }}</p>
                <p><strong>Presupuesto:</strong> ${{ number_format($program->budget, 2) }}</p>
            </div>
            <div class="col-md-6">
                @if($program->description)
                    <p><strong>Descripción:</strong></p>
                    <p>{{ $program->description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection