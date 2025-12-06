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

<!-- Milestones Section -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hitos del Proyecto</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#milestoneModal" onclick="openMilestoneModal()">
            <i class="bi bi-flag"></i> Nuevo Hito
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->milestones as $milestone)
                        <tr>
                            <td><strong>{{ $milestone->name }}</strong></td>
                            <td>{{ $milestone->date->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($milestone->description, 60) }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="editMilestone({{ $milestone->id }})" data-bs-toggle="modal" data-bs-target="#milestoneModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('milestones.destroy', $milestone) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar hito?')">
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

<!-- Milestone Modal -->
<div class="modal fade" id="milestoneModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="milestoneModalTitle">Nuevo Hito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="milestoneForm" method="POST">
                @csrf
                <input type="hidden" id="milestoneMethod" name="_method" value="POST">
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="milestoneName" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="milestoneDate" name="date" 
                               min="{{ $project->planned_start ? $project->planned_start->format('Y-m-d') : '' }}" 
                               max="{{ $project->planned_end ? $project->planned_end->format('Y-m-d') : '' }}" 
                               required>
                        <div class="form-text">
                            @if($project->planned_start && $project->planned_end)
                                Debe estar entre {{ $project->planned_start->format('d/m/Y') }} y {{ $project->planned_end->format('d/m/Y') }}
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="milestoneDescription" name="description" rows="3"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentMilestoneId = null;

function openMilestoneModal() {
    currentMilestoneId = null;
    document.getElementById('milestoneModalTitle').textContent = 'Nuevo Hito';
    document.getElementById('milestoneForm').action = '{{ route("milestones.store") }}';
    document.getElementById('milestoneMethod').value = 'POST';
    clearMilestoneForm();
}

function editMilestone(milestoneId) {
    currentMilestoneId = milestoneId;
    document.getElementById('milestoneModalTitle').textContent = 'Editar Hito';
    document.getElementById('milestoneForm').action = `/milestones/${milestoneId}`;
    document.getElementById('milestoneMethod').value = 'PUT';
    
    // Fetch milestone data
    fetch(`/milestones/${milestoneId}/edit`)
        .then(response => response.json())
        .then(milestone => {
            document.getElementById('milestoneName').value = milestone.name || '';
            document.getElementById('milestoneDate').value = milestone.date ? milestone.date.slice(0, 10) : '';
            document.getElementById('milestoneDescription').value = milestone.description || '';
        })
        .catch(error => console.error('Error:', error));
}

function clearMilestoneForm() {
    document.getElementById('milestoneName').value = '';
    document.getElementById('milestoneDate').value = '';
    document.getElementById('milestoneDescription').value = '';
}

document.getElementById('milestoneForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = this.action;
    
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
            alert('Error al guardar el hito');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar el hito');
    });
});
</script>

<!-- Resources Section -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recursos del Proyecto</h5>
        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#resourceModal" onclick="openResourceModal()">
            <i class="bi bi-box"></i> Nuevo Recurso
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Tarea</th>
                        <th>Cantidad</th>
                        <th>Costo Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->tasks as $task)
                        @foreach($task->resources as $resource)
                            <tr>
                                <td><strong>{{ $resource->name }}</strong></td>
                                <td><span class="badge bg-secondary">{{ $resource->type }}</span></td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $resource->quantity }} {{ $resource->unity }}</td>
                                <td>${{ number_format($resource->total_cost, 2) }}</td>
                                <td><span class="badge bg-primary">{{ $resource->status }}</span></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="editResource({{ $resource->id }})" data-bs-toggle="modal" data-bs-target="#resourceModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('resources.destroy', $resource) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar recurso?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Resource Modal -->
<div class="modal fade" id="resourceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resourceModalTitle">Nuevo Recurso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="resourceForm" method="POST">
                @csrf
                <input type="hidden" id="resourceMethod" name="_method" value="POST">
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="resourceName" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select class="form-select" id="resourceType" name="type" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="material">Material</option>
                                    <option value="personal">Personal</option>
                                    <option value="transporte">Transporte</option>
                                    <option value="imprevistos">Imprevistos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tarea</label>
                        <select class="form-select" id="resourceTaskId" name="task_id" required>
                            <option value="">Seleccionar tarea...</option>
                            @foreach($project->tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="resourceDescription" name="description" rows="2"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="resourceQuantity" name="quantity" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Unidad</label>
                                <select class="form-select" id="resourceUnity" name="unity" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="kg">Kilogramos (kg)</option>
                                    <option value="m">Metros (m)</option>
                                    <option value="m2">Metros cuadrados (m²)</option>
                                    <option value="m3">Metros cúbicos (m³)</option>
                                    <option value="lt">Litros (lt)</option>
                                    <option value="hrs">Horas (hrs)</option>
                                    <option value="dias">Días</option>
                                    <option value="unidad">Unidad</option>
                                    <option value="paquete">Paquete</option>
                                    <option value="caja">Caja</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Costo Unitario</label>
                                <input type="number" class="form-control" id="resourceUnityCost" name="unity_cost" step="0.01" min="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Costo Total</label>
                                <input type="number" class="form-control" id="resourceTotalCost" name="total_cost" step="0.01" min="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" id="resourceStatus" name="status">
                                    <option value="planificado">Planificado</option>
                                    <option value="en_stock">En Stock</option>
                                    <option value="consumido">Consumido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentResourceId = null;

function openResourceModal() {
    currentResourceId = null;
    document.getElementById('resourceModalTitle').textContent = 'Nuevo Recurso';
    document.getElementById('resourceForm').action = '{{ route("resources.store") }}';
    document.getElementById('resourceMethod').value = 'POST';
    clearResourceForm();
}

function editResource(resourceId) {
    currentResourceId = resourceId;
    document.getElementById('resourceModalTitle').textContent = 'Editar Recurso';
    document.getElementById('resourceForm').action = `/resources/${resourceId}`;
    document.getElementById('resourceMethod').value = 'PUT';
    
    // Fetch resource data
    fetch(`/resources/${resourceId}/edit`)
        .then(response => response.json())
        .then(resource => {
            document.getElementById('resourceName').value = resource.name || '';
            document.getElementById('resourceType').value = resource.type || '';
            document.getElementById('resourceTaskId').value = resource.task_id || '';
            document.getElementById('resourceDescription').value = resource.description || '';
            document.getElementById('resourceQuantity').value = resource.quantity || '';
            document.getElementById('resourceUnity').value = resource.unity || '';
            document.getElementById('resourceUnityCost').value = resource.unity_cost || '';
            document.getElementById('resourceTotalCost').value = resource.total_cost || '';
            document.getElementById('resourceStatus').value = resource.status || 'planificado';
        })
        .catch(error => console.error('Error:', error));
}

function clearResourceForm() {
    document.getElementById('resourceName').value = '';
    document.getElementById('resourceType').value = '';
    document.getElementById('resourceTaskId').value = '';
    document.getElementById('resourceDescription').value = '';
    document.getElementById('resourceQuantity').value = '';
    document.getElementById('resourceUnity').value = '';
    document.getElementById('resourceUnityCost').value = '';
    document.getElementById('resourceTotalCost').value = '';
    document.getElementById('resourceStatus').value = 'planificado';
}

// Auto-calculate total cost
document.addEventListener('input', function(e) {
    if (e.target.id === 'resourceQuantity' || e.target.id === 'resourceUnityCost') {
        const quantity = parseFloat(document.getElementById('resourceQuantity').value) || 0;
        const unityCost = parseFloat(document.getElementById('resourceUnityCost').value) || 0;
        const totalCost = quantity * unityCost;
        document.getElementById('resourceTotalCost').value = totalCost.toFixed(2);
    }
});

document.getElementById('resourceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = this.action;
    
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
            alert('Error al guardar el recurso');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar el recurso');
    });
});
</script>

<!-- Invoices Section -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Facturas del Proyecto</h5>
        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceModal" onclick="openInvoiceModal()">
            <i class="bi bi-receipt"></i> Nueva Factura
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Proveedor</th>
                        <th>Tarea</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Documento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->tasks as $task)
                        @foreach($task->invoices as $invoice)
                            <tr>
                                <td><strong>{{ $invoice->number }}</strong></td>
                                <td>{{ $invoice->provider }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $invoice->invoice_date->format('d/m/Y') }}</td>
                                <td>${{ number_format($invoice->total, 2) }}</td>
                                <td><span class="badge bg-primary">{{ $invoice->status }}</span></td>
                                <td>
                                    @if($invoice->document)
                                        <a href="{{ route('documents.show', $invoice->document) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-file-earmark"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">Sin documento</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="editInvoice({{ $invoice->id }})" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar factura?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalTitle">Nueva Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="invoiceForm" method="POST">
                @csrf
                <input type="hidden" id="invoiceMethod" name="_method" value="POST">
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Número de Factura</label>
                                <input type="text" class="form-control" id="invoiceNumber" name="number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="invoiceDate" name="invoice_date" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Proveedor</label>
                                <input type="text" class="form-control" id="invoiceProvider" name="provider" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total</label>
                                <input type="number" class="form-control" id="invoiceTotal" name="total" step="0.01" min="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tarea</label>
                                <select class="form-select" id="invoiceTaskId" name="task_id" required>
                                    <option value="">Seleccionar tarea...</option>
                                    @foreach($project->tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" id="invoiceStatus" name="status" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Pagada">Pagada</option>
                                    <option value="Vencida">Vencida</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Documento Asociado</label>
                        <select class="form-select" id="invoiceDocumentId" name="document_id">
                            <option value="">Sin documento</option>
                            @foreach($documents as $document)
                                <option value="{{ $document->id }}">{{ $document->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" id="invoiceDescription" name="description" rows="3"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentInvoiceId = null;

function openInvoiceModal() {
    currentInvoiceId = null;
    document.getElementById('invoiceModalTitle').textContent = 'Nueva Factura';
    document.getElementById('invoiceForm').action = '{{ route("invoices.store") }}';
    document.getElementById('invoiceMethod').value = 'POST';
    clearInvoiceForm();
}

function editInvoice(invoiceId) {
    currentInvoiceId = invoiceId;
    document.getElementById('invoiceModalTitle').textContent = 'Editar Factura';
    document.getElementById('invoiceForm').action = `/invoices/${invoiceId}`;
    document.getElementById('invoiceMethod').value = 'PUT';
    
    // Fetch invoice data
    fetch(`/invoices/${invoiceId}/edit`)
        .then(response => response.json())
        .then(invoice => {
            document.getElementById('invoiceNumber').value = invoice.number || '';
            document.getElementById('invoiceDate').value = invoice.invoice_date || '';
            document.getElementById('invoiceProvider').value = invoice.provider || '';
            document.getElementById('invoiceTotal').value = invoice.total || '';
            document.getElementById('invoiceTaskId').value = invoice.task_id || '';
            document.getElementById('invoiceStatus').value = invoice.status || 'Pendiente';
            document.getElementById('invoiceDocumentId').value = invoice.document_id || '';
            document.getElementById('invoiceDescription').value = invoice.description || '';
        })
        .catch(error => console.error('Error:', error));
}

function clearInvoiceForm() {
    document.getElementById('invoiceNumber').value = '';
    document.getElementById('invoiceDate').value = '';
    document.getElementById('invoiceProvider').value = '';
    document.getElementById('invoiceTotal').value = '';
    document.getElementById('invoiceTaskId').value = '';
    document.getElementById('invoiceStatus').value = 'Pendiente';
    document.getElementById('invoiceDocumentId').value = '';
    document.getElementById('invoiceDescription').value = '';
}

document.getElementById('invoiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const url = this.action;
    
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
            alert('Error al guardar la factura');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar la factura');
    });
});
</script>
@endsection