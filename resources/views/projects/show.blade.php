@extends('layouts.app')

@section('page-title', 'Ver Proyecto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Proyectos</a></li>
    <li class="breadcrumb-item active">Ver</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">{{ $project->name }}</h5>
        <div>
            <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Comité:</strong> {{ $project->committee->name ?? 'Sin asignar' }}</p>
                <p><strong>Función:</strong> {{ $project->function->nombre ?? 'Sin asignar' }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge bg-{{ $project->status === 'completado' ? 'success' : ($project->status === 'en_ejecucion' ? 'primary' : ($project->status === 'suspendido' ? 'warning' : ($project->status === 'cancelado' ? 'danger' : 'secondary'))) }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </p>
                <p><strong>Avance:</strong> {{ $project->advance }}%</p>
            </div>
            <div class="col-md-6">
                <p><strong>Inicio Planificado:</strong> {{ $project->planned_start ? $project->planned_start->format('d/m/Y H:i') : 'No definido' }}</p>
                <p><strong>Fin Planificado:</strong> {{ $project->planned_end ? $project->planned_end->format('d/m/Y H:i') : 'No definido' }}</p>
                <p><strong>Duración:</strong> {{ $project->duration ?? 'No definida' }}</p>
                @if($project->real_start)
                    <p><strong>Inicio Real:</strong> {{ $project->real_start->format('d/m/Y H:i') }}</p>
                @endif
                @if($project->real_end)
                    <p><strong>Fin Real:</strong> {{ $project->real_end->format('d/m/Y H:i') }}</p>
                @endif
            </div>
        </div>

        @if($project->description)
            <div class="mt-3">
                <p><strong>Descripción:</strong></p>
                <p>{{ $project->description }}</p>
            </div>
        @endif

        @if($project->responsibles->count() > 0)
            <h6 class="mt-4">Responsables</h6>
            <div class="row">
                @foreach($project->responsibles as $responsible)
                    <div class="col-md-4 mb-2">
                        <span class="badge bg-light text-dark">{{ $responsible->name }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        @if($project->tasks->count() > 0)
            <h6 class="mt-4">Tareas</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th>Avance</th>
                            <th>Presupuesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project->tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $task->status === 'en_ejecucion' ? 'primary' : ($task->status === 'suspendida' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td>{{ $task->responsible->name ?? 'Sin asignar' }}</td>
                                <td>{{ $task->advance }}%</td>
                                <td>${{ number_format($task->budget, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection