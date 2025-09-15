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

<!-- Tasks Section -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tareas del Proyecto</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#taskModal" onclick="openTaskModal()">
            <i class="bi bi-plus"></i> Nueva Tarea
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Avance</th>
                        <th>Presupuesto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->tasks as $task)
                        <tr>
                            <td>
                                <strong>{{ $task->name }}</strong>
                                @if($task->description)
                                    <br><small class="text-muted">{{ Str::limit($task->description, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $task->status == 'en_ejecucion' ? 'primary' : ($task->status == 'suspendida' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </td>
                            <td>{{ $task->advance }}%</td>
                            <td>${{ number_format($task->budget, 2) }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="editTask({{ $task->id }})" data-bs-toggle="modal" data-bs-target="#taskModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar tarea?')">
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

<!-- Task Modal -->
<div class="modal fade" id="taskModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalTitle">Nueva Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="taskForm" method="POST">
                @csrf
                <input type="hidden" id="taskMethod" name="_method" value="POST">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="taskName" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" id="taskStatus" name="status" required>
                                    <option value="programada">Programada</option>
                                    <option value="en_ejecucion">En Ejecución</option>
                                    <option value="suspendida">Suspendida</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="taskDescription" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Inicio Planificado</label>
                                <input type="datetime-local" class="form-control" id="taskPlannedStart" name="planned_start">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Fin Planificado</label>
                                <input type="datetime-local" class="form-control" id="taskPlannedEnd" name="planned_end">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Duración</label>
                                <input type="text" class="form-control" id="taskDuration" name="duration" placeholder="ej: 15">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Presupuesto</label>
                                <input type="number" class="form-control" id="taskBudget" name="budget" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Avance (%)</label>
                                <input type="number" class="form-control" id="taskAdvance" name="advance" min="0" max="100" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentTaskId = null;

function openTaskModal() {
    currentTaskId = null;
    document.getElementById('taskModalTitle').textContent = 'Nueva Tarea';
    document.getElementById('taskForm').action = '{{ route("tasks.store") }}';
    document.getElementById('taskMethod').value = 'POST';
    clearTaskForm();
}

function editTask(taskId) {
    currentTaskId = taskId;
    document.getElementById('taskModalTitle').textContent = 'Editar Tarea';
    document.getElementById('taskForm').action = `/tasks/${taskId}`;
    document.getElementById('taskMethod').value = 'PUT';
    
    // Fetch task data
    fetch(`/tasks/${taskId}/edit`)
        .then(response => response.json())
        .then(task => {
            document.getElementById('taskName').value = task.name || '';
            document.getElementById('taskDescription').value = task.description || '';
            document.getElementById('taskStatus').value = task.status || 'programada';
            document.getElementById('taskPlannedStart').value = task.planned_start ? task.planned_start.slice(0, 16) : '';
            document.getElementById('taskPlannedEnd').value = task.planned_end ? task.planned_end.slice(0, 16) : '';
            document.getElementById('taskDuration').value = task.duration || '';
            document.getElementById('taskBudget').value = task.budget || '';
            document.getElementById('taskAdvance').value = task.advance || 0;
        })
        .catch(error => console.error('Error:', error));
}

function clearTaskForm() {
    document.getElementById('taskName').value = '';
    document.getElementById('taskDescription').value = '';
    document.getElementById('taskStatus').value = 'programada';
    document.getElementById('taskPlannedStart').value = '';
    document.getElementById('taskPlannedEnd').value = '';
    document.getElementById('taskDuration').value = '';
    document.getElementById('taskBudget').value = '';
    document.getElementById('taskAdvance').value = '0';
}

document.getElementById('taskForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = this.action;
    const method = document.getElementById('taskMethod').value;
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (response.ok) {
            location.reload();
        } else {
            alert('Error al guardar la tarea');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar la tarea');
    });
});
</script>
@endsection