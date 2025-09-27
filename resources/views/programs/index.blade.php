@extends('layouts.app')

@section('page-title', 'Programas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Programas</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Programas</h2>
    <a href="{{ route('programs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Nuevo Programa
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Presupuesto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $program)
                        <tr>
                            <td>
                                <strong>{{ $program->name }}</strong>
                                @if($program->description)
                                    <br><small class="text-muted">{{ Str::limit($program->description, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $program->status == 'activo' ? 'success' : ($program->status == 'finalizado' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst($program->status) }}
                                </span>
                            </td>
                            <td>{{ $program->start_date ? $program->start_date->format('d/m/Y') : '-' }}</td>
                            <td>{{ $program->end_date ? $program->end_date->format('d/m/Y') : '-' }}</td>
                            <td>${{ number_format($program->budget, 2) }}</td>
                            <td>
                                <a href="{{ route('programs.show', $program) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('programs.edit', $program) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar programa?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection