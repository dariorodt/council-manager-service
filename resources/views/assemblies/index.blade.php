@extends('layouts.app')

@section('page-title', 'Assemblies')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Asambleas</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Asambleas</h2>
    <a href="{{ route('assemblies.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Nueva asamblea
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
                        <th>Correlativo</th>
                        <th>Tipo</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Fecha Programada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assemblies as $assembly)
                        <tr>
                            <td>{{ $assembly->correlative }}</td>
                            <td><span class="badge bg-info">{{ $assembly->type }}</span></td>
                            <td>{{ Str::limit($assembly->reason, 50) }}</td>
                            <td><span class="badge {{ $assembly->status == 'Finalizada' ? 'bg-success' : 'bg-warning' }}">{{ $assembly->status }}</span></td>
                            <td>{{ $assembly->scheduled_date->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('assemblies.show', $assembly) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('assemblies.edit', $assembly) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('assemblies.destroy', $assembly) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar asamblea?')">
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