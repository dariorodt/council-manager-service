@extends('layouts.app')

@section('page-title', 'Comités')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Comités</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Comités</h4>
    <a href="{{ route('committees.create') }}" class="btn btn-primary">Crear Comité</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($committees as $committee)
                        <tr>
                            <td>{{ $committee->name }}</td>
                            <td>{{ $committee->responsible->name ?? 'Sin asignar' }}</td>
                            <td>
                                <span class="badge bg-{{ $committee->status === 'En Funciones' ? 'success' : ($committee->status === 'Suspendido' ? 'danger' : 'secondary') }}">
                                    {{ $committee->status }}
                                </span>
                            </td>
                            <td>{{ $committee->creation_date->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('committees.show', $committee) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('committees.edit', $committee) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                <form method="POST" action="{{ route('committees.destroy', $committee) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay comités registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection