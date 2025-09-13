@extends('layouts.app')

@section('page-title', 'Proyectos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Proyectos</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Proyectos</h4>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Crear Proyecto</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Comité</th>
                        <th>Estado</th>
                        <th>Avance</th>
                        <th>Inicio Planificado</th>
                        <th>Fin Planificado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->committee->name ?? 'Sin asignar' }}</td>
                            <td>
                                <span class="badge bg-{{ $project->status === 'completado' ? 'success' : ($project->status === 'en_ejecucion' ? 'primary' : ($project->status === 'suspendido' ? 'warning' : ($project->status === 'cancelado' ? 'danger' : 'secondary'))) }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </td>
                            <td>{{ $project->advance }}%</td>
                            <td>{{ $project->planned_start ? $project->planned_start->format('d/m/Y') : '-' }}</td>
                            <td>{{ $project->planned_end ? $project->planned_end->format('d/m/Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                <form method="POST" action="{{ route('projects.destroy', $project) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay proyectos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection